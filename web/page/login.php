<div class="wrapper">
	<h1>PlanTree - Login</h1>
	<div id="formContent">
		<!-- Tabs Titles -->
		<h2>Sign In</h2>

		<!-- Login Form -->
		<input type="text" id="login-id" name="login" placeholder="ID" onfocus="this.placeholder=''" onblur="this.placeholder='ID'">
		<input type="password" id="login-pw" name="login" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'">
		<input type="submit" id="login-btn" value="Log In">
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("input#login-btn").click(function() {
			var id = $("input#login-id").val();
			var pw = $("input#login-pw").val();

			if (!id || !pw) {
				_alert('안내', '아이디와 비밀번호를 입력해주세요.');
				return false;
			}

			$.post("http://srv3.modaweb.kr/_process.php", {
				act: "login",
				v1: id,
				v2: pw
			},
			function(data, status) {
				_proc(data.rtn, data);
			}, "json");
		});
	});
</script>