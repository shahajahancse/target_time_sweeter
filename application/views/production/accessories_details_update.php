<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/calendar.css" />
 <script type="text/javascript" src="<?php echo base_url();?>js/calendar_eu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Style Form</title>
</head>

<body>
<?php $attributes = array('class' => 'accesseries_view', 'id' => 'accesseries_view'); ?>
 <?php echo form_open('product_con/access_correction',$attributes) ; ?>
<?php // print_r($values);   

foreach ($values as $rows)
{

?>
<div style=" width:80% ; margin-left:10px ; margin-top:20px ;">
  <table width="95%" border="0" align="center">
    <tr>
      <td width="21%">Style or PO No.</td>
      <td width="1%">:</td>
      <td width="20%"><?php 
	  
	  $data = array(
              'id'  =>$rows->id
  
);

echo form_hidden($data);
	  
	  
	  
	  $data = array('name'        => 'style_no','id'          => 'style_no','value'       =>  $rows->style_no,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>      </td>
      <td width="15%">&nbsp;</td>
      <td>Accesseries Name</td>
      <td>:</td>
      <td width="20%"><?php $options = array(
				'0'  =>'Care'	,	
				'1'  =>'Hang tag',
				'2'  =>'Price tag',
				'3'  =>'Special price tag',
				'4'  =>'Sewing Thread',
				'5'  =>'Elastic',
				'6'  =>'Drawstring',
				'7'  =>'Zipper',
				'8'  =>'Draw Cord',
				'9'  =>'Wash Label',
				'10'  =>'Photo in lay',
				'11'  =>'Hanger Poly',
				'12'  =>'Back Board',
				'13'  =>'Lot Sticker',
				'14'  =>'Price Sticker',
				'15'  =>'Satin tape',
				'16'  =>'Button	Edit',
				'17'  =>'Main+size label',
				'18'  =>'Badge label',
				'19'  =>'Twile tap',
				'20'  =>'Poly',
				'21'  =>'Carton',
				'22'  =>'Gum tap',
				'23'  =>'Scotch tap',
				'24'  =>'Tag pin',
				'25'  =>'PO NUMBER LABEL',
				'26'  =>'COUNTRY OF ORIGIN LABEL',
				'27'  =>'ZIPPER PULLAR',
				'28'  =>'BARCODE STICKER',
				'29'  =>'SHOE STRING',
				'30'  =>'Wood Button',
				'31'  =>'cotton',
				'32'  =>'Lace',
				'33'  =>'Metal Eyelet',
				'34'  =>'Special Carton Tag',
				'35'  =>'Hang tag Gencod Sticker',
				'36'  =>'Parcel Gencod Sticker',
				'37'  =>'Hanger',
				'38'  =>'Rivet',
				'39'  =>'FLAG',
				  );
    $accesseries_name=$rows->accesseries_name ;			
	$count=count($options);
	echo '<select name="accesseries_name">';
	for($i=0;$i< $count; $i++)
	{
		
		if ($options[$i] == $accesseries_name)
		{
			echo "<option value='$accesseries_name' selected='selected'> $accesseries_name </option>";
		}
		else
		{
			echo "<option value='$options[$i]' >$options[$i]</option>";
		}
	}
	echo '</select>';
	?>	     </td>
    </tr>
    <tr>
      <td>Required Quantity</td>
      <td>:</td>
      <td><?php $data = array('name'        => 'required_qty','id'          => 'required_qty','value'       => $rows->accesseries_name,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
      <td width="15%">&nbsp;</td>
      <td width="21%">Accessories Order Date </td>
      <td width="2%">: </td>
      <td><?php
	  
	  $accessories_order_date=$rows->accessories_order_date ;
	  $accessories_order_date = gmdate("d-m-Y", strtotime($accessories_order_date)); 
	  
	  
	   $data = array('name'        => 'accessories_order_date','id'          => 'accessories_order_date','value'       =>$accessories_order_date,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>
						
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'accesseries_view',
									// input name
									'controlname': 'accessories_order_date'
								});
								
					</script>		
						
						</td>
    </tr>
	<tr>
      <td>Required in House date</td>
      <td>:</td>
      <td><?php 
	  
	  $required_in_house_date=$rows->required_in_house_date ;
	  $required_in_house_date = gmdate("d-m-Y", strtotime($required_in_house_date)); 
	  
	  $data = array('name'        => 'required_in_house_date','id'          => 'required_in_house_date','value'       => $required_in_house_date,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>
						
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'accesseries_view',
									// input name
									'controlname': 'required_in_house_date'
								});
								
					</script>		
						
						</td>
      <td width="15%">&nbsp;</td>
      <td width="21%">Received Quantity</td>
      <td width="2%">: </td>
      <td><?php $data = array('name'        => 'received_qty','id'          => 'received_qty','value'       => $rows->received_qty,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
    </tr>
	<tr>
      <td>Required date</td>
      <td>:</td>
      <td><?php 
	    $required_date=$rows->required_date ;
	  $required_date = gmdate("d-m-Y", strtotime($required_date)); 
	  
	  
	  $data = array('name'        => 'required_date','id'          => 'required_date','value'       => $required_date,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'accesseries_view',
									// input name
									'controlname': 'required_date'
								});
								
					</script>		
						
						</td>
      <td width="15%">&nbsp;</td>
      <td width="21%">Supplier</td>
      <td width="2%">: </td>
      <td><?php $data = array('name'        => 'supplier','id'          => 'supplier','value'       => $rows->supplier,'maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?></td>
    </tr>
	 <tr>
      <td colspan="3"><?php  echo form_close(); ?> </td>
      <td width="15%">&nbsp;</td>
      <td width="21%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	
	<?php  }  ?>
  </table>

<table style="width:600px; margin:0 auto; ">
  <tr>
    <td width="3%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="7%"><?php echo form_submit('Update','Update'); ?>
		 <?php  echo form_close(); ?> </td>
	<td width="26%"> <?php  //echo  form_open('product_con/all_style');   ?> 
 <?php //echo form_submit('All Style','All Style'); ?>
 <?php echo form_close(); ?>
	<?php //echo form_open('product_con/style_find');   ?>
	<?php // $data = array('name'        => 'style_no','id'          => 'style_no','value'       => '','maxlength'   => '10',
             		//	'size'        => '20',
              		//	'style'       => 'width:60%',
           		//		 );
              	//		echo form_input($data);	
 // echo form_submit('Find','Find');  
// echo form_close(); ?>	</td>
 <td width="10%"><?php //echo form_open('product_con/all_style');   ?> 
             <?php //echo form_submit('Update','Update'); ?> 
			 <?php //echo form_close(); ?> </td>
 <td width="10%">
 </td>
 </td>
	  <td width="34%">
     <td width="1%">&nbsp;</td>
 <td width="5%"></td>
  </tr>
</table>




</div>
</body>
</html>
