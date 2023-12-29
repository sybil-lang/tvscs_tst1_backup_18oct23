<!-- tst1 -->
<html>

  <head>

    <style type="text/css">
      .mandate {
        color: black;
      }

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
    </style>
  </head>

  <body>
    <?php
    // $report_id = \RightNow\Utils\Url::getParameter('r_id');
    $CI = & get_instance();
    $CI->load->helper('report');
    checkCustomerType('internal employee');
    //$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_AgreementNo_EmployeeBasis);
    //$report_id=$msg->Value;
    //$agreement = \RightNow\Utils\Url::getParameter('ag_id');
    $userProfile = $CI->session->getSessionData('userProfile');
    $agreement = $userProfile['agg_no'];
    ?>
    <!--<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>-->


    <div class="row">
      <div class="col-md-8 not-applicable">

      </div>

    </div>
    <div class="card card1" style="display: none;">
      <div class="card-body">

        <h4 class="card-title" style="padding: 10px;background-color:#e2e2ff; ">Download</h4>
        <div id="filledbtn"></div>
        <p class="card-text text1" style="display: none;">Please wait Loading Content..............</p>
        <p class="card-text text12" style="display: none;"></p>


      </div>
    </div>
    <br>
    <div class="card card2" style="display: none;">
      <div class="card-body">
        <h4 class="card-title" style="padding: 10px;background-color:#e2e2ff; ">NDC(No Due Certificate)</h4>
        <p class="card-text text2">Please wait Loading Content..............</p>
        <div id="dwnbtn"></div>
      </div>
    </div>
    <div class="mandate" id="getMandateStatuses">

    </div>



    <p>&nbsp;</p>
    <div id="showresult"></div>
    <script type="text/javascript">
    /*$.post( "/cc/EmployeeCustom/rest_api_report", { id_of_report : '<?php echo $report_id; ?>' , filtering_val : 'initialloan', method_val : 'initialloanamount'})
        .done( function ( data ) {
          $( "#initialloanamount" ).html( data );
        } );
* /


      jQuery.ajax( {
        type: 'POST',
        data: {
          'c_agreement': '<?php echo $agreement; ?>'
        },
        url: '/cc/EmployeeCustom/getloantype',
        beforeSend: function () {


        },
        success: function ( response ) {
          //alert(response);
          console.log( response );

          if ( response == "True" ) {
            // https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=TN3007CD0001548&report=NOC_FOR_CDPORTFOLIO.pdf
            $.ajax( '/cc/EmployeeCustom/rest_api_report_employeeportal_customer_mandate', {
              data: {
                method_val: 'getMandateStatuses',
                ag_no: '<?php echo $agreement; ?>',
                // filtering_val:''
              },
              type: "POST",
              beforeSend: function () {
                //alert("before send");
                $( "#loader" ).removeClass( "hidden" );
              },
              success: function ( data ) {
                $( "#loader" ).addClass( "hidden" );
                $( "#getMandateStatuses" ).html( data );
              }
            } );
          } else {

            document.getElementById( 'getMandateStatuses' ).innerHTML = "No Record Found"
            // alert('Agreement no is not TYPE:CD . Please select CD type Agreement No.')
          }


        }
      } );
    </script>

  </body>

</html>