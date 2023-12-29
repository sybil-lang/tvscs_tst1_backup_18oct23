<?php
namespace Custom\Models;
use RightNow\Utils\Url,
    RightNow\Utils\Framework,
    RightNow\Utils\Config,
    RightNow\Api,
    RightNow\Connect\v1_3 as RNCPHP,
    RightNow\Internal\Sql\Contact as Sql,
    RightNow\Utils\Connect as ConnectUtil,
    RightNow\Libraries\Hooks,
    RightNow\ActionCapture;	
class TvsModel extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
		initConnectAPI();
	}

    /**
     * This function can be executed a few different ways depending on where it's being called:
     *
     * From a widget or another model: $this->CI->model('custom/Sample')->sampleFunction();
     *
     * From a custom controller: $this->model('custom/Sample')->sampleFunction();
     *
     * Everywhere else: $CI = get_instance();
     *                  $CI->model('custom/Sample')->sampleFunction();
     */
    function report_result($report_id, $filter_array){
		try{
			$result_arr=array();
			$report_filter= new RNCPHP\AnalyticsReportSearchFilter;
			$filters = new RNCPHP\AnalyticsReportSearchFilterArray;
			if(count($filter_array)>0){
				foreach($filter_array as $filtername => $filtervalue){
					$report_filter= new RNCPHP\AnalyticsReportSearchFilter;
					$report_filter->Name = $filtername;
					$report_filter->Values = array($filtervalue);
					$filters[] = $report_filter;
				}
				$ar= RNCPHP\AnalyticsReport::fetch($report_id);
				$con_res= $ar->run(0,$filters);
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
			$postal_code=$param_data['postal_code'];
			$country=$param_data['country'];
			
			$contact = new  RNCPHP\Contact();
			$contact->Name = new  RNCPHP\PersonName();
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
				$contact->Emails = new  RNCPHP\EmailArray();
				$contact->Emails[0] = new  RNCPHP\Email();
				$contact->Emails[0]->AddressType=new  RNCPHP\NamedIDOptList();
				$contact->Emails[0]->AddressType->LookupName = "Email - Primary";
				$contact->Emails[0]->Address = strtolower($email);
			}
			if(strlen($mobile)){
				$i = 0;
				$contact->Phones[$i] = new  RNCPHP\Phone();
				$contact->Phones[$i]->PhoneType = new  RNCPHP\NamedIDOptList();
				$contact->Phones[$i]->PhoneType->LookupName = 'Mobile Phone';
				$contact->Phones[$i]->Number = $mobile;
				$i++;
			}
			if(strlen($date_of_birth)){
				$contact->CustomFields->c->dob=$date_of_birth;	
			}
			$contact->Address = new RNCPHP\Address();
			if(strlen($address) or strlen($postal_code)){
				$contact->Address->Street = $address;
			}
			if(strlen($city) or strlen($city)){
				$contact->Address->City = $city;
			}
			if(strlen($state) or strlen($state)){
				$contact->Address->StateOrProvince = new RNCPHP\NamedIDLabel();
				$contact->Address->StateOrProvince->LookupName = "$state";
			}
			if(strlen($country) or strlen($country)){
				$contact->Address->Country = RNCPHP\Country::fetch("$country");
			}
			if(strlen($postal_code) or strlen($postal_code)){
				$contact->Address->PostalCode = $postal_code;
			}
			
			$contact->ContactType = new RNCPHP\NamedIDLabel();
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
				$postal_code=$param_data['postal_code'];
				$country=$param_data['country'];
				$contact=RNCPHP\Contact::fetch($contact_id);
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
				
				if(strlen($address) or strlen($postal_code)){
					$contact->Address->Street = $address;
				}
				if(strlen($city) or strlen($city)){
					$contact->Address->City = $city;
				}
				if(strlen($state) or strlen($state)){
					$contact->Address->StateOrProvince->LookupName=="$state";
				}
				if(strlen($country) or strlen($country)){
					$contact->Address->Country = RNCPHP\Country::fetch("$country");
				}
				if(strlen($postal_code) or strlen($postal_code)){
					$contact->Address->PostalCode = $postal_code;
				}
				
				$contact->ContactType = new RNCPHP\NamedIDLabel();
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
		   $opp = new RNCPHP\Opportunity();
		   if(strlen($mobile) and strlen($first_name)){
				$oppname="$mobile: $first_name";
				if(strlen($last_name)){
					$oppname .=" - $last_name";	
				}
				$opp->Name =$oppname;
			}
			if(strlen($loan_type) and strlen($loan_type)){
				$menu= new RNCPHP\NamedIDLabel();
				//$menu->LookupName="$loan_type";
				$menu->ID="$loan_type";
				$opp->CustomFields->c->loan_type=$menu;
				
			}
			$opp->PrimaryContact->Contact=RNCPHP\Contact::fetch($contact_id);
			/*$opp->StageWithStrategy->Stage= new RNCPHP\NamedIDLabel();
			$opp->StatusWithType->Status->ID='Active';*/
			$opp->save();
			$opp_id=$opp->ID;
			return $opp_id;
	   }
	   catch(Exception $e){
		  echo "<br>Error: ".$e->getMessage()." | Code: ".$e->getCode()."| Line: ".$e->getLine();
	   }
	}
}
