<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php" clickstream="home"/>
<div class="rn_PageContent rn_Home"> 
  <!--Rest API Call using curl Starts here-->
  <?php
	require_once(get_cfg_var('doc_root').'/include/ConnectPHP/Connect_init.phph');
	initConnectAPI();
	load_curl();
	try{
		/*Get Result in Json formate*/
		?>
  <h1>Get PDD Ageing Details in JSon format</h1>
  <?php
		$data = array("methodName" => "getPDDAgeingDetails", "startDate" => "01/01/2005","endDate" => "01/01/2020", "dealerCode" => "1635");
		$data_string = json_encode($data,JSON_UNESCAPED_SLASHES);
		$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=".rawurlencode($data_string); 
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		 
		$result = curl_exec($ch);
		$data_decode=json_decode($result);
		echo "<br><pre>";
		print_r($data_decode);
		echo "</pre><br>";
		$curlerror = curl_error($ch);
		if($curlerror){
			echo "<br>CURL Error:".$curlerror;
		}
		curl_close($ch);
		
		/*Get Result in Json formate*/
		?>
  <hr>
  <h1>Get PDD Ageing Details in HTML format</h1>
  <?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?methodName=getPDDAgeingDetails&startDate=01/01/2005&endDate=01/01/2020&dealerCode=1635';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in HTML formate*/
		
		
		
		
		?>
  <hr>
  <?php
		
		/*Get Result in Json formate*/
		?>
  <h1>Get PDD Ageing Summary in JSon format</h1>
  <?php
		$data = array("methodName" => "getPDDAgeingSummary", "startDate" => "01/01/2005","endDate" => "01/01/2020", "dealerCode" => "1635");
		$data_string = json_encode($data,JSON_UNESCAPED_SLASHES);
		$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=".rawurlencode($data_string); 
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		 
		$result = curl_exec($ch);
		$data_decode=json_decode($result);
		echo "<br><pre>";
		print_r($data_decode);
		echo "</pre><br>";
		$curlerror = curl_error($ch);
		if($curlerror){
			echo "<br>CURL Error:".$curlerror;
		}
		curl_close($ch);
		/*Get Result in Json formate*/
		?>
  <hr>
  <h1>Get PDD Ageing Summary in HTML format</h1>
  <?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?methodName=getPDDAgeingSummary&startDate=01/01/2005&endDate=01/01/2020&dealerCode=1635';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in HTML formate*/
		
		
		
		
		?>
  <hr>
  <?php
		
		
		/*Get Result in Json formate*/
		?>
  <h1>Get Sales Disbursed Details in JSon format</h1>
  <?php
		$data = array("methodName" => "getSalesDisbursedDetails", "startDate" => "01/01/2005","endDate" => "01/01/2020", "dealerCode" => "1635");
		$data_string = json_encode($data,JSON_UNESCAPED_SLASHES);
		$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=".rawurlencode($data_string); 
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		 
		$result = curl_exec($ch);
		$data_decode=json_decode($result);
		echo "<br><pre>";
		print_r($data_decode);
		echo "</pre><br>";
		$curlerror = curl_error($ch);
		if($curlerror){
			echo "<br>CURL Error:".$curlerror;
		}
		curl_close($ch);
		
		/*Get Result in Json formate*/
		?>
  <hr>
  <h1>Get Sales Disbursed Details in HTML format</h1>
  <?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?methodName=getSalesDisbursedDetails&startDate=01/01/2005&endDate=01/01/2020&dealerCode=1635';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in HTML formate*/
		
		
		
		
		?>
  <hr>
  <?php
		
		
		
		
		/*Get Result in Json formate*/
		?>
  <h1>Get Sales Disbursed Count in JSon format</h1>
  <?php
		$data = array("methodName" => "getSalesDisbursedCount", "startDate" => "01/01/2005","endDate" => "01/01/2005", "dealerCode" => "1635");
		$data_string = json_encode($data,JSON_UNESCAPED_SLASHES);
		$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=".rawurlencode($data_string); 
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		 
		$result = curl_exec($ch);
		$data_decode=json_decode($result);
		echo "<br><pre>";
		print_r($data_decode);
		echo "</pre><br>";
		$curlerror = curl_error($ch);
		if($curlerror){
			echo "<br>CURL Error:".$curlerror;
		}
		curl_close($ch);
		
		
		/*Get Result in Json formate*/
		?>
  <hr>
  <h1>Get Sales Disbursed Count in HTML format</h1>
  <?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?methodName=getSalesDisbursedCount&startDate=01/01/2005&endDate=01/01/2020&dealerCode=1635';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in HTML formate*/
		
		
		
		
		?>
  <hr>
  <?php
		/*Get Result in Json formate*/
		?>
  <h1>Get Sales Performance Summary in JSon format</h1>
  <?php
		$data = array("methodName" => "getSalesPerformanceSummary", "startDate" => "01/01/2005","endDate" => "01/01/2020", "dealerCode" => "1635");
		$data_string = json_encode($data,JSON_UNESCAPED_SLASHES);
		$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=".rawurlencode($data_string); 
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		 
		$result = curl_exec($ch);
		$data_decode=json_decode($result);
		echo "<br><pre>";
		print_r($data_decode);
		echo "</pre><br>";
		$curlerror = curl_error($ch);
		if($curlerror){
			echo "<br>CURL Error:".$curlerror;
		}
		curl_close($ch);
		
		/*Get Result in Json formate*/
		?>
  <hr>
  <h1>Get Sales Performance Summary in HTML format</h1>
  <?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?methodName=getSalesPerformanceSummary&startDate=01/01/2005&endDate=01/01/2020&dealerCode=1635';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in HTML formate*/
		
		?>
  <h1>Get Sales Performance Details in JSon format</h1>
  <?php
		/*Get Result in Json formate*/
		$data = array("methodName" => "getSalesPerformanceDetails", "startDate" => "01/01/2005","endDate" => "01/01/2020", "dealerCode" => "1635");
		$data_string = json_encode($data,JSON_UNESCAPED_SLASHES);
		$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=".rawurlencode($data_string); 
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		 
		$result = curl_exec($ch);
		$data_decode=json_decode($result);
		echo "<br><pre>";
		print_r($data_decode);
		echo "</pre><br>";
		$curlerror = curl_error($ch);
		if($curlerror){
			echo "<br>CURL Error:".$curlerror;
		}
		curl_close($ch);
		
		
		/*Get Result in Json formate*/
		?>
  <hr>
  <h1>Get Sales Performance Details in HTML format</h1>
  <?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?methodName=getSalesPerformanceDetails&startDate=01/01/2005&endDate=01/01/2020&dealerCode=1635';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in HTML formate*/
		?>
  <hr>
  <?php
		
		                                                                                  
   	}
	catch(Exception $e){
		echo "Error: " .$e->getMessage()."| Line No.: ".$e->getLine();	
	}
	?>
  <!--Rest API Call using curl Ends here--> 
</div>
