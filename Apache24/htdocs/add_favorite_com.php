<?

//관심기업 추가0
include './dbconn.php';
$id = $_POST['login_id'];
// $com_num=$_POST['com_num'];
$com_num=$_POST['com_num'];
echo $id;
echo $com_num;
  $query="insert into 관심기업 values('$id','$com_num')";
  mysqli_query($conn,$query);

echo "<script>alert('관심기업추가')</script>";
// echo "<form action='com_list.php' name='goback' method='post'> ";
// echo "<input type='hidden' name='login_id' value='$id'> </form> ";
// echo "<script> document.goback.submit(); </script>";

  ?>
  <script>
     history.go(-1);
  </script>
