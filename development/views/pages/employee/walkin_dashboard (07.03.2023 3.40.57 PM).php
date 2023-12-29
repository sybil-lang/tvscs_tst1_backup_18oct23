<rn:meta title="Walkin Dashboard" template="employee_header.php" clickstream="employee_walkin_dashboard" login_required="true" force_https="true" />
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

  .btn:focus {
    outline: none;
  }

  .paginationdiv {
    display: flex;
    align-items: center;
    justify-content: space-between;

  }

  #download {
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

  #search {
    border: none;
    background-color: #ff9800;
    color: white;
    outline: none;
  }

  #download:hover {
    background-color: #00bfff;
    color: white;
  }

  #clear:hover {
    background-color: #ff0000;
    color: white;
  }

  #search:hover {
    background-color: #ffad33;
    color: white;
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


  .error-message {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 2px;
    white-space: nowrap;
    color: red;
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

  input[type="date"]:before {
    color: lightgray;
    content: attr(placeholder);
  }

  input[type="date"].full:before {
    color: black;
    content: "" !important;
  }
</style>
<div>
  <div class="rn_Container">
    <h1>Walkin Dashboard</h1>
  </div>
</div>

<div class="rn_AskQuestion rn_Container">
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.0/jquery.timepicker.min.css" integrity="sha512-WlaNl0+Upj44uL9cq9cgIWSobsjEOD1H7GK1Ny1gmwl43sO0QAUxVpvX2x+5iQz/C60J3+bM7V07aC/CNWt/Yw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.0/jquery.timepicker.min.js" integrity="sha512-s0SB4i9ezk9SRyV1Glrj/w5xS5ExSxXiN44fQeV9GYOtExbVWnC+mUsUyZdIYv6qXL0xe1qvpe0h1kk56gsgaA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- Add bootstrap pagination CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Add bootstrap pagination JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- date picker libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
    <!--  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- cookies -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.1/js.cookie.min.js"></script>





    <script>
      $(document).ready(function() {
        console.log("Dashboard page");
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

        //calling generate table function
        generatetable();

        //function for changing the functions of pagination buttons when clicked on the search form button
        $('#search').click(function() {
          $('#a_next_button').attr('onclick', 'next_page_search()');
          $('#a_prev_button').attr('onclick', 'prev_page_search()');
          $('#a_first_button').attr('onclick', 'first_page_search()');
          $('#a_last_button').attr('onclick', 'last_page_search()');
          $('#a_page_show').attr('onclick', 'page_show_search(this.innerHTML)');
        });

        // Get references to the input fields
        const branchInput = $('#branch_search');
        const ecodeInput = $('#ecode_search');
        const unameInput = $('#uname_search');
        const pcodeInput = $('#pcode_search');
        const agreementInput = $('#agreement_search');

        //Branch Cookies array
        const branches = getCookiesArray('branch');
        const ecodes = getCookiesArray('ecode');
        const unames = getCookiesArray('uname');
        const pcodes = getCookiesArray('pcode');
        const agreements = getCookiesArray('agreement');

        // Set up autocomplete for each input field
        branchInput.autocomplete({
          source: function(request, response) {
            const branches = getCookiesArray('branch');
            const uniqueBranches = [...new Set(branches)]; // Filter out duplicates
            const matchingBranches = uniqueBranches.filter(branch => branch.includes(request.term));
            response(matchingBranches);
          }
        });
        ecodeInput.autocomplete({
          source: function(request, response) {
            const ecodes = getCookiesArray('ecode');
            const uniqueecodes = [...new Set(ecodes)]; // Filter out duplicates
            const matchingecodes = uniqueecodes.filter(ecode => ecode.includes(request.term));
            response(matchingecodes);
          }
        });
        unameInput.autocomplete({
          source: function(request, response) {
            const unames = getCookiesArray('uname');
            const uniqueunames = [...new Set(unames)]; // Filter out duplicates
            const matchingunames = uniqueunames.filter(uname => uname.includes(request.term));
            response(matchingunames);
          }
        });
        pcodeInput.autocomplete({
          source: function(request, response) {
            const pcodes = getCookiesArray('pcode');
            const uniquepcodes = [...new Set(pcodes)]; // Filter out duplicates
            const matchingpcodes = uniquepcodes.filter(pcode => pcode.includes(request.term));
            response(matchingpcodes);
          }
        });
        agreementInput.autocomplete({
          source: function(request, response) {
            const agreements = getCookiesArray('agreement');
            const uniqueagreements = [...new Set(agreements)]; // Filter out duplicates
            const matchingagreements = uniqueagreements.filter(agreement => agreement.includes(request.term));
            response(matchingagreements);
          }
        });


        var pickerFrom = new Pikaday({
          field: document.getElementById('from_date'),
          format: 'DD-MMM-YYYY',
          onSelect: function(date) {
            // When a date is selected in the "from_date" picker, update the "to_date" picker's minimum date
            pickerTo.setMinDate(date);
          }
        });

        var pickerTo = new Pikaday({
          field: document.getElementById('to_date'),
          format: 'DD-MMM-YYYY',
          onSelect: function(date) {
            // When a date is selected in the "to_date" picker, update the "from_date" picker's maximum date
            pickerFrom.setMaxDate(date);
          }
        });

        // Set the minimum date for the "to_date" picker based on the value of the "from_date" input field
        var from_date = moment($('#from_date').val(), 'DD-MMM-YYYY').toDate();
        pickerTo.setMinDate(from_date);

        // Set the maximum date for the "from_date" picker based on the value of the "to_date" input field
        var to_date = moment($('#to_date').val(), 'DD-MMM-YYYY').toDate();
        pickerFrom.setMaxDate(to_date);

      });


      // Define a function to get the list of values from cookies
      function getCookiesArray(cookieName) {
        const cookieValue = Cookies.get(cookieName);
        if (cookieValue) {
          return cookieValue.split(',');
        } else {
          return [];
        }
      }

      function downloadCSV() {

        const table = document.getElementById('example');
        const downloadButton = document.getElementById('download');
        // alert("length is", table.rows.length)

        if (table.rows.length === 1) {
          // alert("sorry no data to show")
          downloadButton.disabled = true;
        }

        if (table.rows.length > 1) {
          // alert("i am here guys :)")
          // const table = document.getElementById('example');
          downloadButton.disabled = false;
          const rows = table.querySelectorAll('tr');
          const csvContent = [];
          for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].querySelectorAll('td, th');
            const rowData = [];
            for (let j = 0; j < cells.length; j++) {
              rowData.push(cells[j].textContent);
            }
            csvContent.push(rowData.join(','));
          }
          const csvString = csvContent.join('\n');
          const blob = new Blob([csvString], {
            type: 'text/csv;charset=utf-8;'
          });
          const downloadLink = document.createElement('a');
          const url = URL.createObjectURL(blob);
          downloadLink.href = url;
          downloadLink.download = 'Walkin_dashboard.csv';
          document.body.appendChild(downloadLink);
          downloadLink.click();
          document.body.removeChild(downloadLink);
        }
      }

      var page_number_search = 1;
      var total_page_search;
      var last_page_flag_search = false;
      var total_page;
      var page_number = 1;
      var last_page_flag = false;

      //funtion for dasboard page table
      function generatetable() {
        console.log("inside table funtion");
        $('#loader').removeClass("hide-loader");
        var employeecode = <?php echo $employeeCode ?>;
        $.post("/cc/AjaxCustom/GetTokenListApiForTmsDashboard", {
          employeecode: employeecode,
          page_number: page_number
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

              var AlternateMobile = main_data['ReturnOutput'][i]['AlternateMobile'];
              var AlternateMobileDisplay = AlternateMobile ? AlternateMobile : "--";

              var EMail = main_data['ReturnOutput'][i]['EMail'];
              var EMailDisplay = EMail ? EMail : "--";

              var Remarks = main_data['ReturnOutput'][i]['Remarks'];
              var RemarksDisplay = Remarks ? Remarks : "--";

              var EmpName = main_data['ReturnOutput'][i]['EmpName'];
              var EmpNameDisplay = EmpName ? EmpName : "--";

              var EmpCode = main_data['ReturnOutput'][i]['EmpCode'];
              var EmpCodeDisplay = EmpCode ? EmpCode : "--";

              var CreatedDate = main_data['ReturnOutput'][i]['CreatedDate'];
              var CreatedDateDisplay = CreatedDate ? CreatedDate : "--";

              j++;

              html += "<tr><td>" + j + "</td><td>" + main_data['ReturnOutput'][i]['Token'] + "</td><td>" + main_data['ReturnOutput'][i]['CustomerName'] + "</td><td>" + main_data['ReturnOutput'][i]['Mobile'] + "</td><td>" + AlternateMobileDisplay + "</td><td>" + main_data['ReturnOutput'][i]['AgreementNumber'] + "</td><td>" + main_data['ReturnOutput'][i]['TokenRequestId'] + "</td><td>" + CreatedDateDisplay + "</td><td>" + EMailDisplay + "</td><td>" + main_data['ReturnOutput'][i]['UserId'] + "</td><td>" + main_data['ReturnOutput'][i]['UserName'] + "</td><td style='background-color:";

              if (main_data['ReturnOutput'][i]['CaseStatus'] === 'CLOSED') {
                html += "#e84e40; color: white; text-align: center;'>" + main_data['ReturnOutput'][i]['CaseStatus'] + "</td>";
              } else if (main_data['ReturnOutput'][i]['CaseStatus'] === 'OPEN') {
                html += "#73c273; color: white; text-align: center;'>" + main_data['ReturnOutput'][i]['CaseStatus'] + "</td>";
              } else {
                html += "#f0ad4e; color: white; text-align: center;'>" + "New Service Request" + "</td>";
              }
              html += "</td><td>" + EmpCodeDisplay + "</td><td>" + EmpNameDisplay + "</td><td>" + main_data['ReturnOutput'][i]['ProductCode'] + "</td><td>" + main_data['ReturnOutput'][i]['Purpose_of_visit'] + "</td><td>" + main_data['ReturnOutput'][i]['BranchCode'] + "</td><td>" + main_data['ReturnOutput'][i]['BranchName'] + "</td><td>" + RemarksDisplay + "</td></tr>";
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

      // function for search button functionality 
      function SearchingByCat() {
        const downloadButton = document.getElementById('download');
        downloadButton.disabled = false;
        console.log("clicked on search");
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var branch_code = $('#branch_search').val();
        var ecode_code = $("#ecode_search").val();
        var uname_code = $("#uname_search").val();
        var status_code = $("#status_search").val();
        var product_code = $("#pcode_search").val();
        var agreement_code = $("#agreement_search").val();

        if (!from_date && !to_date && !branch_code && !ecode_code && !uname_code && !status_code && !product_code && !agreement_code) {
          return;
        }
        console.log(from_date);
        console.log(to_date);

        let cookieNames = ['branch', 'ecode', 'uname', 'pcode', 'agreement'];
        let cookieValues = [branch_code, ecode_code, uname_code, product_code, agreement_code];

        let cookies = [];

        for (let i = 0; i < cookieNames.length; i++) {
          if (cookieValues[i]) {
            let cookieArray = getCookiesArray(cookieNames[i]);
            cookieArray.push(cookieValues[i]);
            let d = new Date();
            d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000))
            let expires = "expires=" + d.toUTCString();
            cookies.push(`${cookieNames[i]}=${cookieArray.join(',')}; ${expires};path='/'`);
          }
        }

        // Set the cookies using the input field values
        for (let i = 0; i < cookies.length; i++) {
          document.cookie = cookies[i];
        }

        $('#loader').removeClass("hide-loader");

        $.ajax({
          url: '/cc/AjaxCustom/GetSerachForDashboard',
          data: {
            from_date: from_date,
            to_date: to_date,
            branch_code: branch_code,
            ecode_code: ecode_code,
            uname_code: uname_code,
            status_code: status_code,
            product_code: product_code,
            agreement_code: agreement_code,
            page_number_search: page_number_search,
          },
          success: function(response) {
            console.log(response);
            var responsedata = response;
            var response_data = JSON.parse(responsedata); // Your data array
            console.log(response_data)

            var htmlresponse = "";
            $('#loader').addClass("hide-loader");
            $('#table_head').fadeIn()

            if (response_data["ReturnMessage"] == "No Data Found.") {
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
              var recordsperpage = 20; //total records we wanna display per page
              const totalrecords = response_data['TotalRecords']; //total number of records coming from the API response
              console.log("totalrecords", totalrecords);
              totalpage = Math.ceil(totalrecords / recordsperpage); //total page logic
              console.log("totalpage", totalpage);
              const records_search = response_data['ReturnOutput'].length;
              var startindex = (page_number_search - 1) * recordsperpage; //start index
              console.log("startindex", startindex);
              var endindex = startindex + (recordsperpage - 1); //end index
              console.log("endindex", endindex);
              var loopvalue = 20;
              if (last_page_flag_search == true) {
                page_number_search = totalpage;
                endindex = totalrecords - 1;
                startindex = (page_number_search - 1) * recordsperpage;
                loopvalue = endindex - startindex + 1;
                console.log(page_number_search);
                var pageLinks = document.getElementsByClassName("page-link-m");
                for (var i = 0; i < pageLinks.length; i++) {
                  pageLinks[i].innerHTML = (page_number_search - 4) + i;
                  pageLinks[i].parentElement.classList.remove("active");
                  if (pageLinks[i].innerHTML == totalpage) {
                    pageLinks[i].parentElement.classList.add("active");
                  }
                }
              }
              var j = startindex;
              for (var i = 0; i < loopvalue; i++) {
                var AlternateMobile = response_data['ReturnOutput'][i]['AlternateMobile'];
                var AlternateMobileDisplay = AlternateMobile ? AlternateMobile : "--";

                var EMail = response_data['ReturnOutput'][i]['EMail'];
                var EMailDisplay = EMail ? EMail : "--";

                var AgreementNumber = response_data['ReturnOutput'][i]['AgreementNumber'];
                var AgreementNumberDisplay = AgreementNumber ? AgreementNumber : "--";

                var TokenRequestId = response_data['ReturnOutput'][i]['TokenRequestId'];
                var TokenRequestIdDisplay = TokenRequestId ? TokenRequestId : "--";

                var Remarks = response_data['ReturnOutput'][i]['Remarks'];
                var RemarksDisplay = Remarks ? Remarks : "--";

                var EmpName = response_data['ReturnOutput'][i]['EmpName'];
                var EmpNameDisplay = EmpName ? EmpName : "--";

                var EmpCode = response_data['ReturnOutput'][i]['EmpCode'];
                var EmpCodeDisplay = EmpCode ? EmpCode : "--";

                var CreatedDate = response_data['ReturnOutput'][i]['CreatedDate'];
                var CreatedDateDisplay = CreatedDate ? CreatedDate : "--";

                j++;

                htmlresponse += "<tr><td>" + j + "</td><td>" + response_data['ReturnOutput'][i]['Token'] + "</td><td>" + response_data['ReturnOutput'][i]['CustomerName'] + "</td><td>" + response_data['ReturnOutput'][i]['Mobile'] + "</td><td>" + AlternateMobileDisplay + "</td><td>" + AgreementNumberDisplay + "</td><td>" + TokenRequestIdDisplay + "</td><td>" + CreatedDateDisplay + "</td><td>" + EMailDisplay + "</td><td>" + response_data['ReturnOutput'][i]['UserId'] + "</td><td>" + response_data['ReturnOutput'][i]['UserName'] + "</td><td style='background-color:";

                if (response_data['ReturnOutput'][i]['CaseStatus'] === 'CLOSED') {
                  htmlresponse += "#e84e40; color: white; text-align: center;'>" + response_data['ReturnOutput'][i]['CaseStatus'] + "</td>";
                } else if (response_data['ReturnOutput'][i]['CaseStatus'] === 'OPEN') {
                  htmlresponse += "#73c273; color: white; text-align: center;'>" + response_data['ReturnOutput'][i]['CaseStatus'] + "</td>";
                } else {
                  htmlresponse += "#f0ad4e; color: white; text-align: center;'>" + "New Service Request" + "</td>";
                }
                htmlresponse += "</td><td>" + EmpCodeDisplay + "</td><td>" + EmpNameDisplay + "</td><td>" + response_data['ReturnOutput'][i]['ProductCode'] + "</td><td>" + response_data['ReturnOutput'][i]['Purpose_of_visit'] + "</td><td>" + response_data['ReturnOutput'][i]['BranchCode'] + "</td><td>" + response_data['ReturnOutput'][i]['BranchName'] + "</td><td>" + RemarksDisplay + "</td></tr>";
              }
              $("#table_data").html(htmlresponse);
              document.getElementById("page_navigation_text").innerHTML = `Showing ${startindex+1} to ${endindex+1} of ${totalrecords} entries`;
              var pageItems_m = document.getElementsByClassName("page-items");
              for (var i = 0; i < pageItems_m.length; i++) {
                pageItems_m[i].style.display = "unset";
              }
              const firstButton = document.getElementById("first_button");
              const prevButton = document.getElementById("prev_button");
              if (startindex === 0) {
                firstButton.classList.add("disabled");
                prevButton.classList.add("disabled");
                var pageLinks = document.getElementsByClassName("page-link-m");
                for (var i = 0; i < pageLinks.length; i++) {
                  pageLinks[i].parentElement.classList.remove("active");
                  if (pageLinks[i].innerHTML == 1) {
                    pageLinks[i].parentElement.classList.add("active");
                  }
                }
              } else {
                firstButton.classList.remove("disabled");
                prevButton.classList.remove("disabled");
              }
              const lastButton = document.getElementById("last_button");
              const nextButton = document.getElementById("next_button");
              if (endindex + 1 === totalrecords) {
                lastButton.classList.add("disabled");
                nextButton.classList.add("disabled");
              } else {
                lastButton.classList.remove("disabled");
                nextButton.classList.remove("disabled");
              }

            }
          },
          type: 'POST'
        });

      }

      // function for clear button functionality 
      function ClearCat() {
        console.log("clicked on clear");
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var branch_code = $('#branch_search').val();
        var ecode_code = $("#ecode_search").val();
        var uname_code = $("#uname_search").val();
        var status_code = $("#status_search").val();
        var product_code = $("#pcode_search").val();
        var agreement_code = $("#agreement_search").val();

        if (!from_date && !to_date && !branch_code && !ecode_code && !uname_code && !status_code && !product_code && !agreement_code) {
          return;
        }
        $('#loader').removeClass("hide-loader");
        location.reload();
      }


      // function getMinToDate() {
      //   document.getElementById("myDate").min = "11-01-2023";
      // }

      function next_page() {
        last_page_flag = false;
        var nextButton = document.getElementById("next_button");
        if (nextButton.classList.contains("disabled")) {
          return;
        }
        page_number++;
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
        var prevButton = document.getElementById("prev_button");
        if (prevButton.classList.contains("disabled")) {
          return;
        }
        page_number--;
        console.log("prev_page_number", page_number);
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

      function next_page_search() {
        var nextButton = document.getElementById("next_button");
        if (nextButton.classList.contains("disabled")) {
          return;
        }
        page_number_search++;
        console.log("next_page_number", page_number_search);
        SearchingByCat();
        var pageLinks = document.getElementsByClassName("page-link-m");
        for (var i = 0; i < pageLinks.length; i++) {
          var pageNum = parseInt(pageLinks[i].innerHTML);
          pageLinks[i].innerHTML = pageNum + 1;
        }
      }

      function last_page_search() {
        var lastButton = document.getElementById("last_button");
        if (lastButton.classList.contains("disabled")) {
          return;
        }
        last_page_flag_search = true;
        SearchingByCat();
      }

      function first_page_search() {
        var firstButton = document.getElementById("first_button");
        if (firstButton.classList.contains("disabled")) {
          return;
        }
        page_number_search = 1;
        console.log(page_number_search);
        SearchingByCat();
        var pageLinks = document.getElementsByClassName("page-link-m");
        for (var i = 0; i < pageLinks.length; i++) {
          pageLinks[i].innerHTML = i + 1;
          pageLinks[i].parentElement.classList.remove("active");
          if (pageLinks[i].innerHTML == 1) {
            pageLinks[i].parentElement.classList.add("active");
          }
        }
      }

      function prev_page_search() {
        var prevButton = document.getElementById("prev_button");
        if (prevButton.classList.contains("disabled")) {
          return;
        }
        page_number_search--;
        console.log("prev_page_number", page_number_search);
        SearchingByCat();
        var pageLinks = document.getElementsByClassName("page-link-m");
        for (var i = 0; i < pageLinks.length; i++) {
          var pageNum = parseInt(pageLinks[i].innerHTML);
          pageLinks[i].innerHTML = pageNum - 1;
        }
      }

      function page_show_search(value) {
        console.log("page_show_search");
        var firstlink = document.getElementById("first_link");
        if (firstlink.classList.contains("disabled")) {
          return;
        }
        console.log("Value: " + value);
        page_number_search = value;
        console.log(page_number_search);
        SearchingByCat();
        // Add active class to current page
        var pageLinks = document.getElementsByClassName("page-link-m");
        for (var i = 0; i < pageLinks.length; i++) {
          pageLinks[i].parentElement.classList.remove("active");
          if (pageLinks[i].innerHTML == page_number_search) {
            pageLinks[i].parentElement.classList.add("active");
          }
        }
      }
    </script>
  </head>

  <body>

    <div style="border:1px solid #E6E9ED; padding: 8px 20px 15px 20px; ">

      <h2>Token Generation Report</h2>

      <form name="form" id="form">

        <div class="col" style="display:flex;">
          <input type="text" id="from_date" name="from_date" value="" placeholder="From Date" data-date-format="DD-MM-YYYY" size="16" class="form-control space">
          <input type="text" id="to_date" name="to_date" value="" placeholder="To Date" data-date-format="DD-MM-YYYY" size="16" class="form-control space">
          <input type="search" class="form-control space" id="branch_search" name="branch_search" value="" placeholder="Branch Code" autocomplete="on">
          <input type="search" class="form-control space" id="ecode_search" name="ecode_search" value="" placeholder="Employee Code" autocomplete="on">
          <input type="search" id="uname_search" name="uname_search" class="form-control space" value="" placeholder="User Id" autocomplete="on">
          <input type="search" id="pcode_search" name="pcode_search" class="form-control space" value="" placeholder="Product Code" autocomplete="on">
          <input type="search" id="agreement_search" name="agreement_search" class="form-control space" value="" placeholder="Agreement Number" autocomplete="on">
          <select class="form-control space" id="status_search" name="status_search">
            <option value="">Select Status</option>
            <option value="OPEN">OPEN</option>
            <option value="CLOSED">CLOSED</option>
            <option value="CAC">New Service Request</option>
          </select>
          <button type="button" class="btn" id="search" onclick="SearchingByCat()">Search</button>

        </div>

        <div id="error_message" class="error-message"></div>

        <div class="col" id="buttondiv">
          <button type="button" class="btn" id="clear" onclick="ClearCat()">Clear</button>
          <button type="button" class="btn" id="download" onclick="downloadCSV()">Download</button>
        </div>


      </form>
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
          <thead>
            <tr>
              <th>Sr.No.</th>
              <th>Token Id</th>
              <th>Customer Name</th>
              <th>Mobile</th>
              <th>Alternate Mobile</th>
              <th>Agreement Number</th>
              <th>Token Request ID</th>
              <th>Token Date and Time</th>
              <th>Email ID</th>
              <th>User ID</th>
              <th>User Name</th>
              <th>Status</th>
              <th>Employee Code</th>
              <th>Employee name</th>
              <th>Product Code</th>
              <th>Purpose of Visit</th>
              <th>Branch Code</th>
              <th>Branch Name</th>
              <th>Remark</th>
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
                <a class="page-link" id="a_first_button" href="javascript:void(0)" onclick="first_page()">First</a>
              </li>
              <li class="page-item" id="prev_button">
                <a class="page-link" id="a_prev_button" href="javascript:void(0)" onclick="prev_page()">Previous</a>
              </li>
              <li class="page-items active" id="first_link"><a class="page-link-m" href="javascript:void(0)" onclick="page_show(this.innerHTML)">1</a></li>
              <li class="page-items"><a class="page-link-m" id="a_page_show" href="javascript:void(0)" onclick="page_show(this.innerHTML)">2</a></li>
              <li class="page-items"><a class="page-link-m" id="a_page_show" href="javascript:void(0)" onclick="page_show(this.innerHTML)">3</a></li>
              <li class="page-items"><a class="page-link-m" id="a_page_show" href="javascript:void(0)" onclick="page_show(this.innerHTML)">4</a></li>
              <li class="page-items"><a class="page-link-m" id="a_page_show" href="javascript:void(0)" onclick="page_show(this.innerHTML)">5</a></li>
              <li class="page-item" id="next_button">
                <a class="page-link" id="a_next_button" href="javascript:void(0)" onclick="next_page()">Next</a>
              </li>
              <li class="page-item" id="last_button">
                <a class="page-link" id="a_last_button" href="javascript:void(0)" onclick="last_page()">Last</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>


    <div class="clearfix"></div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>

</html>
</div>