<? /* Overriding LoginOtp's view */ ?>
<div id="rn_<?= $this->instanceID; ?>"   class="<?= $this->classList ?>">
  <div id="rn_<?=$this->instanceID;?>_Content">
    <h3>CUSTOMER LOGIN</h3>
    <div class="login">
      <rn:block id="preErrorMessage"/>
      <div id="rn_<?= $this->instanceID; ?>_ErrorMessage"></div>
      <div id="rn_<?= $this->instanceID; ?>_ErrorMessage_OTP"></div>
      <rn:block id="postErrorMessage"/>
      <form id="rn_<?= $this->instanceID; ?>_Form custom_log" onsubmit="return false;">
        <input type="hidden" name="redirect" value="/customer/dashboard/" />
        <div class="form-group">
          <label for="rn_<?= $this->instanceID; ?>_Email">Email Address</label>
          <br>
          <input type="email" maxlength="80" required class="input" id="rn_<?= $this->instanceID; ?>_Email"  name="Contact.Email"/>
          <!-- Commented the below code for OTP disablement CP UAT -->
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

</div>

