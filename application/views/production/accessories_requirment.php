<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/calendar.css" />
 <script type="text/javascript" src="<?php echo base_url();?>js/calendar_eu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Style Form</title>
</head>

<body>
<?php $attributes = array('class' => 'style_view', 'id' => 'style_view'); ?>
 <?php echo form_open_multipart('product_con/style_update',$attributes) ; ?>
<?php 
//print_r($values) ;



$count = count($values) ;
?>
<div style=" width:1000px ;  margin-top:20px ;">

<table cellpadding="0" cellspacing="0" align="center" width="80%" style="font-size:12px; text-decoration:none;">
  <tr >
		<td align="left" colspan="14">
		<?php echo "Style No 	:".$values['0']['style_no'] ;
 echo "<br/>";
echo "Buyer Name:".$values['0']['Buyer_name'] ;
echo "<br/>";
echo "Department:".$values['0']['department'] ; ?></td>
	</tr>
</table>

<table cellpadding="0" cellspacing="0" align="center" width="80%" border="1" style="font-size:12px; text-decoration:none;">

  <tr align="center" style="background-color:#507CD1; color:#FFFFFF;">
   	<td width="13%">Accesseries Name</td>
    <td width="13%">Required Qty</td>
    <td width="13%">Order Date</td>
    <td width="13%">In house Date</td>
    <td width="13%">Received Qty</td>
    <td width="13%">Required Date</td>
	<td width="15%">Balance</td>
    <td width="7%">Supplier</td>
  </tr>


<?php
for($i=0; $i < $count ; $i++)
{
?>	
<tr style='background-color:#EFF3FB;' >
<td><?php echo $values[$i]['accesseries_name'] ?></td> 
<td><?php echo $values[$i]['required_qty'] ?></td> 
<td><?php echo $values[$i]['accessories_order_date'] ?></td> 
<td><?php echo $values[$i]['required_in_house_date'] ?></td> 
<td><?php echo $values[$i]['received_qty'] ?></td> 
<td><?php echo $values[$i]['required_date'] ?></td> 
<td><?php echo $values[$i]['received_qty'] -$values[$i]['required_qty'] ?> </td>
<td><?php echo $values[$i]['supplier'] ?></td> 
</tr>
<?php
}
?>

</div>





</body>
</html>
