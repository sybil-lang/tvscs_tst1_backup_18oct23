<?php
 $CI=&get_instance();
$CI->load->helper('report');
$contact_id=$CI->session->getProfileData("c_id");
checkCustomerType('customer');
?>
<html>
<head><style type="text/css">
    #isload
        {
        height: 80px;
        position: absolute;
        top: 40%;
        right: 50%;
        display:none;
        }
         #cont-div-status-loan
   {
    display: flex;
    flex-direction: column;
   }
  #cont-div-status-loan table
{
  width: 95%;
}
#cont-div-status-loan a
{
  background: #114984 !important;
  /*width: 30%*/
}
 #cont-div-status-loan table th
  {
    /*color: black !important;*/
    color: white !important;
background-color: #108a43;
  }
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

td
{
  background: white;
}


 
    </style></head>
<body>
     <img id="isload" src="/euf/assets/themes/standard/images/loading-large.gif">
<?php
// $report_id = \RightNow\Utils\Url::getParameter('r_id');
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_NO_MSME);
$report_id=$msg->Value;
?>


<h4 class="not_visible_in_mobile" style="margin-top:15px;text-transform:none !important;">Loan Status</h4>

<!-- <form action='#' method='post' class="loan-form">
  <fieldset>
    <div id="statusofloan"></div>
<rn:widget  path="custom/Loan/LoanSelection" your_condition="statusofloan" />
  </fieldset>
</form>

 -->
<div id="cont-div-status-loan"></div>
 <p>&nbsp;</p>
<div id="showresult_loan"></div>
<script type="text/javascript">
// $.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'statusofloan', method_val : 'statusofloan'})
//                           .done(function( data ) {
//                         $( "#statusofloan" ).html(data);
//                     });
    // if(document.getElementById('statusofloan'))
                            document.getElementById('isload').style.display="block";

function checking() 
{
      var sub_val;
      if(document.getElementById('OD_idstatusofloan'))

      {
      if(document.getElementById('OD_idstatusofloan').checked)
      {

        sub_val='OD';
        $.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'instrumentdetails', filter_subloan: sub_val, method_val : 'getInsuranceDetails'})
                                                     .done(function( data ) {
                                                 $( "#statusofloan_OD" ).html(data);
                                         });
      }
  }
      if(document.getElementById('TL_idstatusofloan'))
      {
      if(document.getElementById('TL_idstatusofloan').checked)
      {
        sub_val='TL';
        $.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'instrumentdetails', filter_subloan: sub_val, method_val : 'getInsuranceDetails'})
                                                     .done(function( data ) {
                                                 $( "#statusofloan_TL" ).html(data);
                                         });
      }
  }


              // }
              if(document.getElementById('BD_idstatusofloan')) {

              if(document.getElementById('BD_idstatusofloan').checked) {


                                    $.post( "/cc/AjaxCustom/rest_api_report2", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'statusofloan',filtering_val2 : 'BD', method_val : 'statusofloan'})
                                                     .done(function( data ) {
                                                 $( "#statusofloan_BD" ).html(data);
                                         });
                    }
                }
        
}


                                                  // $('#TL_idstatusofloan').change(function()
                                                  //  {
                                                  //         checking();
                                                  //   });  
                                                  //  $('#OD_idstatusofloan').change(function()
                                                  //  {
                                                  //         checking();
                                                  //   });
                                                  //  $('#BD_idstatusofloan').change(function()
                                                  //  {
                                                  //         checking();
                                                  //   });

                                                   $.post( "/cc/AjaxCustom/initialloanamount_accordin", {contact_id : '<?php echo $contact_id;?>',flag :'true' })
                           .done(function( data ) {
                         // $( "#select_loanamount_OD" ).html(data);
                         var main_data=JSON.parse(data);
                         console.log(JSON.parse(data));
                         for(var i=0;i<main_data.length;i++)
                         {
                         document.getElementById('cont-div-status-loan').innerHTML+='<a class="btn btn-primary left-align" style="text-transform:none !important;" data-toggle="collapse" href="#-status-loanmultiCollapseExample'+i+'" role="button" aria-expanded="false"aria-controls="-status-loanmultiCollapseExample'+i+'"><i class="fa"></i>  Prospect No. :'+main_data[i]["prospectNumber"]+' </a><div class="collapse multi-collapse" id="-status-loanmultiCollapseExample'+i+'"><table id="-status-loan'+main_data[i]["prospectNumber"]+'" class="table display table-bordered nowrap "><th>Agreement No.</th><th>Loan Type</th><th>Status</th></table></div>'
                              if(main_data[i]["agrrementNumberList"]){
                                ///////////////
                                for(var j=0;j<main_data[i].productDetailsList.length;j++)
                                   {
                                      for(var k=0;k<main_data[i].productDetailsList[j].agreementDetailList.length;k++)
                                      {
                                     document.getElementById('-status-loan'+main_data[i]["prospectNumber"]).innerHTML+='<td>'+main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber+'</td><td>'+main_data[i].productDetailsList[j].agreementDetailList[k].productCode+'</td><td>'+main_data[i].productDetailsList[j].agreementDetailList[k].status+'</td></tr>'
                                      }
                                   }





                                ////////////

                              // for(var j=0;j<main_data[i]["agrrementNumberList"].length;j++)
                              //    {
                              //    document.getElementById('-status-loan'+main_data[i]["prospectNumber"]).innerHTML+='<td>'+main_data[i]["agrrementNumberList"][j]+'</td><td>'+main_data[i].productDetailsList[j].agreementDetailList[0].status+'</td></tr>'
                              //  }
                         }
                     }
                            document.getElementById('isload').style.display="none";

                     });
                  
</script>

</body>
</html>