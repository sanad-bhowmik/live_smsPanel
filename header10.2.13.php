<?php
date_default_timezone_set ("Asia/Thimphu"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Administration Panel</title>
<link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->

<script type="text/javascript" src="js/behaviour.js"></script>
<script type="text/javascript" src="js/common.js"></script>
</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		<!--[if !IE]>start head<![endif]-->
		<div id="head">
			
			<!--[if !IE]>start logo and user details<![endif]-->
			<div id="logo_user_details">
				<h1 id="logo"><a href="home.php">SMS Portal Administration Panel</a></h1>
				<!--[if !IE]>start user details<![endif]-->
				<div id="user_details">

                
					<ul id="user_details_menu">
                    
						<li>Welcome <strong><?php echo $login_user_name; ?></strong></li>
						<li>
							<ul id="user_access">
								<li class="first"><a href="#">
								<?php 
								switch($user_type_code){
									
									case 1:
										echo 'General User';
									break;
									case 2:
										echo 'Admin';
									break;
									case 3:
										echo 'Super Admin';
									break;
									
									}
								
								
								?></a></li>
								<li class="last"><a href="logout.php">Log out</a></li>
							</ul>
						</li>
						<li>
                        <a class="new_messages" href="#">
                        <?php     
								$remaining_sms_credit=admin_credit_info($login_user_name);
								echo "Your remaining credit :".$remaining_sms_credit['user_allocated_sms_credit'];
						?>
                        </a>
                        </li>
					</ul>
					<div id="server_details">
						<dl>
							<dt>Server time :</dt>
							<dd><?php echo date("h:i A"); ?> </dd>
						</dl>
						<dl>
							<dt>Last login ip :</dt>
							<dd><?php $address = $_SERVER['REMOTE_ADDR'];

//echo it all baby

echo $address;?></dd>
						</dl>
					</div>
					<!--[if !IE]>start search<![endif]-->
					
				<!--[if !IE]>end search<![endif]-->
				</div>
				
				<!--[if !IE]>end user details<![endif]-->
				
				
				
			</div>
			
			<!--[if !IE]>end logo end user details<![endif]-->
			
			
			
			<!--[if !IE]>start menus_wrapper<![endif]-->