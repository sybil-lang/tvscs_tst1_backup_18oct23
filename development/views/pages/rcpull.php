<?php
 $CI=&get_instance();
  $mobile="";
 $contact_id=$CI->session->getProfileData("c_id");
    $contact =  \RightNow\Connect\v1_3\Contact::fetch($contact_id);
    $cccc=$contact->Name->First.' '.$contact->Name->Last ;
    for($i=0;$i<count($contact->Phones);$i++)
    {
    if($contact->Phones[ $i ]->PhoneType->LookupName == 'Mobile Phone');
    $mobile=$contact->Phones[ $i ]->Number ;
    }
$CI->load->helper('report');

checkCustomerType('customer');

?>
<html>
<head><style type="text/css">
    #loader-img-div
        {
        height: 80px;
        position: absolute;
        top: 101px;
        right: 599px;
        display:none;
        }
        .modal-content
        {
          height: auto !important;
        }

.first-input input[type=file], input[type=file] 
{
    position: relative !important;
}

    </style></head>
<body>
     <img id="loader-img-div" src="/euf/assets/themes/standard/images/loading-large.gif">
<?php
// $report_id = \RightNow\Utils\Url::getParameter('r_id');
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
$report_id=$msg->Value;
?>
<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>

<form action='#' method='post' class="loan-form">
  <fieldset>
    <div id="rcpull"></div>

  </fieldset>
</form>
<div id="image_form_div" style="display:none"> 
<!-- <div id="image_form_div" >  -->

<label for="text" />RC Number</label><input type="rc" id="RC_no" name="RC_no">
<form id="image_form" name="image_form" pattern="[a-zA-Z0-9]+"  enctype="multipart/form-data" >

  

  <input type="hidden" name="json" id="json">
  <!-- <div class="row"> -->
  <label for="file1" />choose a file1</label><input type="file"  name="image1" id="image1" />
  
  <label for="file2" />choose a file2</label> <input type="file"  name="image2" id="image2"  />
  
  <label for="file3" />choose a file3</label><input type="file"  name="image3" id="image3" />
  
  <label for="file4" />choose a file</label><input type="file"  name="image4" id="image4" />
 <!-- </div> -->

  <div style="text-align: center;"><button type="button" class="btn-primary"  name="submit" id="submit" >SUBMIT</button></div>
 

    
</form>
</div>
<p>&nbsp;</p>
<div id="rcpull_showresult"></div>
<script type="text/javascript">
$.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'rcpull', method_val : 'rcpull'})
													 .done(function( data ) 
                                                     {
												        $( "#rcpull" ).html(data);


										              });


  $('#submit').on("click",function(){
    var rc =$("#RC_no").val();
    var agg =$("#rc_pull").val();
    var mobile='<?php echo $mobile ?>';


    $("#json").val('{ "App_key":"R0VUX1JDX0RFVEFJTFM=","Aggrement_no":"'+agg+'","Action":"FILE_UPLOAD","User_Id":"ADMIN","Req_by":"CPORTAL","Mob_no":"'+mobile+'","RC_no":"'+rc+'"}')
    console.log($("#json").val());
  

    // var data = new FormData(form);
          var datastring = $("#image_form").serializeArray();
          var formDataInstance = new FormData();
          var image_1_file = $('input[type="file"]')[0].files[0];
          var image_2_file = $('input[type="file"]')[1].files[0];
          var image_3_file = $('input[type="file"]')[2].files[0];
          var image_4_file = $('input[type="file"]')[3].files[0];
         
          if (image_1_file) {
            formDataInstance.append("image1", image_1_file);
          }
          if (image_2_file) {
            formDataInstance.append("image2", image_2_file);
          }
          if (image_3_file) {
            formDataInstance.append("image3", image_3_file);
          }
          if (image_4_file) {
            formDataInstance.append("image4", image_4_file);
          }
         
          $.each(datastring, function (key, input) {
            formDataInstance.append(input.name, input.value);
          });



          $.ajax({
                                  url: '/cc/AjaxCustom/rcpullUpload',
                                  processData: false,
                                  contentType: false,
                                  // async: false,
                                  // datatype: "json",
                                  data: formDataInstance,
                                  beforeSend: function () {
                                    $('#loader-img-div').css('display','block');
                                    // $('body').css('display','none');
                                  },
                                  complete: function(){
                                    $('#loader-img-div').css('display','none');
                                    // $('body').css('display','block');
                                  },
                                  error: function () {
                                    //window.location.reload();
                                     bootbox.alert("<p>An error has occurred....</p>");
                                  },
                                  success: function (response) {
                                   
                                    var obj = jQuery.parseJSON(response);
                                  
                                    console.log(obj);
                                    if(obj[0].result=="FILE_UPLOADED_SUCCESFULLY")
                                    {
                                            bootbox.alert("File Upload Successful", function() {
                                              location.reload();
                                          });
                                    }
                                    else
                                    {
                                            bootbox.alert("File Upload Unsuccessful", function() {
                                                  location.reload();
                                              });

                                    }
                                   
                                  },
                                  type: 'POST'
                                });   



                });  

                                             
				
									
</script>

</body>
</html>