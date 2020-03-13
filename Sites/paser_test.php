<?
  $subway="흑석";
  // parsing할 url 지정(API 키 포함해서)
  $urlstr = "http://swopenapi.seoul.go.kr/api/subway/7862795572646961353765574d596a/xml/realtimeStationArrival/0/5/";
  $subwayresult = urlencode($subway);
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
    $arvMsg = $value->arvlMsg2;
    //parse_str
    //echo $rowNum;
    //echo $statnNm;
    echo $recptnDt;
    echo $arvMsg;
  }
?>
