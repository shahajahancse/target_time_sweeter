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
		<td align="center" colspan="14">Color wise qty Details</td>
	</tr>
	
 
  <tr align="center" style="background-color:#507CD1; color:#FFFFFF;">
    <td width="12%">Color</td>
    <td width="12%">Size</td>
    <td width="12%">Qty</td>
  </tr>


<?php

//print_r($values);
 $count=count($values);
for($i=0; $i < $count ; $i++)
{
	echo "<tr style='background-color:#EFF3FB;'>";
	echo "<td>" ;
	echo $values[$i]['color'] ;
	echo "</td>";
    echo "<td>";
	echo $values[$i]['size'] ;
	echo "</td>" ;
    echo "<td>";
	echo $values[$i]['qty'] ;
	echo "</td>";
     
?>
	
    </tr>
	
<?php 
 }
?>

<tr align="center" style="background-color:#507CD1; color:#FFFFFF;">
    <td colspan="2">&nbsp;</td>
    <td width="12%">Qty</td>
  </tr>
</table>
</body>
</html>
