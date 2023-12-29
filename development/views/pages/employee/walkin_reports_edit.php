<?php
$token = $_GET['token'];
$CI = &get_instance();
$CI->load->helper('report');
$c_id = $CI->session->getProfileData("c_id");
$contact = \RightNow\Connect\v1_3\Contact::fetch($c_id);
$employeeCode = $contact->CustomFields->c->employee_code;
$md5EmployeeCode = "";
checkCustomerType('internal employee');

try {
    if (strlen($employeeCode)) {
        $md5EmployeeCode = md5($employeeCode);
    }
} catch (Exception $err) {
    echo $err->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TVS Credit</title>
    <link rel="icon" href="https://tms.tvscredit.com/resources/images/Tvscs_Logo.png" sizes="32x32" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <link href="https://tms.tvscredit.com/resources/css/bootstrap.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/nprogress/nprogress.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/custom.css" rel="stylesheet">

</head>

<script>
    $(document).ready(function() {
        var TokenRequestId;
        var token = '<?php echo $token ?>';
        console.log("token", token);
        var employeecode = <?php echo $employeeCode; ?>;
        console.log("employeecode", employeecode);

        //code for filling form details 
        $.post("/cc/AjaxCustom/GetTokenDetails", {
                token: token
            })
            .done(function(data, textStatus, jqXHR) {
                if (jqXHR.status === 200) {
                    console.log(data);
                    // Parse the API response
                    var response = JSON.parse(data);

                    //vaidations
                    var EMail = response.ReturnOutput[0].EMail;
                    var EMailDisplay = EMail ? EMail : "--";

                    var Token = response.ReturnOutput[0].Token;
                    var TokenDisplay = Token ? Token : "--";

                    TokenRequestId = response.ReturnOutput[0].TokenRequestId;
                    var TokenRequestIdDisplay = TokenRequestId ? TokenRequestId : "--";

                    var CustomerType = response.ReturnOutput[0].CustomerType;
                    var CustomerTypeDisplay = CustomerType ? CustomerType : "--";

                    var CustomerName = response.ReturnOutput[0].CustomerName;
                    var CustomerNameDisplay = CustomerName ? CustomerName : "--";

                    var Mobile = response.ReturnOutput[0].Mobile;
                    var MobileDisplay = Mobile ? Mobile : "--";

                    var AlternateMobile = response.ReturnOutput[0].AlternateMobile;
                    var AlternateMobileDisplay = AlternateMobile ? AlternateMobile : "--";

                    var AgreementNumber = response.ReturnOutput[0].AgreementNumber;
                    var AgreementNumberDisplay = AgreementNumber ? AgreementNumber : "--";

                    var AssignedTo = response.ReturnOutput[0].AssignedTo;
                    var AssignedToDisplay = AssignedTo ? AssignedTo : "--";

                    var purpose = response.ReturnOutput[0].purpose;
                    var purposeDisplay = purpose ? purpose : "--";

                    var CreatedBy = response.ReturnOutput[0].CreatedBy;
                    var CreatedByDisplay = CreatedBy ? CreatedBy : "--";

                    var Remarks = response.ReturnOutput[0].Remarks;
                    var RemarksDisplay = Remarks ? Remarks : "--";

                    // Set the values of the input fields
                    document.getElementById('token').value = TokenDisplay;
                    document.getElementById('tokenrequestid').value = TokenRequestIdDisplay;
                    document.getElementById('customertype').value = CustomerTypeDisplay;
                    document.getElementById('visitorname').value = CustomerNameDisplay;
                    document.getElementById('mobile').value = MobileDisplay;
                    document.getElementById('alternatemobile').value = AlternateMobileDisplay;
                    document.getElementById('emailid').value = EMailDisplay;
                    document.getElementById('agreementno').value = AgreementNumberDisplay;
                    document.getElementById('assignto').value = AssignedToDisplay;
                    document.getElementById('purposeofvisit').value = purposeDisplay;
                    document.getElementById('customerremark').value = CreatedByDisplay;
                    document.getElementById('createdby').value = RemarksDisplay;

                } else {
                    console.error("Request failed with status code: " + jqXHR.status);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Request failed: " + errorThrown);
            });
        //code for form validations
        $("#user_form").validate({
            rules: {
                status: {
                    required: true,
                },
                Closure: {
                    required: true,
                }
            },
            messages: {
                status: {
                    required: 'Please Select Status',
                },
                Closure: {
                    required: 'Please Enter Remark',
                }
            }
        });

        //validation on selecting status
        $(document).on('change', "#status", function() {
            var status = $("#status").val().trim();
            console.log(status);
            if (status == "CLOSED") {
                $(".closure_remark_div").show();
                $(".user_submit").html('Submit');
                $(".user_submit").off().on('click', function(event) {
                    event.preventDefault(); // Prevent the default form submission action
                    // Code to execute when the Submit button is clicked
                    console.log("click on submit");
                    var closureRemark = $('#Closure').val();
                    console.log("secound value is ", closureRemark);

                    //calling ajax
                    $.ajax({
                        url: '/cc/AjaxCustom/UpdateTokenStatus',
                        data: {
                            closureRemark: closureRemark,
                            token: token,
                            employeecode: employeecode
                        },
                        type: "POST",
                        async: false,
                        success: function(data) {
                            console.log(data);
                            window.location.replace("https://tvscs--tst1.custhelp.com/app/employee/walkin_report_edit_closed?TokenRequestId=" + TokenRequestId);
                        },
                        error: function(err) {
                            console.log(err);
                            return err;
                        }
                    });
                });
            } else if (status == 'CAC') {
                $(".closure_remark_div").hide();
                $(".user_submit").html('Next');
                $(".user_submit").off().on('click', function(event) {
                    event.preventDefault(); // Prevent the default form submission action
                    // Code to execute when the Next button is clicked
                    console.log("click on next");
                    window.location.replace("https://tvscs--tst1.custhelp.com/app/employee/walkin_report_edit_new?TokenRequest=" + token);
                });
            }
        });

    });

    //code for timmer
    var allowsubmit;
    var timer2 = "15:00";
    var remainingTime = sessionStorage.getItem("remainingTime");
    if (remainingTime && remainingTime !== '0:00') {
        timer2 = remainingTime;
    } else {
        sessionStorage.setItem("remainingTime", timer2);
    }
    var interval = setInterval(function() {
        var timer = timer2.split(':');
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        $('.countdown').html("Remaining Time :- <span class='timer-text'>" + minutes + "</span><small>m</small> : <span class='timer-text'>" + seconds + '</span><small>s</small>');
        if (minutes < 0) {
            clearInterval(interval);
        }
        if ((minutes < 2)) {
            $('.countdown').hide();
            $('.countdown_message').show();
        }
        if ((seconds <= 0) && (minutes <= 0))
            clearInterval(interval);
        timer2 = minutes + ':' + seconds;
        var res = timer2;
        $('#time').text(res);
        sessionStorage.setItem("remainingTime", timer2);
        if (timer2 == '0:00') {
            $('#time').text("Time Over.");
            window.location.replace("https://tvscs--tst1.custhelp.com/app/employee/walkin_reports");
        }
    }, 1000);

    function removenewline() {
        $("textarea").each(
            function() {
                var replaced = $(this).val().replace(/(\r\n|\n|\r)/gm, " ");
                $(this).val(replaced);
            });
    }
</script>

<style>
    body {
        background: #fff;
    }

    .page-header {
        margin: 2rem .5rem;
        font-weight: 300;
        text-align: center;
    }

    .countdown {
        text-align: center;
        font-size: 20px;
        display: inline-block;
        margin-top: 5px;
        position: absolute;
        right: 0;
    }

    .countdown small {
        margin-left: 1px;
    }

    .countdown_message {
        color: red;
        text-align: center;
        display: none;
        font-size: 20px;

        margin-top: 5px;
        position: absolute;
        right: 0;
    }

    .x_title {
        position: relative;
    }

    .timer-text {
        min-width: 28px;
        display: inline-block;
        color: #000 !IMPORTANT;
        text-align: center;
        display: inline-block;
    }

    .less-than-two-minutes {
        color: red !important;
        min-width: 45px;
        text-align: center;
        display: inline-block;
    }

    .view_image {
        color: #03a9f4;
        font-size: 15px;
        cursor: pointer;
    }

    .x_panel {
        border: 0;
        box-shadow: none;
    }

    .row {
        margin: 0;
    }

    .row>.col-md-12,
    .row>.col-sm-12,
    .row>.col-xs-12 {
        padding: 0;
    }

    .page-header {
        margin: 2rem .5rem;
        font-weight: 300;
        text-align: center;
    }

    .x_title {
        position: relative;
    }

    .view_image {
        color: #03a9f4;
        font-size: 15px;
        cursor: pointer;
    }
</style>

<body>
    <div class="clearfix"></div>
    <div class="row">
        <form action="" class="form-horizontal form-label-right" id="user_form" method="post" accept-charset="utf-8">
            <div class="x_panel">
                <div class="x_content">
                    <div class="x_title">
                        <h2>Token Details </h2>
                        <div class="countdown"></div>
                        <div class="countdown_message">Working Time Will Be Expire In <span id="time" class="less-than-two-minutes"></span> Minutes.</div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_name">Token No
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="token" name="token" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_name">Token Request ID
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="tokenrequestid" name="token" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_name">Customer Type
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="customertype" name="token" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_label">Visitor Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="visitorname" name="field_label" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Datatype">Mobile
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="mobile" name="field_label" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Datatype">Alternate Mobile
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="alternatemobile" name="field_label" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_label">Email ID
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="emailid" name="field_label" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_label">Agreement No
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="agreementno" name="field_label" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_label">Assign To
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="assignto" name="field_label" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_label">Purpose of Visit
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="purposeofvisit" name="field_label" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_label">Customer Remark
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea class="form-control" id="customerremark" name="tms_remark1" readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_label">Created By
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="createdby" name="field_label" value="" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_label">Status

                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top:6px">
                            <select class="form-control col-md-7 col-xs-12" id="status" name="status">
                                <option value="">Please Select Status</option>
                                <option value="CLOSED">CLOSE</option>
                                <option value="CAC">NEW SERVICE REQUEST</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group closure_remark_div">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Closure">Token Cloure Remarks
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <textarea id="Closure" name="Closure" class="form-control col-md-7 col-xs-12" placeholder="Please enter closure remark"></textarea>
                        </div>
                    </div>
                    <div class="row" style="text-align: center">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 ">
                                <button type="submit" name="user_submit" value="user_submit" class="btn btn-success user_submit">Submit</button>
                                <button class="btn btn-danger" type="button" id="cancel " onclick="window.location.href = 'https://tvscs--tst1.custhelp.com/app/employee/walkin_reports'">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</body>