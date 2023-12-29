<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="standardMSME.php" login_required="true" force_https="true" />

<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('customer');
$contact_id=$CI->session->getProfileData("c_id");
$contact_type=$CI->session->getSessionData("userProfile");
?>

    
<link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link  href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />
<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"> </script>


<div class="rn_Hero">
    <div class="rn_Container">
        <h1 id="newt">Loans Applied</h1>
    </div>
</div>
<p>&nbsp;</p>
<div class="rn_PageContent rn_AccountOverview rn_Container_dash">
    <div class="rn_ContentDetail" style="margin: 0px 20px;">
<?php
  $msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_NO_MSME);
  $report_id=$msg->Value;

  $fetched_contact=RightNow\Connect\v1_3\Contact::fetch($contact_id);
  //$report_id = '100066';
?>
<style type="text/css">
  .dashboard-container th
  {
    color: white!important;
        font-size: 12px !important;

  }
    .dashboard-container td
    {
            font-weight: bolder;
            font-size: 12px !important;

    }

    .amount
    {   font-weight: bolder;
        /*color: #114984 !important;
        background-color: #eff0f2 !important;
        width: min-content;*/
        cursor: pointer;
    }
    .dashboard-container .modal-content    
    {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        width: 80vw;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: .3rem;
        outline: 0;
    }
        /*  @media (min-width: 768px)
        {*/
    .dashboard-container .modal-dialog
    {
        width: 600px;
             /* margin: 30px auto; */
        margin-left: 10vw;            
        margin-right: 10vw;
        margin-top: 20vh;
    }
        /*}*/    
    #iloaddash_dash
    {
        height: 80px;
        position: absolute;
        top: 40%;
        right: 50%;
        display:none;
    }
    .bg-white
    {
        background-color: white !important;
    }
    table{
        table-layout: unset !important;
    }
    @media screen and (max-width: 480px){
        .iamtablesdiv{
            overflow-x: scroll !important;
        }
    }
    #newt, #tlod-id, #bd_id, h4{
        text-transform: none !important;
    }
</style>


<div class="dashboard-container">
  <img id="iloaddash_dash" src="/euf/assets/themes/standard/images/loading-large.gif">
<h2 align="center" id="nodata_found" style="display: none;"></h2>
            <h4 id="bd_id" class="hidden">Bill Discounting Loans</h4>
<div class="iamtablesdiv">
  <table id="msme_BD_dashboard_details"  class="table display table-bordered nowrap hidden " cellspacing="0" width="100%" style="overflow-wrap: break-word;">
        <thead>

            <tr>
             
                <th>Prospect Number</th>
                <th>Name</th>
                <th>Customer ID</th>
                <th>Sanction Limit</th>
                <th>Amount Utilized</th>
                <th>Available Limit</th>
                <th>Limit Start Date</th>
                <th>Limit End Date</th>
                <!-- <th>Loan Type</th> -->
                <!-- <th>Disbursement Amount</th> -->
        <!-- <th>No Dues Certificate Service</th> -->
        <!-- <th>No Dues Certificate without Cheque Service </th> -->

        

            </tr>
            
        </thead>


 
       
    </table>
</div>
            <h4 id="tlod_id" class="hidden">Other Loans</h4>
    <div class="iamtablesdiv">
    <table id="msme_TLODdashboard_details"  class="table display table-bordered  nowrap hidden " cellspacing="0" width="100%" style="overflow-wrap: break-word;">
        <thead>

            <tr>
             
              <!--   <th>Name</th>
                <th>LAN No</th>
                <th>Prospect No</th> -->
                 <!-- <th>Name</th> -->
                 <th>Loan Agreement No.</th>
                 <th>Loan Type</th>
                 <th>Status</th>
                 <th>Due Date/EMI Date</th>
                 <th>Monthly Due/Next Due</th>
                 <th>Interest Rate</th>
                 <th>Penal Interest Rate</th>
                 <th>EMI Amount</th>
                 <th>Payment Mode</th>
                 <th>Remaining Principal</th>
                 <!-- <th>Loan Status</th> -->
                 <th>Tenure</th>
                 <!-- <th>Ins Amount</th> -->
                 <th>Disbursement Amount</th>

                 <!-- <th>Prospect No</th> -->
                <!--  <th>Disbursed Amount</th>
                 <th>Current outstanding</th>
                 <th>Overdue if any</th>
                 <th>DPD if any</th>
                 <th>Next due Date </th>
                 <th>Due Amount</th> -->
        <!-- <th>No Dues Certificate Service</th> -->
        <!-- <th>No Dues Certificate without Cheque Service </th> -->

        

            </tr>
            
        </thead>
 
       
    </table>
</div>
    <!-- <div class="modal-dialog modal-xl" id="staticBackdrop"> -->
    
<!--  -->
<div class="modal fade" id="exampleModalXl_details_bd" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title h4" id="exampleModalXlLabel">BD Agreement Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" >
        <div class="iamtablesdiv">
        <table id="msme_BD_dashboard_documentdetails_details-table"  class="table display table-bordered nowrap" cellspacing="0" width="100%" style="overflow-wrap: break-word;" >
        <thead>

            
            <tr>
                 <!-- <th>Name</th>
                 <th>LAN No</th>
                 <th>Prospect No</th>
                 <th>Disbursed Amount</th>
                 <th>Current outstanding</th>
                 <th>Overdue if any</th>
                 <th>DPD if any</th>
                 <th>Next due Date </th>
                 <th>Due Amount</th> -->
               <!--  <th>Prospect No</th>
                <th>Loan Type</th>
                <th>SOA</th> -->
                <!-- <th>No Dues Certificate Service</th> -->
                <!-- <th>No Dues Certificate without Cheque Service </th> -->
                 <th>Loan Agreement No.</th>
                 <th>Status</th>
                 <th>Due Date/EMI Date</th>
                 <th>Monthly Due/Next Due</th>
                 <th>Interest Rate</th>
                 <th>Penal Interest Rate</th>
                 <th>EMI Amount</th>
                 <th>Payemnt Mode</th>
                 <th>Remaining Principal</th>
                 <!-- <th>Loan Status</th> -->
                 <th>Tenure</th>
                 <!-- <th>Ins Amount</th> -->
                 <th>Loan Amount</th>
                 <th>Invoice No.</th>
                 <th>Invoice Date</th>
                 <th>Invoice Value</th>
                 <th>Disbursed Amount</th>
                

            </tr>
            <!-- <tr class="bg-white"id="msme_BD_dashboard_documentdetails_details-tr"></tr> -->
            
        </thead>
 
       
    </table>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<script type="text/javascript">
document.getElementById('iloaddash_dash').style.display = "block";
var countTLOD = 0;
var countBD = 0;
var countTL = 0;
var countOD = 0;
var agreementtlod = [];
var agreementbd = [];
var agreement_bd_prospectlevel = [];
$.post("/cc/AjaxCustom/initialloanamount_accordin", {
        contact_id: '<?php echo $contact_id;?>',
        flag: 'true'
    })
    .done(function(data) {
        if(data!= undefined && data != null && data != ""){
            // $( "#select_loanamount_OD" ).html(data)  ;
            var somedata = data;
            somedata = somedata.replace(/null/g, '\"-\"');
            // somedata.replaceAll("null", "\"-\"");
            var main_data = JSON.parse(somedata);

            console.log("parsed data", JSON.parse(somedata));

            var count
            count = main_data.customerID;
            if (count) {
                if (count.toString().length != 8) {
                    document.getElementById('nodata_found').innerHTML = main_data.customerID;
                    document.getElementById('nodata_found').style.display = "block";
                    document.getElementById('iloaddash_dash').style.display = "none";

                    return;
                }
            }

            z = 0;
            q = 0;
            r = 0;
            s = 0;
            qe = 0;
            for (var i = 0; i < main_data.length; i++) {
                if (main_data[i]["agrrementNumberList"]) {


                    for (var j = 0; j < main_data[i].productDetailsList.length; j++) {
                        for (var k = 0; k < main_data[i].productDetailsList[j].agreementDetailList.length; k++) {
                            //        for(var z=0;z<main_data[i].productDetailsList[j].agreementDetailList.length;z++)
                            // {
                            if (main_data[i].productDetailsList[j].agreementDetailList[k].productCode == "OD" || main_data[i].productDetailsList[j].agreementDetailList[k].productCode == "TL") {
                                agreementtlod[z] = main_data[i].productDetailsList[j].agreementDetailList[k]
                                countTLOD++;
                                z++;
                            }
                            if (main_data[i].productDetailsList[j].agreementDetailList[k].productCode == "TL") {
                                // agreementtlod[r]=main_data[i].productDetailsList[j].agreementDetailList[k]
                                countTL++;
                                r++;
                            }
                            if (main_data[i].productDetailsList[j].agreementDetailList[k].productCode == "OD") {
                                // agreementtlod[s]=main_data[i].productDetailsList[j].agreementDetailList[k]
                                countOD++;
                                s++;
                            }
                            // }

                            // for( z=0;z<main_data[i].productDetailsList[j].agreementDetailList.length;z++)
                            //                                   {
                            if (main_data[i].productDetailsList[j].agreementDetailList[k].productCode == "BD") {
                                agreementbd[q] = main_data[i].productDetailsList[j].agreementDetailList[k]
                                agreement_bd_prospectlevel[agreementbd[q].agreementNumber] = main_data[i];

                                countBD++;
                                q++;

                            }


                            // if(main_data[i].productDetailsList[j].agreementDetailList[k].productCode=="BD")
                            //  {

                            //   }


                        }



                    }

                }
                qe++;

            }

            // agreementtlod=JSON.parse(JSON.stringify((agreementtlod)));
            // agreementbd=JSON.parse(JSON.stringify((agreementbd)));
            localStorage.setItem("countTL", countTL);
            localStorage.setItem("countOD", countOD);
            localStorage.setItem("countBD", countBD);
            localStorage.setItem("countTLOD", countTLOD);
            localStorage.setItem("agreementbd", JSON.stringify(agreementbd));
            localStorage.setItem("agreementtlod", JSON.stringify(agreementtlod));
            // console.log("countTLOD", agreementtlod);
            // console.log("countBD", agreementbd);
            // console.log("countTLOD" + countTLOD + "countBD:" + countBD);

            // 
            // document.getElementById('iloaddash').style.display="none";

            // [2].productDetailsList[0].agreementDetailList[0].productCode

            var ig = 0;
            var igt = 0;
            var prospect_unique=[];
            for (var iw = 0; iw < agreementbd.length; iw++) {
                $('#msme_BD_dashboard_details').removeClass('hidden');
                $('#bd_id').removeClass('hidden');

                
          if(!(prospect_unique.includes(agreementbd[iw].prospectNumber)))
                {

                  document.getElementById('msme_BD_dashboard_details').innerHTML += '<tr><td>' + agreementbd[iw].prospectNumber + '</td><td id="namebdddd' + iw + '"></td><td>' + agreement_bd_prospectlevel[agreementbd[iw].agreementNumber].customerID + '</td><td id="Amount_details' + iw + '"onclick="details_bd(' + iw + ')"><p class ="amount">' + agreement_bd_prospectlevel[agreementbd[iw].agreementNumber].sanctionedLimit + '</p></td><td id="namebdddd_total' + iw + '">' + agreement_bd_prospectlevel[agreementbd[iw].agreementNumber].utilizedLimit + '</td><td>' + agreement_bd_prospectlevel[agreementbd[iw].agreementNumber].availableLimit + '</td><td>' + agreement_bd_prospectlevel[agreementbd[iw].agreementNumber].limitStartDate + '</td><td>' + agreement_bd_prospectlevel[agreementbd[iw].agreementNumber].limitEndDate + '</td><tr>'
                    prospect_unique.push( agreementbd[iw].prospectNumber) ;
       
                //   

               for(var i=0;i<agreementbd.length;i++)
               {
                // console.log('inhere')
                value = agreementbd[i];
                document.getElementById('msme_BD_dashboard_documentdetails_details-table').innerHTML += '<tr><td>' + value.agreementNumber + '</td><td>' + value.status + '</td><td>' + value.emiDate + '</td><td>' + value.emiAmount + '</td><td>' + value.internalRateOfReturn + '</td><td>' + value.penalInterestRate + '</td><td>' + value.emiAmount + '</td><td>' + value.repaymentMode + '</td><td>' + value.remainingPrincipal + '</td><td>' + value.tenor + '</td><td>' + value.installmentAmount + '</td><td>' + value.disbursementAmount + '</td><td>' + value.invoiceNumber + '</td><td>' + value.agreementDate + '</td><td>' + value.disbursementAmount + '</td></tr>' ;
               }

                 
               }


                $.post("/cc/AjaxCustom/customerdetails", {
                        prospectNumber: agreementbd[iw].prospectNumber
                    })
                    .done(function(data) {



                        data = data.replace(/null/g, '\"-\"');
                        var data = JSON.parse(data);
                        // console.log('bddata', data)
                        var fname = data[0].firstName
                        var lname = data[0].lastName
                        if (fname == undefined) {
                            fname = "FirstName"
                        }
                        if (lname == undefined) {
                            lname = "LastName";
                        }
                        if(document.getElementById("namebdddd" + ig))
                        {
                           document.getElementById("namebdddd" + ig).innerHTML = fname + ' ' + lname;
                        }
                       
                        ig++;
                    });


            }
            var g = 0;

            for (var w = 0; w < agreementtlod.length; w++) {
                $('#msme_TLODdashboard_details').removeClass('hidden');
                $('#tlod_id').removeClass('hidden');

                // document.getElementById('msme_TLODdashboard_details').innerHTML += '<tr><td>' + agreementtlod[w].agreementNumber + '</td><td>' + agreementtlod[w].loanType + '</td><td>' + agreementtlod[w].status + '</td><td>' + agreementtlod[w].emiDate + '</td><td>' + agreementtlod[w].emiAmount + '</td><td>' + agreementtlod[w].internalRateOfReturn + '</td><td>' + agreementtlod[w].penalInterestRate + '</td><td>' + agreementtlod[w].emiAmount + '</td><td>' + agreementtlod[w].repaymentMode + '</td><td>' + agreementtlod[w].remainingPrincipal + '</td><td>' + agreementtlod[w].status + '</td><td>' + agreementtlod[w].tenor + '</td><td>' + agreementtlod[w].installmentAmount + '</td><td>' + agreementtlod[w].disbursementAmount + '</td><tr>';

                 document.getElementById('msme_TLODdashboard_details').innerHTML += '<tr><td>' + agreementtlod[w].agreementNumber + '</td><td>' + agreementtlod[w].loanType + '</td><td>' + agreementtlod[w].status + '</td><td>' + agreementtlod[w].emiDate + '</td><td>' + agreementtlod[w].emiAmount + '</td><td>' + agreementtlod[w].internalRateOfReturn + '</td><td>' + agreementtlod[w].penalInterestRate + '</td><td>' + agreementtlod[w].emiAmount + '</td><td>' + agreementtlod[w].repaymentMode + '</td><td>' + agreementtlod[w].remainingPrincipal + '</td><td>' + agreementtlod[w].tenor + '</td><td>' + agreementtlod[w].disbursementAmount + '</td><tr>';


            }

            document.getElementById('iloaddash_dash').style.display = "none";

        }
        else{
            $("#nodata_found").html("Some error occured. Please Contact CRM Helpdesk.").css("display","block");
            document.getElementById('iloaddash_dash').style.display = "none";
        }
    });
var df = 0;

function details_bd(valuee) {
    
    $('#msme_TLODdashboard_details').removeClass('hidden');

    jQuery('#exampleModalXl_details_bd').modal('toggle');

}
</script>
<style type="text/css">
    h4{
        font-size: 16px !important;
    }
</style>