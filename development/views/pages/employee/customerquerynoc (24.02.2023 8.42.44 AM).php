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

    .mysel select {
        padding: 4px 0 4px 22px !important;
        border-radius: 50px !important;
        background: #3c71bb !important;
        box-shadow: 5.634px 10.595px 30px rgba(0, 0, 0, 0.1) !important;
        border: none !important;
        height: 40px !important;
        width: 157px !important;
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        line-height: 18px;
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

    .widgetfile {
        background-color: pink;
    }

    /* #infile{
        background-color: yellow;
    } */
    input[type="file"] {
        cursor: pointer;
    }

    .Displaynoc {
        /* margin: 20px !important;
        position: relative !important;
        top: 10px;
        text-align: center !important;
        line-height: 48px !important;
        border: none;
        left: 14px;
        bottom: -80px;
        width: 160px !important;
        height: 45px !important;
        z-index: 237;
        border-radius: 25px !important;
        color: #fff !important;
        background-color: #3c71bb !important;
        font-size: 13px !important;
        text-transform: uppercase !important;
        transition: all .45s ease-in-out 0s !important; */


        color: #fff !important;
        background-color: #3c71bb !important;
        /* font-size: 13px !important;
    text-transform: uppercase !important; */
    }

    .dis {
        display: flex;
        align-items: center;

        justify-content: center;
    }

    .myflex {
        display: flex;
        align-items: center;

        justify-content: flex-start;
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
                        <label for="dealer" class="rn_Label" style="display:block !important" ;> Agreement Number</label>
                        <!--<div id="magicsuggest_customer"></div>-->
                        <input type="text" name="ag_no" id="ag_no" readonly placeholder=" " />
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
            <div class="row" id="custname">
                <div class="col-md-5">
                    <label for="name">Customer Name</label>
                    <input type="text" name="customerName" id="customerName" readonly />
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <!-- <rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#" /> -->

                    <div class="ui-widget">
                        <label for="dealer" class="rn_Label" style="display:block !important" ;>Subject</label>
                        <!--<div id="magicsuggest_customer"></div>-->
                        <input type="text" name="sub" id="subject" readonly placeholder=" " />
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>

            <div class="row myflex">
                <div class="col-6">
                    <label for="vca">Category</label>
                </div>
                <div class="col-6 mysel">
                    <select class="Displaynoc " name="cars" id="cars" disabled>
                        <option value="volvo">NOC Request</option>
                    </select>
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
        <div class="row">
            <div class="col-md-6">
                <div class="widgetfile hidden" id="widfile">
                    <rn:widget path="input/FileAttachmentUpload" name="Incident.FileAttachments" />

                </div>

                <div class="ui-widget  " id="infile">

                    <input type="file" id="inputfile" name="file">

                    <!-- <input type="file" id="inputfile" name="file[]" multiple> -->
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
    window.onload = function() {
        const placeholderValue = localStorage.getItem('agreement');
        console.log(localStorage.getItem('agreement'))
        const inputField = document.getElementById('ag_no');
        inputField.placeholder = placeholderValue;
        document.getElementById('subject').placeholder = localStorage.getItem('sub');
        document.getElementById('customerName').placeholder = localStorage.getItem('custname');

    };


    var selQuery = $('#agreement_no').val();
    var selQuery = $('#agreement_no').val();
    // var cat="";
    var mobile = "";
    var dob = "";
    var customername = "";

    function getchangedval() {
        console.log("insdiegetchangeval() after sel reg add")
        var agg = localStorage.getItem('agreement');
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
                console.log('inside 254')
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
                console.log('inside 253')

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
                console.log('inside 252')

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



        $('#rn_SelectionInput_31').removeClass("hidden");
        $('#rn_TextInput_33').removeClass("hidden");
        $('.pinnm').removeClass("hidden");

        $('select[name="Incident.CustomFields.c.preferred_address"]').attr("required", true);
        $('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("required", true);
        $('#pincode').attr("required", true);


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
                    //  url: '/cc/ajaxRequest/nocupdatecreatedbycontact',
                    //  data: {
                    //      refno: refno
                    //  },
                    //  type: "POST",
                    //  async: false,
                    //  success: function(data) {
                    //      console.log(data);


                    //  },
                    //  error: function(err) {
                    //      console.log(err); // Reject the promise and go to catch()
                    //      return err;
                    //  }
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

        $('#rn_empFormSubmit_34_Button').on("click", function(e) {
            const form = document.getElementById("rn_QuestionSubmit");
            const formData = new FormData(form);
            console.log('here', formData);
            this.disabled = true;
            e.preventDefault();
            console.log("yes you clicked");


            //defining varibales here

            var pin = document.getElementById('pincode').value;
            var cat = "NOC request";
            var categories = [<?php echo $category_list; ?>];
            if (categories.includes(cat.trim()) == true) {
                var value = document.getElementsByName('Incident.CustomFields.c.preferred_address')[0].value

                var value = document.getElementsByName('Incident.CustomFields.c.preferred_address')[0].value;
                if (!value) {
                    alert("Please select the preferred_address");
                    die();

                }
            }

            var ag_no = "_" + localStorage.getItem('agreement');

            console.log('agno is', ag_no)

            var address = document.getElementById('rn_SelectionInput_28_Incident.CustomFields.c.preferred_address').value;
            var daddress = document.getElementById('rn_TextInput_30_Incident.CustomFields.c.dispatchaddress').value;
            var pin = document.getElementById('pincode').value;
            var Question = document.getElementById('rn_TextInput_32_Incident.Threads').value;
            var subjectt = localStorage.getItem('sub');
            var Createdbycontact = <?php echo $c_id ?>;
            Question = Question.replace(/\s\s+/g, ' ');
            Question = Question.replace(/\n+/g, ' ');
            var deta = "";

            if (cat == "NOC request") {
                cat = 58;
            }

            //calling ca_api

            $.post('/cc/AjaxCustom/ca_api', {
                    method: 'getapimessage',
                    ag_no: ag_no,
                    cat: 58
                })
                .done(function(data) {
                    // customalrtbox(data);
                    var daata = JSON.parse(data);

                    console.log("daata from ca_api", daata);

                    deta = daata;
                    dob = deta.dob;
                    mobile = deta.mobile;
                    console.log("mobile is", mobile);
                    customername = deta.customername;
                    response = deta.responseSent;
                    console.log("inside 58");



                    var ResultResponse3 = Nocdispatchdapi(mobile, ag_no);
                    if (ResultRespons3.Status_Code == 1 && (ResultRespons3.Result.includes("Active"))) {


                        console.log('status 1&active')
                        var ag = ag_no.split('_')

                        //display msg3

                        bootbox.alert("Your loan account number " + ag[1] + " is Active. NOC can only be provided on completion of your loan.", function()

                            {
                                // location.reload();
                                window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
                            });

                        die();
                    } else if (ResultRespons3.Status_Code == 1 && (ResultRespons3.Result.includes("dispatched"))) {


                        console.log("ResultRespons3.Result", ResultRespons3.Result);
                        console.log('status_code 1& dispatched')
                        //display msg5///
                        bootbox.alert(ResultRespons3.Result, function()
                            // bootbox.alert("Your NOC has already been dispatched on 05-FEB- 16 through The Professional Courier, Airway bill no. is MAA922270295", function()

                            {
                                // location.reload();
                                window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
                            });

                        die();
                    }

                    //er
                    else {
                        console.log('status_code ER ');
                        console.log("status is", daata.status)
                        /////////////////////////
                        if (daata.status) {
                            console.log("status is not null")

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

                                if (cat == 58) {

                                    bootbox.alert('   Your NOC request is already registered with us. You will get the response on this at the earliest<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" ><tbody><tr><td nowrap=\"\" valign=\"bottom\" ><p>Reference No.</p></td><td nowrap=\"\" valign=\"bottom\" >' + daata.LookupName + '</td></tr></table>', function() {
                                        // location.reload();
                                        window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
                                    });

                                }

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
                                                                                            // location.reload();
                                                                                            window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
                                                                                        });

                                                                                } else {
                                                                                    alert(ResultRespons2.Result)
                                                                                    // location.reload();
                                                                                    window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
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


                                                                                            // location.reload();
                                                                                            window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
                                                                                        });
                                                                                }


                                                                            },
                                                                        }
                                                                    },

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

                                                                            // location.reload();
                                                                            window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
                                                                        });
                                                                }


                                                            }
                                                            // die();


                                                        }
                                                    });
                                                },
                                            },
                                            No: {
                                                label: 'No',
                                                callback: function(result) {



                                                    // location.reload();
                                                    window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";

                                                },
                                            }
                                        }, //button

                                    });
                                    die();
                                }

                            }

                        } else {

                            console.log("status is null")


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
                                                                    // location.reload();
                                                                    window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
                                                                });

                                                        } else {
                                                            alert(ResultRespons2.Result)
                                                            // location.reload();
                                                            window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
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

                                                                    // location.reload();
                                                                    window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
                                                                });
                                                        }



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

                                                    // location.reload();
                                                    window.location.href = "https://tvscs--tst1.custhelp.com/app/employee/customerquery";
                                                });
                                        }



                                    }
                                    // die();


                                }
                            })





                        }


                    }
                });





        });
    });
</script>