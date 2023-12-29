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
        @media only screen and (max-width: 450px) {
	input[type=radio] {
	    border: 0px !important;
    width: 15% !important;
    height: 0.8em !important;
}
.overfloww
{
	overflow-x: scroll;
}
#msme_ecs_details_table th {
    color: white!important;
    width: 100px;
}
}
#msme_ecs_details_table th
{
  color: white!important;
}
.rn_LoanSelection #bdodtl h4{
	text-transform: none !important;
	color: green !important;
    font-size: 18px !important;
}

    </style></head>
<body>
     <img id="isload" src="/euf/assets/themes/standard/images/loading-large.gif">
     <?php
     $msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_NO_MSME);
	 $report_id=$msg->Value;

?>
<!-- <h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4> -->
<h4  style="margin-top:15px;text-transform:none !important;" class="not_visible_in_mobile"  >ECS Mandate</h4>
<p>#rn:msg:CUSTOM_MSG_ECS_MANDATE_INTRO#</p>
<form action='#' method='post' class="loan-form">
  <fieldset>
  <!-- 	<div id="statusofloan"></div> -->
<rn:widget  path="custom/Loan/LoanSelection" your_condition="mandate"/>
 
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

	.bold-text{
		font-weight: 600;
	}
	.rn_agreementSelect {
    	display: inline-block;
	}
	.btn:click{
		color:white;
	}

  }

	/*.no-due:active {
	    color: #fff;
	}*/

</style>
<div class="col-sm-12 col-md-12 col-lg-12" id="contemt-main">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			
		</div>
	</div>
	
</div>

  </fieldset>
</form>
<p>&nbsp;</p>
<div class="overfloww">
<table id="msme_ecs_details_table"  class="table display table-bordered nowrap hidden" cellspacing="0" width="100%" >
        <thead>
            <tr>
               
                <th>Bank Name</th>
                <th>Branch Code</th>
                <th>Account Number</th>
				<th>Batch Number</th>
				<th>Amount Received</th>				
				<th>Amount Required</th>
				<th>Status</th>
				<th>Due Date</th>
				<th>Start Date</th>
				<th>End Date</th>
					

				

            </tr>
            <tr id="msme_ecs_details_table_thbody"></tr>
        </thead>
       
    </table>
</div>
<script type="text/javascript">
	
var sub_val;

function checking(){
        if(document.getElementById('OD_idmandate'))

        {
        	sub_val='OD';
          if(document.getElementById('OD_idmandate').checked){

       			$.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'mandateStatus',filtering_val3:'mandateStatus', filter_subloan: sub_val , method_val : ''})
													 .done(function( data ) {
												 $( "#mandate_OD" ).html(data);
										 });
			}
        }
        if(document.getElementById('TL_idmandate'))
        {
          	sub_val='TL';
          if(document.getElementById('TL_idmandate').checked){

        		$.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'mandateStatus',filtering_val3:'mandateStatus', filter_subloan: sub_val , method_val : ''})
													 .done(function( data ) {
												 $( "#mandate_TL" ).html(data);
										 });
      		}
  		}



													// }
            if(document.getElementById('BD_idmandate').checked){


                if(document.getElementById('BD_idmandate')){           
                                    $.post( "/cc/AjaxCustom/rest_api_report2", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'mandateStatus',filtering_val2 : 'BD', method_val : ''})
                                                     .done(function( data ) {
                                                 $( "#mandate_BD" ).html(data);
                                         });
                                                  } 
			}
 }  



	// $('select#i_detail_BD').change(function()
	// {
			
	// 	 console.log('BD');
	// 	if($('select#i_detail_BD :Selected').val()!="0")
	// 	{
	// 	 console.log($('select#i_detail_BD :Selected').val())

	// 	 RestDatafetch($('select#i_detail_BD :Selected').val());
	// 	}
			
	// });
			 
	// $('select#i_detail_TL').change(function()
	// {
			 //console.log('TL')

	// 	if($('select#i_detail_TL :Selected').val()!="0")
	// 	{
	// 	 console.log($('select#i_detail_TL :Selected').val())
		 

	// 	 RestDatafetch($('select#i_detail_TL :Selected').val());
	// 	}
		

	// });
		
	// $('select#i_detail_OD').change(function()
	// {
	// 	console.log('OD');
	// 	if($('select#i_detail_OD :Selected').val()!="0")
	// 	{
	// 	 console.log($('select#i_detail_OD :Selected').val());
		 
			
	// 	 RestDatafetch($('select#i_detail_OD :Selected').val());
	// 	}
			
	// });

			function RestDatafetch(agg)
			{
				//console.log(agg)
				$('#msme_ecs_details_table').removeClass('hidden');
				
					$.post( "/cc/AjaxCustom/ecs_msme", {agreement_no :agg })
					 .done(function( data ) {

				    dataa=JSON.parse(data);

					console.log('dataSrc',dataa)

				    if(dataa.hasOwnProperty("Error") == false && dataa.Error != "No record was found for agreement Number "+agg)
					    {
				    	

				    	document.getElementById('msme_ecs_details_table_thbody').innerHTML='<td>'+dataa.bankName+'</td><td>'+dataa.branchCode+'</td><td>'+dataa.accountNumber+'</td><td>'+dataa.batchNumber+'</td><td>'+dataa.amountReceived+'</td><td>'+dataa.amountRequired+'</td><td>'+dataa.status+'</td><td>'+dataa.dueDate+'</td><td>'+dataa.ecsStartDate+'</td><td>'+dataa.ecsEndDate+'</td>'
					    }
					    else
					    {
				    	document.getElementById('msme_ecs_details_table_thbody').innerHTML='<td colspan="10" style="text-align:center">'+dataa.Error+'</td>';
					    }
					});
				

			}



</script>
</body>
</html>



<!-- <p>&nbsp;</p> -->

