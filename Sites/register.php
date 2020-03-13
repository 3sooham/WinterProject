<?
  //회원가입때 입력한 정보를 데이터베이스에 입력하는 코드
  include './dbconn.php';
  $id = $_POST['m_id'];
  $ps = $_POST['m_pwd'];
  $name = $_POST['m_name'];
  $addr =$_POST['m_addr'];
  //회원정보
  $query = "select * from Members where id = '$id'";
  $result = mysqli_query($conn, $query); // query to DB
  $row = mysqli_fetch_array($result);// query result from DB;
  /*if($id == $row['id'])
  {
    echo "<script>alert('중복된 ID'); history.go(-1);</script>";// id wndqhr
	//중복으로 바꿈 0309
}
  else
  {*/
     //near_station
    $query = "insert into Members values ('$id', '$ps','$addr','$name')";
    //$query2="insert into 이력서(회원ID,학점,병역,장애) values('$id','$avg','$mil_service','$disorder')";
    mysqli_query($conn, $query); //회원 table에 정보삽입
    //mysqli_query($conn,$query2); //이력서에 정보삽입
    //회원 ID와 일치하는 이력서번호 구하기
    $sub_line1=$_POST['sub_line1'];
    $sub_line2=$_POST['sub_line2'];
    $sub_line3=$_POST['sub_line3'];


    $sub_station1=$_POST['sub_station1'];//지하철 역명(배열)
    $sub_station2=$_POST['sub_station2'];
    $sub_station3=$_POST['sub_station3'];

    $query1 = "insert into Saved_staions(Member_id, Station, Station_line) values('$id','$sub_station1','$sub_line1')";
    $query2 = "insert into Saved_staions(Member_id, Station, Station_line) values('$id','$sub_station2','$sub_line2')";
    $query3 = "insert into Saved_staions(Member_id, Station, Station_line) values('$id','$sub_station3','$sub_line3')";
    mysqli_query($conn, $query1);
    mysqli_query($conn, $query2);
    mysqli_query($conn, $query3);
  #}

?>
  <script>
        alert("회원가입 완료");
       location.href='login_form.html';


</script>
