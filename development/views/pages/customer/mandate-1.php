<!-- LIVE -->
<?php
 $CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('customer');
?>
<html>
<head><style type="text/css">
    #isload
        {
        height: 80px;
        position: absolute;
        top: 101px;
        right: 599px;
        display:none;
        }
    </style></head>
<body>
     <img id="isload" src="/euf/assets/themes/standard/images/loading-large.gif">
     <?php
     $msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
	 $report_id=$msg->Value;

?>
<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>

<form action='#' method='post' class="loan-form">
  <fieldset>
  	<div id="statusofloan_ndc"></div>
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
	/*.no-due{
		background-color:#003c7d !important;
		color:#ffffff; 
	}*/
	/*.live-cust{
		background-color:#1da4d8 !important;
		color:#ffffff; 
	}
	.req-cust{
		background-color:#f8c100 !important;
		color:#ffffff;
	}
	.no-due:hover{
		background-color:#ffffff !important;
		color:#003c7d; 
		border: 1px #003c7d solid;
		border-radius: 4px;
	}
	.live-cust:hover{
		background-color:#ffffff !important;
		color:#1da4d8; 
		border: 1px #1da4d8 solid;
		border-radius: 4px;
	}
	.req-cust:hover{
		background-color:#ffffff !important;
		color:#f8c100;
		border: 1px #f8c100 solid;
		border-radius: 4px;
	}*/
	.bold-text{
		font-weight: 600;
	}
	.rn_agreementSelect {
    	display: inline-block;
	}
	.btn:click{
		color:white;
	}
	/*.no-due:active {
	    color: #fff;
	}*/

</style>
<div class="col-sm-12 col-md-12 col-lg-12" id="contemt-main">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<br><br>
			<div class="row">
				            <div class="col-md-8 not-applicable">
				                <!-- <rn:widget path="custom/input/agreementSelect/" name="Incident.CustomFields.CO.Loan.ID" required="true" label_input="Agreement Number"/> -->
				                <!-- <button id="fetch" class="btn">Fetch</button> -->
				            </div>
				    		
			</div>
			<div class="card card1" style="display: none;">
			  <div class="card-body">
			  	
			    <h4 class="card-title" style="padding: 10px;background-color:#e2e2ff; ">Download</h4>
			    <div id="filledbtn"></div>
			    <p class="card-text text1" style="display: none;">Please wait Loading Content..............</p>
			    <p class="card-text text12" style="display: none;"></p>
				    <!-- <input type="hidden" id="agmt" name="agmt_no"> -->
				    <!-- <a href="#" class="btn no-due bold-text" id="no-due" style="display: none;" target="_blank" download>NDC</a> -->
				    
					
						
					<!-- <a href="/euf/assets/files/filled_mandate.pdf" class="btn req-cust bold-text"  style="display: none;" download>FIlled Mandate</a>		     -->
				
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
		</div>
	</div>


	<div id="showresult_mandate" style='display:none'>
<div class="row">
	<div class="col-md-3" id="mandate">
			<a href="javascript:void(0);"  id="url_for_mandate"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a><p>Mandate</p>
		</div>
	<script type="text/javascript">
		// var agreementNo = "";
		$.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'mandateStatus', method_val : 'getMandateStatus'})
													 .done(function( data ) {
													 	console.log(data)
												 $( "#statusofloan_ndc" ).html(data);
										 });

										 $('#i_detail').change(function(){

	var ag_no = $(this).val();
	console.log('ag is'.ag_no);

// $.post("/cc/AjaxCustom/mandate", {
// 	ag_no: ag_no
//                             })
//                             .done(function(data) {
//                                 if (data != 'no data found') {
// 									console.log('data'.data);
//                                     var bin = atob(data);
//                                     console.log('File Size:', Math.round(bin.length / 1024), 'KB');
//                                     if (Math.round(bin.length / 1024)) {
//                                         document.getElementById('showresult_mandate').style.display = "block";
//                                     }
//                                 }
// 								else {
//                         document.getElementById('showresult_mandate').style.display = "none";
//                     }

//                             });
						});


		// 								 $.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'mandateStatus', method_val : 'getMandateStatus'})
		// 											 .done(function( data ) {
		// 											 	console.log(data)
		// 										 $( "#statusofloan_ndc" ).html(data);
		// 								 });
		// // $('#i_detail').change(function(){
		// 	var select_one = $(this).val();
		// 	alert(select_one);
		// 	if(select_one.trim() != "--Select--"){
		// 		$('.card1').hide();
		// 		$('.card2').hide();
		// 	}
		// });
		// $('#fetch').click(function(e){
		// 	e.preventDefault();
		// 	agreementNo = $('Select[id="rn_agreementSelect_27_Incident.CustomFields.CO.Loan.ID"]').find(":selected").html().trim();
		// 	if(agreementNo=="" || agreementNo==undefined || agreementNo == null || agreementNo == "--Please Select --"){
		// 		alert("Please select an agreement.");
		// 	}
		// 	else{

		// 		$('.card').show();
		// 		$.ajax({
  //                               url: "/cc/AjaxCustom/getMandateStatus",
  //                               type: "post",
  //                               data:{agmt_no:agreementNo},
  //                               success: function(response) {
  //                					$('.card-text').hide();
  //                                   var json_response = JSON.parse(response);
		// 					        console.log(json_response[0].Agment_NO);
		// 					        console.log(json_response[0].Blank_mandate);

		// 					        if(json_response[0].Blank_mandate == "Y"){
		// 					        	$('.no-due').show();
		// 					        }
		// 					        else{
		// 					        	$('.no-due').hide();
		// 					        }

		// 					        if(json_response[0].Fill_mandate == "Y"){
		// 					        	$('.live-cust').show();
		// 					        }
		// 					        else{
		// 					        	$('.live-cust').hide();

		// 					        }
		// 					        if(json_response[0].Noc_mandate == "Y" ){
		// 					        	$('.req-cust').show();
		// 				        	}
		// 				        	else{
		// 				        		$('.req-cust').hide();
		// 				        	}
                                                                    
  //                               },
  //                               error:function(response){
  //                               	$('.card-text').html("An error occured. Please contact admin.").show();
  //                                   console.error(response);
  //                               }
  //                      });
		// 			}
		// 	});

		$('#no-due').click(function(e){
			 e.preventDefault();
			if(agreementNo !="" || agreementNo != null){
				$.ajax({
								url: window.location,
                                type: "post",
                                data:{agmt_no:agreementNo},
                                success: function(response) {
                                	// alert("sent");
                                },
                                error: function(error){
                                	console.error(error);
                                }
				});
			}
			else{
				alert("Agreement Number not selected.");
			}
			
		});

		// $('#i_detail').trigger('change');
		// $('#i_detail').change(function(){

		// 	var ag_no = $(this).val();
		// 	console.log(ag_no);
		
		// $.post("/cc/AjaxCustom/mandate", {
		// 	ag_no: ag_no
        //                             })
        //                             .done(function(data) {
        //                                 if (data != 'no data found') {
		// 									console.log('data'.data);
        //                                     var bin = atob(data);
        //                                     console.log('File Size:', Math.round(bin.length / 1024), 'KB');
        //                                     if (Math.round(bin.length / 1024)) {
        //                                         document.getElementById('showresult_mandate').style.display = "block";
        //                                     }
        //                                 }
		// 								else {
        //                         document.getElementById('showresult_mandate').style.display = "none";
        //                     }

        //                             });

		// 						});


                            
	</script>
</div>

  </fieldset>
</form>
<p>&nbsp;</p>

</body>
</html>



<!-- <p>&nbsp;</p> -->

