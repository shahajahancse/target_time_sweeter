<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/print.css" media="print" />
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
			$grand_total_salary_after_abs_deduction = 0;
			$grand_total_selected_payable_amount = 0;
			
			$grand_total_info_first 	= 0;
			$grand_total_info_second 	= 0;
			$grand_total_info_third 	= 0;
			$grand_total_info_forth 	= 0;
			$grand_total_info_fifth 	= 0;
			$grand_total_pd_amount_per_page = 0;
			$grand_total_pd_bonus_per_page = 0;
			$grand_total_gross_sal_per_page = 0;
			$grand_total_total_pd_amount =0;
			
			?>
			<table >
			
			<?php
for ( $counter = 1; $counter <= $page; $counter ++)
{
?>

<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="0" style="font-size:12px; width:auto; border-collapse:collapse;">

<tr height="50px">

<?php if($deduct_status == "Yes"){?> 
<td colspan="35" align="center">
<?php }else{ ?>
<td colspan="35" align="center">
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

<?php $this->load->view("head_bangla"); ?>
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
    <td rowspan="2"  width="15" height="20px"><div align="center"><strong>ক্রমিক নং</strong></div></td>
    <td rowspan="2" width="30" height="20px"><div align="center"><strong>নাম</strong></div></td>
	<td rowspan="2" width="14" height="20px"><div align="center"><strong>কার্ড নং</strong></div></td>
    <td rowspan="2" width="25" height="20px"><div align="center"><strong>পদবী</strong></div></td>
	 <td rowspan="2" width="25" height="20px"><div align="center"><strong>সেকশন</strong></div></td>
    <td rowspan="2" width="25" height="20px"><div align="center"><strong>যোগদানের তাং</strong></div></td>
	<td rowspan="2" width="25" height="20px"><div align="center"><strong>গ্রেড</strong></div></td>
     <td rowspan="2" width="20" height="20px"> <div align="center"><strong>মূল বেতন</strong></div></td>
    <td rowspan="2" width="17" height="20px"><div align="center"><strong>বাড়ী ভাড়া</strong></div></td>
    <td rowspan="2" width="15" height="20px"><div align="center"><strong>চিকিৎসা</strong></div></td>
    <td rowspan="2" width="15" height="20px"><div align="center"><strong>যাতায়াত ভাতা</strong></div></td>
    <td rowspan="2" width="15" height="20px"><div align="center"><strong>খাদ্য ভাতা</strong></div></td>
    <td rowspan="2" width="35" height="20px"><div align="center"><strong>মোট মজুরী</strong></div></td>
    <td rowspan="2" width="31" height="20px"><div align="center"><strong>মোট দিন</strong></div></td>
    <td colspan="4" width="30" height="20px"><div align="center"><strong>মোট উপস্থিতি (সাপ্তাহিক ছুটি সহ)</strong></div></td>
	<td rowspan="2"><div align="center"><strong>অনুপস্থিতি কর্তন</strong></div></td>
    <td rowspan="2" width="25" ><div align="center"><strong>মোট</strong></div></td>

    
    <!--<td rowspan="2" width="25" ><div align="center"><strong>Net Wages</strong></div></td>-->
    <td colspan="3" ><div align="center"><strong>উৎপাদন সম্পর্কিত তথ্য</strong></div></td>
    <td colspan="3" ><div align="center"><strong>কাজ বিহীন তথ্য</strong></div></td>
    <td rowspan="2" width="100" ><div align="center"><strong>মোট উৎপাদনের টাকা</strong></div></td>
    <td rowspan="2" width="100" ><div align="center"><strong>মোট</strong></div></td>
    <td rowspan="2" width="100" ><div align="center"><strong>হাজিরা বোনাস</strong></div></td>
    
    <td colspan="3" ><div align="center"><strong>ওভার টাইম</strong></div></td>
    <td rowspan="2" width="25" ><div align="center"><strong>স্ট্যাম্প</strong></div></td>
    
    <td rowspan="2" width="22" ><div align="center"><strong>নিট পে </strong></div></td>
	<td rowspan="2"  width="180"><div align="center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;স্বাক্ষর&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></div></td>
  </tr>
  <tr >
  	<td width="15" style="font-size:8px;"><div align="center"><strong>মোট উপস্থিতি</strong></div></td>
	<td width="15" style="font-size:8px;"><div align="center"><strong>মোট অনুপস্থিতি</strong></div></td>
  	<td width="15" style="font-size:8px;"><div align="center"><strong>সাপ্তাহিক ছুটি</strong></div></td>
  	<td width="15" style="font-size:8px;"><div align="center"><strong>ছুটি</strong></div></td>
	
	
    <td width="37" style="font-size:8px;"><div align="center"><strong>উৎপাদনের টাকা</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>উৎপাদন বোনাস(%)</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>উৎপাদন বোনাস</strong></div></td>
    
    <td width="37" style="font-size:8px;"><div align="center"><strong>দিন</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>রেট</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>পরিমাণ</strong></div></td>
    
    <td width="37" style="font-size:8px;"><div align="center"><strong>ওভার টাইম</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>ওভার টাইম রেট</strong></div></td>
    <td width="37" style="font-size:8px;"><div align="center"><strong>ওভার টাইম টাকা</strong></div></td>


    
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
	$total_abs_deduction	= 0;
	$total_salary_after_abs_deduction = 0;
	$total_gross_pays	= 0;
	$total_net_pay	= 0;
	$total_net_wages_after_deduction = 0;
	$total_net_wages_with_ot = 0;
	
	$total_gross_sal_per_page = 0;
	$total_advance_per_page = 0;
	$total_absent_deduction_per_page = 0;
	$total_stamp_deduction_per_page = 0;
	$total_net_wages_without_ot_per_page = 0;
	$total_pd_amount_per_page = 0;
	$total_pd_bonus_per_page = 0;
	$total_ot_amount_per_page = 0;
	$total_nw_amount_per_page = 0;
	$total_total_pd_amount = 0;
	$total_selected_payable_amount = 0;
	
	
	$total_info_first 	= 0;
	$total_info_second 	= 0;
	$total_info_third 	= 0;
	$total_info_forth 	= 0;
	$total_info_fifth 	= 0;
	
	for($p=0; $p<=$per_page_row;$p++)
	{
		echo "<tr height='70' style='text-align:center; font-family:SutonnyMJ;'' >";
		echo "<td >";
		echo $k+1;
		echo "</td>";
		
		echo "<td style='font-family:arial;'>";
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
				
		echo "<td style='font-family:arial;'>";
		print_r($value[$k]->emp_id);
		//echo $row->emp_id;
		echo "</td>";
				
		echo "<td style='font-family:arial;'>";
		print_r($value[$k]->desig_name);
		//echo $row->desig_name;
		echo "</td>";
		
		echo "<td style='font-family:arial;'>";
		print_r($value[$k]->sec_name);
		//echo $row->desig_name;
		echo "</td>";
				
				
		echo "<td style='font-family:arial;'>";
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
		print_r ($value[$k]->basic_sal);
		$basic = $basic + $value[$k]->basic_sal;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->house_r);
		//echo $row->house_r;
		$house_rent = $house_rent + $value[$k]->house_r;
		echo "</td>";
			
		echo "<td>";
		print_r ($value[$k]->medical_a);
		//echo $row->medical_a;
		$medical_all = $medical_all + $value[$k]->medical_a;
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->trans_allow);
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->food_allow);
		echo "</td>";
				 
		echo "<td style='font-weight:bold;'>";
		print_r ($value[$k]->gross_sal);
		//echo "<strong>$row->gross_sal</strong>";
		$gross_sal = $gross_sal + $value[$k]->gross_sal;
		$total_gross_sal_per_page = $total_gross_sal_per_page + $value[$k]->gross_sal;
		$grand_total_gross_sal_per_page = $grand_total_gross_sal_per_page + $value[$k]->gross_sal;
		echo "</td>";
				
		echo "<td>";
		print_r ($value[$k]->total_days);
		//echo $row->total_days;
		echo "</td>"; 
		
		echo "<td>";
		print_r ($value[$k]->att_days);
		//echo $row->att_days;
		echo "</td>"; 
		
		echo "<td>";
		print_r ($value[$k]->absent_days);
		//echo "abs".$row->absent_days;
		echo "</td>";
				
		echo "<td>";
		print_r ($value[$k]->weeked);
		//echo "ho_day" . $row->holiday_or_weeked;
		echo "</td>"; 
		
		
				
		$total_leave = $value[$k]->c_l;// + $value[$k]->s_l + $value[$k]->e_l + $value[$k]->m_l;
		echo "<td>";
		print_r ($value[$k]->c_l);
		//echo "cl".$row->c_l;
		echo "</td>";
			
		
		
		echo "<td>";
		print_r ($value[$k]->abs_deduction);
		echo "</td>";
		$total_abs_deduction = $total_abs_deduction + $value[$k]->abs_deduction;
		$grand_total_absent_deduction = $grand_total_absent_deduction + $value[$k]->abs_deduction;
		
		echo "<td style='font-weight:bold;'>";
		print_r ($value[$k]->salary_after_abs_deduction);
		echo "</td>";
		$total_salary_after_abs_deduction = $total_salary_after_abs_deduction + $value[$k]->salary_after_abs_deduction;
		$grand_total_salary_after_abs_deduction= $grand_total_salary_after_abs_deduction + $value[$k]->salary_after_abs_deduction;
		
		
		
		/*echo "<td style='font-size:10px;'>";
		$sec_name = $value[0]->sec_name;
		$sec_id = $value[$k]->sec_id;
		$emp_id = $value[$k]->emp_id;
		
		$body_id 		= 1;
		$neck_id 		= 2;
		$complet_id 	= 3;
		$remending_id 	= 4;
		$lbs_id 		= 5;
		$moon_id 		= 6;
		$placket_id 	= 7;
		
		$BODY = $value[$k]->body;
		$NECK = $value[$k]->neck;;
		
		$COMPLET = $value[$k]->complet;
		$REMENDING = $value[$k]->remending;
		
		$LBS = $value[$k]->lbs;
		$Moon = $value[$k]->moon;
		$PLACKET = $value[$k]->placket;
		
		if($sec_name == "Knitting")
		{
			$OTHERS_Neck = $COMPLET+$NECK+$REMENDING+$LBS+$Moon+$PLACKET;
			echo "Body: $BODY<br>Neck:$OTHERS_Neck";
			
			$total_info_first 	= $total_info_first + $BODY;
			$total_info_second 	= $total_info_second + $OTHERS_Neck;
			
			$grand_total_info_first 	= $grand_total_info_first + $BODY;
			$grand_total_info_second 	= $grand_total_info_second + $OTHERS_Neck;
		}
		else if($sec_name == "Trimming" || $sec_name == "Mending")
		{
			$OTHERS = $BODY+$NECK+$REMENDING+$LBS+$Moon+$PLACKET;
			echo "Complet: $COMPLET<br>Others: $OTHERS";
			
			$total_info_first 	= $total_info_first + $COMPLET;
			$total_info_second 	= $total_info_second + $OTHERS;
			
			$grand_total_info_first 	= $grand_total_info_first + $COMPLET;
			$grand_total_info_second 	= $grand_total_info_second + $OTHERS;
			
			
		}
		else if($sec_name == "Linking")
		{
			echo "Complet: $COMPLET<br>Neck: $NECK<br>Body: $BODY";
			$total_info_first 	= $total_info_first + $COMPLET;
			$total_info_second 	= $total_info_second + $NECK;
			$total_info_third 	= $total_info_third + $BODY;
			
			$grand_total_info_first 	= $grand_total_info_first + $COMPLET;
			$grand_total_info_second 	= $grand_total_info_second + $NECK;
			$grand_total_info_third 	= $grand_total_info_third + $BODY;
		}
		else if($sec_name == "Winding")
		{
			echo "L.B.S: $LBS";
			$total_info_first 	= $total_info_first + $LBS;
			$grand_total_info_first 	= $grand_total_info_first + $LBS;
		}
		else
		{
			echo "&nbsp;";
		}
		echo "</td>";*/
		
		
				
		
		
				
		echo "<td>";
		print_r ($value[$k]->pd_amount);
		$pd_amount = $value[$k]->pd_amount;// +  $value[$k]->epd_amount; 
		echo "</td>";
		$total_pd_amount_per_page = $total_pd_amount_per_page + $pd_amount; 
		$grand_total_pd_amount_per_page = $grand_total_pd_amount_per_page + $pd_amount; 
		
		echo "<td>";
		echo $value[$k]->pd_bonus_percent.'%';
		$pd_bonus_percent = $pd_bonus_percent + $value[$k]->pd_bonus_percent; 
		echo "</td>";
		
				
		echo "<td>";
		print_r ($value[$k]->pd_bonus_amount);
		echo "</td>";
		$total_pd_bonus_per_page = $total_pd_bonus_per_page + $value[$k]->pd_bonus_amount;
		$grand_total_pd_bonus_per_page = $grand_total_pd_bonus_per_page + $value[$k]->pd_bonus_amount;
		
		
		echo "<td>";
		print_r ($value[$k]->none_work_day);
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->none_work_amount);
		echo "</td>";
		
		echo "<td>";
		print_r ($value[$k]->none_work_allowance);
		echo "</td>";
		$total_nw_amount_per_page = $total_nw_amount_per_page+$value[$k]->none_work_allowance;
		$grand_total_nw_amount = $grand_total_nw_amount+$value[$k]->none_work_allowance;
		
		echo "<td>";
		print_r ($value[$k]->total_pd_amount);
		echo "</td>";
		$total_total_pd_amount = $total_total_pd_amount + $value[$k]->total_pd_amount; 
		$grand_total_total_pd_amount = $grand_total_total_pd_amount + $value[$k]->total_pd_amount; 
		
		echo "<td>";
		print_r ($value[$k]->selected_payable_amount);
		echo "</td>";
		$total_selected_payable_amount = $total_selected_payable_amount + $value[$k]->selected_payable_amount; 
		$grand_total_selected_payable_amount = $grand_total_selected_payable_amount + $value[$k]->selected_payable_amount;
		
		echo "<td>";
		print_r ($value[$k]->att_bonus);
		echo "</td>";
		$total_att_bonus = $total_att_bonus + $value[$k]->att_bonus;
		$grand_total_att_bonus = $grand_total_att_bonus + $value[$k]->att_bonus;
		
		echo "<td>";
		print_r ($value[$k]->ot_hour);
		echo "</td>";
		
		
		echo "<td>";
		print_r ($value[$k]->ot_rate);
		echo "</td>";
		
		
		echo "<td>";
		print_r ($value[$k]->ot_amount);
		echo "</td>";
		$total_ot_amount_per_page = $total_ot_amount_per_page + $value[$k]->ot_amount;
		$grand_total_ot_amount = $grand_total_ot_amount +  $value[$k]->ot_amount;
		
		echo "<td style='font-weight:bold;'>";
		echo $value[$k]->stamp;
		echo "</td>";
		$total_stamp_deduction_per_page = $total_stamp_deduction_per_page + $value[$k]->stamp;
		$grand_total_stamp_deduction 	= $grand_total_stamp_deduction + $value[$k]->stamp;		
					
		echo "<td style='font-weight:bold;'>";
		echo $value[$k]->net_pay;
		echo "</td>";
		
		$total_net_wages_with_ot = $total_net_wages_with_ot + $value[$k]->net_pay;
		$grand_total_net_wages_with_ot = $grand_total_net_wages_with_ot + $value[$k]->net_pay;
		
		
			
		echo "<td>";
		echo "&nbsp;";
		echo "</td>";
			
		echo "</tr>"; 
		$k++;
	}
	?>
	<tr style="font-size: 11px; height: 7px; font-family:SutonnyMJ;">
		<td align="center" colspan="12"><strong>মোট প্রতি পেইজ</strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_gross_sal_per_page);?></strong></td>
        <td colspan="5"></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($total_abs_deduction);?></strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($total_salary_after_abs_deduction);?></strong></td>
       <!-- <td align="right" style="text-align:center; font-size:10px;">
             
        <?php
		if($sec_name == "Knitting")
		{
			echo "Body: $total_info_first<br>Neck:$total_info_second";
		}
		else if($sec_name == "Trimming" || $sec_name == "Mending")
		{
			echo "Complet: $total_info_first<br>Others: $total_info_second";
		}
		else if($sec_name == "Linking")
		{
			echo "Complet: $total_info_first<br>Neck: $total_info_second<br>Body: $total_info_third";
		}
		else if($sec_name == "Winding")
		{
			echo "L.B.S: $total_info_first";
		}
		else
		{
			echo "&nbsp;";
		}
		
		?>
        
        </td>-->
        <td align="right" ><strong><?php echo $english_format_number = number_format($total_pd_amount_per_page);?></strong></td>
		<td align="right" colspan="1"></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_pd_bonus_per_page);?></strong></td>
         <td align="right" colspan="1"></td>
          <td align="right" colspan="1"></td>
      <td align="right"><strong><?php echo $english_format_number = number_format($total_nw_amount_per_page);?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_total_pd_amount);?></strong></td>
	
        <td align="right"><strong><?php echo $english_format_number = number_format($total_selected_payable_amount);?></strong></td>
        
        <td align="right"><strong><?php echo $english_format_number = number_format($total_att_bonus);?></strong></td>

        
         <td align="right" colspan="1"></td>
         <td align="right" colspan="1"></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($total_ot_amount_per_page);?></strong></td>
         <td align="right"><strong><?php echo $english_format_number = number_format($total_stamp_deduction_per_page);?></strong></td>
       

        <td align="right"><strong><?php echo $english_format_number = number_format($total_net_wages_with_ot);?></strong></td>
		
	</tr>
	<?php
	if($counter == $page)
   		{?>
			<tr style=" font-family:SutonnyMJ;">
			<td align="center" colspan="12"><strong> মোট টাকা</strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_gross_sal_per_page);?></strong></td>
        <td colspan="5"></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($grand_total_absent_deduction);?></strong></td>
		<td align="right"><strong><?php echo $english_format_number = number_format($grand_total_salary_after_abs_deduction);?></strong></td>
           <!-- <td align="right" style="text-align:center;font-size:10px;">
            
            <?php
			
			if($sec_name == "Knitting")
			{
				echo "Body: $grand_total_info_first<br>Neck:$grand_total_info_second";
			}
			else if($sec_name == "Trimming" || $sec_name == "Mending")
			{
				echo "Complet: $grand_total_info_first<br>Others: $grand_total_info_second";
			}
			else if($sec_name == "Linking")
			{
				echo "Complet: $grand_total_info_first<br>Neck: $grand_total_info_second<br>Body: $grand_total_info_third";
			}
			else if($sec_name == "Winding")
			{
				echo "L.B.S: $grand_total_info_first";
			}
			else
			{
				echo "&nbsp;";
			}

			?>
            
            </td>-->
             <td align="right" ><strong><?php echo $english_format_number = number_format($grand_total_pd_amount_per_page);?></strong></td>
		<td align="right" colspan="1"></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_pd_bonus_per_page);?></strong></td>
         <td align="right" colspan="1"></td>
          <td align="right" colspan="1"></td>
      <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_nw_amount);?></strong></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_total_pd_amount);?></strong></td>
	
        <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_selected_payable_amount);?></strong></td>
        
        <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_att_bonus);?></strong></td>

        
         <td align="right" colspan="1"></td>
         <td align="right" colspan="1"></td>
        <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_ot_amount);?></strong></td>
         <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_stamp_deduction);?></strong></td>
       

        <td align="right"><strong><?php echo $english_format_number = number_format($grand_total_net_wages_with_ot);?></strong></td>
			
			</tr>
			<?php } ?>
			
			<table width="100%" height="65px" border="0" align="center" style="margin-bottom:10px; font-family:Arial, Helvetica, sans-serif;">
			<tr height="10px" >
			<td colspan="28"></td>
			</tr>
			<tr height="10%">
			<td  align="center">Prepared By</td>
			<td align="center">Checked BY</td>
			<td  align="center">Chief Accounts</td>
			<td  align="center">General Manager</td>
			<td  align="center">Director</td>
            <td  align="center">Director</td>
			</tr>
			
			</table>
			</table>
			  
			<?php

		}

?>
</table>

</body>
</html>