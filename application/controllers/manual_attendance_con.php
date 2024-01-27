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
	
	function manual_attendance_data_entry_for_pd_com()
	{
		$this->load->view('pd/manual_attendance_data_entry_for_pd_com');
	}
	
	function manual_attendance_data_entry_for_fixed()
	{
		$this->load->view('manual_attendance_data_entry_for_fixed');
	}
	
	function manual_attendance_data_entry_for_fixed_complience()
	{
		$this->load->view('manual_attendance_data_entry_for_fixed_complience');
	}
	
	function get_info()
	{
		    $array = $this->uri->uri_to_assoc(3);
			$result = $this->manual_attendance_model->get_info($array['emp_id'],$array['month'],$array['year']);
			echo $result;
	}
	function get_info_pd_com()
	{
		    $array = $this->uri->uri_to_assoc(3);
			$result = $this->manual_attendance_model->get_info_pd_com($array['emp_id'],$array['month'],$array['year']);
			echo $result;
	}
	function get_info_for_fixed()
	{
		    $array = $this->uri->uri_to_assoc(3);
			$result = $this->manual_attendance_model->get_info_for_fixed($array['emp_id'],$array['month'],$array['year']);
			echo $result;
	}
	
	function get_info_for_fixed_for_complience()
	{
		    $array = $this->uri->uri_to_assoc(3);
			$result = $this->manual_attendance_model->get_info_for_fixed_for_complience($array['emp_id'],$array['month'],$array['year']);
			echo $result;
	}
	
	function add_production_log()
	{
		
		$result = $this->manual_attendance_model->manual_attendance_db();
		echo $result ;
		
	}
	function add_production_log_pd_com()
	{
		
		$result = $this->manual_attendance_model->add_production_log_pd_com();
		echo $result ;
		
	}
	
	function add_production_log_for_fixed()
	{
		$result = $this->manual_attendance_model->add_production_log_for_fixed_db();
		echo $result ;
		
	}
	function add_production_log_for_fixed_complience()
	{
		$result = $this->manual_attendance_model->add_production_log_for_fixed_complience_db();
		echo $result ;
		
	}
	
}