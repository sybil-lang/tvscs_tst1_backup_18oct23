<html>
<head></head>
<body>
  <img id="iloadf" src="/euf/assets/themes/standard/images/loading-large.gif">
  <style type="text/css">
    #iloadf
    {
      height: 80px;
      position: absolute;
      top: 40%;
      right: 50%;
      display:none;
    }
        
      #cont-div-Foreclosure table th
      {
        /*color: black !important;*/
        color: white !important;
        background-color: #108a43;
      }
   #cont-div-Foreclosure
   {
    display: flex;
    flex-direction: column;
   }
/*   #cont-div-Foreclosure table a
   {
    color: black !important;
    background-color: #b2c3d7 !important;
   }*/
  #cont-div-Foreclosure table
{
  width: 95%;

}
[data-toggle="collapse"] .fa:before {   
  content: "\f139";
}
td
{
  background: white;
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
#cont-div-Foreclosure a
{
  background: #114984 !important;
  /*width: 60%*/
}

#cont-div-Foreclosure table a {
color: #114984 !important;
background-color: white !important;
font-weight: bold;
}

@media only screen and (max-width: 450px) {
 #cont-div-Foreclosure
  {
    /*overflow-x:auto;*/
  }
 #cont-div-Foreclosure table
  {
    width:auto!important;
    overflow-x:auto;

  }
#cont-div-Foreclosure th
  {
    width:auto!important;
  }
  .overfloww
  {
    overflow-x:auto;
    width: 95%;
  }
}
</style>
<?php
 //$report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');
$contact_id=$CI->session->getProfileData("c_id");

$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_NO_MSME);
$report_id=$msg->Value;
?>
<!-- <h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4> -->
<h4  class="not_visible_in_mobile"   style="margin-top:15px;">Foreclosure</h4>

<div id="cont-div-Foreclosure"></div>
<form action='#' method='post' class="loan-form">
  <fieldset>
    <!-- <div id="instrumentdetails"></div> -->
<!-- <rn:widget  path="custom/Loan/LoanSelection" your_condition="forclosure" /> -->


  </fieldset>
  
</form>




<script type="text/javascript">
document.getElementById('iloadf').style.display="block";
var sub_val; 

 $.post( "/cc/AjaxCustom/initialloanamount_accordin", {contact_id : '<?php echo $contact_id;?>',flag :'true' })
  .done(function( data ) 
  {

     // $( "#select_loanamount_OD" ).html(data);
     var main_data=JSON.parse(data);
     console.log(JSON.parse(data));
     for(var i=0;i<main_data.length;i++)
     {
     document.getElementById('cont-div-Foreclosure').innerHTML+='<a class="btn btn-primary left-align" data-toggle="collapse" href="#fmultiCollapseExample'+i+'" role="button" aria-expanded="false"aria-controls="fmultiCollapseExample'+i+'"><i class="fa"></i>      Prospect NO:    '+main_data[i]["prospectNumber"]+' </a><div class="collapse multi-collapse" id="fmultiCollapseExample'+i+'"><div class="overfloww"><table id="cont-div-Foreclosure'+main_data[i]["prospectNumber"]+'" class="table display table-bordered nowrap "><th>Agreement No</th><th>Loan Type</th><th>Foreclosure Letter</th><th>Sanction Letter</th><th>Welcome Letter</th></table></div></div>'
          if(main_data[i]["agrrementNumberList"]){


             for(var j=0;j<main_data[i].productDetailsList.length;j++)
               {
                  for(var k=0;k<main_data[i].productDetailsList[j].agreementDetailList.length;k++)
                  {
                 document.getElementById('cont-div-Foreclosure'+main_data[i]["prospectNumber"]).innerHTML+='<td>'+main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber+'</td><td>'+main_data[i].productDetailsList[j].agreementDetailList[k].productCode+'</td><td><a target="_blank" href= "https://msmeportaluat.tvscredit.com/MSMEServices/generateForeClosurePDF?agreementNumber='+main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber+'">Download</a></td><td><a target="_blank" href= "https://msmeportaluat.tvscredit.com/MSMEServices/generateSanctionLetter?agreementNumber='+main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber+'">Download</a></td><td><a target="_blank" href= "https://msmeportaluat.tvscredit.com/MSMEServices/getwelcomeletter?agreementNumber='+main_data[i].productDetailsList[j].agreementDetailList[k].agreementNumber+'">Download</a></td></tr>'
                  }
               }

     }
 }

document.getElementById('iloadf').style.display="none";

});



	     

									
</script>

</body>
</html>