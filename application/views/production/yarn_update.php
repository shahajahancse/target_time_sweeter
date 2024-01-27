<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/calendar.css" />
 <script type="text/javascript" src="<?php echo base_url();?>js/calendar_eu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Style Form</title>
</head>

<body>
<?php $attributes = array('class' => 'yarn_view', 'id' => 'yarn_view'); ?>
 <?php echo form_open('product_con/yarn_update_value',$attributes) ; ?>

<div style=" width:80% ; margin-left:10px ; margin-top:20px ;">
<?php foreach($values->result() as $rows)
{
	
?>
  <table width="80%" border="0" align="center">
    <tr>
      <td width="19%">Style or PO No.</td>
      <td width="1%">:</td>
      <td width="22%"><?php 
	  
	    $data = array(
              'id'  =>$rows->id
  
			);

echo form_hidden($data);
	  
	  $data = array('name'        => 'style_no','id'          => 'style_no','value'       => $rows->style_no,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>      </td>
      <td width="15%">&nbsp;</td>
      <td>Color</td>
      <td>:</td>
      <td width="24%"><?php $data = array('name'        => 'color','id'          => 'color','value'       => $rows->color,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>      </td>
    </tr>
    <tr>
      <td>Yarn Type</td>
      <td>:</td>
      <td><?php $data = array('name'        => 'yarn_type','id'          => 'yarn_type','value'       => $rows->yarn_type,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
      <td width="15%">&nbsp;</td>
      <td width="17%">Order Qty</td>
      <td width="2%">: </td>
      <td><?php $data = array('name'        => 'order_qty','id'          => 'order_qty','value'       => $rows->order_qty,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
    </tr>
	
	<tr>
      <td>Received Qty</td>
      <td>:</td>
      <td><?php $data = array('name'        => 'received_qty','id'          => 'received_qty','value'       => $rows->received_qty,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
      <td width="15%">&nbsp;</td>
      <td width="17%">Balance</td>
      <td width="2%">: </td>
      <td><?php $data = array('name'        => 'balance','id'          => 'balance','value'       => $rows->balance,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
    </tr>
	<tr>
      <td>Supplier</td>
      <td>:</td>
      <td><?php $data = array('name'        => 'supplier','id'          => 'supplier','value'       => $rows->supplier,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
      <td width="15%">&nbsp;</td>
      <td width="17%">Date</td>
      <td width="2%">: </td>
      <td><?php $data = array('name'        => 'date','id'          => 'date','value'       => $rows->current_date,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'yarn_view',
									// input name
									'controlname': 'date'
								});
								
					</script>
						
						
	  </td>
    </tr>
	<tr>
      <td>Remarks</td>
      <td>:</td>
      <td><?php $data = array('name'        => 'remarks','id'          => 'remarks','value'       => $rows->remarks,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
      <td width="15%">&nbsp;</td>
      <td width="17%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	
	
	 <tr>
      <td colspan="3">&nbsp;</td>
      <td width="15%">&nbsp;</td>
      <td width="17%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table align="center" width="80%" border="0">
<tr>
<td>
<?php // echo form_open('product_con/yarn_update_value');   ?> 
             <?php echo form_submit('Update','Update'); ?> 
			 <?php echo form_close(); ?>
	
</td>
<td align="right">&nbsp;</td>

</tr>
<?php  } ?>
</table>


</div>
</body>
</html>
