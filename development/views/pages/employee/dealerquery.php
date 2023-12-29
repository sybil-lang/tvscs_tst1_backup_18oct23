<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="employee_header.php" clickstream="employee_dealer_incident_create" login_required="true" force_https="true" />
<?php
$CI=&get_instance();
$CI->load->helper('report');
$c_id=$CI->session->getProfileData("c_id");
checkCustomerType('internal employee');
/*$msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy);
$report_id= $msg_a->Value;
$filter = array("Employee_Id" => $c_id);
$report_results=report_result($report_id,$filter);*/
?>

  <link href="/euf/assets/themes/standard/css/magicsuggest-min.css" rel="stylesheet">
	<script src="/euf/assets/themes/standard/js/magicsuggest.js"></script>
	
		
	<style type="text/css">
header nav, header navbar {
     max-width: 1230px !important; 
        }
        .modal {
		    overflow-y: auto;
		}
		[role=dialog]{
			top: 0px !important;
		}
		.modal-content{
			height: 555px;
		}
		.modal.in .modal-dialog{
			z-index: 1040;
		}
		input[type=radio], input[type=checkbox]{
			margin-left: 15px;
		}
		.modal-body{
			height: 375px;
		}
</style>

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
<!-- <h2>Modal Example</h2> -->
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg hidden" data-toggle="modal" id="modbtn" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" >
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Have you Submitted these documents?</h4>
        </div>
        <div class="modal-body">
			<img src="/euf/assets/images/DocList.png" width="500" height="300">
			<p style="margin-top: 10px;">Please ensure all the above Mandatory documents are uploaded.  If any of the above documents are not uploaded, your ticket may be rejected.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<div class="rn_AskQuestion rn_Container">
    <form id="rn_QuestionSubmit" method="post" action="/cc/ajaxRequest/sendForm/" class="styled" enctype="multipart/form-data">
	<!--<form id="rn_QuestionSubmit" method="post" action="#" class="styled" enctype="multipart/form-data">-->
	<input type="hidden" name="contact_id" value="<?php echo $c_id;?>" />
	<input type="hidden" name="category_name" id="category_name">
        <div id="rn_ErrorLocation"></div>
        <rn:condition logged_in="false">
<!--	<div class="row">
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
	</div>-->
        </rn:condition>
        <rn:condition logged_in="true">
	<div class="row">
			<div class="col-md-4">
			<div class="rn_Select rn_Input">
				<label for="dealer" class="rn_Label">Select Dealer<span class="rn_Required" aria-label="Required">
    *</span></label>
			</div>
			<div id="magicsuggest_dealer"></div>
				
			</div>
	</div>
	<p>&nbsp;</p>
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

	<!--<div class="row">
			<div class="col-md-6">
				<rn:widget path="input/BasicProductCategoryInput" name="Incident.Product"/>

			</div>
	</div>-->

	<div class="row">
			<div class="col-md-6">
				<rn:widget path="custom/input/ProductCategoryInputEmpCustomer" name="Incident.Category" report_id="#rn:msg:CUSTOM_MSG_EmpPortal_DealerHelpdesk#" required_lvl="1" max_lvl="1" />
				
				<!--<rn:widget path="input/BasicProductCategoryInput" name="Incident.Category"/>-->
			</div>
	</div>
	<p>&nbsp;</p>
	<div class="row">
		<div class="col-md-6">
			<rn:widget path="input/FileAttachmentUpload" name="Incident.FileAttachments" />
		</div>
	</div>
	<p>&nbsp;</p>
       <rn:widget path="custom/input/empFormSubmit" label_button="#rn:msg:SUBMIT_YOUR_QUESTION_CMD#" on_success_url="/app/employee/dealer_ask_confirm" error_location="rn_ErrorLocation"/>
	   <input type="hidden" name="dealer_codes" id="dealercode" value="" />
	   <!--<button type="submit" id="rn_submitform"> Submit Your Question  </button>-->
    </form>
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
		
		var ms = $('#magicsuggest_dealer').magicSuggest({
       data:  '/cc/EmployeeCustom/getIncidentDealerLists',
		maxSelection: 1,
		minChars: 4,
		maxSuggestions: 30,
        renderer: function(data){
		  
            return '<div style="padding: 5px; overflow:hidden">' +
                '<div style="float: left;"><i class="fa fa-address-card" aria-hidden="true"></i></div>' +
                '<div style="float: left; margin-left: 5px">' +
                    '<div style="font-weight: bold; color: #333; font-size: 13px; line-height: 11px">' + data.value + '</div>' +
                    '<div style="color: #999; font-size: 13px;">' + data.name + '</div>' +
                '</div>' +
            '</div><div style="clear:both;"></div>'; // make sure we have closed our dom stuff

        }
    });
	$(ms).on('selectionchange', function(e,m)
	{
		$('#dealercode').val(this.getValue());
	});

	var got_category_name;
	$(document).ready(function(){
		$('body').on('click','.ygtvitem a',function(){
			got_category_name= jQuery(this).text().trim();
			console.log("CLICK EVENT: "+got_category_name);
			if(got_category_name=="WC Enrollment Doc Submission"){
				$("#category_name").val(got_category_name);
				$('#modbtn').click();
			}
		});
	});
	
			// $("#rn_QuestionSubmit").validate({
			//   submitHandler: function(form) {
		//$( "#rn_submitform" ).click(function() {
//			alert($('#rn_TextInput_29_Incident.Subject').val() );
			/*if($('#dealercode').val() == ''){
					bootbox.alert("<p>Dealer is Required</p>");
			}else if($('#rn_TextInput_29_Incident.Subject').val() == ''){
					bootbox.alert("<p>Subject is Required</p>");
			}else{*/
				//var datastring = $("#rn_QuestionSubmit").serialize();
			
			//alert($('formData[Incident.CustomFields.CO.Loan.ID]').val());
				/*$.ajax({
				   url: '/cc/EmployeeCustom/raiseQueryRequest',
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
					   var html = '<p>Thanks for submitting your Request. Use this reference number for follow up: <b><a href="/app/employee/dealer/questions/detail/di_id/'+obj[0].value_id+'">'+obj[0].value_refno+'</a>.</b></p>';
					   
					   //alert(obj[0].value_id);
					  // console.log(obj);
					   if (obj[0].value_id){
						   window.location.href = '/app/employee/dealer_ask_confirm/di_id/'+obj[0].value_id;
							//bootbox.alert(html,function(){ window.location.href = '/app/employee/dealer_ask_confirm/di_id/'+obj[0].value_id; });
							
					   }else{
							bootbox.alert("<p>An error has occurred</p>");
					   }
					  /*var $title = $('<h1>').text(data.talks[0].talk_title);
					  var $description = $('<p>').text(data.talks[0].talk_description);
					  $('#info')
						 .append($title)
						 .append($description);*/
						 //ask_confirm/i_id/713
				/*   },
				   type: 'POST'
				});
				return false;*/
		// 	}
		// });
	</script>