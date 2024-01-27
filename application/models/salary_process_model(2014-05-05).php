<?php
class Salary_process_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('common_model');
		$this->load->model('pd_process_model');
		$this->load->model('salary_process_eligibility_model');
	}
	
	function pay_sheet($year, $month,$process_check)
	{
		
		 //==================Get Process Date=========================================
		$process_date 		= $this->pd_process_model->get_start_end_date($month,$year);
		$process_start_date = $process_date['start_date'] ;
		$process_end_date 	= $process_date['end_date'] ;
		
		// ==================Get Process Month (Needs for Join check)==================
		$process_start_month 	= date('Y-m', strtotime($process_start_date));
		$process_end_month 		= date('Y-m', strtotime($process_end_date));

		
		$second_half_search_start_date 		= date("Y-m-01", strtotime($process_end_date));
		//=====================Check Deduct Status (Yes Or No)=====================
		
		//======================Get No. of Days And Working Days  Between Process Dates==========
		$num_of_days = $this->get_no_of_days($process_start_date,$process_end_date);

		//==================Salary Block Check==========================
		$next_month_year = date("Y-m",strtotime("-1 month",strtotime($second_half_search_start_date)));
		$num_row_month_year = $this->db->like('block_month',$next_month_year)->get('pr_salary_block_fixed')->num_rows();
		if($num_row_month_year < 1)
		{
			return "Invalid Process Procedure.";
		}
		
		
		$num_row = $this->db->like('block_month',$process_end_month)->get('pr_salary_block_fixed')->num_rows();
		if($num_row > 0)
		{
			return "This Month Already Finally Processed.";
		}
		
		
		if($process_check == "2")
		{
		  $block_year_month = "$process_end_month-01";
		  $data_1['block_month'] 	= $block_year_month;
		  $data_1['username'] 		=  $this->session->userdata('username');
		  $data_1['date_time'] 	= date("Y-m-d H:i:s");
		  $this->db->insert('pr_salary_block_fixed', $data_1); 
		}
		//==============================================================
		
		//============================Get All Production Employee===============================
		$all_emp_id = $this->pd_process_model->get_all_pr_emp_id($second_half_search_start_date);
		//print_r($all_emp_id->result_array());
		//echo $all_emp_id->num_rows();
		foreach($all_emp_id->result() as $rows)
		{
			$salary_process_eligibility = $this->salary_process_eligibility_model->salary_process_eligibility_fixed($rows->emp_id,$process_start_date,$process_end_date);
			
				
			if($salary_process_eligibility == true)
			{ 
				$emp_id 		= $rows->emp_id;
				$emp_dept_id 	= $rows->emp_dept_id;
				$emp_sec_id 	= $rows->emp_sec_id;
				$emp_floor_id 	= $rows->emp_position_id; 
				$emp_block_id 	= $rows->emp_line_id;  
				$emp_desi_id 	= $rows->emp_desi_id; 
				$emp_status_id	= $rows->emp_cat_id;
				$doj 			= $rows->emp_join_date;
				$salary_type 	= $rows->salary_type;
				$gross_sal 		= $rows->gross_sal;
				$join_month		= date('Y-m', strtotime($doj));
				
				
				//==============================For Increment,promotion,===============================
				$where = "trim(substr(effective_month,1,7)) = '$process_end_month'";
				$this->db->select("new_salary");
				$this->db->where("new_emp_id",$emp_id);
				$this->db->where($where);
				$inc_prom_entry1 = $this->db->get("pr_incre_prom_pun");
				if($inc_prom_entry1->num_rows() > 0 )
				{
					foreach($inc_prom_entry1->result() as $row)
					{
						$gross_sal = $row->new_salary;
					}
					//echo $gross_sal."---equal to---";
				}
				else
				{
					$where = "trim(substr(effective_month,1,7)) > '$process_end_month'";
					$this->db->select("prev_salary");
					$this->db->where("new_emp_id",$emp_id);
					$this->db->where($where);
					$this->db->limit(1);
					$inc_prom_entry2 = $this->db->get("pr_incre_prom_pun");
					
					if($inc_prom_entry2->num_rows() > 0 )
					{
						foreach($inc_prom_entry2->result() as $row)
						{
							$gross_sal = $row->prev_salary;
						}
						//echo $gross_sal."---not equal to---";
					}
					else
					{
						echo "";
					}
				
				}
				//============================================End Increment,promotion ======================
				
				
				//==================================LOCAL Salary Rule===================================
				$salary_structure 		= $this->common_model->salary_structure($gross_sal);
				$madical_allo 			= $salary_structure['medical_allow'];
				$basic_sal 				= $salary_structure['basic_sal'];
				$house_rent 			= $salary_structure['house_rent'];
				$ot_rate				= $salary_structure['ot_rate'];
				
				$total_sal = $basic_sal + $house_rent + $madical_allo; 
				
				$data["emp_id"] 		= $emp_id;
				$data["dept_id"] 		= $emp_dept_id;
				$data["sec_id"] 		= $emp_sec_id;
				$data["desig_id"] 		= $emp_desi_id;
				$data["floor_id"] 		= $emp_floor_id;
				$data["block_id"] 		= $emp_block_id;
				$data["status_id"] 		= $emp_status_id;
				$data["sal_type"] 		= $salary_type;
				$data["basic_sal"] 		= $basic_sal;
				$data["house_r"] 		= $house_rent;
				$data["medical_a"] 		= $madical_allo;
				$data["gross_sal"] 		= $gross_sal;
				$data["total_days"] 	= $num_of_days;
				
				
				
				//COMPLIENCE
				
				$salary_structure_com 	= $this->common_model->salary_structure_fixed_com($gross_sal);
				$madical_allo 			= $salary_structure_com['medical_allow'];
				$trans_allow			= $salary_structure_com['trans_allow'];
				$food_allow				= $salary_structure_com['food_allow'];
				$basic_sal 				= $salary_structure_com['basic_sal'];
				$house_rent 			= $salary_structure_com['house_rent'];
				$ot_rate				= $salary_structure_com['ot_rate'];
				
				$data_com["emp_id"] 		= $emp_id;
				$data_com["dept_id"] 		= $emp_dept_id;
				$data_com["sec_id"] 		= $emp_sec_id;
				$data_com["desig_id"] 		= $emp_desi_id;
				$data_com["floor_id"] 		= $emp_floor_id;
				$data_com["block_id"] 		= $emp_block_id;
				$data_com["status_id"] 		= $emp_status_id;
				$data_com["sal_type"] 		= $salary_type;
				$data_com["basic_sal"] 		= $basic_sal;
				$data_com["house_r"] 		= $house_rent;
				$data_com["medical_a"] 		= $madical_allo;
				$data_com["trans_allow"] 	= $trans_allow;
				$data_com["food_allow"] 	= $food_allow;
				$data_com["gross_sal"] 		= $gross_sal;
				$data_com["total_days"] 	= $num_of_days;
				
				
				//===================For Manual Attendance===============
				$this->db->select('*');
				$this->db->where('emp_id',$emp_id);
				$this->db->like('date',$process_end_month);
				$query = $this->db->get("pr_manual_attandence");
				
				$num_rows = $query->num_rows();
				if($num_rows != 0)
				{
					foreach ($query->result() as $row_man_entry)
					{
					  $no_working_days		= $row_man_entry->total_working_day;
					  $holiday 				= $row_man_entry->holiday;
					  $weekend		 		= $row_man_entry->weekend;
					  $attend 				= $row_man_entry->p_day;
					  $absent 				= $row_man_entry->a_day;
					  $late					= $row_man_entry->late;
					  $total_leave 			= $row_man_entry->leave;
					  $ariar 				= $row_man_entry->ariar;
					  $night_allowance_no 	= $row_man_entry->night;
					  $late_count 			= $row_man_entry->late;
					  $holiday_allowance_no = $row_man_entry->h_day;
					  $half_holiday_allowance_no = $row_man_entry->half_h_day;
					  $half_day 			= $row_man_entry->half_day;
					  $ot					= $row_man_entry->ot;
					}
				}
				else
				{
					$no_working_days 	= 0;
					$holiday 			= 0;
					$weekend 			= 0;
					$attend 			= 0;
					$absent 			= 0;
					$late				= 0;
					$total_leave 		= 0;
					$ariar		 		= 0;
					$night_allowance_no = 0;
					$late_count 		= 0;
					$holiday_allowance_no= 0;
					$half_holiday_allowance_no = 0;
					$half_day 			= 0;
					$ot					= 0;

				}
				
				//=========================Calculate Payable Days=========================================
				$total_holiday 	= $weekend + $holiday;
				$pay_days 		= $attend + $total_holiday + $total_leave;
				
				$data["att_days"] 		= $attend;
				$data["absent_days"] 	= $absent;
				$data["c_l"] 			= $total_leave;
				$data["s_l"] 			= 0;
				$data["e_l"] 			= 0;
				$data["m_l"] 			= 0;
				$data["holiday"] 		= $holiday;
				$data["weekend"] 		= $weekend;
				$data["holiday_or_weekend"] = $total_holiday;
				$data["pay_days"] 		= $pay_days;
				
				
				
				//COMPLIENCE
				$data_com["att_days"] 		= $attend;
				$data_com["absent_days"] 	= $absent;
				$data_com["c_l"] 			= $total_leave;
				$data_com["s_l"] 			= 0;
				$data_com["e_l"] 			= 0;
				$data_com["m_l"] 			= 0;
				$data_com["holiday"] 		= $holiday;
				$data_com["weekend"] 		= $weekend;
				$data_com["holiday_or_weekend"] = $total_holiday;
				$data_com["pay_days"] 		= $pay_days;
				
				
				//DEDUCTION
				
				//============================== Start Calculate Payable Basic Salary And Absent Deduction================================
				//=========================================================================================================================
					
				$abs_deduction = $gross_sal / $num_of_days * $absent;
				
				$abs_deduction_com = $basic_sal / $num_of_days * $absent;
				
				//ADV DEDUCTION
				$advance_deduct = $this->advance_loan_deduction($emp_id, $process_end_month);

				
				//LATE DEDUCTION
				$late_deduct = floor($late_count /3);
				$late_deduct_amount =round($gross_sal / $num_of_days * $late_deduct);
				
				
				//HD DEDUCTION
				$hd_deduct_amount =round($gross_sal / $num_of_days * $half_day);
				
				
				
				$stamp = 10;
				if($attend ==0 || $gross_sal==0)
				{
					$stamp = 0;
				}
				
				$total_deduction = $abs_deduction + $advance_deduct + $hd_deduct_amount + $stamp;// + $late_deduct_amount +
				
				
				$data["abs_deduction"] 	= $abs_deduction;
				$data["adv_deduct"] 	= $advance_deduct;
				$data["late"] 			= $late;
				$data["late_amount"] 	= $late_deduct_amount;
				$data["half_day"] 		= $half_day;
				$data["hd_ded_amount"] 	= $hd_deduct_amount;
				$data["stamp"] 			= $stamp;
				$data["total_deduction"]= $total_deduction;
				
				
				//COMPLIENCE
				$total_deduction_com = $abs_deduction_com + $advance_deduct + $stamp;// + $late_deduct_amount +
				$data_com["abs_deduction"] 	= $abs_deduction_com;
				$data_com["adv_deduct"] 	= $advance_deduct;
				$data_com["late"] 			= $late;
				$data_com["late_amount"] 	= $late_deduct_amount;
				$data_com["half_day"] 		= $half_day;
				$data_com["hd_ded_amount"] 	= $hd_deduct_amount;
				$data_com["stamp"] 			= $stamp;
				$data_com["total_deduction"]= $total_deduction_com;
				
				
				//========================== End Calculate Payable Total Salary=============================
				
				
				//ALLOWANCES
				//==========================Calculate Attendance Bonus============================
				if($attend != 0 and $total_leave == 0)
				{
					$att_bouns = $this->att_bouns_cal($emp_id);
				}
				else
				{
					$att_bouns = 0;
				}
				
				
				
				
				$night_allowance_rules 	= $this->get_night_allowance_rules($emp_desi_id);
				if($night_allowance_rules != "0")
				{
					$night_allowance_rate 	= 	$this->night_allowance_rules_amount($night_allowance_rules);
					$night_allowance_amount =	$night_allowance_rate * $night_allowance_no;
				}
				else
				{
					$night_allowance_no 	= 0;
					$night_allowance_rate  = 0;
					$night_allowance_amount = 0;
				}
			
				
				
				//===================================Holiday Allowance===================================
				$holiday_allowance_rules 	= $this->get_holiday_allowance_rules($emp_desi_id);
				if($holiday_allowance_rules != "0")
				{
					$holiday_allowance_rate = 	$this->holiday_allowance_rules_amount($holiday_allowance_rules);
					$holiday_allowance_amount 		=	$holiday_allowance_rate * $holiday_allowance_no;
				}
				else
				{
					$holiday_allowance_no 	= 0;
					$holiday_allowance_rate  = 0;
					$holiday_allowance_amount = 0;
				}
				
				
				
				//===================================Half Holiday Allowance===================================
				$half_holiday_allowance_rules 	= $this->get_half_holiday_allowance_rules($emp_desi_id);
				if($half_holiday_allowance_rules != "0")
				{
					$half_holiday_allowance_rate 	= 	$this->half_holiday_allowance_rules_amount($half_holiday_allowance_rules);
					$half_holiday_allowance_amount 	=	$half_holiday_allowance_rate * $half_holiday_allowance_no;
				}
				else
				{
					$half_holiday_allowance_no 	= 0;
					$half_holiday_allowance_rate  = 0;
					$half_holiday_allowance_amount = 0;
				}
				
				
				
				$total_allowance = $att_bouns + $night_allowance_amount + $holiday_allowance_amount + $half_holiday_allowance_amount;
				
				$total_allowance_com = $att_bouns ;
				
				$data["att_bonus"] 					= $att_bouns;
				$data["night_allowance_no"] 		= $night_allowance_no;
				$data["night_allowance_rate"] 		= $night_allowance_rate;
				$data["night_allowance"] 			= $night_allowance_amount;
				$data["holiday_allowance_no"] 		= $holiday_allowance_no;
				$data["holiday_allowance_rate"] 	= $holiday_allowance_rate;
				$data["holiday_allowance"] 			= $holiday_allowance_amount;
				$data["half_holiday_allowance_no"] 	= $half_holiday_allowance_no;
				$data["half_holiday_allowance_rate"]= $half_holiday_allowance_rate;
				$data["half_holiday_allowance"] 	= $half_holiday_allowance_amount;
				$data["total_allowance"] 			= $total_allowance;
				
				
				$data["ariar"] 		= $ariar;
				
				//COMPLIENCE
				$data_com["att_bonus"] 					= $att_bouns;
				$data_com["total_allowance"] 			= $total_allowance_com;				
				
				//========================================= Over Time Calculation ==========================================
				
				$data["ot_hour"] 	= 0;
				$data["eot_hour"] 	= 0;
				$data["ot_rate"] 	= 0;
				$data["ot_amount"] 	= 0;
				$data["eot_amount"] = 0;
				
				
				$ot_amount_com = round($ot * $ot_rate);
				$data_com["ot_hour"] 	=	$ot;
				$data_com["eot_hour"] 	= 	0;
				$data_com["ot_rate"] 	= 	$ot_rate;
				$data_com["ot_amount"] 	= 	$ot_amount_com;
				$data_com["eot_amount"] = 	0;
				
				
				
				
				
				//============================Festival bonus====================================
				$effective_date = $this->get_bonus_effective_date($process_end_month);
				if($effective_date != false){ 
					$service_month = $this->common_model->get_service_month($effective_date,$doj);
					if($service_month >= 0)
					{
						$festival_bonus_rule = $this->get_festival_bonus_rule($service_month);
						$festival_bonus = $this->get_festival_bonus($festival_bonus_rule,$gross_sal,$basic_sal);
						}
					}
					else { $festival_bonus = 0; }
				}else{
					$festival_bonus = 0;
				}
				$data["festival_bonus"] = $festival_bonus;
				

				
				$net_pay = $gross_sal + $total_allowance - $total_deduction ;
				
				$net_pay_com = $gross_sal + $total_allowance_com - $total_deduction_com + $ot_amount_com;
				
				if($attend ==0 || $gross_sal==0)
				{
					$net_pay = 0;
					$net_pay_com = 0;
				}
				
				$data["net_pay"] 		= $net_pay;
				$data["salary_month"] 	= $second_half_search_start_date;
				
				$data_com["net_pay"] 		= $net_pay_com;
				$data_com["salary_month"] 	= $second_half_search_start_date;
				
				$this->db->select("emp_id");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("salary_month", $second_half_search_start_date);
				$query = $this->db->get("pr_pay_scale_sheet");
				if($query->num_rows() > 0 )
				{
					$this->db->where("emp_id",$emp_id);
					$this->db->where("salary_month", $second_half_search_start_date);
					$this->db->update("pr_pay_scale_sheet",$data);
				}
				else
				{
					$this->db->insert("pr_pay_scale_sheet",$data);
				}
				
				
				
				$this->db->select("emp_id");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("salary_month", $second_half_search_start_date);
				$query = $this->db->get("pr_pay_scale_sheet_com");
				if($query->num_rows() > 0 )
				{
					$this->db->where("emp_id",$emp_id);
					$this->db->where("salary_month", $second_half_search_start_date);
					$this->db->update("pr_pay_scale_sheet_com",$data_com);
				}
				else
				{
					$this->db->insert("pr_pay_scale_sheet_com",$data_com);
				}

		}
		return "Process completed successfully";
	}
	
	
	function holiday_allowance_rules_amount($holiday_allowance_rules)
	{
		// $night_allowance_rules_amount = $this->db->where("designation_id",$emp_desi_id)->get('pr_night_allowance_level')->row()->rules_id;
		//return $night_allowance_rules_amount;
		$this->db->select('allowance_amount');
		$this->db->from('pr_holiday_allowance_rules');
		$this->db->where("rules_id", $holiday_allowance_rules);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			$allowance_amount = $row->allowance_amount;
		}
		else
		{
			$allowance_amount = 0;
		}
		
		return $allowance_amount;
	}
	function get_holiday_allowance_rules($emp_desi_id)
	{
		$this->db->select('rules_id');
		$this->db->from('pr_holiday_allowance_level');
		$this->db->where("designation_id", $emp_desi_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			$rules_id = $row->rules_id;
		}
		else
		{
			$rules_id = 0;
		}
		
		return $rules_id;
	}
	function get_holiday_allowance_no($emp_id,$process_start_date,$process_end_date)
	{
		$this->db->select('SUM(holiday_allowance) AS holiday_allowance');
		$this->db->from('pr_emp_shift_log');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$process_start_date' and '$process_end_date'");
		$query = $this->db->get();
		$row = $query->row();
		$holiday_allowance = $row->holiday_allowance;
		
		return $holiday_allowance;
	}
	
	
	function half_holiday_allowance_rules_amount($holiday_allowance_rules)
	{
		// $night_allowance_rules_amount = $this->db->where("designation_id",$emp_desi_id)->get('pr_night_allowance_level')->row()->rules_id;
		//return $night_allowance_rules_amount;
		$this->db->select('allowance_amount');
		$this->db->from('pr_half_holiday_allowance_rules');
		$this->db->where("rules_id", $holiday_allowance_rules);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			$allowance_amount = $row->allowance_amount;
		}
		else
		{
			$allowance_amount = 0;
		}
		
		return $allowance_amount;
	}
	function get_half_holiday_allowance_rules($emp_desi_id)
	{
		$this->db->select('rules_id');
		$this->db->from('pr_half_holiday_allowance_level');
		$this->db->where("designation_id", $emp_desi_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			$rules_id = $row->rules_id;
		}
		else
		{
			$rules_id = 0;
		}
		
		return $rules_id;
	}
	function get_half_holiday_allowance_no($emp_id,$process_start_date,$process_end_date)
	{
		$this->db->select('SUM(half_holiday_allowance) AS holiday_allowance');
		$this->db->from('pr_emp_shift_log');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$process_start_date' and '$process_end_date'");
		$query = $this->db->get();
		$row = $query->row();
		$holiday_allowance = $row->holiday_allowance;
		
		return $holiday_allowance;
	}
	
	function night_allowance_rules_amount($night_allowance_rules)
	{
		// $night_allowance_rules_amount = $this->db->where("designation_id",$emp_desi_id)->get('pr_night_allowance_level')->row()->rules_id;
		//return $night_allowance_rules_amount;
		$this->db->select('allowance_amount');
		$this->db->from('pr_night_allowance_rules');
		$this->db->where("rules_id", $night_allowance_rules);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			$allowance_amount = $row->allowance_amount;
		}
		else
		{
			$allowance_amount = 0;
		}
		
		return $allowance_amount;
	}
	function get_night_allowance_rules($emp_desi_id)
	{
		$this->db->select('rules_id');
		$this->db->from('pr_night_allowance_level');
		$this->db->where("designation_id", $emp_desi_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			$rules_id = $row->rules_id;
		}
		else
		{
			$rules_id = 0;
		}
		
		return $rules_id;
	}
	
	function get_night_allowance_no($emp_id,$process_start_date,$process_end_date)
	{
		$this->db->select('SUM(night_allowance) AS night_allowance');
		$this->db->from('pr_emp_shift_log');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$process_start_date' and '$process_end_date'");
		$query = $this->db->get();
		$row = $query->row();
		$night_allowance = $row->night_allowance;
		
		return $night_allowance;
	}	
	function resign_check($emp_id, $salary_month)
	{
		$where = "trim(substr(resign_date,1,7)) = '$salary_month'";
		$this->db->select('resign_date');
		$this->db->where('emp_id', $emp_id);
		$this->db->where($where);
		$query = $this->db->get('pr_emp_resign_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			$resign_date = $query->row()->resign_date;
			return $resign_day = substr($resign_date, 8,2);
		}	
	}
	
	function left_check($emp_id, $salary_month)
	{
		$where = "trim(substr(left_date,1,7)) = '$salary_month'";
		$this->db->select('left_date');
		$this->db->where('emp_id', $emp_id);
		$this->db->where($where);
		$query = $this->db->get('pr_emp_left_history');
		//echo $this->db->last_query();
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			$left_date = $query->row()->left_date;
			return $left_day = substr($left_date, 8,2);
		}	
	}
	
	function emp_production($emp_prod)
	{
		$this->db->select("emp_id,salary_type");
		$this->db->where("emp_id",$emp_prod);
		$this->db->where("salary_type",2);
		$query = $this->db->get("pr_emp_com_info");
		if($query->num_rows == 1)
		{
			return $emp_prod;
		}
		else
		{
			return false ;
		}
	}
	
	function others_allaw_cal($emp_id, $salary_month)
	{
		$this->db->select("payment_amount");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("payment_month",$salary_month);
		$query = $this->db->get("pr_payment");
		//echo $this->db->last_query();
		if($query->num_rows > 0)
		{
			$row = $query->row();
			return $row->payment_amount;
		}
		else
		{
			return 0;
		}
	}
	
	function ot_hour($emp_id, $year_month, $ot_rate)
	{
		$this->db->select_sum("ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("shift_log_date",$year_month);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->ot_hour;
	}
	
	function eot_hour($emp_id, $year_month)
	{
		$this->db->select_sum("extra_ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("shift_log_date",$year_month);
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->extra_ot_hour;
	}
	
	function ot_hour_between_date($emp_id, $start_date, $end_date)
	{
		$this->db->select_sum("ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$start_date' AND '$end_date'");
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->ot_hour;
	}
	
	function eot_hour_between_date($emp_id, $start_date, $end_date)
	{
		$this->db->select_sum("extra_ot_hour");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$start_date' AND '$end_date'");
		$query = $this->db->get("pr_emp_shift_log");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->extra_ot_hour;
	}
	
	function att_bouns_cal($emp_id)
	{
		$this->db->select("pr_attn_bonus.ab_rule");
		$this->db->from("pr_attn_bonus");
		$this->db->from("pr_emp_com_info");
		$this->db->where("pr_emp_com_info.emp_id", $emp_id);
		$this->db->where("pr_emp_com_info.att_bonus = pr_attn_bonus.ab_id");
		$query = $this->db->get();
		$row = $query->row();
		return $row->ab_rule;
	}
	
	function transport_cal($emp_id)
	{
		$this->db->select("transport");
		$this->db->from("pr_emp_com_info");
		$this->db->where("emp_id", $emp_id);
		$query = $this->db->get();
		$row = $query->row();
		if($row->transport == 0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function lunch_allaw_cal($emp_id)
	{
		$this->db->select("lunch");
		$this->db->from("pr_emp_com_info");
		$this->db->where("emp_id", $emp_id);
		$query = $this->db->get();
		$row = $query->row();
		if($row->lunch == 0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function get_no_of_days($start_date,$end_date)
	{
		$start = strtotime($start_date);
		$end = strtotime($end_date);
		$no_of_days = ceil(abs($end - $start) / 86400) + 1;
		return  $no_of_days;
	}
	function others_deduct_cal($emp_id, $year_month)
	{
		$this->db->select_sum("others_deduct");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("deduct_month",$year_month);
		$query = $this->db->get("pr_deduct");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->others_deduct;
	}
	
	function tax_deduct_cal($emp_id, $year_month)
	{
		$this->db->select_sum("tax_deduct ");
		$this->db->where("emp_id", $emp_id);
		$this->db->like("deduct_month",$year_month);
		$query = $this->db->get("pr_deduct");
		//echo $this->db->last_query();
		$row = $query->row();
		return $row->tax_deduct ;
	}
	
	function emp_name($emp_id)
	{
		$this->db->select("emp_full_name");
		$this->db->where("emp_id",$emp_id);
		$query = $this->db->get("pr_emp_per_info");
		$row = $query->row();
		return $row->emp_full_name;
	}
	
	function emp_desig($desig_id)
	{
		$this->db->select("desig_name");
		$this->db->where("desig_id",$desig_id);
		$query = $this->db->get("pr_designation");
		$row = $query->row();
		return $row->desig_name;
	}
	
	function salary_grade($gr_id)
	{
		$this->db->select("gr_name");
		$this->db->where("gr_id",$gr_id);
		$query = $this->db->get("pr_grade");
		$row = $query->row();
		return $row->gr_name;
	}
	
	function attendance_check($emp_id,$present_status,$num_of_days, $start_date)
	{
		//echo "$present_status=> $num_of_days, $start_date###";
		$search_date =trim(substr($start_date,0,7));
		$loop_date = trim(substr($start_date,8,2));
		$this->db->select("");
		$this->db->where("emp_id",$emp_id);
		$this->db->like("att_month",$search_date);
		$query = $this->db->get("pr_attn_monthly");
		//echo $this->db->last_query();
		$count = 0;
		foreach($query->result_array() as $rows => $value)
		{
			for($i=$loop_date; $i<= $num_of_days ; $i++)
			{
				$idate = date("d", mktime(0, 0, 0, 0, $i, 0));
				$date="date_$idate";
				
				if($value[$date] == "$present_status")
				{
					$count++;
				}
			}
		}
		return $count;
	}
	
	
	
	
	function insert_pay_sheet($data)
	{
		$this->db->insert('pr_pay_scale_sheet', $data); 
	}
	
	function update_pay_sheet($data)
	{
		$this->db->where("emp_id",$data['emp_id']);  
		$this->db->update('pr_pay_scale_sheet', $data);
		
	}
	
	function leave_db($emp_id,$start_date,$end_date, $leave_type)
	{
		$where = "trim(substr(start_date,1,10)) BETWEEN '$start_date' and '$end_date'";
		
		$this->db->select('start_date');
		$this->db->where("emp_id",$emp_id);
		$this->db->where("leave_type",$leave_type);
		$this->db->where($where);
		
		$query = $this->db->get('pr_leave_trans');
		
		return $query->num_rows();
	}
	
	function advance_loan_deduction($emp_id, $salary_month)
	{
		$search_year_month = $salary_month;
		$salary_month = "$salary_month-01";
				
		$this->db->select("*");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("loan_status", '1');
		$this->db->like("loan_date",$search_year_month);
		$query = $this->db->get("pr_advance_loan");
		
		if( $query->num_rows() > 0)
		{
			foreach($query->result() as $rows)
			{
				$loan_id	= $rows->loan_id;
				$loan_amt 	= $rows->loan_amt; 	
				$pay_amt  	= $rows->pay_amt;
			}
			
			$this->db->select("emp_id,pay_amount");
			$this->db->where("emp_id", $emp_id);
			$this->db->where("loan_id", $loan_id);
			$this->db->like("pay_month", $salary_month);
			$query1 = $this->db->get("pr_advance_loan_pay_history");
			if( $query1->num_rows() == 0)
			{
				$this->db->select_sum("pay_amount");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("loan_id", $loan_id);
				$query2 = $this->db->get("pr_advance_loan_pay_history");
				//echo $this->db->last_query();
				
				if( $query2->num_rows() > 0)
				{
					$row = $query2->row();
					$total_pay_amount = $row->pay_amount;
				}
				else
				{
					$total_pay_amount = 0;
				}
				
				$rest_loan_amount = $loan_amt - $total_pay_amount;
					
				if($rest_loan_amount > $pay_amt)
				{
					$data = array(
									'pay_id' 	=> '',
									'loan_id' 	=> $loan_id,
									'emp_id'  	=> $emp_id,
									'pay_amount'=> $pay_amt,
									'pay_month' => $salary_month
								);
					if($this->db->insert("pr_advance_loan_pay_history", $data))
					{
						return $pay_amt;
					}
				}
				else
				{
					$data = array(
									'pay_id' 	=> '',
									'loan_id' 	=> $loan_id,
									'emp_id'  	=> $emp_id,
									'pay_amount'=> $rest_loan_amount,
									'pay_month' => $salary_month
								);
					if($this->db->insert("pr_advance_loan_pay_history", $data))
					{
						$this->db->select_sum("pay_amount");
						$this->db->where("emp_id", $emp_id);
						$this->db->where("loan_id", $loan_id);
						$query2 = $this->db->get("pr_advance_loan_pay_history");
						//echo $this->db->last_query();
						
						if( $query2->num_rows() > 0)
						{
							$row = $query2->row();
							$total_pay_amount = $row->pay_amount;
							
							if($total_pay_amount == $loan_amt)
							{
								$data = array(
											'loan_status' => 2
											);
								$this->db->where("emp_id", $emp_id);
								$this->db->where("loan_id", $loan_id);
								$this->db->update("pr_advance_loan", $data);
							}
						}
						return $rest_loan_amount;
					}
				}
				
			}
			else
			{
				$row = $query1->row();
				$pay_amount = $row->pay_amount;
				return $pay_amount;
			}
		}
		else
		{
			$this->db->select("*");
			$this->db->where("emp_id", $emp_id);
			$this->db->where("loan_status", '2');
			$this->db->like("loan_date",$search_year_month);
			$query = $this->db->get("pr_advance_loan");
			
			if( $query->num_rows() > 0)
			{
				foreach($query->result() as $rows)
				{
					$loan_id	= $rows->loan_id;
					$loan_amt 	= $rows->loan_amt; 	
					$pay_amt  	= $rows->pay_amt;
				}
			
				$this->db->select("emp_id,pay_amount");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("loan_id", $loan_id);
				$this->db->like("pay_month", $salary_month);
				$query1 = $this->db->get("pr_advance_loan_pay_history");
				if( $query1->num_rows() == 0)
				{
					return 0;
				}
				else
				{
					$row = $query1->row();
					$pay_amount = $row->pay_amount;
					return $pay_amount;
				}
			}
			else
			{
				return 0;
			}
		}
	}
	
	function get_bonus_status()
	{
		$this->db->select('*');
		$query_fes_bonus = $this->db->get('pr_bonus_rules');
		foreach($query_fes_bonus->result() as $rows)
		{
			$effective_date =  $rows->effective_date;
			list($fes_year, $fes_month, $fes_date) = explode('-', trim($effective_date));
			$fes_bonus_month_table = "att_".$fes_year."_".$fes_month;
		}
		return $fes_bonus_month_table;
	}
	
	function get_bonus_effective_date($salary_month)
	{
		$this->db->select('effective_date');
		$this->db->like('effective_date',$salary_month);
		$query = $this->db->get('pr_bonus_rules');
		//echo $this->db->last_query();
		if($query->num_rows() > 0 ){
			$row = $query->row();
			return $effective_date =  $row->effective_date;
		}else{
			return false;
		}
	}
	
	function get_service_month($effective_date,$doj)
	{
		$date_diff 		= strtotime($effective_date)-strtotime($doj);
		//DATE TO DATE RULE
		//return $month 	= floor(($date_diff)/2592000);
		
		//MONTH TO MONTH RULE
		return $month 	= ceil(($date_diff)/2628000);
	}
	
	function get_festival_bonus_rule($service_month)
	{
		$data = array();
		$this->db->select('*');
		$this->db->where('bonus_first_month <=', $service_month); 
		$this->db->where('bonus_second_month >', $service_month); 
		$this->db->order_by('effective_date','DESC');
		$this->db->limit(1);
		$query = $this->db->get('pr_bonus_rules');
		//echo $this->db->last_query();
		//echo 'R:'.$num = $query->num_rows().'|';
		$row = $query->row();
		if($query->num_rows() != 0)
		{
			$data['bonus_amount'] 		= $row->bonus_amount;
			$data['amount_fraction'] 	= $row->bonus_amount_fraction;
			$data['bonus_percent'] 		= $row->bonus_percent;
		}
		return $data;
	}
	
	function get_festival_bonus($festival_bonus_rule,$gross_sal,$basic_sal)
	{
		$bonus_amount 		= $festival_bonus_rule['bonus_amount'];
		$amount_fraction 	= $festival_bonus_rule['amount_fraction'];
		$bonus_percent 		= $festival_bonus_rule['bonus_percent']; 
		
		if($bonus_amount == "Gross")
		{
			$salary_for_bonus = $gross_sal;
		}
		else
		{
			$salary_for_bonus = $basic_sal; 
		}
		
		$pre_festival_bonus = $salary_for_bonus * $amount_fraction;
		$festival_bonus = round((($pre_festival_bonus * $bonus_percent)/100));
		return $festival_bonus;
	}
	
	function get_late_count($emp_id,$year,$month)
	{
		$year_month = $year."-".$month;
		$this->db->where("trim(substr(shift_log_date,1,7)) = '$year_month'");
		$this->db->where('emp_id', $emp_id);
		$this->db->where('late_status', '1');
		$this->db->from('pr_emp_shift_log');
		return  $this->db->count_all_results();
	
	}
	
	function get_join_month_dates($doj)
	{
		$data = array();
		$year 		= date('Y', strtotime($doj));
		$month 		= date('m', strtotime($doj));
		$day 		= date('d', strtotime($doj));
		$last_day 	= date('t', strtotime($doj));
		
		$data['doj_1st_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$data['doj_2nd_date'] 	= date("Y-m-d", strtotime("-1 day",strtotime($doj)));
		$data['doj_1st_count'] 	= date("d", strtotime($data['doj_2nd_date']));
		$data['doj_3rd_date'] 	= $doj;
		$data['doj_2nd_count'] 	= $last_day;
		$data['doj_4th_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, $last_day, $year));
		
		return $data;
	}
	
	function get_resign_month_dates($resign_check, $salary_month)
	{
		$resign_date = "$salary_month-$resign_check";
		$data = array();
		$year 		= date('Y', strtotime($resign_date));
		$month 		= date('m', strtotime($resign_date));
		$day 		= date('d', strtotime($resign_date));
		$last_day 	= date('t', strtotime($resign_date));
		
		$data['resign_1st_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
		$data['resign_2nd_date'] 	= date("Y-m-d", strtotime("-1 day",strtotime($resign_date)));
		$data['resign_1st_count'] 	= date("d", strtotime($data['resign_2nd_date']));
		$data['resign_3rd_date'] 	= $resign_date;
		$data['resign_2nd_count'] 	= $last_day;
		$data['resign_4th_date'] 	= date("Y-m-d", mktime(0, 0, 0, $month, $last_day, $year));
		
		return $data;
	}
	
	function resign_day_count($resign_date, $end_date_of_month)
	{
		$resign_day = date('d', strtotime($resign_date));	
		return $resign_day_count = $end_date_of_month - $resign_day;
	}
	
	function new_join_day_count($first_day_of_month, $join_date)
	{
		$first_day_of_month = date('d', strtotime($first_day_of_month));
		$join_date = date('d', strtotime($join_date));	
		return $resign_day_count = $join_date - $first_day_of_month;
	}
	
	function deduction_hour_count($emp_id,$year,$month)
	{
		$year_month = "$year-$month";
		
		$this->db->select('SUM(deduction_hour) AS deduction_hour_count');	
		$this->db->where('emp_id', $emp_id);
		$this->db->like('shift_log_date', $year_month);
		$query = $this->db->get('pr_emp_shift_log');
		$row = $query->row();
		return $deduction_hour_count = $row->deduction_hour_count;
	}
}
?>