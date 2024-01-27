<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/calendar.css" />
 <script type="text/javascript" src="<?php echo base_url();?>js/calendar_eu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<?php $attributes = array('class' => 'style_view', 'id' => 'style_view'); ?>
<?php echo form_open_multipart('product_con/style_form') ; ?> 
<div style=" width:500px ; margin-left:400px ; margin-top:20px ;">
<table align="center" width="80%" border="0">
  <tr>
    <td width="50%">Style no</td>
    <td width="5%">:</td>
	<?php  $picture = $values[0]["picture_name"]; ?>
	<?php	$path =base_url().'uploads/'.$picture; ?>
    <td><?php $data = array('name'        => 'style_id','id'          => 'style_id','value'       => $values[0]["style_no"],'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:30%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>		</td>
    <td rowspan="3"><div><img src="<?php echo $path ; ?>" width="50px" height="70px" border="0" /></div></td>
  </tr>
  <tr>
    <td>Buyer Name</td>
    <td>:</td>
	
    <td> 
	<?php
	$data=array( '0' 		=> 'BuyerName1',
				 '1' 		=> 'BuyerName2',
				 '2' 		=> 'BuyerName3'
				);
		//print_r($data);		
	$buyername_form=$values[0]["buyer_name"] ;			
	$count=count($data);
	echo '<select name="buyername">';
	for($i=0;$i< $count; $i++)
	{
		
		if ($data[$i] == $buyername_form)
		{
			echo "<option value='$buyername_form' selected='selected'> $buyername_form </option>";
		}
		else
		{
			echo "<option value='$data[$i]' >$data[$i]</option>";
		}
	}
	echo '</select>';
	?>	</td>
    </tr>
  
  
  <tr>
    <td>Department </td>
    <td>:</td>
    <td> <?php $options = array(
                  '0'		  => 'Newborn',
                  '1'    	  => 'Kids Boys',
				  '2'  		  => 'Kids girl',
                  '3'    	  => 'Teenier ',
				  '4'  		  => 'Ladies Fashion',
                  '5'    	  => 'Ladies classic',
                      );
    $departmente_form=$values[0]["department"] ;			
	$count=count($options);
	echo '<select name="department">';
	for($i=0;$i< $count; $i++)
	{
		
		if ($options[$i] == $departmente_form)
		{
			echo "<option value='$departmente_form' selected='selected'> $departmente_form </option>";
		}
		else
		{
			echo "<option value='$options[$i]' >$options[$i]</option>";
		}
	}
	echo '</select>';
	?>				   </td>
    </tr>
</table>
</div>

<div style= "width:500px ; margin-left:400px ; margin-top:20px ;">
<table align="center" width="80%" border="0">
  <tr>
    <td width="80%">Style Picture </td>
    <td width="5%">: </td>
    <td>
	
<input type="file" name="userfile" size="13" />
</td>
  </tr>
 
</table>
</div>

<div style=" width:500px ; margin-left:400px ; margin-top:20px ;">
<table align="center" width="80%" border="0">
  <tr>
    <td width="50%">Style Describtion</td>
    <td width="5%">:</td>
    <td><?php $data = array('name'        => 'style_describtion','id'          => 'style_describtion','value'       =>  $values[0]["style_describtion"],'maxlength'   => '90%',
              			'size'        => '80',
              			'style'       => 'width:100%',
						'rows'			=>'3',
						'cols'        =>'3',
           				 );
              			echo form_textarea($data);	
			  		?>
		</td>
  </tr>
  <tr>
    <td>Inquiry Received Date</td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'inquery_received_date','id'          => 'inquery_received_date','value'       => $values[0]["inquery_received_date"],'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	 ?>
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'style_view',
									// input name
									'controlname': 'inquery_received_date'
								});
								
					</script></td>
  </tr>
  
  
  <tr>
    <td>Order Confirmation Date</td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'order_confirmation_date','id'          => 'order_confirmation_date','value'       => $values[0]["order_confirmation_date"],'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>
						
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'style_view',
									// input name
									'controlname': 'order_confirmation_date'
								});
								
					</script>
						
						
						</td>
  </tr>
  
  
  <tr>
    <td>Final Inspection Date</td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'final_inspaction_date','id'          => 'final_inspaction_date','value'       => $values[0]["final_inspaction_date"],'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>
						
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'style_view',
									// input name
									'controlname': 'final_inspaction_date'
								});
								
					</script>
						
						
						</td> </tr>
  
  
  
  <tr>
    <td>Payment Mode </td>
    <td>:</td>
    <td> <?php $options = array(
                  '0'  		=> 'cash',
                  '1'    	=> 'cheque',
				  '2'  	    => 'L/C'
                   );
    $paymentmode_form=$values[0]["paymentmode"] ;			
	$count=count($options);
	echo '<select name="paymentmode">';
	for($i=0;$i< $count; $i++)
	{
		
		if ($options[$i] == $paymentmode_form)
		{
			echo "<option value='$paymentmode_form' selected='selected'> $paymentmode_form </option>";
		}
		else
		{
			echo "<option value='$options[$i]'>$options[$i]</option>";
		}
	}
	echo '</select>';
     ?></td>
  </tr>
  
  
  
  <tr>
    <td>Merchandise Name</td>
    <td>:</td>
    <td> <?php $options = array(
                  '0' 			 => 'MerchandiseName1',
                  '1'    		 => 'MerchandiseName2',
                      );
    $merchandisename_form=$values[0]["merchandisename"] ;			
	$count=count($options);
	echo '<select name="merchandisename">';
	for($i=0;$i< $count; $i++)
	{
		
		if ($options[$i] == $merchandisename_form)
		{
			echo "<option value='$merchandisename_form' selected='selected'> $merchandisename_form </option>";
		}
		else
		{
			echo "<option value='$options[$i]'>$options[$i]</option>";
		}
	}
	echo '</select>';
			  		?></td>
  </tr>
  
  
  <tr>
    <td>Order Status</td>
    <td>:</td>
    <td> <?php $options = array(
                  '0'  			=> 'Development',
                  '1'    		=> 'confirmorder',
				  '2'  			=> 'Pending',
				  '3'  			=> 'Cancel'
                   );
 $orderstatus_form=$values[0]["orderstatus"] ;			
	$count=count($options);
	echo '<select name="orderstatus">';
	for($i=0;$i< $count; $i++)
	{
		if ($options[$i] == $orderstatus_form)
		{
			echo "<option value='$orderstatus_form' selected='selected'> $orderstatus_form </option>";
		}
		else
		{
			echo "<option value='$options[$i]'>$options[$i]</option>";
		}
	}
	echo '</select>';
?></td>
  </tr>
</table>
</div>
<div style=" width:500px ; margin-left:400px ; margin-top:20px ;">
<table align="center" width="80%" border="0">
  <tr>
    <td width="50%"></td>
	 
    <td>
	
 	<?php echo form_submit('Update', 'Update'); ?></td>
	 <?php echo form_close(); ?>
	 </td>
  </tr>
</table>
</div>
</body>
</html>
