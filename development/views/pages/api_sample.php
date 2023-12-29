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
		<h1>Get Customer details in Json format</h1>
		<?php
		
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
		/*Get Result in Json formate*/
		?>
		
		<h1>Get Customer details in HTML format</h1>
		<?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?agreementNo=TN3000CA0000258&methodName=getCustomerDetails';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in Json formate*/
		?>
		<hr>
		<?php
		
		/*Get Result in Json formate*/
		?>
		<h1>Get DUE & LAST PAYMENT DETAILS in Json format</h1>
		<?php
		
		$ch = curl_init('http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getLastPaymentDetails,agreementNo:TN3000CA0000258}');
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
		
		<h1>Get DUE & LAST PAYMENT DETAILS in HTML format</h1>
		<?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?agreementNo=TN3000CA0000258&methodName=getLastPaymentDetails';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in Json formate*/
		?>
		<hr>
		<?php
        /*Get Result in Json formate*/
		?>
		<h1>Get - DOWN PAYMENT in Json format</h1>
		<?php
		
		$ch = curl_init('http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getDownPaymentDetails,prospectNo:3000CA00405}');
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
		
		<h1>Get - DOWN PAYMENT in HTML format</h1>
		<?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?prospectNo=3000CA00405&methodName=getDownPaymentDetails';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in Json formate*/
		?>
		<hr>
		<?php 
		
		
		 /*Get Result in Json formate*/
		?>
		<h1>Get - LOAN STATUS & OTHER DETAILS in Json format</h1>
		<?php
		
		$ch = curl_init('http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getLoanStatusandOtherDetails,agreementNo:TN3000CA0000258}');
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
		
		<h1>Get - LOAN STATUS & OTHER DETAILS in HTML format</h1>
		<?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?agreementNo=TN3000CA0000258&methodName=getLoanStatusandOtherDetails';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in Json formate*/
		?>
		<hr>
		<?php 
		
		
		
		 /*Get Result in Json formate*/
		?>
		<h1>Get - INSURANCE DETAILS in Json format</h1>
		<?php
		
		$ch = curl_init('http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getInsuranceDetails,agreementNo:TN3000CA0000258}');
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
		
		<h1>Get - INSURANCE DETAILS in HTML format</h1>
		<?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?agreementNo=TN3000CA0000258&methodName=getInsuranceDetails';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in Json formate*/
		?>
		<hr>
		<?php 
		
		
		 /*Get Result in Json formate*/
		?>
		<h1>Get - ALL TRANSACTION in Json format</h1>
		<?php
		
		$ch = curl_init('http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getAllNotepadTransactions,agreementNo:TN3000CA0000258}');
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
		
		<h1>Get - ALL TRANSACTION in HTML format</h1>
		<?php
		/*Get Result in HTML formate*/
		$url='http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml?agreementNo=TN3000CA0000258&methodName=getAllNotepadTransactions';
		$result=file_get_contents($url);
		# Print response.
		echo $result;
		/*Get Result in Json formate*/
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
