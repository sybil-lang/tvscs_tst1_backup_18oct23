o
<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="standard.php" clickstream="incident_create" />
<?php
$CI = &get_instance();

$contact_id = $CI->session->getProfileData("c_id");
//$mobile = $CI->session->getSessionData("mobileNumber");
$userData = $CI->session->getSessionData('userProfile');
?>
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

<script src="/euf/assets/themes/standard/js/bootstrap-checkbox.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script> -->

<!-- jQuery Modal -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> -->
<!-- <script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script> -->
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
    <center>
        <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
    </center>
</div>
<div class="rn_Hero">
    <div class="rn_Container">
        <h1>#rn:msg:SUBMIT_QUESTION_OUR_SUPPORT_TEAM_CMD#</h1>
        <p>#rn:msg:OUR_DEDICATED_RESPOND_WITHIN_48_HOURS_MSG#</p>
    </div>
</div>

<div id="ex1" class="modal">
    <div id="ex11" style="font-size: large;"></div>

    <!-- <a href="#" rel="modal:close">Close</a> -->
</div>
<div id="ex12" class="modal2">
    <div id="ex112"></div>

    <!-- <a href="#" rel="modal:close">Close</a> -->
</div>

<div class="rn_PageContent rn_AskQuestion rn_AccountOverview rn_Container">
    <form id="rn_QuestionSubmit" method="post" action="#" class="styled" enctype="multipart/form-data">
        <div id="rn_ErrorLocation"></div>
        <rn:condition logged_in="false">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#" />
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true" />
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true" />
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <rn:widget path="input/FormInput" name="Incident.Subject" required="true" label_input="#rn:msg:SUBJECT_LBL#" />
                </div>
                <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                    <rn:widget path="input/FormInput" name="Contact.Phones.Mobile" required="true" initial_focus="true" label_input="Mobile Number"/>

                </div> -->
            </div>
        </rn:condition>
        <div class="row">
            <rn:condition logged_in="true">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <rn:widget path="custom/input/agreementSelect/" name="Incident.CustomFields.CO.Loan.ID" required="true" label_input="Agreement Number" />
                </div>

                <!-- <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="input-2">Agreement Number</label><br />

                    <input type="text" name="ag_no" id="ag_no" readonly data-off-icon-cls="gluphicon-thumbs-down" data-on-icon-cls="gluphicon-thumbs-up">
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="input-2">Use existing details for contacting me</label><br />
                    <input id="existing_contact" name="existing_contact" type="checkbox" checked data-off-icon-cls="gluphicon-thumbs-down" data-on-icon-cls="gluphicon-thumbs-up">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12" id="e_email" style="display:none;">
                    <rn:widget path="input/FormInput" name="Incident.CustomFields.c.incident_email_id" required="true" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#" />
                    <!-- <input type="email" name="email_id" id="email_id" readonly  data-off-icon-cls="gluphicon-thumbs-down" data-on-icon-cls="gluphicon-thumbs-up"> -->
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12" id="e_mobile" style="display:none;">
                    <rn:widget path="input/FormInput" name="Incident.CustomFields.c.incident_mobile_number" required="true" initial_focus="true" label_input="Mobile Number" />
                    <!-- <input type="tel" name="mobile" id="mobile" readonly  data-off-icon-cls="gluphicon-thumbs-down" data-on-icon-cls="gluphicon-thumbs-up"> -->
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#" />
                    <!-- <input type="text" name="subject" id="subject" readonly  data-off-icon-cls="gluphicon-thumbs-down" data-on-icon-cls="gluphicon-thumbs-up"> -->
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <rn:widget path="custom/input/askCategoryInput" name="Incident.Category" required="true" />
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12" id="preferred" style="display: none;">
                    <rn:widget path="input/FormInput" class="pf_add" name="Incident.CustomFields.c.preferred_address" required="true" initial_focus="true" label_input="Preferred Address" />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12" id="dispatch" style="display: none;">
                    <rn:widget path="input/FormInput" name="Incident.CustomFields.c.dispatchaddress" required="true" initial_focus="true" label_input="Dispatch Address" />
                    <div id="messageTerm">

                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12" id="pinnm" style="display: none;">
                    <label for="pin">Pin Code <span class="attachreq"></span></label><input class="rn_Text" type="text" name="pin" required="true" id="pincode" maxlength="6" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                </div>

            </rn:condition>


            <div class="col-lg-6 col-md-6 col-sm-12">
                <rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#" />
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 80px;">
                <input type="hidden" name="co_id" value="<?php echo $contact_id; ?>" />
                <!-- <rn:widget path="input/FileAttachmentUpload"/> -->
                <label for="file">Attachment <span class="attachreq"></span></label>

                <input type="file" id="rn_FileAttachmentUpload_43_FileInput" class="valid" name="file">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <button type="submit" id="rn_submitform" style="background-color: #0e8943;opacity: 1;width: 280px;height: 40px; border: 2px solid rgba(0, 0, 0, .03); border-radius: 25px; color: #fff; font-size: 13px; text-transform: uppercase; transition: all .45s ease-in-out 0s;">Submit Your Question</button>
            </div>
            <rn:condition logged_in="true">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="rn_SideRail">
                        <div class="rn_Well">
                            <h3>Existing Contact Details</h3>
                            <ul>
                                <li><strong>Email Address:</strong><?php echo $userData['sess_email']; ?></li>
                                <li><strong>Mobile Number:</strong><?php echo $userData['mobileNumber']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </rn:condition>
        </div>

    </form>
</div>
<style type="text/css">
    #rn_TextInput_11,
    #rn_TextInput_13,
    #rn_TextInput_15,
    #rn_TextInput_9,
    #rn_TextInput_7,
    #rn_TextInput_35,
    #rn_TextInput_41,
    #rn_TextInput_31,
    #rn_TextInput_33,
    #rn_TextInput_39 {
        margin-left: 0px !important;



    }

    .close-modal1 {
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

    #ex11 table td,
    #ex11 table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #ex11 table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #ex11 table tr:hover {
        background-color: #ddd;
    }

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

    #ex112 table td,
    #ex11 table th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #ex112 table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #ex112 table tr:hover {
        background-color: #ddd;
    }

    #ex112 table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        overflow: hidden;
        overflow-x: scroll;
    }


    .mm {
        position: fixed;
        z-index: 9;
        left: 0;
        top: 80px;
        width: 100%;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .title1 {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
    }

    .title {
        font-size: large;
        text-align: left !important;
    }

    .yesbtn {
        width: 50px;
        margin-top: 20px;
        background-color: green;
        color: white;
    }

    .nobtn {
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

    .modal-footer button {
        color: black !important;
    }
</style>
<div id='modal_dialog' style="display:none;" class="mm">


    <div class='title1'>
        <div style="display: flex;
        flex-direction: row;
        justify-content: flex-end;"><button id="x1" style="display:none">
                X
            </button>
        </div>
        <div class='title'>
        </div>
        <div style="display:flex; justify-content: right;">
            <div class=""><input type='button' class="yesbtn" value='yes' id='btnYes' /></div>
            <div class=""><input type='button' class="nobtn" value='no' id='btnNo' /></div>
        </div>
    </div>
</div>
<div id='modal_dialog2' style="display:none;" class="mm">

    <div class='title1'>
        <div class='title'>
        </div>
        <div align="right" class="yesbtn"><input type='button' class="yesbtn" value='ok' id='btnYes2' /></div>
    </div>

</div>

<script>
    if (localStorage.getItem('agno')) {
        // document.getElementById('rn_TextInput_34_Incident.Subject').value = localStorage.getItem('agno');
    }
    // if (localStorage.getItem('email')) {

    //     document.getElementById('email_id').placeholder = localStorage.getItem('email');
    // }
    if (localStorage.getItem('subjectt')) {
        document.getElementById('rn_TextInput_34_Incident.Subject').value = localStorage.getItem('subjectt');
    }
    // if (localStorage.getItem('mobile')) {
    //     document.getElementById('mobile').placeholder = localStorage.getItem('mobile');
    // }




    // document.addEventListener("DOMContentLoaded", function() {
    // get the value from local storage
    const myValue = localStorage.getItem("checked");
    alert(myValue);
    console.log("value of localstorage", myValue);

    // get the HTML elements
    const field1 = document.getElementById("e_email");
    const field2 = document.getElementById("e_mobile");


    if (myValue === "yes") {
        alert("yes")
        $('#e_email').hide();
        $('#e_mobile').hide();

        // field1.style.display = "none";
        // field2.style.display = "none";
    } else {
        alert("no")
        $('#e_email').show();
        $('#e_mobile').show();


        //   field1.style.display = "block";
        // field2.style.display = "block";
    }

    // });
    $('#btnYes2').on('click', function() {

        $('#modal_dialog2').hide();
    });
</script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
    //$("#rn_submitform").on("submit", function (event) {
    //$( "#rn_submitform" ).click(function() {
    $("form#rn_QuestionSubmit").validate({
        submitHandler: function(form) {
            //form.submit();

            // your code...
            // document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].value=document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].value + ", " +document.getElementById('pincode').value;
            // var getAttachmentElementID = jQuery('input[type="file"]').attr('id').toString();
            // getAttachmentElementID = getAttachmentElementID.split("_FileInput");
            // var FattachLength = jQuery("[id^='"+getAttachmentElementID[0]+"_Item']").length;
            var FattachLength = document.querySelector('input[type="file"]').files.length;

            var Prefadd = $('select[name="Incident.CustomFields.c.preferred_address"]').val();
            if (Prefadd == "253") {
                if (FattachLength < 1) {
                    alert("Please attach address proof as attachment");
                    return false;
                }
            }

            // var datastring = $("#rn_QuestionSubmit").serialize();
            //var datastring = new FormData(this); // <-- 'this' is your form element
            console.log(form);
            var formData = new FormData(form);
            console.log("this is formdata", formData);
            // exit();
            //alert($('formData[Incident.CustomFields.CO.Loan.ID]').val());
            $.ajax({
                url: '/cc/AjaxCustom/raiseQueryRequest',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {

                    $("#loader").removeClass("hidden");
                },
                error: function() {
                    bootbox.alert("<p>An error has occurred....</p>");
                },
                success: function(response) {
                    $("#loader").addClass("hidden");
                    var obj = jQuery.parseJSON(response);
                    var html = '<p>Thanks for submitting your Request. Use this reference number for follow up: <b><a href="/app/account/questions/detail/i_id/' + obj[0].value_id + '">' + obj[0].value_refno + '</a>.</b></p>';
                    //alert(obj[0].value_id);
                    //  console.log(obj);
                    if (obj[0].value_id) {
                        bootbox.alert(html, function() {
                            window.location.href = '/app/ask_confirm/i_id/' + obj[0].value_id;
                        });
                        die();

                    } else {
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
    var cat = "";
    var mobile = "";
    var dob = "";
    var customername = "";


    function die() {
        window.stop();
        throw new Error("ERROR");
    }

    function next_month(value) {
        var Question = document.getElementById('rn_TextInput_42_Incident.Threads').value;
        var subjectt = document.getElementById('rn_TextInput_35_Incident.Subject').value;
        var cat = document.getElementById('rn_askCategoryInput_36_Incident.Category').value;
        var ag_no = document.getElementById('rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID').value;

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
        var cat = document.getElementById('rn_askCategoryInput_36_Incident.Category').value;
        var ag_no = document.getElementById('rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID').value;
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
            window.location.href = "https://tvscs--tst1.custhelp.com/app/customer/selfserviceview/load/" + ag_no;
            return false;

        }
        die();
        //
    }
    var agg;
    $('.setp').on('change', function() {
        q = $(this).val();
        agg = $(this).val();
        $('#rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID').val(agg);
        console.log("agg", agg);
        $.ajax({
            url: '/cc/AjaxCustom/getProduct',
            data: 'agg_no=' + q,
            method: 'post',
            beforeSend: function() {
                $("#loader").removeClass("hidden");
            },
            success: function(response) {
                console.log("in getproduct", response);
                //$('#txtHint').html(data);
                $("#loader").addClass("hidden");
                $('select[name^="formData[Incident.Product]"] option[value="' + response + '"]').attr("selected", "selected");
            }
        }).error(function() {
            bootbox.alert('An error occured');
        });
    });

    $('#existing_contact').checkboxpicker();
    jQuery('#existing_contact').on('change', function(event) {
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
    $(document).ready(function() {
        <?php
        $msgbase = \RightNow\Connect\v1_3\Messagebase::fetch("CUSTOM_MSG_Category_for_Dispatch_address");
        // print_r($msgbase);
        $category_list = $msgbase->Value;
        ?>




        // $('select[name="Incident.CustomFields.c.preferred_address"]').click( function (){ 

        // console.log(this.id)
        $('select[name="Incident.CustomFields.c.preferred_address"]')[0][1].remove();
        $('select[name="Incident.CustomFields.c.preferred_address"]').attr("required", "true");

        // });
        $('select[name="formData[Incident.Category]"').change(function() {
            $('#messageTerm').html("");
            document.getElementById('rn_SelectionInput_38_Incident.CustomFields.c.preferred_address').value = "";
            document.getElementById('pinnm').style.display = "none";
            document.getElementById('pincode').value = "";
            document.getElementById('rn_TextInput_40_Incident.CustomFields.c.dispatchaddress').value = "";
            // document.getElementById('dispatch').value="";
            var categories = [<?php echo $category_list; ?>];

            if (categories.includes(Number($('select[name="formData[Incident.Category]"]').val())) == true)

            {
                // console.log("Here");
                document.getElementById('dispatch').style.display = "block";
                document.getElementById('preferred').style.display = "block";
                document.getElementById('pinnm').style.display = "block";

            } else {
                // console.log("not here");
                document.getElementById('dispatch').style.display = "none";
                document.getElementById('preferred').style.display = "none";
                document.getElementById('pinnm').style.display = "none";

            }

        });

        $('select[name="Incident.CustomFields.c.preferred_address"]').change(function() {
            var aggr = agg.split("_");
            var aggrno = aggr[1];
            var value = document.getElementsByName('Incident.CustomFields.c.preferred_address')[0].value;
            if (value == "254") //registered address
            {
                $("#pincode").attr('readonly', true);
                $('.attachreq').html("").removeClass("rn_Required").attr("aria-label", "");
                if (agg != undefined) {

                    var adType = "RA";
                    $.ajax({
                        url: '/cc/AjaxCustom/getdispatchadd',
                        data: {
                            agreement_no: aggrno,
                            adType: adType
                        },
                        method: 'post',
                        beforeSend: function() {
                            $("#loader").removeClass("hidden");
                        },
                        success: function(response) {
                            //$('#txtHint').html(data);
                            $("#loader").addClass("hidden");
                            $("#loader").attr('readonly', true);
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
                                // $('#pincode').addClass("hidden");
                                document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].readOnly = true;


                            }
                        }
                    }).error(function() {
                        $("#loader").addClass("hidden");
                        bootbox.alert('An error occured');
                    });
                } else {
                    alert("Please Select agreement number first.");
                    console.log($(this).val());

                }
                $('#messageTerm').html("");
            } else if (value == "253") {
                $("#pincode").attr('readonly', false);

                document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].value = "";
                document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].readOnly = false;
                $("#pincode").val("");
                var note = "<ol id='pointersList'><li>NOTE: </li><li>1. You have selected a new address for dispatch of this document. Please attach a valid address proof for the new address.</li> <li>2. The address proof is subject to approval as per organization policy.</li><li>3. Please note that this address would be used only to dispatch thisparticular document requested by you. If you wish to change your address permanently for future reference, raise your request at our Customer Care.</li></ol>";
                $('#messageTerm').html(note).css("color", "red");
                $('.attachreq').html("*").addClass("rn_Required").attr("aria-label", "Required");
            } else {
                $('#messageTerm').html("");
                $('span.attachreq').html("").removeClass("rn_Required").attr("aria-label", "");
            }
            // you can also check: this.selected
        });
    });
</script>

<style type="text/css">
    @media screen and (max-device-width: 480px) and (orientation: portrait) and (min-device-width: 360px) {

        .rn_Email,
        .rn_Text {
            width: 280px !important;
        }

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

    .bootbox-form input {
        width: 100% !important;
    }

    .bootbox-cancel {
        color: black !important;
        font-weight: bold !important;
    }
</style>

</div>


<script type="text/javascript">
    var msg = '';
    var otp = '';
    var newnumber = '';
    var mobile = "";
    var ag_no = "";
    var imei = "";
    var passkey = '';
    var cat = '';
    var Question = '';



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
                console.log("d", d);

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
                console.log("data from noc dispatched api   ", data1);
                // const json = {};

                function parseXmlToJson1(xml) {
                    const json = {};
                    for (const res of xml.matchAll(/(?:<(\w*)(?:\s[^>]*)*>)((?:(?!<\1).)*)(?:<\/\1>)|<(\w*)(?:\s*)*\/>/gm)) {
                        const key = res[1] || res[3];
                        const value = res[2] && parseXmlToJson1(res[2]);
                        json[key] = ((value && Object.keys(value).length) ? value : res[2]) || null;

                    }
                    console.log('insde', json);
                    return json;
                }
                // console.log("for dispatched api", parseXmlToJson1(data1));
                dataAAA1 = parseXmlToJson1(data1); // Resolve promise and go to then()
                console.log("for dispatched api")
                console.log("datat from dun", dataAAA1);
                console.log(JSON.parse((dataAAA1.RequestNOC_EXTResponse.RequestNOC_EXTResult))); // Resolve promise and go to then()
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





    $(document).ready(function() {
        const form = document.getElementById("rn_QuestionSubmit");
        $('#rn_submitform').on('click', function(e) {
            this.disabled = true;
            e.preventDefault();

            const formData = new FormData(form);
            console.log('here', formData);
            console.log('ag selected', formData.get("agreement_no"));

            console.log("i am clicked");
            var cat = document.getElementById('rn_askCategoryInput_36_Incident.Category').value;
            // ag_no = document.getElementById('rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID').value;
            var ag_no = "_" + localStorage.getItem('agreement_number');

            console.log('agno is', ag_no)
            var address = document.getElementById('rn_SelectionInput_38_Incident.CustomFields.c.preferred_address').value;
            var daddress = document.getElementById('rn_TextInput_40_Incident.CustomFields.c.dispatchaddress').value;
            var pin = document.getElementById('pincode').value;
            var Question = document.getElementById('rn_TextInput_42_Incident.Threads').value;
            var subjectt = document.getElementById('rn_TextInput_35_Incident.Subject').value;
            var Createdbycontact = <?php echo $contact_id ?>;

            console.log("Createdbycontact", Createdbycontact);
            console.log(Question);
            // var Question = Question.replace(/\s\s+/g, ' ');
            Question = Question.replace(/\s\s+/g, ' ');
            Question = Question.replace(/\n+/g, ' ');


            console.log(Question);
            // rn_FileAttachmentUpload_43_FileInput





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
            //1727 CD - Moblie unlock 
            // console.log("cat", cat);
            console.log("agr no is", ag_no)
            // if (ag_no.includes("CD")) {

            //     console.log("cd selected")
            // }


            var deta = "";
            // if((cat==53||cat==58||cat==84||cat==93||cat==86||cat==1812||cat==1891 ||cat==77)&&ag_no)
            if ((cat == 53 || cat == 84 || cat == 1891 || cat == 1812 || cat == 86 || cat == 93 || cat == 77 || cat == 1812 || cat == 56 || cat == 82 || cat == 58 || cat == 1727) && ag_no) {


                if (cat && ag_no && address && daddress && pin && Question && subjectt) {

                } else {
                    if (cat != 1891 && cat != 84 && cat != 1812 && cat != 86) {
                        console.log('inside this if');
                        if ((cat == 93 || cat == 77 || cat == 56 || cat == 82 || cat == 1727) && ag_no && Question && subjectt) {

                        } else {
                            console.log('coming here');
                            $('#rn_QuestionSubmit').submit();
                            die();
                        }



                    }
                }



                $.post('/cc/AjaxCustom/ca_api', {
                        method: 'getapimessage',
                        ag_no: ag_no,
                        cat: 58
                    })
                    .done(function(data) {
                        console.log('data coming from ca_Api', data);
                        // customalrtbox(data);
                        var daata = JSON.parse(data);
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


                                console.log('status_code 1& dispatched')
                                //display msg5
                                bootbox.alert("Your NOC has already been dispatched on 05-FEB- 16 through The Professional Courier, Airway bill no. is MAA922270295", function()

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
                                                message: "There is a request which was raised already .<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >" + daata.LookupName + "</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Status</p></td><td nowrap=\"\" valign=\"bottom\" >" + Stat + "</td></tr><tr><td nowrap=\"\" valign=\"bottom\" ><p>Response Sent</p></td><td  valign=\"bottom\" >" + response + "</td></tr></tbody></table><br>Do you still want to raise a request?",
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



                                                                                            // $.ajax({
                                                                                            //     url: '/cc/AjaxCustom/file_attatch',
                                                                                            //     data: formData,
                                                                                            //     processData: false,
                                                                                            //     contentType: false,

                                                                                            //     success: function(response) {
                                                                                            //         console.log("finaly here i am")
                                                                                            //     },
                                                                                            //     type: 'POST'
                                                                                            // });

                                                                                            var ag = ag_no.split('_')

                                                                                            bootbox.alert("Your NOC request is registered, and your reference ID is " + ResultRespons.ReturnOutput[0].lookupName + ". You will get the response on this at the earliest.", function()

                                                                                                {
                                                                                                    //code for attachment


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
                                                                            }, //button

                                                                        });
                                                                    } //if txt
                                                                    else {
                                                                        console.log('not eligible->validate NOC');
                                                                        var ResultResponse = NocRequest_CheckLive(mobile, ag_no, Question, Createdbycontact)

                                                                        //displayinng msg 4 only

                                                                        if (ResultRespons.ReturnID == 2) {

                                                                            var refno = ResultRespons.ReturnOutput[0].lookupName;
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

                                                                        //  formData.reference_no = refno;
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

                                                        //  formData.reference_no = refno;
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





                    });
            } else {
                $('#rn_QuestionSubmit').submit()

            }


        });
    });


    // document.getElementById("rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID").addEventListener("change", agg_reload);
    // document.getElementById("rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID").addEventListener("click", agg_val);
</script>