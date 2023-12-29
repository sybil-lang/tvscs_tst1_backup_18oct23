<html>
<head></head>
<body>
<?php
 //$report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
$report_id=$msg->Value;
$contact_id=$CI->session->getProfileData("c_id");
	$contact =  \RightNow\Connect\v1_3\Contact::fetch($contact_id);
    $cccc=$contact->Name->First.' '.$contact->Name->Last ;
    for($i=0;$i<count($contact->Phones);$i++)
    {
    if($contact->Phones[ $i ]->PhoneType->LookupName == 'Mobile Phone');
		$mobile=$contact->Phones[ $i ]->Number ;
    }
?>
<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>

<form action='#' method='post' class="loan-form">
  <fieldset>
    <div id="instrumentdetails"></div>

  </fieldset>
  
</form>

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
		<div class="col-md-3" id="forclosure_n">
			<a href="javascript:void(0);" target="_blank" id="url_for_n"><img src='/euf/assets/themes/standard/images/documents-flat.png' height="100" width="100"></a><p>Foreclosure Letter</p>
		</div>
		<div class="col-md-3" id="soa_n">
			<a href="javascript:void(0);"  id="url_for_n_soa"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a><p>SOA</p>
		</div>
		<div class="col-md-3" id="insss">
				  <a href="javascript:void(0);" target="_blank" id="url_inss"><img src='/euf/assets/themes/standard/images/clipboard-icon.png' height="100" width="100"></a><p>Insurance Policy Renewal</p>
		</div>
		<div class="col-md-4" id="paperlessnoc">
			<a href="javascript:void(0);"  id="url_for_paperlessnoc"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a><p>Paperless NOC</p>
		</div>
</div>
<div>
	
</div>
</div>
<script type="text/javascript">
$.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'instrumentdetails', method_val : 'getInsuranceDetails'})
		 .done(function( data ) {
	 $( "#instrumentdetails" ).html(data);
});
// $('a#url_for_soa').click(function(e){
// 		     // stop its defaut behaviour
// 		     //console.log("url_for_soa?: ",isSoaOk);
// 		     if(isSoaOk == false){
// 		     	alert("Contact Customer Support for SOA");
// 		     	e.preventDefault();
// 		     }
		      
// });
$('a#url_for_n_soa').click(function(e){
	
	      var agg_no=$('#i_detail').val();
	      var mobile ='<?php echo $mobile;?>';

	      $.post( "/cc/AjaxCustom/soa_download_for_customer", { agg_no:agg_no,mobile:mobile})
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
					alert("No File Found")
				}
			}
	      });
	    });

	$('a#url_for_paperlessnoc').click(function(e){
	     // stop its defaut behaviour
	      //console.log("url_for_n_soa?: ",isSoaOk);
	      // if(isSoaOk == false){
	      // 	alert("Contact Customer Support for SOA");
	      // 	e.preventDefault();
	      // }
	      var agg_no=$('#i_detail').val();

	      $.post( "/cc/AjaxCustom/paperlessnoc", { agg_no:agg_no})
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
					alert("No File Found")
				}
				}


	      });





	      
	    });
									
</script>

</body>
</html>