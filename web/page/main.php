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
		<div id="list_area">
		<h4 class="title">Plant List</h4>
		
			<div id="plant_list">
				<ul>
					<?php
						$q = $con->query("SELECT * FROM plants WHERE `uid` = '$user[id]'");
						while ($d = mysqli_fetch_array($q)) {
							?>
							<li><a href='/plant/<?=$d['id']?>'><img src='http://srv3.modaweb.kr/images/icon_<?=$d['icon']?>.png'/><div><?=$d['name']?></div></a></li>
							<?php
						}
					?>
					<li><a href='/add'><img src='https://cdn-icons-png.flaticon.com/512/4210/4210903.png'/><div>식물 등록</div></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>