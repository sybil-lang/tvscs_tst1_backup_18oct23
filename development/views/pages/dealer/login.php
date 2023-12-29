<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="dealer_header.php" clickstream="dealer-login" />

<div class="rn_PageContent rn_Home">
	<div class="rn_Container">
		<div class="rn_StandardLogin">
			<div class="container">

				<div class="row">
					<div class="col-sm-12 col-md-5 col-xs-12">
						<div class="pull-left">

							<rn:widget path="custom/login/dealerLogin" redirect_url="/app/dealer/dashboard" initial_focus="true" disable_password="false" /><br />
							<rn:condition logged_in="false">
								<!--<p><a href="/app/#rn:config:CP_ACCOUNT_ASSIST_URL##rn:session#">#rn:msg:FORGOT_YOUR_USERNAME_OR_PASSWORD_MSG#</a></p>-->
							</rn:condition>
						</div>
					</div>
					<div class="col-sm-12 col-md-7 col-xs-12">
						<div class="customer_loginimg dealerlogin_img">
						<a href="https://tvscs--tst1.custhelp.com/app/dealer/login" target="_blank">
							<img src="/euf/assets/themes/standard/Images-new/dealer_login_withQR.jpg" alt="click here to download">
							</a>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>