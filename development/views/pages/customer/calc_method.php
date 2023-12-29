<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="tvs_header.php" clickstream="employee-login"/>
<?php 

		$params = array(
					"Asset_Cost" => 10000,
					"Payment_Mode" => 'C',
					"Down_Payment" => 100,
					"EMI" => null,
					"Tenor" => 10,
					"IMEI" => null,
				);

			$response = emi_soap_call("EMICalculator",$params);
			print_r($response);
?>