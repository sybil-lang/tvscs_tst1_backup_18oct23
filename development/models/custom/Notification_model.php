<?php
namespace Custom\Models;

class Notification_model extends \RightNow\Models\Base
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
    function updateNotification()
    {
			$url_key = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],"/")+1) ;
		//	echo $pos = strpos($url_key,'selfserviceview');
			$nflag = \RightNow\Utils\Url::getParameter('notification');
		//	echo $url_key;
			if($url_key == 'selfserviceview' || $nflag == 1){
					$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_LOAN_NOTIFICATIONS);
					$report_id=$msg->Value;
					$CI=&get_instance();
					$CI->load->helper('report');
					$contact_id=$CI->session->getProfileData("c_id");
					$filter = array('Contact ID' => $contact_id);
					$response = report_result($report_id,$filter);
					$notifications_count = count($response);
					date_default_timezone_set("Asia/Kolkata");
					if($notifications_count ){
						 $todaytime = gmmktime (gmdate("H") ,gmdate("i") , gmdate("s"), gmdate("n") , gmdate("j") , gmdate("Y") );
						 for($i = 0; $i < $notifications_count; $i++) {
								//echo "";
								$flag = false;
								if(!empty($response[$i]['Loan ID'])){
										$loan = \RightNow\Connect\v1_3\CO\Loan::fetch($response[$i]['Loan ID']);
									if(!empty($response[$i]['Presentation Date'])){
										$loan->PresentationNotificationRead = true;
										$loan->PresentationNotificationReadOn = $todaytime;
										$flag = true;
									}
									if(!empty($response[$i]['Bounce Date'])){
										$loan->BounceNotificationRead = true;
										$loan->BounceNotificationReadOn = $todaytime;
										$flag = true;
									}
									if(!empty($response[$i]['Receipt Date'])){
										$loan->ReceiptNotificationRead = true;
										$loan->ReceiptNotificationReadOn = $todaytime;
										$flag = true;
									}
									if(!empty($response[$i]['Insurance Renewal Date'])){
										$loan->InsuranceNotificationRead = true;
										$loan->InsuranceNotificationReadOn = $todaytime;
										$flag = true;
									}
										if($flag){
											$loan->save();
										}
									} //end if
							} //end for
					}
			} // end if
	}
}