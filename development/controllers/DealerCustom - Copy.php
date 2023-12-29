<?php
namespace Custom\Controllers;
use \RightNow\Utils\Url,
    \RightNow\Utils\Framework,
    \RightNow\Utils\Config,
    \RightNow\Api,
    \RightNow\Connect\v1_3 as RNCPHP,
    \RightNow\Internal\Sql\Contact as Sql,
    \RightNow\Utils\Connect as ConnectUtil,
    \RightNow\Libraries\Hooks,
    \RightNow\ActionCapture;
class DealerCustom extends \RightNow\Controllers\Base
{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
        $this->load->library("Nusoap_lib");
		$this->load->helper('report');
		$this->wsdlURL = 'http://tvscscrmuatservice.tvscs.co.in/CRMService.svc?wsdl';
	}

    /**
     * Sample function for ajaxCustom controller. This function can be called by sending
     * a request to /ci/ajaxCustom/ajaxFunctionHandler.
     */
    function ajaxFunctionHandler()
    {
        $postData = $this->input->post('post_data_name');
        //Perform logic on post data here
        echo $returnedInformation;
    }

	

	/*
	* Function for Business Information to Get SalesDisbursed Count
	* Param 1 => Start Date
	* Param 2 => End Date
	* Param 3 => Dealer Code
	*/
	function getSalesDisbursedCount(){
			
				load_curl();
				date_default_timezone_set('Asia/Kolkata');
			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];
			$dealerCode = $_POST['dealerCode'];
			list($day, $month, $year) = explode("/",$startDate);
			list($day1, $month1, $year1) = explode("/",$endDate);
			//$year = date("Y",strtotime($startDate));
			$url = "http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
			$response = array();

			$response[0] = array('id' => 'series-1', 'color' => '#875F9A','name'=> 'Current year -'.$year);
			$finalArray = array();
			$count = 0;
			for($i = $month;$i<=$month1;$i++){
				
				
				$sdate = "01/".$i."/".$year;
				$eday = date('t', mktime(0, 0, 0, $i, 1, $year)); 
				$edate = $eday."/".$i."/".$year1;
				$data = array("methodName" => "getSalesDisbursedCount", "startDate" => $sdate,"endDate" => $edate, "dealerCode" => $dealerCode);
				$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data,$url));
				//rand(0,10)
				
				if(!empty($respdata)){
					foreach($respdata as $value){
							$finalArray[] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => (int)$value->NO_OF_APPLICATION);
							$count += $value->NO_OF_APPLICATION;
					}
				}else{
						$finalArray[] = null;
				}
			}
			$response[0]['data'] = $finalArray;
			$response[0]['total'] =$count ;
			$prevYear = $year -1 ;
			/* Code for Previous Year 
			$response[1] = array('id' => 'series-2', 'color' => '#F62459','name'=> 'Current year -'.$prevYear );
			$finalArray = array();
			for($i = 1;$i<=12;$i++){
				
				
				$sdate = "01/".$i."/".$prevYear;
				$eday = date('t', mktime(0, 0, 0, $i, 1, $prevYear)); 
//cal_days_in_month(CAL_GREGORIAN,$i,$prevYear);

				$edate = $eday."/".$i."/".$prevYear;
				$data = array("methodName" => "getSalesDisbursedCount", "startDate" => $sdate,"endDate" => $edate, "dealerCode" => $dealerCode);
		
				$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data,$url));
				//
				if(!empty($respdata)){
					foreach($respdata as $value){
							$finalArray[] = array('name' => date("M",mktime(0,0,0,$i,1,$prevYear)), "y" => (int)$value->NO_OF_APPLICATION);
					}
				}else{
						$finalArray[] = null;
				}
			}
			$response[1]['data'] = $finalArray;
			*/
			print_r(json_encode($response,JSON_NUMERIC_CHECK));
	}



/*
	* Function for Business Information to Summary Details for PDD Pending
	* Param 1 => Start Date
	* Param 2 => End Date
	* Param 3 => Dealer Code
	*/
	function getPDDAgeingSummary(){
			
			load_curl();
			date_default_timezone_set('Asia/Kolkata');
			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];
			$dealerCode = $_POST['dealerCode'];
			list($day, $month, $year) = explode("/",$startDate);
			list($day1, $month1, $year1) = explode("/",$endDate);
			//$year = date("Y",strtotime($startDate));
			//$year = 2012;
			$url = "http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
			$response = array();

			$response[0] = array('id' => 'series-1', 'color' => '#875F9A','name'=> 'Invoice with Ageing -'.$year);
			$response[1] = array('id' => 'series-2', 'color' => '#F62459','name'=> 'Insurance with Ageing -'.$year);
			$response[2] = array('id' => 'series-3', 'color' => '#F7A35C','name'=> 'RC Book with Ageing-'.$year);
			$finalArray = array();
			$colorArray = array('#875F9A','#F62459','#F7A35C');
			for($i = $month;$i<=$month1;$i++){
				
				$sdate = "01/".$i."/".$year;
				$eday = date('t', mktime(0, 0, 0, $i, 1, $year)); 
				$edate = $eday."/".$i."/".$year1;
				$data = array("methodName" => "getPDDAgeingSummary", "startDate" => $sdate,"endDate" => $edate, "dealerCode" => $dealerCode);
				$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data,$url));
				//print_r($respdata);
				//
				$flag_in = $flag_ins = $flag_rc = true;
				if(!empty($respdata)){
					foreach($respdata as $value){
						if($value->AGEING_TYPE == 'Invoice with Ageing' && $flag_in == true){
							$finalArray[$value->AGEING_TYPE][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => (int)$value->COUNT);
							$flag_in = false;
						}else{
							if($flag_in)
								$flag_in =  true;
						}
						if($value->AGEING_TYPE == 'Insurance with Ageing' && $flag_ins == true){
							$finalArray[$value->AGEING_TYPE][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => (int)$value->COUNT);
							$flag_ins = false;
						}else{
								if($flag_ins)
									$flag_ins =  true;
						}
						if($value->AGEING_TYPE == 'RC Book with Ageing' && $flag_rc  == true){
							$finalArray[$value->AGEING_TYPE][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => (int)$value->COUNT);
							$flag_rc  = false;
						}else{
								if($flag_rc)
									$flag_rc =  true;
						}
					}
					if($flag_in)
							$finalArray['Invoice with Ageing'][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0);
					if($flag_ins)
							$finalArray['Insurance with Ageing'][] =array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0);	
					if($flag_rc)
							$finalArray['RC Book with Ageing'][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0);	
				}else{
						$finalArray['Invoice with Ageing'][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0);
						$finalArray['Insurance with Ageing'][] =array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0);
						$finalArray['RC Book with Ageing'][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0);
				}
			}
			$response[0]['data'] = $finalArray['Invoice with Ageing'];
			$response[1]['data'] = $finalArray['Insurance with Ageing'];
			$response[2]['data'] = $finalArray['RC Book with Ageing'];
			$prevYear = $year -1 ;
			
			print_r(json_encode($response,JSON_NUMERIC_CHECK));
	}
/*

*/
	function getSalesRestData(){
		load_curl();
				date_default_timezone_set('Asia/Kolkata');
			$startDate = $_POST['start_date'];
			$endDate = $_POST['end_date'];
			$dealerCode = $_POST['dealer_code'];
			$methodName = $_POST['method'];
			$year = date("Y",strtotime($startDate));
			$url = "http://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
			$response = array();
			$data = array("methodName" => "$methodName", "startDate" => $startDate,"endDate" => $endDate, "dealerCode" => $dealerCode);
			//print_r($data);
			$respdata = ($this->nusoap_lib->getDealerAPIData($data,$url));
				
			//print_r($respdata);
			if($respdata->error_code == "1001"){
					$respdata = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					print_r(json_encode($respdata));

				}else{
					print_r($respdata);
				}
	}

	function reloadSalesRestData(){
			
			date_default_timezone_set('Asia/Kolkata');
			$startDate = $_REQUEST['start_date'];
			$endDate = $_REQUEST['end_date'];
			$dealerCode = $_REQUEST['dealer_code'];
			$methodName = $_REQUEST['method'];
			$year = date("Y",strtotime($startDate));
			$url = "http://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
			$response = array();
			if($methodName == 'getDealerTATransaction'){
					$arrParam = array('FromDate' => $startDate ,'ToDate' => $endDate,"DealerCode" => $dealerCode);
					$transactionSummary = soap_dealer_call($methodName,$arrParam,$this->wsdlURL);
					//print_r($arrParam);
					//print_r($transactionSummary); 
					$responseArray = array();
					if(!empty($transactionSummary['getDealerTATransactionResult']['TA_Transaction_Data_Entity'])){
						$dataResult = $transactionSummary['getDealerTATransactionResult']['TA_Transaction_Data_Entity'];
						if(!empty($dataResult)){
							foreach($dataResult as $key => $responseResult){
								$responseArray[] = $responseResult['objTATransaction'];
							}
						}
					}else{
							//$responseArray[] = "No Data Found";
							$responseArray = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					}
					print_r(json_encode($responseArray));
					exit;
			}elseif($methodName == 'getTADealerSummary'){
						
						list($sday,$smonth,$syear) = explode("/",$startDate);
						list($eday,$emonth,$eyear) = explode("/",$endDate);
						$data = array('methodName' => $methodName,'startDate' => date('d-M-Y', mktime(0,0,0,$smonth,$sday,$syear)) ,'endDate' => date('d-M-Y', mktime(0,0,0,$emonth,$eday,$eyear)),"dealerCode" => $dealerCode);
			}else{
				$data = array("methodName" => "$methodName", "startDate" => $startDate,"endDate" => $endDate, "dealerCode" => $dealerCode);
			}
			//print_r($data);
			load_curl();
			$respdata = ($this->nusoap_lib->getDealerAPIData($data,$url));
			
			if($respdata->error_code == "1001"){
				$respdata = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
				print_r(json_encode($respdata));

			}else{
				print_r($respdata);
			}
	}

	/*
	* Function for Business Information to Summary Details for PDD Pending in Pie and Bar Chart
	* Param 1 => Start Date
	* Param 2 => End Date
	* Param 3 => Dealer Code
	*/
	function getPDDAgeingChartSummary(){
				load_curl();
				date_default_timezone_set('Asia/Kolkata');
				$startDate = $_POST['startDate'];
				$endDate = $_POST['endDate'];
				$dealerCode = $_POST['dealerCode'];
				/*
				color: '#875F9A',
                name: 'Ageing Wise Summary',
                data:[{"name":"Login To Sanction","y":178680,"count":5},{"name":"Sanction To Disbursal","y":0,"count":0},{"name":"Disbursed","y":42754353,"count":1115}],
				*/

				$url = "http://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
				$response = array();
				//echo strtotime($startDate);
							$colorArray = array('#875F9A','#F62459','#F7A35C');
				list($day,$month,$year) = explode("/",$startDate);
				//$year = date("Y",strtotime($startDate));
				$response[0] = array('id' => 'series-1', 'color' => '#054fa4','name'=> 'Ageing Wise Summary -'.$year);
				$response[1] = array('id' => 'series-2', 'color' => '#875F9A','name'=> 'Ageing Wise Summary -'.$year);
				
				$data = array("methodName" => "getPDDAgeingSummary", "startDate" => $startDate,"endDate" => $endDate, "dealerCode" => $dealerCode);
			//print_r($data);
				$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data,$url));
				//print_r($respdata); 
				$count = 0;
				$total = 0;
				if(!empty($respdata) && $respdata->error_code != 1001){
					foreach($respdata as $value){
							$finalArray[$count]['name'] = $value->AGEING_TYPE;
							$finalArray[$count]['y'] = $value->COUNT;
							$finalArray[$count]['color'] = $colorArray[$count];
							$finalArray[$count++]['count'] = $value->COUNT;
							$total += $value->COUNT;
					}
				}else{
						$finalArray = null;
				}
				$response[0]['data'] = $finalArray;
				$response[1]['data'] = $finalArray;
				$response[0]['total'] = $total;
			
			print_r(json_encode($response,JSON_NUMERIC_CHECK));
		}// end of function

		/*
		*
		* Summary SOAP Data
		*/
		function getIncentiveSummarySoapData(){
					
					$yearRange =  $_POST['date_range'];
					$dealerCode = $_POST['dealer_code'];
					$monthsel = $_POST['month_sel'];
					$methodName = $_POST['method'];
					$arrParam = array('strDealer' => $dealerCode,'strFinMonth' => $monthsel ,'strFinYr' => $yearRange);
					$IncentiveSummary = soap_dealer_call($methodName,$arrParam,$this->wsdlURL);
					//print_r($IncentiveSummary);
					$responseArray = array();
					if(!empty($IncentiveSummary['GetDealerSalesIncentiveSummaryDetailsResult']['Dealer_SalesIncentiveSummary_Data_Entity'])){
						$dataResult = $IncentiveSummary['GetDealerSalesIncentiveSummaryDetailsResult']['Dealer_SalesIncentiveSummary_Data_Entity'];
						if(!empty($dataResult)){
							foreach($dataResult as $key => $responseResult){
									
								$responseArray[] = $responseResult['objDlrSalesIncenSummary'];
							}
						}
					}else{
							//$responseArray[] = "No Data Found";
							$responseArray = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					}
					print_r(json_encode($responseArray));
		}

		/*
		*
		* Reload Incentive Soap Data
		*/
		function reloadIncentiveSoapData(){
					
					$yearRange =  $_REQUEST['date_range'];
					$dealerCode = $_REQUEST['dealer_code'];
					$monthsel = $_REQUEST['month_sel'];
					$methodName = $_REQUEST['method'];
					$arrParam = array('strDealer' => $dealerCode,'strFinMonth' => $monthsel ,'strFinYr' => $yearRange);
					$IncentiveSummary = soap_dealer_call($methodName,$arrParam,$this->wsdlURL);
					//print_r($IncentiveSummary);
					$responseArray = array();
					if(!empty($IncentiveSummary['GetDealerSalesIncentiveSummaryDetailsResult']['Dealer_SalesIncentiveSummary_Data_Entity'])){
						$dataResult = $IncentiveSummary['GetDealerSalesIncentiveSummaryDetailsResult']['Dealer_SalesIncentiveSummary_Data_Entity'];
						if(!empty($dataResult)){
							foreach($dataResult as $key => $responseResult){
									
								$responseArray[] = $responseResult['objDlrSalesIncenSummary'];
							}
						}
					}else{
							//$responseArray[] = "No Data Found";
							$responseArray = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					}
					print_r(json_encode($responseArray));
		}

		/*
		*
		*
		*/
		function getCollectionIncentiveSummarySoapData(){
					$yearRange =  $_POST['date_range'];
					$dealerCode = $_POST['dealer_code'];
					$monthsel = $_POST['month_sel'];
					$methodName = $_POST['method'];
					$arrParam = array('strDealer' => $dealerCode,'strFinMonth' => $monthsel ,'strFinYr' => $yearRange);
					$IncentiveSummary = soap_dealer_call($methodName,$arrParam,$this->wsdlURL);
					//print_r($IncentiveSummary);
					$responseArray = array();
					if(!empty($IncentiveSummary['GetDealerCollectionIncentiveSummaryDetailsResult']['Dealer_CollectionIncentiveSummary_Data_Entity'])){
						$dataResult = $IncentiveSummary['GetDealerCollectionIncentiveSummaryDetailsResult']['GetDealerCollectionIncentiveSummaryDetailsResult'];
						if(!empty($dataResult)){
							foreach($dataResult as $key => $responseResult){
									
								$responseArray[] = $responseResult['objDlrCollectionIncenSum'];
							}
						}
					}else{
							//$responseArray[] = "No Data Found";
							$responseArray = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					}
					print_r(json_encode($responseArray));
		}

		/*
		* Reload Data
		*
		*/
		function reloadCollectionIncentiveSoapData()
		{
					$yearRange =  $_REQUEST['date_range'];
					$dealerCode = $_REQUEST['dealer_code'];
					$monthsel = $_REQUEST['month_sel'];
					$methodName = $_REQUEST['method'];
					$arrParam = array('strDealer' => $dealerCode,'strFinMonth' => $monthsel ,'strFinYr' => $yearRange);
					$IncentiveSummary = soap_dealer_call($methodName,$arrParam,$this->wsdlURL);
					//print_r($IncentiveSummary);
					$responseArray = array();
					if(!empty($IncentiveSummary['GetDealerCollectionIncentiveSummaryDetailsResult']['Dealer_CollectionIncentiveSummary_Data_Entity'])){
						$dataResult = $IncentiveSummary['GetDealerCollectionIncentiveSummaryDetailsResult']['Dealer_CollectionIncentiveSummary_Data_Entity'];
						if(!empty($dataResult)){
							foreach($dataResult as $key => $responseResult){
									
								$responseArray[] = $responseResult['objDlrCollectionIncenSum'];
							}
						}
					}else{
							//$responseArray[] = "No Data Found";
							$responseArray = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					}
					print_r(json_encode($responseArray));
			}


			/*
		*
		* Incentive Collection Details SOAP Data
		*/
		function getCollectionDetailsSoapData(){
					
					$yearRange =  $_POST['date_range'];
					$dealerCode = $_POST['dealer_code'];
					$monthsel = $_POST['month_sel'];
					$methodName = $_POST['method'];
					$arrParam = array('strDealer' => $dealerCode,'strFinMonth' => strtoupper($monthsel) ,'strFinYr' => $yearRange);
					$IncentiveSummary = soap_dealer_call($methodName,$arrParam,$this->wsdlURL);
					//print_r($IncentiveSummary);
					$responseArray = array();
					if(!empty($IncentiveSummary['GetDealerCollectionIncentiveDetailsResult']['Dealer_CollectionIncentive_Data_Entity'])){
						$dataResult = $IncentiveSummary['GetDealerCollectionIncentiveDetailsResult']['Dealer_CollectionIncentive_Data_Entity'];
						if(!empty($dataResult)){
							foreach($dataResult as $key => $responseResult){
									
								$responseArray[] = $responseResult['objDealerCollectionIncentive'];
							}
						}
					}else{
							//$responseArray[] = "No Data Found";
							$responseArray = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					}
					print_r(json_encode($responseArray));
		}

		/*
		*
		* Reload Incentive Collection Details Soap Data
		*/
		function reloadCollectionDetailsSoapData(){
					
					$yearRange =  $_REQUEST['date_range'];
					$dealerCode = $_REQUEST['dealer_code'];
					$monthsel = $_REQUEST['month_sel'];
					$methodName = $_REQUEST['method'];
					$arrParam = array('strDealer' => $dealerCode,'strFinMonth' => strtoupper($monthsel) ,'strFinYr' => $yearRange);
					//print_r($arrParam);
					$IncentiveSummary = soap_dealer_call($methodName,$arrParam,$this->wsdlURL);
					//print_r($IncentiveSummary);
					$responseArray = array();
					if(!empty($IncentiveSummary['GetDealerCollectionIncentiveDetailsResult']['Dealer_CollectionIncentive_Data_Entity'])){
						$dataResult = $IncentiveSummary['GetDealerCollectionIncentiveDetailsResult']['Dealer_CollectionIncentive_Data_Entity'];
						if(!empty($dataResult)){
							foreach($dataResult as $key => $responseResult){
									
								$responseArray[] = $responseResult['objDealerCollectionIncentive'];
							}
						}
					}else{
							//$responseArray[] = "No Data Found";
							$responseArray = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					}
					print_r(json_encode($responseArray));
		}

		/*
		*
		* Summary SOAP Data
		*/
		function getIncentiveDetailsSoapData(){
					
					$yearRange =  $_POST['date_range'];
					$dealerCode = $_POST['dealer_code'];
					$monthsel = $_POST['month_sel'];
					$methodName = $_POST['method'];
					$arrParam = array('strDealer' => $dealerCode,'strFinMonth' => strtoupper($monthsel) ,'strFinYr' => $yearRange);
					$IncentiveSummary = soap_dealer_call($methodName,$arrParam,$this->wsdlURL);
					//print_r($IncentiveSummary);
					$responseArray = array();
					if(!empty($IncentiveSummary['GetDealerSalesIncentiveDetailsResult']['Dealer_SalesIncentive_Data_Entity'])){
						$dataResult = $IncentiveSummary['GetDealerSalesIncentiveDetailsResult']['Dealer_SalesIncentive_Data_Entity'];
						if(!empty($dataResult)){
							foreach($dataResult as $key => $responseResult){
									
								$responseArray[] = $responseResult['objDealerSalesIncentive'];
							}
						}
					}else{
							//$responseArray[] = "No Data Found";
							$responseArray = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
							//print_r(json_encode($respdata));
					}
					print_r(json_encode($responseArray));
		}

		/*
		*
		* Reload Incentive Soap Data
		*/
		function reloadIncentiveDetailsSoapData(){
					
					$yearRange =  $_REQUEST['date_range'];
					$dealerCode = $_REQUEST['dealer_code'];
					$monthsel = $_REQUEST['month_sel'];
					$methodName = $_REQUEST['method'];
					$arrParam = array('strDealer' => $dealerCode,'strFinMonth' => strtoupper($monthsel) ,'strFinYr' => $yearRange);
					$IncentiveSummary = soap_dealer_call($methodName,$arrParam,$this->wsdlURL);
					//print_r($IncentiveSummary);
					$responseArray = array();
					if(!empty($IncentiveSummary['GetDealerSalesIncentiveDetailsResult']['Dealer_SalesIncentive_Data_Entity'])){
						$dataResult = $IncentiveSummary['GetDealerSalesIncentiveDetailsResult']['Dealer_SalesIncentive_Data_Entity'];
						if(!empty($dataResult)){
							foreach($dataResult as $key => $responseResult){
									
								$responseArray[] = $responseResult['objDealerSalesIncentive'];
							}
						}
					}else{
							//$responseArray[] = "No Data Found";
							$responseArray = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					}
					print_r(json_encode($responseArray));
		}


		/*

		*/
			function getTARestData(){
				load_curl();
				date_default_timezone_set('Asia/Kolkata');
					$dealerCode = $_POST['dealer_code'];
					$methodName = $_POST['method'];
					$year = date("Y",strtotime($startDate));
					$url = "http://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
					$response = array();
					$data = array("methodName" => "$methodName","dealerCode" => $dealerCode);
					//print_r($data);
					$respdata = ($this->nusoap_lib->getDealerAPIData($data,$url));
						
					print_r($respdata);
			}

			/*
			*
			*
			*/
			function createTARequest(){
				
					$contactId = $_POST['contactID'];
					$amountReq = $_POST['maximum_amount'];
					$userData=$this->session->getSessionData("userProfile");
					/*
					"{""primaryContact"":{""id"":3},""category"":{""id"":194},""queue"":{""id"":3},""statusWithType"": 
{""status"": { ""id"": 1 } },""subject"":""New TA Request"",""customFields"":{""c"": {""amount_requested"":<value>}}}
"
*/
					try{
							$incident = new RNCPHP\Incident();
						 
							$incident->Subject = "New TA Request";
						 
						//	$incident->Product =  RNCPHP\ServiceProduct::fetch(1);
						 
							$incident->Category = RNCPHP\ServiceCategory::fetch(194);
						 
						/*	$incident->Threads = new RNCPHP\ThreadArray();
							$incident->Threads[0] = new RNCPHP\Thread();
							$incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
							$incident->Threads[0]->EntryType->ID = 3; // Used the ID here. See the Thread object for definition
							$incident->Threads[0]->Text = "Mundo Phone won't dial again. Third time this has happened.";
							$incident->Threads[1] = new RNCPHP\Thread();
							$incident->Threads[1]->EntryType = new RNCPHP\NamedIDOptList();
							$incident->Threads[1]->EntryType->ID = 1; // Used the ID here. See the Thread object for definition
							$incident->Threads[1]->Text = "This may be related to defect in keyboard. Probably should replace";
						 
							$incident->AssignedTo = new RNCPHP\GroupAccount();
							$incident->AssignedTo->Account = RNCPHP\Account::fetch(27);//Setting the account will automatically populate the appropriate group
						 
							$incident->Banner = new RNCPHP\Banner();
							$incident->Banner->Text = "Sample Banner Information";
							$incident->Banner->ImportanceFlag = 3;// [Low] => 1, [Medium] => 2, [High] => 3
						 
							$incident->Channel = new RNCPHP\NamedIDLabel();
							$incident->Channel->LookupName = "Email";
						 
							$incident->ChatQueue =  new RNCPHP\NamedIDLabel();
							$incident->ChatQueue->ID = 1;
						 
							$incident->Disposition = RNCPHP\ServiceDisposition::fetch(3);
						 
							$incident->FileAttachments =new RNCPHP\FileAttachmentIncidentArray();
							$fattach = new RNCPHP\FileAttachmentIncident();
							$fattach->ContentType = "text/text";
							$fp = $fattach->makeFile();
							fwrite( $fp, "Making some notes in this text file for the incident".date("Y-m-d h:i:s"));
							fclose( $fp );
							$fattach->FileName = "NewTextFile.txt";
							$fattach->Name = "New Text File.txt";
							$incident->FileAttachments[] = $fattach;
						 
							$incident->SiteInterface =  new RNCPHP\NamedIDLabel();
							$incident->SiteInterface->ID = 1;
						 */
							//$incident->Language = new RNCPHP\NamedIDOptList();
							//$incident->Language->ID =1;
						 
							//$incident->Mailbox = RNCPHP\Mailbox::fetch(30);
						  
						//	$incident->Organization = RNCPHP\Organization::fetch(8);
						 
							$incident->PrimaryContact = RNCPHP\Contact::fetch($contactId);//Required field to create an incident through connect PHP
						 
							$incident->Queue = new RNCPHP\NamedIDLabel();
							$incident->Queue->ID = 3;
						 
							//$incident->Severity = new RNCPHP\NamedIDOptList();
							//$incident->Severity->LookupName  = 1;
						 
							$incident->StatusWithType               = new RNCPHP\StatusWithType() ;
							$incident->StatusWithType->Status       = new RNCPHP\NamedIDOptList() ;
							$incident->StatusWithType->Status->ID   = 1 ;
							 
							 $incident->CustomFields->c->amount_requested = $amountReq;
							 $incident->save(RNCPHP\RNObject::SuppressAll);
							//echo "Incident Created";
							$responseArray[] = array('value_id' => $incident->ID, 'value_refno' => $incident->ReferenceNumber);
							//$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);
							print_r(json_encode($responseArray));
						}
						 
						catch (Exception $err ){
							echo json_encode($err->getMessage());
						}

			}

			/*
			*
			* Trade Advance
			*/
			function getTADealerSummary(){
						
						load_curl();
						$startDate =  $_POST['start_date'];
						$dealerCode = $_POST['dealer_code'];
						$endDate = $_POST['end_date'];
						$methodName = $_POST['method'];
						list($sday,$smonth,$syear) = explode("/",$startDate);
						list($eday,$emonth,$eyear) = explode("/",$endDate);
						$arrParam = array('methodName' => $methodName,'startDate' => date('d-M-Y', mktime(0,0,0,$smonth,$sday,$syear)) ,'endDate' => date('d-M-Y', mktime(0,0,0,$emonth,$eday,$eyear)),"dealerCode" => $dealerCode);
						//print_r($arrParam);
						$url = "http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
						$respdata = json_decode($this->nusoap_lib->getDealerAPIData($arrParam,$url));
						//print_r($respdata);
						if($respdata->error_code == "1001"){
							$respdata = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
							print_r(json_encode($respdata));

						}else{
							print_r(json_encode($respdata));
						}
						//$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data,$url));
			}

			/*
			*
			*
			*
			*/
			function getTADealerData(){
				
				if(isset($_POST['dealer_code'])){
					$startDate =  $_POST['start_date'];
					$dealerCode = $_POST['dealer_code'];
					$endDate = $_POST['end_date'];
					$methodName = $_POST['method'];
				//	list($sday,$smonth,$syear) = explode("/",$startDate);
				//	list($eday,$emonth,$eyear) = explode("/",$endDate);
					$arrParam = array('FromDate' => $startDate ,'ToDate' => $endDate,"DealerCode" => $dealerCode);
					$transactionSummary = soap_dealer_call($methodName,$arrParam,$this->wsdlURL);
					//print_r($arrParam);
					//print_r($transactionSummary); 
					$responseArray = array();
					if(!empty($transactionSummary['getDealerTATransactionResult']['TA_Transaction_Data_Entity'])){
						$dataResult = $transactionSummary['getDealerTATransactionResult']['TA_Transaction_Data_Entity'];
						if(!empty($dataResult)){
							foreach($dataResult as $key => $responseResult){
								$responseArray[] = $responseResult['objTATransaction'];
							}
						}
					}else{
							//$responseArray[] = "No Data Found";
							$responseArray = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					}
					print_r(json_encode($responseArray));
				}else{
						echo "No Data Found";
						exit;
				}
			}

			/*
			*
			*
			*/
			/*
	* Function for Business Information to Summary Details for PDD Pending
	* Param 1 => Start Date
	* Param 2 => End Date
	* Param 3 => Dealer Code
	*/
	function getSalesPerformanceSummary(){
			
				load_curl();
				date_default_timezone_set('Asia/Kolkata');
				$startDate = $_POST['startDate'];
				$endDate = $_POST['endDate'];
				$dealerCode = $_POST['dealerCode'];
				list($day, $month, $year) = explode("/",$startDate);
				list($day1, $month1, $year1) = explode("/",$endDate);
				//$year = date("Y",strtotime($startDate));
				//$year = 2012;
				$url = "http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
				$response = array();

				$response[0] = array('id' => 'series-1', 'color' => '#F62459','name'=> 'Login To Sanction -'.$year);
				$response[1] = array('id' => 'series-2', 'color' => '#F7A35C','name'=> 'Sanction To Disbursal -'.$year);
				//$response[2] = array('id' => 'series-3', 'color' => '#F7A35C','name'=> 'RC Book with Ageing-'.$year);
				$finalArray = array();
				$colorArray = array('#875F9A','#F62459','#F7A35C');
				for($i = $month;$i<=$month1;$i++){
					
					$sdate = "01/".$i."/".$year;
					$eday = date('t', mktime(0, 0, 0, $i, 1, $year)); 
					$edate = $eday."/".$i."/".$year1;
					$data = array("methodName" => "getSalesPerformanceSummary", "startDate" => $sdate,"endDate" => $edate, "dealerCode" => $dealerCode);
					$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data,$url));
					//print_r($respdata);
					//
					$flag_in = $flag_ins = $flag_rc = true;
					if(!empty($respdata)){
						foreach($respdata as $value){
							if($value->TYPE == 'Login To Sanction' && $flag_in == true){
								$finalArray[$value->TYPE][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => (int)$value->VALUE, 'count' => (int)$value->NO_OF_APPLICATION);
								$flag_in = false;
							}else{
								if($flag_in)
									$flag_in =  true;
							}
							if($value->TYPE == 'Sanction To Disbursal' && $flag_ins == true){
								$finalArray[$value->TYPE][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => (int)$value->VALUE, 'count' => (int)$value->NO_OF_APPLICATION);
								$flag_ins = false;
							}else{
									if($flag_ins)
										$flag_ins =  true;
							}
						/*	if($value->AGEING_TYPE == 'RC Book with Ageing' && $flag_rc  == true){
								$finalArray[$value->AGEING_TYPE][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => (int)$value->COUNT);
								$flag_rc  = false;
							}else{
									if($flag_rc)
										$flag_rc =  true;
							}*/
						}
						if($flag_in)
								$finalArray['Login To Sanction'][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0,"count" => 0);
						if($flag_ins)
								$finalArray['Sanction To Disbursal'][] =array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0,"count" => 0);	
						/*if($flag_rc)
								$finalArray['RC Book with Ageing'][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0);	*/
					}else{
							$finalArray['Login To Sanction'][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0,"count" => 0);
							$finalArray['Sanction To Disbursal'][] =array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0,"count" => 0);
							//$finalArray['RC Book with Ageing'][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0);
					}
				}
				$response[0]['data'] = $finalArray['Login To Sanction'];
				$response[1]['data'] = $finalArray['Sanction To Disbursal'];
				//$response[2]['data'] = $finalArray['RC Book with Ageing'];
				$prevYear = $year -1 ;
				
				print_r(json_encode($response,JSON_NUMERIC_CHECK));
		}

		/*
		*
		*
		*/
		/*
	* Function for Business Information to Summary Details for PDD Pending in Pie and Bar Chart
	* Param 1 => Start Date
	* Param 2 => End Date
	* Param 3 => Dealer Code
	*/
	function getSalesPerformanceChartSummary(){
				load_curl();
				date_default_timezone_set('Asia/Kolkata');
				$startDate = $_POST['startDate'];
				$endDate = $_POST['endDate'];
				$dealerCode = $_POST['dealerCode'];
				/*
				color: '#875F9A',
                name: 'Ageing Wise Summary',
                data:[{"name":"Login To Sanction","y":178680,"count":5},{"name":"Sanction To Disbursal","y":0,"count":0},{"name":"Disbursed","y":42754353,"count":1115}],
				*/

				$url = "http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
				$response = array();
				//echo strtotime($startDate);
				list($sday,$smonth,$syear) = explode("/",$startDate);
				$year = date("Y",mktime(0,0,0,$smonth,$sday,$syear));
				$response[0] = array('id' => 'series-1', 'color' => '#875F9A','name'=> 'Summary Details for Disbursal Pending -'.$year);
				$response[1] = array('id' => 'series-2', 'colorByPoint' => true,'name'=> 'Summary Details for Disbursal Pending -'.$year);
				
				$data = array("methodName" => "getSalesPerformanceSummary", "startDate" => $startDate,"endDate" => $endDate, "dealerCode" => $dealerCode);
			//print_r($data);
				$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data,$url));
				//print_r($respdata); 
				$count = 0;
				$total_data = 0;
				if(!empty($respdata) && $respdata->error_code != 1001){
					foreach($respdata as $value){
							$finalArray[$count]['name'] = $value->TYPE;
							if(!isset($value->VALUE) || empty($value->VALUE))
								$finalArray[$count]['y'] = 0;
							else
								$finalArray[$count]['y'] = $value->VALUE;

							$finalArray[$count++]['count'] = $value->NO_OF_APPLICATION;
							$total_data += $value->NO_OF_APPLICATION;
					}
				}else{
						$finalArray = null;
				}
				$response[0]['data'] = $finalArray;
				$response[1]['data'] = $finalArray;
				$response[0]['total'] = $total_data;
			
			print_r(json_encode($response,JSON_NUMERIC_CHECK));
		}// end of function

		function getSalesDisbursedCountData(){
				
				load_curl();
				date_default_timezone_set('Asia/Kolkata');
			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];
			$dealerCode = $_POST['dealerCode'];
			$url = "http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
			$response = array();

			
				$data = array("methodName" => "getSalesDisbursedCount", "startDate" => $startDate,"endDate" => $endDate, "dealerCode" => $dealerCode);
				$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data,$url));
				//print_r($respdata);
			//	print_r($data);
				 $html_outout = '<div class="form-2">
												<h1><span class="log-in">Summary details for Dealer disbursal</span></h1>
												<p class="float">
													<label for="TYPE"><i class="icon-user"></i>Type</label>
													<input type="text" name="TYPE" value = "'.$respdata[0]->TYPE.'" disabled>
												</p>
												<p class="float">
													<label for="NO_OF_APPLICATION"><i class="icon-lock"></i>No of Applications</label>
													<input type="text" name="NO_OF_APPLICATION" value = "'.$respdata[0]->NO_OF_APPLICATION.'" disabled> 
												</p>
												</div>
												';
				echo $html_outout;
		}

		/*
		*
		*
		*
		*/
		/*
	*  Raise a Query
	*/
	function raiseDealerQueryRequest(){
				
					$contactId = $_POST['co_id'];
					//$amountReq = $_POST['maximum_amount'];
					//$userData=$this->session->getSessionData("userProfile");
					
					try{
							$incident = new RNCPHP\Incident();
						 
							$incident->Subject = $_POST['Incident.Subject'];
						 
							$incident->Product =  RNCPHP\ServiceProduct::fetch($_POST['formData']['Incident.Product']);
						 
							$incident->Category = RNCPHP\ServiceCategory::fetch($_POST['formData']['Incident.Category']);
						 
							$incident->Threads = new RNCPHP\ThreadArray();
							$incident->Threads[0] = new RNCPHP\Thread();
							$incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
							$incident->Threads[0]->EntryType->ID = 4; // Used the ID here. See the Thread object for definition
							$incident->Threads[0]->Text = $_POST['Incident_Threads'];
							/*$incident->Threads[1] = new RNCPHP\Thread();
							$incident->Threads[1]->EntryType = new RNCPHP\NamedIDOptList();
							$incident->Threads[1]->EntryType->ID = 1; // Used the ID here. See the Thread object for definition
							$incident->Threads[1]->Text = "This may be related to defect in keyboard. Probably should replace";*/
						 
						 /*
							$incident->AssignedTo = new RNCPHP\GroupAccount();
							$incident->AssignedTo->Account = RNCPHP\Account::fetch(27);//Setting the account will automatically populate the appropriate group
						 
							$incident->Banner = new RNCPHP\Banner();
							$incident->Banner->Text = "Sample Banner Information";
							$incident->Banner->ImportanceFlag = 3;// [Low] => 1, [Medium] => 2, [High] => 3
						 
							$incident->Channel = new RNCPHP\NamedIDLabel();
							$incident->Channel->LookupName = "Email";
						 
							$incident->ChatQueue =  new RNCPHP\NamedIDLabel();
							$incident->ChatQueue->ID = 1;
						 
							$incident->Disposition = RNCPHP\ServiceDisposition::fetch(3);
						 
							$incident->FileAttachments =new RNCPHP\FileAttachmentIncidentArray();
							$fattach = new RNCPHP\FileAttachmentIncident();
							$fattach->ContentType = "text/text";
							$fp = $fattach->makeFile();
							fwrite( $fp, "Making some notes in this text file for the incident".date("Y-m-d h:i:s"));
							fclose( $fp );
							$fattach->FileName = "NewTextFile.txt";
							$fattach->Name = "New Text File.txt";
							$incident->FileAttachments[] = $fattach;
						 
							$incident->SiteInterface =  new RNCPHP\NamedIDLabel();
							$incident->SiteInterface->ID = 1;
						 */
							//$incident->Language = new RNCPHP\NamedIDOptList();
							//$incident->Language->ID =1;
						 
							//$incident->Mailbox = RNCPHP\Mailbox::fetch(30);
						  
						//	$incident->Organization = RNCPHP\Organization::fetch(8);
						 
							$incident->PrimaryContact = RNCPHP\Contact::fetch($contactId);//Required field to create an incident through connect PHP
						 
							$incident->Queue = new RNCPHP\NamedIDLabel();
							$incident->Queue->ID = 2;
						 
							//$incident->Severity = new RNCPHP\NamedIDOptList();
							//$incident->Severity->LookupName  = 1;
						 
							$incident->StatusWithType               = new RNCPHP\StatusWithType() ;
							$incident->StatusWithType->Status       = new RNCPHP\NamedIDOptList() ;
							$incident->StatusWithType->Status->ID   = 1 ;
							 
							 //\RightNow\Connect\v1_3\CO\City::fetch( "$city" );
							 $incident->CustomFields->CO->Loan = \RightNow\Connect\v1_3\CO\Loan::fetch($_POST['formData']['Incident.CustomFields.CO.Loan.ID']);
							 $incident->save(RNCPHP\RNObject::SuppressAll);
							//echo "Incident Created";
							$responseArray[] = array('value_id' => $incident->ID, 'value_refno' => $incident->ReferenceNumber);
							//$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);
							print_r(json_encode($responseArray));
						}
						catch (Exception $err ){
							echo json_encode($err->getMessage());
						}

			}

			/*

			*/
			function getDealerIncidentPieData(){
					
					$startDate = $_POST['startDate'];
					$endDate = $_POST['endDate'];
					$labels = array('Logged in' => "label-important",'Closed' => "label-success",'Pending with initiator / internal team' => "label-info",'Response Awaited' => "label-warning","New" => "label-important");
					$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incidents);
					$report_id=$msg->Value;
					//$c_id =3;
					$c_id=$this->session->getProfileData("c_id");
					//$report_id = '100051';
					//$idreport = $_REQUEST['id_of_report'];
					
					$response_data = array('type' => 'pie','name' =>  'Total Incidents');
					if($report_id>0){
							$filter=array('Contact_Id'=>$c_id);
							$report_result=$this->model('custom/Login')->report_result($report_id,$filter,true);
							//print_r($report_result); exit;
								$inc_count = count($report_result);
								$closed = 	$loggedin = 	$pending = 0;
								$counter = $new = 0;
								$response_awaited = 0;
								//for($i = 0; $i < $inc_count; $i++) {
								foreach($report_result as $key => $response){	

									if($response['Status'] == "New") {
										++$new;
									}elseif($response['Status'] == "Closed") {
										++$closed;
									}
									else if($response['Status'] == "Logged in") {
										++$loggedin;
									}
									else if($response['Status'] == "Pending with initiator / internal team") {
										++$pending;
									}
									else if($response['Status'] == "Response Awaited") {
										++$response_awaited;
									}
									
								}
								$response_data['data'] = array(array("Closed",$closed),array("Logged in",$loggedin),array("Pending with initiator / internal team",$pending),array("Response Awaited",$response_awaited),array("New",$new));
								//json_encode($pie_chart)
					}
					print_r(json_encode($response_data));

			}

			/*
					TA Dealer Data API
			*/
			function getTADealerIncidentPieData(){
					
					$startDate = $_POST['startDate'];
					$endDate = $_POST['endDate'];
					$labels = array('Logged in' => "label-important",'Closed' => "label-success",'Pending with initiator / internal team' => "label-info",'Response Awaited' => "label-warning","New" => "label-important");
					$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incident_UserStatus);
					$report_id=$msg->Value;
					//$c_id =3;
					$c_id=$this->session->getProfileData("c_id");
					//$report_id = '100051';
					//$idreport = $_REQUEST['id_of_report'];
					
					$response_data = array('type' => 'pie','name' =>  'Total TA Requests');
					if($report_id>0){
							$filter=array('Contact_Id'=>$c_id);
							$report_result=$this->model('custom/Login')->report_result($report_id,$filter,true);
							//print_r($report_result); exit;
								$inc_count = count($report_result);
								$closed = 	$loggedin = 	$pending = 0;
								$counter = $new = 0;
								$response_awaited = 0;
								//for($i = 0; $i < $inc_count; $i++) {
								foreach($report_result as $key => $response){	

									if($response['Status'] == "New") {
										++$new;
									}elseif($response['Status'] == "Closed") {
										++$closed;
									}
									else if($response['Status'] == "Logged in") {
										++$loggedin;
									}
									else if($response['Status'] == "Pending with initiator / internal team") {
										++$pending;
									}
									else if($response['Status'] == "Response Awaited") {
										++$response_awaited;
									}
									
								}
								$response_data['data'] = array(array("Closed",$closed),array("Logged in",$loggedin),array("Pending with initiator / internal team",$pending),array("Response Awaited",$response_awaited),array("New",$new));
								//json_encode($pie_chart)
					}
					print_r(json_encode($response_data));

			}
}