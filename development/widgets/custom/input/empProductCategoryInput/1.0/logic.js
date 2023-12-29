RightNow.namespace('Custom.Widgets.input.empProductCategoryInput');
Custom.Widgets.input.empProductCategoryInput = RightNow.Widgets.ProductCategoryInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ProductCategoryInput#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
        },
		
	 /**
     * Selected a node by clicking on its label
     * (as opposed to expanding it via the expand image).
     * Overrides and calls into RightNow.ProductCategory.selectNode.
     * @param {object} node The node
     */
    selectNode: function(node) {
        this._selected = true;
        //get next level if the node hasn't loaded children yet, isn't expanded, and isn't the 'No Value' node
        //or if product linking is on and this is the product (regardless of level)
        if ((!node.expanded && node.value && !node.loaded) ||
           (this.data.js.linkingOn && this.data.js.data_type === "Product")) {
            this.getSubLevelRequest(node);
        }
        else {
            this._errorLocation = "";
            this._checkSelectionErrors();
        }

        RightNow.ProductCategory.prototype.selectNode.call(this, node);
    },

		/**
     * Makes the request to the server to fetch the children for a
     * given node.
     * Overrides and calls into RightNow.ProductCategory.getSubLevelRequest.
     * @param {object} expandingNode The node
     */
    getSubLevelRequest: function (expandingNode) {
        //RightNow.ProductCategory.prototype.getSubLevelRequest.call(this, expandingNode);
		// Only allow one node at-a-time to be expanded.
        if (this._nodeBeingExpanded) return;

        this._nodeBeingExpanded = true;

        var eo = this.getSubLevelRequestEventObject(expandingNode);

        if (eo) {
            if (this.dataType === "Product") {
                //Set namespace global for hier menu list linking display
                RightNow.UI.Form.currentProduct = eo.data.value;
            }

            this._requesting = eo.data.value;

            //RightNow.Event.fire("evt_menuFilterRequest", eo);
			this.callMenuFilterRequest("evt_menuFilterRequest", eo);
        }

        this._nodeBeingExpanded = false;
        // Remove link_map from this._eo so this widget does not misinform the Event Bus
        // or other widgets about the link_map on subsequent requests.
        if (this._eo.data.link_map)
            delete this._eo.data.link_map;
    },
		
        /**
         * Overridable methods from ProductCategoryInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _initializeHint: function()
        // buildPanel: function ()
        // _resetProductCategoryMenu: function()
        // _updatePermissionedHierData: function (dataType)
        // displaySelectedNodesAndClose: function(focus, fireSelectionEvent)
        // selectNode: function(node)
        // getSubLevelRequest: function (expandingNode)
        // getSubLevelRequestEventObject: function(expandingNode)
        // getSubLevelResponse: function(type, args)
        // _setButtonClick: function()
        // _onValidate: function(type, args)
        // _createHintElement: function(visibility)
        // _toggleHint: function(hideOrShow)
        // _realignHint: function(delay)
        // swapLabel: function(container, requiredLevel, label, template)
        // updateRequiredLevel: function(evt, constraint)
        // _checkSelectionErrors: function()
        // _removeErrorMessages: function()
        // _displayErrorMessage: function(message, currentNode)
    },

    /**
             * event handler
             * @param {string} type the event object type
             * @param {Object} eventObject
             * @private
             */
            callMenuFilterRequest: function (type, eventObject)
            {
				//console.log(eventObject);
                //eventObject = eventObject[0];
                var eo;
				//console.log(eventObject);
                if(eventObject.data.link_map)
                    _productLinkingMap = eventObject.data.link_map;

                //Currently only doing cache checking on non-linked menu filters
                if(!eventObject.data.linking_on)
                {
                    if(eventObject.data.level > 5)
                        return;

                    if(eventObject.data.value < 1)
                    {
                        eventObject.data.level = 1;
                        eventObject.data.hier_data = [];
                        RightNow.Event.fire("evt_menuFilterGetResponse", eventObject);
                        return;
                    }
                    if(eventObject.data.cache[eventObject.data.value])
                    {
                        //create new evt obj so that request evt obj isn't modified
                        eo = new this.EventObject();
                        eo.data = {"hier_data" : eventObject.data.cache[eventObject.data.value], "level" : eventObject.data.level + 1};
                        eo.w_id = eventObject.w_id;
                        RightNow.Event.fire("evt_menuFilterGetResponse", eo);
                        return;
                    }
                }
                else if((eventObject.data.data_type.toLowerCase().indexOf("cat") > -1) && _productLinkingMap && _productLinkingMap[eventObject.data.value])
                {
                    eo = RightNow.Lang.cloneObject(eventObject);
                    if(!eo.data.reset)
                        eo.data.level++;
                    eo.data.hier_data = RightNow.Lang.cloneObject(_productLinkingMap[eo.data.value]);
                    eo.data.via_filter_request = true;
                    RightNow.Event.fire("evt_menuFilterGetResponse", eo);
                    return;
                }

                RightNow.Ajax.makeRequest("/cc/AjaxCustomRequest/getHierValues", {
                    linking: eventObject.data.linking_on,
                    filter: eventObject.data.data_type,
                    id: eventObject.data.value
                }, {
                    successHandler: this.callMenuFilterGetSuccess,
                    data: eventObject,
                    type:"GETPOST",
                    scope: this,
                    json: true
                });
            },

			/**
             * Function handler for successful hier menu ajax request
             * @private
             * @param {Object} results object from the server
             * @param {Object} eventObject Original request's EventObject
             */
            callMenuFilterGetSuccess:function (results, eventObject)
            {
                results = results.result;
                if (!results) return;
                //results[0] - Actual filter results
                //results[link_map] - Linking results if neccesary
                eventObject.data.cache[eventObject.data.value] = results[0];
                eventObject.data.hier_data = results[0];
                eventObject.data.level++;
                eventObject.data.via_hier_request = true;
                RightNow.Event.fire("evt_menuFilterGetResponse", eventObject);

                //If linking is on, populate link_map and fire event to category hier menus
                if (eventObject.data.linking_on && eventObject.data.data_type.toLowerCase().indexOf("prod") > -1)
                {
                    _productLinkingMap = results.link_map;
                    RightNow.Event.fire("evt_menuFilterGetResponse", new this.EventObject(null, {data: {
                        level: 1,
                        hier_data: _productLinkingMap[0],
                        data_type: eventObject.data.data_type.replace("Product", "Category"),
                        reset_linked_category: true,
                        via_linking: true
                    }, filters: {
                        report_id: eventObject.filters.report_id
                    }}));
                    //If product changed to none selected, clear out link map
                    if (!eventObject.data.value || eventObject.data.value === -1)
                        _productLinkingMap = null;
                }
            }
});