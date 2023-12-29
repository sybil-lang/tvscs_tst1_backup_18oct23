<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="dealer_header.php" clickstream="dealer-login" />
<style>
	.customer_loginimg {
		background-image: url(/euf/assets/themes/standard/Images-new/Dealer_login_new.jpg);
		background-size: cover;
		/* Adjust the image size to cover the entire div */
		background-position: center;
		/* Center the background image within the div */
		width: 100%;
		/* Assuming you want the div to take the full width of its parent */
		height: 415px;
		/* Set the desired height for the div */
	}


</style>

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

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>