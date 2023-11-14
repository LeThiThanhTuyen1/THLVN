<?php
	include 'config.php';
	//hủy session theo tên
	unset($_SESSION['user']);
	// hủy toàn bộ session 
	//session_destroy();
	header('location: sanbong.php');
?>