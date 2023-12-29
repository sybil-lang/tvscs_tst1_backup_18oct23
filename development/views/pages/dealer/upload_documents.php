<rn:meta title="Upload document" template="dealer_header.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 1000px;
}
     .z-container{
        width: 1230px;
    }
select{
    background-color: white;
    border: 0px;
    box-shadow: 2px 2px 10px 2px rgba(0, 0, 0, 0.14) !important;
    border-radius: 30px;
    width: 280px !important;
    margin-left: 41px;
}
.right
{
	margin-left: 38%;
}
</style>
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('dealer');

//echo ($this->uri->segment('1'));
//echo $agg_no = \RightNow\Utils\Url::getParameter('ag_id');
/*$pros_no = \RightNow\Utils\Url::getParameter('p_id');
list($pros_no,$agg_no) = explode("_",$pros_no);
if(!empty($agg_no)){
	$agreement_id = $agg_no;
}elseif(empty($agg_no) && !empty($pros_no)){
	$agreement_id = $pros_no;
}
*/
?>
	<!-- Zozo Tabs css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />

     <!-- Zozo Tabs Flat Themes css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />
    
    <!-- Zozo Tabs js -->
    <script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

<!-- Datatable CSS and JAVAScript -->
<!--	<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />
-->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-theme.min.css">  
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">


<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>



<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>


<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/buttons/1.2.3/css/buttons.dataTables.min.css" rel="stylesheet" />


<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"> </script>

<script type="text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"> </script>

<script type="text/javascript" src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"> </script>

<script type="text/javascript" src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"> </script>

<script type="text/javascript" src = "//cdn.datatables.net/buttons/1.2.3/js/buttons.html5.min.js"> </script>

<script src="//cdn.datatables.net/plug-ins/1.10.13/api/fnReloadAjax.js"></script>
<!--<script src="/euf/assets/themes/standard/js/jquery.nice-select.js"></script>

<link rel="stylesheet" href="/euf/assets/themes/standard/css/nice-select.css">-->
<style type="text/css">
	#docs_upload_main div{
		padding-left: 40px;

	}
</style>

        <h1 style="padding-left: 15px;padding-top: 10px;">Upload Document</h1>
  
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
   <center>
	  <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
	</center>
</div>
<div class="rn_PageContent ">
    <div class="rn_ContentDetail full_width">
	<div id="page">
		
        <!-- Zozo Tabs Start-->
        <div style="text-align: center;background-color: #ECF0F1;    height: 150px;" id="Agreement_no">
        	<h1 style="padding-top:15px;">PLEASE SELECT AGREEMENT NO</h1>
        	<select id="agg_no_docs" oninput ="displayupload_forms(document.getElementById('agg_no_docs').value);" >
        		<option value="" disabled selected>--Select--</option>
        		<!-- <option disabled></option> -->
        	</select>
        </div>
        
        <div class="card" id="docs_upload_main">
	        <p id="error-msgs"></p>
	        <div id="Insurance_div" style="display: none;">
	        	<h3>Insurance</h3>
	        	<p style="padding:0px 45px 20px;"><strong>NOTE: </strong>File should be less than 1MB and it should be (jpeg/png)</p>

	        	<form id="Insurance_form" method="post" name="Insurance_form" enctype="multipart/form-data" >
	        		<input type="hidden" name="agmt" id="Insurance_agmt">
	        		<input type="hidden" name="type" id="Insurance_type">
	        		<input type="hidden" name="dealer" id="Insurance_dealer">
	        		<input type="hidden" name="divname" value ="Insurance">
	        		<input type="hidden" name="contact" value ="<? echo $contact_id; ?>">


	        	</form>
	        </div>
	        <div id="Invoice_div" method="post" style="display: none;">
	        	<h3>Invoice</h3>
	        	<p style="padding:0px 45px 20px;"><strong>NOTE: </strong>File should be less than 1MB and it should be (jpeg/png)</p>

	        	<form id="Invoice_form" name="Invoice_form" enctype="multipart/form-data" >
	        		<input type="hidden" name="agmt" id="Invoice_agmt">
	        		<input type="hidden" name="type" id="Invoice_type">
	        		<input type="hidden" name="dealer" id="Invoice_dealer">
	        		<input type="hidden" name="divname" value ="Invoice">
	        		<input type="hidden" name="contact" value ="<? echo $contact_id; ?>">


	        	</form>
		       
	        </div>
	        <div id="RCB_div" method="post" style="display: none;">
	        	<h3>RCB</h3>
	        	<p style="padding:0px 45px 20px;"><strong>NOTE: </strong>File should be less than 1MB and it should be (jpeg/png)</p>
	        	<form id="RCB_form" name="RCB_form"  enctype="multipart/form-data" >
	        		<input type="hidden" name="agmt" id="RCB_agmt">
	        		<input type="hidden" name="type" id="RCB_type">
	        		<input type="hidden" name="dealer" id="RCB_dealer">
	        		<input type="hidden" name="divname" value ="RCB">
	        		<!-- <input type="hidden" name="divname" value ="Invoice"> -->
	        		<input type="hidden" name="contact" value ="<? echo $contact_id; ?>">
	        		


	        	</form>

		       
	        </div>
        </div>
        <!-- Zozo Tabs End-->
        <script type="text/javascript">
             
             var agg_no; 
             var divname=[];
             divname=['Insurance','Invoice','RCB']
              for(var i=0;i<3;i++)
              {
              	for(var j=0;j<4;j++)

              	{
              		
                   document.getElementById(divname[i]+"_form").innerHTML+='<div style="height:65px"><input accept="image/x-png,,image/jpeg" name="file'+j+divname[i]+'"  type="file" id="'+divname[i]+'_'+j+'form_field'+j+'" ></div>';

                   if(divname[i]=="Invoice"&&j==2)
                   {
                   	j++;
                   }
              	}
                     document.getElementById(divname[i]+"_form").innerHTML+='<div  style="height:65px"><input  type="submit" id="button_'+i+'" onclick="check_Status_of_file(\''+divname[i]+'\',\'button_'+i+'\')" class="btn" value="Upload"></div>';
              }

        	</script>
		</div>
    </div>
    
</div>
<script type="text/javascript">
       


$(document).ready(function()
 {
var param =
		             {
						    'dlc' : "<? echo $dealer_code; ?>",
						    'Cid': "<? echo $contact_id; ?>",
						    
				
			         };
		// param=[]
		// 	param["dlc"]=<? echo $dealer_code; ?>
		// 	param["Cid"]=
 	 $.ajax({
                    url: "/cc/DealerCustom/fetch_aggreement_no",
                    type: "post",
                    data: param,

                    success: function (response)
                    {
                    	var res_final=JSON.parse(response);
                        // console.log('response',res_final);
                        
                        if(res_final.length!=null)
                      {
						// console.log(value)
						      var n   = res_final.length;						     
						      value="";
						      for (var i = 0; i<n; i++)
							   { 
							      // console.log(contact_a)
							      if(res_final[i]!=null)
							      {
							         if(((res_final[i].toLowerCase()).indexOf(value.toLowerCase()))>-1) 
							           { 	
							           	 var node = document.createElement("option"); 
							             // var res = reportcache[i].split(":");
							             // node.value=res[1]
							             var val = document.createTextNode(res_final[i]); 
							             node.appendChild(val); 
							             node.setAttribute("value",res_final[i]);						  
							             document.getElementById("agg_no_docs").appendChild(node); 
							             //creating and appending new elements in data list 
							           } 

							       }
							    } 
						      // document.getElementById('contact_dd').style.display="block"
						  

                       }
                      else
                     {
                         var node = document.createElement("option"); 
							             // var res = reportcache[i].split(":");
							             // node.value=res[1]
							             var val = document.createTextNode("No AGREEMENT No Found"); 
							             node.appendChild(val); 
							             node.setAttribute("value",null);						  
							             document.getElementById("agg_no_docs").appendChild(node);    
                               // $("#impdata input").prop("disabled", true);
                            
                     }
                        
                        
                        
                    },
                    error: function (er)
                    {
                      console.log("Some error",er);
                    },
                    
            });



 	  
});



		function displayupload_forms(agg_no_arg) 

		{
			agg_no=agg_no_arg
			document.getElementById('Insurance_div').style.display='none'
			document.getElementById('Invoice_div').style.display='none'
			document.getElementById('RCB_div').style.display='none'

			var param = {
				'dlc' : "dlc=<? echo $dealer_code; ?>",
				'agg_no': agg_no
				
			};
							$.ajax({
		                    url: "/cc/DealerCustom/upload_document_enabler",
		                    type: "post",
		                    data: param,
		                    beforeSend:function(){
		                    	$('#error-msgs').html("Please wait.....").css("color","#000000").css("padding","20px");
		                    },
		                    success: function (response)
		                    {
		                    	$('#error-msgs').html("");
		                        console.log(response);
		                        if(response!=null)
		                      {
		                            if(response[0]["INSURANCE"]=="N")
		                            {
		                               document.getElementById('Insurance_div').style.display="block"; 
		                            }
		                            if(response[0]["INVOICE"]=="N")
		                            {
		                                // $("#Invoice input").prop("disabled", true);
		                               document.getElementById('Invoice_div').style.display="block"; 

		                            }
		                            if(response[0]["RCB"]=="N")
		                            {
		                                // $("#RCB input").prop("disabled", true);
		                               document.getElementById('RCB_div').style.display="block"; 
		                                
		                            }
		                            
		                      }
		                      else
		                     {
		                            
		                               $("#impdata input").prop("disabled", true);
		                            
		                     }
		                        
		                        
		                        
		                    },
		                    error: function (er)
		                    {
		                      $('#error-msgs').html(er).css("color","red").css("padding","20px");
		                      console.log("Some error",er);
		                    },
		                    
		            });
        }
        $('#button_0').click(function(e){
        	e.preventDefault();
       
        });
          $('#button_1').click(function(e){
        	e.preventDefault();
      
        });
           $('#button_2').click(function(e){
        	e.preventDefault();
        
        });
       

        function check_Status_of_file(divname,btn)
        { 
			var count=0;  

            for(var i=0;i<document.getElementById(divname+'_'+i+'form_field'+i).files.length;i++)
            {	count++;						  
	            if(document.getElementById(divname+'_'+i+'form_field'+i).files.length)
	            { 	
	            	if((document.getElementById(divname+'_'+i+'form_field'+i).files[0].type=="image/jpeg"||document.getElementById(divname+'_'+i+'form_field'+i).files[0].type=="image/png")&&document.getElementById(divname+'_'+i+'form_field'+i).files[0].size<1048576)
	            	{
					        if(divname=="Insurance")
							{
				               $('#button_0').prop('disabled', true);
							}   
							if(divname=="Invoice")
							{
				               $('#button_0').prop('disabled', true);
							} 
							if(divname=="RCB")
							{
				               $('#button_0').prop('disabled', true);
							}
	            	}
	            	else
	            	{
	            		  if(document.getElementById(divname+'_'+i+'form_field'+i).files[0].size>=1048576)
	            	{
	            		alert("Files greater than 1MB can't be uploaded")
	            	} 
	                       return false;
	            	}

	            }

	            	
            }
            if(count==0)
            {
	           
	           alert('No file for upload is selected .Please select a file')            	
	           return false;
	            
            }
                    console.log("in check status")
		        	var div=divname.slice(0,3);

		            var param =
		             {
						    'dlc' : "<? echo $dealer_code; ?>",
						    'agg_no': agg_no,
						    'type':div.toUpperCase()
				
			         };
							$.ajax({
		                    url: "/cc/DealerCustom/statcheck",
		                    type: "post",
		                    data: param,

		                    success: function (response)
		                    {
		                        console.log(response);
		                        if(response[0].PDD_STATUS=="No Upload found for Agreement")
		                      {

		                          set_agg_type_dlc(divname,param) 

		                      }
		                      else
		                     {
		                            
		                              $('#'+divname+'_form :input').prop("disabled", true);
		                              alert("Files already uploaded! Status: In Process")
		                            
		                     }
		                        
		                        
		                        
		                    },
		                    error: function (er)
		                    {
		                      console.log("Some error",er);
		                    },
		                    
		            });        		
        	
        	// 
        	
        }
//          
   function set_agg_type_dlc(divname,param)
           {
             var agg=document.getElementById(divname+'_agmt').value=param["agg_no"];
             var type=document.getElementById(divname+'_type').value=param["type"];
             var dealer=document.getElementById(divname+'_dealer').value=param["dlc"]; 			 			 
             $('#'+divname+'_form').submit();
           }


	     	
jQuery("form#Insurance_form").submit(function(e){  
	console.log("In Submit of inS");
	e.preventDefault();     
	var formData = new FormData(this); 
	console.log(formData);    
   $.ajax({
            url: "/cc/DealerCustom/upload_pdd_files",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response)
            {
                alert(response);                
            },
            error: function (er)
            {
              console.log("Some error",er);
            },
            
     });
});
jQuery("form#Invoice_form").submit(function(e){  
	console.log("In Submit of inS");
	e.preventDefault();     
	var formData = new FormData(this); 
	console.log(formData);    
   $.ajax({
            url: "/cc/DealerCustom/upload_pdd_files",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response)
            {
                alert(response);                
            },
            error: function (er)
            {
              console.log("Some error",er);
            },
            
     });
});
jQuery("form#RCB_form").submit(function(e){  
	console.log("In Submit of inS");
	e.preventDefault();     
	var formData = new FormData(this); 
	console.log(formData);    
   $.ajax({
            url: "/cc/DealerCustom/upload_pdd_files",
            type: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response)
            {
                alert(response);                
            },
            error: function (er)
            {
              console.log("Some error",er);
            },
            
     });
});

	     </script>     
		
   