<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="standard.php" login_required="true" force_https="true" />

<?php
// $CI=&get_instance();
// $CI->load->helper('report');

// checkCustomerType('customer');
// $contact_id=$CI->session->getProfileData("c_id");
// $contact_type=$CI->session->getSessionData("userProfile");

// echo "LoanTYpe";
// print_r($contact_type);
//echo "good";
//$conftact_id = 3;
//print_r($this->session->getProfile() );
?>
  <!-- Zozo Tabs css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />

     <!-- Zozo Tabs Flat Themes css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />
    
    <!-- Zozo Tabs js -->
    <script src="/euf/assets/themes/standard/js/jquery.min.js"></script>
    <script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

<!-- Datatable CSS and JAVAScript -->

<!-- <rn:theme path="/euf/assets/themes/standard/css" css="site.css,style.css,styles.css,style-product.css,select.dataTables.min.css,dataTables.bootstrap.min.css,customerlogin-style.css,custom_dashboard.css,buttons.dataTables.min.css,bootstrap-datetimepicker.min.css"/> -->
 <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
  <!-- <link rel="stylesheet" href="/euf/assets/themes/standard/css/font-awesome.min.css"> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    
      <link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link  href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700" rel="stylesheet">
 <!-- <link  href="/euf/assets/themes/standard/css/style.css" rel="stylesheet"> -->
      <!-- <link  href="/euf/assets/themes/standard/css/style-product.css" rel="stylesheet"> -->
    <!-- <link  href="/euf/assets/themes/standard/css/customerlogin-style.css" rel="stylesheet"> -->
  <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />

<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"> </script>

<div class="rn_Hero">
    <div class="rn_Container">
        <h1 id="newt">Make Payment</h1>
    </div>
</div>
<p>&nbsp;</p>
<div class="rn_PageContent rn_Profile rn_Container">
   


    <style>
        #makepayment
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
        #iload
        {
        height: 80px;
        position: absolute;
        top: 50vh;
        right: 50%;
        display:none;
        }
        .z-container{
            min-height: 161px !important;
        }
       .make table {
            width: 95%;
            margin: 0 auto;
            /* border-radius: 50%; */
            background-color: white;
        }
       .odd
       {
        /*background-color: lightgrey;*/
       }
       .even
       {
        /*background-color: lightblue;*/
         
       }
       .make
       {
        display: flex;
       }
       .a_div button
       {
        width: 18%;
        background-color: #114984;
       }
       .urldata{
        background-color: #ffffff !important;
        border-color: #114984 !important;
        color:#114984 !important;
       }
       .a_div
       {
        text-align: center;
       }
       .fform
       {
            margin: 19px;
       }
       .main_block_div
       {
        /*text-align: center;*/
        margin-left: 15px;
       }
       .boldy
       {
        font-weight: bolder;
        color: #114984 !important;
        background-color: #dedede;
        text-shadow: 0 0 black;
        
       }
       
       fieldset{
          text-align: center;
          padding: 20px;
          border-radius: 10px;
       }
       #make1 td {
          font-size: 15px;
          color: #000;
      }
      #make21 th{
        background-color: white;
      }
      #make21 td{
        background-color: white;
        font-size: 15px
        color: #000;
      }
      #Overdue-due-accord, #other-due-accord{
        font-weight: bold;
        letter-spacing: 0.1em;
      }
      @media only screen and (max-width: 480px) {
        .a_div a
       {
        width: 65%;
        border-radius: 30px;
        padding: 0px 10px;        
       }
       h4{
        margin-top: 0px !important;
        font-size: 20px !important;
       }
      }
    </style>

  
<?php
// $report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
$report_id=$msg->Value;
?>
<div>
  <h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>
      <div id="makepayment">
       
      </div>
</div>    
<form class="form" action='#' method='post' class="loan-form">

<br>
  <fieldset>
<h2 align="center" class="hidden" id="nodatfound">No Data Found</h2>
    
<div id="main_block_div" class="main_block_div">
  <img id="iload" src="/euf/assets/themes/standard/images/loading-large.gif" >
<a class="btn btn-primary left-align hidden" id="Overdue-due-accord" data-toggle="collapse" href="#-status-Overdue" role="button" aria-expanded="false"aria-controls="-status-Overdue"><i class="fa"></i>Overdue Charges</a>

<div class="collapse multi-collapse" id="-status-Overdue">
    <div class="make">
       <table id=make1 class="table display table-bordered nowrap table-striped hidden">
      </table>
     
    </div>
</div>
<br>
<div class="a_div">
    <button  id="urldata" class=" btn hidden" >Pay Overdue/Charges</button>
</div>
<br>

<a class="btn btn-primary left-align hidden" id="other-due-accord" data-toggle="collapse" href="#-status-Othercharges" role="button" aria-expanded="false"aria-controls="-status-Othercharges"><i class="fa"></i>Other Charges</a>

<div class="collapse multi-collapse" id="-status-Othercharges">
    <div class="make">
    
       <table id="make21" class="table display table-bordered nowrap table-striped hidden">
      </table>
    </div>
</div>
<br>

<div class="a_div">
    <button id="urldata2" class=" btn hidden" >Pay Other Charges</button>
</div>
</div>


  </fieldset>
</form>
<p>&nbsp;</p>
<div id="showresult"></div>
<script type="text/javascript">
  var dataa;
  var paymentId;
      $.post( "/cc/AjaxCustom/makepayment", { id_of_report : '<?php echo $report_id;?>' })
       .done(function( data ) {
             $( "#makepayment" ).html(data);
             // dataa=data

       });
   //     jQuery(document).ready(function ($) {
            

   //          $('#proposal_no').DataTable({
      //  // "responsive": true,
      //  "scrollX":true
      // });
   //      });
   $(document).ajaxStop(function()
   {
    if($("#make1").hasClass("hidden"))
    {
        $('#urldata').addClass('hidden');
    }
    if($("#make21").hasClass("hidden"))
    {
        $('#urldata2').addClass('hidden');
    }
  // alert("All AJAX requests completed");
  });
    </script>
     
    
</div>