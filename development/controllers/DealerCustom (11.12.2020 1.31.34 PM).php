<?php
namespace Custom\Controllers;
use \RightNow\Connect\v1_3 as RNCPHP;

class DealerCustom extends \RightNow\Controllers\Base {
	//This is the constructor for the custom controller. Do not modify anything within
	//this function.
	function __construct() {
		parent::__construct();
		$this->load->library("Nusoap_lib");
		$this->load->helper('report');
		//$this->wsdlURL = 'http://tvscscrmservice.tvscredit.com/CRMService.svc?wsdl';
		$this->wsdlURL = 'http://tvscscrmservice.tvscredit.com/CRMService.svc?wsdl';
	}
	/**
	 * Sample function for ajaxCustom controller. This function can be called by sending
	 * a request to /ci/ajaxCustom/ajaxFunctionHandler.
	 */
	function ajaxFunctionHandler() {
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
	  function GetWCInsuranceResult(){
      if(!extension_loaded("curl")){
        load_curl();
      }
      $dealer_code = $_POST["dealercode"];
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/GetWCInsuranceExistDealer", //UAT: "http://tvscscrmservice.tvscredit.com/CRMService.svc/GetWCInsuranceExistDealer"
        CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n    \"DealerCode\": \"$dealer_code\"\n}",
        CURLOPT_HTTPHEADER => array(
          "Content-Type: application/json"
        ),
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      if ($err) {
        echo "cURL Error #:" . $err;
      }
      else{
        header('Content-type:application/json;charset=utf-8');
        $true_array = json_decode($response,true);
        print_r(json_encode($true_array,true));
      }
    } 
	
	function getWCPOPUP(){
      load_curl();
      $dealer_code = $_POST["DealerCode"];
      $curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/ShowWCPOPUPWindow",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\"DealerCode\":\"$dealer_code\"}",
		  CURLOPT_HTTPHEADER => array(
		    "Content-Type: application/json"
		  ),
		));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
            header('Content-type:application/json;charset=utf-8');
            $true_array = json_decode($response,true);
            print_r(json_encode($true_array,true));
      }  
    }
	
	function setWCPOPUP()
    {
            // print_r($_POST);
            load_curl();
            $dealer_code = $_POST["DealerCode"];
            $is_interested = $_POST["isInterested"];
            $comments = $_POST["Comments"];
            
            $curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/SaveWCPOPUPDetails",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS =>"{\n\t\"DealerCode\":\"$dealer_code\",\"IntrestFlag\":\"$is_interested\",\"Comments\":\"$comments\"\n}",
			  CURLOPT_HTTPHEADER => array(
			    "Content-Type: application/json"
			  ),
			));


            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
                  header('Content-type:application/json;charset=utf-8');
                  $true_array = json_decode($response,true);
                  print_r(json_encode($true_array,true));
            }
    }
	function getProductsName(){
      
      if(!extension_loaded("curl")){
          load_curl();

      }
          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => "http://leadsservice.tvscredit.com/LMSservice.svc/GetProductName",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 100,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array("Content-Length:0")
          ));

          $response = curl_exec($curl);
          $curl_error = curl_error($curl);
          curl_close($curl);
          if ($curl_error) {
            echo "Curl error occurred: ".$curl_error;
          }
          else{
            print_r($response);
          }
    
    }
    function saveLeadData() {

    load_curl();
    $dealer = $this->session->getProfileData("login");
    $postdata = $_POST;
    $email = $postdata['email'];
    $mobile = $postdata['mobile'];
    $action = $postdata['clickaction'];
    $loan_type = $postdata['loan_type'];
    $dlr_code = $dealer;
    /*

    */

    //  if ( isset( $mobile )and strlen( $mobile ) == 10 ) {
    $params = array(
        'title' => $postdata['title'],
        'first_name' => $postdata['first_name'],
        'middle_name' => $postdata['middle_name'],
        'last_name' => $postdata['last_name'],
        'Name' => $postdata['first_name'],
        'MiddleName' => $postdata['middle_name'],
        'LastName' => $postdata['last_name'],
        'Father_Spouse' => $postdata['Father_Spouse'],
        'Gender' => $postdata['Gender'],
        'CompanyName' => $postdata['CompanyName'],
        'CompanyAddress' => $postdata['CompanyAddress'],
        'CustProfile' => $postdata['CustProfile'],
        'Pancard' => $postdata['Pancard'],
        'Passport' => $postdata['Passport'],
        'Voterid' => $postdata['Voterid'],
        'Driving_License' => $postdata['Driving_License'],
        'Rationcard' => $postdata['Rationcard'],
        'Adharcard' => $postdata['Adharcard'],
        'Residentstatus' => $postdata['Residentstatus'],
        'ResidentStability' => $postdata['ResidentStability'],
        'LoanAmount' => $postdata['LoanAmount'],
        'Tenure' => $postdata['Tenure'],
        'RepaymentMode' => $postdata['RepaymentMode'],
        'EMIcomfort' => $postdata['EMIcomfort'],
        'MonthIncome' => $postdata['MonthIncome'],
        'Year' => $postdata['Year'],
        'Make' => $postdata['Make'],
        'Model' => $postdata['Model'],
        'Variant' => $postdata['Variant'],
        'loan_type' => $postdata['loan_type'],
        'date_of_birth' => $postdata['date_of_birth'],
        'email' => $postdata['email'],
        'Email' => $postdata['email'],
        'mobile' => $postdata['mobile'],
        'Mobile' => $postdata['mobile'],
        'address' => $postdata['address'],
        'Address' => $postdata['address'],
        'state' => $postdata['state'],
        'StateCode' => $postdata['state'],
        'city' => $postdata['city'],
        'Citycode' => $postdata['city'],
        'Pincode' => $postdata['Pincode'],
        'country' => $postdata['country'],
        'ACC1' => $postdata['ACC1'],
        'Experience' => $postdata['Experience'],
        'FinalisedCar' => $postdata['FinalisedCar'],
        'ChannelCode' => $postdata['ChannelCode'],
        'ProductCode' => $postdata['loan_type'],
        'loan_type' => $postdata['loan_type'],
        'AgencyCode' => $postdata['AgencyCode'],
        'CampaignCode' => $postdata['CampaignCode'],
        'Dealercode' => $dlr_code
    );
    //print_r($params);
    $LMS_result = soap_call('InsertLMSDataNew', $params);
    //  print_r(json_encode($LMS_result));exit;
    //echo '<p>Thanks for submitting your details. Your reference number is '.$LMS_result['InsertLMSDataResult'].'. We will get back to you soon. <a href="/app/employee/dashboard">Click here</a> to go back.</p>';
    // if($LMS_result['Error_Msg']=="Successfull"){
    // 	echo '<div style="color: #000000; background-color:#ffffff; font-weight:bold;padding:10px;">'.$LMS_result['InsertLMSDataNewResult'].'</div>';
    // }
    // else{
    // 	echo '<div style="color: #000000; background-color:#ffffff; font-weight:bold;padding:10px;">'.$LMS_result['Error_Msg'].'</div>';
    // }
    header('Content-type:application/json;charset=utf-8');
    print_r(json_encode($LMS_result));
    //header("Location: /app/employee/new_lead_thanks/ref_id/".$LMS_result['InsertLMSDataResult']);
    //  exit;
  }
	function getSalesDisbursedCount() {
		load_curl();
		date_default_timezone_set('Asia/Kolkata');
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$dealerCode = $_POST['dealerCode'];
		list($day, $month, $year) = explode("/", $startDate);
		list($day1, $month1, $year1) = explode("/", $endDate);
		//$year = date("Y",strtotime($startDate));
		//$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$response = array();
		$response[0] = array(
			'id' => 'series-1',
			'color' => '#875F9A',
			'name' => 'Current Financial year -' . $year1,
		);
		$finalArray = array();
		$count = 0;
		if ($month > $month1) {
			$month1 += 12;
		} //$month > $month1
		for ($i = $month; $i <= $month1; $i++) {
			if ($i > 12) {
				$fmonth = $i - 12;
				$sdate = "01/" . $fmonth . "/" . $year1;
				$eday = date('t', mktime(0, 0, 0, $fmonth, $day, $year1));
				$edate = $eday . "/" . $fmonth . "/" . $year1;
				$fyear = $year1;
			} //$i > 12
			else {
				$fmonth = $i;
				$sdate = "01/" . $fmonth . "/" . $year;
				$eday = date('t', mktime(0, 0, 0, $fmonth, $day, $year));
				$edate = $eday . "/" . $fmonth . "/" . $year;
				$fyear = $year;
			}
			$data = array(
				"methodName" => "getSalesDisbursedCount",
				"startDate" => $sdate,
				"endDate" => $edate,
				"dealerCode" => $dealerCode,
			);
			$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data, $url));
			//rand(0,10)
			if (!empty($respdata)) {
				foreach ($respdata as $value) {
					$finalArray[] = array(
						'name' => date("M", mktime(0, 0, 0, $fmonth, $day, $fyear)) . "-" . $fyear,
						"y" => (int) $value->NO_OF_APPLICATION,
					);
					$count += $value->NO_OF_APPLICATION;
				} //$respdata as $value
			} //!empty($respdata)
			else {
				$finalArray[] = null;
			}
		} //$i = $month; $i <= $month1; $i++
		$response[0]['data'] = $finalArray;
		$response[0]['total'] = $count;
		$prevYear = $year - 1;
		print_r(json_encode($response, JSON_NUMERIC_CHECK));
	}
	/*
		     * Function for Business Information to Summary Details for PDD Pending
		     * Param 1 => Start Date
		     * Param 2 => End Date
		     * Param 3 => Dealer Code
	*/
	function getPDDAgeingSummary() {
		load_curl();
		date_default_timezone_set('Asia/Kolkata');
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$dealerCode = $_POST['dealerCode'];
		list($day, $month, $year) = explode("/", $startDate);
		list($day1, $month1, $year1) = explode("/", $endDate);
		//$year = date("Y",strtotime($startDate));
		//$year = 2012;
		//$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$response = array();
		$response[0] = array(
			'id' => 'series-1',
			'color' => '#875F9A',
			'name' => 'Invoice with Ageing -' . $year,
		);
		$response[1] = array(
			'id' => 'series-2',
			'color' => '#F62459',
			'name' => 'Insurance with Ageing -' . $year,
		);
		$response[2] = array(
			'id' => 'series-3',
			'color' => '#F7A35C',
			'name' => 'RC Book with Ageing-' . $year,
		);
		$finalArray = array();
		$colorArray = array(
			'#875F9A',
			'#F62459',
			'#F7A35C',
		);
		for ($i = $month; $i <= $month1; $i++) {
			$sdate = "01/" . $i . "/" . $year;
			$eday = date('t', mktime(0, 0, 0, $i, 1, $year));
			$edate = $eday . "/" . $i . "/" . $year1;
			$data = array(
				"methodName" => "getPDDAgeingSummary",
				"startDate" => $sdate,
				"endDate" => $edate,
				"dealerCode" => $dealerCode,
			);
			$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data, $url));
			//print_r($respdata);
			//
			$flag_in = $flag_ins = $flag_rc = true;
			if (!empty($respdata)) {
				foreach ($respdata as $value) {
					if ($value->AGEING_TYPE == 'Invoice with Ageing' && $flag_in == true) {
						$finalArray[$value->AGEING_TYPE][] = array(
							'name' => date("M", mktime(0, 0, 0, $i, 1, $year)) . "-" . $year,
							"y" => (int) $value->COUNT,
						);
						$flag_in = false;
					} //$value->AGEING_TYPE == 'Invoice with Ageing' && $flag_in == true
					else {
						if ($flag_in) {
							$flag_in = true;
						}

					}
					if ($value->AGEING_TYPE == 'Insurance with Ageing' && $flag_ins == true) {
						$finalArray[$value->AGEING_TYPE][] = array(
							'name' => date("M", mktime(0, 0, 0, $i, 1, $year)) . "-" . $year,
							"y" => (int) $value->COUNT,
						);
						$flag_ins = false;
					} //$value->AGEING_TYPE == 'Insurance with Ageing' && $flag_ins == true
					else {
						if ($flag_ins) {
							$flag_ins = true;
						}

					}
					if ($value->AGEING_TYPE == 'RC Book with Ageing' && $flag_rc == true) {
						$finalArray[$value->AGEING_TYPE][] = array(
							'name' => date("M", mktime(0, 0, 0, $i, 1, $year)) . "-" . $year,
							"y" => (int) $value->COUNT,
						);
						$flag_rc = false;
					} //$value->AGEING_TYPE == 'RC Book with Ageing' && $flag_rc == true
					else {
						if ($flag_rc) {
							$flag_rc = true;
						}

					}
				} //$respdata as $value
				if ($flag_in) {
					$finalArray['Invoice with Ageing'][] = array(
						'name' => date("M", mktime(0, 0, 0, $i, 1, $year)) . "-" . $year,
						"y" => 0,
					);
				}

				if ($flag_ins) {
					$finalArray['Insurance with Ageing'][] = array(
						'name' => date("M", mktime(0, 0, 0, $i, 1, $year)) . "-" . $year,
						"y" => 0,
					);
				}

				if ($flag_rc) {
					$finalArray['RC Book with Ageing'][] = array(
						'name' => date("M", mktime(0, 0, 0, $i, 1, $year)) . "-" . $year,
						"y" => 0,
					);
				}

			} //!empty($respdata)
			else {
				$finalArray['Invoice with Ageing'][] = array(
					'name' => date("M", mktime(0, 0, 0, $i, 1, $year)) . "-" . $year,
					"y" => 0,
				);
				$finalArray['Insurance with Ageing'][] = array(
					'name' => date("M", mktime(0, 0, 0, $i, 1, $year)) . "-" . $year,
					"y" => 0,
				);
				$finalArray['RC Book with Ageing'][] = array(
					'name' => date("M", mktime(0, 0, 0, $i, 1, $year)) . "-" . $year,
					"y" => 0,
				);
			}
		} //$i = $month; $i <= $month1; $i++
		$response[0]['data'] = $finalArray['Invoice with Ageing'];
		$response[1]['data'] = $finalArray['Insurance with Ageing'];
		$response[2]['data'] = $finalArray['RC Book with Ageing'];
		$prevYear = $year - 1;
		print_r(json_encode($response, JSON_NUMERIC_CHECK));
	}
	/*

    */
	function getDealerDisbursalRestData() {
      
      date_default_timezone_set('Asia/Kolkata');
      $startDate = $_POST['start_date'];
      $endDate = $_POST['end_date'];
      $dealerCode = $_POST['dealer_code'];
      $methodName = $_POST['method'];
      $year = date("Y", strtotime($startDate));
      //$dealerCode = 7014;
      if(!extension_loaded("curl")){
        load_curl();
      }
     $curl = curl_init();

      curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/GetDealerDisbursalDetails",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS =>"{\n\t\"DealerCode\":\"$dealerCode\",\n\t\"FromDate\":\"$startDate\",\n\t\"Todate\":\"$endDate\"\n}",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/json"
	  ),
	));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
            if ($response->error_code == "1001" || $response == null) {
          $response = array("sEcho" => "0", "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
           print_r(json_encode($response));
         } else {
            print_r($response);
         }
      }
      
     
    }

    function reloadDealerDisbursalRestData() {
      
      date_default_timezone_set('Asia/Kolkata');
      $startDate = $_REQUEST['start_date'];
      $endDate = $_REQUEST['end_date'];
      $dealerCode = $_REQUEST['dealer_code'];
      //$dealerCode = 7014;
      if(!extension_loaded("curl")){
        load_curl();
      }
     $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/GetDealerDisbursalDetails",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n\"DealerCode\":\"$dealerCode\",\r\n\"FromDate\":\"$startDate\",\r\n\"Todate\":\"$endDate\"\r\n}",
        CURLOPT_HTTPHEADER => array(
          "Accept: */*",
          "Accept-Encoding: gzip, deflate",
          "Cache-Control: no-cache",
          "Connection: keep-alive",
          "Content-Type: application/json",
          "Host: tvscscrmuatservice.tvscredit.com",
          "Postman-Token: ddf39a6c-3d7c-403b-bec3-7e407f5482c8,0748b55a-1639-48ce-9cc8-941bb26e99bf",
          "User-Agent: PostmanRuntime/7.20.1",
          "cache-control: no-cache"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
            if ($response->error_code == "1001" || $response == null) {
          $response = array("sEcho" => "0", "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
           print_r(json_encode($response));
         } else {
            print_r($response);
         }
      }
     
    }
    function getPaymentRestData() 
{
    load_curl();
    date_default_timezone_set('Asia/Kolkata');
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $dealerCode = $_POST['dealer_code'];
    //$methodName = $_POST['method'];
    $year = date("Y", strtotime($startDate));
    //load_curl();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/GetDealerPaymentDetails",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\r\n\"DealerCode\":\"$dealerCode\",\r\n\"FromDate\":\"$startDate\",\r\n\"Todate\":\"$endDate\"\r\n}\r\n",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      print_r($response);
    }
  }
  function reloadPaymentDetails(){
    if(!(extension_loaded("curl"))){

    load_curl();
    }
    date_default_timezone_set('Asia/Kolkata');
    $startDate = $_REQUEST['start_date'];
    $endDate = $_REQUEST['end_date'];
    $dealerCode = $_REQUEST['dealer_code'];
    //$methodName = $_POST['method'];
    $year = date("Y", strtotime($startDate));
    //load_curl();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/GetDealerPaymentDetails",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\r\n\"DealerCode\":\"$dealerCode\",\r\n\"FromDate\":\"$startDate\",\r\n\"Todate\":\"$endDate\"\r\n}\r\n",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      print_r($response);
    }
    
  }

	function getSalesRestData() {
		// load_curl();
		date_default_timezone_set('Asia/Kolkata');
		$startDate = $_POST['start_date'];
		$endDate = $_POST['end_date'];
		$dealerCode = $_POST['dealer_code'];
		$methodName = $_POST['method'];
		$year = date("Y", strtotime($startDate));
		//$dealerCode = 7014;
		//$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$response = array();
		$data = array(
			"methodName" => "$methodName",
			"startDate" => $startDate,
			"endDate" => $endDate,
			"dealerCode" => $dealerCode,
		);
		$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data, $url));
		//$result = json_decode($respdata);
		//if (json_last_error() === JSON_ERROR_NONE) {
		//alert("valid json");
		//    }
		//  elseif (json_last_error() === 0) {
		// alert("valid json");
		//         }
		// else{
		//    alert("json not valid");
		// }
		if ($respdata->error_code == "1001" || $respdata == null) {
			$respdata = array(
				"sEcho" => "0",
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
			print_r(json_encode($respdata));
		} //$respdata->error_code == "1001" || $respdata == null
		else {
			print_r(json_encode($respdata));
		}
	}
	function reloadSalesRestData() {
		date_default_timezone_set('Asia/Kolkata');
		$startDate = $_REQUEST['start_date'];
		$endDate = $_REQUEST['end_date'];
		$dealerCode = $_REQUEST['dealer_code'];
		$methodName = $_REQUEST['method'];
		$year = date("Y", strtotime($startDate));
		//$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$response = array();
		if ($methodName == 'getDealerTATransaction') {
			// $arrParam = array('FromDate' => $startDate, 'ToDate' => $endDate, "DealerCode" => $dealerCode);
			// // print_r($arrParm);
			// // print_r($methodName);
			// // print_r($this->wsdlURL);
			// // exit;
			// $transactionSummary = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
			// //print_r($arrParam);
			// //print_r($transactionSummary);
			// $responseArray = array();
			// if (!empty($transactionSummary['getDealerTATransactionResult']['TA_Transaction_Data_Entity']))
			// {
			//   $dataResult = $transactionSummary['getDealerTATransactionResult']['TA_Transaction_Data_Entity'];
			//   if (!empty($dataResult)) {
			//     foreach ($dataResult as $key => $responseResult) {
			//       array_push($responseArray,$responseResult['objTATransaction']);
			//     }
			//   }
			// }
			// else {
			//   //$responseArray[] = "No Data Found";
			//   $responseArray = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
			// }
			// print_r($responseArray);
			// exit;
			load_curl();
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/getDealerTATransaction",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "{\n\t\"FromDate\": \"$startDate\",\n\t\"ToDate\": \"$endDate\",\n\t\"DealerCode\":\"$dealerCode\"\n}",
				CURLOPT_HTTPHEADER => array(
					"Content-Type: application/json",
					"Postman-Token: b053250d-e107-4e64-8626-04415fd26cd7",
					"cache-control: no-cache",
				),
			));
			$realresponse = array();
			$responses = curl_exec($curl);
			$responseArray = json_decode($responses);
			for ($i = 0; $i < count($responseArray); $i++) {
				array_push($realresponse, $responseArray[$i]->objTATransaction);
			} //$i = 0; $i < count($responseArray); $i++
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				echo "cURL Error #:" . $err;
			} //$err
			else {
				// // var_dump($realresponse);
				// print_r(json_encode($realresponse));
				$responses = $realresponse;
			}
		} //$methodName == 'getDealerTATransaction'
		elseif ($methodName == 'getTADealerSummary') {
			list($sday, $smonth, $syear) = explode("/", $startDate);
			list($eday, $emonth, $eyear) = explode("/", $endDate);
			$data = array(
				'methodName' => $methodName,
				'startDate' => date('d-M-Y', mktime(0, 0, 0, $smonth, $sday, $syear)),
				'endDate' => date('d-M-Y', mktime(0, 0, 0, $emonth, $eday, $eyear)),
				"dealerCode" => $dealerCode,
			);
			$responses = json_decode($this->nusoap_lib->getDealerAPIData($data, $url));
		} //$methodName == 'getTADealerSummary'
		else {
			$data = array(
				"methodName" => "$methodName",
				"startDate" => $startDate,
				"endDate" => $endDate,
				"dealerCode" => $dealerCode,
			);
			$responses = json_decode($this->nusoap_lib->getDealerAPIData($data, $url));
		}
		if ($responses->error_code == "1001" || is_null($responses)) {
			$response_to = array(
				"sEcho" => 0,
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
			header('Content-type:application/json;charset=utf-8');
			print_r(json_encode($response_to));
		} //$responses->error_code == "1001" || is_null($responses)
		else {
			 print_r(json_encode($responses));
		}
	}
	/*
		     * Function for Business Information to Summary Details for PDD Pending in Pie and Bar Chart
		     * Param 1 => Start Date
		     * Param 2 => End Date
		     * Param 3 => Dealer Code
	*/
	function getPDDAgeingChartSummary() {
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
		//$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$response = array();
		//echo strtotime($startDate);
		$colorArray = array(
			'#875F9A',
			'#F62459',
			'#F7A35C',
		);
		list($day, $month, $year) = explode("/", $startDate);
		//$year = date("Y",strtotime($startDate));
		$response[0] = array(
			'id' => 'series-1',
			'color' => '#054fa4',
			'name' => 'Ageing Wise Summary -' . $year,
		);
		$response[1] = array(
			'id' => 'series-2',
			'color' => '#875F9A',
			'name' => 'Ageing Wise Summary -' . $year,
		);
		$data = array(
			"methodName" => "getPDDAgeingSummary",
			"startDate" => $startDate,
			"endDate" => $endDate,
			"dealerCode" => $dealerCode,
		);
		//print_r($data);
		$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data, $url));
		//print_r($respdata);
		$count = 0;
		$total = 0;
		if (!empty($respdata) && $respdata->error_code != 1001) {
			foreach ($respdata as $value) {
				$finalArray[$count]['name'] = $value->AGEING_TYPE;
				$finalArray[$count]['y'] = $value->COUNT;
				$finalArray[$count]['color'] = $colorArray[$count];
				$finalArray[$count++]['count'] = $value->COUNT;
				$total += $value->COUNT;
			} //$respdata as $value
		} //!empty($respdata) && $respdata->error_code != 1001
		else {
			$finalArray = null;
		}
		$response[0]['data'] = $finalArray;
		$response[1]['data'] = $finalArray;
		$response[0]['total'] = $total;
		print_r(json_encode($response, JSON_NUMERIC_CHECK));
	}
	// end of function
	/*
	     *
	     * Summary SOAP Data
*/
	function getIncentiveSummarySoapData() {
		$yearRange = $_POST['date_range'];
		$dealerCode = $_POST['dealer_code'];
		$monthsel = $_POST['month_sel'];
		$methodName = $_POST['method'];
		$arrParam = array(
			'strDealer' => $dealerCode,
			'strFinMonth' => $monthsel,
			'strFinYr' => $yearRange,
		);
		$IncentiveSummary = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
		//print_r($IncentiveSummary);
		$responseArray = array();
		if (!empty($IncentiveSummary['GetDealerSalesIncentiveSummaryDetailsResult']['Dealer_SalesIncentiveSummary_Data_Entity'])) {
			$dataResult = $IncentiveSummary['GetDealerSalesIncentiveSummaryDetailsResult']['Dealer_SalesIncentiveSummary_Data_Entity'];
			if (!empty($dataResult)) {
				foreach ($dataResult as $key => $responseResult) {
					$responseArray[] = $responseResult['objDlrSalesIncenSummary'];
				} //$dataResult as $key => $responseResult
			} //!empty($dataResult)
		} //!empty($IncentiveSummary['GetDealerSalesIncentiveSummaryDetailsResult']['Dealer_SalesIncentiveSummary_Data_Entity'])
		else {
			//$responseArray[] = "No Data Found";
			$responseArray = array(
				"sEcho" => 0,
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
		}
		print_r(json_encode($responseArray));
	}
	/*
		     *
		     * Reload Incentive Soap Data
	*/
	function reloadIncentiveSoapData() {
		$yearRange = $_REQUEST['date_range'];
		$dealerCode = $_REQUEST['dealer_code'];
		$monthsel = $_REQUEST['month_sel'];
		$methodName = $_REQUEST['method'];
		$arrParam = array(
			'strDealer' => $dealerCode,
			'strFinMonth' => $monthsel,
			'strFinYr' => $yearRange,
		);
		$IncentiveSummary = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
		//print_r($IncentiveSummary);
		$responseArray = array();
		if (!empty($IncentiveSummary['GetDealerSalesIncentiveSummaryDetailsResult']['Dealer_SalesIncentiveSummary_Data_Entity'])) {
			$dataResult = $IncentiveSummary['GetDealerSalesIncentiveSummaryDetailsResult']['Dealer_SalesIncentiveSummary_Data_Entity'];
			if (!empty($dataResult)) {
				foreach ($dataResult as $key => $responseResult) {
					$responseArray[] = $responseResult['objDlrSalesIncenSummary'];
				} //$dataResult as $key => $responseResult
			} //!empty($dataResult)
		} //!empty($IncentiveSummary['GetDealerSalesIncentiveSummaryDetailsResult']['Dealer_SalesIncentiveSummary_Data_Entity'])
		else {
			//$responseArray[] = "No Data Found";
			$responseArray = array(
				"sEcho" => 0,
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
		}
		print_r(json_encode($responseArray));
	}
	/*
		     *
		     *
	*/
	function getCollectionIncentiveSummarySoapData() {
		$yearRange = $_POST['date_range'];
		$dealerCode = $_POST['dealer_code'];
		$monthsel = $_POST['month_sel'];
		$methodName = $_POST['method'];
		$arrParam = array(
			'strDealer' => $dealerCode,
			'strFinMonth' => $monthsel,
			'strFinYr' => $yearRange,
		);
		$IncentiveSummary = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
		//print_r($IncentiveSummary);
		$responseArray = array();
		if (!empty($IncentiveSummary['GetDealerCollectionIncentiveSummaryDetailsResult']['Dealer_CollectionIncentiveSummary_Data_Entity'])) {
			$dataResult = $IncentiveSummary['GetDealerCollectionIncentiveSummaryDetailsResult']['GetDealerCollectionIncentiveSummaryDetailsResult'];
			if (!empty($dataResult)) {
				foreach ($dataResult as $key => $responseResult) {
					$responseArray[] = $responseResult['objDlrCollectionIncenSum'];
				} //$dataResult as $key => $responseResult
			} //!empty($dataResult)
		} //!empty($IncentiveSummary['GetDealerCollectionIncentiveSummaryDetailsResult']['Dealer_CollectionIncentiveSummary_Data_Entity'])
		else {
			//$responseArray[] = "No Data Found";
			$responseArray = array(
				"sEcho" => 0,
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
		}
		print_r(json_encode($responseArray));
	}
	/*
		     * Reload Data
		     *
	*/
	function reloadCollectionIncentiveSoapData() {
		$yearRange = $_REQUEST['date_range'];
		$dealerCode = $_REQUEST['dealer_code'];
		$monthsel = $_REQUEST['month_sel'];
		$methodName = $_REQUEST['method'];
		$arrParam = array(
			'strDealer' => $dealerCode,
			'strFinMonth' => $monthsel,
			'strFinYr' => $yearRange,
		);
		$IncentiveSummary = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
		//print_r($IncentiveSummary);
		$responseArray = array();
		if (!empty($IncentiveSummary['GetDealerCollectionIncentiveSummaryDetailsResult']['Dealer_CollectionIncentiveSummary_Data_Entity'])) {
			$dataResult = $IncentiveSummary['GetDealerCollectionIncentiveSummaryDetailsResult']['Dealer_CollectionIncentiveSummary_Data_Entity'];
			if (!empty($dataResult)) {
				foreach ($dataResult as $key => $responseResult) {
					$responseArray[] = $responseResult['objDlrCollectionIncenSum'];
				} //$dataResult as $key => $responseResult
			} //!empty($dataResult)
		} //!empty($IncentiveSummary['GetDealerCollectionIncentiveSummaryDetailsResult']['Dealer_CollectionIncentiveSummary_Data_Entity'])
		else {
			//$responseArray[] = "No Data Found";
			$responseArray = array(
				"sEcho" => 0,
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
		}
		print_r(json_encode($responseArray));
	}
	/*
		     *
		     * Incentive Collection Details SOAP Data
	*/
	function getCollectionDetailsSoapData() {
		$yearRange = $_POST['date_range'];
		$dealerCode = $_POST['dealer_code'];
		$monthsel = $_POST['month_sel'];
		$methodName = $_POST['method'];
		$arrParam = array(
			'strDealer' => $dealerCode,
			'strFinMonth' => strtoupper($monthsel),
			'strFinYr' => $yearRange,
		);
		$IncentiveSummary = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
		//print_r($IncentiveSummary);
		$responseArray = array();
		if (!empty($IncentiveSummary['GetDealerCollectionIncentiveDetailsResult']['Dealer_CollectionIncentive_Data_Entity'])) {
			$dataResult = $IncentiveSummary['GetDealerCollectionIncentiveDetailsResult']['Dealer_CollectionIncentive_Data_Entity'];
			if (!empty($dataResult)) {
				foreach ($dataResult as $key => $responseResult) {
					$responseArray[] = $responseResult['objDealerCollectionIncentive'];
				} //$dataResult as $key => $responseResult
			} //!empty($dataResult)
		} //!empty($IncentiveSummary['GetDealerCollectionIncentiveDetailsResult']['Dealer_CollectionIncentive_Data_Entity'])
		else {
			//$responseArray[] = "No Data Found";
			$responseArray = array(
				"sEcho" => 0,
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
		}
		print_r(json_encode($responseArray));
	}
	/*
		     *
		     * Reload Incentive Collection Details Soap Data
	*/
	function reloadCollectionDetailsSoapData() {
		$yearRange = $_REQUEST['date_range'];
		$dealerCode = $_REQUEST['dealer_code'];
		$monthsel = $_REQUEST['month_sel'];
		$methodName = $_REQUEST['method'];
		$arrParam = array(
			'strDealer' => $dealerCode,
			'strFinMonth' => strtoupper($monthsel),
			'strFinYr' => $yearRange,
		);
		//print_r($arrParam);
		$IncentiveSummary = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
		//print_r($IncentiveSummary);
		$responseArray = array();
		if (!empty($IncentiveSummary['GetDealerCollectionIncentiveDetailsResult']['Dealer_CollectionIncentive_Data_Entity'])) {
			$dataResult = $IncentiveSummary['GetDealerCollectionIncentiveDetailsResult']['Dealer_CollectionIncentive_Data_Entity'];
			if (!empty($dataResult)) {
				foreach ($dataResult as $key => $responseResult) {
					$responseArray[] = $responseResult['objDealerCollectionIncentive'];
				} //$dataResult as $key => $responseResult
			} //!empty($dataResult)
		} //!empty($IncentiveSummary['GetDealerCollectionIncentiveDetailsResult']['Dealer_CollectionIncentive_Data_Entity'])
		else {
			//$responseArray[] = "No Data Found";
			$responseArray = array(
				"sEcho" => 0,
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
		}
		print_r(json_encode($responseArray));
	}
	/*
		     *
		     * Summary SOAP Data
	*/
	function getIncentiveDetailsSoapData() {
		$yearRange = $_POST['date_range'];
		$dealerCode = $_POST['dealer_code'];
		$monthsel = $_POST['month_sel'];
		$methodName = $_POST['method'];
		$arrParam = array(
			'strDealer' => $dealerCode,
			'strFinMonth' => strtoupper($monthsel),
			'strFinYr' => $yearRange,
		);
		$IncentiveSummary = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
		//print_r($IncentiveSummary);
		$responseArray = array();
		if (!empty($IncentiveSummary['GetDealerSalesIncentiveDetailsResult']['Dealer_SalesIncentive_Data_Entity'])) {
			$dataResult = $IncentiveSummary['GetDealerSalesIncentiveDetailsResult']['Dealer_SalesIncentive_Data_Entity'];
			if (!empty($dataResult)) {
				foreach ($dataResult as $key => $responseResult) {
					$responseArray[] = $responseResult['objDealerSalesIncentive'];
				} //$dataResult as $key => $responseResult
			} //!empty($dataResult)
		} //!empty($IncentiveSummary['GetDealerSalesIncentiveDetailsResult']['Dealer_SalesIncentive_Data_Entity'])
		else {
			//$responseArray[] = "No Data Found";
			$responseArray = array(
				"sEcho" => 0,
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
			//print_r(json_encode($respdata));
		}
		print_r(json_encode($responseArray));
	}
	/*
		     *
		     * Reload Incentive Soap Data
	*/
	function reloadIncentiveDetailsSoapData() {
		$yearRange = $_REQUEST['date_range'];
		$dealerCode = $_REQUEST['dealer_code'];
		$monthsel = $_REQUEST['month_sel'];
		$methodName = $_REQUEST['method'];
		$arrParam = array(
			'strDealer' => $dealerCode,
			'strFinMonth' => strtoupper($monthsel),
			'strFinYr' => $yearRange,
		);
		$IncentiveSummary = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
		//print_r($IncentiveSummary);
		$responseArray = array();
		if (!empty($IncentiveSummary['GetDealerSalesIncentiveDetailsResult']['Dealer_SalesIncentive_Data_Entity'])) {
			$dataResult = $IncentiveSummary['GetDealerSalesIncentiveDetailsResult']['Dealer_SalesIncentive_Data_Entity'];
			if (!empty($dataResult)) {
				foreach ($dataResult as $key => $responseResult) {
					$responseArray[] = $responseResult['objDealerSalesIncentive'];
				} //$dataResult as $key => $responseResult
			} //!empty($dataResult)
		} //!empty($IncentiveSummary['GetDealerSalesIncentiveDetailsResult']['Dealer_SalesIncentive_Data_Entity'])
		else {
			//$responseArray[] = "No Data Found";
			$responseArray = array(
				"sEcho" => 0,
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
		}
		print_r(json_encode($responseArray));
	}
	/*

    */
	function getTARestData() {
		load_curl();
		date_default_timezone_set('Asia/Kolkata');
		$dealerCode = $_POST['dealer_code'];
		$methodName = $_POST['method'];
		$year = date("Y", strtotime($startDate));
		//oldest url: $url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		//last url: https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=
		//new url(18 nov 2019):  https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutputAsHtml
		// $url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$url = "http://tvscscrmservice.tvscredit.com/CRMService.svc/getTARestData";
		$response = array();
		// $data = array(
		// 	"methodName" => "$methodName",
		// 	"dealerCode" => $dealerCode,
		// );
		//print_r($data);

		// $respdata = ($this->nusoap_lib->getDealerAPIData($data, $url));
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{\n\t\"DealerCode\":\"$dealerCode\"\n}",
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"Postman-Token: b053250d-e107-4e64-8626-04415fd26cd7",
				"cache-control: no-cache",
			),
		));
		$response = curl_exec($curl);
		$error = curl_error($curl);
		if($error){
			print_r("Curl Error"); 
		}
		else{
			print_r($response);

		}
	}
	/*
		     *
		     *
	*/
	function createTARequest() {
		$contactId = $_POST['contactID'];
		$amountReq = $_POST['maximum_amount'];
		$userData = $this->session->getSessionData("userProfile");
		/*
			        "{""primaryContact"":{""id"":3},""category"":{""id"":194},""queue"":{""id"":3},""statusWithType"":
			        {""status"": { ""id"": 1 } },""subject"":""New TA Request"",""customFields"":{""c"": {""amount_requested"":<value>}}}
			        "
		*/
		try {
			$incident = new RNCPHP\Incident();
			$incident->Subject = "New TA Request";
			//    $incident->Product =  RNCPHP\ServiceProduct::fetch(1);
			$incident->Category = RNCPHP\ServiceCategory::fetch(194);
			/*     $incident->Threads = new RNCPHP\ThreadArray();
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
			//    $incident->Organization = RNCPHP\Organization::fetch(8);
			$incident->PrimaryContact = RNCPHP\Contact::fetch($contactId); //Required field to create an incident through connect PHP
			$incident->Queue = new RNCPHP\NamedIDLabel();
			$incident->Queue->ID = 3;
			//$incident->Severity = new RNCPHP\NamedIDOptList();
			//$incident->Severity->LookupName  = 1;
			$incident->StatusWithType = new RNCPHP\StatusWithType();
			$incident->StatusWithType->Status = new RNCPHP\NamedIDOptList();
			$incident->StatusWithType->Status->ID = 1;
			$incident->CustomFields->c->amount_requested = $amountReq;
			$incident->save(RNCPHP\RNObject::SuppressAll);
			//echo "Incident Created";
			$responseArray[] = array(
				'value_id' => $incident->ID,
				'value_refno' => $incident->ReferenceNumber
			);
			//$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);
			
			print_r(json_encode($responseArray));
		} catch (Exception $err) {
			echo json_encode($err->getMessage());
		}
	}
	/*
		     *
		     * Trade Advance
	*/
	function createWCRequest() {
		$contactId = $_POST['contactID'];
		$amountReq = $_POST['maximum_amount'];
		$userData = $this->session->getSessionData("userProfile");
		$contact = RNCPHP\Contact::fetch($contactId);
		$dealerCode = $contact->CustomFields->c->dealer_code;
		try {
			$incident = new RNCPHP\Incident();
			$incident->Subject = "New Working Capital Request";
			$incident->Category = RNCPHP\ServiceCategory::fetch(1405);
			$incident->PrimaryContact = RNCPHP\Contact::fetch($contactId);
			$incident->Queue = new RNCPHP\NamedIDLabel();
			$incident->Queue->ID = 3;
			$incident->StatusWithType = new RNCPHP\StatusWithType();
			$incident->StatusWithType->Status = new RNCPHP\NamedIDOptList();
			$incident->StatusWithType->Status->ID = 1;
			$incident->CustomFields->c->amount_requested = $amountReq;
			$incident->save(RNCPHP\RNObject::SuppressAll);
			$invoicesArr = array();
			if (strlen($_POST["invoice_number_1"]) && strlen($_POST["invoice_amount_1"])) {
				array_push($invoicesArr, array(
					"dealer_code" => $dealerCode,
					"inv_no" => $_POST["invoice_number_1"],
					"inv_amt" => $_POST["invoice_amount_1"],
					"created_by" => $dealerCode,
					"created_date" => date("d/m/Y", strtotime("now")),
				));
				$invoice_1 = new RNCPHP\CO\Invoice();
				$invoice_1->InvoiceNumber = $_POST["invoice_number_1"];
				$invoice_1->InvoiceAmount = $_POST["invoice_amount_1"];
				$invoice_1->Incident = RNCPHP\Incident::fetch($incident->ID);
				if (isset($_FILES["invoice_1_file"]["tmp_name"]) && strlen($_FILES['invoice_1_file']['tmp_name'])) {
					$invoice_1->FileAttachmentArray = new RNCPHP\FileAttachmentCommonArray();
					$fattach = new RNCPHP\FileAttachmentCommon();
					$fattach->ContentType = $_FILES["invoice_1_file"]["type"];
					$fileContent = file_get_contents($_FILES['invoice_1_file']['tmp_name']);
					$fp = $fattach->makeFile();
					fwrite($fp, $fileContent);
					fclose($fp);
					$fileName = substr($_FILES['invoice_1_file']['name'], 0, 40);
					$fattach->FileName = $fileName;
					$fattach->Name = $fileName;
					$invoice_1->FileAttachments[] = $fattach;
				} //isset($_FILES["invoice_1_file"]["tmp_name"]) && strlen($_FILES['invoice_1_file']['tmp_name'])
				$invoice_1->save(RNCPHP\RNObject::SuppressAll);
			} //strlen($_POST["invoice_number_1"]) && strlen($_POST["invoice_amount_1"])
			if (strlen($_POST["invoice_number_2"]) && strlen($_POST["invoice_amount_2"])) {
				array_push($invoicesArr, array(
					"dealer_code" => $dealerCode,
					"inv_no" => $_POST["invoice_number_2"],
					"inv_amt" => $_POST["invoice_amount_2"],
					"created_by" => $dealerCode,
					"created_date" => date("d/m/Y", strtotime("now")),
				));
				$invoice_2 = new RNCPHP\CO\Invoice();
				$invoice_2->InvoiceNumber = $_POST["invoice_number_2"];
				$invoice_2->InvoiceAmount = $_POST["invoice_amount_2"];
				$invoice_2->Incident = RNCPHP\Incident::fetch($incident->ID);
				if (isset($_FILES["invoice_2_file"]["tmp_name"]) && strlen($_FILES['invoice_2_file']['tmp_name'])) {
					$invoice_2->FileAttachmentArray = new RNCPHP\FileAttachmentCommonArray();
					$fattach = new RNCPHP\FileAttachmentCommon();
					$fattach->ContentType = $_FILES["invoice_2_file"]["type"];
					$fileContent = file_get_contents($_FILES['invoice_2_file']['tmp_name']);
					$fp = $fattach->makeFile();
					fwrite($fp, $fileContent);
					fclose($fp);
					$fileName = substr($_FILES['invoice_2_file']['name'], 0, 40);
					$fattach->FileName = $fileName;
					$fattach->Name = $fileName;
					$invoice_2->FileAttachments[] = $fattach;
				} //isset($_FILES["invoice_2_file"]["tmp_name"]) && strlen($_FILES['invoice_2_file']['tmp_name'])
				$invoice_2->save(RNCPHP\RNObject::SuppressAll);
			} //strlen($_POST["invoice_number_2"]) && strlen($_POST["invoice_amount_2"])
			if (strlen($_POST["invoice_number_3"]) && strlen($_POST["invoice_amount_3"])) {
				array_push($invoicesArr, array(
					"dealer_code" => $dealerCode,
					"inv_no" => $_POST["invoice_number_3"],
					"inv_amt" => $_POST["invoice_amount_3"],
					"created_by" => $dealerCode,
					"created_date" => date("d/m/Y", strtotime("now")),
				));
				$invoice_3 = new RNCPHP\CO\Invoice();
				$invoice_3->InvoiceNumber = $_POST["invoice_number_3"];
				$invoice_3->InvoiceAmount = $_POST["invoice_amount_3"];
				$invoice_3->Incident = RNCPHP\Incident::fetch($incident->ID);
				if (isset($_FILES["invoice_3_file"]["tmp_name"]) && strlen($_FILES['invoice_3_file']['tmp_name'])) {
					$invoice_3->FileAttachmentArray = new RNCPHP\FileAttachmentCommonArray();
					$fattach = new RNCPHP\FileAttachmentCommon();
					$fattach->ContentType = $_FILES["invoice_3_file"]["type"];
					$fileContent = file_get_contents($_FILES['invoice_3_file']['tmp_name']);
					$fp = $fattach->makeFile();
					fwrite($fp, $fileContent);
					fclose($fp);
					$fileName = substr($_FILES['invoice_3_file']['name'], 0, 40);
					$fattach->FileName = $fileName;
					$fattach->Name = $fileName;
					$invoice_3->FileAttachments[] = $fattach;
				} //isset($_FILES["invoice_3_file"]["tmp_name"]) && strlen($_FILES['invoice_3_file']['tmp_name'])
				$invoice_3->save(RNCPHP\RNObject::SuppressAll);
			} //strlen($_POST["invoice_number_3"]) && strlen($_POST["invoice_amount_3"])
			if (strlen($_POST["invoice_number_4"]) && strlen($_POST["invoice_amount_4"])) {
				array_push($invoicesArr, array(
					"dealer_code" => $dealerCode,
					"inv_no" => $_POST["invoice_number_4"],
					"inv_amt" => $_POST["invoice_amount_4"],
					"created_by" => $dealerCode,
					"created_date" => date("d/m/Y", strtotime("now")),
				));
				$invoice_4 = new RNCPHP\CO\Invoice();
				$invoice_4->InvoiceNumber = $_POST["invoice_number_4"];
				$invoice_4->InvoiceAmount = $_POST["invoice_amount_4"];
				$invoice_4->Incident = RNCPHP\Incident::fetch($incident->ID);
				if (isset($_FILES["invoice_4_file"]["tmp_name"]) && strlen($_FILES['invoice_4_file']['tmp_name'])) {
					$invoice_4->FileAttachmentArray = new RNCPHP\FileAttachmentCommonArray();
					$fattach = new RNCPHP\FileAttachmentCommon();
					$fattach->ContentType = $_FILES["invoice_4_file"]["type"];
					$fileContent = file_get_contents($_FILES['invoice_4_file']['tmp_name']);
					$fp = $fattach->makeFile();
					fwrite($fp, $fileContent);
					fclose($fp);
					$fileName = substr($_FILES['invoice_4_file']['name'], 0, 40);
					$fattach->FileName = $fileName;
					$fattach->Name = $fileName;
					$invoice_4->FileAttachments[] = $fattach;
				} //isset($_FILES["invoice_4_file"]["tmp_name"]) && strlen($_FILES['invoice_4_file']['tmp_name'])
				$invoice_4->save(RNCPHP\RNObject::SuppressAll);
			} //strlen($_POST["invoice_number_4"]) && strlen($_POST["invoice_amount_4"])
			if (strlen($_POST["invoice_number_5"]) && strlen($_POST["invoice_amount_5"])) {
				array_push($invoicesArr, array(
					"dealer_code" => $dealerCode,
					"inv_no" => $_POST["invoice_number_5"],
					"inv_amt" => $_POST["invoice_amount_5"],
					"created_by" => $dealerCode,
					"created_date" => date("d/m/Y", strtotime("now")),
				));
				$invoice_5 = new RNCPHP\CO\Invoice();
				$invoice_5->InvoiceNumber = $_POST["invoice_number_5"];
				$invoice_5->InvoiceAmount = $_POST["invoice_amount_5"];
				$invoice_5->Incident = RNCPHP\Incident::fetch($incident->ID);
				if (isset($_FILES["invoice_5_file"]["tmp_name"]) && strlen($_FILES['invoice_5_file']['tmp_name'])) {
					$invoice_5->FileAttachmentArray = new RNCPHP\FileAttachmentCommonArray();
					$fattach = new RNCPHP\FileAttachmentCommon();
					$fattach->ContentType = $_FILES["invoice_5_file"]["type"];
					$fileContent = file_get_contents($_FILES['invoice_5_file']['tmp_name']);
					$fp = $fattach->makeFile();
					fwrite($fp, $fileContent);
					fclose($fp);
					$fileName = substr($_FILES['invoice_5_file']['name'], 0, 40);
					$fattach->FileName = $fileName;
					$fattach->Name = $fileName;
					$invoice_5->FileAttachments[] = $fattach;
				} //isset($_FILES["invoice_5_file"]["tmp_name"]) && strlen($_FILES['invoice_5_file']['tmp_name'])
				$invoice_5->save(RNCPHP\RNObject::SuppressAll);
			} //strlen($_POST["invoice_number_5"]) && strlen($_POST["invoice_amount_5"])
			if (count($invoicesArr) > 0) {
				load_curl();
				$dealerInvoicesUrl = "http://tvscscrmservice.tvscredit.com/CRMService.svc/Eligiblefordealer_invoicedetails";
				for ($i = 0; $i < count($invoicesArr); $i++) {
					$dealerInvoicesDataArr = $invoicesArr[$i];
					$dealerInvoicesDataJson = json_encode($dealerInvoicesDataArr, JSON_UNESCAPED_SLASHES);
					$curl = curl_init($dealerInvoicesUrl);
					curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($curl, CURLOPT_POSTFIELDS, $dealerInvoicesDataJson);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
					curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
					curl_setopt($curl, CURLOPT_TIMEOUT, 30);
					curl_setopt($curl, CURLOPT_HTTPHEADER, array(
						'Content-Type:application/json',
					));
					$dealerInvoicesResponseJson = curl_exec($curl);
					$dealerInvoicesResponseArr = json_decode($dealerInvoicesResponseJson, true);
				} //$i = 0; $i < count($invoicesArr); $i++
			} //count($invoicesArr) > 0
			$responseArray[] = array(
				'value_id' => $incident->ID,
				'value_refno' => $incident->ReferenceNumber,
			);
			print_r(json_encode($responseArray));
		} catch (Exception $err) {
			echo json_encode($err->getMessage());
		}
	}
	function getTADealerSummary() {
		load_curl();
		$startDate = $_POST['start_date'];
		$dealerCode = $_POST['dealer_code'];
		$endDate = $_POST['end_date'];
		$methodName = $_POST['method'];
		list($sday, $smonth, $syear) = explode("/", $startDate);
		list($eday, $emonth, $eyear) = explode("/", $endDate);
		$arrParam = array(
			'methodName' => $methodName,
			'startDate' => date('d-M-Y', mktime(0, 0, 0, $smonth, $sday, $syear)),
			'endDate' => date('d-M-Y', mktime(0, 0, 0, $emonth, $eday, $eyear)),
			"dealerCode" => $dealerCode,
		);
		//print_r($arrParam);
		//$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$respdata = json_decode($this->nusoap_lib->getDealerAPIData($arrParam, $url));
		//print_r($respdata);
		if ($respdata->error_code == "1001" || $respdata == null) {
			$respdata = array(
				"sEcho" => 0,
				"iTotalRecords" => "0",
				"iTotalDisplayRecords" => "0",
				"aaData" => array(),
			);
			print_r(json_encode($respdata));
		} //$respdata->error_code == "1001" || $respdata == null
		else {
			print_r(json_encode($respdata));
		}
		//$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data,$url));
	}
	/*
		     *
		     *
		     *
	*/
	function getTADealerData() {
		try {
			$startDate = $_POST['start_date'];
			$dealerCode = $_POST['dealer_code'];
			$endDate = $_POST['end_date'];
			$methodName = $_POST['method'];
			//    list($sday,$smonth,$syear) = explode("/",$startDate);
			//    list($eday,$emonth,$eyear) = explode("/",$endDate);
			$arrParam = array(
				'FromDate' => $startDate,
				'ToDate' => $endDate,
				"DealerCode" => $dealerCode,
			);
			// print_r($arrParm);
			// print_r($methodName);
			// print_r($this->wsdlURL);
			// exit;
			$transactionSummary = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
			//print_r($arrParam);
			$responseArray = array();
			if (!empty($transactionSummary['getDealerTATransactionResult']['TA_Transaction_Data_Entity'])) {
				$dataResult = $transactionSummary['getDealerTATransactionResult']['TA_Transaction_Data_Entity'];
				if (!empty($dataResult)) {
					foreach ($dataResult as $key => $responseResult) {
						array_push($responseArray, $responseResult['objTATransaction']);
					} //$dataResult as $key => $responseResult
				} //!empty($dataResult)
				print_r(json_encode($responseArray));
				// print_r($dataResult);
			} //!empty($transactionSummary['getDealerTATransactionResult']['TA_Transaction_Data_Entity'])
			else {
				//$responseArray[] = "No Data Found";
				$responseArray = array(
					"sEcho" => 0,
					"iTotalRecords" => "0",
					"iTotalDisplayRecords" => "0",
					"aaData" => array(),
				);
				print_r(json_encode($responseArray));
			}
		} catch (Exception $exx) {
			echo $exx->getMessage();
		}
	}
	function getTADealerDataREST() {
		$startDate = $_POST['start_date'];
		$dealerCode = $_POST['dealer_code'];
		$endDate = $_POST['end_date'];
		$methodName = $_POST['method'];
		load_curl();
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/getDealerTATransaction",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{\n\t\"FromDate\": \"$startDate\",\n\t\"ToDate\": \"$endDate\",\n\t\"DealerCode\":\"$dealerCode\"\n}",
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"Postman-Token: b053250d-e107-4e64-8626-04415fd26cd7",
				"cache-control: no-cache",
			),
		));
		$realresponse = array();
		$response = curl_exec($curl);
		$responseArray = json_decode($response);
		for ($i = 0; $i < count($responseArray); $i++) {
			array_push($realresponse, $responseArray[$i]->objTATransaction);
		} //$i = 0; $i < count($responseArray); $i++
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} //$err
		else {
			print_r(json_encode($realresponse));
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
	function getSalesPerformanceSummary() {
		load_curl();
		date_default_timezone_set('Asia/Kolkata');
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$dealerCode = $_POST['dealerCode'];
		list($day, $month, $year) = explode("/", $startDate);
		list($day1, $month1, $year1) = explode("/", $endDate);
		//$year = date("Y",strtotime($startDate));
		//$year = 2012;
		//$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$response = array();
		$response[0] = array(
			'id' => 'series-1',
			'color' => '#F62459',
			'name' => 'Login To Sanction -' . $year1,
		);
		$response[1] = array(
			'id' => 'series-2',
			'color' => '#F7A35C',
			'name' => 'Sanction To Disbursal -' . $year1,
		);
		//$response[2] = array('id' => 'series-3', 'color' => '#F7A35C','name'=> 'RC Book with Ageing-'.$year);
		$finalArray = array();
		$colorArray = array(
			'#875F9A',
			'#F62459',
			'#F7A35C',
		);
		if ($month > $month1) {
			$month1 += 12;
		} //$month > $month1
		for ($i = $month; $i <= $month1; $i++) {
			if ($i > 12) {
				$fmonth = $i - 12;
				$sdate = "01/" . $fmonth . "/" . $year1;
				$eday = date('t', mktime(0, 0, 0, $fmonth, 1, $year1));
				$edate = $eday . "/" . $fmonth . "/" . $year1;
				$fyear = $year1;
			} //$i > 12
			else {
				$fmonth = $i;
				$sdate = "01/" . $fmonth . "/" . $year;
				$eday = date('t', mktime(0, 0, 0, $fmonth, $day, $year));
				$edate = $eday . "/" . $fmonth . "/" . $year;
				$fyear = $year;
			}
			$data = array(
				"methodName" => "getSalesPerformanceSummary",
				"startDate" => $sdate,
				"endDate" => $edate,
				"dealerCode" => $dealerCode,
			);
			$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data, $url));
			//print_r($respdata);
			//
			$flag_in = $flag_ins = $flag_rc = true;
			if (!empty($respdata)) {
				foreach ($respdata as $value) {
					if ($value->TYPE == 'Login To Sanction' && $flag_in == true) {
						$finalArray[$value->TYPE][] = array(
							'name' => date("M", mktime(0, 0, 0, $fmonth, 1, $fyear)) . "-" . $fyear,
							"y" => (int) $value->VALUE,
							'count' => (int) $value->NO_OF_APPLICATION,
						);
						$flag_in = false;
					} //$value->TYPE == 'Login To Sanction' && $flag_in == true
					else {
						if ($flag_in) {
							$flag_in = true;
						}

					}
					if ($value->TYPE == 'Sanction To Disbursal' && $flag_ins == true) {
						$finalArray[$value->TYPE][] = array(
							'name' => date("M", mktime(0, 0, 0, $fmonth, 1, $fyear)) . "-" . $fyear,
							"y" => (int) $value->VALUE,
							'count' => (int) $value->NO_OF_APPLICATION,
						);
						$flag_ins = false;
					} //$value->TYPE == 'Sanction To Disbursal' && $flag_ins == true
					else {
						if ($flag_ins) {
							$flag_ins = true;
						}

					}
					/*     if($value->AGEING_TYPE == 'RC Book with Ageing' && $flag_rc  == true){
						                    $finalArray[$value->AGEING_TYPE][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => (int)$value->COUNT);
						                    $flag_rc  = false;
						                    }else{
						                    if($flag_rc)
						                    $flag_rc =  true;
					*/
				} //$respdata as $value
				if ($flag_in) {
					$finalArray['Login To Sanction'][] = array(
						'name' => date("M", mktime(0, 0, 0, $fmonth, 1, $fyear)) . "-" . $fyear,
						"y" => 0,
						"count" => 0,
					);
				}

				if ($flag_ins) {
					$finalArray['Sanction To Disbursal'][] = array(
						'name' => date("M", mktime(0, 0, 0, $fmonth, 1, $fyear)) . "-" . $fyear,
						"y" => 0,
						"count" => 0,
					);
				}

				/* if($flag_rc)
                $finalArray['RC Book with Ageing'][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0); */
			} //!empty($respdata)
			else {
				$finalArray['Login To Sanction'][] = array(
					'name' => date("M", mktime(0, 0, 0, $fmonth, 1, $fyear)) . "-" . $fyear,
					"y" => 0,
					"count" => 0,
				);
				$finalArray['Sanction To Disbursal'][] = array(
					'name' => date("M", mktime(0, 0, 0, $fmonth, 1, $fyear)) . "-" . $fyear,
					"y" => 0,
					"count" => 0,
				);
				//$finalArray['RC Book with Ageing'][] = array('name' => date("M",mktime(0,0,0,$i,1,$year))."-".$year, "y" => 0);
			}
		} //$i = $month; $i <= $month1; $i++
		$response[0]['data'] = $finalArray['Login To Sanction'];
		$response[1]['data'] = $finalArray['Sanction To Disbursal'];
		//$response[2]['data'] = $finalArray['RC Book with Ageing'];
		$prevYear = $year - 1;
		print_r(json_encode($response, JSON_NUMERIC_CHECK));
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
	function getSalesPerformanceChartSummary() {
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
		//$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$response = array();
		//echo strtotime($startDate);
		list($sday, $smonth, $syear) = explode("/", $startDate);
		list($sday1, $smonth1, $syear1) = explode("/", $endDate);
		$year = date("Y", mktime(0, 0, 0, $smonth, $sday, $syear));
		$response[0] = array(
			'id' => 'series-1',
			'color' => '#875F9A',
			'name' => 'Summary Details for Disbursal Pending -' . $syear1,
		);
		$response[1] = array(
			'id' => 'series-2',
			'colorByPoint' => true,
			'name' => 'Summary Details for Disbursal Pending -' . $syear1,
		);
		$data = array(
			"methodName" => "getSalesPerformanceSummary",
			"startDate" => $startDate,
			"endDate" => $endDate,
			"dealerCode" => $dealerCode,
		);
		//print_r($data);
		$respdata = json_decode($this->nusoap_lib->getDealerAPIData($data, $url));
		//print_r($respdata);
		$count = 0;
		$total_data = 0;
		if (!empty($respdata) && $respdata->error_code != 1001) {
			foreach ($respdata as $value) {
				$finalArray[$count]['name'] = $value->TYPE;
				if (!isset($value->VALUE) || empty($value->VALUE)) {
					$finalArray[$count]['y'] = 0;
				} else {
					$finalArray[$count]['y'] = $value->VALUE;
				}

				$finalArray[$count++]['count'] = $value->NO_OF_APPLICATION;
				$total_data += $value->NO_OF_APPLICATION;
			} //$respdata as $value
		} //!empty($respdata) && $respdata->error_code != 1001
		else {
			$finalArray = null;
		}
		$response[0]['data'] = $finalArray;
		$response[1]['data'] = $finalArray;
		$response[0]['total'] = $total_data;
		print_r(json_encode($response, JSON_NUMERIC_CHECK));
	}
	// end of function
	function getSalesDisbursedCountData() {
		load_curl();
		date_default_timezone_set('Asia/Kolkata');
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$dealerCode = $_POST['dealerCode'];
		//$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
		$response = array();
		$data = array(
			"methodName" => "getSalesDisbursedCount",
			"startDate" => $startDate,
			"endDate" => $endDate,
			"dealerCode" => $dealerCode,
		);
		 $respdata = json_decode($this->nusoap_lib->getDealerAPIData($data, $url));
		//print_r($respdata);
		//    print_r($data);
		$html_outout = '<div class="form-2">
                                                <h1><span class="log-in">Summary details for Dealer disbursal</span></h1>
                                                <p class="float">
                                                    <label for="TYPE"><i class="icon-user"></i>Type</label>
                                                    <input type="text" name="TYPE" value = "' . $respdata[0]->TYPE . '" disabled>
                                                </p>
                                                <p class="float">
                                                    <label for="NO_OF_APPLICATION"><i class="icon-lock"></i>No of Applications</label>
                                                    <input type="text" name="NO_OF_APPLICATION" value = "' . $respdata[0]->NO_OF_APPLICATION . '" disabled>
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
	function raiseDealerQueryRequest() {
		$contactId = $_POST['co_id'];
		//$amountReq = $_POST['maximum_amount'];
		//$userData=$this->session->getSessionData("userProfile");
		try {
			$incident = new RNCPHP\Incident();
			$incident->Subject = $_POST['Incident.Subject'];
			$incident->Product = RNCPHP\ServiceProduct::fetch($_POST['formData']['Incident.Product']);
			$incident->Category = RNCPHP\ServiceCategory::fetch($_POST['formData']['Incident.Category']);
			$incident->Threads = new RNCPHP\ThreadArray();
			$incident->Threads[0] = new RNCPHP\Thread();
			$incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
			$incident->Threads[0]->EntryType->ID = 4; // Used the ID here. See the Thread object for definition
			$incident->Threads[0]->Text = $_POST['Incident_Threads'];
			/* $incident->Threads[1] = new RNCPHP\Thread();
				            $incident->Threads[1]->EntryType = new RNCPHP\NamedIDOptList();
				            $incident->Threads[1]->EntryType->ID = 1; // Used the ID here. See the Thread object for definition
			*/
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
			//    $incident->Organization = RNCPHP\Organization::fetch(8);
			$incident->PrimaryContact = RNCPHP\Contact::fetch($contactId); //Required field to create an incident through connect PHP
			$incident->Queue = new RNCPHP\NamedIDLabel();
			$incident->Queue->ID = 2;
			//$incident->Severity = new RNCPHP\NamedIDOptList();
			//$incident->Severity->LookupName  = 1;
			$incident->StatusWithType = new RNCPHP\StatusWithType();
			$incident->StatusWithType->Status = new RNCPHP\NamedIDOptList();
			$incident->StatusWithType->Status->ID = 1;
			//\RightNow\Connect\v1_3\CO\City::fetch( "$city" );
			$incident->CustomFields->CO->Loan = \RightNow\Connect\v1_3\CO\Loan::fetch($_POST['formData']['Incident.CustomFields.CO.Loan.ID']);
			$incident->save(RNCPHP\RNObject::SuppressAll);
			//echo "Incident Created";
			$responseArray[] = array(
				'value_id' => $incident->ID,
				'value_refno' => $incident->ReferenceNumber,
			);
			//$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);
			print_r(json_encode($responseArray));
		} catch (Exception $err) {
			echo json_encode($err->getMessage());
		}
	}
	/*

    */
    
	function getDealerIncidentPieData() {
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$labels = array(
			'Logged in' => "label-important",
			'Closed' => "label-success",
			'Pending with initiator / internal team' => "label-info",
			'Response Awaited' => "label-warning",
			"New" => "label-important",
		);
		$msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incidents);
		$report_id = $msg->Value;
		//$c_id =3;
		$c_id = $this->session->getProfileData("c_id");
		//$report_id = '100051';
		//$idreport = $_REQUEST['id_of_report'];
		$response_data = array(
			'type' => 'pie',
			'name' => 'Total Incidents',
		);
		if ($report_id > 0) {
			$filter = array(
				'Contact_Id' => $c_id,
			);
			$report_result = $this->model('custom/Login')->report_result($report_id, $filter);
			//print_r($report_result); exit;
			$inc_count = count($report_result);
			$closed = $loggedin = $pending = 0;
			$counter = $new = 0;
			$response_awaited = 0;
			//for($i = 0; $i < $inc_count; $i++) {
			foreach ($report_result as $key => $response) {
				if ($response['Status'] == "New") {
					++$new;
				} //$response['Status'] == "New"
				elseif ($response['Status'] == "Closed") {
					++$closed;
				} //$response['Status'] == "Closed"
				else if ($response['Status'] == "Logged in") {
					++$loggedin;
				} //$response['Status'] == "Logged in"
				else if ($response['Status'] == "Pending with initiator / internal team") {
					++$pending;
				} //$response['Status'] == "Pending with initiator / internal team"
				else if ($response['Status'] == "Response Awaited") {
					++$response_awaited;
				} //$response['Status'] == "Response Awaited"
			} //$report_result as $key => $response
			$response_data['data'] = array(
				array(
					"Closed",
					$closed,
				),
				array(
					"Logged in",
					$loggedin,
				),
				array(
					"Pending with initiator / internal team",
					$pending,
				),
				array(
					"Response Awaited",
					$response_awaited,
				),
				array(
					"New",
					$new,
				),
			);
			//json_encode($pie_chart)
		} //$report_id > 0
		print_r(json_encode($response_data));
	}
	/*
		    TA Dealer Data API
	*/
	function getTADealerIncidentPieData() {
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$labels = array(
			'Logged in' => "label-important",
			'Closed' => "label-success",
			'Pending with initiator / internal team' => "label-info",
			'Response Awaited' => "label-warning",
			"New" => "label-important",
		);
		$msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incident_UserStatus);
		$report_id = $msg->Value;
		//$c_id =3;
		$c_id = $this->session->getProfileData("c_id");
		//$report_id = '100051';
		//$idreport = $_REQUEST['id_of_report'];
		$response_data = array(
			'type' => 'pie',
			'name' => 'Total TA Requests',
		);
		if ($report_id > 0) {
			$filter = array(
				'Contact_Id' => $c_id,
			);
			$report_result = $this->model('custom/Login')->report_result($report_id, $filter);
			//print_r($report_result); exit;
			$inc_count = count($report_result);
			$closed = $loggedin = $pending = 0;
			$counter = $new = 0;
			$response_awaited = 0;
			//for($i = 0; $i < $inc_count; $i++) {
			foreach ($report_result as $key => $response) {
				if ($response['Status'] == "New") {
					++$new;
				} //$response['Status'] == "New"
				elseif ($response['Status'] == "Closed") {
					++$closed;
				} //$response['Status'] == "Closed"
				else if ($response['Status'] == "Logged in") {
					++$loggedin;
				} //$response['Status'] == "Logged in"
				else if ($response['Status'] == "Pending with initiator / internal team") {
					++$pending;
				} //$response['Status'] == "Pending with initiator / internal team"
				else if ($response['Status'] == "Response Awaited") {
					++$response_awaited;
				} //$response['Status'] == "Response Awaited"
			} //$report_result as $key => $response
			$response_data['data'] = array(
				array(
					"Closed",
					$closed,
				),
				array(
					"Logged in",
					$loggedin,
				),
				array(
					"Pending with initiator / internal team",
					$pending,
				),
				array(
					"Response Awaited",
					$response_awaited,
				),
				array(
					"New",
					$new,
				),
			);
			//json_encode($pie_chart)
		} //$report_id > 0
		print_r(json_encode($response_data));
	}
	function getTADataList() {
		$startDate = $_REQUEST['startDate'];
		$endDate = $_REQUEST['endDate'];
		$c_id = $this->session->getProfileData("c_id");
		$msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incident_UserStatus);
		$report_id = $msg->Value;
		if ($report_id > 0) {
			$dateArray = array(
				'sdate' => $startDate,
				'edate' => $endDate,
			);
			$filter = array(
				'Contact_Id' => $c_id,
			);
			$report_result = $this->model('custom/Login')->report_result($report_id, $filter, $dateArray);
			print_r(json_encode($report_result));
		} //$report_id > 0
	}
	function getWCDataList() {
		$startDate = $_REQUEST['startDate'];
		$endDate = $_REQUEST['endDate'];
		$c_id = $this->session->getProfileData("c_id");
		$dateArray = array(
			'sdate' => $startDate,
			'edate' => $endDate,
		);
		$filter = array(
			'Contact_Id' => $c_id,
		);
		$report_result = $this->model('custom/Login')->report_result(100410, $filter, $dateArray);
		print_r(json_encode($report_result));
	}
	/* function for ApproverEmail */
	function sendApproverEmailRequest() {
		// $dealerCode = $_POST['dcode'];
		// $incident_id = $_POST['i_id'];
		// if (!empty($incident_id)) {
		// 	$methodName = 'getTARequestEmailIds';
		// 	$arrParam = array(
		// 		'DealerCode' => $dealerCode,
		// 	);
		// 	$emailResult = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
		// 	$incident = \RightNow\Connect\v1_3\Incident::fetch($incident_id);
		// 	$contact_id = $incident->PrimaryContact->ID;
		// 	$contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
		// 	$dealerName = $contact->Name->First . " " . $contact->Name->Last;
		// 	$branch_id = $contact->CustomFields->CO->DealerBranch->ID;
		// 	if (strlen($branch_id)) {
		// 		$branch = \RightNow\Connect\v1_3\CO\Branch::fetch($branch_id);
		// 		$branch_code = $branch->Branch_Code;
		// 		$branch_name = $branch->Branch_Name;
		// 	} //strlen($branch_id)
		// 	//Array ( [getTARequestEmailIdsResult] => Array ( [Dealer_TARequestDetails_Data_Entity] => Array ( [DealerCode] => [objDlrReqDetails] => Array ( [BCC] => Chandrasekar.s@tvscredit.com [ToEmailId] => Shobha.J@tvscredit.com ) ) ) )
		// 	if (!empty($emailResult['getTARequestEmailIdsResult']['Dealer_TARequestDetails_Data_Entity'])) {
		// 		$resultArray = $emailResult['getTARequestEmailIdsResult']['Dealer_TARequestDetails_Data_Entity'];
		// 		$userData = $this->session->getSessionData("userProfile");
		// 		//$dealerName = $userData['sess_first_name'] . ' ' . $userData['sess_last_name'];
				$dealerCode = $_POST['dcode'];
      $incident_id = $_POST['i_id'];
      if (!empty($incident_id)) {
        // $methodName = 'getTARequestEmailIds';
        // $arrParam = array('DealerCode' => $dealerCode);
        // $emailResult = soap_dealer_call($methodName, $arrParam, $this->wsdlURL);
        $incident = \RightNow\Connect\v1_3\Incident::fetch($incident_id);
        $contact_id = $incident->PrimaryContact->ID;
        $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
        $dealerName = $contact->Name->First." ".$contact->Name->Last;
        $branch_id = $contact->CustomFields->CO->DealerBranch->ID;
        if (strlen($branch_id)) {
          $branch = \RightNow\Connect\v1_3\CO\Branch::fetch($branch_id);
          $branch_code = $branch->Branch_Code;
          $branch_name = $branch->Branch_Name;
        }

        //Array ( [getTARequestEmailIdsResult] => Array ( [Dealer_TARequestDetails_Data_Entity] => Array ( [DealerCode] => [objDlrReqDetails] => Array ( [BCC] => Chandrasekar.s@tvscredit.com [ToEmailId] => Shobha.J@tvscredit.com ) ) ) )
        // if (!empty($emailResult['getTARequestEmailIdsResult']['Dealer_TARequestDetails_Data_Entity'])) {
          \load_curl();
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/getTARequestEmailIds",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 180,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n\t\"DealerCode\":\"$dealerCode\"\n}",
          CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            
            "Content-Type: application/json",
            "Host: tvscscrmservice.tvscredit.com",
            "Postman-Token: 42598393-5185-4b57-9849-ec7d51723b0e,78268d91-5d29-4013-ac87-37deca288912",
            "User-Agent: PostmanRuntime/7.17.1",
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $responseArr= json_decode($response,true);
        
        if (!empty($responseArr[0]['objDlrReqDetails']))
        {
		        $resultArray = $responseArr; //$emailResult['getTARequestEmailIdsResult']['Dealer_TARequestDetails_Data_Entity'];
		        $userData = $this->session->getSessionData("userProfile");
				load_curl();
				date_default_timezone_set('Asia/Kolkata');
				//$url = "http://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
				$url = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj=";
				$response_json = array();
				$data = array(
					"methodName" => "getTADealerRequest",
					"dealerCode" => $dealerCode,
				);
				//print_r($data);
				$response_json = ($this->nusoap_lib->getDealerAPIData($data, $url));
				$response_arr = json_decode($response_json, true);
				//$subject = 'A new TA Request has been raised';
				// $body = '<html><head></head><body>';
				// $body .= '<div><p>';
				// $body .= 'Hi,'."\r\n\r\n\r\n";
				// $body .= 'A new TA Request has been raised by '.$dealerName.' with Incident ID  '.$incident_id."\r\n\r\n";
				// $body .= 'Please use the link https://tvscs.custhelp.com/app/employee/login to login to employee portal to approve the request.'."\r\n\r\n";
				// $body .= 'Thanks'."\r\n\r\n";
				// $body .= 'TVS-Credit';
				// $body .= '</p></div></body></html>';
				// $text = nl2br($body);
				$subject = "TA TRACTOR " . $dealerCode . " - " . $dealerName . " - TA Request Number is " . $incident->ReferenceNumber;
				$body = "<html>
                <head></head>
                <body>
                <p>Dear Sir / Madam,</p>
                <p>New TA requested,</p>
                <p>
                TA Request Number : " . $incident->ReferenceNumber . "<br>
                Request Amount : " . $incident->CustomFields->c->amount_requested . "<br>
                Request Date : " . date("d-M-Y", $incident->CreatedTime) . "<br>
                Dealer Code : " . $dealerCode . "<br>
                Dealer Name : " . $dealerName . "<br>
                Branch Code : " . $branch_code . "<br>
                Branch Name : " . $branch_name . "<br>
                Maximum Eligiable Amount : " . $response_arr["0"]["TA_MAXIMUM_ELIGIBLE_AMOUNT"] . "<br>
                As on Balance Amount : " . $response_arr["0"]["TA_BALANCE_AS_ON_DATE"] . "<br>
                </p>
                <p>Thanking You.</p>
                <p>This is an automatically generated email. Please do not reply.</p>
                </body>
        		</html>";
				$this->nusoap_lib->postRequest($resultArray, $incident_id, $subject, $body);
			}
			else{
		          try{
		              $tcount = count($incident->Threads);
		              if($tcount == 0){
		                $incident->Threads = new RNCPHP\ThreadArray();
		              }
		              $incident->Threads[$tcount] = new RNCPHP\Thread();
		              $incident->Threads[$tcount]->EntryType = new RNCPHP\NamedIDOptList();
		              $incident->Threads[$tcount]->EntryType->ID = 1; // Entry type as note
		              $incident->Threads[$tcount]->Text = "TVS API Error - Could not send Emails to approvers. CURL ERROR: (if any) ".$err;
		              $incident->save();
		            }
		            catch(\Exception $e){
		              print_r($e->getMessage());
		            }
		        } //!empty($emailResult['getTARequestEmailIdsResult']['Dealer_TARequestDetails_Data_Entity'])
		} //!empty($incident_id)
	}
	function sendWcApproverEmailRequest() {
		$dealerCode = $_POST['dcode'];
		$incident_id = $_POST['i_id'];
		$maximum_eligibleamount = $_POST['maximum_eligibleamount'];
		$ta_balance = $_POST['ta_balance'];
		$dealer_type = $_POST['dealer_type'];
		$contact_id_from_PAGE = $_POST['contact_id'];
		//echo ">>1";
		if (!empty($incident_id)) {
			$incident = \RightNow\Connect\v1_3\Incident::fetch($incident_id);
			$contact_id = $incident->PrimaryContact->ID;
			$contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
			$dealerName = $contact->Name->First . " " . $contact->Name->Last;
			$branch_id = $contact->CustomFields->CO->DealerBranch->ID;
			if (strlen($branch_id)) {
				$branch = \RightNow\Connect\v1_3\CO\Branch::fetch($branch_id);
				$branch_code = $branch->Branch_Code;
				$branch_name = $branch->Branch_Name;
			} //strlen($branch_id)
			//---Added by lakshay on 14 june 2019 for Associate Dealer WC req changes asked by hari
			$filter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
			$filter->Name = 'Contact ID';
			$filter->Values = array(
				"$contact_id_from_PAGE",
			);
			$filters = new RNCPHP\AnalyticsReportSearchFilterArray;
			$filters[0] = $filter;
			$ar = \RightNow\Connect\v1_3\AnalyticsReport::fetch(100492);
			$arr = $ar->run(0, $filters);
			if (count($arr) > 0) {
				$row = $arr->next();
				$parent_dealer_branch_code = $row['Main Branch Code'];
				$parent_dealer_branch_name = $row['Main Branch Name'];
				$parent_dealer_code = $row['Main Dealer Code'];
				$parent_dealer_name = $row['Main Dealer Full Name'];
				// echo ">>2";
			} //count($arr) > 0
			//-------------end of changes----------------
			load_curl();
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/getTARequestEmailIds",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "{\"DealerCode\":\"$dealerCode\"}",
				CURLOPT_HTTPHEADER => array(
					"Cache-Control: no-cache",
					"Content-Type: application/json",
				),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$responseArr = json_decode($response, true);
			//echo ">>3";
			//print_r($emailResult);
			//Array ( [getTARequestEmailIdsResult] => Array ( [Dealer_TARequestDetails_Data_Entity] => Array ( [DealerCode] => [objDlrReqDetails] => Array ( [BCC] => Chandrasekar.s@tvscredit.com [ToEmailId] => Shobha.J@tvscredit.com ) ) ) )
			if (!empty($responseArr[0]['objDlrReqDetails'])) {
				$resultArray = $responseArr;
				$userData = $this->session->getSessionData("userProfile");
				//$dealerName = $userData['sess_first_name'] . ' ' . $userData['sess_last_name'];
				$subject = "WC " . $dealerCode . " - " . $dealerName . " - WC Request Number is " . $incident->ReferenceNumber;
				//echo ">>4";
				if ($dealer_type == 'Associate Dealer') {
					$body = "<html>
                  <head></head>
                  <body>
                  <p>Dear Sir / Madam,</p>
                  <p>New WC requested,</p>
                  <p>
                  WC Request Number : " . $incident->ReferenceNumber . "<br>
                  Request Amount : " . $incident->CustomFields->c->amount_requested . "<br>
                  Request Date : " . date("d-M-Y", $incident->CreatedTime) . "<br>
                  Dealer Code : " . $dealerCode . "<br>
                  Dealer Name : " . $dealerName . "<br>
                  Branch Code : " . $branch_code . "<br>
                  Branch Name : " . $branch_name . "<br>
          Main Dealer Code: " . $parent_dealer_code . "<br>
          Main Dealer Name: " . $parent_dealer_name . "<br>
          Main Dealer Branch: " . $parent_dealer_branch_name . "<br>
          Main Dealer Branch Code: " . $parent_dealer_branch_code . "<br>
                  Maximum Eligiable Amount : " . $maximum_eligibleamount . "<br>
                  As on Balance Amount : " . $ta_balance . "<br>
                  </p>
                  <p>Thanking You.</p>
                  <p>This is an automatically generated email. Please do not reply.</p>
                  </body>
          </html>";
					// echo ">>5";
				} //$dealer_type == 'Associate Dealer'
				else if ($dealer_type == 'Parent Dealer') {
					$body = "<html>
                            <head></head>
                            <body>
                            <p>Dear Sir / Madam,</p>
                            <p>New WC requested,</p>
                            <p>
                            WC Request Number : " . $incident->ReferenceNumber . "<br>
                            Request Amount : " . $incident->CustomFields->c->amount_requested . "<br>
                            Request Date : " . date("d-M-Y", $incident->CreatedTime) . "<br>
                            Dealer Code : " . $dealerCode . "<br>
                            Dealer Name : " . $dealerName . "<br>
                            Branch Code : " . $branch_code . "<br>
                            Branch Name : " . $branch_name . "<br>
                            Maximum Eligiable Amount : " . $maximum_eligibleamount . "<br>
                            As on Balance Amount : " . $ta_balance . "<br>
                            </p>
                            <p>Thanking You.</p>
                            <p>This is an automatically generated email. Please do not reply.</p>
                            </body>
                            </html>";
					//echo ">>6";
				} //$dealer_type == 'Parent Dealer'
				$this->nusoap_lib->postRequest($resultArray, $incident_id, $subject, $body);
				// echo ">>7";
			} //!empty($responseArr[0]['objDlrReqDetails'])
		} //!empty($incident_id)
	}
	//create incident
	function create_inc() {
		$CI = &get_instance();
		$CI->load->helper('report');
		$contact_id = $CI->session->getProfileData("c_id");
		try {
			$incident = new RNCPHP\Incident();
			$incident->Subject = "Call me back";
			//$incident->Product =  RNCPHP\ServiceProduct::fetch($_POST['formData']['Incident.Product']);
			$incident->Category = RNCPHP\ServiceCategory::fetch(878);
			$incident->Threads = new RNCPHP\ThreadArray();
			$incident->Threads[0] = new RNCPHP\Thread();
			$incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
			$incident->Threads[0]->EntryType->ID = 4; // Used the ID here. See the Thread object for definition
			$incident->Threads[0]->Text = $_POST['assistance'] . "\n\r Call on " . $_POST['contact_number'];
			//$incident->Language = new RNCPHP\NamedIDOptList();
			//$incident->Language->ID =1;
			//$incident->Mailbox = RNCPHP\Mailbox::fetch(30);
			//    $incident->Organization = RNCPHP\Organization::fetch(8);
			$incident->PrimaryContact = RNCPHP\Contact::fetch($contact_id); //Required field to create an incident through connect PHP
			$incident->Queue = new RNCPHP\NamedIDLabel();
			$incident->Queue->ID = 2;
			//$incident->Severity = new RNCPHP\NamedIDOptList();
			//$incident->Severity->LookupName  = 1;
			$incident->StatusWithType = new RNCPHP\StatusWithType();
			$incident->StatusWithType->Status = new RNCPHP\NamedIDOptList();
			$incident->StatusWithType->Status->ID = 1;
			$incident->CustomFields->c->call_date_time = strtotime($_POST['datetime_speak']);
			$incident->save();
			//echo "Incident Created";
			$responseArray[] = array(
				'value_id' => $incident->ID,
				'value_refno' => $incident->ReferenceNumber,
			);
			//$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);
			print_r(json_encode($responseArray));
		} catch (Exception $err) {
			echo json_encode($err->getMessage());
		}
	}

	function downloadInvoice()
	{
	    $dealer_code = $_POST["dealer_code"];
	    $year = $_POST["year"];
	    $month = $_POST["month"];
	    load_curl();
	    $curl = curl_init();
	    curl_setopt_array($curl, array(
	      CURLOPT_URL => "http://tvscscrmservice.tvscredit.com/CRMService.svc/CDDealerInvoiceDetails",
	      CURLOPT_RETURNTRANSFER => true,
	      CURLOPT_ENCODING => "",
	      CURLOPT_MAXREDIRS => 10,
	      CURLOPT_TIMEOUT => 30,
	      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	      CURLOPT_CUSTOMREQUEST => "POST",
	      CURLOPT_POSTFIELDS => "{\n    \"DealerCode\": \"$dealer_code\"\n}",
	      CURLOPT_HTTPHEADER => array(
	        "Content-Type: application/json"
	      ),
	    ));
	    $response = curl_exec($curl);
	    $err = curl_error($curl);
	    curl_close($curl);
	    if ($err) {
	      echo "cURL Error #:" . $err;
	    } else {
	      $responseArr = json_decode($response, true);
	      for($i = 0; $i < count($responseArr); $i++){
	        if($responseArr[$i]["Year"] == $year && $responseArr[$i]["Month"] == $month){
	          $downloadId = $responseArr[$i]["DownloadId"];
	          $url = "http://tvscscrmservice.tvscredit.com/CRMService.svc/GetCDDealerInvoice/".$downloadId;
	          echo $url;
	          break;
	        }
	      }
	    }
	  }

	  // function getOrderSummaryRestData() 
   //    {
   //                date_default_timezone_set('Asia/Kolkata');
   //                $startDate = $_POST['startDate'];
   //                $endDate = $_POST['endDate'];
   //                $dealerCode = $_POST['dealerCode'];
   //                // list($day, $month, $year) = explode("/", $startDate);
   //                // list($day1, $month1, $year1) = explode("/", $endDate);
   //                if(!extension_loaded("curl")){
   //                  load_curl();
   //                }
   //               $curl = curl_init();

                

   //          curl_setopt_array($curl, array(
   //            CURLOPT_URL => "https://dealerportalservicesuat.tvscredit.com/DealerDetails/GetODSummary",
   //            CURLOPT_RETURNTRANSFER => true,
   //            CURLOPT_ENCODING => "",
   //            CURLOPT_MAXREDIRS => 10,
   //            CURLOPT_TIMEOUT => 0,
   //            CURLOPT_FOLLOWLOCATION => true,
   //            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   //             CURLOPT_SSL_VERIFYPEER=> false,
   //            CURLOPT_CUSTOMREQUEST => "POST",
   //            CURLOPT_POSTFIELDS =>"{\r\n\"Dealer\":\"$dealerCode\",\r\n\"from\":\"$startDate\",\r\n\"to\":\" $endDate\"\r\n}",
   //            CURLOPT_HTTPHEADER => array(
   //              "Authorization: Basic QWRtaW46UGFzc3dvcmQ=",
   //              "Content-Type: application/json"
   //            ),
   //          ));

   //          $response = curl_exec($curl);

   //          curl_close($curl);
   //         if ($err) {
   //          echo "cURL Error #:" . $err;
   //        } else {
   //                header('Content-type:application/json;charset=utf-8');
   //                $dealer_summary = json_decode($response,true);
                  
   //                    if ($dealer_summary["ReturnMessage"] == "No Data Found." || $dealer_summary["ReturnOutput"] == null) 
   //                    {
   //                      $dealer_summary["ReturnOutput"] = array("sEcho" => "0", "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
   //                       print_r(json_encode($dealer_summary["ReturnOutput"]));
   //            }
   //        else {
   //          print_r(json_encode($dealer_summary["ReturnOutput"]));
   //       }
   //                // print_r(json_encode($dealer_summary["ReturnOutput"],true));
   //           }
   //        }


          function getOrderSummaryRestData() 
      {
                  date_default_timezone_set('Asia/Kolkata');
                  $startDate = $_POST['startDate'];
                  $endDate = $_POST['endDate'];
                  $dealerCode = $_POST['dealerCode'];
                  // list($day, $month, $year) = explode("/", $startDate);
                  // list($day1, $month1, $year1) = explode("/", $endDate);
                  if(!extension_loaded("curl")){
                    load_curl();
                  }
                 $curl = curl_init();

                

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://dealerportalservices.tvscredit.com/DealerDetails/GetODSummary",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_SSL_VERIFYPEER=> false,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\r\n\"Dealer\":\"$dealerCode\",\r\n\"from\":\"$startDate\",\r\n\"to\":\" $endDate\"\r\n}",
              CURLOPT_HTTPHEADER => array(
                "Authorization: Basic QWRtaW46UGFzc3dvcmQ=",
                "Content-Type: application/json"
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
           if ($err) {
            echo "cURL Error #:" . $err;
          } else {
                  header('Content-type:application/json;charset=utf-8');
                  $dealer_summary = json_decode($response,true);
                  
                      if ($dealer_summary["ReturnMessage"] == "No Data Found." || $dealer_summary["ReturnOutput"] == null) 
                      {
                        $dealer_summary["ReturnOutput"] = array("sEcho" => "0", "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
                         print_r(json_encode($dealer_summary["ReturnOutput"]));
              }
          else {
            print_r(json_encode($dealer_summary["ReturnOutput"]));
         }
                  // print_r(json_encode($dealer_summary["ReturnOutput"],true));
             }
          }
          function upload_document_enabler()
     {
        try{
        load_curl();
        $Pid = $_POST["pid"];
        $agg_no = $_POST["agg_no"];
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://dealerportalservices.tvscredit.com/DealerDetails/GetPDDStatus",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_SSL_VERIFYPEER=>false,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>"{\r\n\"Pid\":\"$agg_no\"\r\n}",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Basic QWRtaW46UGFzc3dvcmQ=",
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
                    echo "cURL Error #:" . $err;
                  }

        else {
                  header('Content-type:application/json;charset=utf-8');
                  $upload_doc_array = json_decode($response,true);
                  print_r(json_encode($upload_doc_array['ReturnOutput'],true));
             }  

        }
        catch(Exception $ex){
          echo $ex->getMessage();
        }
     }

     function statcheck()
     {
        try{
        load_curl();
        $type = $_POST["type"];
        $agg_no = $_POST["agg_no"];
        $dlc = $_POST["dlc"];
        $curl = curl_init();

          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://dealerportalservices.tvscredit.com/DealerDetails/GetPDDUploadStatus",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_SSL_VERIFYPEER=>false,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>"{\r\n\"agmt\":\"$agg_no\",\r\n\"type\":\"$type\"\r\n}",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Basic QWRtaW46UGFzc3dvcmQ=",
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
                    echo "cURL Error #:" . $err;
                  }

        else {
                  header('Content-type:application/json;charset=utf-8');
                  $upload_doc_array = json_decode($response,true);
                  print_r(json_encode($upload_doc_array['ReturnOutput'],true));
             }  

        }
        catch(Exception $ex){
          echo $ex->getMessage();
        }
     }



     function upload_pdd_files()
     {


      try{

         $div = $_POST["divname"];
         $type=strtoupper($_POST["type"]);
         $con_id=$_POST["contact"];
         $agmt=$_POST["agmt"];
         $dealer=$_POST["dealer"];
         // $type_forapi=$_POST["type"];

     if(isset($_FILES))
     {
        // print_r($_FILES);
        // print_r($_POST);

        // echo $contact;
        // echo $_FILES["file0Insurance"]["name"];
        // echo $_FILES["file1Insurance"]["name"];
        // echo $type;
      
     }
$fcount = count($_FILES);
for($i=0;$i<$fcount;$i++)
{
  if ( isset( $_FILES['file'.$i.$div]['tmp_name'] ) and strlen( $_FILES['file'.$i.$div]['tmp_name'] ) ) {
                    if(isset($_POST['document_type']) and strlen(($_POST['document_type'])))
                    {
                        $document_type  = $_POST['document_type'];
                    }
                    $fileContent          = file_get_contents( $_FILES['file'.$i.$div]['tmp_name'] );
                    $fileType             = $_FILES['file'.$i.$div]['type'];
                    $ext                  = end( explode( ".", $_FILES['file'.$i.$div]['name'] ) );
                    // Add FileAttachment
                    $con = RNCPHP\Contact::fetch( $con_id );
                    $con->FileAttachments = new RNCPHP\FileAttachmentCommonArray();
                    $fattach              = new RNCPHP\FileAttachmentCommon();
                    $fattach->ContentType = "$fileType";
                    $fp                   = $fattach->makeFile();
                    fwrite( $fp, $fileContent );
                    fclose( $fp );
                    $fattach->FileName      = $_FILES['file'.$i.$div]['name'];
                    $fattach->Name          = $_FILES['file'.$i.$div]['name'];
                    $fattach->Description   = "File Uploaded By: " . $Session_UserDisplayName . " (ID:" . $user_id . ")" ." Document Type : ".$document_type;
                    $fattach->Name          = $_FILES['file'.$i.$div]['name'];
                    $fattach->Description = $type.$i."_".$agmt;
                    $con->FileAttachments[] = $fattach;
                    $con->save();


                    
                   
                    // $con->FileAttachments = new RNCPHP\FileAttachmentCommonArray();
                }

}
                                $fattachArr= $con->FileAttachments;
                                $count_attach=count($fattachArr);
                                for($j=0;$j<4;$j++)
                                {
                                  for($f=0;$f<$count_attach;$f++)
                                  {
                                    // echo $fattachArr[$f]->Description."next";

                                    if($fattachArr[$f]->Description==$type.$j."_".$agmt)
                                    {
                                    $id= $fattachArr[$f]->ID;
                                    $attachment[$type.$j."_".$agmt]="https://tvscs.custhelp.com/services/rest/connect/v1.3/contacts/".$con_id."/fileAttachments/".$id."?download";
                                    
                                    }

                                  }
                                }

                                $url1=$attachment[$type."0"."_".$agmt];
                                $url2=$attachment[$type."1"."_".$agmt];
                                $url3=$attachment[$type."2"."_".$agmt];
                                $url4=$attachment[$type."3"."_".$agmt];
                                // echo "hello".$url1.$url2.$url3.$url4;

                                // print_r(json_encode($attachment));
                                load_curl();
                                $curl = curl_init();
                                if($type=="INV")
                                {
                                  
                                curl_setopt_array($curl, array(
                                CURLOPT_URL => " https://dealerportalservices.tvscredit.com/DealerDetails/PDDImage",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_SSL_VERIFYPEER=> false,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "POST",
                                CURLOPT_POSTFIELDS =>"{\r\n\r\n\"agmt\":\"$agmt\",\r\n\"type\":\"$type\",\r\n\"dlrocde\":\"$dealer\",\r\n\"page1\":\"$url1\",\r\n\"page2\":\"$url2\",\r\n\"page3\":\"$url3\"\r\n}",
                                CURLOPT_HTTPHEADER => array(
                                  "Authorization: Basic QWRtaW46UGFzc3dvcmQ=",
                                  "Content-Type: application/json"
                                ),
                                ));
                                }

                                elseif ($type!="INV") 
                                 
                                {
                                  curl_setopt_array($curl, array(
                                  CURLOPT_URL => "https://dealerportalservices.tvscredit.com/DealerDetails/PDDImage",
                                  CURLOPT_RETURNTRANSFER => true,
                                  CURLOPT_ENCODING => "",
                                  CURLOPT_MAXREDIRS => 10,
                                  CURLOPT_TIMEOUT => 0,
                                  CURLOPT_SSL_VERIFYPEER=> false,
                                  CURLOPT_FOLLOWLOCATION => true,
                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                  CURLOPT_CUSTOMREQUEST => "POST",
                                  CURLOPT_POSTFIELDS =>"{\r\n\r\n\"agmt\":\"$agmt\",\r\n\"type\":\"$type\",\r\n\"dlrocde\":\"$dealer\",\r\n\"page1\":\"$url1\",\r\n\"page2\":\"$url2\",\r\n\"page3\":\"$url3\",\r\n\"page4\":\"$url4\"\r\n\r\n\r\n}",
                                  CURLOPT_HTTPHEADER => array(
                                    "Authorization: Basic QWRtaW46UGFzc3dvcmQ=",
                                    "Content-Type: application/json"
                                  ),
                                ));                                  
                                }
                                

                              $response = curl_exec($curl);
                              $err = curl_error($curl);

                              curl_close($curl);

                              if ($err) {
                                $error_arr = array("ReturnMessage" => $err);
                                print_r(json_encode($error_arr,true));
                                // echo "cURL Error #:" . $err;
                              } else {
                                    // header('Content-type:application/json;charset=utf-8');
                                    $true_array = json_decode($response,true);
                                    print_r(json_encode($true_array["ReturnMessage"],true));

                              }


        }
        catch(Exception $ex){
          echo $ex->getMessage();
        }

     }


    function getGST_PAN()
    {   
        try{
        load_curl();
        $dealer_code = $_POST["dlc"];
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://dealerportalservices.tvscredit.com/DealerDetails/GetDealerProfile",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_SSL_VERIFYPEER=>false,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n\t\"Dealer\":\"".$dealer_code."\"\n}",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Basic QWRtaW46UGFzc3dvcmQ=",
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
                    echo "cURL Error #:" . $err;
                  }

        else {
                  header('Content-type:application/json;charset=utf-8');
                  $pan_gst_array = json_decode($response,true);
                  print_r(json_encode($pan_gst_array,true));
             }  
        }
        catch(Exception $ex){
          echo $ex->getMessage();
        }
        // echo $response;
    }
  function getImpData(){
      $result = $this->model('custom/Preferences')->getImpData($_POST["c_id"]);
      header('Content-type:application/json;charset=utf-8');
      print_r(json_encode($result,true));
    }


       function fetch_aggreement_no()
    {
      try
      {
        // load_curl();
        $Cid = $_POST["Cid"];
        $dlc = $_POST["dlc"];
        $ar= RNCPHP\AnalyticsReport::fetch(100682);
        $status_filter0= new RNCPHP\AnalyticsReportSearchFilter;
        $status_filter0->Name = 'contacts';
        $status_filter0->Values = array($Cid); 
        $filters = new RNCPHP\AnalyticsReportSearchFilterArray;
        $filters[0] = $status_filter0;
        $arr= $ar->run( 0, $filters );
          if($arr->count()>0)
          {
            $Agreement_No=array();
            for($i=0; $i<$arr->count();$i++)
            {
              $row = $arr->next();
              $Agreement_No[$i] = $row["Agreement No"];
              
            }
            print_r(json_encode($Agreement_No));
            
          }

        // $curl = curl_init();
      }
       catch(Exception $ex)
      {
       echo $ex->getMessage();
      }
    }
	  

	   function CreateIncident()
    {
    	$contact = $_POST["con"];
    	$email = $_POST["email"];
    	$phone = $_POST["phone"];

    //report call
      //check count
      //if > 0 then say message 
      // otherwise create incident
      
    	try {

            $ar= RNCPHP\AnalyticsReport::fetch(100683);
            $status_filter0= new RNCPHP\AnalyticsReportSearchFilter;
            $status_filter0->Name = 'Contact ID';
            $status_filter0->Values = array($contact); 
            $filters = new RNCPHP\AnalyticsReportSearchFilterArray;
            $filters[0] = $status_filter0;
            $arr= $ar->run( 0, $filters );
              if($arr->count()==0)        
                   {
                  		$contact_ob =  RNCPHP\Contact::fetch($contact);
                  		$orignal_email = $contact_ob->Emails[0]->Address;
                  		$orignal_phone=  $contact_ob->Phone[0]->Number;
                  		$fname = $contact_ob->Name->First;
                  		$lname = $contact_ob->Name->Last;
                  		$full_name = $fname." ".$lname;
                  		$dealer_code = $contact_ob->CustomFields->c->dealer_code;

                      $incident = new RNCPHP\Incident();
                     // Change in {parameter} is requested by the Dealer {full name},  Dealer Code: {delaer+code} <br> {parameter} to be changed: {parameter value} <br>
                      $incident->Subject = "Dealer Contact details enquiry";
                      $incident->Category = RNCPHP\ServiceCategory::fetch(1365);
                      $incident->Threads = new RNCPHP\ThreadArray();
                      $incident->Threads[0] = new RNCPHP\Thread();
                      $incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
                      $incident->Threads[0]->EntryType->ID = 4; // Used the ID here. See the Thread object for definition customer
                      if($email==$orignal_email && $phone!=$orignal_phone )
                      {
                           $incident->Threads[0]->Text =  "Change in phone no. is requested by the Dealer: ".$full_name.",  Dealer Code: ".$dealer_code ." \nPhone no. to be changed: ".$_POST["phone"] ;
                      }
                      if($email!=$orignal_email && $phone==$orignal_phone )
                      {
                               $incident->Threads[0]->Text =  "Change in email is requested by the Dealer: ".$full_name.",  Dealer Code: ".$dealer_code ." \nEmail to be changed: ".$_POST["email"] ;
                      }
                      if($email!=$orignal_email && $phone!=$orignal_phone )
                      {
                                $incident->Threads[0]->Text =  "Change in email and phone no. is requested by the Dealer: ".$full_name.",  Dealer Code: ".$dealer_code ." \nEmail to be changed: ".$_POST["email"]." \nPhone no. to be changed: ".$_POST["phone"] ;
                      }
                      

                      $incident->PrimaryContact = RNCPHP\Contact::fetch($contact); //Required field to create an incident through connect PHP
                      $incident->StatusWithType = new RNCPHP\StatusWithType();
                      $incident->StatusWithType->Status = new RNCPHP\NamedIDOptList();
                      $incident->StatusWithType->Status->ID = 1;//unresolved
                      $incident->save();
                      //echo "Incident Created";
                      $responseArray[] = array('value_id' => $incident->ID, 'value_refno' => $incident->ReferenceNumber);
                      //$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);
                      print_r(json_encode($responseArray));
                   }
                   else
                   {
                    
                   }
          } 
          catch (Exception $err) 
          {
            echo json_encode($err->getMessage());
          }
    }
}