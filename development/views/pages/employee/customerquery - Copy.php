<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="employee_header.php" clickstream="incident_create" login_required="true" force_https="true" />
<?php
$CI=&get_instance();
$CI->load->helper('report');
$c_id=$CI->session->getProfileData("c_id");
checkCustomerType('internal employee');
?>
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

  <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
           <center>
              <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
            </center>
        </div>
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
    <form id="rn_QuestionSubmit" method="post" action="#" class="styled" enctype="multipart/form-data">
	<input type="hidden" name="contact_id" value="<?php echo $c_id;?>" />
        <div id="rn_ErrorLocation"></div>
        <rn:condition logged_in="false">
	<div class="row">
		<div class="col-md-6">
			<rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#"/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
				<rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		     <rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		    <rn:widget path="input/FormInput" name="Incident.Subject" required="true" label_input="#rn:msg:SUBJECT_LBL#"/>
		</div>
	</div>
        </rn:condition>
        <rn:condition logged_in="true">
	<div class="row">
			<div class="col-md-4">
			<div class="ui-widget">
				<label for="dealer" class="rn_Label" style="display:block !important";>Select Agreement<span class="rn_Required" aria-label="Required">*</span><span id="loadericon" class="hidden"><img src="/euf/assets/themes/standard/img/ajax-loader.gif"></span></label>
				<div id="magicsuggest_customer"></div>
				
				
					<p>&nbsp;</p>
					</div>
			</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		    <rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#"/>
		</div>
	</div>
        </rn:condition>
	<div class="row">
		<div class="col-md-6">
			<rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#"/>
		</div>
	</div>

	<div class="row">
			<div class="col-md-6">
				<rn:widget path="input/BasicProductCategoryInput" name="Incident.Product"/>

			</div>
	</div>
<p>&nbsp;</p>
	<div class="row">
			<div class="col-md-6">
				<rn:widget path="custom/input/askEmployeeCategoryInput" name="Incident.Category" required="true"  />
				<!--<rn:widget path="input/BasicProductCategoryInput" name="Incident.Category"/>-->
			</div>
	</div>
	<p>&nbsp;</p>
	<div class="row">
		<div class="col-md-6">
			<rn:widget path="input/FileAttachmentUpload"/>
		</div>
	</div><p>&nbsp;</p>
       <!-- <rn:widget path="input/FormSubmit" label_button="#rn:msg:SUBMIT_YOUR_QUESTION_CMD#" on_success_url="/app/ask_confirm" error_location="rn_ErrorLocation"/>-->
	   <input type="hidden" name="agreement_no" id="agreement_no" />
	   <button type="submit" id="rn_submitform"> Submit Your Question </button><p>&nbsp;</p>
        <rn:condition content_viewed="2" searches_done="1">
        <rn:condition_else/>
        <rn:widget path="input/SmartAssistantDialog" label_prompt="#rn:msg:OFFICIAL_SSS_MIGHT_L_IMMEDIATELY_MSG#"/>
        </rn:condition>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript">
		
		var ms3= $('#magicsuggest_customer').magicSuggest({
       data:  '/cc/EmployeeCustom/getCustomerLists',
		maxSelection: 1,
		minChars: 5,
		maxSuggestions: 30,
		selectionStacked: false,
		 required: true,
        renderer: function(data){
		  
            return '<div style="padding: 5px; overflow:hidden;">' +
                '<div style="float: left;"><i class="fa fa-address-card" aria-hidden="true"></i></div>' +
                '<div style="float: left; margin-left: 5px">' +
                    '<div style="font-weight: bold; color: #333; font-size: 13px; line-height: 11px">' + data.value + '</div>' +
                    '<div style="color: #999; font-size: 13px;">' + data.name + '</div>' +
                '</div>' +
            '</div><div style="clear:both;"></div>'; // make sure we have closed our dom stuff

        }

    });
	$(ms3).on('beforeload', function(){
		 // add your gif loader here
	 		$("#loadericon").removeClass("hidden");
	});
	$(ms3).on('selectionchange', function(e,m){
				var q = this.getValue();
				$("#loadericon").addClass("hidden");
				$('#agreement_no').val(this.getValue());
				  $.ajax({
						url: '/cc/EmployeeCustom/getProduct',
						data: 'agg_no='+q,
						method: 'post',
						beforeSend: function(){
								//	$("#loadericon").removeClass("hidden");
						 },
						success: function (response) {
							//$('#txtHint').html(data);
							// $("#loadericon").addClass("hidden");
							$('select[name^="formData[Incident.Product]"] option[value="'+response+'"]').attr("selected","selected");
						}
					}).error(function() {
						bootbox.alert ('An error occured');
					});
		});

		
	//	$( "#rn_submitform" ).click(function() {
		
		$("#rn_QuestionSubmit").validate({
			  submitHandler: function(form) {
				//form.submit();
//			alert($('#rn_TextInput_29_Incident.Subject').val() );
			/*if($('#agreement_no').val() == ''){
					bootbox.alert("<p>Agreement is Required</p>");
			}else if($('#rn_TextInput_29_Incident.Subject').val() == ''){
					bootbox.alert("<p>Subject is Required</p>");
			}else{*/
				var datastring = $("#rn_QuestionSubmit").serialize();
			
			//alert($('formData[Incident.CustomFields.CO.Loan.ID]').val());
				$.ajax({
				   url: '/cc/EmployeeCustom/raiseCustomerQueryRequest',
				   data: datastring,
				   beforeSend: function(){
							$("#loader").removeClass("hidden");
				   },
				   error: function() {
							bootbox.alert("<p>An error has occurred....</p>");
				   },
				   success: function(response) {
					   $("#loader").addClass("hidden");
					   var obj = jQuery.parseJSON(response);
					   var html = '<p>Thanks for submitting your Request. Use this reference number for follow up: <b><a href="/app/employee/customer/questions/detail/ci_id/'+obj[0].value_id+'">'+obj[0].value_refno+'</a>.</b></p>';
					   //alert(obj[0].value_id);
					  // console.log(obj);
					   if (obj[0].value_id){
						   window.location.href = '/app/employee/customer_ask_confirm/ci_id/'+obj[0].value_id; 
							//bootbox.alert(html,function(){ window.location.href = '/app/employee/customer/questions/detail/ci_id/'+obj[0].value_id; });
							
					   }else{
							bootbox.alert("<p>An error has occurred</p>");
					   }
					  /*var $title = $('<h1>').text(data.talks[0].talk_title);
					  var $description = $('<p>').text(data.talks[0].talk_description);
					  $('#info')
						 .append($title)
						 .append($description);*/
						 //ask_confirm/i_id/713
				   },
				   type: 'POST'
				});
				return false;
			}
		});
	</script>