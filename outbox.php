<?php
session_start();
include('function.php');
include('db.php');
//echo $user_name;
//die();

if (isset($_SESSION['_u_li_'])){
	$login_user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($con,$login_user_name);
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
							<h2> OUTBOX </h2>
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
                                                
												<div style="margin: 2% auto; width:60%; border:0px solid red;">
                                                <form name="outbound_sms_report_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
                                                	<table width="100%" border="0" cellspacing="0" cellpadding="2">
          
													<?php
													if($login_user_name=='superAdmin')
													{
													?>
                                                          <tr>
                                                            <td>User Name&nbsp;</td>
                                                            <td>:</td>
                                                            <td>&nbsp;
													
                                                            
                                                            	<select name="outbound_sms_grp" style="width:180px; outline:none;">

                                                                     <option value="" selected="selected">..::Select User::..</option>
                                                    
                                                                    <?php	
                                                    
                                                                                            
                                                    
                                                                    $retrive_data=list_grp($login_user_name);
                                                    
                                                                    while($retrive_result=mysql_fetch_array($retrive_data)){ ?>
                                                    
                                                                    <option value="<?php echo $retrive_result['user_login_name']; ?>"><?php $grp_id_temp=$retrive_result['user_login_name']; echo $grp_id_temp; ?></option>
                                                    
                                                                    <?php    } ?>
                                                    
                                                               </select>
                                                            
                                                            </td>
                                                          </tr>
														
													<?php
													} 
													?>
														<tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                          <tr>
                                                            <td>From&nbsp;</td>
                                                            <td>:</td>
                                                            <td>&nbsp;
                                                            <select name="outbound_from_year">
                                                            	<option value="" selected="selected">Year</option>
                                                                <?php
																	for($i=2019; $i<2025; $i++){
																		?>
																	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																<?php
																
																		}
																
																?>
                                                            </select>
                                                            -
                                                             <select name="outbound_from_month">
                                                            	<option value="" selected="selected">Month</option>
                                                                <?php
																	for($i=1; $i<13; $i++){
																		?>
																	<option value="<?php printf("%02d", $i); ?>"><?php printf("%02d", $i); ?></option>
																<?php
																
																		}
																
																?>
																
																
                                                            </select>
                                                            -
                                                            <select name="outbound_from_date">
                                                            	<option value="" selected="selected">Date</option>
                                                                <?php
																	for($i=01; $i<32; $i++){
																		?>
																	<option value="<?php printf("%02d", $i); ?>"><?php printf("%02d", $i); ?></option>
																<?php
																
																		}
																
																?>
                                                            </select>
                                                           
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td>To&nbsp;</td>
                                                            <td>:</td>
                                                            <td>&nbsp;
                                                            <select name="outbound_to_year">
                                                            	<option value="" selected="selected">Year</option>
                                                                <?php
																	for($i=2019; $i<2025; $i++){
																		?>
																	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																<?php
																
																		}
																
																?>
                                                            </select>
                                                            -
                                                             <select name="outbound_to_month">
                                                            	<option value="" selected="selected">Month</option>
                                                                <?php
																	for($i=1; $i<13; $i++){
																		?>
																	<option value="<?php printf("%02d", $i); ?>"><?php printf("%02d", $i); ?></option>
																<?php
																
																		}
																
																?>
																
																
                                                            </select>
                                                            -
                                                            <select name="outbound_to_date">
                                                            	<option value="" selected="selected">Date</option>
                                                                <?php
																	for($i=01; $i<32; $i++){
																		?>
																	<option value="<?php printf("%02d", $i); ?>"><?php printf("%02d", $i); ?></option>
																<?php
																
																		}
																
																?>
                                                            </select>
                                                            
                                                                                                       
                                                            
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                            <td><input type="submit" name="search_mt" value="Get report" /></td>
                                                          </tr>
                                                   </table>
                                                   </form>
                                                
                                                </div>
                                                <br/><br/>
                                                <center><span style="font-size:24px; font-weight:bold; color:#000;">REPORT</span></center>
                                                <div style="margin: 2% auto; width:70%; border:0px solid red;">
                                                	<?php
                                                		
														if(isset($_REQUEST['search_mt'])){
															$condition="";
															$outbox_grp="";
																if(isset($_POST['outbound_sms_grp']))
																{
																$outbox_grp = $_POST['outbound_sms_grp'];
																}
																
																$outbox_from_year = $_POST['outbound_from_year'];
																$outbox_from_month = $_POST['outbound_from_month'];
																$outbox_from_date = $_POST['outbound_from_date'];
													
																
	$outbox_date_time_from = $outbox_from_year."-".$outbox_from_month."-".$outbox_from_date;
																
																$outbox_to_year = $_POST['outbound_to_year'];
																$outbox_to_month = $_POST['outbound_to_month'];
																$outbox_to_date = $_POST['outbound_to_date'];
																
																
	$outbox_date_time_to = $outbox_to_year."-".$outbox_to_month."-".$outbox_to_date;
	
			
							
								
							if($outbox_grp != NULL)
								{
								
								if($condition != NULL){								
									$condition = $condition." and sender='$outbox_grp'";
									}
									else {
										
										$condition = "sender='$outbox_grp'";
										
										}
								}
								
								
							if($outbox_from_year != NULL){
								
								if($condition != NULL){								
									$condition = $condition." and date(date_time)>='$outbox_date_time_from'";
									}
									else {
										
										$condition = "date(date_time)>='$outbox_date_time_from'";
										
										}
								}
								else {
									
								if($condition != NULL){		
									$date_today = date("Y-m-d");						
									$condition = $condition." and date(date_time)>='$date_today'";
									}
									else {
										
										$date_today = date("Y-m-d");
										$condition = "date(date_time)>='$date_today'";
										
										}
									}
									
							if($outbox_to_year != NULL){
								
								if($condition != NULL){								
									$condition = $condition." and date(date_time)<='$outbox_date_time_to'";
									}
									else {
										
										$condition = "date(date_time)<='$outbox_date_time_to'";
										
										}
								}
								else {
									
								if($condition != NULL){		
									$date_today = date("Y-m-d");						
									$condition = $condition." and date(date_time)<='$date_today'";
									}
									else {
										
										$date_today = date("Y-m-d");
										$condition = "date(date_time)<='$date_today'";
										
										}
										}
							
						
								
					if($condition==NULL){
						$condition='1';
						}
						
						//echo $condition;		
						if($login_user_name=='superAdmin')
						$sql_mt = "select * from mt_log where ".$condition;
						else
						$sql_mt = "select * from mt_log where ".$condition." AND sender='$login_user_name'";
						$sql_mt_data = mysql_query($sql_mt);
						$num_val = mysql_num_rows($sql_mt_data);
						echo "<h3 style='color:green;'>Total Sent: ". $num_val . "</h3>";
						if(mysql_num_rows($sql_mt_data)!= NULL){ ?>
                        
                        <table width="98%" border="1" cellspacing="0" cellpadding="0">
								  <tr>
									<th width="15%" scope="col">User Name</th>
									<th width="19%" scope="col">Mobile Number</th>
									
									<th width="48%" scope="col">SMS</th>
									<th width="18%" scope="col">Date Time</th>
								  </tr>
                         </table>
                         <div style="width:100%; min-height:200px; max-height:400px; overflow:auto; border:0px green solid;">         
                        <table width="98%" border="1" cellspacing="0" cellpadding="0">
                        <?php
						
							while($sql_mt_result = mysql_fetch_array($sql_mt_data)){ ?>
							
								
								  <tr align="center">
									<td width="15%">&nbsp;<?php echo $sql_mt_result['sender']; ?></td>
									<td width="19%">&nbsp;<?php echo $sql_mt_result['Mob_To']; ?></td>
									
									<td width="48%">&nbsp;<?php echo $sql_mt_result['sms']; ?></td>
									<td width="18%">&nbsp;<?php echo $sql_mt_result['date_time']; ?></td>
								  </tr>
								

							
							
					<?php		} ?>
							
                            </table>
					</div>
					
					<?php
						}
						else {
							
							echo "<h2 style='text-align:center;color:red;'>No result</h2>";
							
							}
										
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