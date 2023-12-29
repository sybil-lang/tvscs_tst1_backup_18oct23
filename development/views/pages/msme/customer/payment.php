<?php
 $CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('customer');
?>
<html>
<head>
	<script type="text/javascript">
		var scounter = 24;
		var ecounter = 25;
		var dealerProduct = "";
		var agreement = "";
	</script>
	<script type="text/javascript" src="/euf/assets/themes/standard/js/date_validation.js"></script>
	
<style type="text/css">
	#iload_pay
        {
        height: 80px;
        position: absolute;
        top: 40%;
        right: 50%;
        display:none;
        }
.rn_Body{
min-height: 563px;
}

.nice-select.wide{
	width:30%;
}
.rn_AccountOverview table td {
   
     text-overflow: unset; 
   
}
 #newjendat1,#newjendat2,#newjendat3
    {
    	display: none;
    }
    .bootstrap-datetimepicker-widget.dropdown-menu.usetwentyfour.bottom{
    	background-color: #777777 !important;
    	color:white !important;
    }
    .bootstrap-datetimepicker-widget table td.day{
    	color:black !important;
    }
@media screen and (max-device-width: 480px) and (orientation: portrait){
div.dataTables_scrollBody > table{
	padding-bottom: 0px !important;
}
div.dataTables_wrapper div.dataTables_filter input{
	width: 80% !important;
    background-position: center right;
    padding: 0 0 !important;
    border-radius: 20px !important;
    margin-left: 0px !important;
}
.z-tabs > .z-container > .z-content > .z-content-inner{
	height: 500px;
}
select{
	margin-left: 35px;
}
 input[type=radio] 
 {
	border: 0px !important;
	width: 5% !important;
	height: 2em !important;
}

}
.container_select
{
	display: flex;
}
.container_select 
.col
{
	width: 30%;
}
.container_select .ine{font-size: x-large;}
.container_select .inee 
{
	    width: 5%;
height: 1em;
}
div.dataTables_scrollBody > table > tbody > tr:first-child > th, div.dataTables_scrollBody > table > tbody > tr:first-child > td{
	text-align:left !important;
}
@media only screen and (max-width: 800px) {
		input[type=radio] 
		{
		    border: 0px !important;
	    width: 15% !important;
	    height: 0.8em !important;
		}
		.not_visible_in_mobile
		{
		display: none;
		}
		.container_select
		{
			display: block;
		}
		.ine
		{
			margin-left: 25px;
		}
		.size_div
		{
			overflow-y: auto;
		}
}
</style>

</head>
<body>
	<img id="iload_pay" src="/euf/assets/themes/standard/images/loading-large.gif">
<?php
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_NO_MSME);
$report_id=$msg->Value;
$contact_id=$CI->session->getProfileData("c_id");
//print_r($CI->session->getProfile());
$userProfile =$CI->session->getSessionData("userProfile");
$countTL=0;
$countOD=0;
$countBD=0;

$contact_id=$CI->session->getProfileData("c_id");



?>

<h4 class="not_visible_in_mobile" style="margin-top:15px;text-transform:none !important;">Last Payment Details</h4>
<div  id='heading' ></div>

<script>document.getElementById('heading').innerHTML='<div align="center" style="font-size:18px !important;margin-top:15px;text-transform:none !important;color:#108a43;">Please Select an option</div>';</script>
<div class="size_div">
	<div class="container_select" >
					<div id="TL-hidden_div_pay" class="col hidden">
					<div class="ine mar-b20px"><input class="inee" type="radio" name="radio" id="TL_id"><label>TL</label></div>

					<form name="newjendat" id="newjendat1">
					<select name="strLoginAgmnt11" class="col-md-3" id="strLoginAgmnt11">
								<option value="">Please Select</option>
						

						
						</select>
					</form>
					</div>

				
					<div id="OD-hidden_div_pay" class="col hidden">
						<script>document.getElementById('heading').innerHTML='<div align="center" style="font-size:18px !important;margin-top:15px;text-transform:none !important;color:#108a43;">Please Select an option</div>';</script>
						<!-- <h4 align="left" style="margin-top:15px;">Please Select Agreement Number</h4> -->
						<div class="ine mar-b20px"><input class="inee" type="radio" name="radio" id="OD_id"><label>OD</label></div>

						<form name="newjendat" id="newjendat2">
						<select name="strLoginAgmnt12" class="col-md-3" id="strLoginAgmnt12" >
									<option value="">Please Select</option>

							</select>
						</form>
					</div>
					
				
					<div id="BD-hidden_div_pay" class="col hidden">
						<script>document.getElementById('heading').innerHTML='<div align="center" style="font-size:18px !important;margin-top:15px;text-transform:none !important;color:#108a43;">Please Select an option</div>';</script>
						<!-- <h4 align="left" style="margin-top:15px;">Please Select Prospect Number</h4> -->
						<div class="ine mar-b20px"><input class="inee" type="radio" name="radio" id="BD_id"><label>BD</label></div>

						<form name="newjendat" id="newjendat3">

						<select name="strLoginAgmnt13" class="col-md-3" id="strLoginAgmnt13">
									<option value="">Please Select</option>
							<!--  -->
							

							
							</select>
						</form>
					</div>
	
	</div>
	<br>
	<div class="row hidden" id="daterow">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
			  <div class="row">
				<div class='col-sm-12 form-inline datetimepickerwrapper'>
				  <div class="form-group">
					<label>From</label>
					<div class='input-group date' id='datetimepicker24'>

					  <input type='text' id="datetimepicker24_input" value="<?php echo date("d/m/Y",mktime(0,0,0,date("m")-1,date("d"),date("Y")));?>" class="form-control"  data-provide="datepicker"  />
					  <span class="input-group-addon click_6">
									<span class="glyphicon glyphicon-calendar"></span>
					  </span>
					</div>
				  </div>

				  <div class="form-group">
					<label>To</label>
					<div class='input-group date' id='datetimepicker25'>

					  <input type='text' class="form-control" id="datetimepicker25_input" value="<?php echo date("d/m/Y");?>" />
					  <span class="input-group-addon click_7">
									<span class="glyphicon glyphicon-calendar"></span>
					  </span>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
		<br>
<table id="msme_payment_details"  class="table display table-bordered nowrap hidden" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <!-- <th>Agreement Number</th> -->
                <!-- <th>Prospect Number</th> -->
                <!-- <th>Product Type</th> -->
                <!-- <th>Product Code</th> -->
                <th>Instant Status</th>
                <th>Payment Mode</th>
				<th>Payment Purpose</th>
				<th>Instrument Description</th>				
					<!-- <th>Voucher Type </th> -->
				<th>Total Amount</th>
				<th>Detailed Amount </th>
				<th>User ID</th>
				<th>Transaction Type</th>
				<th>Due Date</th>
				<th>Reversal Flag</th>
				<!-- <th>Portfolio Code</th> -->
				<th>Payment Applied Date </th>

				

				

            </tr>
        </thead>
       
    </table>
</div>

<!-- ---------------------------------------------------- -->
<script type="text/javascript">
	function myfunc(){
		document.getElementById('iload_pay').style.display = 'block';	
	}
	function myCompleteFunc(){
		document.getElementById('iload_pay').style.display = 'none';
	}
			var countTL=0;
			var countOD=0;
			var countBD=0;
			var agreement_array3 =[];
			var agreement_array2 =[];
			var agreement_array1 =[];

			$.ajaxSetup({
			   beforeSend: myfunc,
			   complete: myCompleteFunc
			});

	 	       $.post( "/cc/AjaxCustom/initialloanamount_accordin", {contact_id : '<?php echo $contact_id;?>',flag :'true' })
                .done(function( data ) 
                {
                   	var main_data=JSON.parse(data);
                     if(main_data.length > 0)
					{
	                     for(var i=0;i<main_data.length;i++)
	                         {
                         
                              if(main_data[i]["agrrementNumberList"]){
                                for(var j=0;j<main_data[i].productDetailsList.length;j++)
                                   {
                                      for(var k=0;k<main_data[i].productDetailsList[j].agreementDetailList.length;k++)
                                      {
                                       
                                        if(main_data[i].productDetailsList[j].agreementDetailList[k].productCode=='TL')
                                        {
                                           countTL++;
                                           agreement_array1.push(main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber);
                                        }
                                        if(main_data[i].productDetailsList[j].agreementDetailList[k].productCode=='OD')
                                        {
                                            countOD++;
                                           agreement_array2.push(main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber);

                                        }
                                        if(main_data[i].productDetailsList[j].agreementDetailList[k].productCode=='BD')
                                        {
                                            countBD++;
                                           agreement_array3.push(main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber);


                                            // agreement_array3 
                                        }
                                      }
                                   }
                         }
                     }

                     // console.log('array',agreement_array1,agreement_array2,agreement_array3)


                     if(countTL)
                     {
                     	$('#TL-hidden_div_pay').removeClass('hidden');

                                 for(var u=0;u<agreement_array1.length;u++)
                                 {
							    	document.getElementById('strLoginAgmnt11').innerHTML+='<option value="'+agreement_array1[u]+'" >'+agreement_array1[u]+'</option>'
						      	 }

                     }
                      if(countOD)
                     {
                     	$('#OD-hidden_div_pay').removeClass('hidden');
                     	 for( u=0;u<agreement_array2.length;u++)
                                 {
							    	document.getElementById('strLoginAgmnt12').innerHTML+='<option value="'+agreement_array2[u]+'" >'+agreement_array2[u]+'</option>'
						      	 }
            
                     }
                      if(countBD)
                     {
                     	$('#BD-hidden_div_pay').removeClass('hidden');
                     	 for( u=0;u<agreement_array3.length;u++)
                                 {
							    	document.getElementById('strLoginAgmnt13').innerHTML+='<option value="'+agreement_array3[u]+'" >'+agreement_array3[u]+'</option>'
						      	 }
                     	
                     }

                     // console.log(countTL,countOD,countBD)
    
                     	
                        }
                           });

$(document).ready(function() {
	 
$('#TL_id').change(function()
{
	document.getElementById('newjendat1').style.display="block";
	document.getElementById('newjendat2').style.display="none";
	document.getElementById('newjendat3').style.display="none";
});  
$('#OD_id').change(function()
{
	document.getElementById('newjendat2').style.display="block";
	document.getElementById('newjendat1').style.display="none";
	document.getElementById('newjendat3').style.display="none";
});
$('#BD_id').change(function()
{
	document.getElementById('newjendat3').style.display="block";
	document.getElementById('newjendat1').style.display="none";
	document.getElementById('newjendat2').style.display="none";
});

$('#strLoginAgmnt11').change(function()
{
checking_payment(document.getElementById('strLoginAgmnt11').value);
});

$('#strLoginAgmnt12').change(function()
{
checking_payment(document.getElementById('strLoginAgmnt12').value);
});

$('#strLoginAgmnt13').change(function()
{
checking_payment(document.getElementById('strLoginAgmnt13').value);
});

function checking_payment (value){

			agreement = value;
			//alert("good");
			 $('#msme_payment_details').removeClass('hidden');
			 $('#daterow').removeClass('hidden');
		msme_payment_details = $('#msme_payment_details').DataTable( {
						 "scrollX": true,
						  "processing": true,
						  dom: 'Bfrtip',
						   buttons: [
							{
								extend: 'excelHtml5',
								title: 'Payment Details'
							},
							{
								extend: 'pdfHtml5',
								title: 'Payment Details',
								orientation: 'landscape',
								pageSize: 'LEGAL'
							},
							{
								extend: 'csvHtml5',
								title: 'Payment Details'
							}
						],
						 // /"responsive":true,
						"ajax": {
									"url": '/cc/AjaxCustom/payment_msme',
									"dataSrc": "",
									"method": "post",
									"data": {
           									 agreement_no: value,
           									 start_date: $("#datetimepicker24_input").val(),
								              end_date: $("#datetimepicker25_input").val(),
									  }

									//"data": $('#mgmdata').serializeArray()
								},
						"columns": [
								// { "data": "agreementNumber" },
								// { "data": "prospectNumber" },
								// { "data": "productCode" },
								// { "data": "productCode" },
								{ "data": "instantStatus" },
								{ "data": "paymentMode" },
								{"data":"paymentPurpose"},
								{"data":"instrumentDescription"},
								// {"data":"voucherType"},
								{"data":"totalAmount"},
								{"data":"detailedAmount"},
								{"data":"userID"},
								{"data":"transactionType"},
								{"data":"dueDate"},
								{"data":"reversalFlag"},
								// {"data":"portfolioCode"},
								{"data":"paymentAppledDate"}


							],
							
							"destroy": true,
						} );
				}


	});

</script>
 
</body>
</html>