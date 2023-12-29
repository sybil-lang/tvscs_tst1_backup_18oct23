<!-- Top content -->
<rn:theme path="/euf/assets/themes/standard" css="site.css,style.css,style-product.css,customerlogin-style.css"/>
        <div class="top-content <?= $this->classList ?>" id="rn_<?= $this->instanceID ?>">
        <div class="container">
<div class="row">
<div class="col-sm-12 col-md-5 col-xs-12">
<div class="">
<h3 id="ret">Employee Login</h3>

                         
                      
                      <rn:block id="preErrorMessage"/>
							<div id="rn_<?=$this->instanceID;?>_ErrorMessage"></div>
						<rn:block id="postErrorMessage"/>
            <!--        <div class="row">
                        
                        <div class="col-sm-5">-->
                        	
                        	<!--<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Sign up now</h3>
	                            		<p>Fill in the form below to get instant access:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
				                    <form role="form" action="" method="post" class="registration-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">First name</label>
				                        	<input type="text" name="form-first-name" placeholder="First name..." class="form-first-name form-control" id="form-first-name">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-last-name">Last name</label>
				                        	<input type="text" name="form-last-name" placeholder="Last name..." class="form-last-name form-control" id="form-last-name">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-email">Email</label>
				                        	<input type="text" name="form-email" placeholder="Email..." class="form-email form-control" id="form-email">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-about-yourself">About yourself</label>
				                        	<textarea name="form-about-yourself" placeholder="About yourself..." 
				                        				class="form-about-yourself form-control" id="form-about-yourself"></textarea>
				                        </div>
				                        <button type="submit" class="btn">Sign me up!</button>
				                    </form>
			                    </div>
                        	</div>
                   
                        </div>-->
                         <div class="">
    <div id="otp" >
	<form class="custom_log employee_log">
	<div class="note">
	<!--<h3>Enter Sign on portal username and password to log on:
</h3>-->
	</div>
                        	<div class="form-box form-group" id="rn_<?=$this->instanceID;?>_Content">
	                        <!--	<div class="form-top">
	                        		<div class="form-top-left">-->
	                        	<!--		<h3>Login to our site</h3>-->
	                            		
	                        		</div>
	                        		<!--<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
	                          <!--  </div>-->
	                      <!--   <div class="form-bottom">-->
				                    <form role="form" class="login-form">
									<input type="hidden" name="redirect" value="/app/employee/dashboard" />
				                    	<div class="form-group">
				                    		<label for="form-username">Username</label>
				                        	<input type="text" id="rn_<?=$this->instanceID;?>_Username" name="form-username"  class="form-control cust_mobileno" >
				                        </div>
				                        <div class="form-group">
				                        	<label for="form-password">Password</label>
				                        	<input type="password" id="rn_<?=$this->instanceID;?>_Password" name="form-password"  class="form-control cust_mobileno" >
				                        </div>
                                        <br>
                                        	<div align="left">
									  <a href="https://signon.tvscredit.com/" class="forgot-password" target="_blank">Forgot your Password?</a>
								    </div>
										<rn:block id="preSubmit"/>
											 <button type="submit" class="btn btn-primary submit" id="rn_<?=$this->instanceID;?>_Submit" >Sign in</button>
										<rn:block id="postSubmit"/>
				                    </form>
							
									<!--<div class="steps_login">
									<ul class="ul-list">
	<li>
		<div class="note">
		
	<ul>
		<li>Site is best viewed in IE version 11 & above, else use chrome browser. Contact IT-Infra team for any issues in this site. </li>
	</ul>-->
		<!--</div>
	</li>
</ul>
									</div>-->
         </form>
    </div>
			                   <!-- </div>-->
		                    </div>
		                
		                	<!--<div class="social-login">
	                        	<h3>...or login with:</h3>
	                        	<div class="social-login-buttons">
		                        	<a class="btn btn-link-1 btn-link-1-facebook" href="#">
		                        		<i class="fa fa-facebook"></i> Facebook
		                        	</a>
		                        	<a class="btn btn-link-1 btn-link-1-twitter" href="#">
		                        		<i class="fa fa-twitter"></i> Twitter
		                        	</a>
		                        	<a class="btn btn-link-1 btn-link-1-google-plus" href="#">
		                        		<i class="fa fa-google-plus"></i> Google Plus
		                        	</a>
	                        	</div>
	                        </div>-->
	                        
                        </div>



                        <!-- End Dive -->
                    </div>
    <div class="col-sm-12 col-md-7 col-xs-12">
<div class="customer_loginimg">
<figure>
    <div class="image-blurred-edge2">   
</div>
<!--<img src="/euf/assets/themes/standard/Images-new/employee.png" class="responsive" alt="customer_loginimg">-->
</figure>
</div>
                    
                </div>
            </div>
            
        </div>
</div>
