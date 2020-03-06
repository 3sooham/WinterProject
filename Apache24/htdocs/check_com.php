<?
include './dbconn.php';
$id = $_POST['login_id'];
$com_num=$_POST['com_num'];

$query="select 이력서번호 from 이력서 where 회원ID='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$resume_num=$row['이력서번호'];
$query1= "select a.취득점수,b.합격점수 from 예상점수 a inner join 기업 b using(기업번호) where a.이력서번호 = '$resume_num' and b.기업번호 = '$com_num'";
$result1 = mysqli_query($conn,$query1);



while ($row1 = mysqli_fetch_array($result1))
{
  if($row1['취득점수'] >= $row1['합격점수'])
  {
    echo"<script>alert('합격 가능');</script>";

  }
  else {
    echo"<script>alert('불합격');</script>";

  }
}
?>
<script>
   history.go(-1);
</script>
