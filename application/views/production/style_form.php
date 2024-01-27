<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/calendar.css" />
 <script type="text/javascript" src="<?php echo base_url();?>js/calendar_eu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Style Form</title>
</head>

<body>
<?php $attributes = array('class' => 'style_view', 'id' => 'style_view'); ?>
 <?php echo form_open_multipart('product_con/style_form',$attributes) ; ?>

<div style=" width:1000px ; margin-left:10px ; margin-top:20px ; padding-top:30px;">

<table align="center" width="80%" border="0">
  <tr>
    <td width="19%">Buyer Name</td>
    <td width="1%">:</td>
    <td width="22%"><?php $data = array('name'        => 'buyer_name','id'          => 'buyer_name','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>	  </td>
											<td width="15%">&nbsp;</td>
		<td>Style/PO No</td>
    <td>:</td>
    <td width="20%"> <?php $data = array('name'        => 'style_no','id'          => 'style_no','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:95%',
           				 );
              			echo form_input($data);	
				 
						 			  		?>	</td>
  </tr>
  <tr>
    

    <td>Department </td>
    <td>:</td>
    <td> <?php $options = array(
                  '0'  		=> 'Newborn',
                  '1'  		=> 'Kids Boys',
				  '2'  		=> 'Kids girl',
                  '3'    	=> 'Teenier ',
				  '4'  		=> 'Ladies Fashion',
                  '5'   	=> 'Ladies classic',
                 );
                   echo form_dropdown('department', $options, 'Select');
			  		?></td>
					<td width="15%">&nbsp;</td>
					<td width="21%">Style Picture </td>
    <td width="2%">: </td>
    <td>
<input type="file" name="userfile" size="13" /></td>
  </tr>
  
  <tr>
    <td>Gauge</td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'gauge','id'          => 'gauge','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>								</td> 
						<td width="15%">&nbsp;</td>
    <td>Yarn Details </td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'yarn','id'          => 'yarn','value'       => '','maxlength'   => '90%',
              			'size'        => '80',
              			'style'       => 'width:100%',
						'rows'			=>'3',
						'cols'        =>'3',
           				 );
              			echo form_textarea($data);	
			  		?>	</td>
  </tr>
  <tr>
    <td>Labdip Details </td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'labdip','id'          => 'labdip','value'       => '','maxlength'   => '90%',
              			'size'        => '80',
              			'style'       => 'width:100%',
						'rows'			=>'3',
						'cols'        =>'3',
           				 );
              			echo form_textarea($data);	
			  		?>							</td> 
						<td width="15%">&nbsp;</td>
    <td>Size Ratio </td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'size_r','id'          => 'size_r','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?></td>
  </tr>
  <tr>
    <td>Weight Ratio </td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'weight_r','id'          => 'weight_r','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>				</td> 
						<td width="15%">&nbsp;</td>
    <td>Sub Materials </td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'sub_materials','id'          => 'sub_materials','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?></td>
  </tr>
  <tr>
    <td>Final Inspection Date</td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'final_inspaction_date','id'          => 'final_inspaction_date','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>
						
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'style_view',
									// input name
									'controlname': 'final_inspaction_date'
								});
								
					</script>						</td> 
						<td width="15%">&nbsp;</td>
    <td>Payment Mode </td>
    <td>:</td>
    <td> <?php $options = array(
                  '0'  		=> 'Cash',
                  '1'   	=> 'Cheque',
				  '2'  		=> 'L/C'
                   );
                   echo form_dropdown('paymentmode', $options, 'Select');
			  		?></td>
  </tr>
  
  <tr>
    <td>Inquiry Received Date</td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'inquery_received_date','id'          => 'inquery_received_date','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	 ?>
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'style_view',
									// input name
									'controlname': 'inquery_received_date'
								});
								
					</script>					</td>
					<td width="15%">&nbsp;</td>

    <td>Order Confirmation Date</td>
    <td>:</td>
    <td> <?php $data = array('name'        => 'order_confirmation_date','id'          => 'order_confirmation_date','value'       => '','maxlength'   => '20',
              			'size'        => '50',
              			'style'       => 'width:80%',
           				 );
              			echo form_input($data);	?>
						
						<script language="JavaScript">
						new tcal ({
									// form name
									'formname': 'style_view',
									// input name
									'controlname': 'order_confirmation_date'
								});
								
					</script>						</td>
  </tr>
 <tr>
    <td width="19%">Style Describtion</td>
    <td width="1%">:</td>
    <td><?php $data = array('name'        => 'style_describtion','id'          => 'style_describtion','value'       => '','maxlength'   => '90%',
              			'size'        => '80',
              			'style'       => 'width:100%',
						'rows'			=>'3',
						'cols'        =>'3',
           				 );
              			echo form_textarea($data);	
			  		?>	  </td>
	  <td width="15%">&nbsp;</td>
		
	 <td>Merchandise Name</td>
    <td>:</td>
    <td> <?php $options = array(
                  '0' 	 => 'Sayed',
                  '1'    => 'Kamrull ',
				  '2' 	 => 'Sumon',
                  '3'    => 'Hassan ',
                      );
                   echo form_dropdown('merchandisename', $options, 'Select');
			  		?></td>	
  </tr> 
  
  
  <tr>
    <td>Order Status</td>
    <td>:</td>
    <td> <?php $options = array(
                  '0'  	 => 'Development',
                  '1'    => 'Confirm Order',
				  '2'    => 'Pending',
				  '3'    => 'Cancel'
                   );
                   echo form_dropdown('orderstatus', $options, 'Select');
			  		?></td>
					<td width="15%">&nbsp;</td>
	
 
    <td>
	<td width="2%">&nbsp;</td>
	 </td>
  </tr>

</table>

<table style="width:600px; margin:0 auto; ">
  <tr>
    <td width="3%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="7%"><?php echo form_submit('send','Send'); ?>
		 <?php  echo form_close(); ?> </td>
	<td width="26%"> <?php  echo  form_open('product_con/all_style');   ?> 
 <?php echo form_submit('All Style','All Style'); ?>
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
