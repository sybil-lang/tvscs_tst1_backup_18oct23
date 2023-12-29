<rn:meta title="Walkin Reports" template="employee_header.php" clickstream="employee_walkin_reports" login_required="true" force_https="true" />
<?php
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
<style type="text/css">
  header nav,
  header navbar {
    max-width: 1230px !important;
  }

  .space {
    margin: 2px;
  }

  #card_div {
      cursor: pointer;
    }
  .tiles {
    max-width: 108rem;
    position: relative;
    width: 125%;
    padding: 15px 20px;
    display: inline-block;

  }

  .tiles-parent {
    padding: 8px 20px;
    text-overflow: ellipsis;
    white-space: nowrap;
    position: relative;
    border: 0px solid transparent;
    border-radius: 1px;
  }

  .count {
    line-height: 47px;
    font-weight: 500;
    text-align: left;
    font-size: 30px;
  }

  .loader {
    position: absolute;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 99999;
    width: 100%;
    height: 100%;
  }

  .loader .lds-ripple {
    display: inline-block;
    position: relative;
    /* width: 80px;
    height: 80px; */
    top: 50%;
    left: 50%;
    /* transform: translate(-50%, -50%); */
    border: 12px solid #f3f3f3;
    border-radius: 50%;
    border-top: 12px solid #454545;
    width: 60px;
    height: 60px;
    -webkit-animation: spin 2s linear infinite;
    /* Safari */
    animation: spin 2s linear infinite;
    margin-left: auto;
    margin-right: auto;
  }

  .paginationdiv {
    display: flex;
    align-items: center;
    justify-content: space-between;

  }


  #search_value {
    width: 170px;
  }

  .btn:focus {
    outline: none;
  }

  #search {
    border: none;
    background-color: #03a9f4;
    color: white;
    outline: none;
  }

  #clear {
    border: none;
    background-color: #e84e40;
    color: white;
    outline: none;
  }

  #closer {
    border: none;
    background-color: #ff9800;
    color: white;
    outline: none;
  }

  #search:hover {
    background-color: #00bfff;
    color: white;
  }

  #clear:hover {
    background-color: #ff0000;
    color: white;
  }

  #closer:hover {
    background-color: #ffad33;
    color: white;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  .hide-loader {
    display: none;
  }

  .error-message {
    color: red;
  }

  /* form css */
  form {
    display: block;
  }

  .inline-span {
    display: inline-block;
    vertical-align: top;
  }

  .mid_div {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  td {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: center;
  }

  th {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: center;
  }

  .customer-type {
    background-color: #777;
    color: white;
    border: 1px solid #3f3f3f;
    text-align: center;
  }
</style>
<div>
  <!-- <div class="rn_AskQuestion rn_Container">
  <iframe src="https://tms.tvscredit.com/ValidateUser/CheckUser?auth=e4a517751a95b256fd16990c6fe19ed6&emp_id=<?php echo $md5EmployeeCode; ?>" style="border:none; width: 100%; height:900px;"></iframe>
</div> -->
  <div class="rn_AskQuestion rn_Container">
    <!-- <iframe src="https://tms.tvscredit.com/ValidateUser/CheckUser?auth=e4a517751a95b256fd16990c6fe19ed6&emp_id=<?php echo $md5EmployeeCode; ?>" style="border:none; width: 100%; height:900px;"></iframe> -->

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.0/jquery.timepicker.min.css" integrity="sha512-WlaNl0+Upj44uL9cq9cgIWSobsjEOD1H7GK1Ny1gmwl43sO0QAUxVpvX2x+5iQz/C60J3+bM7V07aC/CNWt/Yw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.0/jquery.timepicker.min.js" integrity="sha512-s0SB4i9ezk9SRyV1Glrj/w5xS5ExSxXiN44fQeV9GYOtExbVWnC+mUsUyZdIYv6qXL0xe1qvpe0h1kk56gsgaA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
      <!-- Add bootstrap pagination CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

      <!-- Add bootstrap pagination JS -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

      <!-- Bootstrap JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfH4/QRorlJ+darRgNplicHSXKbJvoRxT2MZwUlU" crossorigin="anonymous"></script>

      <!-- Bootbox JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>


      <script>
        $(document).ready(function() {
          console.log("hello");

          ///JS Counter for Status count 
          $('.count').each(function() {
            var $this = $(this);
            jQuery({
              Counter: 0
            }).animate({
              Counter: $this.text()
            }, {
              duration: 1000,
              easing: 'swing',
              step: function() {
                $this.text(Math.ceil(this.Counter));
              }
            });
          });

          generatetable();

          //function for changing the functions of pagination buttons when clicked on the search form button
          $('#search').click(function() {
            $('#a_next_button').attr('onclick', 'next_page_search()');
            $('#a_prev_button').attr('onclick', 'prev_page_search()');
            $('#a_first_button').attr('onclick', 'first_page_search()');
            $('#a_last_button').attr('onclick', 'last_page_search()');
            $('#a_page_show').attr('onclick', 'page_show_search(this.innerHTML)');
          });

          let selectedTokens = [];

          function getSelectedTokens() {

            $('.checkbox-row').each(function() {
              if ($(this).is(':checked')) {
                var token = $(this).closest('tr').find('td:eq(1)').text();
                selectedTokens.push(token);
              }
            });

            return selectedTokens;
          }

          $("#closer").click(function() {
            console.log("Clicked on closer");
            var selectedTokens = getSelectedTokens();
            console.log(selectedTokens.length);
            if (selectedTokens.length > 0) {
              console.log(selectedTokens);
              var TokensString = selectedTokens.join(',');
              var employeecode = <?php echo $employeeCode; ?>;
              bootbox.dialog({
                title: "Custom Title",
                message: '<form><div class="form-group"><label for="remarks">Custom Remarks</label><input type="text" class="form-control" id="remarks"><div id="remarks-error" class="invalid-feedback" style="color: red;">This field is required.</div></div><div class="form-group"><label for="status">Status</label><select class="form-control" id="status"><option value="closed">Closed</option><option value="new_request">New Service Request</option></select></div></form>',
                buttons: {
                  cancel: {
                    label: 'Cancel',
                    className: 'btn-default'
                  },
                  confirm: {
                    label: 'Save',
                    className: 'btn-primary',
                    callback: function() {
                      var remarks = $('#remarks').val();
                      var status = $('#status').val();

                      if (status === 'new_request') {
                        window.location.href = 'https://tvscs--tst1.custhelp.com/app/employee/walkin_report_edit_new';
                      } else if (status === 'closed') {
                        if (!remarks) {
                          $('#remarks').addClass('is-invalid');
                          $('#remarks-error').show();
                          return false;
                        } else {
                          console.log('Custom remarks:', remarks);
                          bootbox.dialog({
                            title: "Confirm Closure",
                            message: "Please confirm for closing the tokens which are " + selectedTokens,
                            buttons: {
                              cancel: {
                                label: 'Cancel',
                                className: 'btn-default'
                              },
                              confirm: {
                                label: 'Close Tickets',
                                className: 'btn-primary',
                                callback: function() {
                                  //calling ajax
                                  $.ajax({
                                    url: '/cc/AjaxCustom/UpdateTokenStatususingbulk',
                                    data: {
                                      closureRemark: remarks,
                                      token: TokensString,
                                      employeecode: employeecode
                                    },
                                    type: "POST",
                                    async: false,
                                    success: function(data) {
                                      console.log(data);
                                      bootbox.alert({
                                        message: "The Selected tickets have been closed",
                                        callback: function() {
                                          location.reload();
                                        }
                                      });

                                    },
                                    error: function(err) {
                                      console.log(err);
                                      return err;
                                    }
                                  });
                                }
                              }
                            }
                          });
                        }
                      }

                      console.log('Selected status:', status);
                    }
                  }
                }
              });


              // Hide the error message initially
              $('#remarks-error').hide();

              // Show or hide the error message when the "Custom Remarks" field changes
              $('#remarks').on('input', function() {
                if ($(this).val()) {
                  $('#remarks').removeClass('is-invalid');
                  $('#remarks-error').hide();
                } else {
                  $('#remarks').addClass('is-invalid');
                  $('#remarks-error').show();
                }
              });

              // $.ajax({
              //           url: '/cc/AjaxCustom/UpdateTokenStatus',
              //           data: {
              //               closureRemark: closureRemark,
              //               token: selectedTokensString,
              //               employeecode: employeecode
              //           },
              //           type: "POST",
              //           async: false,
              //           success: function(data) {
              //               console.log(data);
              //               alert("Token Status Updated as Closed Successfully");
              //           },
              //           error: function(err) {
              //               console.log(err);
              //               return err;
              //           }
              //       });
            } else {
              alert('Please select at least one record to close.');
            }
          });
        });



        var employeecode = <?php echo $employeeCode; ?>;
        $.post("/cc/AjaxCustom/GetTokenCountByStatusForReport", {
          employeecode: employeecode
        }).done(
          function(data) {
            var somedata = data;
            console.log(data);
            try {
              var data = JSON.parse(data);
              console.log(data);
              var all_tokens = data.ReturnOutput[0].CNT;
              console.log('all_tokens' + all_tokens);
              var open_tokens = data.ReturnOutput[1].CNT;
              console.log('opne_tokens' + open_tokens);
              var closed_tokens = data.ReturnOutput[2].CNT;
              console.log('closed_tokens' + closed_tokens);
              var service_requests = data.ReturnOutput[3].CNT;
              console.log('service_requests' + service_requests);
              $('#all_tokens').text(all_tokens);
              $('#open_tokens').text(open_tokens);
              $('#closed_tokens').text(closed_tokens);
              $('#service_requests').text(service_requests);
            } catch (err) {
              console.log(err.message);
            }
          }
        );


        var page_number_search = 1;
        var total_page_search;
        var last_page_flag_search = false;
        var total_page;
        var page_number = 1;
        var last_page_flag = false;

        function generatetable() {
          console.log("inside table funtion");
          $('#loader').removeClass("hide-loader");
          var employeecode = <?php echo $employeeCode ?>;
          var status_code = 1;
          $.post("/cc/AjaxCustom/GetTokenListApiForTmsDashboard", {
            employeecode: employeecode,
            page_number: page_number,
            status_code: status_code
          }).done(function(data) {
            var somedata = data;
            console.log(data);
            try {
              var main_data = JSON.parse(somedata);
              const records_per_page = 20; //total records we wanna display per page
              const total_records = main_data['TotalRecords'];
              console.log("total_records", total_records);
              total_page = Math.ceil(total_records / records_per_page); //total page logic
              console.log("total_page", total_page);
              const records = main_data['ReturnOutput'].length;
              var start_index = (page_number - 1) * records_per_page;
              var end_index = start_index + (records_per_page - 1);
              var loopvalue = 20;
              if (last_page_flag == true) {
                page_number = total_page;
                end_index = total_records - 1;
                start_index = (page_number - 1) * records_per_page;
                loopvalue = end_index - start_index + 1;
                console.log(page_number);
                var pageLinks = document.getElementsByClassName("page-link-m");
                for (var i = 0; i < pageLinks.length; i++) {
                  pageLinks[i].innerHTML = (page_number - 4) + i;
                  pageLinks[i].parentElement.classList.remove("active");
                  if (pageLinks[i].innerHTML == total_page) {
                    pageLinks[i].parentElement.classList.add("active");
                  }
                }
              }
              console.log("records", records);
              console.log("start_index", start_index);
              console.log("end_index", end_index);
              console.log("Loopvalue", loopvalue);
              var html = "";
              var j = start_index;
              $('#loader').addClass("hide-loader");
              $('#table_head').fadeIn()
              for (i = 0; i < loopvalue; i++) {

                j++;

                var ServiceRequestId = main_data['ReturnOutput'][i]['ServiceRequestId'];
                var ServiceRequestIdDisplay = ServiceRequestId ? ServiceRequestId : "--";

                var LeadId = main_data['ReturnOutput'][i]['LeadId'];
                var LeadIdDisplay = LeadId ? LeadId : "--";

                var EMail = main_data['ReturnOutput'][i]['EMail'];
                var EMailDisplay = EMail ? EMail : "--";

                var AlternateMobile = main_data['ReturnOutput'][i]['AlternateMobile'];
                var AlternateMobileDisplay = AlternateMobile ? AlternateMobile : "--";

                var Remarks = main_data['ReturnOutput'][i]['Remarks'];
                var RemarksDisplay = Remarks ? Remarks : "--";


                html += "<tr><td>" + j + "</td><td>" + main_data['ReturnOutput'][i]['Token'] + "</td><td>" + main_data['ReturnOutput'][i]['TokenRequestId'] + "</td><td>" + ServiceRequestIdDisplay + "</td><td>" + LeadIdDisplay + "</td><td>" + main_data['ReturnOutput'][i]['CustomerName'] + "</td><td>" + EMailDisplay + "</td><td>" + main_data['ReturnOutput'][i]['Mobile'] + "</td><td>" + AlternateMobileDisplay + "</td><td>" + main_data['ReturnOutput'][i]['AgreementNumber'] + "</td><td class='customer-type'>" + main_data['ReturnOutput'][i]['CustomerType'] + "</td><td style='background-color:";

                if (main_data['ReturnOutput'][i]['CaseStatus'] === 'CLOSED') {
                  html += "#337ab7; color: white; text-align: center;'>" + main_data['ReturnOutput'][i]['CaseStatus'] + "</td>";
                } else {
                  html += "#1b8258; color: white; text-align: center;'>" + main_data['ReturnOutput'][i]['CaseStatus'] + "</td>";
                }

                html += "<td>" + main_data['ReturnOutput'][i]['CreatedDate'] + "</td><td>" + main_data['ReturnOutput'][i]['UserId'] + "</td><td>" + main_data['ReturnOutput'][i]['UserName'] + "</td><td>" + main_data['ReturnOutput'][i]['AssignedTo'] + "</td><td>" + main_data['ReturnOutput'][i]['AssignedDate'] + "</td><td>" + RemarksDisplay + "</td><td>";

                // Add the view icon
                html += "<a href='https://tvscs--tst1.custhelp.com/app/employee/walkin_reports_view/?token=" + main_data['ReturnOutput'][i]['Token'] + "'><i class='fa fa-eye' style='font-size:18px; color: #03a9f4; padding-right: 10px;'></i></a>";

                // Add the edit icon only if the status is not closed
                // if (main_data['ReturnOutput'][i]['CaseStatus'] !== 'CLOSED') {
                html += "<a href='https://tvscs--tst1.custhelp.com/app/employee/walkin_reports_edit/?token=" + main_data['ReturnOutput'][i]['Token'] + "'><i class='fa fa-edit' style='font-size:18px; color: #03a9f4; padding-right: 10px;'></i></a>";
                html += "<input type='checkbox' class='checkbox-row'/></td></tr>";
                // }

              }

              $("#table_data").html(html);
              let navi_text = document.getElementById("page_navigation_text");
              navi_text.innerHTML = `Showing ${start_index+1} to ${end_index+1} of ${total_records} entries`;
              $("#paginationdiv").show();

              const firstButton = document.getElementById("first_button");
              const prevButton = document.getElementById("prev_button");
              if (start_index === 0) {
                firstButton.classList.add("disabled");
                prevButton.classList.add("disabled");
              } else {
                firstButton.classList.remove("disabled");
                prevButton.classList.remove("disabled");
              }
              const lastButton = document.getElementById("last_button");
              const nextButton = document.getElementById("next_button");
              if (end_index + 1 === total_records) {
                lastButton.classList.add("disabled");
                nextButton.classList.add("disabled");
              } else {
                lastButton.classList.remove("disabled");
                nextButton.classList.remove("disabled");
              }

            } catch (err) {
              console.log(err.message);
            }
          });
        }

        function generatedivtable(status_code){
          console.log("code is :",status_code);
          $('#loader').removeClass("hide-loader");
          var employeecode = <?php echo $employeeCode ?>;
          console.log("employeecode",employeecode);
          $.post("/cc/AjaxCustom/GetTokenListApiForTmsDashboard", {
            employeecode: employeecode,
            page_number: page_number,
            status_code: status_code
          }).done(function(data) {
            var somedata = data;
            console.log(data);
            try {
              var main_data = JSON.parse(somedata);
              if(main_data['ReturnMessage'] === "No Data Found."){
                console.log("No Data found");
                $("#table_data").html(`<div style="text-align:center; color:red; white-space: nowrap;">No Data available in table</div>`);
                var pageItems = document.getElementsByClassName("page-item");
                for (var i = 0; i < pageItems.length; i++) {
                  pageItems[i].classList.add("disabled");
                }
                var pageItems_m = document.getElementsByClassName("page-items");
                for (var i = 0; i < pageItems_m.length; i++) {
                  pageItems_m[i].style.display = "none";
                }
                document.getElementById("page_navigation_text").innerHTML = `Showing 0 to 0 of 0 entries`;
                $('#loader').addClass("hide-loader");

              }
              const records_per_page = 20; //total records we wanna display per page  
              const total_records = main_data['TotalRecords'];
              console.log("total_records", total_records);
              total_page = Math.ceil(total_records / records_per_page); //total page logic
              console.log("total_page", total_page);
              const records = main_data['ReturnOutput'].length;
              var start_index = (page_number - 1) * records_per_page;
              var end_index = start_index + (records_per_page - 1);
              var loopvalue = 20;
              if (last_page_flag == true) {
                page_number = total_page;
                end_index = total_records - 1;
                start_index = (page_number - 1) * records_per_page;
                loopvalue = end_index - start_index + 1;
                console.log(page_number);
                var pageLinks = document.getElementsByClassName("page-link-m");
                for (var i = 0; i < pageLinks.length; i++) {
                  pageLinks[i].innerHTML = (page_number - 4) + i;
                  pageLinks[i].parentElement.classList.remove("active");
                  if (pageLinks[i].innerHTML == total_page) {
                    pageLinks[i].parentElement.classList.add("active");
                  }
                }
              }
              console.log("records", records);
              console.log("start_index", start_index);
              console.log("end_index", end_index);
              console.log("Loopvalue", loopvalue);
              var html = "";
              var j = start_index;
              $('#loader').addClass("hide-loader");
              $('#table_head').fadeIn()
              for (i = 0; i < loopvalue; i++) {

                j++;

                var ServiceRequestId = main_data['ReturnOutput'][i]['ServiceRequestId'];
                var ServiceRequestIdDisplay = ServiceRequestId ? ServiceRequestId : "--";

                var LeadId = main_data['ReturnOutput'][i]['LeadId'];
                var LeadIdDisplay = LeadId ? LeadId : "--";

                var EMail = main_data['ReturnOutput'][i]['EMail'];
                var EMailDisplay = EMail ? EMail : "--";

                var AlternateMobile = main_data['ReturnOutput'][i]['AlternateMobile'];
                var AlternateMobileDisplay = AlternateMobile ? AlternateMobile : "--";

                var Remarks = main_data['ReturnOutput'][i]['Remarks'];
                var RemarksDisplay = Remarks ? Remarks : "--";


                html += "<tr><td>" + j + "</td><td>" + main_data['ReturnOutput'][i]['Token'] + "</td><td>" + main_data['ReturnOutput'][i]['TokenRequestId'] + "</td><td>" + ServiceRequestIdDisplay + "</td><td>" + LeadIdDisplay + "</td><td>" + main_data['ReturnOutput'][i]['CustomerName'] + "</td><td>" + EMailDisplay + "</td><td>" + main_data['ReturnOutput'][i]['Mobile'] + "</td><td>" + AlternateMobileDisplay + "</td><td>" + main_data['ReturnOutput'][i]['AgreementNumber'] + "</td><td class='customer-type'>" + main_data['ReturnOutput'][i]['CustomerType'] + "</td><td style='background-color:";

                if (main_data['ReturnOutput'][i]['CaseStatus'] === 'CLOSED') {
                  html += "#337ab7; color: white; text-align: center;'>" + main_data['ReturnOutput'][i]['CaseStatus'] + "</td>";
                } else {
                  html += "#1b8258; color: white; text-align: center;'>" + main_data['ReturnOutput'][i]['CaseStatus'] + "</td>";
                }

                html += "<td>" + main_data['ReturnOutput'][i]['CreatedDate'] + "</td><td>" + main_data['ReturnOutput'][i]['UserId'] + "</td><td>" + main_data['ReturnOutput'][i]['UserName'] + "</td><td>" + main_data['ReturnOutput'][i]['AssignedTo'] + "</td><td>" + main_data['ReturnOutput'][i]['AssignedDate'] + "</td><td>" + RemarksDisplay + "</td><td>";

                // Add the view icon
                html += "<a href='https://tvscs--tst1.custhelp.com/app/employee/walkin_reports_view/?token=" + main_data['ReturnOutput'][i]['Token'] + "'><i class='fa fa-eye' style='font-size:18px; color: #03a9f4; padding-right: 10px;'></i></a>";

                // Add the edit icon only if the status is not closed
                // if (main_data['ReturnOutput'][i]['CaseStatus'] !== 'CLOSED') {
                html += "<a href='https://tvscs--tst1.custhelp.com/app/employee/walkin_reports_edit/?token=" + main_data['ReturnOutput'][i]['Token'] + "'><i class='fa fa-edit' style='font-size:18px; color: #03a9f4; padding-right: 10px;'></i></a>";
                html += "<input type='checkbox' class='checkbox-row'/></td></tr>";
                // }

              }

              $("#table_data").html(html);
              let navi_text = document.getElementById("page_navigation_text");
              navi_text.innerHTML = `Showing ${start_index+1} to ${end_index+1} of ${total_records} entries`;
              $("#paginationdiv").show();

              const firstButton = document.getElementById("first_button");
              const prevButton = document.getElementById("prev_button");
              if (start_index === 0) {
                firstButton.classList.add("disabled");
                prevButton.classList.add("disabled");
              } else {
                firstButton.classList.remove("disabled");
                prevButton.classList.remove("disabled");
              }
              const lastButton = document.getElementById("last_button");
              const nextButton = document.getElementById("next_button");
              if (end_index + 1 === total_records) {
                lastButton.classList.add("disabled");
                nextButton.classList.add("disabled");
              } else {
                lastButton.classList.remove("disabled");
                nextButton.classList.remove("disabled");
              }

            } catch (err) {
              console.log(err.message);
            }
          });
        }

        function updatePlaceholder() {
          var statusSearch = document.getElementById("status_search");
          var searchValue = document.getElementById("search_value");
          switch (statusSearch.value) {
            case "Token":
              searchValue.placeholder = "Enter Token";
              break;
            case "Customer Name":
              searchValue.placeholder = "Enter Customer Name";
              break;
            case "Email":
              searchValue.placeholder = "Enter Email";
              break;
            case "Mobile":
              searchValue.placeholder = "Enter Mobile";
              break;
            case "Customer Type":
              searchValue.placeholder = "Enter Customer Type";
              break;
            default:
              searchValue.placeholder = "Enter Value";
              break;
          }
        }

        function next_page() {
          last_page_flag = false;
          var nextButton = document.getElementById("next_button");
          if (nextButton.classList.contains("disabled")) {
            return;
          }
          page_number++;
          console.log("next page function is clicked");
          console.log("next_page_number", page_number);
          generatetable();
          var pageLinks = document.getElementsByClassName("page-link-m");
          for (var i = 0; i < pageLinks.length; i++) {
            var pageNum = parseInt(pageLinks[i].innerHTML);
            pageLinks[i].innerHTML = pageNum + 1;
          }
        }

        function prev_page() {
          last_page_flag = false;
          console.log("next page function is clicked");
          var prevButton = document.getElementById("prev_button");
          if (prevButton.classList.contains("disabled")) {
            return;
          }
          page_number--;
          console.log("next_page_number", page_number);
          generatetable();
          var pageLinks = document.getElementsByClassName("page-link-m");
          for (var i = 0; i < pageLinks.length; i++) {
            var pageNum = parseInt(pageLinks[i].innerHTML);
            pageLinks[i].innerHTML = pageNum - 1;
          }
        }

        function page_show(value) {
          last_page_flag = false;
          console.log("page_show");
          var firstlink = document.getElementById("first_link");
          if (firstlink.classList.contains("disabled")) {
            return;
          }
          console.log("Value: " + value);
          page_number = value;
          console.log(page_number);
          generatetable();
          // Add active class to current page
          var pageLinks = document.getElementsByClassName("page-link-m");
          for (var i = 0; i < pageLinks.length; i++) {
            pageLinks[i].parentElement.classList.remove("active");
            if (pageLinks[i].innerHTML == page_number) {
              pageLinks[i].parentElement.classList.add("active");
            }
          }
        }

        function first_page() {
          last_page_flag = false;
          var firstButton = document.getElementById("first_button");
          if (firstButton.classList.contains("disabled")) {
            return;
          }
          page_number = 1;
          console.log(page_number);
          generatetable();
          var pageLinks = document.getElementsByClassName("page-link-m");
          for (var i = 0; i < pageLinks.length; i++) {
            pageLinks[i].innerHTML = i + 1;
            pageLinks[i].parentElement.classList.remove("active");
            if (pageLinks[i].innerHTML == 1) {
              pageLinks[i].parentElement.classList.add("active");
            }
          }
        }

        function last_page() {
          var lastButton = document.getElementById("last_button");
          if (lastButton.classList.contains("disabled")) {
            return;
          }
          last_page_flag = true;
          generatetable();
        }

        // function for search button functionality 
        function SearchByCat() {
          console.log("clicked on search");

          var selectElement = document.getElementById("status_search");
          var selectedOption = selectElement.options[selectElement.selectedIndex].value; //value of selected option
          var inputText = document.getElementById("search_value").value; //value of input text
          var errorMessage = document.getElementById("error_message");

          if (!inputText) {
            errorMessage.innerHTML = "This field is required"; //if input-text is empty then fill inner html 
            return;
          }
          errorMessage.innerHTML = ""; //if input-text is not empty then fill inner html as empty

          console.log("Selected option: " + selectedOption);
          console.log("Input text: " + inputText);

          $('#loader').removeClass("hide-loader");

          $.ajax({
            url: '/cc/AjaxCustom/GetSerachByCategory',
            data: {
              sel_opt: selectedOption,
              inp_text: inputText,
              page_number_search: page_number_search,
            },
            success: function(response) {
              console.log(response);
              var responsedata = response;
              var response_data = JSON.parse(responsedata); // Your data array

              var htmlresponse = "";
              $('#loader').addClass("hide-loader");
              $('#table_head').fadeIn()

              if (response_data["ReturnMessage"] == "No Data Found.") {
                console.log("testing for no data found");
                $("#table_data").html(`<div style="text-align:center; color:red; white-space: nowrap;">No Data available in table</div>`);
                var pageItems = document.getElementsByClassName("page-item");
                for (var i = 0; i < pageItems.length; i++) {
                  pageItems[i].classList.add("disabled");
                }
                var pageItems_m = document.getElementsByClassName("page-items");
                for (var i = 0; i < pageItems_m.length; i++) {
                  pageItems_m[i].style.display = "none";
                }
                document.getElementById("page_navigation_text").innerHTML = `Showing 0 to 0 of 0 entries`;

              } else {
                console.log("data is found");
                const recordsperpage = 20; //total records we wanna display per page
                const totalrecords = response_data['TotalRecords']; //total number of records coming from the API response
                console.log("totalrecords", totalrecords);
                const totalpage = Math.ceil(totalrecords / recordsperpage); //total page logic
                console.log("totalpage", totalpage);
                var startindex = (page_number_search - 1) * recordsperpage; //start index
                console.log("startindex", startindex);
                var endindex = startindex + (recordsperpage - 1); //end index
                console.log("endindex", endindex);
                var j = startindex;

                for (var i = startindex; i < response_data.ReturnOutput.length; i++) {

                  j++;

                  var ServiceRequestId = response_data['ReturnOutput'][i]['ServiceRequestId'];
                  var ServiceRequestIdDisplay = ServiceRequestId ? ServiceRequestId : "--";

                  var LeadId = response_data['ReturnOutput'][i]['LeadId'];
                  var LeadIdDisplay = LeadId ? LeadId : "--";

                  var EMail = response_data['ReturnOutput'][i]['EMail'];
                  var EMailDisplay = EMail ? EMail : "--";

                  var AlternateMobile = response_data['ReturnOutput'][i]['AlternateMobile'];
                  var AlternateMobileDisplay = AlternateMobile ? AlternateMobile : "--";

                  var Remarks = response_data['ReturnOutput'][i]['Remarks'];
                  var RemarksDisplay = Remarks ? Remarks : "--";

                  htmlresponse += "<tr><td>" + j + "</td><td>" + response_data['ReturnOutput'][i]['Token'] + "</td><td>" + response_data['ReturnOutput'][i]['TokenRequestId'] + "</td><td>" + ServiceRequestIdDisplay + "</td><td>" + LeadIdDisplay + "</td><td>" + response_data['ReturnOutput'][i]['CustomerName'] + "</td><td>" + EMailDisplay + "</td><td>" + response_data['ReturnOutput'][i]['Mobile'] + "</td><td>" + AlternateMobileDisplay + "</td><td>" + response_data['ReturnOutput'][i]['AgreementNumber'] + "</td><td class='customer-type'>" + response_data['ReturnOutput'][i]['CustomerType'] + "</td><td style='background-color:";

                  if (response_data['ReturnOutput'][i]['CaseStatus'] === 'CLOSED') {
                    htmlresponse += "#337ab7; color: white; text-align: center;'>" + response_data['ReturnOutput'][i]['CaseStatus'] + "</td>";
                  } else {
                    htmlresponse += "#1b8258; color: white; text-align: center;'>" + response_data['ReturnOutput'][i]['CaseStatus'] + "</td>";
                  }

                  htmlresponse += "<td>" + response_data['ReturnOutput'][i]['CreatedDate'] + "</td><td>" + response_data['ReturnOutput'][i]['UserId'] + "</td><td>" + response_data['ReturnOutput'][i]['UserName'] + "</td><td>" + response_data['ReturnOutput'][i]['AssignedTo'] + "</td><td>" + response_data['ReturnOutput'][i]['AssignedDate'] + "</td><td>" + RemarksDisplay + "</td><td>";

                  // Add the view icon
                  htmlresponse += "<a href='https://tvscs--tst1.custhelp.com/app/employee/walkin_reports_view/?token=" + response_data['ReturnOutput'][i]['Token'] + "'><i class='fa fa-eye' style='font-size:18px; color: #03a9f4; padding-right: 10px;'></i></a>";

                  // Add the edit icon only if the status is not closed
                  if (response_data['ReturnOutput'][i]['CaseStatus'] !== 'CLOSED') {
                    htmlresponse += "<a href='https://tvscs--tst1.custhelp.com/app/employee/walkin_reports_edit/?token=" + response_data['ReturnOutput'][i]['Token'] + "'><i class='fa fa-edit' style='font-size:18px; color: #03a9f4; padding-right: 10px;'></i></a>";
                    htmlresponse += "<input type='checkbox' class='checkbox-row'/></td></tr>";
                  }
                }

                $("#table_data").html(htmlresponse);
                document.getElementById("page_navigation_text").innerHTML = `Showing ${startindex+1} to ${totalrecords} of ${totalrecords} entries`;
                var pageItems = document.getElementsByClassName("page-item");
                for (var i = 0; i < pageItems.length; i++) {
                  pageItems[i].classList.add("disabled");
                }
                var pageItems_m = document.getElementsByClassName("page-items");
                for (var i = 1; i < pageItems_m.length; i++) {
                  pageItems_m[i].style.display = "none";
                }
                document.getElementsByClassName("page-items")[0].classList.add("disabled");
                document.getElementsByClassName("page-link-m")[0].innerHTML = 1;
              }
            },
            type: 'POST'
          });

        }

        function ClearCat() {
          console.log("clicked on clear");
          const input_text = document.getElementById("search_value").value;
          if (input_text !== "") {
            document.getElementById("status_search").selectedIndex = 0;
            document.getElementById("search_value").value = "";
            updatePlaceholder();
            $('#loader').removeClass("hide-loader");
            var pageItems_m = document.getElementsByClassName("page-items");
            for (var i = 1; i < pageItems_m.length; i++) {
              pageItems_m[i].style.display = "unset";
            }
            document.getElementsByClassName("page-items")[0].classList.remove("disabled");
            generatetable();
          }
          document.getElementById("error_message").innerHTML = "";
        }
      </script>
    </head>

    <body>
      <div class="rn_Container">
        <h1>Walkin Reports</h1>
        <!-- <div style="border:1px solid #E6E9ED; padding: 8px 20px 15px 20px; "> -->
        <div class="row">
          <a onClick="generatetable()">
            <div class="col-sm-3" id ="card_div">
              <div class="tiles-parent">
                <div class="card border-secondary mb-3 tiles" style="border-left: 7px solid #009688;">
                  <i class="fa fa-3x fa-tags" style="float: right;padding-top: 13px;color:#009688;"></i>
                  <div class="card-header" style="color: #03a9f4;display:block;font-family: sans-serif;font-weight: 500;">
                    All Tokens
                  </div>
                  <div class="card-body text-secondary">
                    <div class="count" style="font-family: sans-serif;font-weight: 500;" id="all_tokens">112814</div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          <a onClick="generatedivtable(2)">
            <div class="col-sm-3" id ="card_div">
              <div class="tiles-parent" style="box-sizing: border-box;">
                <div class="card border-secondary mb-3 tiles" style="border-left: 7px solid #455a64;">
                  <i class="fa fa-3x fa-check-square-o" style="float: right;padding-top: 15px;color: #455a64;"></i>
                  <div class="card-header" style="color: #03a9f4;display:block;font-family: sans-serif;font-weight: 500;">
                    Open Tokens
                  </div>
                  <div class="card-body text-secondary">
                    <div class="count" style="font-family: sans-serif;font-weight: 500;" id="open_tokens">112814</div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          <a onClick="generatedivtable(3)">
            <div class="col-sm-3" id ="card_div">
              <div class="tiles-parent ">
                <div class="card border-secondary mb-3 tiles" style="border-left: 7px solid #ff9800;">
                  <i class="fa fa-3x fa-times-circle-o" style="float: right;padding-top: 16px;color: #ff9800;"></i>
                  <div class="card-header" style="color: #03a9f4;display:block;font-family:sans-serif;font-weight: 500;">
                    Closed Tokens (Last 30 Days)
                  </div>
                  <div class="card-body text-secondary">
                    <div class="count" style="font-family: sans-serif;font-weight: 500;" id="closed_tokens">112814</div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          <a onClick="generatedivtable(4)">
            <div class="col-sm-3" id ="card_div">
              <div class="tiles-parent">
                <div class="card border-secondary mb-3 tiles" style="border-left: 7px solid #039be5;">
                  <i class="fa fa-3x fa-cogs" style="float: right;padding-top: 16px;color: #039be5;"></i>
                  <div class="card-header" style="color: #03a9f4;display:block;font-family: sans-serif;font-weight: 500;">
                    Service Request (Last 30 Days)
                  </div>
                  <div class="card-body text-secondary">
                    <div class="count" style="font-family: sans-serif;font-weight: 500;" id="service_requests">112814</div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="mid_div">
        <div>
          <h3>All Token Listing</h3>
        </div>
        <div>
          <form name="form" id="form">
            <div class="inline-span">
              <select class="form-control space" id="status_search" name="status_search" onchange="updatePlaceholder()">
                <option value="Token">Token</option>
                <option value="Customer Name">Customer Name</option>
                <option value="Email">Email</option>
                <option value="Mobile">Mobile</option>
                <option value="Customer Type">Customer Type</option>
              </select>
            </div>
            <div class="inline-span">
              <input type="text" placeholder="Enter Token" class="form-control space" name="search" id="search_value">
              <div id="error_message" class="error-message"></div>
            </div>
            <div class="inline-span">
              <button type="button" class="btn space" id="search" onclick="SearchByCat()">Search</button>
              <button type="button" class="btn space" id="clear" onclick="ClearCat()">Clear</button>
              <button type="button" class="btn space" id="closer">Bulk Closure</button>
            </div>
          </form>
        </div>
      </div>

      <div class="page_data">
        <div style="overflow-x:auto; ">
          <div>
            <div class="loader" id="loader">
              <div class="lds-ripple">
                <div></div>
                <div></div>
              </div>
            </div>
          </div>
          <table id="example" style="width:auto;" border="1" cellpadding="2" class="table table-striped table-bordered dataTable table-hover">
            <thead id="table_head" style="display: none;">
              <tr>
                <th>Sr.No.</th>
                <th>Token</th>
                <th>Token Request Id</th>
                <th>Service Request ID</th>
                <th>Lead ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Alternate Mobile</th>
                <th>Agreement Number</th>
                <th>Customer Type</th>
                <th>Case Status</th>
                <th>Created Date</th>
                <th>User Id</th>
                <th>User Name</th>
                <th>Assigned To</th>
                <th>Assigned Date</th>
                <th>Remarks</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody id="table_data"></tbody>
          </table>
        </div>
        <!-- Add pagination controls -->
        <div class="paginationdiv" id="paginationdiv" style="display: none;">
          <div class="page_navigation_text" id="page_navigation_text">
          </div>
          <div class="page_navigation">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item" id="first_button">
                  <a class="page-link" href="javascript:void(0)" onclick="first_page()">First</a>
                </li>
                <li class="page-item" id="prev_button">
                  <a class="page-link" href="javascript:void(0)" onclick="prev_page()">Previous</a>
                </li>
                <li class="page-items active" id="first_link"><a class="page-link-m" href="javascript:void(0)" onclick="page_show(this.innerHTML)">1</a></li>
                <li class="page-items"><a class="page-link-m" href="javascript:void(0)" onclick="page_show(this.innerHTML)">2</a></li>
                <li class="page-items"><a class="page-link-m" href="javascript:void(0)" onclick="page_show(this.innerHTML)">3</a></li>
                <li class="page-items"><a class="page-link-m" href="javascript:void(0)" onclick="page_show(this.innerHTML)">4</a></li>
                <li class="page-items"><a class="page-link-m" href="javascript:void(0)" onclick="page_show(this.innerHTML)">5</a></li>
                <li class="page-item" id="next_button">
                  <a class="page-link" href="javascript:void(0)" onclick="next_page()">Next</a>
                </li>
                <li class="page-item" id="last_button">
                  <a class="page-link" href="javascript:void(0)" onclick="last_page()">Last</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

  </div>
</div>