<?
  include './dbconn.php';

  $id = $_POST['login_id'];
  $pwd = $_POST['login_pwd'];

  $query = "select 회원ID, 회원pwd from 회원 where 회원ID = '$id'";
  $result = mysqli_query($conn, $query);
  $num = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result);


  if ($num) {
    if ($pwd == $row['회원pwd']) {
      echo "<script>alert('로그인 성공')</script>";
      echo "<form action='main.php' name='login' method='post'><input type='hidden' name='login_success' value='1'> ";
      echo "<input type='hidden' name='login_id' value='$id'> </form> ";
      echo "<script> document.login.submit(); </script>";
    } else {
      echo "<script>alert('비번 오류'); history.go(-1);</script>";
    }

  } else {
    echo "<script>alert('ID 없음, 가입창으로'); location.href='main.php';</script>";
  }


?>
