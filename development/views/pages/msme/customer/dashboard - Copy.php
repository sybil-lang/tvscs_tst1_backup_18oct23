<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="tvs_header.php" clickstream="employee-login"/>
<?php
checkLoggedIn('customer'); //check Logged-in or not
$CI=&get_instance();
$bundle=$CI->session->getSessionData("previouslySeenEmail");
$contact_id=$bundle['sess_contact_id'];
?>
<div class="container">
<div class="grid_12">
	<p>Customer Dashborad</p>
	
	<?php
	$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
	$report_id=$msg->Value;
	if($report_id>0){
		$filter=array('ContactID'=>$contact_id);
		$report_result=report_result($report_id,$filter);
		if(count($report_result) > 0){
			?>
			<table class="table">
				<thead>
					<tr>
						<th>Prospect Number</th><!-- data-breakpoints="xs" to show with + sign-->
						<th>Loan Status</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i=0;
				foreach($report_result as $res){
					$prospect_no=$report_result[$i]['Prospect No'];
					$loan_status=$report_result[$i]['Loan Status'];
					?>
					<tr <?php if($i==0){ echo 'data-expanded="true"';}?>>
						<td><?php echo $prospect_no;?></td>
						<td><?php echo $loan_status;?></td>
					</tr>
					<?php
					$i++;	
				}
			?>
			</tbody>
			</table>
			<?php
		}
		
	}
	?>
	
</div>
</div>
