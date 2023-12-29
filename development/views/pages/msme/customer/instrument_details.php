<html>

<head></head>

<body>
	<h2 align="center" id="nodata_found" style="display: none;"></h2>
	<img id="iloadf" src="/euf/assets/themes/standard/images/loading-large.gif">
	<style type="text/css">
		#iloadf {
			height: 80px;
			position: absolute;
			top: 40%;
			right: 50%;
			display: none;
		}
	</style>
	<?php
	//$report_id = \RightNow\Utils\Url::getParameter('r_id');
	$CI = &get_instance();
	$CI->load->helper('report');
	checkCustomerType('customer');
	$msg = RightNow\Connect\v1_3\MessageBase::fetch('CUSTOM_MSG_Document_Details');
	$report_id = $msg->Value;
	$contact_id = $CI->session->getProfileData("c_id");

	$countTL = 0;
	$countBD = 0;
	$countOD = 0;
	if ($report_id > 0) {
		$filter = array('Contact ID' => $contact_id);
		$report_result = report_result($report_id, $filter);
		if (count($report_result) > 0) {
			// echo '<pre>';
			// print_r($report_result);
			$cc = count($report_result);
			$z = 0;
			for ($i = 0; $i < count($report_result); $i++) {
				if ($report_result[$i]['Loan SubType'] == "TL") {
					$Agreementtl[$z] = $report_result[$i];
					$countTL++;
					$z++;
				}
				if ($report_result[$i]['Loan SubType'] == "BD") {
					$Agreementbd[$z] = $report_result[$i];
					$countBD++;
					$z++;
				}
				if ($report_result[$i]['Loan SubType'] == "OD") {
					$Agreementod[$z] = $report_result[$i];
					$countOD++;
					$z++;
				}
			}
		}
	}

	?>

	<style type="text/css">
		table th {
			color: white !important;
		}

		td>a {
			color: #108a43 !important;
			font-weight: bold;
		}

		#cont-div-Foreclosure table th {
			/*color: black !important;*/
			color: white !important;
			background-color: #114984;
		}

		#cont-div-Foreclosure {
			display: flex;
			flex-direction: column;
		}

		#cont-div-Foreclosure table {
			width: 95%;

		}

		@media only screen and (max-width: 450px) {
			.table_container {
				overflow-x: auto;
			}

			.table_container table {
				width: auto !important;
			}

			.table_container th {
				width: auto !important;
			}
		}
	</style>
	<h4 class="not_visible_in_mobile" style="margin-top:15px;text-transform:none !important;">Documents Download</h4>
	<div class="table_container">
		<div>
			<table id="msme_BD_documentdetails_details" class="table display table-bordered  nowrap hidden" cellspacing="0" width="">
				<thead>
					<tr>
						<th>Agreement No.</th>
						<th>Loan Type</th>
						<th>No Dues Certificate Service</th>
						<th>Foreclosure Letter </th>
						<th>Welcome Letter</th>
					</tr>
				</thead>
				<?php
				for ($i = 0; $i < count($Agreementbd); $i++) {    ?>
					<tr>
						<td><?php print_r($Agreementbd[$i]['Agreement No']);  ?></td>
						<td><?php echo $Agreementbd[$i]['Loan SubType']; ?></td>
						<td><a href="javascript:NoDues_check('<?php echo $Agreementbd[$i]['Agreement No']; ?>');" id="">Download</a></td>
						<td><a href="javascript:ForeclosureLetter('<?php echo $Agreementbd[$i]['Agreement No']; ?>');" id="">Download</a></td>
						<td><a href="javascript:welcomeLettercheck('<?php echo $Agreementbd[$i]['Agreement No']; ?>', 'BD');" id="">Download</a></td>
					</tr>
				<?php  } ?>

			</table>
		</div>

		<div>
			<table id="msme_TL_documentdetails_details" class="table display table-bordered  nowrap hidden " cellspacing="0" width="">
				<thead>
					<tr>
						<th>Agreement No.</th>
						<th>Loan Type</th>
						<th>No Dues Certificate Service</th>
						<th>Foreclosure Letter</th>
						<th>Welcome Letter</th>
					</tr>
				</thead>
				<?php
				for ($i = 0; $i < count($Agreementtl); $i++) {    ?>
					<tr>
						<td><?php echo $Agreementtl[$i]['Agreement No'];  ?></td>
						<td><?php echo $Agreementtl[$i]['Loan SubType']; ?></td>
						<td><a href="javascript:NoDues_check('<?php echo $Agreementtl[$i]['Agreement No']; ?>');" id="">Download</a></td>
						<td><a href="javascript:ForeclosureLetter('<?php echo $Agreementtl[$i]['Agreement No']; ?>');" id="">Download</a></td>
						<td><a href="javascript:welcomeLettercheck('<?php echo $Agreementtl[$i]['Agreement No']; ?>','TL');" id="">Download</a></td>

					</tr>
				<?php  } ?>

			</table>
		</div>
		<div>
			<table id="msme_OD_documentdetails_details" class="table display table-bordered  nowrap hidden " cellspacing="0" width="">
				<thead>
					<tr>
						<th>Agreement No.</th>
						<th>Loan Type</th>
						<th>No Dues Certificate Service</th>
						<th>Foreclosure Letter</th>
						<th>Welcome Letter</th>
					</tr>
				</thead>
				<?php
				for ($i = 0; $i < count($Agreementod); $i++) {    ?>
					<tr>
						<td><?php echo $Agreementod[$i]['Agreement No'];  ?></td>
						<td><?php echo $Agreementod[$i]['Loan SubType']; ?></td>
						<td><a href="javascript:NoDues_check('<?php echo $Agreementod[$i]['Agreement No']; ?>');" id="">Download</a></td>
						<td><a href="javascript:ForeclosureLetter('<?php echo $Agreementod[$i]['Agreement No']; ?>');" id="">Download</a></td>
						<td><a href="javascript:welcomeLettercheck('<?php echo $Agreementod[$i]['Agreement No']; ?>','OD');" id="">Download</a></td>

					</tr>
				<?php  } ?>

			</table>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				var countofTL = <?php echo $countTL; ?>;
				var countofOD = <?php echo $countBD; ?>;
				var countofBD = <?php echo $countOD; ?>;

				if (countofTL > 0) {
					$('#msme_TL_documentdetails_details').removeClass('hidden');
				}
				if (countofOD > 0) {
					$('#msme_OD_documentdetails_details').removeClass('hidden');
				}
				if (countofBD > 0) {
					$('#msme_BD_documentdetails_details').removeClass('hidden');
				}
				document.getElementById('iloadf').style.display = "block";
				$.post("/cc/AjaxCustom/initialloanamount_accordin", {
						contact_id: '<?php echo $contact_id; ?>',
						flag: 'true'
					})
					.done(function(data) {
						console.log(data);
						if (data == "No Records Found") {
							console.log("inside if");
							document.getElementById('iloadf').style.display = "none";
						}
						var main_data = JSON.parse(data);
						for (var k = 0; k < main_data.productDetailsList.agreementDetailList.length; k++) {
							var tenor_endDate = main_data.productDetailsList.agreementDetailList[k].tenureEndDate;
							tenor_endDate = tenor_endDate.split(" ")[0];

							var d = new Date(),
								month = '' + (d.getMonth() + 1),
								day = '' + d.getDate(),
								year = d.getFullYear();

							if (month.length < 2)
								month = '0' + month;
							if (day.length < 2)
								day = '0' + day;
							var today_date = [year, month, day].join('-');
							console.log('today_date', today_date, 'tenor_endDate', tenor_endDate)
						}
						document.getElementById('iloadf').style.display = "none";
					});
			});
			function NoDues_check(id) {
				console.log("inside nodue_check function");
				$.post("/cc/AjaxCustom/loan_status_msme", {
						agreement_no: id
					})
					.done(function(data) {
						console.log(JSON.parse(data));
						dataa = JSON.parse(data);
						console.log(dataa.Result[0].customerStatus);
						if (dataa.Result[0].customerStatus.includes("Live")) {
							console.log("should display alert");
							alert("No due is not available for this Agreement number");
						} else {
							console.log("run nodues function");
							NoDues(id);
						}
					});

			}

			function NoDues(id) {
				var agg_no = id;
				$.post("/cc/AjaxCustom/NoDues_msme", {
						agg_no: id
					})
					.done(function(data) {
						console.log(data);
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
								link.download = 'NoDues.pdf';
								link.href = 'data:application/octet-stream;base64,' + data;
								// document.body.appendChild(link);
								link.click();
							} else {
								alert("No File Found")
							}
						}
					});
			}
			function ForeclosureLetter(id) {
				var agg_no = id;
				$.post("/cc/AjaxCustom/foreclosure_msme", {
						agg_no: id
					})
					.done(function(data) {
						console.log(data);
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
								link.download = 'Foreclosure.pdf';
								link.href = 'data:application/octet-stream;base64,' + data;
								// document.body.appendChild(link);
								link.click();
							} else {
								alert("No File Found")
							}
						}
					});
			}
			function welcomeLettercheck(id,type){
				document.getElementById('iloadf').style.display = "block";
				console.log(id);
				console.log(type);
				if(type=='TL'){
					console.log("inside if");
					$.post("/cc/AjaxCustom/instrument_detailWelcomeLetterTL", {
                        ag_no: id
                    })
                    .done(function(data) {

                        // var daata = data;
                        console.log(data);
						document.getElementById('iloadf').style.display = "none";
                        if (data == "no data found") {
                            alert("No File Found")
                        } else {
                            var bin = atob(data);
							console.log('File Size:', Math.round(bin.length / 1024), 'KB');
							if (Math.round(bin.length / 1024)) {
								//console.log('PDF Version:', bin.match(/^.PDF-([0-9.]+)/)[1]);
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
								link.download = 'WelcomeLetter.pdf';
								link.href = 'data:application/octet-stream;base64,' + data;
								// document.body.appendChild(link);
								link.click();
							} else {
								alert("No File Found")
							}
                        }


                    });
				}else{
					$.post("/cc/AjaxCustom/instrument_detailWelcomeLetterODBD", {
                        ag_no: id
                    })
                    .done(function(data) {

                        // var daata = data;
                        console.log(data);
						document.getElementById('iloadf').style.display = "none";
                        if (data == "no data found") {
                            alert("No File Found")
                        } else {
							var bin = atob(data);
							console.log('File Size:', Math.round(bin.length / 1024), 'KB');
							if (Math.round(bin.length / 1024)) {
								//console.log('PDF Version:', bin.match(/^.PDF-([0-9.]+)/)[1]);
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
								link.download = 'WelcomeLetter.pdf';
								link.href = 'data:application/octet-stream;base64,' + data;
								// document.body.appendChild(link);
								link.click();
							} else {
								alert("No File Found")
							}
                        }


                    });
				}
			}
			function welcomeLetter(id) {
				var agg_no = id;
				$.post("/cc/AjaxCustom/WelcomeLetter_msme", {
						agg_no: id
					})
					.done(function(data) {
						console.log(data);
						if (data == "no data found") {
							alert("No File Found")
						} else {
							var bin = atob(data);
							console.log('File Size:', Math.round(bin.length / 1024), 'KB');
							if (Math.round(bin.length / 1024)) {
								//console.log('PDF Version:', bin.match(/^.PDF-([0-9.]+)/)[1]);
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
								link.download = 'WelcomeLetter.pdf';
								link.href = 'data:application/octet-stream;base64,' + data;
								// document.body.appendChild(link);
								link.click();
							} else {
								alert("No File Found")
							}
						}
					});
			}
			$('a#url_for_Nodues').click(function(e) {
				var agg_no = $('#i_detail').val();
				$.post("/cc/AjaxCustom/NoDues_msme")
					.done(function(data) {
						console.log(data);
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
								link.download = 'NoDues.pdf';
								link.href = 'data:application/octet-stream;base64,' + data;
								// document.body.appendChild(link);
								link.click();
							} else {
								alert("No File Found")
							}
						}
					});
			});
		</script>
		<br>
		<div id="cont-div-Foreclosure"></div>

</body>

</html>