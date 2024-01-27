<?php
class Production_salary_report_con extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('pd_models/pd_salary_report_model');
		//$this->load->model('leave_model');
		//$this->load->model('acl_model');
		//$access_level = 8;
		//$acl = $this->acl_model->acl_check($access_level);
	}
	
	function production_monthly_salary_sheet()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');		
		$grid_data 		= $this->input->post('spl');
		$grid_section 	= $this->input->post('grid_section');
		$grid_floor 	= $this->input->post('grid_floor');
		$grid_block 	= $this->input->post('grid_block');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] 	= $sal_year_month;
		$data["grid_status"]  	= $grid_status;
		$data["section"]  		= $grid_section;
		$data["floor"]  		= $grid_floor;
		$data["block"]  		= $grid_block;
		
		$this->load->view('pd/pd_salary_sheet',$data);
	}
	
	
	function production_salary_sheet_complience()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');		
		$grid_data 		= $this->input->post('spl');
		$grid_section 	= $this->input->post('grid_section');
		$grid_floor 	= $this->input->post('grid_floor');
		$grid_block 	= $this->input->post('grid_block');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		$data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet_com($sal_year_month, $grid_status, $grid_emp_id);
		$data["salary_month"] 	= $sal_year_month;
		$data["grid_status"]  	= $grid_status;
		$data["section"]  		= $grid_section;
		$data["floor"]  		= $grid_floor;
		$data["block"]  		= $grid_block;
		
		$this->load->view('pd/pd_salary_sheet_com',$data);
	}
}

