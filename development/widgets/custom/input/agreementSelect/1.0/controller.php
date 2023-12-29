<?php
namespace Custom\Widgets\input;

class agreementSelect extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
		
		//print_r($_REQUEST);
		$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_REPORT_AGREEMENT_IDS);
		$report_id=$msg->Value;
		
		$this->CI->load->helper('report');

		$contact_id=$this->CI->session->getProfileData("c_id");
		//$contact_id = 3;
		if($report_id>0){
					$filter=array('ContactID'=>$contact_id);
					$report_result= report_result($report_id,$filter);
					//print_r($report_result); 
		}
		$this->data['agreement_arr'] = $report_result;
		$this->data['inputName'] = "Incident.CustomFields.CO.Loan.Loan_No";
		$this->data['js']['name'] = "Incident.CustomFields.CO.Loan.Loan_No";
        return parent::getData();

    }

	 /**
    * Used by the view to output an option's selected attribute.
    * @param int $key Key of the item
    * @return mixed String selected string or null
    */
    public function outputSelected($key) {
        if ($this->table === 'Incident' && $this->fieldName === 'Status' && $this->data['displayType'] === 'Select') {
            $selected = ($key === 0);
        }
        else if ($this->dataType === 'Menu') {
            // Note: double-equal comparison intentional here and below.
            $selected = ($key == $this->data['value']->ID);
        }
        else {
            $selected = ($key == $this->data['value']);
        }
        return $selected ? 'selected="selected"' : null;
    }
}