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
	 if($_REQUEST['send_group_sms_submit']){   
	 
	 	$sms_to_send=$_POST['sms'];     
			if(chk_sms_format($sms_to_send)==1){		
					for ($i=0; $i<count($_POST['grp_list_for_grp_sms']);$i++) {
						
					$mobile_num_frm_grp=chk_grp_user_num($grp_id);
					
						
							
							$grp_id=$_POST['grp_list_for_grp_sms'][$i];
						
							$mobile_num_frm_grp=show_grp_members($grp_id);
							
							while($mobile_num_frm_grp_result=mysql_fetch_array($mobile_num_frm_grp)){
							
								$mobile_numbers=$mobile_num_frm_grp_result['mob_num'];
								
								$to_sms_func=$mobile_numbers.' '.$sms_to_send.'<br/>';
								
								if(send_msg($mobile_numbers, $sms_to_send)){
									
									sms_log($mobile_numbers,$sms_to_send,$login_user_name,$grp_id);
									user_credti_minus($login_user_name,1);
									
									}
								else { sms_log($mobile_numbers,' Failed!!!! '.$sms_to_send,$login_user_name,$grp_id);}
								
							
							}
						
							
					}
			}
		else { $msg='SMS out of length';}	
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
							<h2>Send Group SMS</h2>
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
                                                <br /><br />
                         <div style="float:left; width:200px; min-height:300px; max-height:300px; ">
                         
                         		<form name="grp_member_list" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                                	<select name="show_edt_grp_form_group_name" style="width:180px;">

                 <option value="" selected="selected">Select From Below</option>

                <?php	

                                        

                $retrive_data=list_grp($login_user_name);

                while($retrive_result=mysql_fetch_array($retrive_data)){ ?>

                <option value="<?php echo $retrive_result['grp_id']; ?>"><?php $grp_id_temp=explode('_',$retrive_result['grp_id']); echo $grp_id_temp[1]; ?></option>

                <?php    } ?>

                </select>
                 <br/>
                <input type="submit" name="show_members_from_grp" value="SHOW CONTACTS" />
                                
                                </form>  
                                
                                 
                                 <?php  if($_REQUEST['show_members_from_grp']){ ?>

                		

                <div class="table_wrapper">

				<div class="table_wrapper_inner" style="overflow:auto; max-height:150px;">
					<br/>
				<table cellpadding="0" cellspacing="0" width="95%" align="left" border="1">

				<tbody><tr>

															

				<th style="text-align:center; font-size:12px;">CONTACT MOBILE NUMBER</th>

				</tr>

                                                        

                    <?php	

                          $retrive_data_for_member_list=show_grp_members($_POST['show_edt_grp_form_group_name']);

                          while($retrive_result_for_member_list=mysql_fetch_array($retrive_data_for_member_list)){ ?>

                    

				<tr class="first">

				<td style="text-align:center; font-size:14px;">&nbsp;<?php echo $retrive_result_for_member_list['mob_num']; ?></td>

				</tr>

                <?php    } ?>

                </tbody></table>

                </div>

                </div> 

                        



                

                <?php

                    }

                

                

                ?>                        
                         </div>
                                                
                        <form name="send_grp_sms" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="search_form general_form">
                        <fieldset>
                        
                        <div style="margin-left:-100px;">
                        <div class="row">
						<div class="buttons">
						<ul style="list-style:none;">
                        
						<li><span class="button send_form_btn"><span><span>Check All</span></span><input name="CheckAll" onClick="checkAll(document.send_grp_sms.grp_list_for_grp_sms);"/></span></li>
						<li><span class="button cancel_btn"><span><span>Uncheck All</span></span><input name="UnCheckAll" onClick="uncheckAll(document.send_grp_sms.grp_list_for_grp_sms);"/></span></li>
                        
						</ul>
                        </div></div></div>
                        
						<div style=" width:200px; height:300px; overflow:auto; float:left;">
                        
                
					 	<?php 
						 $grp_value_grp_sms=list_grp($login_user_name);
						 while($grp_value_grp_sms_result=mysql_fetch_array($grp_value_grp_sms)){
                           echo $grp_value_grp_sms['grp_id'];
						   
						 ?>
						 
                         <input type="checkbox" name="grp_list_for_grp_sms[]" id="grp_list_for_grp_sms" value="<?php echo $grp_value_grp_sms_result['grp_id']; ?>"/> &nbsp;<?php $grp_id_temp=explode('_',$grp_value_grp_sms_result['grp_id']); echo $grp_id_temp[1]; ?><br/>
                           
                        <?php    } ?> 
                                                
                        </div>
                                                
                                                <div style=" width:700px; height:300px; float:left;">
                                                <div class="forms">
													
														<!--[if !IE]>start row<![endif]-->
														
                                                        
    											<div class="row">
															<label>Write SMS:</label>
															<div class="inputs">
																
																
																<span class="input_wrapper textarea_wrapper">
																	<textarea rows="" name="sms" cols="" class="text" onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter')"></textarea>
																</span>
															</div>
														</div>

                    									<p style="margin-left:250px;">You have <B><SPAN id="myCounter" style="color:#06F;">160</SPAN></B> characters remaining...</p>
               
               									<div style="margin-left:40px;">
              								
															<div class="buttons">
																
																

																
																<ul style="list-style:none;">
																	<li><span class="button orange_btn"><span><span>SEND SMS</span></span><input name="send_group_sms_submit" type="submit" /></span></li>
																	<li><span class="button red_btn"><span><span>RESET</span></span><input name="" type="reset" /></span></li>
																</ul>
																

																
																
																
																
																       
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