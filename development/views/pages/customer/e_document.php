<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       #initialloanamount
        {
           background: #fff;
            padding: 0px 10px;
            display: inline-block;
            width: 250px;
        }
        .form-group ul
        {
            border:1px solid;
        }
        #iload_edoc
        {
        height: 80px;
        position: absolute;
        top: 50%;
        right: 50%;
        display:none;
        }
        .z-container{
            min-height: 161px !important;
        }
        .edoc
        {
            display: flex;
            justify-content: space-evenly;
            flex-direction: row;
            margin-top: 35px;
        }
        .edoc_pdficon
        {
                display: flex;
                align-items: center;
                flex-direction: column;
                justify-content: center;
        }
        .href_class
        {
            display: flex;
            align-items: center;
            /* background: lightblue; */
           flex-direction: row;
    /* height: fit-content;*/
        }
         .btnclass
        {
                  color: white;
    background: #0037ffba;
    border-radius: 6px;
    padding: 7%;
    /* -webkit-text-fill-color: black; */
    min-width: max-content;
    font-size: larger;
        }
        .err{
            display: flex;
    align-items: center;
    justify-content: center;
    font-size: large;
        }
        @media only screen and (max-width: 600px) {
 
    .btnclass
    {
         font-size:100%;
    }
  
}
       
    </style></head>
<body>
  <img id="iload_edoc" src="/euf/assets/themes/standard/images/loading-large.gif">
<?php
// $report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
$report_id=$msg->Value;
?>
<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>

<form action='#' method='post' class="loan-form">
  <fieldset>
    <div id="edoc"></div>

  </fieldset>
</form>
<p>&nbsp;</p>

    <div id="edoc1_s" class="hidden edoc"><div class="edoc_pdficon" id="edoc_showresult">
            <img src="/euf/assets/images/pdficon.png" width="100" height="110">
                <p>Loan Application Form</p>
        <br>
    </div> 
    <div class="edoc_pdficon" id="edoc_showresult_btn1"></div>
</div>

<div id="edoc2_s"class="hidden edoc"> 
    <div class="edoc_pdficon" id="edoc_showresult2">
        <img src="/euf/assets/images/pdficon.png" width="100" height="110">
        <p>Loan Agreement Letter</p>
    </div>
    <div class="edoc_pdficon" id="edoc_showresult_btn2"></div>
</div>
<div class="err" id="error_msg"></div>
<!-- <div id="edoc_showresult2"></div> -->

<script type="text/javascript">
									$.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'edoc', method_val : 'EAPP'})
													 .done(function( data ) {
												 $( "#edoc" ).html(data);
										 });
</script>

</body>
</html>