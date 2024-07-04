<?php
session_start();
include('function.php');
include('db.php');
//echo $user_name;
//die();

if (isset($_SESSION['_u_li_'])){
	$user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($user_name);
	
		if($_POST['delete_user_submit']){
			
			if(delete_user($_POST['delete_retrive_user_name'])==1){
				
				$msg_delete='User Deleted Successfully!!!';
				
				}	
				else {$msg_delete='ERROR:User Deletion unsuccessfull!! ';}	
				
			
			}
	?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>home</title>
	</head>

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
    				<center><b>DELETE USER</b></center><br />
                 <table width="30%" border="1" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td>
                    <form name="delete_user" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                 Select User &nbsp;: &nbsp;<select name="delete_retrive_user_name">
                                <?php
                                $sql_user_get="select user_login_name from user_info_cat where creator_info='".$_SESSION['_u_li_']."'";
                                $sql_user_get_data=mysql_query($sql_user_get);
                                while($sql_user_get_result=mysql_fetch_array($sql_user_get_data)){
                                ?>
                               
                                                    
                                                     <option value="<?php echo $sql_user_get_result['user_login_name'];?>"><?php echo $sql_user_get_result['user_login_name'];?></option>
                                                    
                                                    
                                    
                                <?php
                                        }
                                ?>
                                                
                                                
                                                
                                                </select>
                                                <br/><br/>
                                             <center>   &nbsp;<input type="submit" name="delete_user_submit" value="DELETE THIS USER" /></center>
                		</form>
                    
                    </td>
                  </tr>
                  <tr>
                    <td>
                    
                    <center><?php echo $msg_delete; ?></center>
                    </td>
                  </tr>
                </table>

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
 



                       