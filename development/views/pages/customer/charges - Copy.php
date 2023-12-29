 <html>
 <head></head>
 <style type="text/css">
 div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
	th{
		background-color: #3B6DB1;
		color: #ffffff;
	}
	</style>
 <body>
 <script type="text/javascript">
$('#charge').DataTable( {
					 "scrollX": false,
			//		 "responsive":true,
					"ajax": {
								"url": "/cc/AjaxCustom/rest_api_call",
								"dataSrc": "",
								"data": {
										method: 'getLastPaymentDetails',
										ag_no: 'TN3003CA00023',
								}
							},
					"columns": [
							{ "data": "DUE_TYPE" },
							{ "data": "VALUE" }
						],
						"bDestroy": true
					} );
 </script>
<table id="charge" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Due Type</th>
				<th>Value</th>
            </tr>
        </thead>
        
    </table>
 </body>
 </html>