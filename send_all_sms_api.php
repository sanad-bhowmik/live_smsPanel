<?php

require('function.php');
include('db.php');


	
	$msg="";

	 $username = $_REQUEST['muser'];
	 $password = $_REQUEST['mpass'];	
	if($username=="bgb" && $password=="bgb@2022@mmsl")
	{
			$to_num=trim($_REQUEST['mobile']);
			$msisdn = str_replace("\r\n",' ',$to_num);
			$msisdn = str_replace("  ",' ',$msisdn);
			$to_num1=$msisdn;
			$find= explode(' ',$to_num1);

			$find1=implode(' ',$find);
			
			$mobile_numbers= explode(' ',$find1);
			$n=count($mobile_numbers);
			
			$sms=$_REQUEST['text'];/*
			if(isset($_POST['Bangla']))
			{
			$lang="Bangla";
			}
			else
			{
			$lang="English";
			}*/
			$lang="English";
			$num_of_sending_sms=$n;
			
				if(chk_sms_credit($num_of_sending_sms,$username)==1){	
						if(chk_valid_date($username)==1){
					
							for ($i=0;$i<$n;$i++){
									
								$telco_ID= get_telcoID($mobile_numbers[$i]);
								$sender=$username;
								$to=$mobile_numbers[$i];
								
								$firsttwo = substr($to,0,2);
								if($firsttwo!="88")
								{
								 $to = "88".$to;
								}
								
								if(strlen($to)=="13")
								{
									$date=date('Y-m-d H:i:s');
									$sql="insert into mt_log (sender,Mob_To,sms,date_time,telco_id,lang) values('$sender','$to','$sms','$date','$telco_ID','$lang')";
								 $sqlsend="insert into metro_send_sms_log (sender,Mob_To,sms,date_time,status,lang) values('$sender','$to','$sms','$date','1','$lang')";
								 //echo $sqlsend;
								//die;
									mysql_query("SET NAMES 'UTF8'");
									mysql_query($sql);
									$res = mysql_query($sqlsend);
									if($res)
									{
									user_credti_minus($username,1);
									$msg='SVC001';
									}
									else
									{
								
									sms_log($mobile_numbers[$i],'  Failed!!!!!  '.$sms,$username);
									$msg='SVC002';
									
									}
								}
								else
								{
								$msg='SVC006';
								}
							}
						}
						else{$msg='SVC003';}
						
						
						
						
			
			}
			else { $msg='SVC004';}
	}
	else
	{
	$msg='SVC005';
	}
	

	echo $msg;
	
	?>
                                                

      