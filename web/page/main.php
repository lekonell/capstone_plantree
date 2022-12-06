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
			<h2 id="title">식물 등록</h2>
		</div>
		
		<div id="inf_area">
			<h3 class="txt">식물 정보</h3>
			
			<table id="inf_table">
			<tr>
			<td class='head'>별명</td>
			<td><input type="text" name="name" size="10" style="width:70%;" placeholder="10자 이하"></td>
			</tr>
			<tr>
			<td class='head'>식물종</td>
			<td><input type="text" name="plant" size="20" style="width:70%;" placeholder="20자 이하"></td>
			</tr>
			<tr>
			<td class='head'>사진</td>
				<td><input type="file" id="real-input" accept="image/*" required multiple></td>
			</tr>
			</table>
			
			<div style="display: flex; justify-content: center;">
				<button class="btn1" type="button">등록</button>
			</div>
		</div>
		
		<div id="dis_area">
			<h3 class="txt">병해충 예상순위</h3>
			
			<table id="dis_table">
			<tr>
				<td class='head'>1순위</td>
				<td>XXX (72.30%)</td>
			</tr>
			<tr>
			<td class='head'>2순위</td>
			<td>XXX (72.30%)</td>
			</tr>
			<tr>
			<td class='head'>3순위</td>
			<td>XXX (72.30%)</td>
			</tr>
			</table>
			
			<div style="display: flex; justify-content: center;">
				<button class="btn1" type="button">알아보기</button>
			</div>
		</div>
	</div>
</div>