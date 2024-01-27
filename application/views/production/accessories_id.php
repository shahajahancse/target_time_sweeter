<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<div  style=" margin:0 auto; width:400px; height:100px; margin-top:30px;">
 <?php echo form_open('product_con/accessories_requirment') ; ?>
 	
											
											
<table style="padding-top:50px;"" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td  width="30%" >
	    &nbsp;&nbsp;Enter Style No   :
	</td>
	<td width="30%">
	<?php $data = array('name'        => 'style_no','id'          => 'style_no','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:50%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>
	</td>
	<td  width="30%" >
		<?php echo form_submit('Send','Send'); ?>
		 <?php  echo form_close(); ?>
	</td>
</tr>


</table>

</div>
</body>
</html>
