<rn:meta title="Walkin Reports" template="employee_header.php" clickstream="employee_walkin_reports" login_required="true" force_https="true" />
<?php
$CI = &get_instance();
$CI->load->helper('report');
$c_id = $CI->session->getProfileData("c_id");
$contact = \RightNow\Connect\v1_3\Contact::fetch($c_id);
$employeeCode = $contact->CustomFields->c->employee_code;
$md5EmployeeCode = "";
checkCustomerType('internal employee');

try{
  if(strlen($employeeCode)){
    $md5EmployeeCode = md5($employeeCode);
  }
}        
catch (Exception $err ){
  echo $err->getMessage();
}
?>
<style type="text/css">
  header nav, header navbar {
    max-width: 1230px !important; 
  }
</style>
<div>
  <div class="rn_Container">
    <h1>Walkin Reports</h1>
  </div>
</div>
<div class="rn_AskQuestion rn_Container">
  <iframe src="https://tms.tvscredit.com/ValidateUser/CheckUser?auth=e4a517751a95b256fd16990c6fe19ed6&emp_id=<?php echo $md5EmployeeCode; ?>" style="border:none; width: 100%; height:900px;"></iframe>
</div>