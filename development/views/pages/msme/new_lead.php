<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standardMSME.php" login_required="false" force_https="false"/>
<?php
//$currentsess=$CI->session->getSessionData('previouslySeenEmail');
//$Session_Error_Message=$currentsess['error_message'];
$CI=&get_instance();
$CI->load->helper('report');

$contact_id=$CI->session->getProfileData("c_id");
$contact_id = 3;

if ( $_POST[ 'Action' ] == "Create_New_Lead" ) { //Create new Lead
	$postdata = $_POST;

	$email = $postdata[ 'email' ];
	$mobile = $postdata[ 'mobile' ];
	$action = $postdata[ 'clickaction' ];
	$loan_type = $postdata[ 'loan_type' ];

	if ( isset( $mobile )and strlen( $mobile ) == 10 ) {
		$params = array(
			'title' => $postdata[ 'title' ],
			'first_name' => $postdata[ 'first_name' ],
			'middle_name' => $postdata[ 'middle_name' ],
			'last_name' => $postdata[ 'last_name' ],
			'Name' => $postdata[ 'first_name' ],
			'MiddleName' => $postdata[ 'middle_name' ],
			'LastName' => $postdata[ 'last_name' ],
			'Father_Spouse' => $postdata[ 'Father_Spouse' ],
			'Gender' => $postdata[ 'Gender' ],
			'CompanyName' => $postdata[ 'CompanyName' ],
			'CompanyAddress' => $postdata[ 'CompanyAddress' ],
			'CustProfile' => $postdata[ 'CustProfile' ],
			'Pancard' => $postdata[ 'Pancard' ],
			'Passport' => $postdata[ 'Passport' ],
			'Voterid' => $postdata[ 'Voterid' ],
			'Driving_License' => $postdata[ 'Driving_License' ],
			'Rationcard' => $postdata[ 'Rationcard' ],
			'Adharcard' => $postdata[ 'Adharcard' ],
			'Residentstatus' => $postdata[ 'Residentstatus' ],
			'ResidentStability' => $postdata[ 'ResidentStability' ],
			'LoanAmount' => $postdata[ 'LoanAmount' ],
			'Tenure' => $postdata[ 'Tenure' ],
			'RepaymentMode' => $postdata[ 'RepaymentMode' ],
			'EMIcomfort' => $postdata[ 'EMIcomfort' ],
			'MonthIncome' => $postdata[ 'MonthIncome' ],
			'Year' => $postdata[ 'Year' ],
			'Make' => $postdata[ 'Make' ],
			'Model' => $postdata[ 'Model' ],
			'Variant' => $postdata[ 'Variant' ],
			'loan_type' => $postdata[ 'loan_type' ],
			'date_of_birth' => $postdata[ 'date_of_birth' ],
			'email' => $postdata[ 'email' ],
			'Email' => $postdata[ 'email' ],
			'mobile' => $postdata[ 'mobile' ],
			'Mobile' => $postdata[ 'mobile' ],
			'address' => $postdata[ 'address' ],
			'Address' => $postdata[ 'address' ],
			'state' => $postdata[ 'state' ],
			'StateCode' => $postdata[ 'state' ],
			'city' => $postdata[ 'city' ],
			'CityCode' => $postdata[ 'city' ],
			'Pincode' => $postdata[ 'Pincode' ],
			'country' => $postdata[ 'country' ],
			'ACC1' => $postdata[ 'ACC1' ],
			'Experience' => $postdata[ 'Experience' ],
			'FinalisedCar' => $postdata[ 'FinalisedCar' ],
			'ChannelCode' => $postdata[ 'ChannelCode' ],
			'ProductCode' => $postdata[ 'ProductCode' ],
			'loan_type' => $postdata[ 'loan_type' ],
			'AgencyCode' => $postdata[ 'AgencyCode' ],

		);
		//$report_id=Config::getMessage(CUSTOM_MSG_CONTACT_SEARCH_ON_MOBILE_N_EMAIL);
		$msg = RightNow\ Connect\ v1_3\ MessageBase::fetch( CUSTOM_MSG_CONTACT_SEARCH_ON_MOBILE_N_EMAIL );
		$report_id = $msg->Value;
		if ( $report_id > 0 ) {
			$contact_result = report_result( $report_id, array( 'Mobile' => $mobile ) );
			if ( count( $contact_result ) == 0 ) {
				/*Code to create new Contact starts here*/
				$contact_id = create_contact( $params );
				/*Code to create new Contact ends here*/
				if ( isset( $contact_id )and $contact_id > 0 ) {
					$opp_id = create_opportunity( $params, $contact_id );
				}

			} else {
				$contact_id = $contact_result[ 0 ][ 'Contact ID' ];


				/*Code to update Contact starts here*/
				if ( isset( $contact_id )and $contact_id > 0 ) {
					update_contact( $params, $contact_id );
					//$report_id=Config::getMessage(CUSTOM_MSG_CHECK_OPP_EXISTS_IN_LAST_24_HRS);
					$msg = RightNow\ Connect\ v1_3\ MessageBase::fetch( CUSTOM_MSG_CHECK_OPP_EXISTS_IN_LAST_24_HRS );
					$report_id = $msg->Value;
					if ( $report_id > 0 ) {
						$opp_result = report_result( $report_id, array( 'Contact Id' => $contact_id, 'Loan Type' => $loan_type ) );

						if ( count( $opp_result ) == 0 ) {
							$opp_id = create_opportunity( $params, $contact_id );
						}

					}
				}
				/*Code to update new Contact ends here*/
			}
			/*Code for creatng Lead in LMS System starts here*/
			echo "<pre>";
			print_r( $postdata );
			echo "</pre><br><hr><br>";
			$LMS_result = soap_call( 'InsertLMSData', $params );
			echo "<pre>";
			print_r( $LMS_result );
			echo "</pre>";
			/*Code for creatng Lead in LMS System ends here*/
		}
	} else {
		echo "Please enter 10 digit mobile number";
	}
	/*echo "<pre>";
	print_r($_POST);
	echo "</pre>";*/
	//header("Location: /app/msme/new_lead_thanks");
	exit;

}




$VStateNameList = soap_call( 'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) );
$StateArray = $VStateNameList[ 'GetVStateNameResult' ][ 'LMS_State_Entity' ];

$VCityNameList = soap_call( 'GetVCityName', array( 'statecode' => 'HA', 'AgencyCode' => 'TVSCRM' ) ); //pass statecode dynamically using ajax
$CityArray = $VCityNameList[ 'GetVCityNameResult' ][ 'LMS_City_Entity' ];

$VDynamicLast20Years = soap_call( 'GetVDynamicLast20Years', array( 'AgencyCode' => 'TVSCRM' ) );
$DynamicLast20YearsArray = $VDynamicLast20Years[ 'GetVDynamicLast20YearsResult' ][ 'LMS_DynamicYearGen_Entity' ];

$VMakeList = soap_call( 'getVMakeList', array( 'Year' => '1997', 'AgencyCode' => 'TVSCRM' ) );
$VMakeListArray = $VMakeList[ 'getVMakeListResult' ][ 'LMS_IBBMake_Entity' ];

$VModelList = soap_call( 'getVModelList', array( 'Year' => '1997', 'Make' => 'FIAT', 'AgencyCode' => 'TVSCRM' ) );
$VModelListArray = $VModelList[ 'getVModelListResult' ][ 'LMS_IBBModel_Entity' ];

$V_VariantlList = soap_call( 'getV_VariantlList', array( 'Year' => '1997', 'Make' => 'FIAT', 'Model' => 'UNO', 'AgencyCode' => 'TVSCRM' ) );
$V_VariantlListArray = $V_VariantlList[ 'getV_VariantlListResult' ][ 'LMS_IBBVariant_Entity' ];

$VCommonFields_Gender = soap_call( 'GetVCommonFields', array( 'Key_code' => 'Gender', 'AgencyCode' => 'TVSCRM' ) );
$GenderArray = $VCommonFields_Gender[ 'GetVCommonFieldsResult' ][ 'LMS_Common_Fields_Entity' ];

$VCommonFields_CustomerProfile = soap_call( 'GetVCommonFields', array( 'Key_code' => 'Customer Profile', 'AgencyCode' => 'TVSCRM' ) );
$CustProfileArray = $VCommonFields_CustomerProfile[ 'GetVCommonFieldsResult' ][ 'LMS_Common_Fields_Entity' ];

$VCommonFields_ResidenceStatus = soap_call( 'GetVCommonFields', array( 'Key_code' => 'Residence Status', 'AgencyCode' => 'TVSCRM' ) );
$ResidenceStatusArray = $VCommonFields_ResidenceStatus[ 'GetVCommonFieldsResult' ][ 'LMS_Common_Fields_Entity' ];

$VRepaymentType = soap_call( 'GetVRepaymentType', array( 'AgencyCode' => 'TVSCRM' ) );
$RepaymentTypeArray = $VRepaymentType[ 'GetVRepaymentTypeResult' ][ 'LMS_RepaymentType_Entity' ];

/*code for product Type Dropdown starts here*/
$msg = RightNow\ Connect\ v1_3\ MessageBase::fetch( CUSTOM_MSG_PRODUCT_TYPE_DROPDOWN );
$report_id = $msg->Value;
if ( $report_id > 0 ) {
	$filter = array();
	$ProductCode_Array = report_result( $report_id, $filter );
}
/*code for product Type Dropdown ends here*/

/*echo "<pre>";
print_r($product_type_result);
echo "</pre><br>";*/

?>
	<script type="text/javascript" src="/euf/assets/themes/standard/js/responsive-tabs.js"></script>

	<div class="container">
<h3 style="font-style: none; color: #054fa4; font-weight: 600; font-family: Segoe, Segoe UI,' sans-serif';">New Lead Information</h3>
<hr>

<!-- akash changes -->
<form name="new_lead_form" id="new_lead_form" method="post" action="" class="form-horizontal">
<!-- akash changes -->

<ul class="nav nav-tabs responsive" id="myTab">
  <li class="test-class active"><a href="#resp-tab1"><span class="glyphicon glyphicon-user"></span> Personal Information</a></li>
  <li class="test-class"><a href="#resp-tab2"><span class="glyphicon glyphicon-file"></span>Identification Documents</a></li>
  <li><a class="deco-none" href="#resp-tab3"><span class="glyphicon glyphicon-flag"></span> Loan Eligibility</a></li>
</ul>

<div class="tab-content responsive">
<!--First Tab Starts Here!-->
<div class="tab-pane active" id="resp-tab1"> <br/>
  <br/>
  <div class="container"> 
    
    <!--First Row Starts Here!-->
    <div class="form-group col-md-2">
      <label for="title" class="control-label">Title</label>
      <select name="title" class="form-control">
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
    <!--First Ros Ends Here!--> 
    <!--Second Row Starts Here!-->
    <div class="clearfix"></div>
    <div class="form-group col-md-4">
      <label for="first_name" class="control-label" >First Name<span class="mandatory">*</span></label>
      <input type="text" name="first_name" value="<?php echo $this->input->post('first_name') ? $this->input->post('first_name') :''; ?>" class="form-control" id="first_name" data-validation="required"  maxlength="80" placeholder="First Name"/>
    </div>
    <div class="form-group col-md-4">
      <label for="middle_name" class="control-label" >Mid Name</label>
      <input type="text" name="middle_name" value="<?php echo $this->input->post('middle_name') ? $this->input->post('middle_name') :''; ?>" class="form-control" id="middle_name" data-validation="required"  maxlength="80" placeholder="Mid Name"/>
    </div>
    <div class="form-group col-md-4">
      <label for="last_name" class="control-label" >Last Name</label>
      <input type="text" name="last_name" value="<?php echo $this->input->post('last_name') ? $this->input->post('last_name') :''; ?>" class="form-control" id="last_name" data-validation="required"  maxlength="80" placeholder="Last Name"/>
    </div>
    <!--Second Row Ends Here!--> 
    
    <!--Third Row Starts Here!-->
    
    <div class="clearfix"></div>
    <div class="form-group col-md-4">
      <label for="Father_Spouse" class="control-label" >Father / Spouse<span class="mandatory">*</span></label>
      <input type="text" name="Father_Spouse" value="<?php echo $this->input->post('Father_Spouse') ? $this->input->post('Father_Spouse') :''; ?>" class="form-control" id="Father_Spouse" data-validation="required"  maxlength="80" placeholder="Father's Name"/>
    </div>
    <div class="form-group col-md-4">
      <label for="Gender" class="control-label" > Gender </label>
      <select name="Gender" class="form-control" data-validation="required">
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
    <div class="form-group col-md-4">
      <label for="date_of_birth" class="control-label" >Date of Birth </label>
      <input type="text" id="date_of_birth" name="date_of_birth" value="<?php echo $this->input->post('date_of_birth') ? $this->input->post('date_of_birth') :''; ?>"  data-validation="date_of_birth"  maxlength="10" data-field="date" class="form-control datepicker" data-validation="required" readonly/>
    </div>
    <!--Third Row Ends Here!--> 
    <!--Fourth Row Starts Here!-->
    <div class="clearfix"></div>
    <div class="form-group col-md-4">
      <label for="address" class="control-label" >Address</label>
      <input type="text" name="address" value="<?php echo $this->input->post('address') ? $this->input->post('address') :''; ?>" class="form-control" id="address" data-validation="required"  maxlength="80" placeholder="Address"/>
    </div>
    <div class="form-group col-md-4">
      <label for="email" class="control-label" > Email </label>
      <input type="text" name="email" value="<?php echo $this->input->post('email') ? $this->input->post('email') :''; ?>" class="form-control" id="email" data-validation="required"  maxlength="80" placeholder="Email"/>
    </div>
    <div class="form-group col-md-4">
      <label for="mobile" class="control-label" >Mobile</label>
      <input type="text" id="mobile" name="mobile" value="<?php echo $this->input->post('mobile') ? $this->input->post('mobile') :''; ?>"  maxlength="10" class="form-control" data-validation="required" placeholder="Mobile">
    </div>
    <!--Fourth Row Ends Here!--> 
    <!--Fifth Row Starts Here!-->
    <div class="clearfix"></div>
    <div class="form-group col-md-4">
      <label for="city" class="control-label" >City</label>
      <select name="city" class="form-control" data-validation="required">
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
    <div class="form-group col-md-4">
      <label for="state" class="control-label" > State </label>
      <select name="state" class="form-control" data-validation="required">
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
    <div class="form-group col-md-2">
      <label for="Pincode" class="control-label" >Pincode</label>
      <input type="text" name="Pincode" value="<?php echo $this->input->post('Pincode') ? $this->input->post('Pincode') :''; ?>" class="form-control" id="Pincode" data-validation="required" maxlength="6"/>
    </div>
    <div class="form-group col-md-2">
      <label for="country" class="control-label" >Country</label>
      <select name="country"  class="form-control" >
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
    
    <!--Fifth Row Ends Here!--> 
    <!--Sixth Row Starts Here!-->
    <div class="clearfix"></div>
    <div class="form-group col-md-6">
      <label for="CompanyName" class="control-label" >Company Name</label>
      <input type="text" name="CompanyName" value="<?php echo $this->input->post('CompanyName') ? $this->input->post('CompanyName') :''; ?>" class="form-control" id="CompanyName" maxlength="100"/>
    </div>
    <div class="form-group col-md-6">
      <label for="CompanyAddress" class="control-label" > Company Address </label>
      <input type="text" name="CompanyAddress" value="<?php echo $this->input->post('CompanyAddress') ? $this->input->post('CompanyAddress') :''; ?>" class="form-control" id="CompanyAddress" maxlength="100"/>
    </div>
    
    <!--Sixth Row Ends Here!--> 
    
  </div>
  <hr>
  
  <!--Fourth Row Ends Here!--> 
</div>

<!--First Tab Ends Here!--> 
<!--Second Tab Starts Here!-->
<div class="tab-pane" id="resp-tab2"> <br/>
  <br/>
  <!--First Row Starts Here!-->
  <div class="container">
    <div class="row">
      <div class="form-group">
        <div class="clearfix"></div>
        <div class="form-group col-md-4">
          <label for="CustProfile" class="control-label" >CustProfile</label>
          <select name="CustProfile" class="form-control"   data-validation="required">
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
        <div class="form-group col-md-4">
          <label for="Pancard" class="control-label" > Pan Card </label>
          <input type="text" name="Pancard" value="<?php echo $this->input->post('Pancard') ? $this->input->post('Pancard') :''; ?>" class="form-control" id="Pancard" maxlength="15"/>
        </div>
        <div class="form-group col-md-4">
          <label for="passport" class="control-label" >Passport</label>
          <input type="text" id="passport" name="passport" value="<?php echo $this->input->post('Passport') ? $this->input->post('Passport') :''; ?>"  maxlength="10" data-field="date" class="form-control" data-validation="required">
        </div>
        <!--First Row Ends Here!--> 
        <!--Second Row Starts Here!-->
        
        <div class="clearfix"></div>
        <div class="form-group col-md-4">
          <label for="Voterid" class="control-label" >Voter ID Card </label>
          <input type="text" name="Voterid" value="<?php echo $this->input->post('Voterid') ? $this->input->post('Voterid') :''; ?>" class="form-control" id="Voterid" data-validation="required"  maxlength="80" placeholder="Voter ID"/>
        </div>
        <div class="form-group col-md-4">
          <label for="Driving_License" class="control-label" > Driving License </label>
          <input type="text" name="Driving_License" value="<?php echo $this->input->post('Driving_License') ? $this->input->post('Driving_License') :''; ?>" class="form-control" id="Driving_License" maxlength="20"/>
        </div>
        <div class="form-group col-md-4">
          <label for="Rationcard" class="control-label" >Ration Card </label>
          <input type="text" name="Rationcard" value="<?php echo $this->input->post('Rationcard') ? $this->input->post('Rationcard') :''; ?>" class="form-control" id="Rationcard" maxlength="20"/>
        </div>
        
        <!--Second Row Ends Here!--> 
        <!--Third Row Starts Here!-->
        
        <div class="clearfix"></div>
        <div class="form-group col-md-4">
          <label for="aadharcard" class="control-label" >Aadhar Card </label>
          <input type="text" name="aadharcard" value="<?php echo $this->input->post('Adharcard') ? $this->input->post('Adharcard') :''; ?>" class="form-control" id="aadharcard" data-validation="required"  maxlength="80" placeholder="Aadhar Card ID"/>
        </div>
        <div class="form-group col-md-4">
          <label for="Residentstatus" class="control-label" > Resident Status </label>
          <select name="Residentstatus" class="form-control"  data-validation="required">
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
        <div class="form-group col-md-4">
          <label for="ResidentStability" class="control-label" >Resident Stability</label>
          <input type="number" name="ResidentStability" value="<?php echo $this->input->post('ResidentStability') ? $this->input->post('ResidentStability') :''; ?>" class="form-control" id="ResidentStability" maxlength="2"/>
        </div>
        
        <!--Third Row Ends Here!--> 
        
      </div>
    </div>
    <br/>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
  <hr>
</div>
<!--Third row Ends Here!--> 

<!--Third Tab Starts Here!-->

<div class="tab-pane" id="resp-tab3"><br/>
  <br/>
  <div class="container">
    <div class="row">
      <div class="form-group">
        <div class="clearfix"></div>
        <div class="form-group col-md-4">
          <label for="LoanAmount" class="control-label" >Loan Amount </label>
          <input type="text" name="LoanAmount" value="<?php echo $this->input->post('LoanAmount') ? $this->input->post('LoanAmount') :''; ?>" class="form-control" id="LoanAmount" maxlength="6"/>
        </div>
        <div class="form-group col-md-4">
          <label for="Tenure" class="control-label" > Tenure </label>
          <input type="text" name="Tenure" value="<?php echo $this->input->post('Tenure') ? $this->input->post('Tenure') :''; ?>" class="form-control" id="Tenure" maxlength="4"/>
        </div>
        <div class="form-group col-md-4">
          <label for="RepaymentMode" class="control-label" >Repayment Type</label>
          <select name="RepaymentMode" class="form-control" data-validation="required">
					<?php 
						$RepaymentMode=($this->input->post('RepaymentMode')) ? $this->input->post('RepaymentMode') : '';
						if(count($RepaymentTypeArray)>0){
							foreach($RepaymentTypeArray as $display){
								$value=$display['szpaymenttype'];
								$display_text=$display['szpaymenttypedes'];
								if($RepaymentMode) $selected = ($value == $this->input->post('Residentstatus')) ? ' selected="selected"' : null;
								echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
							}
						}
					?>
				</select>
        </div>
        <!-- Second row Starts Here!-->
        
        <div class="clearfix"></div>
        <div class="form-group col-md-4">
          <label for="EMIcomfort" class="control-label" >EMI Comfort </label>
          <input type="text" name="EMIcomfort" value="<?php echo $this->input->post('EMIcomfort') ? $this->input->post('EMIcomfort') :''; ?>" class="form-control" id="EMIcomfort" maxlength="6"/>
        </div>
        <div class="form-group col-md-4">
          <label for="MonthIncome" class="control-label" > Month Income </label>
          <input type="text" name="MonthIncome" value="<?php echo $this->input->post('MonthIncome') ? $this->input->post('MonthIncome') :''; ?>" class="form-control" id="MonthIncome" maxlength="4"/>
        </div>
        <div class="form-group col-md-4">
          <label for="Year" class="control-label" >Year</label>
          <select name="Year" id="Year" class="form-control">
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
        
        <!-- Second row Ends Here!--> 
        
        <!-- Third row Starts Here!-->
        
        <div class="clearfix"></div>
        <div class="form-group col-md-4">
          <label for="Make" class="control-label" >Make </label>
          <select name="Make"  id="Make" class="form-control">
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
        <div class="form-group col-md-4">
          <label for="Model" class="control-label" > Model </label>
          <select name="Model" id="Model" class="form-control">
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
        <div class="form-group col-md-4">
          <label for="Variant" class="control-label" >Variant</label>
          <select name="Variant" id="Variant" class="form-control">
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
        
        <!-- Third row Ends Here!--> 
        
        <!--Fourth Row Starts Here!-->
        
        <div class="clearfix"></div>
        <div class="form-group col-md-4">
          <label for="ProductCode" class="control-label" >Loan Type </label>
          <select name="ProductCode" class="form-control">
            <?php
								if ( count( $ProductCode_Array ) > 0 ) {
									foreach ( $ProductCode_Array as $display_text ) {
										$selected = ( $display_text[ 'Product Description' ] == $this->input->post( 'ProductCode' ) ) ? ' selected="selected"' : null;
										echo '<option value="' . $display_text[ 'Product Description' ] . '" ' . $selected . '>' . $display_text[ 'Product_Code' ] . '</option>';
									}
								}
								?>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="state" class="control-label" > State </label>
          <select name="state" class="form-control" data-validation="required">
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
        <div class="form-group col-md-4">
          <label for="city" class="control-label" >City</label>
          <select name="city" class="form-control">
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
        
        <!--Fourth Row Ends Here!--> 
		
		<!-- Fifth Row Starts Here! -->
		<div class="clearfix"></div>
		 <div class="form-group col-md-4">
          <label for="Pincode" class="control-label" >Pin code </label>
          <input type="text" name="Pincode" value="<?php echo $this->input->post('Pincode') ? $this->input->post('Pincode') :''; ?>" class="form-control" id="Pincode" maxlength="6"/>
        </div>
        <div class="form-group col-md-4">
          <label for="country" class="control-label" >Country</label>
          <select name="country" class="form-control">
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
		 <div class="form-group col-md-4">
          <label for="ACC1" class="control-label" >Acc 1 </label>
            <input type="text" name="ACC1" value="<?php echo $this->input->post('ACC1') ? $this->input->post('ACC1') :''; ?>" class="form-control" id="ACC1" maxlength="16"/>
        </div>
		<!-- Fifth Row Ends Here! -->
		
        <!--Sixth Row Starts Here!--> 
        
        <div class="clearfix"></div>       
          <div class="form-group col-md-4">
          <label for="Experience" class="control-label" > Experience </label>
         <input type="number" name="Experience" value="<?php echo $this->input->post('Experience') ? $this->input->post('Experience') :''; ?>" class="form-control" id="Experience" maxlength="4"/>
        </div>
        <div class="form-group col-md-4">
          <label for="FinalisedCar" class="control-label" >Financed Cars</label>
           <select name="FinalisedCar" class="form-control">
            <?php
								$FinalisedCar_values = array(
									'Yes' => 'Yes',
									'No' => 'No',
								);
								foreach ( $FinalisedCar_values as $value => $display_text ) {
									$selected = ( $value == $this->input->post( 'FinalisedCar' ) ) ? ' selected="selected"' : null;
									echo '<option value="' . $value . '" ' . $selected . '>' . $display_text . '</option>';
								}
								?>
          </select>
        </div>
        <!--Sixth Row Ends Here!-->
        
        
        
       
      </div>
    </div>
    
    
    <br/>
    
    
    <br/>
    <div class="row">
      <div class="col-md-offset-11 col-md-12">
        <input type="submit" value="submit" class="btn-success">
		<input id="ChannelCode" name="ChannelCode" type="hidden" value="CP">
		<input id="AgencyCode" name="AgencyCode" type="hidden" value="TVSCRM">
		<input id="Action" name="Action" type="hidden" value="Create_New_Lead">
		<input id="clickaction" name="clickaction" type="hidden" class="btn btn-success" value="Submit">
      </div>
    </div>
    <hr>
    
    <!--Sixth Row Ends Here!--> 
  </div>
</div>


<!-- akash changes -->
</form>
<!-- akash changes -->


<!--Loan Eligibility Tabs Ends 
  </div>
  <hr>
</div>
<!-- /container --> 
					<!--Form Area Stop here-->
							
		<br clear="all">
		<!-- jQuery Form Validation code -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>
		<script type="text/javascript">
      $( 'ul.nav.nav-tabs  a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      // ( function( $ ) {
          // // Test for making sure event are maintained
          // $( '.js-alert-test' ).click( function () {
            // alert( 'Button Clicked: Event was maintained' );
          // } );
          // fakewaffle.responsiveTabs( [ 'xs', 'sm' ] );
      // } )( jQuery );

    </script>
		<!--https://jqueryvalidation.org/documentation/-->
		<script>
			// When the browser is ready...
			$( function () {

				// Setup form validation on the #register-form element
				$( "#new_lead_form" ).validate( {

					// Specify the validation rules
					rules: {
						first_name: "required",
						last_name: "required",
						Father_Spouse: "required",
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
							required: true
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
						state: {
							required: "Please enter state"
						},
						Pincode: {
							required: "Please enter postal code",
							digits: "Please enter only numbers in postal code",
							minlength: "Your postal code must be at least 6 digits long",
							maxlength: "Your postal code can't be more than 6 digits"
						},
					},

					submitHandler: function ( form ) {
						form.submit();
					}
				} );

				jQuery( "#Year" ).change( {
					var yr = jQuery( '#Year' ).val();
					$.ajax( {
						url: "/cc/AjaxCustom/get_Make/" + yr,
						success: function ( data ) {
							if ( data ) {
								jQuery( '#Make' ).html( data );
							}
						}
					} );
				} );

			} );
		</script>