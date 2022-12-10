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
	
    <div id="plant_area">
      <h4 class="txt">식물 정보</h4>
          
      <div id="plant_icon">
        <img src='https://ifh.cc/g/PD4dtM.png'>
      </div>

      <div id="plant_inf">
          <ul class="inf_list">
            <li><a href="">별명 : 노랑이</a></li>
            <li><a href="">식물종 : 개나리</a></li>
            <li><a href="">병해충 : 검사안함</a></li>
          </ul>
      </div>
    </div>

    <div id="water_area">
      <h4 class="txt">물 주기 정보</h4>

      <div id="water_icon">
        <ul><li><a href="">
          <img src='https://cdn-icons-png.flaticon.com/512/2514/2514527.png'>
          <div>↑ 클릭 시 물 주기 ↑</div>
        </a></li></ul>
      </div>

      <div id="water_inf">
        <ul class="inf_list">
          <script>
            for (i=0; i<5; i++){
              document.writeln("<li><a href=''>2022/11/22</a></li>")
            }
          </script>
        </ul>
      </div>
    </div>

    <div id="dis_area">
      <h4 class="txt">병해충 검사</h4>
      
      <div id="photo_upload">
        <label for="photo">사진 업로드</label>
        <input type="file" id="photo" name="photo" accept="image/*">
      </div>

      <!-- 파일 업로드 시 나타남 -->
      <div id="dis_inf">
        <div id="dis_txt">병해충 예상순위</div>

        <ul class="inf_list">
          <script>
            for (i=0; i<3; i++){
              document.writeln("<li><a href=''>탄저병 (54.13%)</a></li>")
            }
          </script>
        </ul>

        <button class="btn1">알아보기</button>
      </div>
    </div>
	</div>
</div>