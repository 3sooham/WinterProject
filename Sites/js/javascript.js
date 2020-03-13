 function show_button(){

    if (document.getElementById('a').checked){
      document.getElementById('c').style.display="inline";
      }
  }
  function hide_button(){
    if (document.getElementById('b').checked){
      document.getElementById('c').style.display="none";
      }
  }
  function add_item(){
  // pre_set 에 있는 내용을 읽어와서 처리..
    var div = document.createElement('div');
    div.innerHTML = document.getElementById('pre_set1').innerHTML;
    document.getElementById('field1').appendChild(div);
    }

  function remove_item(obj){
    // obj.parentNode 를 이용하여 삭제
    document.getElementById('pre_set1').remove(obj);
  }

    function add_item2(){
    // pre_set 에 있는 내용을 읽어와서 처리..
    var div = document.createElement('div');
    div.innerHTML = document.getElementById('pre_set2').innerHTML;
    document.getElementById('field2').appendChild(div);
    }

    function remove_item2(obj){
      // obj.parentNode 를 이용하여 삭제
      document.getElementById('pre_set2').remove(obj);
    }

      function add_item3(){
      // pre_set 에 있는 내용을 읽어와서 처리..
      var div = document.createElement('div');
      div.innerHTML = document.getElementById('pre_set3').innerHTML;
      document.getElementById('field3').appendChild(div);
      }

      function remove_item3(obj){
        // obj.parentNode 를 이용하여 삭제
        document.getElementById('pre_set3').remove(obj);
      }

      function check_id(){

       document.getElementById("chk_id2").value=0;
       var id=document.getElementById("chk_id1").value;

       if(id==""){
         alert("빈칸은 ID가 될 수 없다");
       }

       ifrm1.location.href="./join_chk.php?m_id="+id;
      }
