<!-- tst1 -->
<?php
$CI = &get_instance();
$CI->load->helper('report');

checkCustomerType('customer');
?>
<html>

<head>
	<style type="text/css">
		#isload {
			height: 80px;
			position: absolute;
			top: 50%;
			left:50%;
			display: none;
		
		}
	</style>
</head>

<body>
	<img id="isload" src="/euf/assets/themes/standard/images/loading-large.gif" >
	<?php
	$msg = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No); ///100066
	$report_id = $msg->Value;

	?>
	<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>

	<form action='#' method='post' class="loan-form">
		<fieldset>
			<div id="statusofloan_ndc"></div>
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

				.bold-text {
					font-weight: 600;
				}

				.rn_agreementSelect {
					display: inline-block;
				}

				.btn:click {
					color: white;
				}
			</style>
			<div class="col-sm-12 col-md-12 col-lg-12" id="contemt-main">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<br><br>
						<div class="row">
							<div class="col-md-8 not-applicable">
							</div>

						</div>
					</div>
				</div>


				<div id="showresult_mandate" style='display:none'>
					<div class="row">
						<div class="col-md-3" id="mandate1">
							<a href="javascript:void(0);" id="url_for_mandate"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a>
							<p>Digital NOC</p>
						</div>
					</div>
				</div>
				<!-- <div id="showresult_mandate" style='display:none'>
					<div class="row">
						<div class="col-md-3" id="mandate">
							<a href="javascript:void(0);" id="url_for_mandate"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a>
							<p>Prefilled Mandate</p>
						</div>
					</div>
				</div> -->

				<br />
				<a href="javascript:void(0);" id="download-button" style="display: none;"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a>
				<p id="para" style="display: none;">NDC</p>

				<script type="text/javascript">
					// var agreementNo = "";

					$.post("/cc/AjaxCustom/rest_api_report", {
							id_of_report: '<?php echo $report_id; ?>',
							filtering_val: 'mandateStatus',
							method_val: 'getMandateStatus'
						})
						// 
						.done(function(data) {
							// console.log("helloo---1");
							// console.log(data);
							// console.log("helloo---1");
							$("#statusofloan_ndc").html(data);

							//---otherportNoc--
							let source = document.querySelector('#i_detail_');
							// console.log("source is: " + source)///
							source.addEventListener('change', function() {
								let agg_no = this.value;
								
								document.getElementById('isload').style.display = "block";
								document.getElementById('showresult_mandate').style.display = "none";
								console.log('a value first time' + agg_no);
								if (agg_no == '0') {
									document.getElementById('showresult_mandate').style.display = "none";
								}

								if (agg_no != undefined && agg_no != '0') {
								
									$.post("/cc/AjaxCustom/instrument_DigitalNoc", {
											ag_no: agg_no
										})
										.done(function(data) {

											if (data != '') {
												console.log("data frmo instrument_DigitalNoc", data)
												var bin = atob(data);
												console.log('File Size:', Math.round(bin.length / 1024), 'KB');
												if (Math.round(bin.length / 1024)) {
													document.getElementById('showresult_mandate').style.display = "block";
													document.getElementById('isload').style.display = "none";
												}
											} else {
												// alert('Prefilled Mandate is not available for the selected agreement number.');
												console.log('api down ...data not coming from api so dont show the button');
												document.getElementById('showresult_mandate').style.display = "none";
												document.getElementById('isload').style.display = "none";
											}


										});
								}
							});
							source.addEventListener('change', async function() {
								console.log(this.value)
								// function pdf_generation_check(id) {

								// console.log(data);
								let a = this.value;

								if (a.includes("AP3019") || a.includes("AP3020") || a.includes("AP3075")) {
									console.log("inside if");
								} else {
									$('.not-applicable').hide();
									console.log("inside else");
									var response_check = await pdf_generation_check(a);
									if (response_check.includes("no data found")) {
										// console.log("data2");
										console.log("secound if");
										await $("#download-button").hide(); //shows div.
										await $("#para").hide(); //shows div.
										alert("Other Portfolio NDC Not Available for this Agreement Number")
										// console.log("data3");
									} else {
										console.log("inside secound else");
										$("#download-button").show(); //shows div.
										$("#para").show(); //shows div.
										$('#download-button').unbind().click(() => {
											// console.log("hello");
											pdf_generation(a);
											// console.log("hellow1");

										});

									}
								}
							});
							///---------------
						});
					//Prefilled Ecs Mandate
					$('a#url_for_mandate').click(function(e) {

						var agg_no = $('#i_detail_').val();

						$.post("/cc/AjaxCustom/instrument_DigitalNoc", {
								ag_no: agg_no
							})
							.done(function(data) {

								// var daata = data;
								console.log(data);
								// document.getElementById('iloadf').style.display = "none";
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
										link.download = 'DigitalNoc.pdf';
										link.href = 'data:application/octet-stream;base64,' + data;
										// document.body.appendChild(link);
										link.click();
									} else {
										alert("No File Found")
									}
								}


							});

					});

					//Prefilled ECS Mandate




					$('#no-due').click(function(e) {
						e.preventDefault();
						if (agreementNo != "" || agreementNo != null) {
							$.ajax({
								url: window.location,
								type: "post",
								data: {
									agmt_no: agreementNo
								},
								success: function(response) {
									// alert("sent");
								},
								error: function(error) {
									console.error(error);
								}
							});
						} else {
							alert("Agreement Number not selected.");
						}

					});
				</script>
				<script>
					async function pdf_generation_check(id) {
						var res;
						await $.post("/cc/AjaxCustom/OtherPortNOC", {
								agg_no: id
							})
							.done(function(data) {
								console.log("inside pdf_generation_check");
								console.log(data);
								res = data;
								// var result = data;
								// return result;
								// console.log(result);

							});
						return res;
					}

					function pdf_generation(id) {
						$.post("/cc/AjaxCustom/OtherPortNOC", {
								agg_no: id
							})
							.done(function(data) {

								console.log("inside pdf_generation");
								console.log(data);
								// console.log("data1");
								if (data == "no data found") {
									// console.log("data2");
									alert("Other Portfolio NDC Not Available for this Agreement Number")
									// console.log("data3");
								} else {
									// console.log($test);

									var bin = atob(data);
									// console.log('File Size:', Math.round(bin.length / 1024), 'KB');
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
										link.download = 'NDC Form.pdf';
										link.href = 'data:application/octet-stream;base64,' + data;
										// document.body.appendChild(link);
										link.click();
									} else {
										alert("No File Found")
									}
								}


							});
					}

					//Prefilled ECS Mndate strats
					$("#i_detailm").change(function() {
						let agg_no = $("#i_detailm").value;
						console.log('a value'.a);
						console.log('a value changed'.a);
						if (a != "") {
							$.post("/cc/AjaxCustom/prefilled_mandate", {
									agg_no: agg_no
								})
								.done(function(data) {
									if (data != 'no data found') {
										console.log('data'.data);
										var bin = atob(data);
										console.log('File Size:', Math.round(bin.length / 1024), 'KB');
										if (Math.round(bin.length / 1024)) {
											document.getElementById('showresult_mandate').style.display = "block";
										}
									} else {
										console.log('api down');
										document.getElementById('showresult_mandate').style.display = "none";
									}

								});


						}
					});
					//Prefilled ECS Mndate strats
				</script>
			</div>

		</fieldset>
	</form>
	<p>&nbsp;</p>

</body>

</html>



<!-- <p>&nbsp;</p> -->