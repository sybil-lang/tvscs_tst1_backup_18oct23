<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="employee_header.php" clickstream="employee-login"/>
<div class="rn_PageContent rn_Home employee-image">
    <div class="rn_Container">
			 <div class="rn_StandardLogin">
	
			<rn:widget path="custom/login/employeeLogin" redirect_url="/app/employee/dashboard" initial_focus="true" disable_password ="false" /><br/>
		<rn:condition logged_in="false">
			<!--<p><a href="/app/#rn:config:CP_ACCOUNT_ASSIST_URL##rn:session#">#rn:msg:FORGOT_YOUR_USERNAME_OR_PASSWORD_MSG#</a></p>-->
		</rn:condition>
			
		</div>
    </div>