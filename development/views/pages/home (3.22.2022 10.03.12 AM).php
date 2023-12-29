
<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php" clickstream="home"/>
<?php
    // print_r($_SESSION);
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
                        <rn:condition logged_in="false">
        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row option-row">
                    <!-- <button class="btn btn-alert option-row-btn" value="retail" >Retail Login</button>
                    <button class="btn btn-alert option-row-btn" value="msme" onclick="toggleRow(this)">MSME Login</button> -->
                   <rn:condition config_check="Custom:CUSTOM_CFG_MSME_SHOW==true"> 
                    <div class="page-header">
                      <h1 style="display: inline;" class="option-btns option-active" id="retailh1"><a href="" id="retail-option">Retail Loan Customer</a></h1> <h1  style="display: inline; margin-left: 15px;"> | </h1> <h1 id="msmeh1" class="option-btns" style="display:inline; margin-left: 15px;"><a href="" id="msme-option" >Business Loan Customer</a></h1>
                    </div>
                <rn:condition_else>
                    <div class="page-header">
                      <h1 style="display: inline;" class="option-btns option-active" id="retailh1"><a href="" id="retail-option">Retail Loan Customer</a></h1>
                    </div>
                </rn:condition>
                </div>
                <div class="row retail-row">
                    <div class="row">
                            <!--<p><a href="/app/#rn:config:CP_ACCOUNT_ASSIST_URL##rn:session#">#rn:msg:FORGOT_YOUR_USERNAME_OR_PASSWORD_MSG#</a></p>-->
                            <div class="col-sm-12 col-md-5 col-xs-12" id="newi">
                                <div class="rn_StandardLogin">
                                    <rn:widget path="custom/login/LoginOtp/" redirect_url="/app/customer/dashboard"  disable_password ="true" initial_focus="true"/>
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
                                <div class="dealer-calculator">
                                    <div class="row">
                                        <div class="inline-display col-md-5">
                                            <div class="deals">
                                                <div class="dealer-text">
                                                    <div class="card-block">
                                                        <p class="para">Find your <span>nearest dealer.</span></p>
                                                        <a href="https://www.tvscredit.com/dealer-locator/" class="">Know More </a>
                                                    </div>
                                                </div>
                                                <div class="dealer-img">
                                                    <figure>
                                                        <img src="/euf/assets/themes/standard/Images-new/find_nearest_dealer_icon.png" class="responsive" alt="customer_loginimg">
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline-display col-md-2">
                                        </div>
                                        <div class="inline-display col-md-5">
                                            <div class="deals">
                                                <div class="dealer-text">
                                                    <div class="card-block">
                                                        <p class="para">EMI <span>Calculator.</span></p>
                                                        <a href="https://www.tvscredit.com/knowledge-centre#emi-calculator" class="">Know More </a>
                                                    </div>
                                                </div>
                                                <div class="dealer-img">
                                                    <figure>
                                                        <img src="/euf/assets/themes/standard/Images-new/EMI -calculator icon.png" class="responsive" alt="customer_loginimg">
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </rn:condition>
                        <rn:condition logged_in="true">
                        <?php
                            // $CI=&get_instance();
                            // $contact_id=$CI->session->getProfileData("c_id");
                            // $contact_type=$CI->session->getSessionData("userProfile");

                            // var_dump($CI->session);
                            // exit();

                            // if($contact_type != "customer"){
                            //    header('location:/app/customer/error/error_id/6');
                            //    exit;
                            // }
                            // if($contact_type == "customer" && $cont)
                        ?>
                            <div class="col-sm-12 col-md-12 col-xs-12" id="newd">
                                <div class="customer_loginimg">
                                    <figure>
                                        <div class="image-blurred-edge">
                                            <!-- <img src="/euf/assets/themes/standard/Images-new/Customer_Login.png" class="responsive" alt="customer_loginimg">-->
                                        </div>
                                    </figure>
                                </div>
                                <div class="dealer-calculator">
                                    <div class="row">
                                        <div class="inline-display col-md-5">
                                            <div class="deals">
                                                <div class="dealer-text">
                                                    <div class="card-block">
                                                        <p class="para">Find your <span>nearest dealer.</span></p>
                                                        <a href=" https://www.tvscredit.com/dealer-locator/" class="">Know More </a>
                                                    </div>
                                                </div>
                                                <div class="dealer-img">
                                                    <figure>
                                                        <img src="/euf/assets/themes/standard/Images-new/find_nearest_dealer_icon.png" class="responsive" alt="customer_loginimg">
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline-display col-md-2">
                                        </div>
                                        <div class="inline-display col-md-5">
                                            <div class="deals">
                                                <div class="dealer-text">
                                                    <div class="card-block">
                                                        <p class="para">EMI <span>Calculator.</span></p>
                                                        <a href="https://www.tvscredit.com/knowledge-centre#emi-calculator" class="">Know More </a>
                                                    </div>
                                                </div>
                                                <div class="dealer-img">
                                                    <figure>
                                                        <img src="/euf/assets/themes/standard/Images-new/EMI -calculator icon.png" class="responsive" alt="customer_loginimg">
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </rn:condition>
                    </div>
                </div>
                <rn:condition config_check="Custom:CUSTOM_CFG_MSME_SHOW==true">   
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
                            </div>
                            <div class="row" id="unp_block" style="display: none;">
                               <rn:widget path="custom/login/msmeLogin" redirect_url="/app/msme/customer/dashboard" initial_focus="true" disable_password ="false" /><br/>
                            </div>
                        </div>
                    </div>
                </div>
            </rn:condition>
            </div>
        </div>
    </div>
    <!-- #header -->
    <!--</div>
        </div>
        </div>-->
    <!--<div class="rn_PopularKB">
        <div class="rn_Container">
            <h2>#rn:msg:POPULAR_PUBLISHED_ANSWERS_LBL#</h2>
            <rn:widget path="reports/TopAnswers" show_excerpt="true" limit="5"/>
            <a class="rn_AnswersLink" href="/app/answers/list#rn:session#">#rn:msg:SHOW_MORE_PUBLISHED_ANSWERS_LBL#</a>
        </div>
        </div>
        
        <div class="rn_PopulsarSocial">
        <div class="rn_Container">
            <h2>#rn:msg:RECENT_COMMUNITY_DISCUSSIONS_LBL#</h2>
            <rn:widget path="discussion/RecentlyAnsweredQuestions" show_excerpt="true" maximum_questions="5"/>
            <a class="rn_DiscussionsLink" href="/app/social/questions/list/kw/*#rn:session#">#rn:msg:SHOW_MORE_COMMUNITY_DISCUSSIONS_LBL#</a>
        </div>
        </div>
        <div class="row pos_home col-md-10">
        <div class="rn_Container">
             
        <div class="col-md-4"><a href="<?php echo $site_url;?>/app/newlead"><img class="pull-right" src="/euf/assets/themes/standard/images/loan-approval.jpg"></a></div>-->
    <!--<div class="col-md-6"><a href="<?php echo $site_url;?>/app/dealerlocator"><img src="/euf/assets/themes/standard/images/find_dealers-banner.jpg" ></a></div>
        <div class="col-md-4"></div>-->
    <!--    <div class="col-md-6"><a href="<?php echo $site_url;?>/app/emicalculator"><img src="/euf/assets/themes/standard/images/emi-calc.jpg" ></a></div>
        </div>
        </div>-->
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
        .hidden
        {
            display: none;
        }
        .loader_home
        {
                position: fixed;
                top: 50%;
        }
    </style>
    <div class="loader_home col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader_home">
           <center>
              <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
            </center>
        </div>
    <script type="text/javascript">
        $('.option-btns > a').click(
 
        function toggleRow(el){
            // console.log(el);
            el.preventDefault();
            var element_value = el.target.id;
            console.log(element_value);
            var ele = document.getElementsByClassName("retail-row");
            var ele2 = document.getElementsByClassName("msme-row");
            if(element_value == "retail-option"){ 
                  ele[0].style.display = "block";
                  ele2[0].style.display = "none";
                  document.getElementById("retailh1").classList.add("option-active");
                  document.getElementById("msmeh1").classList.remove("option-active");
                 
            }
            else{
                ele2[0].style.display = "block";
                ele[0].style.display = "none";
                document.getElementById("msmeh1").classList.add("option-active");
                document.getElementById("retailh1").classList.remove("option-active");
                 

                
            }
        });

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


        $(document).ready(function()
        {
           $('.verifyotp').click(function()
           {
               $("#loader_home").removeClass("hidden");                   
           })

         });


    </script>
</div>