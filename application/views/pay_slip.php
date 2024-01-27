<?php error_reporting(0);?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pay Slip</title>
 <style type="text/css">
   h1,h2,h3,h4,h5,h6{
    margin: 0;
    padding: 0;
   }

.details table{
  border-collapse: collapse;
  width: 450px;
  font-size: 11px;
}
.details table tr,.details table tr td,.details table tr th{
 border: 1px solid #dddddd;
}
.details table td{
 width: 50%;
}
/*.footer_table table{
  border: 0px;
}
.footer_table table tr,.footer_table table th,.footer_table table td{
  border:0px;
}*/
</style>
</head>
<body>
<div class="container" style="width: 940px;margin:0 auto;">
<?php
$count = count($values['emp_id']);
for($i=0;$i<$count;$i++)
{
  if($i%2==0){
    if($i==0){
      echo '<div style="width:100%;height:0px;clear:both;"></div>';
    }else{
      echo '<div style="width:100%;height:15px;clear:both;"></div>';
    }
    
  }
  if($i%4==0){
    if($i==0){
    echo '<div style="width:100%;height:0px;clear:both;"></div>';
    }else{
      echo '<div style="width:100%;height:10px;clear:both;"></div>';
    }
  }
?>
  <div class="left_side" style="float:left;width:450px;height:640px;border:1px solid gray;padding:5px;margin-right:5px;">
    <h5 style="text-align: center;">টাইম সোয়েটারস লিমিটেড</h5>
    <h6 style="text-align: center;">কুতুবাইল,কাঠেরপুল, ফতুল্লা, নারায়ণগঞ্জ</h6>
    <h6 style="text-align: center;"><span style="border-bottom: 1px solid #000;font-weight: bold">মজুরী রশিদ</span></h6>
    <table style="text-align: center; font-size: 11px" cellpadding="2">
      <tr>
        <td style="width:85px;text-align: left">মাসঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;font-size: 13px;"><?php $salary_month = $values["salary_month"][$i]; echo date("m.Y", strtotime($salary_month));?></td>
        <td style="width:85px;text-align: left;padding-left:20px;font-size: 13px;">তারিখঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;"><?php echo date("Y-m-d");?></td>
      </tr>
      <tr>
        <td style="width:85px;text-align: left">কার্ড নংঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;font-size: 13px;"><?php echo $values["emp_id"][$i];   ?></td>
        <td style="width:85px;text-align: left;padding-left:20px;vertical-align: top;">পদবীঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;vertical-align: top;"><?php echo $values["desig_bangla"][$i];   ?></td>
      </tr>

      <tr>
        <td style="width:85px;text-align: left">সেকশনঃ</td>
        <td style="text-align: left;"><?php echo $values["sec_bangla"][$i];   ?></td>
        <td style="width:85px;text-align: left;padding-left:20px;">গ্রেডঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;font-size: 13px;"><?php echo $values["gr_name"][$i];   ?></td>
      </tr>
      <tr>
        <td style="width:85px;text-align: left;vertical-align: top;">নামঃ</td>
        <td style="text-align: left;width: 115px;height:25px;vertical-align: top;"><?php echo $values["bangla_nam"][$i];?></td>
        <td style="width:85px;text-align: left;padding-left:20px;font-size: 13px;">সর্ব মোট বেতনঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;"><?php echo  $values["gross_sal"][$i];   ?></td>
      </tr>

      <tr>
        <td style="width:85px;text-align: left">অনুপস্থিতি দিনঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;font-size: 13px;"><?php echo $values["absent_days"][$i]; ?></td>
        <td style="width:85px;text-align: left;padding-left:20px;">মোট কর্ম দিবসঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;font-size: 13px;"><?php echo  $values["att_days"][$i];?></td>
      </tr>
    </table>
    <div style="clear:both;height: 3px;width: 85%;"></div>
    <div class="details">
    <table cellpadding="3">
      <tr><th>বিবরণ</th><th>টাকা</th></tr>
      <tr>
        <td>মূল বেতন</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo  $values["basic_sal"][$i];?></td>
      </tr>
      <tr>
        <td>বাড়ি ভাড়া</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo  $values["house_r"][$i];?></td>
      </tr>
      <tr>
        <td>মেডিকেল</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo $medical_allowance = 600; ?></td>
      </tr>
      <tr>
        <td>যাতায়াত ভাড়া</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo $transpot_allowance = 350; ?></td>
      </tr>
      <tr>
        <td>খাদ্য ভাতা</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo $food_allowance = 900; ?></td>
      </tr>
      <tr>
        <td>অনুপস্থিতি কর্তন</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo  $values["abs_deduction"][$i];?></td>
      </tr>
      <tr>
        <td>ন্যূনতম মজুরী</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php  echo $values["gross_sal"][$i];?></td>
      </tr>
      <tr>
        <td>হাজিরা বোনাস</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo $values["att_bonus"][$i];?></td>
      </tr>
      <tr>
        <td>উৎপাদন মজুরী</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo $values['pd_amount'][$i]; ?></td>
      </tr>

      <tr>
        <td>উৎপাদন বোনাস</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo $values['pd_bonus_amount'][$i];?></td>
      </tr>
      <tr>
        <td>নো ওয়ার্ক টাকা</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo $values['none_work_allowance'][$i]; ?></td>
      </tr>
      <tr>
        <td>সাবসিডি</td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;">
          <?php 

            $abs_deduct = $values['abs_deduction'][$i];
            $ababs_deduct = $values['before_after_absent_amount'][$i];
            $adv_deduct = $values['adv_deduct'][$i];
            $deduct_amount  = $values['deduct_amount'][$i];

            $abs_deduct = $abs_deduct + $ababs_deduct;

             $pd_amount = $values['pd_amount'][$i];
             $none_work_allowance = $values['none_work_allowance'][$i];

             $net_wages_after_deduction = $values['gross_sal'][$i] - ($abs_deduct + $adv_deduct + $deduct_amount);

              if($net_wages_after_deduction > ($pd_amount + $none_work_allowance))
                {
                 $subsidary  = ($net_wages_after_deduction) - ($pd_amount + $none_work_allowance);
                 echo ceil($subsidary);
                }
                else
                {
                 echo $subsidary = 0;
                }

            ?>

        </td>
      </tr>
      <tr>
        <td>স্ট্যাম্প কর্তন (সকলের জন্য) </td>
        <td style="text-align: center;font-family: SutonnyMJ;font-size: 13px;"><?php echo $stam_value = 10; ?></td>
      </tr>
      <tr>
        <td>নীট প্রদেয়</td>
        <td style="text-align: center;font-family: SutonnyMJ;">
        <?php 
          $att_bonus = $values['att_bonus'][$i];
          $pd_bonus_amount = $values['pd_bonus_amount'][$i];
          $night_allowance = $values['night_allowance'][$i];
          $holiday_allowance = $values['holiday_allowance'][$i];

          $net_pay = ($subsidary + $pd_amount  + $att_bonus + $pd_bonus_amount+$night_allowance+$holiday_allowance+$none_work_allowance) - $stam_value;

          echo ceil($net_pay) ;
        ?>
          
        </td>
      </tr>
    </table>

    <div style="clear:both;height: 30px;width: 85%;"></div>

    <div class="footer_table" style="width: 450px;">
      <div class="left-sign" style="width: 220px;display: inline;float: left;font-size: 14px;">হিসাবরক্ষক</div>
      <div class="right-sign" style="width: 220px;display: inline;float: right;text-align: right;font-size: 14px;">গ্রহীতা</div>
    </div>
    </div>
    
  </div>
  <?php

      //$i++;

     }
    ?>
  <!-- <div class="right_side" style="float:right;width:440px;border:1px solid gray;padding:5px;">
    <h5 style="text-align: center;">টাইম সোয়েটারস লিমিটেড</h5>
    <h6 style="text-align: center;">কুতুবাইল,কাঠেরপুল, ফতুল্লা, নারায়ণগঞ্জ</h6>
    <h6 style="text-align: center;"><span style="border-bottom: 1px solid #000;font-weight: bold">মজুরী রশিদ</span></h6>
    <table style="text-align: center; font-size: 11px" cellpadding="2">
      <tr>
        <td style="width:85px;text-align: left">মাসঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;"><?php $salary_month = $values["salary_month"][$i]; echo date("m.Y", strtotime($salary_month));?></td>
        <td style="width:85px;text-align: left;padding-left:20px;">তারিখঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;"><?php echo date("Y-m-d");?></td>
      </tr>
      <tr>
        <td style="width:85px;text-align: left">কার্ড নংঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;"><?php echo $values["emp_id"][$i];   ?></td>
        <td style="width:85px;text-align: left;padding-left:20px;">পদবীঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;"><?php echo $values["desig_bangla"][$i];   ?></td>
      </tr>

      <tr>
        <td style="width:85px;text-align: left">সেকশনঃ</td>
        <td style="text-align: left;"><?php echo $values["sec_bangla"][$i];   ?></td>
        <td style="width:85px;text-align: left;padding-left:20px;">গ্রেডঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;"><?php echo $values["gr_name"][$i];   ?></td>
      </tr>
      <tr>
        <td style="width:85px;text-align: left">নামঃ</td>
        <td style="text-align: left;"><?php echo $values["bangla_nam"][$i];   ?></td>
        <td style="width:85px;text-align: left;padding-left:20px;">সর্ব মোট বেতনঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;"><?php echo  $values["gross_sal"][$i];   ?></td>
      </tr>

      <tr>
        <td style="width:85px;text-align: left">অনুপস্থিতি দিনঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;"><?php echo $values["absent_days"][$i]; ?></td>
        <td style="width:85px;text-align: left;padding-left:20px;">মোট কর্ম দিবসঃ</td>
        <td style="text-align: left;font-family: SutonnyMJ;"><?php echo  $values["att_days"][$i];?></td>
      </tr>
    </table>
    <div style="clear:both;height: 3px;width: 85%;"></div>
    <div class="details">
    <table cellpadding="3">
      <tr><th>বিবরণ</th><th>টাকা</th></tr>
      <tr>
        <td>মূল বেতন</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo  $values["basic_sal"][$i];?></td>
      </tr>
      <tr>
        <td>বাড়ি ভাড়া</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo  $values["house_r"][$i];?></td>
      </tr>
      <tr>
        <td>মেডিকেল</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo $medical_allowance = 600; ?></td>
      </tr>
      <tr>
        <td>যাতায়াত ভাড়া</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo $transpot_allowance = 350; ?></td>
      </tr>
      <tr>
        <td>খাদ্য ভাতা</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo $food_allowance = 900; ?></td>
      </tr>
      <tr>
        <td>অনুপস্থিতি কর্তন</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo  $values["abs_deduction"][$i];?></td>
      </tr>
      <tr>
        <td>ন্যূনতম মজুরী</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php  echo $values["gross_sal"][$i];?></td>
      </tr>
      <tr>
        <td>হাজিরা বোনাস</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo $values["att_bonus"][$i];?></td>
      </tr>
      <tr>
        <td>উৎপাদন মজুরী</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo $values['pd_amount'][$i]; ?></td>
      </tr>

      <tr>
        <td>উৎপাদন বোনাস</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo $values['pd_bonus_amount'][$i];?></td>
      </tr>
      <tr>
        <td>নো ওয়ার্ক টাকা</td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo $values['none_work_amount'][$i]; ?></td>
      </tr>
      <tr>
        <td>সাবসিডি</td>
        <td style="text-align: center;font-family: SutonnyMJ;">
          <?php 

            $abs_deduct = $values['abs_deduction'][$i];
            $ababs_deduct = $values['before_after_absent_amount'][$i];
            $adv_deduct = $values['adv_deduct'][$i];
            $deduct_amount  = $values['deduct_amount'][$i];

            $abs_deduct = $abs_deduct + $ababs_deduct;

             $pd_amount = $values['pd_amount'][$i];
             $none_work_allowance = $values['none_work_allowance'][$i];

             $net_wages_after_deduction = $values['gross_sal'][$i] - ($abs_deduct + $adv_deduct + $deduct_amount);

              if($net_wages_after_deduction > ($pd_amount + $none_work_allowance))
                {
                 $subsidary  = ($net_wages_after_deduction) - ($pd_amount + $none_work_allowance);
                 echo ceil($subsidary);
                }
                else
                {
                 echo $subsidary = 0;
                }

            ?>

        </td>
      </tr>
      <tr>
        <td>স্ট্যাম্প কর্তন (সকলের জন্য) </td>
        <td style="text-align: center;font-family: SutonnyMJ;"><?php echo $stam_value = 10; ?></td>
      </tr>
      <tr>
        <td>নীট প্রদেয়</td>
        <td style="text-align: center;font-family: SutonnyMJ;">
        <?php 
          $att_bonus = $values['att_bonus'][$i];
          $pd_bonus_amount = $values['pd_bonus_amount'][$i];
          $night_allowance = $values['night_allowance'][$i];
          $holiday_allowance = $values['holiday_allowance'][$i];

          $net_pay = ($subsidary + $pd_amount  + $att_bonus + $pd_bonus_amount+$night_allowance+$holiday_allowance+$none_work_allowance) - $stam_value;

          echo ceil($net_pay) ;
        ?>
          
        </td>
      </tr>
    </table>

    <div style="clear:both;height: 30px;width: 85%;"></div>

    <div class="footer_table" style="width: 440px;">
      <div class="left-sign" style="width: 220px;display: inline;float: left;font-size: 14px;">হিসাবরক্ষক</div>
      <div class="right-sign" style="width: 220px;display: inline;float: right;text-align: right;font-size: 14px;">গ্রহীতা</div>
    </div>
    </div>
  </div> -->
  <div style="width: 100%;height: 60px;clear: both;"></div>

</div>
</body>
</html>
