<?php

namespace Custom\Controllers;

use \RightNow\Utils\Url,
    \RightNow\Utils\Framework,
    \RightNow\Utils\Config,
    \RightNow\Api,
    \RightNow\Connect\v1_3 as RNCPHP,
    \RightNow\Internal\Sql\Contact as Sql,
    \RightNow\Utils\Connect as ConnectUtil,
    \RightNow\Libraries\Hooks,
    \RightNow\ActionCapture;

class CustomerCustom extends \RightNow\Controllers\Base 
{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    static $mail_URL;
    static $cpc_URL;
    function __construct() {
      parent::__construct();
      $this->mail_URL = "https://apps.tvscredit.com/tvs/vs/otpservice.do";
      $this->cpc_URL = "https://preferences.tvscredit.com/pref/preferences";
    }

    function getPreferenceData(){
        load_curl();
        date_default_timezone_set('Asia/Kolkata');
        $methodName = "getPrefDetails";
        $phno = $_POST["phno"];
        if(strlen($phno)>0){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->cpc_URL,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "name=getPrefDetails&data=%7B%22refdata%22%3A%22".$phno."%22%7D&key=IOIPUQOeaOVola3lINpTeWCxGBLLP3lN5V3Npp4uNEKYgw1SOtAkAYWGtcM259TO",
          CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Content-Type: application/x-www-form-urlencoded",
            "Host: preferences.tvscredit.com",
            "Postman-Token: d03277c3-bc62-4673-9e5c-d9c8ad3af95c,a9448596-89d3-47e9-bb6f-762fe488bbb6",
            "User-Agent: PostmanRuntime/7.15.2",
            "cache-control: no-cache"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if($err){
            echo json_encode($err,true);
        }
        else{
            header('Content-type:application/json;charset=utf-8');
            $true_array = json_decode($response,true);
            print_r(json_encode($true_array,true));
        }
      }
      else{
        $arr = array("statusCode"=>"EX","statusMessage"=>"Could Not Found the Data for the Registered Mobile Number");
        header('Content-type:application/json;charset=utf-8');
        print_r(json_encode($arr,true));
      }
 
        

    }//getPreferenceData

    function updatePreferenceData(){
        // email: lakshay.bhalla@virtuos.com
        // phone: 9268519782
        // payment_mode: sms
        // promotional_mode: email
        // language: english
        // contact_id: 4880659
        // timming: 9to12

        $mobile_number = "";
        $correct_timmings;
        $correct_Payment_mode;
        $correct_promtional_mode;
        $correct_language;
        $result;
        if(!is_null($_POST["contact_id"]) && strlen($_POST["contact_id"])>0){
            $contact = RNCPHP\Contact::fetch($_POST["contact_id"]);
            $mobile_number = $contact->Phones[0]->Number;
            $_POST['real_mob'] = $mobile_number;

            if($_POST['timming'] == "9to12") $correct_timmings = "9AM_12PM";
            else if($_POST['timming'] == "12to3") $correct_timmings = "12PM_3PM";
            else if($_POST['timming'] == "3to7") $correct_timmings = "3PM_7PM";
            else $correct_timmings = "";

            $correct_Payment_mode = $_POST['payment_mode'];
            $correct_promtional_mode = $_POST['promotional_mode'];

            switch ($_POST['language']) {
                case 'EN':
                    $correct_language = "EN";
                    break;
                case 'HI':
                    $correct_language = "HI";
                    break;
                case 'MA':
                    $correct_language = "MA";
                    break;
                case 'ML':
                    $correct_language = "ML";
                    break;
                case 'TA':
                    $correct_language = "TA";
                    break;
                case 'KN':
                    $correct_language = "KN";
                    break;
                case 'TE':
                    $correct_language = "TE";
                    break;    
                default:
                    $correct_language = "EN";
                    break;
            }

            $result = $this->model('custom/Preferences')->UpdatePreferences($_POST);
        }
        $result_decoded = json_decode($result,true);
        if($result_decoded["statusCode"]=="SR")
        {
            load_curl();
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://preferences.tvscredit.com/pref/preferences",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_TIMEOUT => 100,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "name=updatePrefDetails&data=%7B%22mobileNo%22%3A%22".$_POST['realphone']."%22%2C%22emailId%22%3A%22".urlencode($_POST["email"])."%22%2C%22preferredModeForPaymentUpdates%22%3A%22".$correct_Payment_mode."%22%2C%22preferredModeForPromotionalUpdates%22%3A%22".$correct_promtional_mode."%22%2C%22preferredLanguageForCommunication%22%3A%22".$correct_language."%22%2C%22preferredmodeofCommCat_4%22%3A%22test%22%2C%22preferredTiming%22%3A%22".urlencode($correct_timmings)."%22%2C%22alternateMobileNo%22%3A%22".$_POST["phone"]."%22%7D&key=IOIPUQOeaOVola3lINpTeWCxGBLLP3lN5V3Npp4uNEKYgw1SOtAkAYWGtcM259TO",
              CURLOPT_HTTPHEADER => array(
                  "Content-Type: application/x-www-form-urlencoded"
                ),
              ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } 
            else {
              // echo $response;
                header('Content-type:application/json;charset=utf-8');
                $test = json_decode($response,true);
                $final_resp = array("TVS_API"=>$test, "MY_API"=>$result_decoded);
                // code to set the flag if email changed by sms url
                if($final_resp["TVS_API"]["statusCode"] == "SR" && $final_resp["MY_API"]["statusCode"] == "SR" && $_POST['mlogin']=="1")
                {
                  
                    $contact->CustomFields->c->mobile_url_sentt=1;
                    $contact->save();
                    
                }

                print_r(json_encode($final_resp,true));
            }
        }
        else{
          header('Content-type:application/json;charset=utf-8');
          $arrayName = array("statusCode" => "ER","statusMessage"=>"Cannot Save Data. Some Error Encountered!");
          print_r(json_encode($arrayName,true));
        }
        

    }//updatePreferenceData
    function InitiateOTP(){
            $got_email = $_POST["email"];
            if(empty($got_email) || is_null($got_email) || strlen($got_email) == 0){
                $data = array("statusMessage"=>"Invalid Request Data","statusCode"=>"ER");
                header('Content-type:application/json;charset=utf-8');
                print_r(json_encode($data,true));
            }
            else{
                load_curl();
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://apps.tvscredit.com/tvs/vs/otpservice.do",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_SSL_VERIFYPEER => false,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => "name=sendmail&data=%7B%22mail%22%3A%22".urlencode($got_email)."%22%2C%22type%22%3A%22MAILOTP%22%2C%22action%22%3A%22I%22%7D&key=QVU7smYCoxfS6u3G4RNx28jCnzQ0kGz4vP9MYNbCvpPdR92b9AnAUXU27lK350gYbMCRp",
                  CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/x-www-form-urlencoded",
                    "Host: apps.tvscredit.com",
                    "Postman-Token: 584fb80a-649a-45c8-8a05-9a7e0647492d,6b28bccd-7590-4993-a811-994fadc1d157",
                    "cache-control: no-cache"
                  ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                  echo "cURL Error #:" . $err;
                } else {
                header('Content-type:application/json;charset=utf-8');
                print_r($response);
                }
            }   
    }//InitiateOTP

    function ValidateOTP(){
        $otp = $_POST["otp"];
        $seq = $_POST["seqno"];
        $email = $_POST["email"];
        load_curl();
        if(strlen($otp)>0 && strlen($seq)>0 && strlen($email)>0){
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://apps.tvscredit.com/tvs/vs/otpservice.do",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "name=sendmail&data=%7B%22mail%22%3A%22".urlencode($email)."%22%2C%22type%22%3A%22MAILOTP%22%2C%22action%22%3A%22V%22%7D&key=QVU7smYCoxfS6u3G4RNx28jCnzQ0kGz4vP9MYNbCvpPdR92b9AnAUXU27lK350gYbMCRp&seqno=".$seq."&otpnumber=".$otp,
          CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Content-Type: application/x-www-form-urlencoded",
            "Host: apps.tvscredit.com",
            "Postman-Token: 2ed0033b-cc00-4295-9755-5a570006644d,ce5bacf3-35bb-471c-b00e-2b41ce007bb9",
            "User-Agent: PostmanRuntime/7.16.3",
            "cache-control: no-cache"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            header('Content-type:application/json;charset=utf-8');
          print_r($response);
        }
        }
        else{
            $data = array("statusMessage"=>"Invalid Request Data","statusCode"=>"ER");
                    header('Content-type:application/json;charset=utf-8');
                    print_r(json_encode($data,true));
        }
        // print_r($_POST);
}//ValidateOTP

    function ResendOTP(){
        $email = $_POST["email"];
        $seqno = $_POST["seqno"];
        if(strlen($email)>0 && strlen($seqno)>0)
        {
            load_curl();
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://apps.tvscredit.com/tvs/vs/otpservice.do",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_SSL_VERIFYPEER => false,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "name=sendmail&data=%7B%22mail%22%3A%22".urlencode($email)."%22%2C%22type%22%3A%22MAILOTP%22%2C%22action%22%3A%22U%22%7D&key=QVU7smYCoxfS6u3G4RNx28jCnzQ0kGz4vP9MYNbCvpPdR92b9AnAUXU27lK350gYbMCRp&seqno=".$seqno,
              CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/x-www-form-urlencoded",
                "Host: apps.tvscredit.com",
                "Postman-Token: 2ed0033b-cc00-4295-9755-5a570006644d,ce5bacf3-35bb-471c-b00e-2b41ce007bb9",
                "User-Agent: PostmanRuntime/7.16.3",
                "cache-control: no-cache"
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              header('Content-type:application/json;charset=utf-8');
                print_r($response);
            }
        }
        else{
            $data = array("statusMessage"=>"Invalid Request Data","statusCode"=>"ER");
                    header('Content-type:application/json;charset=utf-8');
                    print_r(json_encode($data,true));
        }
    }//ResendOTP

}