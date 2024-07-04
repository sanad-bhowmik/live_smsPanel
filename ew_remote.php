<?php
include('function.php');
include('db.php');

		$u_name = $_REQUEST['user'];
		$u_pass = $_REQUEST['pass'];
		$to_num=trim($_REQUEST['mobile']);
		$msisdn = str_replace("\r\n",' ',$to_num);
		$msisdn = str_replace("  ",' ',$msisdn);
		$to_num1=$msisdn;
		$find= explode(' ',$to_num1);

		$find1=implode(' 88',$find);
		
		$mobile_numbers= explode(' ',$find1);
		
		$n=count($mobile_numbers);
		$num_of_sending_sms=$n;
		$sms = $_REQUEST['text'];
		$login_user_name=$u_name;
		
		
		if(chk_user($u_name,$u_pass)== 1 && chk_sms_credit($n,$u_name) == 1 && chk_valid_date($u_name) == 1){
				
					for ($i=0;$i<$n;$i++){
					
						$telco_ID= get_telcoID($mobile_numbers[$i]);
						$sender=$login_user_name;
						$to=$mobile_numbers[$i];
						$date=date('Y-m-d h:i:s');
						$sql="insert into mt_log (sender,Mob_To,sms,date_time,telco_id) values('$sender','$to','$sms','$date','$telco_ID')";
					    $sqlsend="insert into metro_send_sms_log (sender,Mob_To,sms,date_time,status) values('$sender','$to','$sms','$date','1')";
						mysql_query($sql);
						$res = mysql_query($sqlsend);
						//sms_log($mobile_numbers[$i],$sms,$login_user_name,$telcoID);
						user_credti_minus($login_user_name,1);
						
						
						

			   }
				echo $msg='200';
			}
			else if(chk_user($u_name,$u_pass)!= 1){
					
					echo '100';
					
					}
					else if(chk_user($u_name,$u_pass)== 1 && chk_sms_credit($n,$u_name) != 1){
					
					echo '300';
					
					}
					
					
					else if(chk_user($u_name,$u_pass)== 1 && chk_sms_credit($n,$u_name) == 1 && chk_valid_date($u_name) != 1){
					
					echo '400';
					
					}
					
					
					else
					{
					echo 'error';
					}

?>