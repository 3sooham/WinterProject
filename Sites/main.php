<?
//로그인 실패 시 회원가입 화면 출력, 로그인 성공 시 메인화면 출력
  include './dbconn.php';
  $id = $_POST['login_id'];
  date_default_timezone_set('Asia/Seoul');
  $today = date("Y-m-d",time());
  $query5= "select a.* from 기업 a inner join 관심기업 b using(기업번호) where 회원ID = '$id'";
  $result5 = mysqli_query($conn, $query5);

?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>subway</title>
<script src="js/javascript.js" charset="utf-8"></script>
<style media="screen">
*{
margin:0;
padding:0;
font-family:'나눔 고딕', 'NanumGothic', Gothic;
}
a{
  text-decoration: none;
}
body{
  width:1600px;
  margin:auto;
  background: #E6E6E6;
}
#PageWrapper{
  background: #FFFFFF;
  margin: 40px 0 40px 0;
  padding: 10px 20px 10px 20px;
  border-radius: 5px;
  box-shadow: 0 2px 6px rgba(100,100,100,0.3);
}
.content{display: inline-block ;width:100px; height:100px; margin: 100px;}
.mainbutton{
  width:100%;
  height:100%;
}
table.list{
  color:#06425C;
  border-spacing: 80px;
  border: 3px solid black;
  -webkit-border-radius: 20px 20px 0 0;
  border-radius: 0 0 20px 20px;
}
tr:last-child{
  -webkit-border-radius: 25px 25px 0 0;
  border-radius: 0 0 20px 20px;
}
tr:last-child>td:first-child {
  -webkit-border-radius: 0 0 0 25px;
  border-radius: 0 0 0 20px;
}

tr:last-child>td:last-child{
  -webkit-border-radius: 0 0 25px 0;
  border-radius: 0 0 25px 0;
}
.com th, .com td{
  margin: 2px;
  padding-bottom: 2px;
}
th{
  text-align: center;
  background: #FFFFFF;
}
</style>
</head>
<body>
<div id="PageWrapper">
  <?
    include './dbconn.php';
    $id=$_POST['login_id'];
    if ($_POST['login_success']) {

  ?>
  <div >
    <form  action="login_form.html" method="post" style="display:inline">
      <input type="submit" value="로그아웃" >
    </form>
    <form action="delete_user.php" method="post" style="display:inline">
      <input type="submit" value="탈퇴"   >
      <input type="hidden" name="login_id" value="<?echo $id?>">
    </form>
  <form action='#' name='reg' method='post' >
      <br>
      <CENTER><?= $_POST['login_id']?> 님 환영합니다. </center><br>
  </form>
  </div>

  <!-- 로그인 성공했을때 보여지는 화면 -->

    <!-- 이력서 관리 페이지 이동 -->
    <form  action="resume.php"  class="content" method="post" >
      <input type='hidden' name='login_id' value="<?echo $id?>">
      <input type="submit" class="mainbutton"  value="이력서관리">
    </form>

    <!-- 기업정보 페이지 이동 -->
      <form  action="com_list.php" class="content"  method="post">
        <input type="hidden" name="login_id" value="<?echo $id?>">
        <input type="submit" class="mainbutton" value="기업정보">
      </form>
 <!-- 관심기업 페이지 -->
 <form  action="favorite_com.php" class="content"  method="post">
   <input type="hidden" name="login_id" value="<?echo $id?>">
   <input type="submit" class="mainbutton" value="관심기업">
 </form>
 <!-- 기업 맞춤 추천 페이지 -->
 <form  action="recommend.php" class="content"  method="post">
   <input type="hidden" name="login_id" value="<?echo $id?>">
   <input type="submit" class="mainbutton" value="기업 맞춤 추천">
 </form><br>

 <form action="check_com.php" method="post">
   <input type="hidden" id='a' name="com_num" >
   <input type='hidden' name='login_id' value='<? echo $id?>'>

 <table class="list">
 <tr>
    <CENTER><?= $_POST['login_id']?> 님의 관심기업일정입니다 .</CENTER>
   <th>기업명</th> <th>시작날짜</th> <th>종료날짜</th> <th>시작까지남은일자</th> <th>종료까지날짜일자</th> <th> 현재 지원가능 여부</th> <th>모의합격 여부</th>
 </tr>
 <br>
 <?
 while($row5 = mysqli_fetch_array($result5))
 {
 ?>
 <tr>
 <td><?echo $row5['기업명'] ?></td> <td><?echo $row5['시작날짜'] ?></td> <td><?echo $row5['종료날짜']?></td>
 <td> <?if(floor((strtotime($row5['시작날짜'])- strtotime($today))/86400)>0)
 {
   echo abs(floor((strtotime($row5['시작날짜'])- strtotime($today))/86400))?>일 후
<?
 }
 else {
   echo abs(floor((strtotime($row5['시작날짜'])- strtotime($today))/86400))?>일 전
<?
 }
 ?> </td>
 <td>
 <?if(floor((strtotime($row5['종료날짜']) - strtotime($today))/86400)>0)
 {
  echo abs(floor((strtotime($row5['종료날짜']) - strtotime($today))/86400))?>일 후
<?
 }
 else {
   echo abs(floor((strtotime($row5['종료날짜']) - strtotime($today))/86400))?>일 전
<?
 }
?>
 </td>
 <td>
 <?
 if(floor((strtotime($row5['시작날짜'])- strtotime($today))/86400) < 0  and floor((strtotime($row5['종료날짜']) - strtotime($today))/86400)>0)
 {
     echo "지원 가능";
 }
 else {
     echo "지원 불가능";
 }
 ?>
 </td>
 <td>
 <input type="hidden" name="login_id" value="<?echo $id?>">
 <input type="submit"  value="모의지원" onclick="add_com_resume_num(<?echo $row5['기업번호']?>)">
 <script>
   function add_com_resume_num(x){
     document.getElementById('a').value=x;
   }
 </script>
 </td>
 </tr>
   <?
 }
 ?>
 </table>
</form>
  <!-- 로그인 실패시 회원가입 화면으로 -->
  <?
  } else {
  ?>

  <form action='register.php' name='reg' method='post'>

        <fieldset>

          <legend>회원가입</legend>


              <label>아이디 : </label> <input type="text" name="m_id"  required/>
              <input type="button" value="id_check" onclick="check_id()"> <br>

           <label>비밀번호 : </label> <input type="password" name="m_pwd"  required/> <br>

            <label>이름 : </label><input type="text" name="m_name"  required/> <br>

            <label>거주지: </label> <input type="text" name="m_addr" required placeholder="00시 00구 00ehd"> <br>

<hr><b>선호 하는 역</b>
                  <input  type="button" value="추가" onclick="add_item()"><br>
                   <div id="pre_set" style="display:none">
                       <label for="">선호 호선</label>
                       <select id = select_line name="sub_line[]" onchange="alert_select_value(this)">
                        <option>select one
                        <option value="line1">1호선
                       	<option value="line2">2호선
                       	<option value="line3">3호선
                       	<option value="line4">4호선
                       	<option value="line5">5호선
                       	<option value="line6">6호선
                       	<option value="line7">7호선
                       	<option value="line8">8호선
                       	<option value="line9">9호선
  		                  <option value="line_Airport">공항철도
  		                  <option value="line_Bundang">분당선
  		                  <option value="line_Center">경의중앙선
  		                  <option value="line_Gyeongchun">경춘선
  		                  <option value="line_Sinbundang">신분당선
  		                  <option value="line_Suin">수인선
                        </select>

                        <label for="">선호 역 </label>
                        <select  id = "select_stat" name="sub_station[]">
                          <option> select one
                        </select>

                        <script>
                        function alert_select_value(select_obj){
                            // 우선 selectbox에서 선택된 index를 찾
                            var selected_index = select_obj.selectedIndex;
                            var selected_value = select_obj.options[selected_index].value;
                            // 원하는 동작을 수행한다. 여기서는 그냥 alert해주는 식으로만 처리
                            var target = document.getElementById("select_stat");
                            var line = new Array();
                            if(selected_value == "line1")
                            {
                              target.options.length = 0;

		                             <? $query = "select Stat_Name from line1";
              	                   $result = mysqli_query($conn, $query);
                	                 while($row = mysqli_fetch_array($result)){
                      	           ?>//change the here
                                      var opt = document.createElement("option");
                                      var optText = document.createTextNode('<?echo $row['Stat_Name']?>');
                                      alert();
                                      opt.appendChild(optText);
                                      alert(opt.firstChild);
                                      target.appendChild(opt);

                                	<?   } ?>
                            }

                          }
                          </script>
                      <input type="button" value="삭제" onclick="remove_item(this)">
                    </div>
                     <div id="field"></div>
                    <input type="button" value="회원가입" onclick="reg.submit()">

        </fieldset>
      </form>
    <?
    }
    ?>

</div>

</body>
</html>
