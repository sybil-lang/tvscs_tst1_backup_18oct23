<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="standardMSME.php" clickstream="incident_create" login_required="true" force_https="true"/>
<?php 
$CI=&get_instance();

$contact_id=$CI->session->getProfileData("c_id");
//$mobile = $CI->session->getSessionData("mobileNumber");
$userData = $CI->session->getSessionData('userProfile');
?>
<div class="rn_Hero">
    <div class="rn_Container">
        
            <h1>Address Change Request</h1>
            <p>#rn:msg:OUR_DEDICATED_RESPOND_WITHIN_48_HOURS_MSG#</p>
        
        <!--<div class="translucent">
            <strong>#rn:msg:TIPS_LBL#:</strong>
            <ul>
                <li><i class="fa fa-thumbs-up"></i> #rn:msg:INCLUDE_AS_MANY_DETAILS_AS_POSSIBLE_LBL#</li>
            </ul>
        </div>
        <br>
        <p>#rn:msg:NEED_A_QUICKER_RESPONSE_LBL# <a href="/app/msme/social/ask">#rn:msg:ASK_OUR_COMMUNITY_LBL#</a></p>-->
    </div>
</div>

<div class="rn_PageContent rn_AskQuestion rn_Container">
    <form id="rn_QuestionSubmit" method="post"  enctype="multipart/form-data" action="/cc/AjaxCustom/raiseQueryRequest_add">
        <div id="rn_ErrorLocation"></div>
      
	<div class="row">
			<div class="col-md-8">
				<rn:widget path="custom/input/myagreementSelect/" name="Incident.CustomFields.CO.Loan.ID" required="true" label_input="Agreement Number"/>
				<input type="hidden" name="selectedLoan" id="selectedLoan">
			</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<label>Subject</label>
			<input type="text" class="rn_Text" name="subject" id="subject_id">
		    <!-- <rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#"/> -->
		</div>
	</div>
        <!-- </rn:condition> -->
	<div class="row">
		<div class="col-md-6">
			<label>Question</label>
			<textarea id="Question" class="rn_TextArea" name="Question_Q" required></textarea>
			<!-- <rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#"/> -->
		</div>
	</div>

	<div class="row" style="display:none;">
		<div class="col-md-6">
			<input type="text" name="incident_category" value="65">
			<!-- <rn:widget path="input/ProductCategoryInput" name="Incident.Category" default_value="17,40,65"  /> -->
		</div>
	</div>
			<input type="hidden" name="co_id" value="<?php echo $contact_id;?>">

	<p>&nbsp;</p>
	<div class="row">
		<div class="col-md-6">
			<label>Attach Document</label>
			<input type="file" name="attachment" required id="subject_id">
			<!-- <rn:widget path="input/FileAttachmentUpload"/> -->
		</div>
	</div>
	<br>
	<br>
	<br>
	<div class="rn_FormSubmit">
		<button  type="submit" >Submit</button>

	</div>
	        
    </form>
    <script type="text/javascript">
    	var aggr_sel = document.getElementsByClassName("setp");
    	aggr_sel[0].addEventListener("change",function(){
    		var selected_value = this.options[this.selectedIndex].value;
    		console.log(selected_value);
    		if(selected_value.length != 0){
    			$("#selectedLoan").val(selected_value);

    			console.log()
    		}
    	});
    </script>
</div>
