<!-- tst -->
<html>
<head>
  
  <style type="text/css">
    .mandate{
      color:black;
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
      height: 141px;
  }
  </style>
</head>
<body>
<?php
// $report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
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
      <!-- <div class="card card2" style="display: none;">
        <div class="card-body">
          <h4 class="card-title" style="padding: 10px;background-color:#e2e2ff; ">NDC(No Due Certificate)</h4>
            <p class="card-text text2">Please wait Loading Content..............</p>
            <div id="dwnbtn"></div>
        </div>
      </div> -->
      <div class="card card3">
      <div class="card-body">
        <h4 class="card-title" id="noc-ndc-heading" style="padding: 10px;background-color:#e2e2ff; font-size: 17px !important; ">NOC/NDC</h4>
        <h4 class="card-title" id="no-record-heading" style="padding: 10px;background-color:#e2e2ff;display: none;text-align:center">No Records Found</h4>
        <a href="javascript:void(0);" id="download-button"><img src='/euf/assets/images/pdficon.png' width='100' height='110' style="height:40px; width:40px;"></a>
      </div>
    </div>


    <!-- Changes starts for prefilled on employee portal -->
  <div class="card card4" style="display:none;" id="prefilled">
    <div class="card-body">
      <h4 class="card-title" id="noc-ndc-heading" style="padding: 10px;background-color:#e2e2ff; font-size: 17px !important;">Prefilled Mandate</h4>
      <h4 class="card-title" id="no-record-heading" style="padding: 10px;background-color:#e2e2ff;display: none;text-align:center">No Records Found</h4>
      <a href="javascript:void(0);" id="downloadprefilled-button"><img src='/euf/assets/images/pdficon.png' width='100' height='110' style="height:40px; width:40px;"></a>
    </div>
  </div>
  <!-- Changes ends for prefilled on employee portal -->

<div class="mandate" id="getMandateStatuses">

</div>

  

<p>&nbsp;</p>
<div id="showresult"></div>
<script type="text/javascript">
    let source = document.querySelector('#download-button');
    var a = "<?php echo "$agreement" ?>";
    console.log("a is ", a);
    source.addEventListener('click', async function() {
      console.log("yes i am clicked");

      var response_check = await pdf_generation_check(a);

      if (response_check == "no data found") {
        // console.log("data2");
        $("#download-button").hide();
        $("#para").hide();
        $("#noc-ndc-heading").hide();
        $("#no-record-heading").show();
        // alert("NDC is not existing");
      } else {
        pdf_generation(a);
      }

    });

// Changes starts for prefilled on employee portal 
if (a != undefined && a != '0') {
      $.post("/cc/AjaxCustom/prefilled_mandate", {
          agg_no: a
        })
        .done(function(data) {
          if (data != 'no data found') {
            console.log('data'.data);
            var bin = atob(data);
            console.log('File Size:', Math.round(bin.length / 1024), 'KB');
            if (Math.round(bin.length / 1024)) {
              console.log('prefilled availble');
              document.getElementById('prefilled').style.display = "block";
              //document.getElementById('prefilled').style.display = "block";
            }
          } else {
            console.log('api down');
            document.getElementById('prefilled').style.display = "none";
          }

        });


    }



    $('a#downloadprefilled-button').click(function(e) {
      console.log('inside pdf download');

      var agg_no = "<?php echo "$agreement" ?>";

      $.post("/cc/AjaxCustom/prefilled_mandate", {
          agg_no: agg_no
        })
        .done(function(data) {

          console.log(data);
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
              link.download = 'PrefilledMandate.pdf';
              console.log('link.download' + link.download);
              link.href = 'data:application/octet-stream;base64,' + data;
              // document.body.appendChild(link);
              link.click();
            } else {
              alert("No File Found")
            }
          }
        });
    });


    //  Changes starts for prefilled on employee portal 



    async function pdf_generation_check(id) {
      var res;
      await $.post("/cc/AjaxCustom/employee_noc", {
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
    function pdf_generation(id) {
      $.post("/cc/AjaxCustom/employee_noc", {
          agg_no: id
        })

        .done(function(data) {

          console.log("inside pdf_generation");
          console.log(data);
          // console.log("data1");
          if (data == "no data found") {
            // console.log("data2");
            alert("NDC is not existing")
            // console.log("data3");
          } else {
            // console.log($test);

            var bin = atob(data);
            // console.log('File Size:', Math.round(bin.length / 1024), 'KB');
            if (Math.round(bin.length / 1024)) {
              console.log('PDF Version:', bin.match(/^.PDF-([0-9.]+)/)[1]);


              // Embed the PDF into the HTML page and show it to the user
              //
              var obj = document.createElement('object');
              obj.style.width = '100%';
              obj.style.height = '842pt';
              obj.type = 'application/pdf';
              obj.data = 'data:application/pdf;base64,' + data;
              // document.body.appendChild(obj);

              // Insert a link that allows the user to download the PDF file
              var link = document.createElement('a');
              link.innerHTML = 'Download PDF file';
              link.download = 'NDC Form.pdf';
              link.href = 'data:application/octet-stream;base64,' + data;
              // document.body.appendChild(link);
              link.click();
            } else {
              alert("No File Found")
            }
          }


        });
    }
		/*$.post( "/cc/EmployeeCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'initialloan', method_val : 'initialloanamount'})
						 .done(function( data ) {
					 $( "#initialloanamount" ).html(data);
			 });
*/


                    //  jQuery.ajax({
                    //                   type: 'POST',
                    //                   data: {
                    //                     'c_agreement': '<?php echo $agreement;?>'                    
                    //                   },
                    //                   url: '/cc/EmployeeCustom/getloantype',
                    //                   beforeSend: function () {
                                      
                                           
                    //                   },
                    //                   success: function (response) {
                    //                     //alert(response);
                    //                   console.log(response);

                    //                   if(response=="True")
                    //                   {
                    //                     // https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=TN3007CD0001548&report=NOC_FOR_CDPORTFOLIO.pdf
                    //                     $.ajax('/cc/EmployeeCustom/rest_api_report_employeeportal_customer_mandate', 
          					// 										{ 
            				// 												data: {
            				// 												method_val : 'getMandateStatuses',  
            				// 												ag_no : '<?php echo $agreement;?>',
                    //                         // filtering_val:''
            				// 											   },
                		// 													type: "POST",
                		// 													beforeSend: function() {
                		// 														//alert("before send");
                		// 														$("#loader").removeClass("hidden"); 
                		// 													},
                		// 													success: function( data ) {
                		// 															$("#loader").addClass("hidden"); 
                		// 															$( "#getMandateStatuses" ).html(data);
                		// 													}
          					// 									    });
                    //                     }
                    //                     else
                    //                     {

                    //                               document.getElementById('getMandateStatuses').innerHTML="No Record Found"
                    //                                 // alert('Agreement no is not TYPE:CD . Please select CD type Agreement No.')
                    //                     }
                                       
                                        
                    //                   }
                    //           });
                               

                            

</script>

</body>
</html>