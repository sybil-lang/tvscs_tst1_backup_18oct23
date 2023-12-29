<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="employee_header.php" clickstream="dashboard" login_required="true" force_https="true" />
<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$contact_id=$CI->session->getProfileData("c_id");

$employee_code=$CI->session->getProfileData("login");
$fname=$CI->session->getProfileData("first_name");

$lname=$CI->session->getProfileData("last_name");

$name = ucfirst($fname)." ".ucfirst($lname);

$CI->load->helper('report');

checkCustomerType('internal employee');

$msg=\RightNow\Connect\v1_3\MessageBase::fetch(1000039);
$report_id=$msg->Value;
if($report_id>0){
			$filter=array();
			$report_result=report_result($report_id,$filter);
			print_r($report_result);
}
?>
	