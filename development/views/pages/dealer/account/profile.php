<rn:meta title="#rn:msg:ACCOUNT_SETTINGS_LBL#" template="dealer_header.php" login_required="true" force_https="true" clickstream="dealer_profile_update" />
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('dealer');

 $contact_id = $CI->session->getProfileData("c_id");
 if(strlen($contact_id)>0)
 {
    $con = RightNow\Connect\v1_3\Contact::fetch($contact_id);
    $phone_num = $con->Phones[0]->Number;
    $current_email = $con->Emails[0]->Address;
    $fname = $con->Name->First;
    $lname = $con->Name->Last;
    $dealer_code = $con->CustomFields->c->dealer_code;

 }
 else{
  header("Location: /app/error404");
 }
?>
<style type="text/css">
    #updateSubmit{
        display: none;
    }
    #formSubmit{
        display: none;
    }
    #theloader {
    display:none;
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
  }
  input[type="text"]{
    background-color: #fff;
  }
  fieldset{
    background-color: #efefef;
    padding-bottom: 30px;
  }
  input,button,select{
    border-radius: 30px !important;
    padding-left: 18px;
  }
  .black{
    color:black !important;
  }
  .radio-inline + .radio-inline, .checkbox-inline + .checkbox-inline{
    margin:10px 10px 0px !important;
  }
  .putleft{
      margin-left: 8px !important;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('#theloader').show();
        setTimeout(function(){
        var gotdata = getData();
        if(gotdata!=null){
            $('#bank').val(gotdata.data.bank);
             // $('#gst').val(gotdata.data.gst);
              // $('#pan').val(gotdata.data.pan);
               $('#adhaar').val(gotdata.data.adhaar);
               
        }
        
        $('#theloader').hide();
    },2000);

    });
    $(document).ajaxStart(function(){
    // Show image container
    $("#theloader").show();
  });
  $(document).ajaxComplete(function(){
    // Hide image container
    $("#theloader").hide();
  });
    function showLoader(){
   $("#theloader").show();
  }
  function hideLoader(){
   $("#theloader").hide();
  }
  function getData(){
   var test;
   $.ajax({
              url: "/cc/DealerCustom/getImpData",
              type: "post",
              data: "c_id=<? echo $contact_id; ?>",
              async:false,
              beforeSend : function(){showLoader();},
              success: function(response) {
                   hideLoader();
                   test = response;
                  console.log(response.data);
                  
              },
              error: function(er){
                console.log(er);
                test = er;
              }
  });
    return test;
  }



  function checkmail(){
    var emailaddress =  document.getElementById("email");
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
     if(re.test(emailaddress.value) == true){
        return true;
     }
     else if(emailaddress.value.length == 0 ){
      alert("No Email address Provided");
      return false;
     }
     else{
      alert("Invalid Email Address");
      emailaddress.value = "";
      return false;
     }
  }
  function checkadhaar(){
    var adhaar =  document.getElementById("adhaar");
    var re = /^[0-9]{12}$/;
    if(re.test(adhaar.value)==true){
        return true;
    }
    else if(adhaar.value.length == 0 ){
      
      return true;
     }
    else{
        alert("Enter Valid Adhaar Number");
        return false;
    }
  }
function checkpan(){
    var pan = document.getElementById('pan');
    var re = /^[a-zA-Z]{3}[ABCFGHJLPT]{1}[a-zA-Z]{1}[0-9]{4}[a-zA-Z]{1}$/;
    if(re.test(pan.value)==true){
        return true;
    }
    else if(pan.value.length == 0 ){ 
      return true;
     }
    else{
        alert("Enter Valid PAN Number");
        return false;
    }
}

</script>
<div class="rn_Hero">
    <div class="rn_Container">
        <h1>#rn:msg:ACCOUNT_SETTINGS_LBL#</h1>
    </div>
</div>
<style type="text/css">
    fieldset{
    background-color: #efefef;
    padding-bottom: 30px;
  }
  .rn_FormSubmit{
    padding-top: 0px !important;
  }
</style>

<div class="rn_PageContent rn_Profile rn_Container">
<div id="theloader"></div>
    <fieldset>
        <form action="" method="POST" id="impdata">
            <div class="left-half col-lg-6 col-md-6 col-sm-4 col-xs-12">
                 <div class="form-group">
                  <label for="fname">First Name:</label>
                  <input type="text" class="form-control" id="fname" placeholder="John" name="fname"  value="<?php echo $fname; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="lname">Last Name:</label>
                  <input type="text" class="form-control" id="lname" placeholder="Doe"  name="lname" value="<?php echo $lname; ?>" readonly>
                </div> 
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="abc@example.com" name="email" value="<?php echo $current_email; ?>">
                </div>
                <div class="form-group">
                  <label for="pwd">Phone Number:</label>
                  <input type="text" class="form-control" id="realphone" placeholder="10 Digits only" name="realphone" value="<?php echo $phone_num; ?>">
                </div>
                
            </div>
            <div class="right-half col-lg-6 col-md-6 col-sm-4 col-xs-12">
                <div class="form-group">
                  <label for="pan">Pan Number</label>
                  <input type="text" readonly class="form-control" id="pan" maxlength="10" placeholder="10 digit Pan Number" onblur="checkpan()"  name="pan">
                  <input type="hidden" name="contact_id" value="<?php echo $contact_id; ?>">
                </div>
                <div class="form-group">
                  <label for="adhaar">Aadhaar Number</label>
                  <input type="text" class="form-control" id="adhaar" maxlength="12" placeholder="12 Digit Aadhaar Number"  name="adhaar">
                </div>
                <div class="form-group">
                  <label for="gst">GST IN Number</label>
                  <input type="text" readonly class="form-control" id="gst" placeholder="GST IN Number" maxlength="15" name="gst">
                </div>
                <div class="form-group">
                  <label for="bank">Bank Account Number</label>
                  <input type="text" class="form-control" id="bank" maxlength="25" placeholder="Bank A/C Number"  name="bank">
                </div>
            </div>
            <div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12 putleft" >
              <input type="submit" class="btn btn-primary" style="width: 100% !important; margin-top: 10px;display: block;" id="formSubmit" value="Save Changes"></input>
              <!-- <input type="submit" class="btn btn-primary" style="width: 100% !important; margin-top: 10px;" id="updateSubmit" value="Update"></input> -->
            </div>
        </form>
    </fieldset>
</div>
<script type="text/javascript">
    //Update FORM SUBMIT
    var new_mail;
    var new_phone;
    var previous_email;
    var previous_phone;
    
    
  $('form#impdata').submit(function(e){
    e.preventDefault();
    var chkadhaar = checkadhaar();
    var chkmail = checkmail();
    var chkpan = checkpan();
     new_mail=document.getElementById('email').value
     new_phone=document.getElementById('realphone').value
    if(chkadhaar && chkmail && chkpan && new_mail == previous_email && previous_phone == new_phone){
    $('#theloader').show();
        $.ajax({
                    url: "/cc/DealerCustom/justUpdateImpData",
                    type: "post",
                    data: $('#impdata').serialize(),

                    success: function (response)
                    {
                        if(response.statusCode == "SR"){
                            alert("Save Success!");
                            location.reload();
                        }
                        else{
                            alert("Could Not Save. Please try again later.");
                        }
                    },
                    error: function (er)
                    {
                      console.log("Some error");
                    },
                    complete: function(){
                        setTimeout(function(){
                           $('#theloader').hide();
                        },4000);
                    }
            });
        
           
        }
        else
        {
            var param=
            {
                
                            'con' : "<? echo $contact_id; ?>",
                            'email': new_mail,
                            'phone': new_phone
                            
                
                     
            };
            $('#theloader').show();
          $.ajax({
                    url: "/cc/DealerCustom/CreateIncident",
                    type: "post",
                    data: param,

                    success: function (response)
                    {
                      var res 
                      if(response)
                      {
                         res = JSON.parse(response);
                      }
                        
                        console.log(res)
                        if(response){
                            alert("Request for new email id or mobile no. is been registered with us. Our team will  contact you shortly Incident Reference No: "+res[0].value_refno);
                            // location.reload();
                        }
                        else{
                            alert("Update of email and phone no already in process. Our agents shall call the you on your old contact no. and ask you to confirm your dealership name & address details and also get confirmation on whether the given mail id or mobile number to be updated as a primary or secondary contact details");
                        }
                    },
                    error: function (er)
                    {
                      console.log("Some error");
                    },
                    complete: function(){
                      $('#theloader').hide();
                        setTimeout(function(){
                           $('#theloader').hide();
                        },8000);
                    }
            });
        }
  });


$(document).ready(function(){

  previous_email=document.getElementById('email').value;
  previous_phone=document.getElementById('realphone').value;
  $.ajax({
                    url: "/cc/DealerCustom/getGST_PAN",
                    type: "post",
                    data: "dlc=<? echo $dealer_code; ?>",
                    beforeSend:function (){
                      $('#theloader').show();
                    },
                    success: function (response)
                    {
                        console.log(response);
                        if(response.ReturnMessage!="No Data Found.")
                      {
                            if(response.ReturnOutput)
                            {
                                if(response.ReturnOutput[0].GST_NO)
                                {
                                      $('#gst').val(response.ReturnOutput[0].GST_NO);
                                }
                                if(response.ReturnOutput[0].PAN_NUMBER)
                                {
                                            $('#pan').val(response.ReturnOutput[0].PAN_NUMBER);                             
                                }
                            }
                            
                      }
                      else
                     {
                               $('#gst').prop("disabled", true);
                               $('#pan').prop("disabled", true);
                             $('#adhaar').prop("disabled",true);
                             $('#bank').prop("disabled", true);
                     }
                     $('#theloader').hide();  
                    },
                    error: function (er)
                    {
                      console.log("Some error",er);
                    },
                    
            });


});

</script>