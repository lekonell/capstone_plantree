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

	if (!$_GET['mode']) $_GET['mode'] = 'main';

	if ($_COOKIE['login_id']) {
		$_COOKIE['login_id'] = str_replace(chr(39), '&#039;', $_COOKIE['login_id']);
		$query = $con->query("SELECT * FROM member WHERE `id`= '$_COOKIE[login_id]'");
		$member = $query->fetch_array();

		if ($_COOKIE['login_pw'] == $member['upw']) {
			$_SESSION['user_id'] = $member['uid'];
		}
	}
	else { // if unlogged
		if ($_GET['mode'] != 'login') {
			// header('Location: http://srv3.modaweb.kr/plantree/login');
		}
	}

	$ctime = time();
	$ctime_ymdhis = date('Y-m-d H:i:s', $ctime);
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<title>PlanTree</title>
		<link rel="stylesheet" href="./css/<?=$_GET['mode']?>.css?<?=$ctime?>">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="./css/bootstrap/bootstrap.css" rel="stylesheet">
		<script type="text/javascript" src="./js/bootstrap/bootstrap.js"></script>
	</head>
	<body>
		<?php
		include_once('./page/'.$_GET['mode'].'.php');
		?>
	</body>
</html>