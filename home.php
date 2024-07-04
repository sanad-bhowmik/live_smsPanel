<?php
session_start();
include('function.php');
//include('db.php');
//echo $user_name;
//die();

if (isset($_SESSION['_u_li_'])){
	$login_user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($con,$login_user_name);
	
	if($user_type_code==NULL)
	{
	    $_SESSION['_log_in_error_']=1;
		header("Location: index.php");
	}
	else{
	
	
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
							<h2>Welcome <?php echo strtoupper($login_user_name); ?></h2>
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
	}
	else { 
		
		$_SESSION['_log_in_error_']=1;
		header("Location: index.php");
	
	}

?>			