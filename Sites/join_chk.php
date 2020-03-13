<?
 include "./dbconn.php";

 $id=$_GET['m_id'];

 $query="select count(*) from Members where id='$id'";
 $result=mysql_query($query,$conn);
 $row=mysql_fetch_array($result);


 mysql_close($conn);

?>
<script>
 var row="<?=$row[0]?>";
 if(row==1){
   parent.document.getElementById("chk_id2").value="0";
   parent.alert("누가 이 ID 쓴다 뇌절치지 말고 새거 골라");
 }
 else{
   parent.document.getElementById("chk_id2").value="1";
   parent.alert(" 이 륙 허 가 ");
 }
</script>
