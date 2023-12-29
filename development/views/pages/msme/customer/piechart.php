<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="tvs_header.php" clickstream="employee-login"/>
   
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
	<br><br>
	<div id="incident_list">
	
	</div>
	
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script  src="https://code.jquery.com/jquery-3.1.1.js"  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="  crossorigin="anonymous"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.charts.load('current', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
      
    function drawChart() {
      var jsonData = $.ajax({
          url: "/cc/AjaxCustom/getPieData",
          dataType: "json",
          async: false
          }).responseText;
          
		  console.log(jsonData);
      // Create our data table out of JSON data loaded from server.
      //var data = new google.visualization.DataTable(jsonData);
		var data = google.visualization.arrayToDataTable($.parseJSON(jsonData));
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, {width: 800, height: 400});
	  
	  //code for click event
	  google.visualization.events.addListener(chart, 'select', selectHandler); 

    function selectHandler(e)     {   
        var inc_status = data.getValue(chart.getSelection()[0].row, 0);
		$.post( "/cc/AjaxCustom/getPieInc", {incident_st : inc_status})
													 .done(function( data ) {
														  console.log(data);
														  $('#incident_list').html(data);
											});
									}
	  //code for click event

    }

    </script>