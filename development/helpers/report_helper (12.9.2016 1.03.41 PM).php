<?php
/**
 * This helper can be loaded a few different ways depending on where it's being called:
 *
 * From a widget or model: $this->CI->load->helper('sample')
 *
 * From a custom controller: $this->load->helper('sample')
 *
 * Once loaded you can call this function by simply using helperFunction()
 */
function helperFunction()
{
    /*
     * Legacy functionality:
     * ---------------------
     *
     * This helper can be loaded a few different ways depending on where it's being called:
     *
     * From a widget or model: $this->CI->load->helper('sample')
     *
     * From a custom controller: $this->load->helper('sample')
     *
     * Once loaded you can call this function by simply using helperFunction().
     *
     * This assumes that this file is a collection of global functions.
     */
}

function soap_call( $functionName, $arrparam ) {
	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
	//load_curl();

	$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_TVS_API_URL );
	$url = $msg->Value;
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


