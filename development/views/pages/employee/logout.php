<rn:meta title="" template="tvs_header.php" clickstream="logout_form" login_required="false"/><?php
require_once(get_cfg_var('doc_root').'/include/ConnectPHP/Connect_init.phph');
initConnectAPI();
$retval = RightNow\Libraries\AbuseDetection::check();
/*Store Data in session starts here*/
$CI=&get_instance();
$bundle=array("sess_contact_id"=>'',"sess_first_name"=>'',"sess_last_name"=>'',"sess_contact_type"=>'',"sess_email"=>'');
$CI->session->setSessionData(array("previouslySeenEmail"=>$bundle));
/*Store Data in session ends here*/
header("Location: /app/dealer/login");
?>