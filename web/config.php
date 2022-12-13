<?php
	ob_start();
	session_start();

	$GLOBAL_SESSION_LIFETIME = 60 * 60 * 24;
	session_set_cookie_params($GLOBAL_SESSION_LIFETIME, '/');
	session_cache_expire($GLOBAL_SESSION_LIFETIME / 60);

	$con = mysqli_connect('localhost', 'app_plantree', 'app_plantree');
	mysqli_select_db($con, 'app_plantree');
	$con->query('SET NAMES utf8');
	$con->query('SET CHARACTER SET utf8');
	$con->query("SET SESSION sql_mode = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");

	$SALT = 'dd8f1b35463aab9426d39f457417209b';
	$SALT2 = '7c317a007d9ffa750a97779ecbfb7fb4';
	function enchash($key) {
		return md5(sha1($SALT).sha1($SALT2).$key);
	}

	$ctime = time();
	$ctime_ymdhis = date('Y-m-d H:i:s', $ctime);
	
	$user = '';

	if ($_COOKIE['login_id'] != "") {
		$user_id = $_COOKIE['login_id'];

		$user_id = str_replace(chr(39), '&#039;', $user_id);
		$query = $con->query("SELECT * FROM member WHERE `uid` = '$user_id'");
		$member = $query->fetch_array();

		if ($_COOKIE['login_pw'] == $member['upw']) {
			$_SESSION['uid'] = $member['uid'];
			$user = $member;
		}
		else {
			setcookie('login_id', '', 0, '/');
			setcookie('login_pw', '', 0, '/');
			session_destroy();

			header('Location: http://srv3.modaweb.kr/login');
			exit;
		}
	}
?>