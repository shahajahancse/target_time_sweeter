<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/image_zoom.css" />
<script type="text/javascript" src="<?php echo base_url();?>css/jquery-1.3.1.min.js" > </script> 
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).text());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.print();
        return true;
    }

</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<div id="mydiv" style="width:900px; border:#FF0000 1px solid; margin:0 auto;">
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="16%">Article No </td>
    <td width="12%">Supplier</td>
    <td width="14%">Customer</td>
    <td width="9%">Terms</td>
    <td width="23%">Made of Shipment </td>
    <td width="26%">Shipment Date </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo  $style_details[0]["buyer_name"]  ;  ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="center" colspan="3">Description</td>
    <td  align="center" colspan="3">Color/Size/Qty</td>
    </tr>
  <tr>
    <td colspan="3">
	<?php echo  $style_details[0]["department"]  ;  ?></td>
    <td colspan="3">
	<table cellpadding="0" cellspacing="0" border="1" width="100%" height="100%">
	<?php
	$count = count($color_details) ;
	for($i=0; $i < $count ; $i++)
	{
	echo "<tr>";
	?>
	<td><?php echo  $color_details[$i]["color"]  ;  ?></td> 
	<td><?php echo  $color_details[$i]["size"]  ;  ?></td> 
	<td><?php echo  $color_details[$i]["qty"]  ;  ?></td> 
    </tr>
	<?php
	}
	
	?>
	</table>	</td>
    </tr>
   
	
	<tr>
    <td align="center" colspan="3">Note</td>
    <td colspan="3" rowspan="2">
	<table cellpadding="0" cellspacing="0" border="1" width="100%" height="100%">
	<?php
	$r=0;
	$count2 = count($color_total_qty) ;
	for($k=0; $k < $count2 ; $k++)
	{
	echo "<tr>";
	?>
	<td><?php echo  $color_total_qty[$k]["size"]  ;  ?></td> 
	<td><?php echo  $color_total_qty[$k]["qty"]  ;  ?>
	<?php $r=$r+$color_total_qty[$k]["qty"] ; ?>	</td> 
	</tr>
	<?php
	}
	
	?>
	</table>	</td>
    </tr>
	<tr>
	  <td colspan="3" rowspan="2" align="center">&nbsp;</td>
    </tr>
	
	<tr>
    <td colspan="2">Total</td>
    <td><?php echo $r ?></td>
    </tr>
	
	<tr>
    <td align="center" colspan="3">AWG SHIPPING MARK </td>
    <td colspan="3">Price : </td>
    </tr>
	
	<tr>
    <td colspan="3">&nbsp;</td>
    <td valign="top" colspan="3" rowspan="4">Fabrics :</td>
    </tr>
	<tr>
    <td align="center" style="font:bold;" colspan="3">Main Mark(both Side) </td>
    </tr>
	<tr>
    <td colspan="3">&nbsp;</td>
    </tr>
	<tr>
    <td align="center" colspan="3"><span style="font:bold;">Main Mark(both Side) </span></td>
    </tr>
	<tr>
    <td colspan="3">&nbsp;</td>
    <td valign="top" colspan="3" rowspan="3">Details of Garments:</td>
    </tr>
	<tr>
    <td align="center" colspan="3">Assortment</td>
    </tr>
	<tr>
    <td colspan="3">&nbsp;</td>
    </tr>
	
	<tr>
    <td colspan="2" rowspan="3">
	<?php $picture = $style_details[0]["picture_name"]  ;  ?>
	<?php	$path =base_url().'uploads/'.$picture; ?>
	<img src="<?php echo $path ; ?>" width="100%" height="100%" border="0" />	</td>
    <td width="14%" rowspan="3">&nbsp;</td>
    <td valign="top" colspan="3">Measurement:</td>
    </tr>
	

	<tr>
    <td valign="top" colspan="3">Accessories :<br/>
	<?php 
	$count5 = count($accesseries_details) ;
	for($m=0; $m < $count5 ; $m++)
	{
	?>
   <?php echo  $accesseries_name_group[$m]["accesseries_name"]  ;  ?>
   <?php echo  $accesseries_name_group[$m]["received_qty"] ; ?><br/>
    <?php  } ?>
	</td>
    </tr>
	

	<tr>
    <td valign="top" colspan="3">Sample:<br/>
	<?php 
	$count3 = count($sample_details) ;
	for($l=0; $l < $count2 ; $l++)
	{
	?>
   <?php echo  $sample_details[$l]["sample_type"]  ;  ?>:
	   <br/>
	  <?php  } ?>
	
	
	</td>
    </tr>
</table>
</div>
</body>
</html>
