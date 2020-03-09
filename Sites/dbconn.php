<?
//db 연동 코드
     $host_name = "localhost:3306";
     $db_user_id = "root";
     $db_pwd = "0000";
     $db_name = "winterproject";
     $conn = mysqli_connect($host_name, $db_user_id, $db_pwd, $db_name);
	
     /* check connection */
     if ($conn->connect_error) {
       printf("Connect failed: %s\n", $conn->connect_error);
       exit();
     }
?>
