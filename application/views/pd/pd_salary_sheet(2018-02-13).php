<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
<?php 
	if($grid_status == 1)
	{ echo 'Reguler Employee '; }
	elseif($grid_status == 2)
	{ echo 'New Employee '; }
	elseif($grid_status == 3)
	{ echo 'Left Employee '; }
	elseif($grid_status == 4)
	{ echo 'Resign Employee '; }
	elseif($grid_status == 6)
	{ echo 'Promoted Employee '; }
?>Salary Sheet For The Month of  
<?php 
$date = $salary_month;
$sal_year=trim(substr($date,0,4));
$sal_month=trim(substr($date,5,2));
$day=trim(substr($date,8,2));
$date_format = date("F-Y", mktime(0, 0, 0, $sal_month, $day, $sal_year));
echo $date_format;

?>

</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/SingleRow.css" />


</head>

<body>

<?php 
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
			$Gtotal_gross_salary = 0;
			$Gtotal_basic_salary = 0;
			$stam_value = 10;
			$grand_total_stamp = 0;
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
			
			
			?>
			<table >
			
			<?php
for ( $counter = 1; $counter <= $page; $counter ++)
{
?>

<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; width:auto; border-collapse:collapse;">

<tr height="50px">

<?php if($deduct_status == "Yes"){?> 
<td colspan="47" align="center">
<?php }else{ ?>
<td colspan="47" align="center">
<?php } ?>
<div style="width:100%">

<div style="text-align:left; position:relative;padding-left:10px;width:20%; float:left; font-weight:bold">
<table>
<?php 
$date = date('d-m-Y');
//echo "Payment Date : $date"; 

$section_name = $value[0]->sec_name;
echo "Section : $section_name<br>";
echo "Page No # $counter of $page";
if($floor != "Select")
{
	$floor_name = $this->db->where("posi_id",$floor)->get('pr_emp_position')->row()->posi_name;
	echo "&nbsp;&nbsp;&nbsp;Floor : $floor_name";
}
if($block != "Select")
{
	$block_name = $this->db->where("line_id",$block)->get('pr_line_num')->row()->line_name;
	echo "&nbsp;&nbsp;&nbsp;Block : $block_name";
}
?>
</table>
</div>

<div style="text-align:center; position:relative;padding-left:10px;width:50%; overflow:hidden; float:left; display:block;">

<?php $this->load->view("head_english"); ?>
<?php 
	if($grid_status == 1)
	{ echo 'Reguler Employee '; }
	elseif($grid_status == 2)
	{ echo 'New Employee '; }
	elseif($grid_status == 3)
	{ echo 'Left Employee '; }
	elseif($grid_status == 4)
	{ echo 'Resign Employee '; }
	elseif($grid_status == 6)
	{ echo 'Promoted Employee '; }
?>Salary Sheet For The Month of  
<?php 
$date = $salary_month;
$sal_year=trim(substr($date,0,4));
$sal_month=trim(substr($date,5,2));
$day=trim(substr($date,8,2));
$date_format = date("F-Y", mktime(0, 0, 0, $sal_month, $day, $sal_year));
echo $date_format;

?>

</div>
 
</div>


</td>
</tr>


  <tr height="10px" style="font-size: 11px;">
    <td rowspan="2"  width="15"><div align="center"><strong>SI. No</strong></div></td>
    <td rowspan="2" width="30" ><div align="center"><strong>Name of Employee</strong></div></td>
	<td rowspan="2" width="14" ><div align="center"><strong>Card No</strong></div></td>
    <td rowspan="2" width="25" ><div align="center"><strong>Designation</strong></div></td>
	 <!--<td rowspan="2" width="25"><div align="center"><strong>Section</strong></div></td>-->
    <td rowspan="2" width="25" ><div align="center"><strong>Joining Date</strong></div></td>
	<td rowspan="2" width="25" ><div align="center"><strong>Grade</strong></div></td>
    <td rowspan="2" width="20" ><div align="center"><strong>Gross</strong></div></td>
	<td colspan="3" width="30" ><div align="center"><strong>Present Day</strong></div></td>
	<td colspan="5"><div align="center"><strong>Leave Status</strong></div></td>
	<td rowspan="2"><div align="center"><strong>P.D.</strong></div></td>
	<td rowspan="2"><div align="center"><strong>T.A.</strong></div></td>
	<td rowspan="2" width="35" ><div align="center"><strong>Basic</strong></div></td>
    <td rowspan="2" width="17" ><div align="center"><strong>H/Rent</strong></div></td>
    <td rowspan="2" width="15" ><div align="center"><strong>Medical</strong></div></td>
	<td rowspan="2" width="15" ><div align="center"><strong>T.A.</strong></div></td>
	<td rowspan="2" width="15" ><div align="center"><strong>Food A.</strong></div></td>

	<td rowspan="2" width="25" ><div align="center"><strong>A.Deduct</strong></div></td>
	  
    <td rowspan="2" width="25" ><div align="center"><strong>Net Wages</strong></div></td>
    <td colspan="3" ><div align="center"><strong>No Work</strong></div></td>
    <td colspan="3" ><div align="center"><strong>Production</strong></div></td>
    <td rowspan="2" width="20px"><div align="center"><strong>Subsidiary</strong></div></td>
	<td rowspan="2"  width="15"  style="font-size:10px;"><div align="center"><strong>Attn. Bonus</strong></div></td>
   <!-- <td colspan="3" ><div align="center"><strong>OT</strong></div></td>
    <td colspan="3" ><div align="center"><strong>Night</strong></div></td> -->
    <td colspan="3" ><div align="center"><strong>Friday/Holiday</strong></div></td>
	<td rowspan="2"  width="15"  style="font-size:10px;"><div align="center"><strong>T.Payment</strong></div></td>
	<td rowspan="2"  width="15"  style="font-size:10px;"><div align="center"><strong>Stam.Deduct</strong></div></td>
    <td rowspan="2" width="22" ><div align="center"><strong>Net Pay Amount</strong></div></td>
	<td rowspan="2"  width="180"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
  </tr>
  <tr >
    <td width="15" style="font-size:8px;"><div align="center"><strong>T.D.OF M.</strong></div></td>
  	<td width="15" style="font-size:8px;"><div align="center"><strong>Work Days</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>weeked</strong></div></td>

    
	<td width="22" style="font-size:8px;"><div align="center"><strong>GL.</strong></div></td>
	<td width="22" style="font-size:8px;"><div align="center"><strong>HL.</strong></div></td>
	<td width="22" style="font-size:8px;"><div align="center"><strong>EL.</strong></div></td>
    <td width="22" style="font-size:8px;"><div align="center"><strong>CL.</strong></div></td>
	<td width="22" style="font-size:8px;"><div align="center"><strong>SL.</strong></div></td>
	
   <td width="37" style="font-size:8px;"><div align="center"><strong>Rate</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Day</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Amount</strong></div></td>
	
    <td width="37" style="font-size:8px;"><div align="center"><strong>P.Amount</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>P.B %</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>P.B</strong></div></td>
    
   <!-- <td width="37" style="font-size:8px;"><div align="center"><strong>Rate</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Amount</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Total</strong></div></td>

    <td width="37" style="font-size:8px;"><div align="center"><strong>Day</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Rate</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Amount</strong></div></td> -->
	
    <td width="37" style="font-size:8px;"><div align="center"><strong>Day</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Rate</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Amount</strong></div></td>
    
   </tr>
<?php
			
	if($counter == $page)
  	{
   		$modulus = ($row_count-1) % 8;
    	$per_page_row=$modulus;
	}
   	else
   	{
    	$per_page_row=7;
   	}
  	
   	$total_pay_wages	= 0;
	$total_pd_amounts   	= 0;
	$total_ot_amount  	= 0;
	$total_att_bonus	= 0;
	$total_gross_pays	= 0;
	$total_net_pays		= 0;
	$total_net_wages_after_deduction = 0;
	$total_net_wages_with_ot = 0;
	$per_page_stamp = 0;
	
	//Total Count Again Per Page
	$per_page_gross_salary = 0;
	$per_page_basic_salary = 0;
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
		echo "<tr height='70' style='text-align:center;' >";
		echo "<td >";
		echo $k+1;
		echo "</td>";
		
		echo "<td>";
		print_r($value[$k]->emp_full_name);
		echo '<br>';
		if($grid_status == 4)
		{
			$resign_date = $this->grid_model->get_resign_date_by_empid($value[$k]->emp_id);
			if($resign_date != false){
			echo $resign_date = date('d-M-y', strtotime($resign_date));}
		}
		elseif($grid_status == 3)
		{
			$left_date = $this->grid_model->get_left_date_by_empid($value[$k]->emp_id);
			if($left_date != false){
			echo $left_date = date('d-M-y', strtotime($left_date));}
		}
		echo "</td>"; 
				
		echo "<td>";
		print_r($value[$k]->emp_id);
		//echo $row->emp_id;
		echo "</td>";
				
		echo "<td>";
		print_r($value[$k]->desig_name);
		//echo $row->desig_name;
		echo "</td>";
		
		/*echo "<td>";
		print_r($value[$k]->sec_name);
		//echo $row->desig_name;
		echo "</td>";*/
				
				
		echo "<td>";
		$date = $value[$k]->emp_join_date;
		//print_r($value[$k]->emp_join_date);
		$year=trim(substr($date,0,4));
		$month=trim(substr($date,5,2));
		$day=trim(substr($date,8,2));
		$date_format = date("d-M-y", mktime(0, 0, 0, $month, $day, $year));
		echo $date_format;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->gr_name);
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->gross_sal);
		$per_page_gross_salary = $per_page_gross_salary + $value[$k]->gross_sal;
		echo "</td>";
		
		echo "<td>";
		$total_days = $value[$k]->total_days;
		echo $total_days - $value[$k]->before_after_absent_days;
		$total_mday = $total_mday + $total_days;
		//$total_mday = $total_mday + $value[$k]->total_days;
		//echo $row->total_days;
		echo "</td>";

        echo "<td>";
		print_r ($value[$k]->att_days);
		//echo $row->att_days;
		$total_wday = $total_wday + $value[$k]->att_days;
		echo "</td>"; 
				
		echo "<td>";
		//$holidy_weekend = $value[$k]->holidy + $value[$k]->weeked;
		$weekend = $value[$k]->weeked;
		echo $value[$k]->weeked;
		//$total_offday = $total_offday + $value[$k]->weeked;
		$total_offday = $total_offday + $weekend;
		//echo "ho_day" . $row->holiday_or_weeked;
		echo "</td>"; 
		
		echo "<td>";
		echo " ";
		echo "</td>";
		
		echo "<td>";
		$holidy = $value[$k]->holidy;
		echo $holidy;
		//$total_offday = $total_offday + $value[$k]->weeked;
		//$total_holday = $total_holday + $holidy;
		//echo "ho_day" . $row->holiday_or_weeked;
		echo "</td>";
		
		echo "<td>";
		echo " ";
		echo "</td>";
		
		$total_leave = $value[$k]->c_l + $value[$k]->s_l; // + $value[$k]->e_l + $value[$k]->m_l;
				
		echo "<td>";
		print_r ($value[$k]->c_l);
		$total_clday = $total_clday + $value[$k]->c_l;
		//echo "cl".$row->c_l;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->s_l);
		$total_slday = $total_slday + $value[$k]->s_l;
		//echo "sl".$row->s_l;
		echo "</td>";
		echo "<td>";
		$t_abs = $value[$k]->absent_days + $value[$k]->before_after_absent_days;
		echo $total_days = $value[$k]->total_days - $t_abs;
		echo "</td>";
		echo "<td>";
		
		//print_r($value[$k]->before_after_absent_days);
		//echo $t_abs;
		echo $value[$k]->absent_days;
		echo "</td>";
	/*	echo "<td>";
		print_r ($value[$k]->absent_days);
		$total_absday = $total_absday + $value[$k]->absent_days;
		//echo "abs".$row->absent_days;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->before_after_absent_days);
		$total_baabsday = $total_baabsday + $value[$k]->before_after_absent_days;
		//echo "abs".$row->absent_days;
		echo "</td>";	*/	
			
		echo "<td style='font-weight:bold;'>";
		print_r ($value[$k]->basic_sal);
		//echo "<strong>$row->gross_sal</strong>";
		$per_page_basic_salary = $per_page_basic_salary + $value[$k]->basic_sal;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->house_r);
		//echo $row->house_r;
		$house_rent = $house_rent + $value[$k]->house_r;
		echo "</td>";
			
		echo "<td>";
		echo $medical_allowance = 250;
		//echo $row->medical_a;
		$medical_all = $medical_all + $medical_allowance;
		echo "</td>";
		
		echo "<td>";
		echo $transpot_allowance = 200;
		//echo $row->medical_a;
		$transpot_allowance_all = $transpot_allowance_all + $transpot_allowance;
		echo "</td>";
		
		echo "<td>";
		echo $food_allowance = 650;
		//echo $row->medical_a;
		$food_allowance_all = $food_allowance_all + $food_allowance;
		echo "</td>";

      /*
		echo "<td>";
		print_r ($value[$k]->pay_days);
		$total_payday = $total_payday + $value[$k]->pay_days;
		echo "</td>"; */
		
		echo "<td style='text-align:center;'>";
		$abs_deduct = $value[$k]->abs_deduction;
		$ababs_deduct = $value[$k]->before_after_absent_amount;
		//$baftera_deduct = $baftera_deduct + $ababs_deduct;

		$abs_deduct = $abs_deduct + $ababs_deduct;

		echo $abs_deduct;
		echo "</td>";
		
		
		//echo "<td>";
		//print_r ($value[$k]->adv_deduct);
		//echo "ad".$row->adv_deduct;
		$adv_deduct = $adv_deduct + $value[$k]->adv_deduct; 
		$total_advance_per_page = $total_advance_per_page + $value[$k]->adv_deduct;
		$grand_total_advance_salary = $grand_total_advance_salary + $value[$k]->adv_deduct;
		//echo "</td>";
		
		$gross_salary = $value[$k]->net_pay;

			
		$pay_wages 		= $value[$k]->pay_wages; 
		$adv_deduct 	= $value[$k]->adv_deduct;
		$att_bonus 		= $value[$k]->att_bonus;
		$deduct_amount 	= $value[$k]->deduct_amount;
		
		$total_att_bonus = $total_att_bonus + $att_bonus;
		$grand_total_att_bonus = $grand_total_att_bonus + $att_bonus;
		
		
		
		
			//echo "<td>";
			$stam_value = $value[$k]->stamp;
			//echo $stam_value;
			
			$net_wages_after_deduction = $value[$k]->gross_sal - ( $abs_deduct + $adv_deduct + $deduct_amount);
		
			$total_stam_value = $total_stam_value + $stam_value;
		
		$total_net_wages_without_ot_per_page= $total_net_wages_without_ot_per_page +  $net_wages_after_deduction;
		$grand_total_net_wages_without_ot 	= $grand_total_net_wages_without_ot +  $net_wages_after_deduction;
		
		$total_stamp_deduction_per_page = $total_stamp_deduction_per_page + $stam_value;
		$grand_total_stamp_deduction 	= $grand_total_stamp_deduction + $stam_value;
        /* $Gtotal_gross_salary = $Gtotal_gross_salary + $value[$k]->gross_sal;
		 $Gtotal_basic_salary = $Gtotal_basic_salary + $value[$k]->basic_sal; */
		 $basic_now = $value[$k]->basic_sal;
		 $gross_now = $value[$k]->gross_sal;
		 $Gtotal_gross_salary = $Gtotal_gross_salary + $gross_now;
		 $Gtotal_basic_salary = $Gtotal_basic_salary + $basic_now;
		$others_deduct = $others_deduct + $value[$k]->others_deduct; 
		//echo "</td>";
			
		echo "<td style='font-weight:bold;'>";
		echo $net_wages_after_deduction;
		echo "</td>";
		
		$total_net_wages_after_deduction = $total_net_wages_after_deduction + $net_wages_after_deduction;
		$grand_total_net_wages_after_deduction = $grand_total_net_wages_after_deduction + $net_wages_after_deduction;
		
		echo "<td>";
		print_r ($value[$k]->none_work_amount);
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->none_work_day);
		$total_nowday = $total_nowday + $value[$k]->none_work_day;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->none_work_allowance);
		echo "</td>";
		
				
		echo "<td>";
		print_r ($value[$k]->pd_amount);
		//echo '<br>+';
		//echo '<br>';
		//echo $value[$k]->eot_hour;
		//echo '<br>=';
		//echo '<br>';
		$pd_amount = $value[$k]->pd_amount;// +  $value[$k]->epd_amount; 
		echo "</td>";
		
		$total_pd_amount_per_page = $total_pd_amount_per_page + $pd_amount; 
		$grand_total_pd_amount = $grand_total_pd_amount + $pd_amount; 
		
		echo "<td>";
		echo $value[$k]->pd_bonus_percent.'%';
		//echo "o_r".$row->pd_bonus_percent;
		$pd_bonus_percent = $pd_bonus_percent + $value[$k]->pd_bonus_percent; 
		echo "</td>";

		

		/*end Subsidiary*/
		
		$ot_amount = round($pd_amount * $value[$k]->pd_bonus_percent);
				
		echo "<td>";
		print_r ($value[$k]->pd_bonus_amount);
		echo "</td>";
		
		echo "<td>";
		
		/*if(($pd_amount + $value[$k]->none_work_allowance+$value[$k]->holiday_allowance) < $net_wages_after_deduction)
		{
		 echo $subsidary = $net_wages_after_deduction - ($pd_amount + $value[$k]->none_work_allowance+$value[$k]->holiday_allowance);
		 $total_subsidiary = $total_subsidiary + $subsidary;
		}
		else
		{
		 echo $subsidary = 0;
		} */
		
		$ot_rate_new = $value[$k]->gross_sal/208;
		$total_hour = $value[$k]->att_days * 2;
		$ot_amount_new = $ot_rate_new * $total_hour;
		
		if( $net_wages_after_deduction + $ot_amount_new > ($pd_amount + $value[$k]->none_work_allowance))
		{
		 $subsidary  = ( $net_wages_after_deduction + $ot_amount_new) - ($pd_amount + $value[$k]->none_work_allowance);
		 echo ceil($subsidary);
		 $total_subsidiary = $total_subsidiary + $subsidary;
		}
		else
		{
		 echo $subsidary = 0;
		}
		
		echo "</td>";
		
		echo "<td style='font-weight:bold;'>";
		print_r ($value[$k]->att_bonus);
		echo "</td>";
		
		
		
		
	/*	echo "<td>";
		print_r ($value[$k]->ot_rate);
		echo "</td>"; 
		
		echo "<td>";
		print_r ($value[$k]->ot_hour);
		$total_otamount = $total_otamount + $value[$k]->ot_hour;
		echo "</td>";
		
		$ot_amount_trk =$value[$k]->ot_amount;
		echo "<td>";
		print_r ($ot_amount_trk);
		echo "</td>";  */
		
		$total_ot_amount = $total_ot_amount + $value[$k]->ot_amount;
		$grand_total_ot_amount = $grand_total_ot_amount + $value[$k]->ot_amount;

		
	/*	echo "<td>";
		print_r ($value[$k]->night_allowance_no);
		$total_nday = $total_nday + $value[$k]->night_allowance_no;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->night_allowance_rate);
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->night_allowance);
		echo "</td>";  */
		$total_night_amount_per_page = $total_night_amount_per_page + $value[$k]->night_allowance;
		
		
		echo "<td>";
		print_r ($value[$k]->holiday_allowance_no);
		$total_fhday = $total_fhday + $value[$k]->holiday_allowance_no;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->holiday_allowance_rate);
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->holiday_allowance);
		echo "</td>";

		
		$total_friday_amount_per_page = $total_friday_amount_per_page + $value[$k]->holiday_allowance;
		$total_nw_amount_per_page = $total_nw_amount_per_page+$value[$k]->none_work_allowance;
		$total_ot_amount_per_page = $total_ot_amount_per_page + $ot_amount;
		$total_pd_bonus_per_page = $total_pd_bonus_per_page  + $value[$k]->pd_bonus_amount;
		//$grand_total_ot_amount = $grand_total_ot_amount + $ot_amount;
		
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
		
		
		
        echo "<td style='font-weight:bold;'>";
		 $total_amount = ($subsidary + $pd_amount  + $att_bonus + $value[$k]->pd_bonus_amount+$value[$k]->night_allowance+$value[$k]->holiday_allowance+$value[$k]->none_work_allowance);
		 echo ceil($total_amount);
		$total_pay_amount = $total_pay_amount + $total_amount;
		$gtotal_pay_amount = $gtotal_pay_amount + $total_amount;
		echo "</td>";		
					
		echo "<td>";
		echo $stam_value = $value[$k]->stamp;
		$per_page_stamp = $per_page_stamp + $stam_value;
		$grand_total_stamp = $grand_total_stamp + $stam_value;
		echo "</td>";
		echo "<td style='font-weight:bold;'>";
		//echo $net_wages_with_ot;
		
		$total_pay = ($subsidary + $pd_amount  + $att_bonus + $value[$k]->pd_bonus_amount+$value[$k]->night_allowance+$value[$k]->holiday_allowance+$value[$k]->none_work_allowance) - $stam_value;
		echo ceil($total_pay);
		echo "</td>";
		
		$total_net_wages_with_ot = $total_net_wages_with_ot + $total_pay;
		//$grand_total_net_wages_with_ot = $grand_total_ot_amount + $total_pay;
		$grand_total_net_wages_with_ot = $grand_total_net_wages_with_ot + $total_pay;
		
		
			
		echo "<td>";
		echo "&nbsp;";
		echo "</td>";
		
			
		echo "</tr>"; 
		$k++;
	}
	?>
	<tr style="font-size: 11px; height: 7px;">
		<td align="center" colspan="6"><strong>Total Per Page</strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($per_page_gross_salary);?></strong></td>
		<td colspan="1"><?php echo number_format($total_mday);?></td>
		<td colspan="1"><?php echo number_format($total_wday);?></td>
		<td colspan="1"><?php echo number_format($total_offday);?></td>
		<td colspan="1"><?php echo " ";?></td>
		<td colspan="1"><?php echo " ";?></td>
		<td colspan="1"><?php echo " ";?></td>
		<td colspan="1"><?php echo number_format($total_clday);?></td>
		<td colspan="1"><?php echo number_format($total_slday);?></td>
		<td colspan="1"><?php echo " ";?></td>
		<td colspan="1"><?php echo " ";?></td>

		<td colspan="1"><?php echo number_format($per_page_basic_salary);?></td>
		<td colspan="1"><?php echo " ";?></td>
		<td colspan="1"><?php echo " ";?></td>
		<td colspan="1"><?php echo number_format($transpot_allowance_all);?></td>
		<td colspan="1"><?php echo number_format($food_allowance_all);?></td>
		<!--<td colspan="1"><?php echo number_format($total_payday);?></td> -->
		
	
        <td align="right"><strong><?php echo " ";?></strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($total_net_wages_after_deduction);?></strong></td>
        
		<td align="right" colspan="1"></td>
        <td align="right" colspan="1"><?php echo number_format($total_nowday);?></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_nw_amount_per_page);?></strong></td>
		
        <td align="center"><strong><?php echo $english_format_number = number_format($total_pd_amount_per_page);?></strong></td>
        <td align="right" colspan="1"></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_pd_bonus_per_page);?></strong></td>
        <td align="right" colspan="1"><?php echo number_format(ceil($total_subsidiary));?></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_att_bonus);?></strong></td>
        
       <!-- <td align="right" colspan="1"><strong><?php //echo "" ;?></strong></td>
		<td align="right" colspan="1"><strong><?php //echo number_format($total_otamount);?></strong></td>
		<td align="right" colspan="1"><strong><?php //echo number_format($total_ot_amount);?></strong></td> -->
		
		<!-- <td align="right" colspan="1"><?php echo number_format($total_nday); ?></td>
		 <td align="right" colspan="1"></td>
		  
        <td align="right"><strong><?php echo $english_format_number = number_format($total_night_amount_per_page);?></strong></td> -->
 
        <td align="right" colspan="1"><?php echo number_format($total_fhday);?></td>
        <td align="right" colspan="1"></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_friday_amount_per_page);?></strong></td>
         <td align="right" colspan="1"><strong><?php echo $english_format_number = number_format($total_pay_amount);?></strong></td>
		 <td align="right" colspan="1"><strong><?php echo $per_page_stamp ;?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_net_wages_with_ot);?></strong></td>
		
	</tr>
	<?php
	if($counter == $page)
   		{?>
			<tr>
			<td colspan="6" align="center"><strong>Grand Total Amount Tk</strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($Gtotal_gross_salary);?></strong></td>
			<td colspan="1"><?php echo number_format($Gtotal_mday);?></td>
			<td colspan="1"><?php echo number_format($Gtotal_wday);?></td>
			<td colspan="1"><?php echo number_format($Gtotal_offday);?></td>
			<td colspan="1"><?php echo " ";?></td>
			<td colspan="1"><?php echo " ";?></td>
			<td colspan="1"><?php echo " ";?></td>
			<td colspan="1"><?php echo number_format($Gtotal_clday);?></td>
			<td colspan="1"><?php echo number_format($Gtotal_slday);?></td>
			<td colspan="1"><?php echo " ";?></td>
		    <td colspan="1"><?php echo " ";?></td>
			<!-- <td colspan="1"><?php echo number_format($Gtotal_absday);?></td>
			<td colspan="1"><?php echo number_format($Gtotal_baabsday);?></td> -->
			<td align="right"><strong><?php echo $english_format_number = number_format($Gtotal_basic_salary);?></strong></td>
			<td colspan="1"><?php echo " ";?></td>
		    <td colspan="1"><?php echo " ";?></td>
			<td colspan="1"><?php echo number_format($Gtotal_transpot_allowance_all);?></td>
		     <td colspan="1"><?php echo number_format($Gtotal_food_allowance_all);?></td>
			<!--<td colspan="1"><?php echo number_format($Gtotal_payday);?></td> -->

            <td align="right"><strong><?php echo " ";?></strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_net_wages_after_deduction);?></strong></td>
            <td align="right" colspan="1"></td>
            <td align="right" colspan="1"><?php echo number_format($Gtotal_nowday);?></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_nw_amount);?></strong></td>

            <td align="center"><strong><?php echo $english_format_number = number_format($grand_total_pd_amount);?></strong></td>
            <td colspan="1"></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_pb_amount);?></strong></td>
            <td align="right" colspan="1"><strong><?php echo number_format(ceil($Gtotal_subsidiary));?></strong></td>
            <td align="right" ><strong><?php echo $english_format_number = number_format($grand_total_att_bonus);?></strong></td>
           <!-- <td align="right" colspan="1"><strong><?php //echo "" ;?></strong></td>
			<td align="right" colspan="1"><strong><?php //echo number_format($Gtotal_otamount);?></strong></td>
			<td align="right" colspan="1"><strong><?php //echo number_format($grand_total_ot_amount);//echo $grand_total_ot_amount;?></strong></td> -->
			
			<!--<td align="right" colspan="1"><?php echo number_format($Gtotal_nday); ?></td>
			<td align="right" colspan="1"></td>

            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_night_amount);?></strong></td> -->
            <!--<td align="right" colspan="1"></td>
        	<td align="right" colspan="1"></td>
        	<td align="right" colspan="1"></td>-->
        	<td align="right" colspan="1"><?php echo number_format($Gtotal_fhday);?></td>
        	<td align="right" colspan="1"></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_friday_amount);?></strong></td>
            <!--<td align="right" colspan="1"></td>
            <td align="right" colspan="1"></td>
            <td align="right" colspan="1"></td>-->
			<td align="right" colspan="1"><strong><?php echo $english_format_number = number_format($gtotal_pay_amount);?></strong></td>
			<td align="right" colspan="1"><strong><?php echo $grand_total_stamp;?></strong></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_net_wages_with_ot);?></strong></td>
			
			</tr>
			<?php } ?>
			 </table>
			 <br/>
			<table width="100%" height="60px" border="0" align="center" style="margin-bottom:75px; font-family:Arial, Helvetica, sans-serif;">
			<tr height="10px" >
			<td colspan="28"></td>
			</tr>
			<tr height="10%">
				<td></td>
				<td  align="center">Prepared By</td>
				<td  align="center">Accounts</td>
				<td  align="center">Checked BY</td>
				<td  align="center">Managing Director</td>
				<td></td>
				
			</tr>
			
			</table>
			<br/><br/><br/>
			
			 
			<?php

		}

?>
</table>

<table width="400px" border="1px solid gray" cellspacing="0" cellpadding="0" style="font-size:12px; border-collapse:collapse;margin:0 auto;">
     <tr><td><b>Section Name</b></td><td><b>Sec. Wise Amount</b></td></tr>
	 <?php 

	   //$column_name = "net";
	    $this->db->select('sec_id, sec_name');
		$query = $this->db->get('pr_section');
		$all = $query->result_array();
		
		$finalval = array();
		$Tsamount = 0;
		foreach($all as $key=>$val)
		{
           $finalval['values'][$key] = $this->pd_report_model->production_monthly_section_block_wise_salary_summary($salary_month, $grid_status, $val['sec_id'], 'ismailvai');

           	$Tsamount = $Tsamount + $finalval['values'][$key]['total_net_pay'];
           	echo '<tr>'; 
           	echo '<td>'.$val['sec_name'].'</td>'; 

           	echo '<td>'.$finalval['values'][$key]['total_net_pay'].'</td>';
           	echo '</tr>';
		}	

	  ?>
 
 	<tr>
  		<td><?php echo "<b>GTotalAmount:</b>"; ?></td>
  		<td><?php echo number_format($Tsamount); ?></td>
  	</tr>
</table>

</body>
</html>