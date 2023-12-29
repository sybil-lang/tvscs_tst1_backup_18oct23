<rn:meta title="CD Dealer Invoice" template="dealer_header.php" clickstream="dealer_invoice" login_required="true" force_https="true" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<?php
$CI = &get_instance();
$contact_id = $CI->session->getProfileData("c_id");
$contact = RightNow\Connect\v1_3\Contact::fetch($contact_id);
$product = $contact->CustomFields->CO->DealerProduct->LookupName;
$dealer_code = $contact->CustomFields->c->dealer_code;
// echo "<h1>".$product."</h1>";
$CI->load->helper('report');
checkCustomerType('dealer');
// if($product!="CD"){
//   header("location: /app/error404");
// }
//load_curl();
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://tvscscrmservice.tvscredit.com/CRMService.svc/CDDealerInvoiceDetails",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 180,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n    \"DealerCode\": \"$dealer_code\"\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json"
  ),
));
$response = curl_exec($curl);
$responseArr = json_decode($response, true);
$err = curl_error($curl);
curl_close($curl);
for($i = 0; $i < count($responseArr); $i++){
  $statuscode[] = $responseArr[$i]["StatusCode"];
  $yearsToShowArr[] = $responseArr[$i]["Year"];
  $monthsToShowArr[] = $responseArr[$i]["Month"];
}
if(in_array("ER", $statuscode)){
    echo "<h4 style='margin-left:10px;'>NO DATA FOUND</h4>";
}
for($i=0;$i<count($yearsToShowArr);$i++){
  $count = count($result[$yearsToShowArr[$i]]);
$result[$yearsToShowArr[$i]][$count] = $monthsToShowArr[$i];
$count++;
}
//print_r($result);

$yearsToShowArrUnique = array_values(array_unique($yearsToShowArr));
// $monthsToShowArr = array_values(array_unique($monthsToShowArr));
$monthNumberToNameArr = array("1" => "January", "2" => "February", "3" => "March", "4" => "April", "5" => "May", "6" => "June", "7" => "July", "8" => "August", "9" => "September", "10" => "October", "11" => "November", "12" => "December");
// sort($monthsToShowArr);
?>

<style>
  body{
    font-size: 1.2em;
  }
  option{
    font-size: 1.2em;
  }
  .month-data{
    border: 1px solid #000000;
    margin: 10px 30px;
    float: left;
    border-radius: 10px;
    height: 40px;
    background-color:#115184;
    color: #fff;
    padding: 5px 30px;
  }

  .month-data a {
    text-decoration: none;
    color: #fff;
    font-size: 1.2em;
  }

  .month-data a:hover {
    text-decoration: none;
  }

  .month-data i {
    float: right;
    margin: 5px 0px;
    font-size: 1.2em;
  }

  .month-data i:hover {
    float: right;
    margin: 5px 0px;
    cursor: pointer;
  }

</style>
<div class="container">
    <div class="col-md-4">
    <div class="row" style="display: unset!important;">
      <label for="ddlyear"> Select Year </label>
      <select name="year" class="form-control">
        <option value="none"> -- Select Year -- </option>
        <?php for($i = 0; $i < count($yearsToShowArrUnique); $i++)
        {
            if($yearsToShowArr[$i]!=""){

         ?>
          <option value="<?php echo $yearsToShowArrUnique[$i]; ?>"> <?php echo $yearsToShowArrUnique[$i]; ?> </option>
      <?php } 
        } 
      ?>
      </select>
    </div>
    <!-- <div class="col-md-8">
    </div> -->

  </div> <br />
  <div class="row">
    <div class="col-md-12" id="months-div" style="display: none;">

      <label for="ddmonth" style="padding-left: 30px;"> Select Month </label>
      <div class="row col-md-12">
        <?php foreach ($result as $year_value => $month_value){ 
          for($i=count($month_value)-1; $i>=0;$i--){

          ?>
          <div class="col-md-3 month-data">
            <a href="#" title="download Invoice" class="downloadInvoiceLink" data-year="<? echo $year_value;?>"data-month="<?php echo $month_value[$i]; ?>"> <?php echo $monthNumberToNameArr[$month_value[$i]]; ?> <i title="download Invoice" class="fa fa-download"> </i></a>
          </div>
        <?php }} ?>
      </div>
    </div>
  </div>
</div>
<script>

  $(document).ready(function(){
    $("select[name='year']").change(function(){
      var selectvalue= $("select[name='year']").val();
      if(selectvalue!="none"){
        $('#months-div').show();
        $('.month-data').each(function(index,element){
          $(this).hide();
          if($(this).find('a').attr('data-year')==selectvalue){
            $(this).show();
          }
      });
      }
      else{
        $('#months-div').hide();
      }
    });
  });

  $(".downloadInvoiceLink").click(function(){
    var year = $("select[name='year']").val();
    var month = $(this).attr("data-month");
    if(year.length <= 0 || month.lengh <= 0){
      alert("Please select both year and month");
      return false;
    }
    else{
      $.ajax({
        url: '/cc/DealerCustom/downloadInvoice',
        data: {
          year: year,
          month: month,
          dealer_code: "<?php echo $dealer_code; ?>"
        },
        success: function(response) {
          //console.log(response);
          window.open(response);
        },
        type: 'POST'
      });
    }
  });
</script>