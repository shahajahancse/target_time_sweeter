<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/calendar.css" />
 <script type="text/javascript" src="<?php echo base_url();?>js/calendar_eu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Style Form</title>
</head>

<body>

<div style=" width:1000px ; margin-left:10px ; margin-top:20px ;">
<table align="center" width="73%" border="0">
  <tr>
    <td width="19%" height="30">Style/PO no</td>
    <td width="1%">:</td>
    <td width="20%">
	<?php echo form_open('product_con/sample_find');   ?> 

	<?php echo $values[0]["style_no"] ?>
	<?php $data = array('name'        => 'style_no','id'          => 'style_no','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:40%',
           				 );
              			echo form_input($data);	?>						</td>
											<td width="3%">
											
             <?php echo form_submit('Find','Find'); ?> 
			 <?php echo form_close(); ?>											</td>
		<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="21%" rowspan="4">
	<?php  $picture = $values[0]["picture_name"]; ?>
	<?php	$path =base_url().'uploads/'.$picture; ?>
	<div style="width:80px; height:80px; border:#FF0000 1px solid;"><img src="<?php echo $path ; ?>" width="80px" height="80px" border="0" />	</div>	</td>
    <td width="21%" rowspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td>Buyer Name</td>
    <td>:</td>
    <td><?php echo $values[0]["buyer_name"] ?></td>
    <td>&nbsp;</td>
	
    
    <td width="14%" rowspan="3">&nbsp;</td>
    <td width="3%">&nbsp;</td>
    </tr>
  
  <tr>
    

    <td>Department </td>
    <td>:</td>
    <td> <?php echo $values[0]["department"] ?></td>
					<td width="3%">&nbsp;</td>
	  <td width="3%">&nbsp;</td>
    </tr>
  
  <tr>
    <td>Gauge</td>
    <td>:</td>
    <td> <?php echo $values[0]["gauge"] ?>										</td> 
						<td width="3%">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>Type of Sample </td>
    <td>:</td>
    <td>				
	<?php $attributes = array('class' => 'style_view', 'id' => 'sample_view'); ?>
<?php echo form_open('product_con/sample_save',$attributes);   ?> 

<?php $data = array('name'        => 'style_no','id'          => 'style_no','value'       => $values[0]["style_no"],'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:40%',
           				 );
              			echo form_hidden($data);	?>	
		<?php $data = array('name'        => 'sample_type','id'          => 'sample_type','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?></td> 
						<td width="3%">&nbsp;</td>
    <td>Sending Date </td>
    <td>:</td>
    <td colspan="2"><?php $data = array('name'        => 'sending_date','id'          => 'sending_date','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:40%',
           				 );
              			echo form_input($data);	?>
					<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'sample_view',
									// input name
									'controlname': 'sending_date'
								});
								
					</script>						</td>
  </tr>
  <tr>
    <td>Comment Date</td>
    <td>:</td>
    <td>
								
					</script>						<?php $data = array('name'        => 'comment_date','id'          => 'comment_date','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>
						
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'sample_view',
									// input name
									'controlname': 'comment_date'
								});
									</script>						</td> 
						<td width="3%">&nbsp;</td>
    <td>In house Date </td>
    <td>:</td>
    <td colspan="2"><?php $data = array('name'        => 'in_house_date','id'          => 'in_house_date','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:40%',
           				 );
              			echo form_input($data);	?>
						
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'sample_view',
									// input name
									'controlname': 'in_house_date'
								});
								
					</script>						</td>
  </tr>
  <tr>
    <td>Status</td>
    <td>:</td>
    <td>					<?php $options = array(
                  '0'  			=> 'Development',
                  '1'    		=> 'confirmorder',
				  '2'  			=> 'Pending',
				  '3'  			=> 'Cancel'
                   );
                   echo form_dropdown('status', $options, 'Select');
			  		?></td> 
						<td width="3%">&nbsp;</td>
    <td></td>
    <td>:</td>
    <td colspan="2"> </td>
  </tr>
 </table>
<table align="center" width="73%" border="0">
  
  <tr>
    <td width="10px" ><?php echo form_submit('Save','Save'); ?> 
			 <?php echo form_close(); ?>
	
      </td>
		<td>
		<?php echo form_open('product_con/all_sample');   ?> 
	<?php echo form_submit('All Sample', 'All Sample'); ?>
			 <?php echo form_close(); ?>
		</td>
   
  </tr>
</table>

</div>





</body>
</html>
