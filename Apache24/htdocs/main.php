<?
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
<title>이력서관리시스템</title>
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


              <label>아이디 : </label> <input type="text" name="m_id"  required/> <br>

           <label>비밀번호 : </label> <input type="password" name="m_pwd"  required/> <br>

            <label>이름 : </label><input type="text" name="m_name"  required/> <br>

            <label>나이 : </label> <input type="text" name="m_age"  required> <br>

            <label>거주지: </label> <input type="text" name="m_addr" required placeholder="00시 00구"> <br>


          <hr><b>이력서작성</b> <br>
          <label>학점 : </label> <input  type="number" name="m_avg"  min=0 max=4.5 step="0.1" required/><br>
        <label>경력 : </label> <input id='a' type="radio" name="m_exp" value="1" onclick="show_button()">유 <input id='b' type="radio" name="m_exp" value="0" onclick="hide_button()" >무
        <input id='c' type="button" value="추가" style="display:none" onclick="add_item()"><br>
          <div id="pre_set" style="display:none">
                  기업명:<input type="text" name="c_name[]" value="" style="width:200px" placeholder="근무했던 기업" required> 재직기간: <input type="number" name="work_period[]" value="" placeholder="단위:월" min=0  required>
                  직급/직책: <input type="text" name="position[]" value=""> 직무: <select  name="j_type[]">
                    <? $query="select 직무이름 from 직무";
                      $result=mysqli_query($conn,$query);
                      while($row2=mysqli_fetch_array($result))
                      {
                        ?><option value="<?echo $row2['직무이름']?>"> <?echo $row2['직무이름']?>
                  <?    } ?>

                  </select>

                  <input type="button" value="삭제" onclick="remove_item(this)">
        </div>
        <div id="field"></div>

                  <hr><b>대외활동</b>
                <input  type="button" value="추가"  onclick="add_item2()"><br>
                  <div id="pre_set2" style="display:none">
                      <label for="">활동종류</label>
                      <select  name="act_type[]">
                          <option value="인턴">인턴
                          <option value="자원봉사">자원봉사
                          <option value="교내활동">교내활동
                      </select>
                      <label for="">기관명: </label> <input type="text" name="org_name[]" value="">
                      <label for="">활동기간: </label> <input type="number" name="act_period[]" value="" min=0 placeholder="단위: 월">
                      <input type="button" value="삭제" onclick="remove_item2(this)">
                </div>
                <div id="field2"></div>

            <hr><b>소유 자격증</b>       <br>
         <label>자격증 선택: </label>
           <select name="m_cert[]" multiple size=5>
            <? $query = "select 자격증이름 from 자격증";
              $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result)){
                      ?>   <option value="<?echo $row['자격증이름']?>"><?echo $row['자격증이름']?>
            <?   } ?>
          </select>
            (컨트롤 누르고 다중선택가능) <br>
            <hr><b>어학능력</b>   <br>
            <input  type="button" value="추가"  onclick="add_item3()"><br>
            <div id="pre_set3" style="display:none">
                <label for="">종류</label>
                <select name="lang[]">
                  <? $query = "select 어학시험이름 from 어학";
                    $result = mysqli_query($conn, $query);
                      while($row = mysqli_fetch_array($result)){
                            ?>   <option value="<?echo $row['어학시험이름']?>"><?echo $row['어학시험이름']?>
                  <?   } ?>
                </select>

                <label for="">점수: </label> <input type="number" name="grade_point[]" value="" min =0 placeholder="토익,토플,JPT " required>
                <label for="">급수: </label> <input type="number" name="rating[]" value="" min = 1 placeholder="단위: 급" required>
                <input type="button" value="삭제" onclick="remove_item3(this)">
          </div>
            <div id="field3"></div>

            <hr><b>취업우대/병역</b><br>
              <label >장애</label> <select name="m_disorder"> <option value="X">X <option value="1급">1급
                <option value="2급">2급<option value="3급">3급<option value="4급">4급<option value="5급">5급
                <option value="6급">6급</select>
              <label>병역</label> <select name="m_mil_service">  <option value="군필">군필
                <option value="미필">미필 <option value="면제">면제 <option value="해당없음">해당없음

              </select>
          <hr><b>희망근무조건</b> <br>
            <label>고용형태</label> <select  name="m_emp_type"  required> <option value="정규직">정규직 <option value="계약직">계약직
                  <option value="인턴직">인턴직 <option value="파견직">파견직
            </select>
            <label>희망연봉(최소):</label> <input type="number" name="m_want_salary" value="" placeholder="단위 : 만" min:0 required> <br>
            <label >희망근무지1</label> <input type="text" name="want_place[]" value="" placeholder="지역이름 ex) 서울" required>
            <label >희망근무지2</label> <input type="text" name="want_place[]" value="" required>
            <label >희망근무지3</label> <input type="text" name="want_place[]" value="" required> <br>

            <input type="button" value="회원가입" onclick="reg.submit()">

        </fieldset>
      </form>
    <?
    }
    ?>

</div>

</body>
</html>
