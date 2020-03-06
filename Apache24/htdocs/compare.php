<?

//데이터베이스에 있는 기업 정보 출력
include './dbconn.php';
$id = $_POST['login_id'];
$resume_num=$_POST['resume_num'];
$query="select 이력서번호 from 이력서 where 회원ID='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$resume_num=$row['이력서번호'];
$com_num=$_POST['com_num'];

$query="select 학점,요구학점,합격점수,기업명 from 이력서,기업 where 이력서번호='$resume_num' and 기업번호='$com_num'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_array($result);
  $com_name=$row['기업명'];
  $avgNeed=$row['요구학점'];
  $avg=$row['학점'];
  $scoreNeeded=$row['합격점수'];
  $query="select 취득점수 from 예상점수 where 이력서번호='$resume_num' and 기업번호='$com_num'";
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_array($result);
  $get_score=$row['취득점수'];
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
    table.list{
      color:#06425C;
      border-spacing: 55px;
      border: 3px solid black;
      -webkit-border-radius: 25px 25px 0 0;
      border-radius: 0 0 25px 25px;
    }
    tr:last-child{
      -webkit-border-radius: 25px 25px 0 0;
      border-radius: 0 0 25px 25px;
    }
    tr:last-child>td:first-child {
      -webkit-border-radius: 0 0 0 25px;
      border-radius: 0 0 0 25px;
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
    <script>
    function goback(){
       history.go(-1);}
    </script>
  </head>
  <body>
    <div id="PageWrapper">
      <form  action="login_form.html" method="post" style="display:inline">
        <input type="submit" value="로그아웃" >
      </form>
        <button type="button" name="button" style="display:inline" onclick="goback()">이전</button><br>
    <h1>상세비교</h1><br>
    <div class="" style="display:inline-block;width:50%;">
      <h2>기업명 : <?echo $com_name ?></h2><br>
      <h3>학점 : <?echo $avg?> </h3><br>
      <h3>우대 자격증</h3><br>
      <? // 해당 기업의 가산점 정보
        $query="select a.가산점,b.자격증이름 from 자격증가산점  a inner join 자격증 b using(자격증번호) where 기업번호='$com_num'";
        $result=mysqli_query($conn,$query);
        while($row=mysqli_fetch_array($result))
        {
          $cert_name=$row['자격증이름'];
          $plus_score=$row['가산점'];
            echo "자격증이름: $cert_name 가산점: $plus_score <br>";
        }
        ?>
    <br>  <h3>우대 대외활동</h3> <br>
    <? // 해당기업에서 우대취급 해주는 대외활동
        $query="select 활동종류,활동기간,가산점 from 우대대외활동 where 기업번호='$com_num'";
        $result=mysqli_query($conn,$query);
        while($row=mysqli_fetch_array($result)){
          $act_type=$row['활동종류']; $act_period=$row['활동기간']; $plus_score=$row['가산점'];
          echo "활동종류: $act_type 활동기간(최소): $act_period 개월 가산점: $plus_score <br>";
        }
    ?> <br>
    <h3>우대 어학능력</h3> <br>
    <? //기업에서 우대하는 어학능력
      $query="select 어학시험이름,점수,급수,가산점 from 어학가산점 where 기업번호=$com_num";
      $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_array($result))
      {
        $test_name=$row['어학시험이름']; $score=$row['점수']; $grade=$row['급수']; $plus_score=$row['가산점'];
          if($score==0)
          {
            echo "어학명: $test_name 우대 급수(최소):$grade 가산점: $plus_score <br>";
          }
          else if($grade==0){
            echo "어학명 :$test_name 우대 점수(최소):$score 가산점: $plus_score <br>";
          }
      }
    ?><br>
    <h2>합격 필요 점수 : <?echo $scoreNeeded ?></h2>
    </div>

    <div class="" style="display:inline-block;width:40%;">
      <h2>회원</h2><br>
      <h3>요구학점: <?echo $avgNeed?></h3><br>
      <h3>소유 자격증</h3><br>
      <? //해당회원의 소유자격증 출력
        $query="select b.자격증이름 from 소유자격증 a inner join 자격증 b using(자격증번호) where a.이력서번호='$resume_num'";
        $result2=mysqli_query($conn,$query);
        while($row2=mysqli_fetch_array($result2))
        {
          $cert_name=$row2['자격증이름'];
          echo "자격증이름 : $cert_name <br>";
        }
      ?>
    <br>   <h3>대외활동</h3> <br>
      <?
      $query="select 활동종류,기관명,활동기간 from 대외활동 where 이력서번호='$resume_num'";
      $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_array($result)){
        $act_type=$row['활동종류']; $act_period=$row['활동기간']; $org_name=$row['기관명'];
        echo "활동종류: $act_type 기관명: $org_name 활동기간: $act_period 개월  <br>";
    }?> <br>
    <h3>보유 어학능력</h3> <br>
    <? //회원이 보유한 어학능력
      $query="select 어학시험이름,점수,등급 from 어학능력 where 이력서번호=$resume_num";
      $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_array($result))
      {
        $test_name=$row['어학시험이름']; $score=$row['점수']; $grade=$row['급수'];
          if($score==0)
          {
            echo "어학명: $test_name 급수: $grade <br>";
          }
          else if($grade==0){
            echo "어학명 :$test_name 점수: $score <br>";
          }
      }
    ?> <br>
    <h2>예상 취득점수: <?echo $get_score ?></h2>
    </div>

    </div>
  </body>
</html>
