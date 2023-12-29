<?php
$token = $_GET['token'];
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
    <link href="https://tms.tvscredit.com/resources/css/bootstrap.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/nprogress/nprogress.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="https://tms.tvscredit.com/resources/css/custom.css" rel="stylesheet">

</head>

<script>
    var token = '<?php echo $token ?>';
    console.log(token);
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

            var TokenRequestId = response.ReturnOutput[0].TokenRequestId;
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
            document.getElementById('customerremark').value = RemarksDisplay;
            document.getElementById('createdby').value = CreatedByDisplay;
            document.getElementById('Closure').value = purposeDisplay;

        } else {
            console.error("Request failed with status code: " + jqXHR.status);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Request failed: " + errorThrown);
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
                            <strong>CLOSED</strong>
                        </div>
                    </div>
                    <div class="form-group closure_remark_div">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Closure">Token Cloure Remarks
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <textarea id="Closure" name="Closure" class="form-control col-md-7 col-xs-12" placeholder="Please enter closure remark" readonly></textarea>
                        </div>
                    </div>
                    <div class="row" style="text-align: center">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 ">
                                <button type="submit" name="user_submit" value="user_submit" class="btn btn-success user_submit" disabled>Submit</button>
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