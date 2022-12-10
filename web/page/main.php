<div id="menu_bar">
	<div id="my">
		<img id="my_img" src="https://cdn.pixabay.com/photo/2022/07/07/10/46/woman-7306978_960_720.jpg">
		<h4 id="my_txt">abcd1234 님</h4>
	</div>
	
	<div class="menu">
	<ul>
		<li><a href="/" class="item"><img src="https://cdn-icons-png.flaticon.com/512/628/628297.png"><div>나의 식물</div></a></li>
		<li><a href="/add" class="item"><img src="https://cdn-icons-png.flaticon.com/512/628/628297.png"><div>식물 등록</div></a></li>
	</ul>
	</div>
</div>

<div id="wrapper">
	<div id="main">
	<div id="title_area">
		<h3 id="title">나의 식물</h3>
	</div>
	
	<div id="list_area">
	<h4 class="txt">식물 목록</h4>
	
		<div id="plant_list">
		<ul>
			<script>
			for(i=0; i<5; i++){
				document.writeln("<li><a href='/my/1'><img src='https://ifh.cc/g/PD4dtM.png'/><div>식물 별명</div></a></li>")
			}
			</script>
			<li><a href='/add'><img src='https://cdn-icons-png.flaticon.com/512/4210/4210903.png'/><div>식물 등록</div></a></li>
		</ul>
		</div>
		
	</div>
	</div>
</div>