<rn:meta title="#rn:php:\RightNow\Libraries\SEO::getDynamicTitle('incident', \RightNow\Utils\Url::getParameter('i_id'))#" template="standardMSME.php" login_required="true" clickstream="incident_view" force_https="true"/>

<div class="rn_Hero">
    <div class="rn_Container">
        <h1><rn:field name="Incident.Subject" highlight="true"/></h1>
    </div>
</div>

<div class="rn_PageContent rn_RecordDetail rn_IncidentDetail rn_Container">
    <rn:condition incident_reopen_deadline_hours="72">
        <h2>#rn:msg:UPDATE_THIS_QUESTION_CMD#</h2>
        <div id="rn_ErrorLocation" aria-atomic="true" aria-live="assertive"></div>
        <form id="rn_UpdateQuestion" onsubmit="return false;">
                <rn:widget path="input/FormInput" name="Incident.StatusWithType.Status" label_input="#rn:msg:DO_YOU_WANT_A_RESPONSE_MSG#"/>
                <rn:widget path="input/FormInput" name="Incident.Threads" label_input="#rn:msg:ADD_ADDTL_INFORMATION_QUESTION_CMD#" initial_focus="true" required="true"/>
                <rn:widget path="input/FileAttachmentUpload" label_input="#rn:msg:ATTACH_ADDTL_DOCUMENTS_QUESTION_LBL#"/>
                <rn:widget path="input/FormSubmit" label_on_success_banner="#rn:msg:QUESTION_SUCCESSFULLY_UPDATED_LBL#" on_success_url="/app/msme/account/questions/list"  error_location="rn_ErrorLocation"/>
        </form>
    <rn:condition_else/>
        <h2>#rn:msg:INC_REOPNED_UPD_FURTHER_ASST_PLS_MSG#</h2>
    </rn:condition>

    <h2>#rn:msg:COMMUNICATION_HISTORY_LBL#</h2>
    <div class="rn_QuestionThread">
        <rn:widget path="output/DataDisplay" name="Incident.Threads" label=""/>
    </div>

    <h2>#rn:msg:ADDITIONAL_DETAILS_LBL#</h2>
    <div class="rn_AdditionalInfo">
        <rn:widget path="output/DataDisplay" name="Incident.PrimaryContact.Emails.PRIMARY.Address" label="#rn:msg:EMAIL_ADDR_LBL#" />
        <rn:widget path="output/DataDisplay" name="Incident.ReferenceNumber" label="#rn:msg:REFERENCE_NUMBER_LBL#"/>
        <rn:widget path="output/DataDisplay" name="Incident.StatusWithType.Status" label="#rn:msg:STATUS_LBL#"/>
        <rn:widget path="output/DataDisplay" name="Incident.CreatedTime" label="#rn:msg:CREATED_LBL#" />
        <rn:widget path="output/DataDisplay" name="Incident.UpdatedTime" label="#rn:msg:UPDATED_LBL#"/>
        <rn:widget path="output/DataDisplay" name="Incident.Product"  label="#rn:msg:PRODUCT_LBL#"/>
        <rn:widget path="output/DataDisplay" name="Incident.Category" label="#rn:msg:CATEGORY_LBL#"/>
        <rn:widget path="output/DataDisplay" name="Incident.FileAttachments" label="#rn:msg:FILE_ATTACHMENTS_LBL#"/>
        <!-- <rn:widget path="output/CustomAllDisplay" table="Incident"/> -->
    </div>

    <div class="rn_DetailTools">
        <rn:widget path="utils/PrintPageLink" />
    </div>
    <style type="text/css">
        .rn_TextInput {
            margin-left: 0 !important;
        }
        span.rn_DataLabel {
            font-weight: bold;
            color: #114984;
        }
        .rn_DataValue {
            padding: 4px 0;
        }
        .rn_IncidentThreadDisplay .rn_ThreadHeader.rn_Customer {
    
            font-weight: bold;
        }
        .rn_FileListDisplay .rn_DataValue a {
            color: #0e8943 !important;
        }
    </style>
</div>
