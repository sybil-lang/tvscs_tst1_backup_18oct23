<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="standard.php" login_required="true" force_https="true" />

<?php
$CI = &get_instance();
$CI->load->helper('report');

checkCustomerType('customer');
$contact_id = $CI->session->getProfileData("c_id");

$contact_type = $CI->session->getSessionData("userProfile");

$status_filter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
$status_filter->Name = 'contactId';
$status_filter->Values = array($contact_id);
// $status_filter->Values = array(3140700);
$filters =  new \RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
$filters[] = $status_filter;

$ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch(100925);
$arr = $ar->run(0, $filters);
$arrcount = $arr->count();
$nrows = $arr->count();
$Date = date('Y-m-d');
// echo $nrows;


// echo 'before loop';
// echo 'nrows'.$nrows;
// 	echo 'arrcount'.$arrcount;
	
$i = 0;
while ($i <= $nrows) {
	// echo 'nrows'.$nrows;
	// echo 'arrcount'.$arrcount;
	$row = $arr->next();
	//print_r($row);
	$d = $row['PLPopupCancelledOn'];
	$date = explode(' ', $d);
	$cancelledon = $date[0];
	$cancelledon = str_replace("'", "", $cancelledon);
	$d1 = $row['PLApprovedPlus30days'];
		$date1 = explode(' ', $d1);

		$plapprovedplus30days = $date1[0];
		$plapprovedplus30days = str_replace("'","",$plapprovedplus30days);
	// echo 'cancelledon' . $cancelledon;
	// echo 'currdaate'.date('Y-m-d');
	// echo 'plapproveplus30' . $plapprovedplus30days;
	//die("debug");

	if ($cancelledon != date('Y-m-d') && (date('Y-m-d') >  $plapprovedplus30days ||  ($row['PLApprovedDate'] == null || $row['PLApprovedDate'] == ""))) {
		// echo 'popupcan' . $cancelledon . '|';
		// echo 'currdate' . date('Y-m-d') . '|';
		// echo 'expirydate' . $row['Expiry Date'] . '|';
		// echo 'flag' . $row['Personal Loan Eligible Flag'] . '|';
		// $d1 = $row['PLApprovedPlus30days'];
		// $date1 = explode(' ', $d1);

		// $plapprovedplus30days = $date1[0];
		if ($row['Personal Loan Eligible Flag'] == "Yes" && $row['Expiry Date'] > date('Y-m-d')  && (date('Y-m-d') >  $plapprovedplus30days ||  ($row['PLApprovedDate'] == null || $row['PLApprovedDate'] == ""))) {
			// echo 'PL approved+30' . $plapprovedplus30days;
			// echo 'here3';
			$loan_amount = $row['Top_Up_Eligible_Value'];
			//echo $loan_amount;
			$plmsg = 'You are eligible for a pre-Approved Personal Loan up to Rs. ' . $row['Top_Up_Eligible_Value'] . '.';


			// echo $plmsg;
			// echo $i;
			break;
		}
	}


	// echo "pre";
	// print_r($row);
	//echo $i;
	$i++;
}
//die("debug1");
//echo $contact_id;


//print_r($contact_type);
//echo "good";
//$conftact_id = 3;
//print_r($this->session->getProfile() );

// $contactid = $_POST['contact'];
        // $status_filterr = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
        // $status_filterr->Name = 'contactId';
        // $status_filterr->Values = array($contactid);

        // $filters = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
        // $filters[] = $status_filter;
		//echo 'report2';
 $ar2 = \RightNow\Connect\v1_3\AnalyticsReport::fetch(100927);
        $arr = $ar2->run(0, $filters);
        $nrows = $arr->count();
        $first_name = "";
        $mobileno = "";
        $citycode = "";
        $statecode = "";
        //echo 'nrows'.$nrows;
        while ($nrows) {
            $row = $arr->next();
            $first_name = $row['First Name'];
            $mobileno = $row['Mobile Phone'];
            $citycode = $row['City Code'];
            $statecode = $row['State Code'];
            //   echo "<pre>";
            //     print_r($row);
            // echo $first_name;
			// echo $mobileno;
			// echo $citycode;
			// echo $statecode;
            break;
        }
?>
<script type="text/javascript">
	// console.log('i am here');
	//document.getElementById("plpopmsg").style.display = "none";


	var mlogin = localStorage.getItem("m_login");
	var rcpull = localStorage.getItem("rcpull");
	if (mlogin == "1") {

		location.href = "https://tvscs.custhelp.com/app/account/profile?mlogin=1";

	}
	if (rcpull == "1") {

		location.href = "https://tvscs.custhelp.com/app/customer/selfserviceview";
	}
</script>
<!-- Zozo Tabs css -->
<link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />

<!-- Zozo Tabs Flat Themes css -->
<link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />

<!-- Zozo Tabs js -->
<script src="/euf/assets/themes/standard/js/jquery.min.js"></script>
<script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

<!-- Datatable CSS and JAVAScript -->

<!-- <rn:theme path="/euf/assets/themes/standard/css" css="site.css,style.css,styles.css,style-product.css,select.dataTables.min.css,dataTables.bootstrap.min.css,customerlogin-style.css,custom_dashboard.css,buttons.dataTables.min.css,bootstrap-datetimepicker.min.css"/> -->
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<!-- <link rel="stylesheet" href="/euf/assets/themes/standard/css/font-awesome.min.css"> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700" rel="stylesheet">
<!-- <link  href="/euf/assets/themes/standard/css/style.css" rel="stylesheet"> -->
<!-- <link  href="/euf/assets/themes/standard/css/style-product.css" rel="stylesheet"> -->
<!-- <link  href="/euf/assets/themes/standard/css/customerlogin-style.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"> </script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"> </script>
<style type="text/css">
	.modal-content {
		height: 400px;
		position: fixed;
		top: -30px;
		width: 95%;
		overflow-y: hidden;
	}
</style>

<div class="rn_Hero">
	<div class="rn_Container">
		<h1 id="newt">Dashboard</h1>
	</div>
</div>
<p>&nbsp;</p>




<div class="rn_PageContent rn_AccountOverview rn_Container_dash">
	<div class="rn_ContentDetail full_width">
		<?php
		$msg = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
		$report_id = $msg->Value;
		//$report_id = '100066';
		if ($report_id > 0) {
			$filter = array('ContactID' => $contact_id);
			$report_result = report_result($report_id, $filter);
			//print_r($report_result);
			if (count($report_result) > 0) {

		?>
				<table id="proposal_no" class="table display table-bordered " cellspacing="0" style="width: 100%">
					<thead>
						<tr>
							<th>Prospect <br />Number</th>
							<th>Prospect <br />Status</th>
							<th>Agreement <br />No</th>
							<th>Last EMI <br />Date</th>
							<th>Monthly Due</th>
							<th>Interest Rate</th>
							<th>EMI Amount</th>
							<th>Payment Mode</th>
							<th>Remaining <br />Principal</th>
							<th>Loan Status</th>
							<th>Tenor</th>
							<th>Ins Amount</th>
							<th>Loan Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($report_result as $res) {

							$prospect_no = $report_result[$i]['Prospect No'];
							$loan_status = $report_result[$i]['Loan Status'];
							$agg_no = $report_result[$i]['Agreement No'];
						?>
							<tr <?php if ($i == 0) {
									echo 'data-expanded="true"';
								} ?>>
								<td align="center">
									<?php
									if (!empty($prospect_no) && !empty($agg_no)) {
										echo "<a href='/app/customer/prospectview/p_id/$prospect_no_$agg_no'>" . $prospect_no . "</a>";
									} elseif (!empty($prospect_no) && empty($agg_no)) {
										//	echo "<a href='/app/customer/prospectview/p_id/$prospect_no'>".$prospect_no."</a>";
										echo $prospect_no;
									} elseif (empty($prospect_no) && !empty($agg_no)) {
										echo "<a href='/app/customer/prospectview/p_id/_$agg_no'>" . $prospect_no . "</a>";
									} else {
										echo "<p>n/a</p>";
										continue;
									}
									?></td>
								<td align="center"><?php echo $loan_status; ?></td>
								<?php
								if (!empty($agg_no)) { ?>
									<td align="center"><?php echo $agg_no; ?></td>
								<?php } else { ?>
									<td align="center">n/a</td>
								<?php } ?>
								<?php if ($agg_no != null) {
									echo "<script>$.post( '/cc/AjaxCustom/rest_api_call_drop',{ ag_no : '" . $agg_no . "'})
																		 .done(function( data ) {
																			 var json_data = JSON.parse(data);
																			 //console.log(data);
																			  $( '#first$i' ).html(json_data.first);
																			  $( '#second$i' ).html(json_data.second);
																			  $( '#third$i' ).html(json_data.third);
																			  $( '#fourth$i' ).html(json_data.fourth);
																			  $( '#fifth$i' ).html(json_data.fifth);
																			  $( '#sixth$i' ).html(json_data.sixth);
																			  $( '#seventh$i' ).html(json_data.seventh);
																			  $( '#eigth$i' ).html(json_data.eigth);
																			  $( '#ninth$i' ).html(json_data.ninth);
																			  $( '#tenth$i' ).html(json_data.tenth);
																	 
															 }); </script>";
								} ?>
								<td align="center" id="first<?php echo $i; ?>"></td>
								<td align="center" id="second<?php echo $i; ?>"></td>
								<td align="center" id="third<?php echo $i; ?>"></td>
								<td align="center" id="fourth<?php echo $i; ?>"></td>
								<td align="center" id="fifth<?php echo $i; ?>"></td>
								<td align="center" id="sixth<?php echo $i; ?>"></td>
								<td align="center" id="seventh<?php echo $i; ?>"></td>
								<td align="center" id="eigth<?php echo $i; ?>"></td>
								<td align="center" id="ninth<?php echo $i; ?>"></td>
								<td align="center" id="tenth<?php echo $i; ?>"></td>
							</tr>
						<?php
							$i++;
						}
						?>
					</tbody>
				</table>
		<?php
			} else {
				echo '<p> No Result Found</p>';
			}
		} else {
			echo '<p> No Data Found</p>';
		}
		?>
	</div>

</div>
<!--Modal addtion for popup msg  -->
<!-- <div class="container"  >
  <h2>Modal Example</h2>
  
  <button type="button" id="plpopup" class="btn btn-info btn-lg" data-toggle="modal" type="hidden" data-target="#myModal">Open Modal</button>

  
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div> -->


<!-- Modal -->
<div class="container">
	<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
		<div class="modal-content" style="overflow-y: hidden; height: 237px; position: fixed; top: -30px; width: 389px;">
            <!-- <div class="modal-content" style="height: 317px; overflow-y: hidden;"> -->
				<!-- <div class="modal-header">
					 <h5 class="modal-title" id="staticBackdropLabel">PL Enquiry Popup</h5> 
				</div> -->
				<div class="modal-body">
					<h1 id="testH1"></h1>
				</div>
				<style type="text/css">
				
					.btn-default {
						background-color: black;
						color: white;
					}

					.btn-default:hover {
						color: black;
						background-color: white;
					}
				</style>
				<div class="modal-footer">
					<button type="button" id="btn_applynow" class="btn btn-success" style="margin:2px; border-radius: 30px;margin-top: 2px;width: 48%;">Apply Now</button>
					<button type="button" class="btn btn-danger" id="btn_cancel" style="border-radius: 30px;margin-top: 2px;width: 48%;" data-dismiss="modal">Cancel</button>
					
				</div>
			</div>
		</div>
	</div>
</div>




<div class="container">
	<div class="modal fade" id="myModalforApplyNow" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content" style="overflow-y: hidden;height: 349px;">


			<div class="modal-header">

				<h5 class="modal-title" id="staticBackdropLabel">Pre-Approved Amount</h5>
			</div>
			<div class="modal-body" style="height:auto;">
				<p>Welcome! You have a Pre-Approved Amount loan upto <span id="amount"></span></p>
				<form>
					<div class="form-group">
						<label>Enter loan amount.</label>
						<input type="text" class="form-control" id="inputName" />
						<label id="Warning" style="color:red; display:none;">Please enter a value greater than 1000 & less than approved loan amount.</label>

					</div>

				</form>
			</div>
			<div class="modal-footer" style="text-align: center;">
				<button type="button" class="btn btn-success" style="margin:2px; border-radius: 30px;margin-top: 2px;width: 48%;" id="btn_LoanApplied">Apply Now</button>
				
			</div>
		</div>

	</div>
</div>

</div>


<!-- <div class="modal fade" id="LoanAmountBeyoundRange" role="dialog">
    <div class="modal-dialog">
    
      
      <div class="modal-content">
        <div class="modal-header">
        
		<h5 class="modal-title" id="staticBackdropLabel">PL Application Confirmation</h5>
        </div>
        <div class="modal-body">
          <p>Please enter the</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
        </div>
      </div>
      
    </div>
  </div> -->

<div class="modal fade" id="myModalforApplyNow2" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content" style="height: 245px;overflow-y: hidden;">
			<div class="modal-header">

				<h5 class="modal-title" id="staticBackdropLabel">PL Application Confirmation</h5>
			</div>
			<div class="modal-body">
				<p>Thanks for your interest in pre-approved personal loan. Our executive will get in touch with you shortly</p>
			</div>
			<div class="modal-footer" style="text-align: center;">
				<button type="button"  style="background-color: #115184;color: white;margin:2px;height: 29px; border-radius: 30px;margin-top: 2px;width: 48%;" data-dismiss="modal">Ok</button>
			</div>
		</div>

	</div>
</div>

</div>


<div class="modal fade" id="myModalforApplyNow3" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content" style="height: 245px;overflow-y: hidden;">
			<div class="modal-header">

				<h5 class="modal-title" id="staticBackdropLabel">PL Application Error</h5>
			</div>
			<div class="modal-body">
				<p>There has been some error with your request.Please try again later.</p>
			</div>
			<div class="modal-footer" style="text-align: center;">
				<button type="button" style="background-color: #115184;color: white;margin:2px;height: 29px; border-radius: 30px;margin-top: 2px;width: 48%;" data-dismiss="modal">Ok</button>
			</div>
		</div>

	</div>
</div>

</div>
<!--Modal addtion for popup msg  -->
<script>
	jQuery(document).ready(function($) {
	   c = '<?php echo  $plmsg; ?>';

		if (c != null && c != "") {

             
			//document.getElementById("plpopup").click();
			//$('#myModal').show();
			$("#staticBackdrop").modal();
			document.getElementById('testH1').innerHTML = c;
			//$('#myModal').modal('show');
			//$('#plpopup').hide();

		}



		$('#btn_cancel').click(function() {
			
			// $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
			// $contact->CustomFields->c->pl_popup_cancelledon = date('2022-11-02');
			// $contact->save();
			

var contact_id = '<?php echo $contact_id; ?>';
                $.post("/cc/AjaxCustom/UpdatePLCancelledOn", {
					contact_id: contact_id
					})
			console.log('cancel');
		});

		$('#btn_applynow').click(function() {

			ShowApplyNowConfirmation();
		    document.getElementById('amount').innerHTML = '<?php echo  $loan_amount; ?>';
			$('#staticBackdrop').modal('hide');
			console.log('apply now');

		});

		//
		// $contactid = $_POST['contact'];
        // // $status_filter1 = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
        // // $status_filter->Name = 'contactId';
        // $status_filter->Values = array($contactid);

        // // $filters = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
        // $filters[] = $status_filter;

        // $ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch(100927);
        // $arr = $ar->run(0, $filters);
        // $nrows = $arr->count();
        // $first_name = "";
        // $mobileno = "";
        // $citycode = "";
        // $statecode = "";
        // //echo 'nrows'.$nrows;
        // while ($nrows) {
        //     $row = $arr->next();
        //     $first_name = $row['First Name'];
        //     $mobileno = $row['Mobile Phone'];
        //     $citycode = $row['City Code'];
        //     $statecode = $row['State Code'];
        //     //   echo "<pre>";
        //     //     print_r($row);

        //     break;
        // }
		// ?>

		$('#btn_LoanApplied').click(function() {
			
			var loanamount = '<?php echo  $loan_amount; ?>';
			console.log(loanamount);
			var d = $("#inputName").val();
			loanamount= Number(loanamount);
			if (d < loanamount && d > 1000 ) {
				$("#Warning").css("display", "none");
                document.getElementById('btn_LoanApplied').disabled = true;
                

				var first_name = '<?php echo $first_name; ?>';
				var mobileno = '<?php echo $mobileno; ?>';
				var citycode = '<?php echo $citycode; ?>';
				var statecode = '<?php echo $statecode; ?>';

				$.post("/cc/AjaxCustom/InsertLMSDataPL", {
					first_name: first_name,
					mobileno:mobileno,
					citycode:citycode,
					statecode:statecode
					})
					.done(function(data) {
						var somedata = data;
						console.log(data);
						somedata = somedata.replace(/null/g, '\"-\"');
						// somedata.replaceAll("null", "\"-\"");
						try
						{

						var main_data = JSON.parse(somedata);

						console.log(main_data);

						if (main_data['Lead_Status'] == "DROPPED" || main_data['Lead_Status'] == "NEW") {
						
						// 	$contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
						//    $contact->CustomFields->c->pl_approved_date = date('Y-m-d');
						//    $contact->save();
						
						var contact_id = '<?php echo $contact_id; ?>';
                $.post("/cc/AjaxCustom/UpdatePLApprovedOn", {
					contact_id: contact_id
					})


							console.log('applied api');
							$("#myModalforApplyNow2").modal();
							$('#myModalforApplyNow').modal('hide');

						} 
						else {

							$("#myModalforApplyNow3").modal();
							$('#myModalforApplyNow').modal('hide');


						}
					}
					catch(err)
					{
						$('#myModalforApplyNow').modal('hide');
						$("#myModalforApplyNow3").modal();
						console.log(err.message);
					}

                       


					});






			} else {
				$("#Warning").css("display", "block");
				//$("#Warning").text("Please enter a loan amount value less than ".loanamount);
				// $("#LoanAmountBeyoundRange").modal();
			}

		});













		function ShowApplyNowConfirmation() {
			$("#myModalforApplyNow").modal();
		}

		$('#proposal_no').DataTable({
			// "responsive": true,
			"scrollX": true
		});


	});
</script>