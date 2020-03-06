<?

//데이터베이스에 있는 기업 정보 출력
include './dbconn.php';
$id = $_POST['login_id'];
$query="select 이력서번호 from 이력서 where 회원ID='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$resume_num=$row['이력서번호'];

$query="select a.기업번호 from 예상점수 a inner join 기업 b using(기업번호) where 이력서번호='$resume_num' and a.취득점수>=b.합격점수";
$result = mysqli_query($conn, $query);
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

    </form><br>
    <h1>기업 맞춤추천 </h1>

    <table class="list">
      <tr>
        <th>기업명</th> <th>지역</th> <th>합격점수</th> <th>취득점수(예상)</th> <th>요구학점</th> <th>연봉</th> <th>채용일정</th> <th>관심기업 추가</th> <th>상세비교</th>
      </tr>
      <form action="add_favorite_com.php" method="post">
        <input type="hidden" id='a' name="com_num" >
      <?

      while($row = mysqli_fetch_array($result))
      {
        $com_num=$row['기업번호'];
          $query= "select a.기업명,a.지역,a.합격점수,a.요구학점,a.연봉,a.시작날짜,a.종료날짜,b.취득점수 from 기업 a inner join 예상점수 b using(기업번호) where a.기업번호='$com_num' and b.이력서번호='$resume_num'";
           $result2=mysqli_query($conn,$query);
            $row2=mysqli_fetch_array($result2);



            ?> <tr>
              <td><?echo $row2['기업명'] ?></td> <td><?echo $row2['지역'] ?></td> <td><?echo $row2['합격점수'] ?></td> <td><?echo $row2['취득점수']?></td>
              <td><?echo $row2['요구학점'] ?></td> <td><?echo $row2['연봉'] ?>만원</td> <td><?echo $row2['시작날짜'] ?>~ <?echo $row2['종료날짜'] ?></td>
              <td>
                  <form action="add_favorite_com.php" method="post">
                  <input type="hidden" name="login_id" value="<?echo $id?>">
                <input type="submit"  value="관심기업추가" onclick="add_com_num(<?echo $row['기업번호']?>)">
                  </form>
                </td>
                <td>
                  <form  action="compare.php" method="post">
                    <input type="hidden" name="login_id" value="<?echo $id?>">
                    <input type="hidden" name="resume_num" value="<?echo $resume_num?>">
                  <input type="hidden" name="com_num" value="<?echo $row['기업번호']?>">
                      <input type="submit" name="" value="상세비교">
                  </form>
                </td>
                <script>
                //선택한 버튼이몇번째 버튼인지 알아내서 add_favorite_com.php에 전송할 input의  value값 구함
                function add_com_num(x){
                  document.getElementById('a').value=x;
                  }
                </script>
              </td>
            </tr><?

    }
      ?>

    </table>


  </div>
  </body>
</html>
