<?php
session_start();
require('function.php');
include('db.php');
date_default_timezone_set('Asia/Dhaka');
$date =date("Y-m-d H:i:s", time() + 3);
$date1 =date("Y-m-d H:i:s", time() - 3);
$query = "SELECT * FROM sch_sms_info WHERE delv_time > '$date1' and delv_time < '$date'";
//$query = "SELECT * FROM sch_sms_info WHERE 1";
$result = mysql_query($query);
$i=0;
while($row=mysql_fetch_row($result))
{
	$delv_time = $row[0];
	$to = $row[1];
	$sms = $row[2];
	$admin_id=$row[3];
	//echo $to."<br />";
	if(is_numeric($to))
		{
				$to_num = $to;
				//$sms=$sms;
				$num_of_sending_sms=1;
					if(chk_sms_credit($num_of_sending_sms,$_SESSION['_u_li_'])==1)
						{	
							
						if((chk_mobile_num($to_num)==1) && (chk_sms_format($sms)==1))
							{							
								if(send_msg($to_num, $sms))
									{							
										sms_log($to_num,$sms);
										user_credti_minus($login_user_name,1);
										$msg='SMS SEND TO: &nbsp;'.$to_num;
										//echo $msg;
									}
								else 
									{									
										sms_log($to_num.'  Failed!!!!!',$sms);
										$msg='SMS SENDING FAILED TO: &nbsp;'.$to_num;
										//echo $msg;
									}						
							}					
				
						}
					else 
						{ 
							$msg='SMS CREDIT OVERFLOW.CHECK YOUR REMAINING CREDIT.';
							//echo $msg;
						}
		}
	else
		{
			$query_group_cell_num = "SELECT mob_num FROM grp_tbl WHERE grp_id='$to'";
			$result_group_cell_num = mysql_query($query_group_cell_num);
			
			$j=0;
			while($row1=mysql_fetch_row($result_group_cell_num))
			{
				$group_cell = $row1[0];				
				$to_num = $group_cell;
				//echo $to_num."**********<br />";
				//$sms=$sms;
				$num_of_sending_sms=1;
					//if(chk_sms_credit($num_of_sending_sms,$_SESSION['_u_li_'])==1)
						//{	
							
						if((chk_mobile_num($to_num)==1) && (chk_sms_format($sms)==1))
							{							
								if(send_msg($to_num, $sms))
									{							
										sms_log($to_num,$sms);
										user_credti_minus($login_user_name,1);
										$msg='SMS SEND TO: &nbsp;'.$to_num;
										//echo $msg;
									}
								else 
									{									
										sms_log($to_num.'  Failed!!!!!',$sms);
										$msg='SMS SENDING FAILED TO: &nbsp;'.$to_num;
										//echo $msg;
									}						
							}					
				
						//}
					//else 
						//{ 
							//$msg='SMS CREDIT OVERFLOW.CHECK YOUR REMAINING CREDIT.';
							//echo $msg;
						//}				
			}			
		}		
}
?>