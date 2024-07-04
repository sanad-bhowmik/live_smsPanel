<?php
session_start();
include('function.php');
include('db.php');
//echo $user_name;
//die();

if (isset($_SESSION['_u_li_'])){
	$login_user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($login_user_name);
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
                        	<?php if($user_type_code==3){?>
							<h2>ASSIGN TOTAL CREDIT</h2>
                            <?php }?>
                            
                            <?php if($user_type_code==2){?>
                            <h2>TOTAL CREDIT INFORMATION</h2>
                            <?php }?>
                            
                            <?php if($user_type_code==1){?>
                            <h2>TOTAL CREDIT INFORMATION</h2>
                            <?php }?>
                            
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
                                                


                     <?php
							if((isset($_REQUEST['add_credit_submit']))&&(isset($_POST['new_total_credit']))){
								$new_credit_num=$_POST['new_total_credit'];
								if(add_new_credit($new_credit_num,$login_user_name)){
									
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
                     
                     <p><h2>Your Available Credit : &nbsp;<?php echo $total." &nbsp;";?></h2></p>

                    <?php if($user_type_code==3){?>

                    <p><h2 style="color:#F00;">ADD TOTAL CREDIT</h2></p><br />

                <form name="add_total_credit" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="search_form general_form">
                <fieldset>

                <div class="row">
					<label>Number Of Credit &nbsp;</label>
					<div class="inputs">
					<span class="input_wrapper"><input class="text" type="text" name="new_total_credit" /></span>
					</div>
					</div>
                    
                    <div class="row">
					<div class="buttons" style="margin-left:48px;">
					<ul style="list-style:none;">
					<li><span class="button orange_btn"><span><span>ADD CREDIT</span></span><input name="add_credit_submit" type="submit" /></span></li>
					</ul>
					</div>
					</div>

              	  </fieldset>
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
					<!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start section<![endif]-->	
					
					<!--[if !IE]>end section<![endif]-->
					
					
					
					<!--[if !IE]>start section<![endif]-->	
					
					<!--[if !IE]>end section<![endif]-->
					
					
					
					
					<!--[if !IE]>start section<![endif]-->	
					
					<!--[if !IE]>end section<![endif]-->
					
					
					
					
						
				</div>


			 
             
             
             
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