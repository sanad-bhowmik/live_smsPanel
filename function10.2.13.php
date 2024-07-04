<?php
date_default_timezone_set("Asia/Thimbu");
include('db.php');

function chk_sms_credit($num_of_sending_sms,$sender_id_){
	
	
	$remain_temp=admin_credit_info($sender_id_);
	$remain=$remain_temp[0];
	$sending=$num_of_sending_sms;
	
		if($sending<=$remain){
			
			return 1;
			
			}
		else { return 0;}
	
	
	}
	
function selected_grp_member_num($grp_id_list){
			$total_count=0;
		for($i=0;$i<sizeof($grp_id_list);$i++){
			$sql_selected_grp_member_num="select count('mob_num') as grp_member_no from grp_tbl where grp_id='".$grp_id_list[$i]."'";
			$sql_selected_grp_member_num_data=mysql_query($sql_selected_grp_member_num);
			$sql_selected_grp_member_num_result=mysql_fetch_array($sql_selected_grp_member_num_data);
			
			$total_count=$total_count+$sql_selected_grp_member_num_result[0];
			
			return $total_count;
		}
	
	}

function chk_user($u_n,$pass){
	
	$sql_for_user_info_retrv="select * from user_info_cat where user_login_name='".$u_n."'";
	$data_for_user_info_retrv=mysql_query($sql_for_user_info_retrv);
	$result_for_user_info_retrv=mysql_fetch_array($data_for_user_info_retrv);
		
		if($result_for_user_info_retrv['user_login_pass']==$pass){
			
			return 1;
			
			}
			else { return 0;}
	
	
	}

function chk_user_type($user_name){
	
	$sql_for_user_type_retrv="select user_type from user_info_cat where user_login_name='".$user_name."'";
	$data_for_user_type_retrv=mysql_query($sql_for_user_type_retrv);
	$result_for_user_type_retrv=mysql_fetch_array($data_for_user_type_retrv);
		
		
	
	return $result_for_user_type_retrv['user_type'];
	
	}
 function chk_grp_user_num($grp_id){
	 
	 $sql_grp_mem_num="select mob_num from grp_tbl where grp_id='".$grp_id."'";
	 $sql_grp_mem_num_data=mysql_query($sql_grp_mem_num);
	 $sql_grp_mem_num_result=mysql_num_rows($sql_grp_mem_num_data);
	 
	 return $sql_grp_mem_num_result;
	 }


 function list_grp($grp_creator){
	 
	 if($grp_creator=='superAdmin')
    $sql_retrive_grp_list="select user_login_name from user_info_cat";
	else
	$sql_retrive_grp_list="select user_login_name from user_info_cat where user_login_name='$grp_creator'";
	$retrive_data=mysql_query($sql_retrive_grp_list);
	
	 
	 return $retrive_data;
	 }

function show_grp_members($grp_id){
	 
	 
    $sql_retrive_grp_members="select mob_num from grp_tbl where grp_id='$grp_id'";
	$retrive_data_grp_member=mysql_query($sql_retrive_grp_members);
	
	 
	 return $retrive_data_grp_member;
	 }

function get_telcoID($mobile_num_temp){
		
			$operator = substr($mobile_num_temp,0,5);
			
			if($operator == '88017'){
					$telcoID = '1';
			}else if($operator == '88018'){
					$telcoID = '4';
			}else if($operator == '88015'){
					$telcoID = '5';
			}else if($operator == '88019'){
					$telcoID = '3';
			}else if($operator == '88011'){
					$telcoID = '2';				
			}else if($operator == '88016'){
					$telcoID = '6';				
			}else{ $telcoID = '7'; }
			
			return $telcoID;
	
}
function sms_log($to,$sms,$sender,$telcoID){
	
		$date=date('Y-m-d h:i:s');
		$ftp = fopen('sms_log.txt','a+');
        fwrite($ftp,"\n------------------------------------------------------\n".$to." -->".$sms."	-->".$date."\n------------------------------------------------------\n");
        fclose($ftp);
		
		$sql_insert_mt = "insert into mt values (NULL,'".$sender."','".$to."','".$sms."','".$date."'.'".$telcoID."')";
		mysql_query($sql_insert_mt);
	
	}



function add_grp($new_grp_name,$grp_creator){
	
	$sql_check_grp_name="select grp_id from grp_info where grp_id='".$new_grp_name."'";
	$chk_grp_id=mysql_fetch_array(mysql_query($sql_check_grp_name));
	if(!$chk_grp_id[0]){
		
		$sql_add_new_grp="insert into grp_info values ('".$new_grp_name."','".$grp_creator."')";
		mysql_query($sql_add_new_grp);
		
		return 1;
		
		}
	else { return 0;}
	
	
	
	}

function delete_group($group_name){
	
	$sql_delete="delete from grp_info where grp_id='".$group_name."'";
	$sql_delete1="delete from grp_tbl where grp_id='".$group_name."'";
	mysql_query($sql_delete);
	mysql_query($sql_delete1);
	return 1;
	
	}	

function insert_in_grp_by_num_grp($grp_num,$mobile_num){
		
	$sql_insert_in_grp_by_num_grp="insert into grp_tbl values('".$grp_num."',".$mobile_num.")";
	mysql_query($sql_insert_in_grp_by_num_grp);
	
	return 1;
	
	
	}
	
function contact_upload(){
	
	
	$grp_num=$_POST['show_edt_grp_form_group_name'];
			$uploaddir = 'upload/';
			$uploadfile = $uploaddir . basename($_FILES['mobile_num_file']['name']);
		
				if($_FILES['mobile_num_file']['type']=='application/vnd.ms-excel'){
					if (move_uploaded_file($_FILES['mobile_num_file']['tmp_name'], $uploadfile)) {
						$msg="File is valid, and was successfully uploaded.\n";
						
						$row = 1;
						if (($handle = fopen($uploadfile, "r")) !== FALSE) {
							while (($data = fgetcsv($handle, 2000, "\n")) !== FALSE) {
								$num = count($data);
								$row++;
								for ($c=0; $c < $num; $c++) {
									//echo $data[$c] . "<br />\n";
									
									insert_in_grp_by_num_grp($grp_num,$data[$c]);
									
								}
							}
							fclose($handle);
							$msg='contacts uploaded';
						}
						
						
						
						
					} else {
							$msg="Possible file upload error!\n";
					}
			
			} else { 
					$msg='unsupported type';
				}
			
					return $msg;
	
	
	
	}
	
	
	function delete_contact_frp_grp($mobile_num,$grp_id){
		
		$sql_delete_contact_frp_grp="delete from grp_tbl where mob_num='$mobile_num' and grp_id='$grp_id'";
		$sql_delete_contact_frp_grp;
		mysql_query($sql_delete_contact_frp_grp);
		
		return 1;
		
		
		}
		
		
	function total_credit_info(){
		
		$sql_total_credit="select * from credit_info";
		$sql_total_credit_data=mysql_query($sql_total_credit);
		$sql_total_credit_result=mysql_fetch_array($sql_total_credit_data);
		
		return $sql_total_credit_result;
		
		}
		
	function admin_credit_info($user){
		
		$sql_total_credit="select user_allocated_sms_credit from user_info_cat where user_login_name='".$user."'";
		$sql_total_credit_data=mysql_query($sql_total_credit);
		$sql_total_credit_result=mysql_fetch_array($sql_total_credit_data);
		
		return $sql_total_credit_result;
		
		}
		
		function add_new_credit($new_credit_num,$user){
		$today=date('y-m-d h:m:i');
		$sql_total_credit_add="update credit_info set t_crdt=t_crdt+".$new_credit_num.",last_credit_update_date='".$today."'";
		$sql_total_credit_add2="update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit+".$new_credit_num.",user_remaining_sms_credit=user_remaining_sms_credit+".$new_credit_num." where user_login_name='$user'";
		$sql_total_credit_add_exec=mysql_query($sql_total_credit_add);
		$sql_total_credit_add_exec2=mysql_query($sql_total_credit_add2);
		
		return 1;
		}
		
	function add_new_user($user_name,$user_pass,$user_type,$user_allocated_credit,$admin_name){
		
		$sql_user_chk="select user_login_pass from user_info_cat where user_login_name='".$user_name."'";
		$result_user_chk=mysql_query($sql_user_chk);
		$user_creator_info_result=$_SESSION['_u_li_'];
		$today=date('y-m-d h:m:i');
		$sql_add_new_user="insert into user_info_cat values ('".$user_name."','".$user_pass."','".$user_type."',".$user_allocated_credit.",".$user_allocated_credit.",'".$today."','".$admin_name."')";
		$sql_minus_credit_frm_total="update credit_info set t_crdt=t_crdt-$user_allocated_credit";
		$sql_minus_credit_frm_acc="update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit-$user_allocated_credit where user_login_name='".$user_creator_info_result."'";
		$sql_user_log="insert into user_crdt_log values('".$user_name."','".$user_allocated_credit."','".$today."')";
		
		if(mysql_num_rows($result_user_chk)<1){
			
			mysql_query($sql_add_new_user);
			mysql_query($sql_minus_credit_frm_total);
			mysql_query($sql_minus_credit_frm_acc);
			mysql_query($sql_user_log);
			return 1;
			
			}
		
		else { return 0;}
		
		
		}
		
		
function add_new_user_for_admin($user_name,$user_pass,$user_type,$user_allocated_credit,$admin_name){
		
		$sql_user_chk="select user_login_pass from user_info_cat where user_login_name='".$user_name."'";
		$result_user_chk=mysql_query($sql_user_chk);
		$user_creator_info=mysql_fetch_array($result_user_chk);
		$user_creator_info_result=$_SESSION['_u_li_'];
		$today=date('y-m-d h:m:i');
		
		$sql_add_new_user="insert into user_info_cat values ('".$user_name."','".$user_pass."','".$user_type."','".$user_allocated_credit."','".$user_allocated_credit."','".$today."','".$admin_name."')";
		//$sql_add_new_user;
		$sql_minus_credit_frm_admin="update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit-$user_allocated_credit where user_login_name='".$user_creator_info_result."'";
		$sql_user_log="insert into user_crdt_log values('".$user_name."','".$user_allocated_credit."','".$today."')";
		
		if(mysql_num_rows($result_user_chk)<1){
			
			mysql_query($sql_add_new_user);
			mysql_query($sql_minus_credit_frm_admin);
			mysql_query($sql_user_log);
			return 1;
			
			}
		
		else { return 0;}
		
		
		}
		
		function get_user_info($user_login_name){
			
			$sql_get_user_info="select * from user_info_cat where user_login_name='".$user_login_name."'";
			$sql_get_user_info_data=mysql_query($sql_get_user_info);
			$sql_get_user_info_result=mysql_fetch_array($sql_get_user_info_data);
			
			return $sql_get_user_info_result;
			}


		function user_info_edit_add($prev_user_name,$new_name,$new_pass,$new_credit){
			
			$today=date('y-m-d h:m:i');
			$user_creator_info_result=$_SESSION['_u_li_'];
			$sql_update_user_info="update user_info_cat set user_login_name='".$new_name."', user_login_pass='".$new_pass."',user_allocated_sms_credit=user_allocated_sms_credit+$new_credit where user_login_name='".$prev_user_name."'";
			$sql_minus_credit_frm_total="update credit_info set t_crdt=t_crdt-$new_credit";
			$sql_minus_credit_frm_acc="update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit-$new_credit where user_login_name='".$user_creator_info_result."'";
			$sql_user_log="insert into user_crdt_log values('".$new_name."','".$new_credit."','".$today."')";
			
			
			if(mysql_query($sql_update_user_info)){
				mysql_query($sql_minus_credit_frm_total);
				mysql_query($sql_minus_credit_frm_acc);
				mysql_query($sql_user_log);
				return 1;
				
				}
			else {  return 0; }
			
			}
			
			function user_info_edit_add_admin($prev_user_name,$new_name,$new_pass,$new_credit){
			
			$today=date('y-m-d h:m:i');
			$user_creator_info_result=$_SESSION['_u_li_'];
			$sql_update_user_info="update user_info_cat set user_login_name='".$new_name."', user_login_pass='".$new_pass."',user_allocated_sms_credit=user_allocated_sms_credit+$new_credit where user_login_name='".$prev_user_name."'";
			$sql_minus_credit_frm_total="update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit-$new_credit where user_login_name='".$user_creator_info_result."'";
			$sql_user_log="insert into user_crdt_log values('".$new_name."','".$new_credit."','".$today."')";
			
			
			if(mysql_query($sql_update_user_info)){
				mysql_query($sql_minus_credit_frm_total);
				mysql_query($sql_user_log);
				return 1;
				
				}
			else {  return 0; }
			
			}
			
			
			function user_info_edit_minus($prev_user_name,$new_name,$new_pass,$new_credit){
			
			$today=date('y-m-d h:m:i');
			$user_creator_info_result=$_SESSION['_u_li_'];
			$sql_update_user_info="update user_info_cat set user_login_name='".$new_name."', user_login_pass='".$new_pass."',user_allocated_sms_credit=user_allocated_sms_credit-$new_credit where user_login_name='".$prev_user_name."'";
			$sql_minus_credit_frm_total="update credit_info set t_crdt=t_crdt+$new_credit";
			$sql_minus_credit_frm_acc="update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit+$new_credit where user_login_name='".$user_creator_info_result."'";
			$sql_user_log="insert into user_crdt_log values('".$new_name."','".$new_credit."','".$today."')";
			
				if(mysql_query($sql_update_user_info)){
				mysql_query($sql_minus_credit_frm_total);
				mysql_query($sql_minus_credit_frm_acc);
				mysql_query($sql_user_log);
				return 1;
				
				}
			else {  return 0; }
			
			}
			
			function user_info_edit_minus_admin($prev_user_name,$new_name,$new_pass,$new_credit){
			
			$today=date('y-m-d h:m:i');
			$user_creator_info_result=$_SESSION['_u_li_'];
			$sql_update_user_info="update user_info_cat set user_login_name='".$new_name."', user_login_pass='".$new_pass."',user_allocated_sms_credit=user_allocated_sms_credit-$new_credit where user_login_name='".$prev_user_name."'";
			$sql_minus_credit_frm_total="update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit+$new_credit where user_login_name='".$user_creator_info_result."'";
			$sql_user_log="insert into user_crdt_log values('".$new_name."','".$new_credit."','".$today."')";
			
				if(mysql_query($sql_update_user_info)){
				mysql_query($sql_minus_credit_frm_total);
				mysql_query($sql_user_log);
				return 1;
				
				}
			else {  return 0; }
			
			}
		function user_credti_minus($user_id,$sms_num){
				
				$sql_minus_user_credit="update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit-$sms_num where user_login_name='".$user_id."'";
				mysql_query($sql_minus_user_credit);
				
				}
			
			
		function delete_user($user_login_name){
			
			$sql_delete_user="delete from user_info_cat where user_login_name='".$user_login_name."'";
			
				if(mysql_query($sql_delete_user)){
					
					return 1;
					
					}
					else { return 0;}
			}
			
		function chk_mobile_num($mob_num){
			
				if((strlen($mob_num)==13)){
					 return 1;
					}
				else {return 0;}
			}	

			
		function chk_sms_format($sms){
		
			if(($sms!=NULL) && (strlen($sms)<=156)){
					 return 1;
					}
				else {return 0;}
			
			}
			
		function scdl_sms_to_db($time,$to,$sms,$admin_id){
			
			//$today=date('y-m-d H:i:s');
			$sql_scdl_grp_sms="insert into sch_sms_info values ('$time','$to','$sms','$admin_id')";
			$sql_scdl_grp_sms;
			if(mysql_query($sql_scdl_grp_sms)){
				
				return 1;
				}
			else return 0;
			
			}
			
			
	function send_msg($to, $sms){
			

	$url = "http://221.120.98.162/mkt_tem/via_sms_send.php";
	
	$msg = urlencode($sms);	
	
	$data="from=$to&text=$msg";
        
        $all = $url.'?'.$data;       	
              
	$reply=file_get_contents($all);			
		//die();
		
		return 1;
		}

?>