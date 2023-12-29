RightNow.namespace('Custom.Widgets.login.LoginOtp');
Custom.Widgets.login.LoginOtp = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		// alert("good");
		
        this._usernameField = this.Y.one(this.baseSelector + "_Mobile");
        this._passwordField = this.Y.one(this.baseSelector + "_Otp");
		this._mobilenumberField = this.Y.one(this.baseSelector + "_Mobile");
        if(this.data.attrs.initial_focus && !this.Y.one('.rn_Dialog'))
        {
            if(this._usernameField && this._usernameField.get("value") === '')
                this._usernameField.focus();
            else if(this._passwordField)
                this._passwordField.focus();
        }

        //this check is necessary because the widget may be used in CPv3.1 and CPv3.2,
        //which doesn�t contain the framework function formTokenRegistration
        if(RightNow.Widgets.formTokenRegistration)
        {
            RightNow.Widgets.formTokenRegistration(this);
        }
		this.Y.one(this.baseSelector + "_Submit").on("click", this._onSubmit, this);
        //commented the below line for OTP Disablement on UAT CP
    	// this.Y.one(this.baseSelector + "_Submit_OTP").on("click", this._onSubmitOTP, this);
    },

    /**
     * Function used to parse out the URL where we should redirect to
     * after a successful login
     * @param result Object The response object returned from the server
     * @return String The URL to redirect to
     */
     _getRedirectUrl: function(result){
         var redirectUrl;
         if(this.data.js && this.data.js.redirectOverride)
             redirectUrl = RightNow.Url.addParameter(this.data.js.redirectOverride, 'session', result.sessionParm.substr(result.sessionParm.lastIndexOf("/") + 1));
         else
             redirectUrl = (this.data.attrs.redirect_url || result.url) + ((result.addSession) ? result.sessionParm : "");

        redirectUrl += this.data.attrs.append_to_url;

        if (result.forceRedirect) {
            redirectUrl = RightNow.Url.addParameter(result.forceRedirect, 'redirect', encodeURIComponent(redirectUrl));
        }

        return redirectUrl;
    },

    /**
     * Event handler for when login has returned. Handles either successful login or failed login
     * @param response {Object} Result from server
     * @param originalEventObject {Object} Original request object sent in request
     */
    _onLoginResponse: function(response, originalEventObject)
    {
        //if(!RightNow.Event.fire("evt_loginFormSubmitResponse", {data: originalEventObject, response: response})){
        //    return;
        //}

      //  this._toggleLoading(false);

        if(response.success)
        {
            this.Y.one(this.baseSelector + "_Content").set("innerHTML", response.message);
            var redirectUrl = this._getRedirectUrl(response);
            if(this.Y.UA.ie && this.Y.UA.ie < 9 && RightNow.Text.beginsWith(redirectUrl, '/ci/fattach/get/'))
                this.Y.one(this.baseSelector).set('innerHTML', RightNow.Text.sprintf(RightNow.Interface.getMessage("PLS_CLCK_HREF_EQS_PCT_S_THAN_S_MSG"), redirectUrl));
            else
                RightNow.Url.navigate(redirectUrl);
        }
        else
        {
            this._addErrorMessage(response.message, this.baseDomID + '_Mobile', response.showLink);
        }
    },

    /**
     * Event handler for when login button is clicked.
     * @param {Object} e YUI Event facade
     */
    _onSubmit: function(e)
    {
        e.halt();

        var username = (this._usernameField) ? this.Y.Lang.trim(this._usernameField.get("value")) : "",
            errorMessage, eventObject;
		// alert("Hello");
		
        if(username.indexOf(' ') > -1)
            errorMessage = RightNow.Text.sprintf(RightNow.Interface.getMessage("PCT_S_MUST_NOT_CONTAIN_SPACES_MSG"), RightNow.Interface.getMessage("USERNAME_LBL"));
        else if(username.indexOf('"') > -1)
            errorMessage = RightNow.Text.sprintf(RightNow.Interface.getMessage("PCT_S_CONTAIN_DOUBLE_QUOTES_MSG"), RightNow.Interface.getMessage("USERNAME_LBL"));
        else if(username.indexOf("<") > -1 || username.indexOf(">") > -1)
            errorMessage = RightNow.Text.sprintf(RightNow.Interface.getMessage("PCT_S_CNT_THAN_MSG"), RightNow.Interface.getMessage("USERNAME_LBL"));

        if(errorMessage)
        {
            this._addErrorMessage(errorMessage, this.baseDomID + '_Username');
            return false;
        }

        eventObject = new RightNow.Event.EventObject(this, {data: {
           login: username,
         //  password: ((!this.data.attrs.disable_password && this._passwordField) ? this._passwordField.get("value") : ""),
		   password: this._passwordField.get("value"),
           url: window.location.pathname,
           w_id: this.data.info.w_id,
           f_tok: this.data.js.f_tok,
           div_name_submit:submit_div_id
        }});
        if(RightNow.Event.fire("evt_loginFormSubmitRequest", eventObject)){
            //fthis._toggleLoading(true);

            if(RightNow.Event.noSessionCookies()) {
                //Attempt to set a test login cookie
                RightNow.Event.setTestLoginCookie();
            }
			//console.log(eventObject.data);
			//alert(this.data.attrs.login_ajax);
            RightNow.Ajax.makeRequest(this.data.attrs.login_ajax, eventObject.data, {successHandler: this._onLoginResponse, scope: this, data: eventObject, json: true});

            if(this.Y.UA.ie && window.external && "AutoCompleteSaveForm" in window.external)
            {
                //since this form is submitted by script, force ie to do auto_complete
                var form = document.getElementById(this.baseDomID + "_Form");
                if(form)
                    window.external.AutoCompleteSaveForm(form);
            }
        }
    },

    /**
     * Utility function to display an error message
     * @param message String  The error message to display
     * @param focusElement String The ID of the element to focus when clicking on the error message
     * @param showLink [optional] Boolean Denotes if error message should be surrounded in a link tag
     */
    _addErrorMessage: function(message, focusElement, showLink){
        var error = this.Y.one(this.baseSelector + "_ErrorMessage");
        if(error)
        {
            error.addClass('rn_MessageBox rn_ErrorMessage');
            //add link to message so that it can receive focus for accessibility reasons
            if(showLink === false)
            {
                error.set("innerHTML", message);
            }
            else
            {
                error.set("innerHTML", '<a href="javascript:void(0);" onclick="document.getElementById(\'' + focusElement + '\').focus(); return false;">' + message + '</a>');
                error.one('a').focus();
            }
        }
    },

    /**
     * Toggles the state of loading indicators:
     * Fades the form out/in (for decent browsers)
     * Disables/enables form inputs
     * Adds/Removes loading indicator class
     * @param {Boolean} turnOn Whether to add or remove the loading indicators.
     */
    /*_toggleLoading: function(turnOn) {
        this._widgetContent || (this._widgetContent = this.Y.one(this.baseSelector + '_Content'));

        this._widgetContent.all('input')[(turnOn) ? 'setAttribute' : 'removeAttribute']('disabled', true);

        if (!this.Y.UA.ie || this.Y.UA.ie > 8) {
            // YUI's animation causes JS execution in IE7-8 to fail in weird ways, like failing to redirect the page
            // when a user's successfully logged in...
            this._widgetContent.transition({
                opacity: turnOn ? 0 : 1,
                duration: 0.4
            });
            this.Y.one(this.baseSelector)[(turnOn) ? 'addClass' : 'removeClass']('rn_Loading');
        }
    },*/

/**
     * Event handler for when Send Otp button is clicked.
     * @param {Object} e YUI Event facade
     */
    _onSubmitOTP: function(e)
    {
        // alert("testing !!")
        e.halt();

        var mobilenumber = (this._mobilenumberField) ? this.Y.Lang.trim(this._mobilenumberField.get("value")) : "",
            errorMessage, eventObject;
        // alert(mobilenumber);

		// console.log("1");
        if(mobilenumber.indexOf(' ') > -1)
            errorMessage = RightNow.Text.sprintf(RightNow.Interface.getMessage("PCT_S_MUST_NOT_CONTAIN_SPACES_MSG"), RightNow.Interface.getMessage("USERNAME_LBL"));
        else if(mobilenumber.indexOf('"') > -1)
            errorMessage = RightNow.Text.sprintf(RightNow.Interface.getMessage("PCT_S_CONTAIN_DOUBLE_QUOTES_MSG"), RightNow.Interface.getMessage("USERNAME_LBL"));
        else if(mobilenumber.indexOf("<") > -1 || mobilenumber.indexOf(">") > -1)
            errorMessage = RightNow.Text.sprintf(RightNow.Interface.getMessage("PCT_S_CNT_THAN_MSG"), RightNow.Interface.getMessage("USERNAME_LBL"));
        //  console.log("2");
        // console.log("errormessage",errorMessage);
        console.log(errorMessage);  
        if(errorMessage)
        {
            // alert("testing");
            console.log("3");
            this._addOtpErrorMessage(errorMessage, this.baseDomID + '_MobileN');
            return false;
        }
        // console.log("4");
        eventObject = new RightNow.Event.EventObject(this, {data: {
           login: mobilenumber,
           url: window.location.pathname,
           w_id: this.data.info.w_id,
           f_tok: this.data.js.f_tok
        }});
        console.log("eventObject",eventObject);
        if(RightNow.Event.fire("evt_otpFormSubmitRequest", eventObject)){
          //  this._toggleLoading(true);

            // console.log("5");
            RightNow.Ajax.makeRequest(this.data.attrs.sendotp_ajax, eventObject.data, {timeout: 200000, successHandler: this._onOtpResponse, scope: this, data: eventObject, json: true});
            console.log("!@#",this.data.attrs.sendotp_ajax);
            console.log("%^&",eventObject.data);

            // console.log("6");
            if(this.Y.UA.ie && window.external && "AutoCompleteSaveForm" in window.external)
            {
                //since this form is submitted by script, force ie to do auto_complete
                var form = document.getElementById(this.baseDomID + "_Form_otp");
                // console.log("form",form);
                if(form)
                    window.external.AutoCompleteSaveForm(form);
            }
        }
    },
	
	/**
     * Event handler for when login has returned. Handles either successful login or failed login
     * @param response {Object} Result from server
     * @param originalEventObject {Object} Original request object sent in request
     */
    _onOtpResponse: function(response, originalEventObject)
    {
        if(!RightNow.Event.fire("evt_otpFormSubmitResponse", {data: originalEventObject, response: response})){
            return;
        }

      //  this._toggleLoading(false);

      console.log(response);
        if(response.success)
        {
           
			// alert(response.success);
            //this.Y.one(this.baseSelector + "_Content").set("innerHTML", response.message);
			this._addOtpErrorMessage(response.message, this.baseDomID + '_MobileNumber', false);
           /* var redirectUrl = this._getRedirectUrl(response);
            if(this.Y.UA.ie && this.Y.UA.ie < 9 && RightNow.Text.beginsWith(redirectUrl, '/ci/fattach/get/'))
                this.Y.one(this.baseSelector).set('innerHTML', RightNow.Text.sprintf(RightNow.Interface.getMessage("PLS_CLCK_HREF_EQS_PCT_S_THAN_S_MSG"), redirectUrl));
            else
                RightNow.Url.navigate(redirectUrl);*/
        }
        else
        {
            // console.log("testing");
           
            this._addOtpErrorMessage(response.message, this.baseDomID + '_MobileN', response.showLink);
        }
        $("#loader_home").addClass("hidden");
    },

	 /**
     * Utility function to display an error message
     * @param message String  The error message to display
     * @param focusElement String The ID of the element to focus when clicking on the error message
     * @param showLink [optional] Boolean Denotes if error message should be surrounded in a link tag
     */
    _addOtpErrorMessage: function(message, focusElement, showLink){
        var error = this.Y.one(this.baseSelector + "_ErrorMessage_OTP");
        if(error)
        {
            // console.log(" _addOtpErrorMessage");
            error.addClass('rn_MessageBox rn_ErrorMessage');
            //add link to message so that it can receive focus for accessibility reasons
            if(showLink === false)
            {
                error.set("innerHTML", message);
            }
            else
            {
                error.set("innerHTML", '<a href="javascript:void(0);" onclick="document.getElementById(\'' + focusElement + '\').focus(); return false;">' + message + '</a>');
                error.one('a').focus();
            }
        }
    }


});