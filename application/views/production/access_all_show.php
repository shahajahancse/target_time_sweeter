<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/image_zoom.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<table cellpadding="0" cellspacing="0" align="center" width="80%" border="1" style="font-size:12px; text-decoration:none;">
  <tr style='background-color:#ECE9D8;' >
		<td align="center" colspan="14"><h3>Accesseries Details</h3></td>
	</tr>
	
 <tr>
   	<td colspan="10" width="30%">Enetr Style no:
	<?php echo form_open('product_con/access_find');   ?> 
	<?php $data = array('name'        => 'style_no','id'          => 'style_no','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:20%',
           				 );
              			echo form_input($data);	
				 
						 			  		?> 
		
             <?php echo form_submit('Find','Find'); ?> 
			 <?php echo form_close(); ?>
	
	</td>
	
   
  </tr>
  <tr align="center" style="background-color:#507CD1; color:#FFFFFF;">
   	<td width="12%">Style No</td>
    <td width="12%">Accesseries Name</td>
    <td width="12%">Required Quantity</td>
    <td width="12%">Accessories Order Date</td>
	<td width="12%">Required in House date</td>
    <td width="12%">Received Quantity</td>
    <td width="12%">Required date</td>
    <td width="12%">Supplier</td>
    <td width="2%">Action</td>
    <td width="2%">Action</td>
  </tr>


<?php

//print_r($values);
foreach ($values->result() as $rows)
{
	echo "<tr style='background-color:#EFF3FB;'>
		<td>$rows->style_no</td>
   		<td>$rows->accesseries_name</td>
		<td>$rows->required_qty</td>
		<td>$rows->accessories_order_date</td>
		<td>$rows->required_in_house_date</td>
   		<td>$rows->received_qty</td>
		<td>$rows->required_date</td>
		<td>$rows->supplier</td>";
	  
?>
	
	<td>
	<?php  $url = "product_con/access_edit/".$rows->id."/" ;
				  echo  anchor( $url,'Edit', 'style="text-decoration:none;"'); ?>
	
	</td>
	
	<td>
	<?php  $url = "product_con/access_delete/".$rows->id."/" ;
				echo anchor($url,'Delete','style="text-decoration:none;"'); ?>
	
	</td>
	
    </tr>
	
<?php 
  }
?>
</table>
</body>
</html>
