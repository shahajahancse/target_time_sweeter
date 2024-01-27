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
 <?php echo form_open_multipart('product_con/temp_table',$attributes) ; ?>

<div style=" width:95% ; margin-left:10px ; margin-top:20px ;">
  <table width="95%" border="0" align="center">
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
      <td>Yarn type</td>
      <td>:</td>
      <td><?php $data = array('name'        => 'yarn','id'          => 'yarn','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
      <td width="15%">&nbsp;</td>
      <td width="21%">Order Qty </td>
      <td width="2%">: </td>
      <td><?php $data = array('name'        => 'order_qty','id'          => 'order_qty','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
    </tr>
	<tr>
      <td>Received Qty </td>
      <td>:</td>
      <td><?php $data = array('name'        => 'received_qty','id'          => 'received_qty','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
      <td width="15%">&nbsp;</td>
      <td width="21%">Supplier</td>
      <td width="2%">: </td>
      <td><?php $data = array('name'        => 'supplier','id'          => 'supplier','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
    </tr>
	<tr>
      <td>Date</td>
      <td>:</td>
      <td><?php $data = array('name'        => 'c_date','id'          => 'c_date','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
      <td width="15%">&nbsp;</td>
      <td width="21%">Remarks</td>
      <td width="2%">: </td>
      <td><?php $data = array('name'        => 'remarks','id'          => 'remarks','value'       => '','maxlength'   => '20',
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
<table align="center" width="95%" border="1">

  <tr>
    
    </tr>
  <tr style="background:#99CCFF;" align="center">
    <td width="10%">Style or PO No</td>
    <td width="10%" colspan="-2">Color</td>
    <td width="10%" colspan="-2">Yarn Type</td>
	<td width="10%" colspan="-2">Order Qty</td>
	<td width="10%" colspan="-2">Received Qty</td>
	<td width="10%" colspan="-2">Balance</td>
    <td width="10%" colspan="-2">Supplier</td>
	<td width="10%" colspan="-2">Current Date</td>
	<td width="10%" colspan="-2">Remarks</td>
    <td width="10%">Action</td>
  </tr>
 
<?php
$i=0;
foreach ($values as $rows)
{
$i=$i+1;
echo "<tr style='background-color:#EFF3FB;' >
	<td>$rows->style_no</td>
    <td>$rows->color</td>
	<td>$rows->yarn_type</td>
	<td>$rows->order_qty</td>
	<td>$rows->received_qty</td>
	<td>$rows->balance</td>
	<td>$rows->supplier </td>
	<td>$rows->current_date</td>
	<td>$rows->remarks</td>";
?>
<td>
<?php $url = "product_con/tmp_table_delete/".$rows->id."/" ;
echo anchor( $url,'Delete', 'style="text-decoration:none;"'); ?>	
</td>
	</tr>
<?php
}

?>
</table>
<table align="center" width="95%" border="0">
<tr>
<td>
<?php echo form_open('product_con/save_yarn');   ?> 
             <?php echo form_submit('Send','Send'); ?> 
			 <?php echo form_close(); ?>
</td>
<td align="right">
<?php echo form_open('product_con/show_yarn');   ?> 
             <?php echo form_submit('Show All','Show All'); ?> 
			 <?php echo form_close(); ?>
</td>

</tr>
</table>
</div>
</body>
</html>
