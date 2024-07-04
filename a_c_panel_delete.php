<?php
session_start();
include('function.php');
include('db.php');
//echo $user_name;
//die();
$msg_delete="";
if (isset($_SESSION['_u_li_'])){
	$login_user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($login_user_name);
	
		if(isset($_POST['delete_user_submit'])){
			
			if(delete_user($_POST['delete_retrive_user_name'])==1){
				
				$msg_delete='User Deleted Successfully!!!';
				
				}	
				else {$msg_delete='ERROR:User Deletion unsuccessfull!! ';}	
				
			
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
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Delete User</h2>
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
												<!--[if !IE]>start dashboard menu<![endif]-->
												<div class="dashboard_menu_wrapper">

<form name="delete_user" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <br /><br />
                <div style="float:left; width:200px;">
                <label><strong> Select User : </strong></label>               
                <select name="delete_retrive_user_name" style="width:180px;">
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
                </div>
               
                            
               <ul class="dashboard_menu">
  	  	       <li style="list-style:none;"><input class="dash_bt" style="background:url(images/delete_user.png) no-repeat center; height:102px;" type="submit" name="delete_user_submit" value=" " /></li>               </ul>
               
               </form>                                                


                   
<center><?php echo $msg_delete; ?></center>
										
                                                
                                                
												</div>
												<!--[if !IE]>end dashboard menu<![endif]-->
												
												
												
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