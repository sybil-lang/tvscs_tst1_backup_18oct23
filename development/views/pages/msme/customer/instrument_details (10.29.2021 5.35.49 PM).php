<html>
<head></head>
<body>
<img id="iloadf" src="/euf/assets/themes/standard/images/loading-large.gif">
<style type="text/css">
#iloadf
{
  height: 80px;
  position: absolute;
  top: 40%;
  right: 50%;
  display:none;
}
</style>
<?php
 //$report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Document_Details);
$report_id=$msg->Value;
$contact_id=$CI->session->getProfileData("c_id");

$soa_config_name = RightNow\Connect\v1_3\Configuration::fetch(CUSTOM_CFG_Allow_SOA);
$soa_config = $soa_config_name->Value;

$other_docs_config_name = RightNow\Connect\v1_3\Configuration::fetch(CUSTOM_CFG_Allow_Other_DOCS);
$other_docs_config = $other_docs_config_name->Value;

$countTLOD=0;
$countBD=0;
if($report_id>0)
{
		$filter=array('Contact ID'=>$contact_id);
		// print_r($filter);
		$report_result=report_result($report_id,$filter);
		// print_r($report_result);
		if(count($report_result) > 0)
		{
            // echo       '<pre>';
			// print_r($report_result);
			$cc=count($report_result);
            $z=0;
			for($i=0;$i<count($report_result);$i++)
			{
				if($report_result[$i]['Loan SubType']=="TL"||$report_result[$i]['Loan SubType']=="OD")
				{
				   $Agreementtlod[$z]=$report_result[$i];
                   $countTLOD++;
                   $z++;
				}
				
		    }
            $z=0;
            $checkunique=array();
		    for($i=0;$i<count($report_result);$i++)
			{			
				
					if($report_result[$i]['Loan SubType']=="BD")
					{
						// echo '-->'$i.' valiue:'.array_search($report_result[$i]['Prospect No'],$checkunique);
						if(!(in_array($report_result[$i]['Prospect No'],$checkunique)))
						{
						   $Agreementbd[$z]=$report_result[$i];
		                   $countBD++;
		                   $z++;
                			array_push($checkunique,$report_result[$i]['Prospect No']);

						}	

					}				
				
		    }


		    // $Agreementbd = array_map("unserialize", array_unique(array_map("serialize", $Agreementbd)));
   //           echo '<pre>';
   //              			print_r($checkunique);

			// print_r($Agreementtlod);
			// print_r($Agreementbd);
			// echo $countTLOD.'BD'.$countBD;

	    }
}	


?>

<style type="text/css">
	table th
	{
		color: white !important;
	}
	td > a{
		color: #108a43 !important;
		font-weight: bold;
	}
	#cont-div-Foreclosure table th
      {
        /*color: black !important;*/
        color: white !important;
        background-color: #114984;
      }
    #cont-div-Foreclosure
	{
	    display: flex;
	    flex-direction: column;
	}
    #cont-div-Foreclosure table
	{
	  width: 95%;

	}
	@media only screen and (max-width: 450px) {
	.table_container
	{
		overflow-x:auto;
	}
	.table_container table
	{
		width:auto!important;
	}
	.table_container th
	{
		width:auto!important;
	}
	
}
</style>
<script type="text/javascript">
	var countTLOD=parseInt(localStorage.getItem("countTLOD"));
		var countBD=parseInt(localStorage.getItem("countBD"));
		var agreementtlod=localStorage.getItem("agreementtlod");
		var agreementbd=localStorage.getItem("agreementbd");
		
</script>



<h4  class="not_visible_in_mobile" style="margin-top:15px;text-transform:none !important;">Documents Download</h4>
<div class="table_container">
	<div>
<table id="msme_BD_documentdetails_details"  class="table display table-bordered  nowrap hidden" cellspacing="0" width="" >
        <thead>

        	
            <tr>
             
                <th>Prospect No.</th>
                <th>Loan Type</th>
                <th>SOA</th>
				<th>No Dues Certificate Service</th>
				<th>No Dues Certificate without Cheque Service </th>	
				<th>Sanction Letter </th>				
				<th>Welcome Letter</th>				

							

		<!-- https://msmeportaluat.tvscredit.com/MSMEServices/generateSoaPDF?agreementNumber=TN7001MS0001438&prospectNumber=		 -->

            </tr>
            
        </thead>
 <?php for ($i=0; $i <count($Agreementbd) ; $i++) {    ?>
 	<!-- <script type="text/javascript">console.log('<?php print_r($Agreementbd);?>')</script> -->
        <tr>
            	<td><?php print_r($Agreementbd[$i]['Prospect No']);  ?></td>
            	<td><?php echo $Agreementbd[$i]['Loan SubType']; ?></td>
            	
				<?php //if($Agreementbd[$i]['SOA Allow']) 
				if($soa_config)
				{ ?>
            	<td><a target="_blank" href='<?php echo "https://msmeportaluat.tvscredit.com/MSMEServices/generateSoaPDF?agreementNumber=&prospectNumber=".$Agreementbd[$i]['Prospect No'];?>'>Download</a></td>
            	<?php
				}
				else{
            	?>
            	<td></td>
            	<?php 
                } 
                if($other_docs_config){
                ?>

            	<td><a target="_blank" href='<?php echo "https://msmeportaluat.tvscredit.com/MSMEServices/generateNDNCPDFFile?agreementNumber=&prospectNumber=".$Agreementbd[$i]['Prospect No'];?>' download>Download</a></td>
            	<td><a target="_blank" href='<?php echo "https://msmeportaluat.tvscredit.com/MSMEServices/generateNDNCWithoutChequePDFFile?agreementNumber=&prospectNumber=".$Agreementbd[$i]['Prospect No'];?>'>Download</a></td>
            	<td><a target="_blank" href='<?php echo "https://msmeportaluat.tvscredit.com/MSMEServices/generateSanctionLetter?agreementNumber=&prospectNumber=".$Agreementbd[$i]['Prospect No'];?>'>Download</a></td>
            	
            	<td><a target="_blank" href='<?php echo "https://msmeportaluat.tvscredit.com/MSMEServices/getwelcomeletter?agreementNumber=&prospectNumber=".$Agreementbd[$i]['Prospect No'];?>'>Download</a></td>
            <? } else{
            ?>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <?
            } ?>
        </tr>
<?php  } ?>
       
    </table>
</div>


<div>
<table id="msme_TLOD_documentdetails_details"  class="table display table-bordered  nowrap hidden " cellspacing="0" width="" >
       <!-- <table id="msme_BD_documentdetails_details"  class="table display table-bordered  nowrap hidden" cellspacing="0" width="100%" > -->
        <thead>

        	
            <tr>
             
                <th>Agreement No.</th>
                <th>Loan Type</th>
                <th>SOA</th>
				<th>No Dues Certificate Service</th>
				<th>No Dues Certificate without Cheque Service </th>	
				<th>Sanction Letter </th>				
				<th>Welcome Letter</th>				
							

				

            </tr>
            
        </thead>
 <?php for ($i=0; $i <count($Agreementtlod) ; $i++) {    ?>
        <tr>
            	<td><?php echo $Agreementtlod[$i]['Agreement No'];  ?></td>
            	<td><?php echo $Agreementtlod[$i]['Loan SubType']; ?></td>
            	
				<?php if($Agreementtlod[$i]['SOA Allow'])
				{ ?>
            	<td><a target="_blank" href='<?php echo "https://msmeportaluat.tvscredit.com/MSMEServices/generateSoaPDF?agreementNumber=".$Agreementtlod[$i]['Agreement No']."&prospectNumber=";?>'>Download</a></td>
            	<?php
				}
				else{
            	?>
            	<td></td>
            	<?php 
                } ?>

            	<td><a target="_blank" href='<?php echo "https://msmeportaluat.tvscredit.com/MSMEServices/generateNDNCPDFFile?agreementNumber=".$Agreementtlod[$i]['Agreement No']."&prospectNumber=";?>'>Download</a></td>
            	<td><a target="_blank" href='<?php echo "https://msmeportaluat.tvscredit.com/MSMEServices/generateNDNCWithoutChequePDFFile?agreementNumber=".$Agreementtlod[$i]['Agreement No']."&prospectNumber=";?>'>Download</a></td>
            	<td><a target="_blank" href='<?php echo "https://msmeportaluat.tvscredit.com/MSMEServices/generateSanctionLetter?agreementNumber=".$Agreementtlod[$i]['Agreement No']."&prospectNumber=";?>'>Download</a></td>
            	
            	<td><a target="_blank" href='<?php echo "https://msmeportaluat.tvscredit.com/MSMEServices/getwelcomeletter?agreementNumber=".$Agreementtlod[$i]['Agreement No']."&prospectNumber=";?>'>Download</a></td>

        </tr>
<?php  } ?>
       
    </table>
</div>

<!-- <h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4> -->


  


<!-- 
<p>&nbsp;</p>
<div id="instrumentdetails_docs" style='display:none'>
	<div class="row">
		<div class="col-md-4">
			  <a href="javascript:void(0);" target="_blank" id="url_ins"><img src='/euf/assets/themes/standard/images/clipboard-icon.png' height="100" width="100"></a><p>Insurance Policy Renewal</p>
		</div>
		<div class="col-md-4" id="forclosure">
			  <a href="javascript:void(0);" target="_blank" id="url_for"><img src='/euf/assets/themes/standard/images/documents-flat.png' height="100" width="100"></a><p>Foreclosure Letter</p>
		</div>
		<div class="col-md-4" id="soa">
			  <a href="javascript:void(0);" id="url_for_soa"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a><p>SOA</p>
		</div>
	</div>
</div> 
<div id="showresult_instrument" style='display:none'>
<div class="row">
	<div class="col-md-4" id="forclosure_n">
		<a href="javascript:void(0);" target="_blank" id="url_for_n"><img src='/euf/assets/themes/standard/images/documents-flat.png' height="100" width="100"></a><p>Foreclosure Letter</p>
	</div>
	<div class="col-md-4" id="soa_n">
		<a href="javascript:void(0);"  id="url_for_n_soa"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a><p>SOA</p>
	</div>
</div>
</div> -->
<script type="text/javascript">


	jQuery(document).ready(function ($) 
	{
		// var countTLOD=localStorage.getItem("countTLOD");
		// var countBD=localStorage.getItem("countBD");
		var agreementtlod=localStorage.getItem("agreementtlod");
		var agreementbd=localStorage.getItem("agreementbd");
		  if(countTLOD)
            {
                        $('#msme_TLOD_documentdetails_details').removeClass('hidden');

            }
          if(countBD)
            {
                        $('#msme_BD_documentdetails_details').removeClass('hidden');

            }
            document.getElementById('iloadf').style.display="block";
            $.post( "/cc/AjaxCustom/initialloanamount_accordin", {contact_id : '<?php echo $contact_id;?>',flag :'true' })
			  .done(function( data ) 
			  {

			     // $( "#select_loanamount_OD" ).html(data);
			     var main_data=JSON.parse(data);
			     console.log(JSON.parse(data));
			     for(var i=0;i<main_data.length;i++)
			     {
			     document.getElementById('cont-div-Foreclosure').innerHTML+='<a class="btn btn-primary left-align" style="text-transform:none !important;" data-toggle="collapse" href="#fmultiCollapseExample'+i+'" role="button" aria-expanded="false"aria-controls="fmultiCollapseExample'+i+'"><i class="fa"></i>      Prospect No. :    '+main_data[i]["prospectNumber"]+' </a><div class="collapse multi-collapse" id="fmultiCollapseExample'+i+'"><div class="overfloww"><table id="cont-div-Foreclosure'+main_data[i]["prospectNumber"]+'" class="table display table-bordered nowrap "><th>Agreement No.</th><th>Loan Type</th><th>Foreclosure Letter</th></table></div></div>'
			          if(main_data[i]["agrrementNumberList"]){


			             for(var j=0;j<main_data[i].productDetailsList.length;j++)
			               {
			                  for(var k=0;k<main_data[i].productDetailsList[j].agreementDetailList.length;k++)
			                  {
			                  	var tenor_endDate=main_data[i].productDetailsList[j].agreementDetailList[k].tenureEndDate;
			                  	tenor_endDate=tenor_endDate.split(" ")[0];

			                  	var d = new Date(),
							        month = '' + (d.getMonth() + 1),
							        day = '' + d.getDate(),
							        year = d.getFullYear();

							    if (month.length < 2) 
							        month = '0' + month;
							    if (day.length < 2) 
							        day = '0' + day;
                                 var today_date=[year, month, day].join('-');
                                 console.log('today_date',today_date,'tenor_endDate',tenor_endDate)
                                 if(tenor_endDate>today_date)
                                 {
										document.getElementById('cont-div-Foreclosure'+main_data[i]["prospectNumber"]).innerHTML+='<td>'+main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber+'</td><td>'+main_data[i].productDetailsList[j].agreementDetailList[k].productCode+'</td><td><a target="_blank" href= "https://msmeportaluat.tvscredit.com/MSMEServices/generateForeClosurePDF?agreementNumber='+main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber+'">Download</a></td></tr>'
                                 }
                                 else
                                 {
									document.getElementById('cont-div-Foreclosure'+main_data[i]["prospectNumber"]).innerHTML+='<td>'+main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber+'</td><td>'+main_data[i].productDetailsList[j].agreementDetailList[k].productCode+'</td><td></td></tr>'
                                 }


			                 
			                  }
			               }

			     }
			 }

			 document.getElementById('iloadf').style.display="none";
			 
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
	     // stop its defaut behaviour
	      //console.log("url_for_n_soa?: ",isSoaOk);
	     if(isSoaOk == false){
	     	alert("Contact Customer Support for SOA");
	     	e.preventDefault();
	     }
	      
});

									
</script>
<br>
<div id="cont-div-Foreclosure"></div>

</body>
</html>