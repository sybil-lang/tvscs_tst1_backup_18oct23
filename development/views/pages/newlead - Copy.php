<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php" login_required="false" force_https="false"/>

<style type="text/css">
.form-horizontal .form-group{
margin-left: -5px !important;
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

?>
<!-- Zozo Tabs css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />

     <!-- Zozo Tabs Flat Themes css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />
    
    <!-- Zozo Tabs js -->
    <script src="/euf/assets/themes/standard/js/jquery.min.js"></script>
    <script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

	<!-- Include Date Range Picker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<form name="new_lead_form" id="new_lead_form" method="post" class="form-horizontal" action="<?php echo $site_url;?>/cc/AjaxCustom/createLead" >

<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Apply for Loan</h1>
    </div>
</div>
<div id="lead_loader" style="display:none;"><img src="images/loading-chart.gif" width="50" height="50"></div>
<div class="container" id="lead_form">
<p>&nbsp;</p>

	<!-- Start First Tabs-->
        <div id="tabbed-nav">

            <!-- Tab Navigation Menu -->
            <ul>
                <li><a>Personal Information</a></li>
                <li><a>Identification Documents</a></li>
                <li><a>Loan Eligibility</a></li>
                
            </ul>

            <!-- Content container -->
            <div>

                <!-- Overview -->
                <div>
                   <!-- <h4>Overview</h4>-->
						<div class="container"> 
    
								<!--First Row Starts Here!-->
								<div class="form-group col-md-2">
								  <label for="title" class="control-label">Title</label>
								  <select name="title" class="form-control">
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
								</div>
								<!--First Ros Ends Here!--> 
								<!--Second Row Starts Here!-->
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="first_name" class="control-label" >First Name <span class="mandatory">*</span></label>
								  <input type="text" name="first_name" value="<?php echo $this->input->post('first_name') ? $this->input->post('first_name') :''; ?>" class="form-control" id="first_name" required  maxlength="80" placeholder="First Name"/>
								</div>
								<div class="form-group col-md-4">
								  <label for="middle_name" class="control-label" >Mid Name</label>
								  <input type="text" name="middle_name" value="<?php echo $this->input->post('middle_name') ? $this->input->post('middle_name') :''; ?>" class="form-control" id="middle_name" data-validation="required"  maxlength="80" placeholder="Mid Name"/>
								</div>
								<div class="form-group col-md-4">
								  <label for="last_name" class="control-label" >Last Name <span class="mandatory">*</span></label>
								  <input type="text" name="last_name" value="<?php echo $this->input->post('last_name') ? $this->input->post('last_name') :''; ?>" class="form-control" id="last_name" required  maxlength="80" placeholder="Last Name"/>
								</div>
								<!--Second Row Ends Here!--> 
								
								<!--Third Row Starts Here!-->
								
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="Father_Spouse" class="control-label" >Father / Spouse <span class="mandatory">*</span></label>
								  <input type="text" name="Father_Spouse" value="<?php echo $this->input->post('Father_Spouse') ? $this->input->post('Father_Spouse') :''; ?>" class="form-control" id="Father_Spouse" required  maxlength="80" placeholder="Father's Name"/>
								</div>
								<div class="form-group col-md-4">
								  <label for="Gender" class="control-label" > Gender <span class="mandatory">*</span></label>
								  <select id ="genderList" name="Gender" class="form-control" required>
									<option value="">Select Gender</option>
									<?php 
											/*	$Gender=($this->input->post('Gender')) ? $this->input->post('Gender') : '';
												if(count($GenderArray)>0){  
													foreach($GenderArray as $display){
														$value=$display['key_code'];
														$display_text=$display['code_desc'];
														if($Gender) $selected = ($value == $this->input->post('Gender')) ? ' selected="selected"' : null;
														echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
													}
												}
												*/
												?>
								  </select>
								</div>
								<div class="form-group col-md-4">
								  <label for="date_of_birth" class="control-label" >Date of Birth </label>
								  <input type="text" id="date_of_birth" name="date_of_birth"  required maxlength="10" data-date-format="mm/dd/yyyy" data-field="date" class="form-control datepicker" />
								</div>
								<!--Third Row Ends Here!--> 
								<!--Fourth Row Starts Here!-->
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="address" class="control-label" >Address <span class="mandatory">*</span></label>
								  <input type="text" name="address" value="<?php echo $this->input->post('address') ? $this->input->post('address') :''; ?>" class="form-control" id="address"required  maxlength="80" placeholder="Address"/>
								</div>
								<div class="form-group col-md-4">
								  <label for="email" class="control-label" > Email <span class="mandatory">*</span></label>
								  <input type="email" name="email" value="<?php echo $this->input->post('email') ? $this->input->post('email') :''; ?>" class="form-control" id="email" required  maxlength="80" placeholder="Email"/>
								</div>
								<div class="form-group col-md-4">
								  <label for="mobile" class="control-label" >Mobile <span class="mandatory">*</span></label>
								  <input type="mobile" id="mobile" name="mobile" value="<?php echo $this->input->post('mobile') ? $this->input->post('mobile') :''; ?>"  maxlength="10" class="form-control" required  placeholder="Mobile">
								</div>
								<!--Fourth Row Ends Here!--> 
								<!--Fifth Row Starts Here!-->
								<div class="clearfix"></div>
								
								<div class="form-group col-md-4">
								  <label for="state" class="control-label" > State <span class="mandatory">*</span></label>
								  <select id="stateList" name="state" class="form-control" required>
								  <option value="">Select State</option>
								   <?php 
												/*$state=($this->input->post('state')) ? $this->input->post('state') : '';
												if(count($StateArray)>0){  
													foreach($StateArray as $display){
														$value=$display['szstatecode'];
														$display_text=$display['szdesc'];
														if($state) $selected = ($value == $this->input->post('state')) ? ' selected="selected"' : null;
														echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
													} 
												}*/
									?>
								  </select>
								</div>
								<div class="form-group col-md-4">
								  <label for="city" class="control-label" >City <span class="mandatory">*</span></label>
								  <select id="cityList" name="city" class="form-control" required>
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
								</div>
								<div class="form-group col-md-2">
								  <label for="Pincode" class="control-label" >Pincode <span class="mandatory">*</span></label>
								  <input type="text" name="Pincode" value="<?php echo $this->input->post('Pincode') ? $this->input->post('Pincode') :''; ?>" class="form-control" id="Pincode" data-validation="required" maxlength="6"/>
								</div>
								<div class="form-group col-md-2">
								  <label for="country" class="control-label" >Country</label>
								  <select name="country"  class="form-control" >
								   <?php 
												$country_values = array('IN'=>'India');
												if(count($country_values)>0){
													foreach($country_values as $value => $display_text){
														$selected = ($value == $this->input->post('country')) ? ' selected="selected"' : null;
														echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
													} 
												}
									?>
								  </select>
								</div>
								
								<!--Fifth Row Ends Here!--> 
								<!--Sixth Row Starts Here!-->
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="CompanyName" class="control-label" >Company Name</label>
								  <input type="text" name="CompanyName" value="<?php echo $this->input->post('CompanyName') ? $this->input->post('CompanyName') :''; ?>" class="form-control" id="CompanyName" maxlength="100"/>
								</div>
								<div class="form-group col-md-6">
								  <label for="CompanyAddress" class="control-label" > Company Address </label>
								  <input type="text" name="CompanyAddress" value="<?php echo $this->input->post('CompanyAddress') ? $this->input->post('CompanyAddress') :''; ?>" class="form-control" id="CompanyAddress" maxlength="100"/>
								</div>
								
								<!--Sixth Row Ends Here!--> 
								
							  </div>
                </div>

                <!-- Features -->
                <div>
                    <!--<h4>Features</h4>-->
							<div class="container">
								<div class="row">
								  <div class="form-group">
									<div class="clearfix"></div>
									<div class="form-group col-md-4">
									  <label for="CustProfile" class="control-label" >CustProfile <span class="mandatory">*</span></label>
									  <select id ="custList" name="CustProfile" class="form-control"   required>
									  <option value="">Select Profile</option>
										<?php 
												/*	$CustProfile=($this->input->post('CustProfile')) ? $this->input->post('CustProfile') : '';
													if(count($CustProfileArray)>0){  
														foreach($CustProfileArray as $display){
															$value=$display['code'];
															$display_text=$display['code_desc'];
															if($CustProfile) $selected = ($value == $this->input->post('CustProfile')) ? ' selected="selected"' : null;
															echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
														}
													}*/
										?>
									  </select>
									</div>
									<div class="form-group col-md-3">
									  <label for="Pancard" class="control-label" > Pan Card <span class="mandatory">*</span></label>
									  <input type="text" name="Pancard" value="<?php echo $this->input->post('Pancard') ? $this->input->post('Pancard') :''; ?>" class="form-control" id="Pancard" maxlength="10" required />
									</div>
									<div class="form-group col-md-4">
									  <label for="passport" class="control-label" >Passport</label>
									  <input type="text" id="passport" name="passport" value="<?php echo $this->input->post('Passport') ? $this->input->post('Passport') :''; ?>"  maxlength="10" data-field="date" class="form-control" >
									</div>
									<!--First Row Ends Here!--> 
									<!--Second Row Starts Here!-->
									
									<div class="clearfix"></div>
									<div class="form-group col-md-4">
									  <label for="Voterid" class="control-label" >Voter ID Card </label>
									  <input type="text" name="Voterid" value="<?php echo $this->input->post('Voterid') ? $this->input->post('Voterid') :''; ?>" class="form-control" id="Voterid"   maxlength="80" placeholder="Voter ID"/>
									</div>
									<div class="form-group col-md-3">
									  <label for="Driving_License" class="control-label" > Driving License </label>
									  <input type="text" name="Driving_License" value="<?php echo $this->input->post('Driving_License') ? $this->input->post('Driving_License') :''; ?>" class="form-control" id="Driving_License" maxlength="20"/>
									</div>
									<div class="form-group col-md-4">
									  <label for="Rationcard" class="control-label" >Ration Card </label>
									  <input type="text" name="Rationcard" value="<?php echo $this->input->post('Rationcard') ? $this->input->post('Rationcard') :''; ?>" class="form-control" id="Rationcard" maxlength="20"/>
									</div>
									
									<!--Second Row Ends Here!--> 
									<!--Third Row Starts Here!-->
									
									<div class="clearfix"></div>
									<div class="form-group col-md-4">
									  <label for="aadharcard" class="control-label" >Aadhar Card </label>
									  <input type="text" name="aadharcard" class="form-control" id="aadharcard"  maxlength="80" placeholder="Aadhar Card ID"/>
									</div>
									<div class="form-group col-md-3">
									  <label for="Residentstatus" class="control-label" > Resident Status </label>
									  <select id="residentList" name="Residentstatus" class="form-control"  required>
									   <option value="">Select Resident Status</option>
										<?php 
												/*$Residentstatus=($this->input->post('Residentstatus')) ? $this->input->post('Residentstatus') : '';
												if(count($ResidenceStatusArray)>0){  
													foreach($ResidenceStatusArray as $display){
														$value=$display['code'];
														$display_text=$display['code_desc'];
														if($Residentstatus) $selected = ($value == $this->input->post('Residentstatus')) ? ' selected="selected"' : null;
														echo '<option value="'.$value.'" '.$selected.'>'.ucwords(strtolower($display_text)).'</option>';
													}
												}*/
										?>
									  </select>
									</div>
									<div class="form-group col-md-4">
									  <label for="ResidentStability" class="control-label" >Resident Stability</label>
									  <input type="number" name="ResidentStability"  class="form-control" id="ResidentStability" maxlength="2"/>
									</div>
									
									<!--Third Row Ends Here!--> 
									
								  </div>
								</div>
								<br/>
								<div class="clearfix"></div>
							  </div>
                </div>

                <!-- Docs -->
                <div>
                    <!--<h4>Docs</h4>-->
                    <div class="container">
							<div class="row">
							  <div class="form-group">
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="LoanAmount" class="control-label" >Loan Amount <span class="mandatory">*</span></label>
								  <input type="text" name="LoanAmount" required class="form-control" id="LoanAmount" maxlength="6"/>
								</div>
								<div class="form-group col-md-3">
								  <label for="Tenure" class="control-label" > Tenure <span class="mandatory">*</span></label>
								  <input type="text" name="Tenure" value="<?php echo $this->input->post('Tenure') ? $this->input->post('Tenure') :''; ?>" required class="form-control" id="Tenure" maxlength="4"/>
								</div>
								<div class="form-group col-md-4">
								  <label for="RepaymentMode" class="control-label" >Repayment Type <span class="mandatory">*</span></label>
								  <select id="repaymentList" name="RepaymentMode" class="form-control" required>
								  <option value="" >Select Repayment Type</option>
											
										</select>
								</div>
								<!-- Second row Starts Here!-->
								
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="EMIcomfort" class="control-label" >EMI Comfort <span class="mandatory">*</span></label>
								  <input type="text" name="EMIcomfort" value="<?php echo $this->input->post('EMIcomfort') ? $this->input->post('EMIcomfort') :''; ?>" required class="form-control" id="EMIcomfort" maxlength="6"/>
								</div>
								<div class="form-group col-md-3">
								  <label for="MonthIncome" class="control-label" > Month Income <span class="mandatory">*</span></label>
								  <input type="text" name="MonthIncome" required class="form-control" id="MonthIncome" maxlength="4"/>
								</div>
								<div class="form-group col-md-4">
								  <label for="Year" class="control-label" >Year <span class="mandatory">*</span></label>
								  <select name="Year" id="yearList" class="form-control" required>
								  <option value="">Select Year</option>
									
								  </select>
								</div>
								
								<!-- Second row Ends Here!--> 
								
								<!-- Third row Starts Here!-->
								
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="Make" class="control-label" >Make <span class="mandatory">*</span></label>
								  <select name="Make"  id="makeList" class="form-control" required>
								  <option value="">Select Make</option>
									
								  </select>
								</div>
								<div class="form-group col-md-3">
								  <label for="Model" class="control-label" > Model <span class="mandatory">*</span></label>
								  <select name="Model" id="modelList" class="form-control" required>
									<option value="">Select Model</option>
								  </select>
								</div>
								<div class="form-group col-md-4">
								  <label for="Variant" class="control-label" >Variant <span class="mandatory">*</span></label>
								  <select name="Variant" id="variantList" class="form-control" required>
									<option value="">Select Variant</option>
									
								  </select>
								</div>
								
								<!-- Third row Ends Here!--> 
								
								<!--Fourth Row Starts Here!-->
								
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="ProductCode" class="control-label" >Loan Type </label>
								  <select name="loan_type" class="form-control" required>
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
								</div>
								<div class="form-group col-md-3">
								  <label for="Lstate" class="control-label" > State </label>
								  <select name="Lstate" id="Lstatelist" class="form-control" >
									<option value="">Select State</option>
								  </select>
								</div>
								<div class="form-group col-md-4">
								  <label for="Lcity" class="control-label" >City</label>
								  <select name="Lcity" id="Lcitylist" class="form-control" >
													<option value="">Select City</option>
								  </select>
								</div>
								
								<!--Fourth Row Ends Here!--> 
								
								<!-- Fifth Row Starts Here! -->
								<div class="clearfix"></div>
								 <div class="form-group col-md-4">
								  <label for="Pincode" class="control-label" >Pin code </label>
								  <input type="text" name="Pincode"  class="form-control" id="Pincode" maxlength="6"/>
								</div>
								<div class="form-group col-md-3">
								  <label for="country" class="control-label" >Country</label>
								  <select name="country" class="form-control">
										<?php 
														$country_values = array('IN'=>'India');
														if(count($country_values)>0){
															foreach($country_values as $value => $display_text){
																$selected = ($value == $this->input->post('country')) ? ' selected="selected"' : null;
																echo '<option value="'.$value.'" '.$selected.'>'.$display_text.'</option>';
															} 
														}
										?>
								  </select>
								</div>
								 <div class="form-group col-md-4">
								  <label for="ACC1" class="control-label" >Acc 1 </label>
									<input type="text" name="ACC1"  class="form-control" id="ACC1" maxlength="16"/>
								</div>
								<!-- Fifth Row Ends Here! -->
								
								<!--Sixth Row Starts Here!--> 
								
								<div class="clearfix"></div>       
								  <div class="form-group col-md-4">
								  <label for="Experience" class="control-label" > Experience </label>
								 <input type="number" name="Experience" value="<?php echo $this->input->post('Experience') ? $this->input->post('Experience') :''; ?>" class="form-control" id="Experience" maxlength="4"/>
								</div>
								<div class="form-group col-md-4">
								  <label for="FinalisedCar" class="control-label" >Financed Cars</label>
								   <select name="FinalisedCar" class="form-control">
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
								</div>
								<!--Sixth Row Ends Here!-->
								
								
								
							   
							  </div>
							</div>
							
							
							<!--Sixth Row Ends Here!--> 
						  </div>

                </div>

            </div>

        </div>
        <!-- End First Tabs-->
		<!--<div class="row">
					  <div class="col-md-offset-11 col-md-12">-->
					  <p>&nbsp;</p>
			<div class="col-md-6">

						<button type="submit" class="btn btn-primary btn-lg" id="btn_lead" >Submit </button>
						  <input type="reset" class="btn btn-primary btn-lg" value="Reset" />

						<input id="ChannelCode" name="ChannelCode" type="hidden" value="CP">
						<input id="AgencyCode" name="AgencyCode" type="hidden" value="TVSCRM">
						<input id="Action" name="Action" type="hidden" value="Create_New_Lead">
						<input id="clickaction" name="clickaction" type="hidden" class="btn btn-success" value="Submit">
					 <!-- </div>-->
			</div>
			<div class="col-md-6"></div>
		<br /><br /><br />
</div> <!-- End Container -->
</form>
<script>
        jQuery(document).ready(function ($) {
            /* jQuery activation and setting options for first tabs*/
            $("#tabbed-nav").zozoTabs({
                position: "top-left",
                orientation: "horizontal",
                multiline: true,
                style: "contained",
                theme: "flat-peter-river flat",
                spaced: true,
                rounded: true,
                animation: {
                    easing: "easeInOutExpo",
                    duration: 600,
                    effects: "slideH"
                },
                size:"large"
            });

			// Lead AJAX
				var form=$("#new_lead_form");
	/*			$('#btn_lead').bind('click', function() {
				//$('#new_lead_form').submit(function() {
					 var $theForm =form;
				  //Some browsers don't implement checkValidity
				  if (( typeof($theForm[0].checkValidity) == "function" ) && !$theForm[0].checkValidity()) {
					 return;
				  }
					$("#lead_loader").show();
					$("#lead_form").hide();
					$.ajax({
							type:"POST",
							url: "<?php echo $site_url;?>/cc/AjaxCustom/createLead",
							data:$("#new_lead_form").serialize(),//only input
							success: function(response){
								console.log(response);  
								if(response.Error_Msg == 'Successfull'){
											$("#lead_loader").hide();
											$("#lead_form").show();
											$("#lead_form").html("Thanks for submitting your details. We will get back to you soon. <a href='/app/home'>Click here</a> to go back.");
								}else{
											$("#lead_loader").text('Error in Data. Please try Again');
											$("#lead_form").show();
								}
							}
						});
				});*/
		});

		

		$(function() {
			$( "#date_of_birth" ).datepicker();
		});

</script>
		
		<script>
//GetVRepaymentType
	// You are missing the new anonymous function call
		$("#repaymentList").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#repaymentList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVRepaymentType",
						agencyCode: 'TVSCRM',
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getRepaymentType", data, function (response) {
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].szpaymenttype + '">' + response[i].szpaymenttypedes + '</option>';
					}
					//alert(html);
					$('#repaymentList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#repaymentList").append(html);
				});
			}
		});

		// You are missing the new anonymous function call
		$("#genderList").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#genderList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVCommonFields",
						agencyCode: 'TVSCRM',
						key_code:'Gender',
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getKeyProfileFields", data, function (response) {
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].key_code + '">' + response[i].code_desc + '</option>';
					}
					//alert(html);
					$('#genderList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#genderList").append(html);
				});
			}
		});

//Customer Profile List
		
		// You are missing the new anonymous function call
		$("#custList").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#custList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVCommonFields",
						agencyCode: 'TVSCRM',
						key_code:'Customer Profile',
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getKeyProfileFields", data, function (response) {
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].code + '">' + response[i].code_desc + '</option>';
					}
					//alert(html);
					$('#custList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#custList").append(html);
				});
			}
		});



//Residence Profile List
		
		// You are missing the new anonymous function call
		$("#residentList").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#residentList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVCommonFields",
						agencyCode: 'TVSCRM',
						key_code:'Residence Status',
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getKeyProfileFields", data, function (response) {
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].code + '">' + response[i].code_desc + '</option>';
					}
					//alert(html);
					$('#residentList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#residentList").append(html);
				});
			}
		});

		// You are missing the new anonymous function call
		$("#stateList").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#stateList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVStateName",
						agencyCode: 'TVSCRM',
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getState", data, function (response) {
					//console.log(response);
					//alert(response);
					/*$.each(response.items, function(i,item){
						// Create and append the new options into the select list
						$("#stateList").append("<option value="+item.szstatecode+">"+item.szdesc+"</option>");
					});*/
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].szstatecode + '">' + response[i].szdesc + '</option>';
					}
					//alert(html);
					$('#stateList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#stateList").append(html);
				});
			}
		});

		// You are missing the new anonymous function call
		$("#cityList").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#cityList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVCityName",
						agencyCode: 'TVSCRM',
						statecode: $('#stateList :selected').val(),
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getCity", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].szstatecode + '">' + response[i].szdesc + '</option>';
					}
					//alert(html);
					$('#cityList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#cityList").append(html);
				});
			}
		});

		$("#stateList").change(function() {
				//alert($(this).find("option").size() );
			if ($(this).find("option").size() > 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#cityList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVCityName",
						agencyCode: 'TVSCRM',
						statecode: $('#stateList :selected').val(),
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getCity", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].szstatecode + '">' + response[i].szdesc + '</option>';
					}
					//alert(html);
					$('#cityList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#cityList").append(html);
				});
			}
		});

		//function for Year
		// You are missing the new anonymous function call
		$("#yearList").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#yearList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVDynamicLast20Years",
						agencyCode: 'TVSCRM',
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getYear", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].years + '">' + response[i].years + '</option>';
					}
					//alert(html);
					$('#yearList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#yearList").append(html);
				});
			}
		});

		//function for Make
		// You are missing the new anonymous function call
		$("#yearList").change(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() > 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#makeList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "getVMakeList",
						agencyCode: 'TVSCRM',
						year:$('#yearList :selected').val(),
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/get_Make", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].Make + '">' + response[i].Make + '</option>';
					}
					//alert(html);
					$('#makeList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#makeList").append(html);
				});
			}
		});

		//function for Year
		// You are missing the new anonymous function call
		$("#makeList").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#makeList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "getVMakeList",
						agencyCode: 'TVSCRM',
						year:'1997',
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/get_Make", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].Make + '">' + response[i].Make + '</option>';
					}
					//alert(html);
					$('#makeList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#makeList").append(html);
				});
			}
		});


		//function for Model
		// You are missing the new anonymous function call
		$("#makeList").change(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() > 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#modelList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');

				var year_val = $('#yearList :selected').val();
				if(year_val == ''){
					year_val = '1997';
				}
				var make_val = $('#makeList :selected').val();
				if (make_val == '')
				{
						make_val= 'FIAT';
				}
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "getVModelList",
						agencyCode: 'TVSCRM',
						year:year_val,
						make:make_val,
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/get_model", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].Model + '">' + response[i].Model + '</option>';
					}
					//alert(html);
					$('#modelList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#modelList").append(html);
				});
			}
		});

		//function for Year
		// You are missing the new anonymous function call
		$("#modelList").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#modelList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var year_val = $('#yearList :selected').val();
				if(year_val == ''){
					year_val = '1997';
				}
				var make_val = $('#makeList :selected').val();
				if (make_val == '')
				{
						make_val= 'FIAT';
				}
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "getVModelList",
						agencyCode: 'TVSCRM',
						year:year_val,
						make:make_val,
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/get_model", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].Model + '">' + response[i].Model + '</option>';
					}
					//alert(html);
					$('#modelList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#modelList").append(html);
				});
			}
		});
		

//variantList
//function for variantList
		// You are missing the new anonymous function call
		$("#variantList").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#variantList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var year_val = $('#yearList :selected').val();
				if(year_val == ''){
					year_val = '1997';
				}
				var make_val = $('#makeList :selected').val();
				if (make_val == '')
				{
						make_val= 'FIAT';
				}
				var model_val = $('#modelList :selected').val();
				if (model_val == '')
				{
						model_val= 'UNO';
				}
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "getV_VariantlList",
						agencyCode: 'TVSCRM',
						year:year_val,
						make:make_val,
						model:model_val,
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/get_varient", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].Variant + '">' + response[i].Variant + '</option>';
					}
					//alert(html);
					$('#variantList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#variantList").append(html);
				});
			}
		});

		// You are missing the new anonymous function call
		$("#modelList").change(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() > 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#variantList')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var year_val = $('#yearList :selected').val();
				if(year_val == ''){
					year_val = '1997';
				}
				var make_val = $('#makeList :selected').val();
				if (make_val == '')
				{
						make_val= 'FIAT';
				}
				var model_val = $('#modelList :selected').val();
				if (model_val == '')
				{
						model_val= 'UNO';
				}
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "getV_VariantlList",
						agencyCode: 'TVSCRM',
						year:year_val,
						make:make_val,
						model:model_val,
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/get_varient", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].Variant + '">' + response[i].Variant + '</option>';
					}
					//alert(html);
					$('#variantList')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#variantList").append(html);
				});
			}
		});



		// You are missing the new anonymous function call
		$("#Lstatelist").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#Lstatelist')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVStateName",
						agencyCode: 'TVSCRM',
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getState", data, function (response) {
					//console.log(response);
					//alert(response);
					/*$.each(response.items, function(i,item){
						// Create and append the new options into the select list
						$("#stateList").append("<option value="+item.szstatecode+">"+item.szdesc+"</option>");
					});*/
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].szstatecode + '">' + response[i].szdesc + '</option>';
					}
					//alert(html);
					$('#Lstatelist')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#Lstatelist").append(html);
				});
			}
		});

		// You are missing the new anonymous function call
		$("#Lcitylist").click(function() {
			// If the select list is empty:
			//alert($(this).find("option").size() );
			if ($(this).find("option").size() <= 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#Lcitylist')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVCityName",
						agencyCode: 'TVSCRM',
						statecode: $('#stateList :selected').val(),
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getCity", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].szstatecode + '">' + response[i].szdesc + '</option>';
					}
					//alert(html);
					$('#Lcitylist')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#Lcitylist").append(html);
				});
			}
		});

		$("#Lstatelist").change(function() {
				//alert($(this).find("option").size() );
			if ($(this).find("option").size() > 1) {
				//$('#stateList').prepend($('<option></option>').html('Loading...'));
				$('#Lcitylist')
					.children()
					.remove()
					.end()
					.append('<option value="">Loading...</option>');
				// Documentation on getJSON: http://api.jquery.com/jQuery.getJSON/'GetVStateName', array( 'AgencyCode' => 'TVSCRM' ) 
				var data = {
						methodName: "GetVCityName",
						agencyCode: 'TVSCRM',
						statecode: $('#stateList :selected').val(),
						tvsApi:	'<?php echo $tvsapiurl;?>'
					};
				$.getJSON("/cc/AjaxCustom/getCity", data, function (response) {
					
					var html = '';
					var len = response.length;
					for (var i = 0; i< len; i++) {
						html += '<option value="' + response[i].szstatecode + '">' + response[i].szdesc + '</option>';
					}
					//alert(html);
					$('#Lcitylist')
					.children()
					.remove()
					.end()
					.append('<option value="">Please Select</option>');
					$("#Lcitylist").append(html);
				});
			}
		});
		</script>