<!-- 
map上での表示ページでやること
第一フェーズ
①地図上にデータからマーカーをプロットする（されている状態）
②エリアへのリンクをデータから生成する（されている状態）
③新規地点の登録を行う→登録画面へ（googlemap上で検索）→登録完了画面へ（ここでデータ挿入）→メインページへ戻る（ここでデータの表示）（この時点でphpにデータを挿入し、表示するところまでの処理を行う）

第二フェーズ
④現在地を取得し、そこと登録地点が近いのかどうかを判定する
⑤現在時刻を取得し、その時間と近いかどうかを判定する


 -->
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: 'Noto Sans Japanese', serif;
      }

      #contents{
        overflow: hidden;
      }
      #mapregister{
        width: 30%;
        float: right;
      }
      #map {
        width: 70%;
        /*margin: 40px auto;*/
        height: 600px;
        float: right;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      footer{
        clear: both;
      }

    </style>
    <title>Places Searchbox</title>
    <style>
      #target {
        width: 345px;
      }
    </style>
  </head>
  <body>
  <div id="contents">
    <div id="mapregister">
      <form action="mapregister.php" method="post">
          使ったお金:<input type="text" id="usemoney" name="money">円<br>
          検索ワード:<input type="text" id="serchkeyworddata" name="placename"><br>
          緯度:<input type="text" id="latdata" name="latdata"><br>
          経度:<input type="text" id="lngdata" name="lngdata"><br>
          <input type="submit" value="地点を登録する" id="register"><br>
          <input id="pac-input" class="controls" type="text" placeholder="Search Box">
      </form>
    </div>

    <div id="map"></div>
  </div>
    <footer></footer>
    <script>
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

//マップの初期状態のセット
function initAutocomplete() {
  var lat = 35.681382;
  var lng = 139.766084;
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: lat, lng: lng},
    zoom: 15,
    scrollwheel: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  // function getLatlng(){
  //   var latitude = place.geometry.location.lat();
  //   var longitude = place.geometry.location.lng();
  //   console.log('緯度：' + latitude + '経度：' + longitude);
  // }

  function writeinputbox(){
    var mk = markers[ 0 ];
    var lnglat = mk.getPosition();
    var latitude = lnglat.lat(); // 経度 latitude
    var longitude = lnglat.lng(); // 緯度 longitude
    var latdata = document.getElementById('latdata');
    var lngdata = document.getElementById('lngdata');
    var inputdata = document.getElementById('pac-input');
    var serchkeyworddata = document.getElementById('serchkeyworddata');
    var searchkeyword = inputdata.value;

    latdata.value = latitude;
    lngdata.value = longitude;
    serchkeyworddata.value = searchkeyword;
  }

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // [START region_getplaces]
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    //placesに何もなければ処理を終了
    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });

    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(10, 10),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        // icon: icon,
        title: place.name,
        position: place.geometry.location
      }));

      // var mk = markers[ 0 ];
      // var lnglat = mk.getPosition();
      // var latitude = lnglat.lat(); // 経度 latitude
      // var longitude = lnglat.lng(); // 緯度 longitude
      writeinputbox();
      // console.log('緯度：' + latitude + '経度：' + longitude);
      




      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);

      } else {
        bounds.extend(place.geometry.location);
        // bounds.extend(place.geometry.viewport);
      }
    });
    if(bounds === bounds){
      map.fitBounds(bounds);
      map.setZoom(17);
     
    }else{
      map.fitBounds(bounds);
    }
    
    // map.fitBounds(place.geometry.viewport);
  });
  // [END region_getplaces]
}


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzJwemvClGcDRQeOmMi3QI0cuPnRE1CoY&libraries=places&callback=initAutocomplete"
         async defer></script>
  </body>
</html>