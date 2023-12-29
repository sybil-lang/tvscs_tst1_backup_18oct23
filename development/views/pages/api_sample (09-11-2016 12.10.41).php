<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php" clickstream="home"/>


<div class="rn_PageContent rn_Home">
    <!--Rest API Call using curl Starts here-->
    <?php
	require_once(get_cfg_var('doc_root').'/include/ConnectPHP/Connect_init.phph');
	initConnectAPI();
	load_curl();
	try{
		$ch = curl_init('http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getCustomerDetails,agreementNo:TN3000CA0000258}');
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
   	}
	catch(Exception $e){
		echo "Error: " .$e->getMessage()."| Line No.: ".$e->getLine();	
	}
	?>
    <!--Rest API Call using curl Ends here-->
</div>
