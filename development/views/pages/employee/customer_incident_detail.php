<rn:meta title="#rn:php:\RightNow\Libraries\SEO::getDynamicTitle('incident', \RightNow\Utils\Url::getParameter('ci_id'))#" template="employee_header.php" login_required="true" clickstream="incident_view" force_https="true"/>
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');
//echo $contact_id=$CI->session->getProfileData("c_id");
?>
<div class="rn_Hero">
    <div class="rn_Container">
        <h1><rn:field name="Incident.Subject" highlight="true"/></h1>
    </div>
</div>

<div class="rn_PageContent rn_RecordDetail rn_IncidentDetail rn_Container">
    <rn:condition incident_reopen_deadline_hours="168">
        <h2>#rn:msg:UPDATE_THIS_QUESTION_CMD#</h2>
        <div id="rn_ErrorLocation" aria-atomic="true" aria-live="assertive"></div>
        <form id="rn_UpdateQuestion" onsubmit="return false;">
                <rn:widget path="input/FormInput" name="Incident.StatusWithType.Status" label_input="#rn:msg:DO_YOU_WANT_A_RESPONSE_MSG#"/>
				<!--<div id="rn_SelectionInput_29" class="rn_SelectionInput rn_Input">
    
					<div id="rn_SelectionInput_29_LabelContainer">
						
						<label for="rn_SelectionInput_29_Incident.StatusWithType.Status" id="rn_SelectionInput_29_Label" class="rn_Label">Do you want a response?                        </label>
						
					</div>
					
					<select id="rn_SelectionInput_29_Incident.StatusWithType.Status" name="Incident.StatusWithType.Status">
						
											<option value="0" selected="selected">Yes, please respond to my question</option>
									<option value="1">No, My query is resolved now</option>
									
					</select>
					
					
				</div>-->
                <rn:widget path="input/FormInput" name="Incident.Threads" label_input="#rn:msg:ADD_ADDTL_INFORMATION_QUESTION_CMD#" initial_focus="true" required="true"/>
                <rn:widget path="input/FileAttachmentUpload" label_input="#rn:msg:ATTACH_ADDTL_DOCUMENTS_QUESTION_LBL#"/>
                <rn:widget path="input/FormSubmit" label_on_success_banner="#rn:msg:QUESTION_SUCCESSFULLY_UPDATED_LBL#" on_success_url="/app/employee/customer_incident_list"  error_location="rn_ErrorLocation"/>
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
        <rn:widget path="output/CustomAllDisplay" table="Incident"/>
    </div>

    <div class="rn_DetailTools">
        <rn:widget path="utils/PrintPageLink" />
    </div>
</div>
