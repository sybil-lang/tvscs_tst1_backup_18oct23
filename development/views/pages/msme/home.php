
<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standardMSME.php" clickstream="home"/>
<?php
    $msg = \RightNow\Connect\v1_3\MessageBase::fetch( CUSTOM_MSG_TVS_API_URL );
    $url = $msg->Value;
    
?>
<!-- <script type="text/javascript">var Login_type_div;</script> -->

<div class="rn_PageContent rn_Home home-image">
    <div class="rn_Container">
        <script type="text/javascript">
            var div_id="";
            var submit_div_id="";
            $(document).ready(function(){
                $(".verifyotp").click(function(){
                        console.log('this',this.id);
                        div_id=this.id;

                });

                $(".submit").click(function(){

                    console.log('this',this.id);
                    submit_div_id=this.id;

                });
            });
        </script>
         
                        <rn:condition logged_in="true">
                            <div class="col-sm-12 col-md-12 col-xs-12" id="newd">
                                <div class="customer_loginimg">
                                    <figure>
                                        <div class="image-blurred-edge">
                                            <!-- <img src="/euf/assets/themes/standard/Images-new/Customer_Login.png" class="responsive" alt="customer_loginimg">-->
                                        </div>
                                    </figure>
                                </div>  
                            </div>
                        </rn:condition>
                    
                <div class="row msme-row">
                    <div class="row">
                       <div class="col">
                           <div class="row" style="margin-bottom: 15px;">
                               <label>
                                   <input type="radio" name="loginMethod" id="MobileNumberOTP" value="1" checked="true" /> Mobile Number OTP
                               </label>
                               <label>
                                   <input type="radio" name="loginMethod" id="EmailOTP" value="2" /> Email OTP
                               </label>
                               <label>
                                   <input type="radio" name="loginMethod" id="UsernamePassword" value="3" /> Username / Password
                               </label>
                            </div>
                            <div class="row" id="mobotp_block" >
                                <rn:condition logged_in="false">
                                    <!--<p><a href="/app/#rn:config:CP_ACCOUNT_ASSIST_URL##rn:session#">#rn:msg:FORGOT_YOUR_USERNAME_OR_PASSWORD_MSG#</a></p>-->
                                    <div class="col-sm-12 col-md-5 col-xs-12" id="newi">
                                        <div class="rn_StandardLogin">
                                            <rn:widget path="custom/login/LoginOtp/" redirect_url="/app/msme/customer/dashboard"  disable_password ="true" initial_focus="true"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7 col-xs-12" id="newd">
                                        <div class="customer_loginimg">
                                            <figure>
                                                <div class="image-blurred-edge">
                                                    <!-- <img src="/euf/assets/themes/standard/Images-new/Customer_Login.png" class="responsive" alt="customer_loginimg">-->
                                                </div>
                                            </figure>
                                        </div>
                                        
                                    </div>
                                </rn:condition>
                                
                            </div>
                            <div class="row" id="emailotp_block" style="display: none;">
                                <rn:condition logged_in="false">
                                    <!--<p><a href="/app/#rn:config:CP_ACCOUNT_ASSIST_URL##rn:session#">#rn:msg:FORGOT_YOUR_USERNAME_OR_PASSWORD_MSG#</a></p>-->
                                    <div class="col-sm-12 col-md-5 col-xs-12" id="newi">
                                        <div class="rn_StandardLogin">
                                            <rn:widget path="custom/login/EmailOtp/" redirect_url="/app/msme/customer/dashboard"  disable_password ="true" initial_focus="true"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7 col-xs-12" id="newd">
                                        <div class="customer_loginimg">
                                            <figure>
                                                <div class="image-blurred-edge">
                                                    <!-- <img src="/euf/assets/themes/standard/Images-new/Customer_Login.png" class="responsive" alt="customer_loginimg">-->
                                                </div>
                                            </figure>
                                        </div>
                                        
                                    </div>
                                </rn:condition>
                            </div>
                            <div class="row" id="unp_block" style="display: none;">
                               <rn:widget path="custom/login/msmeLogin" redirect_url="/app/msme/customer/dashboard" initial_focus="true" disable_password ="false" /><br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

    <!-- #header -->
    
    <style type="text/css">
        .form-group .verifyotp {
        left: 272px;
        bottom: 35px;
        }
        .msme-row{
            display: none;
        }
        .row.option-row {
            display: inline;
        }
        button.btn.btn-primary.option-row-btn {
            width: 40%;
            margin: 5px;
        }
        #msme-option, #retail-option{
            text-decoration: none !important;
        }
        .option-active{
            background-color: #0e8943 !important;
        }
        .option-active > a{
            color: #ffffff !important;
        }
        .option-btns{
            color: #155799 !important;
            border: 2px solid #155799 !important;
            padding: 4px 10px;
            
        }
        .option-btns:hover{
            background-color: #155799 !important;
            border-color: #155799 !important;
            color: #ffffff !important;
        }
        .option-btns > a:hover{
            color: #ffffff !important;
        }
        .page-header {
            padding-bottom: 30px !important;
            margin:15px 0px 20px !important;
        }
        @media only screen and (min-width: 360px) {
            .page-header > h1{
                font-size: 15px !important;
            }
            .verifyotp{
                color:#337ab7 !important;
                display: table !important;
            }
        }
        #rn_EmailOtp_8_Submit_OTP{
            bottom:42px !important;
        }
        .verifyotp{
            color:#337ab7 !important;
            display: table !important;
        }
    </style>
    <script type="text/javascript">
        function toggleRow(el){
            var element_value = el.id;
            console.log(element_value);
            var ele = document.getElementsByClassName("retail-row");
            var ele2 = document.getElementsByClassName("msme-row");
            if(element_value == "retail-option"){ 
                  ele[0].style.display = "block";
                  ele2[0].style.display = "none";
                  document.getElementById("retailh1").classList.add("option-active");
                  document.getElementById("msmeh1").classList.remove("option-active");
                  // Login_type_div="MSME";
                 // <?php $Login_type_div="MSME";?>


            }
            else{
                ele2[0].style.display = "block";
                ele[0].style.display = "none";
                document.getElementById("msmeh1").classList.add("option-active");
                document.getElementById("retailh1").classList.remove("option-active");
                 

                
            }
        }
        $("input[type=radio][name=loginMethod]").change(function(){
            if (this.value == '1') {
                // alert("1 checked");
                document.getElementById("mobotp_block").style.display = 'block';
                document.getElementById("emailotp_block").style.display = 'none';
                document.getElementById("unp_block").style.display = 'none';

            }
            else if (this.value == '2') {
                // alert("2 checked");
                document.getElementById("emailotp_block").style.display = 'block';
                document.getElementById("mobotp_block").style.display = 'none';
                document.getElementById("unp_block").style.display = 'none';
            }
            else{
                document.getElementById("unp_block").style.display = 'block';
                document.getElementById("mobotp_block").style.display = 'none';
                document.getElementById("emailotp_block").style.display = 'none';
                // alert("3 checked");
            }
        });
    </script>
</div>