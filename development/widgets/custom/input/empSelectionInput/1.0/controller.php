<?php
namespace Custom\Widgets\input;

use \RightNow\Utils\Connect,
    \RightNow\Utils\Config;


class empSelectionInput extends \RightNow\Widgets\SelectionInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

   function getData() {
        if (parent::getData() === false) return false;

        if(!$this->isValidField()) {
            echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(PCT_S_MENU_YES_SLASH_FIELD_MSG), $this->fieldName));
            return false;
        }
        if($this->fieldName === 'SLAInstance' && !\RightNow\Utils\Framework::isLoggedIn()){
            return false;
        }

        $this->data['readOnly'] = $this->data['js']['readOnly'] = $this->data['readOnly'] || $this->data['attrs']['read_only'];

        if(!Connect::isCustomField($this->fieldMetaData)) {
            //standard field
            if($this->table === 'Incident' && $this->fieldName === 'Status') {
                if (!\RightNow\Utils\Url::getParameter('i_id')) {
                    //Status field shouldn't be shown if there is not an incident ID on the page
                    echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(PCT_S_FLD_DISPLAYED_PG_I_ID_PARAM_MSG), $this->data['attrs']['name']));
                    return false;
                }
                $this->data['menuItems'] = array(\RightNow\Utils\Config::getMessage(YES_PLEASE_RESPOND_TO_MY_QUESTION_MSG), "No, My query is resolved now");
					//\RightNow\Utils\Config::getMessage("No, My query is resolved now"));
                $this->data['hideEmptyOption'] = true;
                $this->data['displayType'] = 'Select';
            }
        }

        if($this->dataType === 'Boolean') {
            if($this->data['attrs']['display_as_checkbox']) {
                $this->data['displayType'] = 'Checkbox';
                $this->data['constraints']['isCheckbox'] = true;
            }
            else {
                $this->data['displayType'] = 'Radio';
                $this->classList->add('rn_Radio');
            }
            $this->data['radioLabel'] = array(\RightNow\Utils\Config::getMessage(NO_LBL), \RightNow\Utils\Config::getMessage(YES_LBL));
            //find the index of the checked value
            if(in_array($this->data['value'], array(true, 'true', '1'), true))
                $this->data['checkedIndex'] = 1;
            else if(in_array($this->data['value'], array(false, 'false', '0'), true))
                $this->data['checkedIndex'] = 0;
            else
                $this->data['checkedIndex'] = -1;
        }
        else if (!$this->data['menuItems']) {
            $this->data['displayType'] = 'Select';
            $this->data['menuItems'] = $this->getMenuItems();
        }
    }

    /**
     * Overridable methods from SelectionInput:
     */
    // function isValidField()
    // public function outputSelected($key)
    // public function outputChecked($currentIndex)
    // protected function getMenuItems()
    // protected function isValidSla($slaInstance)
}