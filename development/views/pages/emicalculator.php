<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php"/> 

<!--<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.3/bootstrap-slider.js" ></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.3/css/bootstrap-slider.css" rel="stylesheet">
-->
<div class="rn_Hero">
    <div class="rn_Container">
        <h1>EMI Calculator</h1>
    </div>
</div>
<div class="container">
<p>&nbsp;</p>

 <link rel="stylesheet" href="/euf/assets/themes/standard/css/rangeslider.css">
<div class="rn_PageContent rn_Home ">
    <div class="rn_Container">	
	<!-- required -->
	<!-- <div class="radio"> -->
	<h3>Payment Method</h3>
      <label><input type="radio" name="payment_mode" value="C">Cash</label>&nbsp;&nbsp;&nbsp;
    <!-- </div> -->
	<!-- <div class="radio"> -->
      <label><input type="radio" name="payment_mode" value="N">Non-Cash</label>
    <!-- </div> -->
	
	<div id="js-example-change-value">
        <h3>Asset Cost</h3>
        <input type="range" min="0" max="150000" data-rangeslider><br>
        <output id="asset_cost"></output>
        <input type="number" value="75000" style='display:none'><button style='display:none'>Change value</button>
    </div>
	
	<div id="js-example-change-value">
        <h3>Down Payment</h3>
        <input type="range" min="0" max="120000" data-rangeslider><br>
        <output id="down_pay"></output>
        <input type="number" value="60000" style='display:none'><button style='display:none'>Change value</button>
    </div>
	
	<div id="js-example-change-value">
        <h3>EMI</h3>
        <input type="range" min="0" max="6000" data-rangeslider><br>
        <output id="emi"></output>
        <input type="number" value="3000"><button>Change value</button>
    </div>
	
    <div id="js-example-change-value">
        <h3>Tenor</h3>
        <input type="range" min="0" max="36" data-rangeslider><br>
        <output id="tenor"></output>
        <input type="number" value="18" style='display:none'><button style='display:none'>Change value</button>
    </div>
	<br><br>
	<button type="button" class="btn btn-info" id="calc_emi">Calculate</button>
	<button type="button" class="btn btn-warning" id="reset">Reset</button>
	
	<div id="emi_data">
	
	</div>
	<br>
	<!-- required -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="/euf/assets/themes/standard/js/rangeslider.js"></script>
	

    <script>
	
	$("#calc_emi").click(function() {
		//alert("hello");
		var asset_cost = $("#asset_cost").text();
		var down_pay = $("#down_pay").text();
		var emi = $("#emi").text();
		var tenor = $("#tenor").text();
		var payment_mode = $('input[name=payment_mode]:checked').val();
		if(payment_mode == null) {
		alert("Please select one of the payment modes");
		}
		else if(asset_cost == "0") {
			alert("Provide AssetCost value");
		}
		else if( down_pay != "0" && emi != "0" && tenor != "0") {
			alert("Provide any one or two inputs from Downpayment, EMI and Tenor");
		}
		else {
			
			$.post( "/cc/AjaxCustom/emi_calculate_soap", { asset_costs : asset_cost, down_pays : down_pay, emis : emi, tenors : tenor, payment_modes : payment_mode })
				.done(function( data ) {
				console.log( "Data Loaded: " + data );
				$("#emi_data").html(data);
				//$("#response_text").html("Your request is logged and our representative will call you back ASAP!");
			});
		}
		
	});
	
    $(function() {
        var $document = $(document);
        var selector = '[data-rangeslider]';
		
        var $element = $(selector);
        // For ie8 support
        var textContent = ('textContent' in document) ? 'textContent' : 'innerText';
        // Example functionality to demonstrate a value feedback
        function valueOutput(element) {
            var value = element.value;
            var output = element.parentNode.getElementsByTagName('output')[0] || element.parentNode.parentNode.getElementsByTagName('output')[0];
            output[textContent] = value;
        }
        $document.on('input', 'input[type="range"], ' + selector, function(e) {
            valueOutput(e.target);
        });
        // Example functionality to demonstrate disabled functionality
        // $document .on('click', '#js-example-disabled button[data-behaviour="toggle"]', function(e) {
            // var $inputRange = $(selector, e.target.parentNode);
            // if ($inputRange[0].disabled) {
                // $inputRange.prop("disabled", false);
            // }
            // else {
                // $inputRange.prop("disabled", true);
            // }
            // $inputRange.rangeslider('update');
        // });
        // Example functionality to demonstrate programmatic value changes
        $document.on('click', '#js-example-change-value button', function(e) {
            var $inputRange = $(selector, e.target.parentNode);
            var value = $('input[type="number"]', e.target.parentNode)[0].value;
            $inputRange.val(value).change();
        });
        // Example functionality to demonstrate programmatic attribute changes
        // $document.on('click', '#js-example-change-attributes button', function(e) {
            // var $inputRange = $(selector, e.target.parentNode);
            // var attributes = {
                    // min: $('input[name="min"]', e.target.parentNode)[0].value,
                    // max: $('input[name="max"]', e.target.parentNode)[0].value,
                    // step: $('input[name="step"]', e.target.parentNode)[0].value
                // };
            // $inputRange.attr(attributes);
            // $inputRange.rangeslider('update', true);
        // });
        // Example functionality to demonstrate destroy functionality
        // $document
            // .on('click', '#js-example-destroy button[data-behaviour="destroy"]', function(e) {
                // $(selector, e.target.parentNode).rangeslider('destroy');
            // })
            // .on('click', '#js-example-destroy button[data-behaviour="initialize"]', function(e) {
                // $(selector, e.target.parentNode).rangeslider({ polyfill: false });
            // });
        // Example functionality to test initialisation on hidden elements
        // $document
            // .on('click', '#js-example-hidden button[data-behaviour="toggle"]', function(e) {
                // var $container = $(e.target.previousElementSibling);
                // $container.toggle();
            // });
        // Basic rangeslider initialization
        $element.rangeslider({
            // Deactivate the feature detection
            polyfill: false,
            // Callback function
            onInit: function() {
                valueOutput(this.$element[0]);
            },
            // Callback function
            // onSlide: function(position, value) {
                // console.log('onSlide');
                // console.log('position: ' + position, 'value: ' + value);
            // },
            // Callback function
            onSlideEnd: function(position, value) {
                console.log('onSlideEnd');
                console.log('position: ' + position, 'value: ' + value);
            }
        });
    });
    </script>
		</div>
</div>
 
</div>