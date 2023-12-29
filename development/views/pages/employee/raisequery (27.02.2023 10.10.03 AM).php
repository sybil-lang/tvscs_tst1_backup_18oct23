<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="employee_header.php" clickstream="incident_create" login_required="true" force_https="true" />
<?php
$CI = &get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');

$cust_id = $CI->session->getProfileData("c_id");

$obj = getCreatedByContact($cust_id);
//$obj = RNCPHP\Contact::fetch($cust_id)
?>
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/tautocomplete.css" />
<script src="/euf/assets/themes/standard/js/tautocomplete.js" type="text/javascript"></script>
<style type="text/css">
	header nav,
	header navbar {
		max-width: 1230px !important;
	}

	#outerdiv {
		visibility: hidden !important;
		/* display: none !important; */
	}

	/* .ui-widget input[type="text"] {
		padding: 13px 0 13px 22px !important;
		border-radius: 50px !important;
		background: #fff !important;
		box-shadow: 5.634px 10.595px 30px rgba(0, 0, 0, 0.1) !important;
		border: none !important;
		height: 40px !important;
		width: 360px !important;
		border: 1px solid rgba(0, 0, 0, 0.05) !important;
	} */
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
		<form id="rn_QuestionSubmit" method="post" action="/cc/ajaxRequest/sendForm" enctype="multipart/form-data">
			<div id="rn_ErrorLocation"></div>
			<rn:condition logged_in="false">
				<div class="row">
					<div class="col-md-11">
						<rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-11">
						<rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-11">
						<rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-11">
						<rn:widget path="input/FormInput" name="Incident.Subject" required="true" label_input="#rn:msg:SUBJECT_LBL#" />
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
						<rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#" />
					</div>
				</div>
			</rn:condition>
			<div class="row">
				<div class="col-md-11">
					<!-- <rn:widget path="input/FormInput" name="Incident.CustomFields.c.imei" /> -->
					<rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#" />
				</div>
			</div>


			<!--<div class="row">
				<div class="col-md-6">
					<rn:widget path="input/ProductCategoryInput" name="Incident.Product"/>
				</div>
		</div>-->

			<div class="row">
				<div class="col-md-10">

					<rn:widget path="custom/input/empProductCategoryInput" name="Incident.Category" required_lvl="3" max_lvl="3" />
				</div>
			</div>
			<div class="row ">
				<div class="col-md-10  hidden" id="imei">
					<!-- <rn:widget path="input/FormInput" name="Incident.CustomFields.c.imei" initial_focus="false"
                        label_input="IMEI Number" required=true /> -->
					<rn:widget path="input/FormInput" name="Incident.CustomFields.c.imei" initial_focus="true" label_input="IMEI Number" />
				</div>
			</div>

			<!-- <rn:widget path="input/FormInput" class="pf_add" name="Incident.CustomFields.c.preferred_address"
				initial_focus="true" label_input="Preferred Address" /> -->
			<!-- 
				<div class="row">
				<div class="col-md-6">
					<rn:widget path="input/FormInput" name="Incident.CustomFields.c.dispatchaddress" initial_focus="true" label_input="Dispatch Address" />
				</div>
			</div> -->


			<div class="row">
				<div class="col-md-6">
					<rn:widget path="input/FileAttachmentUpload" />
				</div>
			</div>
			<rn:widget path="input/FormSubmit" label_button="#rn:msg:SUBMIT_YOUR_QUESTION_CMD#" on_success_url="/app/employee/ask_confirm" error_location="rn_ErrorLocation" />
			<rn:condition content_viewed="2" searches_done="1">
				<rn:condition_else />
				<!--<rn:widget path="input/SmartAssistantDialog" label_prompt="#rn:msg:OFFICIAL_SSS_MIGHT_L_IMMEDIATELY_MSG#"/>-->
			</rn:condition>
		</form>
	</div>
	<div class="rn_SideRail">
		<div class="">
			<!--   <h3>Existing Contact Details</h3>-->
			<ul>
				<li style="margin-bottom:10px;"><a href="<?php echo $site_url; ?>/app/employee/customerquery"><img src="<?php echo $site_url; ?>/euf/assets/themes/standard/images/for-customer-img.gif"></a>
				</li>
				<li style="margin-bottom:10px;"><a href="<?php echo $site_url; ?>/app/employee/dealerquery"><img src="<?php echo $site_url; ?>/euf/assets/themes/standard/images/for-dealer-img.gif"></a>
				</li>
			</ul>
		</div>
	</div>
</div>

<!-- submit button id---rn_FormSubmit_33_Button -->
<!-- form id rn_QuestionSubmit -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js" type="text/javascript"></script>
<script>
	$("#rn_QuestionSubmit").validate({
		submitHandler: function(form) {
			console.log("hi-1");
			console.log(form);
			var formData = new FormData(form);
			console.log("this is formdata", formData);

		}
	});
	$('#rn_FormSubmit_33_Button').click(function(e) {
		this.disabled = true;
	});
	$(document).ready(function() {
		$('input[name="Incident.CustomFields.c.imei"]').attr("required", false);

		$('#rn_empProductCategoryInput_31_Button_Visible_Text').on('DOMSubtreeModified', function() {
			console.log("hi");
			// console.log($('input[name="Incident.CustomFields.c.imei"]').prop("required"));

			var sel_val = $(this).text();

			var categories = ['Locking', 'Unlocking', 'IMEI Release', 'DOA- IMEI Swapping', 'Others', 'Samsung - KNOX', 'Non Samsung -DC', 'KNOX dashboard Access'];

			if (categories.includes(sel_val.replace('Consumer Finance', '').trim()) == true || categories.includes(sel_val.replace('Consumer FinanceEnrollment', '').trim()) == true || categories.includes(sel_val.replace('Consumer FinanceReset/Flashing', '').trim()) == true) {
				console.log("OKKKKKKK");

				$('#imei').removeClass("hidden");
				$('input[name="Incident.CustomFields.c.imei"]').attr("required", true);



			} else {


				console.log("inside else");
				$('#imei').addClass("hidden");
				$('input[name="Incident.CustomFields.c.imei"]').attr("required", false);


			}

		});
	})



	$(document).ready(function(){
			const form = document.getElementById("rn_QuestionSubmit");
			$('#rn_empFormSubmit_35_Button').on('click', function(e) {
				this.disabled = true;
				e.preventDefault();
				console.log("yes you clicked");

			})
	})
</script>