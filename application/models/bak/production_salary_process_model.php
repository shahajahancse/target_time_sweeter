<?php
class Production_salary_process_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->model('pd_process_model');
		$this->load->model('salary_process_eligibility_model');
		$this->load->model('common_model');
	}
	
	function production_pay_sheet($year, $month)
	{
		
		// ==================Get Process Date=========================================
		$process_date 		= $this->pd_process_model->get_start_end_date($month,$year);
		$process_start_date = $process_date['start_date'] ;
		$process_end_date 	= $process_date['end_date'] ;
		
		// ==================Get Process Month (Needs for Join check)==================
		$process_start_month 	= date('Y-m', strtotime($process_start_date));
		$process_end_month 		= date('Y-m', strtotime($process_end_date));
		
		// ==================Get Table Name(att_2013_01)=============================
		$start_table_name 	= $this->get_table_name($process_start_date);
		$end_table_name 	= $this->get_table_name($process_end_date);
		
		//=====================Check Table Name (True Or False)=====================
		$start_table_validity 	= $this->table_exists_check($start_table_name);
		$end_table_validity 	= $this->table_exists_check($end_table_name);
		
		if($start_table_validity == "False" && $end_table_validity == "False")
		{
			return "Process month does not exist, please change your process month";
		}
		
		//======================Get No. of Days And Working Days  Between Process Dates==========
		$day_of_week=5; 
		$num_of_days = $this->get_no_of_days($process_start_date,$process_end_date);
		$no_working_days = $num_of_days - $day_of_week;
		
		
		//============================Get All Production Employee===============================
		$all_emp_id = $this->pd_process_model->get_all_pd_emp_id();
		foreach($all_emp_id->result() as $rows)
		{
			
			$salary_process_eligibility = $this->salary_process_eligibility_model->salary_process_eligibility($rows->emp_id,$process_start_date,$process_end_date);
			
				
			if($salary_process_eligibility == true)
			{ 
				$emp_id 		= $rows->emp_id; 
				$emp_desi_id 	= $rows->emp_desi_id; 
				$doj 			= $rows->emp_join_date;
				$gross_sal 		= $rows->gross_sal;
				$join_month		= date('Y-m', strtotime($doj));
				//==================================LOCAL Salary Rule===================================
				$salary_structure 		= $this->common_model->salary_structure($gross_sal);
				$conveyance 			= 0;
				$madical_allo 			= $salary_structure['medical_allow'];
				$madical_allo_payable 	= $madical_allo;
				$basic_sal 				= $salary_structure['basic_sal'];
				$basic_sal_payable 		= $basic_sal;
				$house_rent 			= $salary_structure['house_rent'];
				$house_rent_payable 	= $house_rent;
				
				$total_sal = $basic_sal + $house_rent + $madical_allo; 
				
				$data["basic_sal"] 		= $basic_sal;
				$data["house_r"] 		= $house_rent;
				$data["medical_a"] 		= $madical_allo;
				$data["gross_sal"] 		= $gross_sal;
				$data["total_days"] 	= $num_of_days;
				$data["num_of_workday"] = $no_working_days;
				
				//============Count No of Attendance And Leave For First Half of Salary Month============================
				//Declare Status======
				$absent_status 	= "A";
				$attend_status 	= "P";
				$weeked_status 	= "W";
				$holiday_status = "H";
				$cl_leave_type 	= "cl";
				$sl_leave_type 	= "sl";
				$el_leave_type 	= "el";
				$ml_leave_type 	= "ml";
				//First Half==========
				$first_half_absent 	= 0;
				$first_half_attend 	= 0;
				$first_half_weeked 	= 0;
				$first_half_holiday = 0;
				//Second Half==============
				$second_half_absent 	= 0;
				$second_half_attend 	= 0;
				$second_half_weeked 	= 0;
				$second_half_holiday    = 0;
				//========================Count No of Attendance For First Half of Salary Month============================
				if($start_table_validity == "True")
				{					
					$first_half_search_start_date		= $process_start_date;
					$first_half_search_end_date 		= date("Y-m-t", strtotime($process_start_date));
					//$first_half_no_of_days 				= date("t", strtotime($first_half_search_start_date));
					$first_half_no_of_days 				= $this->get_no_of_days($first_half_search_start_date,$first_half_search_end_date);
					//===========================First Half Attendance Count===========================================
					$first_half_absent 	= $this->attendance_check_first_half($emp_id,$absent_status,$first_half_no_of_days,$first_half_search_start_date);
					$first_half_attend 	= $this->attendance_check($emp_id,$attend_status,$first_half_no_of_days,$first_half_search_start_date);
					$first_half_weeked 	= $this->attendance_check($emp_id,$weeked_status,$first_half_no_of_days, $first_half_search_start_date);
					$first_half_holiday = $this->attendance_check($emp_id,$holiday_status,$first_half_no_of_days, $first_half_search_start_date);
				}
				
				//============Count No of Attendance For Second Half of Salary Month============================
				if($end_table_validity == "True")
				{
					$second_half_search_end_date		= $process_end_date;
					$second_half_search_start_date 		= date("Y-m-01", strtotime($process_end_date));
					//$second_half_no_of_days 			= date("t", strtotime($process_end_date));
					$second_half_no_of_days 			= $this->get_no_of_days($second_half_search_start_date,$second_half_search_end_date);
					//===========================Second Half Attendance Count===========================================
					$second_half_absent 	= $this->attendance_check($emp_id,$absent_status,$second_half_no_of_days,$second_half_search_start_date);
					$second_half_attend 	= $this->attendance_check($emp_id,$attend_status,$second_half_no_of_days,$second_half_search_start_date);
					$second_half_weeked 	= $this->attendance_check($emp_id,$weeked_status,$second_half_no_of_days, $second_half_search_start_date);
				}
				//==========================Total Attendance And Leave===================================
				$absent 		= $first_half_absent + $second_half_absent;
				$attend 		= $first_half_attend + $second_half_attend;
				$weeked 		= $first_half_weeked + $second_half_weeked;
				$holiday 		= $first_half_holiday + $second_half_holiday;
				$cas_leave 		= $this->leave_db($emp_id, $process_start_date, $process_end_date, $cl_leave_type);
				$sick_leave 	= $this->leave_db($emp_id, $process_start_date, $process_end_date, $sl_leave_type);
				$other_leave 	= $this->leave_db($emp_id, $process_start_date, $process_end_date, $el_leave_type);
				$m_leave 		= $this->leave_db($emp_id, $process_start_date, $process_end_date, $ml_leave_type);
				
				//=========================Calculate Payable Days=========================================
				$total_holiday 	= $weeked + $holiday;
				$total_leave 	= $cas_leave + $sick_leave + $other_leave + $m_leave;
				$pay_days 		= $attend + $total_holiday + $total_leave;
				//============================== Start Calculate Payable Basic Salary And Absent Deduction================================
				//=========================================================================================================================
				$resign_check 	= $this->resign_check($emp_id, $process_start_date,$process_end_date);
				$left_check 	= $this->left_check($emp_id, $process_start_date,$process_end_date);
				if($resign_check != false)
				{
					$resign_after_absent 			= $this->get_no_of_days($resign_check,$process_end_date);
					$data["before_after_absent"] 	= $resign_after_absent;
					
				}
				else if($process_start_month == $join_month || $process_end_month == $join_month )
				{
					$doj_before_absent 				= $this->get_no_of_days($process_start_date, $doj);					
					$data["before_after_absent"] 	= $doj_before_absent;
				}
				else if($left_check != false)
				{
					$resign_after_absent 			= $this->get_no_of_days($left_check,$doj);
					$data["before_after_absent"] 	= $resign_after_absent;
				}
				else
				{
					$data["before_after_absent"] 	= 0;
				}
				
				if($pay_days != 0)
				{
					if($process_start_month == $join_month or $process_end_month == $join_month or $resign_check != false or $left_check != false)
					{
						$before_after_deduct = ($gross_sal / $num_of_days) * $data["before_after_absent"];
						$deduct = $basic_sal / $num_of_days * $absent;
						$deduct = round($deduct + $before_after_deduct);
					}
					else
					{
						$deduct = $basic_sal / $num_of_days * $absent;
						$deduct = round($deduct);
					}
				}
				else
				{
					$deduct = $gross_sal;
				}
				$data["abs_deduction"] = $deduct;
				
				$payable_basic_sal_payable 		= ( (($basic_sal_payable / $num_of_days) * ($pay_days + $absent)) -  $deduct);
				//$payable_basic_sal_payable 		= (($basic_sal_payable / $num_of_days) * $pay_days  );
				$payable_house_rent_payable 	= (($house_rent_payable / $num_of_days) * ($pay_days + $absent)  );
				$payable_madical_allo_payable 	= (($madical_allo_payable / $num_of_days) * ($pay_days + $absent)  );
				
				$payable_basic_sal 		= round($payable_basic_sal_payable);
				$payable_house_rent 	= round($payable_house_rent_payable);
				$payable_madical_allo 	= round($payable_madical_allo_payable);
				//============================== End Calculate Payable Basic Salary And Absent Deduction================================
				
				//========================== Start Calculate Payable Total Salary=============================	
				if($pay_days != 0)
				{
					if($process_start_month == $join_month or $process_end_month == $join_month or $resign_check != false or $left_check != false)
					{
						if($num_of_days == $pay_days)
						{
							$payable_total_sal = $gross_sal;
						}
						else
						{
							$payable_total_sal = round($gross_sal - $deduct);
						}
					}
					else
					{
						if($num_of_days == $pay_days)
						{
							$payable_total_sal = $gross_sal;
						}
						else
						{
							$payable_total_sal = round($gross_sal - $deduct);
						}
					}
				}
				else
				{
					$payable_total_sal = 0;
				}
				$data["payable_basic"] = $payable_basic_sal;
				
				$data["payable_house_rent"] = $payable_house_rent;
				
				$data["payable_madical_allo"] = $payable_madical_allo;
				
				$payable_wages = $payable_total_sal;		
				$data["pay_wages"] = $payable_wages;
				//========================== End Calculate Payable Total Salary=============================
				
				//==========================Calculate Attendance Bonus============================
				$deduction_hour_count 	= $this->deduction_hour_count($emp_id,$process_start_date,$process_end_date);
				$late_count 			= $this->get_late_count($emp_id,$process_start_date,$process_end_date);
				$condition_late			= $this->common_model->get_setup_attributes('3');
				$att_bouns_present_day 	= $attend + $weeked;	
				$eligible_att_bonus_days = $num_of_days - $holiday;
							
				if($att_bouns_present_day == $eligible_att_bonus_days and $deduction_hour_count == 0)
				{
					
					if($late_count <= $condition_late)
					{
						$att_bouns = $this->att_bouns_cal($emp_id);
					}
					else
					{
						$att_bouns = 0;
					}
				}
				else
				{
					$att_bouns = 0;
				}
				
				$data["att_bonus"] = $att_bouns;
				
				//==========================Calculate Transport And Lunch Allowance============================
				//$transport = $this->transport_cal($emp_id);
				/*if($transport == true)
				{
					$trans_allaw = $attend * 20;
				}
				else
				{
					$trans_allaw = 0;
				}*/
				$trans_allaw = 0;
				$data["trans_allaw"] = $trans_allaw;
				
				//$lunch_allaw = $this->lunch_allaw_cal($emp_id);
				$lunch_allaw = 0;
				/*if($transport == true)
				{
					$lunch_allaw = $attend * 25;
				}
				else
				{
					$lunch_allaw = 0;
				}*/
				
				$data["lunch_allaw"] = $lunch_allaw;
				
				//$others_allaw = $this->others_allaw_cal($emp_id, $salary_month);
				$others_allaw = 0;
				$data["others_allaw"] = $others_allaw;
				
				$total_allaw = $att_bouns + $trans_allaw + $lunch_allaw + $others_allaw;
				$data["total_allaw"] = $total_allaw;
				//========================================= Over Time Calculation ==========================================
				$data["ot_hour"] = 0;
							
				$data["ot_rate"] = 0;
				
				//$ot_amount = round($ot_hour * $ot_rate);
				
				$data["ot_amount"] = 0;
				//========================================= Extra OT Calculation =============================================
				
				/*$eot_hour = $this->eot_hour($emp_id, $year_month);
				if($ot_hour == '')
				{
					$eot_hour = 0;
				}
				else
				{
					$eot_hour = $eot_hour;
				}*/
				$eot_hour = 0;
				$data["eot_hour"] = $eot_hour;
				$payable_amount = ($payable_wages + $total_allaw + $ot_amount);
				
				$data["gross_pay"] = $payable_amount;
				
				$advance_deduct = $this->advance_loan_deduction($emp_id, $process_end_month);
				$data["adv_deduct"] = $advance_deduct;
				//PROVIDENT FUNND CALCULATION
				$pf_status = $this->common_model->get_setup_attributes(6);
				if($pf_status == "Yes")
				{
					$check_bank_interest = $this->pf_model->check_bank_interest($start_date);
		
					if($check_bank_interest == false)
					{
						return 'Please insert Bank interest rate of this month for Provident Fund';
					}
					
					$provident_fund = $this->pf_model->provident_fund_calculation($emp_id, $start_date,$doj,$gross_sal,$basic_sal);
					
					$pf 						= $provident_fund["provident_fund"];
					$data["provident_fund"] 	= $provident_fund["provident_fund"];
					$data["pf_bank_interest"] 	= $provident_fund["bank_interest"];
					$data["company_pf"] 		= $provident_fund["company_pf"];
					$data["update_pf"] 			= $provident_fund["update_pf"];
					
				}
				else
				{
					$pf 						= 0;
					$data["provident_fund"] 	= $pf;
					$data["pf_bank_interest"] 	= 0;
					$data["company_pf"] 		= 0;
					$data["update_pf"] 			= 0;
				}
				
				//==================================OTHERS DEDUCTION====================================================
				/*$others_deduct = $this->others_deduct_cal($emp_id, $year_month);
				if($others_deduct == '')
				{
					$others_deduct = 0;
				}*/
				$others_deduct = 0;
				$data["others_deduct"] = $others_deduct;
				
				$total_deduct = $advance_deduct + $pf + $others_deduct;
				$data["total_deduct"] = $total_deduct;
				
				$pbt = $payable_amount - $total_deduct;
				$data["pbt"] = $pbt;
				
				/*$tax = $this->tax_deduct_cal($emp_id, $year_month);
				if($tax == '')
				{
					$tax = 0;
				}*/
				$tax = 0;
				$data["tax"] = $tax;
				
				$net_pay = $pbt - $tax;
				$data["salary_month"] = $second_half_search_start_date;
				
				if($deduct_status == "Yes")
				{
					//******deduct hour *****************************************************************
					$this->db->select('deduction_hour');
					//$this->db->where("trim(substr(shift_log_date,1,7)) = '$salary_month'");
					$this->db->where("shift_log_date BETWEEN '$process_start_date' and '$process_end_date'");
					$this->db->where("emp_id",$rows->emp_id);
					$query_ded = $this->db->get('pr_emp_shift_log');
					$total_deduction_hour = 0;
					foreach ($query_ded->result() as $row)
					{
						$deduction_hour = $row->deduction_hour;
						$total_deduction_hour = $total_deduction_hour + $deduction_hour;
					}
					$data["deduct_hour"] = $total_deduction_hour;
					
					//******End deduct hour ************************************************************************
					
					//************************deduct amount***************************************************** 
					$per_day_salary = $basic_sal/$num_of_days;
					$per_hour_salary = $per_day_salary /8;
					//echo $per_hour_salary;
					$deduct_amount = $per_hour_salary *$total_deduction_hour;
					$data["deduct_amount"] = round($deduct_amount);
					//************************end deduct amount***************************************************** 
				}
					//***************************Festival bonus***********************
				$effective_date = $this->get_bonus_effective_date($process_end_month);
				if($effective_date != false){ 
					$service_month = $this->common_model->get_service_month($effective_date,$doj);
					if($service_month >= 0)
					{
						//echo "$emp_id -'$doj' -  M: ".$service_month; echo '<br>';
						$festival_bonus_rule = $this->get_festival_bonus_rule($service_month);
						$festival_bonus = $this->get_festival_bonus($festival_bonus_rule,$gross_sal,$basic_sal);
						//if($emp_id == "AD0078")
						//{echo "$emp_id -'$doj' -  M: ".$service_month." B: $festival_bonus"; echo '<br>';}
					}
					else { $festival_bonus = 0; }
				}else{
					$festival_bonus = 0;
				}
				$data["festival_bonus"] = $festival_bonus;
				//***************************End of Festival bonus***********************
				//$net_pay = $net_pay + $festival_bonus;
				$data["net_pay"] = $net_pay;
				
				$this->db->select("emp_id");
				$this->db->where("emp_id", $emp_id);
				$this->db->where("salary_month", $process_end_month);
				$query = $this->db->get("pd_pay_scale_sheet");
				
				if($query->num_rows() > 0 )
				{
					$this->db->where("emp_id", $emp_id);
					$this->db->where("salary_month", $process_end_month);
					$this->db->update("pd_pay_scale_sheet",$data);
				}
				else
				{
					$this->db->insert("pd_pay_scale_sheet",$data);
				}

			}
			return "Process completed successfully";
		}
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