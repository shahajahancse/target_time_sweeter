<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Autocomplete extends CI_Controller {
 
	    function index()
	    {
        $this->load->view('autocomplete');
	    }
	function find_emp_id()
	{
		$this->load->model('autocomplete_model');
	
		$query = $this->autocomplete_model->find_emp_id();
		$return_arr = array();
		$row_array = array();
		foreach($query->result() as $row)
		{
		$row_array['emp_id'] = $row->emp_id;
		$row_array['value'] = $row->emp_id;	
		$row_array['section_id'] = $row->emp_sec_id;
		$row_array['floor_id'] = $row->emp_position_id;
		$row_array['block_id'] = $row->emp_line_id;
		$row_array['section'] = $this->get_section_name($row->emp_sec_id);
		$row_array['floor'] = $this->get_floor_name($row->emp_position_id);
		$row_array['block'] = $this->get_line_name($row->emp_line_id);
		$row_array['full_name'] = $row->emp_full_name;
		$row_array['designation'] = $this->get_designation_name($row->emp_desi_id);
		$row_array['image_name'] = $row->img_source;
		$row_array['proxi_id'] = $this->get_proxi_id($row->emp_id);
 
		array_push($return_arr,$row_array);
		}
		echo json_encode($return_arr);
	}
	function find_article_id()
	{
		$this->load->model('autocomplete_model');
	
		$query = $this->autocomplete_model->find_article_id();
		$return_arr = array();
		$row_array = array();
		foreach($query->result() as $row)
		{
		$row_array['article_id'] = $row->article_id;
		$row_array['value'] = $row->article_id;	
		$row_array['article_id_pk'] = $row->article_id_pk; 
		array_push($return_arr,$row_array);
		}
		echo json_encode($return_arr);
	}
	function find_color_name($var)
	{
		$this->load->model('autocomplete_model');	
		$query = $this->autocomplete_model->find_color_name($var);
		$return_arr = array();
		$row_array = array();
		foreach($query->result() as $row)
		{
		$row_array['color_id'] = $row->color_id;
		$row_array['value'] = $row->color_name;	
		$row_array['color_name'] = $row->color_name; 
		array_push($return_arr,$row_array);
		}
		echo json_encode($return_arr);
	}
	function find_issue_emp_id()
	{
		$this->load->model('autocomplete_model');
	
		$query = $this->autocomplete_model->find_issue_emp_id();
		$return_arr = array();
		$row_array = array();
		foreach($query->result() as $row)
		{
		$row_array['emp_id'] = $row->emp_id;
		$row_array['value'] = $row->emp_id;	
		$row_array['section_id'] = $row->section_id;
		$row_array['floor_id'] = $row->floor_id;
		$row_array['block_id'] = $row->emp_line_id;
		$row_array['section'] = $this->get_section_name($row->emp_sec_id);
		$row_array['floor'] = $this->get_floor_name($row->emp_position_id);
		$row_array['block'] = $this->get_line_name($row->emp_line_id);
		$row_array['full_name'] = $row->emp_full_name;
		$row_array['designation'] = $this->get_designation_name($row->emp_desi_id);
		$row_array['image_name'] = $row->img_source ;
 
		array_push($return_arr,$row_array);
		}
		echo json_encode($return_arr);
	}
	function get_section_name($emp_sec_id)
	{
		$this->db->select('sec_name');
		$this->db->where('sec_id',$emp_sec_id);
		$query = $this->db->get("pr_section");
		$row = $query->row();
		return $sec_name = $row->sec_name;
	}
	function get_floor_name($emp_position_id)
	{
		$this->db->select('posi_name');
		$this->db->where('posi_id',$emp_position_id);
		$query = $this->db->get("pr_emp_position");
		$row = $query->row();
		return $posi_name = $row->posi_name;
	}
	function get_line_name($emp_line_id)
	{
		$this->db->select('line_name');
		$this->db->where('line_id',$emp_line_id);
		$query = $this->db->get("pr_line_num");
		$row = $query->row();
		return $line_name = $row->line_name;
	}
	function get_designation_name($emp_desi_id)
	{
		$this->db->select('desig_name');
		$this->db->where('desig_id',$emp_desi_id);
		$query = $this->db->get("pr_designation");
		$row = $query->row();
		return $designation = $row->desig_name;
	}
	
	function get_proxi_id($emp_id)
	{
		$this->db->select('proxi_id');
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get("pr_id_proxi");
		$row = $query->row();
		return $row->proxi_id;
	}
}