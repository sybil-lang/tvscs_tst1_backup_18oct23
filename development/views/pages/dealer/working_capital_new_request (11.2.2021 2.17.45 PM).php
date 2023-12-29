<html>
  <head></head>
  <body>
<style>
/* Center the loader */
#loader-img-div {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #ffffff;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  display: none;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
        <div id="loader-img-div"></div>
    <?php
    $CI = &get_instance();
    $CI->load->helper('report');

    checkCustomerType('dealer');

    $dealer_code = $CI->session->getProfileData("login");
    $ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch(100411);
    $filter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
    $filter->Name = "Contact_Id";
    $contactID = $CI->session->getProfileData('contactID');
    $filter->Values = array("$contactID");
    $filters = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
    $filters[0] = $filter;
    $arr = $ar->run(0, $filters);
    if ($arr->count() > 0) {
      $row = $arr->next();
      $total_requests = $row["Total Requests"];
      $total_amount_requested = $row["Total Amount Requested"];
    }
    $contactObj = \RightNow\Connect\v1_3\Contact::fetch($contactID);
//echo ($this->uri->segment('1'));
//echo $agg_no = \RightNow\Utils\Url::getParameter('ag_id');
    /* $pros_no = \RightNow\Utils\Url::getParameter('p_id');
      list($pros_no,$agg_no) = explode("_",$pros_no);
      if(!empty($agg_no)){
      $agreement_id = $agg_no;
      }elseif(empty($agg_no) && !empty($pros_no)){
      $agreement_id = $pros_no;
      }
     */
      $dl_typ = $contactObj->CustomFields->c->dealer_type->LookupName;
    ?>
    <script type="text/javascript">
    var thesetest = "<?php echo $contactObj->Phones[0]->Number; ?>";
        var contactguy = "<?php echo $contactID; ?>";
        var dltp = "<?php echo $dl_typ; ?>";
        var verifiedOTP;
      $(document).ready(function () {
        $.ajax({
          url: '/cc/DealerCustom/getTARestData',
          data: {
            method: 'getTADealerRequest',
            dealer_code: '<?php echo $dealer_code; ?>'
          },
          beforeSend: function () {
            $("#loader").removeClass("hidden");
          },
          error: function () {
            window.location.reload();
            //$('#info').html('<p>An error has occurred</p>');
          },
          success: function (response) {
            $("#loader").addClass("hidden");
            try {
              var obj = jQuery.parseJSON(response);
              $('#maximum_eligibleamount').val(obj[0].TA_MAXIMUM_ELIGIBLE_AMOUNT);
              $('#ta_balance').val(obj[0].TA_BALANCE_AS_ON_DATE);
              // $('#pending_request').val(obj[0].TA_NO_OF_PENDING_REQUEST);
              $('#ta_overdue').val(obj[0].TA_OVERDUE_AS_ON_DATE);
              // $('#pending_amount').val(obj[0].TA_PENDING_REQUEST_AMOUNT);
              $('#maximum_amount').val(parseInt($('#maximum_eligibleamount').val() ? $('#maximum_eligibleamount').val() : 0) - (parseInt($('#pending_amount').val() ? $('#pending_amount').val() : 0) + parseInt($('#ta_balance').val() ? $('#ta_balance').val() : 0)));
              if ($('#ta_overdue').val().length > 0 && $('#ta_overdue').val() != "0") {
                $('#ta_overdue').parent().css("border", "3px solid red");
                $('#maximum_amount').attr("disabled", true);
                $('#btnTARequest').attr("disabled", true);
              }
            } catch (e) {

            }
          },
          type: 'POST'
        });
      });
      var html;
      $("#btnTARequest").click(function(e)
      {

          var datastring = $("#frmrequest").serializeArray();
          var formDataInstance = new FormData();
          var invoice_1_file = $('input[type="file"]')[0].files[0];
          var invoice_2_file = $('input[type="file"]')[1].files[0];
          var invoice_3_file = $('input[type="file"]')[2].files[0];
          var invoice_4_file = $('input[type="file"]')[3].files[0];
          var invoice_5_file = $('input[type="file"]')[4].files[0];
          if (invoice_1_file) {
            formDataInstance.append("invoice_1_file", invoice_1_file);
          }
          if (invoice_2_file) {
            formDataInstance.append("invoice_2_file", invoice_2_file);
          }
          if (invoice_3_file) {
            formDataInstance.append("invoice_3_file", invoice_3_file);
          }
          if (invoice_4_file) {
            formDataInstance.append("invoice_4_file", invoice_4_file);
          }
          if (invoice_5_file) {
            formDataInstance.append("invoice_5_file", invoice_5_file);
          }
          $.each(datastring, function (key, input) {
            formDataInstance.append(input.name, input.value);
          });

          var amt_request = $('#maximum_amount').val();
          var ta_bal = $('#ta_balance').val();
          var amt_avail = $('#maximum_eligibleamount').val();
          //var amt_request = $('#maximum_amount').val();
          var diff_amt = amt_avail - ta_bal;

          if (!isFormDataValid()) {
            return false;
          }

          if (amt_request == 0) {
            //Request amount should be greater than zero
            //If ((Maximum Eligible Amount - TA Balance as on Date) < Amount Request) THEN
            bootbox.alert('<div class="alert alert-warning"><strong>Request amount should be greater than zero.</strong></div>');
          } 
          else if (diff_amt < amt_request && ta_bal > 0) 
          {
            //Request amount should be greater than zero

            //If ((Maximum Eligible Amount - TA Balance as on Date) < Amount Request) THEN
            bootbox.alert('<div class="alert alert-warning"><strong>Amount Request should be less than or equal to TA Balance.</strong></div>');
          } 
          else 
          {
                $.ajax({
                          url: 'https://tvscs.custhelp.com/cgi-bin/tvscs.cfg/php/custom/getotpwcreq.php?mobile='+thesetest+'&contactid='+contactguy+'&reqAMT='+amt_request,
                          processData: false,
                          contentType: false,
                          type: 'GET',
                          beforeSend: function () {
                            $('#loader-img-div').css('display','block');
                            $('body').css('display','none');
                          },
                          error: function () {
                            //window.location.reload();
                            // bootbox.alert("<p>An error has occurred....</p>");
                            alert("Some Error occured.");
                          },
                          complete:function(){
                             $('#loader-img-div').css('display','none');
                           $('body').css('display','block');
                          },
                          success: function (response) {
                          
                            var OTPobj = JSON.parse(response);
                            verifiedOTP = OTPobj.otp;
                          },
                      }).done(function(){
                          var otp = prompt("Please Enter OTP sent to your Registered mobile number or Email Address:");
                          if(otp == verifiedOTP)
                          {
                              $.ajax({
                                  url: '/cc/DealerCustom/createWCRequest',
                                  processData: false,
                                  contentType: false,
                                  // async: false,
                                  // datatype: "json",
                                  data: formDataInstance,
                                  beforeSend: function () {
                                    $('#loader-img-div').css('display','block');
                                    $('body').css('display','none');
                                  },
                                  complete: function(){
                                    $('#loader-img-div').css('display','none');
                                    $('body').css('display','block');
                                  },
                                  error: function () {
                                    //window.location.reload();
                                     bootbox.alert("<p>An error has occurred....</p>");
                                  },
                                  success: function (response) {
                                   
                                    var obj = jQuery.parseJSON(response);
                                    html = '<p>Thanks for submitting your WC Request. Use this reference number for follow up: <b><a href="/app/dealer/account/questions/detail/i_id/' + obj[0].value_id + '">' + obj[0].value_refno + '</a>.</b></p>';
                                    // bootbox.alert(html);
                                    // window.location.reload();
                                    //console.log(obj);
                                    sendApproverEmail(obj[0].value_id);
                                    //setTimeout(5000);

                                    /*var $title = $('<h1>').text(data.talks[0].talk_title);
                                     var $description = $('<p>').text(data.talks[0].talk_description);
                                     $('#info')
                                     .append($title)
                                     .append($description);*/
                                  },
                                  type: 'POST'
                                });
                            }
                            else{
                              alert('The OTP Entered by you was incorrect!');
                              //location.reload(true);
                            }    
                     });
          }
       });

      function sendApproverEmail(incidentID) {
        if (incidentID != '') {
          var paramstring = {
            'dcode': '<?php echo $dealer_code; ?>',
            'i_id': incidentID,
            'maximum_eligibleamount': jQuery("#maximum_eligibleamount").val(),
            'ta_balance': jQuery("#ta_balance").val(),
            'dealer_type': dltp,
            'contact_id': contactguy
          }
          $.ajax({
            url: '/cc/DealerCustom/sendWcApproverEmailRequest',
            type: 'post',
            data: paramstring,
            beforeSend: function () {
              $("#loader").removeClass("hidden");
            },
            error: function () {
              //window.location.reload();
              // bootbox.alert("<p>An error has occurred....</p>");
            },
            success: function (response) {
              //console.log(response);
              try {
                var obj = jQuery.parseJSON(response);
              } catch (e) {
                //window.location.reload();
                console.log(e);
              }
              $("#loader").addClass("hidden");
              //	console.log(obj);
              ///	alert(obj.email_sent);
              // if (obj.email_sent == 'true'){
              bootbox.alert(html, function () {
                window.location.reload();
              });
              //	   }else{
              //	bootbox.alert("<p>An error has occurred sending Approver Email</p>",function(){ window.location.reload(); });
              //   }
            }
          });
        }
      }

      function isFormDataValid() {
        var allInvoiceFields = "";
        jQuery("#invoiceFields input").each(function () {
          allInvoiceFields += (jQuery(this).val().trim() == "0") ? "" : jQuery(this).val().trim();
        });
        if (allInvoiceFields.length == 0) {
          alert("Please enter atleast one Invoice Data");
          return false;
        }
        if ((jQuery("#invoice_number_1").val().trim().length > 0 || jQuery("#invoice_amount_1").val().trim().length > 0 || jQuery("#invoice_attachment_1").val().trim().length > 0) && (jQuery("#invoice_number_1").val().trim().length == 0 || jQuery("#invoice_amount_1").val().trim().length == 0 || jQuery("#invoice_attachment_1").val().trim().length == 0)) {
          alert("Please upload Invoice for Row #1");
          return false;
        }
        if ((jQuery("#invoice_number_2").val().trim().length > 0 || jQuery("#invoice_amount_2").val().trim().length > 0 || jQuery("#invoice_attachment_2").val().trim().length > 0) && (jQuery("#invoice_number_2").val().trim().length == 0 || jQuery("#invoice_amount_2").val().trim().length == 0 || jQuery("#invoice_attachment_2").val().trim().length == 0)) {
          alert("Please upload Invoice for Row #2");
          return false;
        }
        if ((jQuery("#invoice_number_3").val().trim().length > 0 || jQuery("#invoice_amount_3").val().trim().length > 0 || jQuery("#invoice_attachment_3").val().trim().length > 0) && (jQuery("#invoice_number_3").val().trim().length == 0 || jQuery("#invoice_amount_3").val().trim().length == 0 || jQuery("#invoice_attachment_3").val().trim().length == 0)) {
          alert("Please upload Invoice for Row #3");
          return false;
        }
        if ((jQuery("#invoice_number_4").val().trim().length > 0 || jQuery("#invoice_amount_4").val().trim().length > 0 || jQuery("#invoice_attachment_4").val().trim().length > 0) && (jQuery("#invoice_number_4").val().trim().length == 0 || jQuery("#invoice_amount_4").val().trim().length == 0 || jQuery("#invoice_attachment_4").val().trim().length == 0)) {
          alert("Please upload Invoice for Row #4");
          return false;
        }
        if ((jQuery("#invoice_number_5").val().trim().length > 0 || jQuery("#invoice_amount_5").val().trim().length > 0 || jQuery("#invoice_attachment_5").val().trim().length > 0) && (jQuery("#invoice_number_5").val().trim().length == 0 || jQuery("#invoice_amount_5").val().trim().length == 0 || jQuery("#invoice_attachment_5").val().trim().length == 0)) {
          alert("Please upload Invoice for Row #5");
          return false;
        }
        if (parseInt(jQuery("#maximum_amount").val()) > parseInt(jQuery("#invoice_total_amount").val())) {
          alert("Amount Request should be less than or equal to Invoice Amount.");
          return false;
        }
        if (jQuery("#maximum_amount").val() > ($('#maximum_eligibleamount').val() - $('#pending_amount').val())) {
          alert("Maximum eligible amount already exceeded.");
          return false;
        }
        return true;
      }

      jQuery(".invoice_number_fields").change(function () {
        var invoice_number = jQuery(this).val().trim();
        var contact_ID = <?php echo $contactID ?>;
        var id = jQuery(this).attr("id");
        var invoice_number_element = jQuery(this);
        if (invoice_number.length > 0) {
          jQuery(".invoice_number_fields").each(function () {
            if (jQuery(this).attr("id") != id) {
              if (jQuery(this).val().trim().toLowerCase() == invoice_number.toLowerCase()) {
                alert("You have already entered this Invoice Number (" + invoice_number + "). Please enter a different Invoice Number.");
                jQuery(invoice_number_element).val("");
              }
            }
          });
        }
        var validate_invoice_number_url = window.location.origin + "/cgi-bin/tvscs.cfg/php/custom/validate_invoice_number.php?invoice_number=" + invoice_number+"&contact_id="+contact_ID;
        jQuery.ajax({url: validate_invoice_number_url,
          type: "GET",
          dataType: "text",
          error: function (xhr, status, error) {
            alert(status);
            alert(error);
            alert(xhr);
            alert(xhr.responseText);
          },
          success: function (data) {
            if (data) {
              if (data == "Invoice Number exists") {
                alert("This Invoice Number (" + invoice_number + ") already exists in the database. Please enter a different Invoice Number.");
                jQuery(invoice_number_element).val("");
                jQuery(invoice_number_element).focus();
              }
            }
          }
        });
      });

      jQuery(".invoice_amount_fields").change(function () {
        var invoice_amounts = 0;
        if (jQuery(this).val().trim() == "0") {
          jQuery(this).val("");
        }
        jQuery(".invoice_amount_fields").each(function () {
          if (jQuery(this).val().trim().length > 0 && jQuery.isNumeric(jQuery(this).val().trim())) {
            invoice_amounts = invoice_amounts + parseFloat(jQuery(this).val().trim());
          }
        });
        jQuery("#invoice_total_amount").val(invoice_amounts);
      });

      jQuery(".invoice_attachment_fields").change(function () {
        if (this.files[0].size > 1000000) {
          alert("File size should be less than or equal to 1 MB.");
          jQuery(this).val("");
        }
      });
    </script>
    <form id="frmrequest" name="frmrequest" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="contactID" value="<?php echo $CI->session->getProfileData("c_id"); ?>" />
      <div class="form-group">
        <label for="formGroupExampleInput1">WC Approved Limit</label>
        <div class="input-group col-md-4">
          <div class="input-group-addon">₹</div>
          <input type="text" class="form-control" id="maximum_eligibleamount" name="maximum_eligibleamount" placeholder="Amount" value="0" disabled>
          <div class="input-group-addon">.00</div>
        </div>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput2">WC Utilised Limit</label>
        <div class="input-group col-md-4">
          <div class="input-group-addon">₹</div>
          <input type="text" class="form-control" id="ta_balance" name="ta_balance" placeholder="TA Balance" value="0" disabled>
          <div class="input-group-addon">.00</div>
        </div> <strong></strong>
		<label for="formGroupExampleInput1">Overdue Amount</label>
        <div class="input-group col-md-4">
          <div class="input-group-addon">₹</div>
          <input type="text" class="form-control" id="ta_overdue" name="ta_overdue" placeholder="TA Overdue" value="0" disabled>
          <div class="input-group-addon">.00</div>
        </div>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput3">Amount Request</label>
        <div class="input-group col-md-4">
          <div class="input-group-addon">₹</div>
          <input type="text" class="form-control" id="maximum_amount" name="maximum_amount" placeholder="Amount Request" value="0" class="required">
          <div class="input-group-addon">.00</div>
        </div>
      </div>

      <div class="form-group">
        <label for="formGroupExampleInput2">No of Pending Request & Amount</label>
        <div class="input-group col-md-4">
          <div class="input-group-addon"></div>
          <input type="text" class="form-control" id="pending_request"  name="pending_request" placeholder="Noof Pending Request" value="<?php echo $total_requests; ?>" disabled>
          <div class="input-group-addon"></div>
        </div> <strong>&</strong>
        <div class="input-group col-md-4">
          <div class="input-group-addon">₹</div>
          <input type="text" class="form-control" id="pending_amount" name="pending_amount" placeholder="Amount" value="<?php echo $total_amount_requested; ?>" disabled>
          <div class="input-group-addon">.00</div>
        </div>
      </div>

      <div class="form-group" id="invoiceFields">
        <table>
          <tr>
            <th class="col-sm-1">S.No</th>
            <th class="col-sm-4">Invoice Number</th>
            <th class="col-sm-4">Invoice Amount</th>
            <th class="col-sm-3">Attach Document</th>
          <tr>
          <tr>
            <td>1</td>
            <td><input type="text" class="form-control invoice_number_fields" id="invoice_number_1" name="invoice_number_1" /></td>
            <td><input type="text" class="form-control invoice_amount_fields" id="invoice_amount_1" name="invoice_amount_1" /></td>
            <td><input type="file" class="form-control-file invoice_attachment_fields" id="invoice_attachment_1" name="invoice_attachment_1" /></td>
          </tr>
          <tr>
            <td>2</td>
            <td><input type="text" class="form-control invoice_number_fields" id="invoice_number_2" name="invoice_number_2" /></td>
            <td><input type="text" class="form-control invoice_amount_fields" id="invoice_amount_2" name="invoice_amount_2" /></td>
            <td><input type="file" class="form-control-file invoice_attachment_fields" id="invoice_attachment_2" name="invoice_attachment_2" /></td>
          </tr>
          <tr>
            <td>3</td>
            <td><input type="text" class="form-control invoice_number_fields" id="invoice_number_3" name="invoice_number_3" /></td>
            <td><input type="text" class="form-control invoice_amount_fields" id="invoice_amount_3" name="invoice_amount_3" /></td>
            <td><input type="file" class="form-control-file invoice_attachment_fields" id="invoice_attachment_3" name="invoice_attachment_3" /></td>
          </tr>
          <tr>
            <td>4</td>
            <td><input type="text" class="form-control invoice_number_fields" id="invoice_number_4" name="invoice_number_4" /></td>
            <td><input type="text" class="form-control invoice_amount_fields" id="invoice_amount_4" name="invoice_amount_4" /></td>
            <td><input type="file" class="form-control-file invoice_attachment_fields" id="invoice_attachment_4" name="invoice_attachment_4" /></td>
          </tr>
          <tr>
            <td>5</td>
            <td><input type="text" class="form-control invoice_number_fields" id="invoice_number_5" name="invoice_number_5" /></td>
            <td><input type="text" class="form-control invoice_amount_fields" id="invoice_amount_5" name="invoice_amount_5" /></td>
            <td><input type="file" class="form-control-file invoice_attachment_fields" id="invoice_attachment_5" name="invoice_attachment_5" /></td>
          </tr>
          <tr>
            <td></td>
            <td align="right"><b>Total Amount:&nbsp;</b></td>
            <td><input type="text" readonly id="invoice_total_amount" value="0" /></td>
            <td></td>
          </tr>
        </table>
      </div>

      <button type="button" class="btn btn-primary" id="btnTARequest">Submit</button>
    </form>
  </body>
</html>