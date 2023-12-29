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
    border: 12px solid #f3f3f3;
    border-radius: 50%;
    border-top: 12px solid #3498db;
    width: 60px;
    height: 60px;
    -webkit-animation: spin 2s linear infinite;
    /* Safari */
    animation: spin 2s linear infinite;
    margin-left: auto;
    margin-right: auto;

  }
/* 
  #search_value {
    width: 500px;
  } */

  #search {
    background-Color: #03a9f4;
    color: white;
  }

  #clear {
    background-Color: #e84e40;
    color: white;
  }

  #search:hover {
    background-Color: #00bfff;
    color: white;
  }

  #clear:hover {
    background-Color: #ff0000;
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





      <script>
        $(document).ready(function() {


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





          ///JS Counter for Status count 









          var employeecode = <?php echo $employeeCode ?>;
          $.post("/cc/AjaxCustom/GetTokenListApiForTmsDashboard", {
            employeecode: employeecode
          }).done(function(data) {
            var somedata = data;
            console.log(data);
            try {

              var main_data = JSON.parse(somedata);

              // console.log(main_data);

              // console.log('main_data : '+main_data[0]);
              // console.log('ReturnOutput : '+ReturnOutput[0]);
              // console.log('token 1: '+main_data['ReturnOutput'][0]['Token']);
              // console.log('token 2: '+main_data['ReturnOutput'][1]['Token']);
              var html = "";
              $('#loader').addClass("hide-loader");
              $('#table_head').fadeIn()
              for (i = 0; i < main_data['ReturnOutput'].length; i++) {
                // console.log('test'+main_data['ReturnOutput'][i]['Token']);
                // tokens = main_data['ReturnOutput'][i]['Token'];
                // console.log(tokens);
                // var temp = i;
                // console.log(temp);
                // console.log(main_data['ReturnOutput'][temp]);

                html += "<tr><td>" + i + "</td><td>" + main_data['ReturnOutput'][i]['Token'] + "</td><td>" + main_data['ReturnOutput'][i]['TokenRequestId'] + "</td><td>" + main_data['ReturnOutput'][i]['ServiceRequestId'] + "</td><td>" + main_data['ReturnOutput'][i]['LeadId'] + "</td><td>" + main_data['ReturnOutput'][i]['CustomerName'] + "</td><td>" + main_data['ReturnOutput'][i]['EMail'] + "</td><td>" + main_data['ReturnOutput'][i]['Mobile'] + "</td><td>" + main_data['ReturnOutput'][i]['AlternateMobile'] + "</td><td>" + main_data['ReturnOutput'][i]['AgreementNumber'] + "</td><td>" + main_data['ReturnOutput'][i]['CustomerType'] + "</td><td>" + main_data['ReturnOutput'][i]['CaseStatus'] + "</td><td>" + main_data['ReturnOutput'][i]['CreatedDate'] + "</td><td>" + main_data['ReturnOutput'][i]['UserId'] + "</td><td>" + main_data['ReturnOutput'][i]['UserName'] + "</td><td>" + main_data['ReturnOutput'][i]['AssignedTo'] + "</td><td>" + main_data['ReturnOutput'][i]['AssignedDate'] + "</td><td>" + main_data['ReturnOutput'][i]['Action'] + "</td></tr>";
              }

              $("#table_data").html(html);

            } catch (err) {
              console.log(err.message);
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

        // function getMinToDate() {
        //   document.getElementById("myDate").min = "11-01-2023";
        // }


        // $('.from_date').datepicker({
        //   maxDate: 0,
        //   changeMonth: true,
        //   changeYear: true,
        //   dateFormat: 'dd-M-yy',
        //   onSelect: function(selected) {
        //     var endDate, dateSplit;
        //     dateSplit = selected.split("-");
        //     endDate = new Date(dateSplit[1] + " " + dateSplit[0] + ", " + dateSplit[2]);
        //     $(".to_date").datepicker("option", "minDate", endDate);
        //     console.log('dp');
        //     //searchBankDeposition();
        //   }
        // });


        // $('.to_date').datepicker({

        //   maxDate: 0,
        //   changeMonth: true,
        //   changeYear: true,
        //   dateFormat: 'dd-M-yy'
        //   //            onSelect: function (selected) {
        //   //                searchBankDeposition();
        //   //            }

        // });
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
      </script>
    </head>

    <body>

      <div class="rn_Container">
        <h1>Walkin Reports</h1>
        <!-- <div style="border:1px solid #E6E9ED; padding: 8px 20px 15px 20px; "> -->
        <div class="row">
          <div class="col-sm-3">
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
          <div class="col-sm-3">
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
          <div class="col-sm-3">
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
          <div class="col-sm-3">
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
        </div>
      </div>





      <form name="form" id="form">

        <h3>All Token Listing</h3>
        <div class="col" style="display:flex; padding-left: 665px;">




          <select class="form-control space" id="status_search" name="status_search" onchange="updatePlaceholder()">
            <option value="Token">Token</option>
            <option value="Customer Name">Customer Name</option>
            <option value="Email">Email</option>
            <option value="Mobile">Mobile</option>
            <option value="Customer Type">Customer Type</option>
          </select>
          <input type="text" placeholder="Enter Token" class="form-control space" name="search" size="40" >
          <!-- <input type="text" placeholder="Enter Token" class="form-control space" name="search" size="40" id="search_value"> -->
          <button type="button" class="btn space" id="search">Search</button>
          <button type="button" class="btn space" id="clear">Clear</button>
        </div>


      </form>
      <div style="overflow-x:auto; ">
        <div>
          <div class="loader" id="loader">
            <div></div>
            <div></div>
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
              <th>Action</th>

            </tr>

          </thead>
          <tbody id="table_data"></tbody>
        </table>
        </div>
  </div>
</div>


<div class="clearfix"></div>
</div>
<div class="text-center">
  <div class="seccessMsg form-inline" style="display: none;">
    <div class="alert alert-success ">

    </div>
  </div>

</div>

<div class="form-group">
  <div class="loding-div-inner">
    <div class="lds-ripple">
      <div></div>
      <div></div>
    </div>
  </div>

</div>
</div>
</div>
</div>
</div>
</div>

</html>
</div>