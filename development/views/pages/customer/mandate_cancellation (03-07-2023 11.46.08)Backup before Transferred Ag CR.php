<!-- LIVE -->
<?php
 $CI=&get_instance();
$CI->load->helper('report');
$contact_id=$CI->session->getProfileData("c_id");
checkCustomerType('customer');
?>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

	<style type="text/css">
    #isload
        {
        height: 80px;
        position: absolute;
        top: 101px;
        right: 599px;
        display:none;
        }
    </style></head>
<body>
     <img id="isload" src="/euf/assets/themes/standard/images/loading-large.gif">
     <?php
     $msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Portal_report_ecs_cancel_customer);
	 $report_id=$msg->Value;

?>
<h4 align="center" style="margin-top:15px;     text-transform: none !important;">Please select the Loan Agreement Number for which you wish to cancel your Bank ECS Mandate</h4>

<form name="form" id="form" action='#' method='post' class="loan-form">
  <fieldset>
  	<div id="statusofloan_mandate"></div>
    <style type="text/css">
	.card {
	    margin-top: 10px;
	    background-color: #fff;
	    box-shadow: 0 20px 30px 0 rgba(0, 0, 0, .03);
	    margin-bottom: 15px;
	    border-radius: 1px;
	    color: #444;
	    border: 0.5px #252525 solid;
	    padding: 20px;
	}
	fieldset{
		background: none;
	}
	.bold-text{
		font-weight: 600;
	}
	.rn_agreementSelect {
    	display: inline-block;
	}
	.btn:click{
		color:white;
	}
	#Mandatesubmitbtn{
	    width: auto;
	    border-radius: 25px;
	    color: white;
	    line-height: 27px;
	    font-size: larger;
	    height: 40px;
	   	padding: 0 20px;
	    background-color: #0e8943;
	}
	#status-div{
		margin:25px -10px;
	}
	#statusreport{
		background-color: white;
		padding: 10px;
	}
	.jconfirm .jconfirm-cell {
    display: table-cell;
    vertical-align: baseline !important; 
}
.jconfirm.jconfirm-white .jconfirm-box .jconfirm-buttons, .jconfirm.jconfirm-light .jconfirm-box .jconfirm-buttons {
    /* float: right; */
    /*width: 50%;*/
    /* display: inline; */
    height: 10%;
    display: flex;
    flex-wrap: nowrap;
}
.btn-green
{
	background-color: green;
	color: white;
	height: 10%;
}
.btn-red
{
	background-color: red;
	color: white;
	height: 10%;
}
.ques-n{
	font-weight: bold;
	color:black;
}
.jconfirm-title-c {
    display: flex !important;
    justify-content: center !important;
}
</style>
<div class="col-sm-12 col-md-12 col-lg-12" id="contemt-main">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12" id="status-div">
			
		</div>
		<input type="hidden" name="lan" id="lan" />
		<input type="hidden" name="live" id="live">
		<button name="submit" id="Mandatesubmitbtn" style="display: none;">Submit</button>
	</div>
		<input type="hidden" name="final_status" id="final_status">
	
	<script type="text/javascript">
		// var agreementNo = "";
		$.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'mandateLoanStatus', method_val : 'getMandateStatus'})
		.done(function( data ) {
			$( "#statusofloan_mandate" ).html(data);
			// console.log(final_status);

		});
		$('#Mandatesubmitbtn').click(function(e){
			e.preventDefault();
            var id=$('#i_detaild').val();
          var agg=id.split('_');
					            id=agg[0];
			
			// console.log('final',final_status);

			if(document.getElementById('final_status').value=="Live")
			{
			// console.log('final',final_status);

		   $.confirm({
		    title: '<div style="text-align:center;"><strong>Confirmation Required</strong></div>',
		    content: ' <p>Since the loan is live, mandate cancellation can be done only post submission of the new mandate.</p><br/><p class="ques-n">Do you still want to raise a request for mandate cancellation?</p>',
		    buttons: {
		        
		        Yes: {  text: 'Yes',
	                    btnClass: 'btn-green',
			        	action:function () {
			                 document.getElementById('isload').style.display="block";
                            $.post( "/cc/AjaxCustom/ecsmandate_live_cancel", { contact_id : '<?php echo $contact_id;?>',agg : id })
													 .done(function( data ) {
			                 document.getElementById('isload').style.display="none";
			                 			data=JSON.parse(data)
			                 			// console.log(data);
			                 			if(data.Status=="Success")
			                 			{
			                 				window.location.href = data.Message;
			                 			}

			                 			else
			                 			{
			                 				alert("Some error occured. Please try again")
			                 			}
			                 			
												 
										 }); 

			            }
		            },
		        No: {
			        	text: 'NO',
	                    btnClass: 'btn-red',
			        	action:function () {
			            $.alert('Canceled!');
		                                }

		            }
		    }
		     });

			}
			else
			{
				 document.getElementById('isload').style.display="block";
                            $.post( "/cc/AjaxCustom/ecsmandate_nonlive_cancel", { contact_id : '<?php echo $contact_id;?>',agg : id })
													 .done(function( data ) {
			                 document.getElementById('isload').style.display="none";
			                 // console.log(data);
			                 			data=JSON.parse(data)
			                 			if(data.Status=="Success")
			                 			{
			                 				window.location.href = data.Message;
			                 			}

			                 			else
			                 			{
			                 				alert("Some error occured. Please try again");
			                 				
			                 			}

												 
										 });

			}

		});

		
	</script>
</div>

  </fieldset>
</form>
<p>&nbsp;</p>

</body>
</html>
 <?php 
 // if(($_POST['live']=="live"))
 // {
 // 	 $PrimaryContact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
 //                        // print_r($PrimaryContact);
 //                        $incident = new \RightNow\Connect\v1_3\Incident();
 //                        $incident->PrimaryContact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);
 //                        $incident->Subject = "ECS mandate cancellation";
 //                        $incident->Threads = new \RightNow\Connect\v1_3\ThreadArray();
	// 				    $incident->Threads[0] = new \RightNow\Connect\v1_3\Thread();
	// 				    $incident->Threads[0]->EntryType = new \RightNow\Connect\v1_3\NamedIDOptList();
	// 				    $incident->Threads[0]->EntryType->ID = 3; // Used the ID here. See the Thread object for definition
	// 				    $incident->Threads[0]->Text = "Hi, ".$PrimaryContact->LookupName." has requested for the mandate cancellation process intiation";
 //                        $incident->Category = \RightNow\Connect\v1_3\ServiceCategory::fetch(2168);
                       
 //                        $incident->StatusWithType               = new \RightNow\Connect\v1_3\StatusWithType() ;
	// 				    $incident->StatusWithType->Status       = new \RightNow\Connect\v1_3\NamedIDOptList() ;
	// 				    $incident->StatusWithType->Status->ID   = 1 ;
	// 				    $incident->save(\RightNow\Connect\v1_3\RNObject::SuppressAll);
 // }
 // else
 // {

 // }
                         
                       
                         ?>


<!-- <p>&nbsp;</p> -->

