<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/calendar.css" />
 <script type="text/javascript" src="<?php echo base_url();?>js/calendar_eu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Style Form</title>
</head>

<body>
<?php $attributes = array('class' => 'style_view', 'id' => 'sample_view'); ?>

<div style=" width:1000px ; margin-left:10px ; margin-top:20px ;">
<table align="center" width="73%" border="0">
  <tr>
    <td width="19%" height="30">Style/PO no</td>
    <td width="1%">:</td>
    <td width="20%">
	<?php echo form_open('product_con/sample_find',$attributes);   ?> 

	<?php $data = array('name'        => 'style_no','id'          => 'style_no','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?></td>
											<td width="3%">
											
             <?php echo form_submit('Find','Find'); ?> 
			 <?php echo form_close(); ?>											</td>
		<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="21%" rowspan="4">
	<div style="width:80px; height:80px; border:#FF0000 1px solid;">	</div>	</td>
    <td width="21%" rowspan="4">&nbsp;</td>
  </tr>
  <tr>
    

    <td>Buyer Name</td>
    <td>:</td>
    <td><?php $options = array(
                  '0' 			 => 'Buyer1',
                  '1'    		 => 'Buyer2',
                      );
   				 echo form_dropdown('buyername', $options, 'Select');
			  		?></td>
					<td width="3%">&nbsp;</td>
					<td width="14%" rowspan="3"> picture</td>
    <td width="1%">&nbsp;</td>
    </tr>
  
  <tr>
    

    <td>Department </td>
    <td>:</td>
    <td> <?php $options = array(
                  'Newborn'  => 'Newborn',
                  'Kids Boys'    => 'Kids Boys',
				   'Kids girl'  => 'Kids girl',
                  'Teenier Girls'    => 'Teenier ',
				   'Ladies Fashion'  => 'Ladies Fashion',
                  'Ladies classic'    => 'Ladies classic',
                      );
                   echo form_dropdown('department', $options, 'Select');
			  		?></td>
					<td width="3%">&nbsp;</td>
	  <td width="1%">&nbsp;</td>
    </tr>
  
  <tr>
    <td>Gauge</td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'final_inspaction_date','id'          => 'final_inspaction_date','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>										</td> 
						<td width="3%">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>Type of Sample </td>
    <td>:</td>
    <td>					<?php $data = array('name'        => 'style_no','id'          => 'style_no','value'       => '','maxlength'   => '20',
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
    <td>		<?php $options = array(
                  '0'  			=> 'Development',
                  '1'    		=> 'confirmorder',
				  '2'  			=> 'Pending',
				  '3'  			=> 'Cancel'
                   );
                   echo form_dropdown('status', $options, 'Select');
			  		?></td> 
						<td width="3%">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="5">
	<?php echo form_open('product_con/all_sample');   ?> 
	<?php echo form_submit('All Sample', 'All Sample'); ?></td>
	 <?php echo form_close(); ?></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<table align="center" width="80%" border="0">
  <tr>
    <td colspan="5">
	
	</td>
    </tr>
  
</table>
</div>





</body>
</html>
