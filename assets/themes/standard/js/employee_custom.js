var form=$("#new_lead_form");	

    /*    jQuery(document).ready(function ($) {
            /* jQuery activation and setting options for first tabs
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
			//	var form=$("#new_lead_form");
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
				});
		});
*/
	

$(function() {
	//		$( "#date_of_birth" ).datepicker();
	var max_pickup_Date = new Date();
	$('#date_of_birth').datetimepicker({
		format:'DD/MM/YYYY',
		maxDate :max_pickup_Date,
		useCurrent: false
	});

	var current = new Date();
	
	var month = "";
	if(current.getMonth()<9){
		month = "0"+(current.getMonth()+1);
	}
	else{
		month = (current.getMonth()+1);
	}

	var date = current.getDate();
	var year = current.getFullYear();
	var todayDate = date+"/"+month+"/"+year;

	$('#date_of_birth').on('dp.change',function(e){
		var dob = $(this).val();
		var dobe = e.date;
		console.log(dob, dobe);
		// console.log(todayDate == dob);
		// console.log(todayDate,dob);
		if(todayDate == dob){
			alert("The DOB cannot be the same as today date.");
			$('#date_of_birth').data("DateTimePicker").date(null);

		}
	});

});
		
		
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
						tvsApi:	tvsapiurl
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
						tvsApi:	tvsapiurl
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
		$("#loanList").click(function(){
			$.ajax({
				url: '/cc/DealerCustom/getProductsName',
				method: 'post',
				success: function(response) {
				  var response_decoded = JSON.parse(response);
				  for (var i = 0; i < response_decoded.length; i++) {
				  	// console.log(response_decoded[i].szdesc);
				  	$('Select[name="loan_type"').append(`<option value="${response_decoded[i].szproductcode}"> 
	                                       ${response_decoded[i].szdesc} 
	                                  </option>`);
				  }
				}
			});
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
						tvsApi:	tvsapiurl
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
						tvsApi:	tvsapiurl
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
	/*	$("#stateList").click(function() {
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
						tvsApi:	tvsapiurl
					};
				$.getJSON("/cc/AjaxCustom/getState", data, function (response) {
					//console.log(response);
					//alert(response);
					/*$.each(response.items, function(i,item){
						// Create and append the new options into the select list
						$("#stateList").append("<option value="+item.szstatecode+">"+item.szdesc+"</option>");
					});
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
						tvsApi:	tvsapiurl
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
*/
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
					/*	methodName: "GetVCityName",
						agencyCode: 'TVSCRM',
						statecode: $('#stateList :selected').val(),*/
						tvsApi:	tvsapiurl,
						agencyCode: 'TVSCRM',
						statecode: $('#stateList :selected').val(),
					};
				$.getJSON("/cc/AjaxCustom/getCity", data, function (response) {
					
					var html = '';
				//	var json_obj = jQuery.parseJSON( response );
					//var len = response.length;
				//	alert(len);
					//console.log(response);
					var len = response.length;
					//alert(len);
					for (var i=0;i< len;i++) {
						html += '<option value="' + response[i].City_Code + '">' + response[i].City_Name + '</option>';
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
						tvsApi:	tvsapiurl
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
						tvsApi:	tvsapiurl
					};
				$.getJSON("/cc/AjaxCustom/get_Make_Rest", data, function (response) {
					
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
						year: $('#yearList :selected').val(),//'1997',
						tvsApi:	tvsapiurl
					};
				$.getJSON("/cc/AjaxCustom/get_Make_Rest", data, function (response) {
					
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
						tvsApi:	tvsapiurl
					};
				$.getJSON("/cc/AjaxCustom/get_Model_Rest", data, function (response) {
					
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
						tvsApi:	tvsapiurl
					};
				$.getJSON("/cc/AjaxCustom/get_Model_Rest", data, function (response) {
					
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
						tvsApi:	tvsapiurl
					};
				$.getJSON("/cc/AjaxCustom/get_Variant_Rest", data, function (response) {
					
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
						tvsApi:	tvsapiurl
					};
				$.getJSON("/cc/AjaxCustom/get_Variant_Rest", data, function (response) {
					
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
						tvsApi:	tvsapiurl
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
						tvsApi:	tvsapiurl
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
						tvsApi:	tvsapiurl
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
