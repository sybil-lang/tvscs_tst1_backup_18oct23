<!-- tst1 -->
<?php
$CI = &get_instance();
// 

$userData = $CI->session->getSessionData('userProfile');
// Concatenate first name and last name
$fullName = $userData["sess_first_name"] . " " . $userData["sess_last_name"];

// Output the result


$CI->load->helper('report');

checkCustomerType('customer');
?>
<html>

<head>
    <style type="text/css">
        #isload {
            height: 80px;
            position: absolute;
            top: 50%;
            left: 50%;
            display: none;

        }
    </style>
</head>

<body>
    <img id="isload" src="/euf/assets/themes/standard/images/loading-large.gif">
    <?php
    $msg = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No); ///100066
    $report_id = $msg->Value;

    ?>
    <h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>

    <form action='#' method='post' class="loan-form">
        <fieldset>
            <div id="statusofloan_ndc2"></div>
            <style type="text/css">
                .card {
                    margin-top: 10px;
                    background-color: #fff;
                    box-shadow: 0 20px 30px 0 rgba(0, 0, 0, .03);
                    margin-bottom: 15px;
                    border-radius: 1px;
                    color: #444;
                    border: 0.5px #252525 solid;
                    padding: 20px;
                }

                .bold-text {
                    font-weight: 600;
                }

                .rn_agreementSelect {
                    display: inline-block;
                }

                .btn:click {
                    color: white;
                }

                .id1 {
                    color: blue;
                    font-weight: 400;
                }
            </style>
            <div class="col-sm-12 col-md-12 col-lg-12" id="contemt-main">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <br><br>
                        <div class="row">
                            <div class="col-md-8 not-applicable">
                            </div>

                        </div>
                    </div>
                </div>


                <div id="showresult_mandate" style='display:none'>
                    <div class="row">
                        <div class="col-md-3" id="mandate1">
                            <a href="javascript:void(0);" id="url_for_mandate"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a>
                            <p>Digital NOC</p>
                        </div>
                    </div>
                </div>
                <!-- <p id="msg" style="display: none;">Please note that the NOC validity has expired.Please click here <a href="#"  class="paymentLink" style="font-weight:bold">payment link </a> and pay Rs.500 to raise a request for the Duplicate NOC.”
                </p> -->

                <p id="msg" style="display: none;">
                    Please note, NOC of the selected TVS Credit Loan has expired. You can raise a request for the duplicate NOC by clicking here: <a href="#" class="paymentLink" style="font-weight:bold">payment link </a> and pay the applicable charges Rs.500. Once the payment is successful, duplicate NOC will be processed within 3 working days.
                </p>
                <p id="msg2" style="display: none;">
                    <!-- NOC is not available for the selected agreement number. Please
                    <a href="https://tvscs--tst1.custhelp.com/app/raisequery" class="id1" style="font-weight:bold">click here</a>
                    to raise a request for NOC. Our customer care executive will reach out to you. -->
                    NOC for the selected TVS Credit Loan agreement is not generated. Please contact our customer care team for further assistance.
                </p>

                <p id="msg3" style="display: none;">NOC for the selected TVS Credit Loan agreement is not generated. Please contact our customer care team for further assistance.
                </p>

                <br />
                <a href="javascript:void(0);" id="download-button" style="display: none;"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a>
                <p id="para" style="display: none;">NDC</p>

                <script type="text/javascript">
                    // var agreementNo = "";

                    $.post("/cc/AjaxCustom/rest_api_report", {
                            id_of_report: '<?php echo $report_id; ?>',
                            filtering_val: 'mandateStatus_digitalnoc',
                            method_val: 'getMandateStatus_digitalnoc'
                        })
                        // 
                        .done(function(data) {
                            // console.log("helloo---1");
                            // console.log(data);
                            // console.log("helloo---1");
                            $("#statusofloan_ndc2").html(data);

                            //---otherportNoc--
                            let source = document.querySelector('#i_detail_digitalnoc');
                            // console.log("source is: " + source)///
                            source.addEventListener('change', function() {
                                let agg_no = this.value;

                                document.getElementById('isload').style.display = "block";
                                document.getElementById('showresult_mandate').style.display = "none";
                                console.log('a value first time' + agg_no);
                                if (agg_no == '0') {
                                    document.getElementById('showresult_mandate').style.display = "none";
                                }

                                if (agg_no != undefined && agg_no != '0') {

                                    $.post("/cc/AjaxCustom/instrument_DigitalNoc", {
                                            ag_no: agg_no
                                        })
                                        .done(function(data) {
                                            console.log("first checking", data)

                                            if (data === "NOC Validity Expired") {
                                                console.log("insde NOC Validity Expired ")
                                                document.getElementById('msg').style.display = "block";
                                                document.getElementById('isload').style.display = "none";
                                                document.getElementById('showresult_mandate').style.display = "none";
                                                document.getElementById('msg2').style.display = "none";
                                                document.getElementById('msg3').style.display = "none";
                                            } else if (data === 'api not generating pdf') {

                                                document.getElementById('msg3').style.display = "none";
                                                console.log('api down ...data not coming from api so dont show the button');
                                                document.getElementById('showresult_mandate').style.display = "none";
                                                document.getElementById('isload').style.display = "none";
                                                document.getElementById('msg').style.display = "none";
                                                document.getElementById('msg2').style.display = "none";
                                            } else if (data === 'Hold Marked - NOC generation not allowed') {
                                                document.getElementById('msg').style.display = "none";

                                                document.getElementById('msg2').style.display = "block";
                                                document.getElementById('isload').style.display = "none";
                                                document.getElementById('showresult_mandate').style.display = "none";
                                                document.getElementById('msg3').style.display = "none";
                                            } else if (data === 'NOC not Applicable') {
                                                document.getElementById('msg').style.display = "none";

                                                document.getElementById('msg2').style.display = "none";
                                                document.getElementById('msg3').style.display = "block";
                                                document.getElementById('isload').style.display = "none";
                                                document.getElementById('showresult_mandate').style.display = "none";
                                            } else {
                                                console.log("data frmo instrument_DigitalNoc", data)
                                                var bin = atob(data);
                                                console.log('File Size:', Math.round(bin.length / 1024), 'KB');
                                                if (Math.round(bin.length / 1024)) {
                                                    document.getElementById('showresult_mandate').style.display = "block";
                                                    document.getElementById('msg').style.display = "none";
                                                    document.getElementById('msg2').style.display = "none";
                                                    document.getElementById('msg3').style.display = "none";
                                                    document.getElementById('isload').style.display = "none";
                                                }

                                            }


                                        });
                                }
                            });

                            ///---------------
                        });
                    //Prefilled Ecs Mandate
                    $('a#url_for_mandate').click(function(e) {

                        var agg_no = $('#i_detail_digitalnoc').val();

                        $.post("/cc/AjaxCustom/instrument_DigitalNoc", {
                                ag_no: agg_no
                            })
                            .done(function(data) {

                                // var daata = data;
                                console.log(data);
                                // document.getElementById('iloadf').style.display = "none";
                                if (data == "no data found") {
                                    alert("No File Found")
                                } else {
                                    var bin = atob(data);
                                    console.log('File Size:', Math.round(bin.length / 1024), 'KB');
                                    if (Math.round(bin.length / 1024)) {
                                        //console.log('PDF Version:', bin.match(/^.PDF-([0-9.]+)/)[1]);
                                        // Embed the PDF into the HTML page and show it to the user
                                        var obj = document.createElement('object');
                                        obj.style.width = '100%';
                                        obj.style.height = '842pt';
                                        obj.type = 'application/pdf';
                                        obj.data = 'data:application/pdf;base64,' + data;
                                        // document.body.appendChild(obj);

                                        // Insert a link that allows the user to download the PDF file
                                        var link = document.createElement('a');
                                        link.innerHTML = 'Download PDF file';
                                        link.download = 'DigitalNoc.pdf';
                                        link.href = 'data:application/octet-stream;base64,' + data;
                                        // document.body.appendChild(link);
                                        link.click();
                                    } else {
                                        alert("No File Found")
                                    }
                                }


                            });

                    });
                    $('.paymentLink').click(function(e) {
                        e.preventDefault(); // Prevent the link from navigating
                        document.getElementById('isload').style.display = "block";
                        // Make an AJAX request to your PHP script
                        console.log("i am clicked")
                        var agg_no = $('#i_detail_digitalnoc').val();
                        var fullNameFromPHP = "<?php echo $fullName; ?>";
                        $.post("/cc/AjaxCustom/digitalnoc_paymentlink", {
                                ag_no: agg_no,
                                fullName: fullNameFromPHP
                            })
                            .done(function(data) {
                                document.getElementById('isload').style.display = "none";
                                // var daata = data;
                                console.log(data);
                                // Check if the API response contains a 'returnURL''
                                if (data) {
                                    // Navigate to the returned URL
                                    window.open(data, '_blank');
                                } else {
                                    console.error("API response does not contain a 'returnURL'");
                                }


                            });
                    });
                    //Prefilled ECS Mandate
                </script>
                <script>
                    async function pdf_generation_check(id) {
                        var res;
                        await $.post("/cc/AjaxCustom/OtherPortNOC", {
                                agg_no: id
                            })
                            .done(function(data) {
                                console.log("inside pdf_generation_check");
                                console.log(data);
                                res = data;
                                // var result = data;
                                // return result;
                                // console.log(result);

                            });
                        return res;
                    }
                </script>
            </div>

        </fieldset>
    </form>
    <p>&nbsp;</p>

</body>

</html>



<!-- <p>&nbsp;</p> -->