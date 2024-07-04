<?php
session_start();


if (isset($_SESSION['_u_li_'])){

		unset($_SESSION['_u_li_']);
		unset($_SESSION['_u_li_pass_']);
		header("Location: index.php");
		}
	else {  header("Location: index.php"); }
?>