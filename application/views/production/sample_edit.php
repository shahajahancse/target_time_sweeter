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
    <td width="19%">Type of Sample </td>
    <td width="1%">:</td>
    <td width="20%">				
	<?php $attributes = array('class' => 'style_view', 'id' => 'sample_view'); ?>
	<?php echo form_open('product_con/sample_update',$attributes);   ?> 
	<?php // print_r($values);  
	echo "Style No" ;   
	foreach($values  as $rows)
	{
		
	 $data = array('name'        => 'style_no','id'          => 'style_no','value'       => $rows->style_no,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:40%',
           				 );
              			echo form_input($data);	
	
	
	 ?>

		<?php $data = array('name'        => 'sample_type','id'          => 'sample_type','value'       => $rows->sample_type,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?></td> 
						<td width="3%">&nbsp;</td>
    <td>Sending Date </td>
    <td width="3%">:</td>
    <td><?php 
	
	$sending_date=$rows->sending_date ;
	$sending_date = gmdate("d-m-Y", strtotime($sending_date)); 
	
	$data = array('name'        => 'sending_date','id'          => 'sending_date','value'       => $sending_date,'maxlength'   => '20',
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
	<?php	
		$comment_date=$rows->comment_date ;
		$comment_date = gmdate("d-m-Y", strtotime($comment_date)); 
		
		
		 $data = array('name'        => 'comment_date','id'          => 'comment_date','value'       => $comment_date,'maxlength'   => '20',
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
    <td><?php 
	$in_house_date=$rows->in_house_date ;
	$in_house_date = gmdate("d-m-Y", strtotime($in_house_date)); 
	
	$data = array('name'        => 'in_house_date','id'          => 'in_house_date','value'       => $in_house_date ,'maxlength'   => '20',
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
	$orderstatus_form=$rows->status ;			
	$count=count($options);
	echo '<select name="status">';
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
						<td width="3%">&nbsp;</td>
    <td></td>
    <td>:</td>
    <td> </td>
  </tr>
  
 </table>
<?php }  ?>

<table align="center" width="73%" border="0">
  
  <tr>
    <td width="10px" ><?php echo form_submit('Update','Update'); ?> 
			 <?php echo form_close(); ?>
	
      </td>
		
   
  </tr>
</table>



</div>





</body>
</html>
