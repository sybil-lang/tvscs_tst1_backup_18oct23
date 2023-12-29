<rn:meta title="#rn:msg:CHANGE_YOUR_PASSWORD_CMD#" template="dealer_header.php" login_required="true" force_https="true"/>

<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('dealer');

?>
<div class="rn_Hero">
    <div class="rn_Container">
        <h1>#rn:msg:CHANGE_YOUR_PASSWORD_CMD#</h1>
    </div>
</div>

<div class="rn_PageContent rn_Account rn_Container">
    <div class="rn_Required rn_Message">#rn:url_param_value:msg#</div>
    <div id="rn_ErrorLocation"></div>
    <form id="rn_ChangePassword" onsubmit="return false;">
        <rn:widget path="input/FormInput" name="Contact.CustomFields.c.custom_password" required="true" require_validation="true" require_current_password="true" label_input="#rn:msg:PASSWORD_LBL#" label_validation="#rn:msg:VERIFY_PASSWD_LBL#" initial_focus="true"/>
        <div style="display:none;">
          <rn:widget path="input/SelectionInput" name="Contact.CustomFields.c.reset_password_on_login" default_value="false" />
        </div>
        <rn:widget path="input/FormSubmit" on_success_url="#rn:php:'/app/dealer/account/profile/msg/' . urlencode(\RightNow\Utils\Config::getMessage(YOUR_PASSWORD_HAS_BEEN_CHANGED_MSG))#" error_location="rn_ErrorLocation" />
    </form>
</div>

<script>
jQuery("input[name='Contact.CustomFields.c.custom_password']").attr("type","password");
jQuery("input[name='Contact.CustomFields.c.custom_password_Validation']").attr("type","password");
jQuery("input[name='Contact.CustomFields.c.reset_password_on_login']").attr("checked","false");
</script>