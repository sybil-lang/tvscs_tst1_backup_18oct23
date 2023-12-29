<?php

$token = $_GET['token'];
$CI = &get_instance();
$CI->load->helper('report');
$c_id = $CI->session->getProfileData("c_id");
// var_dump($c_id);
$contact = \RightNow\Connect\v1_3\Contact::fetch($c_id);
// var_dump($contact);
// echo $c_id;
$token = $_GET['TokenRequest'];
$employeeCode = $contact->CustomFields->c->employee_code;
// echo $employeeCode;
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js" type="text/javascript"></script>
    <!-- <script type="text/javascript" src="https://tms.tvscredit.com/resources/js/jquery-2.1.1.min.js"></script> -->
    <!-- <link rel="icon" href="https://tms.tvscredit.com/resources/images/Tvscs_Logo.png" sizes="32x32">
    <link href="https://tms.tvscredit.com/resources/css/bootstrap.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/nprogress/nprogress.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/custom.css" rel="stylesheet"> -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>

<body class="nav-sm footer_fixed">
    <!-- <script src="https://tms.tvscredit.com/resources/js/jquery.validate.min.js"></script> -->
    <!-- <script src="https://tms.tvscredit.com/resources/js/validate.min.js"></script>
    <link href="https://tms.tvscredit.com/resources/css/jquery.timepicker.css" rel="stylesheet">
    <script src="https://tms.tvscredit.com/resources/js/jquery-ui.js"></script>
    <script src="https://tms.tvscredit.com/resources/js/datatables.js"></script> -->
    <!-- <link href="https://tms.tvscredit.com/resources/css/jquery-ui.css" rel="stylesheet"> -->
    <!-- <script src="https://tms.tvscredit.com/resources/css/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://tms.tvscredit.com/resources/js/jquery.timepicker.js"></script>
    <script src="https://tms.tvscredit.com/resources/js/dropDown.js"></script> -->

    <style>
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
            /*min-width: 28px;*/
            display: inline-block;
            color: #000 !IMPORTANT;
        }

        .category-group .category-item {
            padding: 4px 15px 6px 30px;
            border-radius: 20px;
            background: #0e5aca;
            color: #fff;
            margin-top: 2px;
            display: inline-block;
            text-transform: uppercase;
            position: relative;
        }

        .category-group .category-item input[type="radio"] {
            position: absolute;
            left: 11px;
            margin-top: 5px;
        }

        .category-item-active {
            background: #17407c !important;
        }

        .uppercase {
            text-transform: uppercase;
            font-size: 23px;
            margin-bottom: 5px;
        }

        .zero-margin {
            margin-bottom: 0px !important;
        }

        .attachemnt-group {
            margin-bottom: 3px !important;
            min-height: 30px !important;
        }

        .form-horizontal .form-group {
            min-height: 34px;
        }
    </style>



    <script>
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

        $(document).ready(function() {

            $("#user_form").validate({
                rules: {
                    subject: {
                        required: true,
                    },
                    question: {
                        required: true,
                    },
                    category: {
                        required: true,
                    },
                },
                messages: {
                    subject: {
                        required: 'Please Enter Subject',
                    },
                    question: {
                        required: 'Please Enter Question',
                    },
                    category: {
                        required: 'Please Select Category',
                    },

                },
                errorPlacement: function(error, element) {
                    //console.log(element.context.name);

                    if (element.attr("type") == "radio") {
                        console.log(error);
                        $(".category_error").html(error);
                    } else {

                        error.insertAfter($(element).parent('div').find($('.custom_error')));
                    }
                },
                submitHandler: function(form) {
                    allowsubmit = '';
                }
            });
            setTimeout(function() {
                $('#error_screen').hide();
            }, 5000);

            /* $(".user_submit").click(function() {
            	
            	
            }); */
        });
    </script>

    <style>
        body {
            background: #fff;
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
    </style>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="" class="form-horizontal form-label-right" id="user_form" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                <input type="hidden" name="co_id" value="<?php echo $c_id; ?>" />
                <div class="x_panel">
                    <div class="loding-div-inner">
                        <div class="lds-ripple">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <div class="x_content">

                        <div class="x_title">
                            <h2>Help Desk</h2>
                            <div class="countdown">Remaining Time :- <span class="timer-text">9</span><small>m</small> : <span class="timer-text">10</span><small>s</small></div>
                            <div class="countdown_message">TOKEN_EXPIRED_MESSAGE</div>
                            <div class="clearfix"></div>
                        </div>
                        <h3 class="text-center uppercase">Submit a question to our support team</h3>
                        <p class="text-center" style="margin-bottom:10px;">Our dedicated staff will respond within 48 hours</p>
                        <div class="text-center">
                        </div>
                        <div id="error_screen" class="row" style="display: none;">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="text-center" id="timeouterror" style="display:none">
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_name">Token No
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="token" name="token" value=<?php echo $token; ?> class="form-control col-md-7 col-xs-12" readonly="">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_name">Subject<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="subject" name="subject" value="" class="form-control col-md-7 col-xs-12">
                                <span class="custom_error"></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_name">Question<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="question" name="question" class="form-control col-md-7 col-xs-12"></textarea>
                                <span class="custom_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="field_name">Category <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <select class="form-control" name="category">
                                    <option value="">Please Select Category</option>
                                    <option value="48">Acknowledgement Cards</option>
                                    <option value="2490">AP physical NOC - Prior Sep18</option>
                                    <option value="50">Backpapers &amp; KYC Copies</option>
                                    <option value="1727">CD - Moblie unlock</option>
                                    <option value="1812">CD NDC - Soft copy</option>
                                    <option value="51">Cibil Status / Corrections</option>
                                    <option value="46">Confirmation letter to RTO for HP cancellation</option>
                                    <option value="52">Correction in NOC details</option>
                                    <option value="66">Customer Name correction</option>
                                    <option value="65">Customer New Address Updation</option>
                                    <option value="38">Cycle date change</option>
                                    <option value="70">Defects in Insurance Policy</option>
                                    <option value="812">Document query Papers acknowledgement</option>
                                    <option value="73">Duplicate Insurance Policy- Hard Copy</option>
                                    <option value="54">Duplicate Key</option>
                                    <option value="53">Duplicate NOC</option>
                                    <option value="1546">E - Mandate link</option>
                                    <option value="31">ECS /PDC/ADM/ACH Deposition Issues</option>
                                    <option value="33">ECS /PDC/ADM/ACH Realisation Issues</option>
                                    <option value="55">Emi / Charges transfer</option>
                                    <option value="56">Excess Refund</option>
                                    <option value="1928">Fc / OTS Updation</option>
                                    <option value="2620">Foreclosure retention</option>
                                    <option value="68">Hold / Block request of NOC</option>
                                    <option value="71">ICICI/KOTAK Credit Shield Policy Request</option>
                                    <option value="75">Insurance claim - Credit shield</option>
                                    <option value="76">Insurance claim - Vehicle insurance</option>
                                    <option value="77">Insurance Copy request</option>
                                    <option value="72">Insurance policy cancellation</option>
                                    <option value="74">Insurance premium amount transfer &amp; Waiver</option>
                                    <option value="2332">Insurance renewal request</option>
                                    <option value="49">Loan agreement copy</option>
                                    <option value="868">Loan agreement Original Required</option>
                                    <option value="1929">Loan Cancellation</option>
                                    <option value="2265">MSME - Balance certificate</option>
                                    <option value="2326">MSME - Charges waiver</option>
                                    <option value="2268">MSME - Excess refund</option>
                                    <option value="2477">MSME - Interest Certificate</option>
                                    <option value="2591">MSME - LMS - Closure-TL/OD</option>
                                    <option value="2266">MSME - NDC</option>
                                    <option value="34">New ECS/PDC acknowledgement</option>
                                    <option value="57">NOC Dispatch /Return Status</option>
                                    <option value="44">NOC for Duplicate RC / Chassis change</option>
                                    <option value="47">NOC for Fresh RC</option>
                                    <option value="45">NOC for Insurance claim</option>
                                    <option value="83">NOC genuineness confirmation by RTO</option>
                                    <option value="58">NOC request</option>
                                    <option value="2565">NOC request -Tractor / UCV</option>
                                    <option value="29">Not presented/ Security cheques Request</option>
                                    <option value="1930">Online Receipt/Loss &amp; Sale/Receipt Cancellation</option>
                                    <option value="59">Original RC</option>
                                    <option value="1731">Payment made to Individual account</option>
                                    <option value="82">Phone Number Change request</option>
                                    <option value="60">RC xerox</option>
                                    <option value="81">Repayment schedule</option>
                                    <option value="63">Repayment Schedule Hard Copy</option>
                                    <option value="36">Replacement of Cheques</option>
                                    <option value="37">Representation Request</option>
                                    <option value="32">Representation stop request</option>
                                    <option value="28">Return cheque/ memo required</option>
                                    <option value="67">Return Covers -NOC / Excess Refund</option>
                                    <option value="30">SPDC - Balance cheque request</option>
                                    <option value="1495">SPL scheme -EMI waiver</option>
                                    <option value="43">Statement Of Account - Hard Copy</option>
                                    <option value="86">Statement of Account Request</option>
                                    <option value="39">Stop Future Presentation</option>
                                    <option value="35">Swap / Repayment Mode Change</option>
                                    <option value="1891">Swapping Enquiry</option>
                                    <option value="1388">TN - RTO Online Form 34</option>
                                    <option value="1360">TN - RTO Online Form 35</option>
                                    <option value="79">Vehicle Details Updation</option>
                                    <option value="1396">Vehicle Details Updation - Seized &amp; Sold</option>
                                    <option value="61">Waiver commitment</option>
                                    <option value="62">Waiver of charges</option>
                                </select>
                                <span class="custom_error"></span>
                            </div>

                        </div>
                        <div class="form-group attachemnt-group">
                            <div class="col-md-3 col-sm-3 col-xs-12"></div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!-- <input type="file" name="document[]" id="document2"> -->
                                <input type="file" id="inputfile" name="file[]" multiple>
                            </div>
                            <span class="custom_error"></span>
                        </div>

                        <div class="row" style="text-align: center">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 ">
                                    <button type="submit" name="new_request" value="new_request" class="btn btn-success new_request" id="submitbtn">Submit</button>
                                    <button class="btn btn-danger" type="button" id="cancel " onclick="window.location.href = 'https://tvscs--tst1.custhelp.com/app/employee/walkin_reports_edit'">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        const form = document.getElementById("user_form");
        $('#submitbtn').on('click', function(e) {
            this.disabled = true;
            e.preventDefault();

            const formData = new FormData(form);
            console.log('here', formData);

            $.ajax({
                url: '/cc/AjaxCustom/sendForm',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {

                    // $("#loader").removeClass("hidden");
                },
                error: function() {
                    bootbox.alert("<p>An error has occurred....</p>");
                },
                success: function(response) {
                    // $("#loader").addClass("hidden");
                    var obj = jQuery.parseJSON(response);
                    var html = '<p>Thanks for submitting your Request. Use this reference number for follow up: <b><a href="/app/account/questions/detail/i_id/' + obj[0].value_id + '">' + obj[0].value_refno + '</a>.</b></p>';
                    //alert(obj[0].value_id);
                    //  console.log(obj);
                    // window.location.href = '/app/walkin_report_edit_closed/i_id/' + obj[0].value_id;
                    if (obj[0].value_id) {
                        window.location.replace("https://tvscs--tst1.custhelp.com/app/employee/walkin_report_edit_newview/i_id/" + obj[0].value_id);
                    }
                    // else {
                    //     bootbox.alert("<p>An error has occurred</p>");
                    // }
                    /*var $title = $('<h1>').text(data.talks[0].talk_title);
                    var $description = $('<p>').text(data.talks[0].talk_description);
                    $('#info')
                       .append($title)
                       .append($description);*/
                    //ask_confirm/i_id/713
                },
                type: 'POST'
            });

        })



    })
</script>

</html>