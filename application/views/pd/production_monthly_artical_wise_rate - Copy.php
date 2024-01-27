<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Production Monthly Style Sheet
<?php 
$sal_year  = date('Y',strtotime($salary_month));
$sal_month = date('m',strtotime($salary_month));
$day=date('d',strtotime($salary_month));
$date_format = date("F-Y", mktime(0, 0, 0, $sal_month, $day, $sal_year));
echo $date_format;

?>
</title>

</head>

<body>
<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="5" style="font-size:12px; width:auto; border-collapse:collapse;">
<tr>
	<td rowspan="2">Buyer Name</td>
	<td rowspan="2">Style No.</td>
	

<?php
		$section = $this->pd_report_model->get_monthly_section($salary_month);
		foreach($section->result() as $style_row)
		{
			$section_id = $style_row->section_id;
			$process = $this->pd_report_model->get_monthly_process_by_section($salary_month,$section_id );
			$num_of_process =  $process->num_rows();
?>			
			<td colspan="<?php echo $num_of_process; ?>"><?php echo $this->pd_report_model->get_section_name($section_id)?></td>
	<?php		
		}		
	?>
</tr>
<tr>
	
	
</tr>



</table>
</body>
</html>