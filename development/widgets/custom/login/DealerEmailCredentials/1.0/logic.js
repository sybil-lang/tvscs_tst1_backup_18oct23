RightNow.namespace('Custom.Widgets.login.DealerEmailCredentials');
Custom.Widgets.login.DealerEmailCredentials = RightNow.Widgets.EmailCredentials.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.EmailCredentials#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
        }

        /**
         * Overridable methods from EmailCredentials:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onResponseReceived: function(response, originalEventObject)
        // _onSubmit: function(event, arg)
        // _displayErrorMessage: function(errorMessage)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});