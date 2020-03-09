<?
  //회원가입때 입력한 정보를 데이터베이스에 입력하는 코드
  include './dbconn.php';

  $member_number = 1;
  $id = $_POST['m_id'];
  $pwd = $_POST['m_pwd'];
  $name = $_POST['m_name'];
  $addr =$_POST['m_addr']; //near_station

  $mil_service=$_POST['m_mil_service']; //병역
  $disorder=$_POST['m_disorder']; //장애여부
  //회원정보
  $query = "select * from Members where id = '$id'";
  $result = mysqli_query($conn, $query); // query to DB
  $row = mysqli_fetch_array($result);// query result from DB;
  if($id == $row['id'])
  {
    echo "<script>alert('ID is wndqhr'); history.go(-1);</script>";// id wndqhr
  }
  else
  {

    $query = "insert into Members values ('$member_number', '$id', '$pwd', '$name','$addr')";
    //$query2="insert into 이력서(회원ID,학점,병역,장애) values('$id','$avg','$mil_service','$disorder')";
    mysqli_query($conn, $query); //회원 table에 정보삽입
    //mysqli_query($conn,$query2); //이력서에 정보삽입
    $member_number++;
    //회원 ID와 일치하는 이력서번호 구하기
    $sub_line=$_POST['sub_line'];  //지하철 호선 (배열)
    $sub_station=$_POST['sub_station'];//지하철 역명(배열)
    for($i=1;$i<count($sub_station);$i++) //지하철 역 표시한 수만큼
    {
        $query="insert into //선호 테이블 명 (Stat_line, Stat_Name) values('$sub_line[$i]','$sub_station[$i]')";
        mysqli_query($conn, $query);
    }

  }

?>
  <script>
        alert("회원가입 완료");
       location.href='login_form.html';


</script>
