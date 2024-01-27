<?php

class Import extends CI_Controller {



	function __construct()

	{

		parent::__construct();

	}

	

	function index()

	{		

		?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

        <html xmlns="http://www.w3.org/1999/xhtml">

        <head>

        <meta http-equiv="Content-Type" content="text/csv; charset=utf-8"/>

        <title>IMPORT</title>

        </head>

        

        <body>

		<?php

		/********************************/

		/* Code at http://legend.ws/blog/tips-tricks/csv-php-mysql-import/

		/* Edit the entries below to reflect the appropriate values

		/********************************/

		$databasetable = "pr_emp_per_info";

		$fieldseparator = "\t";

		$lineseparator = "\n";

		$csvfile = "import/time_sample-utf8.txt";

		/********************************/

		/* Would you like to add an ampty field at the beginning of these records?

		/* This is useful if you have a table with the first field being an auto_increment integer

		/* and the csv file does not have such as empty field before the records.

		/* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.

		/* This can dump data in the wrong fields if this extra field does not exist in the table

		/********************************/

		$addauto = 1;

		/********************************/

		/* Would you like to save the mysql queries in a file? If yes set $save to 1.

		/* Permission on the file should be set to 777. Either upload a sample file through ftp and

		/* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql

		/********************************/

		$save = 1;

		$outputfile = "import/output.txt";

		/********************************/

		

		

		if(!file_exists($csvfile)) {

			echo "File not found. Make sure you specified the correct path.\n";

			exit;

		}

		

		$file = fopen($csvfile,"r");

		

		if(!$file) {

			echo "Error opening data file.\n";

			exit;

		}

		

		$size = filesize($csvfile);

		

		if(!$size) {

			echo "File is empty.\n";

			exit;

		}

		

		$csvcontent = fread($file,$size);

		

		fclose($file);

		

		//echo $check = file_put_contents($tmpfile, str_replace("\t", ";",  iconv('UTF-16', 'UTF-8', file_get_contents($csvfile))));



		

		$lines = 0;

		$queries = "";

		$linearray = array();

		$line_by_array = explode($lineseparator,$csvcontent);

		

		//foreach(explode($lineseparator,$csvcontent) as $line) {

		$count = count($line_by_array);

		for($i = 0 ; $i < $count - 1; $i++) {

		

			$lines++;

			$line = trim($line_by_array[$i]);

			//echo $line.'<br>';

			//$line = trim($line," \t");

			//$line = str_replace("\r","\t",$line);

			/***********************************

			This line escapes the special character. remove it if entries are already escaped in the csv file

			***********************************/

			//$line = str_replace("'","\'",$line);

			/************************************/

			//echo $line.'<br>';

			$linearray = explode($fieldseparator,$line);

			//print_r($linearray);

			//echo '=========================';

			//$linemysql = implode("','",$linearray);

			

			

			$emp_name  	= trim($linearray[0]);
			$emp_b_name	= trim($linearray[1]);
			$emp_id 	= trim($linearray[2]);
			$dept_name	= trim($linearray[3]);
			$desig_name	= trim($linearray[4]);
			$sec_name	= trim($linearray[5]);
			$floor_name	= trim($linearray[6]);
			$block_name	= trim($linearray[7]);
			
			$dob 		= trim($linearray[8]);
			$doj 		= trim($linearray[9]);
			$sal_grade	= trim($linearray[10]);
			$sal_gross	= trim($linearray[11]);
			$bonus_name	= trim($linearray[12]);
			$gender		= trim($linearray[13]);
			$marital	= trim($linearray[14]);
			
			$ot  = "No";
			
			
			$pre_add	= '';//;trim($linearray[15]);
			$par_add	= '';//trim($linearray[16]);
			$mthr_name	= '';//trim($linearray[15]);
			$fthr_name	= '';//trim($linearray[16]);
			//$emp_b_name = '';
			//$marital	= "No";
			

			if($gender 	=='F'  ){ $gender 	= 2; }else{ $gender = 1; }

			if($marital =='Y'){ $marital 	= 2; }else{ $marital= 1; }

			if($ot 		=='Yes'){ $ot 		= 0; }else{ $ot 	= 1; }

			

			//$this->check_dept($dept_name,$unit_id);

			$this->check_section($sec_name);

			//$this->check_line($line_name,$unit_id);

			$this->check_designation($desig_name);
			
			//$this->check_salgrade($sal_grade);

			//$this->check_att_bonus($bonus_name);

			

			//$dept_id = $this->get_department_id_by_name($dept_name,$unit_id);

			$sec_id  = $this->get_section_id_by_name($sec_name);

			//$line_id = $this->get_line_id_by_name($line_name,$unit_id);

			$desig_id = $this->get_designation_id_by_name($desig_name);

			$sal_grade_id = $this->get_salary_grade_id_by_name($sal_grade);

			$bonus_id = $this->get_bonus_id_by_name($bonus_name);

			

			$dob1 = date('Y-m-d', strtotime($dob));

			$doj1 = date('Y-m-d', strtotime($doj));

			if($addauto){

				echo $query =  "INSERT INTO $databasetable (`emp_id`, `emp_full_name`, `bangla_nam`, `emp_mname`, `emp_fname`, `emp_dob`, `emp_marital_status`, `emp_blood`, `emp_sex` ) VALUES ('$emp_id', '$emp_name', '$emp_b_name','$fthr_name','$mthr_name','$dob1', $marital, 0, $gender);";

				echo "<br>";

				echo $query2 = "INSERT INTO pr_emp_com_info (`emp_id`,`emp_dept_id`, `emp_sec_id`, `emp_line_id`, `emp_desi_id`,`emp_operation_id`,`emp_position_id`, `emp_sal_gra_id`, `emp_cat_id`, `emp_shift`, `gross_sal`, `ot_entitle`, `transport`, `lunch`, `att_bonus`, `salary_draw`,`salary_type`,`emp_join_date`) 

								VALUES ('$emp_id',2,$sec_id,0,$desig_id,0,8,'$sal_grade_id',1,1,'$sal_gross',$ot,1,1,'$bonus_id',1,1,'$doj1' );";

				echo "<br>";

				echo $query3 =  "INSERT INTO pr_emp_add (`emp_id`, `emp_pre_add`, `emp_par_add`) VALUES ('$emp_id','$pre_add','$par_add');";

				echo "<br>";

				echo $query4 =  "INSERT INTO pr_emp_edu (`emp_id`) VALUES ('$emp_id');";

				echo "<br>";

				echo $query5 =  "INSERT INTO pr_emp_skill (`emp_id`) VALUES ('$emp_id');";

				echo "<br>";

				echo $query6 =  "INSERT INTO pr_id_proxi (`emp_id`) VALUES ('$emp_id');";

				echo "<br>";

				

				echo $query7 = "CREATE TABLE IF NOT EXISTS `temp_$emp_id` (`att_id` int(11) NOT NULL AUTO_INCREMENT, `device_id` int(11) DEFAULT NULL, `proxi_id` int(11) DEFAULT NULL, `date_time` datetime DEFAULT NULL, PRIMARY KEY (`att_id`) ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

				echo "<br>";

				echo $query8 ="-- =======================================================================================================";

				

				

				}

			else

				echo $query =  "INSERT INTO $databasetable (`emp_id`,`emp_full_name`,`emp_dob`,`emp_marital_status`,`emp_blood`) VALUES ('$emp_id', '$emp_name', '$dob1', 1, 0);";

			$queries .= $query . "\n";

			$queries .= $query2 . "\n";

			$queries .= $query3 . "\n";

			$queries .= $query4 . "\n";

			$queries .= $query5 . "\n";

			$queries .= $query6 . "\n";

			$queries .= $query7 . "\n";

			$queries .= $query8 . "\n";

			echo "<br>";

			//@mysql_query($query);

		}

		

		//@mysql_close($con);

		

		if($save) {

			

			if(!is_writable($outputfile)) {

				echo "File is not writable, check permissions.\n";

			}

			

			else {

				$file2 = fopen($outputfile,"w");

				

				if(!$file2) {

					echo "Error writing to the output file.\n";

				}

				else {

					fwrite($file2,$queries);

					fclose($file2);

				}

			}

			

		}

		

		echo "Found a total of $lines records in this csv file.\n";

	?>

</body>

</html>

<?php

	}

	

	function check_dept($dept_name,$unit_id)

	{

		$num_row = $this->db->where('dept_name',trim($dept_name))->where('unit_id',$unit_id)->get('pr_dept')->num_rows();

		if($num_row < 1)

		{

			$dept_name = trim($dept_name);

			$data = array(
			'unit_id' => $unit_id,
			'dept_name' => $dept_name

			);

			$this->db->insert('pr_dept', $data); 

		}

	}

	

	function check_section($sec_name)

	{

		$num_row = $this->db->where('sec_name',trim($sec_name))->get('pr_section')->num_rows();

		if($num_row < 1)

		{

			$sec_name = trim($sec_name);

			$data = array(
			'sec_name' => $sec_name

			);

			$this->db->insert('pr_section', $data); 

		}

	}

	function check_line($line_name,$unit_id)

	{

		$num_row = $this->db->where('line_name',trim($line_name))->where('unit_id',$unit_id)->get('pr_line_num')->num_rows();

		if($num_row < 1)

		{

			$line_name = trim($line_name);

			$data = array(
			'unit_id' => $unit_id,
			'line_name' => $line_name

			);

			$this->db->insert('pr_line_num', $data); 

		}

	}

	

	function check_designation($desig_name)

	{

		//echo $unit_id;
		$num_row = $this->db->where('desig_name',trim($desig_name))->get('pr_designation')->num_rows();
		if($num_row < 1)

		{
			$desig_name = trim($desig_name);

			$data = array(
			'desig_name' => $desig_name

			);

			$this->db->insert('pr_designation', $data); 
			//echo $this->db->last_query();
		}

	}


	function check_salgrade($salgrade_name)

	{

		$num_row = $this->db->where('gr_name',trim($salgrade_name))->get('pr_grade')->num_rows();

		if($num_row < 1)

		{

			$salgrade_name = trim($salgrade_name);

			$data = array(

			'gr_name' => $salgrade_name

			);

			$this->db->insert('pr_grade', $data); 

		}

	}
	

	function check_att_bonus($bonus_name)

	{

		$num_row = $this->db->where('ab_rule_name',trim($bonus_name))->get('pr_attn_bonus')->num_rows();

		if($num_row < 1)

		{

			$bonus_name = trim($bonus_name);

			$data = array(

			'ab_rule_name' => $bonus_name

			);

			$this->db->insert('pr_attn_bonus', $data); 

		}

	}

	

	function get_unit_id_by_name($unit_name)

	{

		$this->db->select('unit_id');

		$this->db->where('unit_name',trim($unit_name));

		$query = $this->db->get('pr_units');

		$row = $query->row();

		return $unit_id = $row->unit_id;

	}

	

	function get_department_id_by_name($dept_name,$unit_id)

	{

		$this->db->select('dept_id');

		$this->db->where('dept_name',trim($dept_name));
		$this->db->where('unit_id',$unit_id);

		$query = $this->db->get('pr_dept');

		$row = $query->row();

		return $dept_id = $row->dept_id;

	}

	

	function get_section_id_by_name($sec_name)

	{

		$this->db->select('sec_id');

		$this->db->where('sec_name',trim($sec_name));

		$query = $this->db->get('pr_section');

		$row = $query->row();

		return $sec_id = $row->sec_id;

	}

	

	function get_line_id_by_name($line_name,$unit_id)

	{

		$this->db->select('line_id');

		$this->db->where('line_name',trim($line_name));
		$this->db->where('unit_id',$unit_id);

		$query = $this->db->get('pr_line_num');

		$row = $query->row();

		return $line_id = $row->line_id;

	}

	

	function get_designation_id_by_name($desig_name)

	{

		$this->db->select('desig_id');

		$this->db->where('desig_name',trim($desig_name));

		$query = $this->db->get('pr_designation');

		$row = $query->row();

		return $desig_id = $row->desig_id;

	}

	function get_salary_grade_id_by_name($sal_grade)

	{

		$this->db->select('gr_id');

		$this->db->where('gr_name',trim($sal_grade));

		$query = $this->db->get('pr_grade');

		$row = $query->row();

		return $gr_id = $row->gr_id;

	}

	

	function get_bonus_id_by_name($bonus_name)

	{

		$this->db->select('ab_id');

		$this->db->like('ab_rule_name', trim($bonus_name));

		$query = $this->db->get('pr_attn_bonus');

		$row = $query->row();

		//echo $this->db->last_query();

		return $ab_id = $row->ab_id;

	}



}



?>