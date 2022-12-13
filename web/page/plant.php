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

<?php
	$q = $con->query("SELECT * FROM plants WHERE `id` = '$_GET[id]'");
	$plant = mysqli_fetch_array($q);
?>

<div id="wrapper">
	<div id="main">
		<div id="plant_area">
			<h4 class="title">Plant Information</h4>

			<div id="plant_icon">
				<img src='http://srv3.modaweb.kr/images/icon_<?=$plant['icon']?>.png'>
			</div>

			<div id="plant_inf">
				<table>
					<tr>
						<td class="head">별명</td>
						<td><?=$plant['name']?></td>
					</tr>
					<tr>
						<td class="head">식물종</td>
						<td><?=$plant['category']?></td>
					</tr>
				</table>
			</div>
		</div>

		<div id="water_area">
			<h4 class="title">Watering Information</h4>

			<div id="water_icon">
				<ul>
					<li>
						<a href="">
							<img src='https://cdn-icons-png.flaticon.com/512/2514/2514527.png'>
							<div>↑ 클릭 시 물 주기 ↑</div>
						</a>
					</li>
				</ul>
			</div>

			<div id="water_inf">
				<ul class="inf_list">
					<!-- <li>날짜</li> -->
					<?php
						$q = $con->query("SELECT date FROM watering WHERE `pid` = '$plant[id]'
																	ORDER BY `id` desc
																	Limit 5");
						$i = 0;
						while ($d = mysqli_fetch_array($q)) {
							$i = $i + 1;
							?>
							<li><?=$i?>) <?=$d['date']?></li>
							<?php
						}
					?>
				</ul>
			</div>
		</div>

		<div id="dis_area">
			<h4 class="title">Pests Test</h4>
			
			<form id="photo_form">
				<div id="photo_upload">
					<label for="photo">Upload Photo</label>
					<input type="file" id="photo" name="photo" accept="image/*">
				</div>
			</form>

			<!-- 파일 업로드 시 나타남 -->
			<div id="dis_inf">
				<ul class="inf_list">
					<li class="inf_1">test (12.54%)</li>
					<li class="inf_2">test (12.54%)</li>
					<li class="inf_3">test (12.54%)</li>
				</ul>

				<div>
					<a id="btn_dns_inf" class="btn-1" target="_blank">View More</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("input#photo").change(function() {
			var formData = new FormData($('#photo_form')[0]);

			$('.overlay').addClass('active');

			$.ajax({
				url: 'http://srv3.modaweb.kr:4416/',
				contentType : false,
				processData : false,
				type: 'POST',
				data: formData,
				success: function(data) {
					data = JSON.parse(data);

					var pestMarked = false;

					for (var i = 1; i <= 3; i++) {
						var pest = data[i - 1].split('|')[0];
						pest = pest.toLowerCase();

						if (pest.indexOf('healthy') != -1) pest = '건강함';
						if (pest.indexOf('black_rot') != -1) pest = '검은썩음병';
						if (pest.indexOf('scab') != -1) pest = '검은별무늬병';
						if (pest.indexOf('cedar_rust') != -1) pest = '붉은별무늬병';
						if (pest.indexOf('common_rust') != -1) pest = '녹병';
						if (pest.indexOf('cercospora') != -1) pest = '갈색둥근무늬병';
						if (pest.indexOf('leaf_blight') != -1) pest = '잎마름병';
						if (pest.indexOf('late_blight') != -1) pest = '잎마름역병';
						if (pest.indexOf('early_blight') != -1) pest = '겹무늬병';
						if (pest.indexOf('powdery_mildew') != -1) pest = '흰가루병';
						if (pest.indexOf('bacterial_spot') != -1) pest = '세균성구멍병';
						if (pest.indexOf('target_spot') != -1) pest = '겹동근무늬병';
						if (pest.indexOf('yellow_leaf_curl') != -1) pest = '황화잎말림병';
						if (pest.indexOf('ceptoria_leaf') != -1) pest = '흰색반점병';
						if (pest.indexOf('spider_mite') != -1) pest = '잎응애';
						if (pest.indexOf('leaf_mold') != -1) pest = '잎곰팡이병';
						if (pest.indexOf('leaf_scorch') != -1) pest = '붉은무늬병';
						if (pest.indexOf('haunglongbing') != -1) pest = '황룡병';
						if (pest.indexOf('black_measles') != -1) pest = '꼭지마름병';
						if (pest.indexOf('septoria_leaf') != -1) pest = '흰무늬병';
						if (pest.indexOf('mosaic_virus') != -1) pest = '모자이크병';

						var prob = Math.floor(data[i - 1].split('|')[1] * 10000) / 100;
						$('div#dis_inf').find(`li.inf_${i}`).text(`${i}. ${pest} (${prob}%)`);

						if (pest != '건강함' && !pestMarked) {
							pestMarked = true;
							$('a#btn_dns_inf').attr('href', `https://ncpms.rda.go.kr/npms/SicknsInfoListR.np?sSearchWord=${pest}`);
						}
					}

					if (!pestMarked) {
						$('a#btn_dns_inf').css('display', 'none');
					}
					else {
						$('a#btn_dns_inf').css('display', 'inline-block');
					}

					$('div#dis_inf').css('display', 'flex');
					$('.overlay').removeClass('active');
				},
				error: function(data) {
					$('.overlay').removeClass('active');
					$('div#dis_inf').css('display', 'none');
					_alert('안내', '전송 실패');
				}
			});
		});

		$("#water_icon a").click(function() {
			var pid = <?=$plant['id']?>;

			$.post("http://srv3.modaweb.kr/_process.php", {
				act: "watering",
				v1: pid
			},
			function(data, status) {
				_proc(data.rtn, data);
			}, "json");
		});

		$("btn_dis_inf").click(function() {
			
		});
	});
</script>