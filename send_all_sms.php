<?php
session_start();
require "function.php";
// include('db.php');
// echo $user_name;
// die();

if (isset($_SESSION["_u_li_"])) {
    $login_user_name = $_SESSION["_u_li_"];
    $user_type_code = chk_user_type($con, $login_user_name);
?>

<?php include "header.php"; ?>

<div id="menus_wrapper">
    <?php include "menu.php"; ?>
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
                    <h2>Send ENGLISH Free SMS</h2>
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
                                        <div class="dashboard_menu_wrapper">
                                            <br /><br />
                                            <form name="send_single_sms" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="search_form general_form">
                                                <fieldset>
                                                    <div class="forms">

                                                        <!--[if !IE]>start row<![endif]-->
                                                        <div class="row">
                                                            <label>Mobile Number: &nbsp;</label>
                                                            <div class="inputs">
                                                                <span class="input_wrapper">
                                                                    <textarea rows="10" name="to_num" cols="22" class="text"></textarea>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <label>Write SMS:</label>
                                                            <div class="inputs">
                                                                <span class="input_wrapper textarea_wrapper">
                                                                    <textarea rows="" name="text" cols="" class="text" onKeyPress="return taLimit(this)" onKeyUp="return taCount(this, 'myCounter')"></textarea>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <p style="margin-left:450px;">You have <b><span id="myCounter" style="color:#06F;">160</span></b> characters remaining...</p>

                                                        <div style="margin-left:40px;">
                                                            <div class="row">
                                                                <div class="buttons">
                                                                    <ul style="list-style:none;">
                                                                        <li><span class="button orange_btn"><span><span>SEND SMS</span></span><input name="send_sms_submit" type="submit" /></span></li>
                                                                        <li><span class="button red_btn"><span><span>RESET</span></span><input name="" type="reset" /></span></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </fieldset>
                                            </form>
                                            <?php
                                            $msg = "";

                                            if (isset($_REQUEST["send_sms_submit"])) {
                                                $to_num = trim($_REQUEST["to_num"]);
                                                $msisdn = str_replace("\r\n", " ", $to_num);
                                                $msisdn = str_replace("  ", " ", $msisdn);
                                                $to_num1 = $msisdn;
                                                $find = explode(" ", $to_num1);
                                                $find1 = implode(" ", $find);
                                                $mobile_numbers = explode(" ", $find1);
                                                $n = count($mobile_numbers);

                                                $sms = $_REQUEST["text"];
                                                $lang = "English";
                                                $num_of_sending_sms = $n;

                                                if (chk_sms_credit($con, $num_of_sending_sms, $_SESSION["_u_li_"]) == 1) {
                                                    if (chk_valid_date($con, $_SESSION["_u_li_"]) == 1) {
                                                        for ($i = 0; $i < $n; $i++) {
                                                            $telco_ID = get_telcoID($mobile_numbers[$i]);
                                                            $sender = $login_user_name;
                                                            $to = $mobile_numbers[$i];

                                                            $firsttwo = substr($to, 0, 2);
                                                            if ($firsttwo != "88") {
                                                                $to = "88" . $to;
                                                            }

                                                            $date = date("Y-m-d H:i:s");
                                                            $sql = "INSERT INTO mt_log (sender, Mob_To, sms, date_time, telco_id, lang) VALUES ('$sender', '$to', '$sms', '$date', '$telco_ID', '$lang')";
                                                            $sqlsend = "INSERT INTO metro_send_sms_log (sender, Mob_To, sms, date_time, status, lang) VALUES ('$sender', '$to', '$sms', '$date', '1', '$lang')";
                                                            // echo $sqlsend;
                                                            // die;
                                                            mysqli_query($con, "SET NAMES 'UTF8'");
                                                            mysqli_query($con, $sql);
                                                            $res = mysqli_query($con, $sqlsend);
                                                            if ($res) {
                                                                user_credti_minus($con, $login_user_name, 1);
                                                                $msg = "SMS SEND Successfully";
                                                            } else {
                                                                sms_log($mobile_numbers[$i], "  Failed!!!!!  " . $sms, $login_user_name);
                                                                $msg = "SMS SENDING FAILED";
                                                            }
                                                        }
                                                    } else {
                                                        $msg = "Date Expired";
                                                    }
                                                } else {
                                                    $msg = "SMS CREDIT OVERFLOW. CHECK YOUR REMAINING CREDIT.";
                                                }
                                            }
                                            ?>
                                            <center style="color:red; text-decoration:blink; text-shadow:#999 1px; font-weight:bold;"><?php echo $msg; ?></center>
                                        </div>
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
        </div>
    </div>
    <!--[if !IE]>end page<![endif]-->
    <!--[if !IE]>start sidebar<![endif]-->
    <?php include "side_footer.php"; ?>
    <?php
} else {
    $_SESSION["_log_in_error_"] = 1;
    header("Location: index.php");
}
?>
