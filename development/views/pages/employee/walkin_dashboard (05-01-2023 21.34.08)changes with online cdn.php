<rn:meta title="Walkin Dashboard" template="employee_header.php" clickstream="employee_walkin_dashboard" login_required="true" force_https="true" />
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
    <h1>Walkin Dashboard</h1>
  </div>
</div>
<div class="rn_AskQuestion rn_Container">
  <iframe src="https://tms.tvscredit.com/ValidateUser/GetReport?auth=e4a517751a95b256fd16990c6fe19ed6&emp_id=<?php echo $md5EmployeeCode; ?>" style="border:none; width: 100%; height:900px;"></iframe>
</div>
<div class="rn_AskQuestion rn_Container">
  

<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"  rel="stylesheet" >
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TVS-TMS::Dashboard</title>
		 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="icon" href="https://tms.tvscredit.com/resources/images/Tvscs_Logo.png" sizes="32x32" />
        <link rel = "stylesheet" href  = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">    
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" rel="stylesheet">


        <link href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.css" rel="stylesheet">
        
        <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

        
		
    </head>
    <body class="nav-sm footer_fixed">
		
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.0/jquery.timepicker.css" integrity="sha512-WlaNl0+Upj44uL9cq9cgIWSobsjEOD1H7GK1Ny1gmwl43sO0QAUxVpvX2x+5iQz/C60J3+bM7V07aC/CNWt/Yw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		
		<script src="https://tms.tvscredit.com/resources/js/jquery-ui.js"></script>
		<script src="https://tms.tvscredit.com/resources/js/datatables.js"></script>
		<link href="https://tms.tvscredit.com/resources/css/jquery-ui.css" rel="stylesheet">
        <script src="https://tms.tvscredit.com/resources/css/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://tms.tvscredit.com/resources/js/jquery.timepicker.js"></script>
                <script src="https://tms.tvscredit.com/resources/js/dropDown.js"></script>

				
				
		
        
<!--            <div class="loding-div">
                <div class="lds-ripple"><div></div><div></div></div>
            </div>-->
	 <style>
    .tooltip-inner{
        white-space: nowrap;
    }
        #example_filter, .alert-success{
        display: none;
    }
    .new-serivce-status {
    padding: 0 7px 2px;
    background: #f0ad4e;
    color: #fff;
    margin-top: 2px;
    width: 131px;
    display: inline-block;
    border-radius: 2px;
    font-size: 11px;
    border: 1px solid #d48b25;
}
  .open-status   {
    padding: 0 7px 2px;
    background: #73c273;
    color: #fff;
    margin-top: 2px;
     width: 131px;
    display: inline-block;
    border-radius: 2px;
    font-size: 11px;
    border: 1px solid #1b8258;
}
 .close-status{
    padding: 0 7px 2px;
    background: #e84e40;
    color: #fff;
    margin-top: 2px;
     width: 131px;
    display: inline-block;
    border-radius: 2px;
    font-size: 11px;
        border: 1px solid #a9281c;
}
#example td:nth-child(1) {text-align : center;}
#example td:nth-child(2) {text-align : left;}
#example td:nth-child(3) {text-align : left;}
#example td:nth-child(4) {text-align : center;}
#example td:nth-child(5) {text-align : center;}
#example td:nth-child(6) {text-align : center;}
#example td:nth-child(7) {text-align : left;}
#example td:nth-child(8) {text-align : left;}
#example td:nth-child(9) {text-align : left;}
#example td:nth-child(10) {text-align : center;}
#example td:nth-child(11) {text-align : center;}
#example td:nth-child(12) {text-align : center;}
#example td:nth-child(13) {text-align : center;}
#example td:nth-child(14) {text-align : center;}
#example td:nth-child(15) {text-align : center;}
#example td:nth-child(16) {text-align : center;}
#example td:nth-child(17) {text-align : center;}
#example td:nth-child(18) {text-align : left;}
#example td:nth-child(19) {text-align : left;}
.inline-span input, .inline-span select {
    max-width: 112px;
    padding: 6px 6px;
}
</style>
<script>
    $(document).ready(function () {
            
                            var branchcode = ["3000","3001","3002","3003","3004","3005","3006","3007","3008","3009","3010","3011","3012","3013","3014","3015","3016","3017","3018","3019","3020","3021","3022","3023","3024","3025","3026","3027","3028","3029","3030","3031","3032","3033","3034","3035","3036","3037","3038","3039","3040","3041","3042","3043","3044","3045","3046","3047","3048","3049","3050","3051","3052","3053","3054","3055","3056","3057","3058","3059","3060","3061","3062","3063","3064","3065","3066","3067","3068","3069","3070","3071","3072","3074","3075","3076","3077","3078"];
                            var productcode = ["AL","BL","CA","CD","CP","CT","CV","DC","EG","LN","LT","MS","RC","RT","RV","TR","TT","TW","UT","UV"];
                            var employeecode = ["5000075","5000077","5000088","5000734","5000736","5001837","5001873","5001969","5002309","5002635","5002640","5003043","5003205","5003845","5004276","5004855","5005264","5006686","5006773","5007040","5008851","5009236","5009576","5009907","5010386","5010395","5011148","5012024","5012390","5012547","5013685","5013812","5014034","5014554","5015993","5016319","5016536","5016599","5017276","5017689","5018350","5019142","5019330","5019767","5020142","5020194","5020203","5020305","5020408","5020522","5020602","5020612","5021139","5021178","5021523","5021817","5022311","5022358","5022470","5022925","5023102","5023363","5023364","5023649","5023801","5023934","5024050","5024592","5025542","5025811","5026161","5026880","5026921","5026927","5026967","5026972","5027125","5027136","5027284","5027347","5027649","5027715","5027809","5028522","5028527","5029021","5029465","5029689","5029924","5032951","5033954","5037105","5040164","5041013","5050994"];
                            var kioskusername = ["BANGALORE","CHENNAIBRISTOL","COIMBATORE","dinesh","HYDERABAD","INDORE","JAIPUR","KOLKATA","LUCKNOW","MADURAI","NEWDELHI","PUNE"];
//                            console.log(employeecode);
                            
                            
                            $( "#branch_search" ).autocomplete({
                              source: branchcode
                            });
                            $( "#pcode_search" ).autocomplete({
                              source: productcode
                            });
                            $( "#ecode_search" ).autocomplete({
                              source: employeecode
                            });
                            $( "#uname_search" ).autocomplete({
                              source: kioskusername
                            });
							$( "#agreement_search" ).autocomplete({
                              source: agreementnumber
                            });
              
        listing();
        $('.from_date').datepicker({
            maxDate: 0,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-M-yy',
            onSelect: function (selected) {
                var endDate, dateSplit;
                dateSplit = selected.split("-");
                endDate = new Date(dateSplit[1] + " " + dateSplit[0] + ", " + dateSplit[2]);
                $(".to_date").datepicker("option", "minDate", endDate);
                       
                //searchBankDeposition();
            }
            });
            
       
        $('.to_date').datepicker({
            maxDate: 0,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-M-yy',
//            onSelect: function (selected) {
//                searchBankDeposition();
//            }
        });
        $('.seccessMsg').delay(4000).fadeOut(400);
        
        
        $("#branch_search").keypress(function(e) {
            if(e.which === 13) {
                e.preventDefault();
            $("#search").click();
            }
        });
        
         $("#pcode_search").keypress(function(e) {
            if(e.which === 13) {
                e.preventDefault();
            $("#search").click();
            }
        });
        
         $("#ecode_search").keypress(function(e) {
            if(e.which === 13) {
                e.preventDefault();
            $("#search").click();
            }
        });
        
         $("#uname_search").keypress(function(e) {
            if(e.which === 13) {
                e.preventDefault();
            $("#search").click();
            }
        });
        
		$("#agreement_search").keypress(function(e) {
            if(e.which === 13) {
                e.preventDefault();
            $("#search").click();
            }
        });
    
    });
    
   
    

    
    //---------
    $(function () {

         $("#form").validate({
			//ignore:['hidden'],
            rules: {
                from_date: {
                    required: function(element){
                        return $("#to_date").val()!='';
                    }
                },
                to_date: {
                    required: function(element){
                        return $("#from_date").val()!='';
                    }
                },
                uname_search:{
//                    required: true,
                },
                ecode_search:{
//                    required: true,
                },
                branch_search:{
//                        required: true,
//                        check_branch : true,
                },
                status_search:{
//                    required: true,
                },
                pcode_search:{
//                        required:true,
                },
                
            },
            messages: {
                from_date: {
                    required: 'Please Select From Date.',
                },
                to_date: {
                    required: 'Please Select To Date.',
                },
//                uname_search:{
////                    required: 'Please Enter User ID To Search',
//                },
//                ecode_search:{
////                    required: 'Please Enter Employee Code To Search',
//                },
//                branch_search:{
////                        required:'Please Enter Branch Code To Search',
//                },
//                status_search:{
////                        required:'Please Select Status to Search',
//                },
//                pcode_search:{
////                        required:'Please Product Code to Search',
//                },
                                        
            }
        });
        
        
        
	
		$("#search_type").change(function(e) {
			
			$("label.error").hide();
			var search_type=$("#search_type").val();
                        
//                        alert(search_type);
			
			if(search_type == 'B'){
				$(".date_box").hide();
				$(".branch_box").show();                                
                                $(".ecode_box").hide();
                                $(".uname_box").hide();
                                $(".status_box").hide();
                                $(".pcode_box").hide();
                                $("#branch_search").focus();
                                $("#pcode_search").val('');
                                $("#status_search").val('');
				$("#from_date").val('');
				$("#to_date").val('');
                                $("#ecode_search").val('');
                                $("#uname_search").val('');
				
			} 
                        else if(search_type == 'EC'){
                                $(".date_box").hide();
				$(".branch_box").hide();
                                $(".ecode_box").show();
                                $(".uname_box").hide();
                                $(".status_box").hide(); 
                                $(".pcode_box").hide();
                                $("#ecode_search").focus();
                                $("#pcode_search").val('');
				$("#from_date").val('');
				$("#to_date").val('');                                
                                $("#uname_search").val('');
                                $("#branch_search").val('');                                
                                $("#status_search").val('');
                        }
                        else if(search_type == 'UN'){
                                $(".date_box").hide();
				$(".branch_box").hide();
                                $(".ecode_box").hide();
                                $(".uname_box").show();
                                $(".status_box").hide();
                                $(".pcode_box").hide();
                                $("#uname_search").focus();
                                $("#pcode_search").val('');
				$("#from_date").val('');
				$("#to_date").val('');
                                $("#ecode_search").val();                                
                                $("#branch_search").val('');
                                $("#status_search").val('');
                        }
                        else if(search_type == 'S'){
                                $(".status_box").show();
				$(".date_box").hide();
				$(".branch_box").hide();
                                $(".ecode_box").hide();
                                $(".uname_box").hide();
                                $(".pcode_box").hide();
                                $("#status_search").focus();
                                $("#pcode_search").val('');
                                $("#from_date").val('');
				$("#to_date").val('');
				$("#branch_search").val('');
                                $("#ecode_search").val('');
                                $("#uname_search").val('');
				
			}
                        else if(search_type == 'D'){
				$(".date_box").show();
				$(".branch_box").hide();
                                $(".ecode_box").hide();
                                $(".uname_box").hide();
                                $(".status_box").hide();
                                $(".pcode_box").hide();
//                                $("#from_date").focus();  
                                
                                $("#pcode_search").val('');
				$("#branch_search").val('');
                                $("#ecode_search").val('');
                                $("#uname_search").val('');
                                $("#status_search").val('');
				
			}
                        else if(search_type == 'PC'){
				$(".date_box").hide();
				$(".branch_box").hide();
                                $(".ecode_box").hide();
                                $(".uname_box").hide();
                                $(".status_box").hide();
                                $(".pcode_box").show();
                                $("#pcode_search").focus();                                
                                $("#from_date").val('');
				$("#to_date").val('');
				$("#branch_search").val('');
                                $("#ecode_search").val('');
                                $("#uname_search").val('');
                                $("#status_search").val('');
				
			}
                        
			
		});
                
//                  $("").change(function(e) {
//                                alert();
//                   });
		
                $("#ecode_search").keyup(function() {
                    var ecode_search=$("#ecode_search").val();
//                    alert(ecode_search);
			if($("#ecode_search").val()==''){				
				var table = $('#example').DataTable();
				table.destroy();
				listing();
			}
		});
                $("#uname_search").keyup(function() {
			//alert();
			if($("#uname_search").val()==''){
				//alert();	
				var table = $('#example').DataTable();
				table.destroy();
				listing();
			}
		});
                $("#status_search").keyup(function() {
			//alert();
			if($("#status_search").val()==''){
				//alert();	
				var table = $('#example').DataTable();
				table.destroy();
				listing();
			}
		});
                $("#pcode_search").keyup(function() {
			//alert();
			if($("#pcode_search").val()==''){
				//alert();	
				var table = $('#example').DataTable();
				table.destroy();
				listing();
			}
		});     
    });
    
    
    $(document).on('click', "#clear", function (e) {
        
        $("label.error").hide();
        var search_type=$("#search_type").val();
        
        if ($("#search_type").val() == search_type) {    
            $("#from_date").val("");
            $("#to_date").val("");
            $("#pcode_search").val("");
            $("#branch_search").val("");
            $("#ecode_search").val("");
            $("#uname_search").val("");
            $("#status_search").val("");
			$("#agreement_search").val(""); 
            $("#search_type").val(search_type);
            var table = $('#example').DataTable();
            table.destroy();
            listing();
        }
    
    });
    
    
    $(document).on('click', "#search", function (e) {
//        var form = $( "#form" );
$("#form").valid();

        if (($("#from_date").val().length > 0) && ($("#to_date").val().length > 0)) {
            var table = $('#example').DataTable();
            table.destroy();
            listing();
        } 
            else if($("#branch_search").val() != ''){
			var table = $('#example').DataTable();
            table.destroy();
            listing();
		}
                else if($("#status_search").val() != ''){
			var table = $('#example').DataTable();
            table.destroy();
            listing();
		}
                else if($("#pcode_search").val() != ''){
			var table = $('#example').DataTable();
            table.destroy();
            listing();
		}
                else if($("#ecode_search").val() != ''){                    
			var table = $('#example').DataTable();
            table.destroy();
            listing();
		}
                else if($("#uname_search").val() != ''){                    
			var table = $('#example').DataTable();
            table.destroy();            
            listing();
		}
				else if($("#agreement_search").val() != ''){  
			var table = $('#example').DataTable();
            table.destroy();            
            listing();
		}       
    });
    /*
    $(document).on('click', "#search", function (e) {

        if (($("#from_date").val().length > 0) && ($("#to_date").val().length > 0) && $("#search_type").val()=='D') {
            var table = $('#example').DataTable();
            table.destroy();
            listing();
        } 
            else if($("#search_type").val()=='B' && $("#branch_search").val() != ''){
			var table = $('#example').DataTable();
            table.destroy();
            listing();
		}
                else if($("#search_type").val()=='S' && $("#status_search").val() != ''){
			var table = $('#example').DataTable();
            table.destroy();
            listing();
		}
                else if($("#search_type").val()=='PC' && $("#pcode_search").val() != ''){
			var table = $('#example').DataTable();
            table.destroy();
            listing();
		}
                else if($("#search_type").val()=='EC' && $("#ecode_search").val() != ''){                    
			var table = $('#example').DataTable();
            table.destroy();
            listing();
		}
                else if($("#search_type").val()=='UN' && $("#uname_search").val() != ''){                    
			var table = $('#example').DataTable();
            table.destroy();            
            listing();
		}
                
    });
	*/
    function listing() {
        $('.loding-div-inner').show();
        var table = $('#example').DataTable();
        table.destroy();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var search_type = $('#search_type').val();
	var branch_code=$('#branch_search').val();                            
        var ecode_code=$("#ecode_search").val();
        var uname_code=$("#uname_search").val();
        var status_code=$("#status_search").val();
        var product_code=$("#pcode_search").val();
        var agreement_code = $("#agreement_search").val();
		
        var oTable = $('#example').dataTable({
            "bProcessing": true,
            "bFilter": false,
            "bSort": false,
            "bServerSide": true,
            "sAjaxSource": 'https://tms.tvscredit.com/Reports/listing',
            drawCallback: function (settings) {
                 $('.loding-div-inner').hide();
                var api = this.api();
                $('td', api.table().container()).each(function () {
                    var attr = $(this).find('a').attr('data-original-title');
                    if (typeof attr !== typeof undefined && attr !== false) {
                        $(this).find('a').tooltip({placement: 'left'});
                    }
			var attr_span = $(this).find('span').attr('data-original-title');

			if (typeof attr_span !== typeof undefined && attr_span !== false) {
			    $(this).find('span').attr('title', attr);
			    $(this).find('span').tooltip({placement: 'left'});
			}
                });
            },
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayLength":20,
            "oLanguage": {
                //"sProcessing": "<img src='https://tms.tvscredit.com/resources/images/ajax-loader_dark.gif'>"
            },
            "fnInitComplete": function () {
                 $('.loding-div-inner').hide();
                //oTable.fnAdjustColumnSizing();
            },
            'fnServerData': function (sSource, aoData, fnCallback)
            {
                 $('.loding-div-inner').show();
                $(".dataTables_length").remove();
                             $('.dataTables_processing').remove();
                aoData.push({"name": "from_date", "value": from_date});
                aoData.push({"name": "to_date", "value": to_date});
                aoData.push({"name": "branch_code", "value": branch_code});
                aoData.push({"name": "search_type", "value": search_type});
                aoData.push({"name": "status_code", "value": status_code});
                aoData.push({"name": "ecode_code", "value": ecode_code});
                aoData.push({"name": "uname_code", "value": uname_code});
                aoData.push({"name": "product_code", "value": product_code});
                aoData.push({"name": "agreement_code", "value": agreement_code});
				
                aoData.push({"name": "csrf_test_name", "value": "77927f20bc80d4af07f4df56f1a5cf70"});
                $.ajax
                        ({ 
                            'dataType': 'json',
                            'type': 'POST',
                            'url': sSource,
                            'data': aoData,
                            'success': fnCallback
                        });

            }
        });
    }
	
	
</script>

</head>
<body>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                  
                        <div class="x_title">
                            <div class="row customer-info-row">
                                <div class="col-xs-12 col-sm-2 col-md-3">
                                    <h2>Token Generation Report</h2>
                                </div>
                               
                                <!--<form name="form" id="form" action="https://tms.tvscredit.com/Reports/index" method="POST">-->
                                 <form action="https://tms.tvscredit.com/Reports/index" name="form" id="form" method="POST" accept-charset="utf-8">
                                    <input type="hidden" name="csrf_test_name" value="77927f20bc80d4af07f4df56f1a5cf70" />
                                <div class="col-xs-12 col-sm-10 col-md-9 text-right">
				
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:5px;">
<!--                                    <span class="inline-span">
                                        input type="search" id="serach" name="" value="" placeholder="Search Branch Code"  class="form-control"
                                        <select class="form-control" id="search_type">
                                                <option value="D">Date</option>
                                                <option value="B">Branch Code</option>
                                                <option value="PC">Product Code</option>
                                                <option value="S">Status</option>
                                                <option value="EC">Employee Code</option>
                                                <option value="UN">User ID</option>
                                        </select>
										
                                        <span class="red"></span>
                                    </span>-->
                                    <span class="inline-span date_box">
                                        <input type="text" id="from_date" name="from_date" value="" placeholder="From Date" readonly="" data-date-format="DD-MM-YYYY" size="16" class="form-control from_date">
                                        <span class="red"></span>
                                    </span>
                                    <span class="inline-span date_box">
                                        <input type="text" id="to_date" name="to_date" value="" placeholder="To Date" readonly="" data-date-format="DD-MM-YYYY" size="16" class="form-control to_date">
                                        <span class="red"></span>
                                    </span>
                                    <span class="inline-span branch_box" >
                                             <input type="search" id="branch_search" name="branch_search" value="" placeholder="Branch Code"  class="form-control branch_search">
                                             <span class="red"></span>
                                    </span>
                                    <span class="inline-span ecode_box" >
                                             <input style="max-width:125px;" type="search" id="ecode_search" name="ecode_search" value="" placeholder="Employee Code"  class="form-control ecode_search">
                                             <span class="red"></span>
                                    </span>
                                    <span class="inline-span uname_box" >
                                             <input type="search" id="uname_search" name="uname_search" value="" placeholder="User ID"  class="form-control uname_search" >
                                             <span class="red"></span>
                                    </span>
                                    <span class="inline-span pcode_box" >
                                             <input type="search" id="pcode_search" name="pcode_search" value="" placeholder="Product Code"  class="form-control pcode_search" >
                                             <span class="red"></span>
                                    </span>
									<span class="inline-span agreement_box" >
                                             <input style="max-width:140px;" type="search" id="agreement_search" name="agreement_search" value="" placeholder="Agreement Number"  class="form-control agreement_search" >
                                             <span class="red"></span>
                                    </span>
                                    <span class="inline-span status_box" >
                                             <!--<input type="search" id="status_search" name="status_search" value="" placeholder="Search Employee Name"  class="form-control ename_search" required="required">-->
                                             <select style="max-width:125px;" class="form-control" id="status_search" name = "status_search">
                                                    <option value="">Select Status</option>
                                                    <option value="OPEN">OPEN</option>
                                                    <option value="CLOSED">CLOSED</option>
                                                    <option value="CAC">New Service Request</option>
                                            </select>
                                             <span class="red"></span>
                                    </span>
                                    <span class="inline-span">
                                        <button type="button" class="btn btn-orange" id="search">Search</button> 
                                    </span>
                                    <span class="inline-span">
                                        <button type="button" class="btn btn-warning" id="clear">Clear</button> 
                                    </span>
                                    <span class="inline-span">
                                        <input type="submit" class="btn btn-round btn-primary" value="Download">
                                    </span>
                                </div>
                               </form>
                            </div>
                            <div class="clearfix"></div>
                        </div> 
                        <div class="text-center">
                            <div class="seccessMsg form-inline" style="display: none;">
                                <div class="alert alert-success ">
                                    
                                </div>
                            </div>
                            						 
			</div>

                    <div class="form-group">
                        <div class="loding-div-inner">
                                    <div class="lds-ripple"><div></div><div></div></div>
                                </div>
                        <table id="example" border="1" cellpadding="2" cellspacing="1" class="table table-striped table-bordered dataTable table-hover">
<thead>
<tr>
<th>Sr.No.</th><th>Token Id</th><th>Customer Name</th><th>Mobile</th><th>Alternate Mobile</th><th>Agreement Number</th><th>Token Request ID</th><th>Token Date and Time</th><th>Email ID</th><th>User ID</th><th>User Name</th><th>Status</th><th>Employee Code</th><th>Employee name</th><th>Product Code</th><th>Purpose of Visit</th><th>Branch Code</th><th>Branch Name</th><th>Remark</th></tr>
</thead>
</table>                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  </div>