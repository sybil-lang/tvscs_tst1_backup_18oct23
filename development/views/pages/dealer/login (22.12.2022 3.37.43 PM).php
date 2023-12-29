<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="dealer_header.php" clickstream="dealer-login"/>

<div class="rn_PageContent rn_Home">
    <div class="rn_Container">
			 <div class="rn_StandardLogin">
					<div class="container">

<div class="row">
<div class="col-sm-12 col-md-5 col-xs-12">
<div class="pull-left">
    
			<rn:widget path="custom/login/dealerLogin" redirect_url="/app/dealer/dashboard" initial_focus="true" disable_password ="false" /><br/>
		<rn:condition logged_in="false">
			<!--<p><a href="/app/#rn:config:CP_ACCOUNT_ASSIST_URL##rn:session#">#rn:msg:FORGOT_YOUR_USERNAME_OR_PASSWORD_MSG#</a></p>-->
		</rn:condition>
    </div>
    </div>
				<div class="col-sm-12 col-md-7 col-xs-12">
<div class="customer_loginimg dealerlogin_img">
<figure><div class="image-blurred-edge1">   
</div>
<!--<img src="/euf/assets/themes/standard/Images-new/Dealer_Login.jpg" class="responsive" alt="customer_loginimg">-->
</figure>
</div>
</div>
		</div>
    </div>
        </div>
    </div>
</div>

