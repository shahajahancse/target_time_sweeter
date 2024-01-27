<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/image_zoom.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<table cellpadding="0" cellspacing="0" align="center" width="80%" border="1" style="font-size:12px; text-decoration:none;">
  <tr style='background-color:#ECE9D8;' >
		<td align="center" colspan="14"><h3>All Sample Details</h3></td>
	</tr>
  <tr align="center" style="background-color:#507CD1; color:#FFFFFF;">
   	<td width="15%">Style No</td>
    <td width="15%">Sample Type</td>
    <td width="15%">Sending Date</td>
    <td width="15%">Comment Date</td>
    <td width="15%">In House Date</td>
    <td width="15%">Status</td>
    <td width="5%">Action</td>
    <td width="5%">Action</td>
  </tr>


<?php

//print_r($values);
foreach ($values->result() as $rows)
{
echo "<tr style='background-color:#EFF3FB;' >
	<td>$rows->style_no</td> 
	<td>$rows->sample_type</td> 
	<td>$rows->sending_date</td> 
	<td>$rows->comment_date</td> 
	<td>$rows->in_house_date</td> 
	<td>$rows->status</td> ";
   
?>
	
	<td>
	<?php  $url = "product_con/sample_edit/".$rows->style_no."/" ;
				  echo  anchor( $url,'Edit', 'style="text-decoration:none;"'); ?>
	
	</td>
	
	<td>
	<?php  $url = "product_con/sample_delete/".$rows->style_no."/" ;
				echo anchor($url,'Delete','style="text-decoration:none;"'); ?>
	
	</td>
	
    </tr>
	
<?php 
  }
?>
</table>
</body>
</html>
