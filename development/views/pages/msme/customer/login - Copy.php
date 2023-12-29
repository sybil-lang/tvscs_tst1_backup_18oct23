<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="tvs_header.php" clickstream="employee-login"/>
<?php
if($_POST['btn_action']=="Login"){
	$email=$_POST['email'];
	$password=$_POST['password'];
	$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_CUST_TYPE_CUSTOMER);
	$report_id=$msg->Value;
	if($report_id>0){
		$filter=array('Email'=>$email,'Password'=>$password);
		$contact_result=report_result($report_id,$filter);
		$contact_id=$contact_result[0]['Contact ID'];
		$first_name=$contact_result[0]['First Name'];
		$last_name=$contact_result[0]['Last Name'];
		$savedpassword=$contact_result[0]['Password'];
		if(strlen($contact_id) and $contact_id>0){
			$contact=RightNow\Connect\v1_3\Contact::fetch($contact_id);
			if($password==$savedpassword){
				//loggedin
				$bundle=array("sess_contact_id"=>$contact_id,"sess_first_name"=>$first_name,"sess_last_name"=>$last_name,"sess_contact_type"=>'Internal Employee',"sess_email"=>$email);
				$CI->session->setSessionData(array("previouslySeenEmail"=>$bundle));
				/*Store Data in session ends here*/
				header("Location: /app/msme/customer/dashboard");
	  			exit;
			}
			else{
				//login failed
				$bundle=array('error_message'=>'Invalid Login. Try again.');
				$CI->session->setSessionData(array('previouslySeenEmail'=>$bundle));
				header("Location: /app/msme/customer/login");
	  			exit;
			}
			
		}
		else{
			//login failed
			$bundle=array('error_message'=>'Invalid Login. Try again.');
			$CI->session->setSessionData(array('previouslySeenEmail'=>$bundle));
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
			<input type="text" name="mobile" id="mobile" placeholder="Mobile" value="" class="textinputpwd" maxlength="10" /><br/>
			<input type="submit" class="formloginbtn" value="Send OTP" onClick="return checkotp();">
		  </p>
          <p>
            <input type="otp_text" name="otp_text" id="password" placeholder="OTP" value="" class="textinputuser" maxlength="6"/><br/>
          </p>
		  <div>
           <input type="submit" class="formloginbtn" value="LOGIN" onClick="return checklogin();">
           <input type="hidden" name="btn_action" value="Login">
           <input type="hidden" name="usertype" value="Customer"/>
            <p class="link"><a href="/app/msme/forgot_password">Forgot Password</a></p>
          </div>
          <div class="clearfix"></div>

        </div>
      </form>
    </div>
