 <rn:meta title="Business Information" template="employee_header.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 800px;
}
</style>
<?php
//$currentsess=$CI->session->getSessionData('previouslySeenEmail');
//$Session_Error_Message=$currentsess['error_message'];
$CI=&get_instance();
$CI->load->helper('report');

$contact_id=$CI->session->getProfileData("c_id");
//$contact_id = 3;

$msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_TVS_API_URL );
$tvsapiurl = $msg->Value;


/**/
/*code for product Type Dropdown starts here*/
$msg = RightNow\ Connect\ v1_3\ MessageBase::fetch( CUSTOM_MSG_PRODUCT_TYPE_DROPDOWN );
$report_id = $msg->Value;
if ( $report_id > 0 ) {
	$filter = array();
	$ProductCode_Array = report_result( $report_id, $filter );
}
/*code for product Type Dropdown ends here*/
/*
Additionally, please use report in following message base to get list of all States and their State Codes:
Name: CUSTOM_MSG_STATE_NAME_AND_CODE
ID: 1000023

To get list of Cities in a State, you must pass the State code in filter of following report:
Name: CUSTOM_MSG_REPORT_INDIAN_STATES_AND_CITIES
ID: 1000022
*/
$msg = RightNow\ Connect\ v1_3\ MessageBase::fetch( CUSTOM_MSG_STATE_NAME_AND_CODE );
$statereport_id = $msg->Value;
if ( $statereport_id > 0 ) {
	$filter = array();
	$state_Array = report_result( $statereport_id, $filter );
}
//print_r($state_Array);

?>

<link href="/euf/assets/themes/standard/css/stepsForm.css" rel="stylesheet">
<!-- JS Files------------------------------------ -->
<script src="/euf/assets/themes/standard/js/jquery-2.1.1.min.js"></script>

<!-- Include Date Range Picker -->
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script> 

<link href="/euf/assets/themes/standard/css/magicsuggest-min.css" rel="stylesheet">
	<script src="/euf/assets/themes/standard/js/magicsuggest.js"></script>
<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Lead Generation</h1>
    </div>
</div>
	<p>&nbsp;</p>
	<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
	   <center>
		  <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
		</center>
	</div>
	<section class="container">
			  <div class="row-fluid">
					<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
					 <!--STEPS FORM START ------------ -->
							<div class="stepsForm sf-theme-default">
								<form method="post">
									<div class="sf-steps">
										<div class="sf-steps-content">
											<div>
												<span>1</span> Personal Information
											</div>
											<div>
												<span>2</span> Identification Documents
											</div>
											<div>
												<span>3</span> Loan Documents
											</div>
										</div>
									</div>                
									<div class="sf-steps-form sf-radius"> 
										
										<ul class="sf-content"> <!-- form step one --> 
											 <li>
												<div class="sf_columns column_2">
												<label class="sf-select">
													 <select name="title" data-required="true">
													 <option value="-1" selected>Select Title</option>
															   <?php 
																			 $title_values = array(
																					'Mr'=>'Mr',
																					'Mrs'=>'Mrs',
																					'Miss'=>'Miss',
																			  );
																			  if(count($title_values)>0){
																				foreach($title_values as $value => $display_text){
																					$selected = ($value == $this->input->post('title')) ? ' selected="selected"' : null;
																					echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
																					}
																			  }
																			  ?>
															  </select>
															  <span></span>
														</label>
												</div>
											 </li>
											 <li>
												<div class="sf_columns column_2">
												<label for="first_name" class="" >First Name <span class="mandatory">*</span></label>
																	<input type="text" name="first_name" value="<?php echo $this->input->post('first_name') ? $this->input->post('first_name') :''; ?>" id="first_name"  maxlength="80" placeholder="First Name"  data-required="true" />
												</div>
												<div class="sf_columns column_2">
												<label for="middle_name" class="" >Middle Name</label>
																	<input type="text" name="middle_name" value="<?php echo $this->input->post('middle_name') ? $this->input->post('middle_name') :''; ?>"  id="middle_name"   maxlength="80" placeholder="Middle Name"/>
												</div>
												<div class="sf_columns column_2">
													<label for="last_name" class="" >Last Name <span class="mandatory">*</span></label>
																			 <input type="text" name="last_name" value="<?php echo $this->input->post('last_name') ? $this->input->post('last_name') :''; ?>"  id="last_name"  maxlength="80" placeholder="Last Name" data-required="true" />
												</div>
											 </li>
											  <li>
												
												<div class="sf_columns column_2">
													<div class="sf-radio">
														Gender :  
														<label><input type="radio" value="M" name="Gender" data-required="true"><span></span> Male</label>
														<label><input type="radio" value="F" name="Gender" data-required="true"><span></span> Female</label>
													</div>
												</div>
												<div class="sf_columns column_2">
													<label for="Father_Spouse" class="" >Father / Spouse <span class="mandatory">*</span></label>
																		<input type="text" name="Father_Spouse" value="<?php echo $this->input->post('Father_Spouse') ? $this->input->post('Father_Spouse') :''; ?>" class="form-control" id="Father_Spouse" data-required="true"  maxlength="80" placeholder="Father's Name"/>
												</div>
												<div class="sf_columns column_2">
													<label for="date_of_birth" class="" >Date of Birth </label>
															<input type="text" id="date_of_birth" name="date_of_birth"    data-date-format="DD/MM/YYYY" data-field="date" class="form-control datepicker" data-required="true" />

												</div>
											 </li>
											 
											 

											 <li>
												<div class="sf_columns column_2">
													<label for="email" class="" > Email <span class="mandatory">*</span></label>
											 
														  <input type="email" name="email" value="<?php echo $this->input->post('email') ? $this->input->post('email') :''; ?>" class="form-control" id="email" data-required="true" data-email="true"  maxlength="80" placeholder="Email"/>
												</div>
												<div class="sf_columns column_2">
													<label for="mobile" class="" >Mobile <span class="mandatory">*</span></label>
															<input type="mobile" id="mobile" name="mobile" value="<?php echo $this->input->post('mobile') ? $this->input->post('mobile') :''; ?>" data-number="true"  maxlength="10" class="form-control"   placeholder="Mobile">
												</div>
												<div class="sf_columns column_2">
													<label for="Pincode" class="" >Pincode <span class="mandatory">*</span></label>
															<input type="text" name="Pincode" value="<?php echo $this->input->post('Pincode') ? $this->input->post('Pincode') :''; ?>" data-number="true" class="form-control" id="Pincode"  maxlength="6"/>
												</div>
											 </li>
											<li>
												<div class="sf_columns column_6">
													<textarea placeholder="Address" name="address" data-required="true"></textarea>
												</div>
											 </li>
											 <li>
												<div class="sf_columns column_2">
													<label class="sf-select">
														<select id="stateList" name="state" data-required="true" >
														  <option value="">Select State</option>
														   <?php 
																		$state=($this->input->post('state')) ? $this->input->post('state') : '';
																		if(count($state_Array)>0){  
																			foreach($state_Array as $display){
																				$value=$display['State Code'];
																				$display_text=$display['State Name'];
																				if($state) $selected = ($value == $this->input->post('state')) ? ' selected="selected"' : null;
																				echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
																			} 
																		}
															?>
														  </select>
														<span></span>
													</label>
												</div>
												<div class="sf_columns column_2">
													<label for="city" class="sf-select" >
														  <select id="cityList" name="city"  data-required="true" >
															<option value="">Select City</option>
															<?php 
																	/*	$city=($this->input->post('city')) ? $this->input->post('city') : '';
																		if(count($CityArray)>0){
																			foreach($CityArray as $display){
																				$value=$display['szstatecode'];
																				$display_text=$display['szdesc'];
																				if($city) $selected = ($value == $this->input->post('city')) ? ' selected="selected"' : null;
																				echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
																			}
																		}*/
															?>
														  </select>
														  <span></span>
													</label>
												</div>
												<div class="sf_columns column_2">
													<label class="sf-select">
														<select name="country" data-required="true">
															<option value="" selected="selected">Select country...</option>
															<option value="IN">India</option>

														</select>
														<span></span>
													</label>
												</div>
											 </li>
											  <li>
												<div class="sf_columns column_3">
													<label for="CompanyName" class="" >Company Name</label>
											 
														  <input type="text" name="CompanyName" value="<?php echo $this->input->post('CompanyName') ? $this->input->post('CompanyName') :''; ?>"  id="CompanyName" maxlength="100"/>
												</div>
												<div class="sf_columns column_3">
													 <label for="CompanyAddress" class="" > Company Address </label>
															<input type="text" name="CompanyAddress" value="<?php echo $this->input->post('CompanyAddress') ? $this->input->post('CompanyAddress') :''; ?>"  id="CompanyAddress" maxlength="100"/>
												</div>
												
											 </li>


										</ul>
										   
										<ul class="sf-content"> <!-- form step two --> 

											 <li>
												<div class="sf_columns column_2">
												  <label for="aadharcard" class="" >Aadhar Card </label>
															<input type="text" name="aadharcard" id="aadharcard"  maxlength="80" placeholder="Aadhar Card ID"/>
												</div>
												<div class="sf_columns column_2">
												  <label for="Pancard" class="" > PAN Card <span class="mandatory">*</span></label>
																	<input type="text" name="Pancard" value="<?php echo $this->input->post('Pancard') ? $this->input->post('Pancard') :''; ?>" placeholder="PAN Card" data-required="true" id="Pancard" maxlength="10"  />
												</div>
												<div class="sf_columns column_2">
												  <label for="passport" class="" >Passport</label>
															<input type="text" id="passport" name="passport" value="<?php echo $this->input->post('Passport') ? $this->input->post('Passport') :''; ?>" placeholder="Passport"  maxlength="10" >
												</div>
												<!--First Row Ends Here!--> 
											</li>
												<!--Second Row Starts Here!-->
												<li>
													<div class="sf_columns column_2">
													  <label for="Voterid" class="" >Voter ID Card </label>
																<input type="text" name="Voterid" value="<?php echo $this->input->post('Voterid') ? $this->input->post('Voterid') :''; ?>" placeholder="Voter ID Card"  id="Voterid"   maxlength="80" placeholder="Voter ID"/>
													</div>
													<div class="sf_columns column_2">
													  <label for="Driving_License" class="" > Driving License </label>
																<input type="text" name="Driving_License" value="<?php echo $this->input->post('Driving_License') ? $this->input->post('Driving_License') :''; ?>" placeholder="Driving License"  id="Driving_License" maxlength="20"/>
													</div>

													<div class="sf_columns column_2">
													  <label for="Rationcard" class="" >Ration Card </label>
																<input type="text" name="Rationcard" value="<?php echo $this->input->post('Rationcard') ? $this->input->post('Rationcard') :''; ?>"  placeholder="Ration Card" id="Rationcard" maxlength="20"/>
													</div>
												</li>	
												<!--Second Row Ends Here!--> 
												<!--Third Row Starts Here!-->
												<li>
												<div class="sf_columns column_2"><br />
												  <label for="CustProfile" class="sf-select" >

													  <select id ="custList" name="CustProfile" data-required="true">
													  <option value="">Select Profile</option>
														
													  </select>
													  <span></span>
													  </label>
												</div>
												
												<div class="sf_columns column_2"><br />
												  <label for="Residentstatus" class="sf-select" >
															  <select id="residentList" name="Residentstatus" >
															   <option value="">Select Resident Status</option>
																
															  </select>
														  <span></span>
														</label>
												</div>
												<div class="sf_columns column_2">
												  <label for="ResidentStability" class="" >Resident Stability</label>
																<input type="number" name="ResidentStability"   id="ResidentStability" maxlength="2"/>
												</div>
											</li>
											
										</ul>
						
										<ul class="sf-content" id="last_step"> <!-- form step tree --> 
											 
											 <li>
												 <div class="sf_columns column_2">
														  <label for="LoanAmount" class="" >Loan Amount <span class="mandatory">*</span></label>
																		<input type="text" name="LoanAmount" placeholder="Loan Amount" data-required="true" data-number="true"   id="LoanAmount" maxlength="10"/>
												</div>
												<div class="sf_columns column_2">
													  <label for="Tenure" class="" > Tenure <span class="mandatory">*</span></label>
																	<input type="text" name="Tenure" value="<?php echo $this->input->post('Tenure') ? $this->input->post('Tenure') :''; ?>" placeholder="Tenure" data-required="true" data-number="true"  id="Tenure" maxlength="4"/>
												</div>
												<div class="sf_columns column_2">
												<br />
													  <label for="RepaymentMode" class="sf-select" >
																	  <select id="repaymentList" name="RepaymentMode" data-required="true" >
																			<option value="" >Select Repayment Type</option>
																				
																		</select>
																		<span></span>
														</label>
													</div>
												</li>
													<!-- Second row Starts Here!-->
												<li>
													<div class="sf_columns column_2">
													  <label for="EMIcomfort" class="" >EMI Comfort <span class="mandatory">*</span></label>
																	<input type="text" name="EMIcomfort" value="<?php echo $this->input->post('EMIcomfort') ? $this->input->post('EMIcomfort') :''; ?>" data-required="true"  id="EMIcomfort" maxlength="10"/>
													</div>
													<div class="sf_columns column_2">
													  <label for="MonthIncome" class="" > Month Income <span class="mandatory">*</span></label>
																	<input type="text" name="MonthIncome"  data-required="true" data-number="true" id="MonthIncome" maxlength="10"/>
													</div>
													<div class="sf_columns column_2">
													<br />
													  <label for="Year" class="sf-select" >
																  <select name="Year" id="yearList" data-required="true" >
																  <option value="">Select Year</option>
																	
																  </select>
																  <span></span>
														</label>
													</div>
											</li>		
													<!-- Second row Ends Here!--> 
													
													<!-- Third row Starts Here!-->
											<li>		
													<div class="sf_columns column_2">
													  <label for="Make" class="sf-select" >
																	  <select name="Make"  id="makeList"  data-required="true">
																	  <option value="">Select Make</option>
																		
																	  </select>
																	  <span></span>
															</label>
													</div>
													<div class="sf_columns column_2">
													  <label for="Model" class="sf-select" data-required="true">
													  
																  <select name="Model" id="modelList" >
																	<option value="">Select Model</option>
																  </select>
																  <span></span>
															</label>
													</div>
													<div class="sf_columns column_2">
													  <label for="Variant" class="sf-select" data-required="true">
													 
																	  <select name="Variant" id="variantList"  >
																		<option value="">Select Variant</option>
																		
																	  </select>
																	  <span></span>
															</label>
													</div>
											</li>	
													<!-- Third row Ends Here!--> 
													
													<!--Fourth Row Starts Here!-->
												<li>	
													<div class="sf_columns column_3">
													  <label for="ProductCode" class="sf-select" >
																	  <select name="loan_type"  data-required="true" >
																		<option value="">Select Loan Type</option>
																		<?php
																							if ( count( $ProductCode_Array ) > 0 ) {
																								foreach ( $ProductCode_Array as $display_text ) {
																									$selected = ( $display_text[ 'Product Description' ] == $this->input->post( 'ProductCode' ) ) ? ' selected="selected"' : null;
																									echo '<option value="' . $display_text[ 'Product_Code' ] . '" ' . $selected . '>' . $display_text[ 'Product Description' ] . '</option>';
																								}
																							}
																							?>
																	  </select>
																	  <span></span>
															</label>
													</div>
													
													<div class="sf_columns column_3">
													  <label for="FinalisedCar" class="sf-select" >
																	   <select name="FinalisedCar" >
																	   <option value="">Financed Cars</option> 
																		<?php
																							$FinalisedCar_values = array(
																								'Yes' => 'Yes',
																								'No' => 'No',
																							);
																							foreach ( $FinalisedCar_values as $value => $display_text ) {
																								$selected = ( $value == $this->input->post( 'FinalisedCar' ) ) ? ' selected="selected"' : null;
																								echo '<option value="' . $value . '" ' . $selected . '>' . $display_text . '</option>';
																							}
																							?>
																	  </select>
																	  <span></span>
																</label>
													</div>
													 
													<!-- Fifth Row Ends Here! -->
												</li>
												
												<li>
													<!--Sixth Row Starts Here!--> 
													
													  <div class="sf_columns column_3">
													  <label for="Experience" class="" > Experience </label>
													  
																 <input type="number" name="Experience" value="<?php echo $this->input->post('Experience') ? $this->input->post('Experience') :''; ?>" placeholder="Experience" id="Experience" maxlength="4"/>
													</div>
													<div class="sf_columns column_3">
													  <label for="ACC1" class="" >Acc 1 </label>
																		<input type="text" name="ACC1" placeholder="ACC 1"   id="ACC1" maxlength="16"/>
													</div>
											</li>
											 
											 <li>
												<div class="sf_columns column_6">
													<div class="sf-check">
														<label><input checked type="checkbox" value="true" name="accept"><span></span> I agree to the Terms and Conditions</label>
													</div>
												</div>
											 </li>
										</ul>
									</div>
									<input id="ChannelCode" name="ChannelCode" type="hidden" value="CP">
									<input id="AgencyCode" name="AgencyCode" type="hidden" value="TVSCRM">
									<input id="CampaignCode" name="CampaignCode" type="hidden" value="STC">
									<div class="sf-steps-navigation sf-align-right">
										<span id="sf-msg" class="sf-msg-error"></span>
										<button id="sf-prev" type="button" class="sf-button">Previous</button>
										<button id="sf-next" type="button" class="sf-button">Next</button>
									</div>
								</form>
							</div>
							<!--STEPS FORM END -------------- -->

							</div>
		</div>
</section>
<script>
	$(document).ready(function(e) {
       	
		$(".stepsForm").stepsForm({
			width			:'100%',
			active			:0,
			errormsg		:'Check faulty fields.',
			sendbtntext		:'Save Infomation',
			posturl			:'/cc/EmployeeCustom/saveLeadData',
			theme			:'blue',
		}); 
});
</script>
<script type="text/javascript">
var tvsapiurl = '<?php echo $tvsapiurl;?>';
</script>

    <script src="/euf/assets/themes/standard/js/employee_custom.js"></script>
