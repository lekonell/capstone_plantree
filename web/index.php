<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';

	if (!$_GET['mode']) $_GET['mode'] = 'main';

	if ($_GET['mode'] == "logout") {
		setcookie('login_id', '', 0, '/');
		setcookie('login_pw', '', 0, '/');
		session_destroy();

		header('Location: http://srv3.modaweb.kr/login');
		exit;
	}

	if ($user == '') { // if unlogged
		if ($_GET['mode'] != 'login') {
			header('Location: http://srv3.modaweb.kr/login');
			exit;
		}
	}
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<title>PlanTree</title>
		<link rel="stylesheet" href="http://srv3.modaweb.kr/css/index.css?<?=$ctime?>">
		<link rel="stylesheet" href="http://srv3.modaweb.kr/css/<?=$_GET['mode']?>.css?<?=$ctime?>">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!-- 
		<link rel="stylesheet" href="http://srv3.modaweb.kr/css/swiper.css">
		<link rel="stylesheet" href="http://srv3.modaweb.kr/css/animate.min.css">
		<link rel="stylesheet" href="http://srv3.modaweb.kr/css/style.css">
		-->
		<!-- <link href="./css/bootstrap/bootstrap.css" rel="stylesheet"> -->
		<script type="text/javascript" src="./js/bootstrap/bootstrap.js"></script>
		<script src="http://srv3.modaweb.kr/js/jquery-1.12.4.min.js"></script>
		<script src="http://srv3.modaweb.kr/js/swiper.min.js"></script>
		<script src="http://srv3.modaweb.kr/js/swiper.animate1.0.2.min.js"></script>
		<script type="text/javascript">
			function _alert(alert_title, alert_content) {
				var overlay = $("#overlay");
				var box = $("#alert");

				if (alert_title == "exit") {
					overlay.css('display', 'none');
					box.css('display', 'none');
					return false;
				}

				box.children("p.title").html(alert_title);
				box.children("p.content").html(alert_content);
				box.show();

				var win = $(window);
				var boxLeft = (win.scrollLeft() + (win.width() / 2)) - (box.width() / 2);
				var boxTop = (win.scrollTop() + (win.height() / 2)) - (box.height() / 2);

				overlay.css( { 'opacity' : '0.5'} );
				overlay.show();

				box.css( { 'left': boxLeft+'px', 'top': boxTop+'px', 'opacity' : '1.0' } );

				$(document).keydown(function (e) {
					if (e.keyCode == '13' || e.keyCode == '27') {
					_alert('exit');
					}
				});

				overlay.click(function() {
					_alert('exit');
				});
			}

			function _proc(code, data) {
				if (code == '000') { _alert('안내', '잘못된 요청입니다.'); }
				else if (code == '100') { location.reload(); }
				else if (code == '200') { location.href = data.url; }
				else if (code == '201') { location.replace(data.url); }
				else if (code == '900') { _alert(data.alert_title, data.alert_content); }
				else if (code == '910') { _alert('exit'); }

				return false;
			}
		</script>
	</head>
	<body>
		<div id="overlay" class="overlay"></div>
		<div id="loading_overlay" class="overlay"></div>
		<div id="alert"><p class="title"></p><p class="content"></p><p class="btn"><span class="btn" onclick="_alert('exit');">확인</span></p></div>
		<?php
		include_once('./page/'.$_GET['mode'].'.php');
		?>
	</body>
</html>