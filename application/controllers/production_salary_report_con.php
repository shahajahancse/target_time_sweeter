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
						
		// $data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);	//comment out at 11-02-18
		// echo '<pre>';
		// var_dump($data['value']);die;

		$data['all_block_total'] = 0;	//11-02-18
		$data['all_gross_total'] = 0;
		$data['all_mday'] = 0;
		$data['all_wday'] = 0;
		$data['all_offday'] = 0;
		$data['all_clday'] = 0;
		$data['all_slday'] = 0;
		$data['all_basic_salary'] = 0;
		$data['all_transpot_allowance'] = 0;
		$data['all_food_allowance'] = 0;
		$data['all_net_wages_after_deduction'] = 0;
		$data['all_nowday'] = 0;
		$data['all_nw_amount'] = 0;
		$data['all_pd_amount'] = 0;
		$data['all_pb_amount'] = 0;
		$data['all_subsidiary'] = 0;
		$data['all_att_bonus'] = 0;
		$data['all_fhday'] = 0;
		$data['all_friday_amount'] = 0;
		$data['all_pay_amount'] = 0;
		$data['all_stamp'] = 0;
       
		for($ii = 1; $ii <= 12; $ii++)
		{

			if($ii == $grid_block)
			{
				//echo "hey";exit;
				$data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);

				$ultimate_salary = $this->common_model->get_ultimate_salary_new($data["value"], $sal_year_month, $grid_status);

				$data['all_block_total'] += $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['all_gross_total'] += $ultimate_salary['Gtotal_gross_salary'];
				$data['all_mday'] += $ultimate_salary['total_mday'];
				$data['all_wday'] += $ultimate_salary['total_wday'];
				$data['all_offday'] += $ultimate_salary['total_offday'];
				$data['all_clday'] += $ultimate_salary['total_clday'];
				$data['all_slday'] += $ultimate_salary['total_slday'];
				$data['all_basic_salary'] += $ultimate_salary['total_basic_salary'];
				$data['all_transpot_allowance'] += $ultimate_salary['total_transpot_allowance_all'];
				$data['all_food_allowance'] += $ultimate_salary['total_food_allowance_all'];
				$data['all_net_wages_after_deduction'] += $ultimate_salary['total_net_wages_after_deduction'];
				$data['all_nowday'] += $ultimate_salary['total_nowday'];
				$data['all_nw_amount'] += $ultimate_salary['total_nw_amount'];
				$data['all_pd_amount'] += $ultimate_salary['total_pd_amount'];
				$data['all_pb_amount'] += $ultimate_salary['total_pb_amount'];
				$data['all_subsidiary'] += $ultimate_salary['total_subsidiary'];
				$data['all_att_bonus'] += $ultimate_salary['total_att_bonus'];
				$data['all_fhday'] += $ultimate_salary['total_fhday'];
				$data['all_friday_amount'] += $ultimate_salary['total_friday_amount'];
				$data['all_pay_amount'] += $ultimate_salary['total_pay_amount'];
				$data['all_stamp'] += $ultimate_salary['total_stamp'];

				$data['block_' . $ii] = $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['gross_' . $ii] = $ultimate_salary['Gtotal_gross_salary'];
				$data['mday_' . $ii] = $ultimate_salary['total_mday'];
			}
			else
			{
				$sal_year_month_2 = substr($sal_year_month, 0, 7);
				$single_grid_emp_id = $this->common_model->get_all_employee_for_selection('Select', $grid_section, $ii, 'Select', 'Select', 'ALL', '1', $sal_year_month_2, 2);
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
						$ultimate_salary = $this->common_model->get_ultimate_salary_new($single_block, $sal_year_month, $grid_status);
					}
				}

				$data['all_block_total'] += $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['all_gross_total'] += $ultimate_salary['Gtotal_gross_salary'];
				$data['all_mday'] += $ultimate_salary['total_mday'];
				$data['all_wday'] += $ultimate_salary['total_wday'];
				$data['all_offday'] += $ultimate_salary['total_offday'];
				$data['all_clday'] += $ultimate_salary['total_clday'];
				$data['all_slday'] += $ultimate_salary['total_slday'];
				$data['all_basic_salary'] += $ultimate_salary['total_basic_salary'];
				$data['all_transpot_allowance'] += $ultimate_salary['total_transpot_allowance_all'];
				$data['all_food_allowance'] += $ultimate_salary['total_food_allowance_all'];
				$data['all_net_wages_after_deduction'] += $ultimate_salary['total_net_wages_after_deduction'];
				$data['all_nowday'] += $ultimate_salary['total_nowday'];
				$data['all_nw_amount'] += $ultimate_salary['total_nw_amount'];
				$data['all_pd_amount'] += $ultimate_salary['total_pd_amount'];
				$data['all_pb_amount'] += $ultimate_salary['total_pb_amount'];
				$data['all_subsidiary'] += $ultimate_salary['total_subsidiary'];
				$data['all_att_bonus'] += $ultimate_salary['total_att_bonus'];
				$data['all_fhday'] += $ultimate_salary['total_fhday'];
				$data['all_friday_amount'] += $ultimate_salary['total_friday_amount'];
				$data['all_pay_amount'] += $ultimate_salary['total_pay_amount'];
				$data['all_stamp'] += $ultimate_salary['total_stamp'];

				$data['block_' . $ii] = $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['gross_' . $ii] = $ultimate_salary['Gtotal_gross_salary'];
				$data['mday_' . $ii] = $ultimate_salary['total_mday'];
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


	function production_monthly_salary_sheet_bangla()
	{
		/*$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');		
		$grid_data 		= $this->input->post('spl');
		$grid_section 	= $this->input->post('grid_section');
		$grid_floor 	= $this->input->post('grid_floor');
		$grid_block 	= $this->input->post('grid_block');*/
		//$grid_position 	= $this->input->post('grid_position');
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');		
		$grid_data 		= $this->input->post('spl');
		$grid_section 	= $this->input->post('grid_section');
		$grid_floor 	= $this->input->post('grid_floor');
		$grid_block 	= $this->input->post('grid_block');
		$grid_position 	= $this->input->post('grid_position');
		$salarydate	= $this->input->post('salarydate');
		$grid_emp_id = explode('xxx', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		// $data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);	//comment out at 11-02-18
		// echo '<pre>';
		// var_dump($data['value']);die;

		$data['all_block_total'] = 0;	//11-02-18
		$data['all_gross_total'] = 0;
		$data['all_mday'] = 0;
		$data['all_wday'] = 0;
		$data['all_offday'] = 0;
		$data['all_clday'] = 0;
		$data['all_slday'] = 0;
		$data['all_basic_salary'] = 0;
		$data['all_transpot_allowance'] = 0;
		$data['all_food_allowance'] = 0;
		$data['all_net_wages_after_deduction'] = 0;
		$data['all_nowday'] = 0;
		$data['all_nw_amount'] = 0;
		$data['all_pd_amount'] = 0;
		$data['all_pb_amount'] = 0;
		$data['all_subsidiary'] = 0;
		$data['all_att_bonus'] = 0;
		$data['all_fhday'] = 0;
		$data['all_friday_amount'] = 0;
		$data['all_pay_amount'] = 0;
		$data['all_stamp'] = 0;
		$data['grand_total_advance'] = 0;
       
		for($ii = 1; $ii <= 12; $ii++)
		{

			if($ii == $grid_block)
			{

				/*$data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet_bangla($sal_year_month, $grid_status, $grid_emp_id);
				
				$ultimate_salary = $this->common_model->get_ultimate_salary_new($data["value"], $sal_year_month, $grid_status);*/

				$sal_year_month_2 = substr($sal_year_month, 0, 7);
				$single_grid_emp_id = $this->common_model->get_all_employee_for_selection('Select', $grid_section, $ii, 'Select', 'Select', 'ALL', $grid_floor, $sal_year_month_2, 2);


				$single_arr_grip_emp_id = array();
				foreach($single_grid_emp_id->result() as $key => $emp_id_value)
				{
					$single_arr_grip_emp_id[$key] = $emp_id_value->emp_id;

				}


				$ultimate_salary = 0;

				if(!empty($single_arr_grip_emp_id))
				{
					$single_block = $this->pd_salary_report_model->grid_monthly_salary_sheet_bangla($sal_year_month, $grid_status, $single_arr_grip_emp_id);
					
					$data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet_bangla($sal_year_month, $grid_status, $grid_emp_id);

					if(!empty($single_block))
					{
						$ultimate_salary = $this->common_model->get_ultimate_salary_new($single_block, $sal_year_month, $grid_status);
					}
				}
				
                $data['grand_total_advance'] += $ultimate_salary['grand_total_advance'];
				$data['all_block_total'] += $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['all_gross_total'] += $ultimate_salary['Gtotal_gross_salary'];
				$data['all_mday'] += $ultimate_salary['total_mday'];
				$data['all_wday'] += $ultimate_salary['total_wday'];
				$data['all_offday'] += $ultimate_salary['total_offday'];
				$data['all_clday'] += $ultimate_salary['total_clday'];
				$data['all_slday'] += $ultimate_salary['total_slday'];
				$data['all_basic_salary'] += $ultimate_salary['total_basic_salary'];
				$data['all_transpot_allowance'] += $ultimate_salary['total_transpot_allowance_all'];
				$data['all_food_allowance'] += $ultimate_salary['total_food_allowance_all'];
				$data['all_net_wages_after_deduction'] += $ultimate_salary['total_net_wages_after_deduction'];
				$data['all_nowday'] += $ultimate_salary['total_nowday'];
				$data['all_nw_amount'] += $ultimate_salary['total_nw_amount'];
				$data['all_pd_amount'] += $ultimate_salary['total_pd_amount'];
				$data['all_pb_amount'] += $ultimate_salary['total_pb_amount'];
				$data['all_subsidiary'] += $ultimate_salary['total_subsidiary'];
				$data['all_att_bonus'] += $ultimate_salary['total_att_bonus'];
				$data['all_fhday'] += $ultimate_salary['total_fhday'];
				$data['all_friday_amount'] += $ultimate_salary['total_friday_amount'];
				$data['all_pay_amount'] += $ultimate_salary['total_pay_amount'];
				$data['all_stamp'] += $ultimate_salary['total_stamp'];
				

				$data['block_' . $ii] = $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['gross_' . $ii] = $ultimate_salary['Gtotal_gross_salary'];
				$data['mday_' . $ii] = $ultimate_salary['total_mday'];
				/*echo "<br>";
				print_r($data['block_' . $ii]);*/
			}
			else
			{
				//echo $ii .'=='. $grid_block;exit;
				$sal_year_month_2 = substr($sal_year_month, 0, 7);
				$single_grid_emp_id = $this->common_model->get_all_employee_for_selection('Select', $grid_section, $ii, 'Select', 'Select', 'ALL', $grid_floor, $sal_year_month_2, 2);


				$single_arr_grip_emp_id = array();
				foreach($single_grid_emp_id->result() as $key => $emp_id_value)
				{
					$single_arr_grip_emp_id[$key] = $emp_id_value->emp_id;
				}


				$ultimate_salary = 0;

				if(!empty($single_arr_grip_emp_id))
				{
					$single_block = $this->pd_salary_report_model->grid_monthly_salary_sheet_bangla($sal_year_month, $grid_status, $single_arr_grip_emp_id);

					if(!empty($single_block))
					{
						$ultimate_salary = $this->common_model->get_ultimate_salary_new($single_block, $sal_year_month, $grid_status);
					}
				}
                $data['grand_total_advance'] += $ultimate_salary['grand_total_advance'];
				$data['all_block_total'] += $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['all_gross_total'] += $ultimate_salary['Gtotal_gross_salary'];
				$data['all_mday'] += $ultimate_salary['total_mday'];
				$data['all_wday'] += $ultimate_salary['total_wday'];
				$data['all_offday'] += $ultimate_salary['total_offday'];
				$data['all_clday'] += $ultimate_salary['total_clday'];
				$data['all_slday'] += $ultimate_salary['total_slday'];
				$data['all_basic_salary'] += $ultimate_salary['total_basic_salary'];
				$data['all_transpot_allowance'] += $ultimate_salary['total_transpot_allowance_all'];
				$data['all_food_allowance'] += $ultimate_salary['total_food_allowance_all'];
				$data['all_net_wages_after_deduction'] += $ultimate_salary['total_net_wages_after_deduction'];
				$data['all_nowday'] += $ultimate_salary['total_nowday'];
				$data['all_nw_amount'] += $ultimate_salary['total_nw_amount'];
				$data['all_pd_amount'] += $ultimate_salary['total_pd_amount'];
				$data['all_pb_amount'] += $ultimate_salary['total_pb_amount'];
				$data['all_subsidiary'] += $ultimate_salary['total_subsidiary'];
				$data['all_att_bonus'] += $ultimate_salary['total_att_bonus'];
				$data['all_fhday'] += $ultimate_salary['total_fhday'];
				$data['all_friday_amount'] += $ultimate_salary['total_friday_amount'];
				$data['all_pay_amount'] += $ultimate_salary['total_pay_amount'];
				$data['all_stamp'] += $ultimate_salary['total_stamp'];
				

				$data['block_' . $ii] = $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['gross_' . $ii] = $ultimate_salary['Gtotal_gross_salary'];
				$data['mday_' . $ii] = $ultimate_salary['total_mday'];

				/*echo "<br>";
				print_r($data['block_' . $ii]);*/
			}
		}

		// $ultimate_salary = $this->common_model->get_ultimate_salary($data['value'], $sal_year_month, $grid_status);	//11-02-18
		// echo $ultimate_salary;die;
		/*$data["salary_month"] 	= $sal_year_month;
		$data["grid_status"]  	= $grid_status;
		$data["section"]  		= $grid_section;
		$data["floor"]  		= $grid_floor;
		$data["block"]  		= $grid_block;*/
		
		$data["salary_month"] 	= $sal_year_month;
		$data["grid_status"]  	= $grid_status;
		$data["grid_data"]  	= $grid_emp_id;
		$data["section"]  		= $grid_section;
		$data["floor"]  		= $grid_floor;
		$data["block"]  		= $grid_block;
		$data["grid_position"]  = $grid_position;
		$data["salarydate"]     = $salarydate;

		//print_r($data['all_block_total']);
		//exit();
		$this->load->view('pd/pd_salary_sheet_bangla',$data);
	}

	function production_monthly_salary_sheet_bangla_excel()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');		
		$grid_data 		= $this->input->post('grid_emp_id');
		$grid_section 	= $this->input->post('grid_section');
		$grid_floor 	= $this->input->post('grid_floor');
		$grid_block 	= $this->input->post('grid_block');
		$grid_position 	= $this->input->post('grid_position');
		$grid_emp_id = explode(',', trim($grid_data));
		$this->load->model('common_model');
		/*echo "here";
		print_r($grid_emp_id);exit;*/
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
						
		// $data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet($sal_year_month, $grid_status, $grid_emp_id);	//comment out at 11-02-18
		// echo '<pre>';
		// var_dump($data['value']);die;

		$data['all_block_total'] = 0;	//11-02-18
		$data['all_gross_total'] = 0;
		$data['all_mday'] = 0;
		$data['all_wday'] = 0;
		$data['all_offday'] = 0;
		$data['all_clday'] = 0;
		$data['all_slday'] = 0;
		$data['all_basic_salary'] = 0;
		$data['all_transpot_allowance'] = 0;
		$data['all_food_allowance'] = 0;
		$data['all_net_wages_after_deduction'] = 0;
		$data['all_nowday'] = 0;
		$data['all_nw_amount'] = 0;
		$data['all_pd_amount'] = 0;
		$data['all_pb_amount'] = 0;
		$data['all_subsidiary'] = 0;
		$data['all_att_bonus'] = 0;
		$data['all_fhday'] = 0;
		$data['all_friday_amount'] = 0;
		$data['all_pay_amount'] = 0;
		$data['all_stamp'] = 0;
		$data['grand_total_advance'] = 0;
       
		for($ii = 1; $ii <= 12; $ii++)
		{

			if($ii == $grid_block)
			{

				$sal_year_month_2 = substr($sal_year_month, 0, 7);
				$single_grid_emp_id = $this->common_model->get_all_employee_for_selection('Select', $grid_section, $ii, 'Select', 'Select', 'ALL', $grid_floor, $sal_year_month_2, 2);


				$single_arr_grip_emp_id = array();
				foreach($single_grid_emp_id->result() as $key => $emp_id_value)
				{
					$single_arr_grip_emp_id[$key] = $emp_id_value->emp_id;

				}


				$ultimate_salary = 0;

				if(!empty($single_arr_grip_emp_id))
				{
					$single_block = $this->pd_salary_report_model->grid_monthly_salary_sheet_bangla($sal_year_month, $grid_status, $single_arr_grip_emp_id);
					
					$data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet_bangla($sal_year_month, $grid_status, $grid_emp_id);

					if(!empty($single_block))
					{
						$ultimate_salary = $this->common_model->get_ultimate_salary_new($single_block, $sal_year_month, $grid_status);
					}
				}
				
				$data['grand_total_advance'] += $ultimate_salary['grand_total_advance'];
				$data['all_block_total'] += $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['all_gross_total'] += $ultimate_salary['Gtotal_gross_salary'];
				$data['all_mday'] += $ultimate_salary['total_mday'];
				$data['all_wday'] += $ultimate_salary['total_wday'];
				$data['all_offday'] += $ultimate_salary['total_offday'];
				$data['all_clday'] += $ultimate_salary['total_clday'];
				$data['all_slday'] += $ultimate_salary['total_slday'];
				$data['all_basic_salary'] += $ultimate_salary['total_basic_salary'];
				$data['all_transpot_allowance'] += $ultimate_salary['total_transpot_allowance_all'];
				$data['all_food_allowance'] += $ultimate_salary['total_food_allowance_all'];
				$data['all_net_wages_after_deduction'] += $ultimate_salary['total_net_wages_after_deduction'];
				$data['all_nowday'] += $ultimate_salary['total_nowday'];
				$data['all_nw_amount'] += $ultimate_salary['total_nw_amount'];
				$data['all_pd_amount'] += $ultimate_salary['total_pd_amount'];
				$data['all_pb_amount'] += $ultimate_salary['total_pb_amount'];
				$data['all_subsidiary'] += $ultimate_salary['total_subsidiary'];
				$data['all_att_bonus'] += $ultimate_salary['total_att_bonus'];
				$data['all_fhday'] += $ultimate_salary['total_fhday'];
				$data['all_friday_amount'] += $ultimate_salary['total_friday_amount'];
				$data['all_pay_amount'] += $ultimate_salary['total_pay_amount'];
				$data['all_stamp'] += $ultimate_salary['total_stamp'];

				$data['block_' . $ii] = $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['gross_' . $ii] = $ultimate_salary['Gtotal_gross_salary'];
				$data['mday_' . $ii] = $ultimate_salary['total_mday'];
				/*print_r($data);
				exit;*/
				/*echo "<br>";
				print_r($data['block_' . $ii]);*/
			}
			else
			{
				//echo $ii .'=='. $grid_block;exit;
				$sal_year_month_2 = substr($sal_year_month, 0, 7);
				$single_grid_emp_id = $this->common_model->get_all_employee_for_selection('Select', $grid_section, $ii, 'Select', 'Select', 'ALL', 'Select', $sal_year_month_2, 2);


				$single_arr_grip_emp_id = array();
				foreach($single_grid_emp_id->result() as $key => $emp_id_value)
				{
					$single_arr_grip_emp_id[$key] = $emp_id_value->emp_id;
				}


				$ultimate_salary = 0;

				if(!empty($single_arr_grip_emp_id))
				{
					$single_block = $this->pd_salary_report_model->grid_monthly_salary_sheet_bangla($sal_year_month, $grid_status, $single_arr_grip_emp_id);

					if(!empty($single_block))
					{
						$ultimate_salary = $this->common_model->get_ultimate_salary_new($single_block, $sal_year_month, $grid_status);
					}
				}
				$data['grand_total_advance'] += $ultimate_salary['grand_total_advance'];
				$data['all_block_total'] += $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['all_gross_total'] += $ultimate_salary['Gtotal_gross_salary'];
				$data['all_mday'] += $ultimate_salary['total_mday'];
				$data['all_wday'] += $ultimate_salary['total_wday'];
				$data['all_offday'] += $ultimate_salary['total_offday'];
				$data['all_clday'] += $ultimate_salary['total_clday'];
				$data['all_slday'] += $ultimate_salary['total_slday'];
				$data['all_basic_salary'] += $ultimate_salary['total_basic_salary'];
				$data['all_transpot_allowance'] += $ultimate_salary['total_transpot_allowance_all'];
				$data['all_food_allowance'] += $ultimate_salary['total_food_allowance_all'];
				$data['all_net_wages_after_deduction'] += $ultimate_salary['total_net_wages_after_deduction'];
				$data['all_nowday'] += $ultimate_salary['total_nowday'];
				$data['all_nw_amount'] += $ultimate_salary['total_nw_amount'];
				$data['all_pd_amount'] += $ultimate_salary['total_pd_amount'];
				$data['all_pb_amount'] += $ultimate_salary['total_pb_amount'];
				$data['all_subsidiary'] += $ultimate_salary['total_subsidiary'];
				$data['all_att_bonus'] += $ultimate_salary['total_att_bonus'];
				$data['all_fhday'] += $ultimate_salary['total_fhday'];
				$data['all_friday_amount'] += $ultimate_salary['total_friday_amount'];
				$data['all_pay_amount'] += $ultimate_salary['total_pay_amount'];
				$data['all_stamp'] += $ultimate_salary['total_stamp'];

				$data['block_' . $ii] = $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['gross_' . $ii] = $ultimate_salary['Gtotal_gross_salary'];
				$data['mday_' . $ii] = $ultimate_salary['total_mday'];

				/*echo "<br>";
				print_r($data['block_' . $ii]);*/
			}
		}

		// $ultimate_salary = $this->common_model->get_ultimate_salary($data['value'], $sal_year_month, $grid_status);	//11-02-18
		// echo $ultimate_salary;die;
		$data["salary_month"] 	= $sal_year_month;
		$data["grid_status"]  	= $grid_status;
		$data["section"]  		= $grid_section;
		$data["floor"]  		= $grid_floor;
		$data["block"]  		= $grid_block;

		/*print_r($data['all_gross_total']);
		exit();*/
		$this->load->view('pd/pd_salary_sheet_bangla_excel',$data);
	}
	
	function production_monthly_salary_sheet_bangla_excel_another()
	{
		$sal_year_month = $this->input->post('sal_year_month');
		$grid_status 	= $this->input->post('grid_status');		
		$grid_data 		= $this->input->post('grid_emp_id');
		$grid_section 	= $this->input->post('grid_section');
		$grid_floor 	= $this->input->post('grid_floor');
		$grid_block 	= $this->input->post('grid_block');
		$grid_position 	= $this->input->post('grid_position');
		$grid_emp_id = explode(',', trim($grid_data));
		$this->load->model('common_model');
		//print_r($grid_emp_id);exit;
		$data["deduct_status"]= $this->common_model->get_setup_attributes(1);
				

		$data['all_block_total'] = 0;	//11-02-18
		$data['all_gross_total'] = 0;
		$data['all_mday'] = 0;
		$data['all_wday'] = 0;
		$data['all_offday'] = 0;
		$data['all_clday'] = 0;
		$data['all_slday'] = 0;
		$data['all_basic_salary'] = 0;
		$data['all_transpot_allowance'] = 0;
		$data['all_food_allowance'] = 0;
		$data['all_net_wages_after_deduction'] = 0;
		$data['all_nowday'] = 0;
		$data['all_nw_amount'] = 0;
		$data['all_pd_amount'] = 0;
		$data['all_pb_amount'] = 0;
		$data['all_subsidiary'] = 0;
		$data['all_att_bonus'] = 0;
		$data['all_fhday'] = 0;
		$data['all_friday_amount'] = 0;
		$data['all_pay_amount'] = 0;
		$data['all_stamp'] = 0;
		$data['grand_total_advance'] = 0;
       
		for($ii = 1; $ii <= 12; $ii++)
		{

			if($ii == $grid_block)
			{

				$sal_year_month_2 = substr($sal_year_month, 0, 7);
				$single_grid_emp_id = $this->common_model->get_all_employee_for_selection('Select', $grid_section, $ii, 'Select', 'Select', 'ALL', $grid_floor, $sal_year_month_2, 2);


				$single_arr_grip_emp_id = array();
				foreach($single_grid_emp_id->result() as $key => $emp_id_value)
				{
					$single_arr_grip_emp_id[$key] = $emp_id_value->emp_id;

				}


				$ultimate_salary = 0;

				if(!empty($single_arr_grip_emp_id))
				{
					$single_block = $this->pd_salary_report_model->grid_monthly_salary_sheet_bangla($sal_year_month, $grid_status, $single_arr_grip_emp_id);
					
					$data["value"] = $this->pd_salary_report_model->grid_monthly_salary_sheet_bangla($sal_year_month, $grid_status, $grid_emp_id);

					if(!empty($single_block))
					{
						$ultimate_salary = $this->common_model->get_ultimate_salary_new($single_block, $sal_year_month, $grid_status);
					}
				}
				
				$data['grand_total_advance'] += $ultimate_salary['grand_total_advance'];
				$data['all_block_total'] += $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['all_gross_total'] += $ultimate_salary['Gtotal_gross_salary'];
				$data['all_mday'] += $ultimate_salary['total_mday'];
				$data['all_wday'] += $ultimate_salary['total_wday'];
				$data['all_offday'] += $ultimate_salary['total_offday'];
				$data['all_clday'] += $ultimate_salary['total_clday'];
				$data['all_slday'] += $ultimate_salary['total_slday'];
				$data['all_basic_salary'] += $ultimate_salary['total_basic_salary'];
				$data['all_transpot_allowance'] += $ultimate_salary['total_transpot_allowance_all'];
				$data['all_food_allowance'] += $ultimate_salary['total_food_allowance_all'];
				$data['all_net_wages_after_deduction'] += $ultimate_salary['total_net_wages_after_deduction'];
				$data['all_nowday'] += $ultimate_salary['total_nowday'];
				$data['all_nw_amount'] += $ultimate_salary['total_nw_amount'];
				$data['all_pd_amount'] += $ultimate_salary['total_pd_amount'];
				$data['all_pb_amount'] += $ultimate_salary['total_pb_amount'];
				$data['all_subsidiary'] += $ultimate_salary['total_subsidiary'];
				$data['all_att_bonus'] += $ultimate_salary['total_att_bonus'];
				$data['all_fhday'] += $ultimate_salary['total_fhday'];
				$data['all_friday_amount'] += $ultimate_salary['total_friday_amount'];
				$data['all_pay_amount'] += $ultimate_salary['total_pay_amount'];
				$data['all_stamp'] += $ultimate_salary['total_stamp'];

				$data['block_' . $ii] = $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['gross_' . $ii] = $ultimate_salary['Gtotal_gross_salary'];
				$data['mday_' . $ii] = $ultimate_salary['total_mday'];
				/*echo "<br>";
				print_r($data['block_' . $ii]);*/
			}
			else
			{
				//echo $ii .'=='. $grid_block;exit;
				$sal_year_month_2 = substr($sal_year_month, 0, 7);
				$single_grid_emp_id = $this->common_model->get_all_employee_for_selection('Select', $grid_section, $ii, 'Select', 'Select', 'ALL', 'Select', $sal_year_month_2, 2);


				$single_arr_grip_emp_id = array();
				foreach($single_grid_emp_id->result() as $key => $emp_id_value)
				{
					$single_arr_grip_emp_id[$key] = $emp_id_value->emp_id;
				}


				$ultimate_salary = 0;

				if(!empty($single_arr_grip_emp_id))
				{
					$single_block = $this->pd_salary_report_model->grid_monthly_salary_sheet_bangla($sal_year_month, $grid_status, $single_arr_grip_emp_id);

					if(!empty($single_block))
					{
						$ultimate_salary = $this->common_model->get_ultimate_salary_new($single_block, $sal_year_month, $grid_status);
					}
				}

				$data['grand_total_advance'] += $ultimate_salary['grand_total_advance'];
				$data['all_block_total'] += $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['all_gross_total'] += $ultimate_salary['Gtotal_gross_salary'];
				$data['all_mday'] += $ultimate_salary['total_mday'];
				$data['all_wday'] += $ultimate_salary['total_wday'];
				$data['all_offday'] += $ultimate_salary['total_offday'];
				$data['all_clday'] += $ultimate_salary['total_clday'];
				$data['all_slday'] += $ultimate_salary['total_slday'];
				$data['all_basic_salary'] += $ultimate_salary['total_basic_salary'];
				$data['all_transpot_allowance'] += $ultimate_salary['total_transpot_allowance_all'];
				$data['all_food_allowance'] += $ultimate_salary['total_food_allowance_all'];
				$data['all_net_wages_after_deduction'] += $ultimate_salary['total_net_wages_after_deduction'];
				$data['all_nowday'] += $ultimate_salary['total_nowday'];
				$data['all_nw_amount'] += $ultimate_salary['total_nw_amount'];
				$data['all_pd_amount'] += $ultimate_salary['total_pd_amount'];
				$data['all_pb_amount'] += $ultimate_salary['total_pb_amount'];
				$data['all_subsidiary'] += $ultimate_salary['total_subsidiary'];
				$data['all_att_bonus'] += $ultimate_salary['total_att_bonus'];
				$data['all_fhday'] += $ultimate_salary['total_fhday'];
				$data['all_friday_amount'] += $ultimate_salary['total_friday_amount'];
				$data['all_pay_amount'] += $ultimate_salary['total_pay_amount'];
				$data['all_stamp'] += $ultimate_salary['total_stamp'];

				$data['block_' . $ii] = $ultimate_salary['grand_total_net_wages_with_ot'];
				$data['gross_' . $ii] = $ultimate_salary['Gtotal_gross_salary'];
				$data['mday_' . $ii] = $ultimate_salary['total_mday'];

				/*echo "<br>";
				print_r($data['block_' . $ii]);*/
			}
		}

		$data["salary_month"] 	= $sal_year_month;
		$data["grid_status"]  	= $grid_status;
		$data["section"]  		= $grid_section;
		$data["floor"]  		= $grid_floor;
		$data["block"]  		= $grid_block;

		//print_r($data['all_block_total']);
		//exit();
		$this->load->view('pd/pd_salary_sheet_bangla_excel',$data);
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

