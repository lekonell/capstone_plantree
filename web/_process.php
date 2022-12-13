<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';

	//if (!$_POST['act'] && $_GET['act']) $_POST['act'] = $_GET['act'];

	/*
	v1 user_id
	v2 user_password
	*/
	if ($_POST['act'] == "login") {
		if (!$_POST['v1'] || !$_POST['v2']) {
			echo '{"rtn":"000"}';
			exit;
		}

		$password = enchash($_POST['v2']);

		$q = $con->query("SELECT * FROM member WHERE `uid` = '$_POST[v1]'");
		$d = $q->fetch_array();

		if (!$d) {
			$q = "INSERT INTO member SET `uid` = '$_POST[v1]',
											`upw` = '$password',
											`date` = '$ctime_ymdhis'";
			$con->query($q);
		}
		else {
			if ($password != $d['upw']) {
				echo '{"rtn":"900", "alert_title":"안내", "alert_content":"비밀번호가 다릅니다."}';
				exit;
			}
		}

		setcookie("login_id", $_POST['v1'], time() + 60*60*24*365, "/");
		setcookie("login_pw", $password, time() + 60*60*24*365, "/");
		$_SESSION['uid'] = $d['uid'];

		echo '{"rtn":"201", "url":"http://srv3.modaweb.kr/"}';
		exit;
	}


	/*
	v1 plant_name
	v2 plant_category
	v3 plant_icon
	*/
	if ($_POST['act'] == "add") {
		if (!$_POST['v1'] || !$_POST['v2'] || !$_POST['v3']) {
			echo '{"rtn":"000"}';
			exit;
		}

		$q = $con->query("INSERT INTO plants SET `uid` = '$user[id]',
												`name` = '$_POST[v1]',
												`category` = '$_POST[v2]',
												`icon` = '$_POST[v3]',
												`date` = '$ctime_ymdhis'");

		$last_id = mysqli_insert_id($con);

		echo '{"rtn":"201", "url":"http://srv3.modaweb.kr/plant/'.$last_id.'"}';
		exit;
	}


	/*
	v1 plant_id
	*/
	if ($_POST['act'] == "watering") {
		$q = $con->query("INSERT INTO watering SET `pid` = '$_POST[v1]',
												`date` = '$ctime_ymdhis'");

		echo '{"rtn":"100", "url":"http://srv3.modaweb.kr/plant/'.$_POST[v1].'"}';
		exit;
	}
?>