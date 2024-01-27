<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Blockwise Wise Total Salary </title>
<link rel="stylesheet" type="text/css" href="../../../../../css/SingleRow.css" />
</head>

<body>
<div align="center" style="height:100%; width:100%; overflow:hidden;">

<?php
//print_r($values);
$this->load->view('head_english');

$GTamount = 0;
foreach($values as $detvalue)
{

$count_block_id = count($detvalue["block_id"]);
//$floor_name = $this->db->where("posi_id",$grid_floor)->get('pr_emp_position')->row()->posi_name;
//$sec_name = $this->db->where("sec_id",$grid_section)->get('pr_section')->row()->sec_name;
//$this->db->select('sec_name');
//$query = $this->db->get('pr_section');
//print_r($sec_name);exit;
//$count = 3;
$counts = 0;
?>
<?php 
 //$all = $query->result_array();

//  for($k=0;$k<=29;$k++){
  //foreach($all[$k] as $nam){

  //}
  //}
  //exit;
  ?>
<span style="font-size:13px; font-weight:bold;"><?php 
//echo $nam;
echo "Section : ".$detvalue['sec_name'];
//."&nbsp;&nbsp;&nbsp;Floor : ".$floor_name; 
?>  Salary Summary For The Month of <?php echo $month_year; ?></span>
<br />
<br />
 <table border="1" style="border-collapse:collapse; padding-left:4px;padding-right:2px;" cellpadding="2" cellspacing="0" >

<tr style="text-align:center; font-size:14px; font-weight:bold;">
  <td rowspan="1">SL.</td>
  <td rowspan="1">Block Name</td>
  <td rowspan="1">Total Ground</td>
</tr>

<?php

for($i = 0; $i<$count_block_id;$i++)
{
	
?>
	<tr style="font-size:13px; text-align:right; padding:4px">
    <td style="text-align:left;"><?php echo $i+1; ?></td>
    <td style="text-align:left;"><?php echo $detvalue["block_name"][$i]; ?></td>
   	<td><?php echo $detvalue["net"][$i]; ?></td>
    
    </tr>
<?php	
}
?>
<tr style="font-weight:bold; font-size:13px; text-align:right;">
    <td colspan="2" style="text-align:center;">Total</td>
    <td><?php echo number_format ($detvalue["total_net_pay"]); ?></td>
   
</tr>
</table>
 <br />
<br />
<?php

 $GTamount = $GTamount + $detvalue["total_net_pay"];
 }
 //} 
 //$k++;
 ?>
<table style="margin-top:30px; text-transform:capitalize; width:350px;">
	<tr style="font-size:14px;">
	    <td align="center">Grand Total:</td>
		<td align="left"><?php echo number_format($GTamount); ?></td>
	</tr>
</table>
<table style="margin-top:70px; text-transform:capitalize; width:600px;">
	<tr height="80%" >
		<td colspan="10"></td>
	</tr>
	<tr height="20%" style="font-size:14px;">
		<td  align="center" width="100">Prepared By</td>
		<td align="center" width="100">Checked BY</td>
		<td  align="center" width="100">Cheif Accounts</td>
		<td  align="center" width="150">General Manager</td>
		<td  align="center" width="100">Director</td>
		<td  align="center" width="100">Director</td>
	</tr>
</table>
</div>
</body>
</html>
