<?php
namespace Custom\Controllers;
use RightNow\Utils\Url,
    RightNow\Utils\Framework,
    RightNow\Utils\Config,
    RightNow\Api,
    RightNow\Connect\v1_3 as RNCPHP,
    RightNow\Internal\Sql\Contact as Sql,
    RightNow\Utils\Connect as ConnectUtil,
    RightNow\Libraries\Hooks,
    RightNow\ActionCapture;
class New_lead extends \RightNow\Controllers\Base
{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Sample function for ajaxCustom controller. This function can be called by sending
     * a request to /ci/ajaxCustom/ajaxFunctionHandler.
     */
    function create(){
		$email=$this->input->post('email');
		$mobile=$this->input->post('mobile');
		$action=$this->input->post('clickaction');
		$loan_type=$this->input->post('loan_type');
		if($action=="Submit"){
			if(isset($mobile) and strlen($mobile)==10){
				$report_id=Config::getMessage(CUSTOM_MSG_CONTACT_SEARCH_ON_MOBILE_N_EMAIL);
				if($report_id>0){
					$contact_result=$this->model('custom/TvsModel')->report_result($report_id,array('Mobile'=>$mobile));
					if(count($contact_result)==0){ 
						/*Code to create new Contact starts here*/
						$params = array(
							'title' => $this->input->post('title'),
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'email' => $this->input->post('email'),
							'mobile' => $this->input->post('mobile'),
							'date_of_birth' => $this->input->post('date_of_birth'),
							'address' => $this->input->post('address'),
							'city' => $this->input->post('city'),
							'state' => $this->input->post('state'),
							'country' => $this->input->post('country'),
							'postal_code' => $this->input->post('postal_code'),
							'loan_type' => $this->input->post('loan_type'),
						);
						$params1 = array(
							'title' => $this->input->post('title'),
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'email' => $this->input->post('email'),
							'mobile' => $this->input->post('mobile'),
							'date_of_birth' => $this->input->post('date_of_birth'),
							'address' => $this->input->post('address'),
							'city' => $this->input->post('city'),
							'state' => $this->input->post('state'),
							'country' => $this->input->post('country'),
							'postal_code' => $this->input->post('postal_code'),
							'loan_type' => $this->input->post('loan_type'),
							
						);
						$contact_id=$this->model('custom/TvsModel')->create_contact($params);
						/*Code to create new Contact ends here*/
						if(isset($contact_id) and $contact_id>0){
							$opp_id=$this->model('custom/TvsModel')->create_opportunity($params,$contact_id);
						}
					}
					else{
						$contact_id=$contact_result[0]['Contact ID'];
						$params = array(
							'title' => $this->input->post('title'),
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							/*'email' => $this->input->post('email'),
							'mobile' => $this->input->post('mobile'),*/
							'date_of_birth' => $this->input->post('date_of_birth'),
							'address' => $this->input->post('address'),
							'city' => $this->input->post('city'),
							'state' => $this->input->post('state'),
							'country' => $this->input->post('country'),
							'postal_code' => $this->input->post('postal_code'),
							'loan_type' => $this->input->post('loan_type'),
							
						);
						$params1 = array(
							'title' => $this->input->post('title'),
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'email' => $this->input->post('email'),
							'mobile' => $this->input->post('mobile'),
							'date_of_birth' => $this->input->post('date_of_birth'),
							'address' => $this->input->post('address'),
							'city' => $this->input->post('city'),
							'state' => $this->input->post('state'),
							'country' => $this->input->post('country'),
							'postal_code' => $this->input->post('postal_code'),
							'loan_type' => $this->input->post('loan_type'),
							
						);
						/*Code to update Contact starts here*/
						if(isset($contact_id) and $contact_id>0){
							$this->model('custom/TvsModel')->update_contact($params,$contact_id);
							$report_id=Config::getMessage(CUSTOM_MSG_CHECK_OPP_EXISTS_IN_LAST_24_HRS);
							if($report_id>0){
								$opp_result=$this->model('custom/TvsModel')->report_result($report_id,array('Contact Id'=>$contact_id,'Loan Type'=>$loan_type));
								
								if(count($opp_result)==0){
									$opp_id=$this->model('custom/TvsModel')->create_opportunity($params1,$contact_id);
								}
								header("Location: /app/new_lead_thanks");
								exit;
							}
						}
						/*Code to update new Contact ends here*/
					}
				}
				//Perform logic on post data here
				//echo $returnedInformation;
			}
			else{
				header("Location:/app/new_lead");
				exit;
			}
		}
	}
}

