<?
  include './dbconn.php';
  $id = $_POST['login_id'];
  $query = "select Station from Saved_staions where Member_id = '$id';";
  $result = mysqli_query($conn,$query);

  $subway = array();

  while($row = mysqli_fetch_assoc($result))
  {
    array_push($subway ,$row['Station']);
  }

  $subway_number = count($subway);

  for($i=0; $i<$subway_number;$i++ )
  {
    $urlstr = "http://swopenapi.seoul.go.kr/api/subway/7862795572646961353765574d596a/xml/realtimeStationArrival/0/24/";
    $subwayresult = urlencode($subway[$i]);
    //echo $subwayresult;
    $url = $urlstr.$subwayresult;
    //echo $url;
    $response = file_get_contents($url);
    $object = simplexml_load_file($url);
    $first = $object->row;

    foreach($first as $value){
      //xml data
  	     $rowNum = $value->rowNum;
  	     $statnId = $value->statnId;
        $statnNm = $value->statnNm;
        $recptnDt = $value->recptnDt;
        $arvMsg1 = $value->arvlMsg1;
        $arvMsg2 = $value->arvlMsg2;
        $arvlCd = $value->arvlCd;
        $trainLineNm = $value->trainLineNm;
        //parse_str
        echo $trainLineNm;
        echo $arvMsg1;
        echo $arvMsg2;
        echo $arvlCd;

      }
    }

?>
