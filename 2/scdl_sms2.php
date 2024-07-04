<?php
session_start();
include('function.php');
include('db.php');
//echo $user_name;
//die();

if (isset($_SESSION['_u_li_'])){
	$user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($user_name);
	

	//sms send
	if($_REQUEST['send_scdl_sms_submit_grp']){
		
			$sms=$_POST['sms'];
			$grp_id_list=$_POST['grp_list_for_scdl_sms'];
			$send_scdl_sms_time_year=$_POST['send_scdl_sms_time_year'];
			$send_scdl_sms_time_month=$_POST['send_scdl_sms_time_month'];
			$send_scdl_sms_time_day=$_POST['send_scdl_sms_time_day'];
			$send_scdl_sms_time_hour=$_POST['send_scdl_sms_time_hour'];
			$send_scdl_sms_time_min=$_POST['send_scdl_sms_time_min'];
			$send_time=$send_scdl_sms_time_year.'-'.$send_scdl_sms_time_month.'-'.$send_scdl_sms_time_day.' '.$send_scdl_sms_time_hour.':'.$send_scdl_sms_time_min;
			
			if(chk_sms_format($sms)==1){
				
				
				$grp_id_list_string=implode(",", $grp_id_list);
					
					if(scdl_sms_to_db($send_time,$grp_id_list_string,$sms)){
						
						$msg="SMS Stored for sending";
						echo $send_time;
						
						}
				
				}
				else { $msg='SMS out of length';}
		
		}

			
		if($_REQUEST['send_scdl_sms_submit_sin_num']){
			
			$sms=$_POST['sms'];
			echo $mob_num='88'.$_POST['mob_num_scdl_sms'];
		
			if((chk_sms_format($sms)==1) && (chk_mobile_num($mob_num)==1)){
				
				
				if(scdl_sms_to_db($send_time,$mob_num,$sms)){
						
						$msg="SMS Stored for sending";
						
						
						}
				
				}
				else { echo $msg='SMS out of length';}
		
		}

			
	//sms send end
	
	?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mkt sms panel</title>
<SCRIPT LANGUAGE="JavaScript">

function checkAll(field)
{
	
	//alert('yes:line12');
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}
//sms count
maxL=156;
var bName = navigator.appName;
function taLimit(taObj) {
	if (taObj.value.length==maxL) return false;
	return true;
}

function taCount(taObj,Cnt) { 
	objCnt=createObject(Cnt);
	objVal=taObj.value;
	if (objVal.length>maxL) objVal=objVal.substring(0,maxL);
	if (objCnt) {
		if(bName == "Netscape"){	
			objCnt.textContent=maxL-objVal.length;}
		else{objCnt.innerText=maxL-objVal.length;}
	}
	return true;
}
function createObject(objId) {
	if (document.getElementById) return document.getElementById(objId);
	else if (document.layers) return eval("document." + objId);
	else if (document.all) return eval("document.all." + objId);
	else return eval("document." + objId);
}
</SCRIPT>

<body>

<table width="80%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="100">
     <?php
    

	
	switch ($user_type_code) {
    case 1:
	
        echo '<a href="send_single_sms.php" style="color:black;">SEND SINGLE SMS</a>&nbsp;&nbsp;';
		echo '<a href="grp_sms.php" style="color:black;">SEND GROUP SMS</a>&nbsp;&nbsp;';
		echo '<a href="scdl_sms.php" style="color:black;">SCHEDULING SMS</a>&nbsp;&nbsp;';
		echo '<a href="grp_management.php" style="color:black;">GROUP MANAGEMENT</a>&nbsp;&nbsp;';   
        break;
    case 2:
	
        echo '<a href="send_single_sms.php" style="color:black;">SEND SINGLE SMS</a>&nbsp;&nbsp;';
		echo '<a href="grp_sms.php" style="color:black;">SEND GROUP SMS</a>&nbsp;&nbsp;';
		echo '<a href="scdl_sms.php" style="color:black;">SCHEDULING SMS</a>&nbsp;&nbsp;';
		echo '<a href="grp_management.php" style="color:black;">GROUP MANAGEMENT</a>&nbsp;&nbsp;';
		echo '<a href="a_c_panel.php" style="color:black;">INSERT CREDIT</a>&nbsp;&nbsp;';
		echo '<a href="a_c_panel_add.php" style="color:black;">ADD/EDIT USER</a>&nbsp;&nbsp;';
		echo '<a href="a_c_panel_delete.php" style="color:black;">DELETE USER</a>&nbsp;&nbsp;'; 
        break;
    case 3:
	
 		echo '<a href="a_c_panel.php" style="color:black;">INSERT CREDIT</a>&nbsp;&nbsp;';
		echo '<a href="a_c_panel_add.php" style="color:black;">ADD/EDIT USER</a>&nbsp;&nbsp;';
		echo '<a href="a_c_panel_delete.php" style="color:black;">DELETE USER</a>&nbsp;&nbsp;'; 
        break;
	}
    ?>
    <span style="float:right; width:100px;"><a href="logout.php">Log Out</a></span>
    </td>
  </tr>
  <tr>
    <td>
    <br /><br />
    <form name="send_scdl_sms" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    
                <table width="60%" border="0" cellspacing="0" cellpadding="5" align="center">
                    <tr>
                    <td>Select Sending Time</td>
                    <td>&nbsp;:</td>
                    <td>
                    
                    year :<select name="send_scdl_sms_time_year">
  			<option selected="selected" value="">Select Year</option>
            <option value="2011">2011</option>
            <option value="2012">2012</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
        </select>
						
	&nbsp;month :	<select name="send_scdl_sms_time_month">
  			<option selected="selected" value="">Select Month</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>			
        
   &nbsp;day : <input type="text" name="send_scdl_sms_time_day"  maxlength="2" size="5" /><br/><br/>
   &nbsp;Hour : <input type="text" name="send_scdl_sms_time_hour" maxlength="2" size="5" />
   &nbsp;Min : <input type="text" name="send_scdl_sms_time_min" maxlength="2" size="5" />
                    
                    </td>
                    </tr>
                  <tr>
                    <td>Select Group:</td>
                    <td>&nbsp;:</td>
                    <td valign="top">
                    <br/>
                    <div style=" width:60%; overflow:auto; height:300px; margin:auto; float:left; border:green 1px solid;" >
                       <center> <input type="button" name="CheckAll" value="Check All" onClick="checkAll(document.send_scdl_sms.grp_list_for_scdl_sms);">
                        <input type="button" name="UnCheckAll" value="Uncheck All" onClick="uncheckAll(document.send_scdl_sms.grp_list_for_scdl_sms);"></center>
                        <br/><br/>
                     <?php 
						 $grp_value_grp_sms=list_grp();
					 while($grp_value_grp_sms_result=mysql_fetch_array($grp_value_grp_sms)){
                           echo $grp_value_grp_sms['grp_id'];
						   
						   ?>
						   <input type="checkbox" name="grp_list_for_scdl_sms[]" id="grp_list_for_scdl_sms" value="<?php echo $grp_value_grp_sms_result['grp_id']; ?>"/> &nbsp;<?php echo $grp_value_grp_sms_result['grp_id']; ?><br/>
                           
                         <?php    } ?>        
                    </div>
                    <br />
                    </td>
                  </tr>
                   <tr>
                    <td valign="top">OR Write Mobile Num :</td>
                    <td valign="top">&nbsp;:</td>
                    <td>+88&nbsp;<input type="text" name="mob_num_scdl_sms" /></td>
                  </tr>
                  <tr>
                    <td valign="top">Write SMS:</td>
                    <td valign="top">&nbsp;:</td>
                    <td valign="top">&nbsp;&nbsp;<textarea cols="25" rows="7" name="sms" onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter')"></textarea>
                    
                    <br/>
                    You have <B><SPAN id=myCounter>156</SPAN></B> characters remaining...
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td> <br /><input type="submit" name="send_scdl_sms_submit_grp" value="Send SMS to Group"/> &nbsp;<input type="submit" name="send_scdl_sms_submit_sin_num" value="Send SMS to MOBILE NUMBER"/></td>
                  </tr>
                </table>
	</form>

    <br />
    </td>
  </tr>
  <tr>
    <td>&nbsp;<?php echo $msg;?></td>
  </tr>
</table>
</body>
</html>

<?php
	}
	else { 
		
		$_SESSION['_log_in_error_']=1;
		header("Location: index.php");
	
	}

?>