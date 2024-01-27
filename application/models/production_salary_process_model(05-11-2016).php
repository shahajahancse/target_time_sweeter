<?php
class Production_salary_process_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('pd_process_model');
		$this->load->model('emp_wise_entry_model');
		$this->load->model('salary_process_eligibility_model');
		$this->load->model('common_model');
		$this->load->model('pd_models/pd_salary_report_model');
		
	}
	
	function production_pay_sheet($year, $month,$process_check)
	{
		
		 //==================Get Process Date=========================================
		$process_date 		= $this->pd_process_model->get_start_end_date($month,$year);
		$process_start_date = $process_date['start_date'] ;
		$process_end_date 	= $process_date['end_date'] ;
		
		//Coded By Tarek on 2-10-16
		$process_start_new_date = "01";
		$process_start_date = substr($process_start_date,0,8);
		$process_start_date = $process_start_date.$process_start_new_date;
		//End 
		
		// ==================Get Process Month (Needs for Join check)==================
		$process_start_month 	= date('Y-m', strtotime($process_start_date));
		$process_end_month 		= date('Y-m', strtotime($process_end_date));
		
		// ==================Get Table Name(att_2013_01)=============================
		//$start_table_name 	= $this->get_table_name($process_start_date);
		//$end_table_name 	= $this->get_table_name($process_end_date);
		
		//=====================Check Table Name (True Or False)=====================
		//$start_table_validity 	= $this->table_exists_check($start_table_name);
		//$end_table_validity 	= $this->table_exists_check($end_table_name);
		
		$second_half_search_start_date 		= date("Y-m-01", strtotime($process_end_date));
		//=====================Check Deduct Status (Yes Or No)=====================
		//$deduct_id =1;
		//$deduct_status = $this->common_model->get_setup_attributes($deduct_id);
		
		/*if($start_table_validity == "False" && $end_table_validity == "False")
		{
			return "Process month does not exist, please change your process month";
		}*/
		
		//======================Get No. of Days And Working Days  Between Process Dates==========
		$num_of_days = $this->get_no_of_days($process_start_date,$process_end_date);
		/*$day_of_week=5; 
		$num_of_days = $this->get_no_of_days($process_start_date,$process_end_date);
		$weekend_day_name = $this->common_model->get_setup_attributes(5);
		$weekend_days = $this->get_weekend_days($weekend_day_name,$num_of_days,$process_start_date);
		//echo $weekend_days;
		$no_working_days = $num_of_days - $weekend_days;*/
		//==================Salary Block Check==========================
		$next_month_year = date("Y-m",strtotime("-1 month",strtotime($second_half_search_start_date)));
		$num_row_month_year = $this->db->like('block_month',$next_month_year)->get('pr_salary_block')->num_rows();
		if($num_row_month_year < 1)
		{
			return "Invalid Process Procedure.";
		}
		
		
		$num_row = $this->db->like('block_month',$process_end_month)->get('pr_salary_block')->num_rows();
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
		  $this->db->insert('pr_salary_block', $data_1); 
		  //echo $this->db->last_query();
		}
		//==============================================================
		
		//============================Get All Production Employee===============================
		$all_emp_id = $this->pd_process_model->get_all_pd_emp_id();
		//print_r($all_emp_id->result_array());
		//echo $all_emp_id->num_rows();
		foreach($all_emp_id->result() as $rows)
		{
			$salary_process_eligibility = $this->salary_process_eligibility_model->salary_process_eligibility($rows->emp_id,$process_start_date,$process_end_date);
			
				
			if($salary_process_eligibility == true)
			{ 
				$emp_id 		= $rows->emp_id;
				$emp_dept_id 	= $rows->emp_dept_id;
				$emp_sec_id 	= $rows->emp_sec_id;
				$emp_floor_id 	= $rows->emp_position_id; 
				$emp_block_id 	= $rows->emp_line_id;  
				$emp_desi_id 	= $rows->emp_desi_id; 
				$emp_status_id	= $rows->emp_cat_id;
				$salary_type	= 2;
				$doj 			= $rows->emp_join_date;
				$gross_sal 		= $rows->gross_sal;
				$join_month		= date('Y-m', strtotime($doj));
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
				
				//COMPLIANCE
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
				$data_com["food_allow"] 	= $food_allow;
				$data_com["trans_allow"] 	= $trans_allow;
				$data_com["gross_sal"] 		= $gross_sal;
				$data_com["total_days"] 	= $num_of_days;
				
				
				//===================For Manual Attendance===============
				$this->db->select('*');
				$this->db->where('emp_id',$emp_id);
				$this->db->like('date',$process_end_month);
				$query = $this->db->get("pd_manual_attandence");
				//echo $this->db->last_query();
				
				$num_rows = $query->num_rows();
				if($num_rows != 0)
				{
					foreach ($query->result() as $row_man_entry)
					{
					  $no_working_days		= $row_man_entry->total_working_day;
					  $holiday 				= $row_man_entry->holiday;
					  $weeked		 		= $row_man_entry->weekend;
					  $attend 				= $row_man_entry->p_day;
					  $absent 				= $row_man_entry->a_day;
					  $total_leave 			= $row_man_entry->leave;
					  $none_work_day 		= $row_man_entry->no_work;
					  $night_allowance_no 	= $row_man_entry->night;
					  $late_count 			= $row_man_entry->late;
					  $holiday_allowance_no = $row_man_entry->h_day;
					  $ot				 	= $row_man_entry->ot;
					}
				}
				else
				{
					$no_working_days 	= 0;
					$holiday 			= 0;
					$weeked 			= 0;
					$attend 			= 0;
					$absent 			= 0;
					$total_leave 		= 0;
					$none_work_day 		= 0;
					$night_allowance_no = 0;
					$late_count 		= 0;
					$holiday_allowance_no	= 0;
					$ot				 	= 0;

				}
				
				//=========================Calculate Payable Days=========================================
				$total_holiday 	= $weeked + $holiday;
				$pay_days 		= $attend + $total_holiday + $total_leave;
				
				$data["att_days"] 		= $attend;
				$data["absent_days"] 	= $absent;
				$data["c_l"] 			= $total_leave;
				$data["s_l"] 			= 0;
				$data["e_l"] 			= 0;
				$data["m_l"] 			= 0;
				$data["holidy"] 		= $holiday;
				$data["weeked"] 		= $weeked;
				$data["holiday_or_weeked"] = $total_holiday;
				$data["pay_days"] 		= $pay_days;
				
				
				//COMPLIENCE
				$data_com["att_days"] 		= $attend;
				$data_com["absent_days"] 	= $absent;
				$data_com["c_l"] 			= $total_leave;
				$data_com["s_l"] 			= 0;
				$data_com["e_l"] 			= 0;
				$data_com["m_l"] 			= 0;
				$data_com["holidy"] 		= $holiday;
				$data_com["weeked"] 		= $weeked;
				$data_com["holiday_or_weeked"] = $total_holiday;
				$data_com["pay_days"] 		= $pay_days;
				
				//DEDUCTION
				
				//====ADV DEDUCTION
				$abs_deduction = $gross_sal / $num_of_days * $absent;
				$abs_deduction_com = $basic_sal / $num_of_days * $absent;
				
				$advance_deduct = $this->advance_loan_deduction($emp_id, $process_end_month);
				$stamp = 10;
				if($attend ==0 || $gross_sal==0)
				{
					$stamp = 0;
				}
				
				
				$total_deduction = $advance_deduct + $stamp;
				
				$salary_after_abs_deduction = $gross_sal - $abs_deduction_com;
				
				$data["abs_deduction"] 		= $abs_deduction;
				$data["adv_deduct"] 		= $advance_deduct;
				$data["stamp"] 				= $stamp;
				$data["total_deduction"]	= $total_deduction;
				
				
				$data_com["abs_deduction"] 				= $abs_deduction_com;
				$data_com["adv_deduct"] 				= $advance_deduct;
				$data_com["stamp"] 						= $stamp;
				$data_com["salary_after_abs_deduction"]	= $salary_after_abs_deduction;
				
				//ALLOWANCES
				//==========================Calculate Attendance Bonus============================
							
				if($absent == 0 and $total_leave == 0)
				{
					if($attend != 0){
					$att_bouns = $this->att_bouns_cal($emp_id);
					}else
					{
						$att_bouns = 0;
					}
				}
				else
				{
					$att_bouns = 0;
				}
				
				$data["att_bonus"] 		= $att_bouns;
				$data_com["att_bonus"] 	= $att_bouns;
				
				
				$pd_amount 					= $this->get_pd_amount($emp_id,$emp_sec_id,$process_start_date,$process_end_date);
				
				$pd_amount_bonus_percent 	= $this->get_pd_amount_bonus_percent($pd_amount);
				if($pd_amount_bonus_percent != 0)
				{
					$pd_bonus_amount 			= $this->get_pd_amount_bonus($pd_amount,$pd_amount_bonus_percent);
				}
				else
				{
					$pd_bonus_amount = 0;
				}
				

				//===================================None Work Day And Allowance=================================
				$none_work_amount 			= $this->common_model->get_setup_attributes(9);
				$no_work_allowance 			= $none_work_day * $none_work_amount;
				
				//===================================Night Allowance===================================
				$night_allowance_rules 			= $this->get_night_allowance_rules($emp_desi_id);
				$night_allowance_rules_amount 	= 	$this->night_allowance_rules_amount($night_allowance_rules);
				if($night_allowance_rules != "0")
				{
					$night_allowance_amount 		=	$night_allowance_rules_amount * $night_allowance_no;
				}
				else
				{
					$night_allowance_no 			= 0;
					$night_allowance_amount 		= 0;
				}
				
				
				
				//===================================Holiday Allowance===================================
				$holiday_allowance_rules 		= $this->get_holiday_allowance_rules($emp_desi_id);
				$holiday_allowance_rules_amount = 	$this->holiday_allowance_rules_amount($holiday_allowance_rules);

				if($holiday_allowance_rules != "0")
				{
					$holiday_allowance_amount 		=	$holiday_allowance_rules_amount * $holiday_allowance_no;
				}
				else
				{
					$holiday_allowance_no 			= 0;
					$holiday_allowance_amount 		= 0;
				}
				
				$data["pd_amount"] 			= $pd_amount;
				$data["pd_bonus_percent"] 	= $pd_amount_bonus_percent;
				$data["pd_bonus_amount"] 	= $pd_bonus_amount;
				
				
				$data["none_work_amount"] 		= $none_work_amount;
				$data["none_work_day"] 			= $none_work_day;
				$data["none_work_allowance"] 	= $no_work_allowance;
				
				$data['night_allowance_rate']		= $night_allowance_rules_amount;
				$data["night_allowance_no"] 		= $night_allowance_no;
				$data["night_allowance"] 			= $night_allowance_amount;
				
				$data["holiday_allowance_rate"] 	= $holiday_allowance_rules_amount;
				$data["holiday_allowance_no"] 		= $holiday_allowance_no;
				$data["holiday_allowance"] 			= $holiday_allowance_amount;
				
				
				//COMPLIENCE
				$data_com["pd_amount"] 			= $pd_amount;
				$data_com["pd_bonus_percent"] 	= $pd_amount_bonus_percent;
				$data_com["pd_bonus_amount"] 	= $pd_bonus_amount;
				$data_com["none_work_amount"] 		= $none_work_amount;
				$data_com["none_work_day"] 			= $none_work_day;
				$data_com["none_work_allowance"] 	= $no_work_allowance;
				
				if($pd_amount > $salary_after_abs_deduction)
				{
					$selected_payable_amount_com = $pd_amount;
				}
				else{
					$selected_payable_amount_com = $salary_after_abs_deduction;
				}
				
				$total_pd_amount_compliance = $selected_payable_amount_com + $pd_bonus_amount + $no_work_allowance;

				$data_com['selected_payable_amount'] 	= $selected_payable_amount_com ;
				$data_com['total_pd_amount'] 			= $total_pd_amount_compliance ;
				
				//==========================Calculate Transport And Lunch Allowance============================
				
				$total_allaw = $att_bouns ;//+ $trans_allaw + $lunch_allaw + $others_allaw;
				$data["total_allaw"] = $total_allaw;
				//========================================= Over Time Calculation ==========================================
				$ot_rate_divider = $attend * 8 + $ot;
				if($ot_rate_divider == '0')
				{
					$ot_rate_com = 0;
				}
				else
				{
					$ot_rate_com = round(($pd_amount/($ot_rate_divider)),1);
				}
				
				
				$ot_amount_com = round($ot * $ot_rate_com);
				$data["ot_hour"] 	= 0;
				$data["ot_rate"] 	= 0;
				$data["ot_amount"] 	= 0;
				
				
				$data_com["ot_hour"] 	= $ot;
				$data_com["ot_rate"] 	= $ot_rate_com;
				$data_com["ot_amount"] 	= $ot_amount_com;
				
				
				
				
				
				//===========================PROVIDENT FUNND CALCULATION==============================================
				
				//==================================OTHERS DEDUCTION====================================================
		
				
				$data["salary_month"] = $second_half_search_start_date;
				$data_com["salary_month"] = $second_half_search_start_date;
		
				
				$net_pay = ($pd_amount + $pd_bonus_amount + $no_work_allowance + $night_allowance_amount + $att_bouns + $holiday_allowance_amount)-($advance_deduct);
				
				$data["net_pay"] 	= $net_pay;
				$data["stamp"] 		= $stamp;
				$data["net"] 		= $net_pay - $stamp;
				
				$net_pay_com = $total_pd_amount_compliance + $att_bouns + $ot_amount_com - $stamp;
				
				$data_com["net_pay"] = $net_pay_com;
				
				
				//===================================Production info===================================
				//$process_start_date = $process_date['start_date'] ;
				//$process_end_date 	= $process_date['end_date'] ;
				//$production_info= $this->production_info_calculation($emp_id,$emp_sec_id,$process_start_date,$process_end_date);
				
				//$data["pd_info"] = $production_info;
				
				$body_id 		= 1;
				$neck_id 		= 2;
				$complet_id 	= 3;
				$remending_id 	= 4;
				$lbs_id 		= 5;
				$moon_id 		= 6;
				$placket_id 	= 7;
				
				$BODY = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$body_id);
				$NECK = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$neck_id);
				
				$COMPLET = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$complet_id);
				$REMENDING = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$remending_id);
				
				$LBS = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$lbs_id);
				$Moon = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$moon_id);
				$PLACKET = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$placket_id);
				
				if($BODY == "")
				{
					$BODY = 0;
				
				}
				if($NECK == "")
				{
					$NECK = 0;
				}
				if($COMPLET == "")
				{
					$COMPLET = 0;
				}
				if($REMENDING == "")
				{
					$REMENDING = 0;
				}
				if($LBS == "")
				{
					$LBS = 0;
				}
				if($Moon == "")
				{
					$Moon = 0;
				}
				if($PLACKET == "")
				{
					$PLACKET = 0;
				}
				//echo "===".$BODY;
				$data['body'] 		= $BODY;
				$data['neck'] 		= $NECK;
				$data['complet'] 	= $COMPLET;
				$data['remending'] 	= $REMENDING;
				$data['lbs'] 		= $LBS;
				$data['moon'] 		= $Moon;
				$data['placket'] 	= $PLACKET;
				
				
				
				$data_com['body'] 		= $BODY;
				$data_com['neck'] 		= $NECK;
				$data_com['complet'] 	= $COMPLET;
				$data_com['remending'] 	= $REMENDING;
				$data_com['lbs'] 		= $LBS;
				$data_com['moon'] 		= $Moon;
				$data_com['placket'] 	= $PLACKET;
				
				
				$this->db->select("emp_id");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("salary_month", $second_half_search_start_date);
				$query = $this->db->get("pd_pay_scale_sheet");
				if($query->num_rows() > 0 )
				{
					$this->db->where("emp_id",$emp_id);
					$this->db->where("salary_month", $second_half_search_start_date);
					$this->db->update("pd_pay_scale_sheet",$data);
				}
				else
				{
					$this->db->insert("pd_pay_scale_sheet",$data);
				}
				
				
				
				$this->db->select("emp_id");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("salary_month", $second_half_search_start_date);
				$query = $this->db->get("pd_pay_scale_sheet_com");
				if($query->num_rows() > 0 )
				{
					$this->db->where("emp_id",$emp_id);
					$this->db->where("salary_month", $second_half_search_start_date);
					$this->db->update("pd_pay_scale_sheet_com",$data_com);
				}
				else
				{
					$this->db->insert("pd_pay_scale_sheet_com",$data_com);
				}

			}
		}
		return "Process completed successfully";
		//echo $query;
	}
	
	function production_info_calculation($emp_id,$emp_sec_id,$process_start_date,$process_end_date)
	{
		$body_id 		= 1;
		$neck_id 		= 2;
		$complet_id 	= 3;
		$remending_id 	= 4;
		$lbs_id 		= 5;
		$moon_id 		= 6;
		$placket_id 	= 7;
		
		$BODY = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$body_id);
		$NECK = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$neck_id);
		
		$COMPLET = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$complet_id);
		$REMENDING = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$remending_id);
		
		$LBS = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$lbs_id);
		$Moon = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$moon_id);
		$PLACKET = $this->pd_salary_report_model->get_pd_info($emp_id,$emp_sec_id,$process_start_date,$process_end_date,$placket_id);
		
		$data['BODY'] 		= $BODY;
		$data['NECK'] 		= $NECK;
		$data['COMPLET'] 	= $COMPLET;
		$data['REMENDING'] 	= $REMENDING;
		$data['LBS'] 		= $LBS;
		$data['Moon'] 		= $Moont;
		$data['PLACKET'] 	= $PLACKET;
		
		return $data;
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
	function get_pd_amount_bonus($pd_amount,$pd_amount_bonus_percent)
	{
		return $pd_amount_bonus = round(($pd_amount * $pd_amount_bonus_percent)/100,2);
		
	}
	function get_pd_amount_bonus_percent($pd_amount)
	{
		//$pd_amount="";
		$this->db->select('bonus_percent');
		$this->db->from('pd_production_bonus_rules');
		$this->db->where('first_amount <=', $pd_amount);
		$this->db->where('second_amount >=', $pd_amount);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$row = $query->row();
			$bonus_percent = $row->bonus_percent;
		}
		else
		{
			$bonus_percent = 0;
		}
		return $bonus_percent;
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
	function get_no_work_day($emp_id,$process_start_date,$process_end_date)
	{
		$this->db->select('SUM(pd_no_work_check) AS pd_no_work_day');
		$this->db->from('pr_emp_shift_log');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$process_start_date' and '$process_end_date'");
		$query = $this->db->get();
		$row = $query->row();
		$pd_no_work_day = $row->pd_no_work_day;
		return $pd_no_work_day;
	}
	function get_no_work_allowance($emp_id,$process_start_date,$process_end_date)
	{
		$this->db->select('SUM(pd_no_work_check) AS pd_no_work_day');
		$this->db->from('pr_emp_shift_log');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("shift_log_date BETWEEN '$process_start_date' and '$process_end_date'");
		$query = $this->db->get();
		$row = $query->row();
		$pd_no_work_day = $row->pd_no_work_day;
		$amount= $this->common_model->get_setup_attributes(9);
		$no_work_allowance = $pd_no_work_day * $amount;
		return $no_work_allowance;
	}
	function get_weekend_days($weekend,$days,$start_date)
	{
	   $no_weekends = 0;
	   for($i=0;$i<$days + 1;$i++)
	   {
		   $date = strtotime(date("Y-m-d", strtotime($start_date)) . " +$i day");

		   $new_date = date("D",$date);

		   if($new_date == $weekend)
		   {
				 $no_weekends = $no_weekends +1;
		   }
	   }
	   return $no_weekends;
	}
	/*function get_pd_amount($emp_id,$second_half_search_start_date)
	{
		//$emp_id = "010011";
		$this->db->select_sum('amount');
		$this->db->where("emp_id", $emp_id);
		$this->db->where('month',$second_half_search_start_date);
		$query = $this->db->get('pd_production_summary_logs');
		
		$row = $query->row();
		$sum_pd_amount = $row->amount;
		if($sum_pd_amount == "")
		{
			$sum_pd_amount = 0;
		}
		return $sum_pd_amount;
	}*/
	function get_pd_amount($emp_id,$emp_sec_id,$process_start_date,$process_end_date)
	{
		$amount = 0;
		$this->db->select('SUM(quantity) AS total_quantity,process_id,article_id,section_id,size_id,section_id');
		$this->db->where('emp_id', $emp_id);
		$this->db->where('section_id', $emp_sec_id);
		$where = "date BETWEEN '$process_start_date' and '$process_end_date'";
		$this->db->where($where);
		$this->db->group_by("process_id");
		$this->db->group_by("article_id");
		$this->db->group_by("color_id");
		$this->db->group_by("size_id");
		$query = $this->db->get('pd_production_logs');
		
		
		foreach($query->result() as $style_summary)
		{
			$article_id 		= $style_summary->article_id;
			$section_id 		= $style_summary->section_id;
			$process_id 		= $style_summary->process_id;
			$size_id 			= $style_summary->size_id;
			$total_quantity 	= $style_summary->total_quantity;
			$unit_price 		= $this->emp_wise_entry_model->get_price($article_id,$section_id,$process_id,$size_id);
			$amount 			= $amount + ($unit_price*$total_quantity);
		}
		$pd_amount = round(($amount),2);
		return $pd_amount;
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
	function advance_loan_deduction($emp_id, $salary_month)
	{
		$search_year_month = $salary_month;
		$salary_month = "$salary_month-01";
				
		$this->db->select("*");
		$this->db->where("emp_id", $emp_id);
		$this->db->where("loan_status", '1');
		//$this->db->like("loan_date",$search_year_month);
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
	function get_late_count($emp_id,$process_start_date,$process_end_date)
	{
		$this->db->where("shift_log_date BETWEEN '$process_start_date' and '$process_end_date'");
		$this->db->where('emp_id', $emp_id);
		$this->db->where('late_status', '1');
		$this->db->from('pr_emp_shift_log');
		return  $this->db->count_all_results();
	
	}
	function deduction_hour_count($emp_id,$process_start_date,$process_end_date)
	{
		$this->db->select('SUM(deduction_hour) AS deduction_hour_count');	
		$this->db->where('emp_id', $emp_id);
		$this->db->where("shift_log_date BETWEEN '$process_start_date' and '$process_end_date'");
		$query = $this->db->get('pr_emp_shift_log');
		$row = $query->row();
		return $deduction_hour_count = $row->deduction_hour_count;
	}
	function left_check($emp_id, $process_start_date,$process_end_date)
	{
		$where = "left_date BETWEEN '$process_start_date' and '$process_end_date'";
		//$where = "trim(substr(resign_date,1,7)) = '$salary_month'";
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
			return $left_date;
		}	
	}
	function resign_check($emp_id, $process_start_date,$process_end_date)
	{
		$where = "resign_date BETWEEN '$process_start_date' and '$process_end_date'";
		//$where = "trim(substr(resign_date,1,7)) = '$salary_month'";
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
			return $resign_date;
		}	
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
	
	function attendance_check($emp_id,$present_status,$num_of_days, $start_date)
	{
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
	
	function attendance_check_first_half($emp_id,$present_status,$num_of_days, $start_date)
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
		$i=$loop_date;
		foreach($query->result_array() as $rows => $value)
		{
			
			for($j=1; $j<= $num_of_days ; $j++)
			{
				
				$idate = date("d", mktime(0, 0, 0, 0, $i, 0));
				$date="date_$idate";
				
				if($value[$date] == "$present_status")
				{
					$count++;
				}
				$i = $i + 1;
			}
		}
		return $count;
	}
	
	function get_no_of_days($start_date,$end_date)
	{
		$start = strtotime($start_date);
		$end = strtotime($end_date);
		$no_of_days = ceil(abs($end - $start) / 86400) + 1;
		return  $no_of_days;
	}
	function table_exists_check($table_name)
	{
		if(!$this->db->table_exists($table_name))
		{
			return "False";
		}
		else
		{
			return "True";
		}
	}
	function get_table_name($date)
	{
		$date = strtotime($date);
		$year = date('Y', $date);
		$month = date('m', $date);
		$table_name = "att_".$year."_".$month;
		return $table_name;
	}
		
	
}
?>
