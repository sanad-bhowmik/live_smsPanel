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
							<h2>URL GENERATE</h2>
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
												
												<div style="margin:auto; width:80%; height:500px;">
                                                	<span style="color:#00F; font-size:16px; font-weight:500;">http://www.smartsmspro.net/remote_access_script.php?<b>user</b>=<?php echo $login_user_name; ?>&amp;<b>pass</b>=Password&amp;<b>mobile</b>=Mobile Number&amp;<b>text</b>=SMS Text</span>
                                                    <br/>
                                                    <div style="margin:5% auto auto auto; width:80%;">
                                                    	<span style="color:#6C6; font-size:18px; font-weight:bold;"><center> API USAGE AND NOTES</center></span>
                                                    	<span>
                                                        	
                                                            <ul style="font-size:16px;">
                                                            	<li>Please note all the data sent to gateway server MUST be properly URL encoded.</li>
                                                                <li>User can use HTTP GET method to submit the values of these parameter. </li>
                                                                <li>
                                                                	Parameter Description-
                                                                    <ul>
                                                                    	<li><b>User</b> = 'User of the API (Needs to be an user of this software.)'</li>
                                                                        <li><b>Password</b> = 'Password the user'</li>
                                                                        <li><b>Mobile Number</b> = 'Mobile number to send the SMS'</li>
                                                                        <li><b>SMS Text</b> = 'The sms to be send. SMS must be URL encoded.'</li>
                                                                    </ul>
                                                                </li>
                                                           </ul>
                                                        
                                                        </span>	
                                                    </div>
                                                </div>
												
												
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