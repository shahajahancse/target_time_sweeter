<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <script type="text/javascript" src="<?php echo base_url();?>js/calendar_eu.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>js/production.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<div  style=" margin:0 auto; width:500px; height:100px; margin-top:30px;">
 	<?php //$values[0]['color'];	
	 echo form_open('product_con/required_winding') ; ?>
	<?php              ?>										
									
<table style="padding-top:50px;" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td  width="35%" >
	    Yarn Color          :	</td>
	<td width="24%"><select name="yarn_color" id="yarn_color" onchange="yarn_qty()">
						<option value="Select" selected="selected">Select</option>
				<?php
					$count = count($values) ;
					for($i=0; $i < $count ; $i++)
					{
					?>	
			
						<option value="<?php echo $values[$i]['color_id'] ?>"><?php echo $values[$i]['color'] ?></option>
				<?php
				}
				?>	
	  </select>	   </td>
	<td  width="41%" >&nbsp;</td>
</tr>

<tr>
	<td  width="35%" >Total Yarn : </td>
	<td width="24%">
	<?php $data = array('name'        => 'required','id'          => 'required','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:50%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>
											
											<input type="hidden" value="" name="s_no" id="s_no" />												</td>
	<td  width="41%" >&nbsp;</td>
</tr>
<tr>
	<td  width="35%" >
	    Yarn	Required for winding: </td>
	<td width="24%">
	<?php $data = array('name'        => 'total_yarn','id'          => 'total_yarn','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:50%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>	</td>
	<td  width="41%" >&nbsp;</td>
</tr>
<?php echo form_open('product_con/winding_find') ; ?>
<tr>
	<td  width="35%" >
	<input type="button" name="save_yarn" id="save_yarn" value="Save" onclick="button_save()" />
	    &nbsp;</td>
	<td width="24%">	</td>
	<td  width="41%" >&nbsp;</td>
</tr>
</table>

</div>
</body>
</html>
