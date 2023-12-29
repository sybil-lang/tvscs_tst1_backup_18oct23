
<html>
<head>
    <script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="/euf/assets/themes/standard/js/jquery-1.10.2.min.js"></script><script src="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>
<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap.js"></script>
<!--<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"> </script>-->
   
  
    </head>
    <body>
     <div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
          <!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" onclick='this.parentNode.parentNode.removeChild(this.parentNode)'>&times;</button>
					<h4 class="modal-title">TVS - Call Request</h4>
				</div>
			<p id="response_text"></p>
			<form id="frmcall" name="frmcall" method="post">
				<div class="modal-body" id="model_body">

								<div class="form-group">
									<!--<label for="exampleSelect1">Agreement Number</label>-->
									<rn:widget path="custom/input/agreementSelect/" name="agreementno" required="true" label_input="Agreement Number"/>
								  </div>
							  <div class="form-group">
								<label for="exampleInputEmail1">Preferred contact no.</label>
								<input type="number" class="form-control" id="contact_number"  name="contact_number"  maxlength="10" required >
								<small id="emailHelp" class="form-text text-muted">&nbsp;</small>
							  </div>
							 
							  
							<div class="form-group">
								<label for="datetimepicker">Preferred Date/Time to speak</label>
								<div class='input-group date' id='datetimepicker8'>
									<input type='text' class="form-control" name="datetime_speak" id="datetime">
									<span class="input-group-addon">
										<span class="fa fa-calendar">
										</span>
									</span>
                                </div>
					</div>

					<div class="form-group">
						<label for="exampleTextarea">Assistance required</label>
						<textarea class="form-control" id="assistance"  name="assistance" rows="3" ></textarea>
					  </div>
				</div>
				<div class="modal-footer" id="modal-button">
					<button type="button" class="btn btn-primary" id="call_back">Submit</button>
                    <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>

				</div>
				<div id="after-submit" style="display:none;"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
				</form>
			</div>

		</div>
	</div>
	<!-- Modal -->

	<!-- script for modal -->
	<script>
        			$(function() 
                              {
								$('#datetimepicker8').datetimepicker({
									icons: {
										time: "fa fa-clock-o",
										date: "fa fa-calendar",
										up: "fa fa-arrow-up",
										down: "fa fa-arrow-down"
									},
									minDate : 'now'
								});
                                
});
	$("#close").click( function () {
  $("#myIframe").css({"display": 'none'})});
	var validFlag = false;
		$( "#call_back" ).click( function () {
			//alert( "Handler for .click() called." );
			if($('#rn_agreementSelect_30_agreementno').val() == '-1'){
				bootbox.alert("<p>Please select Agreement No</p>");
				validFlag = true;
			}else if($('#contact_number').val() == ''){
				bootbox.alert("<p>Please Enter valid Mobile No</p>");
				validFlag = true;
			}else{
				validFlag = false;
			}

			if(!validFlag){
				$( "#response_text" ).html("Logging Request......");
				$.ajax({
							url: "/cc/AjaxCustom/create_inc",
							type: "post",
							data: $('#frmcall').serialize(),
							success: function(response) {
								//alert(d);
								var obj = jQuery.parseJSON(response);
								//var html_txt = '<p>Thanks for submitting your Request. Your request is logged and our representative will call you back ASAP! <br />Use this reference number for follow up: <b><a href="/app/msme/account/questions/detail/i_id/'+obj[0].value_id+'">'+obj[0].value_refno+'</a>.</b></p>';
								//$( "#response_text" ).html( html_txt );
								//$('#model_body').hide();
								//$('#modal-button').hide();
								//$('#after-submit').show();
								if(obj[0].value_id != ""){
											window.location.href= '/app/msme/ask_confirm/i_id/'+obj[0].value_id;
								}
							}
				   });
			}
		} );
	</script>

    </body>
</html>
   



		