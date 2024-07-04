<?php
session_start();

if (isset($_SESSION['_u_li_'])){

		unset($_SESSION['_u_li_']);
		unset($_SESSION['_u_li_pass_']);
		header("Location: index.php");
		}
	{}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Administration Panel</title>
<link media="screen" rel="stylesheet" type="text/css" href="css/admin-login.css"  />
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-login-ie.css" /><![endif]-->

</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		
		
		
		
		<!--[if !IE]>start login wrapper<![endif]-->
		<div id="login_wrapper">
			
			
			<div class="error">
				<div class="error_inner">
                
                <?php 
				if(isset($_SESSION['_log_in_error_'])){
				echo $_SESSION['_log_in_error_']; 
				unset($_SESSION['_log_in_error_']);
				}
				else { echo 'TYPE USER NAME AND PASSWORD.';}
				?>
					
				</div>
			</div>
			
			
			
			<!--[if !IE]>start login<![endif]-->
            			
            <form name="log-in" action="log_in_chk.php" method="post">
				<fieldset>
					
					
					
					
					
					<h1 id="logo"><a href="#">websitename Administration Panel</a></h1>
					<div class="formular">
						<div class="formular_inner">
						
						<label>
							<strong>Username:</strong>
							<span class="input_wrapper">
								<input type="text" name="u_name" />
							</span>
						</label>
						<label>
							<strong>Password:</strong>
							<span class="input_wrapper">
								<input type="password" name="u_pass"/>
							</span>
						</label>
						
						
						
						<ul class="form_menu">
							<li><span class="button"><span><span>Submit</span></span><input type="submit" name="log_in" /></span></li>
						</ul>
						
						</div>
					</div>
				</fieldset>
			</form>
			<!--[if !IE]>end login<![endif]-->
		</div>
		<!--[if !IE]>end login wrapper<![endif]-->
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
</body>
</html>
