<html>
<head>

</head>
<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$CI->load->helper('report');

checkCustomerType('internal employee');
//$dealer_code=$CI->session->getProfileData("login");
$userProfile = $CI->session->getSessionData('userProfile');
$dealer_code = $userProfile['dealer_codes'];
//$dealer_code = 7033;
?>
<body>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
			  <div class="row">
				<div class='col-sm-12 form-inline'>
					  <div class="form-group">
						<label>Date Range</label>
						<div class='select-group' id='date-range'>

						  <select name="yearval" id="yearval" class="wide">
							  <?php
							  $count = 1;
							  $datadisplay = '';
							  for($i=date("Y")+1;$i >= 2000;$i--){
								//	if($count ==1)
											//$datadisplay = 'data-display="Select"';
								//	else
											//$datadisplay = '';
									echo ' <option  value="'.($i-1).'-'.$i.'">'.($i-1).'-'.$i.'</option>';
									$count++;
								}
								?>
							  
							</select>
						  
						</div>
					  </div>

				  <div class="form-group">
					<label>Month</label>
					<div class='input-group date' id='month'>

					  <select name="monthval" id="monthval" class="wide">
						  <?php
						  for($i=1;$i<=12;$i++){
								echo ' <option '.$datadisplay.' value="'.date("M",mktime(0,0,0,$i,1,date("Y"))).'">'.date("M",mktime(0,0,0,$i,1,date("Y"))).'</option>';
						  }
						  ?>
						</select>
					 
					</div>
				  </div>
				</div>
			  </div>

			</div>
  
<table id="idetails" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Business Count</th>
				<th>Comm Amount</th>
				<th>Disbursed Amount</th>
				<th>Mode NEFT <br />CHQ No</th>
				<th>NET Pay</th>
				<th>Paid DT</th>
				<th>Payment Status</th>
				<th>TDS Amount</th>
				<th>TDS PREC</th>
				<th>Year</th>
				
            </tr>
        </thead>
        
    </table>
<script type="text/javascript">
		//  $('select').niceSelect();

		</script>

<!-- End of Date -->
<!--
 var url = "/cc/DealerCustom/reloadSalesRestData?method="+methodName+"&start_date="+static_date+"&end_date="+statice_date+"&dealer_code=7014";
				ddtable.ajax.url(url).load();
				
-->


		<script type="text/javascript">
//var table = $('#example').DataTable();
			$("#loader").removeClass("hidden");
var ddtable;
ddtable = $('#idetails').DataTable( {
	 
	 "scrollX": true,
	  dom: 'Bfrtip',
		buttons: [
			{
				extend: 'pdfHtml5',
				orientation: 'landscape',
				pageSize: 'LEGAL'
				
			}
		],
//		 "responsive":true,
		"ajax": {
				"url": "/cc/DealerCustom/getIncentiveSummarySoapData",
				"dataSrc": "",
				"method": 'post',
				"data": {
						method: 'GetDealerSalesIncentiveSummaryDetails',
						date_range: $("#yearval").val(),
						month_sel: $("#monthval").val(),
						dealer_code:'<?php echo $dealer_code;?>'
				},
				/*"success": function(result){
								$("#loader").addClass("hidden");
				}*/
			},
		
	"columns": [
		{
				"data": "Business_Count",
				"defaultContent": "<i>Not set</i>"
		},
		{
				"data": "COMM_AMOUNT",
				"defaultContent": "<i>Not set</i>"
		},
		{ 
				"data": "DISBURSED_AMOUNT",
				"defaultContent": "<i>Not set</i>"
		},
		{
					"data": "MODE_NEFT_CHQ_NO",
					"defaultContent": "<i>Not set</i>"
		},
	    {
					"data": "NET_PAY",
					"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "PAID_DT" ,
			"defaultContent": "<i>Not set</i>"
		},
		{ "data": "PAYMENT_STATUS" },
		{ "data": "TDS_AMOUNT" },
		{ "data": "TDS_PREC" },
		{ "data": "YEAR" }
		],
		"bDestroy": true
	} );
setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
function updateTableData(method,date_range,month_sel,dealer_code){

			$("#loader").removeClass("hidden");
			 var url = "/cc/DealerCustom/reloadIncentiveSoapData?method="+method+"&date_range="+date_range+"&month_sel="+month_sel+"&dealer_code="+dealer_code;
			ddtable.ajax.url(url).load();
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
}
/*
function updateTableData(){
	
   $.ajax({
            url: "/cc/DealerCustom/getIncentiveSummarySoapData",
            type: "post",
            data:  {
						method: 'GetDealerSalesIncentiveSummaryDetails',
						date_range: $("#date-range select").val(),
						month_sel: $("#month select").val(),
						dealer_code:1831 
						}
        }).done(function (result) {
            ddtable.clear().draw();
            ddtable.rows.add(result).draw();
            }).fail(function (jqXHR, textStatus, errorThrown) { 
                  // needs to implement if it fails
            });
}
*/
$( "#monthval" ).change(function() {
		//alert( "Handler for .change() called." );
		var	method = 'GetDealerSalesIncentiveSummaryDetails';
		var date_range = $("#date-range select").val();
		var month_sel = $("#month select").val();
		var dealer_code = '<?php echo $dealer_code;?>' ;
		updateTableData(method,date_range,month_sel,dealer_code);
});

$( "#yearval" ).change(function() {
		/*
		$.getJSON(url, null, function (json) {
		dt.fnClearTable();
		dt.fnAddData(json.aaData);
		dt.fnDraw();
	});
*/
	var	method = 'GetDealerSalesIncentiveSummaryDetails';
	var date_range = $("#date-range select").val();
	var month_sel = $("#month select").val();
	var dealer_code = '<?php echo $dealer_code;?>' ;

	updateTableData(method,date_range,month_sel,dealer_code);

				
});
//updateTableData();
 </script>
</body>
</html>