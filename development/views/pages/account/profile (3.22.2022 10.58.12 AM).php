<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="standard.php" login_required="true" force_https="true" clickstream="profile"/>
<div class="rn_Hero">
    <div class="rn_Container">
        <h1>#rn:msg:ACCOUNT_SETTINGS_LBL#</h1>
    </div>
</div>
<div class="rn_PageContent rn_Profile rn_Container">
    <rn:condition flashdata_value_for="info">
        <div class="rn_MessageBox rn_InfoMessage" role="alert">
            #rn:flashdata:info#
        </div>
    </rn:condition>

    <rn:condition url_parameter_check="msg != null">
        <div class="rn_MessageBox rn_InfoMessage" role="alert">#rn:url_param_value:msg#</div>
    </rn:condition>
<h2>#rn:msg:CONTACT_INFO_LBL#</h2>
<fieldset>
<div id="theloader"></div>
<div id="OTPModal" class="modal fade">
  <div class="modal-dialog modal-sm modal-login">
    <div class="modal-content">
      <form action="#" method="post">
        <div class="modal-header">        
          <h4 class="modal-title">Verify OTP</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">        
          <div class="form-group">
            <label>Please enter OTP sent to your Email ID</label>
            <input type="text" class="form-control" id="otp" required="required">
          </div>
          <span id="error_text_otp" style="color: red;"></span>
                    
        </div>
        <div class="modal-footer">
          
          <input type="button" id="verify_button" class="btn btn-primary pull-right" value="Verify Now">
        </div>
      </form>
    </div>
  </div>
</div> 
<div id="OTPModal2" class="modal fade">
  <div class="modal-dialog modal-sm modal-login">
    <div class="modal-content">
      <form action="#" method="post">
        <div class="modal-header">        
          <h4 class="modal-title">Verify OTP</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">        
          <div class="form-group">
            <label>Please enter OTP re-sent to your Email ID</label>
            <input type="text" class="form-control" id="otp2" required="required">
          </div>
          <span id="error_text_otp2" style="color: red;"></span>
                    
        </div>
        <div class="modal-footer">
          
          <input type="button" id="verify_button2" class="btn btn-primary pull-right" value="Re-Verify">
        </div>
      </form>
    </div>
  </div>
</div> 
<?php
 $CI = &get_instance();
 $contact_id = $CI->session->getProfileData("c_id");
 if(strlen($contact_id)>0)
 {
    $con = RightNow\Connect\v1_3\Contact::fetch($contact_id);
    $phone_num = $con->Phones[0]->Number;
    $current_email = $con->Emails[0]->Address;
    $fname = $con->Name->First;
    $lname = $con->Name->Last;
 }
 else{
  header("Location: /app/error404");
 }
?>
<style type="text/css">
  .modal {
    overflow-y: auto;
  }
  .modal-content {
    
    overflow-y: hidden !important;
    position: fixed;
    top: 0px !important;
    width: 390px;
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
  .verifiedBTN{
    background-color: green !important;
    font-weight: bold;
    opacity: 0.5 !important;
    cursor: not-allowed; 
  }
  @media screen (max-device-width: 480px) and (min-device-width: 360px) and(orientation: portrait) 
  {
      form > input[type=submit]{
      margin-left: 25px !important;
      margin-top: 24px !important;
      width: 100% !important;
    }

    .btn{
      width: 100% !important;
    }
    .form-group input, .form-group~input[type="submit"], .custom_log .submit, .custom_log .submit:hover, button:active:not(:disabled), input[type="submit"]:active:not(:disabled){
      width: 100% !important;
    }
    input[type=file], input[type=text]{
      width: 100% !important;
    }
  }
  form > input[type=submit]{
      margin-left: 0px !important;
      margin-top: 24px !important;
    }
  .form-control{
    width: 100% !important;
    min-width: 100% !important;
  }
  .rn_SearchControls .rn_SourceSearchButton .rn_SubmitButton{
    right: 10px !important;
  }
</style>
<script type="text/javascript">
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
  function checkVerified(){
    var veri_email = "<?php echo $current_email; ?>";
    if($('#email').val().toLowerCase()==veri_email){
      localStorage.setItem("isVerified","true");
      console.log("inside CheckVerified");
    }
    else{
      return false;
    }
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
  function checkmail2(){
    var emailaddress =  document.getElementById("email");
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
     if(re.test(emailaddress.value) == true){
        return true;
     }
     else if(emailaddress.value.length == 0 ){
     
      return true;
     }
     else{
      alert("Invalid Email Address");
      emailaddress.value = "";
      return false;
     }
  }
  function checkvalidity(){
    var numb = document.getElementById("phone");
    var patt = new RegExp("[789]{1}[0-9]{9}");
    var res = patt.test(numb.value);
    if(res){
      return true;
    }
    else{
      alert("Invalid Phone number");
      numb.value = "";
    }
  }
  function getData(){
    var test;
    $.ajax({
              url: "/cc/CustomerCustom/getPreferenceData",
              type: "post",
              data: "phno=<? echo $phone_num; ?>",
              async:false,
              beforeSend : function(){showLoader();},
              success: function(response) {
                   hideLoader();
                   test = response;
                   if(response!=null || response!= undefined)
                      console.log(response);
                   else
                    console.log("response is null from getPreferenceData")

                  
              },
              error: function(er){
                console.log(er);
                test = er;
              }
  });
    return test;
  }
  try{
  $(document).ready(function(){
    var system_email = "<?php echo $current_email; ?>";
    if(system_email == $("#email").val()){
      console.log("inside if doc");
      localStorage.setItem("CurrentVerified",system_email);
      localStorage.setItem("isVerified","true");
    }
    else{
      console.log("inside else doc");
      localStorage.setItem("isVerified","false");
      localStorage.setItem("CurrentVerified","Changed"); 
    }
    localStorage.setItem("SMS1","false");
    localStorage.setItem("SMS2","false");
    
    $('[data-toggle="tooltip"]').tooltip();  
    $('#verify_email').attr('disabled',true); 
  
    var obj = getData();
    if(obj.statusCode == "SR")
    {
      if(obj.data.preferredmodeforpaymentupdates == "SMS" && obj.data.preferredmodeforpromotional == "SMS"){
            // $('#email').attr("disabled",true);
            $('#verify_email').attr("disabled",true);
      }
      else{
              $('#email').removeAttr("disabled");
              $('#verify_email').removeAttr("disabled");
      }  
    } 
    if(obj.statusCode == "SR")
    {
                    $('#email').val(obj.data.emailid);
                    if(obj.data.emailid.length > 0){
                       $('#verify_email').addClass('verifiedBTN');
                       $('#verify_email').html("Verified");
                       $('#verify_email').attr('disabled','true');
                    }
                    if(system_email == $('#email').val().toLowerCase()){
                       $('#verify_email').addClass('verifiedBTN');
                       $('#verify_email').html("Verified");
                       $('#verify_email').attr('disabled','true');
                    }
                    else{
                          $('#verify_email').removeClass('verifiedBTN');
                    }
                    $('#phone').val(obj.data.alternatemobileno);
                    switch(obj.data.preferredmodeforpaymentupdates){
                      case "SMS": 
                            $('#paysms').prop("checked",true);
                            $('#payemail').removeProp("checked");
                            $('#payboth').removeProp("checked");
                            localStorage.setItem("SMS1","true");
                            break;
                      case "EMAIL":
                            $('#payemail').prop("checked",true);
                            $('#paysms').removeProp("checked");
                            $('#payboth').removeProp("checked");
                            localStorage.setItem("SMS1","false");
                            break;
                      case "BOTH":
                            $('#payboth').prop("checked",true);
                            $('#payemail').removeProp("checked");
                            $('#paysms').removeProp("checked");
                            localStorage.setItem("SMS1","false");
                            break;
                      default:
                            $('#paysms').prop("checked",true);

                    }
                    switch(obj.data.preferredmodeforpromotional){
                      case "SMS": 
                            $('#prosms').prop("checked",true);
                            $('#proemail').removeProp("checked");
                            $('#proboth').removeProp("checked");
                            localStorage.setItem("SMS2","true");
                            break;
                      case "EMAIL":
                            $('#proemail').prop("checked",true);
                            $('#prosms').removeProp("checked");
                            $('#proboth').removeProp("checked");
                            localStorage.setItem("SMS2","false");
                            break;
                      case "BOTH":
                            $('#proboth').prop("checked",true);
                            $('#proemail').removeProp("checked");
                            $('#prosms').removeProp("checked");
                            localStorage.setItem("SMS2","false");
                            break;
                      default:
                            $('#prosms').prop("checked",true);
                    }
                    switch(obj.data.preferredlanguageforcomm){
                      case "EN":
                          $('#languages').val("EN");
                          break;
                      case "TA":
                          $('#languages').val("TA");
                          break;
                      case "HI":
                          $('#languages').val("HI");
                          break;
                      case "MA":
                          $('#languages').val("MA");
                          break;
                      case "KN":
                          $('#languages').val("KN");
                          break;
                      case "ML":
                          $('#languages').val("ML");
                          break;
                      case "TE":
                          $('#languages').val("TE");
                          break;
                      default:
                          $('#languages').val("EN");
                    }
                    switch(obj.data.preferredtiming){
                      case "9AM_12PM":
                                $('#timmings').val("9to12");
                                break;
                      case "12PM_3PM":
                                 $('#timmings').val("12to3");
                                 break;
                      case "3PM_7PM":
                                 $('#timmings').val("3to7");
                                 break;
                      default:
                                 $('#timmings').val("-1");
                                 break;
                    }
    }
    else{
      alert("Could not fetch details: No data found");
       $('#prosms').prop("checked",true);
       $('#paysms').prop("checked",true);
       $('#languages').val("EN");
    }
    $('#email').change(function(){
      if(system_email == $('#email').val().toLowerCase()){
          localStorage.setItem("isVerified","true");
          $("#verify_email").attr("disabled", "disabled");
          $('#verify_email').html("Verified");
          $('#verify_email').addClass('verifiedBTN');
          console.log("-> yes the emails are same");
          
      }
      else{
       
        console.log("-> no email is not same as that in CRM");
        if(localStorage.getItem("CurrentVerified")==$('#email').val().toLowerCase()){
          $("#verify_email").attr("disabled", "disabled");
          $('#verify_email').html("Verified");
          $('#verify_email').addClass('verifiedBTN');
        }
        else{localStorage.setItem("isVerified","false");
          console.log("-> no the email is not same as that verified");
          $('#verify_email').removeClass('verifiedBTN');
          $('#verify_email').html('Verify');
          $('#verify_email').removeAttr("disabled");
        }
      }
    });

    $('input[name="promotional_mode"]').change(function(){
        if($(this).val()=="SMS"){
          localStorage.setItem("SMS2","true");
          console.log('SMS2');
        }
        else{
          localStorage.setItem("SMS2","false");
          console.log('!SMS2');
        }
        if(localStorage.getItem('SMS1')=="true" && localStorage.getItem('SMS2')=="true"){
          if(system_email != $('#email').val().toLowerCase() ){
             $('#email').val(system_email);
              $('#verify_email').addClass('verifiedBTN');
              $('#verify_email').html("Verified");
             // // $('#email').attr("disabled",true);
             $('#verify_email').attr("disabled",true);
             localStorage.setItem("isVerified","true");
          }
          // else{
          //   localStorage.setItem("isVerified","true");
          // }
          
        }
        else{
          $('#email').removeAttr("disabled");
          $('#verify_email').removeAttr("disabled");
          if(localStorage.getItem("isVerified")!="true"){
             if(system_email == $('#email').val().toLowerCase()){
                
              }
              else
              {
                  console.log("else>else2");
                      $('#verify_email').removeClass('verifiedBTN');
                      $('#verify_email').html("Verify");
              } 
          }
        }
    });
  $('input[name="payment_mode"]').change(function(){
      if($(this).val()=="SMS"){
        localStorage.setItem("SMS1","true");
        console.log('SMS1');
      }
      else{
        localStorage.setItem("SMS1","false");
        console.log('!SMS1');
      }
      if(localStorage.getItem('SMS1')=="true" && localStorage.getItem('SMS2')=="true"){
        if(system_email != $('#email').val().toLowerCase()){
           $('#email').val(system_email);
           $('#verify_email').addClass('verifiedBTN');
            $('#verify_email').html("Verified");
           // // $('#email').attr("disabled",true);
           $('#verify_email').attr("disabled",true);
           localStorage.setItem("isVerified","true");
        }
        // else{
        //     localStorage.setItem("isVerified","true");
        //   }
       
      }
      else{
        $('#email').removeAttr("disabled");
        $('#verify_email').removeAttr("disabled");
        if(localStorage.getItem("isVerified")!="true"){
             if(system_email == $('#email').val().toLowerCase()){
                
              }
              else
              {
                  console.log("else>else2");
                      $('#verify_email').removeClass('verifiedBTN');
                      $('#verify_email').html("Verify");
              } 
          }
      }
  });

    
});
}
catch(err){
  console.log(err);
}
</script>
<div class="left-half col-lg-6 col-md-6 col-sm-4 col-xs-12">
    <form action="" method="POST" id="cpcdata">
     <div class="form-group">
      <label for="fname">First Name:</label>
      <input type="text" class="form-control" id="fname" placeholder="John" name="fname" disabled value="<?php echo $fname; ?>" >
    </div>
    <div class="form-group">
      <label for="lname">Last Name:</label>
      <input type="text" class="form-control" id="lname" placeholder="Doe" disabled name="lname" value="<?php echo $lname; ?>" >
    </div> 
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="abc@example.com" name="email">
    </div>
    <button class="btn btn-primary" id="verify_email" style="width: 100%;">Verify</button>
    <div class="form-group">
      <label for="pwd">Phone Number:</label>
      <input type="text" class="form-control" id="realphone" placeholder="10 Digits only"  maxlength="10" readonly name="realphone" value="<?php echo $phone_num; ?>">
    </div>
    
</div>
<div class="right-half col-lg-6 col-md-6 col-sm-4 col-xs-12">
    <div class="form-group">
      <label for="pwd">Alternate Phone Number:</label>
      <input type="text" class="form-control" id="phone" onblur="checkvalidity()"  maxlength="10" placeholder="10 Digits only"  name="phone">
    </div>
    <label>Preferred Mode for Payment Updates</label>
    <br>
    <div>
      <label class="radio-inline black">
        <input type="radio" name="payment_mode" id="paysms" value="SMS">SMS
      </label>
    
      <label class="radio-inline black">
        <input type="radio" name="payment_mode" id="payemail" value="EMAIL">Email
      </label>
      <label class="radio-inline black">
        <input type="radio" name="payment_mode" id="payboth" value="BOTH">Both
      </label>
  </div>
    <label>Preferred mode for Promotional updates</label>
    <br>
    
      <label class="radio-inline black">
        <input type="radio" name="promotional_mode" id="prosms" value="SMS">SMS
      </label>
  
      <label class="radio-inline black">
        <input type="radio" name="promotional_mode" id="proemail" value="EMAIL">Email
      </label>
      <label class="radio-inline black">
        <input type="radio" name="promotional_mode" id="proboth" value="BOTH">Both
      </label>
   
    <div class="dropdown">
      <label for="sel1">Preferred language for communication</label>
      <select class="form-control" name="language" id="languages" data-toggle="tooltip" title="Select a Preferred Language for Communication">
        <option value="EN" selected>English</option>
        <option value="HI">Hindi</option>
        <option value="MA">Marathi</option>
        <option value="TE">Telugu</option>
        <option value="KN">Kannada</option>
        <option value="ML">Malayalam</option>
        <option value="TA">Tamil</option>
      </select><i class="fa fa-caret-down" aria-hidden="true" style="position: absolute;right: 10px;top: 50px;"></i>
      <input type="hidden" name="contact_id" id="contact_id" value="<? echo $contact_id; ?>">
    </div>
      <!-- <div class="form-group">
          <label for="sel2">Preferred Category for Cat 4</label>
          <select class="form-control" name="cat4" id="cat4">
            <option value="opt1" selected>Option 1</option>
            <option value="opt2">Option 2</option>
         </select>
     </div> -->
   <div class="dropdown">
        <label for="sel2">Preferred Timings</label>
        <select class="form-control" name="timming" id="timmings" data-toggle="tooltip" title="Select a Preferred Timing for Communication">
          <option value ="-1" selected>--Select one--</option>
          <option value="9to12">9 AM to 12 PM</option>
          <option value="12to3">12 PM to 3 PM</option>
          <option value="3to7">3 PM to 7 PM</option>
       </select><i class="fa fa-caret-down" aria-hidden="true" style="position: absolute;right: 10px;top: 50px;"></i>
   </div>

</div>
<div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12 putleft" >
  <input type="submit" class="btn btn-primary" style="width: 100% !important; margin-top: 10px;" id="formSubmit" value="Save Changes"></input>
</div>
    </form>
</fieldset>
<script type="text/javascript">
    var init_result;
    var verify_result;
    var resend_result;
    var reVerify_result;
    $('#otp').keypress(function (e) {
		 var key = e.which;
		 if(key == 13)  // the enter key code
		  {
		    $('#verify_button').click();
		    return false;  
		  }
	});
  function init_otp(email,callback_func){
    var init_resp;
    $.ajax({
                  url: "/cc/CustomerCustom/InitiateOTP",
                  type: "post",
                  data: "email="+email,
                  async:false,
                  success: function(response) {
                    // console.log(response);
                   init_resp = response;
                  },
                  error: function(e){
                    init_resp = e;
                  }
            });
    return init_resp;
  }

  function verify_otp(email,seq_no,otp){
    var ver_resp;
    $.ajax({
                  url: "/cc/CustomerCustom/ValidateOTP",
                  type: "post",
                  data: 'otp='+otp+'&seqno='+seq_no+'&email='+email,
                  async:false,
                  success: function(response) {
                    ver_resp = response;
                  },
                  error: function(e){
                    ver_resp = e;
                  }
            });
    return ver_resp;
  }
  function resend_otp(email, seq_no){
    var re_resp;
    $.ajax({
                  url: "/cc/CustomerCustom/ResendOTP",
                  type: "post",
                  data: 'email='+email+'&seqno='+seq_no,
                  async:false,
                  success: function(response) {
                    re_resp = response;
                  },
                  error: function(e){
                    re_resp = e;
                  }
            });
    return re_resp;
  }

  $('#formSubmit').click(function(e){
      e.preventDefault();
          // if ($('#timmings').val() == "-1")
          // {
          //   alert("Please select timings");
          // }
          // else
          // {

            if (($('input[name="payment_mode"]:checked').val() == "EMAIL" && $('input[name="promotional_mode"]:checked').val() == "EMAIL") || ($('input[name="payment_mode"]:checked').val() == "BOTH" && $('input[name="promotional_mode"]:checked').val() == "BOTH") || ($('input[name="payment_mode"]:checked').val() == "EMAIL" && $('input[name="promotional_mode"]:checked').val() == "BOTH") || ($('input[name="payment_mode"]:checked').val() == "BOTH" && $('input[name="promotional_mode"]:checked').val() == "EMAIL") || ($('input[name="payment_mode"]:checked').val() == "EMAIL") || $('input[name="promotional_mode"]:checked').val() == "EMAIL" )
            {
             var testt = checkmail();
             checkVerified();
             if(testt==true)
             {
               if(localStorage.getItem("isVerified")=="true" && (localStorage.getItem("CurrentVerified")==$('#email').val().toLowerCase()||localStorage.getItem("CurrentVerified")=="Changed")){
                 
                  console.log("Sending Email/Both Condition....");
                  $.ajax(
                  {
                    url: "/cc/CustomerCustom/updatePreferenceData",
                    type: "post",
                    data: $('#cpcdata').serialize(),
                    success: function (response)
                    {
                        console.log(response);
                        if (response.TVS_API.statusCode == "SR" && response.MY_API.statusCode == "SR")
                        {
                          alert("Preference Data Saved.");
                          location.reload();
                        }
                        else if(response.TVS_API.statusCode == "SR" && response.MY_API.statusCode != "SR")
                        {
                          alert(response.TVS_API.statusMessage);
                        }
                        else if(response.TVS_API.statusCode != "SR" && response.MY_API.statusCode == "SR"){
                          alert(response.MY_API.statusMessage);
                        }
                        else{
                          alert("Failed to Update Preference Data. Please try again Later!");
                        }

                    },
                    error: function (er)
                    {
                      console.log("Some error");
                    }
                  });
                }
                else
                {
                   alert("Please Validate the Email Address First!");
                }
              }
            }
            else if ($('input[name="payment_mode"]:checked').val() == "SMS" && $('input[name="promotional_mode"]:checked').val() == "SMS")
            {
              if($('#email').val!=""){
                var tesst = checkmail2();
                if(tesst==true){
                  if((localStorage.getItem('SMS1')=="true" && localStorage.getItem('SMS2')=="true")&& $('#email').val()!=""){
                      if(localStorage.getItem("isVerified")=="true"){
                        console.log("Sending SMS Condition....");
                        $.ajax(
                        {
                          url: "/cc/CustomerCustom/updatePreferenceData",
                          type: "post",
                          data: $('#cpcdata').serialize(),
                          success: function (response)
                          {

                                console.log(response);
                                if (response.TVS_API.statusCode == "SR" && response.MY_API.statusCode == "SR")
                                {
                                  alert("Preferences Saved.");
                                  location.reload();
                                }
                                else if(response.TVS_API.statusCode == "SR" && response.MY_API.statusCode != "SR")
                                {
                                  alert(response.TVS_API.statusMessage);
                                }
                                else if(response.TVS_API.statusCode != "SR" && response.MY_API.statusCode == "SR"){
                                  alert(response.MY_API.statusMessage);
                                }
                                else{
                                  alert("Failed to Update Preference Data. Please try again Later!");
                                }

                          },
                          error: function (er)
                          {
                            console.log("Some error");
                          }
                        });
                      }
                      else{
                        alert("You have changed the Email address field. To update it in the system, Please verify the changed Email Address");
                      }
                  }
                  else if((localStorage.getItem('SMS1')=="true" && localStorage.getItem('SMS2')=="true")&& $('#email').val()==""){
                    console.log("Sending SMS Condition....");
                        $.ajax(
                        {
                          url: "/cc/CustomerCustom/updatePreferenceData",
                          type: "post",
                          data: $('#cpcdata').serialize(),
                          success: function (response)
                          {

                                console.log(response);
                                if (response.TVS_API.statusCode == "SR" && response.MY_API.statusCode == "SR")
                                {
                                  alert("Preferences Saved.");
                                  location.reload();
                                }
                                else if(response.TVS_API.statusCode == "SR" && response.MY_API.statusCode != "SR")
                                {
                                  alert(response.TVS_API.statusMessage);
                                }
                                else if(response.TVS_API.statusCode != "SR" && response.MY_API.statusCode == "SR"){
                                  alert(response.MY_API.statusMessage);
                                }
                                else{
                                  alert("Failed to Update Preference Data. Please try again Later!");
                                }

                          },
                          error: function (er)
                          {
                            console.log("Some error");
                          }
                        });
                  }
                  
                }
            }
              
            }
            else{

              console.log("Sending SMS+BOTH Condition....");
               var testtt = checkmail();
              checkVerified();
              if(testtt==true){
                if(localStorage.getItem("isVerified")=="true" && localStorage.getItem("CurrentVerified")==$('#email').val()){
                  $.ajax(
                  {
                    url: "/cc/CustomerCustom/updatePreferenceData",
                    type: "post",
                    data: $('#cpcdata').serialize(),
                    success: function (response)
                    {
                        console.log(response);
                        if (response.TVS_API.statusCode == "SR" && response.MY_API.statusCode == "SR")
                        {
                          alert("Preference Data Saved.");
                          location.reload();
                        }
                        else if(response.TVS_API.statusCode == "SR" && response.MY_API.statusCode != "SR")
                        {
                          alert(response.TVS_API.statusMessage);
                        }
                        else if(response.TVS_API.statusCode != "SR" && response.MY_API.statusCode == "SR"){
                          alert(response.MY_API.statusMessage);
                        }
                        else{
                          alert("Failed to Update Preference Data. Please try again Later!");
                        }

                    },
                    error: function (er)
                    {
                      console.log("Some error");
                    }
                  });
                }
                else
                {
                   alert("Please Validate the Email Address First.....");
                }
              }
            }
          // }     
  });

var got_email;
  $('#verify_email').click(function(e){
          e.preventDefault();
          $('#otp').val("");
          $('#otp2').val("");  
          var is_it_alright = checkmail();
          if(is_it_alright){
          $('#theloader').show();
          document.getElementById('verify_email').value = "Please wait. . . .";
          got_email= $('#email').val();
          console.log("Inside Verify : "+got_email);
          setTimeout(function(){
           init_result = init_otp(got_email);
           },10);
          setTimeout(function(){
          console.log(init_result);
          if(init_result.statusCode == "SR")
          {
                $("#theloader").hide();
                $('#OTPModal').modal('toggle');
          }
          else{
              $("#theloader").hide();
              alert("OTP Initiation Failed.");
          }
          },10);
        }

  }); 

  $('#verify_button').click(function(ea){ 
            ea.preventDefault();
            got_email= $('#email').val();
            $('#otp_error').text("");
            var otp = $('#otp').val();  
                if(otp != '')  
                {
                   $('#theloader').show();
                  setTimeout(function(){  
                  verify_result = verify_otp(got_email,init_result.data.seqno,otp);
                },10);
                  setTimeout(function(){
                  if(verify_result.statusCode == "SR"){
                      alert("Email validation is successful. Thank you.");
                      $('#OTPModal').modal('hide');
                      $('#theloader').hide();
                      $('#verify_email').html('Verified');
                      $('#verify_email').addClass('verifiedBTN');
                      $("#verify_email").prop("disabled","true");
                      $(this).val("Verify");
                      localStorage.setItem("isVerified","true");
                      localStorage.setItem("CurrentVerified",got_email);
                      console.log("inside verify_result block");
                  }
                  else{
                        alert(verify_result.statusMessage);
                        $('#OTPModal').modal('hide');
                        var resend = confirm("Do you want to resend OTP? ");
                        if(resend){
                          setTimeout(function(){
                             resend_result = resend_otp(got_email,init_result.data.seqno);
                           },10);
                                $('#OTPModal2').modal('toggle');
                        }
                        else{
                              alert("Email Validation Failed.");
                        }
                  }
                  },10);
                }
                else{
                  alert("Please enter OTP"); 
                }

      });  
     $('#verify_button2').click(function(es){ 
            $('#theloader').show();
            es.preventDefault();
            got_email= $('#email').val();
            $('#otp_error2').text("");
            var otp2 = $('#otp2').val();
            if(otp2!='') {
              setTimeout(function(){
                 reVerify_result = verify_otp(got_email,init_result.data.seqno,otp2);
               },10);
              setTimeout(function(){
                    if(reVerify_result.statusCode == "SR"){
                        alert("Email validation is successful. Thank you.");
                        $('#theloader').hide();
                        $('#verify_email').html('Verified');
                        $('#verify_email').addClass('verifiedBTN');
                        $("#verify_email").prop("disabled","true");
                        $('#OTPModal2').modal('hide');
                        $(this).val("Re-Verify");
                        $('#otp2').val("");
                        localStorage.setItem("isVerified","true");
                        localStorage.setItem("CurrentVerified",got_email);
                     }
                     else{
                        alert(reVerify_result.statusMessage);
                        $('#OTPModal2').modal('hide');
                        $('#theloader').hide();
                     }
                   },10);
            }
            else{
               alert("Please enter OTP"); 
            }
          });

</script>
