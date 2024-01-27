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
		<td align="center" colspan="14">Yarn Details</td>
	</tr>
	
 <tr>
   	<td colspan="3" width="40%">Enetr Style no:
	<?php echo form_open('product_con/yarn_find');   ?> 
	<?php $data = array('name'        => 'style_no','id'          => 'style_no','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:20%',
           				 );
              			echo form_input($data);	
				 
						 			  		?> 
		
             <?php echo form_submit('Find','Find'); ?> 
			 <?php echo form_close(); ?>
	
	</td>
	<td colspan="3" width="30%"></td>
    <td colspan="3" width="30%"></td>
   
  </tr>
  <tr align="center" style="background-color:#507CD1; color:#FFFFFF;">
   	<td width="10%">Style No</td>
    <td width="10%">Color</td>
    <td width="10%">Yarn Type</td>
	<td width="10%">Order Qty</td>
	<td width="10%">Received Qty</td>
    <td width="10%">Balance</td>
	<td width="10%">Supplier</td>
	<td width="10%">Date</td>
    <td width="10%">Remarks</td>
    <td width="5%">Action</td>
    <td width="5%">Action</td>
  </tr>


<?php

//print_r($values);
foreach ($values->result() as $rows)
{
echo "<tr style='background-color:#EFF3FB;' >
	<td>$rows->style_no</td> 
	<td>$rows->color</td> 
	<td>$rows->yarn_type</td> 
	<td>$rows->order_qty</td> 
	<td>$rows->received_qty</td> 
	<td>$rows->balance</td> 
	<td>$rows->supplier</td> 
	<td>$rows->current_date</td> 
	<td>$rows->remarks</td> ";
	  
?>
	
	<td>
	
	<?php  $url = "product_con/yarn_edit/".$rows->id."/" ;
				  echo  anchor( $url,'Edit', 'style="text-decoration:none;"'); ?>
	
	</td>
	
	<td>
	<?php  $url = "product_con/yarn_delete/".$rows->id."/" ;
				echo anchor($url,'Delete','style="text-decoration:none;"'); ?>
	
	</td>
	
    </tr>
	
<?php 
  }
?>
</table>
</body>
</html>
