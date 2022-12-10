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
         <h3 id="title">식물 등록</h3>
       </div>
       
       <div id="inf_area">
        <h4 class="txt">식물 정보</h4>
         
        <table id="inf_table">
          <tr>
           <td class='head'>별명</td>
           <td><input type="text" name="name" size="10" style="width:90%; border:none;" placeholder="10자 이하"></td>
          </tr>
          <tr>
           <td class='head'>식물종</td>
           <td><input type="text" name="plant" size="20" style="width:90%; border:none;" placeholder="20자 이하"></td>
          </tr>
        </table>
        
       <div class="icon_select">
         <p>아이콘 선택</p>
          <input checked="checked" id="icon1" type="radio" name="icon" value="icon1"/>
          <label class="select icon1" for="icon1"></label>
          <input id="icon2" type="radio" name="icon" value="icon2"/>
          <label class="select icon2"for="icon2"></label>
         <input id="icon3" type="radio" name="icon" value="icon3"/>
          <label class="select icon3"for="icon3"></label>
         <input id="icon4" type="radio" name="icon" value="icon4"/>
          <label class="select icon4"for="icon4"></label>
       </div>
           
        <div style="display: flex; justify-content: center;">
             <button class="btn1" type="button">등록</button>
        </div>
       </div>
     </div>
   </div>