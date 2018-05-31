<?php
  function getDB(){
    $dsn = 'mysql:host=localhost;dbname=n9467254';
    $user = 'username';
    $password = 'asdf';
    try {
      $db = new PDO($dsn, $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
    }
    return $db;
  }

  function runSQL($query){
    $pdo = getDB();
    try {
      $rows = $pdo->query($query);
    } catch (PDOException $e) {
      echo 'Query failed: ' . $e->getMessage();
    }
    if (isset($rows)){
      return $rows;
    } else {
      return "";
    }
  }

  function getAverage($id) {
    $query = "SELECT * FROM reviews WHERE hotspotID = ".$id.";";
    $result = runSQL($query);
    $total = 0;
    $rows = 0;
    foreach ($result as $row){
      $rows++;
      $total+=$row['rating'];
    }
    if ($rows == 0) {
      return 0;
    }
    return ceil($total / $rows);
  }

  function getFirstRow($rows){
    foreach ($rows as $row){
      return $row;
    }
  }

  function printReviews(){
    $sql = "SELECT firstName, lastName, text, rating, date, hotspotID FROM reviews, members WHERE reviews.userID = members.userID AND reviews.hotspotID = ".$_GET['id'].";";
    $reviews = runSQL($sql);
    $counter = runSQL($sql);
    $count = 0;
    foreach ($counter as $row){
      $count++;
    }
    //GENERATE reviews
    if ($count > 0){
      echo "<h2>Reviews</h2><br/>";
    } else {
      echo "<h2>Reviews</h2><br/>
        No reviews currently exist for this hotspot.";
    }
    foreach($reviews as $row){
      echo "<div class=\"review\" itemscope itemtype=\"http://schema.org/Review\"><br/>";
      echo "<h3>".$row['firstName'].' '.$row['lastName']."</h3>";
      $date = substr($row['date'], 8, 2)."-".substr($row['date'], 5, 2)."-".substr($row['date'], 0, 4);
      echo $date."<br/>";
      for ($i = 0; $i < $row['rating']; $i++){
        echo "<i class=\"fa fa-star\"> </i>";
      }
      $sql = 'SELECT * FROM items WHERE hotspotID = '.$row['hotspotID'].';';
      $result = runSQL($sql);
      $name = getFirstRow($result);
      echo '<meta itemprop="itemReviewed" content="'.$name['name'].'"/>';
      echo '<meta itemprop="ratingValue" content="'.$row['rating'].'"/>';
      echo '<meta itemprop="bestRating" content="5"/>';
      echo '<meta itemprop="author" content="'.$row['firstName'].' '.$row['lastName'].'"/>';
      echo '<br/><div itemprop="reviewBody">'.$row['text'].'</div></div>';
    }
  }

  function getDistance($lat1, $lon1, $lat2, $lon2) {
  	$EARTH_RADIUS = 6371; //kilometres
  	$HOTSPOT_LAT = $lat2;
  	$HOTSPOT_LONG = $lon2;
  	$lat1 = $lat1;
  	$lon1 = $lon1;
  	$lat2 = $HOTSPOT_LAT;
  	$lon2 = $HOTSPOT_LONG;

  	$x1 = $lat2 - $lat1;
  	$deltaLat = ($x1 * M_PI / 180);
  	$x2 = $lon2 - $lon1;
  	$deltaLon = ($x2 * M_PI / 180);
  	$a = sin($deltaLat/2) * sin($deltaLat/2)
  			+ cos($lat1 * M_PI / 180) * cos($lat2 * M_PI / 180)
  			* sin($deltaLon/2) * sin($deltaLon/2);
  	$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
  	$d = $EARTH_RADIUS * $c;
  	return $d;
  }

  function generateItemMap($lat, $lon, $name){
    echo '<div id="map"></div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          center: {lat: '.$lat.', lng: '.$lon.'},
          zoom: 17
        });
        var marker = new google.maps.Marker({
          position: {lat: '.$lat.', lng: '.$lon.'},
          map: map,
          title: "'.$name.'"
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChN8qa-r6yzLXjlZpFyMCO7pVRY07k4QU&callback=initMap"
    async defer></script>';
  }

  function generateResultsMap($lat, $lon, $rows, $useBlue){

    echo '<div id="map"></div>
    <script>
      var map;
      function initMap() {';

    if ($useBlue) {
      echo 'var blue = "https://maps.google.com/mapfiles/ms/icons/blue-dot.png";';
    } else {
      echo 'var blue = "https://maps.google.com/mapfiles/ms/icons/red-dot.png";';
    }
    echo'
        var red = "https://maps.google.com/mapfiles/ms/icons/red-dot.png";
        map = new google.maps.Map(document.getElementById("map"), {
          center: {lat: '.$lat.', lng: '.$lon.'},
          zoom: 12
        });
        var marker = new google.maps.Marker({
          position: {lat: '.$lat.', lng: '.$lon.'},
          map: map,
          title: "Your Location",
          icon: blue
        });';
    foreach ($rows as $hotspot) {
      echo 'var marker = new google.maps.Marker({
        position: {lat: '.$hotspot['latitude'].', lng: '.$hotspot['longitude'].'},
        map: map,
        title: "'.$hotspot['name'].'",
        icon: red
      });';
      echo 'google.maps.event.addListener(marker, \'click\', function() {
        window.location.href = "item.php?id='.$hotspot['hotspotID'].'";
        });';

    }
    echo '
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChN8qa-r6yzLXjlZpFyMCO7pVRY07k4QU&callback=initMap"
    async defer></script>';
  }
?>
