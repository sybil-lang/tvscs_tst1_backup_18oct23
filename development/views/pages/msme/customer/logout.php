<rn:meta title="logout" template="standardlogincust.php" clickstream="logout_form" login_required="false"/>
<?php

if(getUrlParm("msg_code")=="1"){

		$CI=&get_instance();
		$userData = $CI->session->getSessionData('userProfile');
		if(isset($userData) && !empty($userData)){
			  //$this->session->getSessionData($msg); // execution over, now set it to null
			  $bundle=array('userProfile' => array());
			  //$userData['userProfile'] = null;
			  $CI->session->setSessionData($bundle);
			}
        $CI->model('Contact')->doLogout('', '/app/msme/customer/incon');
        header("location:/app/msme/customer/incon");
        exit();
}
else{
	// require_once(get_cfg_var('doc_root').'/include/ConnectPHP/Connect_init.phph');
	// initConnectAPI();
	// $retval = RightNow\Libraries\AbuseDetection::check();
	/*Store Data in session starts here*/
	$CI=&get_instance();
	$bundle=array("sess_contact_id"=>'',"sess_first_name"=>'',"sess_last_name"=>'',"sess_contact_type"=>'',"sess_email"=>'');
	$CI->session->setSessionData(array("previouslySeenEmail"=>$bundle));
	/*Store Data in session ends here*/
	header("Location: /app/home");
}
?>