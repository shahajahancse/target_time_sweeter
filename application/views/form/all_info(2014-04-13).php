<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Company Info</title>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/calendar.css" />

<script type="text/javascript" src="<?php echo base_url();?>js/dynamic.js"></script>

<script src="<?php echo base_url(); ?>js/calendar_eu.js" type="text/javascript"></script>

<style type="text/css">
.cominfo td{
font-weight:bold;

}
.cominfo select{
width:265px;
}
.bangla{
font-family:SolaimanLipi;
font-size:15px;
}
</style>

</head>

<body bgcolor="#ECE9D8">
<div align="center" style=" width:900px; overflow:hidden;" >
<div  style="width:900px;">
<div id="error_id" style="display:none; color:red;">
<?php echo $validation_errors =  validation_errors(); ?>
</div>
<?php  
if($validation_errors != '')
{
	echo "<SCRIPT LANGUAGE=\"JavaScript\">alert(document.getElementById('error_id').innerHTML);</SCRIPT>"; 
}
?>
<form name='cominfo' class="cominfo"  enctype="multipart/form-data" method="post" action="<?php echo base_url();?>index.php/emp_info_con/personal_info_view1" >
<table cellpadding="0" cellspacing="0" width='900px' border='0' align='center'>
<tr>
  <td width='135px'>Emp Id </td>
  <td width='250px'>
    <input type='text' size='29px' id='empid' name='empid' value="<?php echo set_value('empid'); ?>" required/>
  
    </td>
  <td></td>
  <td>
    
  </td>
  <td width="20%" rowspan="6"><div style='width:150; height:120px; float:left; padding:5px; '><img id='img'  name='image' alt=''><div id='emp_status' style='font-size:14px;color:blue;'></div></div></td>
</tr>

<tr>
  <td>Name(English)</td>
  <td><input  type='text' size='29px' id='name' name="name" value="<?php echo set_value('name'); ?>"></td>
<td width="135px;">Name(Bangla)</td>
<td><input style="width:196px;" class="bangla" type='text' id='bname' name="bname" value="<?php echo set_value('bname'); ?>"></td>
</tr>




<tr><td>Mother's Name</td>
<td><input type='text' size='29px' id='mname' name="mname" value="<?php echo set_value('mname'); ?>"></td>
<td>Father's Name</td>
<td><input type='text' size='29px' id='fname' name="fname" value="<?php echo set_value('fname'); ?>"></td>
</tr>
<tr><td>Present Add.</td>
<td><input type='text' size='29px' id='padd' name='padd' value="<?php echo set_value('padd'); ?>"></td>
<td>Permanent Add.</td>
<td><input type='text' size='29px' id='fadd' name='fadd' value="<?php echo set_value('fadd'); ?>"></td>
</tr>
<tr><td>Date Of Birth</td>
<td><input type='text' size='25px' id='dob' name="dob"  value="<?php echo set_value('dob'); ?>" />
  <script language="JavaScript">
	var o_cal = new tcal ({
		// form name
		'formname': 'cominfo',
		// input name
		'controlname': 'dob'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 6;
	
	</script></td>
<td>Photo</td><td><input type='file' value='Image Source' name='userfile' id='source' size="16px" /></td>
</tr>
<tr><td>Religion</td>
<td> 
	<select style="width:198px;"  id='reli' name="reli">
		<?php $religion_name = $this->processdb->get_religion_name();
		foreach($religion_name->result() as $rows) { 
			if($this->input->post('reli') == $rows->religion_id) {?>
				<option value="<?php echo $rows->religion_id; ?>" selected="selected"><?php echo $rows->religion_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->religion_id; ?>"><?php echo $rows->religion_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	    	  
	</select>
</td>
<td>Sex</td>
<td>
	<select style="width:198px;" id='sex' name="sex">
		<?php $sex_name = $this->processdb->get_sex_name();
		foreach($sex_name->result() as $rows) { 
			if($this->input->post('sex') == $rows->sex_id) {?>
				<option value="<?php echo $rows->sex_id; ?>" selected="selected"><?php echo $rows->sex_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->sex_id; ?>"><?php echo $rows->sex_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	  	
	</select>
</td>
</tr>
<tr><td>Marital Status</td>
<td>
	<select style="width:198px;" id='ms' name="ms">
		<?php $matital_status_name = $this->processdb->get_matital_status_name();
		foreach($matital_status_name->result() as $rows) { 
			if($this->input->post('ms') == $rows->marrital_status_id) {?>
				<option value="<?php echo $rows->marrital_status_id; ?>" selected="selected"><?php echo $rows->marrital_status_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->marrital_status_id; ?>"><?php echo $rows->marrital_status_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	  	
	</select>
</td>
<td>Blood Group</td>
<td>
	<select style="width:198px;" id='bgroup' name="bgroup">
		<?php $blood_name = $this->processdb->get_blood_name();
		foreach($blood_name->result() as $rows) { 
			if($this->input->post('bgroup') == $rows->blood_id) {?>
				<option value="<?php echo $rows->blood_id; ?>" selected="selected"><?php echo $rows->blood_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->blood_id; ?>"><?php echo $rows->blood_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	  	
	</select>
</td>
</tr></table>

<table width='900px' cellpadding="0" cellspacing="0" border='0' align='center'>
<tr><td width="135px">Punch Card No.</td>
  <td width="250px"><input  type='text' id='idcard' name="idcard" size='29px'  value="<?php echo set_value('idcard'); ?>"/></td>
  <td width="135px">Department</td>
  <td>
  	<select style="width:198px;" id='dept' name='dept'>
		<?php $department_name = $this->processdb->get_department_name();
		foreach($department_name->result() as $rows) { 
			if($this->input->post('dept') == $rows->dept_id) {?>
				<option value="<?php echo $rows->dept_id; ?>" selected="selected"><?php echo $rows->dept_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->dept_id; ?>"><?php echo $rows->dept_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>
	</select>
  </td>
</tr>
<tr><td>Section</td>
<td>
	<select style="width:198px;" id='sec' name='sec' >
    	<?php $section_name = $this->processdb->get_section_name();
		foreach($section_name->result() as $rows) { 
			if($this->input->post('sec') == $rows->sec_id) {?>
				<option value="<?php echo $rows->sec_id; ?>" selected="selected"><?php echo $rows->sec_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->sec_id; ?>"><?php echo $rows->sec_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>
  	</select>
</td>
  <td>Designation</td>
  <td>
	<select style="width:198px;" id='desig' name='desig'>
    	<?php $designation_name = $this->processdb->get_designation_name();
		foreach($designation_name->result() as $rows) { 
			if($this->input->post('desig') == $rows->desig_id) {?>
				<option value="<?php echo $rows->desig_id; ?>" selected="selected"><?php echo $rows->desig_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->desig_id; ?>"><?php echo $rows->desig_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>
	</select>
 </td>
</tr>
<tr><td>Block Number</td>
<td>
	<select style="width:198px;" id='line' name='line' >
		<?php $line_name = $this->processdb->get_line_name();
		foreach($line_name->result() as $rows) { 
			if($this->input->post('line') == $rows->line_id) {?>
				<option value="<?php echo $rows->line_id; ?>" selected="selected"><?php echo $rows->line_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->line_id; ?>"><?php echo $rows->line_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	
	</select>
</td>
  <td>Floor</td>
  <td>
	<select style="width:198px;" id='position' name='position' >
		<?php $position_name = $this->processdb->get_position_name();
		foreach($position_name->result() as $rows) { 
			if($this->input->post('position') == $rows->posi_id) {?>
				<option value="<?php echo $rows->posi_id; ?>" selected="selected"><?php echo $rows->posi_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->posi_id; ?>"><?php echo $rows->posi_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	
  	</select></td>
</tr>
<tr><td>Operation</td><td>
	<select style="width:198px;" id='operation' name='operation'>
		<?php $operation_name = $this->processdb->get_operation_name();
		foreach($operation_name->result() as $rows) { 
			if($this->input->post('operation') == $rows->ope_id) {?>
				<option value="<?php echo $rows->ope_id; ?>" selected="selected"><?php echo $rows->ope_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->ope_id; ?>"><?php echo $rows->ope_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	
	</select>
</td>
  <td>Emp Status</td>
  <td>
	<select style="width:198px;" id='empstat' name='empstat' >
    	<?php $status_name = $this->processdb->get_status_name();
		foreach($status_name->result() as $rows) { 
			if($this->input->post('empstat') == $rows->stat_id) {?>
				<option value="<?php echo $rows->stat_id; ?>" selected="selected"><?php echo $rows->stat_type; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->stat_id; ?>"><?php echo $rows->stat_type; ?></option>	
			<?php } ?>	
			
		<?php } ?>		
  	</select>
  </td>
</tr>
<tr><td>Salary Grade</td><td>
	<select style="width:198px;" id='salg' name='salg'>
		<?php $grade_name = $this->processdb->get_grade_name();
		foreach($grade_name->result() as $rows) { 
			if($this->input->post('salg') == $rows->gr_id) {?>
				<option value="<?php echo $rows->gr_id; ?>" selected="selected"><?php echo $rows->gr_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->gr_id; ?>"><?php echo $rows->gr_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	
	</select>
	</td>
  <td>OT Entitle</td>
  <td>
  	<select style="width:198px;" id='otentitle' name='otentitle' >
    	<?php $ot_name = $this->processdb->get_yes_no_asc();
		foreach($ot_name->result() as $rows) { 
			if($this->input->post('otentitle') == $rows->id) {?>
				<option value="<?php echo $rows->id; ?>" selected="selected"><?php echo $rows->name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	
  	</select>
</td>
</tr>
<tr><td>Emp Shift</td><td>
	<select style="width:198px;" id='empshift' name='empshift' >
		<?php $shift_name = $this->processdb->get_shift_name();
		foreach($shift_name->result() as $rows) { 
			if($this->input->post('empshift') == $rows->shift_id) {?>
				<option value="<?php echo $rows->shift_id; ?>" selected="selected"><?php echo $rows->shift_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->shift_id; ?>"><?php echo $rows->shift_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>		
	</select>
</td>
  <td>Lunch Entitle</td>
<td>
	<select style="width:198px;" id='lunch' name='lunch' >
		<?php $lunch_name = $this->processdb->get_yes_no_desc();
		foreach($lunch_name->result() as $rows) { 
			if($this->input->post('lunch') == $rows->id) {?>
				<option value="<?php echo $rows->id; ?>" selected="selected"><?php echo $rows->name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	    	
  	</select>
</td>
</tr>
<tr>
  <td>Transport</td>
  <td>
	<select style="width:198px;" id='transport' name='transport' >
		<?php $transport_name = $this->processdb->get_yes_no_desc();
		foreach($transport_name->result() as $rows) { 
			if($this->input->post('transport') == $rows->id) {?>
				<option value="<?php echo $rows->id; ?>" selected="selected"><?php echo $rows->name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->id; ?>"><?php echo $rows->name; ?></option>	
			<?php } ?>	
			
		<?php } ?>
	</select>
</td>
  <td>Emp join date</td>
  <td><input  type='text' size='25px' id='ejd' name="ejd" value="<?php echo set_value('ejd'); ?>"  required/>
      <script language="JavaScript" type="text/javascript">
	var o_cal = new tcal ({
		// form name
		'formname': 'cominfo',
		// input name
		'controlname': 'ejd'
	});
	
	// individual template parameters can be modified via the calendar variable
	o_cal.a_tpl.yearscroll = false;
	o_cal.a_tpl.weekstart = 6;
	
	</script>  </td>
<tr><td>Att. Bonus</td><td>
	<select style="width:198px;" id='attbonus' name='attbonus' >
		<?php $att_bonus_name = $this->processdb->get_att_bonus_name();
		foreach($att_bonus_name->result() as $rows) { 
			if($this->input->post('attbonus') == $rows->ab_id) {?>
				<option value="<?php echo $rows->ab_id; ?>" selected="selected"><?php echo $rows->ab_rule_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->ab_id; ?>"><?php echo $rows->ab_rule_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>
	</select>
</td>
  <td>Salary Type</td>
<td>
  	<select style="width:198px;" id='saltype' name='saltype' >
		<?php $salary_type_name = $this->processdb->get_salary_type_name();
		foreach($salary_type_name->result() as $rows) { 
			if($this->input->post('saltype') == $rows->sal_type_id) {?>
				<option value="<?php echo $rows->sal_type_id; ?>" selected="selected"><?php echo $rows->sal_type_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->sal_type_id; ?>"><?php echo $rows->sal_type_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	    	
  	</select>
</td>
</tr>
<tr><tr><td>Salary Withdraw</td><td>
	<select style="width:198px;" id='saldraw' name='saldraw' >
		<?php $salary_withdraw_name = $this->processdb->get_salary_withdraw_name();
		foreach($salary_withdraw_name->result() as $rows) { 
			if($this->input->post('saldraw') == $rows->sal_withdraw_id) {?>
				<option value="<?php echo $rows->sal_withdraw_id; ?>" selected="selected"><?php echo $rows->sal_withdraw_name; ?></option>
			<?php } else { ?>	
				<option value="<?php echo $rows->sal_withdraw_id; ?>"><?php echo $rows->sal_withdraw_name; ?></option>	
			<?php } ?>	
			
		<?php } ?>	    	
	</select>
</td> <td>&nbsp;</td><td>&nbsp;</td> </tr>
</table>


 
<table width='900px' border='0' align='center' cellpadding="0" cellspacing="0">
<tr><td width="135px">Emp Last Dgree</td>
  <td width="250px"><input name="text2" type='text' id='emp_last_dg' size='29px'  value="<?php echo set_value('text2'); ?>"/></td>
  <td width="135px">Passing year</td>
  <td><input name="text3" type='text' id='pass_year' size='29px'  value="<?php echo set_value('text3'); ?>"/></td></tr>
<tr><td>Passing Institute</td>
<td><input name="text4" type='text' id='edu_insti' size='29px'  value="<?php echo set_value('text4'); ?>"/></td>
<td>Emp skill dept.</td>
<td><input name="text5" type='text' id='skill_dept' size='29px'  value="<?php echo set_value('text5'); ?>"/></td></tr>
<tr><td>Year of Skill</td>
<td><input name="text6" type='text' id='skill_year' size='29px'  value="<?php echo set_value('text6'); ?>"/></td>
<td>Company Name</td>
<td><input name="text7" type='text' id='skill_com_na' size='29px'  value="<?php echo set_value('text7'); ?>"/></td></tr></table>

<table cellpadding="0" cellspacing="0" width='900px' border='0' align='center'>
  <tr style='background-color:#CCCCCC'>
    <td width="35px">Salary</td>
    <td>
	<table cellpadding="0" cellspacing="0"  width='865px' border='0' align='center' >
      <tr>
        <td  width="92px">Gross</td>
        <td width="250px"><input name="text8" type='text' id='gsal'  onchange='basic_sal_cal()' size='29px'  value="<?php echo set_value('text8'); ?>" required/></td>
        <td width="135px">Basic</td>
        <td  style="background-color:#ECE9D8"><input name="text8" type='text' disabled='disabled' id='bsal'  size='29px' /></td>
      </tr>
      <tr>
        <td>House</td>
        <td><input name="text8" type='text' disabled='disabled' id='hrent'  size='29px' /></td>
        <td>Medical</td>
        <td style="background-color:#ECE9D8"><input name="text8" type='text' disabled='disabled' id='mallow' size='29px' /></td>
      </tr>
    </table></td>
  </tr>
</table>
 <input type='button' name='add' onclick='enable_save()' value='NEW'/>&nbsp;<input type="submit" name='pi_save'   value='SAVE'  />&nbsp;<input type="submit" name="pi_edit" id="pi_edit" disabled="disabled"  value='EDIT'/></form>Find ID :
  <input style='background-color:yellow;' type='text' size='15px' id='search_empid' name='search_empid' onchange="com_info_Search1()"  />
  
  </div>
   </div>
<?php if($this->input->post('pi_edit')) {echo "<SCRIPT LANGUAGE=\"JavaScript\">document.cominfo.pi_edit.disabled = false; document.cominfo.pi_save.disabled = true;</SCRIPT>";} ?>
 
</body>
</html>