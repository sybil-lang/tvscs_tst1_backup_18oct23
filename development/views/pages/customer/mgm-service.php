<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('customer');
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
$report_id=$msg->Value;
$contact_id=$CI->session->getProfileData("c_id");
//print_r($CI->session->getProfile());
$userProfile =$CI->session->getSessionData("userProfile");
$filter=array('ContactID'=>$contact_id);
$agreement_array = report_result($report_id,$filter);
//print_r($agreement_array);

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
<html>
<head>
<style type="text/css">
.select{
    height:100px;
    overflow:scroll;
}
.form-group .input-group .form-control{
	border-top-right-radius: 0px !important;
    border-bottom-right-radius: 0px !important;
}
.btn{
	width: 80% !important;
}
.form-control{
	width: 80% !important;
}
input{
	border-radius: 4px !important;
}
@media screen and (max-device-width: 360px) and (orientation: portrait) {
	.btn{
		width: 93% !important;
	}
	.form-control{
		width: 100% !important;
	}
}

</style>
</head>
<body>
	<div class="container">
		<form name="frmreferral" id="frmreferral">
			<div class="form-group">
				<label for="exampleInputAmount">Agreement Number</label>
				<select name="strLoginAgrmnt" class="form-control" id="strLoginAgrmnt">
						<option value="">Please Select</option>
				<?php
				if(!empty($agreement_array)){
					foreach($agreement_array as $key => $value){
						if(!empty(trim($value['Agreement No']))){
				?>
						<option value="<?php echo  $value['Agreement No'];?>" ><?php echo  $value['Agreement No'];?></option>
				<?php 
						}
					}
				} ?>
				</select>

			</div>
			<div class="form-group">
					<label  for="refProduct">Product Type</label>
				      <select name="refProduct" class="form-control" id="refProduct">
								  <option value="">Select Product Type</option>
								<?php

									if ( count( $ProductCode_Array ) > 0 ) {
										//$ProductCode_Array  = ksort($ProductCode_Array );
										foreach ( $ProductCode_Array as $display_text ) {
											//$selected = ( $display_text[ 'Product Description' ] == $this->input->post( 'ProductCode' ) ) ? ' selected="selected"' : null;
											echo '<option value="' . $display_text[ 'Product_Code' ] . '">' . $display_text[ 'Product Description' ] . '</option>';
										}
									}
									?>
					  </select>
			</div>
			<div class="form-group">
				<label  for="refName">Name</label>
			      <input type="text" class="form-control" id="refName" name="refName" placeholder="Name" maxlength="100">
			</div>
			<div class="form-group">
				 <label  for="RefMobile">Mobile Number</label>
				 <input type="text" class="form-control" id="RefMobile" name="RefMobile" placeholder="Mobile" maxlength="10">
			</div>
			<div class="form-group">
				<label  for="refName">Logged In Mobile Number</label>
				<input type="text" class="form-control" Placeholder="Logged In Mobile Number" id="LoginAgrMobile" name="LoginAgrMobile" value="<?php echo $userProfile['mobileNumber'];?>" maxlength="10">
			</div>
			<button type="button" class="btn btn-primary" id="btnsubmit" style="margin-top: 26px;">Submit</button>
		</form>
	</div>
<script type="text/javascript">
$(document).ready(function() {
 // $('select').niceSelect({
//		'overflow':scroll
 // });
var flag = false;
  $('#btnsubmit').click(function(){
	
	//alert($('#strLoginAgrmnt').val());

	  if($('#strLoginAgrmnt').val() == ''){
			bootbox.alert('<p>Select Agreement Number</p>');
			flag = true;
	  }else if($('#refProduct').val() == ''){
			bootbox.alert('<p>Select Product </p>');
			flag = true;
	  }else if(isNaN($('#RefMobile').val())){
			bootbox.alert('<p>Enter Valid Mobile number</p>');
			flag = true;
	  }else if(isNaN($('#LoginAgrMobile').val())){
			bootbox.alert('<p>Enter Valid LoginAgrMobile</p>');
			flag = true;
	  }else{
			flag = false;
	  }
	  if(!flag){
		  $("#loader").removeClass("hidden");   
			$.ajax({
					   url: '/cc/AjaxCustom/insertMGMReferral',
					   data: $('#frmreferral').serialize(),
					   method:'post',
					   error: function() {
						  bootbox.alert('<p>An error has occurred</p>');
					   },
				//	   dataType: 'json',
					   success: function(response) {
						$("#loader").addClass("hidden");   
						  bootbox.alert('<p>'+response+'</p>');
					   },
					   type: 'POST'
					});
	  }
  });
});
</script>
</body>
</html>
