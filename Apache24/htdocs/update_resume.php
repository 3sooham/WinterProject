<?php
  include './dbconn.php';
$id=$_POST['login_id'];
$addr =$_POST['m_addr'];
$exp=$_POSt['m_exp']; //경력여부
$avg=$_POST['m_avg']; //학점

$mil_service=$_POST['m_mil_service']; //병역
$disorder=$_POST['m_disorder']; //장애여부
 //거주지 수정
  $query="update 회원 set 거주지='$addr' where 회원ID='$id'";
  mysqli_query($conn, $query);
  //경력여부 수정

  //이력서번호 가져오기
  $query="select 이력서번호 from 이력서 where 회원ID='$id'";
  $result=mysqli_query($conn, $query); //회원 ID와 일치하는 이력서번호 저장
  $row= mysqli_fetch_array($result);
  $resume_num=$row['이력서번호'];

  //새로운 경력 추가
  $c_name= $_POST['c_name']; //기업이름(배열)
  $work_period=$_POST['work_period'];//재직기간(배열)
  $position=$_POST['position'];//직급/직책(배열)
  $j_type=$_POST['j_type'];//직종(배열)
  for($i=1;$i<count($c_name);$i++) //경력 개수만큼 테이블에 추가
  {
      $query="insert into 경력(이력서번호,기업명,재직기간,직급직책,직무) values('$resume_num','$c_name[$i]','$work_period[$i]','$position[$i]','$j_type[$i]')";
       mysqli_query($conn, $query);
  }
  //대외활동 추가
    $act_type=$_POST['act_type'];  //활동종류(배열)
    $org_name=$_POST['org_name'];//기관명(배열)
    $act_period=$_POST['act_period']; //활동기간(배열)
    for($i=1;$i<count($org_name);$i++) //대외활동 겸험 수만큼
    {
        $query="insert into 대외활동(이력서번호,활동종류,기관명,활동기간) values('$resume_num','$act_type[$i]','$org_name[$i]','$act_period[$i]')";
         mysqli_query($conn, $query);
    }
  //자격증 추가
  $arr=$_POST['m_cert']; //소유자격증에 추가할 자격증(다중값) 배열
  foreach($arr as $item)
    {
      $query="select 자격증번호 from 자격증 where 자격증이름='$item'"; //자격증번호에 일치하는 자격증번호 검색
      $result=mysqli_query($conn, $query); // 자격증번호 저장
      $row = mysqli_fetch_array($result);
      $cert_num=$row['자격증번호'];
    //  echo $row['자격증번호'];
     $query2="insert into 소유자격증 values('$resume_num','$cert_num')";
     mysqli_query($conn, $query2); //소유자격증 테이블에 정보삽입
    }
    //자격증삭제
  //  $arr2=$_POST['m_cert_del']; //소유자격증에서 삭제할 자격증 배열
    // foreach($arr2 as $item)
    // {
    //   $query="select 자격증번호 from 자격증 where 자격증이름='$item'"; //자격증번호에 일치하는 자격증번호 검색
    //   $result=mysqli_query($conn, $query); // 자격증번호 저장
    //   $row = mysqli_fetch_array($result);
    //   $cert_num=$row['자격증번호'];
    //   $query2="delete from 소유자격증 where 이력서번호='$resume_num' and 자격증번호='$cert_num'";
    //   mysqli_query($conn, $query2); //소유자격증 테이블에서 정보 자격증삭제
    // }

    //어학능력 추가
    $lang=$_POST['lang'];
    $grade_point=$_POST['grade_point']; //어학점수
    $rating=$_POST['rating'];//급수
    for($i=1;$i<count($lang);$i++) //자격증 수만큼
    {
      echo($lang[$i]);
        $query = "insert into 어학능력(이력서번호,어학시험이름,점수,등급) values('$resume_num','$lang[$i]','$grade_point[$i]','$rating[$i]')";
        mysqli_query($conn, $query);
      //  echo mysqli_error($conn);
    }


    $lang1=$_POST['lang1'];
    $grade_point1=$_POST['grade_point1']; //어학점수
    $rating1=$_POST['rating1'];


    for($i=0;$i<count($lang1);$i++) //자격증 수만큼
    {

    $query1 = "update 어학능력 set 점수 = '$grade_point1[$i]',등급 = '$rating1[$i]' where 이력서번호 = '$resume_num' and 어학시험이름 = '$lang1[$i]'";
    mysqli_query($conn, $query1);
    }
      //병역, 장애에 따른 추가 가산점
      $plus_score=0;
      // 병역에 따른 가산점
      if($mil_service =='군필')
        {
          $plus_score+=5;
        }

        //장애 여부에 따른 기본가산점
      if($disorder=='1급'){$plus_score+=12;}
      else if($disorder=='2급'){$plus_score+=10;}
      else if($disorder=='3급'){$plus_score+=8;}
      else if($disorder=='4급'){$plus_score+=6;}
      else if($disorder=='5급'){$plus_score+=4;}
      else if($disorder=='6급'){$plus_score+=2;}
      //획득 가산점 업데이트
          $query="update 이력서 set 기본가산점='$plus_score' where 이력서번호='$resume_num'";
          $query2="update 이력서 set 병역='$mil_service' where 이력서번호='$resume_num'";
          $query3="update 이력서 set 장애='$disorder' where 이력서번호='$resume_num'";
           mysqli_query($conn, $query);
           mysqli_query($conn,$query2);
           mysqli_query($conn,$query3);

    //희망근무조건 수정
    $emp_type=$_POST['m_emp_type']; //희망고용형태
    $want_salary=$_POST['m_want_salary']; // 희망연봉
    $query="update 희망근무조건 set 고용형태='$emp_type',희망연봉='$want_salary' where 이력서번호='$resume_num'";
    mysqli_query($conn, $query);
    $want_place=$_POST['want_place'];// 희망근무지(배열);
    $query="delete from 희망근무지 where 이력서번호='$resume_num'";
    mysqli_query($conn, $query);
    foreach($want_place as $item)
    {
      $query="insert into 희망근무지 values('$resume_num','$item')";
      mysqli_query($conn, $query);
    }

    //각 기업(30개) 마다  받을 수 있는 예상점수( 배열 선언)
    $my_score=array($plus_score,$plus_score,$plus_score,$plus_score,$plus_score,$plus_score,$plus_score,
    $plus_score,$plus_score,$plus_score,$plus_score,$plus_score,$plus_score,$plus_score,$plus_score,
    $plus_score,$plus_score,$plus_score,$plus_score,$plus_score,$plus_score,$plus_score,$plus_score,
    $plus_score,$plus_score,$plus_score,$plus_score,$plus_score,$plus_score,$plus_score);

    $query="select 요구학점 from 기업";
    $result=mysqli_query($conn,$query);
    $avgNeeded=array();
    while($row=mysqli_fetch_array($result))
    {
        $avgNeeded[]=$row['요구학점'];
    }

    for($i=0;$i<30;$i++)
    { // 내학점이 기업의 권장학점을 넘을경우 가산점 10점 부여;
        if($avg>=$avgNeeded[$i]) $my_score[$i]+=10;
    }

    // for($i=0;$i<30;$i++)
    // {
    //   echo "$i : $my_score[$i] <br>";
    // }
    // 회원이 보유한 자격증의 자격증번호 검색
      $query="select 자격증번호 from 소유자격증 where 이력서번호='$resume_num'";
      $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_array($result))
      {
          $cert_num=$row['자격증번호'];
          $query="select 기업번호,가산점 from 자격증가산점 where 자격증번호='$cert_num'";
          $result2=mysqli_query($conn,$query);
          while($row2=mysqli_fetch_array($result2))
          {
            $my_score[$row2['기업번호']-1]+=$row2['가산점'];
          }
      }

      // 경력에 따른 가산점 부여
      $query="select 재직기간,직무 from 경력 where 이력서번호='$resume_num'";
      $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_array($result))
      {
        //3개월이상의 경력을 지니고 있고 경력과 같은 종류의 직무를 뽑는 기업이 있따면
          if($row['재직기간']>=3)
          {
            $job_type=$row['직무'];
            //나의 경력(직무)와 일치하는 직무를 뽑는  기업의 기업번호 검색
            $query="select a.기업번호 from 채용직무 a inner join 직무 b on a.직무번호=b.직무번호 where 직무이름='$job_type'";
            $result2=mysqli_query($conn,$query);
            while($row2=mysqli_fetch_array($result2))
            {
              //가산점 10점 부여
              $my_score[$row2['기업번호']-1]+=10;
            }
          }
      }

      //대외활동 가산점 부여
      $query="select 활동종류,활동기간 from 대외활동 where 이력서번호='$resume_num'";
      $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_array($result))
      {
        $act_type=$row['활동종류'];
        $act_period=$row['활동기간'];
        $query="select 기업번호, 가산점 from 우대대외활동 where 활동종류='$act_type' and 활동기간<='$act_period'";
        $result2=mysqli_query($conn,$query);
          while($row2=mysqli_fetch_array($result2))
          {
            $my_score[$row2['기업번호']-1]+=$row2['가산점'];
          }
      }
      //어학능력 가산점 부여
      $query= "select 어학시험이름,점수,등급 from 어학능력 where 이력서번호=$resume_num";
      $result=mysqli_query($conn,$query);
      while($row=mysqli_fetch_array($result))
      {
        $test_name=$row['어학시험이름'];
        $score=$row['점수'];
        $grade=$row['등급'];
        $query="select 기업번호,점수,급수,가산점 from 어학가산점 where 어학시험이름='$test_name' and 점수<='$score' and 급수>='$grade'";
        $result2=mysqli_query($conn,$query);

          while($row2=mysqli_fetch_array($result2))
          {
            // 기업에서 제시하는 점수/급수보다 높으면 가산점 부여
                  $my_score[$row2['기업번호']-1]+=$row2['가산점'];
            }
          }
      for($i=0;$i<30;$i++)
      {
          $j=$i+1;
          $query="update 예상점수 set 취득점수='$my_score[$i]' where 이력서번호='$resume_num' and 기업번호='$j'";
         mysqli_query($conn,$query);
      }

?>

<form action='resume.php' name='return' method='post'>
     <input type='hidden' name='login_id' value='<? echo $id?>'>
       </form>
   <script>  alert("이력서 수정완료");
       document.return.submit();
   </script>
