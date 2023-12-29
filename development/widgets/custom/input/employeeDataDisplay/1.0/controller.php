<?php
namespace Custom\Widgets\input;

class employeeDataDisplay extends \RightNow\Widgets\DataDisplay {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
		//print_r($this->data); exit;
        $data = parent::getData();
	//	print_r($this->data);
	//	$this->data['value'] = 
		$id  = Url::getParameter('di_id');
		if ($id) {
			$CI=&get_instance();
            $result = $CI->model('custom/EmployeeIncident')->get($id)->result;
        }
		return $data;
    }
}