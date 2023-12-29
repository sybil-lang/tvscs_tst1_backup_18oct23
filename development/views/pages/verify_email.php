<rn:meta title="TVS Credits | Verify Email" template="standard.php" clickstream="portal-verify" clickstream="EmailVerify" login_required="false"/>
<style type="text/css">
	#notfound{
		margin-top: -100px !important;
	}
</style>
<?php
$c_id = $_GET["id"];
$isValid = false;
$isEmailVerified = false;
if(strlen($c_id)>0 && ($c_id !=null )&& preg_match('/^\d+$/', $c_id)>0){
	// echo $c_id;

	date_default_timezone_set('Asia/Kolkata');
	$dateTime = date('m/d/Y h:i:s a', time());
	// print_r("Now: ".$dateTime);
	// echo "<br/>";
	$context = RightNow\Connect\v1_4\ConnectAPI::getCurrentContext();
	$context->ApplicationContext = "test";
	$contact = RightNow\Connect\v1_4\Contact::fetch($c_id);
	// print_r("<br/>".$contact->Emails[0]->Address);
	$temp_email = $contact->CustomFields->c->temp_email;
	$Expiry_Timestamp = $contact->CustomFields->c->evalexptime;
	$Expiry_Time = date('m/d/Y h:i:s a',$Expiry_Timestamp);
	// print_r("<br/>Exp: ".$Expiry_Time);

	if(strlen($temp_email)>0 && $temp_email!=null){
		// echo "<br>inside 1st if";
		if(strtotime($dateTime) < strtotime($Expiry_Time)){
			$alreadyOpened = $contact->CustomFields->c->evalflag;
			if($alreadyOpened){
				header("Location: /app/error404");
			}
			// echo "<br>inside 2nd if";
			$isValid=true;
			$contact->Emails[0]->Address = $temp_email;
			$contact->CustomFields->c->temp_email = null;
			$contact->CustomFields->c->evalflag = 1;
			$contact->save();
			$isEmailVerified = true;
		}
		else if(strtotime($dateTime) > strtotime($Expiry_Time)){
			// echo "<br>inside 2nd else";
			$isEmailVerified = false;
		}
	}
	else{
		echo "<h3 class='exc-msg'>Invalid Request</h3>";
	}
}
else{
	echo "<h3 class='exc-msg'>No contact id found or Invalid Contact Id</h3>";
}
?>
<link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/euf/assets/css/error-style.css">
<? if($isValid){ ?>
<div class="row main-content">

		<div class="my-card single">
			<?php if($isEmailVerified){ ?>
				<style type="text/css">
					.notfound .notfound-404>div:first-child{
						background:#13ad00;
					}
				</style>
			<!-- <h3>Your Email Verification is Success. <span style='font-size:30px;'>&#128521;</span></h3> -->
			<div id="notfound">
				<div class="notfound">
					<div class="notfound-404">
						<div></div>
						<h1 style="color:white !important;">&#10004;</h1>
					</div>
					<h2>Email Verification Success</h2>
					<p>Your Email Address has been updated successfully.</p>
				</div>
			</div>
		<? } else { ?>
			<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<div></div>
				<h1>&#33;</h1>
			</div>
			<h2>Email Verification Failed</h2>
			<p>The Validation Link Expired. Please Try Calling Customer Care.</p>
		</div>
	</div>
<? } 
 }
	else { ?>
				<div id="notfound">
			<div class="notfound">
				<div class="notfound-404">
					<div></div>
					<h1>&#33;</h1>
				</div>
				<h2>Email Verification Failed</h2>
				<p>Please Try Calling Customer Care.</p>
			</div>
		</div>
			
<? } ?>
</div>
</div>