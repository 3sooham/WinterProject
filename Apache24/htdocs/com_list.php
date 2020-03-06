<?

//데이터베이스에 있는 기업 정보 출력
include './dbconn.php';
$id = $_POST['login_id'];
$query= "select * from 기업";
$result=mysqli_query($conn,$query);
  ?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/basicstyle.css">
    <style media="screen">
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
    <h1>기업정보 </h1>
    <form action="search.php" method="post">
          <input type='hidden' name='login_id' value='<? echo $id?>'>
      <label>학점 : </label> <input  type="number" name="m_avg"  min=0 max=4.5 step="0.1" >
      <label>합격점수:</label> <input type="number" name="m_grade" value="" >
      <label>지역 : </label> <input type="text" name="m_addr" value ="">
      <label>희망연봉(최소):</label> <input type="number" name="m_want_salary" value="" placeholder="단위 : 만" min:0>
      <label>모집일정:</label> <input type="date" name="start_date">
      <input type="submit" value="검색"><br>
    </form>
    <table class="list">
      <tr>
        <th>기업명</th> <th>지역</th> <th>합격점수</th> <th>요구학점</th> <th>연봉</th> <th>모집일정</th> <th>관심기업 추가</th> <th>상세비교</th>
      </tr>
      <?
      while($row=mysqli_fetch_array($result))
      {


        ?>
        <tr>
          <td><?echo $row['기업명'] ?></td> <td><?echo $row['지역'] ?></td> <td><?echo $row['합격점수'] ?></td>
          <td><?echo $row['요구학점'] ?></td> <td><?echo $row['연봉'] ?>만원</td> <td><?echo $row['시작날짜'] ?>~ <?echo $row['종료날짜'] ?></td>
          <td>
            <form action="add_favorite_com.php" method="post">
              <input type="hidden" id='a' name="com_num" value="<?echo $row['기업번호']?>" >
              <input type='hidden' name='login_id' value='<? echo $id?>'>
              <input type="submit"  value="관심기업추가" >
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
        </tr><?
      }
      ?>

    </table>
  </div>
  </body>
</html>
