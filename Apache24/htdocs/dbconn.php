<?
     $host_name = "localhost";
     $db_user_id = "root";
     $db_pwd = "0000";
     $db_name = "make";
     $conn = mysqli_connect($host_name, $db_user_id, $db_pwd, $db_name);

     /* check connection */
     if ($conn->connect_error) {
       printf("Connect failed: %s\n", $conn->connect_error);
       exit();
     }
?>
