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
							<h2>VIEW USER INFO.</h2>
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
                                                
													<div style="margin:5px auto; width:50%; height:400px; overflow:auto;">
                                                    <?php
														if($user_type_code==3){
															
															$sql_user_info="select * from user_info_cat where 1";
														}
														else {
															
															$sql_user_info="select * from user_info_cat where creator_info='".$login_user_name."'";
															
															}
														$sql_user_info_data=mysql_query($sql_user_info);
														if(mysql_num_rows($sql_user_info_data)!=0){
															
													
													?>
                                                    
                                                            <table align="left" width="96%" border="0" cellspacing="0" cellpadding="5">
                                                              <tr style=" background:#CCC; font-size:14px;">
                                                              	<th width="13%">&nbsp;SL No</th>
                                                                <th width="45%">&nbsp;User Name</th>
                                                                <th width="42%">&nbsp;Remaining SMS Credit</th>
																
															  </tr>
                                                         <?php
														 	$i=1;
														 	while($sql_user_info_result=mysql_fetch_array($sql_user_info_data)){
														 
														 ?>
                                                              <tr align="center">
                                                              	<td>&nbsp;<?php echo $i; ?></td>
                                                                <td>&nbsp;<?php echo $sql_user_info_result['user_login_name']; ?></td>
                                                                <td>&nbsp;<?php echo $sql_user_info_result['user_allocated_sms_credit']; ?></td>
																
															  </tr>
                                                            
													<?php		
																$i++;
																
																}?>
                                                                
                                                                </table>
                                                        <?php        
                                                                
															}
															else{
																
																echo "<center>No user is created till now.</center>";
																
																}
													?>	
                                                    
                                                    </div>                                             
                                                
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