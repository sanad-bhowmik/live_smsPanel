<?php
session_start();
include('function.php');
include('db.php');
//echo $user_name;
//die();

if (isset($_SESSION['_u_li_'])){
	$user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($user_name);
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mkt sms panel</title>

<script language = "Javascript">
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
</script>

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
    <form name="send_single_sms" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    
                <table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td>Enter Mobile Number:</td>
                    <td>&nbsp;:</td>
                    <td>+88&nbsp;
                      <input type="text" name="to_mob_num" maxlength="15" /><br /></td>
                  </tr>
                  <tr>
                    <td>Write SMS:</td>
                    <td>&nbsp;:</td>
                    <td>&nbsp;<textarea cols="25" rows="7" name="sms" onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter')"></textarea><br/>
                    You have <B><SPAN id=myCounter>156</SPAN></B> characters remaining...</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td> <br /><input type="submit" name="send_single_sms_submit" value="Send SMS"/></td>
                  </tr>
                </table>
	</form>
    <?php
	
	

	if($_REQUEST['send_single_sms_submit']){
		
		$to_num='88'.$_POST['to_mob_num'];
		$sms=$_POST['sms'];
		
				if((chk_mobile_num($to_num)==1) && (chk_sms_format($sms)==1)){
					
					if(send_msg($to_num, $sms)){
				
						sms_log($to_num,$sms);
						user_credti_minus($user_name,1);
						}
					else {
						
						sms_log($to_num.'  Failed!!!!!',$sms);
						
						}
					
					
					}
					
					
		
		}
	

	echo $sms;
	
	?>
    <br />
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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