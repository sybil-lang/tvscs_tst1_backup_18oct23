<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="employee_header.php" clickstream="employee_customer_incident_create" login_required="true" force_https="true" />
<?php
$CI=&get_instance();
$CI->load->helper('report');
$c_id=$CI->session->getProfileData("c_id");
checkCustomerType('internal employee');
  $msgbase = \RightNow\Connect\v1_3\Messagebase::fetch("CUSTOM_MSG_CategoryName_for_Dispatch_address");
  $category_list = $msgbase->Value;
?>
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/tautocomplete.css" />
<script src="/euf/assets/themes/standard/js/tautocomplete.js" type="text/javascript"></script>
<style type="text/css">
	.modal-dialog
	{
		z-index: 999999999999999999999999999 !important;
	}
	.bootbox-body
    {
        padding-top: 50px;

    }
    .modal-content {
     height: auto!important;
    overflow-y: scroll !important;
    position: fixed !important;
    top: -30px !important;
    width: auto !important;
}
.uderline
{
    text-decoration: underline !important;
}
select{
		padding: 4px 0 4px 22px !important;
	    border-radius: 50px !important;
	    background: #fff!important;
	    box-shadow: 5.634px 10.595px 30px rgba(0,0,0,0.1)!important;
	    border: none!important;
	    height: 40px!important;
	    width: 360px !important;
	    border: 1px solid rgba(0,0,0,0.05) !important;
	    line-height: 18px;
	}
	.ui-widget input[type="text"]{
		padding: 4px 0 4px 22px !important;
	    border-radius: 50px !important;
	    background: #fff!important;
	    box-shadow: 5.634px 10.595px 30px rgba(0,0,0,0.1)!important;
	    border: none!important;
	    height: 40px!important;
	    width: 360px !important;
	    border: 1px solid rgba(0,0,0,0.05) !important;
	    line-height: 20px;
	}
	#rn_FileAttachmentUpload_36_LoadingIcon
	{
		    left: 30px;
		    z-index: 100000;
		    position: absolute;
		    bottom: 40px;
	}
	#branchPointer, #pointersList{
		color: red;
		font-weight: bold;
	}
	ol #pointersList{
		list-style: number;
	}
	.modal-dialog
	{
		z-index: 999999999999999999999999999 !important;
	}
</style>
      <script type="text/javascript">
	 submit_variable=1;
</script>
  <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
           <center>
              <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
            </center>
        </div>
<p>&nbsp;</p>
<div class="">
    <div class="rn_Container">
        
            <h1>#rn:msg:SUBMIT_QUESTION_OUR_SUPPORT_TEAM_CMD#</h1>
            <p>#rn:msg:OUR_DEDICATED_RESPOND_WITHIN_48_HOURS_MSG#</p>
        
        <!--<div class="translucent">
            <strong>#rn:msg:TIPS_LBL#:</strong>
            <ul>
                <li><i class="fa fa-thumbs-up"></i> #rn:msg:INCLUDE_AS_MANY_DETAILS_AS_POSSIBLE_LBL#</li>
            </ul>
        </div>
        <br>
        <p>#rn:msg:NEED_A_QUICKER_RESPONSE_LBL# <a href="/app/social/ask">#rn:msg:ASK_OUR_COMMUNITY_LBL#</a></p>-->
    </div>
</div>

<div class="rn_AskQuestion rn_Container">
    <form id="rn_QuestionSubmit" method="post" action="/cc/ajaxRequest/sendForm/" class="styled" enctype="multipart/form-data">
	<!--<form id="rn_QuestionSubmit" method="post" action="#" class="styled" enctype="multipart/form-data">-->
	<input type="hidden" name="contact_id" value="<?php echo $c_id;?>" />
        <div id="rn_ErrorLocation"></div>
        <rn:condition logged_in="false">
	<div class="row">
		<div class="col-md-6">
			<rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#"/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
				<rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		     <rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		    <rn:widget path="input/FormInput" name="Incident.Subject" required="true" label_input="#rn:msg:SUBJECT_LBL#"/>
		</div>
	</div>
        </rn:condition>
        <rn:condition logged_in="true">
	<div class="row">
			<div class="col-md-4">
			<div class="ui-widget">
				<label for="dealer" class="rn_Label" style="display:block !important";> Agreement Number<span class="rn_Required" aria-label="Required">*</span><span id="loadericon" class="hidden"><img src="/euf/assets/themes/standard/img/ajax-loader.gif"></span></label>
				<!--<div id="magicsuggest_customer"></div>-->
						<input type="text" name="agreement_no" id="agreement_no" required />
					<p>&nbsp;</p>
					</div>
			</div>
	</div>
	<div class="row" style="display:none;" id="custname">
		<div class="col-md-5">
		<label for="name">Customer Name</label>
			<input type="text" name="customerName" id="customerName" readonly />
		</div>
	</div>
	<div class="row">
		<div class="col-md-5">
		    <rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#"/>
		</div>
	</div>
	<div class="row">
			<div class="col-md-6">
				
				<rn:widget path="custom/input/ProductCategoryInputEmpCustomer" name="Incident.Category" report_id="#rn:msg:CUSTOM_MSG_EmpPortal_CustomerHelpdesk#" required_lvl="1" max_lvl="1" />
				
			</div>
	</div>

	<div class="row">
            <div class="col-md-6">
                <rn:widget path="input/FormInput" class="pf_add" name="Incident.CustomFields.c.preferred_address" initial_focus="true" label_input="Preferred Address"/> 
                <div id="messageTerm">
                	
                </div> 
            </div>
    </div>        

    <div class="row">
        <div class="col-md-6">
            <rn:widget path="input/FormInput" name="Incident.CustomFields.c.dispatchaddress" initial_focus="true" label_input="Dispatch Address"/>     
        </div>
    </div>   

     <div class="row pinnm" >
        <div class="col-md-6">
            <label>Pin Code <span id="pincodestar" class="rn_Required">*</span></label><input class="rn_Text" type="text" name="pin" required id="pincode" maxlength="6" pattern= "[0-9]+" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">   
        </div>
    </div>
        </rn:condition>
	<div class="row">
		<div class="col-md-6">
			<rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#"/>
		</div>
	</div>

	<!--<div class="row">
			<div class="col-md-6">
				<rn:widget path="input/ProductCategoryInputEmpCustomer" name="Incident.Product" report_id="null" required_lvl="1" max_lvl="1" />
			</div>
	</div>-->
	<!-- <div class="row">
			<div class="col-md-6">
				
				<rn:widget path="custom/input/ProductCategoryInputEmpCustomer" name="Incident.Category" report_id="#rn:msg:CUSTOM_MSG_EmpPortal_CustomerHelpdesk#" required_lvl="1" max_lvl="1" />
				
			</div>
	</div> -->
	<div class="row">
		<div class="col-md-6">
			<rn:widget path="input/FileAttachmentUpload" name="Incident.FileAttachments" />
		</div>
    </div>
	  <input type="hidden" name="selectedLoan" id="selectedLoan" value="" />
	  <input type="hidden" name="productId" id="productId" />
      <rn:widget path="custom/input/empFormSubmit" label_button="#rn:msg:SUBMIT_YOUR_QUESTION_CMD#" on_success_url="/app/employee/customer_ask_confirm" error_location="rn_ErrorLocation"/>
	  <p>&nbsp;</P>
	  <!--<button type="submit" id="rn_submitform"> Submit Your Question </button><p>&nbsp;</p>-->
  </form>
</div>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js" type="text/javascript"></script>
<script>
		//var ms3= $('#magicsuggest_customer').magicSuggest({
//$('#agreement_no').on('blur',function(){	
		var selQuery = $('#agreement_no').val();
		var selQuery = $('#agreement_no').val();
		 // var cat="";
        var mobile="";
        var dob="";
        var customername="";
       

        
		
		var text2 = $("#agreement_no").tautocomplete({
                   // width: "700px",
                    columns: ['Value', 'Name'],
					placeholder: "Search Agreement Number",
				//	regex: "/^[a-zA-Z0-9]{3,}$/",
                    ajax: {
                        url: "/cc/EmployeeCustom/getCustomerAgreementLists",
                        type: "GET",
                        data: function(){var x = { query: text2.searchdata()}; return x;},
                        success: function (result) {
                            
                            var filterData = [];

                            var searchData = eval("/" + text2.searchdata() + "/gi");

                            $.each(result, function (i, v) {
                                if (v.name.search(new RegExp(searchData)) != -1) {
                                    filterData.push(v);
                                }
                            });
                            return filterData;
                        }
                    },
                    onchange: function () {
                       // $("#ta-txt").html(text2.text());
					   var obj = text2.id();
					   var strResult = obj.split('_');
					//alert( result[2] );
						var str_id = strResult[0]+'_'+strResult[1];
                      $("#selectedLoan").val(str_id);
					  $("#customerName").val(strResult[2]);
						$('#custname').show();
					  setProductValue(text2.text());
                    }
                });
			
//		}
			
		
		
	function setProductValue(agreementNumber){
				$("#loadericon").addClass("hidden");
				  $.ajax({
						url: '/cc/EmployeeCustom/getProduct',
						data: 'agg_no='+agreementNumber,
						method: 'post',
						beforeSend: function(){
								//	$("#loadericon").removeClass("hidden");
						 },
						success: function (response) {
							//$('#txtHint').html(data);
							// $("#loadericon").addClass("hidden");
							jQuery('#productId').val(response);
						}
					}).error(function() {
						bootbox.alert ('An error occured');
					});
	}

		
	//	$( "#rn_submitform" ).click(function() {
		
		$("#rn_QuestionSubmit").validate({
			  submitHandler: function(form) {
				
			}
		});
	
function getchangedval(){
	// var agg=$('#agreement_no').val();;
    var a=$('#agreement_no').val().split('#')
					         var agg=a[2];
    var adType="RA";
    console.log("agg",agg);

    $.ajax({
                url: '/cc/AjaxCustom/getdispatchadd',
                data: {agreement_no:agg , adType:adType},
                method: 'post',
                beforeSend: function(){
                            $("#loader").removeClass("hidden");
                 },
                success: function (response) {
                    //$('#txtHint').html(data);
                     $("#loader").addClass("hidden");
                     response=JSON.parse(response)

                     console.log(response);
                     if(response.ReturnMessage=="SUCCESS")
                     {
                      var address = "";
                            if(response.ReturnObject.AddressLine3 != "" && response.ReturnObject.AddressLine2 != "" && response.ReturnObject.AddressLine1 != ""){
                                address = response.ReturnObject.AddressLine1+" , "+response.ReturnObject.AddressLine2+" , "+response.ReturnObject.AddressLine3;
                            }
                            else if(response.ReturnObject.AddressLine2 != "" && response.ReturnObject.AddressLine1 != "" &&  response.ReturnObject.AddressLine3 == ""){
                                address = response.ReturnObject.AddressLine1+" , "+response.ReturnObject.AddressLine2;

                            }
                            else if(response.ReturnObject.AddressLine1 != "" && response.ReturnObject.AddressLine2 == "" && response.ReturnObject.AddressLine3 == ""){
                                address = response.ReturnObject.AddressLine1;
                            }
                            else{
                                address = "";
                            }
                            if(response.ReturnObject.Landmark != ""){
                                address = address + ", "+response.ReturnObject.Landmark;
                            }  
                       document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].value=address;
                       document.getElementById('pincode').value=response.ReturnObject.PinCode;

                     }
                }
            }).error(function() {
                bootbox.alert ('An error occured');
            });
}

$(document).ready(function(){



	$('#rn_SelectionInput_31').addClass("hidden");
	$('#rn_TextInput_33').addClass("hidden");
	$('.pinnm').addClass("hidden");

	$('select[name="Incident.CustomFields.c.preferred_address"]').attr("required",false);
	$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("required",false);
	$('#pincode').attr("required",false);

	$('#pincode').blur(function(event) {
		var k = $(this).val();
		if(k != "" && k != undefined && k!= null){
			// var txtA = $("textarea[name='Incident.CustomFields.c.dispatchaddress']").val();
			// $("textarea[name='Incident.CustomFields.c.dispatchaddress']").val(txtA + ", "+k);
		}
	});

	$('button[type="submit"]').click(function(e){
		// e.preventDefault();
		setTimeout(()=>{
			$('input').removeClass("rn_ErrorField");
			$('textarea').removeClass("rn_ErrorField");
			$('select').removeClass("rn_ErrorField");
			$('button').removeClass("rn_ErrorField");
		},500);
		

	});


	
  	$('select[name="Incident.CustomFields.c.preferred_address"]').change( function (){


        // console.log($('select[name="Incident.CustomFields.c.preferred_address"]'));
       var value= document.getElementsByName('Incident.CustomFields.c.preferred_address')[0].value
       if (value=="254") //registered address
       {
       	$('#messageTerm').removeClass("hidden");
       		jQuery('.pinnm').show();
       		$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("maxlength",500);
       		getchangedval();
       		$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("readonly",true);
       		$('#pincode').attr("readonly",true);
       		$('#messageTerm').html("");
       }
        if (value=="253") //new address
       {
       	$('#messageTerm').removeClass("hidden");

			jQuery('.pinnm').show();
			jQuery('#pincodestar').addClass("rn_Required").html("*");
			jQuery('#rn_FileAttachmentUpload_36_Label').addClass("rn_Required").html("Address Proof Attachment *");
			$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("readonly",false);
       		$('#pincode').attr("readonly",false);
       		$('select[name="Incident.CustomFields.c.preferred_address"]').attr("required",true);
			$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("required",true);
			$('#pincode').attr("required",true);

       		var note = "<ol id='pointersList'><li>NOTE: </li><li>1. You have selected a new address for dispatch of this document. Please attach a valid address proof for the new address.</li> <li>2. The address proof is subject to approval as per organization policy.</li><li>3. Please note that this address would be used only to dispatch thisparticular document requested by you. If you wish to change your address permanentlyfor future reference, raise your request at our Customer Care.</li></ol>";
       		$('#messageTerm').html(note);
       		$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("maxlength",500);
       		$('#rn_TextInput_33_Label').html("Dispatch Address <span id='attachreq'></span>");
       		$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').val("");
       		$("#pincode").val("");
       		$('#attachreq').html("*").addClass("rn_Required").attr("aria-label","Required");
       }
        if (value=="252") //branch address
       {
       	$('#messageTerm').removeClass("hidden");
       	
       		jQuery('.pinnm').hide();
       		jQuery('#pincodestar').removeClass("rn_Required").html("");
       		jQuery('#rn_FileAttachmentUpload_36_Label').removeClass("rn_Required").html("Attach Documents");
       		$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("required",true);
       		$('#messageTerm').html("<p id='branchPointer'>NOTE: Kindly enter only the branch name</p>");
       		$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("readonly",false);
       		$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("maxlength",15);
       		$('#rn_TextInput_33_Label').html("Dispatch Address <span id='attachreq'></span>");
       		$('#attachreq').html("*").addClass("rn_Required").attr("aria-label","Required");
       		$("#pincode").val("");
       		$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').val("");
        
       }
        // you can also check: this.selected

    
  });


  	$('#rn_ProductCategoryInputEmpCustomer_29_Button_Visible_Text').on('DOMSubtreeModified',function(){
  		document.getElementsByName('Incident.CustomFields.c.preferred_address')[0].value="";
  		document.getElementById('pincode').value = "";
        document.getElementsByName('Incident.CustomFields.c.dispatchaddress')[0].value="";
  		var sel_val = $(this).text();
  		$('#messageTerm').addClass("hidden");
  		var categories = [<?php echo $category_list; ?>];
  		if(categories.includes(sel_val.trim()) == true){
  			console.log("OKKKKKKK");
  			// selectDiv.innerHTML = selectDivCreated.innerHTML;
  			// dispatchAddr.innerHTML = dispatchAddrDivCreated.innerHTML;
  			// pinDiv.innerHTML = pinDivCreated.innerHTML;

  			$('#rn_SelectionInput_31').removeClass("hidden");
			$('#rn_TextInput_33').removeClass("hidden");
			$('.pinnm').removeClass("hidden");

			$('select[name="Incident.CustomFields.c.preferred_address"]').attr("required",true);
			$('textarea[name="Incident.CustomFields.c.dispatchaddress"]').attr("required",true);
			$('#pincode').attr("required",true);
  		}
  		else
  		{
  			$('#rn_SelectionInput_31').addClass("hidden");
			$('#rn_TextInput_33').addClass("hidden");
			$('.pinnm').addClass("hidden");
  		}

  	});
   //$('select[name="Incident.CustomFields.c.preferred_address"]').val(254).change();
});

		var mobile="";
        var dob="";
        var customername="";
       

        function die()
        {
            window.stop();
            throw new Error("ERROR");
        }
         function soa(val)
            {
                // var cat=document.getElementById('rn_askCategoryInput_36_Incident.Category').value;
                var cat=document.getElementById('rn_ProductCategoryInputEmpCustomer_29_Button_Visible_Text').innerHTML;
                if(cat=="Insurance Copy request")
										    {
										    	cat=77;
										          
										    }
										     if(cat=="Statement of Account Request")
										    {
										    	cat=86;
										          
										    }
										     if(cat=="CD NOC - Soft copy")
										    {
										    	cat=1812;
										          
										    }
										     if(cat=="Swapping Enquiry")
										    {
										    	cat=1891;
										          
										    }
                // var ag_no=document.getElementById('rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID').value;
                var a=$('#agreement_no').val().split('#')
					         var ag_no="_"+a[2];
                if(val=='hard')
                {
                 $.ajax({
                            type: "POST",
                            url: "/cc/AjaxCustom/paymentgateway_urls",
                            async: false,
                            data: {   ag_no : ag_no,  cat : cat,mobile:mobile,dob:dob,customername:customername},
                            success: function(data) {
                                                  
                            dd=JSON.parse(data)
                             if(dd.ReturnID!=0)
                                             {
                                                
                             
                              console.log(dd);

                              
                                  window.open(dd.ReturnURL, '_blank');
                                

                           die(); 
                         }   
                         else
                         {
                            alert("The requested details not found. Please contact customer care for further information");
                         } 
                          
                                                   
                                               }
                                              });
                }
                else
                {
                    window.location.href="https://tvscs.custhelp.com/app/employee/selfserviceview/load/"+ag_no;
                    return false;

                }
                die();

            }
             $(document).ready(function(){


        $('#rn_empFormSubmit_37_Button').on('click',function(e)
        {
					         e.preventDefault();
					         var cat=document.getElementById('rn_ProductCategoryInputEmpCustomer_29_Button_Visible_Text').innerHTML;
					         var a=$('#agreement_no').val().split('#')
					         var ag_no="_"+a[2];
					         var address=document.getElementById('rn_SelectionInput_31_Incident.CustomFields.c.preferred_address').value;
					         var daddress=document.getElementById('rn_TextInput_33_Incident.CustomFields.c.dispatchaddress').value;
					         var pin=document.getElementById('pincode').value;
					         var Question=document.getElementById('rn_TextInput_35_Incident.Threads').value;
					         var subjectt=document.getElementById('rn_TextInput_28_Incident.Subject').value;

					         console.log(cat,ag_no,Question,subjectt)
					         // die();
										// if(cat&&ag_no&&address&&daddress&&pin&&Question&&subjectt)
									        // {       
										                                         
										                    //86 statement of amount req  
										                    //1812 CD- NDC softcopy  
										                    //1891 Swapping Enquiry 
										                    //insurance 77         
										    var deta="";
										    if(cat=="Insurance Copy request")
										    {
										    	cat=77;
										          
										    }
										     if(cat=="Statement of Account Request")
										    {
										    	cat=86;
										          
										    }
										     if(cat=="CD NOC - Soft copy")
										    {
										    	cat=1812;
										          
										    }
										     if(cat=="Swapping Enquiry")
										    {
										    	cat=1891;
										          
										    }
			           if((cat==1891||cat==1812||cat==86||cat==77 )&&ag_no)

			           {

													           
													               
													                    if(ag_no&&Question&&subjectt)
													                    {

													                    }
													                    else
													                    {
													                    submit_variable=0;
													                    $('#rn_empFormSubmit_37_Button').submit();
													                    submit_variable=1;
													                    die();  
													                    }
													                     
													               
													                     
													                
													            
           										 $.post('/cc/AjaxCustom/ca_api', { method : 'getapimessage',  ag_no : ag_no,  cat : cat})
                                                    .done(function( data ) 
                                                    {
                                                 // customalrtbox(data);
                                                  var daata= JSON.parse(data);
                                                  deta=daata;
                                                   dob=deta.dob;
                                                   mobile =deta.mobile;
                                                   customername=deta.customername;
                                                   response=deta.responseSent;
                                                  if(cat==1891)//1891 Swapping Enquiry
                                                  {
                                             


                                                     $.ajax({
                                                            type: "POST",
                                                            url: "/cc/AjaxCustom/paymentgateway_urls",
                                                            async: false,
                                                            data: {   ag_no : ag_no,  cat : cat,mobile:mobile,dob:dob,customername:customername},
                                                            success: function(data) {
                                                                                              // .done(function( data ) 
                                                                                              //     {
                                                                                                     dd=JSON.parse(data)  
                                                                                                     console.log(dd);
                                                                                                     if(dd.ReturnID!=0)
                                                                                                     {

                                                                                                          bootbox.alert("Dear customer, If you wish to change your loan repayment account to another account, you would be required to pay the swapping charges and submit the new account details to us. <br><br><a class=\"uderline\" href=\""+dd.ReturnURL+"\" target=\"_blank\">Please click here </a> to pay now.<br><br><p style=\"color:red;\">Please note that the EMI deduction is subject to receipt of new bank details / required documents and subject to approvals.</p>",function(){ location.reload(); });

                                                                                                                                                                                                                      
                                                                                                         
                                                                                                      // die();
                                                                                                      return;
                                                                                                     }   
                                                                                                     else
                                                                                                     {
                                                                                                        
                                                                                                         }  
                                                                                                        bootbox.alert("Dear Customer, Repayment swapping is applicable only for the live loans. Your request can’t be processed since your loan is not active.",function(){ location.reload(); });
                                                                                                       
                                                                                                      // die(); 
                                                                                                      return; 
                                                                                                      die();                                                                                        
                                                                                                        
                                                                                                  }
                                                                                              });
                                                                                             
                                                  }

                                                  if(cat==77)//insurance 77   
                                                  {

                                                    $.ajax({
                                                                    type: "POST",
                                                                    url: "/cc/AjaxCustom/apiHITSfor_digitization",
                                                                    async: false,
                                                                    data: {   method : 'getapimessage',  ag_no : ag_no,  cat : cat,mobile:mobile},
                                                                    success: function(data) {
                                                                        
                                                                            // dd=d;
                                                                            var dd="";

                                                                            if(data.length<=94)
                                                                            {
                                                                            d = data.replace(/(\r\n|\n|\r)/gm, "");
                                                                            dd=JSON.parse(d)
                                                                            dd=JSON.parse(dd)                                                                            
                                                                            }
                                                                           var agg_no= ag_no.split('_')



                                                                                var r="";

                                                                                 if(dd.Status_Code!=0)
                                                                                 {
                                                                                       r = "Please click here <a class=\"uderline\" target=\"_blank\" href=\"https://customeroperationapi.tvscredit.com/InsuranceRenewal/InsurancecopyRenewalDocuments?AgreementNo="+agg_no[1]+"\">-https://..</a>to download the Insurance Copy.";  
                                                                                 }
                                                                                 else
                                                                                 {
                                                                                      r = "Sorry, we could not find the document.";

                                                                                 }

                                                                                  bootbox.alert(r,function(){ location.reload(); });

                                                                                                                                                                                                  
                                                                                 return;
                                                                              die();
                                                                            } 
                                                                        });

                                                  }
                                                  if(cat==1812)//1812 CD- NDC softcopy
                                                  {
					                                                     				$.ajax({
					                                                                    type: "POST",
					                                                                    url: "/cc/AjaxCustom/cdndc",
					                                                                    async: false,
					                                                                    data: {   method : 'getapimessage',  ag_no : ag_no,  cat : cat,mobile:mobile},
					                                                                    success: function(data) {

					                                                                        // console.log(data)
					
					                                                                        var s=data.toLowerCase();
					                                                                        // let strippedHtml = s.replace(/<[^>]+>/g, '');

					                                                                        // console.log(s)

													                                                        if(s.includes("no data found") !== false)
													                                                        {
													                                                            // console.log(s)

													                                                            bootbox.alert("Sorry, we could not find the document.",function(){ location.reload(); });
													                                                        }
													                                                        else
													                                                        {
													                                                              const myArray = ag_no.split("_");
													                                                                                    var href='https://rmsnew.tvscredit.com/rms/Jasper?AGRNO='+myArray[1]+'&report=NOC_FOR_CDPORTFOLIO.pdf';
													                                                                                     bootbox.alert("CD NDC soft copy can be downloaded through customer portal & Saathi app.  <a class=\"uderline\" target='_blank' href='"+href+" '>Click here to download</a>",function(){ location.reload(); });
													                                                        }




													                                                  
													                                                                                  

													                                                                                      return; 
													                                                                                     die();     
													                                                                                     } 

													                                                            });
								                                                            
		                                            }

									                                                   if(cat==86) //86 statement of amount req soft copy
									                                                  {


									                                                            // $("#ex112").html('');
									                                                            var hard="hard";
									                                                            var soft = "soft";

									                                                           bootbox.alert('<div style="display: flex;justify-content: space-around;flex-direction: column"><p style="font-size: larger;">Your loan statement copy can be downloaded through customer portal & Saathi app.<span value="soft" class="uderline"  onclick="soa(\'soft\')" style="font-weight:800; cursor: pointer;"> Click here to download Soft Copy </span></p><br><br><p style="font-size: larger;" > Hard copy of loan statement is chargeable.<span style="font-weight:800;   cursor: pointer;" value="hard" class="uderline" onclick="soa(\'hard\')"> Click here </span>to make the payment and place your request.  </p><br></div>',function(){ location.reload(); });
									                                                             
									                                                            // die();
									                                                            return;
									                                                            die();


									                                                            
									                                                        
									                                                  
									                                                }

                                                   
                                                    
                                   
								});
					}
else
{
	submit_variable=0;
	$('#rn_empFormSubmit_37_Button').submit();
													                    
}
});
});

var test=$('#agreement_no').val();
function agg_val()
        {
             test=$('#agreement_no').val();
            
            
        }
function agg_reload()
        {
            // var test=document.getElementById("rn_agreementSelect_29_Incident.CustomFields.CO.Loan.ID").value
            if(test)
            {
                
                var cat=document.getElementById('rn_ProductCategoryInputEmpCustomer_29_Button_Visible_Text').innerHTML="";
					        
					         // document.getElementById('rn_SelectionInput_31_Incident.CustomFields.c.preferred_address').value="";
					         // document.getElementById('rn_TextInput_33_Incident.CustomFields.c.dispatchaddress').value="";
					         // document.getElementById('pincode').value="";
					         document.getElementById('rn_TextInput_35_Incident.Threads').value="";
					         document.getElementById('rn_TextInput_28_Incident.Subject').value="";
                // $('select[name="formData[Incident.Category]"').trigger("change");


                


               
                
            }
            
        }


	</script>