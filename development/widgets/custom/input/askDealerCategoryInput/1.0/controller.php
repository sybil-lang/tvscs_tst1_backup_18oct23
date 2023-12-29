<?php
namespace Custom\Widgets\input;

use \RightNow\Utils\Text;

class askDealerCategoryInput extends \RightNow\Widgets\ProductCategoryInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
        // Set max_lvl to parent widget's default as this attribute needs all levels in order to display any specified prod/cats and its descendants.
        $this->data['attrs']['max_lvl'] = 1;
        if (parent::getData() === false) {
            return false;
        }
		
		$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Dealer_Category);
		$report_id=$msg->Value;
		
		$this->CI->load->helper('report');

		/*$contact_id=$this->CI->session->getProfileData("c_id");
		$contact_id = 3;*/
		

        $hierData = $this->data['js']['hierData'][0] ?: array();
        if ($hierData && ($selected = $this->data['selected'])) {
            // Build up a new hierarchy of the selected item and its descendants
            $selectedInResults = false;
            $newData = array();
            foreach($hierData as $data) {
                $data['label'] = Text::escapeHtml($data['label']);
                if ($data['id'] === 0 || $data['id'] === $selected) {
                    $newData[] = $data;
                    if (!$selectedInResults && $data['id'] === $selected) {
                        $selectedInResults = true;
                    }
                }
            }

            if (!$selectedInResults) {
                $response = $this->CI->model('Prodcat')->get($selected);
				//print_r($response); die;
                if ($errorMessage = $response->error) {
                    echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(ERR_ENC_ATT_RETRIEVE_PCT_S_PCT_S_LBL), $this->data['attrs']['label_input'], $selected, $errorMessage));
                }
                if ($object = $response->result) {
                    $newData[] = array('id' => $object->ID, 'label' => Text::escapeHtml($object->LookupName), 'selected' => true);
                }
            }

            if ($descendants = $this->data['descendants']) {
                $newData = array_merge($newData, array_map(function($data) {
                    $data['child'] = true;
                    $data['label'] = Text::escapeHtml($data['label']);
                    return $data;
                }, $descendants));
            }
            $hierData = $newData;
        }
        else{
            foreach($hierData as &$data) {
                $data['label'] = Text::escapeHtml($data['label']);
            }
        }
        if ($hierData && $hierData[0]['id'] === 0) {
            // The model expects null for 'no selection'
            $hierData[0]['id'] = '';
        }
//		print_r($hierData);
unset($hierData);
		if($report_id>0){
							$filter=array();
							$report_result= report_result($report_id,$filter);
							//print_r($report_result);
							// Array ( [id] => 964 [label] => IT Infra [hasChildren] => [selected] => ) )
							//$cdata = ksort($report_result['Category']);
							//print_r($cdata); 
							$hierData[] = array('id' => '', 'label' => 'Select a Category');
							$default = $this->data['attrs']['default_value'];
						//echo "good";
							foreach($report_result as $key => $response){
									if($default == $response['Category_Id']){
											$hierData[] = array('id'=> $response['Category_Id'], 'label' => addslashes($response['Category']),'hasChildren' => '', 'selected' => 'true');
									}else{
											$hierData[] = array('id'=> $response['Category_Id'], 'label' => addslashes($response['Category']),'hasChildren' => '', 'selected' => '');
									}
							}
				}
				
				//print_r($hierData);
        $this->data['hierData'] = $hierData;
    }

    /**
     * Calls the parent getDefaultChain function and sets the following parameters indicating child prod/cats to display:
     *   this->data['selected'] - Either the prod/cat returned from the parent:getDefaultChain call, or if linking is on, the default product ID.
     *   this->data['descendants'] - An array of child prod/cats from 'selected' above.
     *   this->data['ancestors'] - An array of $selected's ancestors
     *
     * @return array The default chain returned by the parent widget.
     */
    protected function getDefaultChain() {
        $selected = $this->data['selected'] = null;
        $this->data['descendants'] = $this->data['ancestors'] = array();
        if ($defaultChain = parent::getDefaultChain()) {
            $selected = $this->data['selected'] = intval(end($defaultChain));
            $response = $this->CI->model('Prodcat')->getDirectDescendants($this->data['js']['data_type'], $selected);
            if ($errorMessage = $response->error) {
                echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(ERR_ENC_ATT_RETRIEVE_DESCENDANTS_LBL), $this->data['attrs']['label_input'], $selected, $errorMessage));
            }
            if (is_array($descendants = $response->result)) {
                $this->data['descendants'] = $descendants;
            }
        }
        else if ($this->data['js']['linkingOn'] && $this->data['js']['data_type'] === self::CATEGORY) {
            $selected = $this->CI->model('Prodcat')->getDefaultProductID();
            $response = $this->CI->model('Prodcat')->getLinkedCategories($selected);
            if ($errorMessage = $response->error) {
                echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(ERR_ENC_ATT_RETRIEVE_LINKED_CAT_PCT_LBL), $selected, $errorMessage));
            }
            if (is_array($descendants = $response->result)) {
                $this->data['descendants'] = $descendants;
            }
        }

        if ($selected && $this->data['attrs']['display_ancestors']) {
            $response = $this->CI->model('Prodcat')->getFormattedChain($this->data['js']['data_type'], $selected);
            if ($errorMessage = $response->error) {
                echo $this->reportError(sprintf(\RightNow\Utils\Config::getMessage(ERR_ENC_ATT_RETRIEVE_HIER_PCT_S_PCT_LBL), $this->data['attrs']['label_input'], $selected, $errorMessage));
            }
            if(is_array($ancestors = $response->result)){
                //Remove the last item as that will be the currently selected value, which isn't an ancestor
                array_pop($ancestors);
                $this->data['ancestors'] = $ancestors;
            }
        }
        return $defaultChain;
    }
}