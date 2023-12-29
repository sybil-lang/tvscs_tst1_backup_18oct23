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
    //this function. LIVE
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
    function search()
    {
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
    function soap_call($functionName, $arrparam)
    {

        //	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
        load_curl();
        $this->load->library("Nusoap_lib");
        $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_TVS_API_URL);
        $url = $msg->Value;
        //$client = new SoapClient( $url, 'wsdl' );
        //$client->soap_defencoding = 'UTF-8';
        $param = array('parameters' => $arrparam);
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
    function getKeyProfileFields()
    {

        $functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];
        $Key_code = $_REQUEST['key_code'];

        $url = urldecode($_REQUEST['tvsApi']);
        $url = str_replace("http", "https", $url);
        $url = str_replace("?wsdl", "", $url);
        $arrParam = array('Key_code' => $Key_code, 'AgencyCode' => $agencyCode);


        // $VProfileFieldsList = soap_lead_call($functionName,$arrParam,$url );
        $VProfileFieldsREST = soap_lead_rest_call($functionName, $arrParam, $url);
        //print_r($VStateList);
        // $VProfileFieldsJson =  json_encode($VProfileFieldsList[ 'GetVCommonFieldsResult' ][ 'LMS_Common_Fields_Entity' ]);
        //	return $VStateJson;
        print_r($VProfileFieldsREST);
    }

    /*
* Get Repayment Type for Lead Form
*/
    function getRepaymentType()
    {

        $functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];

        $url = urldecode($_REQUEST['tvsApi']);
        $url = str_replace("http", "https", $url);
        $url = str_replace("?wsdl", "", $url);
        $arrParam = array('AgencyCode' => $agencyCode);

        $VRepaymentType = soap_lead_rest_call($functionName, $arrParam, $url); //soap_lead_call($functionName,$arrParam,$url );
        //print_r($VStateList);
        // $VRepaymentTypeJson =  json_encode($VRepaymentType[ 'GetVRepaymentTypeResult' ][ 'LMS_RepaymentType_Entity' ]);
        //	return $VStateJson;
        print_r($VRepaymentType);
    }
    /*
* Get State for Lead Form
*/
    function getState()
    {

        $functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];
        $url = $_REQUEST['tvsApi'];

        $arrParam = array('AgencyCode' => $agencyCode);

        $VStateList = soap_lead_call($functionName, $arrParam, $url);
        //print_r($VStateList);
        $VStateJson =  json_encode($VStateList['GetVStateNameResult']['LMS_State_Entity']);
        //	return $VStateJson;
        print_r($VStateJson);
    }

    /*
*
*/
    /*
* Get City for Lead Form
*/
    function getCity()
    {

        //	$functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];
        $stateCode = $_REQUEST['statecode'];
        $url = $_REQUEST['tvsApi'];


        $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_REPORT_INDIAN_STATES_AND_CITIES);
        $cityreport_id = $msg->Value;
        if ($cityreport_id > 0) {
            $filter = array('State Code' => $stateCode);
            $city_Array = report_result($cityreport_id, $filter);
        }
        $cityArray = array();
        $i = 0;
        foreach ($city_Array as $key => $result) {
            $cityArray[$i]['City_Code'] = $result['City Code'];
            $cityArray[$i++]['City_Name'] = $result['City Name'];
        }
        print_r(json_encode($cityArray));
    }

    /*
* Get City for Lead Form
*/
    function getYear()
    {

        $functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];
        $url = $_REQUEST['tvsApi'];
        $url = str_replace("http", "https", $url);
        $url = str_replace("?wsdl", "", $url);
        $arrParam = array('AgencyCode' => $agencyCode);


        $VYearNameList = soap_lead_rest_call($functionName, $arrParam, $url);
        //print_r($VStateList);
        // $VYearJson =  json_encode( $VYearNameList[ 'GetVDynamicLast20YearsResult' ][ 'LMS_DynamicYearGen_Entity' ]);
        //	return $VStateJson;
        print_r($VYearNameList);
    }

    /*
		*
		*/
    function get_make()
    {
        $functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];
        $yearCode = $_REQUEST['year'];
        $url = $_REQUEST['tvsApi'];
        $url = str_replace("http", "https", $url);
        $url = str_replace("?wsdl", "", $url);
        if (!empty($yearCode)) {
            $arrParam = array('Year' => $yearCode, 'AgencyCode' => $agencyCode);
        } else {

            $arrParam = array('Year' => date('Y'), 'AgencyCode' => $agencyCode);
        }

        $VMakeList = soap_lead_rest_call($functionName, $arrParam, $url);
        //print_r($VStateList);
        // $VMakeJson =  json_encode( $VMakeList['getVMakeListResult']['LMS_IBBMake_Entity']);
        //	return $VStateJson;
        print_r($VMakeList);
    }

    function get_Make_Rest()
    {
        $functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];
        $yearCode = $_REQUEST['year'];
        $url = urldecode($_REQUEST['tvsApi']);
        $url = str_replace("http", "https", $url);
        $new_url = explode("?", $url);
        // echo $new_url[0]."/".$functionName;
        if (empty($yearCode)) {
            $yearCode = date('Y');
        }
        if (!extension_loaded("curl")) {
            load_curl();
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $new_url[0] . "/" . $functionName,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 80,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"year\":\"$yearCode\",\"AgencyCode\":\"$agencyCode\"}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        // echo "<br>";
        // print_r(json_encode($arrParam));
    }

    function get_model()
    {

        $functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];
        $yearCode = $_REQUEST['year'];
        $make = $_REQUEST['make'];
        $url = urldecode($_REQUEST['tvsApi']);
        $url = str_replace("http", "https", $url);

        if (!empty($yearCode)) {
            $arrParam = array('Year' => $yearCode, 'Make' => $make, 'AgencyCode' => $agencyCode);
        } else {

            $arrParam = array('Year' => date('Y'), 'Make' => $make, 'AgencyCode' => $agencyCode);
        }

        $VModelList = soap_lead_rest_call($functionName, $arrParam, $url);
        //print_r($VStateList);
        //$VModelJson =  json_encode( $VModelList['getVModelListResult']['LMS_IBBModel_Entity']);
        //	return $VStateJson;
        print_r($VModelList);
    }

    function get_Model_Rest()
    {
        $functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];
        $yearCode = $_REQUEST['year'];
        $make = $_REQUEST['make'];
        $url = urldecode($_REQUEST['tvsApi']);
        $url = str_replace("http", "https", $url);
        $new_url = explode("?", $url);
        if (!extension_loaded("curl")) {
            load_curl();
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $new_url[0] . "/" . $functionName,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"year\":\"$yearCode\",\"AgencyCode\":\"$agencyCode\",\"Make\":\"$make\"}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    function get_varient()
    {

        $functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];
        $yearCode = $_REQUEST['year'];
        $make = $_REQUEST['make'];
        $model = $_REQUEST['model'];
        $url = $_REQUEST['tvsApi'];

        if (!empty($model)) {
            $arrParam = array('Year' => $yearCode, 'Make' => $make, 'Model' => $model, 'AgencyCode' => $agencyCode);
        } else {

            $arrParam = array('Year' => date('Y'), 'Make' => $make,  'Model' => 'UNO', 'AgencyCode' => $agencyCode);
        }

        $V_VariantlList = soap_lead_call($functionName, $arrParam, $url);
        //print_r($VStateList);
        $VariantJson =  json_encode($V_VariantlList['getV_VariantlListResult']['LMS_IBBVariant_Entity']);
        //	return $VStateJson;
        print_r($VariantJson);
    }

    function get_Variant_Rest()
    {
        $functionName = $_REQUEST['methodName'];
        $agencyCode = $_REQUEST['agencyCode'];
        $yearCode = $_REQUEST['year'];
        $make = $_REQUEST['make'];
        $model = $_REQUEST['model'];
        $url = urldecode($_REQUEST['tvsApi']);
        $url = str_replace("http", "https", $url);

        $new_url = explode("?", $url);
        if (!extension_loaded("curl")) {
            load_curl();
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $new_url[0] . "/" . $functionName,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"year\":\"$yearCode\",\"AgencyCode\":\"$agencyCode\",\"Make\":\"$make\",\"Model\":\"$model\"}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    /**
     * Perform the login of a user given their username/password. Returns the result from the
     * login. Either additional redirect information, or an error message.
     */
    public function doOTPLogin()
    {
        //AbuseDetection::check();
        if (!$this->checkForValidFormToken()) {
            $this->_renderJSON(array('message' => Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG), 'showLink' => false));
            return;
        }

        $userID = $this->input->post('login');
        $password = $this->input->post('password');
        $sessionID = $this->session->getSessionData('sessionID');
        $widgetID  = $this->input->post('w_id');
        $url = $this->input->post('url');
        $submit_div_id = $this->input->post('div_name_submit');
        $result = $this->model('custom/Login')->doLogin($userID, $password, $sessionID, $widgetID, $url, $submit_div_id)->result;
        $this->_renderJSON($result);
    }

    /**
     * Looks for a form token in the post parameters and verifies its validity.
     * @return Boolean Whether the form token exists and is valid
     */
    private function checkForValidFormToken()
    {
        $formToken = $this->input->post('f_tok');
        return count($_POST) && $formToken && Framework::isValidSecurityToken($formToken, 0);
    }

    /**
     * Send the OTP to User on Given Mobile Number if exist in Rightnow Contact. Either additional redirect information, or an error message.
     */
    public function doOTPSend()
    {
        //AbuseDetection::check();
        if (!$this->checkForValidFormToken()) {
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
    function rest_api_call()
    {
        load_curl();
        // $ch = curl_init("https://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:".$_REQUEST['method'].",agreementNo:".$_REQUEST['ag_no']."}");
        $apitoken = $this->nusoap_lib->generateToken();

        if (empty($apitoken)) {
            return 'Token Mismatch';
        }
        //$result = '';

        $ch = curl_init("https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:" . $_REQUEST['method'] . ",agreementNo:" . $_REQUEST['ag_no'] . "}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //		 curl_setopt($ch,CURLOPT_POSTFIELDS,$data_encoded);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'token_id: ' . $apitoken, "content-length: 0"));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        //  print_r($result."hello=");
        // exit;
        $data_decode = json_decode($result);
        if ($_REQUEST['method'] == "getCustomerDetails") {

            $html_outout = '<div class="form-2">
									<h1><span class="log-in">Login Status</span></h1>
									
									<p class="float">
										<label for="Customer_Name"><i class="fa fa-user"></i>Customer Name</label>
										<input type="text" name="Customer_Name" value = "' . $data_decode[0]->CUSTOMER_NAME . '" disabled> 
									</p>
									<p class="float">
										<label for="gender"><i class="fa fa-transgender" aria-hidden="true"></i> Gender</label>
										<input type="text" name="db_date" value = "' . $data_decode[0]->GENDER . '" disabled>
									</p>
									<p class="float">
										<label for="DATE_OF_BIRTH"><i class="fa fa-calendar"></i>Date of Birth</label>
										<input type="text" name="birth_date" value = "' . $data_decode[0]->DATE_OF_BIRTH . '" disabled>
									</p>
									<p class="float">
										<label for="address"><i class="fa fa-address-card" aria-hidden="true"></i>Address</label>
										<textarea name="address" disabled>' . $data_decode[0]->ADDRESS . '</textarea>
									</p>
									<p class="float">
										<label for="AGREEMENT_NUMBER"><i class="fa fa-lock"></i>Agreement Number</label>
										<input type="text" name="AGREEMENT_NUMBER" value = "' . $data_decode[0]->AGREEMENT_NUMBER . '" disabled>
									</p>
									<!--<p class="float">
										<label for="LOGIN_DATE"><i class="fa fa-calendar"></i>Login Date</label>
										<input type="text" name="LOGIN_DATE" value = "' . $data_decode[0]->LOGIN_DATE . '" disabled> 
									</p>-->
									<p class="float">
										<label for="MOBILE_NUMBER"><i class="fa fa-mobile"></i>Mobile Number</label>
										<input type="text" name="MOBILE_NUMBER" value = "' . $data_decode[0]->MOBILE_NUMBER . '" disabled>
									</p>
									<p class="float">
										<label for="CUSTOMER_NUMBER"><i class="fa fa-user-o"></i>Customer Number</label>
										<input type="text" name="CUSTOMER_NUMBER" value = "' . $data_decode[0]->CUSTOMER_NUMBER . '" disabled> 
									</p>
									
								</div>';
            echo $html_outout;
        } else if ($_REQUEST['method'] == "getLastPaymentDetails") {
            //print_r($result);
            $html_outout = '<div class="form-2">
									<h1><span class="log-in">Charges</span></h1>';
            if (!empty($data_decode)) {
                foreach ($data_decode as $key => $charge_data) {
                    $html_outout .= '<p class="float">
												<label for="' . $charge_data->DUE_TYPE . '"><i class="fa fa-inr"></i>' . $charge_data->DUE_TYPE . '</label>
												<input type="text" name="' . $charge_data->DUE_TYPE . '" value = "' . $charge_data->VALUE . '" disabled>
											</p>';
                }
            }
            $html_outout .= '</div>';
            echo $html_outout;
        } else {
            //echo '<p>';
            $curlerror = curl_error($ch);
            if ($curlerror) {
                // echo "<br><p>CURL Error:".$curlerror.'</p>';
                $respdata = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
                print_r(json_encode($respdata));
            } else {
                if (!empty($data_decode)) {
                    print_r($result);
                } else {

                    $respdata = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
                    print_r(json_encode($respdata));
                }
                //echo '</p>';
            }


            curl_close($ch);
        }
    }

    /*
	*	 Get Data from LMS and RMS 
	*/
    function rest_api_call_drop()
    {
        $agmt = $_REQUEST["ag_no"];
        if ($_REQUEST["method_val"] == "getMandateStatuses") {
            load_curl();
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://tvscscrmservice.tvscredit.com/CRMService.svc/MandateAgreementflag",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS => "{\r\n\t\"AgreementNo\":\"$agmt\"\r\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $curl_error = curl_error($curl);
            curl_close($curl);
            if ($curl_error) {
                print_r($curl_error);
            } else {
                // header('Content-type:application/json;charset=utf-8');
                print_r($response);
            }
        } else if ($_REQUEST["method_val"] == "getMandateLoanStatuses") {
            // uncomment below code for it to work.
            load_curl();
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://customeroperationapi.tvscredit.com/Customer/NPCI", //  https://ivrserviceuat.tvscredit.com/Customer/NPCI
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS => "{\r\n\t\"AgreementNo\":\"$agmt\"\r\n}",
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic SVZSVVNSOklWUlVTUiQ=',
                    'Content-Type: application/json'
                    // 'Cookie: ChannelName=IVR'
                ),
            ));

            $response = curl_exec($curl);
            $curl_error = curl_error($curl);
            curl_close($curl);
            if ($curl_error) {
                print_r($curl_error);
            } else {
                $response = json_decode($response);
                // header('Content-type:application/json;charset=utf-8');
                if ($response->ReturnMessage == "NPCI") {
                    print_r(json_encode($response));
                } else {
                    // $response->ReturnOutput=null;
                    print_r(json_encode($response));
                }
            }
            // $sample_response = array("message"=>"sample response");
            // echo json_encode($sample_response);
        } else {
            //method_val : "getInsuranceDetails"
            load_curl();
            $apitoken = $this->nusoap_lib->generateToken();
            if (empty($apitoken)) {
                return 'Token Mismatch';
            }
            //$_REQUEST['ag_no'] = 'HR3047TW16786';
            if ($_REQUEST['method_val'] == "getInsuranceDetails") {
                // $ch = curl_init("https://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:".$_REQUEST['method_val'].",agreementNo:".$_REQUEST['ag_no']."}");
                $ch = curl_init("https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:" . $_REQUEST['method_val'] . ",agreementNo:" . $_REQUEST['ag_no'] . "}");
            } else {
                // $ch = curl_init("https://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getLoanStatusandOtherDetails,agreementNo:".$_REQUEST['ag_no']."}");
                $ch = curl_init("https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getLoanStatusandOtherDetails,agreementNo:" . $_REQUEST['ag_no'] . "}");
            }

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'token_id: ' . $apitoken, "content-length: 0"));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            $data_decode = json_decode($result);
            if ($_REQUEST['method_val'] == 'initialloanamount') {
                $this->model('custom/EmpSession')->updateEmpSessionData($_REQUEST['ag_no']);
                echo "<div class='form-2'><fieldset><p class='float'><label for='loan_amount'><i class='fa fa-inr'></i><strong>Initial Loan Amount</strong></label>";
                if ($data_decode->error_desc == "No Data Found") {
                    echo "No Data Found</p>";
                } else {
                    echo '<input type="text" name="loan_amount" value = "' . number_format($data_decode[0]->LOAN_AMOUNT, 2) . '" disabled>';
                    echo "</p></fieldset></div>";
                }
            } else if ($_REQUEST['method_val'] == 'statusofloan') {
                $this->model('custom/EmpSession')->updateEmpSessionData($_REQUEST['ag_no']);
                //echo "<p><strong>Status of Loan :</strong>";
                echo "<div class='form-2'><fieldset><p class='float'><label for='status_loan'><i class='fa fa-user'></i><strong>Status of Loan </strong></label>";
                if ($data_decode->error_desc == "No Data Found") {
                    echo "No Data Found</p>";
                } else {
                    echo '<input type="text" name="status_loan" value = "' . $data_decode[0]->LOAN_STATUS . '" disabled>';
                    echo "</p></fieldset></div>";
                    //							echo ;
                    //						echo '</p>';
                }
            } else if ($_REQUEST['method_val'] == 'getInsuranceDetails') {
                $this->model('custom/EmpSession')->updateEmpSessionData($_REQUEST['ag_no']);
                /* Check for Foreclosure Letter */
                $flag_foreclosure_letter  = false;
                $flag_foreclosure_letter = $this->checkForClosureLetter($_REQUEST['ag_no']);

                //echo $flag_foreclosure_letter."ggpd";

                if ($data_decode->error_desc == "No Data Found") {
                    //echo "<p>No Data Found</p>"; 
                    //$url_for = "https://rmsuatnew.tvscredit.com/rms/Jasper?AGRNO=".$_REQUEST['ag_no']."&DATE=".date('d/m/Y')."&report=Foreclosure_Print";
                    if ($flag_foreclosure_letter) {
                        $url_for = "https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=" . $_REQUEST['ag_no'] . "&DATE=" . date('d/m/Y') . "&report=Foreclosure_Print";
                    } else {
                        $url_for = '';
                    }
                    //$soa_for = "https://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=".$_REQUEST['ag_no'];

                    $soa_for = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=" . $_REQUEST['ag_no'];

                    $arr = array("url_ins" => '', "url_for" => $url_for, "soa_for" => $soa_for, "message" => 'aa');
                    print_r(json_encode($arr));
                } else {
                    $ins_number = 0;
                    $policy_number = '';
                    if (!empty($data_decode)) {
                        foreach ($data_decode as $key => $result) {
                            //print_r($result);

                            if ($result->INSURANCE_RENEWAL_NO > $ins_number ||  $ins_number == 0) {
                                $policy_number = $result->INSURANCE_POLICY_NO;
                            }
                            $ins_number = $result->INSURANCE_RENEWAL_NO;
                        }
                    }
                    if (!empty($policy_number)) {
                        /* $arr = array("first"=>$data_decode[0]->LAST_EMI_DATE,"second"=>$data_decode[0]->INTEREST_RATE,"third"=>$data_decode[0]->EMI_AMOUNT,"fourth"=>$data_decode[0]->PAYMENT_MODE,"fifth"=>$data_decode[0]->REMAINING_PRINCIPAL,"sixth"=>$data_decode[0]->LOAN_STATUS,"seventh"=>$data_decode[0]->TENOR,"eigth"=>$data_decode[0]->LOAN_AMOUNT);
				 print_r(json_encode($arr));*/
                        $pos = strpos($policy_number, "P");
                        if ($pos == false) {
                            //$url_ins = "https://portal.uiic.in/polclaim/accounts/DirectDupPrnVouchShowReportAction.do?PolNo=3".$data_decode[0]->INSURANCE_POLICY_NO."&reportType=schedule&transactionId=null";
                            $url_ins = "https://portal.uiic.in/polclaim/accounts/DirectDupPrnVouchShowReportAction.do?PolNo=3" . $policy_number . "&reportType=schedule&transactionId=null";

                            //$url_for = "https://rmsuatnew.tvscredit.com/rms/Jasper?AGRNO=".$_REQUEST['ag_no']."&DATE=".date('d/m/Y')."&report=Foreclosure_Print";
                            if ($flag_foreclosure_letter) {
                                $url_for = "https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=" . $_REQUEST['ag_no'] . "&DATE=" . date('d/m/Y') . "&report=Foreclosure_Print";
                            } else {
                                $url_for = '';
                            }
                            //$soa_for = "https://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=".$_REQUEST['ag_no'];
                            $soa_for = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=" . $_REQUEST['ag_no'];
                        } else {
                            //$url_ins = "https://portal.uiic.in/GCCustomerPortalService/PdfGenerator.ashx?strToken=586034d8-a020-49db-af33-76f3a772837e&strUserID=RENEWAL@TVS&strUserRole=DEALER&strPolicyNumber=".$data_decode[0]->INSURANCE_POLICY_NO;
                            $url_ins = "https://portal.uiic.in/GCCustomerPortalService/PdfGenerator.ashx?strToken=a7ef5f22-f962-4dd2-aee8-c5e08a34dbfe&strUserID=RENEWAL@TVS&strUserRole=DEALER&strPolicyNumber=" . $policy_number;
                            if ($flag_foreclosure_letter) {
                                $url_for = "https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=" . $_REQUEST['ag_no'] . "&DATE=" . date('d/m/Y') . "&report=Foreclosure_Print";
                            } else {
                                $url_for = '';
                            }

                            $soa_for = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=" . $_REQUEST['ag_no'];
                        }
                        $arr = array("url_ins" => $url_ins, "url_for" => $url_for, "soa_for" => $soa_for, "message" => '');
                    } else {
                        $url_ins = "";
                        if ($flag_foreclosure_letter) {
                            $url_for = "https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=" . $_REQUEST['ag_no'] . "&DATE=" . date('d/m/Y') . "&report=Foreclosure_Print";
                        } else {
                            $url_for = '';
                        }
                        $soa_for = "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveSOAPDF?agreementNo=" . $_REQUEST['ag_no'];
                        $arr = array("url_ins" => $url_ins, "url_for" => $url_for, "soa_for" => $soa_for, "message" => 'aa');
                    }

                    print_r(json_encode($arr));
                }
            } else {
                $arr = array("first" => $data_decode[0]->LAST_EMI_DATE, "second" => $data_decode[0]->MONTHLYDUE, "third" => $data_decode[0]->INTEREST_RATE, "fourth" => $data_decode[0]->EMI_AMOUNT, "fifth" => $data_decode[0]->PAYMENT_MODE, "sixth" => $data_decode[0]->REMAINING_PRINCIPAL, "seventh" => $data_decode[0]->LOAN_STATUS, "eigth" => $data_decode[0]->TENOR, "ninth" => $data_decode[0]->INSAMT, "tenth" => $data_decode[0]->LOAN_AMOUNT);
                print_r(json_encode($arr));
            }
            $count_data_decode = count($data_decode);

            $curlerror = curl_error($ch);
            if ($curlerror) {
                echo "<br>CURL Error:" . $curlerror;
            }

            curl_close($ch);
        }
    }

    /*
	*Generate API Report
	*/
    function rest_api_call2()
    {
        //load_curl();
        $msg = \RightNow\Connect\v1_3\MessageBase::fetch('1000001');
        $report_id = $msg->Value;
        //$report_id = '1000001';
        $contact_id = $this->session->getProfileData("c_id");
        if ($report_id > 0) {
            $filter = array('ContactID' => $contact_id);
            $report_result = report_result($report_id, $filter);
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
        } else {
            echo "<p>No Report Found</p>";
        }
    }
    function check_soa_permission()
    {
        load_curl();
        $curl = curl_init();
        $ag_no = $_POST['ag_no'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://customeroperationapi.tvscredit.com/Customer/SOADownloadValidation", // uat=https://ivrserviceuat.tvscredit.com/Customer/SOADownloadValidation
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n \"AgreementNo\":\"$ag_no\"\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic VklSVFVPUzpWSVJUVU9TJA==",
                "Content-Type: application/json",
                "Cookie: ChannelName=IVR"
            ),
        ));

        $response = curl_exec($curl);
        $curlerror = curl_error($curl);
        curl_close($curl);
        if (strlen($curlerror) > 0) {
        } else {
            header('Content-type:application/json;charset=utf-8');
            print_r(json_encode($response));
        }
    }
    /*
* Generate API Report from Rightnow
*/
    function rest_api_report()
    {
        //$url = "https://RNTpartner_VirtuosNarendra:Rightnow!1@tvscs.custhelp.com/services/rest/connect/v1.3/analyticsReportResults"; 

        $idreport = $_POST['id_of_report'];
        //{"filters":[{"name":"<FilterName>","values":"<filtervalue>"}],"id":<report Id>}
        //{"filters":[{"name":"ContactID","values":"3"}],"id":100010}
        $contact_id = $this->session->getProfileData("c_id");

        //print_r($content );
        load_curl();
        $filter = array('ContactID' => $contact_id);
        $response = report_result($idreport, $filter);
        $userData = $this->session->getSessionData("userProfile");
        $agg_count = count($response);
        $methodval = $_POST['method_val'];
        $flag = false;
        if ($_REQUEST['filtering_val'] == 'initialloan') {
            echo "<div class='form-group'><select id='i_loan'><option value='0'>--Select--</option>";
            //for($i = 0; $i < $agg_count; $i++ ) {
            foreach ($response as $key => $result) {
                //	if(!empty($userData['agg_no']) && $userData['agg_no'] == $result['Agreement No']){
                //			$sel = "selected";
                //			$flag = true;
                //	}else{
                $sel = '';
                //	}	
                echo '<option value=' . $result['Agreement No'] . ' ' . $sel . '>' . $result['Agreement No'] . '</option>';
            }
            echo '</select></div>';
?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#i_loan').trigger('change'); //This event will fire the change event. 
                    $('#i_loan').change(function() {
                        $('#iload').css("display", "block");
                        var d = $(this).val();
                        $.post("/cc/AjaxCustom/rest_api_call_drop", {
                                ag_no: d,
                                method_val: '<?php echo $methodval; ?>'
                            })
                            .done(function(data) {
                                $("#showresult").html(data);
                                $('#iload').css("display", "none");

                            });
                    });

                });
            </script>

        <?php
        } else if ($_REQUEST['filtering_val'] == 'edoc') {
            echo "<div class='form-group'><select id='edoc_loan'><option value='0'>--Select--</option>";
            foreach ($response as $key => $result) {
                //if(!empty($userData['agg_no']) && $userData['agg_no'] == $result['Agreement No']){
                //		$sel = "selected";
                //	$flag = true;
                //}else{
                $sel = '';

                //}	
                echo '<option value=' . $result['Agreement No'] . ' ' . $sel . '>' . $result['Agreement No'] . '</option>';
            }
            echo '</select></div>';
        ?>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#edoc_loan').trigger('change'); //This event will fire the change event. 
                    $('#edoc_loan').change(function() {

                        var x = $(this).val();
                        if ($(this).val() != '0') {
                            $('#iload_edoc').css("display", "block");

                            $.post("/cc/AjaxCustom/edoc", {
                                    ag_no: x,
                                    method_val: '<?php echo $methodval; ?>'
                                })
                                .done(function(data) {
                                    var href_data1 = "";
                                    var data = JSON.parse(data);
                                    // console.log('pdfdata',data);
                                    $('#edoc1_s').addClass('hidden');
                                    $('#edoc2_s').addClass('hidden');

                                    document.getElementById('error_msg').innerHTML = ""

                                    document.getElementById('edoc_showresult_btn1').innerHTML = ""
                                    document.getElementById('edoc_showresult_btn2').innerHTML = ""
                                    // document.getElementById('edoc1_s').innerHTML="";
                                    // document.getElementById('edoc2_s').innerHTML="";
                                    if (data.statusMessage == "Success") {
                                        href_data1 = data.data;


                                        // console.log('if1',data);

                                        $.post("/cc/AjaxCustom/edoc", {
                                                ag_no: x,
                                                method_val: 'SANC_EAGRE'
                                            })
                                            .done(function(data) {
                                                var data = JSON.parse(data);
                                                href_data = data.data;
                                                // console.log('if2',data);
                                                if (href_data) {
                                                    document.getElementById('edoc_showresult_btn1').innerHTML += '<a class="btnclass" target="_blank" class="edoc_pdficon" download="application.pdf" download="file.pdf" href="data:application/pdf;base64,' + href_data1 + '">Download Application Form</a><br>';
                                                    // document.getElementById('APP_b_href').href=href_data

                                                    $('#edoc1_s').removeClass('hidden');
                                                    document.getElementById('edoc_showresult_btn2').innerHTML += '<a class="btnclass" target="_blank" class="edoc_pdficon" download="sanction.pdf" href="data:application/pdf;base64,' + href_data + '">Download Agreement Letter</a>';
                                                    // document.getElementById('SAN_b_href').href=href_data
                                                    $('#edoc2_s').removeClass('hidden');
                                                    $('#iload_edoc').css("display", "none");

                                                }

                                                // $( "#showresult" ).html(data);

                                            });
                                    } else {
                                        // $('#edoc1_s').removeClass('hidden');
                                        document.getElementById('error_msg').innerHTML = data.statusMessage;
                                        // console.log('else',data);
                                        $('#iload_edoc').css("display", "none");

                                    }

                                });
                        } else {
                            document.getElementById('error_msg').innerHTML = ""

                            document.getElementById('edoc_showresult_btn1').innerHTML = ""
                            document.getElementById('edoc_showresult_btn2').innerHTML = ""
                            $('#edoc1_s').addClass('hidden');
                            $('#edoc2_s').addClass('hidden');

                        }
                        // $('#iload_edoc').css("display","none");


                    });
                });
            </script>

        <?php
        } else if ($_REQUEST['filtering_val'] == 'statusofloan') {
            echo "<div class='form-group'><select id='s_loan'><option value='0'>--Select--</option>";
            foreach ($response as $key => $result) {
                //if(!empty($userData['agg_no']) && $userData['agg_no'] == $result['Agreement No']){
                //		$sel = "selected";
                //	$flag = true;
                //}else{
                $sel = '';

                //}	
                echo '<option value=' . $result['Agreement No'] . ' ' . $sel . '>' . $result['Agreement No'] . '</option>';
            }
            echo '</select></div>';
        ?>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#s_loan').trigger('change'); //This event will fire the change event. 
                    $('#s_loan').change(function() {
                        $('#isload').css("display", "block");
                        var x = $(this).val();
                        $.post("/cc/AjaxCustom/rest_api_call_drop", {
                                ag_no: x,
                                method_val: '<?php echo $methodval; ?>'
                            })
                            .done(function(data) {
                                $("#showresult_loan").html(data);
                                $('#isload').css("display", "none");
                            });
                    });
                });
            </script>

        <?php
        } else if ($_REQUEST['filtering_val'] == 'instrumentdetails') {
        	$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_paperless_noc);
											$valll=$msg->Value;
            echo "<div class='form-group'><select id='i_detail'><option value='0'>--Select--</option>";
            foreach ($response as $key => $result) {
                //	if(!empty($userData['agg_no']) && $userData['agg_no'] == $result['Agreement No']){
                //$sel = "selected";
                //$flag = true;
                //}else{
                $sel = '';
                //}	
                echo '<option value=' . $result['Agreement No'] . ' ' . $sel . '>' . $result['Agreement No'] . '</option>';
            }
            echo '</select></div>';
        ?>
            <script type="text/javascript">
                var isSoaOk = true;
                $(document).ready(function() {


                    $('#i_detail').trigger('change');
                    $('#i_detail').change(function() {


                        if ($(this).val() != '0' && $(this).val() != null) {
                            ////////////////////////////code for paperlessnoc
                            var agg_no = $('#i_detail').val();
                            var firstchar = agg_no[0];
                            var secondchar = agg_no[1];
                            var vall = '<?php echo $valll; ?>';
                            var firstchar1 = vall[0];
                            var secondchar2 = vall[1];

                            console.log(firstchar, secondchar, middlechar,firstchar1,secondchar2);


                            var middlechar = agg_no.includes("TW");
                            document.getElementById('paperlessnoc').style.display = "none";
                            if (firstchar == firstchar1 && secondchar == secondchar2 && middlechar) {
                                // console.log(firstchar, secondchar, middlechar);
                                $.post("/cc/AjaxCustom/paperlessnoc", {
                                        agg_no: agg_no
                                    })
                                    .done(function(data) {
                                        if (data != 'no data found') {
                                            var bin = atob(data);
                                            console.log('File Size:', Math.round(bin.length / 1024), 'KB');
                                            if (Math.round(bin.length / 1024)) {
                                                document.getElementById('paperlessnoc').style.display = "block";
                                            }
                                        }

                                    });


                            } else {
                                document.getElementById('paperlessnoc').style.display = "none";
                            }
                            ////////////////////////////code for paperlessnoc
                            $('#idload').css("display", "block");
                            var id = $(this).val();
                            $.post("/cc/AjaxCustom/InsuranceRenewalPolicy", {
                                    ag_no: id
                                })
                                .done(function(data) {

                                    if (data == "true") {
                                        $("#showresult_instrument").css("display", "block");
                                        // $("#showresult_instrument").hide();																 
                                        var url = 'https://customeroperationapi.tvscredit.com/InsuranceRenewal/InsurancecopyRenewalDocuments?AgreementNo=' + id //id
                                        $("#url_inss").attr("href", url);

                                    } else {
                                        $("#insss").hide();

                                        // $("#instrumentdetails_docs").hide();
                                    }


                                });
                            $.post("/cc/AjaxCustom/check_soa_permission", {
                                ag_no: id
                            }).done(function(data) {
                                var resp = JSON.parse(data);
                                // console.log(resp);
                                // console.log(resp.ReturnOutput[0].SOA_DOWNLOAD);
                                if (resp.ReturnMessage == "SOADownloadValidation") {
                                    if (resp.ReturnOutput[0].SOA_DOWNLOAD == "N") {
                                        isSoaOk = false;
                                    } else {
                                        isSoaOk = true;
                                    }
                                }
                                // console.log("isok? :"+isSoaOk);
                            }).then(
                                function() {
                                    $.post("/cc/AjaxCustom/rest_api_call_drop", {
                                            ag_no: id,
                                            method_val: '<?php echo $methodval; ?>'
                                        })
                                        .done(function(data) {
                                            var url_data = JSON.parse(data);
                                            // if(url_data.message == ''){
                                            // 	 //console.log(url_data.url_for);
                                            // 	// console.log(url_data.url_ins);
                                            // 	$("#instrumentdetails_docs").css("display", "block");
                                            // 	$("#showresult_instrument").hide();
                                            // 	if(url_data.url_ins !=''){
                                            // 		$("#url_ins").attr("href", url_data.url_ins);
                                            // 	}
                                            // 	if(url_data.url_for != ''){
                                            // 		$("#url_for").attr("href", url_data.url_for);
                                            // 	}else{
                                            // 		$('#forclosure').hide();
                                            // 	}
                                            // 	if(url_data.soa_for !=''){
                                            // 		$("#url_for_soa").attr("href", url_data.soa_for);
                                            // 	}
                                            // 	else{
                                            // 		$("#soa").hide();
                                            // 	}
                                            // }else{
                                            $("#showresult_instrument").css("display", "block");
                                            $("#instrumentdetails_docs").hide();
                                            //	$("#url_ins").attr("href", url_data.url_ins);
                                            if (url_data.url_for != '') {
                                                $("#url_for_n").attr("href", url_data.url_for);
                                            } else {
                                                $('#forclosure_n').hide();
                                            }
                                            if (url_data.soa_for != '') {
                                                // $("#url_for_n_soa").attr("href", url_data.soa_for);
                                            } else {
                                                $("#soa_n").hide();
                                            }
                                            //	 $( "#showresult_instrument" ).html(url_data.message);

                                            // }
                                            $('#idload').css("display", "none");
                                        });
                                });
                        }
                    });
                    const queryString = window.location.href;
                    const agg = queryString.split("_");

                    if (agg) {
                        $('#i_detail').val(agg);
                        $('#i_detail').trigger('change');
                    }
                });
            </script>

        <?php
        } else if ($_REQUEST["filtering_val"] == "mandateStatus") {
            echo "<div class='form-group'><select id='i_detailm'><option value='0'>--Select--</option>";
            foreach ($response as $key => $result) {
                //	if(!empty($userData['agg_no']) && $userData['agg_no'] == $result['Agreement No']){
                //$sel = "selected";
                //$flag = true;
                //}else{
                $sel = '';
                //}	
                echo '<option value=' . $result['Agreement No'] . ' ' . $sel . '>' . $result['Agreement No'] . '</option>';
            }
            echo '</select></div>';
        ?>
            <script type="text/javascript">
                $(document).ready(function() {

                    var show_card = false;
                    var show_card2 = false;
                    // $('#i_detail').trigger('change');
                    $('#i_detailm').change(function() {
                        $('#idload').css("display", "block");

                        var id = $(this).val();
                        if (id != "--Select--") {

                            $.post("/cc/AjaxCustom/rest_api_call_drop", {
                                    ag_no: id,
                                    method_val: 'getMandateStatuses'
                                })
                                .done(function(data) {
                                    var json_response = JSON.parse(data);
                                    // console.log(json_response);
                                    // console.log(json_response[0].Agment_NO);
                                    //       console.log(json_response[0].Blank_mandate);
                                    //       console.log(json_response[0].Noc_mandate);


                                    $('.text1').html("<p><strong style='color:#003c7d;'>Prefilled Mandate:</strong> Please download the Prefilled mandate document.  Attest your signature as per your bank records and send it to our address: TVS Credit Services, 2nd Floor, Bristol Tower, 10 South Phase, Thiruvika Industrial Estate, Guindy Chennai-600 032</p>");
                                    $('.text12').html("<p><a href='https://tvscscrmservice.tvscredit.com/CRMService.svc/Blank_mandate/" + id + "' class='live-cust'  style='display: none;' download><img src='/euf/assets/images/pdficon.png' width='100' height='110'></a><br><strong style='color:#003c7d;'>Blank Mandate:</strong> Please download the blank mandate. Fill the appropriate bank details as required, sign it as per your bank records and send it to our address: TVS Credit Services, 2nd Floor, Bristol Tower, 10 South Phase, Thiruvika Industrial Estate, Guindy Chennai-600 032</p>");
                                    $('.text2').html("");
                                    // var url_to = "https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=TN3000CD0006055&report=NOC_FOR_CDPORTFOLIO.jrxml";//"https://rmsnew.tvscredit.com/rms/Jasper?AGRNO="+id+"&report=NOC_FOR_CDPORTFOLIO.jrxml"; https://tvscscrmservice.tvscredit.com/CRMService.svc/Blank_mandate/TN3000TW00426
                                    //https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=TN3000TW00426&report=NOC_FOR_CDPORTFOLIO.jrxml ;;;https://tvscscrmservice.tvscredit.com/CRMService.svc/GetFilledForm_ECS/TN3000TW00426 earlier -> https://tvscscrmuatservice.tvscredit.com/CRMService.svc/GetFilledForm_ECS
                                    $('#dwnbtn').html("<a href='https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=" + id + "&report=NOC_FOR_CDPORTFOLIO.pdf' class='no-due' id='no-due' target='_blank' download><img src='/euf/assets/images/pdficon.png' width='100' height='110'></a>");
                                    $('#filledbtn').html("<a href='https://tvscscrmservice.tvscredit.com/CRMService.svc/GetFilledForm_ECS/" + id + "' class='req-cust' id='req-cust' target='_blank' download><img src='/euf/assets/images/pdficon.png' width='100' height='110'></a>");
                                    if ((json_response[0].Blank_mandate == "N" && json_response[0].Fill_mandate == "N" && json_response[0].Noc_mandate == "N") || (json_response[0].Blank_mandate == "" && json_response[0].Fill_mandate == "" && json_response[0].Noc_mandate == "") || (json_response[0].Blank_mandate == "" && json_response[0].Fill_mandate == "" && json_response[0].Noc_mandate == "N")) {
                                        $('.not-applicable').html("Selected Loan Account is not live. This option is not applicable.");
                                        $('.not-applicable').show();
                                        $(".card1").hide();
                                        $(".card2").hide();
                                    } else {
                                        $('.not-applicable').hide();
                                        if (json_response[0].Blank_mandate == "Y") {
                                            $('.live-cust').show();
                                            $('.text12').show();
                                            show_card = true;
                                        } else {
                                            $('.live-cust').hide();
                                            $('.text12').hide();
                                        }

                                        if (json_response[0].Fill_mandate == "Y") {
                                            $('.req-cust').show();
                                            $('.text1').show();
                                            show_card = true;
                                        } else {
                                            $('.req-cust').hide();
                                            $('.text1').hide();
                                        }
                                        if (json_response[0].Blank_mandate != "Y" && json_response[0].Fill_mandate != "Y") {
                                            show_card = false;
                                        }
                                        if (json_response[0].Noc_mandate == "Y") {
                                            $('#dwnbtn').show();
                                            show_card2 = true;
                                        } else {
                                            $('#dwnbtn').hide();
                                            show_card2 = false;
                                        }
                                        if (show_card == true) {
                                            $('.card1').show();
                                        } else {
                                            $('.card1').hide();
                                        }
                                        // alert(show_card2 +" and "+ id);
                                        if (show_card2 == true) {
                                            $('.card2').show();
                                        } else {
                                            $('.card2').hide();
                                        }
                                    }
                                });
                        }
                    });
                });
            </script>
            <?
        }

        //curl_close($curl);
        else if ($_REQUEST["filtering_val"] == "mandateLoanStatus") {
            echo "<div class='form-group'><select id='i_detaild'><option value='0'>--Select--</option>";
            foreach ($response as $key => $result) {
                $sel = '';
                echo '<option value=' . $result['ID'] . '_' . $result['Agreement No'] . '>' . $result['Agreement No'] . '</option>';
            }
            echo '</select></div>';

            if ($methodval) {
            ?>

                <script type="text/javascript">
                    $(document).ready(function() {


                        // $('#i_detail').trigger('change');
                        $('#i_detaild').change(function() {
                            $('#isload').css("display", "block");

                            var id = $(this).val();
                            var agg = id.split('_');
                            id = agg[1];
                            if ($(this).val() != '0') {

                                $.post("/cc/AjaxCustom/rest_api_call_drop", {
                                        ag_no: id,
                                        method_val: 'getMandateLoanStatuses'
                                    })
                                    .done(function(data) {
                                        var json_response = JSON.parse(data);
                                        // console.log(json_response);
                                        if (json_response.ReturnOutput != null) {
                                            var l = json_response.ReturnOutput.length;
                                            k = l;
                                            l = l - 1;
                                            document.getElementById('final_status').value = json_response.ReturnOutput[l].FinalStatus;
                                            for (var u = 0; u < k; u++) {
                                                if (json_response.ReturnOutput[u].AgreementNo == id) {
                                                    $('#status-div').html("<p id='statusreport'> Status: <em id='statusdata'>" + json_response.ReturnOutput[u].Status + "</em></p>");
                                                }

                                            }

                                            $("#lan").val(id);
                                            $('#Mandatesubmitbtn').show();

                                        } else {
                                            $('#status-div').html("<p id='statusreport'> No record found</em></p>");
                                        }
                                        $('#isload').css("display", "none");

                                        //show the response on the html body.


                                    });
                            }



                        });
                    });
                </script>
        <? }
        }
    }    //akash changes



    /*
* Retrive Pie Chart Data from Rightnow
*/
    function getPieData()
    {
        $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incidents);
        $report_id = $msg->Value;
        //$c_id =3;
        $c_id = $this->session->getProfileData("c_id");
        //$report_id = '100051';
        //$idreport = $_REQUEST['id_of_report'];
        if ($report_id > 0) {
            $filter = array('Contact_Id' => $c_id);
            $report_result = $this->model('custom/Login')->report_result($report_id, $filter);
            //print_r($report_result); exit;
            $inc_count = count($report_result);
            $closed = 0;
            $loggedin = 0;
            $new = $pending = 0;
            $response_awaited = 0;
            //for($i = 0; $i < $inc_count; $i++) {
            foreach ($report_result as $key => $response) {
                if ($response['Status'] == "New") {
                    ++$new;
                }
                if ($response['Status'] == "Closed") {
                    ++$closed;
                } else if ($response['Status'] == "Logged in") {
                    ++$loggedin;
                } else if ($response['Status'] == "Pending with initiator / internal team") {
                    ++$pending;
                } else if ($response['Status'] == "Response Awaited") {
                    ++$response_awaited;
                }
            }
            $pie_chart = array(array("Status", "Values"), array("New", $new), array("Closed", $closed), array("Logged in", $loggedin), array("Pending with initiator / internal team", $pending), array("Response Awaited", $response_awaited));
            //json_encode($pie_chart)
        }
        print_r(json_encode($pie_chart));
    }

    // Create Incident Pie Chart

    function getPieInc()
    {
        $inc_status = $_REQUEST['status'];
        $contact_id = $_REQUEST['c_id'];
        $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incidents);
        $report_id = $msg->Value;
        //$c_id =3;
        $c_id = $this->session->getProfileData("c_id");
        //$report_id = '100051';
        //$idreport = $_REQUEST['id_of_report'];
        if ($report_id > 0) {
            $filter = array('Contact_Id' => $c_id);
            $report_result = $this->model('custom/Login')->report_result($report_id, $filter);
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
            foreach ($report_result as $key => $response) {
                //print_r($response);
                if ($response['Status'] == $inc_status) {
                    $dataArray[] = $response;
                    //$dataArray[$key] = json_encode($response);

                }
            }
            //$jsonArray['data']  = $dataArray;
            print_r(json_encode($dataArray));
        }
    }

    //create incident	
    function create_inc()
    {
        $CI = &get_instance();
        $CI->load->helper('report');

        $contact_id = $CI->session->getProfileData("c_id");


        try {
            $incident = new RNCPHP\Incident();

            $incident->Subject = "Call me back";

            //$incident->Product =  RNCPHP\ServiceProduct::fetch($_POST['formData']['Incident.Product']);

            $incident->Category = RNCPHP\ServiceCategory::fetch(1330);

            $incident->Threads = new RNCPHP\ThreadArray();
            $incident->Threads[0] = new RNCPHP\Thread();
            $incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
            $incident->Threads[0]->EntryType->ID = 4; // Used the ID here. See the Thread object for definition
            $incident->Threads[0]->Text = $_POST['assistance'] . "\n\r Call on " . $_POST['contact_number'];

            //$incident->Language = new RNCPHP\NamedIDOptList();
            //$incident->Language->ID =1;

            //$incident->Mailbox = RNCPHP\Mailbox::fetch(30);

            //	$incident->Organization = RNCPHP\Organization::fetch(8);

            $incident->PrimaryContact = RNCPHP\Contact::fetch($contact_id); //Required field to create an incident through connect PHP

            $incident->Queue = new RNCPHP\NamedIDLabel();
            $incident->Queue->ID = 2;

            //$incident->Severity = new RNCPHP\NamedIDOptList();
            //$incident->Severity->LookupName  = 1;

            $incident->StatusWithType = new RNCPHP\StatusWithType();
            $incident->StatusWithType->Status = new RNCPHP\NamedIDOptList();
            $incident->StatusWithType->Status->ID = 1;

            //\RightNow\Connect\v1_3\CO\City::fetch( "$city" );
            if (strlen($_POST['formData']['agreementno'])) {
                list($loan_id, $agg_no) = explode("_", $_POST['formData']['agreementno']);
                $incident->CustomFields->CO->Loan = \RightNow\Connect\v1_3\CO\Loan::fetch($loan_id);
            }
            // $incident->CustomFields->c->call_date_time = strtotime($_POST['datetime_speak']);
            $incident->save();
            //echo "Incident Created";
            $responseArray[] = array('value_id' => $incident->ID, 'value_refno' => $incident->ReferenceNumber);
            //$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);
            print_r(json_encode($responseArray));
        } catch (Exception $err) {
            echo json_encode($err->getMessage());
        }
    }

    /*
		* Function to Calculate EMI
		*/
    function emi_calculate_soap()
    {
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

        $response = soap_emi_call("EMICalculator", $arrparams);
        $emi_data = count($response['EMICalculatorResult']['EMI_Calculator_Entity']);
        //print_r($emi_data);
        if ($emi_data == '7') {
            echo "<table style='border:1px solid black'><tr><th style='border:1px solid black;text-align: center;'>DOWN PAYMENT</th><th style='border:1px solid black;text-align: center;'>LOAN AMOUNT</th><th style='border:1px solid black;text-align: center;'>EMI</th><th style='border:1px solid black;text-align: center;'>TENOR</th></tr>";
            //for($i = 0; $i < $emi_data; $i++) {
            echo "<tr><td align=center style='border:1px solid black'>" . $response['EMICalculatorResult']['EMI_Calculator_Entity']['objEmiOutPutCalculator']['DOWNPAYMENT'] . "</td><td align=center style='border:1px solid black'>" . $response['EMICalculatorResult']['EMI_Calculator_Entity']['objEmiOutPutCalculator']['LOANAMOUNT'] . "</td><td align=center style='border:1px solid black'>" . $response['EMICalculatorResult']['EMI_Calculator_Entity']['objEmiOutPutCalculator']['EMI'] . "</td><td align=center style='border:1px solid black'>" . $response['EMICalculatorResult']['EMI_Calculator_Entity']['objEmiOutPutCalculator']['TENOR'] . "</td></tr>";

            //}
            echo "</table>";
        } else if ($emi_data == '3') {
            echo "<table style='border:1px solid black'><tr><th style='border:1px solid black;text-align: center;'>DOWN PAYMENT</th><th style='border:1px solid black;text-align: center;'>LOAN AMOUNT</th><th style='border:1px solid black;text-align: center;'>EMI</th><th style='border:1px solid black;text-align: center;'>TENOR</th></tr>";
            for ($i = 0; $i < $emi_data; $i++) {
                $emi_count2 = count($response['EMICalculatorResult']['EMI_Calculator_Entity'][$i]);

                //for($j = 0; $j < $emi_count2; $j++) {
                echo "<tr><td align=center style='border:1px solid black'>" . $response['EMICalculatorResult']['EMI_Calculator_Entity'][$i]['objEmiOutPutCalculator']['DOWNPAYMENT'] . "</td><td align=center style='border:1px solid black'>" . $response['EMICalculatorResult']['EMI_Calculator_Entity'][$i]['objEmiOutPutCalculator']['LOANAMOUNT'] . "</td><td align=center style='border:1px solid black'>" . $response['EMICalculatorResult']['EMI_Calculator_Entity'][$i]['objEmiOutPutCalculator']['EMI'] . "</td><td align=center style='border:1px solid black'>" . $response['EMICalculatorResult']['EMI_Calculator_Entity'][$i]['objEmiOutPutCalculator']['TENOR'] . "</td></tr>";
                //}

            }
            echo "</table>";
        }
    }
    //end function


    // Function to Create Contact
    function create_contact($param_data)
    {
        try {
            $title = $param_data['title'];
            $first_name = $param_data['first_name'];
            $last_name = $param_data['last_name'];
            $mobile = $param_data['mobile'];
            $date_of_birth = $param_data['date_of_birth'];
            $email = $param_data['email'];
            $address = $param_data['address'];
            $city = $param_data['city'];
            $state = $param_data['state'];
            $Pincode = $param_data['Pincode'];
            $country = $param_data['country'];

            $contact = new \RightNow\Connect\v1_3\Contact();
            $contact->Name = new \RightNow\Connect\v1_3\PersonName();
            if (!empty($title)) {
                $contact->title = $title;
            }
            if (!empty($first_name)) {
                $contact->Name->First = ucwords($first_name);
            }
            if (!empty($last_name)) {
                $contact->Name->Last = ucwords($last_name);
            }
            if (!empty($email)) {
                //add email addresses
                $contact->Emails = new \RightNow\Connect\v1_3\EmailArray();
                $contact->Emails[0] = new \RightNow\Connect\v1_3\Email();
                $contact->Emails[0]->AddressType = new \RightNow\Connect\v1_3\NamedIDOptList();
                $contact->Emails[0]->AddressType->LookupName = "Email - Primary";
                $contact->Emails[0]->Address = strtolower($email);
            } else {
                $contact->Emails = new \RightNow\Connect\v1_3\EmailArray();
                $contact->Emails[0] = new \RightNow\Connect\v1_3\Email();
                $contact->Emails[0]->AddressType = new \RightNow\Connect\v1_3\NamedIDOptList();
                $contact->Emails[0]->AddressType->LookupName = "Email - Primary";
                $contact->Emails[0]->Address = strtolower($mobile . '@invalid.mail.com');
                $contact->Emails[0]->Invalid = true;
            }
            $contact->NewPassword = ucwords(trim($first_name)) . "@123";
            $contact->CustomFields->c->custom_password = ucwords(trim($first_name)) . "@123";

            if (!empty($mobile)) {
                $i = 0;
                $contact->Phones[$i] = new \RightNow\Connect\v1_3\Phone();
                $contact->Phones[$i]->PhoneType = new \RightNow\Connect\v1_3\NamedIDOptList();
                $contact->Phones[$i]->PhoneType->LookupName = 'Mobile Phone';
                $contact->Phones[$i]->Number = $mobile;
                $i++;
            }
            if (!empty($date_of_birth)) {
                $contact->CustomFields->c->dob = $date_of_birth;
            }
            $contact->Address = new \RightNow\Connect\v1_3\Address();
            if (!empty($address)) {
                $contact->Address->Street = $address;
            }
            if (!empty($city)) {
                $contact->Address->City = $city;
                $contact->CustomFields->CO->City =  \RightNow\Connect\v1_3\CO\City::fetch("$city");
            }
            if (!empty($state)) {
                //	$contact->Address->StateOrProvince = new \RightNow\Connect\v1_3\NamedIDLabel();
                //	$contact->Address->StateOrProvince->LookupName = "$state";
            }
            if (!empty($country)) {
                //	$contact->Address->Country = \RightNow\Connect\v1_3\Country::fetch( "$country" );
            }
            if (!empty($Pincode)) {
                $contact->Address->PostalCode = $Pincode;
            }

            $contact->ContactType = new \RightNow\Connect\v1_3\NamedIDLabel();
            $contact->ContactType->LookupName = "Customer";
            $contact->Login = "LOGIN_" . date("Y-m-d-h-i-s");
            $contact->CustomFields->c->custom_password = "123456";
            $contact->save();
            $contact_id = $contact->ID;
            return $contact_id;
        } catch (Exception $e) {
            echo "<br>Error: " . $e->getMessage() . " | Code: " . $e->getCode() . "| Line: " . $e->getLine();
        }
    }

    /*
* Function to update Contact
*/
    function update_contact($param_data, $contact_id)
    {
        try {
            if (strlen($contact_id) and $contact_id > 0) {
                $title = $param_data['title'];
                $first_name = $param_data['first_name'];
                $last_name = $param_data['last_name'];
                $date_of_birth = $param_data['date_of_birth'];
                $address = $param_data['address'];
                $city = $param_data['city'];
                $state = $param_data['state'];
                $Pincode = $param_data['Pincode'];
                $country = $param_data['country'];
                $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
                if (isset($title) and strlen($title)) {
                    $contact->title = $title;
                }
                if (!empty($first_name)) {
                    $contact->Name->First = ucwords($first_name);
                }
                if (!empty($last_name)) {
                    $contact->Name->Last = ucwords($last_name);
                }
                if (!empty($date_of_birth)) {
                    $contact->CustomFields->c->dob = $date_of_birth;
                }

                if (!empty($address)) {
                    $contact->Address->Street = $address;
                }
                if (!empty($city)) {
                    $contact->Address->City = $city;
                    $contact->CustomFields->CO->City =  \RightNow\Connect\v1_3\CO\City::fetch("$city");
                }
                if (!empty($state)) {
                    //	$contact->Address->StateOrProvince->LookupName ="$state";
                }
                if (!empty($country)) {
                    //$contact->Address->Country = \RightNow\Connect\v1_3\Country::fetch( "$country" );
                }
                if (!empty($Pincode)) {
                    $contact->Address->PostalCode = $Pincode;
                }

                $contact->ContactType = new \RightNow\Connect\v1_3\NamedIDLabel();
                $contact->ContactType->LookupName = "Customer";

                $contact->save();
            }
        } catch (Exception $e) {
            echo "<br>Error: " . $e->getMessage() . " | Code: " . $e->getCode() . "| Line: " . $e->getLine();
        }
    }

    /*
* Function to create Opportunity
*/
    function create_opportunity($param_data, $contact_id)
    {
        try {
            $first_name = $param_data['first_name'];
            $last_name = $param_data['last_name'];
            $mobile = $param_data['mobile'];
            $loan_type = $param_data['loan_type'];
            $opp = new \RightNow\Connect\v1_3\Opportunity();
            if (!empty($mobile) and !empty($first_name)) {
                $oppname = "$mobile: $first_name";
                if (!empty($last_name)) {
                    $oppname .= " - $last_name";
                }
                $opp->Name = $oppname;
            }
            if (!empty($loan_type)) {
                //$menu = new \RightNow\Connect\v1_3\NamedIDLabel();
                //$menu->LookupName="$loan_type";
                //$menu->ID = "$loan_type";
                //$opp->CustomFields->c->loan_type = $menu;
                $opp->CustomFields->CO->Product = \RightNow\Connect\v1_3\CO\Product::fetch($loan_type);
            }
            $opp->PrimaryContact->Contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
            /*$opp->StageWithStrategy->Stage= new RightNow\Connect\v1_3\NamedIDLabel();
			$opp->StatusWithType->Status->ID='Active';*/
            $opp->save();
            $opp_id = $opp->ID;
            return $opp_id;
        } catch (Exception $e) {
            echo "<br>Error: " . $e->getMessage() . " | Code: " . $e->getCode() . "| Line: " . $e->getLine();
        }
    }

    /*
* Function to Create New Lead
*/
    function createLead()
    {

        //print_r($_POST); die;
        if ($_POST['Action'] == 'Create_New_Lead') {
            $postdata = $_POST;
            $email = $postdata['email'];
            $mobile = $postdata['mobile'];
            $action = $postdata['clickaction'];
            $loan_type = $postdata['loan_type'];

            //	if ( isset( $mobile )and strlen( $mobile ) == 10 ) {
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
                'CityCode' => $postdata['city'],
                'Pincode' => $postdata['Pincode'],
                'country' => $postdata['country'],
                'ACC1' => $postdata['ACC1'],
                'Experience' => $postdata['Experience'],
                'FinalisedCar' => $postdata['FinalisedCar'],
                'ChannelCode' => $postdata['ChannelCode'],
                'ProductCode' => $postdata['loan_type'],
                'loan_type' => $postdata['loan_type'],
                'AgencyCode' => $postdata['AgencyCode'],

            );
            //	print_r($params); die;
            //$report_id=Config::getMessage(CUSTOM_MSG_CONTACT_SEARCH_ON_MOBILE_N_EMAIL);
            $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CONTACT_SEARCH_ON_MOBILE_N_EMAIL);
            $report_id = $msg->Value;
            if ($report_id > 0) {
                //print_r(array( 'Mobile' => $mobile ));
                $contact_result = report_result($report_id, array('Mobile' => $mobile));
                if (count($contact_result) == 0) {
                    /*Code to create new Contact starts here*/
                    $contact_id = $this->create_contact($params);
                    /*Code to create new Contact ends here*/
                    if (isset($contact_id) and $contact_id > 0) {
                        $opp_id = $this->create_opportunity($params, $contact_id);
                    }
                } else {
                    $contact_id = $contact_result[0]['Contact ID'];


                    /*Code to update Contact starts here*/
                    if (isset($contact_id) and $contact_id > 0) {
                        $this->update_contact($params, $contact_id);
                        //$report_id=Config::getMessage(CUSTOM_MSG_CHECK_OPP_EXISTS_IN_LAST_24_HRS);
                        $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_CHECK_OPP_EXISTS_IN_LAST_24_HRS);
                        $report_id = $msg->Value;
                        if ($report_id > 0) {
                            //print_r(array( 'Contact Id' => $contact_id, 'Loan Type' => $loan_type ));
                            $opp_result = report_result($report_id, array('Contact Id' => $contact_id, 'Loan Type' => $loan_type));

                            if (count($opp_result) == 0) {
                                $opp_id = $this->create_opportunity($params, $contact_id);
                            } else {
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
                $LMS_result = soap_call('InsertLMSData', $params);
                //print_r(json_encode($LMS_result));
                header("Location: /app/new_lead_thanks/ref_id/" . $LMS_result['InsertLMSDataResult']);
                exit;
            } else {
                header("Location: /app/newlead");
                exit;
            }
        } else {
            header("Location: /app/newlead");
            exit;
        }
    } // end of function

    /*
*
* Function for Dealer Login
*
*/
    function doDealerLogin()
    {

        if (!$this->checkForValidFormToken()) {
            $this->_renderJSON(array('message' => Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG), 'showLink' => false));
            return;
        }

        $userID = $this->input->post('login');
        $password = $this->input->post('password');
        $custType = $this->input->post('custType');
        $sessionID = $this->session->getSessionData('sessionID');
        $widgetID  = $this->input->post('w_id');
        $url = $this->input->post('url');
        $result = $this->model('custom/Login')->doDealerLogin($userID, $password, $custType, $sessionID, $widgetID, $url)->result;
        $this->_renderJSON($result);
    }

    // Function for Insert MGM Referral
    function insertMGMReferral()
    {

        $params = array();

        $params = array(
            'strLoginAgrmnt' => $_POST['strLoginAgrmnt'],
            'refProduct'    => $_POST['refProduct'],
            'refName' => $_POST['refName'],
            'RefMobile' => $_POST['RefMobile'],
            'loginAgrMobile' => $_POST['LoginAgrMobile']
        );
        $referral_result = soap_emi_call('InsertMyReferralDetails', $params);

        print_r($referral_result['InsertMyReferralDetailsResult']);
    }

    /*
	*
	*
	*/
    function getMGMReferralDetails()
    {
        //	$params = array();

        //print_r($_POST);
        $params = array(
            'AgreementNo' => $_POST['form'][0]['value']
        );
        //	print_r($params );
        $response = array();
        $referral_result = soap_emi_call('getMGMReferredDetails', $params);
        //print_r($referral_result);
        if (!empty($referral_result['getMGMReferredDetailsResult']['MGM_Referral_Data_Entity'])) {
            $i = 0;
            //print_r($referral_result['getMGMReferredDetailsResult']['MGM_Referral_Data_Entity']);
            foreach ($referral_result['getMGMReferredDetailsResult']['MGM_Referral_Data_Entity'] as $responseResult) {
                if (isset($responseResult['objMGMRefData']) && !empty($responseResult['objMGMRefData'])) {
                    $response[] = $responseResult['objMGMRefData'];
                } else {
                    if (!empty($responseResult))
                        $response[] = $responseResult;
                    //}
                }
            }
            //print_r($response);
            $responseData = ($response);
        } else {
            $responseData = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
        }
        print_r(json_encode($responseData));
    }

    /*
	*  Raise a Query
	*/
    function raiseQueryRequest()
    {

        //print_r($_POST); die;
        $contactId = $_POST['co_id'];
        //$amountReq = $_POST['maximum_amount'];
        //$userData=$this->session->getSessionData("userProfile");
        if (empty($contactId)) {
            $param['email'] = $_POST['Contact_Emails_PRIMARY_Address'];
            $param['first_name'] = $_POST['Contact_Name_First'];
            $param['last_name'] = $_POST['Contact_Name_Last'];
            //$param['last_name'] = $_POST['Contact.Name.Last'];
            //$param['mobile'] = 
            $contactId = $this->create_contact($param);
        }
        try {
            $incident = new RNCPHP\Incident();

            $incident->Subject = $_POST['Incident_Subject'];

            if (!empty($_POST['formData']['Incident.Product'])) {
                $incident->Product =  RNCPHP\ServiceProduct::fetch($_POST['formData']['Incident.Product']);
            }
            if (!empty($_POST['formData']['Incident.Category'])) {
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

            $incident->PrimaryContact = RNCPHP\Contact::fetch($contactId); //Required field to create an incident through connect PHP

            $incident->Queue = new RNCPHP\NamedIDLabel();
            $incident->Queue->ID = 2;

            //$incident->Severity = new RNCPHP\NamedIDOptList();
            //$incident->Severity->LookupName  = 1;

            $incident->StatusWithType               = new RNCPHP\StatusWithType();
            $incident->StatusWithType->Status       = new RNCPHP\NamedIDOptList();
            $incident->StatusWithType->Status->ID   = 1;

            //\RightNow\Connect\v1_3\CO\City::fetch( "$city" );
            if (strlen($_POST['formData']['Incident.CustomFields.CO.Loan.ID'])) {
                list($loan_id, $agg_no) = explode("_", $_POST['formData']['Incident.CustomFields.CO.Loan.ID']);
                $incident->CustomFields->CO->Loan = \RightNow\Connect\v1_3\CO\Loan::fetch($loan_id);
            }

            if (!empty($_POST['Incident_CustomFields_c_incident_email_id'])) {
                $incident->CustomFields->c->incident_email_id = $_POST['Incident_CustomFields_c_incident_email_id'];
                $incident->CustomFields->c->use_existing_details = 0;
            }
            if (!empty($_POST['Incident_CustomFields_c_incident_mobile_number'])) {
                $incident->CustomFields->c->incident_mobile_number = $_POST['Incident_CustomFields_c_incident_mobile_number'];
                $incident->CustomFields->c->use_existing_details = 0;
            }
            $incident->save();
            //echo "Incident Created";
            $responseArray[] = array('value_id' => $incident->ID, 'value_refno' => $incident->ReferenceNumber);
            //$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);
            print_r(json_encode($responseArray));
        } catch (Exception $err) {
            echo json_encode($err->getMessage());
        }
    }

    /*
Get product based on Agreement Number

*/
    function getProduct()
    {

        $msg = \RightNow\Connect\v1_3\MessageBase::fetch(1000037);
        $agreement_no = $_POST['agg_no'];
        $report_id = $msg->Value;
        list($loan_id, $agg_no) = explode("_", $agreement_no);
        $filter = array('Agreement_No' => $agg_no);
        $report_result = report_result($report_id, $filter);
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
    function doEmployeeLogin()
    {
        //print_r($_POST);
        if (!$this->checkForValidFormToken()) {
            $this->_renderJSON(array('message' => Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG), 'showLink' => false));
            return;
        }
        $userID = $this->input->post('login');
        $password = $this->input->post('password');
        $custType = $this->input->post('custType');
        $sessionID = $this->session->getSessionData('sessionID');
        $widgetID  = $this->input->post('w_id');
        $url = $this->input->post('url');
        $result = $this->model('custom/Login')->doEmployeeLogin($userID, $password, $custType, $sessionID, $widgetID, $url)->result;
        $this->_renderJSON($result);
    }

    /*
	*[{"Dealer Code":"2438","Latitude":"28.604264","Longitude":"77.061303","Distance":12.108005845147,"Dealer Email":"dynamictvs@gmail.com","First Name":"DYNAMIC","Last Name":"MOTORS PVT LTD"},{"Dealer Code":"2569","Latitude":"28.579466","Longitude":"76.945983","Distance":16.467982579546,"Dealer Email":"vardhman.traders@gmail.com","First Name":"VARDHMAN","Last Name":"TRADERS"},{"Dealer Code":"1979","Latitude":"28.613939","Longitude":"77.209021","Distance":17.616997024229,"Dealer Email":"sk_tvswest@yahoo.com","First Name":"SK","Last Name":"TRADERS"},{"Dealer Code":"1015","Latitude":"28.62777","Longitude":"77.284787","Distance":24.171604552973,"Dealer Email":"cv_kapilkumar@rediffmail.com","First Name":"GS","Last Name":"MOTORS"},{"Dealer Code":"1980","Latitude":"28.672311","Longitude":"77.238083","Distance":24.416942067094,"Dealer Email":"rajpootmotorstvs@gmail.com","First Name":"RAJPOOT","Last Name":"MOTORS"}]

	*/
    function getDealerStores()
    {
        $lat = $_POST['lat'];
        $long = $_POST['lng'];
        $url = "https://tvscs.custhelp.com/cgi-bin/tvscs.cfg/php/custom/nearest_dealer.php?latitude=" . $lat . "&longitude=" . $long . "&range=25";
        load_curl();
        $response = json_decode($this->nusoap_lib->getDealerData($url));
        $i = 0;
        //print_r($response);
        foreach ($response as $key => $results) {

            $resultData = (array)$results;
            // We add the store to the result array.
            $nearbyStores[$i]['id'] = $resultData['Dealer Code'];
            $nearbyStores[$i]['name'] = ucfirst($resultData['First Name'] . ' ' . $resultData['Last Name']);
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
    function getNewjencourierdetails()
    {
        //	$params = array();

        //print_r($_POST);
        $params = array(
            'AgreementNo' => $_POST['form'][0]['value']
        );
        //	print_r($params );
        $response = array();
        $referral_result = soap_emi_call('getNewGenCourierOutWardData', $params);
        //print_r($referral_result);
        if (!empty($referral_result['getNewGenCourierOutWardDataResult']['NewGEN_CourierOutWard_Data_Entity'])) {
            $i = 0;
            //print_r($referral_result['getMGMReferredDetailsResult']['MGM_Referral_Data_Entity']);
            foreach ($referral_result['getNewGenCourierOutWardDataResult']['NewGEN_CourierOutWard_Data_Entity'] as $responseResult) {
                if (isset($responseResult['objCourierOutWrdData']) && !empty($responseResult['objCourierOutWrdData'])) {
                    $response[] = $responseResult['objCourierOutWrdData'];
                } else {
                    if (!empty($responseResult))
                        $response[] = $responseResult;
                    //}
                }
            }
            //print_r($response);
            $responseData = ($response);
        } else {
            $responseData = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
        }
        print_r(json_encode($responseData));
    }

    /* function for ForClosureLetter */
    private function checkForClosureLetter($agreement_no)
    {
        $ch = curl_init("https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getLoanStatusandOtherDetails,agreementNo:" . $_REQUEST['ag_no'] . "}");
        // $agreement_no = 'TN3000TW0037843';
        // $ch = curl_init("https://tvscscrmuat.tvscredit.com:8180/tvscrmlosws/rest/GetTVSDetails/giveOutput?hidInputObj={methodName:getLoanStatusandOtherDetails,agreementNo:".$agreement_no."}");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //		 curl_setopt($ch,CURLOPT_POSTFIELDS,$data_encoded);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'token_id: ' . $apitoken, "content-length: 0"));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $data_decode = json_decode($result);
        if (!empty($data_decode)) {
            //print_r( $data_decode); exit;

            if (strtotime(str_replace("/", "-", $data_decode[0]->LAST_EMI_DATE))  > strtotime("now")) {
                $flag_show = true;
            } else {
                return false;
            }
            if (!empty($data_decode[0]->LOAN_STATUS) && strtoupper($data_decode[0]->LOAN_STATUS) == "LIVE") {
                $flag_show = true;
            } else {
                return false;
            }
            //CA
            if (strpos(strtoupper($agreement_no), "CA") === false) {
                $flag_show = true;
            } else {
                return false;
            }
            return $flag_show;
        } else {
            return false;
        }
        //if()
    }


    function makepayment()
    {
        $idreport = $_POST['id_of_report'];
        $contact_id = $this->session->getProfileData("c_id");
        $filter = array('ContactID' => $contact_id);
        $response = report_result($idreport, $filter);
        // if($_REQUEST['filtering_val'] == 'initialloan') {
        echo "<div class='form-group'><select id='i_loan'><option value='0'>--Select--</option>";
        //for($i = 0; $i < $agg_count; $i++ ) {
        foreach ($response as $key => $result) {
            //	if(!empty($userData['agg_no']) && $userData['agg_no'] == $result['Agreement No']){
            //			$sel = "selected";
            //			$flag = true;
            //	}else{
            $sel = '';
            //	}	
            echo '<option value=' . $result['Agreement No'] . ' ' . $sel . '>' . $result['Agreement No'] . '</option>';
        }
        echo '</select></div>';
        ?>
        <script type="text/javascript">
            var AgreementNo = null;
            $(document).ready(function() {
                $('#i_loan').trigger('change'); //This event will fire the change event. 
                $('#i_loan').change(function() {

                    if ($(this).val() != '0') {
                        $('#iload').css("display", "block");
                        var d = $(this).val();
                        $.post("/cc/AjaxCustom/makepaymentapi", {
                                ag_no: d
                            })
                            .done(function(data) {
                                $('#urldata').removeClass('hidden');
                                $('#urldata2').removeClass('hidden');
                                $('#urldata').prop('disabled', false);
                                $('#urldata2').prop('disabled', false);
                                //console.log(JSON.parse(data))
                                // $( "#showresult" ).html(data);
                                dataa = JSON.parse(data);
                                var dd = dataa;
                                dataa = dataa.ReturnObject;
                                if (dd.ReturnMessage == "SUCCESS") {
                                    $('#main_block_div').removeClass('hidden')
                                    $('#-status-Overdue').addClass(' in');

                                    document.getElementById('-status-Overdue').style.height = "";
                                    // var AgreementNo;
                                    // PaymentID = dataa.PaymentID;
                                    AgreementNo = dataa.AgreementNo;

                                    $('#nodatfound').addClass('hidden');
                                    //                        

                                    document.getElementById('make21').innerHTML = "";
                                    document.getElementById('make1').innerHTML = "";
                                    for (var z = 0; z < dataa.ChargeLists.length; z++) {
                                        if (dataa.ChargeLists[z].ChargeCode != "OVERDUE") {
                                            //console.log(dataa.ChargeLists[z]);
                                            $('#make21').removeClass('hidden');
                                            $('#other-due-accord').removeClass('hidden');


                                            document.getElementById('make21').innerHTML += '<tr><th>' + dataa.ChargeLists[z].ChargeName + '</th><td>' + dataa.ChargeLists[z].ChargeAmount + '</td></tr>'
                                        } else {

                                            //console.log(dataa.ChargeLists[z]);
                                            if (dataa.ChargeLists[z].Emisplit) {
                                                $('#make1').removeClass('hidden');

                                                for (var j = 0; j < dataa.ChargeLists[z].Emisplit.length; j++) {
                                                    if (dataa.ChargeLists[z].Emisplit[j].SplitupAmount != 0) {
                                                        $('#Overdue-due-accord').removeClass('hidden');

                                                        document.getElementById('make1').innerHTML += '<tr><th>' + dataa.ChargeLists[z].Emisplit[j].SplitupName + '</th><td>' + dataa.ChargeLists[z].Emisplit[j].SplitupAmount + '</td></tr>'
                                                    }
                                                    //console.log(j, dataa.ChargeLists[z].Emisplit.length);

                                                    if (j == (dataa.ChargeLists[z].Emisplit.length) - 1) {
                                                        document.getElementById('make1').innerHTML += '<tr><th class="boldy">Total Overdue</th><td class="boldy">' + dataa.ChargeLists[z].ChargeAmount + '</td></tr>'
                                                    }

                                                }
                                            }

                                        }
                                    }


                                } else {


                                    $('#nodatfound').removeClass('hidden');
                                    $('#iload').css("display", "none");
                                    $('#main_block_div').addClass('hidden')
                                    // $('#other-due-accord').addClass('hidden')


                                }

                                $('#iload').css("display", "none");

                            });
                    }
                });


                $("#urldata").click(function(event) {
                    event.preventDefault();
                    $('#urldata').prop('disabled', true);
                    $.post("/cc/AjaxCustom/makepaymentapi_button", {
                            agg: AgreementNo,
                            AdChargeFlg: "N"
                        })
                        .done(function(data) {
                            //console.log(JSON.parse(data));
                            var data = JSON.parse(data);

                            if (data.ReturnMessage == "SUCCESS") {
                                var url_data = data.ReturnURL;
                                //console.log("url_data1", url_data)

                                // document.getElementById('urldata').href = url_data;
                                // $('#make_button').removeClass('hidden');
                                // $("#urldata").click(function(){
                                // alert("The paragraph was clicked.");
                                $('#urldata').addClass('urldata'); // 



                                // });

                                window.open(url_data, '_blank');


                            }
                        });
                    // alert( "Handler for .click() called." );
                });
                $("#urldata2").click(function(event) {
                    event.preventDefault()
                    $('#urldata2').prop('disabled', true);

                    $.post("/cc/AjaxCustom/makepaymentapi_button", {
                            agg: AgreementNo,
                            AdChargeFlg: "Y"
                        })
                        .done(function(data) {
                            //console.log(JSON.parse(data));
                            var data = JSON.parse(data);

                            if (data.ReturnMessage == "SUCCESS") {
                                var url_data2 = data.ReturnURL;
                                //console.log("url_data", url_data2)

                                //document.getElementById('urldata2').href = url_data2;
                                // $('#urldata2').removeClass('hidden');
                                // $('#make_button').removeClass('hidden');
                                // $("#urldata2").click(function(){
                                // alert("The paragraph was clicked.");
                                $('#urldata2').addClass('urldata');

                                // });
                                window.open(url_data2, '_blank');


                            }
                        });
                });
            });
        </script>

        <?php
        // }
    }



    function makepaymentapi_button()
    {
        $paymentid = $_POST['paymentid'];
        $CTP = "CTP";
        $AdChargeFlg = $_POST['AdChargeFlg'];
        $AgreementNumber = $_POST['agg'];


        load_curl();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://payment.tvscredit.com/Customer/FetchCustomer',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // "{\"year\":\"$yearCode\",\"AgencyCode\":\"$agencyCode\"}",
            CURLOPT_POSTFIELDS => '{"AdChargeFlg": "' . $AdChargeFlg . '","AgreementNumber": "' . $AgreementNumber . '","ChannelCode": "CTP"}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    function makepaymentapi()
    {
        $agg = $_POST['ag_no'];
        load_curl();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://payment.tvscredit.com/Customer/FetchChargeWithSplit',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST', //btn 1 N btn 2 y
            CURLOPT_POSTFIELDS => '{
			    "AdChargeFlg": "Y",
			    "AgreementNumber": "' . $agg . '",
			    "ChannelCode": "CTP",
			    "ChargeCode": null,
			    "PaymentID": null,
			    "RegistrationNumber": null
			       }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        ///ihihi




    }








    ////////////////////////MSME Section

    public function doOTPSendEmail()
    {
        //AbuseDetection::check();
        if (!$this->checkForValidFormToken()) {
            $this->_renderJSON(array('message' => Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG), 'showLink' => false));
            return;
        }
        $email = $this->input->post('login');
        $sessionID = $this->session->getSessionData('sessionID');
        $widgetID  = $this->input->post('w_id');
        $url = $this->input->post('url');
        $result = $this->model('custom/Login')->sendOTPEmail($email, $sessionID, $widgetID, $url)->result;
        $this->_renderJSON($result);
    }

    function doMSMELogin()
    {
        //print_r($_POST);
        if (!$this->checkForValidFormToken()) {
            $this->_renderJSON(array('message' => Config::getMessage(ERROR_REQUEST_ACTION_COMPLETED_MSG), 'showLink' => false));
            return;
        }
        $userID = $this->input->post('login');
        $password = $this->input->post('password');
        $custType = $this->input->post('custType');
        $sessionID = $this->session->getSessionData('sessionID');
        $widgetID  = $this->input->post('w_id');
        $url = $this->input->post('url');
        $result = $this->model('custom/Login')->doMSMELogin($userID, $password, $custType, $sessionID, $widgetID, $url)->result;
        $this->_renderJSON($result);
    }
    function ecs_msme()
    {
        load_curl();
        $curl = curl_init();
        $ag_no = $_POST['agreement_no'];
        curl_setopt_array($curl, array(
            // CURLOPT_URL => 'https://msmeportaluat.tvscredit.com/MSMEServices/getECSInstructionsDetails?agreementNumber=TN7001MS0000001',
            CURLOPT_URL => 'https://msmeportal.tvscredit.com/MSMEServices/getECSInstructionsDetails?agreementNumber=' . $ag_no,

            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        $curlerror = curl_error($curl);

        curl_close($curl);
        // echo "Inside the function ok";
        // header('Content-type:application/json;charset=utf-8');
        // $response = json_decode($response);
        // print_r(json_encode($response,true));
        if ($curlerror) {
            $responseData = null;
            print_r(json_encode($responseData, true));
        } else {
            if (strpos($response, "No record was found"))
            // if($response=="Bad Request")
            {
                $responseData = null;
                print_r(json_encode($responseData, true));
            } else {
                header('Content-type:application/json;charset=utf-8');

                print_r($response, true);
            }
        }
    }

    function initialloanamount_accordin()
    {
        $contact_id = $_POST['contact_id'];
        $flag = $_POST['flag'];
        $contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
        $custID = $contact->CustomFields->c->customerno;
        // $custID=12696034;
        $flag = "true";

        load_curl();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://msmeportal.tvscredit.com/MSMEServices/account/getApplicationDetails',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "{\"customerID\":\"$custID\",\"expandAgreementDetails\":\"$flag\"}",
            // CURLOPT_POSTFIELDS =>'{ "customerID":"12696034","expandAgreementDetails": "true"}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }


    function customerdetails()
    {
        $prospectNumber = $_POST['prospectNumber'];

        load_curl();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://msmeportal.tvscredit.com/MSMEServices/customer/getCustomerDetails',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // CURLOPT_POSTFIELDS =>'{"prospectNumber": "8001CV0027384"}',
            CURLOPT_POSTFIELDS => "{\"prospectNumber\": \"$prospectNumber\"}",

            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    function raiseQueryRequest_add()
    {
        // echo '<pre>';	
        // print_r($_POST); 
        // exit();
        // print_r($_FILES);
        // ex1it();

        $contactId = $_POST['co_id'];


        try {
            $incident = new RNCPHP\Incident();

            $incident->Subject = $_POST['subject'];

            if (!empty($_POST['incident_category'])) {
                $incident->Category = RNCPHP\ServiceCategory::fetch($_POST['incident_category']);
            }

            $incident->Threads = new RNCPHP\ThreadArray();
            $incident->Threads[0] = new RNCPHP\Thread();
            $incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
            $incident->Threads[0]->EntryType->ID = 4; // Used the ID here. See the Thread object for definition
            $incident->Threads[0]->Text = $_POST['Question_Q'];
            //file attachment

            if (isset($_FILES['attachment']['tmp_name']) and strlen($_FILES['attachment']['tmp_name'])) {
                $fileContent = file_get_contents($_FILES['attachment']['tmp_name']);
                $fileType = $_FILES['attachment']['type'];
                $ext = end(explode(".", $_FILES['attachment']['name']));
                // Add FileAttachment
                $incident->FileAttachments = new RNCPHP\FileAttachmentIncidentArray();
                $fattach = new RNCPHP\FileAttachmentIncident();
                $fattach->ContentType = "$fileType";
                $fp = $fattach->makeFile();
                fwrite($fp, $fileContent);
                fclose($fp);
                $fattach->FileName = $_FILES['attachment']['name'];
                $fattach->Name = $_FILES['attachment']['name'];
                // $fattach->Description = "File Uploaded By: " . $Session_UserDisplayName . " (ID:" . $user_id . ")";
                $fattach->Name = $_FILES['attachment']['name'];
                $incident->FileAttachments[] = $fattach;
            }
            // echo "string".$contact_id;
            // exit();

            $incident->PrimaryContact = RNCPHP\Contact::fetch($contactId); //Required field to create an incident through connect PHP

            $incident->StatusWithType               = new RNCPHP\StatusWithType();
            $incident->StatusWithType->Status       = new RNCPHP\NamedIDOptList();
            $incident->StatusWithType->Status->ID   = 1;

            //\RNCPHP\CO\City::fetch( "$city" );
            if (strlen($_POST['Incident_CustomFields_CO_Loan_ID'])) {
                // list($loan_id,$agg_no) = $_POST['Incident_CustomFields_CO_Loan_ID'];
                $incident->CustomFields->CO->Loan = RNCPHP\CO\Loan::fetch($_POST['Incident_CustomFields_CO_Loan_ID']);
            }



            $incident->save();
            //echo "Incident Created";
            $responseArray[] = array('value_id' => $incident->ID, 'value_refno' => $incident->ReferenceNumber);
            //$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);

            // $responseArray =json_encode($responseArray);

            $id = $incident->ID;
            $ref = $incident->ReferenceNumber;
            $url = "https://tvscs.custhelp.com/app/msme/ask_confirm/i_id/" . $incident->ID;
            // exit();
            header("Location: " . $url);
        } catch (Exception $err) {
            echo json_encode($err->getMessage());
        }
    }

    function payment_msme()
    {
        $agmt = $_REQUEST['agreement_no'];
        $start = $_REQUEST['start_date'];
        $end = $_REQUEST['end_date'];

        load_curl();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://msmeportal.tvscredit.com/MSMEServices/payment/getAllDetails',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"agreementNumber": "' . $agmt . '", "fromDate":"' . $start . '", "toDate":"' . $end . '"}',

            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        if ($curl_error) {
            $responseData = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
            print_r(json_encode($responseData));
        } else {
            // header('Content-type:application/json;charset=utf-8');
            // print_r($response);
            if ($response == "Bad Request") {
                $responseData = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
                print_r(json_encode($responseData));
            } else if (isset($response)) {
                $err_res = json_decode($response);
                if (isset($err_res->Error)) {
                    $responseData = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
                    print_r(json_encode($responseData));
                } else {
                    $jsontoArrResponse = json_decode($response);
                    $final_response = json_encode($jsontoArrResponse->paymentDetails);
                    print_r($final_response);
                }
            } else {
                $responseData = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
                print_r(json_encode($responseData));
            }
        }
    }

    function repayment_msme()
    {
        // $agmt ="TN4001MS0001960";
        $agmt = $_POST['agreement_no'];
        // echo $agmt;
        // return 'post'.$_POST;
        load_curl();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://msmeportal.tvscredit.com/MSMEServices/schedule/getAmortSchedule',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            //   CURLOPT_POSTFIELDS =>'{
            //     "loanAccountNumber": "KA5002MS0029544"$re
            // }',
            CURLOPT_POSTFIELDS => "{\r\n\t\"agreementNumber\":\"$agmt\"\r\n}",

            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => 'https://msmeportaluat.tvscredit.com/MSMEServices/getRepaymentScheduleDetails?agreementNumber=TN4001MS0003728',
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => '',
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => 'GET',
        // ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        if ($curl_error) {
            $responseData = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
            print_r(json_encode($responseData));
        } else {
            // header('Content-type:application/json;charset=utf-8');
            // $response=json_decode($response);
            // print_r(json_encode($response));
            if ($response == "Bad Request") {
                $responseData = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
                print_r(json_encode($responseData));
            } else {
                // print_r(json_encode(json_decode($response)));

                $response = json_decode($response);

                $response = json_encode($response->{'amortSchedule'});
                if ($response == null || $response == "null") {
                    $responseData = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
                    print_r(json_encode($responseData));
                } else {
                    print_r($response);
                }

                // echo($response);

                // print_r(json_encode(json_dencode($response)));


            }
        }
    }

    function rest_api_report2()
    {
        //$url = "https://RNTpartner_VirtuosNarendra:Rightnow!1@tvscs.custhelp.com/services/rest/connect/v1.3/analyticsReportResults"; 


        /// message base repor (new report loan type filter contact id, loan type msme, )


        $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No_OD); //issue not finding
        $report_id = $msg->Value;
        $idreport = $report_id;
        // $idreport=100706;






        //{"filters":[{"name":"<FilterName>","values":"<filtervalue>"}],"id":<report Id>}
        //{"filters":[{"name":"ContactID","values":"3"}],"id":100010}
        $contact_id = $this->session->getProfileData("c_id");

        //print_r($content );
        load_curl();
        $filter = array('Contact ID' => $contact_id);
        $response = report_result($idreport, $filter);
        $userData = $this->session->getSessionData("userProfile");
        $agg_count = count($response);
        $methodval = $_POST['method_val'];
        $flag = false;
        if ($_REQUEST['filtering_val'] == 'initialloan' && $_REQUEST['filtering_val2'] == 'BD') {
            echo "<div class='form-group'><select id='i_loan'><option value='0'>--Select--</option>";
            //for($i = 0; $i < $agg_count; $i++ ) {
            foreach ($response as $key => $result) {
                //	if(!empty($userData['agg_no']) && $userData['agg_no'] == $result['Agreement No']){
                //			$sel = "selected";
                //			$flag = true;
                //	}else{
                $sel = '';
                //	}	
                echo '<option value=' . $result['Prospect No'] . ' ' . $sel . '>' . $result['Prospect No'] . '</option>';
            }
            echo '</select></div>';
        ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#i_loan').trigger('change'); //This event will fire the change event. 
                    $('#i_loan').change(function() {
                        if ($(this).val() != '0') {
                            $('#iload').css("display", "block");
                            var d = $(this).val();
                            $.post("/cc/AjaxCustom/rest_api_call_drop2", {
                                    ag_no: d,
                                    method_val: '<?php echo $methodval; ?>'
                                })
                                .done(function(data) {
                                    $("#showresult").html(data);
                                    $('#iload').css("display", "none");

                                });
                        }
                    });

                });
            </script>

        <?php
        } else if ($_REQUEST['filtering_val'] == 'statusofloan' && $_REQUEST['filtering_val2'] == 'BD') {
            echo "<div class='form-group'><select id='s_loan'><option value='0'>--Select--</option>";
            foreach ($response as $key => $result) {
                //if(!empty($userData['agg_no']) && $userData['agg_no'] == $result['Agreement No']){
                //		$sel = "selected";
                //	$flag = true;
                //}else{
                $sel = '';

                //}	
                echo '<option value=' . $result['Prospect No'] . ' ' . $sel . '>' . $result['Prospect No'] . '</option>';
            }
            echo '</select></div>';
        ?>

            <script type="text/javascript">
                $(document).ready(function() {
                    $('#s_loan').trigger('change'); //This event will fire the change event. 
                    $('#s_loan').change(function() {
                        if ($(this).val() != '0') {
                            $('#isload').css("display", "block");
                            var x = $(this).val();
                            $.post("/cc/AjaxCustom/rest_api_call_drop2", {
                                    ag_no: x,
                                    method_val: '<?php echo $methodval; ?>'
                                })
                                .done(function(data) {
                                    $("#showresult_loan").html(data);
                                    $('#isload').css("display", "none");
                                });
                        }
                    });
                });
            </script>

        <?php
        } else if ($_REQUEST['filtering_val'] == 'instrumentdetails' && $_REQUEST['filtering_val2'] == 'BD') {
            echo "<div class='form-group'><select id='i_detail'><option value='0'>--Select--</option>";
            foreach ($response as $key => $result) {
                //	if(!empty($userData['agg_no']) && $userData['agg_no'] == $result['Agreement No']){
                //$sel = "selected";
                //$flag = true;
                //}else{
                $sel = '';
                //}	
                echo '<option value=' . $result['Prospect No'] . ' ' . $sel . '>' . $result['Prospect No'] . '</option>';
            }
            echo '</select></div>';
        ?>
            <script type="text/javascript">
                var isSoaOk = true;
                $(document).ready(function() {


                    $('#i_detail').trigger('change');
                    $('#i_detail').change(function() {
                        if ($(this).val() != '0') {
                            $('#idload').css("display", "block");
                            var id = $(this).val();
                            $.post("/cc/AjaxCustom/check_soa_permission", {
                                ag_no: id
                            }).done(function(data) {
                                var resp = JSON.parse(data);
                                // console.log(resp);
                                // console.log(resp.ReturnOutput[0].SOA_DOWNLOAD);
                                if (resp.ReturnMessage == "SOADownloadValidation") {
                                    if (resp.ReturnOutput[0].SOA_DOWNLOAD == "N") {
                                        isSoaOk = false;
                                    } else {
                                        isSoaOk = true;
                                    }
                                }
                                // console.log("isok? :"+isSoaOk);
                            }).then(
                                function() {
                                    $.post("/cc/AjaxCustom/rest_api_call_drop2", {
                                            ag_no: id,
                                            method_val: '<?php echo $methodval; ?>'
                                        })
                                        .done(function(data) {
                                            var url_data = JSON.parse(data);
                                            if (url_data.message == '') {
                                                //console.log(url_data.url_for);
                                                // console.log(url_data.url_ins);
                                                $("#instrumentdetails_docs").css("display", "block");
                                                $("#showresult_instrument").hide();
                                                if (url_data.url_ins != '') {
                                                    $("#url_ins").attr("href", url_data.url_ins);
                                                }
                                                if (url_data.url_for != '') {
                                                    $("#url_for").attr("href", url_data.url_for);
                                                } else {
                                                    $('#forclosure').hide();
                                                }
                                                if (url_data.soa_for != '') {
                                                    $("#url_for_soa").attr("href", url_data.soa_for);
                                                } else {
                                                    $("#soa").hide();
                                                }
                                            } else {
                                                $("#showresult_instrument").css("display", "block");
                                                $("#instrumentdetails_docs").hide();
                                                //	$("#url_ins").attr("href", url_data.url_ins);
                                                if (url_data.url_for != '') {
                                                    $("#url_for_n").attr("href", url_data.url_for);
                                                } else {
                                                    $('#forclosure_n').hide();
                                                }
                                                if (url_data.soa_for != '') {
                                                    $("#url_for_n_soa").attr("href", url_data.soa_for);
                                                } else {
                                                    $("#soa_n").hide();
                                                }
                                                //	 $( "#showresult_instrument" ).html(url_data.message);

                                            }
                                            $('#idload').css("display", "none");
                                        });
                                });
                        }
                    });
                });
            </script>

            <?php
        } else if ($_REQUEST["filtering_val"] == "mandateStatus" && $_REQUEST['filtering_val2'] == 'BD') {
            echo "<div class='form-group'><select id='i_detail'><option value='0'>--Select--</option>";
            foreach ($response as $key => $result) {
                //	if(!empty($userData['agg_no']) && $userData['agg_no'] == $result['Agreement No']){
                //$sel = "selected";
                //$flag = true;
                //}else{
                $sel = '';
                //}	
                echo '<option value=' . $result['Agreement No'] . ' ' . $sel . '>' . $result['Agreement No'] . '</option>';
            }
            echo '</select></div>';
            if ($methodval) {
            ?>
                <script type="text/javascript">
                    $(document).ready(function() {

                        var show_card = false;
                        var show_card2 = false;

                        $('#i_detail').trigger('change');
                        $('#i_detail').change(function() {

                            if ($(this).val() != '0') {
                                $('#idload').css("display", "block");

                                var id = $(this).val();


                                $.post("/cc/AjaxCustom/rest_api_call_drop2", {
                                        ag_no: id,
                                        method_val: 'getMandateStatuses'
                                    })
                                    .done(function(data) {
                                        var json_response = JSON.parse(data);
                                        //console.log(json_response);
                                        // console.log(json_response[0].Agment_NO);
                                        //       console.log(json_response[0].Blank_mandate);
                                        //       console.log(json_response[0].Noc_mandate);


                                        $('.text1').html("<p><strong style='color:#003c7d;'>Prefilled Mandate:</strong> Please download the Prefilled mandate document.  Attest your signature as per your bank records and send it to our address: TVS Credit Services, 2nd Floor, Bristol Tower, 10 South Phase, Thiruvika Industrial Estate, Guindy Chennai-600 032</p>");
                                        $('.text12').html("<p><a href='https://tvscscrmservice.tvscredit.com/CRMService.svc/Blank_mandate/" + id + "' class='live-cust'  style='display: none;' download><img src='/euf/assets/images/pdficon.png' width='100' height='110'></a><br><strong style='color:#003c7d;'>Blank Mandate:</strong> Please download the blank mandate. Fill the appropriate bank details as required, sign it as per your bank records and send it to our address: TVS Credit Services, 2nd Floor, Bristol Tower, 10 South Phase, Thiruvika Industrial Estate, Guindy Chennai-600 032</p>");
                                        $('.text2').html("");
                                        // var url_to = "https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=TN3000CD0006055&report=NOC_FOR_CDPORTFOLIO.jrxml";//"https://rmsnew.tvscredit.com/rms/Jasper?AGRNO="+id+"&report=NOC_FOR_CDPORTFOLIO.jrxml"; https://tvscscrmservice.tvscredit.com/CRMService.svc/Blank_mandate/TN3000TW00426
                                        //https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=TN3000TW00426&report=NOC_FOR_CDPORTFOLIO.jrxml ;;;https://tvscscrmservice.tvscredit.com/CRMService.svc/GetFilledForm_ECS/TN3000TW00426 earlier -> https://tvscscrmuatservice.tvscredit.com/CRMService.svc/GetFilledForm_ECS
                                        $('#dwnbtn').html("<a href='https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=" + id + "&report=NOC_FOR_CDPORTFOLIO.pdf' class='no-due' id='no-due' target='_blank' download><img src='/euf/assets/images/pdficon.png' width='100' height='110'></a>");
                                        $('#filledbtn').html("<a href='https://tvscscrmservice.tvscredit.com/CRMService.svc/GetFilledForm_ECS/" + id + "' class='req-cust' id='req-cust' target='_blank' download><img src='/euf/assets/images/pdficon.png' width='100' height='110'></a>");
                                        if ((json_response[0].Blank_mandate == "N" && json_response[0].Fill_mandate == "N" && json_response[0].Noc_mandate == "N") || (json_response[0].Blank_mandate == "" && json_response[0].Fill_mandate == "" && json_response[0].Noc_mandate == "") || (json_response[0].Blank_mandate == "" && json_response[0].Fill_mandate == "" && json_response[0].Noc_mandate == "N")) {
                                            $('.not-applicable').html("Selected Loan Account is not live. This option is not applicable.");
                                            $('.not-applicable').show();
                                            $(".card1").hide();
                                            $(".card2").hide();
                                        } else {
                                            $('.not-applicable').hide();
                                            if (json_response[0].Blank_mandate == "Y") {
                                                $('.live-cust').show();
                                                $('.text12').show();
                                                show_card = true;
                                            } else {
                                                $('.live-cust').hide();
                                                $('.text12').hide();
                                            }

                                            if (json_response[0].Fill_mandate == "Y") {
                                                $('.req-cust').show();
                                                $('.text1').show();
                                                show_card = true;
                                            } else {
                                                $('.req-cust').hide();
                                                $('.text1').hide();
                                            }
                                            if (json_response[0].Blank_mandate != "Y" && json_response[0].Fill_mandate != "Y") {
                                                show_card = false;
                                            }
                                            if (json_response[0].Noc_mandate == "Y") {
                                                $('#dwnbtn').show();
                                                show_card2 = true;
                                            } else {
                                                $('#dwnbtn').hide();
                                                show_card2 = false;
                                            }
                                            if (show_card == true) {
                                                $('.card1').show();
                                            } else {
                                                $('.card1').hide();
                                            }
                                            // alert(show_card2 +" and "+ id);
                                            if (show_card2 == true) {
                                                $('.card2').show();
                                            } else {
                                                $('.card2').hide();
                                            }
                                        }
                                    });
                                // }
                            }
                        });

                    });
                </script>
<? }
        }

        //curl_close($curl);

    }    //akash changes


    ////////msme end
    //////////mandate cancel
    function ecsmandate_live_cancel()
    {
        try {
            $contact_id = $_POST['contact_id'];
            $loan_id = $_POST['agg'];


            $PrimaryContact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
            // print_r($PrimaryContact);
            $incident = new \RightNow\Connect\v1_3\Incident();
            $incident->PrimaryContact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
            $incident->Subject = "ECS mandate cancellation";
            $incident->Threads = new \RightNow\Connect\v1_3\ThreadArray();
            $incident->Threads[0] = new \RightNow\Connect\v1_3\Thread();
            $incident->Threads[0]->EntryType = new \RightNow\Connect\v1_3\NamedIDOptList();
            $incident->Threads[0]->EntryType->ID = 3;
            $incident->Threads[0]->Text = "Hi, " . $PrimaryContact->LookupName . " has requested for the mandate cancellation process intiation";
            $incident->Category = \RightNow\Connect\v1_3\ServiceCategory::fetch(2235); //ECS mandate cancellation

            $incident->StatusWithType               = new \RightNow\Connect\v1_3\StatusWithType();
            $incident->StatusWithType->Status       = new \RightNow\Connect\v1_3\NamedIDOptList();
            $incident->StatusWithType->Status->ID   = 1;
            $incident->CustomFields->CO->Loan = \RightNow\Connect\v1_3\CO\Loan::fetch($loan_id);

            $incident->save(\RightNow\Connect\v1_3\RNObject::SuppressAll);
            // return;
            $ref = $incident->ReferenceNumber;
            $url = "https://tvscs.custhelp.com/app/ask_confirm/i_id/" . $incident->ID;
            $resp = array("Message" => $url, "Status" => "Success");
            echo json_encode($resp, JSON_UNESCAPED_SLASHES);
            // exit();
        }
        //header("Location: ".$url);
        catch (Exception $err) {

            echo json_encode(array("Message" => $err->getMessage(), "Status" => "Error"));
        }
    }

    function ecsmandate_nonlive_cancel()
    {
        try {
            $contact_id = $_POST['contact_id'];
            $loan_id = $_POST['agg'];
            $PrimaryContact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
            $incident = new \RightNow\Connect\v1_3\Incident();
            $incident->PrimaryContact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
            $incident->Subject = "ECS mandate cancellation";
            $incident->Threads = new \RightNow\Connect\v1_3\ThreadArray();
            $incident->Threads[0] = new \RightNow\Connect\v1_3\Thread();
            $incident->Threads[0]->EntryType = new \RightNow\Connect\v1_3\NamedIDOptList();
            $incident->Threads[0]->EntryType->ID = 3;
            $incident->Threads[0]->Text = "Hi, " . $PrimaryContact->LookupName . " has requested for the mandate cancellation 
					    process intiation";
            $incident->Category = \RightNow\Connect\v1_3\ServiceCategory::fetch(2239);  //Mandate cancellation request                     
            $incident->StatusWithType               = new \RightNow\Connect\v1_3\StatusWithType();
            $incident->StatusWithType->Status       = new \RightNow\Connect\v1_3\NamedIDOptList();
            $incident->StatusWithType->Status->ID   = 1;
            $incident->save(\RightNow\Connect\v1_3\RNObject::SuppressAll);
            $id = $incident->ID;
            $ref = $incident->ReferenceNumber;
            $url = "https://tvscs.custhelp.com/app/ask_confirm/i_id/" . $incident->ID;
            // exit();
            $resp = array("Message" => $url, "Status" => "Success");
            echo json_encode($resp, JSON_UNESCAPED_SLASHES);
        } catch (Exception $err) {
            echo json_encode(array("Message" => $err->getMessage(), "Status" => "Error"));
        }
        // return;

    }
    ///////////edoc

    function edoc()
    {
        // print_r($_POST);
        $ag_no = $_POST['ag_no'];
        $method_val = $_POST['method_val'];
        load_curl();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://customeroperationapi.tvscredit.com/Customer/FileDownload',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
	 "referenceno":"' . $ag_no . '",

	   "doc_type":"' . $method_val . '"
	}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic SVZSVVNSOklWUlVTUiQ=',
                'Content-Type: application/json',
                'Cookie: ChannelName=IVR'
            ),
        ));

        // print_r($curl);
        $response = curl_exec($curl);

        curl_close($curl);
        if ($curl_error) {
            print_r($curl_error);
        } else {
            print_r($response);
        }
    }

    function RCIMAGE()
    {
        $ag_no = $_POST['ag_no'];
        // $_POST['form'][0]['value']
        // echo $ag_no;exit();
        $ar = RNCPHP\ROQL::query("Select CO.Loan.Prospect_No from CO.Loan where CO.Loan.Agreement_No='" . $ag_no . "'")->next();
        $arr = $ar->next();

        load_curl();
        $curl = curl_init();
        $json_url = 'https://customeroperationapi.tvscredit.com/GetData/RCImage_available?ApplicationNo=' . $arr['Prospect_No']; //$ag_no
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $json_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        print_r($response);
    }


    function InsuranceRenewalPolicy()
    {
        $ag_no = $_POST['ag_no'];
        // $_POST['form'][0]['value']
        // echo $ag_no;exit();
        load_curl();
        $curl = curl_init();
        $json_url = 'https://customeroperationapi.tvscredit.com/InsuranceRenewal/InsurancecopyRenewalDocuments_available?AgreementNo=' . $ag_no; //$ag_no
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $json_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        print_r($response);
    }

    function JSondata()
    {

        $ag_no = $_POST['ag_no'];
        // $_POST['form'][0]['value']
        // echo $ag_no;exit();
        load_curl();
        $curl = curl_init();
        $json_url = 'https://customeroperationapi.tvscredit.com/GetData/NewgenDMSDetails?AgreementNo=' . $ag_no; //$ag_no
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $json_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        $data = (stripcslashes(trim($response, '"')));
        print_r($data);
    }

    function soa_download_for_customer()
    {
        load_curl();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/callUserAuthenticate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => '{
    "userId" : "CRMUSR1",
    "password" : "ff7bd97b1a7789ddd2775122fd6817f3173672da9f802ceec57f284325bf589f"
  }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);



        curl_close($curl);
        $data = $r = json_decode(stripcslashes(trim($response, '"')));

        if ($data->root->Result->Status == 2) {
            echo "no data found";
            // exit();
        } else {
            // echo "<script>console.log(".$response.")</script>";
            // echo $response;
            $agg = $_POST['agg_no'];
            // load_curl();
            $curl2 = curl_init();

            curl_setopt_array($curl2, array(
                CURLOPT_URL => 'https://tvscscrm.tvscredit.com/tvscrmlosws/rest/GetTVSDetails/givePostSOAPDFJSON',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS => '{
            "userId" : "CRMUSR1",
            "sessionId" : "' . $data->root->Result->SessionId . '",
            "agreementNo" : "' . $agg . '"
          }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                    // header('Content-Disposition: attachment; filename="response.pdf"');
                ),

            ));
            // curl_setopt($ch, CURLOPT_HEADER, 0);
            $response2 = curl_exec($curl2);

            curl_close($curl2);

            echo base64_encode($response2);




            // if(st)
        }
    }



    function ca_api()
    {
        $ag = $_POST['ag_no'];
        $cat = $_POST['cat'];
        $agg = explode("_", $ag);
        // echo $ag;exit();
        $query1 = "Select ID,Contact from CO.Loan where Agreement_No='" . $agg[1] . "'";
        $res1 = \RightNow\Connect\v1_3\ROQL::query($query1)->next();
        $loan = $res1->next();
        $loanID = $loan['ID'];
        $contactt = $loan['Contact'];
        $contact =  \RightNow\Connect\v1_3\Contact::fetch($contactt);
        $cccc = $contact->Name->First . ' ' . $contact->Name->Last;
        for ($i = 0; $i < count($contact->Phones); $i++) {
            if ($contact->Phones[$i]->PhoneType->LookupName == 'Mobile Phone');
            $mobile = $contact->Phones[$i]->Number;
        }
        $dob = $contact->CustomFields->c->dob;

        // echo $loanID; 
        $query = "Select Subject,StatusWithType.Status,LookupName,ID,StatusWithType.StatusType,CreatedTime from Incident where Incident.CustomFields.CO.Loan.ID= " . $loanID . " and Category.ID=" . $cat . " ORDER BY ID DESC LIMIT 25";
        $res = \RightNow\Connect\v1_3\ROQL::query("$query")->next();
        $incident = $res->next();
        $IncidentID = $incident['LookupName'];
        // print_r($incident);
        $d = strtotime($incident['CreatedTime']);
        $dd = date("Y-m-d H:i:s", $d);
        $dob = substr_replace($dob, "/", 2, 0);
        $dob = substr_replace($dob, "/", 5, 0);
        $IncidentStatus = $incident['StatusType'];
        $data['LookupName'] = $IncidentID;
        $data['status'] = $IncidentStatus;
        $data['Cat'] = $cat;
        $data['Subject'] = $incident['Subject'];
        $data['mobile'] = $mobile;
        $data['dob'] = $dob;
        $data['dateCreated'] = $dd;
        $data['Stat'] = $incident['Status'];
        $data['customername'] = $cccc;
        $data['responseSent'] = "";

        if ($IncidentID) {


            $filter = new RNCPHP\AnalyticsReportSearchFilter;
            $filter->Name = 'ref_no';
            $filter->Values = array($IncidentID);
            $filters = new RNCPHP\AnalyticsReportSearchFilterArray;
            $filters[] = $filter;

            $arr = RNCPHP\AnalyticsReport::fetch(100831); //tst  107326
            $staff_entry = $arr->run(0, $filters);
            $staff_entrycount = $staff_entry->count();

            if ($staff_entrycount) {
                $row = $staff_entry->next();
                $data['responseSent'] = $row['Text'];
            } else {
                $data['responseSent'] = "";
            }
        }

        print_r(json_encode($data));
    }

    function cdndc()
    {
        $cat = $_POST['cat'];
        $ag = $_POST['ag_no'];
        $agg = explode("_", $ag);
        $mobile = $_POST['mobile'];
        // $ag=TN3000TW0095211;
        // $mobile='8309249930';
        //53 duplicate noc
        //58 noc request
        //84 balance query
        //93 f/c
        //86 statement of amount req
        //1812 CD- NDC softcopy
        //1891 Swapping Enquiry
        //insurance 77
        $url = "https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=" . $agg[1] . "&report=NOC_FOR_CDPORTFOLIO.pdf";
        // $url="https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=".$agg[1]."&report=NOC_FOR_CDPORTFOLIO.pdf";
        $msg = "";
        load_curl();
        // $curl = curl_init();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    function apiHITSfor_digitization()
    {
        $cat = $_POST['cat'];
        $ag = $_POST['ag_no'];
        $agg = explode("_", $ag);
        $mobile = $_POST['mobile'];
        // $ag=TN3000TW0095211;
        // $mobile='8309249930';
        //53 duplicate noc
        //58 noc request
        //84 balance query
        //93 f/c
        //86 statement of amount req
        //1812 CD- NDC softcopy
        //1891 Swapping Enquiry
        //insurance 77
        $url = "";
        $msg = "";
        if ($cat == 58) {
            // $url='https://ivrserviceuat.tvscredit.com/ChatBotNew/NOCRequest';
            $url = 'https://customeroperationapi.tvscredit.com/ChatBotNew/NOCRequest';
        } elseif ($cat == 53) {
            // $url='https://ivrserviceuat.tvscredit.com/ChatBotNew/Dup_NOCRequest';
            $url = 'https://customeroperationapi.tvscredit.com/ChatBotNew/Dup_NOCRequest';
            $msg = "Apply NOC";
        } elseif ($cat == 77) {
            // $url='https://ivrserviceuat.tvscredit.com/InsuranceRenewal/InsurancecopyRenewalDocuments?AgreementNo='.$agg[1];
            $url = 'https://customeroperationapi.tvscredit.com/InsuranceRenewal/InsurancecopyRenewalDocuments?AgreementNo=' . $agg[1];
        } elseif ($cat == 84) {
            // $url='https://ivrserviceuat.tvscredit.com/ChatBotNew/BalanceOverDue';
            $url = 'https://customeroperationapi.tvscredit.com/ChatBotNew/BalanceOverDue';
        } elseif ($cat == 93) {
            // $url='https://ivrserviceuat.tvscredit.com/LoanDetails/GetEmiDetails';
            $url = 'https://customeroperationapi.tvscredit.com/LoanDetails/GetEmiDetails';
        } elseif ($cat == 86) {
            $url = '';
        } elseif ($cat == 1891) {
            $url = '';
        }
        // echo $url;
        if ($cat != 1891 && $cat != 93 && $cat != 77) {


            if ($cat != 77 && $cat != 53) {
                load_curl();
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{"AgreementNo":"' . $agg[1] . '",
			"AppID":"yFyPUcFsqzeYCfyokBaqxA=="
			 }
			',

                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));





                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;
            } else {
                load_curl();
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '
			 {"AgreementNo":"' . $agg[1] . '",
                                    "MobileNo":"' . $mobile . '",
                                     "Message":"' . $msg . '",
                                    "AppID":"yFyPUcFsqzeYCfyokBaqxA=="
                           }',

                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));





                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;
            }
        } elseif ($cat == 93) {
            load_curl();
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '
			 {"AgreementNo":"' . $agg[1] . '"}',

                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic SVZSVVNSOklWUlVTUiQ=',
                    'Content-Type: application/json',
                    'Cookie: ChannelName=IVR'
                ),

            ));





            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
        } elseif ($cat == 77) {
            load_curl();


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
        }
    }
    function paymentgateway_urls()
    {

        $cat = $_POST['cat'];
        $ag = $_POST['ag_no'];
        $agg = explode("_", $ag);
        $mobile = $_POST['mobile'];
        $dob = $_POST['dob'];
        $customername = $_POST['customername'];

        // $ag='MH3018TR0000283';
        // $mobile='9635194552';
        //53 duplicate noc    // DUP_NOC – Duplicate NOC     
        //86 statement of amount re// 	LOANST_CHG – Statement of Account Request
        //1891 Swapping Enquiry     // SWAP_CHG – Swapping charges
        $chargestype = "";
        if ($cat == 53) {
            $chargestype = "DUP_NOC";
        } elseif ($cat == 86) {
            $chargestype = "LOANST_CHG";
        } elseif ($cat == 1891) {
            $chargestype = "SWAP_CHG";
        }
        // echo $agg[1].$customername.$chargestype.$dob.$mobile;exit();
        load_curl();
        $curl = curl_init();
        // $url="https://pguat.tvscredit.com/Customer/OtherChargesPayment"

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://payment.tvscredit.com//Customer/OtherChargesPayment',

            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            // CURLOPT_POSTFIELDS =>'{
            // 	"ChannelCode" : "PGW",
            // 	"AgreementNo" : '.$agg[1].',
            // 	"CustomerName" : '.$customername.',
            // 	"chargestype":'.$chargestype.',
            // 	"DateofBirth" : '.$dob.',
            // 	"MobileNo" : '.$mobile.'
            // 	}',
            // CURLOPT_POSTFIELDS =>'{
            // 				"ChannelCode" : "PGW",
            // 				"AgreementNo" : "TN3006TW0094828",
            // 				"CustomerName" : "USHA B",
            // 				"chargestype":"SWAP_CHG",
            // 				"DateofBirth" : "27/09/1964",
            // 				"MobileNo" : "9677992076"
            // 				}',
            CURLOPT_POSTFIELDS => '{
									"ChannelCode" : "PGW",
									"AgreementNo" : "' . $agg[1] . '",
									"CustomerName" : "' . $customername . '",
									"chargestype":"' . $chargestype . '",
									"DateofBirth" : "' . $dob . '",
									"MobileNo" : "' . $mobile . '"
									}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    function getdispatchadd()
    {
        load_curl();
        $curl = curl_init();
        $ag_no = $_POST['agreement_no'];
        $adtype = $_POST['adType'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://payment.tvscredit.com/Customer/FetchAddressDetails',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => '{
			    "AgreementNo": "' . $ag_no . '",
			    "AddressType": "' . $adtype . '",
			    "ChannelCode": "PGW",
			    "ChargeHead":null
			    
			}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        print_r($response);
    }


      function paperlessnoc()
{
	load_curl();
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://intranetTvsrmskyc.tvscredit.com/tvsrmskycws/rest/kyc/createsess',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POSTFIELDS =>'{"UserName":"RAO","UserPassword":"Pass@123"}',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);



  curl_close($curl);


  if(strpos($response, 'errorCode=0000') == false)
  {
    echo "no data found";
    // exit();
  }
  else
  {
    // echo "<script>console.log(".$response.")</script>";
	// echo $response;
	      $agg=$_POST['agg_no'];
	      $str=explode("=",$response);
	      $c=count($str);
	      $c--;

	      // load_curl();
	       $curl2 = curl_init();
	       // print_r($str);
           // echo $c.$str[$c];exit();
           $str=str_replace("}","",$str[$c]);
       		 curl_setopt_array($curl2, array(
          CURLOPT_URL => 'https://intranetTvsrmskyc.tvscredit.com/tvsrmskycws/rest/kyc/paperlessnoc',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_SSL_VERIFYHOST => false,
          CURLOPT_SSL_VERIFYPEER => false,
           CURLOPT_POSTFIELDS =>'{"Sessionid":"'.$str.'","Agreementnumber":"'. $agg.'"}',
           // CURLOPT_POSTFIELDS =>'{"Sessionid":"'.$str.'","Agreementnumber":"AP3020TW29362"}',

          CURLOPT_HTTPHEADER => array(
           'Content-Type: application/json'
        // header('Content-Disposition: attachment; filename="response.pdf"');
          ),

        ));
 // curl_setopt($ch, CURLOPT_HEADER, 0);
        $response2 = curl_exec($curl2);
        
        curl_close($curl2);
      
        echo base64_encode($response2);




        // if(st)
      }
  }
}
