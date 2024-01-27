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
$count_article_id = count($values["article_id"]);
?>
</title>

</head>
<?php

$sal_year  = date('Y',strtotime($salary_month));
$sal_month = date('m',strtotime($salary_month));
$day=date('d',strtotime($salary_month));
$date_format = date("F-Y", mktime(0, 0, 0, $sal_month, $day, $sal_year));

?>

<body>
<div align="center" style="height:100%; width:100%; overflow:hidden;" >
<?php $this->load->view('head_english'); ?>
<span style="font-size:13px; font-weight:bold; text-align:center;">Monthly Artical Wise Rate Sheet of  <?php echo $date_format;?></span>
<table align="center" height="auto"  class="sal" border="1" cellspacing="0" cellpadding="5" style="font-size:12px; width:auto; border-collapse:collapse; margin-top: 10px;">



<tr style=" font-weight:bold; font-size:14px; text-align:center; background-color: #eae8e8">
	<td>Section</td>
	<td>Buyer Name</td>	
	<td>Style Name</td>	
	
	<td>Process</td>
	<td>Size</td>
	<td>Price</td>			
</tr>
<?php



for($i = 0; $i<$count_article_id;$i++)
{
	$section_name = $values["section_name"][$i]; 
	if($section_name == "Knitting" || $section_name == "Mending")
	{
		$section_background = "#FFFFF";
	}
	else
	{
		$section_background = "#DAE0E6";
	}
	
	echo "<tr style='font-size:13px; text-align:center; background:$section_background'>"
	?>
	<td><?php echo  $values["section_name"][$i]; ?></td>
    <td><?php echo  $values["buyer_name"][$i]; ?></td>
    <td><?php echo  $values["style_id"][$i]; ?></td>
    <td><?php echo  $values["process_name"][$i]; ?></td>
    <td><?php echo  $values["size_name"][$i]; ?></td>
    <td><?php echo  $values["price"][$i]; ?></td>
    </tr>
<?php
}
?>


</table>
</div>
</body>
</html>