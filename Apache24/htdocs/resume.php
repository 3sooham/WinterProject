<?
include './dbconn.php';
$id=$_POST['login_id'];
$query=" select a.이름,a.나이,a.거주지,b.이력서번호,
 b.학점,b.경력,b.병역,b.장애,b.기본가산점
 from 회원 a inner join 이력서 b using(회원ID) where 회원ID= '$id'";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$resume_num=$row['이력서번호'];
 ?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
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

    </style>
    <script src="js/javascript.js" charset="utf-8"></script>
  </head>
  <body>
    <div id="PageWrapper">
    <form  action="login_form.html" method="post" style="display:inline">
      <input type="submit" value="로그아웃" >
    </form>
    <form  action="main.php" method="post" style="display:inline">
      <input type='hidden' name='login_success' value='1'>
      <input type='hidden' name='login_id' value='<? echo $id?>'>
      <input type="submit" value="메인" >
    </form>
    <h1>이력서 관리 </h1>
    <form action="update_resume.php" name="res" method="post">
    <fieldset>
      <legend>내 이력서</legend>
          <input type='hidden' name='login_id' value='<? echo $id?>'>
        이름 : <?echo $row['이름']?> <br>
        나이 : <?echo $row['나이']?> <br>
        거주지: <input type="text" name="m_addr" value="<?echo $row['거주지'] ?>"required > <br>
      학점 :<?echo $row['학점']?>점 <br>
    <hr><b>경력</b>
    <input  type="button" value="추가"  onclick="add_item();update_exp()"> <!-- 새로운 경력 추가버튼 -->

    <script>
      function update_exp(){

      <? if($row['경력']==0) $query="update 이력서 set 경력=1 where 회원ID='$id'"; //이력서의 경력속성=1 로 변경
      mysqli_query($conn, $query);
      ?>
      }
    </script>
      <? // 경력이 있다면
      if($row['경력']==1) { ?> <br> <?
          $query="select * from 경력 where 이력서번호='$resume_num'";
          $result = mysqli_query($conn, $query);
          while($row2 = mysqli_fetch_array($result))
          {
            ?>기업명:<?echo $row2['기업명']?> 재직기간: <?echo $row2['재직기간']?>개월
            직급/직책:<?echo $row2['직급직책']?> 직무:<?echo $row2['직무']?>
           <br> <?}
        }
        else echo ":없음";
          ?>
          <!--  새로운 경력 추가 -->

            <div id="pre_set" style="display:none">
                    기업명:<input type="text" name="c_name[]" value="" style="width:200px" placeholder="근무했던 기업" required>
                    재직기간: <input type="number" name="work_period[]" value="" placeholder="단위:월" min=0  required>
                    직급/직책: <input type="text" name="position[]" value=""> 직무:<select  name="j_type[]">
                      <? $query="select 직무이름 from 직무";
                        $result=mysqli_query($conn,$query);
                        while($row2=mysqli_fetch_array($result))
                        {
                          ?><option value="<?echo $row2['직무이름']?>"> <?echo $row2['직무이름']?>
                    <?    } ?>

                    </select> <br>
                <input type="button" value="삭제" onclick="remove_item(this)">
          </div>
            <div id="field"></div>
          <br>

          <hr><b>대외활동내역</b> <input  type="button" value="추가"  onclick="add_item2()"><br>
          <?
            $query="select 활동종류,기관명,활동기간 from 대외활동 where 이력서번호='$resume_num'";
            $result= mysqli_query($conn,$query);
            while($row2=mysqli_fetch_array($result))
            {
              ?>활동종류: <?echo $row2['활동종류']?> 기관명: <?echo $row2['기관명']?> 활동기간: <?echo $row2['활동기간']?>개월 <br>
            <?}
          ?>

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

          <hr>
     <b>소유 자격증</b>
        <?
         $query ="select b.자격증이름 자격증이름 from 소유자격증 a inner join 자격증 b using(자격증번호) where a.이력서번호='$resume_num'";
        $result = mysqli_query($conn, $query);
        while($row2 = mysqli_fetch_array($result)){
            ?>  <ul style="margin-left:50px">
              <li>   <?echo $row2['자격증이름']; ?>    </li>
            </ul>
            <?}
              ?> <br>
     <b>추가할 자격증</b>
       <select name="m_cert[]" multiple size=5 >
              <?
              $query="select 자격증이름 from 자격증 where 자격증이름 not in (select b.자격증이름 자격증이름 from 소유자격증 a inner join
              자격증 b using(자격증번호) where a.이력서번호='$resume_num')";
              $result = mysqli_query($conn, $query);
              while($row = mysqli_fetch_array($result)){
                    ?>   <option value="<?echo $row['자격증이름']?>"><?echo $row['자격증이름']?>
          <?   } ?>

      </select>
      <br>
      <hr>
      <b>소유 어학능력</b>
      <?
        $query="select * from 어학능력 where 이력서번호='$resume_num'";
        $result= mysqli_query($conn,$query);
        while($row2=mysqli_fetch_array($result))
        {
          ?><ul style="margin-left:50px">
          시험이름: <?echo $row2['어학시험이름']?> 점수: <?echo $row2['점수']?> 등급: <?echo $row2['등급']?>급 <br>
          </ul>
        <?}
      ?>
      <b>추가할 어학능력</b>
      <input  type="button" value="추가"  onclick="add_item3()"><br>
      <div id="pre_set3" style="display:none">
        <label for="">종류</label>
        <select name="lang[]">
          <? $query = "select 어학시험이름 from 어학 where 어학시험이름 not in(select 어학시험이름 from 어학능력 where 이력서번호='$resume_num')";
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

      <br>
      <b>수정할 어학능력</b>
    
      <select name="lang1[]">
        <? $query = "select 어학시험이름 from 어학 where 어학시험이름 in(select 어학시험이름 from 어학능력 where 이력서번호='$resume_num')";
          $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)){
                  ?>   <option value="<?echo $row['어학시험이름']?>"><?echo $row['어학시험이름']?>
        <?   } ?>
      </select>

     <label for="">점수: </label> <input type="number" name="grade_point1[]" value="" min =0 placeholder="토익,토플,JPT " required>
     <label for="">급수: </label> <input type="number" name="rating1[]" value="" min = 1 placeholder="단위: 급" required>


      <hr><b>취업우대/병역</b><br>
      <? $query="select * from 이력서 where 회원ID='$id'";
        $result = mysqli_query($conn, $query);
        $row2=mysqli_fetch_array($result);
      ?>
        장애: <?echo $row2['장애']?>

      <select name="m_disorder"> <option value="X">X <option value="1급">1급
          <option value="2급">2급<option value="3급">3급<option value="4급">4급<option value="5급">5급
          <option value="6급">6급</select> <br>
        병역:<?echo $row2['병역']?>
        <!-- 병역 수정-->
         <select name="m_mil_service">  <option value="군필">군필 </option>
          <option value="미필">미필 <option value="면제">면제 <option value="해당없음">해당없음 </select> <br>
        가산점:  <?echo $row2['기본가산점']?>점
        <br>
        <hr><b>희망근무조건</b> <br>
        <?
        $query="select * from 희망근무조건 where 이력서번호='$resume_num'";
          $result = mysqli_query($conn, $query);
          $row2=mysqli_fetch_array($result);
        ?>
          희망 고용형태(현재): <?echo $row2['고용형태']?> <br>
          <label>희망 고용형태</label>
          <select  name="m_emp_type"  required> <option value="정규직">정규직 <option value="계약직">계약직
                <option value="인턴직">인턴직 <option value="파견직">파견직
          </select>
          <label>희망연봉(최소):</label> <input type="number" name="m_want_salary" value="<?echo $row2['희망연봉']?>"  min:0 required> <br>

          <?$query="select * from 희망근무지 where 이력서번호='$resume_num'";
            $result = mysqli_query($conn, $query);
            $i=1;
            while($row2=mysqli_fetch_array($result))
            {
              ?>희망근무지<?echo $i++?>: <input type="text" name="want_place[]" value="<?echo $row2['희망근무지']?>" required>
            <?}
          ?>
          <br>
  <input type="button" value="수정" onclick="res.submit()">
    </fieldset>
  </form>
</div>
  </body>
</html>
