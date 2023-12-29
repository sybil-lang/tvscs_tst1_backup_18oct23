<?php
$CI = &get_instance();
$CI->load->helper('report');
checkCustomerType('dealer');
$c_id = $CI->session->getProfileData("c_id");
$contact = \RightNow\Connect\v1_3\Contact::fetch($c_id);
$dealerProduct = $contact->CustomFields->CO->DealerProduct;

$dealer_code = $CI->session->getProfileData("login");

?>

<rn:meta title="TA / WC Return" template="dealer_header.php" login_required="true" force_https="true" />

<style type="text/css">
    .rn_Body {
        min-height: 800px;
    }

    .row {
        margin: 10px auto;
    }
    body{
        font-family: 'Gotham', sans-serif;
    }
    table{
        table-layout:fixed;
    }
    table tbody tr td input{
        width:100%;
        margin:5px 0;
    }
    table tbody tr td button{
        width:100%;
        margin:5px 0;
    }
    table tbody tr td {
        font-family: 'Gotham',Sans-serif;
        font-size: smaller;
    }
    thead{
        color:white  !important;
        background-color:#0c4a85 !important;
    }
    td{
        word-wrap:break-word;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        padding:5px;
    }
    input[disabled], button[disabled]{
        cursor: not-allowed !important;
    }
    .table>thead>tr>th{
        vertical-align: middle !important;        
    }
    @media only screen and (max-width: 480px){
      .table-responsive{
            display: block !important;
            width: 100% !important;
            overflow-x: scroll !important;
            table-layout: fixed !important;
            max-width: max-content !important;
            white-space: nowrap !important;
        }
        tr, td, th {
            vertical-align: middle !important;
            min-width: 200px !important;
        }

    }
    #loadingDiv{
      position:fixed;
      top:0px;
      right:0px;
      width:100%;
      height:100%;
      background-color:#666;
      background-image:url('/euf/assets/themes/standard/img/ajax-loader.gif');
      background-repeat:no-repeat;
      background-position:center;
      z-index:1049;
      opacity: 0.4;
      filter: alpha(opacity=40); /* For IE8 and earlier */
    }
    .modal-header .close {
    
        position: relative;
        top: -38px !important;
        left: 5px !important;
        width: 25px !important;
        background-color: #c30202 !important;
        color: white !important;
        font-size: 25px !important;
    }
    .modal-title {
        margin-bottom: 0px !important;
        color: #003e98 !important;
    }
    #paymentModal{
        transform: translate(0px, -180px);
    }
    #noti_text{
        text-align: center;
        font-size: 1.5rem;
        padding-top: 20px;
        text-transform: none;
        color: red;
        font-family: 'raleway-regular';
        font-weight: 600;
    }
</style>

<div class="container-fluid" id="content-main">
    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loadingDiv">

    </div>
    <div class="row">
        <div class="heading">
            <h4><? echo ($eligibleForWorkingRequest) ? "WC Return" : "TA Return";?> - <span id="noti_text">Transfer the amount through Payment gateway for easy & faster Updation. Once payment completed it will reflect in statement within one hour.</span></h4>
            
        </div>
    </div>
    <div class="row">
        <div class="table-responsive" id="taReturnDiv">
         <h5 id="pending-msg"></h5>
            <table id="taReturn" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Agreement Number</th>
                        <th scope="col">Disbursal Date</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Disbursal Amount</th>
                        <th scope="col">Total Outstanding</th>
                        <th scope="col">Principal Outstanding</th>
                        <th scope="col">Interest Outstanding</th>
                        <th scope="col">ADHOC Outstanding</th>
                        <th scope="col">ADMIN Outstanding</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbodyData">
                    
                </tbody>

            </table>
            
            <script type='text/javascript'>
                var appendString = "";
                $(document).ready(function() 
                {

                    $.ajax({
                        url : "/cc/DealerCustom/getTaReturnResult",
                        type: "POST",
                        data : {dealer_code: '<?php echo $dealer_code; ?>'},
                        beforeSend: function(){
                            appendString = "<tr><td colspan='10' style='text-align:center;'>Loading.....</td></tr>";
                            $('#tbodyData').html(appendString);
                        },
                        success: function(data, textStatus, jqXHR)
                        {
                            let conv_data = JSON.parse(data);
                            console.log(conv_data);
                            
                            if(conv_data.ReturnMessage != "" && conv_data.ReturnList != null)
                            {
                                appendString = "";
                                

                                for (let i = 0; i < conv_data.ReturnList.length; i++) {
                                    
                                    if(conv_data.ReturnList[i].PayAllowed == "Y"){
                                        appendString = appendString + "<tr><td>"+conv_data.ReturnList[i].AgmtNo+"</td><td>"+conv_data.ReturnList[i].Disbursaldate+"</td>"+"<td>"+conv_data.ReturnList[i].InstaDueDate+"</td><td>"+conv_data.ReturnList[i].DisbursalAmount+"</td><td>"+conv_data.ReturnList[i].TotalOS+"</td><td>"+conv_data.ReturnList[i].PrincipalOS+"</td><td>"+conv_data.ReturnList[i].IntrestOS+"</td><td>"+conv_data.ReturnList[i].ADHOCOS+"</td><td>"+conv_data.ReturnList[i].ADMINOS+"</td><td><input type='text'id='payedit"+i+"' class='payedit' name='payedit"+i+"' value='"+conv_data.ReturnList[i].TotalOS+"' /></td><td><button class='paybtn' data-payId='"+conv_data.ReturnMessage+"' data-id='"+i+"' data-maxAmt='"+conv_data.ReturnList[i].TotalOS+"' data-agno='"+conv_data.ReturnList[i].AgmtNo+"' data-loanStatus='"+conv_data.ReturnList[i].AgreementStatus+"' data-custName ='"+conv_data.ReturnList[i].DealerName+"' >Pay</button></td></tr>"; 
                                    }
                                    else{
                                        appendString = appendString + "<tr><td>"+conv_data.ReturnList[i].AgmtNo+"</td><td>"+conv_data.ReturnList[i].Disbursaldate+"</td>"+"<td>"+conv_data.ReturnList[i].InstaDueDate+"</td><td>"+conv_data.ReturnList[i].DisbursalAmount+"</td><td>"+conv_data.ReturnList[i].TotalOS+"</td><td>"+conv_data.ReturnList[i].PrincipalOS+"</td><td>"+conv_data.ReturnList[i].IntrestOS+"</td><td>"+conv_data.ReturnList[i].ADHOCOS+"</td><td>"+conv_data.ReturnList[i].ADMINOS+"</td><td><input type='text' id='payedit"+i+"' name='payedit' class='payedit"+i+"' value='"+conv_data.ReturnList[i].TotalOS+"' disabled/></td><td><button class='paybtn' data-payId='"+conv_data.ReturnMessage+"' data-id='"+i+"' data-maxAmt='"+conv_data.ReturnList[i].TotalOS+"' data-agno='"+conv_data.ReturnList[i].AgmtNo+"' data-loanStatus='"+conv_data.ReturnList[i].AgreementStatus+"' data-custName ='"+conv_data.ReturnList[i].DealerName+"' disabled>Pay</button></td></tr>"; 
                                    }
                                    
                                }

                                if(conv_data.ReturnMessage == "PENDING"){
                                   $('#pending-msg').html("Your payment is being processed, Kindly try after some time!").css("font-weight","600").css("color","#108a43 !important");
                                }
                            }
                            else{
                                appendString = "<tr><td colspan='10' style='text-align:center;'>"+conv_data.ReturnMessage+"</td></tr>";
                            }
                            $('#tbodyData').html(appendString);
                            console.log(conv_data);
                            
                            jQuery('.paybtn').click(function(){ 
                                
                                var btn_id = jQuery(this).attr("data-id");
                                var max_amount = jQuery(this).attr("data-maxAmt");
                                var agr_no = jQuery(this).attr("data-agno");
                                var agr_status = jQuery(this).attr("data-loanStatus");
                                var cust_name = jQuery(this).attr("data-custName");
                                var payment_id = jQuery(this).attr("data-payId");
                                var payamount = "#payedit"+btn_id;
                                var edited_amount = jQuery(payamount).val();

                                console.log("Pay id: ",btn_id);
                                console.log("Pay amount: ",payamount);
                                console.log(parseFloat(edited_amount));
                                if(edited_amount == ""){
                                    alert("Kindly enter some amount");   
                                }
                                else{
                                    
                                    if(parseFloat(edited_amount) > parseFloat(max_amount)){
                                        alert('Please enter the payable amount less than the outstanding balance amount.');
                                    }
                                    else if(parseFloat(max_amount) <= parseFloat(100)){
                                        if(parseFloat(edited_amount) < parseFloat(100)){
                                            alert('Partial payments not allowed if the TA balance is less than Rs.100');
                                            jQuery(payamount).val(max_amount);
                                        }
                                    }
                                    else if(parseFloat(edited_amount) < parseFloat(max_amount)){
                                        if(parseFloat(edited_amount) < parseFloat(100)){
                                            alert("Kindly enter the amount greater than or equal to Rs.100 !");
                                            jQuery(payamount).val(max_amount);
                                        }
                                        else{
                                            
                                            $(this).attr("disabled",true);
                                            $(payamount).attr("disbled",true);
                                            $.ajax
                                            ({
                                                url : "/cc/DealerCustom/getTApaymentURI",
                                                type: "POST",
                                                data : {AgreementNo: agr_no, AgreementStatus: agr_status, CustomerName: cust_name, EmiOverdue: max_amount, FinalAmount: edited_amount, PaymentID : payment_id},
                                                beforeSend: function(){
                                                    $("#loadingDiv").removeClass("hidden");
                                                },
                                                success: function(data, textStatus, jqXHR)
                                                {
                                                    
                                                    var dataParsed = JSON.parse(data);
                                                    // $("#loadingDiv").addClass("hidden");
                                                    // $('#paymentModalFrame').attr("src",dataParsed.ReturnURL);
                                                    window.open(dataParsed.ReturnURL);
                                                    window.setTimeout(
                                                    function()
                                                    { 
                                                        window.location.reload(); 
                                                    }, 
                                                    180000
                                                );
                                                 $('#paymentModal').modal('show');
                                                }
                                            });
                                        }
                                    }
                                    else{
                                        
                                        $(this).attr("disabled",true);
                                        $(payamount).attr("disbled",true);
                                        $.ajax
                                        ({
                                            url : "/cc/DealerCustom/getTApaymentURI",
                                            type: "POST",
                                            data : {AgreementNo: agr_no, AgreementStatus: agr_status, CustomerName: cust_name, EmiOverdue: max_amount, FinalAmount: edited_amount, PaymentID : payment_id},
                                            beforeSend: function(){
                                                $("#loadingDiv").removeClass("hidden");
                                            },
                                            success: function(data, textStatus, jqXHR)
                                            {
                                                
                                                var dataParsed = JSON.parse(data);
                                                // $("#loadingDiv").addClass("hidden");
                                                // $('#paymentModalFrame').prop("src",dataParsed.ReturnURL);
                                                window.open(dataParsed.ReturnURL);
                                               
                                                window.setTimeout(
                                                    function()
                                                    { 
                                                        window.location.reload(); 
                                                    }, 
                                                    180000
                                                );
                                                 $('#paymentModal').modal('show');
                                                // console.log(data);
                                            }
                                        });

                                    }
                                }
                            });
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            console.log(textStatus);
                        }
                    });
                    
                });
                
                $(document).on('input', 'input.payedit', function() {
                    console.log("old ",this.value);
                    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                    console.log("new ",this.value);
                });
                
            </script>
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true" style="height: 200px !important;" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog modal-lg" role="document" style="width: 400px !important;">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" style="height: 100px !important;padding: 10px;line-height: 27px;">
                    <p>This page will be refreshed after 180 seconds!</p>
                    <p>Do not close or refresh this window!</p>
                  </div>
                  <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div> -->
                </div>
              </div>
            </div>

            <!-- <script type="text/javascript">
                $('#paymentModal').on('hidden.bs.modal', function (e) {
                  window.location.reload();
                });
            </script> -->
        </div>
    </div>


</div>