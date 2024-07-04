<?php
session_start();
include('function.php');

 $u_name=trim($_POST['u_name']);

$u_pass=trim($_POST['u_pass']);
$error_log='wrong user name or pass';
	
	if(($u_name!=NULL) && ($u_pass!=NULL)){
		
			if(chk_user($con,$u_name,$u_pass)==1){
				
				
				 $_SESSION['_u_li_']=$u_name;
				$_SESSION['_u_li_pass_']=$u_pass;
			
				header("Location: home.php");	
			
			}
			
			else { 
			
			$_SESSION['_log_in_error_']='error : wrong user name and passowrd';
			header("Location: index.php"); 
			
			}
			
		
		
		}
		else { 
		
			$_SESSION['_log_in_error_']='<strong>Access Denied</strong> | <span>user/password combination wrong</span>';
			header("Location: index.php"); 
		
		}

?>

 
				
				
				
				
				
				