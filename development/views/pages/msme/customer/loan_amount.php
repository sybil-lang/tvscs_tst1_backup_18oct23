<html>
<head>
    <style>
      table{
        overflow-x: scroll !important;
      }
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
        #iload
        {
        height: 80px;
        position: absolute;
        top: 40%;
        right: 50%;
        display:none;
        }
        .z-container{
            min-height: 500px !important;
        }
       #cont-div table th
  {
    /*color: black !important;*/
    /*overflow-x: scroll;*/
    color: white !important;
background-color: #108a43;
  }
  .overflow
  {
    overflow-x: scroll;
  }
   #cont-div
   {
    display: flex;
    flex-direction: column;
   }
  #cont-div table
{
  width: 95%;
}
#cont-div a
{
  background: #114984 !important;
  /*width: 30%*/
}
td
{
  background: white;
}
[data-toggle="collapse"] .fa:before {   
  content: "\f139";
}

[data-toggle="collapse"].collapsed .fa:before {
  content: "\f13a";
}
.left-align
{
  text-align: left;
 font-size: initial;
 font-weight: bold;
 
}
@media only screen and (max-width: 450px) {
  .not_visible_in_mobile {
    display: none;
  }
}
   </style></head>

<body>
  <img id="iload" src="/euf/assets/themes/standard/images/loading-large.gif">
<?php
// $report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_NO_MSME);
$report_id=$msg->Value;
$contact_id=$CI->session->getProfileData("c_id");
?>
<h4 class="not_visible_in_mobile"  style="margin-top:15px; text-transform:none !important;">Initial Loan Amount</h4>

<!-- <rn:widget  path="custom/Loan/LoanSelection" your_condition="select_loanamount"/> -->
<!-- <form action='#' method='post' class="loan-form">
  <fieldset>
    <div id="initialloanamount"></div>

  </fieldset>
</form> -->

<div id="cont-div"></div>
<p>&nbsp;</p>
<div id="showresult"></div>
<script type="text/javascript">
                            document.getElementById('iload').style.display="block";

    // if(document.getElementById('select_loanamount'))
    // {
      var sub_val;
//       function checking()
     
//      { 
//       if(document.getElementById('OD_idselect_loanamount'))

//       {
//           if(document.getElementById('OD_idselect_loanamount').checked){

//         sub_val='OD';
//           $.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'initialloan', filter_subloan: sub_val , method_val : 'initialloanamount'})
//                            .done(function( data ) {
//                          $( "#select_loanamount_OD" ).html(data);
//                      });
//                          }
//       }
//       if (document.getElementById('TL_idselect_loanamount')) 
//       {
//         sub_val='TL';
//           if(document.getElementById('TL_idselect_loanamount').checked){
        
//         $.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'initialloan', filter_subloan: sub_val , method_val : 'initialloanamount'})
//                            .done(function( data ) {
//                          $( "#select_loanamount_TL" ).html(data);
//                      });
//       }

//       }
//       if(document.getElementById('BD_idselect_loanamount'))


//       {


//           if(document.getElementById('BD_idselect_loanamount').checked){
//           $.post( "/cc/AjaxCustom/rest_api_report2", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'initialloan',filtering_val2 : 'BD', method_val :'initialloanamount'})
//                            .done(function( data ) {
//                        $( "#select_loanamount_BD" ).html(data);
//                });
//                          }

//                        }
// }

                                                   // $('#TL_idselect_loanamount').change(function()
                                                   // {      document.getElementById('select_loanamount_OD').style.display="none";
                                                   //        document.getElementById('select_loanamount_BD').style.display="none";
                                                   //        document.getElementById('select_loanamount_TL').style.display="block";

                                                   //        checking();
                                                   //  });  
                                                   // $('#OD_idselect_loanamount').change(function()
                                                   // {
                                                   //         document.getElementById('select_loanamount_OD').style.display="block";
                                                   //        document.getElementById('select_loanamount_TL').style.display="none";
                                                   //        document.getElementById('select_loanamount_BD').style.display="none";
                                                   //        checking();
                                                   //  });
                                                   // $('#BD_idselect_loanamount').change(function()
                                                   // {
                                                   //        document.getElementById('select_loanamount_OD').style.display="none";
                                                   //        document.getElementById('select_loanamount_BD').style.display="block";
                                                   //        document.getElementById('select_loanamount_TL').style.display="none";
                                                   //        checking();
                                                   //  });
                                                




                          $.post( "/cc/AjaxCustom/initialloanamount_accordin", {contact_id : '<?php echo $contact_id;?>',flag :'true' })
                           .done(function( data ) {

                         // $( "#select_loanamount_OD" ).html(data);
                         var main_data=JSON.parse(data);
                         console.log(JSON.parse(data));
                         for(var i=0;i<main_data.length;i++)
                         {
                         document.getElementById('cont-div').innerHTML+='<a class="btn btn-primary left-align" data-toggle="collapse" style="text-transform:none !important;"  href="#multiCollapseExample'+i+'" role="button" aria-expanded="false"aria-controls="multiCollapseExample'+i+'"><i class="fa"></i>  Prospect No. : '+main_data[i]["prospectNumber"]+' </a><div class="collapse multi-collapse" id="multiCollapseExample'+i+'"><div class=""><table id="'+main_data[i]["prospectNumber"]+'" class="table display table-bordered nowrap "><th>Agreement No.</th><th>Loan Type</th><th>Disbursement Amount / Limit Utilised</th></table></div></div>'
                              if(main_data[i]["agrrementNumberList"]){
                                for(var j=0;j<main_data[i].productDetailsList.length;j++)
                                   {
                                      for(var k=0;k<main_data[i].productDetailsList[j].agreementDetailList.length;k++)
                                      {
                                        if(main_data[i].productDetailsList[j].agreementDetailList[k].disbursementAmount == null || main_data[i].productDetailsList[j].agreementDetailList[k].disbursementAmount == "null"){
                                          main_data[i].productDetailsList[j].agreementDetailList[k].disbursementAmount = 0;
                                        }
                                     document.getElementById(main_data[i]["prospectNumber"]).innerHTML+='<td>'+main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber+'</td><td>'+main_data[i].productDetailsList[j].agreementDetailList[k].productCode+'</td><td>'+main_data[i].productDetailsList[j].agreementDetailList[k].disbursementAmount+'</td></tr>'
                                      }
                                   }
                         }
                     }

                            document.getElementById('iload').style.display="none";


                     });


    // [0].productDetailsList[0].agreementDetailList[0].agreementNumber
   
</script>

</body>
</html>