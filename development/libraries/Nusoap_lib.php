<?php

namespace Custom\Libraries;


class Nusoap_lib
{
    /**
     * This library can be loaded a few different ways depending on where it's being called:
     *
     * From a widget or model: $this->CI->load->library('Sample');
     *
     * From a custom controller: $this->load->library('Sample');
     *
     * Everywhere else, including other libraries: $CI = get_instance();
     *                                             $CI->load->library('Sample')->sampleFunction();
     */
    function __construct(){
			    //require_once('nusoap/nusoap.php');
			//	require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
    }

    /**
     * Once loaded as described above, this function would be called in the following ways, depending on where it's being called:
     *
     * From a widget or model: $this->CI->sample->sampleFunction();
     *
     * From a custom controller: $this->sample->sampleFunction();
     *
     * Everywhere else, including other libraries: $CI = get_instance();
     *                                             $CI->sample->sampleFunction();
     */
    function getResults($body,$url)
    {
	//	load_curl();
		

		$headers = array(
		'Content-Type: text/xml; charset="utf-8"',
		'Content-Length: '.strlen($body),
		'Accept: text/xml',
		'Cache-Control: no-cache',
		'Pragma: no-cache',
		'SOAPAction: "http://tempuri.org/SendSMSExternal"'
		);

			$URL = $url;
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,            $URL);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			$output = curl_exec($ch);
		//	print_r($output);   
			curl_close($ch);
			if($output  === false)
			{
				$message['success'] = 0;
				$message['text'] = 'URL not available';
				return (array)$message;
			}
			else
			{
				// echo 'Operation completed without any errors';
				$message['success'] = 1;
				$message['text'] = $output;
				return (array)$message;
				// return "hello";							
			}
			
//			return 1;
    }

/*
*
*/
function getLeadResults($body,$url,$methodName)
    {
		load_curl();
		

		$headers = array(
		'Content-Type: text/xml; charset="utf-8"',
		'Content-Length: '.strlen($body),
		'Accept: text/xml',
		'Cache-Control: no-cache',
		'Pragma: no-cache',
		'SOAPAction: "http://tempuri.org/ITVSCSLMSAPI/'.$methodName.'"'
		);

			$URL = $url;
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,            $URL);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			$output = curl_exec($ch);
		//	print_r($output);   
			curl_close($ch);
			if($output  === false)
			{
				$message['success'] = 0;
				$message['text'] = 'URL not available';
				return (array)$message;
			}
			else
			{
				//echo 'Operation completed without any errors';
				$message['success'] = 1;
				$message['text'] = $output;
				return (array)$message;							
			}
			
//			return 1;
    }

	/*
function for curl API
	*/
	function getDealerAPIData($data,$api_url){

		$apitoken = $this->generateToken();
		if(empty($apitoken)){
				return 'Token Mismatch';
		}
	//	$data = "[1]";
		//$data_encoded = utf8_encode($data);
		/*$data = array("methodName" => "getSalesDisbursedCount", "startDate" => "01/01/2005","endDate" => "01/01/2005", "dealerCode" => "1635");*/
		
		$data_string = json_encode($data,JSON_UNESCAPED_SLASHES);
	    $url = $api_url.rawurlencode($data_string);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		//curl_setopt($ch,CURLOPT_POSTFIELDS,$data_encoded);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
		curl_setopt($ch, CURLOPT_MAXREDIRS ,10);
		curl_setopt($ch, CURLOPT_TIMEOUT,30);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','token_id: '.$apitoken,"content-length: 0"));
		 
		$result = curl_exec($ch);

		$data_encode=$result;
		// print_r($data_encode);
		/*echo "<br><pre>";
		print_r($data_decode);
		echo "</pre><br>";
		$curlerror = curl_error($ch);
		if($curlerror){
			echo "<br>CURL Error:".$curlerror;
		}*/
		
		//echo "</pre><br>";
		$curlerror = curl_error($ch);
		if($result === false){
			return null;
		}else{
			return $data_encode;
		}
		curl_close($ch);
	}

	/*
	*
	*
	*
	*/
	 function getEmployeeLoginResults($body,$url)
    {
		load_curl();
		

		$headers = array(
		'Content-Type: text/xml; charset="utf-8"',
		'Content-Length: '.strlen($body),
		'Accept: text/xml',
		'Cache-Control: no-cache',
		'Pragma: no-cache',
		'SOAPAction: "http://tempuri.org/LOGIN_CREDENTIALS"'
		);

	 
			$URL = $url;
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,            $URL);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			$output = curl_exec($ch);
		//	print_r($output);   
			curl_close($ch);
			if($output  === false)
			{
				$message['success'] = 0;
				$message['text'] = 'URL not available';
				return (array)$message;
			}
			else
			{
				//echo 'Operation completed without any errors';
			//	$message['success'] = 1;
				$parser = xml_parser_create();
				xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
				xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
				xml_parse_into_struct($parser, $output, $values, $tags);
				xml_parser_free($parser);
				/*$message['text'] = $values;
				$message['tags'] = $tags;
				$message['results'] = $output;
				*/
				//$message['results'] = $values[4]['tag'] .'===='.$values[4]['value']."===".$values[6]['value']."===".$values[5]['value'];
				if($values[4]['tag'] == 'RESULT' && $values[4]['value'] == 1){
				    
				    switch ($values[5]['value']){
				        case 'LS':
				            $message['success'] = 0;
				            $message['text'] = $values[6]['value'];
				            break;
			            case 'PS':
			                $message['success'] = 0;
			                $message['text'] = $values[6]['value'];
			                break;
			            case 'PE':
			                $message['success'] = 0;
			                $message['text'] = $values[6]['value']." <a href='https://signon.tvscredit.com/' target='_blank'>Click Here</a>";
			                break;
			            default:
			                $message['success'] = 0;
			                $message['text'] = $values[6]['value'];
				    }
				    
				}else{
				    switch ($values[5]['value']){
				        case 'PS':
				            $message['success'] = 2;
				            $message['text'] = $values[6]['value'];
				            break;
				        default:
				            $message['success'] = 1;
				            $message['text'] = $values[6]['value'];
				    }
				    
				}
				return (array)$message;							
			}
//			return 1;
    }

	/*

	*/
	function getDealerData($url){
			
			$URL = $url;
			$apitoken = $this->generateToken();
			if(empty($apitoken)){
					return 'Token Mismatch';
			}
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,            $URL);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','token_id: '.$apitoken));
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			$output = curl_exec($ch);
		//	print_r($output);   
			curl_close($ch);
			return $output;
	}

	/*
		Get OTP from API
	*/
	function getOTP($mobile_no){
		//------------------Old OTP API---------------------------------
			$url = "https://tvscs--tst1.custhelp.com/cgi-bin/tvscs.cfg/php/custom/send_otp.php?mobile=".$mobile_no;
			load_curl();
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			$output = curl_exec($ch);
			// print_r($output);   
			curl_close($ch);
			return $output;
		//-----------------------------------------------------------------------
		

	}

	/*
	Method to Generate Token using Basic Authentication
	*/
	function generateToken(){
		if(!extension_loaded("curl")){
			load_curl();
		}
		$tokenURL = 'https://tvscscrm.tvscredit.com/tvscrmlosws/rest/IssueToken/giveToken';
		$username  = 'INDUS';
		$password   = 'indus123';
		$params = array();
		$result = '';
		$data = "[1]";
		$data_encoded = utf8_encode($data);

		$curl = curl_init();
//		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://tvscscrm.tvscredit.com/tvscrmlosws/rest/IssueToken/giveToken",
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_SSL_VERIFYHOST => 0,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $data_encoded,
		  CURLOPT_HTTPHEADER => array(
			"Authorization: Basic ".base64_encode($username.":".$password),
			"Cache-Control: no-cache",
			"Content-Type: application/x-www-form-urlencoded",
			"content-length: ".strlen($data_encoded)
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$info = curl_getinfo($curl);
		//print_r($info);
		curl_close($curl);

		if ($err) {
		  // echo "cURL Error #:" . $err;
		return '';
		} else {
		  return $response;
		}

		
	}

/* Send Email to Approver */

	function postRequest($postData,$incident_id,$subject,$body){
			if(!extension_loaded("curl"))
			{
				load_curl();
			}
			
			$ch = curl_init();
			$poststring = '';
			if(!empty($postData)){
				$toEmail = "";
				$bccEmail = "";
				for($i = 0; $i < count($postData); $i++){
					if(strlen($postData[$i]["objDlrReqDetails"]["ToEmailId"])){
						$toEmail .= $postData[$i]["objDlrReqDetails"]["ToEmailId"].",";
					}
					if(strlen($postData[$i]["objDlrReqDetails"]["BCC"])){
						$bccEmail .= $postData[$i]["objDlrReqDetails"]["BCC"].",";
					}
				}
				$toEmail = rtrim($toEmail,',');
				$bccEmail = rtrim($bccEmail,',');
				$poststring .= "&to=".$toEmail."&bcc=".$bccEmail;
			}
			//echo $poststring;
		//	$poststring = '&to=raman.katyal@virtuos.com&bcc=truelogic.jaipur@gmail.com';
			$postData = 'incident_id='.$incident_id.'&subject='.$subject.'&body='.rawurlencode($body).$poststring;
			curl_setopt($ch, CURLOPT_URL,"https://tvscs--tst1.custhelp.com/cgi-bin/tvscs.cfg/php/custom/ta_request.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"$postData");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			// in real life you should use something like:
			// curl_setopt($ch, CURLOPT_POSTFIELDS, 
			//          http_build_query(array('postvar1' => 'value1')));

			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec ($ch);

			print_r($server_output );

			curl_close ($ch);
	}
}
