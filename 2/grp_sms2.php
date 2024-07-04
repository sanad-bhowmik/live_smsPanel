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
	 if($_REQUEST['send_group_sms_submit']){   
	 
	 	$sms_to_send=$_POST['sms'];     
			if(chk_sms_format($sms_to_send)==1){		
					for ($i=0; $i<count($_POST['grp_list_for_grp_sms']);$i++) {
					
						$grp_id=$_POST['grp_list_for_grp_sms'][$i];
						
						$mobile_num_frm_grp=show_grp_members($grp_id);
						
						while($mobile_num_frm_grp_result=mysql_fetch_array($mobile_num_frm_grp)){
							
								$mobile_numbers=$mobile_num_frm_grp_result['mob_num'];
								
								$to_sms_func=$mobile_numbers.' '.$sms_to_send.'<br/>';
								
								if(send_msg($mobile_numbers, $sms_to_send)){
									
									sms_log($mobile_numbers,$sms_to_send);
									user_credti_minus($user_name,1);
									
									}
								else { sms_log($mobile_numbers.'  Failed!!!!!',$sms_to_send);}
								
							
							}
                    }
			}
		else { $msg='SMS out of length';}	
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
    <form name="send_grp_sms" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    
                <table width="50%" border="0" cellspacing="0" cellpadding="5" align="center">
                  <tr>
                    <td>Select Group:</td>
                    <td>&nbsp;:</td>
                    <td valign="top">
                    <br/>
                    <div style=" width:50%; overflow:auto; height:300px; margin:auto; float:left; border:green 1px solid;" >
                       <center> <input type="button" name="CheckAll" value="Check All" onClick="checkAll(document.send_grp_sms.grp_list_for_grp_sms);">
                        <input type="button" name="UnCheckAll" value="Uncheck All" onClick="uncheckAll(document.send_grp_sms.grp_list_for_grp_sms);"></center>
                        <br/><br/>
                     <?php 
						 $grp_value_grp_sms=list_grp();
					 while($grp_value_grp_sms_result=mysql_fetch_array($grp_value_grp_sms)){
                           echo $grp_value_grp_sms['grp_id'];
						   
						   ?>
						   <input type="checkbox" name="grp_list_for_grp_sms[]" id="grp_list_for_grp_sms" value="<?php echo $grp_value_grp_sms_result['grp_id']; ?>"/> &nbsp;<?php echo $grp_value_grp_sms_result['grp_id']; ?><br/>
                           
                         <?php    } ?>        
                    </div>
                    <br />
                    </td>
                  </tr>
                  <tr>
                    <td valign="top">Write SMS:</td>
                    <td valign="top">&nbsp;:</td>
                    <td>&nbsp;<textarea cols="25" rows="7" name="sms" onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter')"></textarea>
                    
                    <br/>
                    You have <B><SPAN id=myCounter>156</SPAN></B> characters remaining...
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td> <br /><input type="submit" name="send_group_sms_submit" value="Send SMS"/></td>
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