<rn:meta title="#rn:php:\RightNow\Libraries\SEO::getDynamicTitle('incident', \RightNow\Utils\Url::getParameter('ci_id'))#" template="employee_header.php" login_required="true" clickstream="incident_view" force_https="true"/>
<?php
$CI=&get_instance();
$CI->load->helper('report');
$ci_id = \RightNow\Utils\Url::getParameter('ci_id');
$incident = RightNow\Connect\v1_3\Incident::fetch($ci_id);
$allow_update = true;
if(strlen($incident->ClosedTime)){
    date_default_timezone_set("Asia/Kolkata");
    $closed = new DateTime();
    $closed->setTimestamp($incident->ClosedTime);
    $now = new DateTime();
    $diff = date_diff($now,$closed);
    if(strlen($diff->y) || strlen($diff->m)){
        $allow_update = false;
    }
    else{
        if(strlen($diff->d)){
            if($diff->d >= 3){
                $allow_update = false;
            }
        }
    }
}
checkCustomerType('internal employee');
//echo $contact_id=$CI->session->getProfileData("c_id");
?>
<div class="rn_Hero">
    <div class="rn_Container">
       <p id="subject_1"> </p>
    </div>
</div>

<div class="rn_PageContent rn_RecordDetail rn_IncidentDetail rn_Container">
    <?php if($allow_update == true){ ?>
        <h2>#rn:msg:UPDATE_THIS_QUESTION_CMD#</h2>
        <div id="rn_ErrorLocation" aria-atomic="true" aria-live="assertive"></div>
        <!--<form id="rn_UpdateQuestion" onsubmit="return false;">-->
        <form id="rn_QuestionSubmit" method="post" action="/cc/ajaxRequest/sendFormEmpIncUpdate/" class="styled" enctype="multipart/form-data">
            <!--<div id="rn_SelectionInput_29" class="rn_SelectionInput rn_Input">
                <div id="rn_SelectionInput_29_LabelContainer">
                    <label for="rn_SelectionInput_29_Incident.StatusWithType.Status" id="rn_SelectionInput_29_Label" class="rn_Label">Do you want a response?</label>
                </div>
                <select id="rn_SelectionInput_29_Incident.StatusWithType.Status" name="Incident.StatusWithType.Status">
                    <option value="0" selected="selected">Yes, please respond to my question</option>
                    <option value="1">No, My query is resolved now</option>
                </select>
            </div>-->
            <div style="display:none;">
                <rn:widget path="input/FormInput" name="Incident.CustomFields.c.incident_id" default_value="#rn:php:$ci_id#" />
            </div>
            <rn:widget path="input/FormInput" name="Incident.CustomFields.c.do_you_want_a_response" default_value="173" required="true" />
            <rn:widget path="input/FormInput" name="Incident.Threads" label_input="#rn:msg:ADD_ADDTL_INFORMATION_QUESTION_CMD#" initial_focus="true" required="true"/>
            <rn:widget path="input/FileAttachmentUpload" label_input="#rn:msg:ATTACH_ADDTL_DOCUMENTS_QUESTION_LBL#"/>
            <rn:widget path="input/FormSubmit" label_on_success_banner="#rn:msg:QUESTION_SUCCESSFULLY_UPDATED_LBL#" on_success_url="none"  error_location="rn_ErrorLocation"/>
        </form>
    <?php } else { ?>
        <h2>#rn:msg:INC_REOPNED_UPD_FURTHER_ASST_PLS_MSG#</h2>
    <?php } ?>

    <h2>#rn:msg:COMMUNICATION_HISTORY_LBL#</h2>
    <div class="rn_QuestionThread" id="thread_1">
        <!--<rn:widget path="output/DataDisplay" name="Incident.Threads" label=""/>-->
    </div>

    <h2>#rn:msg:ADDITIONAL_DETAILS_LBL#</h2>
	<div class="rn_AdditionalInfo" id="additional_info">
	
	</div>

    <div class="rn_DetailTools">
        <rn:widget path="utils/PrintPageLink" />
    </div>
</div>
<script type="text/javascript">
$.ajax({
   url: '/cc/EmployeeCustom/getEmployeeCustomerIncidentDetail',
   data: {
      'ci_id': '<?php echo $ci_id;?>'
   },
   error: function() {
      $('#info').html('<p>An error has occurred</p>');
   },
   success: function(data) {
   /*   var $title = $('<h1>').text(data.talks[0].talk_title);
      var $description = $('<p>').text(data.talks[0].talk_description);*/
	  //console.log(data);
	  var obj = jQuery.parseJSON(data);
      $('#additional_info').html(obj.additionalInfo);
	  $('#subject_1').html('<h1>'+obj.subject+'</h1>');
	  $('#thread_1').html(obj.threadArray);
       //  .append($description);
		// additional_info
   },
   type: 'POST'
});
</script>
