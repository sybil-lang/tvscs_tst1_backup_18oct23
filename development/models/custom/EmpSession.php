<?php
namespace Custom\Models;

use \RightNow\Utils\Url,
    \RightNow\Utils\Framework,
    \RightNow\Utils\Config,
    \RightNow\Api,
    \RightNow\Connect\v1_3 as Connect,
    \RightNow\Internal\Sql\Contact as Sql,
    \RightNow\Utils\Connect as ConnectUtil,
    \RightNow\Libraries\Hooks,
    \RightNow\ActionCapture;

require_once CORE_FILES . 'compatibility/Internal/Sql/Contact.php';

class EmpSession extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
    }
	
	/*
	
	*/
	function updateSessionData($dealer_codes, $dealer_name = '',$dealerID = ''){
			$userProfile = $this->CI->session->getSessionData('userProfile');
			$userProfile['dealer_codes'] = $dealer_codes;
			$userProfile['dealer_names'] = $dealer_name;
			$userProfile['employee_d_id'] = $dealerID;
			$bundle=array('userProfile' => $userProfile);
			$this->CI->session->setSessionData($bundle);
			
	}

	function updateEmpSessionData($agreement_number){
			$userProfile = $this->CI->session->getSessionData('userProfile');
			$userProfile['agg_no'] = $agreement_number;
			$bundle=array('userProfile' => $userProfile);
			$this->CI->session->setSessionData($bundle);
			/*$bundle=array('DealerProfile' => array('empProfile' => $userProfile, 'dealer_codes' =>  $dealer_codes);
			//$userProfile['dealer_codes'] = $dealer_codes;
			$this->CI->session->setSessionData($bundle);*/
	}

	/*
	*/
	function updateEmpCustomerSessionData($customerId){
			$userProfile = $this->CI->session->getSessionData('userProfile');
			$userProfile['employee_c_id'] = $customerId;
			$bundle=array('userProfile' => $userProfile);
			$this->CI->session->setSessionData($bundle);
	}

	/*
	*/
	function updateEmpDealerSessionData($dealerId){
			$userProfile = $this->CI->session->getSessionData('userProfile');
			$userProfile['employee_d_id'] = $dealerId;
			$bundle=array('userProfile' => $userProfile);
			$this->CI->session->setSessionData($bundle);
	}
	/*

	*/
	function updateAgreementSession($agg_no){
			$userProfile = $this->CI->session->getSessionData('userProfile');
			$userProfile['customer_agg_no'] = $agg_no;
			$bundle=array('userProfile' => $userProfile);
			$this->CI->session->setSessionData($bundle);
	}
}
?>