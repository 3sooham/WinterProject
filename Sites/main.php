<?
//로그인 실패 시 회원가입 화면 출력, 로그인 성공 시 메인화면 출력
  include './dbconn.php';
  $id = $_POST['login_id'];
  date_default_timezone_set('Asia/Seoul');
  $today = date("Y-m-d",time());

?>




<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>subway</title>
<script src="js/javascript.js?ver=getTime()" charset="utf-8"></script>
<script src = "http://code.jquery.com/jquery-1.12.1.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<style media="screen">
*{
margin:0;
padding:0;
font-family:'나눔 고딕', 'NanumGothic', Gothic;
}
a{
  text-decoration: none;
}
body{
  width:1600px;
  margin:auto;
  background-image: url('autumn.jpg');
  background-size: cover;
}
#PageWrapper{
  background: rgba(255,255,255,.7);
  margin: 40px 0 40px 0;
  padding: 10px 20px 10px 20px;
  border-radius: 5px;
  box-shadow: 0 2px 6px rgba(100,100,100,0.3);
}
.content{display: inline-block ;width:100px; height:100px; margin: 100px;}
.mainbutton{
  width:100%;
  height:100%;
		 background-color:rgba(192,131,100,0.8);
}
table.list{
  color:#06425C;
  border-spacing: 80px;
  border: 3px solid black;
  -webkit-border-radius: 20px 20px 0 0;
  border-radius: 0 0 20px 20px;
}
tr:last-child{
  -webkit-border-radius: 25px 25px 0 0;
  border-radius: 0 0 20px 20px;
}
tr:last-child>td:first-child {
  -webkit-border-radius: 0 0 0 25px;
  border-radius: 0 0 0 20px;
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
  <?
    include './dbconn.php';
    $id=$_POST['login_id'];
    if ($_POST['login_success']) {

  ?>
  <div >
    <form  action="login_form.html" method="post" style="display:inline">
      <input type="submit" value="로그아웃" >
    </form>
    <form action="delete_user.php" method="post" style="display:inline">
      <input type="submit" value="탈퇴"   >
      <input type="hidden" name="login_id" value="<?echo $id?>">
    </form>
  <form action='#' name='reg' method='post' >
      <br>
      <CENTER><?= $_POST['login_id']?> 님 환영합니다. </center><br>
  </form>
  </div>

  <!-- 로그인 성공했을때 보여지는 화면 -->

    <!-- 이력서 관리 페이지 이동 -->
    <form  action="resume.php"  class="content" method="post" >
      <input type='hidden' name='login_id' value="<?echo $id?>">
      <input type="submit" class="mainbutton"  value="이력서관리">
    </form>

    <!-- 기업정보 페이지 이동 -->
      <form  action="com_list.php" class="content"  method="post">
        <input type="hidden" name="login_id" value="<?echo $id?>">
        <input type="submit" class="mainbutton" value="기업정보">
      </form>
 <!-- 관심기업 페이지 -->
 <form  action="favorite_com.php" class="content"  method="post">
   <input type="hidden" name="login_id" value="<?echo $id?>">
   <input type="submit" class="mainbutton" value="관심기업">
 </form>
 <!-- 기업 맞춤 추천 페이지 -->
 <form  action="recommend.php" class="content"  method="post">
   <input type="hidden" name="login_id" value="<?echo $id?>">
   <input type="submit" class="mainbutton" value="기업 맞춤 추천">
 </form><br>

<foram action= "check_com.php" method="post">
  <input type="hidden" id = 'a' name = "com_num">
  <input type="hidden" name= 'login_id' value='<? echo $id?>'>

</form><br>
<?
$query = "select Station from Saved_staions where Member_id = '$id';";
$result = mysqli_query($conn,$query);

$diff = 0;
$AreaName ="";

while($row = mysqli_fetch_array($result))
{
  if($diff++ !=0)
  {
    $AreaName .=",";
  }
  $AreaName .="'".$row['Station']."'";
}
?>
 <script>
   var subway = new Array(<?=$AreaName?>);
   var urlstr = "http://swopenapi.seoul.go.kr/api/subway/7862795572646961353765574d596a/json/realtimeStationArrival/0/24/";
   var urls = urlstr.concat(encodeURI(subway[0]));

     $(document).ready(function(){
       updateData();
     });

     function updateData(){

       $.ajax({
       url : urls ,              //ajax로 ajax_xml.xml파일을 불러온다.
       cache: false,                     //사용자캐시를 사용할 것인가.
       dataType: "json",                  //서버로부터 받을 것으로 예상되는 데이터 타입.
       success: function(data){          //ajax요청을 통해 반환되는 데이터 data.
         showtable(data);
       }
     });
     setTimeout("updateData()", 30000); // 15초 단위로 갱신 처리
   }

   function showtable(data) {
         var div = document.getElementById('wrap');
         var line;
         console.log(data);
         html = '<table>';
         html += '<th>호선</th> <th>운행방면 </th> <th>열차 번호</th> <th>도착 시간</th> <th>다음 열차</th> <th>그 다음 열차</th> <th>열차 상황</th> </tr>';
         for (var j = 0; j < data.realtimeArrivalList.length; j++){
             if(data.realtimeArrivalList[j].subwayId == '1001')
             {
               line = 1;
             }
             if(data.realtimeArrivalList[j].subwayId == '1002')
             {
               line = 2;
             }
             if(data.realtimeArrivalList[j].subwayId == '1003')
             {
               line = 3;
             }
             if(data.realtimeArrivalList[j].subwayId == '1004')
             {
               line = 4;
             }
             if(data.realtimeArrivalList[j].subwayId == '1005')
             {
               line = 5;
             }
             if(data.realtimeArrivalList[j].subwayId == '1006')
             {
               line = 6;
             }
             if(data.realtimeArrivalList[j].subwayId == '1007')
             {
               line = 7;
             }
             if(data.realtimeArrivalList[j].subwayId == '1008')
             {
               line = 8;
             }
             if(data.realtimeArrivalList[j].subwayId == '1009')
             {
               line = 9;
             }
             html += '<tr><td>' + line + '</td><td>' + data.realtimeArrivalList[j].trainLineNm + '</td><td>' + data.realtimeArrivalList[j].btrainNo + '</td><td>' + data.realtimeArrivalList[j].recptnDt
                     + '</td><td> ' + data.realtimeArrivalList[j].arvlMsg2 + '</td><td>' + data.realtimeArrivalList[j].arvlMsg3 + '</td><td> ' + data.realtimeArrivalList[j].arvlCd +  '</td></tr>';
         }
         html += '</table>';

         div.innerHTML = html;
     }

 </script>
</form>

 <table class="list" id ="wrap">
 <tr>
    <CENTER><?= $id ?> 님의 관심 역 정보입니다 .</CENTER>
 </tr>
 <br>


 </td>

 </tr>
 </table>
</form>
  <!-- 로그인 실패시 회원가입 화면으로 -->
  <?
  } else {
  ?>

  <form action='register.php' name='reg' method='post'>

        <fieldset>

          <legend>회원가입</legend>


              <label>아이디&nbsp;&nbsp;&nbsp;&nbsp;: </label> <input type="text" name="m_id" id= 'chk_id1' required/>
              <input type="button" value="id_check" onclick="check_id()"> <br>
              <input type= "hidden" id ="chk_id2" name = chk_id2 value ="0">

           <label>비밀번호 : </label> <input type="password" name="m_pwd"  required/> <br>

            <label>이름<pre>&nbsp;</pre>: </label><input type="text" name="m_name"  required/> <br>

            <label>거주지: </label> <input type="text" name="m_addr" required placeholder="00시 00구 00ehd"> <br>

<hr><b>선호 하는 역</b><br>
  <?php
  $line1 = array();

  $query= "select Stat_Name from line1";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line1 ,$row['Stat_Name']);
  }

  $line2 = array();
  $query= "select Stat_Name from line2";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line2 ,$row['Stat_Name']);
  }
  $line3 = array();
  $query= "select Stat_Name from line3";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line3 ,$row['Stat_Name']);
  }
  $line4 = array();
  $query= "select Stat_Name from line4";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line4 ,$row['Stat_Name']);
  }
  $line5 = array();
  $query= "select Stat_Name from line5";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line5 ,$row['Stat_Name']);
  }
  $line6 = array();
  $query= "select Stat_Name from line6";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line6 ,$row['Stat_Name']);
  }
  $line7 = array();
  $query= "select Stat_Name from line7";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line7 ,$row['Stat_Name']);
  }
  $line8 = array();
  $query= "select Stat_Name from line8";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line8 ,$row['Stat_Name']);
  }
  $line9 = array();
  $query= "select Stat_Name from line9";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line9 ,$row['Stat_Name']);
  }
  $line_Airport = array();
  $query= "select Stat_Name from line_Airport";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line_Airport ,$row['Stat_Name']);
  }
  $line_Bundang = array();
  $query= "select Stat_Name from line_Bundang";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line_Bundang ,$row['Stat_Name']);
  }
  $line_Center = array();
  $query= "select Stat_Name from line_Center";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line_Center ,$row['Stat_Name']);
  }
  $line_Gyeongchun = array();
  $query= "select Stat_Name from line_Gyeongchun";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line_Gyeongchun ,$row['Stat_Name']);
  }
  $line_Sinbundang = array();
  $query= "select Stat_Name from line_Sinbundang";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line_Sinbundang ,$row['Stat_Name']);
  }
  $line_Suin = array();
  $query= "select Stat_Name from line_Suin";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result))
  {
    array_push($line_Suin ,$row['Stat_Name']);
  }
  $stepCategoryJsonArray = array( // 해당 부분을 DB에서 읽어오는 것으로 응용 가능하다.
  'line0' => array("선택하세요"),
  'line1' => $line1, // 삼차원 배열로 만들기
  'line2' => $line2,
  'line3' => $line3,
  'line4' => $line4,
  'line5' => $line5,
  'line6' => $line6,
  'line7' => $line7,
  'line8' => $line8,
  'line9' => $line9,
  'line_Airport' => $line_Airport,
  'line_Bundang' => $line_Bundang,
  'line_Center' => $line_Center,
  'line_Gyeongchun' => $line_Gyeongchun,
  'line_Sinbundang' => $line_Sinbundang,
  'line_Suin' => $line_Suin
  );
?>
                    <div id="pre_set1" style="display:inline">
                       <label for="">선호 호선</label>
                       <!-- onchange를 통해서 변경되는 event가 발생하면 categoryChange 함수를 호출한다.-->
                       <select id='step1' name ="sub_line1" onchange='categoryChange1(this)' >
                        <option value = "line0">선택하세요.
                        <option value="line1">1호선
                        <option value="line2">2호선
                        <option value="line3">3호선
                        <option value="line4">4호선
                        <option value="line5">5호선
                        <option value="line6">6호선
                        <option value="line7">7호선
                        <option value="line8">8호선
                        <option value="line9">9호선
                        <option value="line_Airport">공항철도
                        <option value="line_Bundang">분당선
                        <option value="line_Center">경의중앙선
                        <option value="line_Gyeongchun">경춘선
                        <option value="line_Sinbundang">신분당선
                        <option value="line_Suin">수인선
                         </select>
                       </select>
                       <!-- 변화가 생기기 전에 select box에서 기본적으로 표시될 부분.-->
                       <!-- 이 부분도 동적으로 하고 싶으면, DB에서 값을 읽어와서 php echo를 통해 뿌려주는 방법으로 처리.-->
                       <label for="">선호 역</label>
                       <select id='step2' name = "sub_station1">
                         <option value='f'>선택하세요.</option>
                       </select>


                    <input type="button" value="삭제" onclick="remove_item(this)">
                  </div>

                  <script>
                  function categoryChange1(e){ // 인자로 호출된 값을 받는다.
                  var stepCategoryJsonArray = <?php echo json_encode($stepCategoryJsonArray) ?>; // php에서 json으로 가공한 값을 js에서 json 으로 encode
                  console.log(stepCategoryJsonArray[e.value].length); // 호출된 json 배열의 크기
                  var target1 = document.getElementById('step2');// step2의 요소들을 가져온다.
                  $("select#step2 option").remove(); // jQuery 를 이용하여 기존의 step2 option 모두 제거 -> 없으면 선택한 step2들이 계속 누적된다.

                  for(var i=0; i<stepCategoryJsonArray[e.value].length; i++){
                  var opt = document.createElement('option'); // option 이라는 태그를 사용할 것이라 선언
                  opt.value = stepCategoryJsonArray[e.value][i]; // option의 value를 추가
                  opt.innerHTML = stepCategoryJsonArray[e.value][i]; // option의 inner 부분을 추가
                  // 객체로 생성(위에서 가공한 것을 기반으로, 실질적으로 html 코드가 생성되는 부분)
                  target1.append(opt);
                 }



                }
                 </script>

                 <br>
                   <div id="pre_set2" style="display:inline">
                      <label for="">선호 호선</label>
                      <!-- onchange를 통해서 변경되는 event가 발생하면 categoryChange 함수를 호출한다.-->
                      <select id='step3' name ="sub_line2" onchange='categoryChange2(this)' >
                        <option value = "line0">선택하세요.
                        <option value="line1">1호선
                        <option value="line2">2호선
                        <option value="line3">3호선
                        <option value="line4">4호선
                        <option value="line5">5호선
                        <option value="line6">6호선
                        <option value="line7">7호선
                        <option value="line8">8호선
                        <option value="line9">9호선
                        <option value="line_Airport">공항철도
                        <option value="line_Bundang">분당선
                        <option value="line_Center">경의중앙선
                        <option value="line_Gyeongchun">경춘선
                        <option value="line_Sinbundang">신분당선
                        <option value="line_Suin">수인선
                        </select>
                      </select>
                      <!-- 변화가 생기기 전에 select box에서 기본적으로 표시될 부분.-->
                      <!-- 이 부분도 동적으로 하고 싶으면, DB에서 값을 읽어와서 php echo를 통해 뿌려주는 방법으로 처리.-->
                      <label for="">선호 역</label>
                      <select id='step4' name = "sub_station2">
                        <option value='f'>선택하세요.</option>
                      </select>

                   <input type="button" value="삭제" onclick="remove_item2(this)">
                 </div>

                 <script>
                 function categoryChange2(e){ // 인자로 호출된 값을 받는다.
                 var stepCategoryJsonArray = <?php echo json_encode($stepCategoryJsonArray) ?>; // php에서 json으로 가공한 값을 js에서 json 으로 encode
                 var target2 = document.getElementById('step4');// step2의 요소들을 가져온다.
                 $("select#step4 option").remove(); // jQuery 를 이용하여 기존의 step2 option 모두 제거 -> 없으면 선택한 step2들이 계속 누적된다.

                 for(var i=0; i<stepCategoryJsonArray[e.value].length; i++){
                 var opt = document.createElement('option'); // option 이라는 태그를 사용할 것이라 선언
                 opt.value = stepCategoryJsonArray[e.value][i]; // option의 value를 추가
                 opt.innerHTML = stepCategoryJsonArray[e.value][i]; // option의 inner 부분을 추가
                 // 객체로 생성(위에서 가공한 것을 기반으로, 실질적으로 html 코드가 생성되는 부분)
                 target2.append(opt);
                }
               }
                </script>
                <br>

                  <div id="pre_set3" style="display:inline">
                     <label for="">선호 호선</label>
                     <!-- onchange를 통해서 변경되는 event가 발생하면 categoryChange 함수를 호출한다.-->
                     <select id='step5' name ="sub_line3" onchange='categoryChange3(this)' >
                       <option value = "line0">선택하세요
                       <option value="line1">1호선
                       <option value="line2">2호선
                       <option value="line3">3호선
                       <option value="line4">4호선
                       <option value="line5">5호선
                       <option value="line6">6호선
                       <option value="line7">7호선
                       <option value="line8">8호선
                       <option value="line9">9호선
                      <option value="line_Airport">공항철도
                      <option value="line_Bundang">분당선
                      <option value="line_Center">경의중앙선
                      <option value="line_Gyeongchun">경춘선
                      <option value="line_Sinbundang">신분당선
                      <option value="line_Suin">수인선
                       </select>
                     </select>
                     <!-- 변화가 생기기 전에 select box에서 기본적으로 표시될 부분.-->
                     <!-- 이 부분도 동적으로 하고 싶으면, DB에서 값을 읽어와서 php echo를 통해 뿌려주는 방법으로 처리.-->
                     <label for="">선호 역</label>
                     <select id='step6' name = "sub_station3">
                       <option value='f'>선택하세요.</option>
                     </select>

                  <input type="button" value="삭제" onclick="remove_item3(this)">
                </div>

                <script>
                function categoryChange3(e){ // 인자로 호출된 값을 받는다.
                var stepCategoryJsonArray = <?php echo json_encode($stepCategoryJsonArray) ?>; // php에서 json으로 가공한 값을 js에서 json 으로 encode
                console.log(stepCategoryJsonArray[e.value].length); // 호출된 json 배열의 크기
                var target3 = document.getElementById('step6');// step2의 요소들을 가져온다.
                $("select#step6 option").remove(); // jQuery 를 이용하여 기존의 step2 option 모두 제거 -> 없으면 선택한 step2들이 계속 누적된다.

                for(var i=0; i<stepCategoryJsonArray[e.value].length; i++){
                var opt = document.createElement('option'); // option 이라는 태그를 사용할 것이라 선언
                opt.value = stepCategoryJsonArray[e.value][i]; // option의 value를 추가
                opt.innerHTML = stepCategoryJsonArray[e.value][i]; // option의 inner 부분을 추가
                // 객체로 생성(위에서 가공한 것을 기반으로, 실질적으로 html 코드가 생성되는 부분)
                target3.append(opt);
               }



              }
               </script>
               <br>
                  <input type="button" value="회원가입" onclick="reg.submit()">

        </fieldset>
      </form>
    <?
    }
    ?>

</div>

<iframe src="" id="ifrm1" scrolling=no frameborder=no width=0 height=0 name="ifrm1"></iframe>

</body>
</html>
