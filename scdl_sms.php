<?php
session_start();
include('function.php');
include('db.php');
//echo $user_name;
//die();

if (isset($_SESSION['_u_li_'])){
	$login_user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($login_user_name);
	

	//sms send
	if($_REQUEST['send_scdl_sms_submit_grp']){
		
			$sms=$_POST['sms'];
			$grp_id_list=$_POST['grp_list_for_scdl_sms'];
			$send_scdl_sms_time_year=$_POST['send_scdl_sms_time_year'];
			$send_scdl_sms_time_month=$_POST['send_scdl_sms_time_month'];
			$send_scdl_sms_time_day=$_POST['send_scdl_sms_time_day'];
			$send_scdl_sms_time_hour=$_POST['send_scdl_sms_time_hour'];
			$send_scdl_sms_time_min=$_POST['send_scdl_sms_time_min'];
			$send_time=$send_scdl_sms_time_year.'-'.$send_scdl_sms_time_month.'-'.$send_scdl_sms_time_day.' '.$send_scdl_sms_time_hour.':'.$send_scdl_sms_time_min;
			
			if(chk_sms_format($sms)==1){
				
				
				$grp_id_list_string=implode(",", $grp_id_list);
					
				$num_of_sending_sms=selected_grp_member_num($grp_id_list);
				
									
				if(chk_sms_credit($num_of_sending_sms,$login_user_name)==1){	
					if(scdl_sms_to_db($send_time,$grp_id_list_string,$sms,$login_user_name)){
						
						$msg="SMS Stored for sending";
						
						
						}
					}
				else { $msg='SMS CREDIT OVERFLOW.CHECK YOUR REMAINING CREDIT.';}
				
				}
				else { $msg='SMS out of length';}
		
		}

			
		if($_REQUEST['send_scdl_sms_submit_sin_num']){
			
			$sms=$_POST['sms'];
			$mob_num='88'.$_POST['mob_num_scdl_sms'];
			$send_scdl_sms_time_year=$_POST['send_scdl_sms_time_year'];
			$send_scdl_sms_time_month=$_POST['send_scdl_sms_time_month'];
			$send_scdl_sms_time_day=$_POST['send_scdl_sms_time_day'];
			$send_scdl_sms_time_hour=$_POST['send_scdl_sms_time_hour'];
			$send_scdl_sms_time_min=$_POST['send_scdl_sms_time_min'];
			$send_time=$send_scdl_sms_time_year.'-'.$send_scdl_sms_time_month.'-'.$send_scdl_sms_time_day.' '.$send_scdl_sms_time_hour.':'.$send_scdl_sms_time_min.':00';
			$num_of_sending_sms=1;
			if(chk_sms_credit($num_of_sending_sms,$_SESSION['_u_li_'])==1){	
					
				if((chk_mobile_num($mob_num)==1) && (chk_sms_format($sms)==1)){
					
					
					if(scdl_sms_to_db($send_time,$mob_num,$sms,$login_user_name)){
						
								$msg="SMS Stored for sending";
							}
					
					}
					else {  $msg='SMS out of length';}
					
		
		}
		else { $msg='SMS CREDIT OVERFLOW.CHECK YOUR REMAINING CREDIT.';}
		
		}

			
	//sms send end
	
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
							<h2>Schedule SMS</h2>
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
                                                <br />
                                                
                        <form name="send_scdl_sms" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="search_form general_form">
                        <fieldset>
                        
                        
                        <div class="row">
						<p><strong>Select Sending Time</strong></p>
                        Year :<select name="send_scdl_sms_time_year">
                        <option selected="selected" value="">Select Year</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        </select>
                                    
                        &nbsp;Month :	<select name="send_scdl_sms_time_month">
                        <option selected="selected" value="">Select Month</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                        </select>			
        				
                       &nbsp;Day : <input type="text" name="send_scdl_sms_time_day"  maxlength="2" size="5" />
                  
                       &nbsp;Hour : <input type="text" name="send_scdl_sms_time_hour" maxlength="2" size="5" />
                       &nbsp;Min : <input type="text" name="send_scdl_sms_time_min" maxlength="2" size="5" />
                       
                        
                        </div>
                        
                        
                        <div style="margin-left:-100px;">
                        <div class="row">
						<div class="buttons">
						<ul style="list-style:none;">
                        
						<li><span class="button send_form_btn"><span><span>Check All</span></span><input name="CheckAll" onClick="checkAll(document.send_scdl_sms.grp_list_for_scdl_sms);"/></span></li>
						<li><span class="button cancel_btn"><span><span>Uncheck All</span></span><input name="UnCheckAll" onClick="uncheckAll(document.send_scdl_sms.grp_list_for_scdl_sms);"/></span></li>
                        
						</ul>
                        </div></div></div>
                        
                         
						<div style=" width:200px; height:350px; overflow:auto; float:left;">
                        
                
					 	<?php 
						 $grp_value_grp_sms=list_grp($login_user_name);
					 while($grp_value_grp_sms_result=mysql_fetch_array($grp_value_grp_sms)){
                           echo $grp_value_grp_sms['grp_id'];
						   
						   ?>
						   <input type="checkbox" name="grp_list_for_scdl_sms[]" id="grp_list_for_scdl_sms" value="<?php echo $grp_value_grp_sms_result['grp_id']; ?>"/> &nbsp;<?php $grp_id_temp=explode('_',$grp_value_grp_sms_result['grp_id']); echo $grp_id_temp[1]; ?><br/>
                           
                         <?php    } ?>  
                                                
                        </div>
                                                
                                                <div style=" width:700px; height:300px; float:right;">
                                                <div class="forms">
													
														<!--[if !IE]>start row<![endif]-->
														<div class="row">
															<label>Mobile Number: &nbsp;+88</label>
															<div class="inputs">
																<span class="input_wrapper"><input class="text" name="mob_num_scdl_sms" type="text" /></span>
																
															</div>
														</div>
                                                        
    											<div class="row">
															<label>Write SMS:</label>
															<div class="inputs">
																
																
																<span class="input_wrapper textarea_wrapper">
																	<textarea rows="" name="sms" cols="" class="text" onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter')"></textarea>
																</span>
															</div>
														</div>

                    									<p style="margin-left:450px;">You have <B><SPAN id="myCounter" style="color:#06F;">160</SPAN></B> characters remaining...</p>
               
               									<div style="margin-left:40px;">
              									 <div class="row">
															<div class="buttons">
																
																

																
																<ul style="list-style:none;">
																	<li><span class="button orange_btn"><span><span>Send SMS to Group</span></span><input name="send_scdl_sms_submit_grp" type="submit" /></span></li>
																	<li><span class="button red_btn"><span><span>Send SMS to MOBILE NUMBER</span></span><input name="send_scdl_sms_submit_sin_num" type="submit" /></span></li>
																</ul>
		
																       
															</div>
														</div>
                                                        </div>
                   
	</div>
                                                
                                                </div>
                                                </fieldset>
                                                </form>
                                                <br/><br/>
                                                <div style="color:red; text-decoration:blink; text-shadow:#999 1px; font-weight:bold;"><?php echo $msg; ?></div> 
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