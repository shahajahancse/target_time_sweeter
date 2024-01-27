<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/calendar.css" />
 <script type="text/javascript" src="<?php echo base_url();?>js/calendar_eu.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>js/production.js"></script>
 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<div style="width:800px; height:700px; border:#FF0000 1px solid; margin:0 auto;">
	
	<div style="float:right; width:300px; height:700px; border:#FFFF00 1px solid;">
	threee
	</div>
	<div style="float:right; width:495px; height:700px; border:#0000FF 1px solid;">
		<div style="width:495px; height:200px; border:#FF00FF 1px solid;">
		two
		</div>
		<div style="width:470px; height:470px; border:#FF00FF 1px solid; padding:10px;">
		
			<form name="form_yarn_type" id="form_yarn_type">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td  width="23%"><?php echo form_label('Style No ', 'label'); ?></td>
			
				<td  width="77%">
					<select name="style_no" id="style_no" onchange="yarn_type_find()">
						<option value="Select" selected="selected">Select</option>
				<?php
					$count = count($values) ;
					for($i=0; $i < $count ; $i++)
					{
					?>	
			
						<option value="<?php echo $values[$i]['style_no'] ?>"><?php echo $values[$i]['style_no'] ?></option>
				<?php
				}
				?>	
				</select>   
				

			</td>
			</tr>
			
			<tr>
				<td  width="23%"><?php echo form_label('Yarn type', 'label'); ?></td>
			
				<td  width="77%">	
						<select name="yarn_type" id="yarn_type" onchange="yarn_type_color()">
						<option value="Select" selected="selected">Select</option>
						<option value=""></option>
						</select>     </td>
			</tr>
			
			
			<tr>
				<td  width="23%"><?php echo form_label('Color', 'label'); ?></td>
			
				<td  width="77%"><?php $options = array(
                  '0'  			=> 'Red',
                  '1'    		=> 'Blue',
				  '2'  			=> 'Green',
				
                   );
                   echo form_dropdown('color', $options, 'Select');
			  		?>  </td>
			</tr>
			
			
			<tr>
				<td  width="23%"><?php echo form_label('Quantity', 'label'); ?></td>
			
				<td  width="77%"><?php $data = array('name'        => 'qty','id'          => 'qty','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:30%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>  </td>
			</tr>
			</table>
		</form>
		</div>
	</div>


</div>
</body>
</html>
