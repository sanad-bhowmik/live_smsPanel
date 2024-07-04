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
    
 <table width="60%" align="center" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <?php if($user_type_code==3){?>
    		<center><b>ASSIGN TOTAL CREDIT</b></center><br />
            
            <?php }?>
                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top" height="100" align="center">
                    <center><b><u>TOTAL CREDIT INFO.</u></b></center><br />
                     <?php
							if(($_REQUEST['add_credit_submit'])&&(isset($_POST['new_total_credit']))){
								$new_credit_num=$_POST['new_total_credit'];
								if(add_new_credit($new_credit_num)){
									
									$msg=$new_credit_num.' Credits Added Successfully';
								
								}
								}
							?>
                    <?php 
					if($user_type_code==3){
					 $info_credit=total_credit_info();
					 $total=$info_credit['t_crdt'];
					}
					else if($user_type_code==2){
						$info_credit=admin_credit_info($_SESSION['_u_li_']);
						$total=$info_credit['user_allocated_sms_credit'];
						
						}
					 ?>
                     Total Credit : &nbsp;<?php echo $total." &nbsp;";?><br />
                   
                     
						

					</td>
                    <?php if($user_type_code==3){?>
                    <td  valign="top">
                    <center><b><u>ADD TOTAL CREDIT</u></b></center><br />
                    		
                            <form name="add_total_credit" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <center>Number Of Credit &nbsp;: &nbsp;<input type="text" name="new_total_credit" /></center><br/>
                            <center><input type="submit" name="add_credit_submit" value="ADD CREDIT"/></center><br/>
                            
                            </form>   
                            
                           <?php 
						   
						   echo $msg;
						   
						   ?>
                            
                    </td>
                    <?php
					}
					?>
                  </tr>
                </table>

    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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
 



                       