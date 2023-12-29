<?php
require_once( get_cfg_var( 'doc_root' ) . '/include/ConnectPHP/Connect_init.phph' );
initConnectAPI();
$CI = & get_instance();
$section = ( $CI->uri->segment( '3' ) ) ? $CI->uri->segment( '3' ) : 'customer';
$currentsess = $CI->session->getSessionData( 'previouslySeenEmail' );
$Session_Contact_Id = $currentsess['sess_contact_id'];
$Session_Contact_Type = $currentsess['sess_contact_type'];
$LoginFlag=0;
if($Session_Contact_Id > 0){$LoginFlag=1;}
$site_url = 'https://tvscs.custhelp.com/app/' . $section;
/*if user is already logged-in start here*/
if(($CI->uri->segment( '3' )=="home" and $LoginFlag==1) or ($CI->uri->segment( '4' )=="login" and $LoginFlag==1)){
	if($CI->uri->segment( '3' )=="home"){
		header("Location:/app/customer/dashboard");
		exit;
	}
	else{
		header("Location:/app/$section/dashboard");
		exit;
	}
}

function checkLoggedIn($section) {
	$section=($section) ? $section : 'customer';
	$CI = & get_instance();
	$bundle = $CI->session->getSessionData( "previouslySeenEmail" );
	$Session_Contact_Id = $bundle[ 'sess_contact_id' ];
	if ( $Session_Contact_Id > 0 ) {
		//do nothing
	} else {
		header( "Location: /app/$section/login" );
		exit;
	}

}

function randomGen( $min, $max, $quantity ) {
	$numbers = range( $min, $max );
	shuffle( $numbers );
	return array_slice( $numbers, 0, $quantity );
}
require_once( '/cgi-bin/tvscs.cfg/scripts/cp/customer/development/libraries/nusoap/nusoap.php' );
load_curl();
function soap_call( $functionName, $arrparam ) {
	$msg = RightNow\ Connect\ v1_3\ MessageBase::fetch( CUSTOM_MSG_TVS_API_URL );
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

function send_OTP_call( $functionName, $arrparam ) {
	$msg = RightNow\ Connect\ v1_3\ MessageBase::fetch( CUSTOM_MSG_SEND_OTP_URL );
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

function report_result( $report_id, $filter_array ) {
	try {
		$result_arr = array();
		if ( count( $filter_array ) > 0 ) {
			$report_filter = new RightNow\ Connect\ v1_3\ AnalyticsReportSearchFilter;
			$filters = new RightNow\ Connect\ v1_3\ AnalyticsReportSearchFilterArray;
			foreach ( $filter_array as $filtername => $filtervalue ) {
				$report_filter = new RightNow\ Connect\ v1_3\ AnalyticsReportSearchFilter;
				$report_filter->Name = $filtername;
				$report_filter->Values = array( $filtervalue );
				$filters[] = $report_filter;
			}
			$ar = RightNow\ Connect\ v1_3\ AnalyticsReport::fetch( $report_id );
			$con_res = $ar->run( 0, $filters );
			$con_count = $con_res->count();
			if ( $con_count > 0 ) {
				for ( $ii = $con_count; $ii--; ) {
					$row = $con_res->next();
					$result_arr[] = $row;
				}
			}
		} else {
			$ar = RightNow\ Connect\ v1_3\ AnalyticsReport::fetch( $report_id );
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

		$contact = new RightNow\ Connect\ v1_3\ Contact();
		$contact->Name = new RightNow\ Connect\ v1_3\ PersonName();
		if ( isset( $title )and strlen( $title ) ) {
			$contact->title = $title;
		}
		if ( strlen( $first_name ) ) {
			$contact->Name->First = ucwords( $first_name );
		}
		if ( strlen( $last_name ) ) {
			$contact->Name->Last = ucwords( $last_name );
		}
		if ( strlen( $email ) ) {
			//add email addresses
			$contact->Emails = new RightNow\ Connect\ v1_3\ EmailArray();
			$contact->Emails[ 0 ] = new RightNow\ Connect\ v1_3\ Email();
			$contact->Emails[ 0 ]->AddressType = new RightNow\ Connect\ v1_3\ NamedIDOptList();
			$contact->Emails[ 0 ]->AddressType->LookupName = "Email - Primary";
			$contact->Emails[ 0 ]->Address = strtolower( $email );
		}
		$contact->NewPassword = ucwords( trim( $first_name ) ) . "@123";
		$contact->CustomFields->c->custom_password = ucwords( trim( $first_name ) ) . "@123";

		if ( strlen( $mobile ) ) {
			$i = 0;
			$contact->Phones[ $i ] = new RightNow\ Connect\ v1_3\ Phone();
			$contact->Phones[ $i ]->PhoneType = new RightNow\ Connect\ v1_3\ NamedIDOptList();
			$contact->Phones[ $i ]->PhoneType->LookupName = 'Mobile Phone';
			$contact->Phones[ $i ]->Number = $mobile;
			$i++;
		}
		if ( strlen( $date_of_birth ) ) {
			$contact->CustomFields->c->dob = $date_of_birth;
		}
		$contact->Address = new RightNow\ Connect\ v1_3\ Address();
		if ( strlen( $address )or strlen( $Pincode ) ) {
			$contact->Address->Street = $address;
		}
		if ( strlen( $city )or strlen( $city ) ) {
			$contact->Address->City = $city;
		}
		if ( strlen( $state )or strlen( $state ) ) {
			$contact->Address->StateOrProvince = new RightNow\ Connect\ v1_3\ NamedIDLabel();
			$contact->Address->StateOrProvince->LookupName = "$state";
		}
		if ( strlen( $country )or strlen( $country ) ) {
			$contact->Address->Country = RightNow\ Connect\ v1_3\ Country::fetch( "$country" );
		}
		if ( strlen( $Pincode )or strlen( $Pincode ) ) {
			$contact->Address->PostalCode = $Pincode;
		}

		$contact->ContactType = new RightNow\ Connect\ v1_3\ NamedIDLabel();
		$contact->ContactType->LookupName = "Customer";

		$contact->save();
		$contact_id = $contact->ID;
		return $contact_id;
	} catch ( Exception $e ) {
		echo "<br>Error: " . $e->getMessage() . " | Code: " . $e->getCode() . "| Line: " . $e->getLine();
	}
}

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
			$contact = RightNow\ Connect\ v1_3\ Contact::fetch( $contact_id );
			if ( isset( $title )and strlen( $title ) ) {
				$contact->title = $title;
			}
			if ( strlen( $first_name ) ) {
				$contact->Name->First = ucwords( $first_name );
			}
			if ( strlen( $last_name ) ) {
				$contact->Name->Last = ucwords( $last_name );
			}
			if ( strlen( $date_of_birth ) ) {
				$contact->CustomFields->c->dob = $date_of_birth;
			}

			if ( strlen( $address )or strlen( $Pincode ) ) {
				$contact->Address->Street = $address;
			}
			if ( strlen( $city )or strlen( $city ) ) {
				$contact->Address->City = $city;
			}
			if ( strlen( $state )or strlen( $state ) ) {
				$contact->Address->StateOrProvince->LookupName == "$state";
			}
			if ( strlen( $country )or strlen( $country ) ) {
				$contact->Address->Country = RightNow\ Connect\ v1_3\ Country::fetch( "$country" );
			}
			if ( strlen( $Pincode )or strlen( $Pincode ) ) {
				$contact->Address->PostalCode = $Pincode;
			}

			$contact->ContactType = new RightNow\ Connect\ v1_3\ NamedIDLabel();
			$contact->ContactType->LookupName = "Customer";

			$contact->save();
		}
	} catch ( Exception $e ) {
		echo "<br>Error: " . $e->getMessage() . " | Code: " . $e->getCode() . "| Line: " . $e->getLine();
	}
}

function create_opportunity( $param_data, $contact_id ) {
	try {
		$first_name = $param_data[ 'first_name' ];
		$last_name = $param_data[ 'last_name' ];
		$mobile = $param_data[ 'mobile' ];
		$loan_type = $param_data[ 'loan_type' ];
		$opp = new RightNow\ Connect\ v1_3\ Opportunity();
		if ( strlen( $mobile ) and strlen( $first_name ) ) {
			$oppname = "$mobile: $first_name";
			if ( strlen( $last_name ) ) {
				$oppname .= " - $last_name";
			}
			$opp->Name = $oppname;
		}
		if ( strlen( $loan_type ) and strlen( $loan_type ) ) {
			$menu = new RightNow\ Connect\ v1_3\ NamedIDLabel();
			//$menu->LookupName="$loan_type";
			$menu->ID = "$loan_type";
			$opp->CustomFields->c->loan_type = $menu;

		}
		$opp->PrimaryContact->Contact = RightNow\ Connect\ v1_3\ Contact::fetch( $contact_id );
		/*$opp->StageWithStrategy->Stage= new RightNow\Connect\v1_3\NamedIDLabel();
		$opp->StatusWithType->Status->ID='Active';*/
		$opp->save();
		$opp_id = $opp->ID;
		return $opp_id;
	} catch ( Exception $e ) {
		echo "<br>Error: " . $e->getMessage() . " | Code: " . $e->getCode() . "| Line: " . $e->getLine();
	}
}

?>
<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard"/>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>TVS Credit Service Ltd - Customer Portal</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="/euf/assets/themes/standard/css/normalize.css">
	<link rel="stylesheet" href="/euf/assets/themes/standard/css/base.css">
	<link rel="stylesheet" href="/euf/assets/themes/standard/css/grid.css">
	<link rel="stylesheet" href="/euf/assets/themes/standard/css/style.css"/>
	<link rel="stylesheet" href="/euf/assets/themes/standard/css/slicknav.css"/>
	<link rel="stylesheet" href="/euf/assets/themes/standard/css/font-awesome.min.css">
	<script type="text/javascript" src="/euf/assets/themes/standard/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/euf/assets/themes/standard/js/modernizr-2.6.2.min.js"></script>
	<script type="text/javascript" src="/euf/assets/themes/standard/js/jquery.tabslet.min.js"></script>
	<script type="text/javascript" src="js/jquery.slicknav.js"></script>
	<!--<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>-->
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="/euf/assets/themes/standard/bootstrap/bootstrap-theme.css">
	<link rel="stylesheet" href="/euf/assets/themes/standard/bootstrap/bootstrap.css">

	<script src="//code.jquery.com/jquery-1.12.3.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/euf/assets/themes/standard/js/scripts.js"></script>
</head>

<body>
	<!-- Div container Starts Here!-->
	<div class="header-container">
		<div class="container">
			<div class="grid_12">
				<!-- Social Icons Starts Here-->
				<div class="<?php echo ($LoginFlag==0) ? 'grid_12' : 'grid_10';?>"><!--Change it to grid_12-->
					<div class="container">
						<div class="grid_10">
							<div class="tvs-social"> <img src="/euf/assets/themes/standard/images/icons/shareicon.png"/><span style="font-family:Segoe, Segoe UI, DejaVu Sans, Trebuchet MS, Verdana,' sans-serif';"> &nbsp;Follow us&nbsp;&nbsp;</span><a href="https://www.facebook.com/TVSCREDIT" target="_blank"><img src="/euf/assets/themes/standard/images/icons/fb-icon.png"></a>&nbsp;<a href="https://twitter.com/TVSCredit" target="_blank"><img src="/euf/assets/themes/standard/images/icons/twitter-icon.png"></a>&nbsp;<a href="https://www.linkedin.com/company/tvs-credit-services-ltd-?trk=top_nav_home" target="_blank"><img src="/euf/assets/themes/standard/images/icons/linkedin.png"></a> </div>
						</div>
					</div>

					<!-- Social Icons Ends Here-->
					<!-- Logo Block Starts Here-->

					<div class="container">
						<div class="<?php echo ($LoginFlag==0) ? 'grid_12' : 'grid_10';?>"><!--Change it to grid_12-->
							<div style="float:left;"> <img src="/euf/assets/themes/standard/images/header/brand-logo.png"> </div>
							<div style="float:right">
								<div class="prime-menu">
									<ul>
										<li><a href="http://www.tvscredit.co.in/aboutus.aspx" target="_blank">ABOUT US</a>
										</li>
										<li> <a href="http://www.tvscredit.co.in/investor-information-annual-reports.aspx" target="_blank">INVESTOR CORNER</a>
										</li>
										<li> <a href="http://www.tvscredit.co.in/career.aspx" target="_blank">CAREER</a>
										</li>
										<li>
											<span class="search-block">
												<form action="/app/search" method="post" onSubmit="checkSearch();">
													<input type="text" name="search" id="search" placeholder="Search" value="">
												</form>
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				
				if ($Session_Contact_Id > 0) {
					?>
					<div class="grid_1 dropdown_divider">

						<div id="container" class="dropdown">
							<nav>
								<ul>
									<li><a href="#" class="dropdown_bg"><img src="images/icons/dropdown-icon.png"> </a>
										<!-- First Tier Drop Down -->
										<ul>
											<li><a href="<?php echo $site_url;?>/profile">My Account</a>
											</li>
											<li><a href="#">Settings</a>
											</li>
											<li><a href="<?php echo $site_url;?>/logout"><strong>Logout</strong></a>
											</li>
										</ul>
									</li>
								</ul>
							</nav>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<!-- Logo Block ends Here-->
		<!-- Contact Number starts Here-->
		<div class="clearfix"></div>
		<div class="container">
			<div class="<?php echo ($LoginFlag==0) ? 'grid_12' : 'grid_11';?>"><!--Before login it would be grid_12-->
				<div class="tvs-contact tvs-text-gen"> <img src="/euf/assets/themes/standard/images/tel.png"> 044-4587-5478 (Toll Free) </div>
			</div>
		</div>

		<!-- Contact Number Ends Here-->

		<!--Mega Menu starts Here!-->

	</div>
	<?php
	if ($LoginFlag==1) {
		if($Session_Contact_Type=="Dealer"){
			?>
			<div class="megamenu-container">
				<div class="main-menu">
					<div class="container">
						<div class="grid_12">
							<ul id="menu">
								<li><a href="<?php echo $site_url;?>/dashboard" class="active"><span><i class="fa fa-home" aria-hidden="true"></i>  </span><br></a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-bullhorn" aria-hidden="true"></i>
			</span><br>Business Information</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-usd" aria-hidden="true"></i>
			</span><br>Trade Advance</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-briefcase" aria-hidden="true"></i>
			</span><br>Incentive &amp; Claims</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-comment" aria-hidden="true"></i>
			</span><br>Grievance</a> </li>
								<!--<li><a href="javascript:void(0);"><span><i class="fa fa-phone" aria-hidden="true"></i>
			</span><br>Contact us</a> </li>-->
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		elseif($Session_Contact_Type=="Employee"){
			?>
			<div class="megamenu-container">
				<div class="main-menu">
					<div class="container">
						<div class="grid_12">
							<ul id="menu">
								<li><a href="<?php echo $site_url;?>/dashboard" class="active"><span><i class="fa fa-home" aria-hidden="true"></i>  </span><br></a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-bullhorn" aria-hidden="true"></i>
			</span><br>Business Status</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-usd" aria-hidden="true"></i>
			</span><br>Agent/AD</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-briefcase" aria-hidden="true"></i>
			</span><br>Helpdesk</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-comment" aria-hidden="true"></i>
			</span><br>General</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-newspaper-o" aria-hidden="true"></i>
			</span><br>Tutorial</a> </li>
						<li><a href="javascript:void(0);"><span><i class="fa fa-folder-open" aria-hidden="true"></i>
			</span><br>Documents</a> </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		else{
			?>
			<div class="megamenu-container">
				<div class="main-menu">
					<div class="container">
						<div class="grid_12">
							<ul id="menu">
								<li><a href="<?php echo $site_url;?>/dashboard" class="active"><span><i class="fa fa-home" aria-hidden="true"></i>  </span><br></a> </li>
								<li><a href="<?php echo $site_url;?>/dashboard"><span><i class="fa fa-tachometer" aria-hidden="true"></i>
			</span><br>Dashboard</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-bullhorn" aria-hidden="true"></i>
			</span><br>Self-Service</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-usd" aria-hidden="true"></i>
			</span><br>Value-Added Services</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-briefcase" aria-hidden="true"></i>
			</span><br>Vehicle</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-comment" aria-hidden="true"></i>
			</span><br>Wallet</a> </li>
								<li><a href="javascript:void(0);"><span><i class="fa fa-phone" aria-hidden="true"></i>
			</span><br>General</a> </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
	?>

	<!--Mega Menu Ends Here!-->
	<!--Main section  starts Here!-->
	<rn:condition show_on_pages="home, dealer/login, employee/login, customer/login"/>
		<div class="home-image">
		<rn:condition_else/>
		<div>
	</rn:condition>
	<div class="container">
		<div class="clearfix"></div>
		<rn:page_content/>
		<div class="clearfix"></div>
	</div>
</div>

<!--Main section  Ends Here!-->
<div class="clearfix"></div>
<div class="footer-container">
	<div class="footer-menu">
		<ul>
			<li>Copyright &copy;
				<?php echo date('Y');?> All rights reserved by TVS Credit Services Limited.</li>
			<li> <a href="http://www.tvscredit.co.in/termsandcondition.aspx" target="_blank">Terms and Conditions</a> | <a href="http://www.tvscredit.co.in/privacypolicy.aspx" target="_blank">Privacy Policy</a>
			</li>
			<li> <a href="mailto:helpdesk@tvsc.co.in"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;helpdesk@tvsc.co.in</a>
			</li>
		</ul>
	</div>

</div>
<!--Css and Javascript file starts here-->

<script>
	$(document).ready(function() {
		$('.datatable_display').DataTable();
	});
</script>
<!--Css and Javascript files ends here-->
</body>

</html>