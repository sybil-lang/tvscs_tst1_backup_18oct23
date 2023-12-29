<?php
namespace Custom\Widgets\login;

class DealerEmailCredentials extends \RightNow\Widgets\EmailCredentials {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
        $credentialType = $this->data['attrs']['credential_type'];
        $this->data['js']['request_type'] = 'email' . ucfirst($credentialType);
        if ($credentialType === 'password') {
            //honor config: don't output password form
            //if (!\RightNow\Utils\Config::getConfig(EU_CUST_PASSWD_ENABLED))
            //    return false;

            $this->data['js']['field_required'] = \RightNow\Utils\Config::getMessage(A_USERNAME_IS_REQUIRED_MSG);
        }
        else {
            $this->data['js']['field_required'] = \RightNow\Utils\Config::getMessage(AN_EMAIL_ADDRESS_IS_REQUIRED_MSG);
            if ($previouslySeenEmail = $this->CI->session->getSessionData('previouslySeenEmail')) {
                $this->data['email'] = $previouslySeenEmail;
            }
            else if ($urlParm = \RightNow\Utils\Url::getParameter('Contact.Emails.PRIMARY.Address')) {
                $this->data['email'] = $urlParm;
            }
        }
    }

    /**
     * AJAX endpoint to send an email to a contact containing either their username, or a password reset notification.
     *
     * If $parameters['requestType'] is 'emailPassword' then $parameters['value'] is the contact's username and a password reset will be performed.
     * Otherwise 'value' is the contact's email address and their username will be emailed.
     *
     * @param array|null $parameters An array of key/value pairs.
     */
    function sendEmailCredentials($parameters) {
        \RightNow\Libraries\AbuseDetection::check();
        $contactId = $this->CI->model("Contact")->getIDFromLogin($parameters["value"])->result;
        if(!strlen($contactId)){
            $this->renderJSON(array("message"=>"Your Dealer account has no Email Address"));
        }
        else{
            $method = ($this->data['attrs']['credential_type'] === 'password') ? 'sendResetPasswordEmail' : 'sendLoginEmail';
            $this->renderJSON($this->CI->model('Contact')->$method($parameters['value'])->result);
        }
    }
}