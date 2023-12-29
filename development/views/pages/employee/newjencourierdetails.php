<?php
 $CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');
?>
<html>
<head>
<style type="text/css">
.rn_Body{
min-height: 863px;
}
.z-tabs > .z-container > .z-content > .z-content-inner{
height:350px;
}

.nice-select.wide{
	width:30%;
}
</style>

</head>
<body>
<?php

$userProfile = $CI->session->getSessionData('userProfile');
$agreement = $userProfile['agg_no'];
?>
 

<form name="newjendata" id="newjendata">
<input type="hidden" name="strLoginAgrmnt1" id="strLoginAgrmnt1" value="<?php echo $agreement;?>">
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script type="text/javascript">
$(document).ready(function() {

					$('#newjendetails').DataTable( {
						 "scrollX": true,
						  "processing": true,
						  dom: 'Bfrtip',
						   buttons: [
							{
								extend: 'excelHtml5',
								title: 'Courier Details'
							},
							{
								extend: 'pdfHtml5',
								title: 'Courier Details',
								orientation: 'landscape',
								pageSize: 'LEGAL'
							},
							{
								extend: 'csvHtml5',
								title: 'Courier Details'
							}
						],
				//		 "responsive":true,
						"ajax": {
									"url": '/cc/AjaxCustom/getNewjencourierdetails',
									"dataSrc": function ( json ) {
										$("#loader").addClass("hidden"); 
										return json;
										},
									"type": "POST",
									"beforeSend": function() {
											$("#loader").removeClass("hidden");   
									},
									"beforeSend": function() {
									//alert("before send");
										$("#loader").removeClass("hidden"); 
									},
									"data": function ( d ) {
										d.form = $('#newjendata').serializeArray();
									  }
									//"data": $('#mgmdata').serializeArray()
								},
						"columns": [
								{ "data": "BRANCHNAME" },
								{ "data": "COMMENTS" },
								{ "data": "COURIERNAME" },
								{ "data": "DEALERNAME" },
								{ "data": "FROMPERSION" },
								{ "data": "HANDOVERCODE" },
								{"data":"LOCATION"},
								{"data":"NAME"},
								{ "data": "OUTWARDDATE" },
								{ "data": "OUTWARDFLAG" },
								{ "data": "PINCODE" },
								{ "data": "PODNUMBER" },
								{ "data": "RETURNACKCOMMENTS" },
								{ "data": "RETURNACKDATE" },
								{"data":"RETURNACKSTATUS"},
								{"data":"SNo"},
								{ "data": "SUBCATEGORY" },
								{"data":"TYPE"}
							],
							"destroy": true,
						} );
					var ag_no=$('#strLoginAgrmnt1').val();
		
        $.post('/cc/AjaxCustom/JSondata', {   ag_no : ag_no})
                                                     .success(function( data ) {
                                                     	$('#table_json').removeClass('hidden');

                                                     	// if(data)
                                                     
												     d = data.replace(/(\r\n|\n|\r)/gm, "");
												     dd=JSON.parse(d)
												     console.log(dd.Table.length)
												     for(var j=0;j<dd.Table.length;j++)
														{
												      var keys = Object.keys(dd.Table[j]);
												     var iterator = Object.values(dd.Table[j]);
                                                     var array= [[]];
												     for(var i=0;i<keys.length;i++)
														{
															k=keys[i];
															v=iterator[i];
														    array[j][k]=v;
														 }
														}
														 // console.log(array[0]);

												     
														    $('#table_json').DataTable( {
														    	"scrollX": true,
																	 "scrollY":true,
																	  "processing": true,
																	  dom: 'Bfrtip',
																	   buttons: [
																		{
																			extend: 'excelHtml5',
																			title: 'Courier Details'
																		},
																		{
																			extend: 'pdfHtml5',
																			title: 'Courier Details',
																			orientation: 'landscape',
																			pageSize: 'LEGAL'
																		},
																		{
																			extend: 'csvHtml5',
																			title: 'Courier Details'
																		}
																	],
														        data: array,
														        "columns": [
																	{ "data": "BRANCH NAME" },
																	{ "data": "COMMENTS" },
																	{ "data": "COURIER NAME" },
																	{ "data": "DEALER NAME" },
																	{ "data": "DOCUMENTKEYNUMBER" },
																	{ "data": "FROM PERSION" },
																	{ "data": "HANDOVER CODE" },
																	{"data":"LOCATION"},
																	{"data":"NAME"},
																	{ "data": "OUTWARD DATE" },
																	{ "data": "OUTWARD FLAG" },
																	{ "data": "PINCODE" },
																	{ "data": "POD NUMBER" },
																	{ "data": "RETURN ACK COMMENTS" },
																	{ "data": "RETURN ACK DATE" },
																	{"data":"RETURN ACK STATUS"},
																	{"data":"SNo"},
																	{ "data": "SUBCATEGORY" },
																	{"data":"TYPE"}
																],
																"destroy": true,
														    } );
														
												    

												     // document.getElementById('tr_head').innerHTML=""
												     // document.getElementById('tr_data').innerHTML=""
														// for(var i=0;i<keys.length;i++)
														// {
														  // document.getElementById('tr_head').innerHTML+= '<th>'+keys[i]+'</th>';
														// }
														// for(var i=0;i<keys.length;i++)
														// {
														  // document.getElementById('tr_data').innerHTML+= '<td>'+iterator[i]+'</td>';
														// }
														

												    
                                                     	
                                         });
				});
	//
 </script>
<table id="table_json" class="table display  table-bordered  nowrap hidden " cellspacing="0" style="width: 100%;" >
    	<thead>
            <tr>
                <th>Branch Name</th>
                <th>Comments</th>
                <th>Courier Name</th>
                <th>Dealer Name</th>
                  <th>DOCUMENT KEY NUMBER</th>
                <th>From Persion</th>
                <th>Handover Code</th>
				<th>Location</th>
				<th>Name</th>
				<th>Outward Date</th>
                <th>Outward Flag</th>
                <th>Pincode</th>
                <th>Pod Number</th>
                <th>Return ACK Comments</th>
                <th>Return ACK Date</th>
				<th>Return ACK Status</th>
				<th>SNo</th>
				<th>Subcategory</th>
				<th>Type</th>
            </tr>
        </thead>
    </table>
 <table id="newjendetails"  class="table display table-bordered  nowrap" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th>Branch Name</th>
                <th>Comments</th>
                <th>Courier Name</th>
                <th>Dealer Name</th>
                <th>From Persion</th>
                <th>Handover Code</th>
				<th>Location</th>
				<th>Name</th>
				<th>Outward Date</th>
                <th>Outward Flag</th>
                <th>Pincode</th>
                <th>Pod Number</th>
                <th>Return ACK Comments</th>
                <th>Return ACK Date</th>
				<th>Return ACK Status</th>
				<th>SNo</th>
				<th>Subcategory</th>
				<th>Type</th>
            </tr>
        </thead>
       
    </table>
</body>
</html>