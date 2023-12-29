<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="standard.php" login_required="true" force_https="true" />

<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('customer');
$contact_id=$CI->session->getProfileData("c_id");
$contact_type=$CI->session->getSessionData("userProfile");


//print_r($contact_type);
//echo "good";
//$conftact_id = 3;
//print_r($this->session->getProfile() );
?>
<script type="text/javascript">
	// console.log('i am here');
	var mlogin = localStorage.getItem("m_login");
		var rcpull = localStorage.getItem("rcpull");
	if(mlogin=="1")
	{
		
	location.href = "https://tvscs.custhelp.com/app/account/profile?mlogin=1";   

	}
	if(rcpull=="1")
	{
		
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
	  
      <link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link  href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700" rel="stylesheet">
 <!-- <link  href="/euf/assets/themes/standard/css/style.css" rel="stylesheet"> -->
      <!-- <link  href="/euf/assets/themes/standard/css/style-product.css" rel="stylesheet"> -->
	  <!-- <link  href="/euf/assets/themes/standard/css/customerlogin-style.css" rel="stylesheet"> -->
	<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />

<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"> </script>

<div class="rn_Hero">
    <div class="rn_Container">
        <h1 id="newt">Dashboard</h1>
    </div>
</div>
<p>&nbsp;</p>
<div class="rn_PageContent rn_AccountOverview rn_Container_dash">
    <div class="rn_ContentDetail full_width">
<?php
	$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
	$report_id=$msg->Value;
	//$report_id = '100066';
	if($report_id>0){
		$filter=array('ContactID'=>$contact_id);
		$report_result=report_result($report_id,$filter);
		//print_r($report_result);
		if(count($report_result) > 0){
		
			?>	
	<table id="proposal_no" class="table display table-bordered " cellspacing="0" style="width: 100%">
						<thead>
							<tr>
								<th>Prospect <br/>Number</th>
								<th>Prospect <br/>Status</th>
								<th>Agreement <br/>No</th>
								<th>Last EMI <br/>Date</th>
								<th>Monthly Due</th>
								<th>Interest Rate</th>
								<th>EMI Amount</th>
								<th>Payment Mode</th>
								<th>Remaining <br/>Principal</th>
								<th>Loan Status</th>
								<th>Tenor</th>
								<th>Ins Amount</th>
								<th>Loan Amount</th>
							</tr>
						</thead>
							<tbody>
								<?php
									$i=0;
									foreach($report_result as $res){

										$prospect_no=$report_result[$i]['Prospect No'];
										$loan_status=$report_result[$i]['Loan Status'];
										$agg_no=$report_result[$i]['Agreement No'];
										?>
										<tr <?php if($i==0){ echo 'data-expanded="true"';}?> >
											<td align="center">
											<?php 
											if(!empty($prospect_no) && !empty($agg_no)){
												echo "<a href='/app/customer/prospectview/p_id/$prospect_no_$agg_no'>".$prospect_no."</a>";
										}elseif(!empty($prospect_no) && empty($agg_no)){
											//	echo "<a href='/app/customer/prospectview/p_id/$prospect_no'>".$prospect_no."</a>";
												echo $prospect_no;
										}elseif(empty($prospect_no) && !empty($agg_no)){
												echo "<a href='/app/customer/prospectview/p_id/_$agg_no'>".$prospect_no."</a>";
										}else{
                                                echo "<p>n/a</p>";
												continue;
										}
												?></td>
											<td align="center" ><?php echo $loan_status;?></td>
										<?php
										if(!empty($agg_no)){?>
											<td align="center" ><?php echo $agg_no;?></td>
										<?php }else{?>
											<td align="center" >n/a</td>
										<?php }?>
											<?php if($agg_no!= null) {
												echo "<script>$.post( '/cc/AjaxCustom/rest_api_call_drop',{ ag_no : '".$agg_no."'})
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
											<td align="center"  id="second<?php echo $i; ?>"></td>
											<td align="center" id="third<?php echo $i; ?>"></td>
											<td align="center"  id="fourth<?php echo $i; ?>"></td>
											<td align="center"  id="fifth<?php echo $i; ?>"></td>
											<td align="center"  id="sixth<?php echo $i; ?>"></td>
											<td align="center"  id="seventh<?php echo $i; ?>"></td>
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
					}
					else{
						echo '<p> No Result Found</p>';
					}
	}else{
		echo '<p> No Data Found</p>';
	}
	?>
    </div>
    
</div>
<script>
        jQuery(document).ready(function ($) {
            

            $('#proposal_no').DataTable({
				// "responsive": true,
				"scrollX":true
			});
        });
    </script>