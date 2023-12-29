<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standardMSME.php" login_required="false" force_https="false"/>

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
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!-- Include Date Range Picker -->
<!--<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-theme.min.css">  -->
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script> 

<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Apply for Loan</h1>
    </div>
</div>

<div class="container">
	<div class="row">
		<section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-file"></i>
                            </span>
                        </a>
                    </li>
                    <li role="presentation" class="disabled">
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <form role="form" id="new_lead_form" method="post" class="form-horizontal" action="<?php echo $site_url;?>/cc/AjaxCustom/createLead" >
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <h3>Personal Information</h3>
                        <div class="row"> 
    
											<!--First Row Starts Here!-->
											<div class="form-group col-md-2">
											  <label for="title" class="control-label">Title</label>
											  <div class="input-group">
															 <div class="input-group-addon"><i class="fa fa-hand-o-right" aria-hidden="true"></i></div>
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
											</div>
											<!--First Ros Ends Here!--> 
											<!--Second Row Starts Here!-->
											<div class="clearfix"></div>
													<div class="form-group col-md-4">
													  <label for="first_name" class="control-label" >First Name <span class="mandatory">*</span></label>
														<div class="input-group">
															 <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
																	<input type="text" name="first_name" value="<?php echo $this->input->post('first_name') ? $this->input->post('first_name') :''; ?>" class="form-control" id="first_name"  maxlength="80" placeholder="First Name"/>
														</div>
													</div>
													<div class="form-group col-md-4">
													  <label for="middle_name" class="control-label" >Mid Name</label>
													  <div class="input-group">
															 <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
																		<input type="text" name="middle_name" value="<?php echo $this->input->post('middle_name') ? $this->input->post('middle_name') :''; ?>" class="form-control" id="middle_name" data-validation="required"  maxlength="80" placeholder="Mid Name"/>
															</div>
													</div>
													<div class="form-group col-md-4">
													  <label for="last_name" class="control-label" >Last Name <span class="mandatory">*</span></label>
														  <div class="input-group">
																 <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
																			 <input type="text" name="last_name" value="<?php echo $this->input->post('last_name') ? $this->input->post('last_name') :''; ?>" class="form-control" id="last_name"  maxlength="80" placeholder="Last Name"/>
															</div>
													</div>
											<!--Second Row Ends Here!--> 
											
											<!--Third Row Starts Here!-->
											
											<div class="clearfix"></div>
											<div class="form-group col-md-4">
											  <label for="Father_Spouse" class="control-label" >Father / Spouse <span class="mandatory">*</span></label>
											  <div class="input-group">
																 <div class="input-group-addon"><i class="fa fa-user-plus" aria-hidden="true"></i></div>
																		<input type="text" name="Father_Spouse" value="<?php echo $this->input->post('Father_Spouse') ? $this->input->post('Father_Spouse') :''; ?>" class="form-control" id="Father_Spouse"   maxlength="80" placeholder="Father's Name"/>
												</div>
											</div>
											<div class="form-group col-md-4">
											  <label for="Gender" class="control-label" > Gender <span class="mandatory">*</span></label>
											  <div class="input-group">
															 <div class="input-group-addon"><i class="fa fa-transgender" aria-hidden="true"></i></div>
																  <select id ="genderLists" name="Gender" class="form-control" >
																	<option value="">Select Gender</option>
																	
																	<option value="Male">Male</option>
																	<option value="Female">Female</option></select>
																  </select>
														</div>
											</div>
											<div class="form-group col-md-4">
											  <label for="date_of_birth" class="control-label" >Date of Birth </label>
											  <div class="input-group">
													<div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
															<input type="text" id="date_of_birth" name="date_of_birth"    data-date-format="DD/MM/YYYY" data-field="date" class="form-control datepicker" />
													</div>
											</div>
											<!--Third Row Ends Here!--> 
											<!--Fourth Row Starts Here!-->
											<div class="clearfix"></div>
											<div class="form-group col-md-4">
											  <label for="address" class="control-label" >Address <span class="mandatory">*</span></label>
											  <div class="input-group">
													<div class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></div>
														<input type="text" name="address" value="<?php echo $this->input->post('address') ? $this->input->post('address') :''; ?>" class="form-control" id="address"  maxlength="80" placeholder="Address"/>
												</div>
											</div>
											<div class="form-group col-md-4">
											  <label for="email" class="control-label" > Email <span class="mandatory">*</span></label>
											  <div class="input-group">
													<div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
														  <input type="email" name="email" value="<?php echo $this->input->post('email') ? $this->input->post('email') :''; ?>" class="form-control" id="email" required  maxlength="80" placeholder="Email"/>
													</div>
											</div>
											<div class="form-group col-md-4">
											  <label for="mobile" class="control-label" >Mobile <span class="mandatory">*</span></label>
											  <div class="input-group">
													<div class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
															<input type="mobile" id="mobile" name="mobile" value="<?php echo $this->input->post('mobile') ? $this->input->post('mobile') :''; ?>"  maxlength="10" class="form-control"   placeholder="Mobile">
													</div>
											</div>
											<!--Fourth Row Ends Here!--> 
											<!--Fifth Row Starts Here!-->
											<div class="clearfix"></div>
											
											<div class="form-group col-md-4">
											  <label for="state" class="control-label" > State <span class="mandatory">*</span></label>
											  <div class="input-group">
													<div class="input-group-addon"><i class="fa fa-flag-o" aria-hidden="true"></i></div>
														  <select id="stateList" name="state" class="form-control" >
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
													</div>
											</div>
											<div class="form-group col-md-4">
											  <label for="city" class="control-label" >City <span class="mandatory">*</span></label>
											  <div class="input-group">
													<div class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></div>
														  <select id="cityList" name="city" class="form-control" >
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
											</div>
											<div class="form-group col-md-2">
											  <label for="Pincode" class="control-label" >Pincode <span class="mandatory">*</span></label>
												  <div class="input-group">
														<div class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></div>
															<input type="text" name="Pincode" value="<?php echo $this->input->post('Pincode') ? $this->input->post('Pincode') :''; ?>" class="form-control" id="Pincode"  maxlength="6"/>
														</div>
												</div>
											<div class="form-group col-md-2">
											  <label for="country" class="control-label" >Country</label>
											  <div class="input-group">
														<div class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i></div>
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
											</div>
											
											<!--Fifth Row Ends Here!--> 
											<!--Sixth Row Starts Here!-->
											<div class="clearfix"></div>
											<div class="form-group col-md-4">
											  <label for="CompanyName" class="control-label" >Company Name</label>
											  <div class="input-group">
														<div class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></div>
															<input type="text" name="CompanyName" value="<?php echo $this->input->post('CompanyName') ? $this->input->post('CompanyName') :''; ?>" class="form-control" id="CompanyName" maxlength="100"/>
												</div>
											</div>
											<div class="form-group col-md-6">
											  <label for="CompanyAddress" class="control-label" > Company Address </label>
													<div class="input-group">
														<div class="input-group-addon"><i class="fa fa-address-card-o" aria-hidden="true"></i></div>
																<input type="text" name="CompanyAddress" value="<?php echo $this->input->post('CompanyAddress') ? $this->input->post('CompanyAddress') :''; ?>" class="form-control" id="CompanyAddress" maxlength="100"/>
													</div>
											</div>
											
											<!--Sixth Row Ends Here!--> 
											
							</div>
							<!-- End Row-->
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                        <h3>Identification Documents</h3>
                       <div class="row">
								<div class="form-group col-md-4">
									  <label for="CustProfile" class="control-label" >CustProfile <span class="mandatory">*</span></label>
									  <div class="input-group">
														<div class="input-group-addon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
									  <select id ="custList" name="CustProfile" class="form-control">
									  <option value="">Select Profile</option>
										
									  </select>
										</div>
									</div>
									<div class="form-group col-md-3">
									  <label for="Pancard" class="control-label" > Pan Card <span class="mandatory">*</span></label>
									  <div class="input-group">
												<div class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></div>
														<input type="text" name="Pancard" value="<?php echo $this->input->post('Pancard') ? $this->input->post('Pancard') :''; ?>" class="form-control" id="Pancard" maxlength="10"  />
										</div>
									</div>
									<div class="form-group col-md-4">
									  <label for="passport" class="control-label" >Passport</label>
									  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
												<input type="text" id="passport" name="passport" value="<?php echo $this->input->post('Passport') ? $this->input->post('Passport') :''; ?>"  maxlength="10" data-field="date" class="form-control" >
										</div>
									</div>
									<!--First Row Ends Here!--> 
									<!--Second Row Starts Here!-->
									
									<div class="clearfix"></div>
									<div class="form-group col-md-4">
									  <label for="Voterid" class="control-label" >Voter ID Card </label>
									  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></div>
												<input type="text" name="Voterid" value="<?php echo $this->input->post('Voterid') ? $this->input->post('Voterid') :''; ?>" class="form-control" id="Voterid"   maxlength="80" placeholder="Voter ID"/>
										</div>
									</div>
									<div class="form-group col-md-3">
									  <label for="Driving_License" class="control-label" > Driving License </label>
									  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></div>
												<input type="text" name="Driving_License" value="<?php echo $this->input->post('Driving_License') ? $this->input->post('Driving_License') :''; ?>" class="form-control" id="Driving_License" maxlength="20"/>
										</div>
									</div>

									<div class="form-group col-md-4">
									  <label for="Rationcard" class="control-label" >Ration Card </label>
									  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></div>
												<input type="text" name="Rationcard" value="<?php echo $this->input->post('Rationcard') ? $this->input->post('Rationcard') :''; ?>" class="form-control" id="Rationcard" maxlength="20"/>
											</div>
									</div>
									
									<!--Second Row Ends Here!--> 
									<!--Third Row Starts Here!-->
									
									<div class="clearfix"></div>
									<div class="form-group col-md-4">
									  <label for="aadharcard" class="control-label" >Aadhar Card </label>
									  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></div>
												<input type="text" name="aadharcard" class="form-control" id="aadharcard"  maxlength="80" placeholder="Aadhar Card ID"/>
									</div>
									</div>
									<div class="form-group col-md-3">
									  <label for="Residentstatus" class="control-label" > Resident Status </label>
									  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-id-badge" aria-hidden="true"></i></div>
												  <select id="residentList" name="Residentstatus" class="form-control" >
												   <option value="">Select Resident Status</option>
													
												  </select>
										</div>
									</div>
									<div class="form-group col-md-4">
									  <label for="ResidentStability" class="control-label" >Resident Stability</label>
									 <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-id-badge" aria-hidden="true"></i></div>
													<input type="number" name="ResidentStability"  class="form-control" id="ResidentStability" maxlength="2"/>
											</div>
									</div>
									
									<!--Third Row Ends Here!--> 
								
					   </div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <h3>Loan Documents</h3>
                        <div class="row">
								<div class="form-group col-md-4">
								  <label for="LoanAmount" class="control-label" >Loan Amount <span class="mandatory">*</span></label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></div>
												<input type="text" name="LoanAmount"  class="form-control" id="LoanAmount" maxlength="10"/>
									</div>
								</div>
								<div class="form-group col-md-3">
								  <label for="Tenure" class="control-label" > Tenure <span class="mandatory">*</span></label>
								   <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
												<input type="text" name="Tenure" value="<?php echo $this->input->post('Tenure') ? $this->input->post('Tenure') :''; ?>"  class="form-control" id="Tenure" maxlength="4"/>
											</div>
								</div>
								<div class="form-group col-md-4">
								  <label for="RepaymentMode" class="control-label" >Repayment Type <span class="mandatory">*</span></label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-briefcase" aria-hidden="true"></i></div>
												  <select id="repaymentList" name="RepaymentMode" class="form-control" >
												  <option value="" >Select Repayment Type</option>
															
														</select>
											</div>
								</div>
								<!-- Second row Starts Here!-->
								
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="EMIcomfort" class="control-label" >EMI Comfort <span class="mandatory">*</span></label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
												<input type="text" name="EMIcomfort" value="<?php echo $this->input->post('EMIcomfort') ? $this->input->post('EMIcomfort') :''; ?>"  class="form-control" id="EMIcomfort" maxlength="10"/>
											</div>
								</div>
								<div class="form-group col-md-3">
								  <label for="MonthIncome" class="control-label" > Month Income <span class="mandatory">*</span></label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></div>
												<input type="text" name="MonthIncome"  class="form-control" id="MonthIncome" maxlength="10"/>
									</div>
								</div>
								<div class="form-group col-md-4">
								  <label for="Year" class="control-label" >Year <span class="mandatory">*</span></label>
									<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div>
											  <select name="Year" id="yearList" class="form-control" >
											  <option value="">Select Year</option>
												
											  </select>
									</div>
								</div>
								
								<!-- Second row Ends Here!--> 
								
								<!-- Third row Starts Here!-->
								
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="Make" class="control-label" >Make <span class="mandatory">*</span></label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-car" aria-hidden="true"></i></div>
												  <select name="Make"  id="makeList" class="form-control" >
												  <option value="">Select Make</option>
													
												  </select>
										</div>
								</div>
								<div class="form-group col-md-3">
								  <label for="Model" class="control-label" > Model <span class="mandatory">*</span></label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-car" aria-hidden="true"></i></div>
											  <select name="Model" id="modelList" class="form-control" >
												<option value="">Select Model</option>
											  </select>
										</div>
								</div>
								<div class="form-group col-md-4">
								  <label for="Variant" class="control-label" >Variant <span class="mandatory">*</span></label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-car" aria-hidden="true"></i></div>
												  <select name="Variant" id="variantList" class="form-control" >
													<option value="">Select Variant</option>
													
												  </select>
										</div>
								</div>
								
								<!-- Third row Ends Here!--> 
								
								<!--Fourth Row Starts Here!-->
								
								<div class="clearfix"></div>
								<div class="form-group col-md-4">
								  <label for="ProductCode" class="control-label" >Loan Type </label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-car" aria-hidden="true"></i></div>
												  <select name="loan_type" class="form-control" >
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
								</div>
							<!--	<div class="form-group col-md-3">
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
								</div>--?
								
								<!--Fourth Row Ends Here!--> 
								
								<!-- Fifth Row Starts Here! -->
								<!--<div class="clearfix"></div>
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
								</div>-->
								 <div class="form-group col-md-4">
								  <label for="ACC1" class="control-label" >Acc 1 </label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></div>
													<input type="text" name="ACC1"  class="form-control" id="ACC1" maxlength="16"/>
											</div>
								</div>
								<!-- Fifth Row Ends Here! -->
								
								<!--Sixth Row Starts Here!--> 
								
								<div class="clearfix"></div>       
								  <div class="form-group col-md-4">
								  <label for="Experience" class="control-label" > Experience </label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></div>
											 <input type="number" name="Experience" value="<?php echo $this->input->post('Experience') ? $this->input->post('Experience') :''; ?>" class="form-control" id="Experience" maxlength="4"/>
											</div>
									</div>
								<div class="form-group col-md-4">
								  <label for="FinalisedCar" class="control-label" >Financed Cars</label>
								  <div class="input-group">
											<div class="input-group-addon"><i class="fa fa-car" aria-hidden="true"></i></div>
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
								</div>
						</div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                   <!--         <li><button type="button" class="btn btn-default next-step">Skip</button></li>-->
                            <li><button type="submit" class="btn btn-primary btn-info-full ">Save and continue</button></li>
							<input id="ChannelCode" name="ChannelCode" type="hidden" value="CP">
						<input id="AgencyCode" name="AgencyCode" type="hidden" value="TVSCRM">
						<input id="Action" name="Action" type="hidden" value="Create_New_Lead">
						<input id="clickaction" name="clickaction" type="hidden" value="Submit">
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
                        <h3>Complete</h3>
                        <p>You have successfully completed all steps.</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </section>
   </div>
</div>
<script type="text/javascript">
var tvsapiurl = '<?php echo $tvsapiurl;?>';
</script>
<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
    rel="stylesheet" type="text/css" />

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

    <script src="/euf/assets/themes/standard/js/custom.js"></script>
<script>
  $.validate({
    validateOnBlur : false, // disable validation when input looses focus
  //  errorMessagePosition : 'top' // Instead of 'inline' which is default
    scrollToTopOnError : false // Set this property to true on longer forms
  });
</script>