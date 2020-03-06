<?
include './dbconn.php';
$id = $_GET['id'];
$query="delete from 회원 where 회원ID='$id'";
mysqli_query($conn, $query);

echo" <script>
    alert('회원탈퇴완료');
    location.href='./login_form.html';
    </script>
    ";
  ?>
