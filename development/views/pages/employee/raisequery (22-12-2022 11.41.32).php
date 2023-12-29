<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="employee_header.php" clickstream="incident_create" login_required="true" force_https="true" />
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');

$cust_id=$CI->session->getProfileData("c_id");

$obj = getCreatedByContact($cust_id);
//$obj = RNCPHP\Contact::fetch($cust_id)
?>
<style type="text/css">
header nav, header navbar {
     max-width: 1230px !important; 
        }
</style>
<div class="">
    <div class="rn_Container">
        
            <h1>#rn:msg:SUBMIT_QUESTION_OUR_SUPPORT_TEAM_CMD#</h1>
            <p>#rn:msg:OUR_DEDICATED_RESPOND_WITHIN_48_HOURS_MSG#</p>
        
        <!--<div class="translucent">
            <strong>#rn:msg:TIPS_LBL#:</strong>
            <ul>
                <li><i class="fa fa-thumbs-up"></i> #rn:msg:INCLUDE_AS_MANY_DETAILS_AS_POSSIBLE_LBL#</li>
            </ul>
        </div>
        <br>
        <p>#rn:msg:NEED_A_QUICKER_RESPONSE_LBL# <a href="/app/social/ask">#rn:msg:ASK_OUR_COMMUNITY_LBL#</a></p>-->
    </div>
</div>

<div class="rn_PageContent rn_AskQuestion rn_Container">
	<div class="col-sm-8">
		<form id="rn_QuestionSubmit" method="post" action="/cc/ajaxRequest/sendForm">
			<div id="rn_ErrorLocation"></div>
			<rn:condition logged_in="false">
		<div class="row">
			<div class="col-md-11">
				<rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#"/>
			</div>
		</div>
		<div class="row">
			<div class="col-md-11">
					<rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
			</div>
		</div>
		<div class="row">
			<div class="col-md-11">
				 <rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
			</div>
		</div>
		<div class="row">
			<div class="col-md-11">
				<rn:widget path="input/FormInput" name="Incident.Subject" required="true" label_input="#rn:msg:SUBJECT_LBL#"/>
			</div>
		</div>
			</rn:condition>
			<rn:condition logged_in="true">
		<!--<div class="row">
				<div class="col-md-8">
					<rn:widget path="custom/input/agreementSelect/" name="Incident.CustomFields.CO.Loan.ID" required="true" label_input="Agreement Number"/>
				</div>
		</div>-->
		<div class="row">
			<div class="col-md-11">
				<rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#"/>
			</div>
		</div>
			</rn:condition>
		<div class="row">
			<div class="col-md-11">
				<rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#"/>
			</div>
		</div>

		<!--<div class="row">
				<div class="col-md-6">
					<rn:widget path="input/ProductCategoryInput" name="Incident.Product"/>
				</div>
		</div>-->

		<div class="row">
				<div class="col-md-10">

					<rn:widget path="custom/input/empProductCategoryInput" name="Incident.Category" required_lvl ="3" max_lvl="3" />
				</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<rn:widget path="input/FileAttachmentUpload"/>
			</div>
		</div>
			<rn:widget path="input/FormSubmit" label_button="#rn:msg:SUBMIT_YOUR_QUESTION_CMD#" on_success_url="/app/employee/ask_confirm" error_location="rn_ErrorLocation"/>
			<rn:condition content_viewed="2" searches_done="1">
			<rn:condition_else/>
			<!--<rn:widget path="input/SmartAssistantDialog" label_prompt="#rn:msg:OFFICIAL_SSS_MIGHT_L_IMMEDIATELY_MSG#"/>-->
			</rn:condition>
		</form>
</div>
<div class="rn_SideRail">
        <div class="">
         <!--   <h3>Existing Contact Details</h3>-->
            <ul>
                <li style="margin-bottom:10px;"><a href="<?php echo $site_url;?>/app/employee/customerquery"><img src="<?php echo $site_url;?>/euf/assets/themes/standard/images/for-customer-img.gif"></a></li>
				 <li style="margin-bottom:10px;"><a href="<?php echo $site_url;?>/app/employee/dealerquery"><img src="<?php echo $site_url;?>/euf/assets/themes/standard/images/for-dealer-img.gif"></a></li>
            </ul>
        </div>
    </div>
</div>
