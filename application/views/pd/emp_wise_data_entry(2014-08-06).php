<style>
body{
	background:#ECE9D8;
}
.main_img{
	width:70px; 
	height:80px;
	border:1px solid #999;
	background-image:url(<?php echo base_url();?>img/icon.jpg);
	z-index:-9999;
}
.preview
{
	width:70px;
	height:80px;
	border:solid 1px #dedede;
	position:relative;
	/*left: 690px;
	top: 209px;*/
}
#ui-datepicker-div{
	top: 56px !important;
}
#grid_production_logs{
	height:auto;
	clear:both;
	/*border:1px solid #0F0;*/
	/*border-bottom:1px solid #A6C9E2;*/
}

.div_row_top{
	float:left; 
	background:#D2E6F5;
	padding-left:5px; 
	width:133px; 
	height:24px; 
	border-top:1px solid #A6C9E2;
	border-left:1px solid #A6C9E2; 
	border-bottom:1px solid #A6C9E2;
	text-align:center;
	font-weight:bold;
}
.div_row_top_for_size{
	float:left; 
	background:#D2E6F5;
	padding-left:5px; 
	width:105px; 
	height:24px; 
	border-top:1px solid #A6C9E2;
	border-left:1px solid #A6C9E2; 
	border-bottom:1px solid #A6C9E2;
	text-align:center;
	font-weight:bold;
}
.div_row_top_for_qty{
	float:left; 
	background:#D2E6F5;
	padding-left:5px; 
	width:175px; 
	height:24px; 
	border-top:1px solid #A6C9E2;
	border-left:1px solid #A6C9E2; 
	border-bottom:1px solid #A6C9E2;
	text-align:center;
	font-weight:bold;
}
.div_row_normal{
	float:left;
	/*background:#FFF;*/
	font-size:13px;
 	padding-left:5px; 
	width:133px; 
	height:24px; 
	border-left:1px solid #A6C9E2; 
	border-bottom:1px solid #A6C9E2;
}
.div_row_normal_for_size{
	float:left;
	/*background:#FFF;*/
	font-size:13px;
 	padding-left:5px; 
	width:105px; 
	height:24px; 
	border-left:1px solid #A6C9E2; 
	border-bottom:1px solid #A6C9E2;
}
.div_row_normal_for_qty{
	float:left;
	/*background:#FFF;*/
	font-size:13px;
 	padding-left:5px; 
	width:175px; 
	height:24px; 
	border-left:1px solid #A6C9E2; 
	border-bottom:1px solid #A6C9E2;
}
.add_submit{
	background:#333;
	color:#FFF;
	padding:4px;
	border-radius:4px;
}
input:focus{
	background:#FFC;
	color:#000;
}
select:focus{
	background:#FFC;
}
</style>
<form id="add_production_log" name="add_production_log" method="post" action="">
<div style="width:760px;">
	<fieldset><legend>Data Entry</legend>
    <div style="width:700px;">
    
    <div style="width:700px;">
		<table width="700">
    <tr>
      <td width="48">Date</td> 
      <td width="126"><input type="text" name="pd_log_date" id="pd_log_date" style="width:121px;" value="<?php echo date('d-m-Y'); ?>" class="datepicker" tabindex="1" autofocus/></td>
      
      <td colspan="2">&nbsp;</td> 
      
      <td width="106" rowspan="3"><div class="main_img">
            
        </div>
        </td>
      
    </tr>
    
    <tr>
    	<td>Section</td>
        <td>
        	<select id="section_id" name="section_id" style="width:121px; height:20px;" onchange="Getfloor()" tabindex="2">
            	<option value="">-Select Name-</option>
             <?php
		   		
				$this->db->select('*');
				//$this->db->where();
				$this->db->from('pr_section');
				$query = $this->db->get();
				foreach($query->result() as $row){
		   	?>
                <option value="<?php echo $row->sec_id;?>"><?php echo $row->sec_name;?></option>
            <?php } ?>
              </select>
         </td>
         
         
         <td width="55">Floor</td>
        <td width="138">
        	<select id="floor" name="floor" style="width:121px; height:20px;" onchange="Getblock()" tabindex="3">
                <option></option>
              </select>
         </td>
         
         <td width="38">Name</td>
    <td width="157">
        <input type="text" name="full_name" id="full_name" style="border:none; background:none; width:150px; font-weight:bold;" />
     </td>
    </tr>
    
    <tr>
    	<td>Block </td>
        <td>
        	<select id="block" name="block" style="width:121px; height:20px;"  tabindex="4">
                <option></option>
              </select>
         </td>
         
         <td>Emp ID</td>
        <td>
        	<input id="emp_id" name="emp_id" style="width:121px; height:20px;"  tabindex="5">
              </input>
         </td>
         
          <td>Desig.</td>
    <td>
         <input type="text" name="designation" id="designation" style="border:none; background:none; width:150px;" />
     </td>
    <input type="hidden"  id="enter_key_flag" value="0" />
    </tr>
    <input type="hidden" value="" name="count" id="count">
    
    <tr>
    <td colspan="4">&nbsp;</td> 
    </tr>
     <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
    
    </table> 
   
    </div>
    
    
    
    
    <div style="clear:both;"></div>
       <div id="grid_production_logs">
    	<div style="height:24px;">
        	<div class="div_row_top">
            
            	Artical ID
         	</div>
		<!--<div class="div_row_top">
            	Color Name
         	</div>-->
         <div class="div_row_top_for_size">
            	Size Name
         	</div>
            <div class="div_row_top">
            	Process Name
         	</div>
            <div class="div_row_top_for_qty">
            	Quantity
         	</div>
		
            <div style="clear:both;"></div>
        </div>
        <div style="width:575px; overflow:auto;" id="grids">
        
        </div>
		<div style="float:left; width:575px; text-align:right; height:24px;">
        	<input type="button"  value="Submit" id="add_production_log_button" tabindex="6" class="add_submit"/>
        </div>
    </div></div>

    </fieldset>
 </div>   
    




</form>

<link rel="stylesheet" href="<?php echo base_url();?>css/datepicker/jquery-ui-1.9.2.custom/development-bundle/themes/base/jquery-ui.css" />
<script src="<?php echo base_url();?>js/datepicker/jquery-1.8.3.js"></script>
<script src="<?php echo base_url();?>js/datepicker/jquery-ui.js"></script>

<script>

$(function(){
	
	
	$(document).keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        //alert(keycode);
        	var enter_flag = document.getElementById('enter_key_flag').value;
		
		//alert(enter_flag);	
        if(keycode == '13' && enter_flag == '1') { 
    	
    	//alert(keycode);
    		
		var emp_id = document.getElementById('emp_id').value;
		
		
		if(emp_id==0 || emp_id=='' || emp_id=='Emp ID Not Exists.')
		  {
		  	alert('Please Select Employee ID.');
			tabindex = 3;
			document.getElementById('emp_id').value() = '';
			document.getElementById('emp_id').focus();
		  	return;
		  }
		  
		  
		  dataString = $("#add_production_log").serialize();
		  $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/emp_wise_entry_con/add_production_log",
				data: dataString,
				cache: false,
				success: function(data){
					alert('Process Log is added Successfully!');
					var index = $("select#emp_id").prop('selectedIndex');
					if($('#emp_id option:last').val() == $('#emp_id option:selected').val())
					{
						$("select#emp_id").prop('selectedIndex', 0);
						$('#grids').html('');
						$('.main_img').html('');
						document.getElementById('enter_key_flag').value = 0;
						document.getElementById('emp_id').value = '';
						return false;
					}
		$("select#emp_id").prop('selectedIndex', index+1);
/*		if($("#emp_id").val() == '')
		{
			alert('sdf');
			return false;
		}*/
		//GetImageOthers();
					
				}
				});
			return false;	
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
        }
    });
	
	$('.datepicker').datepicker({
   		dateFormat: "dd-mm-yy"
 	});
 	
 	
 	$('#emp_id').keydown(function(){
 		var s_id = 'section_id';
	var f_id = 'floor';
	var b_id = 'block';	
	var e_id = 'emp_id';	
	var section_id = document.getElementById(s_id).value;
	var floor_id = document.getElementById(f_id).value;
	var block_id = document.getElementById(b_id).value;
 	if(section_id=='Select' || section_id=='' ){
		alert("Please select Section ");
		document.getElementById('emp_id').value = '';
	 	return;
	}
	if(floor_id=='Select' || floor_id=='' ){
		alert("Please select Floor ");
		document.getElementById('emp_id').value = '';
	 	return;
	}
	if(block_id=='Select' || block_id=='' ){
		alert("Please select Block ");
		document.getElementById('emp_id').value = '';
	 	return;
	}

	
		$(this).autocomplete(
		{
			source: "<?php echo base_url(); ?>index.php/emp_wise_entry_con/GetProcessEmp/"+section_id+"/"+floor_id+"/"+block_id,
			minLength: 0,
			autoFocus: false,
			async : false,
			select:function(event,ui){ 
			if(ui.item.value != "Emp ID Not Exists.")
			{
				GetImageOthers(ui.item.value);
			}
			else
			{
				alert("Emp ID Not Exists.");
				document.getElementById('emp_id').value = "";
				return false;
			}
			 }
		});
		
	});
 	
 	
	$('#add_production_log_button').click(function(){ 
		var emp_id = document.getElementById('emp_id').value;
		if(emp_id==0 || emp_id=='' || emp_id=='Emp ID Not Exists.')
		  {
		  	alert('Please Select Employee ID.');
			tabindex = 3;
			document.getElementById('emp_id').value() = '';
			document.getElementById('emp_id').focus();
		  	return;
		  }
		  
		  
		  dataString = $("#add_production_log").serialize();
		  $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/emp_wise_entry_con/add_production_log",
				data: dataString,
				cache: false,
				success: function(data){
					alert('Process Log is added Successfully!');
					var index = $("select#emp_id").prop('selectedIndex');
					if($('#emp_id option:last').val() == $('#emp_id option:selected').val())
					{
						$("select#emp_id").prop('selectedIndex', 0);
						$('#grids').html('');
						$('.main_img').html('');
						//enter_flag = 0;
						document.getElementById('enter_key_flag').value = 0;
						document.getElementById('emp_id').value = '';
						return false;
					}
		$("select#emp_id").prop('selectedIndex', index+1);
/*		if($("#emp_id").val() == '')
		{
			alert('sdf');
			return false;
		}*/
		//GetImageOthers();
				}
				});
			return false;	
	});


	$('#pd_log_date').keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
	   
        if(keycode == '13') { 
            tabindex++;
            if(tabindex == lastTabIndex){ tabindex = 3 } 
            $("[TabIndex='"+tabindex+"']").focus();
          
        }
    });
    $('#section_id').keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
	   
        if(keycode == '13') { 
            tabindex++;

            if(tabindex == lastTabIndex){ tabindex = 3 } 
            $("[TabIndex='"+tabindex+"']").focus();
          
        }
    });
    $('#emp_id').keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
	   
        if(keycode == '13' && tabindex != 3) { 
            tabindex++;
            
            /*while(($("[TabIndex='"+tabindex+"']").length == 0 || $("[TabIndex='"+tabindex+"']:not([readonly])").length == 0) && tabindex != lastTabIndex ){
                tabindex++;
            }*/
            if(tabindex == lastTabIndex){ tabindex = 3 } 
            $("[TabIndex='"+tabindex+"']").focus();
          
        }
    });
   /* $(document).keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13') { 
          //=====================================================
		   
		var emp_id = document.getElementById('emp_id').value;
		if(emp_id==0 || emp_id=='')
		  {
		  	alert('Please Select Employee ID.');
			tabindex = 3;
			document.getElementById('emp_id').focus();
		  	return;
		  }
		  
		  
		  dataString = $("#add_production_log").serialize();
		  $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>index.php/emp_wise_entry_con/add_production_log",
				data: dataString,
				cache: false,
				success: function(data){
					alert('Process Log is added Successfully!');
					var index = $("select#emp_id").prop('selectedIndex');
					if($('#emp_id option:last').val() == $('#emp_id option:selected').val())
					{
						$("select#emp_id").prop('selectedIndex', 0);
						$('#grids').html('');
						$('.main_img').html('');
						return false;
					}
		$("select#emp_id").prop('selectedIndex', index+1);
		if($("#emp_id").val() == '')
		{
			alert('sdf');
			return false;
		}
		//GetImageOthers();
					
				}
				});
			return false;	
	
		  //========================================================
        }
    });*/

    $("input").click(function() {  
        var input = $(this);
        tabindex = input.attr("tabindex");
    });
});

function Getfloor(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
 	try{
   		// Opera 8.0+, Firefox, Safari
   		ajaxRequest = new XMLHttpRequest();
 	}catch (e){
   		// Internet Explorer Browsers
   	try{
    	ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
    		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         	// Something went wrong
         	alert("Your browser broke!");
         	return false;
      		}
   		}
 	}
	var s_id = 'section_id';
	var e_id = 'floor';	
	var section_id = document.getElementById(s_id).value;
  
 	if(section_id=='Select'){
		alert("Please select Section ");
	 	return;
	}
    //alert(i_group);
	var queryString=s_id+"="+section_id;
	hostname = window.location.hostname;
	var url = "<?php echo base_url(); ?>index.php/emp_wise_entry_con/Getfloor/s_id/"+s_id;
	
	ajaxRequest.open("POST", url, true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(queryString);
	 
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			process_name = resp.split("===");
			emp_position_id = process_name[0].split("***");
			emp_position_name = process_name[1].split("***");
			document.getElementById(e_id).options.length = 0;
			document.getElementById(e_id).options[0]=new Option("Select","", true, false);
			for (i=0; i<emp_position_id.length; i++){
				//document.getElementById(e_id).options[i+1]=new Option(emp_id[i], false);
				document.getElementById(e_id).options[i+1]=new Option(emp_position_name[i],emp_position_id[i], false, false);
			}
			
		}
	}
}
function Getblock(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
 	try{
   		// Opera 8.0+, Firefox, Safari
   		ajaxRequest = new XMLHttpRequest();
 	}catch (e){
   		// Internet Explorer Browsers
   	try{
    	ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
    		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         	// Something went wrong
         	alert("Your browser broke!");
         	return false;
      		}
   		}
 	}
	var s_id = 'section_id';
	var f_id = 'floor';
	var e_id = 'block';	
	var section_id = document.getElementById(s_id).value;
	var floor_id = document.getElementById(f_id).value;
  
 	if(section_id=='Select'){
		alert("Please select Section ");
	 	return;
	}
    //alert(i_group);
	var queryString=s_id+"="+section_id+"&"+f_id+"="+floor_id;
	hostname = window.location.hostname;
	var url = "<?php echo base_url(); ?>index.php/emp_wise_entry_con/Getblock/s_id/"+s_id+"/f_id/"+f_id;
	
	ajaxRequest.open("POST", url, true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(queryString);
	 
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			process_name = resp.split("===");
			emp_line_id = process_name[0].split("***");
			var emp_line_name = process_name[1].split("***");
			document.getElementById(e_id).options.length = 0;
			document.getElementById(e_id).options[0]=new Option("Select","", true, false);
			for (i=0; i<emp_line_id.length; i++){
				//document.getElementById(e_id).options[i+1]=new Option(emp_id[i], false);
				document.getElementById(e_id).options[i+1]=new Option(emp_line_name[i],emp_line_id[i], false, false);
			}
			
		}
	}
}
function GetProcessEmp(){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
 	try{
   		// Opera 8.0+, Firefox, Safari
   		ajaxRequest = new XMLHttpRequest();
 	}catch (e){
   		// Internet Explorer Browsers
   	try{
    	ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
    		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         	// Something went wrong
         	alert("Your browser broke!");
         	return false;
      		}
   		}
 	}
	var s_id = 'section_id';
	var f_id = 'floor';
	var b_id = 'block';	
	var e_id = 'emp_id';	
	var section_id = document.getElementById(s_id).value;
	var floor_id = document.getElementById(f_id).value;
	var block_id = document.getElementById(b_id).value;
  
 	if(section_id=='Select'){
		alert("Please select Section ");
	 	return;
	}
    //alert(i_group);
	var queryString=s_id+"="+section_id+"&"+f_id+"="+floor_id+"&"+b_id+"="+block_id;
	hostname = window.location.hostname;
	var url = "<?php echo base_url(); ?>index.php/emp_wise_entry_con/GetProcessEmp/s_id/"+s_id+"/f_id/"+f_id+"/b_id/"+b_id;
	
	ajaxRequest.open("POST", url, true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(queryString);
	 
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			process_name = resp.split("===");
			emp_id = process_name[0].split("***");
			
			document.getElementById(e_id).options.length = 0;
			document.getElementById(e_id).options[0]=new Option("Select","", true, false);
			for (i=0; i<emp_id.length; i++){
				//document.getElementById(e_id).options[i+1]=new Option(emp_id[i], false);
				document.getElementById(e_id).options[i+1]=new Option(emp_id[i],emp_id[i], false, false);
			}
			
		}
	}
}
var tabindex = 1; 


function GetImageOthers(emp_id){
	var ajaxRequest;  // The variable that makes Ajax possible!
	
 	try{
   		// Opera 8.0+, Firefox, Safari
   		ajaxRequest = new XMLHttpRequest();
 	}catch (e){
   		// Internet Explorer Browsers
   	try{
    	ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
    		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         	// Something went wrong
         	alert("Your browser broke!");
         	return false;
      		}
   		}
 	}
	var pd_log_date = document.getElementById('pd_log_date').value;
	if(pd_log_date == '')
	{
		alert("Select Date First!");
         	return false;
	}
	var em_id 		= 'emp_id';
	var desig_id 	= 'designation';
	var f_id 		= 'full_name';
	//var p_img_id	= 'preview_img';
	//var emp_id 	= document.getElementById(em_id).value;
  
 	if(emp_id=='Select'){
		alert("Please select Item ");
	 	return;
	}

	var queryString=em_id+"="+emp_id;
	hostname = window.location.hostname;
	var url = "<?php echo base_url(); ?>index.php/entry_con/GetImage/id/"+em_id;
	
	ajaxRequest.open("POST", url, true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(queryString);
	 
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp 			= ajaxRequest.responseText;
			full_name 			= resp.split("===");
			full_name1 			= full_name[0].split("***");
			image_name 			= full_name[1].split("***");
			designation_name 	= full_name[2].split("***");
			document.getElementById(f_id).value 		= full_name1;
			document.getElementById(desig_id).value 	= designation_name;
			
			hostname = window.location.hostname;
			var url = "<?php echo base_url(); ?>uploads/photo/"+image_name;
			$('.main_img').html('<img id="preview_img" class="preview" src="'+url+'"/>');
			GridGen();
		}
	}
}
function GridGen()
{
	var ajaxRequest;  // The variable that makes Ajax possible!
	
 	try{
   		// Opera 8.0+, Firefox, Safari
   		ajaxRequest = new XMLHttpRequest();
 	}catch (e){
   		// Internet Explorer Browsers
   	try{
    	ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
    		ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
         	// Something went wrong
         	alert("Your browser broke!");
         	return false;
      		}
   		}
 	}
	var s_id = 'section_id';
		//s_id += id;
	var article_id = 'article_id';
		//p_id += id;
	var process_id = 'process_id';
	var process_names = 'process_name';
		//e_id += id;
	var f_id = 'floor';	
	var b_id = 'block';	
	var section_id = document.getElementById(s_id).value;
	var floor_id = document.getElementById(f_id).value;
	var block_id = document.getElementById(b_id).value;
	var pd_log_date = document.getElementById('pd_log_date').value;
	var emp_id = document.getElementById('emp_id').value;
  
 	if(section_id=='Select'){
		alert("Please select Section ");
	 	return;
	}
    //alert(i_group);
	var queryString=s_id+"="+section_id;
	hostname = window.location.hostname;
	var url = "<?php echo base_url(); ?>index.php/emp_wise_entry_con/GridGen/id/"+s_id;
	
	ajaxRequest.open("POST", url, true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(queryString);
	 
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var resp = ajaxRequest.responseText;
			process_name 	= resp.split("===");
			article_id 		= process_name[0].split("***");
			process_id 		= process_name[1].split("***");
			process_names 	= process_name[2].split("***");
			color_id 		= process_name[3].split("***");
			color_name 		= process_name[4].split("***");
			
			size_id 		= process_name[5].split("***");
			size_name 		= process_name[6].split("***");
			article_id_pk 	= process_name[7].split("***");
			$('#grids').html('');
			var i = 0;
			var j = 6;
			var s = 0;
			tabindex = 3;
			while(i<article_id.length && process_id[i] != '')
			{
				
				j=20;
				j=i+j;
				//alert(process_id[i]);
			if(s%2 ==0)
			{
$('<div class="div_row" style="height:24px; background:white"><dt class="div_row_normal">'+article_id[i]+'</dt><dt class="div_row_normal_for_size">'+size_name[i]+'</dt><dt class="div_row_normal">'+process_names[i]+'</dt><dt class="div_row_normal_for_qty"><input id="tabable'+i+'" type="text" name="quantity'+i+'" style="width:170px; background-color:transparent;  border:1px #330000 thin; border-style:groove;" tabindex="'+j+'"><input type="hidden" name="marge'+i+'" value="'+pd_log_date+','+section_id+','+emp_id+','+article_id[i]+','+process_id[i]+','+color_id[i]+','+size_id[i]+','+article_id_pk[i]+','+floor_id+','+block_id+'"></dt></div><div style="clear:both;"></div>').fadeIn('slow').appendTo('#grids');
document.getElementById('count').value = i;
			}
			else
			{
			$('<div class="div_row" style="height:24px; background: #9BCDFF"><dt class="div_row_normal">'+article_id[i]+'</dt><dt class="div_row_normal_for_size">'+size_name[i]+'</dt><dt class="div_row_normal">'+process_names[i]+'</dt><dt class="div_row_normal_for_qty"><input id="tabable'+i+'" type="text" name="quantity'+i+'" style="width:170px; background-color:transparent;  border:1px #330000 thin; border-style:groove;" tabindex="'+j+'"><input type="hidden" name="marge'+i+'" value="'+pd_log_date+','+section_id+','+emp_id+','+article_id[i]+','+process_id[i]+','+color_id[i]+','+size_id[i]+','+article_id_pk[i]+','+floor_id+','+block_id+'"></dt></div><div style="clear:both;"></div>').fadeIn('slow').appendTo('#grids');
document.getElementById('count').value = i;
			}
			i++;
			s++;
			}
			document.getElementById('tabable0').focus();
			document.getElementById('add_production_log_button').tabIndex = j+1;
			lastTabIndex = j+2; 
			tabindex++;
			
			document.getElementById("add_production_log_button").disabled = false;
			
		}
		document.getElementById('enter_key_flag').value = 1;
		//enter_flag = 1;
	}
}

var lastTabIndex = 4;
function OnFocusOut()
{
    var currentElement = $get(currentElementId); // ID set by OnFOcusIn
    var curIndex = currentElement.tabIndex; //get current elements tab index
    if(curIndex == lastTabIndex) { //if we are on the last tabindex, go back to the beginning
        curIndex = 0;
    }
    var tabbables = document.getElementsByName("tabable"); //get all tabable elements
    for(var i=0; i<tabbables.length; i++) { //loop through each element
        if(tabbables[i].tabIndex == (curIndex+1)) { //check the tabindex to see if it's the element we want
            tabbables[i].focus(); //if it's the one we want, focus it and exit the loop
            break;
        }
    }
}
// tab index setup
   
    
	

</script>