<html>

<head></head>

<body>
	<?php
	//$report_id = \RightNow\Utils\Url::getParameter('r_id');
	$CI = &get_instance();
	$CI->load->helper('report');
	checkCustomerType('customer');
	$msg = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No_Instrument_Details_Page);
	$report_id = $msg->Value;
	$contact_id = $CI->session->getProfileData("c_id");
	$contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
	$cccc = $contact->Name->First . ' ' . $contact->Name->Last;
	for ($i = 0; $i < count($contact->Phones); $i++) {
		if ($contact->Phones[$i]->PhoneType->LookupName == 'Mobile Phone')
			;
		$mobile = $contact->Phones[$i]->Number;
	}

	//IARC
	$status_filter1 = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
	$status_filter1->Name = 'ContactID';
	$status_filter1->Values = array($contact_id);
	// $status_filter->Values = array(3140700);
	$filters1 = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
	$filters1[] = $status_filter1;

	$ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch($report_id);
	$arr = $ar->run(0, $filters1);
	$arrcount = $arr->count();
	// echo "arrcount";
	// // print_r($arr);
	// echo $arrcount;

	$total_agreements = array();
	

	for ($i=0;$i<$arrcount;$i++) 
	{

		$row = $arr->next();
		$total_agreements[$i]['AgreementNo'] =    $row['Agreement No'];
		$total_agreements[$i]['TransferredAg'] = $row['Transferred Agreement'];
		
		// print_r(json_decode($total_agreements));

		// if ($row['Transferred Agreement'] == "Yes") {

		// 	if ($Transferred_Ag == "") {
		// 		$Transferred_Ag = $row['Agreement No'];
		// 	} else {
		// 		$Transferred_Ag = $Transferred_Ag . ',' . $row['Agreement No'];
		// 	}


		// }
	}
	// print_r($total_agreements);
	$total_agreements = json_encode($total_agreements);
	//IARC
	// var_dump($Transferred_Ag);
	



	?>
	<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>

	<form action='#' method='post' class="loan-form">
		<fieldset>
			<div id="instrumentdetails"></div>

		</fieldset>

	</form>

	<p>&nbsp;</p>

	<!-- IARC CR Chnages -->
	<div class="modal-dialog modal-dialog-centered" id="IarcModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" style="display:none;">
		<div class="modal-dialog " role="document">
			<div class="modal-content" style="height: auto;
	overflow-y: hidden;
	overflow-x: hidden;
	position: fixed;
	top: 40%;
	left: 37%;
	width: 704px;
   ">
				<div class="modal-header" style="margin-top:24px;">
					<center>
						<h3 class="modal-title" id="myModalLabel">IARC Notification</h3>
					</center>
					<button type="button" id="popup_close" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Dear Customer, your loan has been transferred to International Asset Reconstruction Company
						Private Limited (“IARC”) and we request you to contact their customer support team for any
						further queries.</p>
					<b>
						<pre>Customer Support:
International Asset Reconstruction Company Private Limited,
A-601/602/605, 215 Atrium, Kanakia Spaces,
Andheri Kurla Road, Andheri (East), Mumbai-400093
Email id: customersupport@iarc.co.in
Customer Support number: 022-45963100 
(Between 9:00 AM. to 07:00 PM. Monday to Saturday, except National & Public Holidays)
Website:www.iarc.co.in
For online access and payment: res.iarc.co.in
</pre>
					</b>
				</div>
				<div class="modal-footer">
					<center><button type="button" id="popup_close1"
							style="background-color: #115184;color: white;margin:2px;height: 29px; border-radius: 30px;margin-top: 17px;width: 48%;"
							data-dismiss="modal">Ok</button></<center>
						<!-- <button type="button" style="background-color: #115184;color: white;" class="btn btn-primary">Save changes</button> -->
				</div>
			</div>
		</div>
	</div>

	<!-- IARC CR Chnages -->

	<div id="instrumentdetails_docs" style='display:none'>
		<div class="row">
			<div class="col-md-4">
				<a href="javascript:void(0);" target="_blank" id="url_ins"><img
						src='/euf/assets/themes/standard/images/clipboard-icon.png' height="100" width="100"></a>
				<p>Insurance Policy Renewal</p>
			</div>
			<div class="col-md-4" id="forclosure">
				<a href="javascript:void(0);" target="_blank" id="url_for"><img
						src='/euf/assets/themes/standard/images/documents-flat.png' height="100" width="100"></a>
				<p>Foreclosure Letter</p>
			</div>
			<!-- <div class="col-md-4" id="soa">
					<a href="javascript:void(0);" id="url_for_soa"><img
							src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a>
					<p>SOA</p>
				</div> -->
		</div>
	</div>
	<div id="showresult_instrument" style='display:none'>
		<div class="row">
			<div class="col-md-3" id="forclosure_n">
				<a href="javascript:void(0);" target="_blank" id="url_for_n"><img
						src='/euf/assets/themes/standard/images/documents-flat.png' height="100" width="100"></a>
				<p>Foreclosure Letter</p>
			</div>
			<!-- <div class="col-md-3" id="soa_n">
					<a href="javascript:void(0);" id="url_for_n_soa"><img
							src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a>
					<p id="soa_p">SOA</p>
				</div> -->
			<div class="col-md-3" id="insss">
				<a href="javascript:void(0);" target="_blank" id="url_inss"><img
						src='/euf/assets/themes/standard/images/clipboard-icon.png' height="100" width="100"></a>
				<p>Insurance Policy Renewal</p>
			</div>
			<div class="col-md-4" id="paperlessnoc">
				<a href="javascript:void(0);" id="url_for_paperlessnoc"><img
						src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a>
				<p>Paperless NOC</p>
			</div>
		</div>
		<div>

		</div>
	</div>

	<a href="javascript:void(0);" id="btn1" style="display: none;"><img
			src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a>
	<p id="para1" style="display: none;">Download Repayment Letter</p>

	<a href="javascript:void(0);" id="url_for_n_soa" style="display: none;"><img
			src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a>
	<p id="soa_p" style="display: none;">SOA</p>

	<script type="text/javascript">


		$(document).ready(function () {

			
			
$('#popup_close').click(function () {
				console.log('inside close button');
				$('#IarcModal').css('display', 'none');
			});

			$('#popup_close1').click(function () {
				console.log('inside close button');
				$('#IarcModal').css('display', 'none');
			});




			
		});




		$.post("/cc/AjaxCustom/rest_api_report", { id_of_report: '<?php echo $report_id; ?>', filtering_val: 'instrumentdetails', method_val: 'getInsuranceDetails' })
			.done(function (data) {
				$("#instrumentdetails").html(data);
				let source = document.querySelector('#i_detail');
				source.addEventListener('change', function () {

					
					let a = this.value;
					console.log("value in the dropdown", a);
					//showing welcome letter button
					// $("#btn1").show();
					// $("#para1").show();
					// $("#url_for_n_soa").show();
					// $("#soa_p").show();

					//IARC
					var TransferredAg = "<?php print_r($TransferredAg); ?>";
					console.log("tr".TransferredAg);
					if (a != "" && a != null && a != 0) {
						var SingleIARCAg = localStorage.getItem("key");
						if (SingleIARCAg == "1") {
							console.log('instru pg');
							$("#url_for_n_soa").show();
							$("#soa_p").show();


						}
						else if (SingleIARCAg == "multiple") {
							var input_string = <?php print_r ($total_agreements); ?>;
							//console.log("Check multiple".input_string);
							// var Transferred_Ag = input_string.split(",");
							// console.log(Transferred_Ag);

							// var isMatch = input_string === a;
							for (var i = 0; i < input_string.length; i++) {
								if (input_string[i]['AgreementNo'] == a) {
									if( input_string[i]['TransferredAg'] == "Yes")
									{
									document.getElementById('IarcModal').style.display = "block";
									$("#btn1").hide();
									$("#para1").hide();
									$("#url_for_n_soa").show();
									$("#soa_p").show();
									}
									if( input_string[i]['TransferredAg'] != "Yes")
									{
										$("#btn1").show();
									$("#para1").show();
									$("#url_for_n_soa").show();
									$("#soa_p").show();
									}
								}
								// else {
								// 	$("#btn1").show();
								// 	$("#para1").show();
								// 	$("#url_for_n_soa").show();
								// 	$("#soa_p").show();
								// }
							}
							


						}

						else {
							$("#btn1").show();
							$("#para1").show();
							$("#url_for_n_soa").show();
							$("#soa_p").show();

						}
					}

					if (a == 0 || a == null) {
						$("#btn1").hide();
						$("#para1").hide();
						$("#url_for_n_soa").hide();
						$("#soa_p").hide();

					}



					//IARC


					$('#btn1').click(() => {
						console.log("repayment letter button is clickedd")

						pdf_GenerationReapymentLetter(a);
						// welcome_letterdate(a);

					});
				})


			});
		// $('a#url_for_soa').click(function(e){
		// 		     // stop its defaut behaviour
		// 		     //console.log("url_for_soa?: ",isSoaOk);
		// 		     if(isSoaOk == false){
		// 		     	alert("Contact Customer Support for SOA");
		// 		     	e.preventDefault();
		// 		     }

		// });
		$('a#url_for_n_soa').click(function (e) {

			var agg_no = $('#i_detail').val();
			var mobile = '<?php echo $mobile; ?>';

			$.post("/cc/AjaxCustom/soa_download_for_customer", { agg_no: agg_no, mobile: mobile })
				.done(function (data) {

					console.log(data);
					if (data == "no data found") {
						alert("No File Found")
					}
					else {
						var bin = atob(data);
						console.log('File Size:', Math.round(bin.length / 1024), 'KB');
						if (Math.round(bin.length / 1024)) {
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
							link.download = 'SOA.pdf';
							link.href = 'data:application/octet-stream;base64,' + data;
							// document.body.appendChild(link);
							link.click();
						}
						else {
							alert("No File Found")
						}
					}
				});
		});

		$('a#url_for_paperlessnoc').click(function (e) {
			// stop its defaut behaviour
			//console.log("url_for_n_soa?: ",isSoaOk);
			// if(isSoaOk == false){
			// 	alert("Contact Customer Support for SOA");
			// 	e.preventDefault();
			///
			// }
			var agg_no = $('#i_detail').val();

			$.post("/cc/AjaxCustom/paperlessnoc", { agg_no: agg_no })
				.done(function (data) {

					console.log(data);
					if (data == "no data found") {
						alert("No File Found")
					}
					else {

						var bin = atob(data);
						console.log('File Size:', Math.round(bin.length / 1024), 'KB');
						if (Math.round(bin.length / 1024)) {
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
						else {
							alert("No File Found")
						}
					}


				});






		});
		function pdf_GenerationReapymentLetter(id) {
			console.log("inside method to download repayment letter");
			$.post("/cc/AjaxCustom/instrument_detailRepaymentLetter", {
				ag_no: id
			})
				.done(function (data) {
					console.log("data coimg from ajax is:", data);

					// console.log(data);
					if (data == "no data found") {
						alert("No File Found")
					} else {

						var bin = atob(data);
						console.log('File Size:', Math.round(bin.length / 1024), 'KB');
						if (Math.round(bin.length / 1024)) {
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
							link.download = 'Repayment Letter.pdf';
							link.href = 'data:application/octet-stream;base64,' + data;
							// document.body.appendChild(link);
							link.click();
						} else {
							alert("No File Found")
						}
					}


				});

		}

	</script>

	<!----pop up code starts -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Include the Bootstrap JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!----pop up code ends -->
</body>

</html>