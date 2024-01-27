<?php
class Pd_report_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('pd_process_model');
	}
	
	
	function get_section_name($section_id)
	{
		$this->db->select('sec_name');
		$this->db->where('sec_id',$section_id);
		$query = $this->db->get("pr_section");
		$row = $query->row();
		if($query->num_rows() ==0)
		return false;
		else
		return $row->sec_name;
	}
	function get_process_name($process_id)
	{
		$this->db->select('process_name');
		$this->db->where('process_id',$process_id);
		$query = $this->db->get("pd_process_setups");
		$row = $query->row();
		if($query->num_rows() ==0)
		return false;
		else
		return $row->process_name;
	}
	function style_detail_report($article_id)
	{
		$this->db->select('*');
		$this->db->where('article_id',$article_id);
		return $query = $this->db->get('pd_style_infos');
	}
	function color_wise_report($article_id)
	{
		$this->db->select('*');
		$this->db->where('article_id',$article_id);
		return $query = $this->db->get('pd_color_wise_lots');
	}
	function get_size_by_colour($article_id,$color_id)
	{
		$this->db->select('*');
		$this->db->where('color_id',$color_id);
		$this->db->where('article_id',$article_id);
		return $query = $this->db->get('pd_size_wise_lots');
	}
	function get_buyer_name($buyer_id)
	{
		$this->db->select('buyer_name');
		$this->db->where('buyer_id',$buyer_id);
		$query = $this->db->get("pd_buyer_infos");
		$row = $query->row();
		if($query->num_rows() ==0)
		return false;
		else
		return $row->buyer_name;
	}
	function get_merchandiser_name($merchandiser_id)
	{
		$this->db->select('merchandiser_name');
		$this->db->where('merchandiser_id',$merchandiser_id);
		$query = $this->db->get("pd_merchandiser_infos");
		$row = $query->row();
		if($query->num_rows() ==0)
		return false;
		else
		return $row->merchandiser_name;
	}
	function get_gauge_name($gauge_id)
	{
		$this->db->select('gauge_name');
		$this->db->where('gauge_id',$gauge_id);
		$query = $this->db->get("pd_gauge_infos");
		$row = $query->row();
		if($query->num_rows() ==0)
		return false;
		else
		return $row->gauge_name;
	}
	function get_shipment_name($shipment_id)
	{
		$this->db->select('shipment_name');
		$this->db->where('shipment_id',$shipment_id);
		$query = $this->db->get("pd_shipment_modes");
		$row = $query->row();
		if($query->num_rows() ==0)
		return false;
		else
		return $row->shipment_name;
	}
	function get_payment_name($payment_id)
	{
		$this->db->select('payment_name');
		$this->db->where('payment_id',$payment_id);
		$query = $this->db->get("pd_payment_modes");
		$row = $query->row();
		if($query->num_rows() ==0)
		return false;
		else
		return $row->payment_name;
	}
	function get_size_name($size_id)
	{
		$this->db->select('size_name');
		$this->db->where('size_id',$size_id);
		$query = $this->db->get("pd_size_infos");
		$row = $query->row();
		if($query->num_rows() ==0)
		return false;
		else
		return $row->size_name;
	}
	function get_color_name($color_id)
	{
		$this->db->select('color_name');
		$this->db->where('color_id',$color_id);
		$query = $this->db->get("pd_color_infos");
		$row = $query->row();
		if($query->num_rows() ==0)
		return false;
		else
		return $row->color_name;
	}
	
	function daily_total_quantity($date,$article_id,$section_id)
	{
		$this->db->select_sum('quantity');
		$this->db->where('section_id',$section_id);
		$this->db->where('date',$date);
		$this->db->where('article_id',$article_id);
		$query=$this->db->get('pd_production_logs');
		$row = $query->row();
		$result = $row->quantity;
		if($result == "")
		{
			return 0;
		}
		else
		{
			return $result;
		}
	}
	
	function section_total_quantity($article_id,$section_id)
	{
		$this->db->select_sum('quantity');
		$this->db->where('section_id',$section_id);
		$this->db->where('article_id',$article_id);
		$query=$this->db->get('pd_production_logs');
		$row = $query->row();
		$result = $row->quantity;
		if($result == "")
		{
			return 0;
		}
		else
		{
			return $result;
		}

	}
	function production_job_card($grid_firstdate, $grid_seconddate, $grid_emp_id)
	{
		$sStartDate = date("Y-m-d", strtotime($grid_firstdate)); 
		$sEndDate = date("Y-m-d", strtotime($grid_seconddate));
				
		$data = array();
		
		$this->db->select('emp_id');
		$this->db->from('pr_emp_com_info');
		$this->db->where_in('emp_id', $grid_emp_id);
		$this->db->order_by("emp_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		foreach($grid_emp_id as $emp_id)
		{
			//echo $emp_id = $row;
			//echo "$emp_id<br>";
			
			$this->db->distinct();
			$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name,pr_dept.dept_name,pr_section.sec_name,pr_section.sec_id,pr_line_num.line_name,pr_emp_com_info.emp_join_date,pr_id_proxi.proxi_id,pr_emp_position.posi_name');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_attn_monthly');
			$this->db->from('pr_id_proxi');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_designation');
			$this->db->from('pr_emp_position');
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_id_proxi.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_emp_com_info.emp_position_id = pr_emp_position.posi_id');
			$this->db->where('pr_emp_per_info.emp_id', $emp_id);
			
			$query = $this->db->get();
			foreach($query->result() as $row)
			{
				$data["emp_id"][] = $emp_id;
				
				$data["emp_full_name"][] = $row->emp_full_name;
				
				$data["proxi_id"][] = $row->proxi_id;
				
				$data["sec_name"][] = $row->sec_name;
				
				$section_id = $row->sec_id;
				$data["sec_id"][] = $row->sec_id;
				
				$data["line_name"][] = $row->line_name;
				
				$data["desig_name"][] = $row->desig_name;
				$data["posi_name"][] = $row->posi_name;
				
				$emp_join_date = $row->emp_join_date;
				
				$emp_join_date = date('d-M-Y', strtotime($emp_join_date));
				$data["emp_join_date"][] = $emp_join_date;
				
				$data["dept_name"][] = $row->dept_name;
				$this->db->select('SUM(quantity) AS quantity,process_id,article_id,section_id,color_id,size_id,date AS day');
				$this->db->where('emp_id', $emp_id);
			
				$this->db->where("pd_production_logs.date BETWEEN '$sStartDate' and '$sEndDate'");
				$this->db->group_by("process_id");
				$this->db->group_by("article_id");
				$this->db->group_by("color_id");
				$this->db->group_by("size_id");
				$this->db->group_by("date");
				$query = $this->db->get('pd_production_logs');
				foreach($query->result() as $rows)
				{
					
					$data[$emp_id]["date"][] 	= $rows->day;
					$data[$emp_id]["article_id"][] = $rows->article_id;
					$data[$emp_id]["process_id"][] = $rows->process_id;
					$data[$emp_id]["color_id"][] = $rows->color_id;
					$data[$emp_id]["size_id"][] = $rows->size_id;
					$data[$emp_id]["quantity"][] = $rows->quantity;
				}
				
			}
		}
		//print_r($data);
		return $data;
		
	}
	function get_pd_qty($emp_id,$day)
	{
		//$emp_id = "010011";
		//echo $day;
		$year_month = date('Y-m', strtotime($day));
		$this->db->select_sum('total_quantity');
		$this->db->where('emp_id', $emp_id);
		$this->db->like('month',$year_month);
		$query = $this->db->get('pd_production_summary_logs');
		
		$row = $query->row();
		$sum_pd_quantity = $row->total_quantity;
		if($sum_pd_quantity == "")
		{
			$sum_pd_quantity = 0;
		}
		return $sum_pd_quantity;
	}
	
	function daily_production_summary($grid_firstdate, $grid_section)
	{
		$year_month_day = date('Y-m-d', strtotime($grid_firstdate));
		$data['date'] = date('M-d-Y', strtotime($grid_firstdate));
		
		$data['section_name'] = $this->get_section_name($grid_section);
		$this->db->select('SUM(quantity) AS quantity,process_id,article_id,section_id,color_id');
		$this->db->where('section_id', $grid_section);
		$this->db->where('date',$year_month_day);
		//$this->db->group_by('article_id');
		//$this->db->group_by('process_id');
		$this->db->group_by('color_id');
		$query_style = $this->db->get('pd_production_logs');
		$query_style_num_rows = $query_style->num_rows();
		
		if($query_style_num_rows > 0)
		{
		
		  foreach($query_style->result() as $row)
		  {
			  $article_id 	= $row->article_id;
			  $process_id 	= $row->process_id;
			  $color_id 	= $row->color_id;
			  $quantity 	= $row->quantity;
			  $color_name 	= $this->get_color_name($color_id);
			  $process_name	= $this->get_process_name($process_id);
			  $results 		= $this->style_detail_report($article_id);
			  $style_info 	= $results->row();
			  $style_id 	= $style_info->style_id;
			  $buyer_id 	= $style_info->buyer_id;
			  $order_qty 	= $style_info->total_quantity;
			  $buyer_name = $this->get_buyer_name($buyer_id);
			  
			  $qty_complete = $this->get_qty_complete_by_color($article_id,$process_id,$color_id,$grid_section);
			  
			  
			  $data['buyer_name'][] 	= $buyer_name;
			  $data['style_id'][] 		= $style_id;
			  $data['order_qty'][] 		= $order_qty;
			  $data['article_id'][] 	= $article_id;
			  $data['process_name'][] 	= $process_name;
			  $data['color_name'][] 	= $color_name;
			  $data['quantity'][] 		= $quantity;
			  $data['qty_complete'][] 	= $qty_complete;
			  $data['balance'][] 		= $order_qty - $qty_complete;
			  
		  }
		  //print_r($data);
		  return $data;
		}
		else
		{
			 return "empty";
		}
	}
	function get_qty_complete_by_color($article_id,$process_id,$color_id,$grid_section)
	{
		
		$this->db->select_sum('total_quantity');
		$this->db->where('section_id', $grid_section);
		$this->db->where('article_id', $article_id);
		//$this->db->where('process_id', $process_id);
		$this->db->where('color_id', $color_id);
		$query = $this->db->get('pd_production_summary_logs');
		
		$row = $query->row();
		$sum_pd_quantity = $row->total_quantity;
		if($sum_pd_quantity == "")
		{
			$sum_pd_quantity = 0;
		}
		return $sum_pd_quantity;
		
	}
	
	function production_summary()
	{
	
		//=====Collect Buyer Wise Style Information========
		$this->db->select('*');
		$query_style = $this->db->get('pd_style_infos');
		foreach($query_style->result() as $row)
		{
			$data['article_id'][] 		= $row->article_id;
			$byuer_name = $this->get_buyer_name($row->buyer_id);
			$gauge_name = $this->get_gauge_name($row->gauge_id);
			
			$data['byuer_name'][] 		= $byuer_name;
			$data['style_id'][]	 		= $row->style_id;
			$data['order_number'][]		= $row->order_number;
			$data['gauge_name'][]		= $gauge_name;
			$data['shipment_date'][]	= $row->shipment_date;
			$total_quantity 			= $row->total_quantity;
			$data['total_quantity'][] 	= $total_quantity;
			$five_percent_qty 			= ($total_quantity*5)/100;
			
			$data['five_percent_plus_qty'][] 	= $five_percent_qty + $total_quantity;
			
			$qty_complete_for_kinit = $this->get_qty_complete($row->article_id,1);
			$data['qty_complete_for_kinit'][] 	= $qty_complete_for_kinit;
			
			$qty_complete_for_linking = $this->get_qty_complete($row->article_id,2);
			$data['qty_complete_for_linking'][] 	= $qty_complete_for_linking;
			
		}
		
		//print_r($data);
		return $data;
		
	}
	function get_qty_complete($article_id,$sec_id)
	{
		
		$this->db->select_sum('total_quantity');
		$this->db->where('article_id', $article_id);
		$query = $this->db->get('pd_production_summary_logs');
		
		$row = $query->row();
		$sum_pd_quantity = $row->total_quantity;
		if($sum_pd_quantity == "")
		{
			$sum_pd_quantity = 0;
		}
		return $sum_pd_quantity;
		
	}
	function production_monthly_salary_summary($grid_firstdate)
	{
		$year_month = date('Y-m', strtotime($grid_firstdate));
		
		$section = array(1,2,3,4,5);
		$total_basic_sal = 0;
		$total_pd_amount = 0;
		$total_pd_bonus_amount = 0;
		$total_holiday_allowance = 0;
		$total_night_allowance = 0;
		$total_none_work_allowance = 0;
		$total_att_bonus = 0;
		$total_others_allaw = 0;
		$total_gross_sal = 0;
		$total_adv_deduct = 0;
		$total_abs_deduction = 0;
		$total_others_deduct = 0;
		$total_gross_sal = 0;
		$total_adv_deduct = 0;
		$total_net_pay =0;
		$total_man_power = 0;
		foreach($section as $section_id)
		{
			
			$data['section_id'][] = $section_id;
			
			$data['section_name'][] = $this->get_section_name($section_id);
			
			//get Basic amount
			$column_name = "basic_sal";
			$basic_sal = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['basic_sal'][] = $basic_sal;
			$total_basic_sal = $total_basic_sal + $basic_sal;
			
			//get Production amount
			$column_name = "pd_amount";
			$pd_amount= $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['pd_amount'][] = $pd_amount;
			$total_pd_amount = $total_pd_amount + $pd_amount;
			
			//get Production Bonus
			$column_name = "pd_bonus_amount";
			$pd_bonus_amount = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['pd_bonus_amount'][] = $pd_bonus_amount;
			$total_pd_bonus_amount = $total_pd_bonus_amount + $pd_bonus_amount;
			
			//get Holiday Bonus
			$column_name = "holiday_allowance";
			$holiday_allowance = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['holiday_allowance'][] = $holiday_allowance;
			$total_holiday_allowance = $total_holiday_allowance + $holiday_allowance;
			
			//get Night Bonus
			$column_name = "night_allowance";
			$night_allowance = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['night_allowance'][] = $night_allowance;
			$total_night_allowance = $total_night_allowance + $night_allowance;
			
			//get None Work Bonus
			$column_name = "none_work_allowance";
			$none_work_allowance = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['none_work_allowance'][] = $none_work_allowance;
			$total_none_work_allowance = $total_none_work_allowance + $none_work_allowance;
			
			//get Attendance Bonus
			$column_name = "att_bonus";
			$att_bonus= $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['att_bonus'][] = $att_bonus;
			$total_att_bonus = $total_att_bonus + $att_bonus;
			
			//get Other Bonus
			$column_name = "others_allaw";
			$others_allaw = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['others_allaw'][] = $others_allaw;
			$total_others_allaw = $total_others_allaw + $others_allaw;
			
			//get Gross Salary
			$column_name = "gross_sal";
			$gross_sal = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['gross_sal'][] = $gross_sal;
			$total_gross_sal = $total_gross_sal + $gross_sal;
			
			//get Night Bonus
			$column_name = "adv_deduct";
			$adv_deduct = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['adv_deduct'][] = $adv_deduct;
			$total_adv_deduct = $total_adv_deduct + $adv_deduct;
			
			//get None Work Bonus
			$column_name = "abs_deduction";
			$abs_deduction = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['abs_deduction'][] = $abs_deduction;
			$total_abs_deduction= $total_abs_deduction + $abs_deduction;
			
			//get Attendance Bonus
			$column_name = "others_deduct";
			$others_deduct = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['others_deduct'][] = $others_deduct;
			$total_others_deduct= $total_others_deduct + $others_deduct;
			
			//get Net Pay 
			$column_name = "net_pay";
			$net_pay = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			$data['net_pay'][] = $net_pay;
			$total_net_pay = $total_net_pay + $net_pay;
			
			//get Man Power
			$man_power = $this->db->where('sec_id',$section_id)->like('salary_month',$year_month)->get('pd_pay_scale_sheet')->num_rows();
			$data['man_power'][] = $man_power;
			$total_man_power = $total_man_power + $man_power;
			
		}
		
		$data['total_basic_sal'] 			= $total_basic_sal;
		$data['total_pd_amount'] 			= $total_pd_amount;
		$data['total_pd_bonus_amount'] 		= $total_pd_bonus_amount;
		$data['total_holiday_allowance'] 	= $total_holiday_allowance;
		$data['total_night_allowance'] 		= $total_night_allowance;
		$data['total_none_work_allowance'] 	= $total_none_work_allowance;
		$data['total_att_bonus'] 			= $total_att_bonus;
		$data['total_others_allaw'] 		= $total_others_allaw;
		$data['total_gross_sal'] 			= $total_gross_sal;
		$data['total_adv_deduct'] 			= $total_adv_deduct;
		$data['total_abs_deduction'] 		= $total_abs_deduction;
		$data['total_others_deduct'] 		= $total_others_deduct;
		$data['total_net_pay'] 				= $total_net_pay;
		$data['total_man_power'] 			= $total_man_power;
		//print_r($data);
		return $data;
		
	}
	function production_monthly_cost_sheet($grid_firstdate)
	{
		$year_month = date('Y-m', strtotime($grid_firstdate));
		$prev_year_month = strtotime ( '-1 month' , strtotime ( $grid_firstdate ) ) ;
		$prev_year_month = date ( 'Y-m' , $prev_year_month );
		
		$fixed_section = $this->get_section(1);
		$pd_section = $this->get_section(2);
		$data['year_month'] = $year_month;
		$data['prev_year_month'] = $prev_year_month;
		//echo $fixed_section;
		if($fixed_section !=0)
		{
		  foreach($fixed_section as $section_id)
		  {
			  
			 $data['fx_section_id'][] = $section_id;
			  
			  $data['fx_section_name'][] = $this->get_section_name($section_id);
			  // echo $section_id ;
			  //get Man Power of current month
			  $fx_man_power = $this->db->where('sec_id',$section_id)->like('salary_month',$year_month)->get('pr_pay_scale_sheet')->num_rows();
			  $data['fx_man_power'][] = $fx_man_power;
			  
			  //get Man Power of Previous month
			  $fx_man_power_pm = $this->db->where('sec_id',$section_id)->like('salary_month',$prev_year_month)->get('pr_pay_scale_sheet')->num_rows();
			  $data['fx_man_power_pm'][] = $fx_man_power_pm;
			  
			  //get ADVance Loan
			  $column_name = "adv_deduct";
			  $fx_adv_deduct = $this->get_fixed_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			  $data['fx_adv_deduct'][] = $fx_adv_deduct;
			  
			  //get ADVance Loan Previous month
			  $column_name = "adv_deduct";
			  $fx_adv_deduct_pm = $this->get_fixed_section_wise_cost_sheet_data($prev_year_month,$section_id,$column_name );
			  $data['fx_adv_deduct_pm'][] = $fx_adv_deduct_pm;
			  
			  //get Net Pay 
			  $column_name = "net_pay";
			  $fx_net_pay = $this->get_fixed_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			  $data['fx_net_pay'][] = $fx_net_pay;
			  
			  //get Net Pay Previous month
			  $column_name = "net_pay";
			  $fx_net_pay_pm = $this->get_fixed_section_wise_cost_sheet_data($prev_year_month,$section_id,$column_name );
			  $data['fx_net_pay_pm'][] = $fx_net_pay_pm;
			  
		  }
		  $data['fx_section_null'] = 1;
		}
		else
		{
			$data['fx_section_null'] =0;
		}
		
		if($pd_section !=0)
		{
		  foreach($pd_section as $section_id)
		  {
			  
			  $data['pd_section_id'][] = $section_id;
			  
			  $data['pd_section_name'][] = $this->get_section_name($section_id);
			  // echo $section_id ;
			  //get Man Power of current month
			  $pd_man_power = $this->db->where('sec_id',$section_id)->like('salary_month',$year_month)->get('pd_pay_scale_sheet')->num_rows();
			  $data['pd_man_power'][] = $pd_man_power;
			  
			  //get Man Power of Previous month
			  $pd_man_power_pm = $this->db->where('sec_id',$section_id)->like('salary_month',$prev_year_month)->get('pd_pay_scale_sheet')->num_rows();
			  $data['pd_man_power_pm'][] = $pd_man_power_pm;
			  
			  //get ADVance Loan
			  $column_name = "adv_deduct";
			  $pd_adv_deduct = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			  $data['pd_adv_deduct'][] = $pd_adv_deduct;
			  
			  //get ADVance Loan Previous month
			  $column_name = "adv_deduct";
			  $pd_adv_deduct_pm = $this->get_section_wise_cost_sheet_data($prev_year_month,$section_id,$column_name );
			  $data['pd_adv_deduct_pm'][] = $pd_adv_deduct_pm;
			  
			  //get Production amount
			  $column_name = "pd_amount";
			  $pd_amount= $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			  $data['pd_amount'][] = $pd_amount;
			  
			  //get Production amount Previous month
			  $column_name = "pd_amount";
			  $pd_amount_pm= $this->get_section_wise_cost_sheet_data($prev_year_month,$section_id,$column_name );
			  $data['pd_amount_pm'][] = $pd_amount_pm;
			  
			  //get Net Pay 
			  $column_name = "net_pay";
			  $pd_net_pay = $this->get_section_wise_cost_sheet_data($year_month,$section_id,$column_name );
			  $data['pd_net_pay'][] = $pd_net_pay;
			  
			  //get Net Pay Previous month
			  $column_name = "net_pay";
			  $pd_net_pay_pm = $this->get_section_wise_cost_sheet_data($prev_year_month,$section_id,$column_name );
			  $data['pd_net_pay_pm'][] = $pd_net_pay_pm;
			  
			  
			  
		  }
		  $data['pd_section_null'] = 1;
		}
		else
		{
			$data['pd_section_null'] = 0;
		}
		//print_r($data);
		return $data;
		
	}

	
	function get_section($salary_type)
	{
		$this->db->select('emp_sec_id');
		$this->db->where('salary_type',$salary_type);
		$this->db->group_by('emp_sec_id');
		$query = $this->db->get('pr_emp_com_info');
		if($query->num_rows > 0)
		{
		  foreach($query->result() as $rows)
		  {
			  $section_id[] = $rows->emp_sec_id;
		  }
		}
		else
		{
			$section_id = 0;
		}
		return $section_id;
		
	}
	function get_fixed_section_wise_cost_sheet_data($year_month,$section_id,$column_name )
	{
		$this->db->select_sum($column_name);
		$this->db->where('sec_id', $section_id);
		$this->db->like('salary_month',$year_month);
		$query = $this->db->get('pr_pay_scale_sheet');
		
		$row = $query->row();
		$sum = $row->$column_name;
		if($sum == "")
		{
			$sum = 0;
		}
		return $sum;
		
	}
	
	function get_section_wise_cost_sheet_data($year_month,$section_id,$column_name )
	{
		$this->db->select_sum($column_name);
		$this->db->where('sec_id', $section_id);
		$this->db->like('salary_month',$year_month);
		$query = $this->db->get('pd_pay_scale_sheet');
		
		$row = $query->row();
		$sum = $row->$column_name;
		if($sum == "")
		{
			$sum = 0;
		}
		return $sum;
		
	}
	
	function grid_production_wages_card($sal_year_month,$grid_emp_id)
	{
		//echo $sal_year_month;
		$year_month = date('Y-m', strtotime($sal_year_month));
		$data['year'] = date('Y', strtotime($sal_year_month));
		$data['month'] = date('F', strtotime($sal_year_month));
		$year = date('Y', strtotime($sal_year_month));
		$month = date('m', strtotime($sal_year_month));
		
		$process_date 		= $this->pd_process_model->get_start_end_date($month,$year);
		 $process_start_date = $process_date['start_date'] ;
		$process_end_date 	= $process_date['end_date'] ;
		
		foreach($grid_emp_id as $emp_id)
		{
			
			$this->db->select('pr_emp_com_info.emp_sec_id,pr_emp_per_info.emp_full_name, pr_designation.desig_name,pr_dept.dept_name, pr_section.sec_name, pr_line_num.line_name, pr_emp_position.posi_name,pd_pay_scale_sheet.*');
			$this->db->from('pr_emp_per_info');
			$this->db->from('pr_emp_com_info');
			$this->db->from('pr_designation');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_emp_position');
			$this->db->from('pd_pay_scale_sheet');
			$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
			$this->db->where('pr_emp_com_info.emp_position_id = pr_emp_position.posi_id');
			$this->db->where("pr_emp_per_info.emp_id = '$emp_id'");
			$this->db->where("pr_emp_per_info.emp_id = pd_pay_scale_sheet.emp_id");
			$this->db->like('salary_month', $sal_year_month);
			$company_info = $this->db->get();
			
			$num_rows = $company_info->num_rows();
			if($num_rows < 1)
			{
				return "Requested List is Empty.";
			}
			$com_info 				= $company_info->row();
			$section_name 			= $com_info->sec_name;
			$emp_sec_id 			= $com_info->emp_sec_id;
			$posi_name		 		= $com_info->posi_name;
			$desig_name 			= $com_info->desig_name;
			$line_name	 			= $com_info->line_name;
			$emp_full_name 			= $com_info->emp_full_name;
			$pd_amount 				= $com_info->pd_amount;
			$pd_bonus_amount 		= $com_info->pd_bonus_amount;
			$att_bonus 				= $com_info->att_bonus;
			$none_work_allowance 	= $com_info->none_work_allowance;
			$holiday_allowance 		= $com_info->holiday_allowance;
			$night_allowance 		= $com_info->night_allowance;
			$others_allaw 			= $com_info->others_allaw;
			$net_pay 				= $com_info->net_pay;
			   
			
			$data['emp_id'][] 				= $emp_id;
			$data['section_name'][] 		= $section_name;
			$data['line_name'][]			= $line_name;
			$data['posi_name'][]			= $posi_name;
			$data['desig_name'] []			= $desig_name;
			$data['emp_full_name'][] 		= $emp_full_name;
			
			$data['pd_amount'][] 			= $pd_amount;
			$data['pd_bonus_amount'][]		= $pd_bonus_amount;
			$data['att_bonus'][]			= $att_bonus;
			$data['none_work_allowance'][]	= $none_work_allowance;
			$data['holiday_allowance'][] 	= $holiday_allowance;
			$data['night_allowance'][]		= $night_allowance;
			$data['others_allaw'][]			= $others_allaw;
			$data['net_pay'][] 				= $net_pay;
			
			$this->db->select('SUM(total_quantity) AS total_quantity,process_id,article_id,section_id,unit_price,SUM(amount) AS amount');
			$this->db->where('emp_id', $emp_id);
			$this->db->where('section_id', $emp_sec_id);
			$this->db->like('month', $sal_year_month);
			$this->db->group_by('article_id');
			$this->db->group_by('process_id');
			$query = $this->db->get('pd_production_summary_logs');
			$data[$emp_id]['count_style_summary'] = $query->num_rows();
			//echo $this->db->last_query();
			foreach($query->result() as $style_summary)
			{
				$article_id 		= $style_summary->article_id;
				$process_id 		= $style_summary->process_id;
				$process_name		= $this->get_process_name($process_id);
				$total_quantity 	= $style_summary->total_quantity;
				$unit_price 		= $style_summary->unit_price;
				$amount	 			= $style_summary->amount;
				
				$data[$emp_id]['article_id'][] 		= $article_id;
				$data[$emp_id]['process_id'][] 		= $process_name;
				$data[$emp_id]['total_quantity'][] 	= $total_quantity;
				$data[$emp_id]['unit_price'][] 		= $unit_price;
				$data[$emp_id]['amount'][] 			= $amount;
				
			}
			
			
			
			
		$this->db->select('SUM(quantity) AS quantity,process_id,article_id,color_id, date as day,size_id');
		$this->db->where('emp_id', $emp_id);
		$this->db->where('section_id', $emp_sec_id);
		//$this->db->like('date', $year_month);
		$where = "trim(date BETWEEN '$process_start_date' and '$process_end_date'";
		$this->db->group_by("process_id");
		$this->db->group_by("article_id");
		$this->db->group_by("color_id");
		$this->db->group_by("size_id");
		$query_style = $this->db->get('pd_production_logs');
		
		//echo $this->db->last_query();
		
		$data[$emp_id]['count_r_color'] = $query_style->num_rows();
		
		  foreach($query_style->result() as $row)
		  {
			  $article_id 	= $row->article_id;
			  $process_id 	= $row->process_id;
			  $color_id 	= $row->color_id;
			  $size_id 		= $row->size_id;
			  $quantity 	= $row->quantity;
			  $date 		= $row->day;
			  $color_name 	= $this->get_color_name($color_id);
			  $process_name	= $this->get_process_name($process_id);
			  $results 		= $this->style_detail_report($article_id);
			  $style_info 	= $results->row();
			  $style_id 	= $style_info->style_id;
			  $buyer_id 	= $style_info->buyer_id;
			  $order_qty 	= $style_info->total_quantity;
			  $buyer_name = $this->get_buyer_name($buyer_id);
			  
			  $unit_price = $this->db->where("article_id",$article_id)->where("process_id",$process_id)->where("section_id",$emp_sec_id)->where("size_id",$size_id)->get('pd_article_wise_process_prices')->row()->price;
			  
			  $data[$emp_id]['date'][] 			= $date;
			  $data[$emp_id]['r_buyer_name'][] 	= $buyer_name;
			  $data[$emp_id]['r_style_id'][] 	= $style_id;
			  $data[$emp_id]['r_article_id'][] 	= $article_id;
			  $data[$emp_id]['r_process_name'][]= $process_name;
			  $data[$emp_id]['r_color_name'][] 	= $color_name;
			  $data[$emp_id]['r_quantity'][] 	= $quantity;
			  $data[$emp_id]['r_unit_price'][] 	= $unit_price;
		  }
		}
		//print_r($data);
		return $data;
	}
	function production_monthly_attn_register($year_month, $grid_emp_id)
	{
		$year= trim(substr($year_month,0,4));
		$month = trim(substr($year_month,5,2));
		$att_month = "att_".$year."_".$month;
		$this->db->select('pr_emp_per_info.emp_full_name,pr_designation.desig_name,pd_manual_attandence.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pd_manual_attandence');
			$this->db->from('pr_dept');
			$this->db->from('pr_section');
			$this->db->from('pr_line_num');
			$this->db->from('pr_designation');
			$this->db->or_where_in("pr_emp_per_info.emp_id", $grid_emp_id);
			$this->db->like("pd_manual_attandence.date",$year_month);
			$this->db->where('pr_emp_com_info.emp_desi_id = pr_designation.desig_id');
			$this->db->where('pr_emp_com_info.emp_dept_id = pr_dept.dept_id');
			$this->db->where('pr_emp_com_info.emp_sec_id = pr_section.sec_id');
			$this->db->where('pr_emp_com_info.emp_line_id = pr_line_num.line_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pd_manual_attandence.emp_id');
		$this->db->order_by("pr_emp_com_info.emp_id");
		$this->db->group_by('pd_manual_attandence.emp_id');
		$query = $this->db->get();	
		//echo $this->db->last_query();
		if($query->num_rows > 0)
		{	
			return $query;
		}
		else
		{
			return "Soryy! Requested list is empty";
		}
	}
	function get_pd_pay_scale_sheet($emp_id,$sal_year_month)
	{
		$this->db->select('*');
		$this->db->where('emp_id', $emp_id);
		$this->db->like('salary_month', $sal_year_month);
		return $query = $this->db->get('pd_pay_scale_sheet');
		
	}
	
	function get_company_info($emp_id)
	{
		$this->db->select('*');
		$this->db->where('emp_id',$emp_id);
		return $query = $this->db->get('pr_emp_com_info');
	
	}
	function get_personal_info($emp_id)
	{
		$this->db->select('*');
		$this->db->where('emp_id',$emp_id);
		return $query = $this->db->get('pr_emp_per_info');
	
	}
		
	function GetDays($sStartDate, $sEndDate)
	{  
       	$sStartDate = date("Y-m-d", strtotime($sStartDate)); 
		$sEndDate = date("Y-m-d", strtotime($sEndDate)); 
		  
        // Start the variable off with the start date  
    	$aDays[] = $sStartDate;  
    
    	// Set a 'temp' variable, sCurrentDate, with  
    	// the start date - before beginning the loop  
    	$sCurrentDate = $sStartDate;  
    
		// While the current date is less than the end date  
    	while($sCurrentDate < $sEndDate)
		{  
       		// Add a day to the current date  
       		$sCurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  
     
       		// Add this new day to the aDays array  
        		$aDays[] = $sCurrentDate; 
			//print_r($aDays);
     	}  
     // Once the loop has finished, return the  
     return $aDays;  
   }
}