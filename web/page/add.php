<div id="menu_bar">
	<div id="my">
		<img id="my_img" src="https://cdn.pixabay.com/photo/2022/07/07/10/46/woman-7306978_960_720.jpg">
		<h4 id="my_txt"><?=$user['uid']?></h4>
	</div>
	
	<div class="menu">
		<ul>
			<li><a href="/" class="item">My Plant</a></li>
			<li><a href="/add" class="item">Add Plant</a></li>
		</ul>
		
		<div>
			<button onclick="location.href='http://srv3.modaweb.kr/logout';" class="btn-2">Logout</button>
		</div>
	</div>
</div>

<div id="wrapper">
	<div id="main">
		<div id="inf_area">
			<h4 class="title">Plant Registration</h4>

			<div id="inf_table">
				<div class="input-data">
					<input type="text" name="name">
					<label>별명</label>
				</div>

				<div class="input-data">
					<input type="text" name="category">
					<label>식물종</label>
				</div>
			</div>
			
			<div class="icon_select">
				<p>아이콘 선택</p>
				<input checked="checked" id="icon1" type="radio" name="icon" value="1"/>
				<label class="select icon1" for="icon1" 
				style="background:url('http://srv3.modaweb.kr/images/icon_1.png'); background-size:90px;"></label>
	
				<script>
					for(i=2; i<13; i++){
						document.write('<input id="icon' + i + '" type="radio" name="icon" value="' + i + '"/>')
						document.write('<label class="select icon' + i + '"for="icon' + i)
						document.write('"style="background:url(http://srv3.modaweb.kr/images/icon_' + i)
						document.write('.png); background-size:90px;"></label>')
					}
				</script>
			</div>

			<div style="display: flex; justify-content: center;">
				<input type="submit" id="add-btn" class="btn-1" value="등록">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("input#add-btn").click(function() {
			var name = $('input[name="name"]').val();
			var category = $('input[name="category"]').val();
			var icon = $('input[name="icon"]:checked').val();
			icon = parseInt(icon);

			if (!name || !category) {
				_alert('안내', '별명, 식물종을 입력해주세요.');
				return false;
			}

			$.post("http://srv3.modaweb.kr/_process.php", {
				act: "add",
				v1: name,
				v2: category,
				v3: icon
			},
			function(data, status) {
				_proc(data.rtn, data);
			}, "json");
		});
	});
</script>