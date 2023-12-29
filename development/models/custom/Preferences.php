<?php

namespace Custom\Models;

use \RightNow\Utils\Url, \RightNow\Utils\Framework, \RightNow\Utils\Config, \RightNow\Api, \RightNow\Connect\v1_3 as RNCPHP, \RightNow\Internal\Sql\Contact as Sql, \RightNow\Utils\Connect as ConnectUtil, \RightNow\Libraries\Hooks, \RightNow\ActionCapture;

require_once CORE_FILES . 'compatibility/Internal/Sql/Contact.php';

class Preferences extends \RightNow\Models\Base
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
    
    
    // $data = Array
    // (
    //     [email] => lakshay.bhalla@virtuos.com
    //     [phone] => 9268519782
    //     [payment_mode] => BOTH
    //     [promotional_mode] => EMAIL
    //     [language] => EN 
    //     [timming] => 12to3
    // );
    public static function addNotes($log_msg,$id){
      if($id!=null || $id>0){
        $contact = RNCPHP\Contact::fetch($id);
        $ncount = count($contact->Notes);
        if ($ncount == 0) {
                $contact->Notes = new RNCPHP\NoteArray();
              }
              $contact->Notes[$ncount] = new RNCPHP\Note();
              $contact->Notes[$ncount]->Channel = new RNCPHP\NamedIDLabel();
              $contact->Notes[$ncount]->Channel->LookupName = "E-mail";
              $contact->Notes[$ncount]->Text = $log_msg." was added on ".date('Y-m-d h:i A');
              $contact->save();
      }
    }

    public function UpdatePreferences($data)
    {
        
        try {
            $context                     = RNCPHP\ConnectAPI::getCurrentContext();
            $context->ApplicationContext = "updateCP";
            // Array
            // (
            //     [email] => lakshay.bhalla@virtuos.com
            //     [phone] => 8076567584
            //     [payment_mode] => both
            //     [promotional_mode] => email
            //     [language] => http_persistent_handles_ident()    
            //     [timming] => 12to3
            //     [contact_id] => 4880659
            // )
            
            // Fields of the form
            $pref_lang        = $data["language"];
            $pref_payment     = $data["payment_mode"];
            $pref_promotional = $data["promotional_mode"];
            $timings          = $data["timming"];
            $email_add        = $data["email"];
            $alt_phone        = $data["phone"];
            $contact_id       = $data["contact_id"];
            $primary_mobile   = $data["real_mob"];
            // vars
            $time_id; $isLangPresent = false; $isPayPresent = false; $isProPresent = false; $isTimingPresent = false; $isPrimaryPresent = false; $lang_menu;
            $msg = "Email: ".$email_add.", Phone: ".$primary_mobile.", Alternate Phone: ".$alt_phone.", Payment: ".$pref_payment.", Promotional: ".$pref_promotional.", Timings: ".$timings;
            self::addNotes($msg,$contact_id);
      //Check for Parameters

      if(strlen($timings)>0){
                $isTimingPresent = true;
              if($timings == "9to12" || $timings == "9AM_12PM"){
                  $time_id = 217;
              }
              else if($timings == "12to3" || $timings == "12PM_3PM"){
                  $time_id = 218;
              }
              else if($timings == "3to7" || $timings == "3PM_7PM"){
                  $time_id = 219;
              }
              else{
                $isTimingPresent=false;
              }
      }
      if(strlen($primary_mobile)>0){
        $isPrimaryPresent = true;
      }

      if(strlen($pref_lang)>0){
            $isLangPresent = true;
            switch ($pref_lang) {
                case 'EN':
                        $lang_menu = "English";
                    break;
                case 'HI':
                        $lang_menu = "Hindi";
                    break;
                case 'TA':
                        $lang_menu = "Tamil";
                    break;
                case 'TE':
                        $lang_menu = "Telugu";
                    break;
                case 'MA':
                        $lang_menu = "Marathi";
                    break;
                case 'ML':
                        $lang_menu = "Malayalam";   
                    break;
                case 'KN':
                        $lang_menu = "Kannada";
                    break;
                default:
                        $lang_menu = "English";
                    break;
            }
      }
      if(strlen($pref_payment)>0){
            $isPayPresent = true;
      }
      if(strlen($pref_promotional)>0){
            $isProPresent = true;
      }

      // Check for Contact ID

      if(strlen($contact_id)>0){
          $contact = RNCPHP\Contact::fetch($contact_id);
      }
      else if($isPrimaryPresent){
            $res = RNCPHP\ROQL::query( "SELECT Contact.ID from Contact where Contact.Phones.Number = '".$isPrimaryPresent."' and Contact.Phones.PhoneType.LookupName = 'Mobile Phone'" )->next();
            while($contax = $res->next()) {
                $contact_id = $contax["ID"];
            }
            $contact = RNCPHP\Contact::fetch($contact_id);
      }
      else{
        $error = array("statusCode"=>"ER","Message"=>"Contact ID or Primary Mobile Number is not Specified in the Request. Atleast one of them is required.");
        print_r(json_encode($error,true));
      }
      
            // Email address is not specified by the Customer

            if (strlen($alt_phone) != 0) {
                
                $contact->Phones[0]                        = new RNCPHP\Phone();
                $contact->Phones[0]->PhoneType             = new RNCPHP\NamedIDOptList();
                $contact->Phones[0]->PhoneType->LookupName = 'Home Phone';
                $contact->Phones[0]->Number                = $alt_phone;
                            
            } 
            if (strlen($email_add) != 0) {
                $contact->Emails[0]->Address = $email_add;    
                
            }
                // Setting up Payment Menu
                if ($isPayPresent) {
                    $pay_menu                           = new RNCPHP\NamedIDLabel();
                    $pay_menu->LookupName               = $pref_payment;
                    $contact->CustomFields->c->pay_mode = $pay_menu;
                }
                // Setting up Promo menu
                if ($isProPresent) {
                    $pro_menu                             = new RNCPHP\NamedIDLabel();
                    $pro_menu->LookupName                 = $pref_promotional;
                    $contact->CustomFields->c->promo_mode = $pro_menu;
                }
                // Setting up Lang menu
                if ($isLangPresent) {
                    $the_lang                               = new RNCPHP\NamedIDLabel();
                    $the_lang->LookupName                   = $lang_menu;
                    $contact->CustomFields->c->pref_language = $the_lang;
                }
                
                if($isTimingPresent){
                    $contact->CustomFields->c->pref_time->ID = $time_id;
                }
                else{
                  $contact->CustomFields->c->pref_time = null;
                }
            
            
            $contact->save();
            $success_mesg = array(
                "statusCode" => "SR",
                "Message" => "Preferences Updated for the Customer."
            );
            return json_encode($success_mesg, true);
            
            
        }
        catch (Exception $ex) {
            $error = array(
                "statusCode" => "EX",
                "Message" => $ex->getMessage()
            );
            return json_encode($error, true);
        }
        
    }

      function getImpData($data){
          $array_response = array();
          if(strlen($data)>0){
               $contact = RNCPHP\Contact::fetch($data);
               $array_response["pan"] = strtoupper($contact->CustomFields->c->pan_number);
               $array_response["gst"] = strtoupper($contact->CustomFields->c->gst_in_number);
               $array_response["adhaar"] = strtoupper($contact->CustomFields->c->adhaar_number);
               $array_response["bank"] = strtoupper($contact->CustomFields->c->bank_ac_number);
          }
          if(count($array_response)>0){
            $final_response = array("statusCode" => "SR",
                    "Message" => "Data Found",
                    "data"=>$array_response);
            return $final_response;
          }
          else{
            $success_mesg = array(
                    "statusCode" => "ER",
                    "Message" => "No Data Found",
                    "data"=>null
            );
                return $success_mesg;
          }
      }
}