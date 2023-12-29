<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="tvs_header.php" clickstream="employee-login"/>
<?php
if($_POST['send_otp']=="Send OTP"){
	$mobile=$_POST['mobile'];
	$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER);
	$report_id=$msg->Value;
	if($report_id>0){
		$filter=array('Mobile'=>$mobile);
		$contact_result=report_result($report_id,$filter);
		$contact_id=$contact_result[0]['Contact ID'];
		$first_name=$contact_result[0]['First Name'];
		$last_name=$contact_result[0]['Last Name'];
		$savedpassword=$contact_result[0]['Password'];
		if(strlen($contact_id) and $contact_id>0){
			$contact=RightNow\Connect\v1_3\Contact::fetch($contact_id);
			
			$otp=implode('',randomGen(0,9,6));
			$time = time();
			$last_time = ($time - ($time % (15 * 60)));
			$in15mins =  $last_time+ (15 * 60);
			$startdatetime=date('Y-m-d H:i');
			$enddatetime=date('Y-m-d H:i', $in15mins);
			$returnarray=json_encode(array('mobile'=>$mobile,'OTP'=>$otp,'startdatetime'=>$startdatetime,'enddatetime'=>$enddatetime));
			
			$contact->CustomFields->c->otp=$otp;
			$contact->CustomFields->c->otp_generated_on=strtotime($startdatetime);
			$contact->CustomFields->c->otp_generated_till=strtotime($enddatetime);
			$contact->save();
			
			$sms_message=$otp.' is your OTP for loan application with TVS Credit. Please use this OTP within 15 min to complete your enquiry. For further details call 18004252021';
			
			$parameters=array('Vendor'=>'U','Phoneno'=>$mobile,'Message'=>$sms_message,'Purpose'=>'For Login in Customer Portal','CustNo'=>'-');
			
			$response=send_OTP_call('SendSMSExternal', $parameters);
		}
		else{
			//login failed
			$bundle=array('error_message'=>'Invalid Mobile Number. Try again.');
			$CI->session->setSessionData(array('previouslySeenEmail'=>$bundle));
			header("Location: /app/msme/customer/login");
			exit;
		}
	}
}
if($_POST['btn_action']=="LOGIN"){
	$mobile=$_POST['mobile'];
	$otp_text=$_POST['otp_text'];
	$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER);
	$report_id=$msg->Value;
	if($report_id>0){
		$filter=array('Mobile'=>$mobile);
		$contact_result=report_result($report_id,$filter);
		$contact_id=$contact_result[0]['Contact ID'];
		$email=$contact_result[0]['Email Address'];
		$first_name=$contact_result[0]['First Name'];
		$last_name=$contact_result[0]['Last Name'];
		$savedpassword=$contact_result[0]['Password'];
		if(strlen($contact_id) and $contact_id>0){
			$contact=RightNow\Connect\v1_3\Contact::fetch($contact_id);
			$otp=$contact->CustomFields->c->otp;
			$startdatetime=$contact->CustomFields->c->otp_generated_on;
			$enddatetime=$contact->CustomFields->c->otp_generated_till;
			$currentdatetime=strtotime(date('Y-m-d H:i:s'));
			echo "<br><br>$otp_text==$otp==$currentdatetime==<=$enddatetime";
			if(($otp_text==$otp) and ($currentdatetime <=$enddatetime)){
				//loggedin
				$bundle=array("sess_contact_id"=>$contact_id,"sess_first_name"=>$first_name,"sess_last_name"=>$last_name,"sess_contact_type"=>'Customer',"sess_email"=>$email);
				$CI->session->setSessionData(array("previouslySeenEmail"=>$bundle));
				//echo "<br>===1<br>";
				header("Location: /app/msme/customer/dashboard");
				exit;
			}
			elseif(($otp_text==$otp) and ($currentdatetime > $enddatetime)){
				//login failed
				$bundle=array('error_message'=>'OTP Time exceeded. Try again.');
				$CI->session->setSessionData(array('previouslySeenEmail'=>$bundle));
				//echo "<br>===2<br>";
				header("Location: /app/msme/customer/login");
				exit;
			}
			else{
				//login failed
				$bundle=array('error_message'=>'Invalid OTP Entry. Try again.');
				$CI->session->setSessionData(array('previouslySeenEmail'=>$bundle));
				//echo "<br>===3<br>";
				header("Location: /app/msme/customer/login");
				exit;
			}
		}
		else{
			//login failed
			$bundle=array('error_message'=>'Invalid Mobile Number. Try again.');
			$CI->session->setSessionData(array('previouslySeenEmail'=>$bundle));
			//echo "<br>===4<br>";
			header("Location: /app/msme/customer/login");
			exit;
		}
	}
}
$currentsess=$CI->session->getSessionData('previouslySeenEmail');
$Session_Error_Message=$currentsess['error_message'];
?>
<div class="prefix_8 grid_4">
	  <form name="login_form" id="login-form" action="" method="post">
        <div class="formbox">
          <p><strong>ALREADY HAVE AN ACCOUNT?</strong></p>
          	<?php 
			if(strlen($Session_Error_Message)){
				?>
				<div class="error">
				<?php
				echo $Session_Error_Message;
				?>
				</div>
				<?php
				$bundle=array('previouslySeenEmail'=>'');
				$CI->session->setSessionData($bundle);
			}
			?>
		  
          <p>
			<input type="text" name="mobile" id="mobile" placeholder="Mobile" value="<?php echo $_POST['mobile'];?>" class="textinputpwd" maxlength="10" /><br/>
			<input type="submit" name="send_otp" id="send_otp" class="formloginbtn" value="Send OTP" onClick="return checkotp();">
		  </p>
          <p>
            <input type="passsword" name="otp_text" id="otp_text" placeholder="OTP" value="" class="textinputuser" maxlength="6"/><br/>
          </p>
		  <div>
           <input type="submit" name="btn_action" id="btn_action" class="formloginbtn" value="LOGIN" onClick="return checklogin();">
           
           <input type="hidden" name="usertype" value="Customer"/>
            <p class="link"><a href="/app/msme/forgot_password">Forgot Password</a></p>
          </div>
          <div class="clearfix"></div>

        </div>
      </form>
    </div>
