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
 <?php echo form_open_multipart('product_con/quick_create',$attributes) ; ?>
<?php


?>
<div style=" width:80% ; margin-left:10px ; margin-top:20px ;">
  <table width="80%" border="0" align="center">
    <tr>
      <td width="19%">Style or PO No.</td>
      <td width="1%">:</td>
      <td width="22%"><?php $data = array('name'        => 'style_no','id'          => 'style_no','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 				?>      </td>

      <td width="15%">&nbsp;</td>
      <td>Color</td>
      <td>:</td>
      <td width="20%"><?php $data = array('name'        => 'color','id'          => 'color','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>      </td>
    </tr>
    <tr>
      <td>Size</td>
      <td>:</td>
      <td><?php $data = array('name'        => 'size','id'          => 'size','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
      <td width="15%">&nbsp;</td>
      <td width="21%">Qty</td>
      <td width="2%">: </td>
      <td><?php $data = array('name'        => 'qty','id'          => 'qty','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
    </tr>
	
	 <tr>
      <td colspan="3"><?php echo form_submit('Quick Create','Quick Create'); ?>
		 <?php  echo form_close(); ?> </td>
      <td width="15%">&nbsp;</td>
      <td width="21%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
 
<table align="center" width="80%" border="1">

  <tr>
    
    </tr>
  <tr style="background:#99CCFF;" align="center">
    <td width="30%">Style or PO No</td>
    <td width="26%" colspan="-2">Color</td>
    <td width="23%" colspan="-2">Size</td>
    <td width="10%" colspan="-2">Quantity</td>
    <td width="11%">Action</td>
  </tr>
  
 <?php 
  
foreach ($values as $rows)
{
    echo "<tr>
	<td>$rows->style_no</td>
    <td>$rows->color</td>
	<td>$rows->size</td>
	<td>$rows->qty</td>";
	?>
	<td>
	<?php $url = "product_con/delete_color/".$rows->id."/" ;
				echo anchor( $url,'Delete', 'style="text-decoration:none;"'); ?>	</td>
	</tr>
<?php
}

?>
</table>

<table align="center" width="80%" border="0">
<tr>
<td>
<?php echo form_open('product_con/color_w_qty_save');   ?> 
             <?php echo form_submit('Send','Send'); ?> 
			 <?php echo form_close(); ?>
</td>
<td align="right">
<?php echo form_open('product_con/color_w_qty_all');   ?> 
             <?php echo form_submit('Show All','Show All'); ?> 
			 <?php echo form_close(); ?>
</td>

</tr>
</table>


</div>
</body>
</html>
