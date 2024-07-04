<?php
date_default_timezone_set("Asia/Thimbu");
//include('db.php');


// Create connection
//global $con;
$con = mysqli_connect("localhost", "root", "", "mmsl_sms");

// Check connection
if (!$con) {
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Set the character set to utf8
if (!mysqli_set_charset($con, "utf8")) {
	die("Error loading character set utf8: " . mysqli_error($con));
}

// Set session collation
if (!mysqli_query($con, "SET SESSION collation_connection = 'utf8_general_ci'")) {
	die("Error setting collation: " . mysqli_error($con));


}



function chk_sms_credit($con, $num_of_sending_sms, $sender_id_)
{
	$sql_total_credit = "SELECT user_allocated_sms_credit FROM user_info_cat WHERE user_login_name='" . $sender_id_ . "'";
	$sql_total_credit_data = mysqli_query($con, $sql_total_credit);

	if ($sql_total_credit_data) {
		$sql_total_credit_result = mysqli_fetch_array($sql_total_credit_data, MYSQLI_ASSOC);

		if ($sql_total_credit_result) {
			$remain_temp = $sql_total_credit_result['user_allocated_sms_credit'];

			echo "Remaining Credit: " . $remain_temp . "<br>";
			echo "Sending: " . $num_of_sending_sms . "<br>";

			if ($num_of_sending_sms <= $remain_temp) {
				return 1;
			} else {
				return 0;
			}
		} else {
			echo "Error fetching data.";
			return 0;
		}
	} else {
		echo "Error executing query.";
		return 0;
	}
}

function admin_date_info($con, $user)
{

	$sql_total_credit = "select user_valid_date from user_info_cat where user_login_name='" . $user . "'";
	$sql_total_credit_data = mysqli_query($con, $sql_total_credit);
	$sql_total_credit_result = mysqli_fetch_array($sql_total_credit_data, MYSQLI_ASSOC);

	return $sql_total_credit_result;

}

function chk_valid_date($con, $sender_id_)
{
	$today = date('Y-m-d');
	$sql_total_credit = "SELECT user_valid_date FROM user_info_cat WHERE user_login_name='" . $sender_id_ . "'";
	$sql_total_credit_data = mysqli_query($con, $sql_total_credit);

	if ($sql_total_credit_data) {
		$sql_total_credit_result = mysqli_fetch_array($sql_total_credit_data, MYSQLI_ASSOC);

		if ($sql_total_credit_result) {
			$validdate = $sql_total_credit_result['user_valid_date'];

			echo "Today's Date: " . $today . "<br>";
			echo "Valid Date: " . $validdate . "<br>";

			if ($today <= $validdate) {
				return 1;
			} else {
				return 0;
			}
		} else {
			echo "Error fetching data.";
			return 0;
		}
	} else {
		echo "Error executing query.";
		return 0;
	}
}

function selected_grp_member_num($grp_id_list)
{
	$total_count = 0;
	for ($i = 0; $i < sizeof($grp_id_list); $i++) {
		$sql_selected_grp_member_num = "select count('mob_num') as grp_member_no from grp_tbl where grp_id='" . $grp_id_list[$i] . "'";
		$sql_selected_grp_member_num_data = mysqli_query($con, $sql_selected_grp_member_num);
		$sql_selected_grp_member_num_result = mysqli_fetch_array($sql_selected_grp_member_num_data, MYSQLI_ASSOC);

		$total_count = $total_count + $sql_selected_grp_member_num_result[0];

		return $total_count;
	}

}

function chk_user($con, $u_n, $pass)
{

	$sql_for_user_info_retrv = "select * from user_info_cat where user_login_name='" . $u_n . "'";


	$data_for_user_info_retrv = mysqli_query($con, $sql_for_user_info_retrv);
	$result_for_user_info_retrv = mysqli_fetch_array($data_for_user_info_retrv, MYSQLI_ASSOC);
	$result_for_user_info_retrv['user_login_pass'];

	if ($result_for_user_info_retrv['user_login_pass'] == $pass) {

		return 1;

	} else {
		return 0;
	}


}

function chk_user_type($con, $user_name)
{

	$sql_for_user_type_retrv = "select user_type from user_info_cat where user_login_name='" . $user_name . "'";
	$data_for_user_type_retrv = mysqli_query($con, $sql_for_user_type_retrv);
	$result_for_user_type_retrv = mysqli_fetch_array($data_for_user_type_retrv, MYSQLI_ASSOC);



	return $result_for_user_type_retrv['user_type'];

}
function chk_grp_user_num($grp_id)
{

	$sql_grp_mem_num = "select mob_num from grp_tbl where grp_id='" . $grp_id . "'";
	$sql_grp_mem_num_data = mysqli_query($con, $sql_grp_mem_num);
	$sql_grp_mem_num_result = mysql_num_rows($sql_grp_mem_num_data);

	return $sql_grp_mem_num_result;
}


function list_grp($grp_creator)
{

	if ($grp_creator == 'superAdmin')
		$sql_retrive_grp_list = "select user_login_name from user_info_cat";
	else
		$sql_retrive_grp_list = "select user_login_name from user_info_cat where user_login_name='$grp_creator'";
	$retrive_data = mysqli_query($con, $sql_retrive_grp_list);


	return $retrive_data;
}

function show_grp_members($grp_id)
{


	$sql_retrive_grp_members = "select mob_num from grp_tbl where grp_id='$grp_id'";
	$retrive_data_grp_member = mysqli_query($con, $sql_retrive_grp_members);


	return $retrive_data_grp_member;
}

function get_telcoID($mobile_num_temp)
{

	$operator = substr($mobile_num_temp, 0, 5);

	if ($operator == '88017') {
		$telcoID = '1';
	} else if ($operator == '88018') {
		$telcoID = '4';
	} else if ($operator == '88015') {
		$telcoID = '5';
	} else if ($operator == '88019') {
		$telcoID = '3';
	} else if ($operator == '88011') {
		$telcoID = '2';
	} else if ($operator == '88016') {
		$telcoID = '6';
	} else {
		$telcoID = '7';
	}

	return $telcoID;

}
function sms_log($to, $sms, $sender, $telcoID)
{

	$date = date('Y-m-d h:i:s');
	$ftp = fopen('sms_log.txt', 'a+');
	fwrite($ftp, "\n------------------------------------------------------\n" . $to . " -->" . $sms . "	-->" . $date . "\n------------------------------------------------------\n");
	fclose($ftp);

	$sql_insert_mt = "insert into mt values (NULL,'" . $sender . "','" . $to . "','" . $sms . "','" . $date . "'.'" . $telcoID . "')";
	mysqli_query($con, $sql_insert_mt);

}



function add_grp($new_grp_name, $grp_creator)
{

	$sql_check_grp_name = "select grp_id from grp_info where grp_id='" . $new_grp_name . "'";
	$chk_grp_id = mysqli_fetch_array(mysqli_query($con, $sql_check_grp_name), MYSQLI_ASSOC);
	if (!$chk_grp_id[0]) {

		$sql_add_new_grp = "insert into grp_info values ('" . $new_grp_name . "','" . $grp_creator . "')";
		mysqli_query($con, $sql_add_new_grp);

		return 1;

	} else {
		return 0;
	}



}

function delete_group($group_name)
{

	$sql_delete = "delete from grp_info where grp_id='" . $group_name . "'";
	$sql_delete1 = "delete from grp_tbl where grp_id='" . $group_name . "'";
	mysqli_query($con, $sql_delete);
	mysqli_query($con, $sql_delete1);
	return 1;

}

function insert_in_grp_by_num_grp($grp_num, $mobile_num)
{

	$sql_insert_in_grp_by_num_grp = "insert into grp_tbl values('" . $grp_num . "'," . $mobile_num . ")";
	mysqli_query($con, $sql_insert_in_grp_by_num_grp);

	return 1;


}

function contact_upload()
{


	$grp_num = $_POST['show_edt_grp_form_group_name'];
	$uploaddir = 'upload/';
	$uploadfile = $uploaddir . basename($_FILES['mobile_num_file']['name']);

	if ($_FILES['mobile_num_file']['type'] == 'application/vnd.ms-excel') {
		if (move_uploaded_file($_FILES['mobile_num_file']['tmp_name'], $uploadfile)) {
			$msg = "File is valid, and was successfully uploaded.\n";

			$row = 1;
			if (($handle = fopen($uploadfile, "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 2000, "\n")) !== FALSE) {
					$num = count($data);
					$row++;
					for ($c = 0; $c < $num; $c++) {
						//echo $data[$c] . "<br />\n";

						insert_in_grp_by_num_grp($grp_num, $data[$c]);

					}
				}
				fclose($handle);
				$msg = 'contacts uploaded';
			}




		} else {
			$msg = "Possible file upload error!\n";
		}

	} else {
		$msg = 'unsupported type';
	}

	return $msg;



}


function delete_contact_frp_grp($mobile_num, $grp_id)
{

	$sql_delete_contact_frp_grp = "delete from grp_tbl where mob_num='$mobile_num' and grp_id='$grp_id'";
	$sql_delete_contact_frp_grp;
	mysqli_query($con, $sql_delete_contact_frp_grp);

	return 1;


}


function total_credit_info()
{

	$sql_total_credit = "select * from credit_info";
	$sql_total_credit_data = mysqli_query($con, $sql_total_credit);
	$sql_total_credit_result = mysqli_fetch_array($sql_total_credit_data, MYSQLI_ASSOC);

	return $sql_total_credit_result;

}

function admin_credit_info($con, $user)
{

	$sql_total_credit = "select user_allocated_sms_credit from user_info_cat where user_login_name='" . $user . "'";

	$sql_total_credit_data = mysqli_query($con, $sql_total_credit);
	$sql_total_credit_result = mysqli_fetch_array($sql_total_credit_data, MYSQLI_ASSOC);

	return $sql_total_credit_result;

}

function add_new_credit($new_credit_num, $user)
{
	$today = date('y-m-d h:m:i');
	$sql_total_credit_add = "update credit_info set t_crdt=t_crdt+" . $new_credit_num . ",last_credit_update_date='" . $today . "'";
	$sql_total_credit_add2 = "update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit+" . $new_credit_num . ",user_remaining_sms_credit=user_remaining_sms_credit+" . $new_credit_num . " where user_login_name='$user'";
	$sql_total_credit_add_exec = mysqli_query($con, $sql_total_credit_add);
	$sql_total_credit_add_exec2 = mysqli_query($con, $sql_total_credit_add2);

	return 1;
}

function add_new_user($user_name, $user_pass, $user_type, $user_allocated_credit, $user_valid_date, $admin_name)
{

	$sql_user_chk = "select user_login_pass from user_info_cat where user_login_name='" . $user_name . "'";
	$result_user_chk = mysqli_query($con, $sql_user_chk);
	$user_creator_info_result = $_SESSION['_u_li_'];
	$today = date('y-m-d h:m:i');
	$sql_add_new_user = "insert into user_info_cat values ('" . $user_name . "','" . $user_pass . "','" . $user_type . "'," . $user_allocated_credit . "," . $user_allocated_credit . ",'" . $today . "','" . $user_valid_date . "','" . $admin_name . "')";
	$sql_minus_credit_frm_total = "update credit_info set t_crdt=t_crdt-$user_allocated_credit";
	$sql_minus_credit_frm_acc = "update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit-$user_allocated_credit where user_login_name='" . $user_creator_info_result . "'";
	$sql_user_log = "insert into user_crdt_log values('" . $user_name . "','" . $user_allocated_credit . "','" . $today . "')";

	if (mysql_num_rows($result_user_chk) < 1) {

		mysqli_query($con, $sql_add_new_user);
		mysqli_query($con, $sql_minus_credit_frm_total);
		mysqli_query($con, $sql_minus_credit_frm_acc);
		mysqli_query($con, $sql_user_log);
		return 1;

	} else {
		return 0;
	}


}


function add_new_user_for_admin($user_name, $user_pass, $user_type, $user_allocated_credit, $admin_name)
{

	$sql_user_chk = "select user_login_pass from user_info_cat where user_login_name='" . $user_name . "'";
	$result_user_chk = mysqli_query($con, $sql_user_chk);
	$user_creator_info = mysqli_fetch_array($result_user_chk, MYSQLI_ASSOC);
	$user_creator_info_result = $_SESSION['_u_li_'];
	$today = date('y-m-d h:m:i');

	$sql_add_new_user = "insert into user_info_cat values ('" . $user_name . "','" . $user_pass . "','" . $user_type . "','" . $user_allocated_credit . "','" . $user_allocated_credit . "','" . $today . "','" . $admin_name . "')";
	//$sql_add_new_user;
	$sql_minus_credit_frm_admin = "update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit-$user_allocated_credit where user_login_name='" . $user_creator_info_result . "'";
	$sql_user_log = "insert into user_crdt_log values('" . $user_name . "','" . $user_allocated_credit . "','" . $today . "')";

	if (mysql_num_rows($result_user_chk) < 1) {

		mysqli_query($con, $sql_add_new_user);
		mysqli_query($con, $sql_minus_credit_frm_admin);
		mysqli_query($con, $sql_user_log);
		return 1;

	} else {
		return 0;
	}


}

function get_user_info($user_login_name)
{

	$sql_get_user_info = "select * from user_info_cat where user_login_name='" . $user_login_name . "'";
	$sql_get_user_info_data = mysqli_query($con, $sql_get_user_info);
	$sql_get_user_info_result = mysqli_fetch_array($sql_get_user_info_data, MYSQLI_ASSOC);

	return $sql_get_user_info_result;
}


function user_info_edit_add($prev_user_name, $new_name, $new_pass, $new_credit, $newvaliddate)
{

	$today = date('y-m-d h:m:i');
	$user_creator_info_result = $_SESSION['_u_li_'];
	$sql_update_user_info = "update user_info_cat set user_login_name='" . $new_name . "', user_login_pass='" . $new_pass . "',user_allocated_sms_credit=user_allocated_sms_credit+$new_credit,`user_valid_date` = '$newvaliddate' where user_login_name='" . $prev_user_name . "'";
	$sql_minus_credit_frm_total = "update credit_info set t_crdt=t_crdt-$new_credit";
	$sql_minus_credit_frm_acc = "update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit-$new_credit where user_login_name='" . $user_creator_info_result . "'";
	$sql_user_log = "insert into user_crdt_log values('" . $new_name . "','" . $new_credit . "','" . $today . "')";


	if (mysqli_query($con, $sql_update_user_info)) {
		mysqli_query($con, $sql_minus_credit_frm_total);
		mysqli_query($con, $sql_minus_credit_frm_acc);
		mysqli_query($con, $sql_user_log);
		return 1;

	} else {
		return 0;
	}

}

function user_info_edit_add_admin($prev_user_name, $new_name, $new_pass, $new_credit, $newvaliddate)
{

	$today = date('y-m-d h:m:i');
	$user_creator_info_result = $_SESSION['_u_li_'];
	$sql_update_user_info = "update user_info_cat set user_login_name='" . $new_name . "', user_login_pass='" . $new_pass . "',user_allocated_sms_credit=user_allocated_sms_credit+$new_credit, `user_valid_date` = '$newvaliddate' where user_login_name='" . $prev_user_name . "'";
	$sql_minus_credit_frm_total = "update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit-$new_credit where user_login_name='" . $user_creator_info_result . "'";
	$sql_user_log = "insert into user_crdt_log values('" . $new_name . "','" . $new_credit . "','" . $today . "')";


	if (mysqli_query($con, $sql_update_user_info)) {
		mysqli_query($con, $sql_minus_credit_frm_total);
		mysqli_query($con, $sql_user_log);
		return 1;

	} else {
		return 0;
	}

}


function user_info_edit_minus($prev_user_name, $new_name, $new_pass, $new_credit, $newvaliddate)
{

	$today = date('y-m-d h:m:i');
	$user_creator_info_result = $_SESSION['_u_li_'];
	$sql_update_user_info = "update user_info_cat set user_login_name='" . $new_name . "', user_login_pass='" . $new_pass . "',user_allocated_sms_credit=user_allocated_sms_credit-$new_credit, `user_valid_date` = '$newvaliddate' where user_login_name='" . $prev_user_name . "'";
	$sql_minus_credit_frm_total = "update credit_info set t_crdt=t_crdt+$new_credit";
	$sql_minus_credit_frm_acc = "update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit+$new_credit where user_login_name='" . $user_creator_info_result . "'";
	$sql_user_log = "insert into user_crdt_log values('" . $new_name . "','" . $new_credit . "','" . $today . "')";

	if (mysqli_query($con, $sql_update_user_info)) {
		mysqli_query($con, $sql_minus_credit_frm_total);
		mysqli_query($con, $sql_minus_credit_frm_acc);
		mysqli_query($con, $sql_user_log);
		return 1;

	} else {
		return 0;
	}

}

function user_info_edit_minus_admin($prev_user_name, $new_name, $new_pass, $new_credit, $newvaliddate)
{

	$today = date('y-m-d h:m:i');
	$user_creator_info_result = $_SESSION['_u_li_'];
	$sql_update_user_info = "update user_info_cat set user_login_name='" . $new_name . "', user_login_pass='" . $new_pass . "',user_allocated_sms_credit=user_allocated_sms_credit-$new_credit,`user_valid_date` = '$newvaliddate' where user_login_name='" . $prev_user_name . "'";
	$sql_minus_credit_frm_total = "update user_info_cat set user_allocated_sms_credit=user_allocated_sms_credit+$new_credit where user_login_name='" . $user_creator_info_result . "'";
	$sql_user_log = "insert into user_crdt_log values('" . $new_name . "','" . $new_credit . "','" . $today . "')";

	if (mysqli_query($con, $sql_update_user_info)) {
		mysqli_query($con, $sql_minus_credit_frm_total);
		mysqli_query($con, $sql_user_log);
		return 1;

	} else {
		return 0;
	}

}
function user_credti_minus($con, $user_id, $sms_num) {
    $sql_minus_user_credit = "UPDATE user_info_cat SET user_allocated_sms_credit = user_allocated_sms_credit - $sms_num WHERE user_login_name = '$user_id'";
    mysqli_query($con, $sql_minus_user_credit);
}



function delete_user($user_login_name)
{

	$sql_delete_user = "delete from user_info_cat where user_login_name='" . $user_login_name . "'";

	if (mysqli_query($con, $sql_delete_user)) {

		return 1;

	} else {
		return 0;
	}
}

function chk_mobile_num($mob_num)
{

	if ((strlen($mob_num) == 13)) {
		return 1;
	} else {
		return 0;
	}
}


function chk_sms_format($sms)
{

	if (($sms != NULL) && (strlen($sms) <= 156)) {
		return 1;
	} else {
		return 0;
	}

}

function scdl_sms_to_db($time, $to, $sms, $admin_id)
{

	//$today=date('y-m-d H:i:s');
	$sql_scdl_grp_sms = "insert into sch_sms_info values ('$time','$to','$sms','$admin_id')";
	$sql_scdl_grp_sms;
	if (mysqli_query($con, $sql_scdl_grp_sms)) {

		return 1;
	} else
		return 0;

}


function send_msg($to, $sms)
{



	$msg = urlencode($sms);


	//die();



	$content = "uid=mmsl&pwd=mmsl123!!&body=$msg&phone[0]=$to";
	$opts = array(
		'http' =>
			array(
				'method' => 'POST',
				'header' => 'Content-type: application/x-www-form-urlencoded',
				'content' => $content
			)
	);

	$context = stream_context_create($opts);

	$reply_text = file_get_contents('http://power-sms.mycitycell.com/powersms/http_api/batchsms.php', false, $context);
	$reply_text;





	return 1;
}

?>