<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->
</head>

<body>
<?php
$filename = "araf.xls";
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
?>

<body>

<?php
// echo $all_gross_total;exit;
$row_count=count($value);
if($row_count >7)
{
$page=ceil($row_count/7);
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
<table style="vertical-align: middle;">

<?php
for($counter = 1; $counter <= $page; $counter ++)
{
?>

<table align="center" height="auto" class="sal" border="1" cellspacing="0" cellpadding="0" style="vertical-align: middle;font-size:8px; width:auto; border-collapse:collapse;">

<tr style="vertical-align: middle;">
<td colspan="36">

<!-- <div style="width:100%">-->
<table>
<tr>
<td colspan="17">
<!--<div style="text-align:center;border:5px solid #000; position:relative;padding-left:10px;width:300px; float:left; font-weight:bold">-->
<?php 

$date = date('d-m-Y');
//echo "Payment Date : $date"; 

$section_name = $value[0]->sec_name;
if($section_name == 'knitting')
{
  echo 'সেকশন  : নিটিং<br>';
}
else
{
	echo "Section : $section_name<br>";
}

echo "Page No # $counter of $page";
if($floor != "Select")
{
	$floor_name = $this->db->where("posi_id",$floor)->get('pr_emp_position')->row()->posi_name;
	echo "&nbsp;&nbsp;&nbsp;ফ্লোর : $floor_name";
}
if($block != "Select")
{
	$block_name = $this->db->where("line_id",$block)->get('pr_line_num')->row()->line_name;
	echo "&nbsp;&nbsp;&nbsp;ব্লক : $block_name";
}
?>
</td>
<!-- </div> -->


<!-- <div style="font-family:SutonnyMJ;text-align:center; position:relative;padding-left:10px;width:50%
; overflow:hidden; float:left; display:block;">
<table width="500px"> -->

<td colspan="19" style="text-align: left;">
<?php $this->load->view("head_bangla_excel"); ?>
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
?> 
<?php 
$date = $salary_month;
$sal_year=trim(substr($date,0,4));
$sal_month=trim(substr($date,5,2));
$day=trim(substr($date,8,2));
$date_format = date("m-Y", mktime(0, 0, 0, $sal_month, $day, $sal_year));
echo $date_format.' '.'মাসের বেতনের তালিকা';

?>
</td>
</tr>
 </table>
 </td>
</tr>


  <tr height="10px" style="font-size: 8px;vertical-align: middle;">
    <td rowspan="2"  width="15"><div align="center"><strong>ক্রমিক নং</strong></div></td>
    <td rowspan="2" width="30" ><div align="center"><strong>শ্রমিকের নাম</strong></div></td>
	<td rowspan="2" width="14" ><div align="center"><strong>কার্ড নং</strong></div></td>
    <td rowspan="2" width="25" ><div align="center"><strong>পদবী</strong></div></td>
	 <!--<td rowspan="2" width="25"><div align="center"><strong>Section</strong></div></td>-->
    <td rowspan="2" width="30" ><div align="center"><strong>যোগদানের তাং</strong></div></td>
	<td rowspan="2" width="25" ><div align="center"><strong>গ্রেড</strong></div></td>
    <td rowspan="2" width="15" ><div align="center"><strong>মোট বেতন</strong></div></td>
	<td colspan="3" width="40" ><div align="center"><strong>হাজিরা তথ্য</strong></div></td>
	<td colspan="5"><div align="center"><strong>ছুটির অবস্থা</strong></div></td>
	<td rowspan="2"><div align="center"><strong>মোট হাজিরা</strong></div></td>
	<td rowspan="2"><div align="center"><strong>অনুপস্থিতি</strong></div></td>
	<td colspan="5" width="25" ><div align="center"><strong>প্রদানের ধরণ</strong></div></td>

	<td rowspan="2" width="25" ><div align="center"><strong>অনুপস্থিতি কর্তন</strong></div></td>
	  
    <td rowspan="2" width="25" ><div align="center"><strong>নূন্যতম বেতন</strong></div></td>
    <td colspan="3" ><div align="center"><strong>কাজ বিহীন তথ্য</strong></div></td>
    <td colspan="3" ><div align="center"><strong>উৎপাদন সম্পর্কিত তথ্য</strong></div></td>
    <td rowspan="2" width="20px"><div align="center"><strong>সহায়ক পরিমাণ</strong></div></td>
	<td rowspan="2"  width="15"  style="font-size:8px;"><div align="center"><strong>হাজিরা বোনাস</strong></div></td>
   <!-- <td colspan="3" ><div align="center"><strong>OT</strong></div></td>
    <td colspan="3" ><div align="center"><strong>Night</strong></div></td> -->
    <!--<td colspan="3" ><div align="center"><strong>শক্রবার/ছুটি</strong></div></td>-->
	<td rowspan="2"  width="15"  style="font-size:8px;"><div align="center"><strong>মোট বেতন</strong></div></td>
	<td rowspan="2"  width="15"  style="font-size:8px;"><div align="center"><strong>স্ট্যাম্প কর্তন</strong></div></td>
	<td rowspan="2"  width="15"  style="font-size:8px;"><div align="center"><strong>অগ্রিম বেতন</strong></div></td>
    <td rowspan="2" width="30" ><div align="center"><strong>পাপ্ত টাকা</strong></div></td>
	<td rowspan="2"  width="143"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;স্বাক্ষর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
  </tr>
  <tr style="vertical-align: middle;">
    <td width="15" style="font-size:8px;"><div align="center"><strong>মাসের মোট দিন</strong></div></td>
  	<td width="15" style="font-size:8px;"><div align="center"><strong>উপস্থিতি দিন</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>সপ্তাহ  ছুটি</strong></div></td>

    
	<td width="25" style="font-size:8px;"><div align="center"><strong>সাধারণ ছুটি</strong></div></td>
	<td width="25" style="font-size:8px;"><div align="center"><strong>উৎসব ছুটি </strong></div></td>
	<td width="25" style="font-size:8px;"><div align="center"><strong>অর্জিত ছুটি</strong></div></td>
    <td width="25" style="font-size:8px;"><div align="center"><strong>নৈমিত্তিক ছুটি</strong></div></td>
	<td width="25" style="font-size:8px;"><div align="center"><strong>চিকিৎসা ছুটি</strong></div></td>

	<td width="22" ><div align="center"><strong>মূল বেতন</strong></div></td>
    <td width="22" ><div align="center"><strong>বাড়ী ভাড়া</strong></div></td>
    <td width="22" ><div align="center"><strong>চিকিৎসা</strong></div></td>
	<td width="22" ><div align="center"><strong>যাতায়াত</strong></div></td>
	<td width="22" ><div align="center"><strong>খাদ্য</strong></div></td>
	
   <td width="37" style="font-size:8px;"><div align="center"><strong>রেট</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>দিন</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>পরিমাণ</strong></div></td>
	
    <td width="37" style="font-size:8px;"><div align="center"><strong>উৎপাদনের মুজুরী</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>উৎপাদন বোনাস(%)</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>উৎপাদন বোনাস</strong></div></td>
    
   <!-- <td width="37" style="font-size:8px;"><div align="center"><strong>Rate</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Amount</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Total</strong></div></td>

    <td width="37" style="font-size:8px;"><div align="center"><strong>Day</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Rate</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>Amount</strong></div></td> -->
	
   <!-- <td width="37" style="font-size:8px;"><div align="center"><strong>দিন</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>রেট</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>পরিমাণ</strong></div></td> -->
    
   </tr>
<?php
			
	if($counter == $page)
  	{
   		$modulus = ($row_count-1) % 7;
    	$per_page_row=$modulus;
	}
   	else
   	{
    	$per_page_row=6;
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
		echo "<tr height='70' style='text-align:center;vertical-align: middle;'>";
		echo "<td style='font-family:SutonnyMJ;'>";
		echo $k+1;
		echo "</td>";
		
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r($value[$k]->bangla_nam);
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
				
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r($value[$k]->desig_bangla);
		//echo $row->desig_name;
		echo "</td>";
		
		/*echo "<td>";
		print_r($value[$k]->sec_name);
		//echo $row->desig_name;
		echo "</td>";*/
				
				
		echo "<td style='font-family:SutonnyMJ;'>";
		$date = $value[$k]->emp_join_date;
		//print_r($value[$k]->emp_join_date);
		$year=trim(substr($date,0,4));
		$month=trim(substr($date,5,2));
		$day=trim(substr($date,8,2));
		$date_format = date("d-m-y", mktime(0, 0, 0, $month, $day, $year));
		echo $date_format;
		echo "</td>";
			
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r ($value[$k]->gr_name);
		echo "</td>";
			
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r ($value[$k]->gross_sal);
		$per_page_gross_salary = $per_page_gross_salary + $value[$k]->gross_sal;
		echo "</td>";
		
		echo "<td style='font-family:SutonnyMJ;'>";
		$total_days = $value[$k]->total_days;
		echo $total_days - $value[$k]->before_after_absent_days;
		$total_mday = $total_mday + $total_days;
		//$total_mday = $total_mday + $value[$k]->total_days;
		//echo $row->total_days;
		echo "</td>";

        echo "<td style='font-family:SutonnyMJ;'>";
		print_r ($value[$k]->att_days);
		//echo $row->att_days;
		$total_wday = $total_wday + $value[$k]->att_days;
		echo "</td>"; 
				
		echo "<td style='font-family:SutonnyMJ;'>";
		//$holidy_weekend = $value[$k]->holidy + $value[$k]->weeked;
		$weekend = $value[$k]->weeked;
		echo $value[$k]->weeked;
		//$total_offday = $total_offday + $value[$k]->weeked;
		$total_offday = $total_offday + $weekend;
		//echo "ho_day" . $row->holiday_or_weeked;
		echo "</td>"; 
		
		echo "<td style='font-family:SutonnyMJ;'>";
		echo " ";
		echo "</td>";
		
		echo "<td style='font-family:SutonnyMJ;'>";
		$holidy = $value[$k]->holidy;
		echo $holidy;
		//$total_offday = $total_offday + $value[$k]->weeked;
		//$total_holday = $total_holday + $holidy;
		//echo "ho_day" . $row->holiday_or_weeked;
		echo "</td>";
		
		echo "<td style='font-family:SutonnyMJ;'>";
		echo " ";
		echo "</td>";
		
		$total_leave = $value[$k]->c_l + $value[$k]->s_l; // + $value[$k]->e_l + $value[$k]->m_l;
				
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r ($value[$k]->c_l);
		$total_clday = $total_clday + $value[$k]->c_l;
		//echo "cl".$row->c_l;
		echo "</td>";
			
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r ($value[$k]->s_l);
		$total_slday = $total_slday + $value[$k]->s_l;
		//echo "sl".$row->s_l;
		echo "</td>";
		echo "<td style='font-family:SutonnyMJ;'>";
		$t_abs = $value[$k]->absent_days + $value[$k]->before_after_absent_days;
		echo $total_days = $value[$k]->total_days - $t_abs;
		echo "</td>";
		echo "<td style='font-family:SutonnyMJ;'>";
		
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
			
		echo "<td style='font-weight:bold;font-family:SutonnyMJ'>";
		print_r ($value[$k]->basic_sal);
		//echo "<strong>$row->gross_sal</strong>";
		$per_page_basic_salary = $per_page_basic_salary + $value[$k]->basic_sal;
		echo "</td>";
		
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r ($value[$k]->house_r);
		//echo $row->house_r;
		$house_rent = $house_rent + $value[$k]->house_r;
		echo "</td>";
			
		echo "<td style='font-family:SutonnyMJ;'>";
		echo $medical_allowance = 250;
		//echo $row->medical_a;
		$medical_all = $medical_all + $medical_allowance;
		echo "</td>";
		
		echo "<td style='font-family:SutonnyMJ;'>";
		echo $transpot_allowance = 200;
		//echo $row->medical_a;
		$transpot_allowance_all = $transpot_allowance_all + $transpot_allowance;
		echo "</td>";
		
		echo "<td style='font-family:SutonnyMJ;'>";
		echo $food_allowance = 650;
		//echo $row->medical_a;
		$food_allowance_all = $food_allowance_all + $food_allowance;
		echo "</td>";

      /*
		echo "<td>";
		print_r ($value[$k]->pay_days);
		$total_payday = $total_payday + $value[$k]->pay_days;
		echo "</td>"; */
		
		echo "<td style='text-align:center;font-family:SutonnyMJ'>";
		$abs_deduct = $value[$k]->abs_deduction;
		$ababs_deduct = $value[$k]->before_after_absent_amount;
		//$baftera_deduct = $baftera_deduct + $ababs_deduct;

		$abs_deduct = $abs_deduct + $ababs_deduct;

		echo $abs_deduct;
		echo "</td>";
		
		
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
			
			$net_wages_after_deduction = $value[$k]->gross_sal - ($abs_deduct + $deduct_amount);
		
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
			
		echo "<td style='font-weight:bold;font-family:SutonnyMJ'>";
		echo $net_wages_after_deduction;
		echo "</td>";
		
		$total_net_wages_after_deduction = $total_net_wages_after_deduction + $net_wages_after_deduction;
		$grand_total_net_wages_after_deduction = $grand_total_net_wages_after_deduction + $net_wages_after_deduction;
		
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r ($value[$k]->none_work_amount);
		echo "</td>";
		
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r ($value[$k]->none_work_day);
		$total_nowday = $total_nowday + $value[$k]->none_work_day;
		echo "</td>";
		
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r ($value[$k]->none_work_allowance);
		echo "</td>";
		
				
		echo "<td style='font-family:SutonnyMJ;'>";
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
		
		echo "<td style='font-family:SutonnyMJ;'>";
		echo $value[$k]->pd_bonus_percent.'%';
		//echo "o_r".$row->pd_bonus_percent;
		$pd_bonus_percent = $pd_bonus_percent + $value[$k]->pd_bonus_percent; 
		echo "</td>";

		

		/*end Subsidiary*/
		
		$ot_amount = round($pd_amount * $value[$k]->pd_bonus_percent);
				
		echo "<td style='font-family:SutonnyMJ;'>";
		print_r ($value[$k]->pd_bonus_amount);
		echo "</td>";
		
		echo "<td style='font-family:SutonnyMJ;'>";
		
		/*if(($pd_amount + $value[$k]->none_work_allowance+$value[$k]->holiday_allowance) < $net_wages_after_deduction)
		{
		 echo $subsidary = $net_wages_after_deduction - ($pd_amount + $value[$k]->none_work_allowance+$value[$k]->holiday_allowance);
		 $total_subsidiary = $total_subsidiary + $subsidary;
		}
		else
		{
		 echo $subsidary = 0;
		} */
		
		/*$ot_rate_new = $value[$k]->gross_sal/208;
		$total_hour = $value[$k]->att_days * 2;
		$ot_amount_new = $ot_rate_new * $total_hour;*/
		
		if( $net_wages_after_deduction > ($pd_amount + $value[$k]->none_work_allowance))
		{
		 $subsidary  = ($net_wages_after_deduction) - ($pd_amount + $value[$k]->none_work_allowance);
		 echo ceil($subsidary);
		 
		 $total_subsidiary = $total_subsidiary + $subsidary;
		}
		else
		{
		 echo $subsidary = 0;
		}
		
		echo "</td>";
		
		echo "<td style='font-weight:bold;font-family:SutonnyMJ'>";
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
		
		
		/*echo "<td>";
		print_r ($value[$k]->holiday_allowance_no);
		$total_fhday = $total_fhday + $value[$k]->holiday_allowance_no;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->holiday_allowance_rate);
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->holiday_allowance);
		echo "</td>"; */

		
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
		
		
		
        echo "<td style='font-weight:bold;font-family:SutonnyMJ'>";
		 $total_amount = ($subsidary + $pd_amount  + $att_bonus + $value[$k]->pd_bonus_amount+$value[$k]->night_allowance+$value[$k]->holiday_allowance+$value[$k]->none_work_allowance);

		 echo ceil($total_amount);
		$total_pay_amount = $total_pay_amount + $total_amount;
		$gtotal_pay_amount = $gtotal_pay_amount + $total_amount;
		echo "</td>";		
					
		echo "<td style='font-family:SutonnyMJ;'>";
		echo $stam_value = $value[$k]->stamp;
		$per_page_stamp = $per_page_stamp + $stam_value;
		$grand_total_stamp = $grand_total_stamp + $stam_value;
		echo "</td>";
		
		echo "<td>";
		
		
		print_r ($value[$k]->adv_deduct);
		$adv_deduct = $adv_deduct + $value[$k]->adv_deduct; 
		$total_advance_per_page = $total_advance_per_page + $value[$k]->adv_deduct;
		$grand_total_advance_salary = $grand_total_advance_salary + $value[$k]->adv_deduct;
		echo "</td>";
		
		echo "<td style='font-weight:bold;font-family:SutonnyMJ'>";
		
		//echo $net_wages_with_ot;
		
		$total_pay = ($subsidary + $pd_amount  + $att_bonus + $value[$k]->pd_bonus_amount+$value[$k]->night_allowance+$value[$k]->holiday_allowance+$value[$k]->none_work_allowance) - $stam_value - $value[$k]->adv_deduct;

		echo ceil($total_pay);
		echo "</td>";
		
		$total_net_wages_with_ot = $total_net_wages_with_ot + $total_pay;
		//$grand_total_net_wages_with_ot = $grand_total_ot_amount + $total_pay;
		$grand_total_net_wages_with_ot = $grand_total_net_wages_with_ot + $total_pay;
		
		
			
		echo "<td style='height:80px;font-family:SutonnyMJ;'>";
		echo "&nbsp;";
		echo "</td>";
		
			
		echo "</tr>"; 
		$k++;
	}
	?>
	<tr style="font-size: 10px; height: 25px;font-family:SutonnyMJ;vertical-align: middle;">
		<td align="center" colspan="6"><strong>মোট পার পেইজ</strong></td>
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
 
     <!--   <td align="right" colspan="1"><?php echo number_format($total_fhday);?></td>
        <td align="right" colspan="1"></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_friday_amount_per_page);?></strong></td> -->
         <td align="right" colspan="1"><strong><?php echo $english_format_number = number_format($total_pay_amount);?></strong></td>
		 <td align="right" colspan="1"><strong><?php echo $per_page_stamp ;?></strong></td>
		 <td align="right" colspan="1"><?php echo $total_advance_per_page; ?></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_net_wages_with_ot);?></strong></td>
		
	</tr>
	<?php
	if($counter == $page)
   		{?>
			<tr style="font-size: 10px;font-family:SutonnyMJ;height:25px;vertical-align: middle;">
			<td colspan="6" align="center"><strong>সর্বমোট পরিমাণ টাকা</strong></td>
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

        	<!--<td align="right" colspan="1"><?php echo number_format($Gtotal_fhday);?></td>
        	<td align="right" colspan="1"></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_friday_amount);?></strong></td>-->
            <!--<td align="right" colspan="1"></td>
            <td align="right" colspan="1"></td>
            <td align="right" colspan="1"></td>-->
			<td align="right" colspan="1"><strong><?php echo $english_format_number = number_format($gtotal_pay_amount);?></strong></td>
			<td align="right" colspan="1"><strong><?php echo $grand_total_stamp;?></strong></td>
			<td align="right" colspan="1"><?php echo $grand_total_advance_salary; ?></td>
            <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_net_wages_with_ot);?></strong></td>
			</tr>


			<?php
             if($salary_month=='2020-01-01')
			 {
				 if($section_name=='Linking')
				 {
					 $all_subsidiary = $all_subsidiary - 5500;
				     $all_block_total = $all_block_total - 5500;
				     $all_pay_amount = $all_pay_amount - 5500;
				 }else{
					 $all_subsidiary = $all_subsidiary;
				     $all_block_total = $all_block_total;
				     $all_pay_amount = $all_pay_amount;
				 }
				 
			 }else{
				 $all_block_total = $all_block_total;
				 $all_subsidiary = $all_subsidiary;
				 $all_pay_amount = $all_pay_amount;
			 }		 
			
			if($section=='1' && $block=='4'){?>
			<tr style="font-size: 11px;font-family:SutonnyMJ;">
		       <td colspan="6" style="text-align: center;font-weight: bold;">সব ব্লকের সর্বমোট পরিমাণ</td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_gross_total)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_mday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_wday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_offday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_clday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_slday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_basic_salary)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_transpot_allowance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_food_allowance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_net_wages_after_deduction)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_nowday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_nw_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pd_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pb_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_subsidiary)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_att_bonus)) ?></td>
		      <!-- <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_fhday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_friday_amount)) ?></td> -->
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pay_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_stamp)) ?></td>
			   <td colspan="1" style="font-weight: bold;"><?=number_format(round($grand_total_advance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_block_total)) ?></td>
	       </tr>
		   
		   <?php } if($section=='1' && $block=='2'){?>
			<tr style="font-size: 11px;font-family:SutonnyMJ;">
		       <td colspan="6" style="text-align: center;font-weight: bold;">সব ব্লকের সর্বমোট পরিমাণ</td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_gross_total)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_mday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_wday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_offday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_clday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_slday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_basic_salary)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_transpot_allowance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_food_allowance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_net_wages_after_deduction)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_nowday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_nw_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pd_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pb_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_subsidiary)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_att_bonus)) ?></td>
		      <!-- <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_fhday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_friday_amount)) ?></td> -->
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pay_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_stamp)) ?></td>
			   <td colspan="1" style="font-weight: bold;"><?=number_format(round($grand_total_advance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_block_total)) ?></td>
	       </tr>
		   
		   <?php }elseif($section=='2' && $block=='5') { ?>
              <tr style="font-size: 11px;font-family:SutonnyMJ;">
		       <td colspan="6" style="text-align: center;font-weight: bold;">সব ব্লকের সর্বমোট পরিমাণ</td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_gross_total)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_mday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_wday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_offday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_clday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_slday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_basic_salary)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_transpot_allowance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_food_allowance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_net_wages_after_deduction)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_nowday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_nw_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pd_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pb_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_subsidiary)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_att_bonus)) ?></td>
		      <!-- <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_fhday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_friday_amount)) ?></td> -->
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pay_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_stamp)) ?></td>
			   <td colspan="1" style="font-weight: bold;"><?=number_format(round($grand_total_advance))?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_block_total)) ?></td>
	       </tr>
		   <?php } elseif($section !='1' && $section !='2') { ?>
		    <tr style="font-size: 11px;font-family:SutonnyMJ;">
		       <td colspan="6" style="text-align: center;font-weight: bold;">সব ব্লকের সর্বমোট পরিমাণ</td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_gross_total)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_mday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_wday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_offday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_clday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_slday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_basic_salary)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_transpot_allowance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_food_allowance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_net_wages_after_deduction)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_nowday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_nw_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pd_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pb_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_subsidiary)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_att_bonus)) ?></td>
		      <!-- <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_fhday)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=" " ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_friday_amount)) ?></td> -->
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_pay_amount)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_stamp)) ?></td>
			   <td colspan="1" style="font-weight: bold;"><?=number_format(round($grand_total_advance)) ?></td>
		       <td colspan="1" style="font-weight: bold;"><?=number_format(round($all_block_total)) ?></td>
	       </tr>
		   
		   <?php } ?>
			<?php } ?>
			 </table>
			 <table border="0" align="center" style="width:100%;margin-bottom:75px; font-family:Arial, Helvetica, sans-serif;vertical-align: middle;">
			<tr height="25" >
				<td colspan="36"></td>
			</tr>
			<tr height="25" style="font-family:SutonnyMJ;vertical-align: middle;">
				<td></td>
				<td colspan="9" height="50px;" align="center" style="width: 400px;padding:20px;padding: 30px;">প্রস্তুতকারক</td>
				<td colspan="9" align="center">ব্যবস্থাপক প্রশাসন</td>
				<td colspan="9" align="center">প্রধান হিসাব কর্মকর্তা</td>
				<td colspan="9" align="center">অনুমোদন কারী</td>
				<td></td>
				
			</tr>
			<tr height="25" >
				<td colspan="36"></td>
			</tr>
		</table>
			
			 
			<?php

		}

?>
</table>

</body>
</html>