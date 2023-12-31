<?php
namespace Custom\Widgets\login;

class DealerResetPassword extends \RightNow\Widgets\ResetPassword {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
        if($parmString = \RightNow\Utils\Url::getParameter('cred'))
        {
            \RightNow\Utils\Url::redirectIfPageNeedsToBeSecure();

            $this->data['js']['resetString'] = $parmString;
            $parmString = \RightNow\Api::ver_ske_decrypt($parmString);
            // token should be in the form: 'c_id/expire_date'.
            // (with an optional /login if the contact doesn't have a login)
            // (and an optional email address if multiple contacts share the same email [CFG_OPT_DUPLICATE_EMAIL])
            list($contactID, $expire, $loginRequired, $sharedEmail) = explode('/', $parmString);

            if($expire && ($contactID || $sharedEmail))
            {
                $contactID = intval($contactID);
                $expire = intval($expire);
                //contact without a login: put login Input widget in the form.
                $this->data['loginRequired'] = ($loginRequired) ? true : false;

                if($expire > time())
                {
                    if($contactID === 0 && $sharedEmail)
                    {
                        //creating a new contact for a shared email
                        return;
                    }
                    else
                    {
                        $contact = $this->CI->model('Contact')->get($contactID)->result;
                        //valid contact found
                        if($contact && isset($contact->Emails[0]->Address))
                        {
                            $contactType = $contact->ContactType->ID;
                            if($contactType == "2"){
                                $url = \RightNow\Utils\URL::getOriginalUrl(true);
                                if(!strpos($url,"dealer")){
                                    $urlArr = explode("app/",$url);
                                    $urlFront = $urlArr[0]."app/dealer/";
                                    $newUrl = $urlFront.$urlArr[1];
                                    \RightNow\Utils\Framework::setLocationHeader($newUrl);
                                }
                            }
                            //Only two valid cases to display the password form:
                            //(1) if they don't have a login then display the login field in addition to pw form: for finishing account creation
                            if(!$contact->Login && $this->data['loginRequired'])
                                return;
                            //(2) they came from reset passwd link: if the db value matches the email parm value, display the form
                            if($contact->PasswordEmailExpirationTime === $expire)
                                return;
                        }
                    }
                }
            }
        }
        echo '<br/>' . \RightNow\Utils\Config::getMessage(LINK_ACCESS_PAGE_EXPIRED_CMD);
        echo '<br/>' . sprintf(\RightNow\Utils\Config::getMessage(REQ_PASSWD_RESET_MSG_PLS_VISIT_HREF_MSG), \RightNow\Utils\Config::getConfig(CP_ACCOUNT_ASSIST_URL, 'RNW_UI'), \RightNow\Utils\Config::getMessage(ACCOUNT_ASSISTANCE_LBL));
        return false;
    }

    /**
     * Overridable methods from ResetPassword:
     */
    // function performResetPassword($parameters)

    /**
     * Reset password Ajax handler. Echos out JSON encoded result
     * @param array|null $parameters Post parameters
     */
    function performResetPassword($parameters)
    {
        \RightNow\Libraries\AbuseDetection::check();
        $data = json_decode($parameters['form']);
        if(!$data)
        {
            \RightNow\Utils\Framework::writeContentWithLengthAndExit(json_encode(\RightNow\Utils\Config::getMessage(JAVASCRIPT_ENABLED_FEATURE_MSG)), 'application/json');
        }
        $data[1] = clone $data[0];
        $data[0]->name = "Contact.NewPassword";
        $result = $this->CI->model('Field')->resetPassword($data, $parameters['pw_reset']);
        $jsonResult = $result->toJson();
        $contactId = $result->result["transaction"]["contact"]["value"];
        $contact = \RightNow\Connect\v1_3\Contact::fetch($contactId);
        $loginResult = $this->CI->model('custom/Login')->doDealerLogin($contact->Login, $data[0]->value, $contact->ContactType->LookupName, "", "", "")->result;
        $this->echoJSON($jsonResult);
        //$this->echoJSON($this->CI->model('Field')->resetPassword($data, $parameters['pw_reset'])->toJson());
    }
}