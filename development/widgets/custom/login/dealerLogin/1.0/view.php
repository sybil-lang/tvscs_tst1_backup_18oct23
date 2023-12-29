<link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
<div class="widgetbody">
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
 <rn:block id="top"/>
        <rn:block id="preErrorMessage"/>
        <div id="rn_<?=$this->instanceID;?>_ErrorMessage"></div>
        <rn:block id="postErrorMessage"/>
					<!-- Box Start-->
				<div class="">
    <div id="otp" >
	<form class="custom_log dealer_log">
        <h3>dealer login</h3>   
	<!--<div class="note">
	<h3>	  Enter your dealer code and password to sign in</h3>
	</div>-->
							
								<!--	<div class="apollo-image profile-img-card"><img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png"></div>-->
								
							<p>&nbsp;</p>
						<!--		<div class="apollo-register">
									<form class="form-signin" id="apollo-register-form">
										<div class="form-group">
											<input type="text" value="" id="rn_<?=$this->instanceID;?>_Email" class="form-control email" placeholder="Email address">
										</div>

										<div class="form-group">
											<input type="password" value="" class="form-control" placeholder="Password" id="rn_<?=$this->instanceID;?>_NewPassword">
										</div>

										<div class="form-group">
											<input type="password" value="" class="form-control" placeholder="Confirm password">
										</div>


										<p class="apollo-seperator"> about you </p>

										<div class="form-group">
											<input type="text" value="" class="form-control" id="firstName" placeholder="First name">
										</div>

										<div class="form-group">
											<input type="text" value="" class="form-control" id="lastName" placeholder="Last name">
										</div>

										
										<button class="btn btn-lg btn-block btn-primary" type="submit" id="rn_<?=$this->instanceID;?>_RegisterSubmit">Register</button>
									</form>

									<p class="apollo-back"> <a href="#"><i class="icon-arrow-left"></i> back to login</a> </p>
								</div>-->

								 <div class="form-group">
									 <label for="mobile">Dealer Code </label>
									<input type="hidden" name="optionsRadios" value="yes" >
									<input type="hidden" name="redirect" value="/app/dealer/dashboard2" />
									<div id="rn_<?=$this->instanceID;?>_Content">
									
											<input type="text" class="form-control cust_mobileno"  name="dealer_code" id="rn_<?=$this->instanceID;?>_Username" required>
										</div>
                                 </div>

										<div class="form-group">
									    <label for="mobile">Password </label>
											<input type="password" name="dealer_password"  class="form-control cust_mobileno"  id="rn_<?=$this->instanceID;?>_Password" required>
                                            <span class="form-error">Enter Valid Password </span>
										</div>
                                            <a href="/app/utils/dealer/account_assistance#rn:session#" class="forgot-password">Forgot your password?</a><br>
		 								<rn:block id="preSubmit"/>
													<input id="rn_<?=$this->instanceID;?>_Submit" type="submit" class="btn btn-lg btn-signin btn-block btn btn-primary submit" value="Sign in"/>
										<rn:block id="postSubmit"/>
        <!-- <label class="registration">Need an account?   <a href="https://dealerempanelment.tvscs.co.in/DealerRegistration/Register.aspx" class="forgot-password1">   Register here</a></label> -->
        <label class="registration">Need an account?   <a href="https://dealerempanelment.tvscredit.com/DealerRegistration/Register.aspx" class="forgot-password1">   Register here</a></label>
									</form>
								</div>
									<!--<p class="apollo-register-account"> 
									<a href="https://dealerempanelmentuat.tvscs.co.in/DealerRegistration/Default.aspx" class="register-link">Need an account? <strong>Register here </strong><i class="icon-arrow-right"></i></a>
									<br><a href="#" class="password-link"><small>Forgot your password?</small></a> 
									</p>-->
									<!--<p><a href="/app/#rn:config:CP_ACCOUNT_ASSIST_URL##rn:session#">#rn:msg:FORGOT_YOUR_USERNAME_OR_PASSWORD_MSG#</a></p>
									<p class="apollo-register-account"> 
									<!--Line Add by TVSCS Chandru on 15-Feb-2018-->
									<!--<a href="https://dealerempanelmentuat.tvscs.co.in/DealerRegistration/Register.aspx" class="">Need an account? <strong>Register here </strong><i class="icon-arrow-right"></i></a>									
									</p>
									<!--Line Add by TVSCS Chandru on 15-Feb-2018-->
								<!--	<p class="apollo-change-account"> <a href="#"><i class="icon-arrow-left"></i><strong>Not you?</strong> Sign in as a different user</a> </p>
								</div>

								<div class="apollo-forgotten-password">
									<!--<form class="form-signin" id="apollo-forgotten-password-form">
										<div class="form-group">
											<input type="text" required class="form-control email input_width" placeholder="Email address">
										</div>
										<button class="btn btn-lg btn-block btn-primary" type="submit">Reset password</button>
									</form>-->
									
								<!--	<p class="apollo-back"> <a href="#"><i class="icon-arrow-left"></i> back to login</a> </p>
								</div>

								<!--<div class="apollo-logging-in">
									<h2>Welcome back<span class="user-name"></span>!</h2>
									<p><strong>Please wait whilst we securely log you in...</strong></p>

									<p>&nbsp;</p>
								</div>-->

							<!--	<div class="apollo-registering">
									<h2>Thanks<span class="user-name"></span>!</h2>
									<p><strong>We've sent you an activation email, blah blah...</strong></p>
									<p>Nullam ac erat nunc. Donec in orci purus, vel tempor tortor. Integer tincidunt ipsum sed ipsum scelerisque malesuada.</p>
								</div>

								<div class="apollo-password-reset">
									<h2>Check your email</h2>
									<p><strong>We've sent you a link, blah blah...</strong></p>
									<p>Nullam ac erat nunc. Donec in orci purus, vel tempor tortor. Integer tincidunt ipsum sed ipsum scelerisque malesuada.</p>
								</div>
							</div>
						</div> -->

					<!-- Text Under Box -->
	<!--<div id="bottom_text">
		Don't have an account? <a href="#">Sign Up</a><br/>
		Remind <a href="#">Password</a>
	</div>-->
	    <rn:block id="bottom"/>
    </div>
</div>
</div>

		<script src="/euf/assets/themes/standard/js/images.js"></script>
		<script src="/euf/assets/themes/standard/js/md5.js"></script>
		<script src="/euf/assets/themes/standard/js/main.js"></script>

		