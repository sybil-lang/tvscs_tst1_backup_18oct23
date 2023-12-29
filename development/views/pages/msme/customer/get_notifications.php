<html>
<head>
</head>
<body>
<?php
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_MSME_loan_notification);
$report_id=$msg->Value;

$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');

//$report_id = '1000018';
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$contact_id=$CI->session->getProfileData("c_id");
//$contact_id=$bundle['sess_contact_id'];
//$filter=array('Contact ID'=>7);
$filter = array('Contact ID' => $contact_id);
$response = report_result($report_id,$filter);
$notifications_count = count($response);
echo "<h2>Notifications Details</h2><br><br>";
 date_default_timezone_set("Asia/Kolkata");
if($notifications_count ){
	 $todaytime = gmmktime (gmdate("H") ,gmdate("i") , gmdate("s"), gmdate("n") , gmdate("j") , gmdate("Y") );
		for($i = 0; $i < $notifications_count; $i++) {
			//echo "";
			/*if(!empty($response[$i]['Loan ID'])){
					$loan = \RightNow\Connect\v1_3\CO\Loan::fetch($response[$i]['Loan ID']);

					$loan->PresentationNotificationRead = true;
					$loan->PresentationNotificationReadOn = $todaytime;

					$loan->BounceNotificationRead = true;
					$loan->BounceNotificationReadOn = $todaytime;

					$loan->ReceiptNotificationRead = true;
					$loan->ReceiptNotificationReadOn = $todaytime;

					$loan->InsuranceNotificationRead = true;
					$loan->InsuranceNotificationReadOn = $todaytime;
					$loan->save();
			}*/
			echo "<table style='font-family: arial, sans-serif;border-collapse: collapse;width: 100%;'>";
			
			if(!empty($response[$i]['Bounce Date'])){
				echo "<tr style='background-color: #dddddd;'><td style='border: 1px solid #dddddd;text-align:left;padding: 8px;'>Your Bounce Date is ".$response[$i]['Bounce Date']." for Agreement No ".$response[$i]['Agreement No']."</td></tr>";
			}

			if(!empty($response[$i]['Insurance Renewal Date'])){
				echo "<tr><td style='border: 1px solid #dddddd;text-align:left;padding: 8px;'>Your Insurance Renewal Date is ".$response[$i]['Insurance Renewal Date']." for Agreement No ".$response[$i]['Agreement No']."</td></tr>";
			}
			
			if(!empty($response[$i]['Receipt Date'])){
				echo "<tr style='background-color: #dddddd;'><td style='border: 1px solid #dddddd;text-align:left;padding: 8px;'>Your Receipt Date is ".$response[$i]['Receipt Date']." for Agreement No ".$response[$i]['Agreement No']."</td></tr>";
			}
			
			if(!empty($response[$i]['Agreement No'])){
				echo "<tr><td style='border: 1px solid #dddddd;text-align:left;padding: 8px;'>Your Presentation Date is ".$response[$i]['Presentation Date']." for Agreement No ".$response[$i]['Agreement No']."</td></tr>";
			}
				
			echo "</table>";
			//echo "</table>";
		}
}else{
	echo "<p>No Notification Found</p>";
}
?>
</body>
</html>