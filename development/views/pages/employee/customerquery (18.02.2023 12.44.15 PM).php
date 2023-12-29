<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="employee_header.php" clickstream="employee_customer_incident_create" login_required="true" force_https="true" />
<?php
$CI = &get_instance();
$CI->load->helper('report');
$c_id = $CI->session->getProfileData("c_id");
// 
checkCustomerType('internal employee');
$msgbase = \RightNow\Connect\v1_3\Messagebase::fetch("CUSTOM_MSG_CategoryName_for_Dispatch_address");
$category_list = $msgbase->Value;








?>
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/tautocomplete.css" />
<script src="/euf/assets/themes/standard/js/tautocomplete.js" type="text/javascript"></script>
<style type="text/css">
	.modal-dialog {
		z-index: 999999999999999999999999999 !important;
	}

	.bootbox-body {
		padding-top: 50px;

	}

	.modal-content {
		height: auto !important;
		overflow-y: scroll !important;
		position: fixed !important;
		top: -30px !important;
		width: auto !important;
	}

	.uderline {
		text-decoration: underline !important;
	}

	select {
		padding: 4px 0 4px 22px !important;
		border-radius: 50px !important;
		background: #fff !important;
		box-shadow: 5.634px 10.595px 30px rgba(0, 0, 0, 0.1) !important;
		border: none !important;
		height: 40px !important;
		width: 360px !important;
		border: 1px solid rgba(0, 0, 0, 0.05) !important;
		line-height: 18px;
	}

	.ui-widget input[type="text"] {
		padding: 4px 0 4px 22px !important;
		border-radius: 50px !important;
		background: #fff !important;
		box-shadow: 5.634px 10.595px 30px rgba(0, 0, 0, 0.1) !important;
		border: none !important;
		height: 40px !important;
		width: 360px !important;
		border: 1px solid rgba(0, 0, 0, 0.05) !important;
		line-height: 20px;
	}

	#rn_FileAttachmentUpload_36_LoadingIcon {
		left: 30px;
		z-index: 100000;
		position: absolute;
		bottom: 40px;
	}

	#branchPointer,
	#pointersList {
		color: red;
		font-weight: bold;
	}

	ol #pointersList {
		list-style: number;
	}

	.modal-dialog {
		z-index: 999999999999999999999999999 !important;
	}

	/* .widgetfile{
		background-color: pink;
	}
	#infile{
		background-color: yellow;
	} */
	input[type="file"] {
		cursor: pointer;
	}
</style>



<script type="text/javascript">
	submit_variable = 1;
</script>
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
	<center>
		<img src="/euf/assets/themes/standard/img/ajax-loader.gif">
	</center>
</div>
<p>&nbsp;</p>
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

<div class="rn_AskQuestion rn_Container">
	<form id="rn_QuestionSubmit" method="post" action="/cc/ajaxRequest/sendForm/" class="styled" enctype="multipart/form-data">
		<!--<form id="rn_QuestionSubmit" method="post" action="#" class="styled" enctype="multipart/form-data">-->
		<input type="hidden" name="contact_id" value="<?php echo $c_id; ?>" />
		<input type="hidden" name="ref_no" value=refno />
		<div id="rn_ErrorLocation"></div>
		<rn:condition logged_in="false">
			<div class="row">
				<div class="col-md-6">
					<rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<rn:widget path="input/FormInput" name="Incident.Subject" required="true" label_input="#rn:msg:SUBJECT_LBL#" />
				</div>
			</div>
		</rn:condition>
		<rn:condition logged_in="true">
			<div class="row">
				<div class="col-md-4">
					<div class="ui-widget">
						<label for="dealer" class="rn_Label" style="display:block !important" ;> Agreement Number<span class="rn_Required" aria-label="Required">*</span><span id="loadericon" class="hidden"><img src="/euf/assets/themes/standard/img/ajax-loader.gif"></span></label>
						<!--<div id="magicsuggest_customer"></div>-->
						<input type="text" name="agreement_no" id="agreement_no" required />
						<p>&nbsp;</p>
					</div>
				</div>
			</div>
			<div class="row" style="display:none;" id="custname">
				<div class="col-md-5">
					<label for="name">Customer Name</label>
					<input type="text" name="customerName" id="customerName" readonly />
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">

					<rn:widget path="custom/input/ProductCategoryInputEmpCustomer" name="Incident.Category" report_id="#rn:msg:CUSTOM_MSG_EmpPortal_CustomerHelpdesk#" required_lvl="1" max_lvl="1" />

				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<rn:widget path="input/FormInput" class="pf_add" name="Incident.CustomFields.c.preferred_address" initial_focus="true" label_input="Preferred Address" />
					<div id="messageTerm">

					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<rn:widget path="input/FormInput" name="Incident.CustomFields.c.dispatchaddress" initial_focus="true" label_input="Dispatch Address" />
				</div>
			</div>

			<div class="row pinnm">
				<div class="col-md-6">
					<label>Pin Code <span id="pincodestar" class="rn_Required">*</span></label><input class="rn_Text" type="text" name="pin" required id="pincode" maxlength="6" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
				</div>
			</div>
		</rn:condition>
		<div class="row">
			<div class="col-md-6">
				<rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#" />
			</div>
		</div>

		<!--<div class="row">
			<div class="col-md-6">
				<rn:widget path="input/ProductCategoryInputEmpCustomer" name="Incident.Product" report_id="null" required_lvl="1" max_lvl="1" />
			</div>
	</div>-->
		<!-- <div class="row">
			<div class="col-md-6">
				
				<rn:widget path="custom/input/ProductCategoryInputEmpCustomer" name="Incident.Category" report_id="#rn:msg:CUSTOM_MSG_EmpPortal_CustomerHelpdesk#" required_lvl="1" max_lvl="1" />
				
			</div>
	</div> -->
		<div class="row hidden">
			<div class="col-md-6">
				<rn:widget path="input/FileAttachmentUpload" name="Incident.FileAttachments" />	
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">

			
				<div class="ui-widget " >
					<input type="file" id="inputfile" name="file">

					<p>&nbsp;</p>
				</div>
			</div>
		</div>
		<input type="hidden" name="selectedLoan" id="selectedLoan" value="" />
		<input type="hidden" name="productId" id="productId" />
		<rn:widget path="custom/input/empFormSubmit" label_button="#rn:msg:SUBMIT_YOUR_QUESTION_CMD#" on_success_url="/app/employee/customer_ask_confirm" error_location="rn_ErrorLocation" />
		<p>&nbsp;</P>
		<!--<button type="submit" id="rn_submitform"> Submit Your Question </button><p>&nbsp;</p>-->
	</form>
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js" type="text/javascript"></script>
<script>
	//var ms3= $('#magicsuggest_customer').magicSuggest({
	//$('#agreement_no').on('blur',function(){	
	var selQuery = $('#agreement_no').val();
	var selQuery = $('#agreement_no').val();
	// var cat="";
	var mobile = "";
	var dob = "";
	var customername = "";




	var text2 = $("#agreement_no").tautocomplete({
		// width: "700px",
		columns: ['Value', 'Name'],

		placeholder: "Search Agreement Number",
		//	regex: "/^[a-zA-Z0-9]{3,}$/",
		norecord: "No Records Found/Please enter atleast 8 characters",
		ajax: {
			url: "/cc/EmployeeCustom/getCustomerAgreementLists",
			type: "GET",
			data: function() {
				var x = {
					query: text2.searchdata()
				};
				return x;
			},
			success: function(result) {

				var filterData = [];

				var searchData = eval("/" + text2.searchdata() + "/gi");

				$.each(result, function(i, v) {
					if (v.name.search(new RegExp(searchData)) != -1) {
						filterData.push(v);
					}
				});
				return filterData;
			}
		},
		onchange: function() {
			// $("#ta-txt").html(text2.text());
			var obj = text2.id();
			var strResult = obj.split('_');
			//alert( result[2] );
			var str_id = strResult[0] + '_' + strResult[1];
			$("#selectedLoan").val(str_id);
			$("#customerName").val(strResult[2]);
			$('#custname').show();
			setProductValue(text2.text());
		}
	});

	//		}



	function setProductValue(agreementNumber) {
		$("#loadericon").addClass("hidden");
		$.ajax({
			url: '/cc/EmployeeCustom/getProduct',
			data: 'agg_no=' + agreementNumber,
			method: 'post',
			beforeSend: function() {
				//	$("#loadericon").removeClass("hidden");
			},
			success: function(response) {
				//$('#txtHint').html(data);
				// $("#loadericon").addClass("hidden");
				jQuery('#productId').val(response);
			}
		}).error(function() {
			bootbox.alert('An error occured');
		});
	}

	//

	//	$( "#rn_submitform" ).click(function() {

	$("#rn_QuestionSubmit").validate({

		submitHandler: function(form) {
			console.log("hi-1");
			console.log(form);
			var formData = new FormData(form);
			console.log("this is formdata", formData);

		}
	});

	function getchangedval() {
		// var agg=$('#agreement_no').val();;
		var a = $('#agreement_no').val().split('#')
		var agg = a[2];
		var adType = "RA";
		console.log("agg", agg);

		$.ajax({
			url: '/cc/AjaxCustom/getdispatchadd',
			data: {
				agreement_no: agg,
				adType: adType
			},
			method: 'post',
			beforeSend: function() {
				$("#loader").removeClass("hidden");
			},
			success: function(response) {
				//$('#txtHint').html(data);
				$("#loader").addClass("hidden");
				response = JSON.parse(response)

				console.log(response);
				if (response.ReturnMessage == "SUCCESS") {
					var address = "";
					if (response.ReturnObject.AddressLine3 != "" && response.ReturnObject.AddressLine2 != "" && response.ReturnObject.AddressLine1 != "") {
						address = response.ReturnObject.AddressLine1 + " , " + response.ReturnObject.AddressLine2 + " , " + response.ReturnObject.AddressLine3;
					} else if (response.ReturnObject.AddressLine2 != "" && response.ReturnObject.AddressLine1 != "" && response.ReturnObject.AddressLine3 == "") {
						address = response.ReturnObject.AddressLine1 + " , " + response.ReturnObject.AddressLine2;

					} else if (response.ReturnObject.AddressLine1 != "" && response.ReturnObject.AddressLine2 == "" && response.ReturnObject.AddressLine3 == "") {
						address = response.ReturnObject.AddressLine1;
					} else {
						address = "";
					}
					if (response.ReturnObject.Landmark != "") {
						address = address + ", " + response.ReturnObject.Landmark;
					}
					document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].value = address;
					document.getElementById('pincode').value = response.ReturnObject.PinCode;

				}
			}
		}).error(function() {
			bootbox.alert('An error occured');
		});
	}
	$('#rn_empFormSubmit_37_Button').click(function(e) {
		this.disabled = true;
	});
	$(document).ready(function() {

		console.log("hi-2");
		$('#rn_SelectionInput_31').addClass("hidden");
		$('#rn_TextInput_33').addClass("hidden");
		$('.pinnm').addClass("hidden");

		$('select[name="Incident.CustomFields.c.preferred_address"]').attr("required", false);
		$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("required", false);
		$('#pincode').attr("required", false);

		$('#pincode').blur(function(event) {
			var k = $(this).val();
			if (k != "" && k != undefined && k != null) {
				// var txtA = $("textarea[name='Incident.CustomFields.c.dispatchaddress']").val();
				// $("textarea[name='Incident.CustomFields.c.dispatchaddress']").val(txtA + ", "+k);
			}
		});

		$('button[type="submit"]').click(function(e) {
			// e.preventDefault();
			setTimeout(() => {
				$('input').removeClass("rn_ErrorField");
				$('textarea').removeClass("rn_ErrorField");
				$('select').removeClass("rn_ErrorField");
				$('button').removeClass("rn_ErrorField");
			}, 500);


		});



		$('select[name="Incident.CustomFields.c.preferred_address"]').change(function() {


			// console.log($('select[name="Incident.CustomFields.c.preferred_address"]'));
			var value = document.getElementsByName('Incident.CustomFields.c.preferred_address')[0].value

			if (value == "254") //registered address
			{
				$('#messageTerm').removeClass("hidden");
				jQuery('.pinnm').show();
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("maxlength", 500);
				getchangedval();
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("readonly", true);
				$('#pincode').attr("readonly", true);
				$('#messageTerm').html("");
			}
			if (value == "253") //new address
			{
				$('#messageTerm').removeClass("hidden");

				jQuery('.pinnm').show();
				jQuery('#pincodestar').addClass("rn_Required").html("*");
				jQuery('#rn_FileAttachmentUpload_36_Label').addClass("rn_Required").html("Address Proof Attachment *");
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("readonly", false);
				$('#pincode').attr("readonly", false);
				$('select[name="Incident.CustomFields.c.preferred_address"]').attr("required", true);
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("required", true);
				$('#pincode').attr("required", true);

				var note = "<ol id='pointersList'><li>NOTE: </li><li>1. You have selected a new address for dispatch of this document. Please attach a valid address proof for the new address.</li> <li>2. The address proof is subject to approval as per organization policy.</li><li>3. Please note that this address would be used only to dispatch thisparticular document requested by you. If you wish to change your address permanentlyfor future reference, raise your request at our Customer Care.</li></ol>";
				$('#messageTerm').html(note);
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("maxlength", 500);
				$('#rn_TextInput_33_Label').html("Dispatch Address <span id='attachreq'></span>");
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').val("");
				$("#pincode").val("");
				$('#attachreq').html("*").addClass("rn_Required").attr("aria-label", "Required");
			}
			if (value == "252") //branch address
			{
				$('#messageTerm').removeClass("hidden");

				jQuery('.pinnm').hide();
				jQuery('#pincodestar').removeClass("rn_Required").html("");
				jQuery('#rn_FileAttachmentUpload_36_Label').removeClass("rn_Required").html("Attach Documents");
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("required", true);
				$('#messageTerm').html("<p id='branchPointer'>NOTE: Kindly enter only the branch name</p>");
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("readonly", false);
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("maxlength", 15);
				$('#rn_TextInput_33_Label').html("Dispatch Address <span id='attachreq'></span>");
				$('#attachreq').html("*").addClass("rn_Required").attr("aria-label", "Required");
				$("#pincode").val("");
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').val("");

			}
			// you can also check: this.selected


		});


		$('#rn_ProductCategoryInputEmpCustomer_29_Button_Visible_Text').on('DOMSubtreeModified', function() {
			document.getElementsByName('Incident.CustomFields.c.preferred_address')[0].value = "";
			document.getElementById('pincode').value = "";
			document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].value = "";
			var sel_val = $(this).text();
			console.log("sel_val", sel_val);
			$('#messageTerm').addClass("hidden");
			var categories = [<?php echo $category_list; ?>];
			if (categories.includes(sel_val.trim()) == true) {
				console.log("OKKKKKKK");
				console.log('fds', categories);
				// selectDiv.innerHTML = selectDivCreated.innerHTML;
				// dispatchAddr.innerHTML = dispatchAddrDivCreated.innerHTML;
				// pinDiv.innerHTML = pinDivCreated.innerHTML;

				$('#infile').removeClass("hidden");
				$('#widfile').addClass("hidden");



				$('#rn_SelectionInput_31').removeClass("hidden");
				$('#rn_TextInput_33').removeClass("hidden");
				$('.pinnm').removeClass("hidden");

				$('select[name="Incident.CustomFields.c.preferred_address"]').attr("required", true);
				$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("required", true);
				$('#pincode').attr("required", true);
			} else {
				
				// $('#infile').addClass("hidden");
				// $('#widfile').removeClass("hidden");

				$('#rn_SelectionInput_31').addClass("hidden");
				$('#rn_TextInput_33').addClass("hidden");
				$('.pinnm').addClass("hidden");
			}

		});
		//$('select[name="Incident.CustomFields.c.preferred_address"]').val(254).change();
	});

	var mobile = "";
	var dob = "";
	var customername = "";
	var ag_no = "";
	var filevalue = "";
	var formData = "";
	var refno = "";
	var Question = '';
	var Createdbycontact = '';



	function die() {
		window.stop();
		throw new Error("ERROR");
	}

	function next_month(value) {
		var Question = document.getElementById('rn_TextInput_35_Incident.Threads').value;
		var subjectt = document.getElementById('rn_TextInput_28_Incident.Subject').value;
		var cat = document.getElementById('rn_ProductCategoryInputEmpCustomer_29_Button_Visible_Text').innerHTML;
		var a = $('#agreement_no').val().split('#')
		var ag_no = "_" + a[2];
		if (cat == "Excess Refund") {
			cat = 56;
		}

		$.ajax({
			type: "POST",
			url: "/cc/AjaxCustom/excess_refund",
			async: false,
			data: {
				ag_no: ag_no,
				cat: cat,
				mobile: mobile,
				dob: dob,
				customername: customername,
				value: value,
				Question: Question,
				subjectt: subjectt
			},
			success: function(data) {
				dd = JSON.parse(data)
				console.log(dd);
				bootbox.alert(dd.ReturnMessage, function() {
					location.reload();
				});
				die();
			}
		});

	}

	function soa(val) {
		// var cat=document.getElementById('rn_askCategoryInput_36_Incident.Category').value;
		var cat = document.getElementById('rn_ProductCategoryInputEmpCustomer_29_Button_Visible_Text').innerHTML;
		if (cat == "Insurance Copy request") {
			cat = 77;

		}
		if (cat == "Statement of Account Request") {
			cat = 86;

		}
		if (cat == "CD NOC - Soft copy") {
			cat = 1812;

		}
		if (cat == "Swapping Enquiry") {
			cat = 1891;

		}

		// var ag_no=document.getElementById('rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID').value;
		var a = $('#agreement_no').val().split('#')
		var ag_no = "_" + a[2];
		if (val == 'hard') {
			$.ajax({
				type: "POST",
				url: "/cc/AjaxCustom/paymentgateway_urls",
				async: false,
				data: {
					ag_no: ag_no,
					cat: cat,
					mobile: mobile,
					dob: dob,
					customername: customername
				},
				success: function(data) {

					dd = JSON.parse(data)
					if (dd.ReturnID != 0) {


						console.log(dd);


						window.open(dd.ReturnURL, '_blank');


						die();
					} else {
						alert("The requested details not found. Please contact customer care for further information");
					}


				}
			});
		} else {
			window.location.href = "https://tvscs.custhelp.com/app/employee/selfserviceview/load/" + ag_no;
			return false;

		}
		die();

	}
	////
	var ResultRespons = '';

	function NocRequest_CheckLive(mobile, ag_no, Question, Createdbycontact) {

		$.ajax({
			url: '/cc/AjaxCustom/noclivecheck',
			data: {
				ag_no: ag_no,
				mobile: mobile,
				Question: Question,
				Createdbycontact: Createdbycontact
			},
			type: "POST",
			async: false,
			success: function(data) {

				console.log('data from noclivecheck...................', data);


				var d = JSON.parse(data);
				// console.log("resp fromnoclove", d);

				// console.log("refno", d.ReturnOutput[0].lookupName);
				// var refno = d.ReturnOutput[0].lookupName;


				// ////
				// $.ajax({
				// 	url: '/cc/ajaxRequest/nocupdatecreatedbycontact',
				// 	data: {
				// 		refno: refno
				// 	},
				// 	type: "POST",
				// 	async: false,
				// 	success: function(data) {
				// 		console.log(data);


				// 	},
				// 	error: function(err) {
				// 		console.log(err); // Reject the promise and go to catch()
				// 		return err;
				// 	}
				// });


				/////


				ResultRespons = d;
				return d;

			},
			error: function(err) {
				console.log(err); // Reject the promise and go to catch()
				return err;
			}
		});

	}
	var ResultRespons2 = ""

	function invokepl(mobile, ag_no) {
		$.ajax({
			url: '/cc/AjaxCustom/invokepl',
			data: {
				ag_no: ag_no,
				mobile: mobile
			},
			type: "POST",
			async: false,
			success: function(data) {
				// const json = {};

				// console.log(JSON.parse(data));
				console.log('data from invokepl', data);

				// dataAAA=parseXmlToJson(data); // Resolve promise and go to then()
				// console.log(JSON.parse((dataAAA.Is_Toupup_RequiredResponse.Is_Toupup_RequiredResult))); // Resolve promise and go to then()
				var d = JSON.parse(data);
				// console.log('parsed data ',
				//     d);
				ResultRespons2 = d;
				return d;

			},
			error: function(err) {
				console.log(err); // Reject the promise and go to catch()
				return err;
			}
		});

	}

	var ResultRespons3 = ""
	//fucntion to call noc dispatched api

	function Nocdispatchdapi(mobile, ag_no) {
		// alert('calling nocdispTHED PAI');
		$.ajax({


			url: '/cc/AjaxCustom/nocdispatched',
			data: {
				ag_no: ag_no,
				mobile: mobile
			},
			type: "POST",
			async: false,
			success: function(data1) {
				// console.log("data from noc dispatched api   ", data1);
				// const json = {};

				function parseXmlToJson1(xml) {
					const json = {};
					for (const res of xml.matchAll(/(?:<(\w*)(?:\s[^>]*)*>)((?:(?!<\1).)*)(?:<\/\1>)|<(\w*)(?:\s*)*\/>/gm)) {
						const key = res[1] || res[3];
						const value = res[2] && parseXmlToJson1(res[2]);
						json[key] = ((value && Object.keys(value).length) ? value : res[2]) || null;

					}
					return json;
				}
				// console.log("for dispatched api", parseXmlToJson1(data1));
				dataAAA1 = parseXmlToJson1(data1); // Resolve promise and go to then()
				console.log("for dispatched api")
				// console.log(JSON.parse((dataAAA1.RequestNOC_EXTResponse.RequestNOC_EXTResult))); // Resolve promise and go to then()
				var e = JSON.parse((dataAAA1.RequestNOC_EXTResponse.RequestNOC_EXTResult));
				ResultRespons3 = e;



				return e;

			},
			error: function(err) {
				console.log(err); // Reject the promise and go to catch()
				return err;
			}
		});

	}





	////


	$(document).ready(function() {

		const form = document.getElementById("rn_QuestionSubmit");



		$('#rn_empFormSubmit_37_Button').on('click', function(e) {
			// const input = document.querySelector('input[type="file"]');
			const formData = new FormData(form);
			
			  sessionStorage.setItem("formData", JSON.stringify(formData));
			console.log('here', formData);
			console.log('ag selected', formData.get("agreement_no"));
			//    console.log('file info selected',formData1.get("Incident.FileAttachments"));
			//  console.log('here',formData.agreement_no);
			this.disabled = true;
			e.preventDefault();

			// console.log("incident id from local storage is:",localStorage.getItem("incident_id"));

console.log("form data ************************ ",JSON.parse( localStorage.getItem( 'formData' ) ));


let data = {};
for (let [key, value] of formData.entries()) {
  data[key] = value;
}


const dataString = JSON.stringify(data);
sessionStorage.setItem('formData', dataString);



   const storedDataString = sessionStorage.getItem( 'formData' );
    const storedData = JSON.parse( storedDataString );
    console.log( 'yguhhdbshyuxjhbdsijkbhu',storedData );



			//  let formData = JSON.parse( localStorage.getItem( 'formData' ) );
    // var obj = JSON.parse( sessionStorage.getItem( 'formData' ) );
    // console.log( "form oabjetc", formData );

            //  let incident_id=localStorage.getItem("incident_id");
            //      formData.append('incident_id', incident_id);
            //  $.ajax({
            //      url: '/cc/AjaxCustom/allfile_attatch',
            //      data: formData,
            //      processData: false,
            //      contentType: false,
    
            //      success: function(response) {
            //          console.log("finaly here i am")
            //      },
            //      type: 'POST'
            //  });
            
    //         $.ajax( {
    //     url: '/customer_ask_confirm/',
    //     data: formData,
    //     processData: false,
    //     contentType: false,

    //     success: function ( response ) {
    //         console.log( "finaly here i am dtfgyhujiugtrtyui" );
	// 		console.log(response);
    //     },
    //     type: 'POST'
    // } );
	

			

			console.log("yes you clicked");

			var daddress = document.getElementById('rn_TextInput_33_Incident.CustomFields.c.dispatchaddress').value;
			var pin = document.getElementById('pincode').value;
			var cat = document.getElementById('rn_ProductCategoryInputEmpCustomer_29_Button_Visible_Text').innerHTML;
			var categories = [<?php echo $category_list; ?>];
			if (categories.includes(cat.trim()) == true) {
				var value = document.getElementsByName('Incident.CustomFields.c.preferred_address')[0].value

				var value = document.getElementsByName('Incident.CustomFields.c.preferred_address')[0].value;
				if (!value) {
					alert("Please select the preferred_address");
					die();

				}
			}
			var a = $('#agreement_no').val().split('#')
			var ag_no = "_" + a[2];
			var address = document.getElementById('rn_SelectionInput_31_Incident.CustomFields.c.preferred_address').value;
			var daddress = document.getElementById('rn_TextInput_33_Incident.CustomFields.c.dispatchaddress').value;
			var pin = document.getElementById('pincode').value;
			var Question = document.getElementById('rn_TextInput_35_Incident.Threads').value;
			var subjectt = document.getElementById('rn_TextInput_28_Incident.Subject').value;



			//file attachment 
			// var filetype = document.getElementById('rn_FileAttachmentUpload_36_FileInput').type; 
			// var filename = document.getElementById('rn_FileAttachmentUpload_36_FileInput').name; 
			// var filevalue = document.getElementById('rn_FileAttachmentUpload_36_FileInput').value; 
			// const filevalue = document.querySelector("input[type='file']").value;
			// console.log("filevalue is",filevalue);
			// // console.log("fileAttachemnt type is :",filetype);
			// console.log("fileAttachemnt name is :",filename);
			// console.log("fileAttachemnt value is :",filevalue);


			//  const input =document.getElementById('rn_FileAttachmentUpload_36_FileInput');
			// const file = input.files[0];

			// const reader = new FileReader();
			// reader.onload = function() {
			// 	const content = reader.result;
			// 	console.log('terwrghtre3rghtre3rgtrewefge',content);
			// }

			var Createdbycontact = <?php echo $c_id ?>;

			console.log("Createdbycontact", Createdbycontact);

			console.log(Question);
			// var Question = Question.replace(/\s\s+/g, ' ');
			Question = Question.replace(/\s\s+/g, ' ');
			Question = Question.replace(/\n+/g, ' ');


			console.log(Question);


			//              const fileInput = document.getElementById('rn_FileAttachmentUpload_36_FileInput').value;
			// 			 console.log("fileinput",fileInput)
			//   fileInput.addEventListener('change', function(event) {
			//     const files = event.target.files;
			//     for (let i = 0; i < files.length; i++) {
			//       console.log('herer',files[i]);
			//     }
			//   });

			// fileInput.onchange = () => {
			//   const selectedFiles = [...fileInput.files];
			//   console.log('here',selectedFiles);
			// }



			// console.log(cat, ag_no, Question, subjectt);
			// die();
			// if(cat&&ag_no&&address&&daddress&&pin&&Question&&subjectt)
			// {       

			//86 statement of amount req  
			//1812 CD- NDC softcopy  
			//1891 Swapping Enquiry 
			//insurance 77         
			var deta = "";
			if (cat == "Insurance Copy request") {
				cat = 77;

			}
			if (cat == "Statement of Account Request") {
				cat = 86;

			}
			if (cat == "CD NOC - Soft copy") {
				cat = 1812;

			}
			if (cat == "Swapping Enquiry") {
				cat = 1891;

			}
			if (cat == "NOC request") {
				// console.log("inside noc")

				cat = 58;

				//show the input tag file
				// let inputfile=document.getElementById("inputfile");
				//  inputfile.style.display = "block";
				//  console.log("display block krdia")

				//  //hide widget file
				//  let widgetfile=document.getElementById("widgetfile");
				//  widgetfile.style.display = "none";
				//  console.log('hide krdia widget wale ko');


			}
			if (cat == "Excess Refund") {

				console.log(cat);
				cat = 56;
				console.log(cat);

			}
			// if ((cat == 1891 || cat == 1812 || cat == 86 || cat == 77 || cat == 56) && ag_no)
			if ((cat == 1891 || cat == 1812 || cat == 86 || cat == 77 || cat == 58 || cat == 56) && ag_no)


			{
				console.log("1");



				if (ag_no && Question && subjectt) {

					console.log("2");

				} else {
					console.log("3");
					submit_variable = 0;
					$('#rn_empFormSubmit_37_Button').submit();
					submit_variable = 1;
					die();
				}





				$.post('/cc/AjaxCustom/ca_api', {
						method: 'getapimessage',
						ag_no: ag_no,
						cat: cat
					})
					.done(function(data) {
						// customalrtbox(data);
						var daata = JSON.parse(data);

						console.log("daata", daata);

						deta = daata;
						dob = deta.dob;
						mobile = deta.mobile;
						customername = deta.customername;
						response = deta.responseSent;
						if (cat == 58) {

							console.log("inside 58");



							var ResultResponse3 = Nocdispatchdapi(mobile, ag_no);
							if (ResultRespons3.Status_Code == 1 && (ResultRespons3.Result.includes("Active"))) {


								console.log('status 1&active')
								var ag = ag_no.split('_')

								//display msg3

								bootbox.alert("Your loan account number " + ag[1] + " is Active. NOC can only be provided on completion of your loan.", function()

									{
										location.reload();
									});

								die();
							} else if (ResultRespons3.Status_Code == 1 && (ResultRespons3.Result.includes("dispatched"))) {


								console.log("ResultRespons3.Result", ResultRespons3.Result);
								console.log('status_code 1& dispatched')
								//display msg5///
								bootbox.alert(ResultRespons3.Result, function()
									// bootbox.alert("Your NOC has already been dispatched on 05-FEB- 16 through The Professional Courier, Airway bill no. is MAA922270295", function()

									{
										location.reload();
									});

								die();
							}

							//er
							else {
								console.log('status_code ER ');
								/////////////////////////
								if (daata.status) {
									console.log('open request')

									if (daata.status != "2") {
										var Stat = "Unresolved";

										function customalrtbox(msg) {
											var warning = msg;
											$('.title').html(warning);
											$("#modal_dialog2").show();

											function Yes() {

												$("#modal_dialog2").hide();
												// Do something
											}

											function No() {
												$("#modal_dialog").hide();
												// Do something else
											}

										}

										if (cat == 53) {
											bootbox.alert('Your NOC request is already registered with us. We will revert to you on this at the earliest. <br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >' + daata.LookupName + '</td></tr></table>', function() {
												location.reload();
											});
										}
										if (cat == 58) {
											bootbox.alert('   Your NOC request is already registered with us. You will get the response on this at the earliest<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >' + daata.LookupName + '</td></tr></table>', function() {
												location.reload();
											});
										}
										if (cat != 58 && cat != 53) {
											bootbox.alert('   Your request is already registered with us. We will revert to you on this at the earliest. <br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >' + daata.LookupName + '</td></tr></table>', function() {
												location.reload();
											});
										}




										die();

									} else {
										console.log('closed request');

										var Stat = "Resolved";


										if (cat == 58) {
											bootbox.dialog({
												message: "There is a request which was raised already .<br><table border=\"1\" cellspacing=\"1\" cellpadding=\"1\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >" + daata.LookupName + "</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Status</p></td><td nowrap=\"\" valign=\"bottom\" >" + Stat + "</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Response Sent</p></td><td  valign=\"bottom\" >" + response + "</td></tr></tbody></table><br>Do you still want to raise a request?",
												// swapButtonOrder: true,
												// size:'small',
												buttons: {

													Yes: {
														label: 'Yes',
														// className: 'btn-danger',
														callback: function(result) {
															$.ajax({
																type: "POST",
																url: "/cc/AjaxCustom/CheckLoanEligibilityNOC",
																async: false,
																data: {
																	// method: 'getapimessage',
																	ag_no: ag_no,
																	// cat: cat,
																	mobile: mobile,
																	async: false
																},
																success: function(nocEligibility) {
																	var txt = '';

																	parser = new DOMParser();
																	xmlDoc = parser.parseFromString(nocEligibility, "text/xml");
																	console.log(xmlDoc);
																	x = xmlDoc.getElementsByTagName("CheckLoanEligibilityResult");
																	for (i = 0; i < x.length; i++) {
																		txt += x[i].childNodes[0].nodeValue;
																	} // Resolve promise and go to then()
																	console.log('txt is', txt);
																	if (txt > 0) {
																		console.log('inside if eligible');
																		bootbox.dialog({
																			message: "<span style='color:black;'>You are eligible for the Personal Loan of Rs. " + txt + " would like to avail the Personal Loan?</span>",
																			// swapButtonOrder: true,
																			// size:'small',
																			buttons: {

																				Yes: {
																					label: 'Yes',
																					// className: 'btn-danger',
																					callback: function(result) {
																						invokepl(mobile, ag_no);
																						console.log('if needed->invokePL')

																						if (ResultRespons2.Status_Code == 1) {
																							// alert(ResultRespons2.Result)
																							// location.reload();

																							bootbox.alert("Thanks for your interest in pre-approved personal loan. Our executive will get in touch with you shortly", function()

																								{
																									location.reload();
																								});

																						} else {
																							alert(ResultRespons2.Result)
																							location.reload();
																						}
																					},
																				},
																				No: {
																					label: 'No',
																					callback: function(result) {
																						console.log('not needed->validate NOC')
																						var ResultResponse = NocRequest_CheckLive(mobile, ag_no, Question, Createdbycontact)
																						// console.log("cfgvbhjnkmjb hvgfcvhj", ResultRespons.ReturnOutput[0].lookupName);
																						if (ResultRespons.ReturnID == 2) {
																							var refno = ResultRespons.ReturnOutput[0].lookupName;


																							var refno = ResultRespons.ReturnOutput[0].lookupName;

																							// var payload = formData;
																							// formData.reference_no = refno;
																							formData.append('refno', refno);


																							$.ajax({
																								url: '/cc/AjaxCustom/file_attatch',
																								data: formData,
																								processData: false,
																								contentType: false,

																								success: function(response) {
																									console.log("finaly here i am")
																								},
																								type: 'POST'
																							});


																							var ag = ag_no.split('_')

																							bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.ReturnOutput[0].lookupName + ". You will get the response on this at the earliest.", function()

																								{


																									location.reload();
																								});
																						}

																						//displayinng msg 4 only


																						// bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.lookupName + ". You will get the response on this at the earliest.", function()

																						//     {
																						//         location.reload();
																						//     });
																						// if (ResultRespons.Status_Code == 1) {
																						//     var ag = ag_no.split('_')

																						//     bootbox.alert("Your loan account number " + ag[1] + " is Active. NOC can only be provided on completion of your loan.", function()

																						//         {
																						//             location.reload();
																						//         });
																						// } else if (ResultRespons.Status_Code == 2) {
																						//     var ag = ag_no.split('_')

																						//     bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.lookupName + ". You will get the response on this at the earliest.", function()

																						//         {
																						//             location.reload();
																						//         });
																						// } else if (ResultRespons.Status_Code == -1) {
																						//     var ag = ag_no.split('_')
																						//     //msg4

																						//     bootbox.alert("This request cannot be fulfiiled", function()

																						//         {
																						//             location.reload();
																						//         });
																						// } else {
																						//     bootbox.alert("status code is other than 1,2,-1", function()

																						//         {
																						//             location.reload();
																						//         });
																						// }



																						///
																					},
																				}
																			}, //butto

																		});
																	} //if txt
																	else {
																		console.log('not eligible->validate NOC');
																		var ResultResponse = NocRequest_CheckLive(mobile, ag_no, Question, Createdbycontact)

																		//displayinng msg 4 only

																		if (ResultRespons.ReturnID == 2) {
																			var refno = ResultRespons.ReturnOutput[0].lookupName;

																			var refno = ResultRespons.ReturnOutput[0].lookupName;

																			// var payload = formData;
																			// formData.reference_no = refno;
																			formData.append('refno', refno);


																			$.ajax({
																				url: '/cc/AjaxCustom/file_attatch',
																				data: formData,
																				processData: false,
																				contentType: false,

																				success: function(response) {
																					console.log("finaly here i am")
																				},
																				type: 'POST'
																			});
																			var ag = ag_no.split('_')

																			bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.ReturnOutput[0].lookupName + ". You will get the response on this at the earliest.", function()

																				{

																					location.reload();
																				});
																		}

																		// bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.lookupName + ". You will get the response on this at the earliest.", function()

																		//     {
																		//         location.reload();
																		//     });

																		// if (ResultRespons.Status_Code == 1) {
																		//     var ag = ag_no.split('_')

																		//     bootbox.alert("Your loan account number " + ag[1] + " is Active. NOC can only be provided on completion of your loan.", function()

																		//         {
																		//             location.reload();
																		//         });
																		// } else if (ResultRespons.Status_Code == 2) {
																		//     var ag = ag_no.split('_')

																		//     bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.lookupName + ". You will get the response on this at the earliest.", function()

																		//         {
																		//             location.reload();
																		//         });
																		// } else if (ResultRespons.Status_Code == -1) {
																		//     var ag = ag_no.split('_')
																		//     //msg4

																		//     bootbox.alert("This request cannot be fulfiiled", function()

																		//         {
																		//             location.reload();
																		//         });
																		// } else {
																		//     bootbox.alert("status code is other than 1,2,-1", function()

																		//         {
																		//             location.reload();
																		//         });
																		// }

																	}
																	// die();


																} //success noneligibility
															});
														},
													},
													No: {
														label: 'No',
														callback: function(result) {



															location.reload();
															///
														},
													}
												}, //button

											});
											die();
										}
										$.ajax({
											type: "POST",
											url: "/cc/AjaxCustom/apiHITSfor_digitization",
											async: false,
											data: {
												method: 'getapimessage',
												ag_no: ag_no,
												cat: cat,
												mobile: mobile
											},
											success: function(data) {



												d = data.replace(/(\r\n|\n|\r)/gm, "");
												dd = d;

												if (dd == "No Data Found") {

													bootbox.alert('The requested details not found. Please contact customer care for further information', function() {
														location.reload();
													});
													die();

												}
												if (cat == 77) {

												}
												if (cat == 93) {
													dd = JSON.parse(d)
													// dd=JSON.parse(dd)  
												} else {
													dd = JSON.parse(d)
													dd = JSON.parse(dd)
												}
												console.log(dd);
												var checkstatus = dd.Status_Code;
												if (cat == 84) {
													checkstatus = dd.length;
												}
												if (cat == 93) {
													checkstatus = dd.ReturnOutput[0].NO_OF_INS_PAID;
													if (checkstatus > 5) {
														checkstatus = 1;
													} else {
														checkstatus = 0;
													}
												}
												var string = dd.Result;
												if (checkstatus > 0) {
													if (cat != 77 && cat != 84 && cat != 93) //insurance 77//84 balance query
													{



														if (cat == 53) //58 noc request//53 duplicate noc
														{
															string = dd.Result;
															var s = string.toLowerCase();
															if (s.includes("active") !== false) {

																bootbox.alert(dd.Result, function() {
																	location.reload();
																})
																die();
															}

															// return;
														}
													}
													if (cat == 93) {
														// var r = 'Net foreclosure amount : '+dd.ReturnOutput[0].NET_OVERDUEAMOUNT+' Subject: '+ daata.Subject+'\n Reference #: '+ daata.LookupName+'\n Status:'+Stat+' \n Date Created: '+ daata.dateCreated+'\nDo you still want to raise a request?';
														var r = "<br>A request has been raised in this regard .<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >" + daata.LookupName + "</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Status</p></td><td nowrap=\"\" valign=\"bottom\" >" + Stat + "</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Response Sent</p></td><td  valign=\"bottom\" >" + response + "</td></tr></tbody></table><br> Do you still want to raise a request?"


														var warning = r;
														$('.title').html(warning);
														$("#modal_dialog").show();


														$('#btnYes').one('click', function() {
															$("#modal_dialog").hide();
															$('#rn_QuestionSubmit').submit();
															return;

														});
														$('#btnNo').one('click', function() {
															$("#modal_dialog").hide();
															// window.open(dd.ReturnURL, '_blank');
														});

													}
													if (cat == 84) //84 balance query
													{
														if (dd.length) {
															console.log(dd[0]);

															var keys = Object.keys(dd[0]);
															var val = Object.values(dd[0]);

															console.log(keys, val)

															var r = "<br>A request has been raised in this regard .<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >" + daata.LookupName + "</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Status</p></td><td nowrap=\"\" valign=\"bottom\" >" + Stat + "</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Response Sent</p></td><td  valign=\"bottom\" >" + response + "</td></tr></tbody></table><br> Do you still want to raise a request?";
															var warning = r;
															$('.title').html(warning);
															$("#modal_dialog").show();


															$('#btnYes').one('click', function() {
																$("#modal_dialog").hide();
																$('#rn_QuestionSubmit').submit();
																return;

															});
															$('#btnNo').one('click', function() {
																$("#modal_dialog").hide();
																// window.open(dd.ReturnURL, '_blank');
															});

														}





													}


													dob = deta.dob;
													mobile = deta.mobile;

													if (deta.Cat == 53) //53 duplicate noc
													{
														$.ajax({
															type: "POST",
															url: "/cc/AjaxCustom/paymentgateway_urls",
															async: false,
															data: {
																ag_no: ag_no,
																cat: cat,
																mobile: mobile,
																dob: dob,
																customername: customername
															},
															success: function(data) {
																dd = JSON.parse(data)
																// dd=JSON.parse(dd)
																console.log(dd);
																if (dd.ReturnID != 0) {


																	// var r = ('\n Subject: '+ daata.Subject+'\n Reference #: '+ daata.LookupName+'\n Status:'+Stat+' \n Date Created: '+ daata.dateCreated+'\nDo you still want to raise a request?');
																	var warning = "<br>A request has been raised in this regard .<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >" + daata.LookupName + "</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Status</p></td><td nowrap=\"\" valign=\"bottom\" >" + Stat + "</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Response Sent</p></td><td  valign=\"bottom\" >" + response + "</td></tr></tbody></table><br>Duplicate NOC is chargeable. Please click here to make an online payment <a class=\"uderline\" target=\"_blank\" href=\"" + dd.ReturnURL + "\">payment gateway link</a> and place your request for duplicate NOC.";
																	$('.title').html(warning);
																	$("#modal_dialog").show();


																	$('#btnYes').hide();
																	$('#btnNo').hide();
																	$('#x1').show();



																	$('#x1').one('click', function() {
																		$("#modal_dialog").hide();
																		// window.open(dd.ReturnURL, '_blank');
																		//   $('#rn_QuestionSubmit').submit()

																	});
																	$('#btnNo').one('click', function() {
																		$("#modal_dialog").hide();
																		// window.open(dd.ReturnURL, '_blank');
																	});





																	die();
																} else {
																	function customalrtbox(msg) {
																		var warning = msg;
																		$('.title').html(warning);
																		$("#modal_dialog2").show();

																		function Yes() {

																			$("#modal_dialog2").hide();
																			// Do something
																		}

																		function No() {
																			$("#modal_dialog").hide();
																			// Do something else
																		}
																		// $('#btnYes2').click(Yes);
																		// $('#btnNo').click(No);
																	}
																	bootbox.alert("The requested details not found. Please contact customer care for further information", function() {
																		location.reload();
																	});
																}

																// window.location()

															}
														});

													}
												} else {
													function customalrtbox(msg) {
														var warning = msg;
														$('.title').html(warning);
														$("#modal_dialog2").show();

														function Yes() {

															$("#modal_dialog2").hide();
															// Do something
														}

														function No() {
															$("#modal_dialog").hide();
															// Do something else
														}
														// $('#btnYes2').click(Yes);
														// $('#btnNo').click(No);
													}
													bootbox.alert('The requested details not found. Please contact customer care for further information', function() {
														location.reload();
													});
												}
											}
										});
									}

								} else {

									///////No Request Flow starts



									// console.log('inside no reuqest');

									if (cat == 58) {

										console.log(" ER->INSIDE NO REQUEST FLOW");

										$.ajax({
											type: "POST",
											url: "/cc/AjaxCustom/CheckLoanEligibilityNOC",
											async: false,
											data: {
												// method: 'getapimessage',
												ag_no: ag_no,
												// cat: cat,
												mobile: mobile,
												async: false
											},
											success: function(nocEligibility) {
												var txt = '';

												parser = new DOMParser();
												xmlDoc = parser.parseFromString(nocEligibility, "text/xml");
												console.log(xmlDoc);
												x = xmlDoc.getElementsByTagName("CheckLoanEligibilityResult");
												for (i = 0; i < x.length; i++) {
													txt += x[i].childNodes[0].nodeValue;
												} // Resolve promise and go to then()
												console.log('txt is', txt);
												if (txt > 0) {
													console.log('if eligible');

													bootbox.dialog({
														message: "<span style='color:black;'>You are eligible for the Personal Loan of Rs. " + txt + " would like to avail the Personal Loan?</span>",
														// swapButtonOrder: true,
														// size:'small',
														buttons: {

															Yes: {
																label: 'Yes',
																// className: 'btn-danger',
																callback: function(result) {
																	console.log('yes is clickd');
																	// invokepl(mobile, ag_no);
																	var ResultResponse2 = invokepl(mobile, ag_no);

																	if (ResultRespons2.Status_Code == 1) {
																		// alert(ResultRespons2.Result)
																		// location.reload();
																		console.log('invokePL status_code=1')

																		bootbox.alert("Thanks for your interest in pre-approved personal loan. Our executive will get in touch with you shortly", function()

																			{
																				location.reload();
																			});

																	} else {
																		alert(ResultRespons2.Result)
																		location.reload();
																	}
																},
															},
															No: {


																label: 'No',
																callback: function(result) {
																	console.log('not needed ,invoke validate noc');
																	var ResultResponse = NocRequest_CheckLive(mobile, ag_no, Question, Createdbycontact)

																	// //displayinng msg 4 only
																	if (ResultRespons.ReturnID == 2) {
																		var refno = ResultRespons.ReturnOutput[0].lookupName;

																		var refno = ResultRespons.ReturnOutput[0].lookupName;

																		// var payload = formData;
																		// formData.reference_no = refno;
																		formData.append('refno', refno);


																		$.ajax({
																			url: '/cc/AjaxCustom/file_attatch',
																			data: formData,
																			processData: false,
																			contentType: false,

																			success: function(response) {
																				console.log("finaly here i am")
																			},
																			type: 'POST'
																		});
																		var ag = ag_no.split('_')

																		bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.ReturnOutput[0].lookupName + ". You will get the response on this at the earliest.", function()

																			{

																				location.reload();
																			});
																	}


																	// bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.lookupName + ". You will get the response on this at the earliest.", function()

																	//     {
																	//         location.reload();
																	//     });

																	// if (ResultRespons.Status_Code == 1) {
																	//     var ag = ag_no.split('_')

																	//     bootbox.alert("Your loan account number " + ag[1] + " is Active. NOC can only be provided on completion of your loan.", function()

																	//         {
																	//             location.reload();
																	//         });
																	// } else if (ResultRespons.Status_Code == 2) {
																	//     var ag = ag_no.split('_')

																	//     bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.lookupName + ". You will get the response on this at the earliest.", function()

																	//         {
																	//             location.reload();
																	//         });
																	// } else if (ResultRespons.Status_Code == -1) {
																	//     var ag = ag_no.split('_')
																	//     //msg4

																	//     bootbox.alert("This request cannot be fulfiiled", function()

																	//         {
																	//             location.reload();
																	//         });
																	// } else {

																	//     bootbox.alert("status code other than 1,2,-1", function()

																	//         {
																	//             location.reload();
																	//         });
																	// }



																	///
																},
															}
														}, //button

													});
												} //if txt
												else {
													console.log('not eligible,triger validate noc')
													var ResultResponse = NocRequest_CheckLive(mobile, ag_no, Question, Createdbycontact)

													//displayinng msg 4 only
													if (ResultRespons.ReturnID == 2) {
														var refno = ResultRespons.ReturnOutput[0].lookupName;

														var refno = ResultRespons.ReturnOutput[0].lookupName;

														// var payload = formData;
														// formData.reference_no = refno;
														formData.append('refno', refno);


														$.ajax({
															url: '/cc/AjaxCustom/file_attatch',
															data: formData,
															processData: false,
															contentType: false,

															success: function(response) {
																console.log("finaly here i am")
															},
															type: 'POST'
														});
														var ag = ag_no.split('_')

														bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.ReturnOutput[0].lookupName + ". You will get the response on this at the earliest.", function()

															{

																location.reload();
															});
													}


													// bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.lookupName + ". You will get the response on this at the earliest.", function()

													//     {
													//         location.reload();
													//     });

													// if (ResultRespons.Status_Code == 1) {
													//     var ag = ag_no.split('_')

													//     bootbox.alert("Your loan account number " + ag[1] + " is Active. NOC can only be provided on completion of your loan.", function()

													//         {
													//             location.reload();
													//         });
													// } else if (ResultRespons.Status_Code == 2) {
													//     var ag = ag_no.split('_')

													//     bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.lookupName + ". You will get the response on this at the earliest.", function()

													//         {
													//             location.reload();
													//         });
													// } else if (ResultRespons.Status_Code == -1) {
													//     var ag = ag_no.split('_')
													//     //msg4

													//     bootbox.alert("This request cannot be fulfiiled", function()

													//         {
													//             location.reload();
													//         });
													// } else {

													//     bootbox.alert("status code other than 1,2,-1", function()

													//         {
													//             location.reload();
													//         });
													// }
												}
												// die();


											} //success noneligibility
										})
										//$('#rn_QuestionSubmit').submit()
										// die();
									}


									///////////No request flow ends



									// var Stat="Resolved";                                                             
									$.ajax({
										type: "POST",
										url: "/cc/AjaxCustom/apiHITSfor_digitization",
										async: false,
										data: {
											method: 'getapimessage',
											ag_no: ag_no,
											cat: cat,
											mobile: mobile
										},
										success: function(data) {

											d = data.replace(/(\r\n|\n|\r)/gm, "");
											dd = d;
											if (dd == "No Data Found") {
												function customalrtbox(msg) {
													var warning = msg;
													$('.title').html(warning);
													$("#modal_dialog2").show();

													function Yes() {

														$("#modal_dialog2").hide();
														// Do something
													}

													function No() {
														$("#modal_dialog").hide();
														// Do something else
													}
													// $('#btnYes2').click(Yes);
													// $('#btnNo').click(No);
												}

												if (cat != 58) {
													bootbox.alert('The requested details not found. Please contact customer care for further information', function() {
														location.reload();
													});
												}
												die();

											}
											if (cat == 77) {

											}
											if (cat == 93) {
												dd = JSON.parse(d)
												// dd=JSON.parse(dd)  
											} else {
												dd = JSON.parse(d)
												dd = JSON.parse(dd)
											}

											console.log(dd);
											var checkstatus = dd.Status_Code;
											if (cat == 84) {
												checkstatus = dd.length;
											}
											if (cat == 93) {
												checkstatus = dd.ReturnOutput[0].NO_OF_INS_PAID;
												if (checkstatus > 5) {
													checkstatus = 1;
												} else {
													checkstatus = 0;
												}
											}
											var string = dd.Result;
											if (checkstatus > 0) {
												if (cat != 77 && cat != 84 && cat != 93) //insurance 77//84 balance query
												{
													if (cat != 58) {
														function customalrtbox(msg) {
															var warning = msg;
															$('.title').html(warning);
															$("#modal_dialog2").show();

															function Yes() {

																$("#modal_dialog2").hide();
																// Do something
															}

															function No() {
																$("#modal_dialog").hide();
																// Do something else
															}
															// $('#btnYes2').click(Yes);
															// $('#btnNo').click(No);
														}
														// customalrtbox(dd.Result);
													}


													if (cat == 53) //58 noc request//53 duplicate noc
													{
														string = dd.Result;
														var s = string.toLowerCase();
														if (s.includes("active") !== false) {
															function customalrtbox(msg) {
																var warning = msg;
																$('.title').html(warning);
																$("#modal_dialog2").show();

																function Yes() {

																	$("#modal_dialog2").hide();
																	// Do something
																}

																function No() {
																	$("#modal_dialog").hide();
																	// Do something else
																}
																// $('#btnYes2').click(Yes);
																// $('#btnNo').click(No);
															}
															bootbox.alert(dd.Result, function() {
																location.reload();
															})
															die();
														}
														// if (cat == 58) {
														//     var r = (dd.Result + '<br>Do you still want to raise a request');
														//     var warning = r;
														//     $('.title').html(warning);
														//     $("#modal_dialog").show();


														//     $('#btnYes').one('click', function() {
														//         $("#modal_dialog").hide();
														//         // window.open(dd.ReturnURL, '_blank');
														//         $('#rn_QuestionSubmit').submit()
														//         return;

														//     });
														//     $('#btnNo').one('click', function() {
														//         $("#modal_dialog").hide();
														//         // window.open(dd.ReturnURL, '_blank');
														//     });
														// }
														// return;
													}
												}
												if (cat == 93) {
													var r = 'Your Foreclosure amount is Rs' + dd.ReturnOutput[0].NET_OVERDUEAMOUNT + ' <a class=\"uderline\" target=\"_blank\" href="https://tvscs--tst1.custhelp.com/app/customer/selfserviceview/load/' + ag_no + '">Please click here to download the F/C statement copy </a> <br> Do you still want to raise a request?';


													var warning = r;
													$('.title').html(warning);
													$("#modal_dialog").show();


													$('#btnYes').one('click', function() {
														$("#modal_dialog").hide();
														$('#rn_QuestionSubmit').submit();
														return;

													});
													$('#btnNo').one('click', function() {
														$("#modal_dialog").hide();
														// window.open(dd.ReturnURL, '_blank');
													});

												}
												if (cat == 84) //84 balance query
												{
													if (dd.length) {
														console.log(dd[0]);

														var keys = Object.keys(dd[0]);
														var val = Object.values(dd[0]);

														console.log(keys, val)

														var r = ('\nYour overdue amount is ' + dd[0].OverdueAmount + 'Do you still want to raise a request?');
														var warning = r;
														$('.title').html(warning);
														$("#modal_dialog").show();


														$('#btnYes').one('click', function() {
															$("#modal_dialog").hide();
															// window.open(dd.ReturnURL, '_blank');
															$('#rn_QuestionSubmit').submit()
															return;

														});
														$('#btnNo').one('click', function() {
															$("#modal_dialog").hide();
															// window.open(dd.ReturnURL, '_blank');
														});

													}

												}



												dob = deta.dob;
												mobile = deta.mobile;

												if (deta.Cat == 53) //53 duplicate noc
												{
													$.ajax({
														type: "POST",
														url: "/cc/AjaxCustom/paymentgateway_urls",
														async: false,
														data: {
															ag_no: ag_no,
															cat: cat,
															mobile: mobile,
															dob: dob,
															customername: customername
														},
														success: function(data) {
															dd = JSON.parse(data)
															// dd=JSON.parse(dd)
															console.log(dd);
															if (dd.ReturnID != 0) {


																console.log('duplicate noc clicked below is payment url')
																console.log(dd.ReturnURL);
																var warning = "Duplicate NOC is chargeable. Please click here to make an online payment <a target=\"_blank\" class=\"uderline\" href=\"" + dd.ReturnURL + "\">payment gateway link</a> and place your request for duplicate NOC.";
																$('.title').html(warning);
																$("#modal_dialog").show();


																$('#btnYes').hide();
																$('#btnNo').hide();
																$('#x1').show();



																$('#x1').one('click', function() {
																	$("#modal_dialog").hide();
																	// window.open(dd.ReturnURL, '_blank');
																	//   $('#rn_QuestionSubmit').submit()

																});
																$('#btnNo').one('click', function() {
																	$("#modal_dialog").hide();
																	// window.open(dd.ReturnURL, '_blank');
																});

																die();
															} else {

																bootbox.alert("The requested details not found. Please contact customer care for further information", function() {
																	location.reload();
																});
															}

															// window.location()

														}
													});

												}
											} else {

												// bootbox.alert('The requested details not found. Please contact customer care for further information', function() {
												//     location.reload();
												// });
												if (cat != 58) {
													bootbox.alert('The requested details not found. Please contact customer care for further information', function() {
														location.reload();
													});
												}
											}
										}
									});
								}
								/////////////////////////////

							}







						}
						if (cat == 56) {

							console.log("cat is 56 inside if");

							$.ajax({
								type: "POST",
								url: "/cc/AjaxCustom/excess_refund",
								async: false,
								data: {
									ag_no: ag_no,
									cat: cat,
									mobile: mobile,
									dob: dob,
									customername: customername,
									Question: Question,
									subjectt: subjectt
								},
								success: function(data) {
									dd = JSON.parse(data)
									console.log(dd);
									if (dd.ReturnID == 1001) {
										bootbox.alert(dd.ReturnMessage, function() {
											location.reload();
										});
										die();

									}
									if (dd.ReturnID == 1002) {
										bootbox.alert(dd.ReturnMessage, function() {
											location.reload();
										});
										die();


									}
									if (dd.ReturnID == 1003) {
										bootbox.alert(dd.ReturnMessage, function() {
											location.reload();
										});
										die();


									}
									if (dd.ReturnID == 1004) {


										bootbox.alert(dd.ReturnMessage + "<br><div style='display: flex;justify-content: space-around;'><div><button onclick='next_month(\"No\")' class='btn btn-primary ' type='button' data-dismiss='modal'>Next month EMI</button></div><div><button class='btn btn-primary ' data-dismiss='modal' type='button' onclick='next_month(\"Yes\")'>Refund</button></div></div>", function() {
											location.reload();
										});
										die();


									}
									if (dd.ReturnID == 1005) {
										bootbox.alert(dd.ReturnMessage, function() {
											location.reload();
										});
										die();


									}
									// else
									// {
									bootbox.alert(dd.ReturnMessage, function() {
										location.reload();
									});


									// }
									die();

									// if(dd.ReturnID!=0)

								}
							});
						}
						if (cat == 1891) //1891 Swapping Enquiry
						{



							$.ajax({
								type: "POST",
								url: "/cc/AjaxCustom/paymentgateway_urls",
								async: false,
								data: {
									ag_no: ag_no,
									cat: cat,
									mobile: mobile,
									dob: dob,
									customername: customername
								},
								success: function(data) {
									// .done(function( data ) 
									//     {
									dd = JSON.parse(data)
									console.log(dd);
									if (dd.ReturnID != 0) {

										bootbox.alert("Dear customer, If you wish to change your loan repayment account to another account, you would be required to pay the swapping charges and submit the new account details to us. <br><br><a class=\"uderline\" href=\"" + dd.ReturnURL + "\" target=\"_blank\">Please click here </a> to pay now.<br><br><p style=\"color:red;\">Please note that the EMI deduction is subject to receipt of new bank details / required documents and subject to approvals.</p>", function() {
											location.reload();
										});



										// die();
										return;
									} else {

									}
									bootbox.alert("Dear Customer, Repayment swapping is applicable only for the live loans. Your request can’t be processed since your loan is not active.", function() {
										location.reload();
									});

									// die(); 
									return;
									die();

								}
							});

						}

						if (cat == 77) //insurance 77   
						{

							$.ajax({
								type: "POST",
								url: "/cc/AjaxCustom/apiHITSfor_digitization",
								async: false,
								data: {
									method: 'getapimessage',
									ag_no: ag_no,
									cat: cat,
									mobile: mobile
								},
								success: function(data) {

									// dd=d;
									var dd = "";

									if (data.length <= 94) {
										d = data.replace(/(\r\n|\n|\r)/gm, "");
										dd = JSON.parse(d)
										dd = JSON.parse(dd)
									}
									var agg_no = ag_no.split('_')



									var r = "";

									if (dd.Status_Code != 0) {
										r = "Please click here <a class=\"uderline\" target=\"_blank\" href=\"https://customeroperationapi.tvscredit.com/InsuranceRenewal/InsurancecopyRenewalDocuments?AgreementNo=" + agg_no[1] + "\">-https://..</a>to download the Insurance Copy.";
									} else {
										r = "Sorry, we could not find the document.";

									}

									bootbox.alert(r, function() {
										location.reload();
									});


									return;
									die();
								}
							});

						}
						if (cat == 1812) //1812 CD- NDC softcopy
						{
							$.ajax({
								type: "POST",
								url: "/cc/AjaxCustom/cdndc",
								async: false,
								data: {
									method: 'getapimessage',
									ag_no: ag_no,
									cat: cat,
									mobile: mobile
								},
								success: function(data) {

									// console.log(data)

									var s = data.toLowerCase();
									// let strippedHtml = s.replace(/<[^>]+>/g, '');

									// console.log(s)

									if (s.includes("no data found") !== false) {
										// console.log(s)

										bootbox.alert("Sorry, we could not find the document.", function() {
											location.reload();
										});
									} else {
										const myArray = ag_no.split("_");
										var href = 'https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=' + myArray[1] + '&report=NOC_FOR_CDPORTFOLIO.pdf';
										bootbox.alert("CD NDC soft copy can be downloaded through customer portal & Saathi app.  <a class=\"uderline\" target='_blank' href='" + href + " '>Click here to download</a>", function() {
											location.reload();
										});
									}







									return;
									die();
								}

							});

						}

						if (cat == 86) //86 statement of amount req soft copy
						{


							// $("#ex112").html('');
							var hard = "hard";
							var soft = "soft";

							bootbox.alert('<div style="display: flex;justify-content: space-around;flex-direction: column"><p style="font-size: larger;">Your loan statement copy can be downloaded through customer portal & Saathi app.<span value="soft" class="uderline"  onclick="soa(\'soft\')" style="font-weight:800; cursor: pointer;"> Click here to download Soft Copy </span></p><br><br><p style="font-size: larger;" > Hard copy of loan statement is chargeable.<span style="font-weight:800;   cursor: pointer;" value="hard" class="uderline" onclick="soa(\'hard\')"> Click here </span>to make the payment and place your request.  </p><br></div>', function() {
								location.reload();
							});

							// die();
							return;
							die();





						}




					});
			} else {
				console.log("inside else of if");
				submit_variable = 0;
				$('#rn_empFormSubmit_37_Button').submit();

			}
		});
	});

	var test = $('#agreement_no').val();

	function agg_val() {
		test = $('#agreement_no').val();


	}

	function agg_reload() {
		// var test=document.getElementById("rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID").value
		if (test) {

			var cat = document.getElementById('rn_ProductCategoryInputEmpCustomer_29_Button_Visible_Text').innerHTML = "";

			// document.getElementById('rn_SelectionInput_31_Incident.CustomFields.c.preferred_address').value="";
			// document.getElementById('rn_TextInput_33_Incident.CustomFields.c.dispatchaddress').value="";
			// document.getElementById('pincode').value="";
			document.getElementById('rn_TextInput_35_Incident.Threads').value = "";
			document.getElementById('rn_TextInput_28_Incident.Subject').value = "";
			// $('select[name="formData[Incident.Category]"').trigger("change");







		}

	}
</script>