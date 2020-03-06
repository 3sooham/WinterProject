<?

//데이터베이스에 있는 기업 정보 출력
  include './dbconn.php';
  $id = $_POST['login_id'];
  $avg = $_POST['m_avg'];
  $grade = $_POST['m_grade'];
  $addr = $_POST['m_addr'];
  $salary = $_POST['m_want_salary'];
  $start = $_POST['start_date'];
  $end = $_POST['end_date'];
  $query= "select * from 기업 where
  지역 Like '%$addr%' and 연봉 >'$salary' and 요구학점 > '$avg' ";
  $result=mysqli_query($conn,$query);

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

  <h1>검색결과 </h1>
  <form action="add_favorite_com.php" method="post">
    <input type="hidden" id='a' name="com_num" >
    <input type='hidden' name='login_id' value='<? echo $id?>'>

  <table class="list">
    <tr>
      <th>기업명</th> <th>지역</th> <th>합격점수</th> <th>요구학점</th> <th>연봉</th> <th>채용일정</th> <th>관심기업 추가</th>
    </tr>
<?
while($row=mysqli_fetch_array($result))
{
  ?> <tr>
    <td><?echo $row['기업명'] ?></td> <td><?echo $row['지역'] ?></td> <td><?echo $row['합격점수'] ?></td>
    <td><?echo $row['요구학점'] ?></td> <td><?echo $row['연봉'] ?>만원</td> <td><?echo $row['시작날짜'] ?>~ <?echo $row['종료날짜'] ?></td>
    <td>
      <form action="add_favorite_com.php" method="post">
            <input type="hidden" id='a' name="com_num" value="<?echo $row['기업번호']?>" >
            <input type='hidden' name='login_id' value='<? echo $id?>'>
      <input type="submit"  value="관심기업추가">
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

<?
}
?>
</table>
</div>
</body>
