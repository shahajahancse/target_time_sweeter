<?php
/**
 * Autocomplete_Model
 *
 * @package autocomplete
 */
class Autocomplete_Model extends CI_Model
{
    function find_emp_id()
    {
		$term = $this->input->get('term',TRUE);
	    $this->db->select('pr_emp_per_info.emp_id,emp_sec_id,emp_line_id,emp_full_name,emp_desi_id,img_source,emp_position_id');
		$this->db->join('pr_emp_per_info', 'pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->like('pr_emp_com_info.emp_id',$term,'after');
		$this->db->limit(10);
		$query = $this->db->get("pr_emp_com_info");
		return $query;
	}
	function find_article_id()
    {
		$status	= "Disable";		
		$term = $this->input->get('term',TRUE);
		//echo $this->input->get('artical_id_pk');
	    $this->db->select('article_id,article_id_pk');
		$this->db->like('article_id',$term,'after');
		$this->db->where('status !=',$status);
		$this->db->limit(10);
		$query = $this->db->get("pd_style_infos");
		return $query;
	}
	function find_color_name($var)
    {
		$term = $this->input->get('term',TRUE);
	    $this->db->select('pd_color_infos.color_id,color_name');
		$this->db->join('pd_color_infos', 'pd_color_infos.color_id = pd_color_wise_lots.color_id');
		$this->db->where('article_id',$var);
		$this->db->like('color_name',$term,'after');
		$this->db->limit(10);
		$query = $this->db->get("pd_color_wise_lots");
		return $query;
	}
	function find_issue_emp_id()
    {
		$term = $this->input->get('term',TRUE);
	    $this->db->select('*');
		$this->db->join('pr_emp_com_info', 'pr_emp_com_info.emp_id = pd_production_logs.emp_id');
		$this->db->join('pr_emp_per_info', 'pr_emp_per_info.emp_id = pr_emp_com_info.emp_id');
		$this->db->like('pd_production_logs.emp_id',$term,'after');
		$this->db->where('status',1);
		$this->db->group_by('pd_production_logs.emp_id');
		$this->db->limit(10);
		$query = $this->db->get("pd_production_logs");
		return $query;
	}
}