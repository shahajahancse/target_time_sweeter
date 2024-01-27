<?php
class Manual_attendance_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		//$this->load->model('acl_model');
		$this->load->model('manual_attendance_model');
		$this->load->model('pd_process_model');
		//$access_level = 3;
		//$acl = $this->acl_model->acl_check($access_level);
	}
	
	function manual_attendance_data_entry()
	{
		$this->load->view('pd/manual_attendance_data_entry');
	}
	function get_info()
	{
		    $array = $this->uri->uri_to_assoc(3);
			$result = $this->manual_attendance_model->get_info($array['emp_id'],$array['month'],$array['year']);
			echo $result;
	}
	function add_production_log()
	{
		
		$result = $this->manual_attendance_model->manual_attendance_db();
		echo $result ;
		
	}
	
}