<rn:meta title="Notification" template="dealer_header.php" clickstream="notification" login_required="true" force_https="true" />

<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('dealer');
?>
<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Notifications</h1>
    </div>
</div>
<div class="rn_PageContent rn_Profile rn_Container">

	<fieldset style="padding: 15px;">
	<?php
		  
		  try{
			  //echo "<br>Notification ID: ".getUrlParm("id");
		  	  $noti_id = getUrlParm("id");
			  $report_id = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Noti_report)->Value;
			  // echo "<br>Report ID:".$report_id;
	    	  $id_filter = new RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
		      $id_filter->Name = "ID";
		      $id_filter->Values= array("$noti_id");
		      

		      $filters = new RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
	          $filters[0] = $id_filter;
	          
			  $ar= RightNow\Connect\v1_3\AnalyticsReport::fetch($report_id);
			  $arr = $ar->run(0,$filters);
			  $nrows= $arr->count();
			  // echo "<br>Rows:".$nrows;
			  if ($nrows>0) 
			  {  	 $row = $arr->next();
				     for ( $ii = 0; $ii++ < $nrows; $row = $arr->next())
				     {
				     	echo "<h4>".$row["Name"]."</h4><br>";
				     	echo "<p>".$row["Description"]."</p>";
				     }
			  }
			  else{
			  	echo "<h4>No Notifications for now.</h4>";
			  }
		}
		catch(Exception $w){
			echo $w->getMessage();
		}
	?>
	</fieldset>
</div>