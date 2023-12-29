<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="standardMSME.php" clickstream="incident_create"/>
<?php
$CI=&get_instance();

$contact_id=$CI->session->getProfileData("c_id");
//$mobile = $CI->session->getSessionData("mobileNumber");
$userData = $CI->session->getSessionData('userProfile');
?>
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<script src="/euf/assets/themes/standard/js/bootstrap-checkbox.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>
<style type="text/css">
/*.bootbox-body
    {
      width: 284px;
    }
.modal-footer .btn-primary
    {
        width: 100px;
    }
.modal-content
    {
        overflow-y:hidden;
       width: 505px;
       height: 300px;
    }*/
.rn_TextInput {
    margin-left: 0 !important;
}
form > button[type=submit]{
    margin-left: 0 !important; 
}

.rn_AccountOverview{
    padding: 0;
    display: flex;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: center;
    align-items: flex-start;
}
.rn_AccountOverview .rn_SideRail{
    float: right;
}
</style>
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
           <center>
              <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
            </center>
        </div>
<div class="rn_Hero">
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
        <p>#rn:msg:NEED_A_QUICKER_RESPONSE_LBL# <a href="/app/msme/social/ask">#rn:msg:ASK_OUR_COMMUNITY_LBL#</a></p>-->
    </div>
</div>

<div class="rn_PageContent rn_AskQuestion rn_AccountOverview rn_Container">
    <div class="rn_ContentDetail">
    <div class="rn_HeaderContainer">
        &nbsp;
    </div>
    <form id="rn_QuestionSubmit" method="post" action="#" class="styled" enctype="multipart/form-data">
    <input type="hidden" name="co_id" value="<?php echo $contact_id;?>" />
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
            <div class="col-md-8">
                <rn:widget path="custom/input/agreementSelect/" name="Incident.CustomFields.CO.Loan.ID" required="true" label_input="Agreement Number"/>
            </div>
    </div>
    <br />
    <!-- <div class="row">
        <div class="col-md-6">
            <label for="input-2">Use existing details for contacting me</label><br />
            <input id="existing_contact" name="existing_contact" type="checkbox" checked data-off-icon-cls="gluphicon-thumbs-down" data-on-icon-cls="gluphicon-thumbs-up">
        </div>
    </div> -->
    <br />
    <div class="row" id="e_email" style="display:none;">
        <div class="col-md-6">
            <rn:widget path="input/FormInput" name="Incident.CustomFields.c.incident_email_id" required="true" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#"/>
        </div>
    </div>
    <div class="row"  id="e_mobile" style="display:none;">
        <div class="col-md-6">
            <rn:widget path="input/FormInput" name="Incident.CustomFields.c.incident_mobile_number" required="true" initial_focus="true" label_input="Mobile Number"/>
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

 <!--   <div class="row">
            <div class="col-md-6">
                <rn:widget path="input/BasicProductCategoryInput" name="Incident.Product" />

            </div>
    </div>-->
<br />
    <div class="row">
            <div class="col-md-6">
                <rn:widget path="custom/input/askCategoryInput" name="Incident.Category" required="true"  />
                <!--<rn:widget path="input/BasicProductCategoryInput" name="Incident.Category"/>-->
            </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <rn:widget path="input/FileAttachmentUpload" min_required_attachments = "1" max_required_attachment="1" loading_icon_path="/euf/assets/themes/standard/img/ajax-loader.gif"/>
        </div>
    </div>
    <br />
       <!-- <rn:widget path="input/FormSubmit" label_button="#rn:msg:SUBMIT_YOUR_QUESTION_CMD#" on_success_url="/app/msme/ask_confirm" error_location="rn_ErrorLocation"/>-->
       <button type="submit" id="rn_submitform"> Submit Your Question  </button>
        <rn:condition content_viewed="2" searches_done="1">
        <rn:condition_else/>
        <rn:widget path="input/SmartAssistantDialog" label_prompt="#rn:msg:OFFICIAL_SSS_MIGHT_L_IMMEDIATELY_MSG#"/>
        </rn:condition>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript">
       
        //$("#rn_submitform").on("submit", function (event) {
        //$( "#rn_submitform" ).click(function() {
        $("#rn_QuestionSubmit").validate({
              submitHandler: function(form) {
                //form.submit();
                var loanID = $('select[name="formData[Incident.CustomFields.CO.Loan.ID]"]').val();

                var getAttachmentElementID = jQuery('input[type="file"]').attr('id').toString();
                getAttachmentElementID = getAttachmentElementID.split("_FileInput");
                var FattachLength = jQuery("[id^='"+getAttachmentElementID[0]+"_Item']").length;
                
                if(loanID != "" && loanID != undefined && loanID != null)
                {
                    if(FattachLength>0){

                        var datastring = $("#rn_QuestionSubmit").serialize();
                            
                                $.ajax({
                                   url: '/cc/AjaxCustom/raiseQueryRequest',
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
                                       var html = '<p>Thanks for submitting your Request. Use this reference number for follow up: <b><a href="/app/msme/account/questions/detail/i_id/'+obj[0].value_id+'">'+obj[0].value_refno+'</a>.</b></p>';
                                       //alert(obj[0].value_id);
                                     //  console.log(obj);
                                       if (obj[0].value_id){
                                            bootbox.alert(html,function(){ window.location.href = '/app/msme/ask_confirm/i_id/'+obj[0].value_id; });
                                            
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
                    else{
                        alert("Kindly Attach Supporting Documents and try again.");
                        return false;
                    }
                }
                else{
                    alert("Kindly select an Agreement number");
                    return false;
                }
              }
        });
    </script>

    <script type="text/javascript">
        $('.setp').on('change', function (){
            q = $(this).val();

            $.ajax({
                url: '/cc/AjaxCustom/getProduct',
                data: 'agg_no='+q,
                method: 'post',
                beforeSend: function(){
                            $("#loader").removeClass("hidden");
                 },
                success: function (response) {
                    //$('#txtHint').html(data);
                     $("#loader").addClass("hidden");
                    $('select[name^="formData[Incident.Product]"] option[value="'+response+'"]').attr("selected","selected");
                }
            }).error(function() {
                bootbox.alert ('An error occured');
            });
    });

    $('#existing_contact').checkboxpicker();
    jQuery('#existing_contact').on('change', function (event) {
        if ($(this).prop('checked')) {
            //alert('checked');
            $('#e_email').hide();
            $('#e_mobile').hide();
        } else {
            //alert('unchecked');
            $('#e_email').show();
            $('#e_mobile').show();
        }
    });
    </script>
<rn:condition logged_in="true">
<div class="rn_SideRail">
        <div class="rn_Well">
            <h3>Existing Contact Details</h3>
            <ul>
                <li><strong>Email Address:</strong><?php echo $userData['sess_email'];?></li>
                 <li><strong>Mobile Number:</strong><?php echo $userData['mobileNumber'];?></li>
            </ul>
        </div>
    </div>
</rn:condition>
<style type="text/css">
    @media screen and (max-device-width: 480px) and (orientation: portrait) and (min-device-width: 360px){
        .rn_Email, .rn_Text{
                    width: 280px !important;
        }
    }
    
</style>
</div>