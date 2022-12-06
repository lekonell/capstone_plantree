<div id="menu_bar">
	<div id="my">
		<img id="my_img" src="https://cdn.pixabay.com/photo/2022/07/07/10/46/woman-7306978_960_720.jpg">
		<h3 id="my_txt">abcd1234 님</h3>
	</div>
	
	<div class="menu">
		<ul>
		<li><a href="#" class="item"><img src="https://cdn-icons-png.flaticon.com/512/628/628297.png"><div>나의 식물</div></a></li>
		<li><a href="#" class="item"><img src="https://cdn-icons-png.flaticon.com/512/628/628297.png"><div>식물 등록</div></a></li>
		<li><a href="#" class="item"><img src="https://cdn-icons-png.flaticon.com/512/628/628297.png"><div>도움말</div></a></li>
		</ul>
	</div>
</div>
<div id="wrapper">
	<div id="main">
		<div id="title_area">
			<h2 id="title">나의 식물</h2>
		</div>
		
		<div id="plant_list_area">
			<h3 class="txt">식물 목록</h3>
			
			<div style="max-height:300px; overflow:auto">
			<table id='plant_list_table'>
			<tr>
				<td class='head'></td>
				<td class='head'>별명</td>
				<td class='head'>식물종</td>
				<td class='head'>병해충</td>
				<td class='head'>관리</td>
			</tr>
			<script>
			for(j=0;j<2;j++){
				document.writeln("<tr>")
				document.writeln("<td><img id='plant_photo' src='https://cdn-icons-png.flaticon.com/512/1668/1668377.png'></td>")
				document.writeln("<td>" + "노랑이" + "</td>")
				document.writeln("<td>" + "개나리" + "</td>")
				document.writeln("<td>" + "탄저병" + "</td>")
				document.writeln("<td><button type='button'>보기</button></td>")
				document.writeln("</tr>")
			}
			</script>
			</table>
			</div>
		</div>
		
		<div id="plant_area">
			<h3 class="txt">식물 관리</h3>
			
			<div style="max-height:400px; overflow:auto">
			<table id="date_table">
				<th colspan="2">최근 물 준 주기</th>
				<script>
				for(i=1;i<10;i++){
					document.writeln("<tr>")
					document.writeln("<td class='head'>"+ i + "</td>")
					document.writeln("<td>2022/11/22</td>")
					document.writeln("</tr>")
				}
				</script>
			</table>
			</div>
			
			<div style="display: flex; justify-content: center;">
				<button class="btn1" type="button">추가</button>
			</div>
		</div>
	</div>
</div>