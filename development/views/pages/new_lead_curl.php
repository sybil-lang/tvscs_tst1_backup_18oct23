<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="tvs_header.php" clickstream="incident_create"/>
<?php
require_once(get_cfg_var('doc_root').'/include/ConnectPHP/Connect_init.phph');
initConnectAPI();
require_once ('/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php');
$retval = RightNow\Libraries\AbuseDetection::check();
function soap_call($functionName, $arrparam){
	$url = 'http://leadsuatservice.tvscredit.com/TVSCSLMSAPI.svc?wsdl';
	$client = new nusoap_client($url,'wsdl');
	$client->soap_defencoding = 'UTF-8';
	$param=array('parameters'=>$arrparam);
	$response = $client->call($functionName, $param);
	$soapError = $client->getError();
	if (!empty($soapError)){
		echo 'SOAP method invocation failed:'.$soapError;
	}
	else{
		if(is_array($response)){	
			return $response;
		}
		else{
			return $response;	
		}
	}
}
function report_result($report_id, $filter_array){
	try{
		$result_arr=array();
		if(count($filter_array)>0){
			$report_filter= new RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
			$filters = new RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
			foreach($filter_array as $filtername => $filtervalue){
				$report_filter= new RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
				$report_filter->Name = $filtername;
				$report_filter->Values = array($filtervalue);
				$filters[] = $report_filter;
			}
			$ar= RightNow\Connect\v1_3\AnalyticsReport::fetch($report_id);
			$con_res= $ar->run(0,$filters);
			$con_count=$con_res->count();
			if($con_count>0){
				for($ii=$con_count;$ii--;){
					 $row = $con_res->next();
					 $result_arr[]=$row;
				}
			}
		}
		else{
			$ar= RightNow\Connect\v1_3\AnalyticsReport::fetch($report_id);
			$con_res= $ar->run(0);
			$con_count=$con_res->count();
			if($con_count>0){
				for($ii=$con_count;$ii--;){
					 $row = $con_res->next();
					 $result_arr[]=$row;
				}
			}
		}
		return $result_arr;
	}
	catch (Exception $err ){
		echo $err->getMessage();
	}
}
function create_contact($param_data){
	try{
		$title=$param_data['title'];
		$first_name=$param_data['first_name'];
		$last_name=$param_data['last_name'];
		$mobile=$param_data['mobile'];
		$date_of_birth=$param_data['date_of_birth'];
		$email=$param_data['email'];
		$address=$param_data['address'];
		$city=$param_data['city'];
		$state=$param_data['state'];
		$Pincode=$param_data['Pincode'];
		$country=$param_data['country'];
			
		$contact = new  RightNow\Connect\v1_3\Contact();
		$contact->Name = new  RightNow\Connect\v1_3\PersonName();
		if(isset($title) and strlen($title)){
			$contact->title=$title;
		}
		if(strlen($first_name)){
			$contact->Name->First =ucwords($first_name);
		}
		if(strlen($last_name)){
			$contact->Name->Last = ucwords($last_name);
		}
		if(strlen($email)){
			//add email addresses
			$contact->Emails = new  RightNow\Connect\v1_3\EmailArray();
			$contact->Emails[0] = new  RightNow\Connect\v1_3\Email();
			$contact->Emails[0]->AddressType=new  RightNow\Connect\v1_3\NamedIDOptList();
			$contact->Emails[0]->AddressType->LookupName = "Email - Primary";
			$contact->Emails[0]->Address = strtolower($email);
		}
		if(strlen($mobile)){
			$i = 0;
			$contact->Phones[$i] = new  RightNow\Connect\v1_3\Phone();
			$contact->Phones[$i]->PhoneType = new  RightNow\Connect\v1_3\NamedIDOptList();
			$contact->Phones[$i]->PhoneType->LookupName = 'Mobile Phone';
			$contact->Phones[$i]->Number = $mobile;
			$i++;
		}
		if(strlen($date_of_birth)){
			$contact->CustomFields->c->dob=$date_of_birth;	
		}
		$contact->Address = new RightNow\Connect\v1_3\Address();
		if(strlen($address) or strlen($Pincode)){
			$contact->Address->Street = $address;
		}
		if(strlen($city) or strlen($city)){
			$contact->Address->City = $city;
		}
		if(strlen($state) or strlen($state)){
			$contact->Address->StateOrProvince = new RightNow\Connect\v1_3\NamedIDLabel();
			$contact->Address->StateOrProvince->LookupName = "$state";
		}
		if(strlen($country) or strlen($country)){
			$contact->Address->Country = RightNow\Connect\v1_3\Country::fetch("$country");
		}
		if(strlen($Pincode) or strlen($Pincode)){
			$contact->Address->PostalCode = $Pincode;
		}

		$contact->ContactType = new RightNow\Connect\v1_3\NamedIDLabel();
		$contact->ContactType->LookupName = "Customer";

		$contact->save();
		$contact_id=$contact->ID;
		return $contact_id;
	}
	catch(Exception $e){
	  echo "<br>Error: ".$e->getMessage()." | Code: ".$e->getCode()."| Line: ".$e->getLine();
	}	
}
function update_contact($param_data,$contact_id){
	try{
		if(strlen($contact_id) and $contact_id>0){
			$title=$param_data['title'];
			$first_name=$param_data['first_name'];
			$last_name=$param_data['last_name'];
			$date_of_birth=$param_data['date_of_birth'];
			$address=$param_data['address'];
			$city=$param_data['city'];
			$state=$param_data['state'];
			$Pincode=$param_data['Pincode'];
			$country=$param_data['country'];
			$contact=RightNow\Connect\v1_3\Contact::fetch($contact_id);
			if(isset($title) and strlen($title)){
				$contact->title=$title;
			}
			if(strlen($first_name)){
				$contact->Name->First =ucwords($first_name);
			}
			if(strlen($last_name)){
				$contact->Name->Last = ucwords($last_name);
			}
			if(strlen($date_of_birth)){
				$contact->CustomFields->c->dob=$date_of_birth;	
			}

			if(strlen($address) or strlen($Pincode)){
				$contact->Address->Street = $address;
			}
			if(strlen($city) or strlen($city)){
				$contact->Address->City = $city;
			}
			if(strlen($state) or strlen($state)){
				$contact->Address->StateOrProvince->LookupName=="$state";
			}
			if(strlen($country) or strlen($country)){
				$contact->Address->Country = RightNow\Connect\v1_3\Country::fetch("$country");
			}
			if(strlen($Pincode) or strlen($Pincode)){
				$contact->Address->PostalCode = $Pincode;
			}

			$contact->ContactType = new RightNow\Connect\v1_3\NamedIDLabel();
			$contact->ContactType->LookupName = "Customer";

			$contact->save();
		}
	}
	catch(Exception $e){
	  echo "<br>Error: ".$e->getMessage()." | Code: ".$e->getCode()."| Line: ".$e->getLine();
	}	
}
function create_opportunity($param_data,$contact_id){
   try{
	   $first_name=$param_data['first_name'];
	   $last_name=$param_data['last_name'];
	   $mobile=$param_data['mobile'];
	   $loan_type=$param_data['loan_type'];
	   $opp = new RightNow\Connect\v1_3\Opportunity();
	   if(strlen($mobile) and strlen($first_name)){
			$oppname="$mobile: $first_name";
			if(strlen($last_name)){
				$oppname .=" - $last_name";	
			}
			$opp->Name =$oppname;
		}
		if(strlen($loan_type) and strlen($loan_type)){
			$menu= new RightNow\Connect\v1_3\NamedIDLabel();
			//$menu->LookupName="$loan_type";
			$menu->ID="$loan_type";
			$opp->CustomFields->c->loan_type=$menu;

		}
		$opp->PrimaryContact->Contact=RightNow\Connect\v1_3\Contact::fetch($contact_id);
		/*$opp->StageWithStrategy->Stage= new RightNow\Connect\v1_3\NamedIDLabel();
		$opp->StatusWithType->Status->ID='Active';*/
		$opp->save();
		$opp_id=$opp->ID;
		return $opp_id;
   }
   catch(Exception $e){
	  echo "<br>Error: ".$e->getMessage()." | Code: ".$e->getCode()."| Line: ".$e->getLine();
   }
}

if($_POST['Action']=="Create_New_Lead"){ //Create new Lead
	$postdata=$_POST;
	
	$email=$postdata['email'];
	$mobile=$postdata['mobile'];
	$action=$postdata['clickaction'];
	$loan_type=$postdata['loan_type'];
	
	if(isset($mobile) and strlen($mobile)==10){
		$params = array(
					'title' => $postdata['title'],
					'first_name' => $postdata['first_name'],
					'middle_name' => $postdata['middle_name'],
					'last_name' => $postdata['last_name'],
					'Name' => $postdata['first_name'],
					'MiddleName' => $postdata['middle_name'],
					'LastName' => $postdata['last_name'],
					'Father_Spouse' => $postdata['Father_Spouse'],
					'Gender' => $postdata['Gender'],
					'CompanyName' => $postdata['CompanyName'],
			        'CompanyAddress' => $postdata['CompanyAddress'],
					'CustProfile' => $postdata['CustProfile'],
					'Pancard' => $postdata['Pancard'],
					'Passport' => $postdata['Passport'],
					'Voterid' => $postdata['Voterid'],
					'Driving_License' => $postdata['Driving_License'],
					'Rationcard' => $postdata['Rationcard'],
					'Adharcard' => $postdata['Adharcard'],
					'Residentstatus' => $postdata['Residentstatus'],
					'ResidentStability' => $postdata['ResidentStability'],
					'LoanAmount' => $postdata['LoanAmount'],
					'Tenure' => $postdata['Tenure'],
					'RepaymentMode' => $postdata['RepaymentMode'],
					'EMIcomfort' => $postdata['EMIcomfort'],
					'MonthIncome' => $postdata['MonthIncome'],
					'Year' => $postdata['Year'],
					'Make' => $postdata['Make'],
					'Model' => $postdata['Model'],
					'Variant' => $postdata['Variant'],
					'loan_type' => $postdata['loan_type'],
					'date_of_birth' => $postdata['date_of_birth'],
					'email' => $postdata['email'],
					'Email' => $postdata['email'],
					'mobile' => $postdata['mobile'],
					'Mobile' => $postdata['mobile'],
					'address' => $postdata['address'],
				    'Address' => $postdata['address'],
					'state' => $postdata['state'],
				    'StateCode' => $postdata['state'],
					'city' => $postdata['city'],
					'CityCode' => $postdata['city'],
					'Pincode' => $postdata['Pincode'],
					'country' => $postdata['country'],
					'ACC1' => $postdata['ACC1'],
					'Experience' => $postdata['Experience'],
					'FinalisedCar' => $postdata['FinalisedCar'],
					'ChannelCode' => $postdata['ChannelCode'],
					'ProductCode' => $postdata['ProductCode'],
					'loan_type' => $postdata['loan_type'],
					'AgencyCode'=>$postdata['AgencyCode'],

		);
		//$report_id=Config::getMessage(CUSTOM_MSG_CONTACT_SEARCH_ON_MOBILE_N_EMAIL);
		$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_ON_MOBILE_N_EMAIL);
		$report_id=$msg->Value;
		if($report_id>0){
			$contact_result=report_result($report_id,array('Mobile'=>$mobile));
			if(count($contact_result)==0){ 
				/*Code to create new Contact starts here*/
				$contact_id=create_contact($params);
				/*Code to create new Contact ends here*/
				if(isset($contact_id) and $contact_id>0){
					$opp_id=create_opportunity($params,$contact_id);
				}

			}
			else{
				$contact_id=$contact_result[0]['Contact ID'];
				
				
				/*Code to update Contact starts here*/
				if(isset($contact_id) and $contact_id>0){
					update_contact($params,$contact_id);
					//$report_id=Config::getMessage(CUSTOM_MSG_CHECK_OPP_EXISTS_IN_LAST_24_HRS);
					$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CHECK_OPP_EXISTS_IN_LAST_24_HRS);
					$report_id=$msg->Value;
					if($report_id>0){
						$opp_result=report_result($report_id,array('Contact Id'=>$contact_id,'Loan Type'=>$loan_type));

						if(count($opp_result)==0){
							$opp_id=create_opportunity($params,$contact_id);
						}

					}
				}
				/*Code to update new Contact ends here*/
			}
			/*Code for creatng Lead in LMS System starts here*/
			echo "<pre>";
			print_r($postdata);
			echo "</pre><br><hr><br>";
			$LMS_result= soap_call('InsertLMSData', $params);
			echo "<pre>";
			print_r($LMS_result);
			echo "</pre>";
			/*Code for creatng Lead in LMS System ends here*/
		}
	}
	else{
		echo "Please enter 10 digit mobile number";
	}
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";*/
	//header("Location: /app/new_lead_thanks");
	exit;

}




$VStateNameList= soap_call('GetVStateName', array('AgencyCode'=>'TVSCRM'));
$StateArray=$VStateNameList['GetVStateNameResult']['LMS_State_Entity'];

$VCityNameList= soap_call('GetVCityName', array('statecode'=>'HA','AgencyCode'=>'TVSCRM')); //pass statecode dynamically using ajax
$CityArray=$VCityNameList['GetVCityNameResult']['LMS_City_Entity'];

$VDynamicLast20Years= soap_call('GetVDynamicLast20Years', array('AgencyCode'=>'TVSCRM'));
$DynamicLast20YearsArray=$VDynamicLast20Years['GetVDynamicLast20YearsResult']['LMS_DynamicYearGen_Entity'];

$VMakeList= soap_call('getVMakeList', array('Year'=>'1997','AgencyCode'=>'TVSCRM'));
$VMakeListArray=$VMakeList['getVMakeListResult']['LMS_IBBMake_Entity'];

$VModelList= soap_call('getVModelList', array('Year'=>'1997','Make'=>'FIAT','AgencyCode'=>'TVSCRM'));
$VModelListArray=$VModelList['getVModelListResult']['LMS_IBBModel_Entity'];

$V_VariantlList= soap_call('getV_VariantlList', array('Year'=>'1997','Make'=>'FIAT','Model'=>'UNO','AgencyCode'=>'TVSCRM'));
$V_VariantlListArray=$V_VariantlList['getV_VariantlListResult']['LMS_IBBVariant_Entity'];

$VCommonFields_Gender= soap_call('GetVCommonFields', array('Key_code'=>'Gender','AgencyCode'=>'TVSCRM'));
$GenderArray=$VCommonFields_Gender['GetVCommonFieldsResult']['LMS_Common_Fields_Entity'];

$VCommonFields_CustomerProfile= soap_call('GetVCommonFields', array('Key_code'=>'Customer Profile','AgencyCode'=>'TVSCRM'));
$CustProfileArray=$VCommonFields_CustomerProfile['GetVCommonFieldsResult']['LMS_Common_Fields_Entity'];

$VCommonFields_ResidenceStatus= soap_call('GetVCommonFields', array('Key_code'=>'Residence Status','AgencyCode'=>'TVSCRM'));
$ResidenceStatusArray=$VCommonFields_ResidenceStatus['GetVCommonFieldsResult']['LMS_Common_Fields_Entity'];

$VRepaymentType= soap_call('GetVRepaymentType', array('AgencyCode'=>'TVSCRM'));
$RepaymentTypeArray=$VRepaymentType['GetVRepaymentTypeResult']['LMS_RepaymentType_Entity'];

/*code for product Type Dropdown starts here*/
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_PRODUCT_TYPE_DROPDOWN);
$report_id=$msg->Value;
if($report_id>0){
	$filter=array();
	$ProductCode_Array=report_result($report_id,$filter);
}
/*code for product Type Dropdown ends here*/

/*echo "<pre>";
print_r($product_type_result);
echo "</pre><br>";*/

?>
<div class="prefix_4 grid_8">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>Add New Lead</strong></h3>
  </div>
</div>
<br clear="all">
<div class="table-responsive col-md-8 ">
  <table width="100%" cellpadding="10" cellspacing="3" class="table-striped">
    <thead>
      <tr>
        <td align="right">(<span class="mandatory">*</span>) fields are Mandatory</td>
      </tr>
      <tr>
        <td><!--Form Area Starts here--> 
          
          <form name="new_lead_form" id="new_lead_form" method="post" action="" class="form-horizontal">
          
            
          <div class="form-group">
            <label for="country" class="col-md-4 control-label">Title</label>
            <div class="col-md-8">
              <select name="title" class="form-control" style="width:200px;">
                <?php 
				 $title_values = array(
						'Mr'=>'Mr',
						'Mrs'=>'Mrs',
						'Miss'=>'Miss',
				  );
				  if(count($title_values)>0){
					foreach($title_values as $value => $display_text){
						$selected = ($value == $this->input->post('title')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
					}
				  }
				  ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="first_name" class="col-md-4 control-label">First Name<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <input type="text" name="first_name" value="<?php echo $this->input->post('first_name') ? $this->input->post('first_name') :''; ?>" class="form-control" id="first_name" data-validation="required" maxlength="80"/>
            </div>
          </div>
          <div class="form-group">
            <label for="middle_name" class="col-md-4 control-label">Middle Name</label>
            <div class="col-md-8">
              <input type="text" name="middle_name" value="<?php echo $this->input->post('middle_name') ? $this->input->post('middle_name') :''; ?>" class="form-control" id="middle_name" data-validation="required" maxlength="80"/>
            </div>
          </div>
          <div class="form-group">
            <label for="last_name" class="col-md-4 control-label">Last Name<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <input type="text" name="last_name" value="<?php echo $this->input->post('last_name') ? $this->input->post('last_name') :''; ?>" class="form-control" id="last_name" data-validation="required"  maxlength="80"/>
            </div>
          </div>
          <div class="form-group">
            <label for="Father_Spouse" class="col-md-4 control-label">Father / Spouse<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <input type="text" name="Father_Spouse" value="<?php echo $this->input->post('Father_Spouse') ? $this->input->post('Father_Spouse') :''; ?>" class="form-control" id="Father_Spouse" data-validation="required"  maxlength="80"/>
            </div>
          </div>
          <div class="form-group">
            <label for="Gender" class="col-md-4 control-label">Gender<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="Gender" class="form-control"  style="width:200px;" data-validation="required">
              <?php 
				$Gender=($this->input->post('Gender')) ? $this->input->post('Gender') : '';
				if(count($GenderArray)>0){  
					foreach($GenderArray as $display){
						$value=$display['key_code'];
						$display_text=$display['code_desc'];
						if($Gender) $selected = ($value == $this->input->post('Gender')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
					}
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="acc1" class="col-md-4 control-label">Company Name</label>
            <div class="col-md-8">
              <input type="text" name="CompanyName" value="<?php echo $this->input->post('CompanyName') ? $this->input->post('CompanyName') :''; ?>" class="form-control" id="CompanyName" maxlength="100"/>
            </div>
          </div>
           <div class="form-group">
            <label for="acc1" class="col-md-4 control-label">Company Address</label>
            <div class="col-md-8">
              <input type="text" name="CompanyAddress" value="<?php echo $this->input->post('CompanyAddress') ? $this->input->post('CompanyAddress') :''; ?>" class="form-control" id="CompanyAddress" maxlength="100"/>
            </div>
          </div>
          <div class="form-group">
            <label for="CustProfile" class="col-md-4 control-label">CustProfile<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="CustProfile" class="form-control"  style="width:200px;" data-validation="required">
              <?php 
				$CustProfile=($this->input->post('CustProfile')) ? $this->input->post('CustProfile') : '';
				if(count($CustProfileArray)>0){  
					foreach($CustProfileArray as $display){
						$value=$display['code'];
						$display_text=$display['code_desc'];
						if($CustProfile) $selected = ($value == $this->input->post('CustProfile')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
					}
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="Pancard" class="col-md-4 control-label">PAN Card</label>
            <div class="col-md-8">
              <input type="text" name="Pancard" value="<?php echo $this->input->post('Pancard') ? $this->input->post('Pancard') :''; ?>" class="form-control" id="Pancard" maxlength="15"/>
            </div>
          </div>
          <div class="form-group">
            <label for="Passport" class="col-md-4 control-label">Passport Card</label>
            <div class="col-md-8">
              <input type="text" name="Passport" value="<?php echo $this->input->post('Passport') ? $this->input->post('Passport') :''; ?>" class="form-control" id="Passport" maxlength="20"/>
            </div>
          </div>
          <div class="form-group">
            <label for="Voterid" class="col-md-4 control-label">Voter Id Card</label>
            <div class="col-md-8">
              <input type="text" name="Voterid" value="<?php echo $this->input->post('Voterid') ? $this->input->post('Voterid') :''; ?>" class="form-control" id="Voterid" maxlength="20"/>
            </div>
          </div>
          <div class="form-group">
            <label for="Driving_License" class="col-md-4 control-label">Driving License</label>
            <div class="col-md-8">
              <input type="text" name="Driving_License" value="<?php echo $this->input->post('Driving_License') ? $this->input->post('Driving_License') :''; ?>" class="form-control" id="Driving_License" maxlength="20"/>
            </div>
          </div>
          <div class="form-group">
            <label for="Rationcard" class="col-md-4 control-label">Ration Card</label>
            <div class="col-md-8">
              <input type="text" name="Rationcard" value="<?php echo $this->input->post('Rationcard') ? $this->input->post('Rationcard') :''; ?>" class="form-control" id="Rationcard" maxlength="20"/>
            </div>
          </div>
          <div class="form-group">
            <label for="Adharcard" class="col-md-4 control-label">Aadhar Card</label>
            <div class="col-md-8">
              <input type="text" name="Adharcard" value="<?php echo $this->input->post('Adharcard') ? $this->input->post('Adharcard') :''; ?>" class="form-control" id="Adharcard" maxlength="20"/>
            </div>
          </div>
          <div class="form-group">
            <label for="Residentstatus" class="col-md-4 control-label">Resident Status<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="Residentstatus" class="form-control"  style="width:200px;" data-validation="required">
              <?php 
				$Residentstatus=($this->input->post('Residentstatus')) ? $this->input->post('Residentstatus') : '';
				if(count($ResidenceStatusArray)>0){  
					foreach($ResidenceStatusArray as $display){
						$value=$display['code'];
						$display_text=$display['code_desc'];
						if($Residentstatus) $selected = ($value == $this->input->post('Residentstatus')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
					}
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="ResidentStability" class="col-md-4 control-label">Resident Stability</label>
            <div class="col-md-8">
              <input type="number" name="ResidentStability" value="<?php echo $this->input->post('ResidentStability') ? $this->input->post('ResidentStability') :''; ?>" class="form-control" id="ResidentStability" maxlength="4"/>
            </div>
          </div>
          <div class="form-group">
            <label for="LoanAmount" class="col-md-4 control-label">Loan Amount</label>
            <div class="col-md-8">
              <input type="text" name="LoanAmount" value="<?php echo $this->input->post('LoanAmount') ? $this->input->post('LoanAmount') :''; ?>" class="form-control" id="LoanAmount" maxlength="6"/>
            </div>
          </div>
          <div class="form-group">
            <label for="Tenure" class="col-md-4 control-label">Tenure</label>
            <div class="col-md-8">
              <input type="number" name="Tenure" value="<?php echo $this->input->post('Tenure') ? $this->input->post('Tenure') :''; ?>" class="form-control" id="Tenure" maxlength="4"/>
            </div>
          </div>
          <div class="form-group">
            <label for="RepaymentMode" class="col-md-4 control-label">Repayment Type<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="RepaymentMode" class="form-control"  style="width:200px;" data-validation="required">
              <?php 
				$Residentstatus=($this->input->post('RepaymentMode')) ? $this->input->post('RepaymentMode') : '';
				if(count($RepaymentTypeArray)>0){
					foreach($RepaymentTypeArray as $display){
						$value=$display['szpaymenttype'];
						$display_text=$display['szpaymenttypedes'];
						if($Residentstatus) $selected = ($value == $this->input->post('Residentstatus')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
					}
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="EMIcomfort" class="col-md-4 control-label">EMI Comfort</label>
            <div class="col-md-8">
              <input type="text" name="EMIcomfort" value="<?php echo $this->input->post('EMIcomfort') ? $this->input->post('EMIcomfort') :''; ?>" class="form-control" id="EMIcomfort" maxlength="4"/>
            </div>
          </div>
           <div class="form-group">
            <label for="MonthIncome" class="col-md-4 control-label">Month Income</label>
            <div class="col-md-8">
              <input type="text" name="MonthIncome" value="<?php echo $this->input->post('MonthIncome') ? $this->input->post('MonthIncome') :''; ?>" class="form-control" id="MonthIncome" maxlength="10"/>
            </div>
          </div>
          <div class="form-group">
            <label for="Year" class="col-md-4 control-label">Year<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="Year" id="Year" class="form-control"  style="width:200px;">
              <?php 
				$Year=($this->input->post('Year')) ? $this->input->post('Year') : '';
				if(count($DynamicLast20YearsArray)>0){
					foreach($DynamicLast20YearsArray as $display){
						$value=$display['years'];
						$display_text=$display['years'];
						if($state) $selected = ($value == $this->input->post('state')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
					} 
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="Make" class="col-md-4 control-label">Make<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="Make"  id="Make" class="form-control"  style="width:200px;">
              <?php 
				$Make=($this->input->post('Make')) ? $this->input->post('Make') : '';
				if(count($VMakeListArray)>0){
					foreach($VMakeListArray as $display){
						$value=$display['Make'];
						$display_text=$display['Make'];
						if($Make) $selected = ($value == $this->input->post('Make')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
					}
				}
				?>
              </select>
            </div>
          </div>
           <div class="form-group">
            <label for="Model" class="col-md-4 control-label">Model<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="Model" id="Model" class="form-control"  style="width:200px;">
              <?php 
				$Model=($this->input->post('Model')) ? $this->input->post('Model') : '';
				if(count($VModelListArray)>0){  
					foreach($VModelListArray as $display){
						$value=$display['Model'];
						$display_text=$display['Model'];
						if($Model) $selected = ($value == $this->input->post('Model')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
					}
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="Variant" class="col-md-4 control-label">Variant<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="Variant" id="Variant" class="form-control"  style="width:200px;">
              <?php 
				$Variant=($this->input->post('Variant')) ? $this->input->post('Variant') : '';
				if(count($V_VariantlListArray)>0){  
					foreach($V_VariantlListArray as $display){
						$value=$display['Variant'];
						$display_text=$display['Variant'];
						if($Model) $selected = ($value == $this->input->post('Model')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
					}
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="country" class="col-md-4 control-label">Loan Type<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="ProductCode" class="form-control" style="width:200px;">
                <?php
				if(count($ProductCode_Array)>0){    
					foreach($ProductCode_Array as $display_text){
						$selected = ($display_text['Product Description'] == $this->input->post('ProductCode')) ? ' selected="selected"' : null;
						echo '<option value="'.$display_text['Product Description'].'" '.$selected.'>'.$display_text['Product_Code'].'</option>';
					}
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-md-4 control-label">Date of birth<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <input type="text" id="date_of_birth" name="date_of_birth" value="<?php echo $this->input->post('date_of_birth') ? $this->input->post('date_of_birth') :''; ?>"  data-validation="date_of_birth"  maxlength="10" style="width:200px;"  data-field="date" class="form-control datepicker" data-validation="required" readonly  /><div class="dtBox"></div>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-md-4 control-label">Email<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <input type="text" name="email" value="<?php echo $this->input->post('email') ? $this->input->post('email') :''; ?>" class="form-control" id="email" data-validation="email"  maxlength="150"/>
            </div>
          </div>
          <div class="form-group">
            <label for="mobile" class="col-md-4 control-label">Mobile<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <input type="text" name="mobile" value="<?php echo $this->input->post('mobile') ? $this->input->post('mobile') :''; ?>" class="form-control" id="mobile" data-validation="required" maxlength="10" />
            </div>
          </div>
          <div class="form-group">
            <label for="address" class="col-md-4 control-label">Address</label>
            <div class="col-md-8">
              <input type="text" name="address" value="<?php echo $this->input->post('address') ? $this->input->post('address') :''; ?>" class="form-control" id="address"  maxlength="256" />
            </div>
          </div>
          <div class="form-group">
            <label for="state" class="col-md-4 control-label">State<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="state" class="form-control"  style="width:200px;" data-validation="required">
              <?php 
				$state=($this->input->post('state')) ? $this->input->post('state') : '';
				if(count($StateArray)>0){  
					foreach($StateArray as $display){
						$value=$display['szstatecode'];
						$display_text=$display['szdesc'];
						if($state) $selected = ($value == $this->input->post('state')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
					} 
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="city" class="col-md-4 control-label">City<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="city" class="form-control"  style="width:200px;" data-validation="required">
              <?php 
				$city=($this->input->post('city')) ? $this->input->post('city') : '';
				if(count($CityArray)>0){
					foreach($CityArray as $display){
						$value=$display['szstatecode'];
						$display_text=$display['szdesc'];
						if($city) $selected = ($value == $this->input->post('city')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
					}
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="Pincode" class="col-md-4 control-label">Postal Code<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <input type="text" name="Pincode" value="<?php echo $this->input->post('Pincode') ? $this->input->post('Pincode') :''; ?>" class="form-control" id="Pincode" data-validation="required" maxlength="6"/>
            </div>
          </div>
          <div class="form-group">
            <label for="country" class="col-md-4 control-label">Country<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="country" class="form-control"  style="width:200px;">
                <?php 
				$country_values = array('IN'=>'India');
				if(count($country_values)>0){
					foreach($country_values as $value => $display_text){
						$selected = ($value == $this->input->post('country')) ? ' selected="selected"' : null;
						echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
					} 
				}
				?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="acc1" class="col-md-4 control-label">ACC1</label>
            <div class="col-md-8">
              <input type="text" name="ACC1" value="<?php echo $this->input->post('ACC1') ? $this->input->post('ACC1') :''; ?>" class="form-control" id="ACC1" maxlength="16"/>
            </div>
          </div>
          <div class="form-group">
            <label for="acc1" class="col-md-4 control-label">Experience</label>
            <div class="col-md-8">
              <input type="number" name="Experience" value="<?php echo $this->input->post('Experience') ? $this->input->post('Experience') :''; ?>" class="form-control" id="Experience" maxlength="4"/>
            </div>
          </div>
          <div class="form-group">
            <label for="FinalisedCar" class="col-md-4 control-label">Financed Car<span class="mandatory">*</span></label>
            <div class="col-md-8">
              <select name="FinalisedCar" class="form-control" style="width:200px;">
                <?php
					$FinalisedCar_values = array(
                        'Yes'=>'Yes',
                        'No'=>'No',
                    );
                    foreach($FinalisedCar_values as $value => $display_text){
                        $selected = ($value == $this->input->post('FinalisedCar')) ? ' selected="selected"' : null;
                        echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
                    } 
                    ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
              <input id="Submit" name="Submit" type="submit" class="btn btn-success" value="Submit">
              <input id="ChannelCode" name="ChannelCode" type="hidden" value="CP">
              
              <input id="AgencyCode" name="AgencyCode" type="hidden" value="TVSCRM">
              <input id="Action" name="Action" type="hidden" value="Create_New_Lead">
              <input id="clickaction" name="clickaction" type="hidden" class="btn btn-success" value="Submit">
            </div>
          </div>
         </form>
          <!--Form Area Stop here--></td>
      </tr>
    </thead>
  </table>
</div>
</div>
<br clear="all">
<!-- jQuery Form Validation code -->

<!--https://jqueryvalidation.org/documentation/-->
  <script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#new_lead_form").validate({
    
        // Specify the validation rules
        rules: {
            first_name: "required",
            last_name: "required",
			Father_Spouse:"required",
            email: {
                required: true,
                email: true
            },
            mobile: {
                required: true,
				digits: true,
                minlength: 10,
				maxlength: 10
            },
			date_of_birth: "required",
            city: "required",
			state: {
				required:true
			},
			Pincode: {
                required: true,
				digits: true,
                minlength: 6
            }
        },
        
        // Specify the validation error messages
        messages: {
            first_name: "Please enter your first name",
            last_name: "Please enter your last name",
			email: "Please enter a valid email address",
            mobile: {
                required: "Please enter mobile number",
				digits: "Please enter only numbers in mobile number",
                minlength: "Your mobile number must be at least 10 digits long",
				maxlength: "Your mobile number can't be more than 10 digits"
            },
			date_of_birth: "Please enter Date of birth",
            city: "Please enter city",
			state:{
				required: "Please enter state"
			},
			Pincode: {
                required: "Please enter postal code",
				digits: "Please enter only numbers in postal code",
                minlength: "Your postal code must be at least 6 digits long",
				maxlength: "Your postal code can't be more than 6 digits"
            },
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
	
	$("#Year").change({
		var yr=$('#Year').val();
		$.ajax({
			url:"/cc/AjaxCustom/get_Make/"+yr,  
			success:function(data) {
			  if(data){
		      	$('#Make').html(data);
			  }
			}
  		});
	});

  });
	  
  
  </script>