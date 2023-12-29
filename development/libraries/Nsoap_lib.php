<?php 
namespace Custom\Libraries;

class Nsoap_lib
{
   function __construct()
   {
       require_once('nusoap.php');
   }

/*
*
*/
function getResults($body,$url,$methodName)
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
}
?>