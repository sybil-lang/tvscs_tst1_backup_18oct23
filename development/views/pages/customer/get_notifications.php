<html>

<head>
</head>

<body>
	<?php
	$msg = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_LOAN_NOTIFICATIONS);
	$report_id = $msg->Value;



	$CI = &get_instance();
	$CI->load->helper('report');
	checkCustomerType('customer');




	//$report_id = '1000018';
	//$bundle=$CI->session->getSessionData("previouslySeenEmail");
	$contact_id = $CI->session->getProfileData("c_id");
	//$contact_id=$bundle['sess_contact_id'];
	//$filter=array('Contact ID'=>7);
	$filter = array('Contact ID' => $contact_id);
	$response = report_result($report_id, $filter);
	$notifications_count = count($response);
	echo "<h2>Notifications Details</h2><br><br>";
	date_default_timezone_set("Asia/Kolkata");
	echo "<table id='notification-page' style='font-family: arial, sans-serif;border-collapse: collapse;width: 100%;'>";
	if ($notifications_count) {
		$todaytime = gmmktime(gmdate("H"), gmdate("i"), gmdate("s"), gmdate("n"), gmdate("j"), gmdate("Y"));
		for ($i = 0; $i < 0; $i++) {
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
			// echo "<table style='font-family: arial, sans-serif;border-collapse: collapse;width: 100%;'>";

			if (!empty($response[$i]['Bounce Date'])) {
				echo "<tr style='background-color: #dddddd;'><td style='border: 1px solid #dddddd;text-align:left;padding: 8px;'>Your Bounce Date is " . $response[$i]['Bounce Date'] . " for Agreement No " . $response[$i]['Agreement No'] . "</td></tr>";
			}

			if (!empty($response[$i]['Insurance Renewal Date'])) {
				echo "<tr><td style='border: 1px solid #dddddd;text-align:left;padding: 8px;'>Your Insurance Renewal Date is " . $response[$i]['Insurance Renewal Date'] . " for Agreement No " . $response[$i]['Agreement No'] . "</td></tr>";
			}

			if (!empty($response[$i]['Receipt Date'])) {
				echo "<tr style='background-color: #dddddd;'><td style='border: 1px solid #dddddd;text-align:left;padding: 8px;'>Your Receipt Date is " . $response[$i]['Receipt Date'] . " for Agreement No " . $response[$i]['Agreement No'] . "</td></tr>";
			}

			if (!empty($response[$i]['Agreement No'])) {
				echo "<tr><td style='border: 1px solid #dddddd;text-align:left;padding: 8px;'>Your Presentation Date is " . $response[$i]['Presentation Date'] . " for Agreement No " . $response[$i]['Agreement No'] . "</td></tr>";
			}


			//echo "</table>";
		}
	} else {
		// echo "<tr><th>No Notification Found</th></tr>";
	}
	echo "</table>";
	?>
	<div id='notification-page2'></div>
	<style type="text/css">
		body {
			font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif;
			color: #34495e;
			-webkit-font-smoothing: antialiased;
			line-height: 1.6em;
		}

		p {
			margin: 0;
		}

		.notice {
			position: relative;
			margin: 1em;
			background: #F9F9F9;
			padding: 1em 1em 1em 2em;
			border-left: 4px solid #DDD;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.125);
		}

		.notice:before {
			position: absolute;
			top: 50%;
			margin-top: -17px;
			left: -17px;
			background-color: #DDD;
			color: #FFF;
			width: 30px;
			height: 30px;
			border-radius: 100%;
			text-align: center;
			line-height: 30px;
			font-weight: bold;
			font-family: Georgia;
			text-shadow: 1px 1px rgba(0, 0, 0, 0.5);
		}

		.info {
			border-color: #0074D9;
		}

		.info:before {
			content: "i";
			background-color: #0074D9;
		}

		.success {
			border-color: #2ECC40;
		}

		.success:before {
			content: "√";
			background-color: #2ECC40;
		}

		.warning {
			border-color: #FFDC00;
		}

		.warning:before {
			content: "!";
			background-color: #FFDC00;
		}

		.error {
			border-color: #FF4136;
		}

		.error:before {
			content: "X";
			background-color: #FF4136;
		}

		.z-content-inner {
			height: fit-content !important;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function() {
			// var contactid= '<?php echo $contact_id; ?>';
			var notificatCount = '<?php echo $notifications_count ?>';
			if (notificatCount) {
				document.getElementById('notification-page').innerHTML = "";
			}
			if (contactid) {

				// var agreements=[];
				// var BounceNotifications=[];
				// var BounceNotifications1=[];
				// var BounceNotifications2=[];
				// var BounceNotifications3=[];
				// var BounceNotifications4=[];
				// var BounceNotifications5=[];


				$.post("/cc/AjaxCustom/agreements", {
						contactid: contactid
					})
					.done(function(data) {

						// console.log(JSON.parse(data));
						dataa = JSON.parse(data)
						console.log("data from agreemnt",dataa);
						if (dataa.length > 0) {
							for (var k = 0; k < dataa.length; k++) {
								///RC pending notification
								// $.post("/cc/AjaxCustom/PNTNotification", {
								// 		agg: dataa[k]
								// 	})
								// 	.done(function(data) {
								// 		if (data.includes('AGREEMENTNO')) {
								// 			console.log('API response from PNTNotification view', data);

								// 			d = '';
								// 			d = JSON.parse(data);
								// 			// BounceNotifications5.push(d);EMI
								// 			document.getElementById('notification-page').innerHTML += "<div class='notification-item-read notice info'><h5 class='item-title'>Hi " + d[0]['FIRST_NAME'] + ",Your EMI of Rs." + d[0]['EMI'] + " is scheduled for ECS clearance on " + d[0]['NEXT_DUE_DATE'] + ". Please maintain sufficient balance in your bank account.</h5></div><li class='divider'></li>"
								// 			// d=JSON.parse(d);

								// 			// console.log(BounceNotifications5);
								// 		}
								// 	});

								// $.post("/cc/AjaxCustom/RC_PendingNotification", {
								// 		agg: dataa[k]
								// 	})
								// 	.done(function(data) {
								// 		console.log('testdata rc', data);
								// 		//if (data.includes('FIRSTNAME')) {
								// 		console.log("RC_PendingNotification");
								// 		d = '';
								// 		d = JSON.parse(data);
								// 		console.log('parsed data', d);
								// 		// BounceNotifications.push(d);
								// 		document.getElementById('notification-page').innerHTML += "<div class='notification-item-read notice info'><h5 class='item-title'>Hi " + d[0]['APPLICANT_NAME'] + ", Your Post disbursal document (PDD) is pending since " + d[0]['FILE_AUTHORISATION_DATE'] + ".Please mail a copy of your vehicle registration certificate (RC) to helpdesk@tvscredit.com </h5></div><li class='divider'></li>"
								// 		// d=JSON.parse(d);

								// 		// console.log(RC_PendingNotification);
								// 		//}

								// 	});


								// $.post("/cc/AjaxCustom/InsuranceNotification", {
								// 		agg: dataa[k]
								// 	})
								// 	.done(function(data) {
								// 		console.log('testdata', data);
								// 		if (data.includes('FIRSTNAME')) {
								// 			console.log("under testdata if");
								// 			d = '';
								// 			d = JSON.parse(data);
								// 			// BounceNotifications.push(d);
								// 			document.getElementById('notification-page').innerHTML += "<div class='notification-item-read notice info'><h5 class='item-title'>Hi " + d[0]['FIRSTNAME'] + ",Your TVS two-wheeler insurance has been renewed.<a id = 'id_insurance_notify_1' href='https://tvscs--tst1.custhelp.com/app/customer/selfserviceview' style='color:blue; padding:5px;'>Click here to download the insurance document</a></h5></div><li class='divider'></li>"
								// 			// d=JSON.parse(d);

								// 			$('#id_insurance_notify_1').click(function(){
								// 									//Some code
								// 									console.log("i am clicked");
								// 									localStorage.setItem("insu_noti_1", "1");
								// 								});

								// 			// console.log(InsuranceNotifications);
								// 		}

								// 	});


								// $.post("/cc/AjaxCustom/BounceNotification", {
								// 		agg: dataa[k]
								// 	})
								// 	.done(function(data) {
								// 		console.log('data1', data);
								// 		if (data.includes('AGREEMENTNO')) {
								// 			d = '';
								// 			d = JSON.parse(data);
								// 			// BounceNotifications.push(d);
								// 			document.getElementById('notification-page').innerHTML += "<div class='notification-item-read notice info'><h5 class='item-title'>Hi " + d[0]['FIRST_NAME'] + ",Your EMI of Rs. " + d[0]['EMI'] + " for the month of " + d[0]['DUE_MONTH_YEAR'] + " has bounced due to insufficient balance in your account. Please pay immediately to avoid penalty charges.  <a href='https://pguat.tvscredit.com/Home/Index' style='color:black; padding:0px;'>Pay now!</a>. Please ignore if it is already paid.</h5></div><li class='divider'></li>"
								// 			// d=JSON.parse(d);

								// 			// console.log(BounceNotifications);
								// 		}

								// 	});

								// $.post("/cc/AjaxCustom/MandateRejectNotification", {
								// 		agg: dataa[k]
								// 	})
								// 	.done(function(data) {
								// 		console.log('data2', data);

								// 		if (data.includes('AGREEMENTNO')) {
								// 			d = '';
								// 			d = JSON.parse(data);
								// 			// BounceNotifications1.push(d);
								// 			document.getElementById('notification-page').innerHTML += "<div class='notification-item-read notice info'><h5 class='item-title'>Hi " + d[0]['FIRST_NAME'] + ",Your ECS mandate for your TVS Credit Loan a/c no.-" + d[0]['AGREEMENTNO'] + " has been declined by your banker due to " + d[0]['REJECTION_REASON'] + ". Please contact our customer care for any queries.</h5></div><li class='divider'></li>"
								// 			// d=JSON.parse(d);

								// 			// console.log(BounceNotifications1);
								// 		}
								// 	});
								$.post("/cc/AjaxCustom/NOCPendingNotification", {
										agg: dataa[k]
									})
									.done(function(data) {
										if (data.includes('AGREEMENTNO')) {
											console.log('data3', data);

											d = '';
											d = JSON.parse(data);
											// BounceNotifications2.push(d);
											document.getElementById('notification-page').innerHTML += "<div class='notification-item-read notice info'><h5 class='item-title'>Hi " + d[0]['FIRST_NAME'] + ", Your TVS Credit loan-" + d[0]['AGREEMENTNO'] + " has been closed. To process your NOC, please mail a copy of your vehicle registration certificate (RC) to helpdesk@tvscredit.com or upload a copy of the RC on the Saathi App.Upload the RC copy here! <a href='https://tvscs--tst1.custhelp.com/app/raisequery' style='color:black;padding:0px;'>(https://tvscs--tst1.custhelp.com/app/raisequery)</a></h5></div><li class='divider'></li>"
											// d=JSON.parse(d);

											// console.log(BounceNotifications2);
										}
									});
								$.post("/cc/AjaxCustom/MandateSuccessNotification", {
										agg: dataa[k]
									})
									.done(function(data) {
										if (data.includes('AGREEMENTNO')) {
											console.log('data4', data);

											d = '';
											d = JSON.parse(data);
											// BounceNotifications3.push(d);
											document.getElementById('notification-page').innerHTML += "<div class='notification-item-read notice info'><h5 class='item-title'>Hi " + d[0]['FIRST_NAME'] + ",Your NACH mandate for " + d[0]['BANK_NAME'] + " has been set up under mandate no. " + d[0]['MANDATE_NUM'] + " on " + d[0]['MANDATE_DATETIME'] + ".</h5></div><li class='divider'></li>"
											// d=JSON.parse(d);

											// console.log(BounceNotifications3);
										}
									});
								// $.post("/cc/AjaxCustom/ClearedNotification", {
								// 		agg: dataa[k]
								// 	})
								// 	.done(function(data) {
								// 		console.log('data5', data);
								// 		if (data.includes('AGREEMENTNO')) {


								// 			d = '';
								// 			d = JSON.parse(data);
								// 			// BounceNotifications4.push(d);
								// 			document.getElementById('notification-page').innerHTML += "<div class='notification-item-read notice info'><h5 class='item-title'>Hi " + d[0]['FIRST_NAME'] + ",Thank you for making a payment of Rs." + d[0]['EMI_RECD'] + " towards your loan account no." + d[0]['AGREEMENTNO'] + ".This payment will reflect on your account within two working days. Your payment reference number is " + d[0]['PAY_REF_ID'] + "</h5></div><li class='divider'></li>"
								// 			// d=JSON.parse(d);

								// 			// console.log(BounceNotifications4);
								// 		}
								// 	});


								// $.post("/cc/AjaxCustom/BirthdayNotification", {
								// 		contactid: dataa[k]
								// 	})
								// 	.done(function(data) {
								// 		//console.log(k);
								// 		if (k == 0) {
								// 			if (data.includes('FIRST_NAME')) {
								// 				console.log('data6', data);

								// 				d = '';
								// 				d = JSON.parse(data);
								// 				// BounceNotifications5.push(d);EMI
								// 				document.getElementById('notification-page').innerHTML += "<div class='notification-item-read notice info'><h5 class='item-title'>Happy Birthday " + d[0]['FIRST_NAME'] + "! May the days ahead of you be filled with prosperity, good health and success. Enjoy your day!</h5></div><li class='divider'></li>"
								// 				// d=JSON.parse(d);

								// 				// console.log(BounceNotifications5);
								// 			}
								// 		}
								// 	});



								$.post("/cc/AjaxCustom/WelcomeLetterNotification", {
										agg: dataa[k]
									})
									.done(function(data) {
										if (data.includes('AGMTNO')) {
											console.log('data6', data);

											d = '';
											d = JSON.parse(data);
											// BounceNotifications5.push(d);EMI
											document.getElementById('notification-page').innerHTML += "<div class='notification-item-read notice info'><h5 class='item-title'>Welcome to the TVS Credit family! Hi " + d[0]['FIRST_NAME'] + ",Your welcome kit for loan a/c no. " + d[0]['AGMTNO'] + ",containing key information has been sent to your registered email id. CTA: View your loan details here! (Customer portal Dashboard page)</h5></div><li class='divider'></li>"
											// d=JSON.parse(d);

											// console.log(BounceNotifications5);
										}
									});


							}
						}
					});
			}
		});
	</script>
</body>

</html>