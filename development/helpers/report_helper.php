<?php
use \RightNow\Utils\Url,
        \RightNow\Utils\Framework,
        \RightNow\Utils\Config,
        \RightNow\Api,
		\RightNow\Connect\v1_3 as RNCPHP,
        \RightNow\Connect\v1_2 as Connect,
        \RightNow\Internal\Sql\Contact as Sql,
        \RightNow\Utils\Connect as ConnectUtil,
        \RightNow\ActionCapture;
    require_once(CORE_FILES . 'compatibility/Internal/Sql/Contact.php');
/**
 * This helper can be loaded a few different ways depending on where it's being called:
 *
 * From a widget or model: $this->CI->load->helper('sample')
 *
 * From a custom controller: $this->load->helper('sample')
 *
 * Once loaded you can call this function by simply using helperFunction()
 */
function checkURL($type)
{
	$url_array = array();
	if($type == 'dealer'){
			$url_array = array("dealer_dashboard","business-information","dealer_collection_incentive","dealer_collection_incentive_details","dealer_disbursal","dealer_disbursal_detail","incentive","incentive_view","detail","trade-request");
	}elseif($type=='customer'){
			$url_array = array("customer_dashboard","payment-details","prospectview","selfserviceview");
	}
	 $url_key = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],"/")+1) ;

	return in_array($url_key,$url_array);
}

/*
Check Active TAB
*/
function checkTAB($page_name){
	//$url_array = array("customer_dashboard","payment-details","prospectview");
	$url_key = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],"/")+1) ;

	return ($page_name==$url_key) ? true : false;
}
/*
*
*/
function soap_dealer_call($functionName, $arrparam,$url) {
	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php');
	//load_curl();
	//$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_TVS_API_URL );
	//$url = $msg->Value;
	//$url = "http://leadsuatservice.tvscredit.com/TVSCSLMSAPI.svc?singlewsdl";
	$client = new nusoap_client( $url, 'wsdl' );
	$client->soap_defencoding = 'UTF-8';
	$param = array( 'parameters' => $arrparam );
	$response = $client->call( $functionName, $param );
	$soapError = $client->getError();
	if ( !empty( $soapError ) ) {
		return 'SOAP method invocation failed:' . $soapError;
	} else {
		if ( is_array( $response ) ) {
			return $response;
		} else {
			return $response;
		}
	}
}

function soap_call( $functionName, $arrparam ) {
	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
	//load_curl();

	$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_TVS_API_URL );
	$url = $msg->Value;
	if(empty($url)){
		//$url = 'http://leadsuatservice.tvscredit.com/TVSCSLMSAPI.svc?wsdl';
		$url = 'https://leadsservice.tvscredit.com/TVSCSLMSAPI.svc?wsdl';
		//http://leadsuatservice.tvscredit.com/TVSCSLMSAPI.svc?wsdl 
	}
	//echo $url;
	$client = new nusoap_client( $url, 'wsdl' );
	$client->soap_defencoding = 'UTF-8';
	$param = array( 'parameters' => $arrparam );
	$response = $client->call( $functionName, $param );
	$soapError = $client->getError();
	if ( !empty( $soapError ) ) {
		return 'SOAP method invocation failed:' . print_r($soapError);
	} else {
		if ( is_array( $response ) ) {
			return $response;
		} else {
			return $response;
		}
	}
}


function soap_emi_call($functionName, $arrparam) {
	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
	//load_curl();

	//$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_TVS_API_URL );
	//$url = $msg->Value;
	//$url = "http://tvscscrmuatservice.tvscredit.com/CRMService.svc?singleWsdl";
	$url = "https://tvscscrmservice.tvscredit.com/CRMService.svc?singleWsdl";
	$client = new nusoap_client( $url, 'wsdl' );
	$client->soap_defencoding = 'UTF-8';
	$param = array( 'parameters' => $arrparam );
	$response = $client->call( $functionName, $param );
	$soapError = $client->getError();
	if ( !empty( $soapError ) ) {
		return 'SOAP method invocation failed:' . $soapError;
	} else {
		if ( is_array( $response ) ) {
			return $response;
		} else {
			return $response;
		}
	}
}

/*
*
*/
function soap_lead_call($functionName, $arrparam,$url) {
	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
	load_curl();

	//$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_TVS_API_URL );
	//$url = $msg->Value;
	//$url = "http://leadsuatservice.tvscredit.com/TVSCSLMSAPI.svc?singlewsdl";
	$client = new nusoap_client( 'https://leadsservice.tvscredit.com/TVSCSLMSAPI.svc?singlewsdl', 'wsdl' );
	$client->soap_defencoding = 'UTF-8';
	$param = array( 'parameters' => $arrparam );
	$response = $client->call( $functionName, $param );
	$soapError = $client->getError();
	if ( !empty( $soapError ) ) {
		return 'SOAP method invocation failed:' . $soapError;
	} else {
		if ( is_array( $response ) ) {
			return $response;
		} else {
			return $response;
		}
	}
}
function soap_lead_rest_call($functionName, $arrparam,$url){
	
	load_curl();
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url.'/'.$functionName,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 80,
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>json_encode($arrparam,true),
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json'
	  ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
	// echo $response;
	// exit();
	return $response;
}

function report_result( $report_id, $filter_array = NULL) {
	try {
		$result_arr = array();
		if ( count( $filter_array ) > 0 ) {
			$report_filter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
			$filters = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
			foreach ( $filter_array as $filtername => $filtervalue ) {
				$report_filter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
				$report_filter->Name = $filtername;
				$report_filter->Values = array( $filtervalue );
				$filters[] = $report_filter;
			}
			$ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch( $report_id );
			$con_res = $ar->run( 0, $filters );
			$con_count = $con_res->count();
			if ( $con_count > 0 ) {
				for ( $ii = $con_count; $ii--; ) {
					$row = $con_res->next();
					$result_arr[] = $row;
				}
			}
		} else {
			$ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch( $report_id );
			$con_res = $ar->run( 0 );
			$con_count = $con_res->count();
			if ( $con_count > 0 ) {
				for ( $ii = $con_count; $ii--; ) {
					$row = $con_res->next();
					$result_arr[] = $row;
				}
			}
		}
		return $result_arr;
	} catch ( Exception $err ) {
		echo $err->getMessage();
	}
}


	/*
	*
	*
	*
	*/
	function checkCustomerType($type){
			$CI=&get_instance();
			 $contact_id=$CI->session->getProfileData("c_id");
			$userProfile=$CI->session->getSessionData("userProfile");
			//print_r($userProfile);die;
			//$contact=\RightNow\Connect\v1_3\Contact::fetch($contact_id);
					//echo "good";print_r($contact_result );
		//	$type = $contact->ContactType->LookupName;
			if(strtolower($type) == strtolower($userProfile['cType'])){
					
			}else{
				if(strtolower($userProfile['cType']) == 'dealer'){
					//header('HTTP/1.0 403 Forbidden');
					header('location:/app/dealer/error/error_id/6');
					exit;
				}elseif(strtolower($userProfile['cType']) == 'customer'){
					//header('HTTP/1.0 403 Forbidden');
					header('location:/app/customer/error/error_id/6');
					exit;
				}else{
					header('location:/app/employee/error/error_id/6');
					//echo 'You are forbidden!';
					exit;
				}
		}
	
	/*
	*
	*
	*/
	function in_array_r($item , $array){
		return preg_match('/"'.$item.'"/i' , json_encode($array));
	}

/**
     * Looks up an Incident ID given its reference number
     * @param string $referenceNumber The reference number to use
     * @return int|bool Incident ID or false if no incident was found
     */
     function getIncidentRefnoFromID($id){
			
         try
        {
            $result = Connect\ROQL::query(sprintf("SELECT I.ReferenceNumber FROM Incident I WHERE I.ID = '%s'", Connect\ROQL::escapeString($id)))->next();
        }
        catch(Connect\ConnectAPIErrorBase $e)
        {
           return $e->getMessage();
        }
        if($row = $result->next())
            return $row['ReferenceNumber'];
        return 'Invalid or non-existent reference number supplied';
    }

/*
function to update Employee Customer Session ID
*/
function updateEmpCustomerSession(){
			$CI=&get_instance();
			$userProfile = $CI->session->getSessionData('userProfile');
			$userProfile['employee_c_id'] = '';
			$bundle=array('userProfile' => $userProfile);
			$CI->session->setSessionData($bundle);
	}

	function getCreatedByContact($contact_id){
			return RNCPHP\Contact::fetch($contact_id);
	}
}

function isDealerEligibleForWorkingRequest() {
	$CI = &get_instance();
	$contact_id = $CI->session->getProfileData("c_id");
	$contact = RNCPHP\Contact::fetch($contact_id);
	if ($contact->ContactType->ID == "2") {
	  $dealerCode = $contact->CustomFields->c->dealer_code;
	  $CI->load->library("Nusoap_lib");
	  $eligibleForWcUrl = "https://tvscscrmservice.tvscredit.com/CRMService.svc/Eligiblefordealerworkingcapital";
	  $eligibleForWcDataArr = array("Dealer_code" => $dealerCode);
	  $eligibleForWcDataJson = json_encode($eligibleForWcDataArr, JSON_UNESCAPED_SLASHES);
	  load_curl();
	  $curl = curl_init($eligibleForWcUrl);
	  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	  curl_setopt($curl, CURLOPT_POSTFIELDS, $eligibleForWcDataJson);
	  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
	  curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
	  curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	  $eligibleForWcResponseJson = curl_exec($curl);
	  $eligibleForWcResponseArr = json_decode($eligibleForWcResponseJson, true);
	  if (count($eligibleForWcResponseArr) > 0) {
		if ($eligibleForWcResponseArr[0]["status"] == "Y") {
		  return true;
		} else {
		  return false;
		}
	  } else {
		return false;
	  }
	} else {
	  return false;
	}
  }