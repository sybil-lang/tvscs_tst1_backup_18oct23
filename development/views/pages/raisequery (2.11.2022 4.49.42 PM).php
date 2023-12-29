<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="standard.php" clickstream="incident_create"/>
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


            }
            .close-modal1 
            {
                position: absolute;
                top: -1.5px !important;
                right: -1.5px !important;
            }
            .modal1 {
                max-width: 20% !important;
            }
            #ex11 table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#ex11 table td, #ex11 table th {
  border: 1px solid #ddd;
  padding: 8px;
}

#ex11 table tr:nth-child(even){background-color: #f2f2f2;}

#ex11 table tr:hover {background-color: #ddd;}

#ex11 table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
  overflow: hidden;
    overflow-x: scroll;
}
     .modal2 {
                max-width: 48% !important;
            }
            #ex11 table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#ex112 table td, #ex11 table th {
  border: 1px solid #ddd;
  padding: 8px;
}

#ex112 table tr:nth-child(even){background-color: #f2f2f2;}

#ex112 table tr:hover {background-color: #ddd;}

#ex112 table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
  overflow: hidden;
    overflow-x: scroll;
}


    .mm
    {
            position: fixed;
    z-index: 9;
    left: 0;
    top: 80px;
    width: 100%;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
    }
    .title1
    {
        background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 30%;
    }
    .title
    {
        font-size: large;
        text-align: left !important;
    }
    .yesbtn
    {
        width: 50px;
    margin-top: 20px;
    background-color: green;
    color: white;
    }
     .nobtn
    {
        width: 50px;
    margin-top: 20px;
    background-color: red;
    color: white;
    }
#x1 {
    /*position: absolute;*/
    background: red;
    color: white;
    top: -10px;
    right: -10px;
}
#x2 {
    /*position: absolute;*/
    background: red;
    color: white;
    top: -10px;
    right: -10px;
}
.rn_TextInput
{
     margin-left: 0px !important;

}
form > button[type=submit]
{
    margin-left: 0px !important;
}
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
        <p>#rn:msg:NEED_A_QUICKER_RESPONSE_LBL# <a href="/app/social/ask">#rn:msg:ASK_OUR_COMMUNITY_LBL#</a></p>-->
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
    <div class="row">
        <div class="col-md-6">
            <label for="input-2">Use existing details for contacting me</label><br />
            <input id="existing_contact" name="existing_contact" type="checkbox" checked data-off-icon-cls="gluphicon-thumbs-down" data-on-icon-cls="gluphicon-thumbs-up">
        </div>
    </div>
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
  

 <!--   <div class="row">
            <div class="col-md-6">
                <rn:widget path="input/BasicProductCategoryInput" name="Incident.Product" />

            </div>
    </div>-->

    <div class="row">
            <div class="col-md-6">
                <rn:widget path="custom/input/askCategoryInput" name="Incident.Category" required="true"  />
                <!--<rn:widget path="input/BasicProductCategoryInput" name="Incident.Category"/>-->
            </div>
    </div>
       <div class="col-lg-12 col-md-12 col-sm-12" id="preferred" style="display: none;">
                <rn:widget path="input/FormInput" class="pf_add" name="Incident.CustomFields.c.preferred_address" required="true" initial_focus="true" label_input="Preferred Address"/>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12" id="dispatch" style="display: none;">
                <rn:widget path="input/FormInput" name="Incident.CustomFields.c.dispatchaddress" required="true" initial_focus="true" label_input="Dispatch Address"/>
                <div id="messageTerm">
                    
                </div>   
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12" id="pinnm" style="display: none;">
                <label for="pin">Pin Code <span class ="attachreq"></span></label><input class="rn_Text" type="text" name="pin" required="true" id="pincode" maxlength="6" pattern= "[0-9]+" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">  
            </div>
    <br />
      <div class="row">
        <div class="col-md-6">
            <rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <rn:widget path="input/FileAttachmentUpload"/>
        </div>
    </div>
    
       <!-- <rn:widget path="input/FormSubmit" label_button="#rn:msg:SUBMIT_YOUR_QUESTION_CMD#" on_success_url="/app/ask_confirm" error_location="rn_ErrorLocation"/>-->
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
              
            // your code...
                
                var datastring = $("#rn_QuestionSubmit").serialize();
                //var datastring = new FormData(this); // <-- 'this' is your form element

            
                //alert($('formData[Incident.CustomFields.CO.Loan.ID]').val());
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
                       var html = '<p>Thanks for submitting your Request. Use this reference number for follow up: <b><a href="/app/account/questions/detail/i_id/'+obj[0].value_id+'">'+obj[0].value_refno+'</a>.</b></p>';
                       //alert(obj[0].value_id);
                     //  console.log(obj);
                       if (obj[0].value_id){
                            bootbox.alert(html,function(){ window.location.href = '/app/ask_confirm/i_id/'+obj[0].value_id; });
                            
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

    <script type="text/javascript">
        var agg;
        $('.setp').on('change', function (){
            q = $(this).val();
 agg = $(this).val();
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
<div id='modal_dialog'style="display:none;" class="mm">
    
    
    <div class='title1'>
        <div style="display: flex;
    flex-direction: row;
    justify-content: flex-end;"><button id = "x1" style="display:none">
            X
        </button>
    </div>
        <div class='title'>
        </div>
        <div style="display:flex; justify-content: right;">
        <div class="" ><input type='button'class="yesbtn" value='yes' id='btnYes' /></div>
        <div class=""><input type='button' class="nobtn" value='no' id='btnNo' /></div>
        </div>
    </div>
</div>
<div id='modal_dialog2' style="display:none;" class="mm">
    
     <div class='title1'>
        <div class='title'>
        </div>
        <div align="right" class="yesbtn"><input  type='button'class="yesbtn" value='ok' id='btnYes2' /></div>
    </div>
    
</div>

<script>
    $('#btnYes2').on('click',function(){

$('#modal_dialog2').hide();
    });

</script>
<style type="text/css">
    @media screen and (max-device-width: 480px) and (orientation: portrait) and (min-device-width: 360px){
        .rn_Email, .rn_Text{
                    width: 280px !important;
        }
    }
     .bootbox-body
    {
        padding-top: 50px;

    }
    .modal-content {
     height: auto!important;
    overflow-y: scroll !important;
    position: fixed !important;
    top: -30px !important;
    width: auto !important;
}
.uderline
{
    text-decoration: underline !important;
}
</style>
</div>
<script type="text/javascript">
      var mobile="";
        var dob="";
        var customername="";
       

        function die()
        {
            window.stop();
            throw new Error("ERROR");
        }
         function soa(val)
            {
                var cat=document.getElementById('rn_askCategoryInput_36_Incident.Category').value;
                var ag_no=document.getElementById('rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID').value;
                if(val=='hard')
                {
                 $.ajax({
                            type: "POST",
                            url: "/cc/AjaxCustom/paymentgateway_urls",
                            async: false,
                            data: {   ag_no : ag_no,  cat : cat,mobile:mobile,dob:dob,customername:customername},
                            success: function(data) {
                                                  
                            dd=JSON.parse(data)
                             if(dd.ReturnID!=0)
                                             {
                                                
                             
                              console.log(dd);

                              
                                  window.open(dd.ReturnURL, '_blank');
                                

                           die(); 
                         }   
                         else
                         {
                            alert("The requested details not found. Please contact customer care for further information");
                         } 
                          
                                                   
                                               }
                                              });
                }
                else
                {
                    window.location.href="https://tvscs.custhelp.com/app/customer/selfserviceview/load/"+ag_no;
                    return false;

                }
                die();

            }
        $(document).ready(function(){
        <?php 
        $msgbase = \RightNow\Connect\v1_3\Messagebase::fetch("CUSTOM_MSG_Category_for_Dispatch_address");
        $category_list = $msgbase->Value;
        ?>
        $('select[name="Incident.CustomFields.c.preferred_address"]')[0][1].remove();
        $('select[name="Incident.CustomFields.c.preferred_address"]').attr("required","true");


$('select[name="formData[Incident.Category]"').change( function ()
 { $('#messageTerm').html("");
    document.getElementById('rn_SelectionInput_38_Incident.CustomFields.c.preferred_address').value="";
    document.getElementById('pinnm').style.display = "none";
    document.getElementById('pincode').value = "";
    document.getElementById('rn_TextInput_40_Incident.CustomFields.c.dispatchaddress').value="";
    // document.getElementById('dispatch').value="";
    var categories = [<?php echo $category_list; ?>];

    if(categories.includes(Number($('select[name="formData[Incident.Category]"]').val())) == true)

    {
        // console.log("Here");
        document.getElementById('dispatch').style.display = "block";
        document.getElementById('preferred').style.display = "block";
        document.getElementById('pinnm').style.display = "block";

    }
    else
    {
        // console.log("not here");
        document.getElementById('dispatch').style.display = "none";
        document.getElementById('preferred').style.display = "none";
        document.getElementById('pinnm').style.display = "none";

    }

 });

   $('select[name="Incident.CustomFields.c.preferred_address"]').change( function (){
        var aggr = agg.split("_");
        var aggrno = aggr[1];
       var value= document.getElementsByName('Incident.CustomFields.c.preferred_address')[0].value;
       if (value=="254") //registered address
       { 
            $("#pincode").attr('readonly', true);
            $('.attachreq').html("").removeClass("rn_Required").attr("aria-label","");
            if(agg != undefined)
            {
                  
                  var adType="RA";
                  $.ajax({
                    url: '/cc/AjaxCustom/getdispatchadd',
                    data: {agreement_no:aggrno , adType:adType},
                    method: 'post',
                    beforeSend: function(){
                        $("#loader").removeClass("hidden");
                    },
                    success: function (response) 
                    {
                        //$('#txtHint').html(data);
                        $("#loader").addClass("hidden");
                         $("#loader").attr('readonly', true);
                         response=JSON.parse(response)

                         console.log(response);
                         if(response.ReturnMessage=="SUCCESS")
                         {
                            var address = "";
                            if(response.ReturnObject.AddressLine3 != "" && response.ReturnObject.AddressLine2 != "" && response.ReturnObject.AddressLine1 != ""){
                                address = response.ReturnObject.AddressLine1+" , "+response.ReturnObject.AddressLine2+" , "+response.ReturnObject.AddressLine3;
                            }
                            else if(response.ReturnObject.AddressLine2 != "" && response.ReturnObject.AddressLine1 != "" &&  response.ReturnObject.AddressLine3 == ""){
                                address = response.ReturnObject.AddressLine1+" , "+response.ReturnObject.AddressLine2;

                            }
                            else if(response.ReturnObject.AddressLine1 != "" && response.ReturnObject.AddressLine2 == "" && response.ReturnObject.AddressLine3 == ""){
                                address = response.ReturnObject.AddressLine1;
                            }
                            else{
                                address = "";
                            }
                            if(response.ReturnObject.Landmark != ""){
                                address = address + ", "+response.ReturnObject.Landmark;
                            }    
                           document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].value=address;
                           document.getElementById('pincode').value=response.ReturnObject.PinCode;
                           // $('#pincode').addClass("hidden");
                           document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].readOnly = true;


                         }
                    }
                }).error(function() {
                    $("#loader").addClass("hidden");
                    bootbox.alert('An error occured');
                });
            }
            else{
                alert("Please Select agreement number first.");
                console.log($(this).val());

            }
            $('#messageTerm').html("");   
       }
       else if(value == "253"){
        $("#pincode").attr('readonly', false);
           
           document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].value = "";
           document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].readOnly = false;
           $("#pincode").val("");
           var note = "<ol id='pointersList'><li>NOTE: </li><li>1. You have selected a new address for dispatch of this document. Please attach a valid address proof for the new address.</li> <li>2. The address proof is subject to approval as per organization policy.</li><li>3. Please note that this address would be used only to dispatch thisparticular document requested by you. If you wish to change your address permanently for future reference, raise your request at our Customer Care.</li></ol>";
            $('#messageTerm').html(note).css("color","red");
            $('.attachreq').html("*").addClass("rn_Required").attr("aria-label","Required");
       }
       else{
            $('#messageTerm').html("");
            $('span.attachreq').html("").removeClass("rn_Required").attr("aria-label","");
       }
        // you can also check: this.selected
    });

////////////////////////////////////////////////////////////////////////////////////////////////////////
        $('#rn_submitform').on('click',function(e)
        {
         e.preventDefault();
         var cat=document.getElementById('rn_askCategoryInput_36_Incident.Category').value;
         var ag_no=document.getElementById('rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID').value;
         var address=document.getElementById('rn_SelectionInput_38_Incident.CustomFields.c.preferred_address').value;
         var daddress=document.getElementById('rn_TextInput_40_Incident.CustomFields.c.dispatchaddress').value;
         var pin=document.getElementById('pincode').value;
         var Question=document.getElementById('rn_TextInput_42_Incident.Threads').value;
         var subjectt=document.getElementById('rn_TextInput_35_Incident.Subject').value;
// if(cat&&ag_no&&address&&daddress&&pin&&Question&&subjectt)
// {       
                    //53 duplicate noc 
                    //58 noc request 
                    //84 balance query   
                    //93 f/c     
                    //86 statement of amount req  
                    //1812 CD- NDC softcopy  
                    //1891 Swapping Enquiry 
                    //insurance 77         
    var deta="";
           // if((cat==53||cat==58||cat==84||cat==93||cat==86||cat==1812||cat==1891 ||cat==77)&&ag_no)
           if((cat==53||cat==84||cat==1891||cat==1812||cat==86||cat==93||cat==77||cat==1812 )&&ag_no)

           {

            if(cat&&ag_no&&address&&daddress&&pin&&Question&&subjectt)
            // if(cat&&ag_no&&Question&&subjectt)

            {


            }
            else
            {
                if(cat!=1891&&cat!=84&&cat!=1812&& cat!=86)
                {
                    if((cat==93||cat==77)&&ag_no&&Question&&subjectt)
                    {

                    }
                    else
                    {
                      $('#rn_QuestionSubmit').submit();
                     die();  
                    }
                     
               
                     
                }
            }
            $.post('/cc/AjaxCustom/ca_api', { method : 'getapimessage',  ag_no : ag_no,  cat : cat})
                                                    .done(function( data ) 
                                                    {
                                                 // customalrtbox(data);
                                                  var daata= JSON.parse(data);
                                                  deta=daata;
                                                   dob=deta.dob;
                                                   mobile =deta.mobile;
                                                   customername=deta.customername;
                                                   response=deta.responseSent;
                                                  if(cat==1891)//1891 Swapping Enquiry
                                                  {
                                             


                                                     $.ajax({
                                                            type: "POST",
                                                            url: "/cc/AjaxCustom/paymentgateway_urls",
                                                            async: false,
                                                            data: {   ag_no : ag_no,  cat : cat,mobile:mobile,dob:dob,customername:customername},
                                                            success: function(data) {
                                                                                              // .done(function( data ) 
                                                                                              //     {
                                                                                                     dd=JSON.parse(data)  
                                                                                                     console.log(dd);
                                                                                                     if(dd.ReturnID!=0)
                                                                                                     {

                                                                                                          bootbox.alert("Dear customer, If you wish to change your loan repayment account to another account, you would be required to pay the swapping charges and submit the new account details to us. <br><br><a class=\"uderline\" href=\""+dd.ReturnURL+"\" target=\"_blank\">Please click here </a> to pay now.<br><br><p style=\"color:red;\">Please note that the EMI deduction is subject to receipt of new bank details / required documents and subject to approvals.</p>",function(){ location.reload(); });

                                                                                                                                                                                                                      
                                                                                                         
                                                                                                      die();
                                                                                                     }   
                                                                                                     else
                                                                                                     {
                                                                                                        
                                                                                                         }  
                                                                                                        bootbox.alert("Dear Customer, Repayment swapping is applicable only for the live loans. Your request can’t be processed since your loan is not active.",function(){ location.reload(); });
                                                                                                       
                                                                                                      die();                                                                                          
                                                                                                        
                                                                                                  }
                                                                                              });
                                                                                             
                                                  }

                                                  if(cat==77)
                                                  {

                                                    $.ajax({
                                                                    type: "POST",
                                                                    url: "/cc/AjaxCustom/apiHITSfor_digitization",
                                                                    async: false,
                                                                    data: {   method : 'getapimessage',  ag_no : ag_no,  cat : cat,mobile:mobile},
                                                                    success: function(data) {
                                                                        
                                                                            // dd=d;
                                                                            var dd="";

                                                                            if(data.length<=94)
                                                                            {
                                                                            d = data.replace(/(\r\n|\n|\r)/gm, "");
                                                                            dd=JSON.parse(d)
                                                                            dd=JSON.parse(dd)                                                                            
                                                                            }
                                                                           var agg_no= ag_no.split('_')



                                                                                var r="";

                                                                                 if(dd.Status_Code!=0)
                                                                                 {
                                                                                       r = "Please click here <a class=\"uderline\" target=\"_blank\" href=\"https://customeroperationapi.tvscredit.com/InsuranceRenewal/InsurancecopyRenewalDocuments?AgreementNo="+agg_no[1]+"\">-https://..</a>to download the Insurance Copy.";  
                                                                                 }
                                                                                 else
                                                                                 {
                                                                                      r = "Sorry, we could not find the document.";

                                                                                 }

                                                                                  bootbox.alert(r,function(){ location.reload(); });

                                                                                                                                                                                                  
                                                                                 
                                                                              die();
                                                                            } 
                                                                        });

                                                  }
                                                  if(cat==1812)//1812 CD- NDC softcopy
                                                  {
                                                     $.ajax({
                                                                    type: "POST",
                                                                    url: "/cc/AjaxCustom/cdndc",
                                                                    async: false,
                                                                    data: {   method : 'getapimessage',  ag_no : ag_no,  cat : cat,mobile:mobile},
                                                                    success: function(data) {

                                                                        // console.log(data)
// 
                                                                        var s=data.toLowerCase();
                                                                        // let strippedHtml = s.replace(/<[^>]+>/g, '');

                                                                        // console.log(s)

                                                        if(s.includes("no data found") !== false)
                                                        {
                                                            // console.log(s)

                                                            bootbox.alert("Sorry, we could not find the document.",function(){ location.reload(); });
                                                        }
                                                        else
                                                        {
                                                              const myArray = ag_no.split("_");
                                                                                    var href='https://rmsnew.tvscredit.com/rms/Jasper?AGRNO='+myArray[1]+'&report=NOC_FOR_CDPORTFOLIO.pdf';
                                                                                     bootbox.alert("CD NDC soft copy can be downloaded through customer portal & Saathi app.  <a class=\"uderline\" target='_blank' href='"+href+" '>Click here to download</a>",function(){ location.reload(); });
                                                        }




                                                  
                                                                                  

                                                                                       
                                                                                     die();     
                                                                                     } 

                                                            });
                                                            
                                                }

                                                   if(cat==86) //86 statement of amount req soft copy
                                                  {


                                                            // $("#ex112").html('');
                                                            var hard="hard";
                                                            var soft = "soft";

                                                           bootbox.alert('<div style="display: flex;justify-content: space-around;flex-direction: column"><p style="font-size: larger;">Your loan statement copy can be downloaded through customer portal & Saathi app.<span value="soft" class="uderline"  onclick="soa(\'soft\')" style="font-weight:800; cursor: pointer;"> Click here to download Soft Copy </span></p><br><br><p style="font-size: larger;" > Hard copy of loan statement is chargeable.<span style="font-weight:800;   cursor: pointer;" value="hard" class="uderline" onclick="soa(\'hard\')"> Click here </span>to make the payment and place your request.  </p><br></div>',function(){ location.reload(); });
                                                             
                                                            // die();
                                                            return;

                                                            
                                                        
                                                  
                                                }

                                                   if(daata.status)
                                                    {

                                                          if(daata.status!="2")
                                                        {
                                                                     var Stat="Unresolved";
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

                                                                                                                if(cat==53)
                                                                                                                {
                                                                                                                 bootbox.alert('Your NOC request is already registered with us. We will revert to you on this at the earliest. <br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >'+ daata.LookupName+'</td></tr></table>',function(){ location.reload(); });
                                                                                                                }
                                                                                                                if(cat==58)
                                                                                                                {
                                                                                                                 bootbox.alert('   Your NOC request is already registered with us. We will revert to you on this at the earliest<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >'+ daata.LookupName+'</td></tr></table>',function(){ location.reload(); });
                                                                                                                }
                                                                                                                if(cat!=58 && cat!=53)
                                                                                                                {
                                                                                                                 bootbox.alert('   Your request is already registered with us. We will revert to you on this at the earliest. <br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >'+ daata.LookupName+'</td></tr></table>',function(){ location.reload(); });
                                                                                                                }
                                                                                                               

                                                                    die();
                                                            
                                                        }
                                                        else 
                                                           {    
                                                                   var Stat="Resolved";                                                             
                                                                    $.ajax({
                                                                    type: "POST",
                                                                    url: "/cc/AjaxCustom/apiHITSfor_digitization",
                                                                    async: false,
                                                                    data: {   method : 'getapimessage',  ag_no : ag_no,  cat : cat,mobile:mobile},
                                                                    success: function(data) {



                                                                            d = data.replace(/(\r\n|\n|\r)/gm, "");
                                                                            dd=d;

                                                                             if(dd=="No Data Found")
                                                                             {
                                                                               
                                                                                bootbox.alert('The requested details not found. Please contact customer care for further information',function(){ location.reload(); });
                                                                                die();

                                                                             }
                                                                             if(cat==77)
                                                                             {

                                                                             }
                                                                           if(cat==93)
                                                                                {
                                                                                   dd=JSON.parse(d)
                                                                                   // dd=JSON.parse(dd)  
                                                                                }
                                                                                else
                                                                                {
                                                                                    dd=JSON.parse(d)
                                                                                   dd=JSON.parse(dd)  
                                                                                }
                                                                            console.log(dd);
                                                                            var checkstatus= dd.Status_Code;
                                                                            if(cat==84)
                                                                                {
                                                                                    checkstatus=dd.length;
                                                                                }
                                                                                if(cat==93)
                                                                                {
                                                                                    checkstatus=dd.ReturnOutput[0].NO_OF_INS_PAID;
                                                                                    if(checkstatus>5)
                                                                                    {
                                                                                        checkstatus=1;
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        checkstatus=0;
                                                                                    }
                                                                                }
                                                                                var string=dd.Result;
                                                                            if(checkstatus>0)
                                                                            {
                                                                                if(cat!=77 && cat!=84 && cat!=93)//insurance 77//84 balance query
                                                                                {
                                                                                      
                                                                                   
                                                                                    
                                                                                     if(cat==53||cat==58)//58 noc request//53 duplicate noc
                                                                                    {
                                                                                         string=dd.Result;
                                                                                       var s=string.toLowerCase();
                                                        if(s.includes("active") !== false){
                                                                                              
                                                                                            bootbox.alert(dd.Result,function(){ location.reload(); })
                                                                                               die();
                                                                                            } 
                                                                                            if(cat==58)
                                                                                            {
                                                                                                var r = dd.Result+"<br>A request has been raised in this regard .<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >"+ daata.LookupName+"</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Status</p></td><td nowrap=\"\" valign=\"bottom\" >"+Stat+"</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Response Sent</p></td><td  valign=\"bottom\" >"+ response+"</td></tr></tbody></table><br>";

                                                                                                
                                                                                                            var warning = r;
                                                                                                            $('.title').html(warning);
                                                                                                            $("#modal_dialog").show();

                                                                                                              
                                                                                                                $('#btnYes').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                       $('#rn_QuestionSubmit').submit()

                                                                                                                });
                                                                                                                  $('#btnNo').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                      // window.open(dd.ReturnURL, '_blank');
                                                                                                                });   
                                                                                               
                                                                                            }
                                                                                     // return;
                                                                                    }
                                                                                }
                                                                                if(cat==93)
                                                                                   {
                                                                                    // var r = 'Net foreclosure amount : '+dd.ReturnOutput[0].NET_OVERDUEAMOUNT+' Subject: '+ daata.Subject+'\n Reference #: '+ daata.LookupName+'\n Status:'+Stat+' \n Date Created: '+ daata.dateCreated+'\nDo you still want to raise a request?';
                                                                                    var r="<br>A request has been raised in this regard .<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >"+ daata.LookupName+"</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Status</p></td><td nowrap=\"\" valign=\"bottom\" >"+Stat+"</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Response Sent</p></td><td  valign=\"bottom\" >"+ response+"</td></tr></tbody></table><br> Do you still want to raise a request?"


                                                                                                             var warning = r;
                                                                                                            $('.title').html(warning);
                                                                                                            $("#modal_dialog").show();

                                                                                                              
                                                                                                                $('#btnYes').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                       $('#rn_QuestionSubmit').submit();
                                                                                                                       return;

                                                                                                                });
                                                                                                                  $('#btnNo').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                      // window.open(dd.ReturnURL, '_blank');
                                                                                                                });   
                                                                                               
                                                                                   }
                                                                                if(cat==84)//84 balance query
                                                                                {
                                                                                    if(dd.length)
                                                                                    {
                                                                                        console.log(dd[0]);

                                                                                    var keys = Object.keys(dd[0]);
                                                                                    var val =Object.values(dd[0]);

                                                                                    console.log(keys,val)
                                                                                   
                                                                                            var r = "<br>A request has been raised in this regard .<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >"+ daata.LookupName+"</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Status</p></td><td nowrap=\"\" valign=\"bottom\" >"+Stat+"</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Response Sent</p></td><td  valign=\"bottom\" >"+response+"</td></tr></tbody></table><br> Do you still want to raise a request?";
                                                                                                  var warning = r;
                                                                                                            $('.title').html(warning);
                                                                                                            $("#modal_dialog").show();

                                                                                                              
                                                                                                                $('#btnYes').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                       $('#rn_QuestionSubmit').submit();
                                                                                                                       return;

                                                                                                                });
                                                                                                                  $('#btnNo').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                      // window.open(dd.ReturnURL, '_blank');
                                                                                                                });
                                                                                        
                                                                                    }

                                                                                   
                                                                                    


                                                                                }

                                                                                
                                                                                  dob=deta.dob;
                                                                                 mobile=deta.mobile;

                                                                                 if(deta.Cat==53)//53 duplicate noc
                                                                                 {
                                                                                                       $.ajax({
                                                                                    type: "POST",
                                                                                    url: "/cc/AjaxCustom/paymentgateway_urls",
                                                                                    async: false,
                                                                                    data: {   ag_no : ag_no,  cat : cat,mobile:mobile,dob:dob,customername:customername},
                                                                                    success: function(data) {
                                                                                                            dd=JSON.parse(data)
                                                                                                             // dd=JSON.parse(dd)
                                                                                                              console.log(dd);
                                                                                                                if(dd.ReturnID!=0)
                                                                                                     {
                                                                                                    

                                                                                                              // var r = ('\n Subject: '+ daata.Subject+'\n Reference #: '+ daata.LookupName+'\n Status:'+Stat+' \n Date Created: '+ daata.dateCreated+'\nDo you still want to raise a request?');
                                                                                                                   var warning = "<br>A request has been raised in this regard .<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >"+ daata.LookupName+"</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Status</p></td><td nowrap=\"\" valign=\"bottom\" >"+Stat+"</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Response Sent</p></td><td  valign=\"bottom\" >"+response+"</td></tr></tbody></table><br>Duplicate NOC is chargeable. Please click here to make an online payment <a class=\"uderline\" target=\"_blank\" href=\""+dd.ReturnURL+"\">payment gateway link</a> and place your request for duplicate NOC.";
                                                                                                            $('.title').html(warning);
                                                                                                            $("#modal_dialog").show();

                                                                                                              
                                                                                                                $('#btnYes').hide();
                                                                                                                 $('#btnNo').hide();
                                                                                                                 $('#x1').show();



                                                                                                                $('#x1').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                     // window.open(dd.ReturnURL, '_blank');
                                                                                                                     //   $('#rn_QuestionSubmit').submit()

                                                                                                                });
                                                                                                                  $('#btnNo').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                      // window.open(dd.ReturnURL, '_blank');
                                                                                                                });



                                                                                                               

                                                                                                             die(); 
                                                                                                     }   
                                                                                                     else
                                                                                                     {
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
                                                                                                        bootbox.alert("The requested details not found. Please contact customer care for further information",function(){ location.reload(); });
                                                                                                     } 

                                                                                                              // window.location()

                                                                                                          }
                                                                                                      });

                                                                                 }
                                                                            }
                                                                                            else
                                                                                            {
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
                                                                                                bootbox.alert('The requested details not found. Please contact customer care for further information',function(){ location.reload(); });
                                                                                            }
                                                                         }
                                                                 });
                                                            }

                                                    } 
                                                    else
                                                   {
                                                                 // var Stat="Resolved";                                                             
                $.ajax({
                type: "POST",
                url: "/cc/AjaxCustom/apiHITSfor_digitization",
                async: false,
                data: {   method : 'getapimessage',  ag_no : ag_no,  cat : cat,mobile:mobile},
                success: function(data) 
                {

                        d = data.replace(/(\r\n|\n|\r)/gm, "");
                        dd=d;
                          if(dd=="No Data Found")
                         {
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

                            bootbox.alert('The requested details not found. Please contact customer care for further information',function(){ location.reload(); });
                            die();

                         }
                         if(cat==77)
                         {
                            
                          }
                        if(cat==93)
                        {
                           dd=JSON.parse(d)
                           // dd=JSON.parse(dd)  
                        }
                        else
                        {
                            dd=JSON.parse(d)
                           dd=JSON.parse(dd)  
                        }

                        console.log(dd);
                        var checkstatus= dd.Status_Code;
                        if(cat==84)
                        {
                            checkstatus=dd.length;
                        }
                        if(cat==93)
                        {
                            checkstatus=dd.ReturnOutput[0].NO_OF_INS_PAID;
                            if(checkstatus>5)
                            {
                                checkstatus=1;
                            }
                            else
                            {
                                checkstatus=0;
                            }
                        }
                        var string=dd.Result;
                        if(checkstatus>0)
                        {
                                                if(cat!=77 && cat!=84 && cat!=93 )//insurance 77//84 balance query
                                                {
                                                      if(cat!=58){function customalrtbox(msg) {
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
                                                   
                                                    
                                                     if(cat==53||cat==58)//58 noc request//53 duplicate noc
                                                    {
                                                         string=dd.Result;
                                                         var s=string.toLowerCase();
                                                        if(s.includes("active") !== false){
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
                                                            bootbox.alert(dd.Result,function(){ location.reload(); })
                                                               die();
                                                            } 
                                                            if(cat==58)
                                                            {
                                                                var r = (dd.Result+'<br>Do you still want to raise a request');
                                                                          var warning = r;
                                                                                                            $('.title').html(warning);
                                                                                                            $("#modal_dialog").show();

                                                                                                              
                                                                                                                $('#btnYes').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                     // window.open(dd.ReturnURL, '_blank');
                                                                                                                       $('#rn_QuestionSubmit').submit()
                                                                                                                       return;

                                                                                                                });
                                                                                                                  $('#btnNo').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                      // window.open(dd.ReturnURL, '_blank');
                                                                                                                });
                                                            }
                                                     // return;
                                                    }
                                                }
                                                if(cat==93)
                                                                                   {
                                                                                    var r = 'Your Foreclosure amount is Rs'+dd.ReturnOutput[0].NET_OVERDUEAMOUNT+' <a class=\"uderline\" target=\"_blank\" href="https://tvscs.custhelp.com/app/customer/selfserviceview/load/'+ag_no+'">Please click here to download the F/C statement copy </a> <br> Do you still want to raise a request?';


                                                                                                             var warning = r;
                                                                                                            $('.title').html(warning);
                                                                                                            $("#modal_dialog").show();

                                                                                                              
                                                                                                                $('#btnYes').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                       $('#rn_QuestionSubmit').submit();
                                                                                                                       return;

                                                                                                                });
                                                                                                                  $('#btnNo').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                      // window.open(dd.ReturnURL, '_blank');
                                                                                                                });   
                                                                                               
                                                                                   }
                                            if(cat==84)//84 balance query
                                            {
                                                        if(dd.length)
                                                        {
                                                                console.log(dd[0]);

                                                                var keys = Object.keys(dd[0]);
                                                                var val =Object.values(dd[0]);

                                                                console.log(keys,val)
                                                                
                                                                        var r = ('\nYour overdue amount is '+dd[0].OverdueAmount+'Do you still want to raise a request?');
                                                                                      var warning = r;
                                                                                                            $('.title').html(warning);
                                                                                                            $("#modal_dialog").show();

                                                                                                              
                                                                                                                $('#btnYes').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                     // window.open(dd.ReturnURL, '_blank');
                                                                                                                       $('#rn_QuestionSubmit').submit()
                                                                                                                       return;

                                                                                                                });
                                                                                                                  $('#btnNo').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                      // window.open(dd.ReturnURL, '_blank');
                                                                                                                });
                                                                        
                                                        }

                                             }

                                          
                                                                                                     
                                              dob=deta.dob;
                                             mobile=deta.mobile;

                                             if(deta.Cat==53)//53 duplicate noc
                                             {
                                                                   $.ajax({
                                                                            type: "POST",
                                                                            url: "/cc/AjaxCustom/paymentgateway_urls",
                                                                            async: false,
                                                                            data: {   ag_no : ag_no,  cat : cat,mobile:mobile,dob:dob,customername:customername},
                                                                            success: function(data) {
                                                                            dd=JSON.parse(data)
                                                                             // dd=JSON.parse(dd)
                                                                              console.log(dd);
                                                                                if(dd.ReturnID!=0)
                                                                                                     {
                                                                                                      

                                                                                                       var warning = "Duplicate NOC is chargeable. Please click here to make an online payment <a target=\"_blank\" class=\"uderline\" href=\""+dd.ReturnURL+"\">payment gateway link</a> and place your request for duplicate NOC.";
                                                                                                            $('.title').html(warning);
                                                                                                            $("#modal_dialog").show();

                                                                                                              
                                                                                                                $('#btnYes').hide();
                                                                                                                 $('#btnNo').hide();
                                                                                                                 $('#x1').show();



                                                                                                                $('#x1').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                     // window.open(dd.ReturnURL, '_blank');
                                                                                                                     //   $('#rn_QuestionSubmit').submit()

                                                                                                                });
                                                                                                                  $('#btnNo').one('click', function(){
                                                                                                                    $("#modal_dialog").hide();
                                                                                                                      // window.open(dd.ReturnURL, '_blank');
                                                                                                                });

                                                                                                             die(); 
                                                                                                     }   
                                                                                                     else
                                                                                                     {
                                                                                                          
                                                                                                        bootbox.alert("The requested details not found. Please contact customer care for further information",function(){ location.reload(); });
                                                                                                     } 

                                                                              // window.location()

                                                                                }
                                                                         });

                                             }
                        }
                        else
                        {
                              
                            bootbox.alert('The requested details not found. Please contact customer care for further information',function(){ location.reload(); });
                        }
                 }
            });
                                                         }
                                                    

                                             });
           }
           else
           {
            $('#rn_QuestionSubmit').submit()

           }

           
        });
});

var test=document.getElementById("rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID").value
function agg_val()
        {
             test=document.getElementById("rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID").value
            // if(test)
            // {
            //     location.reload();
            // }
            
        }
function agg_reload()
        {
            // var test=document.getElementById("rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID").value
            if(test)
            {
                
                document.getElementById("rn_SelectionInput_38_Incident.CustomFields.c.preferred_address").value='';
                document.getElementById("rn_TextInput_35_Incident.Subject").value='';
                document.getElementById("pincode").value='';
                document.getElementById("rn_TextInput_42_Incident.Threads").value='';
                document.getElementById("rn_TextInput_40_Incident.CustomFields.c.dispatchaddress").value='';

                
                document.getElementById("rn_askCategoryInput_36_Incident.Category").value='';
                $('select[name="formData[Incident.Category]"').trigger("change");


                


               
                
                // location.reload();
            }
            
        }
        document.getElementById("rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID").addEventListener("change", agg_reload);
document.getElementById("rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID").addEventListener("click", agg_val);
</script>