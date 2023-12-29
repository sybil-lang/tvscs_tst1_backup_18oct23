<html>
<head>
</head>
<body>
<?php
require_once(get_cfg_var('doc_root').'/include/ConnectPHP/Connect_init.phph');
initConnectAPI();
require_once ('/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php');
$retval = RightNow\Libraries\AbuseDetection::check();
function soap_call($functionName, $arrparam){
	$url = 'http://leadsuatservice.tvscredit.com/TVSCSLMSAPI.svc?wsdl';
	$client = new nusoap_client($url,'wsdl');
	$client->soap_defencoding = 'UTF-8';
	$param=array('parameters'=>$arrparam);
	$response = $client->call($functionName, $param);
	$soapError = $client->getError();
	if (!empty($soapError)){
		echo 'SOAP method invocation failed:'.$soapError;
	}
	else{
		if(is_array($response)){	
			return $response;
		}
		else{
			return $response;	
		}
	}
}
print_r($_GET);
$result='';
if($year){
	$VMakeList= $this->soap_call('getVMakeList', array('Year'=>$year,'AgencyCode'=>'TVSCRM'));
	$VMakeListArray=$VMakeList['getVMakeListResult']['LMS_IBBMake_Entity'];
	$count=count($VMakeListArray);
	if($count > 0){
		foreach($VMakeListArray as $display){
			$value=$display['Make'];
			$display_text=$display['Make'];
			$result .= '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
		} 
		echo $result;
	}
}
?>
	</body>
</html>	