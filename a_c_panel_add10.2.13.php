<?php
session_start();
include('function.php');
include('db.php');
//echo $user_name;
//die();

if (isset($_SESSION['_u_li_'])){
	$login_user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($login_user_name);
	$user_type_code_array = array('2','3');
			if($_REQUEST['create_user_submit']){
				
				$new_user_name=$_POST['add_user_name'];
				$user_pass=$_POST['add_user_pass'];
				$user_type=$_POST['user_type_select'];
				$user_allocated_credit=$_POST['add_user_credit'];
				$chk_crdt=chk_sms_credit($new_credit,$login_user_name);
					if(in_array($user_type_code,$user_type_code_array) && ($chk_crdt==1)){
						
								if(add_new_user($new_user_name,$user_pass,$user_type,$user_allocated_credit,$_SESSION['_u_li_'])==1){
							
									$msg='New User '.$new_user_name.' Added.' ;
									}
									else { $msg='User Name Already Exists!!<br/> Choose New User Name.';}
						
						}
					else if(in_array($user_type_code,$user_type_code_array) && ($chk_crdt==1)){
						
								if(add_new_user_for_admin($new_user_name,$user_pass,$user_type,$user_allocated_credit,$_SESSION['_u_li_'])==1){
							
									$msg='New User '.$new_user_name.' Added.' ;
									}
									else { $msg='User Name Already Exists!!<br/> Choose New User Name.';}
						
						}else { $msg_edit='Credit over!!'; }	
				
				}
				
			if($_REQUEST['send_user_login_name']){
				
				$user_info=get_user_info($_POST['edit_retrive_user_name']);
				
				}
				
			if($_REQUEST['edit_user_acc_submit_add']){
				$prev_user_name=$_POST['prev_user_name'];
				$new_name=$_POST['new_user_name'];
				$new_pass=$_POST['new_pass'];
				$new_credit=$_POST['new_credit'];
				$chk_crdt=chk_sms_credit($new_credit,$login_user_name);
					if(($user_type_code==3) && ($chk_crdt==1)){
						
						if(user_info_edit_add($prev_user_name,$new_name,$new_pass,$new_credit)==1){
						
						 $msg_edit='User Info. Updated Successfully.';
						
						}
						else { $msg_edit='Something wrong while updating!!';}
						
						
						}
						
						
					else if(($user_type_code==2) && ($chk_crdt==1)){
						
						if(user_info_edit_add_admin($prev_user_name,$new_name,$new_pass,$new_credit)==1){
						
						 $msg_edit='User Info. Updated Successfully.';
						
						}
						else { $msg_edit='Something wrong while updating!!';}
						
						}
						else { $msg_edit='Credit over!!'; }	
				
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
    
<?php include ('header.php'); ?>

			<div id="menus_wrapper">
				
				
				<?php include ('menu.php'); ?>
				
				
				
			</div>
			<!--[if !IE]>end menus_wrapper<![endif]-->
			
			
			
		</div>
		<!--[if !IE]>end head<![endif]-->
		
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			
			
			
			
			
			<!--[if !IE]>start page<![endif]-->
			<div id="page">

<div class="inner">
					
					
					
					<!--[if !IE]>start section<![endif]-->	
					<div class="section table_section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Add New User</h2>
							<span class="title_wrapper_left"></span>
							<span class="title_wrapper_right"></span>
						</div>
						<!--[if !IE]>end title wrapper<![endif]-->
						<!--[if !IE]>start section content<![endif]-->
						<div class="section_content">
							<!--[if !IE]>start section content top<![endif]-->
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
											<div class="sct_right">

												<!--[if !IE]>start table_wrapper<![endif]-->
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
                                                
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="add_user">

                            <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
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
<br />
<center><?php echo $msg; echo $msg_edit;?></center>                                                
                                             
</div>
										</div>
									</div>
								</div>
							</div>
							<!--[if !IE]>end section content top<![endif]-->
							<!--[if !IE]>start section content bottom<![endif]-->
							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							<!--[if !IE]>end section content bottom<![endif]-->
							
						</div>
						<!--[if !IE]>end section content<![endif]-->
					</div>
		 
             
  </div></div>



					<div class="section table_section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Edit User</h2>
							<span class="title_wrapper_left"></span>
							<span class="title_wrapper_right"></span>
						</div>
						<!--[if !IE]>end title wrapper<![endif]-->
						<!--[if !IE]>start section content<![endif]-->
						<div class="section_content">
							<!--[if !IE]>start section content top<![endif]-->
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
											<div class="sct_right">

												<!--[if !IE]>start table_wrapper<![endif]-->
												<div class="table_wrapper">
													<div class="table_wrapper_inner">

						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center">&nbsp; 
                            <form name="get_user_login_name" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                 <strong>Select User &nbsp;: &nbsp;</strong>
                                 <select name="edit_retrive_user_name" style="width:200px;">
                                	<option value="" selected="selected">Select From Below</option>
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
                                		<table width="100%" align="center" border="0" cellspacing="0" cellpadding="5">
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
                        
                              
                            </td>
                          </tr>
                        </table>												
           						  <br />
                                <center><?php echo $msg_edit; ?></center>
						
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--[if !IE]>end section content top<![endif]-->
							<!--[if !IE]>start section content bottom<![endif]-->
							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							<!--[if !IE]>end section content bottom<![endif]-->
							
						</div>
						<!--[if !IE]>end section content<![endif]-->
					</div>
		 
             
  </div></div></div>
             
			</div>
			<!--[if !IE]>end page<![endif]-->
			<!--[if !IE]>start sidebar<![endif]-->
<?php include ('side_footer.php'); ?>
	
	<?php
	}
	else { 
		
		$_SESSION['_log_in_error_']=1;
		header("Location: index.php");
	
	}

?>