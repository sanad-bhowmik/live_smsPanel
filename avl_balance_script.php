<?php
include('function.php');
include('db.php');

		$u_name = $_REQUEST['user'];
		$u_pass = $_REQUEST['pass'];

	
	
		$login_user_name=$u_name;
		
		
		if(chk_user($u_name,$u_pass)== 1){
				
					
						
			 $sql="select * from user_info_cat where user_login_name='$u_name' and user_login_pass='$u_pass'";
			  $qr = mysql_query($sql);

              while($row = mysql_fetch_array($qr))		
                   			  
	             echo 'Your Available Balance:  '.$row['user_allocated_sms_credit'];
				
			}
			else{
					
					echo 'Wrong User Name or Password';
					
					}
					
					
					

?>