<?php
class Pd_process_model extends CI_Model{
	
	
	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
	}
	public function get_start_end_date($month,$year)
	{
		$process_start_date = $this->get_setup('process_start_date');
		$process_close_date = $this->get_setup('process_close_date');
		$data['start_date'] =date("Y-m-d", strtotime("-1 month", strtotime(date("Y-m-d", mktime(0, 0, 0, $month, $process_start_date, $year)))));
		$data['end_date'] = date("Y-m-d", mktime(0, 0, 0, $month, $process_close_date, $year));
		return $data;
	}
	function get_all_pd_emp_id()
	{
		$this->db->select('*');
		$this->db->from('pr_emp_com_info');
		$this->db->where("pr_emp_com_info.emp_id", "01001");
		$this->db->where("pr_emp_com_info.salary_type", 2);
		$this->db->order_by("pr_emp_com_info.emp_id");
		return $query = $this->db->get();
	}
	function insert_into_pd_sum_logs($emp_id,$start_date,$end_date)
	{
		$this->db->select('SUM(quantity) AS total_quantity,process_id,article_id,section_id');
		$this->db->from('pd_production_logs');
		$this->db->where("emp_id", $emp_id);
		$this->db->where("pd_production_logs.date BETWEEN '$start_date' and '$end_date'");
		$this->db->group_by("process_id");
		$this->db->group_by("article_id");
		$this->db->group_by("section_id");
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query->num_rows() != 0)
		{
			//echo $this->db->last_query();
		$row = $query->row();
		$first_y=trim(substr($end_date,0,4));
		$first_m=trim(substr($end_date,5,2));
		$first_d=01;
		$month = date("Y-m-d", mktime(0, 0, 0, $first_m, $first_d, $first_y));
		$unit_price = $this->get_price($row->article_id,$row->section_id,$row->process_id);
		$section = $this->get_section_name($row->section_id);
		$process = $this->get_process_name($row->process_id);
		if($unit_price == false)
		{
			echo "Please Set Article: $row->article_id, Section: $section, Process : $process";
			exit;
		}
		$amount = $unit_price*$row->total_quantity;
		$data = array(
			'emp_id' => $emp_id,
			'article_id' => $row->article_id,
			'section_id' => $row->section_id,
			'process_id' => $row->process_id,
			'unit_price' => $unit_price,
			'total_quantity' => $row->total_quantity,
			'amount' => $amount,
			'month' => $month
			);
		$this->db->insert("pd_production_summary_logs",$data);
		return $amount;
		}
		else
		{
			return 0;
		}
	}
	function get_price($article_id,$section_id,$process_id)
	{
		$this->db->select('price');
		$this->db->where('article_id',$article_id);
		$this->db->where('article_id',$article_id);
		$this->db->where('article_id',$article_id);
		$query = $this->db->get('pd_article_wise_process_prices');
		$row = $query->row();
		if($query->num_rows() != 0)
		return $row->price;
		else
		return false;		
	}
	
	function get_setup($setup_id)
	{
		$this->db->select('value');
		$this->db->where("attributes",$setup_id);
		$query = $this->db->get('pd_setups');
		$rows = $query->row();
		$setup_value = $rows ->value;
		return $setup_value;
	}
	function get_section_name($sec_id)
	{
		$this->db->select('sec_name');
		$this->db->where("sec_id",$sec_id);
		$query = $this->db->get('pr_section');
		$rows = $query->row();
		if($query->num_rows() == 0)
		return false;
		$sec_name = $rows ->sec_name;
		return $sec_name;
	}
	function get_process_name($process_id)
	{
		$this->db->select('process_name');
		$this->db->where("process_id",$process_id);
		$query = $this->db->get('pd_process_setups');
		$rows = $query->row();
		if($query->num_rows() == 0)
		return false;
		$process_name = $rows ->process_name;
		return $process_name;
	}
}