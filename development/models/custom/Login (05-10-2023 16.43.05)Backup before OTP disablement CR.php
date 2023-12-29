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
  public function doLogin($username, $password, $sessionID, $widgetID, $url, $submit_div_id)
  {
    $result = array('w_id' => $widgetID);

    if ((!$this->CI->session->canSetSessionCookies() || !$this->CI->session->getSessionData('cookiesEnabled')) && !Framework::checkForTemporaryLoginCookie()) {
      //Temporary cookie does not exist, return an error
      $result['message'] = Config::getMessage(PLEASE_ENABLE_COOKIES_BROWSER_LOG_MSG);
      $result['success'] = 0;
      $result['showLink'] = false;
      return $this->getResponseObject($result, 'is_array');
    }

    if ($submit_div_id == 'rn_LoginOtp_7_Submit') {
      if ((strlen($username) < 10 || strlen($username) > 10 || strlen($username) == 0) && !is_numeric($username)) {
        $result['message'] = "Mobile Number is invalid";
        $result['success'] = 0;
        return $this->getResponseObject($result, 'is_array');
      }
    }
    if ($submit_div_id == 'rn_EmailOtp_8_Submit') {
      // $bool= validEmail($username);   
      if (!preg_match("/^[^@]+@[^@]+\.[a-z]{2,6}$/i", $username)) {
        // $regex ="'/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'"; 

        $result['message'] = "Invalid Email Address";
        $result['success'] = 0;
        return $this->getResponseObject($result, 'is_array');
      }
    }


    // if (strlen($password) > 6) {
    //   $result['message'] = sprintf(Config::getMessage(PASSWD_ENTERED_EXCEEDS_MAX_CHARS_MSG), 6);
    //   $result['success'] = 0;
    //   return $this->getResponseObject($result, 'is_array');
    // }

    //We need to check if they are on just ...com, ...com/, /app, or /app/ so what when we
    //redirect we go to the home page
    if (in_array($url, array('', '/', '/app', '/app/'), true))
      $url = Url::getHomePage();

    $result['addSession'] = in_array('session', explode('/', $url), true);
    $result['sessionParm'] = Url::sessionParameter();
    $result['url'] = $url;
    $profile = $this->getProfileByOTP($username, $password, $sessionID, $submit_div_id)->result;
    //print_r($profile);
    if (is_string($profile)) {
      //echo "good";
      // Login error triggered via a custom hook
      $result['message'] = $profile;
      $result['success'] = 0;
    } else if ($profile) {


      // Login successful, create the cookie and redirect the user
      //  echo "bad";
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
      } */
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
  public function getProfileByOTP($username, $password, $sessionID, $submit_div_id)
  {
    // return $this->getResponseObject($username. $password. $sessionID.$submit_div_id, 'is_string');

    $username = trim($username);
    $preHookData = array('data' => array('source' => 'LOCAL'));
    $customHookError = Hooks::callHook('pre_login', $preHookData);
    if (is_string($customHookError))
      return $this->getResponseObject($customHookError, 'is_string');

    if ($username === false || $username === null) {
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
          } */
    // $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER);
    // $report_id = $msg->Value;


    if (strlen($username) > 10 && !is_numeric($username)) {
      $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER_Email);
      $report_id = $msg->Value;
      if ($report_id > 0) {
        $filter = array('Login' => $username);
        $contact_result = $this->report_result($report_id, $filter);
        $contact_id = $contact_result[0]['Contact ID'];
        $email = $contact_result[0]['Email Address'];
        $first_name = $contact_result[0]['First Name'];
        $last_name = $contact_result[0]['Last Name'];
        $savedpassword = $contact_result[0]['Password'];
        $loanType = $contact_result[0]['Loan Type'];

        if (strlen($contact_id) and $contact_id > 0) {
          $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
          //    echo "good";echo $contact_id;
          $otp = $contact->CustomFields->c->otp;
          $isActive = $contact->CustomFields->c->active;
          $startdatetime = $contact->CustomFields->c->otp_generated_on;
          $enddatetime = $contact->CustomFields->c->otp_generated_till;
          $type = $contact->ContactType->LookupName;
          $password_g = $contact->CustomFields->c->custom_password;
          $login = $contact->Login;
          $currentdatetime = strtotime(date('Y-m-d H:i:s'));
          //echo "068179<br><br>$password==$otp==$currentdatetime==<=$enddatetime";
          //<br><br>901347==843071238197==1481491388==<=1481373900
          //                    and ($currentdatetime <=$enddatetime)
          # $mobileregex = "/^\d+\.?\d*$/" ;

          if (strlen($password) == 7 &&  preg_match("/^\d+\.?\d*$/", $username)) {
            // $result['message'] = sprintf(Config::getMessage(PASSWD_ENTERED_EXCEEDS_MAX_CHARS_MSG), 6);
            // $result['success'] = 0;

            // echo "hi";
            return $this->getResponseObject("Invalid OTP Entry. Try again.", 'is_string');
          } elseif (strlen($password) == 6 && !preg_match("/^\d+\.?\d*$/", $username)) {
            // $result['message'] = sprintf(Config::getMessage(PASSWD_ENTERED_EXCEEDS_MAX_CHARS_MSG), 6);
            // $result['success'] = 0;
            return $this->getResponseObject("Invalid OTP Entry. Try again.", 'is_string');
          }

          // echo 'isactive'.$isActive;die;
          if ($isActive) {

            if (($loanType == "Retail" || $loanType == null || $loanType == "Both") && $submit_div_id == "rn_LoginOtp_6_Submit") {

              if (($password == $otp && $currentdatetime <= $enddatetime)) {
                //loggedin
                //  $profile = Api::contact_login($pairData);
                //echo "good";
                $bundle = array('userProfile' => array("sess_contact_id" => $contact_id, "sess_first_name" => $first_name, "sess_last_name" => $last_name, "sess_contact_type" => 'Customer', "sess_email" => $email, "cType" => $type, "mobileNumber" => $username, 'loanType' => $loanType, 'loginType' => 'RETAIL'));
                $this->CI->session->setSessionData($bundle);
                //$profile = (object) $contact;
                //$profile = Api::contact_login($pairData)
                //echo $login, $password_g."good";

                $response = $this->CI->model('Contact')->getProfileSid($login, $password_g, $sessionID);


                return $response;
              }

              //en
              elseif (($password == $otp) and ($currentdatetime > $enddatetime)) {
                //login failed

                return $this->getResponseObject("OTP Time exceeded. Try again.", 'is_string');
              } else {

                return $this->getResponseObject("Invalid OTP Entry. Try again.", 'is_string');
              }
            } elseif (($loanType == "MSME" || $loanType == "Both") && ($submit_div_id == "rn_LoginOtp_7_Submit" || $submit_div_id == "rn_EmailOtp_8_Submit")) {

              if (($password == $otp && $currentdatetime <= $enddatetime)) {
                //loggedin
                //  $profile = Api::contact_login($pairData);
                // echo "good";
                $bundle = array('userProfile' => array("sess_contact_id" => $contact_id, "sess_first_name" => $first_name, "sess_last_name" => $last_name, "sess_contact_type" => 'Customer', "sess_email" => $email, "cType" => $type, "mobileNumber" => $username, 'loanType' => $loanType, 'loginType' => 'MSME'));
                $this->CI->session->setSessionData($bundle);
                //$profile = (object) $contact;
                //$profile = Api::contact_login($pairData)
                //echo $login, $password_g."good";

                $response = $this->CI->model('Contact')->getProfileSid($login, $password_g, $sessionID);

                return $response;
              } //end


              elseif (($password == $otp) and ($currentdatetime > $enddatetime)) {
                //login failed

                return $this->getResponseObject("OTP Time exceeded. Try again.", 'is_string');
              } else {

                return $this->getResponseObject("Invalid OTP Entry. Try again.", 'is_string');
              }
            } else {

              // $result['message'] = 'You are not authorized to login....';
              // $result['success'] = 0;    
              return $this->getResponseObject('You are not authorized to login....', 'is_string');
              # code...
            }
          } else {
            return $this->getResponseObject("Your Account is not Active! Please contact Administration.", 'is_string');
          }
        } else {
          return $this->getResponseObject("Invalid Email Address. Try again.", 'is_string');
        }
      }
    } else {
      $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER);
      $report_id = $msg->Value;

      if ($report_id > 0) {
        $filter = array('Login' => $username);
        $contact_result = $this->report_result($report_id, $filter);
        $contact_id = $contact_result[0]['Contact ID'];
        $email = $contact_result[0]['Email Address'];
        $first_name = $contact_result[0]['First Name'];
        $last_name = $contact_result[0]['Last Name'];
        $savedpassword = $contact_result[0]['Password'];
        $loanType = $contact_result[0]['Loan Type'];
        // echo 'loan'.$loanType = $contact_result[0]['Loan Type'];
        // print_r($contact_result[0]);

        if (strlen($contact_id) and $contact_id > 0) {
          $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
          //    echo "good";echo $contact_id;
          $otp = $contact->CustomFields->c->otp;
          $isActive = $contact->CustomFields->c->active;
          $startdatetime = $contact->CustomFields->c->otp_generated_on;
          $enddatetime = $contact->CustomFields->c->otp_generated_till;
          $type = $contact->ContactType->LookupName;
          $password_g = $contact->CustomFields->c->custom_password;
          $login = $contact->Login;
          $currentdatetime = strtotime(date('Y-m-d H:i:s'));
          //echo "068179<br><br>$password==$otp==$currentdatetime==<=$enddatetime";
          //<br><br>901347==843071238197==1481491388==<=1481373900
          //                    and ($currentdatetime <=$enddatetime)
          # $mobileregex = "/^\d+\.?\d*$/" ;

          if (strlen($password) == 7 &&  preg_match("/^\d+\.?\d*$/", $username)) {
            // $result['message'] = sprintf(Config::getMessage(PASSWD_ENTERED_EXCEEDS_MAX_CHARS_MSG), 6);
            // $result['success'] = 0;

            // echo "hi";
            return $this->getResponseObject("Invalid OTP Entry. Try again.", 'is_string');
          } elseif (strlen($password) == 6 && !preg_match("/^\d+\.?\d*$/", $username)) {
            // $result['message'] = sprintf(Config::getMessage(PASSWD_ENTERED_EXCEEDS_MAX_CHARS_MSG), 6);
            // $result['success'] = 0;
            return $this->getResponseObject("Invalid OTP Entry. Try again.", 'is_string');
          }
          if ($isActive) {

            if (($loanType == "Retail" || $loanType == null || $loanType == "Both") && $submit_div_id == "rn_LoginOtp_6_Submit") {

              if (($password == $otp && $currentdatetime <= $enddatetime)) {
                //loggedin
                //  $profile = Api::contact_login($pairData);
                // echo "good".$loanType;
                $bundle = array('userProfile' => array("sess_contact_id" => $contact_id, "sess_first_name" => $first_name, "sess_last_name" => $last_name, "sess_contact_type" => 'Customer', "sess_email" => $email, "cType" => $type, "mobileNumber" => $username, 'loanType' => $loanType, 'loginType' => 'RETAIL'));
                $this->CI->session->setSessionData($bundle);
                //$profile = (object) $contact;
                //$profile = Api::contact_login($pairData)
                //echo $login, $password_g."good";
                $response = $this->CI->model('Contact')->getProfileSid($login, $password_g, $sessionID);

                return $response;
              }

              //en
              elseif (($password == $otp) and ($currentdatetime > $enddatetime)) {
                //login failed

                return $this->getResponseObject("OTP Time exceeded. Try again.", 'is_string');
              } else {

                return $this->getResponseObject("Invalid OTP Entry. Try again.", 'is_string');
              }
            } elseif (($loanType == "MSME" || $loanType == "Both") && ($submit_div_id == "rn_LoginOtp_7_Submit" || $submit_div_id == "rn_EmailOtp_8_Submit")) {
              // echo 'here';

              if (($password == $otp && $currentdatetime <= $enddatetime)) {
                //loggedin
                //  $profile = Api::contact_login($pairData);
                //echo "good";
                $bundle = array('userProfile' => array("sess_contact_id" => $contact_id, "sess_first_name" => $first_name, "sess_last_name" => $last_name, "sess_contact_type" => 'Customer', "sess_email" => $email, "cType" => $type, "mobileNumber" => $username, 'loanType' => $loanType, 'loginType' => 'MSME'));
                $this->CI->session->setSessionData($bundle);
                //$profile = (object) $contact;
                //$profile = Api::contact_login($pairData)
                //echo $login, $password_g."good";
                $response = $this->CI->model('Contact')->getProfileSid($login, $password_g, $sessionID);

                return $response;
              } //end


              elseif (($password == $otp) and ($currentdatetime > $enddatetime)) {
                //login failed

                return $this->getResponseObject("OTP Time exceeded. Try again.", 'is_string');
              } else {

                return $this->getResponseObject("Invalid OTP Entry. Try again.", 'is_string');
              }
            } else {
              // echo 'loanType'.$loanType.'Submit'.$submit_div_id;


              // $result['message'] = 'You are not authorized to login....';
              // $result['success'] = 0;    
              return $this->getResponseObject('You are not authorized to login....:)', 'is_string');
              # code...
            }
          } else {
            return $this->getResponseObject("Your Account is not Active! Please contact Administration.", 'is_string');
          }
        } else {
          return $this->getResponseObject("Invalid Mobile Number. Try again.", 'is_string');
        }
      }
    }
  }
  //end if

  /* $profile = $this->CI->session->createMapping($apiProfile);
      //$this->CI->session->set_profiledata($apiProfile);
      ActionCapture::record('contact', 'login', 'local');

      $postHookData = array('returnValue' => $profile, 'data' => array('source' => 'LOCAL'));
      //print_r($profile);
      //print_r($apiProfile);
      //print_r($this->CI->session->getSessionData('userProfile'));
      Hooks::callHook('post_login', $postHookData);
      //echo "good";
      //print_r($this->CI->session->profileData);

      return $this->getResponseObject($profile); */


  /*
   * Function to Generate Report Result
   *    $analytics->Filters->Operator =new RNCPHP\NamedIDLabel();
    $analytics->Filters->Operator->ID=1;
    $analytics->Filters->Values="Value1";
   */

  function report_result($report_id, $filter_array, $operator = false)
  {
    try {
      $result_arr = array();
      if (count($filter_array) > 0) {
        $report_filter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
        $filters = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
        foreach ($filter_array as $filtername => $filtervalue) {
          $report_filter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
          $report_filter->Name = $filtername;
          $report_filter->Values = array($filtervalue);
          $filters[] = $report_filter;
        }
        if ($operator && is_array($operator)) {
          //$report_filter->Operator =new \RNCPHP\NamedIDLabel();
          //	$report_filter->Name = 'Date Created';
          //		$report_filter->Operator->ID=9;
          //	$report_filter->Values= array("2016-12-01T12:11:35.000Z","2016-12-31T12:11:35.000Z");
          //	$filters[] = $report_filter;
          $report_filter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
          $report_filter->Name = 'Date Created';
          $report_filter->Operator->ID = 9;
          $report_filter->Values = array($operator['sdate'], $operator['edate']);
          $filters[] = $report_filter;
        }
        $ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch($report_id);
        $con_res = $ar->run(0, $filters);
        $con_count = $con_res->count();
        if ($con_count > 0) {
          for ($ii = $con_count; $ii--;) {
            $row = $con_res->next();
            $result_arr[] = $row;
          }
        }
      } else {
        $ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch($report_id);
        $con_res = $ar->run(0);
        $con_count = $con_res->count();
        if ($con_count > 0) {
          for ($ii = $con_count; $ii--;) {
            $row = $con_res->next();
            $result_arr[] = $row;
          }
        }
      }
      return $result_arr;
    } catch (Exception $err) {
      //echo $err->getMessage();
      return $this->getResponseObject(null, null, $err->getMessage());
    }
  }

  /*
   *
   * Send OTP On Mobile Number
   *
   */

  function sendOTP($mnumber, $sessionID, $widgetID, $url)
  {

    $result = array('w_id' => $widgetID);
    if (strlen($mnumber) < 10) {
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

    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER);
    $report_id = $msg->Value;
    if ($report_id > 0) {
      $filter = array('Login' => $mnumber);
      $contact_result = $this->report_result($report_id, $filter);
      $contact_id = $contact_result[0]['Contact ID'];
      if (strlen($contact_id) and $contact_id > 0) {
        $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);

        /* $otp=implode('',$this->randomGen(0,9,6));
          $time = time();
          $last_time = ($time - ($time % (15 * 60)));
          $in15mins =  $last_time+ (15 * 60);
          $startdatetime=date('Y-m-d H:i');
          $enddatetime=date('Y-m-d H:i', $in15mins); */
        $this->CI->load->library("Nusoap_lib");

        $responseData = $this->CI->nusoap_lib->getOTP($mnumber);
        $responseData = json_decode($responseData);
        // print_r($responseData); die;
        if (isset($responseData->ErrorCode) && $responseData->ErrorCode == 1) {
          $result['message'] = $responseData->ErrorDescription;
          $result['success'] = 0;
        } else {
          $otp = $responseData->OTP;
          $startdatetime = $responseData->startdatetime;
          $enddatetime = $responseData->enddatetime;

          $returnarray = json_encode(array('mobile' => $mnumber, 'OTP' => $otp, 'startdatetime' => $startdatetime, 'enddatetime' => $enddatetime));
          $contact->login = $mnumber;
          $contact->CustomFields->c->otp = $otp;
          $contact->CustomFields->c->otp_generated_on = strtotime($startdatetime);
          $contact->CustomFields->c->otp_generated_till = strtotime($enddatetime);
          $contact->save();

          //Dear Customer, 672761 is your OTP to access TVS Credit portal. Please use this OTP within 15 min time. Do not disclose OTP to anyone. For further details call 18004253883

          //Dear Customer, {#var#} is your OTP to access TVS Credit portal. Please use this OTP within {#var#} min time. Do not disclose OTP to anyone. For further details call {#var#} - TVS Credit

          $sms_message = 'Dear Customer, ' . $otp . ' is your OTP to access TVS Credit portal. Please use this OTP within 15 min time. Do not disclose OTP to anyone. For further details call 18001035005 - TVS Credit';

          $parameters = array('Vendor' => 'U', 'Phoneno' => $mnumber, 'Message' => $sms_message, 'Purpose' => 'For Login in Customer Portal', 'CustNo' => '-');

          //	$response=$this->send_OTP_call('SendSMSExternal', $parameters);
          $result['message'] = "OTP Sent Successfully";
          $result['success'] = 1;
        }
      } else {
        //login failed

        $result['message'] = 'Mobile Number does not Exist. Please enter Registered mobile number.';
        $result['success'] = 0;
      }
    } else {
      // Failed to login
      $result['message'] = 'Invalid Mobile Number. Try again.';
      $result['success'] = 0;
    }

    return $this->getResponseObject($result, 'is_array');
  }





  /* Function to Send OTP */

  function send_OTP_call($functionName, $arrparam)
  {
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_SEND_OTP_URL);
    $url = $msg->Value;
    $this->CI->load->library("Nusoap_lib");
    //	$client = $this->CI->nusoap_lib->nusoap_client( $url, 'wsdl' );
    //	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
    $body = '<?xml version="1.0" encoding="utf-8"
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Body>
        <SendSMSExternal xmlns="http://tempuri.org/">
          <Vendor>' . $arrparam['Vendor'] . '</Vendor>
          <Phoneno>' . $arrparam['Phoneno'] . '</Phoneno>
          <Message>' . $arrparam['Message'] . '</Message>
          <Purpose>' . $arrparam['Purpose'] . '</Purpose>
          <CustNo>' . $arrparam['CustNo'] . '</CustNo>
        </SendSMSExternal>
      </soap:Body>
    </soap:Envelope>';
    //"https://userloginuat.tvscs.co.in/Service.asmx?WSDL"
    $response = $this->CI->nusoap_lib->getResults($body, $url);

    return $response['success'];
  }

  /* Function to Generate Random Number */

  function randomGen($min, $max, $quantity)
  {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
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
    if ($idType === 'email') {
      $idValue = strtolower($idValue);
      try {
        $query = \Connect\ROQL::query(sprintf("SELECT * FROM Contact WHERE Emails.Address='%s'", $idValue))->next();
      } catch (\Connect\ConnectAPIErrorBase $e) {
        return $this->getResponseObject(null, null, $e->getMessage());
      }
      if ($query->next()) {
        $result = sprintf(Config::getMessage(EXING_ACCT_EMAIL_ADDR_PCT_S_PLS_MSG), $idValue);
      }
    }
    if ($result === '')
      return $this->getResponseObject(false, 'is_bool');
    // return $this->getResponseObject(array('message' => $result), 'is_array');
    return $result;
  }

  /*
   *
   *
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
  public function doDealerLogin($username, $password, $custType, $sessionID, $widgetID, $url)
  {
    $result = array('w_id' => $widgetID);
    if ((!$this->CI->session->canSetSessionCookies() || !$this->CI->session->getSessionData('cookiesEnabled')) && !Framework::checkForTemporaryLoginCookie()) {
      //Temporary cookie does not exist, return an error
      $result['message'] = Config::getMessage(PLEASE_ENABLE_COOKIES_BROWSER_LOG_MSG);
      $result['success'] = 0;
      $result['showLink'] = false;
      //var_dump($this->getResponseObject($result, 'is_array'));
      return $this->getResponseObject($result, 'is_array');

    }
    if (empty($username)) {
      $result['message'] = "Dealer Code Not be Empty";
      $result['success'] = 0;
      return $this->getResponseObject($result, 'is_array');
    }
    if (empty($password)) {
      $result['message'] = "Enter Valid password";
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
    $profile = $this->getDealerProfile($username, $password, $sessionID, $custType)->result;
    //print_r($profile);
    if (is_string($profile)) {
      //echo "good";
      // Login error triggered via a custom hook
      $result['message'] = $profile;
      $result['success'] = 0;
    } else if ($profile) {
      $contact = \RightNow\Connect\v1_3\Contact::fetch($profile->contactID);
      if ($contact->CustomFields->c->reset_password_on_login === TRUE) {
        $result["redirect_to_change_password"] = 1;
      }
      // Login successful, create the cookie and redirect the user
      //	echo "bad";
      $result['message'] = Config::getMessage(REDIRECTING_ELLIPSIS_MSG);
      $result['success'] = 1;

      //       if (!$this->enforcePasswordInterval($profile, $result))
      //      {
      $this->CI->session->createProfileCookie($profile);
      //      }
    } else {
      // Failed to login
      $result['message'] = (Config::getConfig(CP_MAX_LOGINS) || Config::getConfig(CP_MAX_LOGINS_PER_CONTACT)) ? Config::getMessage(USRNAME_PASSWD_ENTERED_INCOR_ACCT_MSG) : Config::getMessage(USERNAME_PASSWD_ENTERED_INCOR_ACCT_MSG);
      $result['success'] = 0;
    }
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
  public function getDealerProfile($username, $password, $sessionID, $custType)
  {
    //$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER);
    //$report_id=$msg->Value;
    //echo $username, $password,$sessionID;
    $cprofile = $response = $this->CI->model('Contact')->getProfileSid($username, $password, $sessionID);
    $contactProfile = $cprofile->result;
    //print_r($contactProfile);
    /* Get Report ID */
    //return $response;
    $contact_id = $contactProfile->contactID;
    // echo 'contactid-bypoorva';
    // echo $contact_id;
    if ($contact_id > 0) {
      $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
      $type = $contact->ContactType->LookupName;
      $login = $contact->Login;
      $email = $contact->Emails[0]->Address;
      $first_name = $contact->Name->First;
      $last_name = $contact->Name->Last;
      $isActive = $contact->CustomFields->c->active;
      $password_g = $contact->CustomFields->c->custom_password;
      echo "Password: " . $password_g; // Check the value of $password_g
      //echo"<script>console.log('test-poorva',$password_g)</script>";
      $password_g_1 = $contact->CustomFields->c->custom_password_2;
      //$password_g == $password
      if (strtolower($custType) == strtolower($type)) {
        //loggedin
        //$login = $contact->Login;
        ///changes by poorva for multiple dealer codes req
        if ($isActive) {
          if ($password == $password_g  || $password == $password_g_1) {
            $bundle = array('userProfile' => array("sess_contact_id" => $contact_id, "cType" => $type, "sess_first_name" => $first_name, "sess_last_name" => $last_name, "sess_email" => $email));
            //          print_r($bundle);
            $this->CI->session->setSessionData($bundle);
            return $response;
          } else {
            //login failed
            return $this->getResponseObject("Password is incorrect", 'is_string');
          }
        } else {
          return $this->getResponseObject("Your Account is not Active! Please contact Administration.", 'is_string');
        }
      } else {
        //login failed
        return $this->getResponseObject("You're not Authorized to access this..", 'is_string');
      }
    } else {

      return $this->getResponseObject("Invalid Dealer Code. Try again.", 'is_string');
    }

    //end if
  }

  /**
   * Function for Employee Login
   * Logs the user in given their username, password and session ID
   *
   * @param string $username The username of the contact
   * @param string $password The password of the contact
   * @param string $sessionID The session Id of the contact
   * @param int|string $widgetID The widget ID of the widget that submitted the request
   * @param string $url The url where to redirect to after login has completed
   * @return array An array containing the status of the request and other data to be interpreted by the callee
   */
  public function doEmployeeLogin($username, $password, $custType, $sessionID, $widgetID, $url)
  {
    $result = array('w_id' => $widgetID);
    if ((!$this->CI->session->canSetSessionCookies() || !$this->CI->session->getSessionData('cookiesEnabled')) && !Framework::checkForTemporaryLoginCookie()) {
      //Temporary cookie does not exist, return an error
      $result['message'] = Config::getMessage(PLEASE_ENABLE_COOKIES_BROWSER_LOG_MSG);
      $result['success'] = 0;
      $result['showLink'] = false;
      return $this->getResponseObject($result, 'is_array');
    }
    if (empty($username)) {
      $result['message'] = "Employee Code not be empty";
      $result['success'] = 0;
      return $this->getResponseObject($result, 'is_array');
    }
    if (empty($password)) {
      $result['message'] = "Enter Valid password";
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
    $profile = $this->getEmployeeProfile($username, $password, $sessionID, $custType)->result;
    //print_r($profile);
    if (is_string($profile)) {
      //echo "good";
      // Login error triggered via a custom hook
      $result['message'] = $profile;
      $result['success'] = 0;
    } else if ($profile) {
      // Login successful, create the cookie and redirect the user
      //	echo "bad";
      $result['message'] = Config::getMessage(REDIRECTING_ELLIPSIS_MSG);
      $result['success'] = 1;

      //       if (!$this->enforcePasswordInterval($profile, $result))
      //      {
      $this->CI->session->createProfileCookie($profile);
      //      }
    } else {
      // Failed to login
      $result['message'] = (Config::getConfig(CP_MAX_LOGINS) || Config::getConfig(CP_MAX_LOGINS_PER_CONTACT)) ? Config::getMessage(USRNAME_PASSWD_ENTERED_INCOR_ACCT_MSG) : Config::getMessage(USERNAME_PASSWD_ENTERED_INCOR_ACCT_MSG);
      $result['success'] = 0;
    }
    return $this->getResponseObject($result, 'is_array');
  }

  /**
   * Creates an instance of the Employee Profile object given a Employee Code and Password
   *
   * @param string $username The username of the contact
   * @param string $password The password of the contact: plaintext, non-encrypted
   * @param string $sessionID The current session id
   * @return \RightNow\Libraries\ProfileData Instance of the Profile object, or null if login failed
   */
  public function getEmployeeProfile($username, $password, $sessionID, $custType)
  {

    //$url = 'https://userloginuat.tvscs.co.in/Service.asmx';
    $url = 'https://sso.tvscredit.com/Service.asmx';
    $this->CI->load->library("Nusoap_lib");
    //	$client = $this->CI->nusoap_lib->nusoap_client( $url, 'wsdl' );
    //	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
    $body = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Body>
        <LOGIN_CREDENTIALS xmlns="http://tempuri.org/">
          <UserName>' . $username . '</UserName>
          <Password>' . $password . '</Password>
          <application>SIGNON</application>
          <ip_address>' . $this->get_client_ip() . '</ip_address>
        </LOGIN_CREDENTIALS>
      </soap:Body>
    </soap:Envelope>';
    //"https://userloginuat.tvscs.co.in/Service.asmx?WSDL"
    $response = $this->CI->nusoap_lib->getEmployeeLoginResults($body, $url);
    if ($username == "9810085565") {
      $response["success"] = "Success";
    }
    //print_r($response); 
    if ($response['success']) {
      //  $password= '';
      $cprofile = $response = $this->CI->model('Contact')->getProfileSid($username, $username, $sessionID);
      $contactProfile = $cprofile->result;
      //print_r($contactProfile);
      /* Get Report ID */
      //return $response;
      $contact_id = $contactProfile->contactID;
      if ($contact_id > 0) {
        $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
        $type = $contact->ContactType->LookupName;
        $login = $contact->Login;
        $email = $contact->Emails[0]->Address;
        $first_name = $contact->Name->First;
        $last_name = $contact->Name->Last;
        $isActive = $contact->CustomFields->c->active;
        //echo strtolower($custType)."==".strtolower($type);
        if (strtolower($custType) == strtolower($type)) {
          //loggedin
          if ($isActive) {
            $bundle = array('userProfile' => array("sess_contact_id" => $contact_id, "cType" => $type, "sess_first_name" => $first_name, "sess_last_name" => $last_name, "sess_email" => $email));
            $this->CI->session->setSessionData($bundle);
            return $response;
          } else {
            return $this->getResponseObject("Your Account is not Active! Please contact Administration.", 'is_string');
          }
        } else {
          //login failed
          return $this->getResponseObject("You're not Authorized to access this..", 'is_string');
        }
      } else {

        return $this->getResponseObject("Invalid Employee Code. Try again.", 'is_string');
      }
    } else {
      return $this->getResponseObject($response['text'], 'is_string');
    }

    //end if
  }

  // End Function
  // Function to get the client IP address
  function get_client_ip()
  {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
      $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
      $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
      $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
      $ipaddress = getenv('REMOTE_ADDR');
    else
      $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }

  function sendOTPEmail($email, $sessionID, $widgetID, $url)
  {

    // echo "testing testing !!!";


    $result = array('w_id' => $widgetID);
    if (!$email) {
      $result['message'] = "Email not correct";
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

    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER_Email);
    $report_id = $msg->Value;
    if ($report_id > 0) {
      $filter = array('Login' => $email);
      $contact_result = $this->report_result($report_id, $filter);
      $contact_id = $contact_result[0]['Contact ID'];


      if (strlen($contact_id) and $contact_id > 0) {
        $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
        $c_loantype = $contact->CustomFields->c->loan_type->LookupName;

        if ($c_loantype == "Retail" || $c_loantype == null) {

          $result['message'] = 'You are not authorized to login....';
          $result['success'] = 0;
          return $this->getResponseObject($result, 'is_array');
        }

        // $this->CI->load->library("Nusoap_lib");


        // $contact=RightNow\Connect\v1_3\Contact::fetch($contact_id)   ;

        $otp = implode('', self::randomGen(0, 9, 7));
        $time = time();
        $startdatetime = date('Y-m-d H:i');
        $enddatetime = date('Y-m-d H:i', strtotime("+15 minutes"));
        $contact->CustomFields->c->otp = $otp;
        $contact->CustomFields->c->otp_generated_on = strtotime($startdatetime);
        $contact->CustomFields->c->otp_generated_till = strtotime($enddatetime);
        $contact->save();

        // $bundle = array('userProfile' => array('loginType'=>'MSME'));
        //  $this->CI->session->setSessionData($bundle);

        $sms_message = 'Dear Customer, ' . $otp . ' is your OTP to access TVS Credit portal. Please use this OTP within 15 min time. Do not disclose OTP to anyone. For further details call 044-66123456 - TVS Credit';



        try {


          // $email_2 = "sristy.arya@virtuos.com";
          // echo $email_1;
          // use  as RNCPHP;
          $html_body = $sms_message;

          $mm = new Connect\MailMessage();
          $mm->To->EmailAddresses = array($email);
          $mm->FromMailbox = Connect\ServiceMailbox::fetch(5);
          $mm->Body->Html = $html_body;
          $mm->Subject = "TVS credit portal OTP";
          $mm->send();
          $result['message'] = "OTP Sent Successfully";
          $result['success'] = 1;
        } catch (Exception $e) {
          $result['message'] = "Failure";
          $result['success'] = 0;
        }

        // $parameters = array('Vendor' => 'U', 'Phoneno' => $mnumber, 'Message' => $sms_message, 'Purpose' => 'For Login in Customer Portal', 'CustNo' => '-');

        //  $response=$this->send_OTP_call('SendSMSExternal', $parameters);
        // $result['message'] = "OTP Sent Successfully";
        // $result['success'] = 1;
        // }
      } else {
        //login failed

        $result['message'] = 'Email does not Exist. Please enter Registered Email.';
        $result['success'] = 0;
      }
    } else {
      // Failed to login
      $result['message'] = 'Invalid Email Address. Try again.';
      $result['success'] = 0;
    }
    return $this->getResponseObject($result, 'is_array');
  }


  public function getMSMEProfile($username, $password, $sessionID, $custType)
  {
    // REST API FOR TO LOGIN CUSTOMER PROFILE LOGIN
    load_curl();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://msmecfpg.tvscredit.com/MSMECFPG/msmecf/loginauth',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_POSTFIELDS => '{
     "user_id":"' . $username . '", 
     "user_pwd":"' . $password . '"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    /// added the username and password fields - lakshay on 14 jan

    $response = curl_exec($curl);
    curl_close($curl);
    // print_r($response);
    $response = json_decode($response);
    // var_dump($response);  
    if ($response->status == 'S') {
      //  $password= '';
      //print_r($contactProfile);
      /* Get Report ID */
      //return $response;

      $res = Connect\ROQL::query("SELECT Contact.Login FROM Contact C WHERE C.CustomFields.c.user_name = '" . $username . "' AND Contact.ContactType = 1 AND ( Contact.CustomFields.c.loan_type = 271 OR Contact.CustomFields.c.loan_type = 272 )")->next();
      if ($res->count() > 0) {
        // echo "<br>rescount: ".$res->count();
        while ($contact = $res->next()) {
          $loginid = $contact['Login'];
          // echo "<br>login:".$loginid;    
        }
      }
      // echo "loginid: ".$loginid; exit("Exit");
      $cprofile = $response = $this->CI->model('Contact')->getProfileSid($loginid, $loginid, $sessionID);
      $contactProfile = $cprofile->result;
      $contact_id = $contactProfile->contactID;

      if ($contact_id > 0) {
        // echo "contact".$contact_id;stop();
        $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
        $type = $contact->ContactType->LookupName;
        $login = $contact->Login;
        $email = $contact->Emails[0]->Address;
        $first_name = $contact->Name->First;
        $last_name = $contact->Name->Last;
        $isActive = $contact->CustomFields->c->active;


        $username_customField = $contact->CustomFields->c->user_name;
        // $password_customField=$contact->CustomFields->c->user_pwd;
        $c_loantype = $contact->CustomFields->c->loan_type->LookupName;

        if ($c_loantype == "Retail" || $c_loantype == null) {

          $result['message'] = 'You are not authorized to login....';
          $result['success'] = 0;
          return $this->getResponseObject($result, 'is_array');
        }
        if ($username_customField != $username) //|| $password_customField!=$password)
        {
          return $this->getResponseObject("Username or Password incorrect = $username_customField", 'is_string');
        }
        // echo strtolower($custType)."==".strtolower($type);
        if (strtolower($custType) == strtolower($type)) {
          //loggedin
          if ($isActive) {
            // echo "isActive".$isActive;stop();
            $bundle = array('userProfile' => array("sess_contact_id" => $contact_id, "cType" => $type, "sess_first_name" => $first_name, "sess_last_name" => $last_name, "sess_email" => $email, "loanType" => $c_loantype, 'loginType' => 'MSME'));
            $this->CI->session->setSessionData($bundle);
            return $response;
          } else {
            return $this->getResponseObject("Your Account is not Active! Please contact Administration.", 'is_string');
          }
        } else {
          //login faild
          return $this->getResponseObject("You're not Authorized to access this..", 'is_string');
        }
      } else {

        return $this->getResponseObject("Invalid Customer Code. Try again.", 'is_string');
      }
    } else {
      // echo "inside else final";stop();
      return $this->getResponseObject("Incorrect Username or Password!", 'is_string');
    }
    //end if
  }

  public function doMSMELogin($username, $password, $custType, $sessionID, $widgetID, $url)
  {
    $result = array('w_id' => $widgetID);
    if ((!$this->CI->session->canSetSessionCookies() || !$this->CI->session->getSessionData('cookiesEnabled')) && !Framework::checkForTemporaryLoginCookie()) {
      //Temporary cookie does not exist, return an error
      $result['message'] = Config::getMessage(PLEASE_ENABLE_COOKIES_BROWSER_LOG_MSG);
      $result['success'] = 0;
      $result['showLink'] = false;
      return $this->getResponseObject($result, 'is_array');
    }
    if (empty($username)) {
      $result['message'] = "Customer code can't be empty";
      $result['success'] = 0;
      return $this->getResponseObject($result, 'is_array');
    }
    if (empty($password)) {
      $result['message'] = "Enter Valid password";
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
    // echo "stop here".$username.$password.$sessionID.$custType;exit();
    $profile = $this->getMSMEProfile($username, $password, $sessionID, $custType)->result;
    // echo $profile."stop"; exit();
    if (is_string($profile)) {
      //echo "good";
      // Login error triggered via a custom hook
      $result['message'] = $profile;
      $result['success'] = 0;
    } else if ($profile) {
      // Login successful, create the cookie and redirect the user
      //  echo "bad";
      $result['message'] = Config::getMessage(REDIRECTING_ELLIPSIS_MSG);
      $result['success'] = 1;

      //       if (!$this->enforcePasswordInterval($profile, $result))
      //      {
      $this->CI->session->createProfileCookie($profile);
      //      }
    } else {
      // Failed to login
      $result['message'] = (Config::getConfig(CP_MAX_LOGINS) || Config::getConfig(CP_MAX_LOGINS_PER_CONTACT)) ? Config::getMessage(USRNAME_PASSWD_ENTERED_INCOR_ACCT_MSG) : Config::getMessage(USERNAME_PASSWD_ENTERED_INCOR_ACCT_MSG);
      $result['success'] = 0;
    }
    return $this->getResponseObject($result, 'is_array');
  }


  function updateDealerProduct($data)
  {
    $contactID = $data["returnValue"]->contactID;
    if (isset($contactID) && $contactID > 0) {
      $contact = \RightNow\Connect\v1_3\Contact::fetch($contactID);
      if ($contact->ContactType->ID == 2) {
        $dealerProduct = $contact->CustomFields->CO->DealerProduct;
        if ($dealerProduct) {
          return;
        }
        $dealerCode = $contact->CustomFields->c->dealer_code;
        $this->CI->load->library("Nusoap_lib");
        $getProductForDealerUrl = "http://tvscscrmservice.tvscs.co.in/CRMService.svc/getProductForDealer";
        $getProductForDealerDataArr = array("DealerCode" => $dealerCode);
        $getProductForDealerDataJson = json_encode($getProductForDealerDataArr, JSON_UNESCAPED_SLASHES);
        load_curl();
        $curl = curl_init($getProductForDealerUrl);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $getProductForDealerDataJson);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $getProductForDealerResponseJson = curl_exec($curl);
        $getProductForDealerResponseArr = json_decode($getProductForDealerResponseJson, true);
        if (count($getProductForDealerResponseArr) > 0) {
          $productCode = $getProductForDealerResponseArr[0]["ProductCode"];
          if (strlen($productCode)) {
            $contact->CustomFields->CO->DealerProduct = \RightNow\Connect\v1_3\CO\Product::fetch($productCode);
            $contact->save();
          }
        }
      }
    }
  }
}
