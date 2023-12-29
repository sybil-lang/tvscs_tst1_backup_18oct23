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

class EmployeeCustom extends \RightNow\Controllers\Base {

  //This is the constructor for the custom controller. Do not modify anything within
  //this function.
  function __construct() {
    parent::__construct();
    $this->load->library("Nusoap_lib");
    $this->load->helper('report');
    //$this->wsdlURL = 'https://tvscscrmuatservice.tvscredit.com/CRMService.svc?wsdl';
    $this->wsdlURL = 'https://tvscscrmservice.tvscredit.com/CRMService.svc?wsdl';
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
  
  function rest_api_call_drop() {
    $agmt = $_REQUEST["ag_no"];
    // if($_REQUEST["method_val"]=="getMandateStatuses"){
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
          CURLOPT_POSTFIELDS =>"{\r\n\t\"AgreementNo\":\"$agmt\"\r\n}",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);
        if($curl_error){
          print_r($curl_error);
        }
        else{
          // header('Content-type:application/json;charset=utf-8');
          print_r($response);
        }
    // }
  }

  function getloantype()
  {
      $report_id=100771;
      $agg=$_POST['c_agreement'];
      $agreement_number= new RNCPHP\AnalyticsReportSearchFilter;
      $agreement_number->Name = 'Agreement No';
      $agreement_number->Values = array( $agg );
      $filters = new RNCPHP\AnalyticsReportSearchFilterArray;
      $filters[] = $agreement_number;
      $ar= RNCPHP\AnalyticsReport::fetch( $report_id);
      $arr= $ar->run( 0, $filters );
      $nrows= $arr->count();
      
      if($nrows)
      {
        print_r("True");
      }
      else
      {
       print_r("False");
      }
  }

  function rest_api_report_employeeportal_customer_mandate()
{
  $id = $_REQUEST["ag_no"];
  ?>
  <script type="text/javascript">
              
          // $(document).ready(function (){
                      
                 var show_card = false;
                 var show_card2 = false;

                    
                 // $('#i_detail').trigger('change');
                 // $('#i_detail').change(function()
                 // {
                                      $('#idload').css("display","block");

                                      // var id= $(this).val(); 
                                      //     if($(this).val()!='0'){

                                            // if(id!="--Select--"){
                                                  
                                            
                                          console.log("here");
                                         $.post( "/cc/EmployeeCustom/rest_api_call_drop", {ag_no : '<?php echo $id;?>' , method_val : 'getMandateStatuses'})
                                         .done(function( data ) {
                                                    var json_response = JSON.parse(data);
                                                    console.log(json_response);
                                                    // console.log(json_response[0].Agment_NO);
                                                  //       console.log(json_response[0].Blank_mandate);
                                       //       console.log(json_response[0].Noc_mandate);
                                  

                                      $('.text1').html("<p><strong style='color:#003c7d;'>Prefilled Mandate:</strong> Please download the Prefilled mandate document.  Attest your signature as per your bank records and send it to our address: TVS Credit Services, 2nd Floor, Bristol Tower, 10 South Phase, Thiruvika Industrial Estate, Guindy Chennai-600 032</p>");
                                      $('.text12').html("<p><a href='https://tvscscrmservice.tvscredit.com/CRMService.svc/Blank_mandate/<?php echo $id; ?>' class='live-cust'  style='display: none;' download><img src='/euf/assets/images/pdficon.png' width='100' height='110'> Download</a><br><strong style='color:#003c7d;'>Blank Mandate:</strong> Please download the blank mandate. Fill the appropriate bank details as required, sign it as per your bank records and send it to our address: TVS Credit Services, 2nd Floor, Bristol Tower, 10 South Phase, Thiruvika Industrial Estate, Guindy Chennai-600 032</p>");
                                      $('.text2').html("");
                                      
                                      $('#dwnbtn').html("<a href='https://rmsnew.tvscredit.com/rms/Jasper?AGRNO=<?php echo $id; ?>&report=NOC_FOR_CDPORTFOLIO.pdf' class='no-due' id='no-due' target='_blank' download><img src='/euf/assets/images/pdficon.png' width='100' height='110'><p style='padding-left:18px;padding-top:4px;'>Download</p></a>");
                                      $('#filledbtn').html("<a href='https://tvscscrmservice.tvscredit.com/CRMService.svc/GetFilledForm_ECS/<?php echo $id; ?>' class='req-cust' id='req-cust' target='_blank' download><img src='/euf/assets/images/pdficon.png' width='100' height='110'><p style='padding-left:18px;padding-top:4px;'>Download</p></a>");
                                      if((json_response[0].Blank_mandate == "N" && json_response[0].Fill_mandate == "N" && json_response[0].Noc_mandate == "N") || (json_response[0].Blank_mandate == "" && json_response[0].Fill_mandate == "" && json_response[0].Noc_mandate == "") || (json_response[0].Blank_mandate == "" && json_response[0].Fill_mandate == "" && json_response[0].Noc_mandate == "N") ){
                                        $('.not-applicable').html("Selected Loan Account is not live. This option is not applicable.");
                                        $('.not-applicable').show();
                                        $(".card1").hide();
                                        $(".card2").hide();
                                      }
                                      else{
                                        $('.not-applicable').hide();
                                        if(json_response[0].Blank_mandate == "Y"){
                                          $('.live-cust').show();
                                          $('.text12').show();
                                          show_card = true;
                                        }
                                        else{
                                          $('.live-cust').hide();
                                          $('.text12').hide();
                                        }

                                        if(json_response[0].Fill_mandate == "Y"){
                                          $('.req-cust').show();
                                          $('.text1').show();
                                          show_card = true;
                                        }
                                        else{
                                          $('.req-cust').hide();
                                          $('.text1').hide();
                                        }
                                        if(json_response[0].Blank_mandate != "Y" && json_response[0].Fill_mandate != "Y" ){
                                          show_card = false;
                                        }
                                        if(json_response[0].Noc_mandate == "Y" ){
                                          $('#dwnbtn').show();
                                          show_card2 = true;
                                        }
                                        else{
                                          $('#dwnbtn').hide();
                                          show_card2 = false;
                                        }
                                        if(show_card == true){
                                          $('.card1').show();
                                        }
                                        else{
                                          $('.card1').hide();
                                        }
                                        // alert(show_card2 +" and "+ id);
                                        if(show_card2 == true){
                                          $('.card2').show();
                                        }
                                        else{
                                          $('.card2').hide();
                                        }
                                      }
                            }); 

          </script>
          <?php
}

  function getEmployeePieData() {

    $labels = array('Logged in' => "label-important", 'Closed' => "label-success", 'Pending with initiator / internal team' => "label-info", 'Response Awaited' => "label-warning", "New" => "label-important");
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incidents);
    $report_id = $msg->Value;
    //$c_id =3;
    $c_id = $this->session->getProfileData("c_id");
    //$report_id = '100051';
    //$idreport = $_REQUEST['id_of_report'];
    $response_data = array('type' => 'pie', 'name' => 'Total Incidents');
    if ($report_id > 0) {
      $filter = array('Contact_Id' => $c_id);
      $report_result = $this->model('custom/Login')->report_result($report_id, $filter);
      //print_r($report_result); exit;
      $inc_count = count($report_result);
      $closed = $loggedin = $pending = 0;
      $counter = $new = 0;
      $response_awaited = 0;
      //for($i = 0; $i < $inc_count; $i++) {
      $html_data = '';
      foreach ($report_result as $key => $response) {

        if ($response['Status'] == "New") {
          ++$new;
        } elseif ($response['Status'] == "Closed") {
          ++$closed;
        } else if ($response['Status'] == "Logged in") {
          ++$loggedin;
        } else if ($response['Status'] == "Pending with initiator / internal team") {
          ++$pending;
        } else if ($response['Status'] == "Response Awaited") {
          ++$response_awaited;
        }
        //		if($counter < 10){
        /* 	$html_data .= '<div class="ticket">
          <span class="label '.$labels[$response['Status']].'">'.$response['Status'].'</span>
          <a href="'.$site_url.'/app/employee/account/questions/detail/i_id/'.$response['Incident ID'].'">'.$response['Subject'].' <span>['.$response['Reference #'].']</span></a>
          <span class="opened-by">

          '.$response['Date Raised'].'
          </span>
          </div>'; */
        $html_data[] = array($response['Incident ID'], $response['Reference #'], $response['Status'], '<a href="' . $site_url . '/app/employee/account/questions/detail/i_id/' . $response['Incident ID'] . '">' . $response['Subject'] . '</a>', $response['Date Raised']);
        //	}
        $counter++;
      }
      $stats_data = '
										<h3 class="box-header">
											<i class="icon-signal"></i>
											Total Incident Statistics
										</h3>
										<div class="box no-border no-padding widget-statistics">
				
													<div class="rounded-borders">
														<div class="counter small">
															<span>
															' . $closed . '
															</span>
														</div>
														<div class="counter-label">
															Closed
														</div>
													</div>
													
													<div class="rounded-borders">
														<div class="counter small">
															<span>
															' . $loggedin . '
															</span>
														</div>
														<div class="counter-label">
															Logged in
														</div>
													</div>
													
													<div class="rounded-borders">
														<div class="counter small">
															<span>
															' . $pending . '
															</span>
														</div>
														<div class="counter-label">
															Pending with initiator / internal team
														</div>
													</div>
													
													<div class="rounded-borders">
														<div class="counter small">
															<span>
															' . $response_awaited . '
															</span>
														</div>
														<div class="counter-label">
															Response Awaited
														</div>
													</div>
													
													<div class="rounded-borders">
														<div class="counter small">
															<span>
															' . $new . '
															</span>
														</div>
														<div class="counter-label">
															New
														</div>
													</div>
													
													
												</div>';
      //$pie_chart = array(array("Status","Values"),array("Closed",$closed),array("Logged in",$loggedin),array("Pending with initiator / internal team",$pending),array("Response Awaited",$response_awaited));
      $response_data['data'] = array(array("Closed", $closed), array("Logged in", $loggedin), array("Pending with initiator / internal team", $pending), array("Response Awaited", $response_awaited), array("New", $new));
      $response_data['htmlData'] = $html_data;
      $response_data['statisticsData'] = $stats_data;
      $response_data['total'] = $closed + $loggedin + $pending + $response_awaited + $new;
      //json_encode($pie_chart)
    }
    print_r(json_encode($response_data));
  }

  /*
    Get Dealer Incidents
   */

  function getDealerIncidentPieData() {

    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $dealerCode = $_POST['dealerCode'];
    $labels = array('Logged in' => "label-important", 'Closed' => "label-success", 'Pending with initiator / internal team' => "label-info", 'Response Awaited' => "label-warning", "New" => "label-important");
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_EmpPortal_IncidentDealer);
    $report_id = $msg->Value;
    //$c_id =3;
    $c_id = $this->session->getProfileData("c_id");
    //$report_id = '100051';

    $response_data = array('type' => 'pie', 'name' => 'Total Incidents');
    if ($report_id > 0) {
      $filter = array('Internal Employee' => $c_id, 'Dealer ID' => $dealerCode);
      $report_result = $this->model('custom/Login')->report_result($report_id, $filter, true);
      //print_r($report_result); exit;
      $inc_count = count($report_result);
      $closed = $loggedin = $pending = 0;
      $counter = $new = 0;
      $response_awaited = 0;
      //for($i = 0; $i < $inc_count; $i++) {
      foreach ($report_result as $key => $response) {

        if ($response['Status'] == "New") {
          ++$new;
        } elseif ($response['Status'] == "Closed") {
          ++$closed;
        } else if ($response['Status'] == "Logged in") {
          ++$loggedin;
        } else if ($response['Status'] == "Pending with initiator / internal team") {
          ++$pending;
        } else if ($response['Status'] == "Response Awaited") {
          ++$response_awaited;
        }
      }
      $response_data['data'] = array(array("Closed", $closed), array("Logged in", $loggedin), array("Pending with initiator / internal team", $pending), array("Response Awaited", $response_awaited), array("New", $new));
      //json_encode($pie_chart)
    }
    print_r(json_encode($response_data));
  }

  /*
    TA Dealer Data API
   */

  function getTADealerIncidentPieData() {

    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $dealerCode = $_POST['dealerCode'];
    $labels = array('Logged in' => "label-important", 'Closed' => "label-success", 'Pending with initiator / internal team' => "label-info", 'Response Awaited' => "label-warning", "New" => "label-important");
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_TA_Dealer_Incidents);
    $report_id = $msg->Value;
    //$report_id = 100122;
    //$c_id =3;
    $c_id = $this->session->getProfileData("c_id");
    //$report_id = '100051';
    //$idreport = $_REQUEST['id_of_report'];

    $response_data = array('type' => 'pie', 'name' => 'Total TA Requests');
    if ($report_id > 0) {
      $filter = array('Contact ID' => $c_id, 'Dealer Code' => $dealerCode);
      $report_result = $this->model('custom/Login')->report_result($report_id, $filter, true);
      //print_r($report_result); exit;
      $inc_count = count($report_result);
      $closed = $loggedin = $pending = 0;
      $counter = $new = 0;
      $response_awaited = 0;
      //for($i = 0; $i < $inc_count; $i++) {
      foreach ($report_result as $key => $response) {

        if ($response['Status'] == "New") {
          ++$new;
        } elseif ($response['Status'] == "Closed") {
          ++$closed;
        } else if ($response['Status'] == "Logged in") {
          ++$loggedin;
        } else if ($response['Status'] == "Pending with initiator / internal team") {
          ++$pending;
        } else if ($response['Status'] == "Response Awaited") {
          ++$response_awaited;
        }
      }
      $response_data['data'] = array(array("Closed", $closed), array("Logged in", $loggedin), array("Pending with initiator / internal team", $pending), array("Response Awaited", $response_awaited), array("New", $new));
      //json_encode($pie_chart)
    }
    print_r(json_encode($response_data));
  }

  /*
   *  Raise a Dealer Query
   */

  function raiseQueryRequest() {

    $contactId = $_POST['contact_id'];
    $dealer_code = $_POST['dealer_codes'];
    //$amountReq = $_POST['maximum_amount'];
    //$userData=$this->session->getSessionData("userProfile");
    //print_r($_POST);
    $c_id = $this->session->getProfileData("c_id");
    try {
      $incident = new RNCPHP\Incident();

      $incident->Subject = $_POST['Incident_Subject'];

      //	$incident->Product =  RNCPHP\ServiceProduct::fetch($_POST['formData']['Incident.Product']);

      $incident->Category = RNCPHP\ServiceCategory::fetch($_POST['Incident_Category']);

      $incident->Threads = new RNCPHP\ThreadArray();
      $incident->Threads[0] = new RNCPHP\Thread();
      $incident->Threads[0]->EntryType = new RNCPHP\NamedIDOptList();
      $incident->Threads[0]->EntryType->ID = 4; // Used the ID here. See the Thread object for definition
      $incident->Threads[0]->Text = $_POST['Incident_Threads'];

      //$incident->Language = new RNCPHP\NamedIDOptList();
      //$incident->Language->ID =1;
      //$incident->Mailbox = RNCPHP\Mailbox::fetch(30);
      //	$incident->Organization = RNCPHP\Organization::fetch(8);

      $incident->PrimaryContact = RNCPHP\Contact::fetch($dealer_code); //Required field to create an incident through connect PHP
      $incident->OtherContacts[0] = RNCPHP\Contact::fetch($c_id);
      $incident->CustomFields->CO->CreatedByContact = RNCPHP\Contact::fetch($c_id);
      $incident->Queue = new RNCPHP\NamedIDLabel();
      $incident->Queue->ID = 2;

      //$incident->Severity = new RNCPHP\NamedIDOptList();
      //$incident->Severity->LookupName  = 1;
      /* 	$incident->FileAttachments =new RNCPHP\FileAttachmentIncidentArray();
        $fattach = new RNCPHP\FileAttachmentIncident();
        $fattach->ContentType = "text/text";
        $file = '/tmp/test.txt';
        $fattach->setFile($file);
        $fattach->FileName = "NewFile.txt";
        $incident->FileAttachments[] = $fattach;
       */

      $incident->StatusWithType = new RNCPHP\StatusWithType();
      $incident->StatusWithType->Status = new RNCPHP\NamedIDOptList();
      $incident->StatusWithType->Status->ID = 1;

      //\RightNow\Connect\v1_3\CO\City::fetch( "$city" );
      /* if(strlen($dealer_code)){
        $incident->CustomFields->c->dealer_code = $dealer_code;
        } */
      $incident->save();
      //echo "Incident Created";
      $responseArray[] = array('value_id' => $incident->ID, 'value_refno' => $incident->ReferenceNumber);
      //$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);
      //$this->model('custom/EmpSession')->updateEmpDealerSessionData($dealer_code);
      print_r(json_encode($responseArray));
    } catch (Exception $err) {
      echo json_encode($err->getMessage());
    }
  }

  /*

   */

  function getEmployeeCustomerPieData() {

    $labels = array('Logged in' => "label-important", 'Closed' => "label-success", 'Pending with initiator / internal team' => "label-info", 'Response Awaited' => "label-warning", "New" => "label-important");
    //$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_INTERNAL_EMPLOYEE_DEALER_CUSTOMER_INCIDENTS);
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_EmpPortal_IncidentCustomer);

    $report_id = $msg->Value;
    //$c_id =3;
    $c_id = $this->session->getProfileData("c_id");
    //$report_id = '100051';
    //$idreport = $_REQUEST['id_of_report'];
    $response_data = array('type' => 'pie', 'name' => 'Total Incidents');
    if ($report_id > 0) {
      $filter = array('Internal Employee' => $c_id);
      $report_result = $this->model('custom/Login')->report_result($report_id, $filter);
      //	print_r($report_result); exit;
      $inc_count = count($report_result);
      $closed = $loggedin = $pending = 0;
      $counter = $new = 0;
      $response_awaited = 0;
      //for($i = 0; $i < $inc_count; $i++) {
      $html_data = '';
      foreach ($report_result as $key => $response) {

        if ($response['Status'] == "New") {
          ++$new;
        } elseif ($response['Status'] == "Closed") {
          ++$closed;
        } else if ($response['Status'] == "Logged in") {
          ++$loggedin;
        } else if ($response['Status'] == "Pending with initiator / internal team") {
          ++$pending;
        } else if ($response['Status'] == "Response Awaited") {
          ++$response_awaited;
        }
        //if($counter < 10){

        /* 		$html_data[] = array('Dealer ID' => $response['Dealer ID'],'Dealer Name' => $response['Dealer Name'],'Customer ID' =>$response['Customer ID'],'Customer Name' => $response['Customer Name'],'Reference #' => '<a href="'.$site_url.'/app/employee/account/questions/detail/i_id/'.$response['Incident ID'].'">'.$response['Reference #'].'</a>','Status' => $response['Status'],'Status Type' => $response['Status Type'],'Subject' => $response['Subject'], 'Date Created' => $response['Date Created']); */

        $html_data[] = array($response['Customer Name'], '<a href="' . $site_url . '/app/employee/customer/questions/detail/ci_id/' . $response['Incident ID'] . '">' . $response['Reference #'] . '</a>', $response['Status'], $response['Status Type'], $response['Subject'], $response['Date Created']);
        //}
        //$counter++;
      }
      //$pie_chart = array(array("Status","Values"),array("Closed",$closed),array("Logged in",$loggedin),array("Pending with initiator / internal team",$pending),array("Response Awaited",$response_awaited));

      $stats_data = '
										<h3 class="box-header">
											<i class="icon-signal"></i>
											Total Incident Statistics
										</h3>
										<div class="box no-border no-padding widget-statistics">
				
													<div class="rounded-borders">
														<div class="counter small">
															<span>
															' . $closed . '
															</span>
														</div>
														<div class="counter-label">
															Closed
														</div>
													</div>
													
													<div class="rounded-borders">
														<div class="counter small">
															<span>
															' . $loggedin . '
															</span>
														</div>
														<div class="counter-label">
															Logged in
														</div>
													</div>
													
													<div class="rounded-borders">
														<div class="counter small">
															<span>
															' . $pending . '
															</span>
														</div>
														<div class="counter-label">
															Pending with initiator / internal team
														</div>
													</div>
													
													<div class="rounded-borders">
														<div class="counter small">
															<span>
															' . $response_awaited . '
															</span>
														</div>
														<div class="counter-label">
															Response Awaited
														</div>
													</div>
													
													<div class="rounded-borders">
														<div class="counter small">
															<span>
															' . $new . '
															</span>
														</div>
														<div class="counter-label">
															New
														</div>
													</div>
													
													
												</div>';
      $response_data['data'] = array(array("Closed", $closed), array("Logged in", $loggedin), array("Pending with initiator / internal team", $pending), array("Response Awaited", $response_awaited), array("New", $new));
      $response_data['htmlData'] = $html_data;
      $response_data['statisticsData'] = $stats_data;
      //json_encode($pie_chart)
    }
    print_r(json_encode($response_data));
  }

  /*
    Get All Employee Customers Agreement Number

   */

  function getEmployeeCustomerAgreements() {

    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_AgreementNo_EmployeeBasis);
    $report_id = $msg->Value;
    //$c_id =3;
    $c_id = $this->session->getProfileData("c_id");
    if ($report_id > 0) {
      $filter = array('Contact ID' => $c_id);
      $report_result = $this->model('custom/Login')->report_result($report_id, $filter);
//					print_r($report_result);
      $responseData = array();
      foreach ($report_result as $key => $response) {
        $responseData[] = array('name' => $response['Agreement No'], 'Agreement_No' => $response['Agreement No']);
      }
      print_r(json_encode($responseData));
    }
  }

  /*
    Function to Save Lead Employee
   */

  function saveLeadData() {

    load_curl();
    $employee = $this->session->getProfileData("login");
    $postdata = $_POST;
    $email = $postdata['email'];
    $mobile = $postdata['mobile'];
    $action = $postdata['clickaction'];
    $loan_type = $postdata['loan_type'];
    $emp_code = $employee;
    $url = 'https://leadsservice.tvscredit.com/TVSCSLMSAPI.svc';

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
        'CampaignCode' => $postdata['CampaignCode'],
        'EmpNo' => $emp_code
    );
    //print_r($params);
    $LMS_result = soap_lead_rest_call('InsertLMSData', $params);
    //	print_r(json_encode($LMS_result));exit;
    //echo '<p>Thanks for submitting your details. Your reference number is '.$LMS_result['InsertLMSDataResult'].'. We will get back to you soon. <a href="/app/employee/dashboard">Click here</a> to go back.</p>';
    $LMS_result = json_decode($LMS_result);
    echo json_encode($LMS_result['InsertLMSDataResult']);
    //header("Location: /app/employee/new_lead_thanks/ref_id/".$LMS_result['InsertLMSDataResult']);
    //	exit;
  }

  /*
    Show Lead Status
   */

  function getEmployeeLeadData() {

    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $empCode = $_POST['employee_code'];
    $methodName = $_POST['method'];
    $year = date("Y", strtotime($startDate));
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_TVS_API_URL);
    //echo $tvsapiurl = $msg->Value;
    $tvsapiurl = 'https://leadsservice.tvscredit.com/TVSCSLMSAPI.svc?wsdl';
    $arrParam = array('FromDate' => $startDate, 'ToDate' => $endDate, "EmpNo" => $empCode);
    $leadSummary = soap_lead_call($methodName, $arrParam, $tvsapiurl);

    if (!empty($leadSummary['GetVReferralDetailsResult'])) {
      $response[] = $leadSummary['GetVReferralDetailsResult']['LMS_Referral_Entity'];
    } else {
      $response = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
    }
    print_r(json_encode($response));
  }

  function reloadLeadSoapData() {

    $startDate = $_REQUEST['start_date'];
    $endDate = $_REQUEST['end_date'];
    $empCode = $_REQUEST['employee_code'];
    $methodName = $_REQUEST['method'];
    $year = date("Y", strtotime($startDate));
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_TVS_API_URL);
    //$tvsapiurl = $msg->Value;
    $tvsapiurl = 'https://leadsservice.tvscredit.com/TVSCSLMSAPI.svc?wsdl';
    $arrParam = array('FromDate' => $startDate, 'ToDate' => $endDate, "EmpNo" => $empCode);
    $leadSummary = soap_lead_call($methodName, $arrParam, $tvsapiurl);

    if (!empty($leadSummary['GetVReferralDetailsResult'])) {
      $response[] = $leadSummary['GetVReferralDetailsResult']['LMS_Referral_Entity'];
    } else {
      $response = array("sEcho" => 0, "iTotalRecords" => "0", "iTotalDisplayRecords" => "0", "aaData" => array());
    }
    print_r(json_encode($response));
  }

  /*
    Set Dealer Code Session
   */

  function setDealerCode() {


    if (isset($_POST['dealer_codes']) && !empty($_POST['dealer_codes'])) {

      $msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy);
      $report_id = $msg_a->Value;
      //	$userProfile['dealer_codes'] = $_POST['dealer_codes'];
      //	$this->session->setSessionData(array('userProfile'=>$userProfile));
      $cust_id = $this->session->getProfileData("c_id");
      //$filter = array("Employee_Id" => $cust_id);
      $filter = array();
      $report_results = report_result($report_id, $filter);
      $dealer_array = array();
      foreach ($report_results as $key => $resultData) {
        if ($_POST['dealer_codes'] == $resultData['Dealer Code']) {
          //$this->model('custom/EmpSession')->updateSessionData($_POST['dealer_codes']);
          $dealer_name = $resultData['Full Name'];
          $dealer_ID = $resultData['Dealer ID'];
          break;
        }
        //$dealer_array[] = $resultData['Dealer Code'];
      }
      $this->model('custom/EmpSession')->updateSessionData($_POST['dealer_codes'], $dealer_name, $dealer_ID);
      echo $_POST['dealer_codes'];
    } else {
      echo '0';
    }
  }

  /*
    Set Employee Code
   */

  function setAgreementCode() {

    if (isset($_POST['agreement_number']) && !empty($_POST['agreement_number'])) {

      $this->model('custom/EmpSession')->updateEmpSessionData($_POST['agreement_number']);
      echo $_POST['agreement_number'];
    } else {
      echo '0';
    }
  }

  /*

   */

  function setCustomerCode() {
    if (isset($_POST['customer_id']) && !empty($_POST['customer_id'])) {

      $agreementNumber = $_POST['agreement_no'];
      $customer_id = $_POST['customer_id'];
      //$msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_AgreementNo_EmployeeBasis);
      /* 	$msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy_Customer);
        $report_id= $msg_a->Value;

        $cust_id=$this->session->getProfileData("c_id");
        //$filter = array("Contact ID" => $cust_id);
        if(!empty($_REQUEST['query'])){
        $filter=array('Agreement Number'=>$_REQUEST['query']);
        }else{
        $filter=array();
        }
        $report_results=report_result($report_id,$filter);
        //print_r($report_results); exit;
        $customer_array = array();
        $customer_id = $agreementNumber = '';
        foreach($report_results as $key => $resultData){
        if($_POST['customer_id'] == $resultData['Customer']){
        //$this->model('custom/EmpSession')->updateSessionData($_POST['dealer_codes']);
        $agreementNumber = $resultData['Agreement No'];
        $customer_id = $resultData['Customer'];
        break;
        }
        //$dealer_array[] = $resultData['Dealer Code'];
        } */

      $this->model('custom/EmpSession')->updateEmpCustomerSessionData($customer_id);
      $this->model('custom/EmpSession')->updateEmpSessionData($agreementNumber);
      echo $_POST['customer_id'];
    } else {
      echo '0';
    }
  }

  /*

   */

  function setDealerId() {
    if (isset($_POST['dealer_id']) && !empty($_POST['dealer_id'])) {

      $this->model('custom/EmpSession')->updateEmpDealerSessionData($_POST['dealer_id']);
      echo $_POST['dealer_id'];
    } else {
      echo '0';
    }
  }

  /*
    Get Customer Incidents List on Customer Contact ID
   */

  function getCustomerIncidents() {

    $labels = array('Logged in' => "label-important", 'Closed' => "label-success", 'Pending with initiator / internal team' => "label-info", 'Response Awaited' => "label-warning", "New" => "label-important");
    //$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_INTERNAL_EMPLOYEE_DEALER_CUSTOMER_INCIDENTS);
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_EmpPortal_IncidentCustomer);
    $report_id = $msg->Value;
    //$c_id =3;
    $cust_id = $this->session->getProfileData("c_id");
    $c_id = $_POST['cid'];
    $response_data = array('type' => 'pie', 'name' => 'Total Incidents');
    if ($report_id > 0) {
      if (!empty($c_id)) {
        $filter = array('Internal Employee' => $cust_id, 'Customer ID' => $c_id);
        //$filter=array('Customer ID'=>$c_id);
      } else {
        $filter = array('Internal Employee' => $cust_id);
        //$filter=array();
      }
      $report_result = $this->model('custom/Login')->report_result($report_id, $filter);
      //	print_r($report_result); exit;
      $inc_count = count($report_result);
      $closed = $loggedin = $pending = 0;
      $counter = $new = 0;
      $response_awaited = 0;
      //for($i = 0; $i < $inc_count; $i++) {
      $html_data = '';
      foreach ($report_result as $key => $response) {

        if ($response['Status'] == "New") {
          ++$new;
        } elseif ($response['Status'] == "Closed") {
          ++$closed;
        } else if ($response['Status'] == "Logged in") {
          ++$loggedin;
        } else if ($response['Status'] == "Pending with initiator / internal team") {
          ++$pending;
        } else if ($response['Status'] == "Response Awaited") {
          ++$response_awaited;
        }
        //, $response['Dealer Name']
        $html_data[] = array($response['Incident ID'], $response['Customer Name'], $response['Reference #'], '<a href="' . $site_url . '/app/employee/customer/questions/detail/ci_id/' . $response['Incident ID'] . '">' . $response['Subject'] . '</a>', $response['Status'], $response['Status Type'], $response['Date Created']);
        //	}
        $counter++;
      }
      //$pie_chart = array(array("Status","Values"),array("Closed",$closed),array("Logged in",$loggedin),array("Pending with initiator / internal team",$pending),array("Response Awaited",$response_awaited));
      $response_data['data'] = array(array("Closed", $closed), array("Logged in", $loggedin), array("Pending with initiator / internal team", $pending), array("Response Awaited", $response_awaited), array("New", $new));
      $response_data['htmlData'] = $html_data;
      //json_encode($pie_chart)
    }
    print_r(json_encode($response_data));
  }

  /*
    Get Dealer Incidents List on Dealer Contact ID

   */

  function getDealerIncidents() {

    $labels = array('Logged in' => "label-important", 'Closed' => "label-success", 'Pending with initiator / internal team' => "label-info", 'Response Awaited' => "label-warning", "New" => "label-important");
    //$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_INTERNAL_EMPLOYEE_DEALER_INCIDENTS);
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_EmpPortal_IncidentDealer);
    $report_id = $msg->Value;
    //$c_id =3;
    $cust_id = $this->session->getProfileData("c_id");
    $d_id = $_POST['did'];
    $response_data = array('type' => 'pie', 'name' => 'Total Incidents');
    if ($report_id > 0) {
      if (!empty($d_id)) {
        $filter = array('Internal Employee' => $cust_id, 'Dealer ID' => $d_id);
        //$filter=array('Dealer ID'=>$d_id);
      } else {
        $filter = array('Internal Employee' => $cust_id);
        //$filter=array();
      }
      $report_result = $this->model('custom/Login')->report_result($report_id, $filter);
      //	print_r($report_result); exit;
      $inc_count = count($report_result);
      $closed = $loggedin = $pending = 0;
      $counter = $new = 0;
      $response_awaited = 0;
      //for($i = 0; $i < $inc_count; $i++) {
      $html_data = '';
      foreach ($report_result as $key => $response) {

        if ($response['Status'] == "New") {
          ++$new;
        } elseif ($response['Status'] == "Closed") {
          ++$closed;
        } else if ($response['Status'] == "Logged in") {
          ++$loggedin;
        } else if ($response['Status'] == "Pending with initiator / internal team") {
          ++$pending;
        } else if ($response['Status'] == "Response Awaited") {
          ++$response_awaited;
        }

        $html_data[] = array($response['Incident ID'], $response['Dealer Name'], $response['Reference #'], '<a href="' . $site_url . '/app/employee/dealer/questions/detail/di_id/' . $response['Incident ID'] . '">' . $response['Subject'] . '</a>', $response['Status'], $response['Status Type'], $response['Date Created']);
        //	}
        $counter++;
      }
      //$pie_chart = array(array("Status","Values"),array("Closed",$closed),array("Logged in",$loggedin),array("Pending with initiator / internal team",$pending),array("Response Awaited",$response_awaited));
      $response_data['data'] = array(array("Closed", $closed), array("Logged in", $loggedin), array("Pending with initiator / internal team", $pending), array("Response Awaited", $response_awaited), array("New", $new));
      $response_data['htmlData'] = $html_data;
      //json_encode($pie_chart)
    }
    print_r(json_encode($response_data));
  }

  /*
   *  Raise a Dealer Query
   */

  function raiseCustomerQueryRequest() {

    if (isset($_POST['agreement_no']) && !empty($_POST['agreement_no'])) {
      $contactId = $_POST['contact_id'];
      list($agg_no, $cid) = explode("_", $_POST['selectedLoan']);

      //$amountReq = $_POST['maximum_amount'];
      //$userData=$this->session->getSessionData("userProfile");
      //print_r($_POST);
      $cust_id = $this->session->getProfileData("c_id");
      try {
        $incident = new RNCPHP\Incident();

        $incident->Subject = $_POST['Incident_Subject'];

        if (strlen(trim($_POST['formData']['Incident.Product']))) {
          $incident->Product = RNCPHP\ServiceProduct::fetch($_POST['formData']['Incident.Product']);
        }

        if (strlen(trim($_POST['formData']['Incident.Category']))) {
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

        $incident->PrimaryContact = RNCPHP\Contact::fetch($cid); //Required field to create an incident through connect PHP
        $incident->OtherContacts[0] = RNCPHP\Contact::fetch($cust_id);
        $incident->CustomFields->CO->CreatedByContact = RNCPHP\Contact::fetch($cust_id);
        $incident->Queue = new RNCPHP\NamedIDLabel();
        $incident->Queue->ID = 2;

        //$incident->Severity = new RNCPHP\NamedIDOptList();
        //$incident->Severity->LookupName  = 1;

        $incident->StatusWithType = new RNCPHP\StatusWithType();
        $incident->StatusWithType->Status = new RNCPHP\NamedIDOptList();
        $incident->StatusWithType->Status->ID = 1;

        if (strlen($agg_no)) {
          $incident->CustomFields->CO->Loan = \RightNow\Connect\v1_3\CO\Loan::fetch($agg_no);
        }
        $incident->save();
        //echo "Incident Created";
        $responseArray[] = array('value_id' => $incident->ID, 'value_refno' => $incident->ReferenceNumber);
        //	$this->model('custom/EmpSession')->updateEmpCustomerSessionData($cid);
        //$responseArray[] = array('key' => 'refno', 'value' => $incident->ReferenceNumber);
        print_r(json_encode($responseArray));
      } catch (Exception $err) {
        echo json_encode($err->getMessage());
      }
    }
  }

  /*
    Return List of Employee Dealers
   */

  public function getDealerLists() {

    $CI = &get_instance();
    $contact_id = $CI->session->getProfileData("c_id");

    /*     * ***************************** */
    $msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy);
    $report_id = $msg_a->Value;
    if (!empty($_REQUEST['query'])) {
      $filter = array('Dealer Full Name' => '%' . trim($_REQUEST['query']) . '%');
        
    } else {
      $filter = array();
    }
    //$filter = array();
    $report_results = report_result($report_id, $filter);
    //print_r($report_results);
    $dealer_array = array();
    //$dealer_array[] = array("id"=> 0,'text' => 'Choose One','value' => '');
    foreach ($report_results as $key => $resultData) {

      $dealer_array[] = array("id" => $resultData['Dealer Code'], 'name' => $resultData['Full Name'], 'value' => $resultData['Dealer Code']);
      //$dealer_array[] = $resultData['Dealer Code'];
    }
    //		$dealer_array[] = array("id" => 7033,'name' => 'For testing','value' => '7033');
    //		$dealer_array[] = array("id" => 7036,'name' => 'For testing1','value' => '7036');
    $inputOptions = json_encode($dealer_array);

    print_r($inputOptions);
  }

  /*

   */

  function getIncidentDealerLists() {

    $CI = &get_instance();
    $contact_id = $CI->session->getProfileData("c_id");

    /*     * ***************************** */
    //CUSTOM_MSG_Contact_Hierarchy
    $msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy);
    $report_id = $msg_a->Value;
    $ar = RNCPHP\AnalyticsReport::fetch($report_id);
    $start = 0;
    $limit = 10000;
    $arr_count = 0;
    $report_results = array();
    do {
      $arr = $ar->run($start);
      $arr_count = $arr->count();
      if ($arr_count > 0) {
        for ($i = 0; $i < $arr_count; $i++) {
          $report_results[] = $arr->next();
        }
        $start = $start + $arr_count;
        if ($start >= 200000)
          break;
      }
    }
    while ($arr_count > 0);
    //$report_results=report_result($report_id,$filter);
    //print_r($report_results);
    $dealer_array = array();
    foreach ($report_results as $key => $resultData) {

      $dealer_array[] = array("id" => $resultData['Dealer ID'], 'name' => $resultData['Full Name']." ".$resultData['Dealer Code'], 'value' => $resultData['Dealer Code']);
        
      //$dealer_array[] = $resultData['Dealer Code'];
    }
    $inputOptions = json_encode($dealer_array);
    print_r($inputOptions);
  }

  /* */

  function getTADataList() {

    $startDate = $_REQUEST['startDate'];
    $endDate = $_REQUEST['endDate'];
    $dealerData = $this->session->getSessionData("userProfile");

    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incident_UserStatus);
    $report_id = $msg->Value;
    if ($report_id > 0) {
      $dateArray = array('sdate' => $startDate, 'edate' => $endDate);
      $filter = array('Contact_Id' => $dealerData['employee_d_id']);
      $report_result = $this->model('custom/Login')->report_result($report_id, $filter, $dateArray);

      print_r(json_encode($report_result));
    }
  }

  /*

   */

  function getIncidentCustomerLists() {

    $CI = &get_instance();
    $contact_id = $CI->session->getProfileData("c_id");

    /*     * ***************************** */
    $msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy_Customer);
    $report_id = $msg_a->Value;
    //$filter = array("Employee_Id" => $contact_id);
    if (!empty($_REQUEST['query'])) {
      $filter = array('Agreement Number' => $_REQUEST['query']);
    } else {
      //
      $filter = array();
    }
    //charu chnages
    // $report_id=100984;  //created copy of report and added afilter in this that transferred agr=no or no value
    $report_results = report_result($report_id, $filter);
    // $report_results = report_result($report_id, $filter);
    //print_r($report_results);
    $customer_array = array();
    //$dealer_array[] = array("id"=> 0,'text' => 'Choose One','value' => '');
    if (!empty($report_results)) {
      foreach ($report_results as $key => $resultData) {

        $customer_array[] = array("id" => $resultData['Customer'], 'name' => $resultData['Agreement No'], 'value' => $resultData['Full Name']);
        //$dealer_array[] = $resultData['Dealer Code'];
      }
    }
    //$dealer_array[] = array("id" => 7033,'name' => 'For testing','value' => '7033');
    //$dealer_array[] = array("id" => 7036,'name' => 'For testing1','value' => '7036');
    $inputOptions = json_encode($customer_array);

    print_r($inputOptions);
  }

  /*
    Get Employee Dealer Incident Details
   */

//IARC
//Check if selected agreement is transferred
   function getTransferredAgreement() {

    $CI = &get_instance();
    $contact_id = $CI->session->getProfileData("c_id");

    /*     * ***************************** */
    $msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_all_agreements_list);
    $report_id = $msg_a->Value;
    //$filter = array("Employee_Id" => $contact_id);
    
    if (!empty($_REQUEST['query_ag'])) {
      $filter = array('AgreementNo' => $_REQUEST['query_ag']);
    } else {
      //
      $filter = array();
    }
    //charu chnages
    // $report_id=100984;  //created copy of report and added afilter in this that transferred agr=no or no value
    $response = report_result($report_id, $filter);

    // print_r($response);
    
    if($response[0]['Transferred Agreement'] == 'Yes')
    {
   echo("true");
    }
    else
    {
      echo("false");
    }

    // $report_results = report_result($report_id, $filter);
    //print_r($report_results);
    // $customer_array = array();
    // //$dealer_array[] = array("id"=> 0,'text' => 'Choose One','value' => '');
    // if (!empty($report_results)) {
    //   foreach ($report_results as $key => $resultData) {

    //     $customer_array[] = array("id" => $resultData['Customer'], 'name' => $resultData['Agreement No'], 'value' => $resultData['Full Name']);
    //     //$dealer_array[] = $resultData['Dealer Code'];
    //   }
    // }
    // //$dealer_array[] = array("id" => 7033,'name' => 'For testing','value' => '7033');
    // //$dealer_array[] = array("id" => 7036,'name' => 'For testing1','value' => '7036');
    // $inputOptions = json_encode($customer_array);

    // print_r($inputOptions);
  }
//IARC
  public function getEmployeeDealerIncidentDetail() {

    $html_text = '';
    $dincident_id = $_POST['di_id'];
    $userProfile = $this->session->getSessionData('userProfile');

    $incident = RNCPHP\Incident::fetch($dincident_id);
    //CUSTOM_MSG_Contact_Incident_Thread
    $msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incident_Thread);
    $report_id = $msg_a->Value;
    $filter = array("Incident_Id" => $dincident_id);
    $report_results = report_result($report_id, $filter);
//	print_r($report_results);
    $threads = $incident->Threads;
//		print_r($threads);

    $contact = RNCPHP\Contact::fetch($incident->PrimaryContact->ID);

    $incident_array = array();
    if (!empty($contact->Emails[0]->Address)) {
      // Be sure to instantiate the sub-object
      // if it is not already there
      $html_text .= '<div id="rn_FieldDisplay_37" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Email Address </span><div class="rn_DataValue"><a href="mailto:' . $contact->Emails[0]->Address . '">' . $contact->Emails[0]->Address . '</a></div></div>';
    }
    if (!empty($incident->ReferenceNumber)) {
      $html_text .= '<div id="rn_FieldDisplay_39" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Reference Number </span><div class="rn_DataValue">' . $incident->ReferenceNumber . '</div></div>';
    }
    if (!empty($report_results[0]['Status'])) {
      $html_text .= '<div id="rn_FieldDisplay_41" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Status </span><div class="rn_DataValue">' . $report_results[0]['Status'] . '</div></div>';
    }
    if (!empty($incident->CreatedTime)) {
      $html_text .= '<div id="rn_FieldDisplay_43" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Created </span><div class="rn_DataValue">' . date('d/m/Y H:i:s', $incident->CreatedTime) . '</div></div>   ';
    }
    if (!empty($incident->UpdatedTime)) {
      $html_text .= '<div id="rn_FieldDisplay_45" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Updated </span><div class="rn_DataValue">25/01/2017 04.47 PM</div></div>';
    }
    if (!empty($report_results[0]['Category'])) {
      $html_text .= '<div id="rn_FieldDisplay_45" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Category </span><div class="rn_DataValue">' . $report_results[0]['Category'] . '</div></div>';
    }
    if (!empty($report_results[0]['Product'])) {
      $html_text .= '<div id="rn_FieldDisplay_45" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Product </span><div class="rn_DataValue">' . $report_results[0]['Product'] . '</div></div>';
    }
    if (!empty($incident->Channel->LookupName)) {
      $html_text .= '<div id="rn_FieldDisplay_54" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Request Type </span><div class="rn_DataValue">' . $incident->Channel->LookupName . ' </div></div>';
    }

    $thread_Entry_Type = array('Customer' => 'rn_Customer', 'Customer Proxy' => 'rn_Customer', 'Staff Account' => '');
    $threaddata = '<div id="rn_IncidentThreadDisplay_35" class="rn_IncidentThreadDisplay rn_Output">';

    if (!empty($report_results)) {
      foreach ($report_results as $key => $response) {
        $threaddata .= '<div class="rn_ThreadHeader ' . $thread_Entry_Type[$response['Thread Entry Type']] . '">';
        if ($response['Thread Entry Type'] == 'Customer')
          $name = $contact->Name->First . ' ' . $contact->Name->Last;
        else
          $name = $response['Account'];

        $threaddata .= '<span class="rn_ThreadAuthor">' . $response['Thread Entry Type'] . ' (' . $name . ') via channel "' . $response['Channel'] . '"</span><span class="rn_ThreadTime">' . str_replace("'", '', $response['Date Thread Created']) . '</span></div>';
        $threaddata .= '<div class="rn_ThreadContent">' . $response['Text'] . '</div>';
      }
    }
    $threaddata .= '</div>';

    //print_r($incident->FileAttachments);
    $incident_array['subject'] = $incident->Subject;
    $incident_array['additionalInfo'] = $html_text;
    $incident_array['threadArray'] = $threaddata;
    //	print_r( $html_text);
    print_r(json_encode($incident_array));
  }

  /* Get Employee Customer Incident Details */

  public function getEmployeeCustomerIncidentDetail() {

    $html_text = '';
    $cincident_id = $_POST['ci_id'];
    $userProfile = $this->session->getSessionData('userProfile');

    $incident = RNCPHP\Incident::fetch($cincident_id);
    //CUSTOM_MSG_Contact_Incident_Thread
    $msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incident_Thread);
    $report_id = $msg_a->Value;
    $filter = array("Incident_Id" => $cincident_id);
    $report_results = report_result($report_id, $filter);
    //	print_r($report_results);
    $threads = $incident->Threads;
//		print_r($threads);
    $contact = RNCPHP\Contact::fetch($incident->PrimaryContact->ID);

    $incident_array = array();
    if (!empty($contact->Emails[0]->Address)) {
      // Be sure to instantiate the sub-object
      // if it is not already there
      $html_text .= '<div id="rn_FieldDisplay_37" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Email Address </span><div class="rn_DataValue"><a href="mailto:' . $contact->Emails[0]->Address . '">' . $contact->Emails[0]->Address . '</a></div></div>';
    }
    if (!empty($incident->ReferenceNumber)) {
      $html_text .= '<div id="rn_FieldDisplay_39" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Reference Number </span><div class="rn_DataValue">' . $incident->ReferenceNumber . '</div></div>';
    }
    if (!empty($report_results[0]['Status'])) {
      $html_text .= '<div id="rn_FieldDisplay_41" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Status </span><div class="rn_DataValue">' . $report_results[0]['Status'] . '</div></div>';
    }
    if (!empty($incident->CreatedTime)) {
      $html_text .= '<div id="rn_FieldDisplay_43" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Created </span><div class="rn_DataValue">' . date('d/m/Y H:i:s', $incident->CreatedTime) . '</div></div>   ';
    }
    if (!empty($incident->UpdatedTime)) {
      $html_text .= '<div id="rn_FieldDisplay_45" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Updated </span><div class="rn_DataValue">25/01/2017 04.47 PM</div></div>';
    }
    if (!empty($report_results[0]['Category'])) {
      $html_text .= '<div id="rn_FieldDisplay_45" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Category </span><div class="rn_DataValue">' . $report_results[0]['Category'] . '</div></div>';
    }
    if (!empty($report_results[0]['Product'])) {
      $html_text .= '<div id="rn_FieldDisplay_45" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Product </span><div class="rn_DataValue">' . $report_results[0]['Product'] . '</div></div>';
    }
    if (!empty($incident->Channel->LookupName)) {
      $html_text .= '<div id="rn_FieldDisplay_54" class="rn_FieldDisplay rn_Output"><span class="rn_DataLabel">Request Type </span><div class="rn_DataValue">' . $incident->Channel->LookupName . ' </div></div>';
    }
    if (!empty($incident->FileAttachments)) {
      $html_text .= '<div id="rn_FileListDisplay_51" class="rn_FileListDisplay rn_Output"><span class="rn_DataLabel">File Attachments</span><div class="rn_DataValue">';

      $html_text .= '<ul>';
      initConnectAPI('RNTpartner_VirtuosIntegration', 'Rightnow!Integration');
      foreach ($incident->FileAttachments as $response) {
        /* print_r($response);
          echo $response->ID;
          echo $response->FileName;
          echo $response->URL;
          echo $response->Name; */
        $html_text .= '<li>
						<a href="' . $response->getAdminUrl() . '" target="_blank">
							
													<span class="rn_FileTypeIcon rn_mht"><span class="rn_ScreenReaderOnly">File Type mht</span></span>                                        
							
							' . $response->FileName . '                    
						</a>
									   
						<span class="rn_FileSize">(' . $response->Size . ' Bytes)</span>
						
									   
					</li>';
      }

      $html_text .= '</ul>
        
   </div>
   
</div>';
    }

    $thread_Entry_Type = array('Customer' => 'rn_Customer', 'Customer Proxy' => 'rn_Customer', 'Staff Account' => '');
    $threaddata = '<div id="rn_IncidentThreadDisplay_35" class="rn_IncidentThreadDisplay rn_Output">';

    if (!empty($report_results)) {
      foreach ($report_results as $key => $response) {
        $threaddata .= '<div class="rn_ThreadHeader ' . $thread_Entry_Type[$response['Thread Entry Type']] . '">';
        if ($response['Thread Entry Type'] == 'Customer')
          $name = $contact->Name->First . ' ' . $contact->Name->Last;
        else
          $name = $response['Account'];

        $threaddata .= '<span class="rn_ThreadAuthor">' . $response['Thread Entry Type'] . ' (' . $name . ') via channel "' . $response['Channel'] . '"</span><span class="rn_ThreadTime">' . str_replace("'", '', $response['Date Thread Created']) . '</span></div>';
        $threaddata .= '<div class="rn_ThreadContent">' . $response['Text'] . '</div>';
      }
    }
    $threaddata .= '</div>';

    //print_r($incident->FileAttachments);
    $incident_array['subject'] = $incident->Subject;
    $incident_array['additionalInfo'] = $html_text;
    $incident_array['threadArray'] = $threaddata;
    //	print_r( $html_text);
    print_r(json_encode($incident_array));
  }

  /* get customer List and Agreement Number on RaiseAQuery */

  public function getCustomerLists() {

    //$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_AgreementNo_EmployeeBasis);
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy_Customer);
    $report_id = $msg->Value;
    //$c_id =3;
    $c_id = $this->session->getProfileData("c_id");
    $customer_array = array();
    //	$agreement_array[] = array('text' => 'Choose One','value' => '');
    //print_r($_REQUEST['query']);exit;
    if ($report_id > 0) {
      if (!empty($_REQUEST['query'])) {
        $filter = array('Agreement Number' => $_REQUEST['query']);
      } else {
        //
        $filter = array();
      }
      $report_result = $report_agg_result = report_result($report_id, $filter);
      //print_r($report_result);

      if (!empty($report_agg_result)) {
        foreach ($report_agg_result as $key => $response) { //$resultData['Full Name']
          //$customer_array[] = array("id" => $response['Agreement No'].'_'.$response['Customer ID'],'name' => strtoupper($response['Agreement No']),'value' => $response['Full Name']);
          $customer_array[] = array("id" => $response['Agreement No'] . '_' . $response['Customer'], 'name' => strtoupper($response['Agreement No']), 'value' => $response['Full Name']);
        }
      }
    }
    $inputOptions = json_encode($customer_array);
    print_r($inputOptions);
  }

  /* get customer List and Agreement Number on RaiseAQuery */

  public function getCustomerAgreementLists() {

    //$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_AgreementNo_EmployeeBasis);
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy_Customer);
    $report_id = $msg->Value;
    //$c_id =3;
    $c_id = $this->session->getProfileData("c_id");
    $customer_array = array();
    //	$agreement_array[] = array('text' => 'Choose One','value' => '');
    //print_r($_REQUEST['query']);exit;
    if ($report_id > 0) {
      if (!empty($_REQUEST['query'])) {
        $filter = array('Agreement Number' => $_REQUEST['query']);
      } else {
        //
        $filter = array();
      }
      $agggg=$_REQUEST['query'];
       if(strlen($agggg)<8)
      {
        // echo "i am here".count($_REQUEST['query']).$_REQUEST['query'];

      }
      else
      {
      $report_result = $report_agg_result = report_result($report_id, $filter);
      //print_r($report_result);

      if (!empty($report_agg_result)) {
        foreach ($report_agg_result as $key => $response) { //$resultData['Full Name']
          //$customer_array[] = array("id" => $response['Agreement No'].'_'.$response['Customer ID'],'name' => strtoupper($response['Agreement No']),'value' => $response['Full Name']);
          $customer_array[] = array("id" => $response['Loan ID'] . '_' . $response['Customer'] . '_' . $response['Full Name'], 'name' => strtoupper($response['Agreement No']), 'code' => $response['Full Name']);
        }
      }
    }
  }
    $inputOptions = json_encode($customer_array);
    print_r($inputOptions);
  }

  public function getCustomerProspectLists() {

    //$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_AgreementNo_EmployeeBasis);
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy_Customer);
    $report_id = $msg->Value;
    //$c_id =3;
    $c_id = $this->session->getProfileData("c_id");
    $customer_array = array();
    //	$agreement_array[] = array('text' => 'Choose One','value' => '');
    //print_r($_REQUEST['query']);exit;
    if ($report_id > 0) {
      if (!empty($_REQUEST['query'])) {
        $filter = array('Prospect_No' => $_REQUEST['query']);
      } else {
        //
        $filter = array();
      }
      $report_result = $report_agg_result = report_result($report_id, $filter);
      //print_r($report_result);

      if (!empty($report_agg_result)) {
        foreach ($report_agg_result as $key => $response) { //$resultData['Full Name']
          //$customer_array[] = array("id" => $response['Agreement No'].'_'.$response['Customer ID'],'name' => strtoupper($response['Agreement No']),'value' => $response['Full Name']);
          $customer_array[] = array("id" => $response['Loan ID'] . '_' . $response['Customer'] . '_' . $response['Full Name'], 'name' => strtoupper($response['Prospect No']), 'code' => $response['Full Name']);
        }
      }
    }
    $inputOptions = json_encode($customer_array);
    print_r($inputOptions);
  }

  /* get Employee Agreement Product */

  function getProduct() {
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch(1000037);
    $agreement_no = $_POST['agg_no'];
    $report_id = $msg->Value;
    list($agg_no, $custid) = explode("_", $agreement_no);
    $prodByAgrNumReport = \RightNow\Connect\v1_3\AnalyticsReport::fetch($report_id);
    $prodByAgrNumReportFilter = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
    $prodByAgrNumReportFilter->Name = "Agreement_No";
    $prodByAgrNumReportFilter->Values = array("$agreement_no");
    $prodByAgrNumReportFilters = new \RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
    $prodByAgrNumReportFilters[0] = $prodByAgrNumReportFilter;
    $prodByAgrNumReportRun = $prodByAgrNumReport->run(0, $prodByAgrNumReportFilters);
    $prodByAgrNumReportRunCount = $prodByAgrNumReportRun->count();
    $prodByAgrNumReportRunRow = $prodByAgrNumReportRun->next();
    echo $prodByAgrNumReportRunRow["Product"];
  }

  /*
   * Generate API Report from Rightnow
   */

  function rest_api_report() {
    //$url = "httpss://RNTpartner_VirtuosNarendra:Rightnow!1@tvscs.custhelp.com/services/rest/connect/v1.3/analyticsReportResults"; 

    $idreport = $_POST['id_of_report'];
    //{"filters":[{"name":"<FilterName>","values":"<filtervalue>"}],"id":<report Id>}
    //{"filters":[{"name":"ContactID","values":"3"}],"id":100010}
    $contact_id = $this->session->getProfileData("c_id");

    //print_r($content );
    load_curl();
    $filter = array('Contact ID' => $contact_id);
    $response = report_result($idreport, $filter);

    $agg_count = count($response);
    $methodval = $_POST['method_val'];
    if ($_REQUEST['filtering_val'] == 'initialloan') {
      echo "<div class='form-group'><select id='i_loan'><option value='0'>--Select--</option>";
      //for($i = 0; $i < $agg_count; $i++ ) {
      foreach ($response as $key => $result) {
        echo '<option value=' . $result['Agreement No'] . '>' . $result['Agreement No'] . '</option>';
      }
      echo '</select></div>';
      ?>
      <script type="text/javascript">
        $(document).ready(function () {
          $('#i_loan').wrap('<div class="select_wrapper"></div>')
          $('#i_loan').parent().prepend('<span>' + $('#i_loan').find(':selected').text() + '</span>');
          $('#i_loan').parent().children('span').width(131);
          $('#i_loan').css('display', 'none');
          $('#i_loan').parent().append('<ul class="select_inner"></ul>');
          $('#i_loan').children().each(function () {
            var opttext = $(this).text();
            var optval = $(this).val();
            $('#i_loan').parent().children('.select_inner').append('<li id="' + optval + '">' + opttext + '</li>');
          });



          $('#i_loan').parent().find('li').on('click', function () {
            var cur = $(this).attr('id');
            $('#i_loan').parent().children('span').text($(this).text());
            $('#i_loan').children().removeAttr('selected');
            $('#i_loan').children('[value="' + cur + '"]').attr('selected', 'selected');
            console.log($('#i_loan').children('[value="' + cur + '"]').text());
            $.post("/cc/AjaxCustom/rest_api_call_drop", {ag_no: $('#i_loan').children('[value="' + cur + '"]').text(), method_val: '<?php echo $methodval; ?>'})
                    .done(function (data) {
                      $("#showresult").html(data);
                    });
          });
          $('#i_loan').parent().on('click', function () {
            $(this).find('ul').slideToggle('fast');
          });
        });
      </script>
      <?php
    } else if ($_REQUEST['filtering_val'] == 'statusofloan') {
      echo "<div class='form-group'><select id='s_loan'><option value='0'>--Select--</option>";
      foreach ($response as $key => $result) {
        echo '<option value=' . $result['Agreement No'] . '>' . $result['Agreement No'] . '</option>';
      }
      echo '</select></div>';
      ?>
      <script type="text/javascript">
        $(document).ready(function () {
          $('#s_loan').wrap('<div class="select_wrapper"></div>')
          $('#s_loan').parent().prepend('<span>' + $('#s_loan').find(':selected').text() + '</span>');
          //alert($('#s_loan').width());
          $('#s_loan').parent().children('span').width(131);
          $('#s_loan').css('display', 'none');
          $('#s_loan').parent().append('<ul class="select_inner"></ul>');
          $('#s_loan').children().each(function () {
            var opttext = $(this).text();
            var optval = $(this).val();
            $('#s_loan').parent().children('.select_inner').append('<li id="' + optval + '">' + opttext + '</li>');
          });



          $('#s_loan').parent().find('li').on('click', function () {
            var cur = $(this).attr('id');
            $('#s_loan').parent().children('span').text($(this).text());
            $('#s_loan').children().removeAttr('selected');
            $('#s_loan').children('[value="' + cur + '"]').attr('selected', 'selected');
            console.log($('#s_loan').children('[value="' + cur + '"]').text());
            $.post("/cc/AjaxCustom/rest_api_call_drop", {ag_no: $('#s_loan').children('[value="' + cur + '"]').text(), method_val: '<?php echo $methodval; ?>'})
                    .done(function (data) {
                      $("#showresult_loan").html(data);
                    });
          });
          $('#s_loan').parent().on('click', function () {
            $(this).find('ul').slideToggle('fast');
          });
        });
      </script>
      <?php
    } else if ($_REQUEST['filtering_val'] == 'instrumentdetails') {
      echo "<div class='form-group'><select id='i_detail'><option value='0'>--Select--</option>";
      foreach ($response as $key => $result) {
        echo '<option value=' . $result['Agreement No'] . '>' . $result['Agreement No'] . '</option>';
      }
      echo '</select></div>';
      ?>
      <script type="text/javascript">
        $(document).ready(function () {
          $('#i_detail').wrap('<div class="select_wrapper"></div>')
          $('#i_detail').parent().prepend('<span>' + $('#i_detail').find(':selected').text() + '</span>');
          $('#i_detail').parent().children('span').width(131);
          $('#i_detail').css('display', 'none');
          $('#i_detail').parent().append('<ul class="select_inner"></ul>');
          $('#i_detail').children().each(function () {
            var opttext = $(this).text();
            var optval = $(this).val();
            $('#i_detail').parent().children('.select_inner').append('<li id="' + optval + '">' + opttext + '</li>');
          });



          $('#i_detail').parent().find('li').on('click', function () {
            var cur = $(this).attr('id');
            $('#i_detail').parent().children('span').text($(this).text());
            $('#i_detail').children().removeAttr('selected');
            $('#i_detail').children('[value="' + cur + '"]').attr('selected', 'selected');
            console.log($('#i_detail').children('[value="' + cur + '"]').text());
            //TN3005TW06877&DATE=22/11/2016&report=Foreclosure_Print
            //$('#i_detail').children('[value="'+cur+'"]').text() 
            $.post("/cc/AjaxCustom/rest_api_call_drop", {ag_no: $('#i_detail').children('[value="' + cur + '"]').text(), method_val: '<?php echo $methodval; ?>'})
                    .done(function (data) {
                      var url_data = JSON.parse(data);
                      if (url_data.message == '') {
                        //console.log(url_data.url_for);
                        // console.log(url_data.url_ins);
                        $("#instrumentdetails_docs").css("display", "block");
                        $("#url_ins").attr("href", url_data.url_ins);
                        $("#url_for").attr("href", url_data.url_for);
                        $("#url_for_soa").attr("href", url_data.soa_for);
                      } else {
                        $("#showresult_instrument").css("display", "block");
                        //	$("#url_ins").attr("href", url_data.url_ins);
                        $("#url_for_n").attr("href", url_data.url_for);
                        $("#url_for_n_soa").attr("href", url_data.soa_for);
                        //	 $( "#showresult_instrument" ).html(url_data.message);

                      }
                    });
          });
          $('#i_detail').parent().on('click', function () {
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


    function soa_download_for_emp()
{
  load_curl();
  $curl = curl_init();
$employeeCode=$_POST['employeeCode'];
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
    "userId" : "CRMUSR",
    "password" : "01d9e6e7da8a8ab3215abae97533d76903b0c678380d3be907b20b0358e37694",
    "soaGeneratedUserid":"'.$employeeCode.'"
  }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));

  $response = curl_exec($curl);



  curl_close($curl);
  $data = $r = json_decode(stripcslashes(trim($response, '"')));

  if($data->root->Result->Status==2)
  {
    echo "no data found";
    // exit();
  }
  else
  {
    // echo "<script>console.log(".$response.")</script>";
// echo $response;
      $agg=$_POST['agg_no'];
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
            "userId" : "CRMUSR",
            "sessionId" : "' . $data->root->Result->SessionId . '",
            "agreementNo" : "'.$agg.'",
            "soaGeneratedUserid":"'.$employeeCode.'"
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

}
