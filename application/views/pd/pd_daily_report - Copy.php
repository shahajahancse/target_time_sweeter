<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Daily Production Report of <?php echo date('d-M-Y', strtotime($date)); ?></title>
<style>
td{ padding:0px 5px 0px 5px;}
table{ font-family:Arial, Helvetica, sans-serif; font-size:12px;}
.daily{ color:green; text-align:right; font-weight:bold; font-size:14px;}
.total{ color:purple; text-align:right; font-weight:bold; font-size:14px;}
.balance{ color:red; text-align:right; font-weight:bold; font-size:14px;}
</style>
</head>
<body style=" margin:0 auto; font-family:Arial, Helvetica, sans-serif;">
<div style="text-align:center; margin-bottom:10px;">
<?php $this->load->view('head_english');?>
Daily Production Report of <?php echo date('d-M-Y', strtotime($date)); ?>
</div>
<table align="center" border="1" style="border-collapse:collapse;">
	<tr style="background-color:#9CF;">
    	<th rowspan="4">Sl#</th>
        <th rowspan="4">Buyer</th>
        <th rowspan="4">Article</th>
        <th rowspan="4">Total <br /> Qty</th>
        <!--<th rowspan="4">Color</th>
        <th rowspan="4">Size</th>
        <th rowspan="4">Color And <br />Size Wise <br /> Qty</th>-->
        <th rowspan="4">GG</th>
        <!--<th rowspan="4">Running<br />Machine</th>-->
        <th>Knitting</th>
        <th>Linking</th>
        <th>Trimming</th>
        <th>Mending</th>
    </tr>
    <tr style="background-color:#9CF;">
        <th>Daily</th>
        <th>Daily</th>
        <th>Daily</th>
        <th>Daily</th>
    </tr>
    <tr style="background-color:#9CF;">
        <th>Total</th>
        <th>Total</th>
        <th>Total</th>
        <th>Total</th>
    </tr>
    <tr style="background-color:#9CF;">
        <th>Balance</th>
        <th>Balance</th>
        <th>Balance</th>
        <th>Balance</th>
    </tr>
  
  <?php
  	//$query = $this->db->select('article_id,color_id,size_id')->where('date',$date)->group_by('article_id, color_id,size_id')->order_by('article_id,color_id,size_id')->get('pd_production_logs');
	$query = $this->db->select('article_id,color_id,size_id')->where('date',$date)->group_by('article_id')->order_by('article_id')->get('pd_production_logs');
	$i = 1;
	foreach($query->result() as $rows){?>
			<?php if($i%2 == 0){ echo "<tr style='background-color:#ccc;'>"; }
			else { echo "<tr style='background-color:#fff';>"; }
			?>
                <?php 
					$article_id = $rows->article_id;
					$size_id = $rows->size_id;
					$query = $this->db->select('article_id,order_number,gauge_id,buyer_id,total_quantity')->where('article_id_pk',$article_id)->get('pd_style_infos');
					if($query->num_rows() > 0)
					{
					$row = $query->row();
					$style = $row->article_id;
					$order_number = $row->order_number;
					$gauge_id = $row->gauge_id;
					$buyer_id = $row->buyer_id;
					$total_quantity = $row->total_quantity;
					
					}else{ echo 'N/A';}
					?> 
                <td rowspan="4"> <?php echo $i;?> </td>
                <td rowspan="4"> 
					<?php 
					$query = $this->db->select('buyer_name')->where('buyer_id',$buyer_id)->get('pd_buyer_infos');
					if($query->num_rows() > 0)
					{
					$row = $query->row();
					echo $buyer_name = $row->buyer_name;
					}else{ echo 'N/A';}
                    ?> 
                </td>
                <td rowspan="4"> <?php echo $style;?> </td>
                <td rowspan="4"> 
					<?php echo $total_quantity;?>
                </td>
                <!--<td rowspan="4"> 
                	<?php 
					/*$color_id = $rows->color_id;
					$query = $this->db->select('color_name')->where('color_id',$color_id)->get('pd_color_infos');
					if($query->num_rows() > 0)
					{
					$row = $query->row();
					echo $row->color_name;
					}else{ echo 'N/A';}*/
					?> 
                </td>
                 <td rowspan="4" style="text-align:center;"> 
                	<?php 
					/*$query = $this->db->select('size_name')->where('size_id',$size_id)->get('pd_size_infos');
					if($query->num_rows() > 0)
					{
					$row = $query->row();
					echo $row->size_name;
					}else{ echo 'N/A';}*/
					?> 
                </td>
                <td rowspan="4" style="font-weight:bold; text-align:center;"> 
					<?php 
					/*$query = $this->db->select('quantity')->where('article_id',$article_id)->where('color_id',$color_id)->where('size_id',$size_id)->get('pd_size_wise_lots');
					if($query->num_rows() > 0)
					{
					$row = $query->row();
					echo $color_size_wise_qty = $total_quantity; //$row->quantity;
					}else{ echo 'N/A';}*/
					$color_size_wise_qty = $total_quantity;
					?> 
                </td>-->
                <td rowspan="4"> 
					<?php 
					$query = $this->db->select('gauge_name')->where('gauge_id',$gauge_id)->get('pd_gauge_infos');
					if($query->num_rows() > 0)
					{
					$row = $query->row();
					echo $row->gauge_name;
					}else{ echo 'N/A';}
					?> 
                </td>
                <!--<td rowspan="4" style="text-align:center;">
                	<?php
					//echo $running_machine = $this->db->distinct('machine_no')->where('date',$date)->where('article_id',$article_id)->where("machine_no != ''")->get('pd_production_logs')->num_rows();
					?>
                </td>-->
                </tr>
               
               <?php if($i%2 == 0){ echo "<tr style='background-color:#ccc;'>"; }
			   else { echo "<tr style='background-color:#fff';>"; }
			   ?>
                  <td class="daily">
                  <?php
                      //DAILY KNITTING TOTAL PRODUCTION
                      //KNITTING = (Knitting-12GG =1 + Knitting-7GG=28) 
                      $section_ids = array(1);
                      echo $daily_knittin = $this->pd_report_model->daily_total_quantity($date,$article_id,$section_ids);
                  ?>
                  </td>
                  <td class="daily">
                  <?php
                      //DAILY LINKING TOTAL PRODUCTION
                      //LINKING = (LINKING =37) 
                      $section_ids = array(2);
                      echo $daily_linking = $this->pd_report_model->daily_total_quantity($date,$article_id,$section_ids);
                  ?>
                  </td>
                  <td class="daily">
                  <?php
                      //DAILY TRIMMING TOTAL PRODUCTION
                      //TRIMMING = (TRIMMING =4) 
                      $section_ids = array(4);
                      echo $daily_trimming = $this->pd_report_model->daily_total_quantity($date,$article_id,$section_ids);
                  ?>
                  </td>
                  <td class="daily">
                  <?php
                      //DAILY MENDING TOTAL PRODUCTION
                      //MENDING = (MENDING =3) 
                      $section_ids = array(5);
                      echo $daily_mending = $this->pd_report_model->daily_total_quantity($date,$article_id,$section_ids);
                  ?>
                  </td>
               </tr> 
               <?php if($i%2 == 0){ echo "<tr style='background-color:#ccc;'>"; }
			   else { echo "<tr style='background-color:#fff';>"; }
			   ?>         
                  <td class="total">
                  <?php
                      //ORDER WISE TOTAL KNITTING PRODUCTION
                      //KNITTING = (Knitting-12GG =1 + Knitting-7GG=28) 
                      $section_ids = array(1);
                      echo $total_knittin = $this->pd_report_model->section_total_quantity($date,$article_id,$section_ids);
                  ?>
                  </td>
                  <td class="total">
                  <?php
                      //ORDER WISE TOTAL LINKING PRODUCTION
                      //LINKING = (LINKING =37) 
                      $section_ids = array(2);
                      echo $total_linking = $this->pd_report_model->section_total_quantity($date,$article_id,$section_ids);
                  ?>
                  </td>
                  <td class="total">
                  <?php
                      //ORDER WISE TOTAL TRIMMING PRODUCTION
                      //TRIMMING = (TRIMMING =4) 
                      $section_ids = array(4);
                      echo $total_trimming = $this->pd_report_model->section_total_quantity($date,$article_id,$section_ids);
                  ?>
                  </td>
                  <td class="total">
                  <?php
                      //ORDER WISE TOTAL MENDING PRODUCTION
                      //MENDING = (MENDING =3) 
                      $section_ids = array(5);
                      echo $total_mending = $this->pd_report_model->section_total_quantity($date,$article_id,$section_ids);
                  ?>
                  </td>
               </tr>
               <?php if($i%2 == 0){ echo "<tr style='background-color:#ccc;'>"; }
			   else { echo "<tr style='background-color:#fff';>"; }
			   ?>
                  <td class="balance">
                  <?php 
                      $balance = $total_knittin - $color_size_wise_qty;
                      if($balance < 0){echo $balance;}else{ echo "+$balance";}
                  ?>
                  </td>
                  <td class="balance">
                  <?php 
                      $balance_linking = $total_linking - $color_size_wise_qty;
                      if($balance_linking < 0){echo $balance_linking;}else{ echo "+$balance_linking";}
                  ?>
                  </td>
                  <td class="balance">
                  <?php 
                      $balance_trimming = $total_trimming - $color_size_wise_qty;
                      if($balance_trimming < 0){echo $balance_trimming;}else{ echo "+$balance_trimming";}
                  ?>
                  </td>
                  <td class="balance">
                  <?php 
                      $balance_mending = $total_mending - $color_size_wise_qty;
                      if($balance_mending < 0){echo $balance_mending;}else{ echo "+$balance_mending";}
                  ?>
                  </td>
               </tr>
              
               	
               
            </tr>
            	
            <?php $i++; } ?>
</table>
</body>
</html>