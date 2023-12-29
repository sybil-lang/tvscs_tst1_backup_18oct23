<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.3/bootstrap-slider.js" ></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.3/css/bootstrap-slider.css">

<div class="rn_PageContent rn_Home ">
    <div class="rn_Container">
		<div class="span3">
			<h2>EMI Calculator</h2>
			<form>
			<div class="row">
				<div class="col-md-6">
					<label>Asset Cost</label>
					<input type="text" name="Asset_Cost" id="Asset_Cost" data-slider-id='ex1Slider'  data-slider-min="0" data-slider-max="150000" data-slider-step="1000" data-slider-value="2000">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label>Down Payment</label>
					<input type="text" name="Down_Payment" class="span3" required>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
						<label>EMI</label>
						<input type="text" name="EMI" class="span3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
						<label>Tenor</label>
						<input type="text" name="Tenor" class="span3" required>
				</div>
			</div>
			<input type="submit" value="Calculate" class="btn btn-primary pull-right">
			<input type="reset" value="Reset" class="btn btn-primary pull-right">
			<div class="clearfix"></div>
			</form>
		</div>
</div>
<script>
// Without JQuery
var slider = new Slider("#Asset_Cost", {
	tooltip: 'always'
});
</script>
