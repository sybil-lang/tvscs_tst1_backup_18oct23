<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="tvs_header.php" clickstream="employee-login"/>

  
  <!-- Contact Number Ends Here--> 
  
  <!--Mega Menu starts Here!--> 
  
<!--Mega Menu Ends Here!--> 
<!--Main section  starts Here!-->

<div class="container dashboard">
  <div class="home-image" style="background: none!important;"> 
<h1>Self-Service : Client</h1>
<section>
  <h4 class="active" id="initialloanamount_target">Initial loan amount</h4>
  <ul>
  <li id="initialloanamount">
			<p>Demo1</p>
   
   
	  </li>
  </ul>
  <h4 id="instrumentdetails_target">Instrument details</h4>
  <ul>
    <li id="instrumentdetails" style='height:50px'>
		  
	  </li>
	  <hr>
	  <div id="instrumentdetails_docs" style='display:none'>
		  <a href="" target="_blank" id="url_ins"><img src='http://freevector.co/wp-content/uploads/2010/02/30766-writing-a-document-with-a-pencil.png' height="50" width="50"></a><p>Insurance Policy Renewal</p><br>
		  <a href="" target="_blank" id="url_for"><img src='http://freevector.co/wp-content/uploads/2010/02/30766-writing-a-document-with-a-pencil.png' height="50" width="50"></a><p>Foreclosure Letter</p>
	  </div> 
  </ul>
  <h4 id="statusofloan_target">Status of loan</h4>
  <ul>
	  <li id="statusofloan">
		   <p>Demo3</p>
	  </li>
  </ul>
  <!-- <h4 id="presentationnotification_target">Presentation notification</h4>
  <ul>
   <li id="presentationnotification">
		  <p>Demo4</p>
	  </li>
  </ul>
  <h4 id="bouncenotification_target">Bounce notification</h4>
  <ul>
   <li id="bouncenotification">
		  <p>Demo5</p>
	  </li>
  </ul>
  <h4 id="receiptnotification_target">Receipt notification</h4>
  <ul>
   <li id="receiptnotification">
		  <p>Demo6</p>
	  </li>
  </ul> -->
  <h4 id="raiseaquery_target">Raise a query</h4>
  <ul>
   <li id="raiseaquery">
		  <p>Demo7</p>
	  </li>
  </ul>
  <h4 id="addresschangerequest_target">Address Change Request</h4>
  <ul>
   <li id="addresschangerequest">
		  <p>Demo8</p>
	  </li>
  </ul>  
</section>

</div>
	</div>
<!--Main section  Ends Here!-->

<script type="text/javascript" src="js/jquery.slicknav.js"></script>
	<script type="text/javascript">
	$('section h4').click(function(event) {
  event.preventDefault();
  $(this).addClass('active');
  $(this).siblings().removeClass('active');

  var ph = $(this).parent().height();
  var ch = $(this).next().height();

  if (ch > ph) {
    $(this).parent().css({
      'min-height': ch + 'px'
    });
  } else {
    $(this).parent().css({
      'height': 'auto'
    });
  }
});

function tabParentHeight() {
  var ph = $('section').height();
  var ch = $('section ul').height();
  if (ch > ph) {
    $('section').css({
      'height': ch + 'px'
    });
  } else {
    $(this).parent().css({
      'height': 'auto'
    });
  }
}

$(window).resize(function() {
  tabParentHeight();
});

$(document).resize(function() {
  tabParentHeight();
});
tabParentHeight();
	</script>
	
	
<script> 
	 $("#initialloanamount_target").click(function(){
		 
		 $.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : 100010 , filtering_val : 'initialloan'})
													 .done(function( data ) {
												 $( "#initialloanamount" ).html(data);
										 });
		
		});
		
		 $("#statusofloan_target").click(function(){
		 
		 $.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : 100010 , filtering_val : 'statusofloan'})
													 .done(function( data ) {
												 $( "#statusofloan" ).html(data);
										 });
		
		});
		
		 $("#instrumentdetails_target").click(function(){
		 
		 $.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : 100010 , filtering_val : 'instrumentdetails'})
													 .done(function( data ) {
												 $( "#instrumentdetails" ).html(data);
										 });
		
		});
		
		
</script>

</html>
