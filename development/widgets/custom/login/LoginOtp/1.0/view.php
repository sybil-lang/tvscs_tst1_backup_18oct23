<?php /* Originating Release: August 2016 */ ?>
<!--<div id="rn_<?= $this->instanceID; ?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <div id="rn_<?= $this->instanceID; ?>_Content">
        <rn:block id="preErrorMessage"/>
        <div id="rn_<?= $this->instanceID; ?>_ErrorMessage"></div>
        <rn:block id="postErrorMessage"/>
        <form id="rn_<?= $this->instanceID; ?>_Form" onsubmit="return false;">
            <rn:block id="preUsername"/>
            <label for="rn_<?= $this->instanceID; ?>_Username"><?= $this->data['attrs']['label_username']; ?></label>
            <input id="rn_<?= $this->instanceID; ?>_Username" type="text" maxlength="80" name="Contact.Login" autocorrect="off" autocapitalize="off" value="<?= $this->data['username']; ?>"/>
            <rn:block id="postUsername"/>
<? if (!$this->data['attrs']['disable_password']): ?>
              <rn:block id="prePassword"/>
              <label for="rn_<?= $this->instanceID; ?>_Password"><?= $this->data['attrs']['label_password']; ?></label>
              <input id="rn_<?= $this->instanceID; ?>_Password" type="password" maxlength="20" name="Contact.Password" <?= ($this->data['attrs']['disable_password_autocomplete']) ? 'autocomplete="off"' : '' ?>/>
              <rn:block id="postPassword"/>
<? elseif ($this->data['isIE']): ?>
              <label for="rn_<?= $this->instanceID; ?>_HiddenInput" class="rn_Hidden">&nbsp;</label>
              <input id="rn_<?= $this->instanceID; ?>_HiddenInput" type="text" class="rn_Hidden" disabled="disabled" />
<? endif; ?>
            <br/>
            <rn:block id="preSubmit"/>
            <input id="rn_<?= $this->instanceID; ?>_Submit" type="submit" value="<?= $this->data['attrs']['label_login_button']; ?>"/>
            <rn:block id="postSubmit"/>
            <br/>
        </form>
    </div>
    <rn:block id="bottom"/>
</div>
<p><strong>#rn:msg:LOG_IN_WITH_AN_EXISTING_ACCOUNT_LBL#</strong></p>-->

<div id="rn_<?= $this->instanceID; ?>"   class="<?= $this->classList ?>">
  <div id="rn_<?=$this->instanceID;?>_Content">
    <h3>CUSTOMER LOGIN</h3>
    <!--<ul class="nav nav-pills customer_loginnav">
     <li class="active"><a data-toggle="pill" href="#otp">otp</a></li>
        <li><a data-toggle="pill" href="#login">login</a></li>
      </ul>--><div class="login">
      <rn:block id="preErrorMessage"/>
      <div id="rn_<?= $this->instanceID; ?>_ErrorMessage"></div>
      <div id="rn_<?= $this->instanceID; ?>_ErrorMessage_OTP"></div>
      <rn:block id="postErrorMessage"/>
      <form id="rn_<?= $this->instanceID; ?>_Form custom_log" onsubmit="return false;">
        <input type="hidden" name="redirect" value="/customer/dashboard/" />
        <div class="form-group">
          
        <label for="rn_<?= $this->instanceID; ?>_Mobile">Mobile Number</label>
        <br>
        <input type="text" maxlength="10" min="10"  required class="input" id="rn_<?= $this->instanceID; ?>_Mobile"  name="Contact.Mobile"/>
        <!-- commented the below line for UAT CP OTP disablement -->
        <!-- <a href="#" id="rn_<?= $this->instanceID; ?>_Submit_OTP" class="verifyotp">Verify</a> -->
        </div>
        <div class="form-group">
          <label for="rn_<?= $this->instanceID; ?>_Otp">Password</label><br><input type="password" required class="input" id="rn_<?= $this->instanceID; ?>_Otp" name="Contact.otp" placeholder="Enter the password here" />
          <rn:block id="preSubmit"/>
        </div><br><div class="form-group">
          <input id="rn_<?= $this->instanceID; ?>_Submit" type="submit" value="<?= $this->data['attrs']['label_login_button']; ?>" class="btn btn btn-primary submit pull-left"/>
          <rn:block id="postSubmit"/>
        </div>
      </form>
    </div>
  </div>
  <!--<div class="tab-content">


<div id="login" class="tab-pane fade in active">
<div class="login">
<rn:block id="preErrorMessage"/>
      <div id="rn_<?= $this->instanceID; ?>_ErrorMessage"></div>
<rn:block id="postErrorMessage"/>
<form id="rn_<?= $this->instanceID; ?>_Form custom_log" onsubmit="return false;">
<input type="hidden" name="redirect" value="/customer/dashboard/" />
  <div class="form-group">
  <label for="rn_<?= $this->instanceID; ?>_Mobile">Mobile Number</label><br><input type="text" maxlength="10" min="10"  required class="input" id="rn_<?= $this->instanceID; ?>_Mobile"  name="Contact.Mobile"/>
  </div>
<div class="form-group">
       <label for="rn_<?= $this->instanceID; ?>_Otp">OTP</label><br><input type="password" required class="input" id="rn_<?= $this->instanceID; ?>_Otp" name="Contact.otp" />
<rn:block id="preSubmit"/>
  </div><br><div class="form-group">
          <input id="rn_<?= $this->instanceID; ?>_Submit" type="submit" value="<?= $this->data['attrs']['label_login_button']; ?>" class="btn btn btn-primary submit pull-left"/>
      <rn:block id="postSubmit"/>
  </div>
</form>
</div>

  <!--<div class="social-login">Or sign in with &nbsp;
  <a href="" class="fb"><i class="fa fa-facebook"></i></a>
  <a href="" class="tw"><i class="fa fa-twitter"></i></a>
  <a href="" class="gp"><i class="fa fa-google-plus"></i></a>
  <a href="" class="in"><i class="fa fa-linkedin"></i></a>
  </div>-->
  <!--</div>
  
  <div id="otp" class="tab-pane fade">
  <div class="login">
  
  <rn:block id="preErrorMessage"/>
          <div id="rn_<?= $this->instanceID; ?>_ErrorMessage_OTP"></div>
  <rn:block id="postErrorMessage"/>
  <form id="rn_<?= $this->instanceID; ?>_Form_otp custom_log" onsubmit="return false;">
  <div class="form-group">
      <label for="rn_<?= $this->instanceID; ?>_MobileN">Mobile Number</label><br><input type="text" required class="input" id="rn_<?= $this->instanceID; ?>_MobileN" name="Contact.MobileNumber" maxlength="10" min="10" /></div>
  <!--<li><input type="password" required class="input" placeholder="OTP"/><span class="icon"><i class="fa fa-lock"></i></span></li>
  <li><input type="checkbox" id="check1"> <label for="check1">I accept terms and conditions</label></li>-->

        <!-- <rn:block id="preSubmit"/>
    <div class="form-group">
        <input id="rn_<?= $this->instanceID; ?>_Submit_OTP" type="submit" value="<?= $this->data['attrs']['label_loginOTP_button']; ?>" class="btn btn btn-primary submit pull-left" id="subut"/>
    </div><br>
            <rn:block id="postSubmit"/><br>
    <div class="note"><h3>Steps for login to customer portal</h3>

                
        <ul id="list">
                <li>Step 1: Enter your registered mobile no. under OTP column, Click on send OTP</li>
                <li>Step 2: Enter your mobile no and OTP under Login column, Click on login</li>
        </ul>
                </div>
        
        
</form>
    
</div>

  <!--<div class="social-login">Or sign up with &nbsp;
  <a href="" class="fb"><i class="fa fa-facebook"></i></a>
  <a href="" class="tw"><i class="fa fa-twitter"></i></a>
  <a href="" class="gp"><i class="fa fa-google-plus"></i></a>
  <a href="" class="in"><i class="fa fa-linkedin"></i></a>
  </div>-->
  <!--</div>
  </div>-->
</div>

