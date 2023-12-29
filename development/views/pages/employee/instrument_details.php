<html>
<head></head>
<body>
<?php
 //$report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('internal employee');
//$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_AgreementNo_EmployeeBasis);
//$report_id=$msg->Value;
$userProfile = $CI->session->getSessionData('userProfile');
$agreement = $userProfile['agg_no'];
$contact_id=$CI->session->getProfileData("c_id");
	$contact =  \RightNow\Connect\v1_3\Contact::fetch($contact_id);
    $cccc=$contact->Name->First.' '.$contact->Name->Last ;
$employeeCode=$contact->CustomFields->c->employee_code;
?>
<!--<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>-->

<form action='#' method='post' class="loan-form">
  <fieldset>
    <div id="instrumentdetails"></div>

  </fieldset>
  
</form>
<p>&nbsp;</p>
<div id="instrumentdetails_docs" style='display:none'>
	<div class="row">
		<div class="col-md-4">
			  <a href="javascript:void(0);" target="_blank" id="url_ins"><img src='https://tvscs.custhelp.com/euf/assets/images/clipboard-icon.png' height="100" width="100"></a><p>Insurance Policy Renewal</p>
		</div>
		<div class="col-md-4">
			  <a href="javascript:void(0);" target="_blank" id="url_for"><img src='https://tvscs.custhelp.com/euf/assets/images/documents-flat.png' height="100" width="100"></a><p>Foreclosure Letter</p>
		</div>
		<div class="col-md-4">
			  <a href="javascript:void(0);" id="url_for_soa"><img src="https://tvscs.custhelp.com/euf/assets/images/clipboard_icon-1.png" height="100" width="100"></a><p>SOA</p>
		</div>
	</div>
</div> 
<div id="showresult_instrument" style='display:none'>
<div class="row"> 
	<div class="col-md-3">
		<a href="javascript:void(0);" target="_blank" id="url_for_n"><img src='https://tvscs.custhelp.com/euf/assets/images/documents-flat.png' height="100" width="100"></a><p>Foreclosure Letter</p>
	</div>
	<div class="col-md-3">
		<a href="javascript:void(0);"  id="url_for_n_soa"><img src='https://tvscs.custhelp.com/euf/assets/images/clipboard_icon-1.png' height="100" width="100"></a><p style="padding-left: 35px; padding-top: 10px;">SOA</p>
	</div>
	<div class="col-md-3" id="insss">
			  <a href="javascript:void(0);" target="_blank" id="url_inss"><img src='/euf/assets/themes/standard/images/clipboard-icon.png' height="100" width="100"></a><p>Insurance Policy Renewal</p>
		</div>
</div>
</div>
<script type="text/javascript">
	localStorage.setItem("prof", "");
	var isSoaOk = true;
/*				$.post( "/cc/EmployeeCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'instrumentdetails', method_val : 'getInsuranceDetails'})
													 .done(function( data ) {
												 $( "#instrumentdetails" ).html(data);
										 });
*/	
$.post("/cc/AjaxCustom/check_soa_permission",{ag_no : '<?php echo $agreement;?>'}).done(function(data){
					            	var resp = JSON.parse(data);
					            	// console.log(resp);
					            	// console.log(resp.ReturnOutput[0].SOA_DOWNLOAD);
					            	if(resp.ReturnMessage == "SOADownloadValidation"){
					            		if(resp.ReturnOutput[0].SOA_DOWNLOAD == "N"){
					            			isSoaOk = false;
					            		}
					            		else{
					            			isSoaOk = true;
					            		}
					            	}
					            	//console.log("isok? :"+isSoaOk);
					            }).then(function(){
			$.ajax('/cc/AjaxCustom/rest_api_call_drop', 
			{ 
				data: {
				method_val : 'getInsuranceDetails',  
				ag_no : '<?php echo $agreement;?>'
			},
			type: "POST",
			beforeSend: function() {
				//alert("before send");
				$("#loader").removeClass("hidden"); 
			},
			success: function( data ) {
					$("#loader").addClass("hidden"); 
					//$('#instrumentdetails').html(data);
					var url_data = JSON.parse(data);
						var id ='<?php echo $agreement;?>';
					var id2 ='<?php echo $prospect;?>';

					 $.post( "/cc/AjaxCustom/RCIMAGE", {ag_no : id} )
																		 .done(function( data ) 
																		 {

																		 	if(data=="true")
																		 	{
																			 	$("#showresult_instrument").css("display", "block");
																				// $("#showresult_instrument").hide();																 
	                                                                        	var url='https://customeroperationapioci.tvscredit.com/GetData/RCImage_Download?ApplicationNo='+id2//id
																				$("#url_for_rc").attr("href", url);

																		 	}
																		 	else
																		 	{
                                                                              	$("#RCimage").hide();
                                                                              	// $("#instrumentdetails_docs").hide();
																		 	}


																		 });

																		 	 $.post( "/cc/AjaxCustom/InsuranceRenewalPolicy", {ag_no : '<?php echo $agreement;?>'} )
																		 .done(function( data ) 
																		 {

																		 	if(data=="true")
																		 	{
																			 	$("#showresult_instrument").css("display", "block");
																				// $("#showresult_instrument").hide();																 
	                                                                       var url='https://customeroperationapi.tvscredit.com/InsuranceRenewal/InsurancecopyRenewalDocuments?AgreementNo='+id//id
																				$("#url_inss").attr("href", url);

																		 	}
																		 	else
																		 	{
                                                                              	$("#insss").hide();

                                                                              	// $("#instrumentdetails_docs").hide();
																		 	}

					$('#loader22').css("display","none");

																		 });
					 // if(url_data.message == ''){
						// 	 //console.log(url_data.url_for);
						// 	// console.log(url_data.url_ins);
						// 	$("#instrumentdetails_docs").css("display", "block");
						// 	$("#showresult_instrument").hide();
						// 	$("#url_ins").attr("href", url_data.url_ins);
						// 	if(url_data.url_for == ""){
						// 		$("#url_for").parent().hide();
						// 	}
						// 	else{
						// 		$("#url_for").attr("href", url_data.url_for);
						// 	}
						// 	$("#url_for_soa").attr("href", url_data.soa_for);
					 // }else{
						 $("#showresult_instrument").css("display", "block");
						 $("#instrumentdetails_docs").hide();
						 //	$("#url_ins").attr("href", url_data.url_ins);
						 if(url_data.url_for == ""){
							 $("#url_for_n").parent().hide();
						 }
						 else{
							 $("#url_for_n").attr("href", url_data.url_for);
						 }
						 // $("#url_for_n_soa").attr("href", url_data.soa_for);
						 //	 $( "#showresult_instrument" ).html(url_data.message);	
					 // }
			}
		});
});

$('a#url_for_soa').click(function(e){
		     // stop its defaut behaviour
		     //console.log("url_for_soa?: ",isSoaOk);
		     if(isSoaOk == false){
		     	alert("Contact Customer Support for SOA");
		     	e.preventDefault();
		     }
		      
});
$('a#url_for_n_soa').click(function(e){
	
	      // var agg_no=$('#i_detail').val();
	      var agg_no ='<?php echo $agreement;?>';
	      var employeeCode ='<?php echo $employeeCode;?>';

	      $.post( "/cc/EmployeeCustom/soa_download_for_emp", { agg_no:agg_no,employeeCode:employeeCode})
	      .done( function( data ) 
	      {

	      	console.log(data);

	      	if(data=="no data found")
	      	{
            alert("No File Found")
	      	}
	      	else
	      	{



                var bin = atob(data);
				console.log('File Size:', Math.round(bin.length / 1024), 'KB');
				if(Math.round(bin.length / 1024))
				{
					console.log('PDF Version:', bin.match(/^.PDF-([0-9.]+)/)[1]);
				

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
				link.download = 'file.pdf';
				link.href = 'data:application/octet-stream;base64,' + data;
				// document.body.appendChild(link);
				link.click();
				}
				else
				{
					// $('a#url_for_n_soa').css.style("none");
					 // $('a#url_for_n_soa').css("display","none");
					alert("No File Found")
				}
			}
	      });
	    });
</script>

</body>
</html>