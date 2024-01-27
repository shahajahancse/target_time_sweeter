<?php
class Common_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
	}
	
	function salary_structure($gross_salary)
	{
		$data = array();
		
		/*$data['medical_allow'] = 200;
		$data['gross_salary']  = $gross_salary;
		$data['basic_sal'] 	   = round(($gross_salary - $data['medical_allow']) / 1.4);
		$data['house_rent']    = round($data['basic_sal'] * 40 / 100);
		$data['ot_rate']       = round(($data['basic_sal'] * 2  / 208),2);*/
		
		//New Salary Structure By Tarek On 03-10-16
		
		$data['medical_allow'] = 200;
		$data['gross_salary']  = $gross_salary;
		$data['basic_sal'] 	   = round(($gross_salary - 1100) / 1.4);
		$data['house_rent']    = round($gross_salary - 1100 - $data['basic_sal']);
		$data['ot_rate']       = round(($data['basic_sal'] * 2  / 208),2);
		
		return $data;
	}
	
	function salary_structure_fixed_com($gross_salary)
	{
		$data = array();
		
		$data['medical_allow'] 	= 250;
		$data['trans_allow'] 	= 200;
		$data['food_allow'] 	= 650;
		$total_salary_allow 	= $data['medical_allow'] + $data['trans_allow'] + $data['food_allow'];
		$data['gross_salary'] 	= $gross_salary;
		
		$data['basic_sal'] 	   = round(($gross_salary - $total_salary_allow) / 1.4);
		$data['house_rent']    = round($data['basic_sal'] * 40 / 100);
		$data['ot_rate']       = round(($data['basic_sal'] * 2  / 208),2);
		return $data;
	}
	
	function get_setup_attributes($setup_id)
	{
		$this->db->select('value');
		$this->db->where("id",$setup_id);
		$query = $this->db->get('pr_setup');
		$rows = $query->row();
		$setup_value = $rows ->value;
		return $setup_value;
	}
	
	//CreatedBy: Zuel & Ismail, At: 11-02-18
	function get_ultimate_salary($value, $salary_month, $grid_status)
	{ 
		$date = $salary_month;
		$sal_year=trim(substr($date,0,4));
		$sal_month=trim(substr($date,5,2));
		$day=trim(substr($date,8,2));
		// $date_format = date("F-Y", mktime(0, 0, 0, $sal_month, $day, $sal_year));
		 
		$row_count=count($value);
		if($row_count >8)
		{
			$page=ceil($row_count/8);
		}
		else
		{
			$page=1;
		}

		$k = 0;

		$Gtotal_gross_salary = 0;
		$Gtotal_basic_salary = 0;
		$basic = 0;
		$house_rent = 0;
		$medical_all = 0;
		$gross_sal = 0;
		$abs_deduct = 0;
		$payable_basic = 0;
		$payable_house_rent =0;
		$payable_madical_allo =0;
		$pay_wages = 0;
		$grand_total_att_bonus =0;
		$grand_total_net_wages_after_deduction = 0;
		$grand_total_net_wages_with_ot = 0;
		$trans_allaw = 0;
		$lunch_allaw =0;
		$others_allaw = 0;
		$total_allaw =0;
		$pd_amount =0;
		$pd_bonus_percent =0;
		$ot_amount =0;
		$gross_pay =0;
		$adv_deduct =0;
		$provident_fund =0;
		$others_deduct =0;
		$total_deduct =0;
		$pbt =0;
		$tax =0;
		$net_pay =0;
		$baftera_deduct = 0;
		$total_pay_amount = 0;
		$transpot_allowance_all = 0;
		$food_allowance_all = 0;
			
        //Total Count Again
		$total_mday = 0;
		$Gtotal_mday = 0;
		$total_wday = 0;
		$Gtotal_wday = 0;
		$total_offday = 0;
		$Gtotal_offday = 0;
		$total_absday = 0;
		$Gtotal_absday = 0;
		$total_baabsday = 0;
		$Gtotal_baabsday = 0;
		$total_clday = 0;
		$Gtotal_clday = 0;
		$total_slday = 0;
		$Gtotal_slday = 0;
		$total_payday = 0;
		$Gtotal_payday = 0;
		$total_subsidiary = 0;
		$Gtotal_subsidiary = 0;
		$total_otamount = 0;
		$Gtotal_otamount = 0;
		$total_nday = 0;
		$Gtotal_nday = 0;
		$total_fhday = 0;
		$Gtotal_fhday = 0;
		$total_nowday = 0;
		$Gtotal_nowday = 0;
	    
		$stam_value = 10;
		$total_stam_value = 0;
		$grand_total_advance_salary = 0;
		$grand_total_lunch_deduction_hour = 0;
		$grand_total_lunch_deduction_amount = 0;
		$grand_total_absent_deduction = 0;
		$grand_total_stamp_deduction = 0;
		$grand_total_net_wages_without_ot = 0;
		$grand_total_pd_amount = 0;
		$grand_total_ot_amount = 0;
		$grand_total_pb_amount = 0;
		$grand_total_night_amount = 0;
		$grand_total_friday_amount = 0;
		$grand_total_nw_amount = 0;
		
		$grand_total_info_first 	= 0;
		$grand_total_info_second 	= 0;
		$grand_total_info_third 	= 0;
		$grand_total_info_forth 	= 0;
		$grand_total_info_fifth 	= 0;
			
		$Gtotal_transpot_allowance_all = 0;
        $Gtotal_food_allowance_all = 0;
		$gtotal_pay_amount = 0;
		
		$totalnet = 0;

		for ($counter = 1; $counter <= $page; $counter ++)
		{

			$date = date('d-m-Y');

			$section_name = $value[0]->sec_name;

			$date = $salary_month;
			$sal_year=trim(substr($date,0,4));
			$sal_month=trim(substr($date,5,2));
			$day=trim(substr($date,8,2));
			$date_format = date("F-Y", mktime(0, 0, 0, $sal_month, $day, $sal_year));

			if($counter == $page)
		  	{
		   		$modulus = ($row_count-1) % 8;
		    	$per_page_row=$modulus;
			}
		   	else
		   	{
		    	$per_page_row=7;
		   	}
	
			$per_page_gross_salary = 0;
			$per_page_basic_salary = 0;
		  	
		   	$total_pay_wages	= 0;
			$total_pd_amounts   	= 0;
			$total_ot_amount  	= 0;
			$total_att_bonus	= 0;
			$total_gross_pays	= 0;
			$total_net_pays		= 0;
			$total_net_wages_after_deduction = 0;
			$total_net_wages_with_ot = 0;
	
			//Total Count Again Per Page
			$total_mday = 0;
			$total_wday = 0;
			$total_offday = 0;
			$total_absday = 0;
			$total_baabsday = 0;
			$total_clday = 0;
			$total_slday = 0;
			$total_payday = 0;
			$total_subsidiary = 0;
			$total_otamount = 0;
			$total_nday = 0;
			$total_fhday = 0;
			$total_nowday = 0;
	
			$total_basic_sal_per_page = 0;
			$total_advance_per_page = 0;
			$lunch_deduction_hour_per_page = 0;
			$lunch_deduction_amount_per_page = 0;
			$total_absent_deduction_per_page = 0;
			$total_stamp_deduction_per_page = 0;
			$total_net_wages_without_ot_per_page = 0;
			$total_pd_amount_per_page = 0;
			$total_pd_bonus_per_page = 0;
			$total_ot_amount_per_page = 0;
			$total_night_amount_per_page=0;
			$total_friday_amount_per_page = 0;
			$total_nw_amount_per_page = 0;
			$GTbaftera_deduct = 0;
			
			$total_info_first 	= 0;
			$total_info_second 	= 0;
			$total_info_third 	= 0;
			$total_info_forth 	= 0;
			$total_info_fifth 	= 0;
			
			$transpot_allowance_all = 0;
			$food_allowance_all = 0;
			$total_pay_amount = 0;
	
			for($p=0; $p<=$per_page_row;$p++)
			{
				if($grid_status == 4)
				{
					$resign_date = $this->grid_model->get_resign_date_by_empid($value[$k]->emp_id);
					if($resign_date != false){
						$resign_date = date('d-M-y', strtotime($resign_date));}
				}
				elseif($grid_status == 3)
				{
					$left_date = $this->grid_model->get_left_date_by_empid($value[$k]->emp_id);
					if($left_date != false){
						$left_date = date('d-M-y', strtotime($left_date));}
				}

				$date = $value[$k]->emp_join_date;
				$year=trim(substr($date,0,4));
				$month=trim(substr($date,5,2));
				$day=trim(substr($date,8,2));
				$date_format = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
				$date_format;
				$per_page_gross_salary = $per_page_gross_salary + $value[$k]->gross_sal;
				$total_days = $value[$k]->total_days;
				$total_days - $value[$k]->before_after_absent_days;
				$total_mday = $total_mday + $total_days;
				$total_wday = $total_wday + $value[$k]->att_days;
				$weekend = $value[$k]->weeked;
				$total_offday = $total_offday + $weekend;
				$holidy = $value[$k]->holidy;
				$total_leave = $value[$k]->c_l + $value[$k]->s_l; 
				
				$total_clday = $total_clday + $value[$k]->c_l;
				$total_slday = $total_slday + $value[$k]->s_l;
				$t_abs = $value[$k]->absent_days + $value[$k]->before_after_absent_days;
				$total_days = $value[$k]->total_days - $t_abs;

			
				$per_page_basic_salary = $per_page_basic_salary + $value[$k]->basic_sal;
				$house_rent = $house_rent + $value[$k]->house_r;
				$medical_allowance = 250;
				$medical_all = $medical_all + $medical_allowance;
				$transpot_allowance = 200;
				$transpot_allowance_all = $transpot_allowance_all + $transpot_allowance;
				$food_allowance = 650;
				$food_allowance_all = $food_allowance_all + $food_allowance;
				
				$abs_deduct = $value[$k]->abs_deduction;
				$ababs_deduct = $value[$k]->before_after_absent_amount;

				$abs_deduct = $abs_deduct + $ababs_deduct;

				$adv_deduct = $adv_deduct + $value[$k]->adv_deduct; 
				$total_advance_per_page = $total_advance_per_page + $value[$k]->adv_deduct;
				$grand_total_advance_salary = $grand_total_advance_salary + $value[$k]->adv_deduct;
				
				$gross_salary = $value[$k]->net_pay;
					
				$pay_wages 		= $value[$k]->pay_wages; 
				$adv_deduct 	= $value[$k]->adv_deduct;
				$att_bonus 		= $value[$k]->att_bonus;
				$deduct_amount 	= $value[$k]->deduct_amount;
						
				$total_att_bonus = $total_att_bonus + $att_bonus;
				$grand_total_att_bonus = $grand_total_att_bonus + $att_bonus;		
		
				$stam_value = $value[$k]->stamp;
					
				$net_wages_after_deduction = $value[$k]->gross_sal - ( $abs_deduct + $adv_deduct + $deduct_amount);
			
				$total_stam_value = $total_stam_value + $stam_value;
				
				$total_net_wages_without_ot_per_page= $total_net_wages_without_ot_per_page +  $net_wages_after_deduction;
				$grand_total_net_wages_without_ot 	= $grand_total_net_wages_without_ot +  $net_wages_after_deduction;
				
				$total_stamp_deduction_per_page = $total_stamp_deduction_per_page + $stam_value;
				$grand_total_stamp_deduction 	= $grand_total_stamp_deduction + $stam_value;
				$basic_now = $value[$k]->basic_sal;
				$gross_now = $value[$k]->gross_sal;
				$Gtotal_gross_salary = $Gtotal_gross_salary + $gross_now;
				$Gtotal_basic_salary = $Gtotal_basic_salary + $basic_now;
				$others_deduct = $others_deduct + $value[$k]->others_deduct; 
			
				$total_net_wages_after_deduction = $total_net_wages_after_deduction + $net_wages_after_deduction;
				$grand_total_net_wages_after_deduction = $grand_total_net_wages_after_deduction + $net_wages_after_deduction;
				
				$total_nowday = $total_nowday + $value[$k]->none_work_day;
				$pd_amount = $value[$k]->pd_amount;// +  $value[$k]->epd_amount; 
		
				$total_pd_amount_per_page = $total_pd_amount_per_page + $pd_amount; 
				$grand_total_pd_amount = $grand_total_pd_amount + $pd_amount; 
				
				$pd_bonus_percent = $pd_bonus_percent + $value[$k]->pd_bonus_percent; 
		
				$ot_amount = round($pd_amount * $value[$k]->pd_bonus_percent);
				
				if(($pd_amount + $value[$k]->none_work_allowance+$value[$k]->holiday_allowance) < $net_wages_after_deduction)
				{
				 $subsidary = $net_wages_after_deduction - ($pd_amount + $value[$k]->none_work_allowance+$value[$k]->holiday_allowance);
				 $total_subsidiary = $total_subsidiary + $subsidary;
				}
				else
				{
				 $subsidary = 0;
				}
		
				$total_otamount = $total_otamount + $value[$k]->ot_hour;
		
				$ot_amount_trk =$value[$k]->ot_amount;
		
				$total_ot_amount = $total_ot_amount + $value[$k]->ot_amount;
				$grand_total_ot_amount = $grand_total_ot_amount + $value[$k]->ot_amount;

				$total_nday = $total_nday + $value[$k]->night_allowance_no;
		
				$total_night_amount_per_page = $total_night_amount_per_page + $value[$k]->night_allowance;
		
				$total_fhday = $total_fhday + $value[$k]->holiday_allowance_no;

				$total_friday_amount_per_page = $total_friday_amount_per_page + $value[$k]->holiday_allowance;
				$total_nw_amount_per_page = $total_nw_amount_per_page+$value[$k]->none_work_allowance;
				$total_ot_amount_per_page = $total_ot_amount_per_page + $ot_amount;
				$total_pd_bonus_per_page = $total_pd_bonus_per_page  + $value[$k]->pd_bonus_amount;
				
				$Gtotal_mday = $Gtotal_mday + $value[$k]->total_days;
				$Gtotal_wday = $Gtotal_wday + $value[$k]->att_days;
				$Gtotal_offday = $Gtotal_offday + $weekend;
				$Gtotal_absday  = $Gtotal_absday + $value[$k]->absent_days;
				$Gtotal_baabsday = $Gtotal_baabsday + $value[$k]->before_after_absent_days;
				$Gtotal_clday = $Gtotal_clday + $value[$k]->c_l;
				$Gtotal_slday = $Gtotal_slday + $value[$k]->s_l;
				$Gtotal_payday = $Gtotal_payday + $value[$k]->pay_days;
				$Gtotal_subsidiary = $Gtotal_subsidiary + $subsidary;
				$Gtotal_otamount = $Gtotal_otamount + $value[$k]->ot_hour;
				$Gtotal_nday = $Gtotal_nday + $value[$k]->night_allowance_no;
				$Gtotal_fhday = $Gtotal_fhday + $value[$k]->holiday_allowance_no;
				$Gtotal_nowday = $Gtotal_nowday + $value[$k]->none_work_day;
				$GTbaftera_deduct = $GTbaftera_deduct+$baftera_deduct;
				$grand_total_pb_amount = $grand_total_pb_amount + $value[$k]->pd_bonus_amount;
				$grand_total_night_amount = $grand_total_night_amount + $value[$k]->night_allowance;
				$grand_total_friday_amount = $grand_total_friday_amount + $value[$k]->holiday_allowance;
				$grand_total_nw_amount = $grand_total_nw_amount + $value[$k]->none_work_allowance;
				$ot_amount_only = $ot_amount;
				$net_wages_with_ot = $net_wages_after_deduction + $ot_amount_only;
				
				$Gtotal_transpot_allowance_all = $Gtotal_transpot_allowance_all + $transpot_allowance;
				$Gtotal_food_allowance_all = $Gtotal_food_allowance_all + $food_allowance;
				
				$total_amount = ($subsidary + $ot_amount_trk + $pd_amount  + $att_bonus + $value[$k]->pd_bonus_amount+$value[$k]->night_allowance+$value[$k]->holiday_allowance+$value[$k]->none_work_allowance);
				$total_pay_amount = $total_pay_amount + $total_amount;
				$gtotal_pay_amount = $gtotal_pay_amount + $total_amount;
				$stam_value = $value[$k]->stamp;
				$total_pay = ($subsidary + $ot_amount_trk + $pd_amount  + $att_bonus + $value[$k]->pd_bonus_amount+$value[$k]->night_allowance+$value[$k]->holiday_allowance+$value[$k]->none_work_allowance) - $stam_value;
		
				$total_net_wages_with_ot = $total_net_wages_with_ot + $total_pay;
				$grand_total_net_wages_with_ot = $grand_total_net_wages_with_ot + $total_pay;

				$k++;
	 		}
	 	}
	 	return $grand_total_net_wages_with_ot;
	}
	//end get_ultimate_salary function
	
	function allowance_bills($id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->where("id",$id);
		$query = $this->db->get('pr_allowance_bills');
		foreach($query->result() as $rows)
		{
			$data['first_tiffin_allo_min'] = $rows ->first_tiffin_allo_min;
			$data['second_tiffin_allo_min'] = $rows ->second_tiffin_allo_min;
			$data['night_allo_min'] = $rows ->night_allo_min;
			$data['first_tiffin_allo_amount'] = $rows ->tiffin_allo_amount;
			$data['second_tiffin_allo_amount'] = $rows ->tiffin_allo_amount;
			$data['night_allo_amount'] = $rows ->night_allo_amount;
			//echo $rows ->first_tiffin_allo_min;
		}
		
		return $data;
	}
	
	function get_ot_title($emp_id)
	{
		$this->db->select('ot_entitle');
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get('pr_emp_com_info');
		$row = $query->row();
		return $row->ot_entitle;
	}
	
	function get_service_month($effective_date,$doj)
	{
		$date_diff 		= strtotime($effective_date)-strtotime($doj);
		//DATE TO DATE RULE
		//return $month 	= floor(($date_diff)/2592000);
		
		//MONTH TO MONTH RULE
		return $month 	= ceil(($date_diff)/2628000);
	}
	
	function get_gross_salary($emp_id)
	{
		$this->db->select('gross_sal');
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get('pr_emp_com_info');
		$row = $query->row();
		return $row->gross_sal;
	}
	
	function company_information($select_value)
	{
		$query 	= $this->db->select($select_value)->get('company_infos');
		$row 	= $query->row();
		return $row->$select_value;
	}
	
	//PRODUCTION RELATED METHODS GOES HERE...
	function check_article_id_existance($article_id_pk)
	{
		$this->db->select('article_id_pk');
		$this->db->where('article_id_pk',$article_id_pk);
		$query = $this->db->get('pd_style_infos');
		if($query->num_rows() > 0){ return true;}else{ return false;}
	}
	
	function color_wise_lot_duplicate_entry_check($article_id, $color_id)
	{
		$this->db->select('article_id');
		$this->db->where('article_id',$article_id);
		$this->db->where('color_id',$color_id);
		$query = $this->db->get('pd_color_wise_lots');
		if($query->num_rows() > 0){ return false;}else{ return true;}
	}
	
	function color_fixed_for_article_check($article_id, $color_id)
	{
		$this->db->select('article_id');
		$this->db->where('article_id',$article_id);
		$this->db->where('color_id',$color_id);
		$query = $this->db->get('pd_color_wise_lots');
		if($query->num_rows() > 0){ return false;}else{ return true;}
	}
	
	function get_color_id_by_pk($primary_key)
	{
		$this->db->select('color_id');
		$this->db->where('id',$primary_key);
		$query = $this->db->get('pd_color_wise_lots');
		if($query->num_rows() > 0){ return $color_id = $query->row()->color_id;}else{ return false;}
	}
	
	function get_section_name($sec_id)
	{
		$this->db->select('sec_name');
		$this->db->where('sec_id',$sec_id);
		$query = $this->db->get(' pr_section');
		if($query->num_rows() > 0){ return $sec_name = $query->row()->sec_name;}else{ return false;}
	}
	
	function get_position_name($posi_id)
	{
		$this->db->select('posi_name');
		$this->db->where('posi_id',$posi_id);
		$query = $this->db->get('pr_emp_position');
		if($query->num_rows() > 0){ return $posi_name = $query->row()->posi_name;}else{ return false;}
	}
	
	function get_line_name($line_id)
	{
		$this->db->select('line_name');
		$this->db->where('line_id',$line_id);
		$query = $this->db->get('pr_line_num');
		if($query->num_rows() > 0){ return $line_name = $query->row()->line_name;}else{ return false;}
	}
	
	function get_size_id_by_pk_for_size_wise($primary_key)
	{
		$this->db->select('size_id');
		$this->db->where('id',$primary_key);
		$query = $this->db->get('pd_size_wise_lots');
		if($query->num_rows() > 0){ return $size_id = $query->row()->size_id;}else{ return false;}
	}
	
	function size_wise_lot_existance_check($article_id, $color_id, $size_id)
	{
		$this->db->select('article_id');
		$this->db->where('article_id',$article_id);
		$this->db->where('color_id',$color_id);
		$this->db->where('size_id',$size_id);
		$query = $this->db->get('pd_size_wise_lots');
		if($query->num_rows() > 0){ return false;}else{ return true;}
	}
	function  get_prev_month($probation_period,$year_month)
	{	
		//$probation_period = $probation_period -1;
		
		$text ="-".$probation_period."month";
		$prev_month = strtotime($text, strtotime($year_month));
		$prev_month = date("Y-m", $prev_month);
		return $prev_month;
	}
	function get_left_emp($salary_month)
	{
		$i = 1;
		$this->db->select('pr_emp_left_history.emp_id');
		$this->db->from('pr_emp_left_history');
		$this->db->where("trim(substr(pr_emp_left_history.left_date,1,7)) <= '$salary_month'");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
			  
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = 0  ;
		}
	}
	function get_resign_emp($salary_month)
	{
		$i = 1;
		$this->db->select('pr_emp_resign_history.*');
		$this->db->from('pr_emp_resign_history');
		$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) <= '$salary_month'");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
			  
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = 0  ;
		}
	}
	function get_all_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$position,$salary_month,$salary_type)
	{
		$sal_year_month = "$salary_month-01";
		$i = 1;
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pd_pay_scale_sheet');
		$this->db->where('pr_emp_per_info.emp_id = pd_pay_scale_sheet.emp_id');
		$this->db->where("pd_pay_scale_sheet.salary_month = '$sal_year_month'");
		if($dept !="Select")
		{
			$this->db->where("pd_pay_scale_sheet.dept_id", $dept);
		}
		if($section !="Select")
		{
			$this->db->where("pd_pay_scale_sheet.sec_id", $section);
		}
		if($line !="Select")
		{
			$this->db->where("pd_pay_scale_sheet.block_id ", $line);
		}
		if($desig !="Select")
		{
			$this->db->where("pd_pay_scale_sheet.desig_id", $desig);
		}
		if($position !="Select")
		{
			$this->db->where("pd_pay_scale_sheet.floor_id", $position);
		}
		if($sex !="Select")
		{
			$this->db->where("pd_pay_scale_sheet.emp_sex", $sex);
		}
		if($status !="ALL" )
		{
			$this->db->where("pd_pay_scale_sheet.status_id", $status);
		}
		if($salary_type !="Select" )
		{
			$this->db->where("pd_pay_scale_sheet.sal_type", $salary_type);
		}
		$this->db->order_by('pr_emp_per_info.emp_id');
		$query = $this->db->get();
		//echo $query->num_rows();
		return $query;
	}
	
	
	function get_all_employee_for_selection_for_fixed($dept,$section,$line,$desig,$sex,$status,$position,$salary_month,$salary_type)
	{
		//$get_left_emp = $this->get_left_emp_all_sts($salary_month);
		//$get_resign_emp = $this->get_resign_emp_all_sts($salary_month);
		$sal_year_month = "$salary_month-01";
		$i = 1;
		$this->db->select('pr_emp_per_info.*');
		//$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_pay_scale_sheet');
		//$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_pay_scale_sheet.emp_id');
		$this->db->where("pr_pay_scale_sheet.salary_month = '$sal_year_month'");
		if($dept !="Select")
		{
			$this->db->where("pr_pay_scale_sheet.dept_id", $dept);
		}
		if($section !="Select")
		{
			$this->db->where("pr_pay_scale_sheet.sec_id", $section);
		}
		if($line !="Select")
		{
			$this->db->where("pr_pay_scale_sheet.block_id ", $line);
		}
		if($desig !="Select")
		{
			$this->db->where("pr_pay_scale_sheet.desig_id", $desig);
		}
		if($position !="Select")
		{
			$this->db->where("pr_pay_scale_sheet.floor_id", $position);
		}
		if($sex !="Select")
		{
			$this->db->where("pr_pay_scale_sheet.emp_sex", $sex);
		}
		if($status !="ALL" )
		{
			$this->db->where("pr_pay_scale_sheet.status_id", $status);
		}
		if($salary_type !="Select" )
		{
			$this->db->where("pr_pay_scale_sheet.sal_type", $salary_type);
		}
		$this->db->order_by('pr_emp_per_info.emp_id');
		$query = $this->db->get();
		//echo $query->num_rows();
		return $query;
	}
	
	
	function get_new_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$position,$salary_month)
	{
		$probation_period 	= $this->get_setup_attributes(10);
		$prev_prob_month 	= $this->get_prev_month($probation_period,$salary_month);
		$get_left_emp 		= $this->get_left_emp($salary_month);
		$get_resign_emp 	= $this->get_resign_emp($salary_month);
		$i = 1;
		
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		if($dept !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_dept_id", $dept);
		}
		if($section !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_sec_id", $section);
		}
		if($line !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_line_id ", $line);
		}
		if($desig !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_desi_id", $desig);
		}
		if($position !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_position_id", $position);
		}
		if($sex !="Select")
		{
			$this->db->where("pr_emp_per_info.emp_sex", $sex);
		}
		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) <= '$salary_month'");
		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) >= '$prev_prob_month'");
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_left_emp);
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_resign_emp);
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query;
		/*echo $this->db->last_query();
		foreach ($query->result() as $row)
		{
			$emp_id = $row->emp_id;
			echo "$i .$emp_id<br>";
			$i = $i + 1;
		}*/
	}
	function get_regular_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$position,$salary_month)
	{
		$probation_period 	= $this->get_setup_attributes(10);
		$prev_prob_month 	= $this->get_prev_month($probation_period,$salary_month);
		$get_left_emp 		= $this->get_left_emp($salary_month);
		$get_resign_emp 	= $this->get_resign_emp($salary_month);
		$sal_year_month = "$salary_month-01";
		$i = 1;
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pd_pay_scale_sheet');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pd_pay_scale_sheet.emp_id');
		$this->db->where("pd_pay_scale_sheet.salary_month = '$sal_year_month'");
		if($dept !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_dept_id", $dept);
		}
		if($section !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_sec_id", $section);
		}
		if($line !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_line_id ", $line);
		}
		if($desig !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_desi_id", $desig);
		}
		if($position !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_position_id", $position);
		}
		if($sex !="Select")
		{
			$this->db->where("pr_emp_per_info.emp_sex", $sex);
		}
		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) < '$prev_prob_month'");
		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) <= '$salary_month'");
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_left_emp);
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_resign_emp);
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		//echo $query->num_rows();
		return $query;
		/*foreach ($query->result() as $row)
		{
			$emp_id[] = $row->emp_id;
			//echo "$i .$emp_id<br>";
			//$i = $i + 1;
		}
		return $emp_id;*/
	}
	
	function get_left_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$position,$salary_month)
	{
		//echo $salary_month;
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_left_history');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_left_history.emp_id');
		if($dept !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_dept_id", $dept);
		}
		if($section !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_sec_id", $section);
		}
		if($line !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_line_id ", $line);
		}
		if($desig !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_desi_id", $desig);
		}
		if($position !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_position_id", $position);
		}
		if($sex !="Select")
		{
			$this->db->where("pr_emp_per_info.emp_sex", $sex);
		}
		$this->db->where("trim(substr(pr_emp_left_history.left_date,1,7)) = '$salary_month'");
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query;
		/*echo $this->db->last_query();
		foreach ($query->result() as $row)
		{
			$emp_id = $row->emp_id;
			echo "$i .$emp_id<br>";
			$i = $i + 1;
		}*/
	}
	
	function get_resign_employee_for_selection($dept,$section,$line,$desig,$sex,$status,$position,$salary_month)
	{
		
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_resign_history');
		$this->db->from('pr_emp_per_info');
		$this->db->from('pr_emp_com_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_resign_history.emp_id');
		if($dept !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_dept_id", $dept);
		}
		if($section !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_sec_id", $section);
		}
		if($line !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_line_id ", $line);
		}
		if($desig !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_desi_id", $desig);
		}
		if($position !="Select")
		{
			$this->db->where("pr_emp_com_info.emp_position_id", $position);
		}
		if($sex !="Select")
		{
			$this->db->where("pr_emp_per_info.emp_sex", $sex);
		}
		$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) = '$salary_month'");
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query;
		/*echo $this->db->last_query();
		foreach ($query->result() as $row)
		{
			$emp_id = $row->emp_id;
			echo "$i .$emp_id<br>";
			$i = $i + 1;
		}*/
	}
	
	
	
	
	//================================== Below Code Written For ALL Status=============================
	//=================================================================================================
	function get_all_employee($salary_month)

	{
		$get_left_emp = $this->get_left_emp_all_sts($salary_month);
		$get_resign_emp = $this->get_resign_emp_all_sts($salary_month);
		//print_r($get_resign_emp);
		$i = 1;
		$this->db->select('pr_emp_per_info.*');
		$this->db->from('pr_emp_com_info');
		$this->db->from('pr_emp_per_info');
		$this->db->where('pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->where("trim(substr(pr_emp_com_info.emp_join_date,1,7)) <= '$salary_month'");
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_left_emp);
		$this->db->where_not_in('pr_emp_com_info.emp_id',$get_resign_emp);
		$this->db->order_by('pr_emp_com_info.emp_id');
		$query = $this->db->get();
		return $query;
		/*foreach ($query->result() as $row)
		{
			$emp_id[] = $row->emp_id;
			//echo "$i .$emp_id<br>";
			//$i = $i + 1;
		}
		return $emp_id;*/
	}
	function get_left_emp_all_sts($salary_month)
	{
		$i = 1;
		$this->db->select('pr_emp_left_history.emp_id');
		$this->db->from('pr_emp_left_history');
		$this->db->where("trim(substr(pr_emp_left_history.left_date,1,7)) < '$salary_month'");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
			  
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = 0  ;
		}
	}
	function get_resign_emp_all_sts($salary_month)
	{
		$emp_id = array();
		$i = 1;
		$this->db->select('pr_emp_resign_history.*');
		$this->db->from('pr_emp_resign_history');
		$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) < '$salary_month'");
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
			  
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = 0  ;
		}
		
	}
	
	//================================== END Code Written For ALL Status===============================
	//=================================================================================================
	
	function get_left_emp_continuous($grid_firstdate,$grid_seconddate)
	{
		$i = 1;
		$this->db->select('pr_emp_left_history.emp_id');
		$this->db->from('pr_emp_left_history');
		$where = "left_date < '$grid_firstdate'";
		//$this->db->where("trim(pr_emp_left_history.left_date)) <= '$salary_month'");
		$this->db->where($where);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
			  
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = '' ;
		}
	}
	function get_resign_emp_continuous($grid_firstdate,$grid_seconddate)
	{
		$i = 1;
		$this->db->select('pr_emp_resign_history.*');
		$this->db->from('pr_emp_resign_history');
		//$this->db->where("trim(substr(pr_emp_resign_history.resign_date,1,7)) <= '$salary_month'");
		$where = "resign_date <'$grid_firstdate'";
		$this->db->where($where);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
		  foreach ($query->result() as $row)
		  {
			  $emp_id[] = $row->emp_id;
			  //echo "$i .$row->emp_id<br>";
			  //$i = $i + 1;
			  
		  }
		  return $emp_id ;
		}
		else
		{
			return $emp_id[] = ''  ;
		}
	}
}
?>