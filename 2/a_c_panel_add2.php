<?php
session_start();
include('function.php');
include('db.php');
//echo $user_name;
//die();

if (isset($_SESSION['_u_li_'])){
	echo $user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($user_name);
	
			if($_REQUEST['create_user_submit']){
				
				$user_name=$_POST['add_user_name'];
				$user_pass=$_POST['add_user_pass'];
				$user_type=$_POST['user_type_select'];
				$user_allocated_credit=$_POST['add_user_credit'];
				
					if($user_type_code==3){
						
								if(add_new_user($user_name,$user_pass,$user_type,$user_allocated_credit,$_SESSION['_u_li_'])==1){
							
									$msg='New User '.$user_name.' Added.' ;
									}
									else { $msg='User Name Already Exists!!<br/> Choose New User Name.';}
						
						}
					else if($user_type_code==2){
						
								if(add_new_user_for_admin($user_name,$user_pass,$user_type,$user_allocated_credit,$_SESSION['_u_li_'])==1){
							
									$msg='New User '.$user_name.' Added.' ;
									}
									else { $msg='User Name Already Exists!!<br/> Choose New User Name.';}
						
						}
				
				}
				
			if($_REQUEST['send_user_login_name']){
				
				$user_info=get_user_info($_POST['edit_retrive_user_name']);
				
				}
				
			if($_REQUEST['edit_user_acc_submit_add']){
				$prev_user_name=$_POST['prev_user_name'];
				$new_name=$_POST['new_user_name'];
				$new_pass=$_POST['new_pass'];
				$new_credit=$_POST['new_credit'];
					
					if($user_type_code==3){
						
						if(user_info_edit_add($prev_user_name,$new_name,$new_pass,$new_credit)==1){
						
						 $msg_edit='User Info. Updated Successfully.';
						
						}
						else { $msg_edit='Something wrong while updating!!';}
						
						
						}
						
					else if($user_type_code==2){
						
						if(user_info_edit_add_admin($prev_user_name,$new_name,$new_pass,$new_credit)==1){
						
						 $msg_edit='User Info. Updated Successfully.';
						
						}
						else { $msg_edit='Something wrong while updating!!';}
						
						}	
				
				}
				
			if($_REQUEST['edit_user_acc_submit_minus']){
				$prev_user_name=$_POST['prev_user_name'];
				$new_name=$_POST['new_user_name'];
				$new_pass=$_POST['new_pass'];
				$new_credit=$_POST['new_credit'];
					
					if($user_type_code==3){
						
						if(user_info_edit_minus($prev_user_name,$new_name,$new_pass,$new_credit)==1){
						
						 $msg_edit='User Info. Updated Successfully.';
						
						}
						else { $msg_edit='Something wrong while updating!!';}
						
						
						}
						
					else if($user_type_code==2){
						
						if(user_info_edit_minus_admin($prev_user_name,$new_name,$new_pass,$new_credit)==1){
						
						 $msg_edit='User Info. Updated Successfully.';
						
						}
						else { $msg_edit='Something wrong while updating!!';}
						
						}	
				
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
            <table width="100%" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" valign="top">
                <center><b>ADD NEW USER</b></center><br />
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="add_user">
                            <table width="90%" border="1" cellspacing="0" cellpadding="5" align="center">
                              <tr>
                                <td>User Name &nbsp;:</td>
                                <td>&nbsp; <input type="text" name="add_user_name"/><br /></td>
                              </tr>
                              <tr>
                                <td>User Password &nbsp;:</td>
                                <td>&nbsp; <input type="text" name="add_user_pass"/><br /></td>
                              </tr>
                              <tr>
                                <td>User Type &nbsp;:</td>
                                <td>&nbsp; <?php if($user_type_code==3 ){ echo '<input type="checkbox" name="user_type_select" value="2"/> &nbsp;ADMIN USER&nbsp;';} ?>
									<input type="checkbox" name="user_type_select" value="1"/> &nbsp;GENERAL USER&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Allocate Credit &nbsp;:</td>
                                <td>&nbsp;  <input type="text" name="add_user_credit"/><br /></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td><input type="submit" name="create_user_submit" value="CREATE USER" /><br /></td>
                              </tr>
                            </table>
            
                        </form>
                </td>
                <td valign="top">
                <center><b>EDIT USER</b></center><br />
                        <table width="100%" border="1" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center">&nbsp; 
                            <form name="get_user_login_name" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                 Select User &nbsp;: &nbsp;<select name="edit_retrive_user_name">
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
                                                &nbsp;<input type="submit" name="send_user_login_name" value="GET USERS" />
                		</form>
                
                			</td>
                          </tr>
                          <tr>
                            <td>
                            <br/>
                            	<form name="edit_user_acc" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                	<input type="hidden" name="prev_user_name" value="<?php echo $user_info['user_login_name'];?>"/>
                                		<table width="60%" align="center" border="1" cellspacing="0" cellpadding="5">
                                                  <tr>
                                                    <td width="37%"> Name &nbsp;  :</td>
                                                    <td width="63%">&nbsp;<input type="text" name="new_user_name" value="<?php echo $user_info['user_login_name'];?>"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td>Password &nbsp;:</td>
                                                    <td>&nbsp;<input type="text" name="new_pass" value="<?php echo $user_info['user_login_pass'];?>"/></td>
                                                  </tr>
                          
                                                  <tr>
                                                    <td>Allocate Credit&nbsp;:</td>
                                                    <td>&nbsp;<input type="text" name="new_credit" value="<?php echo $user_info['user_allocated_sms_credit'];?>"/></td>
                                                  </tr>
                                                  <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input type="submit" name="edit_user_acc_submit_add" value="ADD CREDIT" />&nbsp;<input type="submit" name="edit_user_acc_submit_minus" value="MINUS CREDIT" /></td>
                                                  </tr>
                                        </table>

                                </form>
                                <br />
                                <center><?php echo $msg_edit; ?></center>
                            <br/>
                            </td>
                          </tr>
                        </table>

                </td>
              </tr>
            </table>

    <br />
    </td>
  </tr>
  <tr>
    <td> <center><?php echo $msg;?></center></td>
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
 



                       