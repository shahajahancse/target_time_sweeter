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
	
	/*function production_monthly_salary_sheet()
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
	} */
	
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
						
		// $data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);	//comment out at 11-02-18
		// echo '<pre>';
		// var_dump($data['value']);die;

		$data['all_block_total'] = 0;	//11-02-18

		for($ii = 1; $ii <= 12; $ii++)
		{
			if($ii == $grid_block)
			{
				$data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);

				$ultimate_salary = $this->common_model->get_ultimate_salary($data['value'], $sal_year_month, $grid_status);

				$data['all_block_total'] += $ultimate_salary;

				$data['block_' . $ii] = $ultimate_salary;
			}
			else
			{
				$sal_year_month_2 = substr($sal_year_month, 0, 7);
				$single_grid_emp_id = $this->common_model->get_all_employee_for_selection('Select', $grid_section, $ii, 'Select', 'Select', 'ALL', 'Select', $sal_year_month_2, 2);
				// echo $this->db->last_query();die;
				// echo '<pre>';
				// var_dump($single_grid_emp_id->result());die;

				$single_arr_grip_emp_id = array();
				foreach($single_grid_emp_id->result() as $key => $emp_id_value)
				{
					$single_arr_grip_emp_id[$key] = $emp_id_value->emp_id;
				}
				// echo '<pre>';
				// var_dump($grid_emp_id);
				// echo '</pre> ------------ <br> <br> <pre>';
				// var_dump($single_arr_grip_emp_id);
				// die;

				$ultimate_salary = 0;

				if(!empty($single_arr_grip_emp_id))
				{
					$single_block = $this->pd_salary_report_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $single_arr_grip_emp_id);

					if(!empty($single_block))
					{
						$ultimate_salary = $this->common_model->get_ultimate_salary($single_block, $sal_year_month, $grid_status);
					}
				}

				$data['all_block_total'] += $ultimate_salary;

				$data['block_' . $ii] = $ultimate_salary;
			}
		}

		// $ultimate_salary = $this->common_model->get_ultimate_salary($data['value'], $sal_year_month, $grid_status);	//11-02-18
		// echo $ultimate_salary;die;
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

