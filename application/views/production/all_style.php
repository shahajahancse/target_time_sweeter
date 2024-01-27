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
		<td align="center" colspan="14"><h3>All Style Details</h3></td>
	</tr>
  <tr align="center" style="background-color:#507CD1; color:#FFFFFF;">
    <td>SNo</td> <td width="6%">Style No</td>
    <td width="7%">Buyer Name</td>
    <td width="7%">Department</td>
    <td width="16%">Describtion</td>
    <td width="7%">Inquiry Received Date</td>
    <td width="9%">Order confirmation Date</td>
    <td width="10%">Final Inspaction date</td><td width="5%">Payment Mode </td>
    <td width="9%">Merchandise Name</td>
    <td width="6%">Order Status</td>
    <td width="4%">Picture</td>
    <td width="2%">Action</td>
    <td width="4%">Action</td>
  </tr>





<?php
$i=0;
foreach ($values as $rows)
{
$i=$i+1;
echo "<tr style='background-color:#EFF3FB;' ><td>$i</td>
	<td>$rows->style_no</td>
    <td>$rows->buyer_name</td>";
$departmet=array();
$departmet[0]='Newborn';
$departmet[1]='Kids Boys';
$departmet[2]='Kids girl';
$departmet[3]='Teenier';
$departmet[4]='Ladies Fashion';
$departmet[5]='Ladies classic';
echo "<td>";
echo $departmet[$rows->department];
"</td>";
echo "<td>$rows->style_describtion</td>
	<td>$rows->inquery_received_date</td>
	<td>$rows->order_confirmation_date</td>
	<td>$rows->final_inspaction_date </td>";


$paymentmode = array(
                  '0'  		=> 'Cash',
                  '1'   	=> 'Cheque',
				  '2'  		=> 'L/C'
                   );
$paymentmode[$rows->paymentmode];	
echo "<td>";

echo $paymentmode[$rows->paymentmode];
echo "</td>";

$merchandisename = array(
                  '0' 	 => 'Sayed',
                  '1'    => 'Kamrull ',
				  '2' 	 => 'Sumon',
                  '3'    => 'Hassan ',
               );
echo "<td>" ;
echo $merchandisename[$rows->merchandisename];
echo "</td>";
$orderstatus = array(
                  '0'  			=> 'Development',
                  '1'    		=> 'Confirm Order',
				  '2'  			=> 'Pending',
				  '3'  			=> 'Cancel'
                   );
echo "<td>";
echo $orderstatus[$rows->orderstatus];
echo "</td>";
?>
	<?php  $picture = $rows->picture_name; ?>
	<?php	$path =base_url().'uploads/'.$picture; ?>
	
	
	<td style="width:20px; height:20px;">
	<div class="gallerycontainer">
		<?php $url = "product_con/edit_style/".$rows->style_no."/" ; ?>
	<a class="thumbnail" href="<?php echo site_url();?>/product_con/edit_style/<?php echo $rows->style_no ;?>"><img src="<?php echo $path ; ?>" width="100%" height="100%" border="0" />
	<span><img src="<?php echo $path ; ?>" /></span></a></div>
	</td>
	<td>
	<?php $url = "product_con/edit_style/".$rows->style_no."/" ;
				echo anchor( $url,'Edit', 'style="text-decoration:none;"'); ?>
	
	</td>
	
	<td>
	<?php $url = "product_con/delete_style/".$rows->style_no."/" ;
				echo anchor($url,'Delete','style="text-decoration:none;"'); ?>
	
	</td>
	
    </tr>
	
<?php 
  }
$i++;
?>
<tr style='background-color:#2461BF;'>
		<td align="center" colspan="14"><?php  echo $this->pagination->create_links(); ?></td>
	</tr>
</table>


</body>
</html>
