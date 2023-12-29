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

class Login extends \RightNow\Models\Base
{
    function __construct()
    {
        parent::__construct();
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
    /**
     * Logs the user in given their username, password and session ID
     *
     * @param string $username The username of the contact
     * @param string $password The password of the contact
     * @param string $sessionID The session Id of the contact
     * @param int|string $widgetID The widget ID of the widget that submitted the request
     * @param string $url The url where to redirect to after login has completed
     * @return array An array containing the status of the request and other data to be interpreted by the callee
     */
    public function doLogin($username, $password, $sessionID, $widgetID, $url)
    {
        $result = array('w_id' => $widgetID);
        if((!$this->CI->session->canSetSessionCookies() || !$this->CI->session->getSessionData('cookiesEnabled')) && !Framework::checkForTemporaryLoginCookie())
        {
            //Temporary cookie does not exist, return an error
            $result['message'] = Config::getMessage(PLEASE_ENABLE_COOKIES_BROWSER_LOG_MSG);
            $result['success'] = 0;
            $result['showLink'] = false;
            return $this->getResponseObject($result, 'is_array');
        }
		if(strlen($username) < 10){
            $result['message'] = "Mobile Number should be in 10 digit";
            $result['success'] = 0;
            return $this->getResponseObject($result, 'is_array');
        }
        if(strlen($password) > 6){
            $result['message'] = sprintf(Config::getMessage(PASSWD_ENTERED_EXCEEDS_MAX_CHARS_MSG), 6);
            $result['success'] = 0;
            return $this->getResponseObject($result, 'is_array');
        }

        //We need to check if they are on just ...com, ...com/, /app, or /app/ so what when we
        //redirect we go to the home page
        if (in_array($url, array('', '/', '/app', '/app/'), true))
            $url = Url::getHomePage();

        $result['addSession'] = in_array('session', explode('/', $url), true);
        $result['sessionParm'] = Url::sessionParameter();
        $result['url'] = $url;
        $profile = $this->getProfileByOTP($username, $password, $sessionID)->result;
		//print_r($profile);
        if(is_string($profile))
        {
			//echo "good";
            // Login error triggered via a custom hook
            $result['message'] = $profile;
            $result['success'] = 0;
        }
        else if($profile)
        {
            // Login successful, create the cookie and redirect the user
		//	echo "bad";
            $result['message'] = Config::getMessage(REDIRECTING_ELLIPSIS_MSG);
            $result['success'] = 1;

     //       if (!$this->enforcePasswordInterval($profile, $result))
      //      {
                $this->CI->session->createProfileCookie($profile);
      //      }
        }
      /*  else
        {
            // Failed to login
            $result['message'] = (Config::getConfig(CP_MAX_LOGINS) || Config::getConfig(CP_MAX_LOGINS_PER_CONTACT))
                ? Config::getMessage(USRNAME_PASSWD_ENTERED_INCOR_ACCT_MSG)
                : Config::getMessage(USERNAME_PASSWD_ENTERED_INCOR_ACCT_MSG);
            $result['success'] = 0;
        }*/
        return $this->getResponseObject($result, 'is_array');
    }

	/**
     * Creates an instance of the CP Profile object given a user's Mobile Number and OTP
     *
     * @param string $username The username of the contact
     * @param string $password The password of the contact: plaintext, non-encrypted
     * @param string $sessionID The current session id
     * @return \RightNow\Libraries\ProfileData Instance of the Profile object, or null if login failed
     */
    public function getProfileByOTP($username, $password, $sessionID)
    {
        $username = trim($username);
        $preHookData = array('data' => array('source' => 'LOCAL'));
        $customHookError = Hooks::callHook('pre_login', $preHookData);
        if(is_string($customHookError))
            return $this->getResponseObject($customHookError, 'is_string');

        if($username === false || $username === null){
            return $this->getResponseObject(null, null, "Invalid username format provided. Value must be a string but received either null or false.");
        }

        if ($abuseMessage = $this->isAbuse()) {
            return $this->getResponseObject(null, null, $abuseMessage);
        }

        $pairData = array(
            'login' => $username,
            'sessionid' => $sessionID,
            'cookie_set' => 1,
            'login_method' => CP_LOGIN_METHOD_LOCAL,
        );
        if (is_string($password) && $password !== '') {
            $pairData['password_text'] = $password;
        }
       /* if ($profile = Api::contact_login($pairData)) {
            // Login succeeded. Attach the Contact's associated SocialUser onto the session profile.
            $profile = (object) $profile;
            $this->CI->session->setSocialUser($profile);
        }*/
		$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER);
		$report_id=$msg->Value;

		/* Get Report ID */
		if($report_id>0){
				$filter=array('Mobile'=>$username);
				$contact_result= $this->report_result($report_id,$filter);
				$contact_id=$contact_result[0]['Contact ID'];
				$email=$contact_result[0]['Email Address'];
				$first_name=$contact_result[0]['First Name'];
				$last_name=$contact_result[0]['Last Name'];
				$savedpassword=$contact_result[0]['Password'];
				if(strlen($contact_id) and $contact_id>0){
					$contact=\RightNow\Connect\v1_3\Contact::fetch($contact_id);
					//echo "good";print_r($contact_result );
					$otp=$contact->CustomFields->c->otp;
					$startdatetime=$contact->CustomFields->c->otp_generated_on;
					$enddatetime=$contact->CustomFields->c->otp_generated_till;
					$password_g = $contact->CustomFields->c->custom_password;
					$login = $contact->Login;
					$currentdatetime=strtotime(date('Y-m-d H:i:s'));
					//echo "<br><br>$password==$otp==$currentdatetime==<=$enddatetime";
					//<br><br>123456==741382==1481003686==<=1480947300
//					and ($currentdatetime <=$enddatetime)
					if(($password==$otp) ){
						//loggedin
					//	$profile = Api::contact_login($pairData);
						//echo "good";
						$bundle=array('userProfile' => array("sess_contact_id"=>$contact_id,"sess_first_name"=>$first_name,"sess_last_name"=>$last_name,"sess_contact_type"=>'Customer',"sess_email"=>$email));
						//$profile = (object) $contact;
						//$profile = Api::contact_login($pairData)
						
						$this->CI->session->setSessionData($bundle);
						$apiProfile = array();
						$apiProfile['c_id'] = $contact_id;
						$apiProfile['login'] = $login;
						$apiProfile['email']          = $email;
						$apiProfile['firstName']      = $first_name;
						$apiProfile['lastName']       = $last_name;
						$apiProfile['disabled']       = $contact->Disabled ?: null;
						$apiProfile['orgID']           = $contact->Organization->ID ?: null;
						$apiProfile['slai']            = $contact->slai ?: null;
						$apiProfile['slac']            = $contact->slac ?: null;
						$apiProfile['webAccess']       = $contact->web_access ?: null;
						$apiProfile['authToken']       = $contact->cookie;
						$apiProfile['orgLevel'] = $contact->o_lvlN;
						$apiProfile['ptaLoginUsed']  = $this->sessionData->ptaUsed;
						$apiProfile['openLoginUsed']  = $contact->openLoginUsed;
						$apiProfile['forcefulLogoutTime']  =$contact->forcefulLogoutTime;
						$apiProfile['socialUserID']   = $contact->SocialUser->ID;
						$apiProfile['sessionID'] = $this->CI->session->getSessionData('sessionID');
						$this->CI->session->setSocialUser($apiProfile);
					}
					elseif(($password==$otp) and ($currentdatetime > $enddatetime)){
						//login failed
						
						return $this->getResponseObject("OTP Time exceeded. Try again.",'is_string');
					}
					else{
						
						return $this->getResponseObject("Invalid OTP Entry. Try again.",'is_string');
					}
				}
				else{
					
					 return $this->getResponseObject("Invalid Mobile Number. Try again.",'is_string');
				}
			}

		//end if

        $profile = $this->CI->session->createMapping($apiProfile,true,false);
        ActionCapture::record('contact', 'login', 'local');

        $postHookData = array('returnValue' => $profile, 'data' => array('source' => 'LOCAL'));
		//print_r($profile);
		//print_r($apiProfile);
		//print_r($this->CI->session->getSessionData('userProfile'));
        Hooks::callHook('post_login', $postHookData);
		//echo "good";
        return $this->getResponseObject($profile);
    }

/*
* Function to Generate Report Result
*
*/
function report_result( $report_id, $filter_array ) {
		try {
			$result_arr = array();
			if ( count( $filter_array ) > 0 ) {
				$report_filter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
				$filters = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
				foreach ( $filter_array as $filtername => $filtervalue ) {
					$report_filter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
					$report_filter->Name = $filtername;
					$report_filter->Values = array( $filtervalue );
					$filters[] = $report_filter;
				}
				$ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch( $report_id );
				$con_res = $ar->run( 0, $filters );
				$con_count = $con_res->count();
				if ( $con_count > 0 ) {
					for ( $ii = $con_count; $ii--; ) {
						$row = $con_res->next();
						$result_arr[] = $row;
					}
				}
			} else {
				$ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch( $report_id );
				$con_res = $ar->run( 0 );
				$con_count = $con_res->count();
				if ( $con_count > 0 ) {
					for ( $ii = $con_count; $ii--; ) {
						$row = $con_res->next();
						$result_arr[] = $row;
					}
				}
			}
			return $result_arr;
		} catch ( Exception $err ) {
			//echo $err->getMessage();
			return $this->getResponseObject(null, null, $err->getMessage());
		}
	}

	/*
	*
	* Send OTP On Mobile Number
	*
	*/
	function sendOTP($mnumber, $sessionID, $widgetID, $url){
			
			$result = array('w_id' => $widgetID);
			if(strlen($mnumber) < 10){
				$result['message'] = "Mobile Number should be in 10 digit";
				$result['success'] = 0;
				return $this->getResponseObject($result, 'is_array');
			}
			//We need to check if they are on just ...com, ...com/, /app, or /app/ so what when we
			//redirect we go to the home page
			if (in_array($url, array('', '/', '/app', '/app/'), true))
				$url = Url::getHomePage();

			$result['addSession'] = in_array('session', explode('/', $url), true);
			$result['sessionParm'] = Url::sessionParameter();
			$result['url'] = $url;

			$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER);
			$report_id=$msg->Value;
			if($report_id>0){
				$filter=array('Mobile'=>$mnumber);
				$contact_result=$this->report_result($report_id,$filter);
				$contact_id=$contact_result[0]['Contact ID'];
				if(strlen($contact_id) and $contact_id>0){
						$contact=\RightNow\Connect\v1_3\Contact::fetch($contact_id);
						
						$otp=implode('',$this->randomGen(0,9,6));
						$time = time();
						$last_time = ($time - ($time % (15 * 60)));
						$in15mins =  $last_time+ (15 * 60);
						$startdatetime=date('Y-m-d H:i');
						$enddatetime=date('Y-m-d H:i', $in15mins);
						$returnarray=json_encode(array('mobile'=>$mnumber,'OTP'=>$otp,'startdatetime'=>$startdatetime,'enddatetime'=>$enddatetime));
						
						$contact->CustomFields->c->otp=$otp;
						$contact->CustomFields->c->otp_generated_on=strtotime($startdatetime);
						$contact->CustomFields->c->otp_generated_till=strtotime($enddatetime);
						$contact->save();
						
						$sms_message=$otp.' is your OTP for loan application with TVS Credit. Please use this OTP within 15 min to complete your enquiry. For further details call 18004252021';
						
						$parameters=array('Vendor'=>'U','Phoneno'=>$mnumber,'Message'=>$sms_message,'Purpose'=>'For Login in Customer Portal','CustNo'=>'-');
						
						$response=$this->send_OTP_call('SendSMSExternal', $parameters);
						$result['message'] = "OTP Sent Successfully";
						$result['success'] = 1;
					}
					else{
						//login failed
						
						$result['message'] = 'Mobile Number not Exist. Please enter Registered mobile number.';
						$result['success'] = 0;
					}
			}
			else
			{
				// Failed to login
				$result['message'] = 'Invalid Mobile Number. Try again.';
				$result['success'] = 0;
			}
			return $this->getResponseObject($result, 'is_array');
	}

/* Function to Send OTP */

	function send_OTP_call( $functionName, $arrparam ) {
			$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_SEND_OTP_URL );
			$url = $msg->Value;
			$this->CI->load->library("Nusoap_lib");
		//	$client = $this->CI->nusoap_lib->nusoap_client( $url, 'wsdl' );
		//	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
			$body='<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <SendSMSExternal xmlns="http://tempuri.org/">
      <Vendor>'.$arrparam['Vendor'].'</Vendor>
      <Phoneno>'.$arrparam['Phoneno'].'</Phoneno>
      <Message>'.$arrparam['Message'].'</Message>
      <Purpose>'.$arrparam['Purpose'].'</Purpose>
      <CustNo>'.$arrparam['CustNo'].'</CustNo>
    </SendSMSExternal>
  </soap:Body>
</soap:Envelope>';
//"https://userloginuat.tvscs.co.in/Service.asmx?WSDL"
			$response = $this->CI->nusoap_lib->getResults($body,$url);
			/*$client = new nusoap_client( $url, 'wsdl' );
			$client->soap_defencoding = 'UTF-8';
			$param = array( 'parameters' => $arrparam );
			$response = $client->call( $functionName, $param );
			$soapError = $client->getError();
			if ( !empty( $soapError ) ) {
				return 'SOAP method invocation failed:' . $soapError;
			} else {
				if ( is_array( $response ) ) {
					return $response;
				} else {
					return $response;
				}
			}*/
			return $response['success'];
		}
	
	/* Function to Generate Random Number */

	function randomGen( $min, $max, $quantity ) {
			$numbers = range( $min, $max );
			shuffle( $numbers );
			return array_slice( $numbers, 0, $quantity );
		}

		/**
     * Checks if a contact already exists with the given login or email.
     *
     * @param string $idType The identifier used to check contact uniqueness; either 'login' or 'email'
     * @param string $idValue The actual username or email value entered
     * @param string $accountSetup If the user is creating a username via setup_password: don't direct them back to acct_assist
     * page in the error message if they chose a pre-existing username.
     * @return string|bool Error message or false if the idValue is unique.
     */
    public function contactExists($idType, $idValue, $accountSetup = false)
    {
        $idValue = \Connect\ROQL::escapeString($idValue);
        $result = '';
        if($idType === 'email')
        {
            $idValue = strtolower($idValue);
            try{
                $query = \Connect\ROQL::query(sprintf("SELECT * FROM Contact WHERE Emails.Address='%s'", $idValue))->next();
            }
            catch(\Connect\ConnectAPIErrorBase $e){
                return $this->getResponseObject(null, null, $e->getMessage());
            }
            if($query->next()){
                $result = sprintf(Config::getMessage(EXING_ACCT_EMAIL_ADDR_PCT_S_PLS_MSG), $idValue);
                
            }
        }
        if($result === '')
            return $this->getResponseObject(false, 'is_bool');
       // return $this->getResponseObject(array('message' => $result), 'is_array');
	   return $result;
    }
}