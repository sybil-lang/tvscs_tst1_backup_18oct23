<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="standard.php" login_required="true" force_https="true" />
<?php
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');

$contact_id=$CI->session->getProfileData("c_id");
/*$contact_id = 3;
//print_r($this->session->getProfile() );
require_once(get_cfg_var('doc_root').'/include/ConnectPHP/Connect_init.phph');
	initConnectAPI();
$contact = new RightNow\ Connect\ v1_3\ Contact(3);

    $contact->Login = 'narendrak';
    $contact->NewPassword = "123456";
    $contact->save();
*/
?>


 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script  src="https://code.jquery.com/jquery-3.1.1.js"  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="  crossorigin="anonymous"></script>

<!-- Datatable CSS and JAVAScript -->
	<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />

<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"> </script>

<script type="text/javascript">

// Load the Visualization API and the piechart package.
google.charts.load('current', {'packages':['corechart']});
  
// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);
  
function drawChart() {
  var jsonData = $.ajax({
	  url: "/cc/AjaxCustom/getPieData/",
	  dataType: "json",
	  async: false
	  }).responseText;
	  
	  console.log(jsonData);
  // Create our data table out of JSON data loaded from server.
  //var data = new google.visualization.DataTable(jsonData);
	var data = google.visualization.arrayToDataTable($.parseJSON(jsonData));
  // Instantiate and draw our chart, passing in some options.
  var chartobj = document.getElementById('chart_div');
  $('#chart_div').val('');
  var chart = new google.visualization.PieChart(chartobj);
  chart.draw(data, {width: 700, height: 400});
  
  //code for click event
  google.visualization.events.addListener(chart, 'select', selectHandler); 

	function selectHandler(e)     {   
		var inc_status = data.getValue(chart.getSelection()[0].row, 0);
		$('#incident_list').show();
	/*	$.post( "/cc/AjaxCustom/getPieInc", {incident_st : inc_status})
													 .done(function( data ) {
														  console.log(data);
														  $('#incident_list').html(data);
											});
									}*/
			var dataTable = $('#employee-grid').DataTable( {
				
				"ajax":{
					"url" :"/cc/AjaxCustom/getPieInc", // json datasource
					"dataSrc": "",
					"data": {
							status: inc_status,
							c_id: '<?php echo $contact_id;?>',
					},
				},
				"columns": [
						{ "data": "Incident ID" },
						{ "data": "Reference #" },
						{ "data": "Subject" },
						{ "data": "Status" },
						{ "data": "Date Raised" }
						],
						"bDestroy": true
			} );
	}
  //code for click event

}

</script>
<div class="rn_Hero">
    <div class="rn_Container">
        <h1>#rn:msg:ACCOUNT_OVERVIEW_LBL#</h1>
    </div>
</div>
<div class="rn_PageContent rn_AccountOverview rn_Container">
    <div class="rn_ContentDetail">
			<div class="rn_HeaderContainer">
							<h2><a>Incident Report</a></h2>
			 </div>
			<div id="chart_div" ><img src="images/loading-chart.gif" width="50" height="50"></div>
			<div id="incident_list" style="display:none";>
				<table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="table display table-bordered  nowrap" width="100%">
					<thead>
						<tr>
							<th>Incident ID</th>
							<th>Reference #</th>
							<th>Subject</th>
							<th>Status</th>
							<th>Date Raised</th>
						</tr>
					</thead>
			</table>
			</div>
		</div>
		<div class="rn_SideRail">
        <div class="rn_Well">
            <h3>#rn:msg:LINKS_LBL#</h3>
            <ul>
                <li><a href="/app/account/profile#rn:session#">#rn:msg:UPDATE_YOUR_ACCOUNT_SETTINGS_CMD#</a></li>
                <rn:condition external_login_used="false">
                    <rn:condition config_check="EU_CUST_PASSWD_ENABLED == true">
                        <li><a href="/app/account/change_password#rn:session#">#rn:msg:CHANGE_YOUR_PASSWORD_CMD#</a></li>
                    </rn:condition>
                </rn:condition>
                <li><a href="/app/account/notif/list#rn:session#">#rn:msg:MANAGE_YOUR_NOTIFICATIONS_LBL#</a></li>
                <rn:condition is_active_social_user="true">
                        <li><a href="/app/public_profile/user/#rn:profile:socialUserID#">#rn:msg:VIEW_YOUR_PUBLIC_PROFILE_LBL#</a></li>
                </rn:condition>
            </ul>
        </div>
    </div>
</div>
<div class="rn_PageContent rn_AccountOverview rn_Container">
    <div class="rn_ContentDetail">
        <div class="rn_Questions">
            <rn:container report_id="196" per_page="4">
                <div class="rn_HeaderContainer">
                    <h2><a class="rn_Questions" href="/app/account/questions/list#rn:session#">#rn:msg:MY_SUPPORT_QUESTIONS_LBL#</a></h2>
                </div>
                <rn:widget path="reports/Grid" label_caption="<span class='rn_ScreenReaderOnly'>#rn:msg:YOUR_RECENTLY_SUBMITTED_QUESTIONS_LBL#</span>"/>
                <a href="/app/account/questions/list#rn:session#">#rn:msg:SEE_ALL_MY_SUPPORT_QUESTIONS_LBL#</a>
            </rn:container>
        </div>
        <div class="rn_Discussions">
            <rn:container report_id="15156" per_page="4">
                <div class="rn_HeaderContainer">
                    <h2><a class="rn_Discussions" href="/app/social/questions/list/author/#rn:profile:socialUserID#/kw/*#rn:session#">#rn:msg:MY_DISCUSSION_QUESTIONS_LBL#</a></h2>
                </div>
                <rn:widget path="reports/Grid" static_filter="User=#rn:profile:socialUserID#" label_caption="<span class='rn_ScreenReaderOnly'>#rn:msg:YOUR_RECENTLY_SUBMITTED_DISCUSSIONS_LBL#</span>"/>
                <a href="/app/social/questions/list/author/#rn:profile:socialUserID#/kw/*#rn:session#">#rn:msg:SEE_ALL_MY_DISCUSSION_QUESTIONS_LBL#</a>
            </rn:container>
        </div>
    </div>
    
</div>
