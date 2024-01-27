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
		<td align="center" colspan="14"><h3>All Color wise quantity</h3></td>
	</tr>
	
 <tr>
   	<td colspan="2" width="30%">Enetr Style no:
	<?php echo form_open('product_con/color_w_qty_find_one');   ?> 
	<?php $data = array('name'        => 'style_no','id'          => 'style_no','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:20%',
           				 );
              			echo form_input($data);	
				 
						 			  		?> 
		
             <?php echo form_submit('Find','Find'); ?> 
			 <?php echo form_close(); ?>
	
	</td>
	<td colspan="2" width="18%"></td>
    <td colspan="2" width="18%"></td>
   
  </tr>
  <tr align="center" style="background-color:#507CD1; color:#FFFFFF;">
   	<td width="18%">Style No</td>
    <td width="18%">Color</td>
    <td width="18%">Size</td>
    <td width="15%">Quantity</td>
    <td width="5%">Action</td>
    <td width="6%">Action</td>
  </tr>


<?php

//print_r($values);
foreach ($values->result() as $rows)
{
echo "<tr style='background-color:#EFF3FB;' >
	<td>$rows->style_no</td> 
	<td>$rows->color</td> 
	<td>$rows->size</td> 
	<td>$rows->qty</td> ";
	  
?>
	
	<td>
	
	<?php  $url = "product_con/color_edit/".$rows->id."/" ;
				  echo  anchor( $url,'Edit', 'style="text-decoration:none;"'); ?>
	
	</td>
	
	<td>
	<?php  $url = "product_con/color_w_q_delete/".$rows->id."/" ;
				echo anchor($url,'Delete','style="text-decoration:none;"'); ?>
	
	</td>
	
    </tr>
	
<?php 
  }
?>
</table>
</body>
</html>
