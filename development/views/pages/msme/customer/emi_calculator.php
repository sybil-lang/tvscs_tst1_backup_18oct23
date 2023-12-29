<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="tvs_header.php" clickstream="employee-login"/>
<!-- <html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script>
$(document).ready(function(){
	
});
function emi_cal() {
	alert("hhhhhhhhh");
		// var abc = '<?php echo soap_curl_hit(); ?>';
			// $("#emi_data").html(abc);
		}
			

</script>  
  <div class="container" style='margin-top:5%;'>
  <div class="jumbotron">
  
	<div class="row">
  <div class="col-lg-4"><b>Payment Mode :</b></div>
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
  
	<div class="radio">
      <label><input type="radio" name="payment_mode" value="C">Cash</label>
    </div>
	<div class="radio">
      <label><input type="radio" name="payment_mode" value="N">Non-Cash</label>
    </div>
	
	</div>
	</div>

	<div class="row">
  <div class="col-lg-4"><b>Asset Cost :</b></div>
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
		<!-- slider -->
		<div class="range-slider1">
		<input class="range-slider__range1" type="range" value="100" min="0" max="10000">
		<span class="range-slider__value1" id="asset_cost">0</span> 
		</div>
		<!-- slider -->
  </div>
  </div>

	<div class="row">
  <div class="col-lg-4"><b>Down Payment :</b></div>
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
		<!-- slider -->
		<div class="range-slider2">
		<input class="range-slider__range2" type="range" value="100" min="0" max="10000">
		<span class="range-slider__value2" id="down_payment">0</span> 
		</div>
		<!-- slider -->
  </div>
	</div>

	<div class="row">
  <div class="col-lg-4"><b>EMI :</b></div>
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
		<!-- slider -->
		<div class="range-slider3">
		<input class="range-slider__range3" type="range" value="100" min="0" max="10000">
		<span class="range-slider__value3"  id="emi">0</span> 
		</div>
		<!-- slider -->
  </div>
	</div>
	
	<div class="row">
  <div class="col-lg-4"><b>Tenor :</b></div>
  <div class="col-lg-4"></div>
  <div class="col-lg-4">
		<!-- slider -->
		<div class="range-slider4">
		<input class="range-slider__range4" type="range" value="100" min="0" max="10000">
		<span class="range-slider__value4"  id="tenor">0</span> 
		</div>
		<!-- slider -->
  </div>
	</div>
	
	<div class="row">
  <div class="col-lg-4"></div>
  <div class="col-lg-4"><button type="button" class="btn btn-warning">Reset</button>&nbsp;<button type="button" onclick="emi_cal()" class="btn btn-success">Calculate</button></div>
  <div class="col-lg-4"></div>
	</div>
	
</div>
<div id="emi_data">
</div>
  </div>
  <!-- </body>
  </html> -->