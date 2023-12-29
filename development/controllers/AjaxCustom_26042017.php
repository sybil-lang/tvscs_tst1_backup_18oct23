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
class AjaxCustom extends \RightNow\Controllers\Base
{
    //This is the constructor for the custom controller. Do not modify anything within
    //this function.
    function __construct()
    {
        parent::__construct();
        $this->load->library("Nusoap_lib");
		$this->load->helper('report');
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

    /**
     * Sample search function
     */
    function search () {
        $filters = json_decode($this->input->post('filters'), true);
        $filters['limit'] = array('value' => $this->input->request('limit'));
        $sourceID = $this->input->post('sourceID');

        $search = \RightNow\Libraries\Search::getInstance($sourceID);
        $search->addFilters($filters);

        echo json_encode($search->executeSearch());
    }

	/*
	*
	*/
	function soap_call($functionName, $arrparam){
		
	//	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
		load_curl();
		$this->load->library("Nusoap_lib");
		$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_TVS_API_URL );
		$url = $msg->Value;
		//$client = new SoapClient( $url, 'wsdl' );
		//$client->soap_defencoding = 'UTF-8';
		$param = array( 'parameters' => $arrparam );
		//$response = $client->call( $functionName, $param );
		/*$soapError = $client->getError();
		if ( !empty( $soapError ) ) {
			return 'SOAP method invocation failed:' . $soapError;
		} else {
			if ( is_array( $response ) ) {
				return $response;
			} else {
				return $response;
			}
		}*/

	
	}

	/*
* Get Gender for Lead Form
*/
	function getKeyProfileFields(){
			
			$functionName = $_REQUEST['methodName'];
			$agencyCode = $_REQUEST['agencyCode'];
			$Key_code = $_REQUEST['key_code'];
			$url = $_REQUEST['tvsApi'];
			
			$arrParam = array('Key_code' => $Key_code,'AgencyCode' => $agencyCode);
			
			$VProfileFieldsList = soap_lead_call($functionName,$arrParam,$url );
			//print_r($VStateList);
			$VProfileFieldsJson =  json_encode($VProfileFieldsList[ 'GetVCommonFieldsResult' ][ 'LMS_Common_Fields_Entity' ]);
		//	return $VStateJson;
			print_r($VProfileFieldsJson);
		}

/*
* Get Repayment Type for Lead Form
*/
	function getRepaymentType(){
			
			$functionName = $_REQUEST['methodName'];
			$agencyCode = $_REQUEST['agencyCode'];
			$url = $_REQUEST['tvsApi'];
			
			$arrParam = array('AgencyCode' => $agencyCode);
			
			$VRepaymentType = soap_lead_call($functionName,$arrParam,$url );
			//print_r($VStateList);
			$VRepaymentTypeJson =  json_encode($VRepaymentType[ 'GetVRepaymentTypeResult' ][ 'LMS_RepaymentType_Entity' ]);
		//	return $VStateJson;
			print_r($VRepaymentTypeJson);
		}
/*
* Get State for Lead Form
*/
	function getState(){
			
			$functionName = $_REQUEST['methodName'];
			$agencyCode = $_REQUEST['agencyCode'];
			$url = $_REQUEST['tvsApi'];
			
			$arrParam = array('AgencyCode' => $agencyCode);
			
			$VStateList = soap_lead_call($functionName,$arrParam,$url );
			//print_r($VStateList);
			$VStateJson =  json_encode($VStateList[ 'GetVStateNameResult' ][ 'LMS_State_Entity' ]);
		//	return $VStateJson;
			print_r($VStateJson);
		}

/*
*
*/
/*
* Get City for Lead Form
*/
		function getCity(){
			
		//	$functionName = $_REQUEST['methodName'];
			$agencyCode = $_REQUEST['agencyCode'];
			$stateCode = $_REQUEST['statecode'];
			$url = $_REQUEST['tvsApi'];
			
			
			$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_REPORT_INDIAN_STATES_AND_CITIES );
			$cityreport_id = $msg->Value;
			if ( $cityreport_id > 0 ) {
				$filter = array('State Code' => $stateCode);
				$city_Array = report_result( $cityreport_id, $filter );
			}
			$cityArray = array();
			$i = 0;
			foreach($city_Array as $key => $result){
					$cityArray[$i]['City_Code'] = $result['City Code'];
					$cityArray[$i++]['City_Name'] = $result['City Name'];
			}
			print_r(json_encode($cityArray));
		}
	
/*
* Get City for Lead Form
*/
		function getYear(){
			
			$functionName = $_REQUEST['methodName'];
			$agencyCode = $_REQUEST['agencyCode'];
			$url = $_REQUEST['tvsApi'];
			
			$arrParam = array( 'AgencyCode' => $agencyCode);
			
			
			$VYearNameList = soap_lead_call($functionName,$arrParam,$url );
			//print_r($VStateList);
			$VYearJson =  json_encode( $VYearNameList[ 'GetVDynamicLast20YearsResult' ][ 'LMS_DynamicYearGen_Entity' ]);
		//	return $VStateJson;
			print_r($VYearJson);
		}

		/*
		*
		*/
	function get_make(){
		$functionName = $_REQUEST['methodName'];
			$agencyCode = $_REQUEST['agencyCode'];
			$yearCode = $_REQUEST['year'];
			$url = $_REQUEST['tvsApi'];
			
			if(!empty($yearCode)){
				$arrParam = array( 'Year' =>$yearCode,'AgencyCode' => $agencyCode);
			}else{
				
				$arrParam = array( 'Year' => date('Y'),'AgencyCode' => $agencyCode);

			}
			
			$VMakeList = soap_lead_call($functionName,$arrParam,$url );
			//print_r($VStateList);
			$VMakeJson =  json_encode( $VMakeList['getVMakeListResult']['LMS_IBBMake_Entity']);
		//	return $VStateJson;
			print_r($VMakeJson);
	}

	function get_model(){

			$functionName = $_REQUEST['methodName'];
			$agencyCode = $_REQUEST['agencyCode'];
			$yearCode = $_REQUEST['year'];
			$make = $_REQUEST['make'];
			$url = $_REQUEST['tvsApi'];
			
			if(!empty($yearCode)){
				$arrParam = array( 'Year' =>$yearCode,'Make'=>$make,'AgencyCode' => $agencyCode);
			}else{
				
				$arrParam = array( 'Year' => date('Y'),'Make'=>$make,'AgencyCode' => $agencyCode);

			}
			
			$VModelList = soap_lead_call($functionName,$arrParam,$url );
			//print_r($VStateList);
			$VModelJson =  json_encode( $VModelList['getVModelListResult']['LMS_IBBModel_Entity']);
		//	return $VStateJson;
			print_r($VModelJson);
        	
	}


	function get_varient(){
		
		$functionName = $_REQUEST['methodName'];
			$agencyCode = $_REQUEST['agencyCode'];
			$yearCode = $_REQUEST['year'];
			$make = $_REQUEST['make'];
			$model = $_REQUEST['model'];
			$url = $_REQUEST['tvsApi'];
			
			if(!empty($model)){
				$arrParam = array( 'Year' =>$yearCode,'Make'=>$make, 'Model' => $model,'AgencyCode' => $agencyCode);
			}else{
				
				$arrParam = array( 'Year' => date('Y'),'Make'=>$make,  'Model' => 'UNO', 'AgencyCode' => $agencyCode);

			}
			
			$V_VariantlList = soap_lead_call($functionName,$arrParam,$url );
			//print_r($VStateList);
			$VariantJson =  json_encode( $V_VariantlList['getV_VariantlListResult']['LMS_IBBVariant_Entity']);
		//	return $VStateJson;
			print_r($VariantJson);
        	
	}

	/**
     * Perform the login of a user given their username/password. Returns the result from the
     * login. Either additional redirect information, or an error message.
     */
    public function doOTPLogin()
    {
        //AbuseDetection::check();
        if(!$this->checkForValidFormToken()) {
            $this->_renderJSON(array('message' => Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG), 'showLink' => false));
            return;
        }
		
        $userID = $this->input->post('login');
        $password = $this->input->post('password');
        $sessionID = $this->session->getSessionData('sessionID');
        $widgetID  = $this->input->post('w_id');
        $url = $this->input->post('url');
        $result = $this->model('custom/Login')->doLogin($userID, $password, $sessionID, $widgetID, $url)->result;
        $this->_renderJSON($result);
    }

	/**
     * Looks for a form token in the post parameters and verifies its validity.
     * @return Boolean Whether the form token exists and is valid
     */
    private function checkForValidFormToken() {
        $formToken = $this->input->post('f_tok');
        return count($_POST) && $formToken && Framework::isValidSecurityToken($formToken, 0);
    }

	/**
     * Send the OTP to User on Given Mobile Number if exist in Rightnow Contact. Either additional redirect information, or an error message.
     */
    public function doOTPSend()
    {
        //AbuseDetection::check();
        if(!$this->checkForValidFormToken()) {
            $this->_renderJSON(array('message' => Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG), 'showLink' => false));
            return;
        }
        $mnumber = $this->input->post('login');
        $sessionID = $this->session->getSessionData('sessionID');
        $widgetID  = $this->input->post('w_id');
        $url = $this->input->post('url');
        $result = $this->model('custom/Login')->sendOTP($mnumber, $sessionID, $widgetID, $url)->result;
        $this->_renderJSON($result);
    }

	/*
	* REST API Integration for LMS and RMS
	*/
	//akash changes
	function rest_api_call() {
		 load_curl();
		// $ch = curl_init("http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:".$_REQUEST['method'].",agreementNo:".$_REQUEST['ag_no']."}");
		$apitoken = $this->nusoap_lib->generateToken();
		if(empty($apitoken)){
					return 'Token Mismatch';
		}
		//$result = '';

		 $ch = curl_init("https://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:".$_REQUEST['method'].",agreementNo:".$_REQUEST['ag_no']."}");
		 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//		 curl_setopt($ch,CURLOPT_POSTFIELDS,$data_encoded);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','token_id: '.$apitoken,"content-length: 0"));
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 $result = curl_exec($ch);
		 $data_decode=json_decode($result);
		 if($_REQUEST['method'] == "getCustomerDetails") {

			 $html_outout = '<div class="form-2">
									<h1><span class="log-in">Login Status</span></h1>
									
									<p class="float">
										<label for="Customer_Name"><i class="fa fa-user"></i>Customer Name</label>
										<input type="text" name="Customer_Name" value = "'.$data_decode[0]->CUSTOMER_NAME.'" disabled> 
									</p>
									<p class="float">
										<label for="gender"><i class="fa fa-transgender" aria-hidden="true"></i> Gender</label>
										<input type="text" name="db_date" value = "'.$data_decode[0]->GENDER.'" disabled>
									</p>
									<p class="float">
										<label for="DATE_OF_BIRTH"><i class="fa fa-calendar"></i>Date of Birth</label>
										<input type="text" name="birth_date" value = "'.$data_decode[0]->DATE_OF_BIRTH.'" disabled>
									</p>
									<p class="float">
										<label for="address"><i class="fa fa-address-card" aria-hidden="true"></i>Address</label>
										<textarea name="address" disabled>'.$data_decode[0]->ADDRESS.'</textarea>;
									</p>
									<p class="float">
										<label for="AGREEMENT_NUMBER"><i class="fa fa-lock"></i>Agreement Number</label>
										<input type="text" name="AGREEMENT_NUMBER" value = "'.$data_decode[0]->AGREEMENT_NUMBER.'" disabled>
									</p>
									<!--<p class="float">
										<label for="LOGIN_DATE"><i class="fa fa-calendar"></i>Login Date</label>
										<input type="text" name="LOGIN_DATE" value = "'.$data_decode[0]->LOGIN_DATE.'" disabled> 
									</p>-->
									<p class="float">
										<label for="MOBILE_NUMBER"><i class="fa fa-mobile"></i>Mobile Number</label>
										<input type="text" name="MOBILE_NUMBER" value = "'.$data_decode[0]->MOBILE_NUMBER.'" disabled>
									</p>
									<p class="float">
										<label for="CUSTOMER_NUMBER"><i class="fa fa-user-o"></i>Customer Number</label>
										<input type="text" name="CUSTOMER_NUMBER" value = "'.$data_decode[0]->CUSTOMER_NUMBER.'" disabled> 
									</p>
									
								</div>';
				echo $html_outout ;
			
		 }
		 else if($_REQUEST['method'] == "getLastPaymentDetails") {
			//print_r($result);
			$html_outout = '<div class="form-2">
									<h1><span class="log-in">Charges</span></h1>';
		if(!empty($data_decode)){
			foreach($data_decode as $key => $charge_data){
				$html_outout .= '<p class="float">
											<label for="'.$charge_data->DUE_TYPE.'"><i class="fa fa-inr"></i>'.$charge_data->DUE_TYPE.'</label>
											<input type="text" name="'.$charge_data->DUE_TYPE.'" value = "'.$charge_data->VALUE.'" disabled>
										</p>';
			}	
		}
				$html_outout .= '</div>';
				echo $html_outout ;
		 }
		 else {
			 //echo '<p>';
			 $curlerror = curl_error($ch);
			 if($curlerror){
				// echo "<br><p>CURL Error:".$curlerror.'</p>';
					$respdata = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
					print_r(json_encode($respdata));
			  }else{
					print_r($result); 
			  }
			//echo '</p>';
		 }		
		 

		 curl_close($ch);
	}
	
	/*
	*	 Get Data from LMS and RMS 
	*/	
	function rest_api_call_drop() {
		
		//method_val : "getInsuranceDetails"
		 load_curl();
		 $apitoken = $this->nusoap_lib->generateToken();
		if(empty($apitoken)){
					return 'Token Mismatch';
		}
		//$_REQUEST['ag_no'] = 'HR3047TW16786';
		if($_REQUEST['method_val'] == "getInsuranceDetails") {
		// $ch = curl_init("http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:".$_REQUEST['method_val'].",agreementNo:".$_REQUEST['ag_no']."}");
		 $ch = curl_init("https://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:".$_REQUEST['method_val'].",agreementNo:".$_REQUEST['ag_no']."}");
		}
		else {
			// $ch = curl_init("http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getLoanStatusandOtherDetails,agreementNo:".$_REQUEST['ag_no']."}");
			 $ch = curl_init("https://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getLoanStatusandOtherDetails,agreementNo:".$_REQUEST['ag_no']."}");
		}
		
		 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','token_id: '.$apitoken,"content-length: 0"));
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 $result = curl_exec($ch);
		 $data_decode=json_decode($result);
		 if($_REQUEST['method_val'] == 'initialloanamount') {
			 echo "<div class='form-2'><fieldset><p class='float'><label for='loan_amount'><i class='fa fa-inr'></i><strong>Initial Loan Amount</strong></label>";
			 if($data_decode->error_desc == "No Data Found") {
				echo "No Data Found</p>"; 
			 }
			else {
				 echo '<input type="text" name="loan_amount" value = "'.number_format($data_decode[0]->LOAN_AMOUNT,2).'" disabled>';
				 echo "</p></fieldset></div>";
			}
		 }
		 else if($_REQUEST['method_val'] == 'statusofloan') {
				//echo "<p><strong>Status of Loan :</strong>";
				 echo "<div class='form-2'><fieldset><p class='float'><label for='status_loan'><i class='fa fa-user'></i><strong>Status of Loan </strong></label>";
				if($data_decode->error_desc == "No Data Found") {
					echo "No Data Found</p>"; 
				}
					else {
						echo '<input type="text" name="status_loan" value = "'.$data_decode[0]->LOAN_STATUS.'" disabled>';
						echo "</p></fieldset></div>";
//							echo ;
	//						echo '</p>';
				}
		 }
		 else if($_REQUEST['method_val'] == 'getInsuranceDetails') {
			if($data_decode->error_desc == "No Data Found") {
					//echo "<p>No Data Found</p>"; 
					//$url_for = "https://rmsuatnew.tvscs.co.in/rms/Jasper?AGRNO=".$_REQUEST['ag_no']."&DATE=".date('d/m/Y')."&report=Foreclosure_Print";
					$url_for = "https://rms.tvscs.co.in/rms/Jasper?AGRNO=".$_REQUEST['ag_no']."&DATE=".date('d/m/Y')."&report=Foreclosure_Print";
					//$soa_for = "http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=".$_REQUEST['ag_no'];
										
					$soa_for = "https://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=".$_REQUEST['ag_no'];

					$arr = array("url_ins" => '', "url_for" => $url_for, "soa_for" => $soa_for , "message" => 'aa');
					print_r(json_encode($arr));
				}
		 else {
			 $ins_number = 0;
			 $policy_number = '';
			 if(!empty($data_decode)){
				 foreach($data_decode as $key => $result){
						//print_r($result);
						
						if($result->INSURANCE_RENEWAL_NO > $ins_number ||  $ins_number == 0){
							$policy_number = $result->INSURANCE_POLICY_NO;
						}
						$ins_number = $result->INSURANCE_RENEWAL_NO;
					}
			 }
			 if(!empty($policy_number)){
				/* $arr = array("first"=>$data_decode[0]->LAST_EMI_DATE,"second"=>$data_decode[0]->INTEREST_RATE,"third"=>$data_decode[0]->EMI_AMOUNT,"fourth"=>$data_decode[0]->PAYMENT_MODE,"fifth"=>$data_decode[0]->REMAINING_PRINCIPAL,"sixth"=>$data_decode[0]->LOAN_STATUS,"seventh"=>$data_decode[0]->TENOR,"eigth"=>$data_decode[0]->LOAN_AMOUNT);
				 print_r(json_encode($arr));*/
				 $pos = strpos($policy_number, "P");
					if($pos == false) {
						//$url_ins = "https://portal.uiic.in/polclaim/accounts/DirectDupPrnVouchShowReportAction.do?PolNo=3".$data_decode[0]->INSURANCE_POLICY_NO."&reportType=schedule&transactionId=null";
						$url_ins = "https://portal.uiic.in/polclaim/accounts/DirectDupPrnVouchShowReportAction.do?PolNo=3".$policy_number."&reportType=schedule&transactionId=null";
						
						//$url_for = "https://rmsuatnew.tvscs.co.in/rms/Jasper?AGRNO=".$_REQUEST['ag_no']."&DATE=".date('d/m/Y')."&report=Foreclosure_Print";

						$url_for = "https://rms.tvscs.co.in/rms/Jasper?AGRNO=".$_REQUEST['ag_no']."&DATE=".date('d/m/Y')."&report=Foreclosure_Print";

						//$soa_for = "http://tvscscrmuat.tvscs.co.in:8180/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=".$_REQUEST['ag_no'];
						$soa_for = "https://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=".$_REQUEST['ag_no'];

					}
					else {
						//$url_ins = "https://portal.uiic.in/GCCustomerPortalService/PdfGenerator.ashx?strToken=586034d8-a020-49db-af33-76f3a772837e&strUserID=RENEWAL@TVS&strUserRole=DEALER&strPolicyNumber=".$data_decode[0]->INSURANCE_POLICY_NO;
						$url_ins = "https://portal.uiic.in/GCCustomerPortalService/PdfGenerator.ashx?strToken=586034d8-a020-49db-af33-76f3a772837e&strUserID=RENEWAL@TVS&strUserRole=DEALER&strPolicyNumber=".$policy_number;
						
						$url_for = "https://rms.tvscs.co.in/rms/Jasper?AGRNO=".$_REQUEST['ag_no']."&DATE=".date('d/m/Y')."&report=Foreclosure_Print";
						
						$soa_for = "https://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=".$_REQUEST['ag_no'];
					}
				$arr = array("url_ins" => $url_ins, "url_for" => $url_for, "soa_for" => $soa_for ,"message" => '' );
			 }else{
						$url_ins = "";
						$url_for = "https://rms.tvscs.co.in/rms/Jasper?AGRNO=".$_REQUEST['ag_no']."&DATE=".date('d/m/Y')."&report=Foreclosure_Print";
						
						$soa_for = "https://tvscscrm.tvscs.co.in/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=".$_REQUEST['ag_no'];
						$arr = array("url_ins" => $url_ins, "url_for" => $url_for,"soa_for" => $soa_for , "message" => 'aa' );
			 }
				
				print_r(json_encode($arr));
			 }
		 }
		 else {
			 $arr = array("first"=>$data_decode[0]->LAST_EMI_DATE,"second"=>$data_decode[0]->MONTHLYDUE,"third"=>$data_decode[0]->INTEREST_RATE,"fourth"=>$data_decode[0]->EMI_AMOUNT,"fifth"=>$data_decode[0]->PAYMENT_MODE,"sixth"=>$data_decode[0]->REMAINING_PRINCIPAL,"seventh"=>$data_decode[0]->LOAN_STATUS,"eigth"=>$data_decode[0]->TENOR,"ninth"=>$data_decode[0]->INSAMT,"tenth"=>$data_decode[0]->LOAN_AMOUNT);
			 print_r(json_encode($arr));
		 }
		 $count_data_decode = count($data_decode);
		
		 $curlerror = curl_error($ch);
		 if($curlerror){
			 echo "<br>CURL Error:".$curlerror;
		  }

		 curl_close($ch);
	}
	
	/*
	*Generate API Report
	*/
	function rest_api_call2() {
		 //load_curl();
		 $msg=\RightNow\Connect\v1_3\MessageBase::fetch('1000001');
		$report_id=$msg->Value;
		//$report_id = '1000001';
		$contact_id=$this->session->getProfileData("c_id");
		if($report_id>0){
			$filter=array('ContactID'=>$contact_id);
			$report_result=report_result($report_id,$filter);
			return $result;
		 /*$ch = curl_init("https://RNTpartner_VirtuosNarendra:Rightnow!1@tvscs.custhelp.com/services/rest/connect/v1.3/messageBases/1000001");
		 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 $result = curl_exec($ch);
		 $data_decode=json_decode($result);
		 //echo "<pre>";
		 print_r($result);
		 $count_data_decode = count($data_decode);
		
		 $curlerror = curl_error($ch);
		 if($curlerror){
			 echo "<br>CURL Error:".$curlerror;
		  }

		 curl_close($ch);*/
		}else{
				echo "<p>No Report Found</p>";
		}
	}
	
	/*
* Generate API Report from Rightnow
*/
		function rest_api_report() {
			//$url = "https://RNTpartner_VirtuosNarendra:Rightnow!1@tvscs.custhelp.com/services/rest/connect/v1.3/analyticsReportResults"; 
			
			$idreport = $_POST['id_of_report'];
			//{"filters":[{"name":"<FilterName>","values":"<filtervalue>"}],"id":<report Id>}
			//{"filters":[{"name":"ContactID","values":"3"}],"id":100010}
			$contact_id=$this->session->getProfileData("c_id");
			
			//print_r($content );
			load_curl();
			$filter = array('ContactID' => $contact_id);
			$response = report_result($idreport,$filter);
			
			$agg_count = count($response);
			$methodval = $_POST['method_val'];
			if($_REQUEST['filtering_val'] == 'initialloan') {
					echo "<div class='form-group'><select id='i_loan'><option value='0'>--Select--</option>";
					//for($i = 0; $i < $agg_count; $i++ ) {
					foreach($response as $key => $result){
						echo '<option value='.$result['Agreement No'].'>'.$result['Agreement No'].'</option>';
					}
					echo '</select></div>';
					?>
					<script type="text/javascript">
						$(document).ready(function (){
							$('#i_loan').wrap('<div class="select_wrapper"></div>')
							$('#i_loan').parent().prepend('<span>'+ $('#i_loan').find(':selected').text() +'</span>');
							$('#i_loan').parent().children('span').width(131);	
							$('#i_loan').css('display', 'none');					
							$('#i_loan').parent().append('<ul class="select_inner"></ul>');
							$('#i_loan').children().each(function(){
							  var opttext = $(this).text();
							  var optval = $(this).val();
							  $('#i_loan').parent().children('.select_inner').append('<li id="' + optval + '">' + opttext + '</li>');
							});



							$('#i_loan').parent().find('li').on('click', function (){
							  var cur = $(this).attr('id');
							  $('#i_loan').parent().children('span').text($(this).text());
							  $('#i_loan').children().removeAttr('selected');
							  $('#i_loan').children('[value="'+cur+'"]').attr('selected','selected');					
							  console.log($('#i_loan').children('[value="'+cur+'"]').text());
							  $.post( "/cc/AjaxCustom/rest_api_call_drop", {ag_no : $('#i_loan').children('[value="'+cur+'"]').text() , method_val : '<?php echo $methodval;?>'})
													 .done(function( data ) {
															$( "#showresult" ).html(data);
														});
							});
							$('#i_loan').parent().on('click', function (){
							  $(this).find('ul').slideToggle('fast');
							});
						});
						</script>
					<?php
			}
			else if($_REQUEST['filtering_val'] == 'statusofloan') {
					echo "<div class='form-group'><select id='s_loan'><option value='0'>--Select--</option>";
					foreach($response as $key => $result){
						echo '<option value='.$result['Agreement No'].'>'.$result['Agreement No'].'</option>';
					}
					echo '</select></div>';
					?>
					<script type="text/javascript">
						$(document).ready(function (){
							$('#s_loan').wrap('<div class="select_wrapper"></div>')
							$('#s_loan').parent().prepend('<span>'+ $('#s_loan').find(':selected').text() +'</span>');
							//alert($('#s_loan').width());
							$('#s_loan').parent().children('span').width(131);	
							$('#s_loan').css('display', 'none');					
							$('#s_loan').parent().append('<ul class="select_inner"></ul>');
							$('#s_loan').children().each(function(){
							  var opttext = $(this).text();
							  var optval = $(this).val();
							  $('#s_loan').parent().children('.select_inner').append('<li id="' + optval + '">' + opttext + '</li>');
							});



							$('#s_loan').parent().find('li').on('click', function (){
							  var cur = $(this).attr('id');
							  $('#s_loan').parent().children('span').text($(this).text());
							  $('#s_loan').children().removeAttr('selected');
							  $('#s_loan').children('[value="'+cur+'"]').attr('selected','selected');					
							  console.log($('#s_loan').children('[value="'+cur+'"]').text());
							  $.post( "/cc/AjaxCustom/rest_api_call_drop", {ag_no : $('#s_loan').children('[value="'+cur+'"]').text() , method_val : '<?php echo $methodval;?>'})
													 .done(function( data ) {
												 $( "#showresult_loan" ).html(data);
										 });
							});
							$('#s_loan').parent().on('click', function (){
							  $(this).find('ul').slideToggle('fast');
							});
						});
						</script>
					<?php
			}
			else if($_REQUEST['filtering_val'] == 'instrumentdetails') {
				echo "<div class='form-group'><select id='i_detail'><option value='0'>--Select--</option>";
					foreach($response as $key => $result){
						echo '<option value='.$result['Agreement No'].'>'.$result['Agreement No'].'</option>';
					}
					echo '</select></div>';
					?>
					<script type="text/javascript">
						$(document).ready(function (){
							$('#i_detail').wrap('<div class="select_wrapper"></div>')
							$('#i_detail').parent().prepend('<span>'+ $('#i_detail').find(':selected').text() +'</span>');
							$('#i_detail').parent().children('span').width(131);	
							$('#i_detail').css('display', 'none');					
							$('#i_detail').parent().append('<ul class="select_inner"></ul>');
							$('#i_detail').children().each(function(){
							  var opttext = $(this).text();
							  var optval = $(this).val();
							  $('#i_detail').parent().children('.select_inner').append('<li id="' + optval + '">' + opttext + '</li>');
							});



							$('#i_detail').parent().find('li').on('click', function (){
							  var cur = $(this).attr('id');
							  $('#i_detail').parent().children('span').text($(this).text());
							  $('#i_detail').children().removeAttr('selected');
							  $('#i_detail').children('[value="'+cur+'"]').attr('selected','selected');					
							  console.log($('#i_detail').children('[value="'+cur+'"]').text());
							  //TN3005TW06877&DATE=22/11/2016&report=Foreclosure_Print
							  //$('#i_detail').children('[value="'+cur+'"]').text() 
							  $.post( "/cc/AjaxCustom/rest_api_call_drop", {ag_no : $('#i_detail').children('[value="'+cur+'"]').text() , method_val : '<?php echo $methodval;?>'})
													 .done(function( data ) {
												 var url_data = JSON.parse(data);
												 if(url_data.message == ''){
														 //console.log(url_data.url_for);
														// console.log(url_data.url_ins);
														$("#instrumentdetails_docs").css("display", "block");
														$("#showresult_instrument").hide();
														$("#url_ins").attr("href", url_data.url_ins);
														$("#url_for").attr("href", url_data.url_for);
														$("#url_for_soa").attr("href", url_data.soa_for);
												 }else{
														$("#showresult_instrument").css("display", "block");
														$("#instrumentdetails_docs").hide();
													//	$("#url_ins").attr("href", url_data.url_ins);
														$("#url_for_n").attr("href", url_data.url_for);
														$("#url_for_n_soa").attr("href", url_data.soa_for);
													//	 $( "#showresult_instrument" ).html(url_data.message);
														
												 }
										 });
							});
							$('#i_detail').parent().on('click', function (){
							  $(this).find('ul').slideToggle('fast');
							});
						});
						</script>
						<?php
			}
			?>
				
			<?php
			//curl_close($curl);
		
		}
	//akash changes

/*
* Retrive Pie Chart Data from Rightnow
*/
	function getPieData() {
			$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incidents);
			$report_id=$msg->Value;
			//$c_id =3;
			$c_id=$this->session->getProfileData("c_id");
			//$report_id = '100051';
			//$idreport = $_REQUEST['id_of_report'];
			if($report_id>0){
					$filter=array('Contact_Id'=>$c_id);
					$report_result=$this->model('custom/Login')->report_result($report_id,$filter);
					//print_r($report_result); exit;
						$inc_count = count($report_result);
						$closed = 0;
						$loggedin = 0;
						$new = $pending = 0;
						$response_awaited = 0;
						//for($i = 0; $i < $inc_count; $i++) {
						foreach($report_result as $key => $response){
							if($response['Status'] == "New") {
								++$new;
							}
							if($response['Status'] == "Closed") {
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
						$pie_chart = array(array("Status","Values"),array("New",$new),array("Closed",$closed),array("Logged in",$loggedin),array("Pending with initiator / internal team",$pending),array("Response Awaited",$response_awaited));
						//json_encode($pie_chart)
			}
			print_r(json_encode($pie_chart));
		}
		
		// Create Incident Pie Chart

		function getPieInc() {
			$inc_status = $_REQUEST['status'];
			$contact_id = $_REQUEST['c_id'];
			$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incidents);
			$report_id=$msg->Value;
			//$c_id =3;
			$c_id=$this->session->getProfileData("c_id");
			//$report_id = '100051';
			//$idreport = $_REQUEST['id_of_report'];
			if($report_id>0){
					$filter=array('Contact_Id'=>$c_id);
					$report_result=$this->model('custom/Login')->report_result($report_id,$filter);
					//print_r($report_result); exit;
						$inc_count = count($report_result);
						/*echo "<table style='border:1px solid black'><tr><th style='border:1px solid black'>Incident ID</th><th style='border:1px solid black'>Reference #</th><th style='border:1px solid black'>Subject</th><th style='border:1px solid black'>Status</th></tr>";
						for($i = 0; $i < $inc_count; $i++) {
							if($response['rows'][$i][3] == $inc_status) {
								echo "<tr><td style='border:1px solid black'>".$response['rows'][$i][0]."</td><td style='border:1px solid black'>".$response['rows'][$i][1]."</td><td style='border:1px solid black'>".$response['rows'][$i][2]."</td><td style='border:1px solid black'>".$response['rows'][$i][3]."</td></tr>";
							}
						}
						echo "</table>";*/
						$dataArray = array();
						foreach($report_result as $key => $response){	
							//print_r($response);
							if($response['Status'] == $inc_status) {
									$dataArray[] = $response;
									//$dataArray[$key] = json_encode($response);

							}
						}
						//$jsonArray['data']  = $dataArray;
						print_r(json_encode($dataArray));
					}
		}
		
		//create incident	
		function create_inc() {
			$CI=&get_instance();
			$CI->load->helper('report');

			$contact_id=$CI->session->getProfileData("c_id");
			
			
			try{
				$incident = new RNCPHP\Incident();
			 
				$incident->Subject = "Call me back";
			 
				//$incident->Product =  RNCPHP\ServiceProduct::fetch($_POST['formData']['Incident.Product']);
			 
				$incident->Category = RNCPHP\ServiceCategory::fetch(1330);
			 
				$incident->Threads = new RNCPHP\ThreadArray();
				$incident->Threads[0] = new RNCPHP\Thread();
				$incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
				$incident->Threads[0]->EntryType->ID = 4; // Used the ID here. See the Thread object for definition
				$incident->Threads[0]->Text = $_POST['assistance']."\n\r Call on ". $_POST['contact_number'];
				
				//$incident->Language = new RNCPHP\NamedIDOptList();
				//$incident->Language->ID =1;
			 
				//$incident->Mailbox = RNCPHP\Mailbox::fetch(30);
			  
			//	$incident->Organization = RNCPHP\Organization::fetch(8);
			 
				$incident->PrimaryContact = RNCPHP\Contact::fetch($contact_id);//Required field to create an incident through connect PHP
			 
				$incident->Queue = new RNCPHP\NamedIDLabel();
				$incident->Queue->ID = 2;
			 
				//$incident->Severity = new RNCPHP\NamedIDOptList();
				//$incident->Severity->LookupName  = 1;
			 
				$incident->StatusWithType               = new RNCPHP\StatusWithType() ;
				$incident->StatusWithType->Status       = new RNCPHP\NamedIDOptList() ;
				$incident->StatusWithType->Status->ID   = 1 ;
				 
				 //\RightNow\Connect\v1_3\CO\City::fetch( "$city" );
					if(strlen($_POST['formData']['agreementno'])){
					  list($loan_id,$agg_no) = explode("_",$_POST['formData']['agreementno']);
					  $incident->CustomFields->CO->Loan = \RightNow\Connect\v1_3\CO\Loan::fetch($loan_id);
					}
				 $incident->CustomFields->c->call_date_time = strtotime($_POST['datetime_speak']);
				 $incident->save();
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
		* Function to Calculate EMI
		*/
		function emi_calculate_soap() {
			$asset_costs = $_REQUEST['asset_costs'];
			$down_pays = $_REQUEST['down_pays'];
			$emis = $_REQUEST['emis'];
			$tenors = $_REQUEST['tenors'];
			$payment_modes = $_REQUEST['payment_modes'];
			//$imei = null;
			
			$arrparams = array(
					"Asset_Cost" => $asset_costs,
					"Payment_Mode" => $payment_modes,
					"Down_Payment" => $down_pays,
					"EMI" => $emis,
					"Tenor" => $tenors,
					"IMEI" => null,
				);
				
				$response = soap_emi_call("EMICalculator" , $arrparams);
				$emi_data = count($response['EMICalculatorResult']['EMI_Calculator_Entity']);
				//print_r($emi_data);
				if($emi_data == '7') {
					echo "<table style='border:1px solid black'><tr><th style='border:1px solid black;text-align: center;'>DOWN PAYMENT</th><th style='border:1px solid black;text-align: center;'>LOAN AMOUNT</th><th style='border:1px solid black;text-align: center;'>EMI</th><th style='border:1px solid black;text-align: center;'>TENOR</th></tr>";
					//for($i = 0; $i < $emi_data; $i++) {
								echo "<tr><td align=center style='border:1px solid black'>".$response['EMICalculatorResult']['EMI_Calculator_Entity']['objEmiOutPutCalculator']['DOWNPAYMENT']."</td><td align=center style='border:1px solid black'>".$response['EMICalculatorResult']['EMI_Calculator_Entity']['objEmiOutPutCalculator']['LOANAMOUNT']."</td><td align=center style='border:1px solid black'>".$response['EMICalculatorResult']['EMI_Calculator_Entity']['objEmiOutPutCalculator']['EMI']."</td><td align=center style='border:1px solid black'>".$response['EMICalculatorResult']['EMI_Calculator_Entity']['objEmiOutPutCalculator']['TENOR']."</td></tr>";
							
					//}
					echo "</table>";
				}
				
				else if($emi_data == '3') {
					echo "<table style='border:1px solid black'><tr><th style='border:1px solid black;text-align: center;'>DOWN PAYMENT</th><th style='border:1px solid black;text-align: center;'>LOAN AMOUNT</th><th style='border:1px solid black;text-align: center;'>EMI</th><th style='border:1px solid black;text-align: center;'>TENOR</th></tr>";
					for($i = 0; $i < $emi_data; $i++) {
					$emi_count2 = count($response['EMICalculatorResult']['EMI_Calculator_Entity'][$i]);
					
						//for($j = 0; $j < $emi_count2; $j++) {
							echo "<tr><td align=center style='border:1px solid black'>".$response['EMICalculatorResult']['EMI_Calculator_Entity'][$i]['objEmiOutPutCalculator']['DOWNPAYMENT']."</td><td align=center style='border:1px solid black'>".$response['EMICalculatorResult']['EMI_Calculator_Entity'][$i]['objEmiOutPutCalculator']['LOANAMOUNT']."</td><td align=center style='border:1px solid black'>".$response['EMICalculatorResult']['EMI_Calculator_Entity'][$i]['objEmiOutPutCalculator']['EMI']."</td><td align=center style='border:1px solid black'>".$response['EMICalculatorResult']['EMI_Calculator_Entity'][$i]['objEmiOutPutCalculator']['TENOR']."</td></tr>";
						//}
						
					}
					echo "</table>";
				}
				
		}
		//end function


// Function to Create Contact
	function create_contact( $param_data ) {
				try {
					$title = $param_data[ 'title' ];
					$first_name = $param_data[ 'first_name' ];
					$last_name = $param_data[ 'last_name' ];
					$mobile = $param_data[ 'mobile' ];
					$date_of_birth = $param_data[ 'date_of_birth' ];
					$email = $param_data[ 'email' ];
					$address = $param_data[ 'address' ];
					$city = $param_data[ 'city' ];
					$state = $param_data[ 'state' ];
					$Pincode = $param_data[ 'Pincode' ];
					$country = $param_data[ 'country' ];

					$contact = new \RightNow\Connect\v1_3\Contact();
					$contact->Name = new \RightNow\Connect\v1_3\PersonName();
					if ( !empty( $title ) ) {
						$contact->title = $title;
					}
					if ( !empty( $first_name ) ) {
						$contact->Name->First = ucwords( $first_name );
					}
					if ( !empty( $last_name ) ) {
						$contact->Name->Last = ucwords( $last_name );
					}
					if ( !empty( $email ) ) {
						//add email addresses
						$contact->Emails = new \RightNow\Connect\v1_3\EmailArray();
						$contact->Emails[ 0 ] = new \RightNow\Connect\v1_3\Email();
						$contact->Emails[ 0 ]->AddressType = new \RightNow\Connect\v1_3\NamedIDOptList();
						$contact->Emails[ 0 ]->AddressType->LookupName = "Email - Primary";
						$contact->Emails[ 0 ]->Address = strtolower( $email );
					}else{
						$contact->Emails = new \RightNow\Connect\v1_3\EmailArray();
						$contact->Emails[ 0 ] = new \RightNow\Connect\v1_3\Email();
						$contact->Emails[ 0 ]->AddressType = new \RightNow\Connect\v1_3\NamedIDOptList();
						$contact->Emails[ 0 ]->AddressType->LookupName = "Email - Primary";
						$contact->Emails[ 0 ]->Address = strtolower( $mobile.'@invalid.mail.com' );
						$contact->Emails[0]->Invalid= true;
					}
					$contact->NewPassword = ucwords( trim( $first_name ) ) . "@123";
					$contact->CustomFields->c->custom_password = ucwords( trim( $first_name ) ) . "@123";

					if ( !empty( $mobile ) ) {
						$i = 0;
						$contact->Phones[ $i ] = new \RightNow\Connect\v1_3\Phone();
						$contact->Phones[ $i ]->PhoneType = new \RightNow\Connect\v1_3\NamedIDOptList();
						$contact->Phones[ $i ]->PhoneType->LookupName = 'Mobile Phone';
						$contact->Phones[ $i ]->Number = $mobile;
						$i++;
					}
					if ( !empty( $date_of_birth ) ) {
						$contact->CustomFields->c->dob = $date_of_birth;
					}
					$contact->Address = new \RightNow\Connect\v1_3\Address();
					if ( !empty( $address ) ) {
						$contact->Address->Street = $address;
					}
					if ( !empty( $city ) ) {
						$contact->Address->City = $city;
						$contact->CustomFields->CO->City =  \RightNow\Connect\v1_3\CO\City::fetch( "$city" );
					}
					if ( !empty( $state ) ) {
					//	$contact->Address->StateOrProvince = new \RightNow\Connect\v1_3\NamedIDLabel();
					//	$contact->Address->StateOrProvince->LookupName = "$state";
					}
					if ( !empty( $country ) ) {
					//	$contact->Address->Country = \RightNow\Connect\v1_3\Country::fetch( "$country" );
					}
					if ( !empty( $Pincode ) ) {
						$contact->Address->PostalCode = $Pincode;
					}

					$contact->ContactType = new \RightNow\Connect\v1_3\NamedIDLabel();
					$contact->ContactType->LookupName = "Customer";
					$contact->Login = "LOGIN_".date("Y-m-d-h-i-s");
					$contact->CustomFields->c->custom_password = "123456";
					$contact->save();
					$contact_id = $contact->ID;
					return $contact_id;
				} catch ( Exception $e ) {
					echo "<br>Error: " . $e->getMessage() . " | Code: " . $e->getCode() . "| Line: " . $e->getLine();
				}
			}

/*
* Function to update Contact
*/
	function update_contact( $param_data, $contact_id ) {
		try {
			if ( strlen( $contact_id )and $contact_id > 0 ) {
				$title = $param_data[ 'title' ];
				$first_name = $param_data[ 'first_name' ];
				$last_name = $param_data[ 'last_name' ];
				$date_of_birth = $param_data[ 'date_of_birth' ];
				$address = $param_data[ 'address' ];
				$city = $param_data[ 'city' ];
				$state = $param_data[ 'state' ];
				$Pincode = $param_data[ 'Pincode' ];
				$country = $param_data[ 'country' ];
				$contact = \RightNow\Connect\v1_3\Contact::fetch( $contact_id );
				if ( isset( $title )and strlen( $title ) ) {
					$contact->title = $title;
				}
				if ( !empty( $first_name ) ) {
					$contact->Name->First = ucwords( $first_name );
				}
				if ( !empty( $last_name ) ) {
					$contact->Name->Last = ucwords( $last_name );
				}
				if ( !empty( $date_of_birth ) ) {
					$contact->CustomFields->c->dob = $date_of_birth;
				}

				if ( !empty( $address ) ) {
					$contact->Address->Street = $address;
				}
				if ( !empty( $city ) ) {
					$contact->Address->City = $city;
					$contact->CustomFields->CO->City =  \RightNow\Connect\v1_3\CO\City::fetch( "$city" );
				}
				if ( !empty( $state ) ) {
				//	$contact->Address->StateOrProvince->LookupName ="$state";
				}
				if ( !empty( $country ) ) {
					//$contact->Address->Country = \RightNow\Connect\v1_3\Country::fetch( "$country" );
				}
				if ( !empty( $Pincode ) ) {
					$contact->Address->PostalCode = $Pincode;
				}

				$contact->ContactType = new \RightNow\Connect\v1_3\NamedIDLabel();
				$contact->ContactType->LookupName = "Customer";

				$contact->save();
			}
		} catch ( Exception $e ) {
			echo "<br>Error: " . $e->getMessage() . " | Code: " . $e->getCode() . "| Line: " . $e->getLine();
		}
	}

/*
* Function to create Opportunity
*/
	function create_opportunity( $param_data, $contact_id ) {
		try {
			$first_name = $param_data[ 'first_name' ];
			$last_name = $param_data[ 'last_name' ];
			$mobile = $param_data[ 'mobile' ];
			$loan_type = $param_data[ 'loan_type' ];
			$opp = new \RightNow\Connect\v1_3\Opportunity();
			if ( !empty( $mobile ) and !empty( $first_name ) ) {
				$oppname = "$mobile: $first_name";
				if ( !empty( $last_name ) ) {
					$oppname .= " - $last_name";
				}
				$opp->Name = $oppname;
			}
			if ( !empty( $loan_type )) {
				//$menu = new \RightNow\Connect\v1_3\NamedIDLabel();
				//$menu->LookupName="$loan_type";
				//$menu->ID = "$loan_type";
				//$opp->CustomFields->c->loan_type = $menu;
					$opp->CustomFields->CO->Product = \RightNow\Connect\v1_3\CO\Product::fetch($loan_type);
			}
			$opp->PrimaryContact->Contact = \RightNow\Connect\v1_3\Contact::fetch( $contact_id );
			/*$opp->StageWithStrategy->Stage= new RightNow\Connect\v1_3\NamedIDLabel();
			$opp->StatusWithType->Status->ID='Active';*/
			$opp->save();
			$opp_id = $opp->ID;
			return $opp_id;
		} catch ( Exception $e ) {
			echo "<br>Error: " . $e->getMessage() . " | Code: " . $e->getCode() . "| Line: " . $e->getLine();
		}
	}

/*
* Function to Create New Lead
*/
function createLead(){

	//print_r($_POST); die;
			if($_POST['Action'] == 'Create_New_Lead'){
					$postdata = $_POST;
					$email = $postdata[ 'email' ];
					$mobile = $postdata[ 'mobile' ];
					$action = $postdata[ 'clickaction' ];
					$loan_type = $postdata[ 'loan_type' ];

			//	if ( isset( $mobile )and strlen( $mobile ) == 10 ) {
					$params = array(
						'title' => $postdata[ 'title' ],
						'first_name' => $postdata[ 'first_name' ],
						'middle_name' => $postdata[ 'middle_name' ],
						'last_name' => $postdata[ 'last_name' ],
						'Name' => $postdata[ 'first_name' ],
						'MiddleName' => $postdata[ 'middle_name' ],
						'LastName' => $postdata[ 'last_name' ],
						'Father_Spouse' => $postdata[ 'Father_Spouse' ],
						'Gender' => $postdata[ 'Gender' ],
						'CompanyName' => $postdata[ 'CompanyName' ],
						'CompanyAddress' => $postdata[ 'CompanyAddress' ],
						'CustProfile' => $postdata[ 'CustProfile' ],
						'Pancard' => $postdata[ 'Pancard' ],
						'Passport' => $postdata[ 'Passport' ],
						'Voterid' => $postdata[ 'Voterid' ],
						'Driving_License' => $postdata[ 'Driving_License' ],
						'Rationcard' => $postdata[ 'Rationcard' ],
						'Adharcard' => $postdata[ 'Adharcard' ],
						'Residentstatus' => $postdata[ 'Residentstatus' ],
						'ResidentStability' => $postdata[ 'ResidentStability' ],
						'LoanAmount' => $postdata[ 'LoanAmount' ],
						'Tenure' => $postdata[ 'Tenure' ],
						'RepaymentMode' => $postdata[ 'RepaymentMode' ],
						'EMIcomfort' => $postdata[ 'EMIcomfort' ],
						'MonthIncome' => $postdata[ 'MonthIncome' ],
						'Year' => $postdata[ 'Year' ],
						'Make' => $postdata[ 'Make' ],
						'Model' => $postdata[ 'Model' ],
						'Variant' => $postdata[ 'Variant' ],
						'loan_type' => $postdata[ 'loan_type' ],
						'date_of_birth' => $postdata[ 'date_of_birth' ],
						'email' => $postdata[ 'email' ],
						'Email' => $postdata[ 'email' ],
						'mobile' => $postdata[ 'mobile' ],
						'Mobile' => $postdata[ 'mobile' ],
						'address' => $postdata[ 'address' ],
						'Address' => $postdata[ 'address' ],
						'state' => $postdata[ 'state' ],
						'StateCode' => $postdata[ 'state' ],
						'city' => $postdata[ 'city' ],
						'CityCode' => $postdata[ 'city' ],
						'Pincode' => $postdata[ 'Pincode' ],
						'country' => $postdata[ 'country' ],
						'ACC1' => $postdata[ 'ACC1' ],
						'Experience' => $postdata[ 'Experience' ],
						'FinalisedCar' => $postdata[ 'FinalisedCar' ],
						'ChannelCode' => $postdata[ 'ChannelCode' ],
						'ProductCode' => $postdata[ 'loan_type' ],
						'loan_type' => $postdata[ 'loan_type' ],
						'AgencyCode' => $postdata[ 'AgencyCode' ],

					);
				//	print_r($params); die;
					//$report_id=Config::getMessage(CUSTOM_MSG_CONTACT_SEARCH_ON_MOBILE_N_EMAIL);
					$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_CONTACT_SEARCH_ON_MOBILE_N_EMAIL );
					$report_id = $msg->Value;
					if ( $report_id > 0 ) {
						//print_r(array( 'Mobile' => $mobile ));
							$contact_result = report_result( $report_id, array( 'Mobile' => $mobile ) );
							if ( count( $contact_result ) == 0 ) {
								/*Code to create new Contact starts here*/
								$contact_id = $this->create_contact( $params );
								/*Code to create new Contact ends here*/
								if ( isset( $contact_id )and $contact_id > 0 ) {
									$opp_id = $this->create_opportunity( $params, $contact_id );
								}

							} else {
								$contact_id = $contact_result[ 0 ][ 'Contact ID' ];


								/*Code to update Contact starts here*/
									if ( isset( $contact_id )and $contact_id > 0 ) {
											$this->update_contact( $params, $contact_id );
											//$report_id=Config::getMessage(CUSTOM_MSG_CHECK_OPP_EXISTS_IN_LAST_24_HRS);
											$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_CHECK_OPP_EXISTS_IN_LAST_24_HRS );
											$report_id = $msg->Value;
											if ( $report_id > 0 ) 
											{
												//print_r(array( 'Contact Id' => $contact_id, 'Loan Type' => $loan_type ));
													$opp_result = report_result( $report_id, array( 'Contact Id' => $contact_id, 'Loan Type' => $loan_type ) );

													if ( count( $opp_result ) == 0 )
													{
														$opp_id = $this->create_opportunity( $params, $contact_id );
													}else{
														echo "Already in 24 Hour";
														//	header("Location: /app/newlead");
															exit;
													}

												}
										}
									/*Code to update new Contact ends here*/
								}
						/*Code for creatng Lead in LMS System starts here*/
						/*echo "<pre>";
						print_r( $params );
						echo "</pre><br><hr><br>";*/
						$LMS_result = soap_call( 'InsertLMSData', $params );
						//print_r(json_encode($LMS_result));
						header("Location: /app/new_lead_thanks/ref_id/".$LMS_result['InsertLMSDataResult']);
						exit;
					}else{
							header("Location: /app/newlead");
							exit;
					}
			} else{
							header("Location: /app/newlead");
							exit;
			}
	}// end of function

/*
*
* Function for Dealer Login
*
*/
	function doDealerLogin(){

			 if(!$this->checkForValidFormToken()) {
					$this->_renderJSON(array('message' => Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG), 'showLink' => false));
				return;
			}
		
			$userID = $this->input->post('login');
			$password = $this->input->post('password');
			$custType = $this->input->post('custType');
			$sessionID = $this->session->getSessionData('sessionID');
			$widgetID  = $this->input->post('w_id');
			$url = $this->input->post('url');
			$result = $this->model('custom/Login')->doDealerLogin($userID, $password, $custType,$sessionID, $widgetID, $url)->result;
			$this->_renderJSON($result);
	}

	// Function for Insert MGM Referral
	function insertMGMReferral(){
			
			$params = array();

			$params = array(
					'strLoginAgrmnt' => $_POST['strLoginAgrmnt'],
					'refProduct'	=> $_POST['refProduct'],
					'refName' => $_POST['refName'],
					'RefMobile' => $_POST['RefMobile'],
					'loginAgrMobile' => $_POST['LoginAgrMobile']
				);
			$referral_result = soap_emi_call( 'InsertMyReferralDetails', $params );
			
			print_r($referral_result['InsertMyReferralDetailsResult']);

	}

	/*
	*
	*
	*/
	function getMGMReferralDetails(){
			//	$params = array();

			//print_r($_POST);
			$params = array(
					'AgreementNo' => $_POST['form'][0]['value']
				);
		//	print_r($params );
		$response = array();
			$referral_result = soap_emi_call( 'getMGMReferredDetails', $params );
//print_r($referral_result);
			if(!empty($referral_result['getMGMReferredDetailsResult']['MGM_Referral_Data_Entity'])){
				$i= 0;
				//print_r($referral_result['getMGMReferredDetailsResult']['MGM_Referral_Data_Entity']);
				foreach($referral_result['getMGMReferredDetailsResult']['MGM_Referral_Data_Entity'] as $responseResult){
					if(isset($responseResult['objMGMRefData']) && !empty($responseResult['objMGMRefData'])){
							$response[] = $responseResult['objMGMRefData'];
					}else{
							if(!empty($responseResult))
								$response[] = $responseResult;
						//}
							}
					}
				//print_r($response);
				$responseData = ($response);
			}else{
				$responseData = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
			}
			print_r(json_encode($responseData));

	}

	/*
	*  Raise a Query
	*/
	function raiseQueryRequest(){
				
		//print_r($_POST); die;
		$contactId = $_POST['co_id'];
		//$amountReq = $_POST['maximum_amount'];
		//$userData=$this->session->getSessionData("userProfile");
		if(empty($contactId)){
			$param['email'] = $_POST['Contact_Emails_PRIMARY_Address'];
			$param['first_name'] = $_POST['Contact_Name_First'];
			$param['last_name'] = $_POST['Contact_Name_Last'];
			//$param['last_name'] = $_POST['Contact.Name.Last'];
			//$param['mobile'] = 
			$contactId = $this->create_contact($param);
		}
		try{
				$incident = new RNCPHP\Incident();
			 
				$incident->Subject = $_POST['Incident_Subject'];
				
			if(!empty($_POST['formData']['Incident.Product'])){
				$incident->Product =  RNCPHP\ServiceProduct::fetch($_POST['formData']['Incident.Product']);
			}
			if(!empty($_POST['formData']['Incident.Category'])){
				$incident->Category = RNCPHP\ServiceCategory::fetch($_POST['formData']['Incident.Category']);
			}
				$incident->Threads = new RNCPHP\ThreadArray();
				$incident->Threads[0] = new RNCPHP\Thread();
				$incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
				$incident->Threads[0]->EntryType->ID = 4; // Used the ID here. See the Thread object for definition
				$incident->Threads[0]->Text = $_POST['Incident_Threads'];
				
				//$incident->Language = new RNCPHP\NamedIDOptList();
				//$incident->Language->ID =1;
			 
				//$incident->Mailbox = RNCPHP\Mailbox::fetch(30);
			  
			//	$incident->Organization = RNCPHP\Organization::fetch(8);
			/*$incident->FileAttachments =new RNCPHP\FileAttachmentIncidentArray();
			$fattach = new RNCPHP\FileAttachmentIncident();
			$fattach->ContentType = "text/text";
			$fp = $fattach->makeFile();
			fwrite( $fp, "Making some notes in this text file for the incident".date("Y-m-d h:i:s"));
			fclose( $fp );
			$fattach->FileName = "NewTextFile.txt";
			$fattach->Name = "New Text File.txt";
			$incident->FileAttachments[] = $fattach;*/
			 
				$incident->PrimaryContact = RNCPHP\Contact::fetch($contactId);//Required field to create an incident through connect PHP
			 
				$incident->Queue = new RNCPHP\NamedIDLabel();
				$incident->Queue->ID = 2;
			 
				//$incident->Severity = new RNCPHP\NamedIDOptList();
				//$incident->Severity->LookupName  = 1;
			 
				$incident->StatusWithType               = new RNCPHP\StatusWithType() ;
				$incident->StatusWithType->Status       = new RNCPHP\NamedIDOptList() ;
				$incident->StatusWithType->Status->ID   = 1 ;
				 
				 //\RightNow\Connect\v1_3\CO\City::fetch( "$city" );
					if(strlen($_POST['formData']['Incident.CustomFields.CO.Loan.ID'])){
						list($loan_id,$agg_no) = explode("_",$_POST['formData']['Incident.CustomFields.CO.Loan.ID']);
						$incident->CustomFields->CO->Loan = \RightNow\Connect\v1_3\CO\Loan::fetch($loan_id);
					}
				
				 if(!empty($_POST['Incident_CustomFields_c_incident_email_id'])){
						$incident->CustomFields->c->incident_email_id = $_POST['Incident_CustomFields_c_incident_email_id'];
						$incident->CustomFields->c->use_existing_details = 0;
				 }
				 if(!empty($_POST['Incident_CustomFields_c_incident_mobile_number'])){
						$incident->CustomFields->c->incident_mobile_number = $_POST['Incident_CustomFields_c_incident_mobile_number'];
						$incident->CustomFields->c->use_existing_details = 0;
				 }
				 $incident->save();
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
Get product based on Agreement Number

*/
function getProduct(){
		
		$msg = \RightNow\Connect\v1_3\MessageBase::fetch(1000037);
		$agreement_no = $_POST['agg_no'];
		$report_id = $msg->Value;
		list($loan_id,$agg_no) = explode("_",$agreement_no);
		$filter=array('Agreement_No'=>$agg_no);
		$report_result=report_result($report_id,$filter);
		echo $report_result[0]['Product'];
		//echo '5';
		//print_r($report_result); 
}

/*
	/*
*
* Function for Employee Login
*
*/
	function doEmployeeLogin(){

		//print_r($_POST);
		if(!$this->checkForValidFormToken()) {
					$this->_renderJSON(array('message' => Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG), 'showLink' => false));
				return;
			}
		
			$userID = $this->input->post('login');
			$password = $this->input->post('password');
			$custType = $this->input->post('custType');
			$sessionID = $this->session->getSessionData('sessionID');
			$widgetID  = $this->input->post('w_id');
			$url = $this->input->post('url');
			$result = $this->model('custom/Login')->doEmployeeLogin($userID, $password, $custType,$sessionID, $widgetID, $url)->result;
			$this->_renderJSON($result);
	}

/*
	*[{"Dealer Code":"2438","Latitude":"28.604264","Longitude":"77.061303","Distance":12.108005845147,"Dealer Email":"dynamictvs@gmail.com","First Name":"DYNAMIC","Last Name":"MOTORS PVT LTD"},{"Dealer Code":"2569","Latitude":"28.579466","Longitude":"76.945983","Distance":16.467982579546,"Dealer Email":"vardhman.traders@gmail.com","First Name":"VARDHMAN","Last Name":"TRADERS"},{"Dealer Code":"1979","Latitude":"28.613939","Longitude":"77.209021","Distance":17.616997024229,"Dealer Email":"sk_tvswest@yahoo.com","First Name":"SK","Last Name":"TRADERS"},{"Dealer Code":"1015","Latitude":"28.62777","Longitude":"77.284787","Distance":24.171604552973,"Dealer Email":"cv_kapilkumar@rediffmail.com","First Name":"GS","Last Name":"MOTORS"},{"Dealer Code":"1980","Latitude":"28.672311","Longitude":"77.238083","Distance":24.416942067094,"Dealer Email":"rajpootmotorstvs@gmail.com","First Name":"RAJPOOT","Last Name":"MOTORS"}]

	*/
	function getDealerStores(){
			$lat = $_POST['lat'];
			$long = $_POST['lng'];
			$url = "https://tvscs.custhelp.com/cgi-bin/tvscs.cfg/php/custom/nearest_dealer.php?latitude=".$lat."&longitude=".$long ."&range=25";
			load_curl();
			$response = json_decode($this->nusoap_lib->getDealerData($url ));
			$i = 0;
			//print_r($response);
			foreach($response as $key => $results){
						
						$resultData = (array)$results;
						// We add the store to the result array.
						$nearbyStores[$i]['id'] = $resultData['Dealer Code'];
						$nearbyStores[$i]['name'] = ucfirst($resultData['First Name'].' '.$resultData['Last Name']);
						$nearbyStores[$i]['latitude'] = $resultData['Latitude'];
						$nearbyStores[$i]['longitude'] = $resultData['Longitude'];
						$nearbyStores[$i]['email'] = $resultData['Dealer Email'];
						$nearbyStores[$i]['city'] = $resultData['City'];
						$nearbyStores[$i]['address'] = $resultData['Address'];
						$nearbyStores[$i]['distance-kilometers'] = round($resultData['Distance']) . ' km';
						$nearbyStores[$i++]['distance-miles'] = round($resultData['Distance'] / 1.6) . ' mi';
			}
			//id, name, address, zip, city, state, country, url, latitude, longitude,
			// We construct two strings containing the distance in kilometers and miles.
			
			print_r(json_encode($nearbyStores));
	
	}


	/*
	*
	* Get Newjencourier Details
	*/
	function getNewjencourierdetails(){
			//	$params = array();

			//print_r($_POST);
			$params = array(
					'AgreementNo' => $_POST['form'][0]['value']
				);
		//	print_r($params );
		$response = array();
			$referral_result = soap_emi_call( 'getNewGenCourierOutWardData', $params );
//print_r($referral_result);
			if(!empty($referral_result['getNewGenCourierOutWardDataResult']['NewGEN_CourierOutWard_Data_Entity'])){
				$i= 0;
				//print_r($referral_result['getMGMReferredDetailsResult']['MGM_Referral_Data_Entity']);
				foreach($referral_result['getNewGenCourierOutWardDataResult']['NewGEN_CourierOutWard_Data_Entity'] as $responseResult){
					if(isset($responseResult['objCourierOutWrdData']) && !empty($responseResult['objCourierOutWrdData'])){
							$response[] = $responseResult['objCourierOutWrdData'];
					}else{
							if(!empty($responseResult))
								$response[] = $responseResult;
						//}
							}
					}
				//print_r($response);
				$responseData = ($response);
			}else{
				$responseData = array("sEcho"=> 0, "iTotalRecords" => "0","iTotalDisplayRecords" => "0","aaData" => array() );
			}
			print_r(json_encode($responseData));

	}

	
}