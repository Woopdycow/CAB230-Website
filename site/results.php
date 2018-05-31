<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <?php
    require 'formatting.php';
    require 'dbConnect.php';
    generateHead('Results');
  ?>
  <body>
    <div id="wrapper">
      <?php
        generateHeader();
        echo "<div class=\"center-content-text\">";
        //IF SEARCH IS SET

        if (isset($_GET['lat']) && isset($_GET['lon'])) {
          echo '<br/>';
          $sql = 'SELECT * FROM items;';
          $result = runSQL($sql);
          $distanceResults = runSQL($sql);
          $order = 0;
          foreach ($result as $hotspot) {
            $array[$order] = $hotspot;
            $order++;
          }
          foreach ($distanceResults as $hotspot) {
            $distance[$hotspot['name']] = getDistance($_GET['lat'], $_GET['lon'], $hotspot['latitude'], $hotspot['longitude']);
          }

          $size = $order;
          $i = 0;
          $j = 0;
          for ($i = 0; $i < $size - 1; $i++) {
            $jmin = $i;
            for ($j = $i + 1; $j < $size; $j++) {
              if ($distance[$array[$j]['name']] < $distance[$array[$jmin]['name']]) {
                $jmin = $j;
              }
            }
            if ($jmin != $i){
            $temp = $array[$i];
            $array[$i] = $array[$jmin];
            $array[$jmin] = $temp;
            }
          }
          $sorted = $array;

          echo "
            <h1>Results</h1>
            Showing all hotspots sorting from closest to furthest.
            <div class=\"break-line\"></div>";

          $markers = runSQL($sql);
          generateResultsMap($_GET['lat'], $_GET['lon'], $markers, true);
          echo "<div class=\"break-line\"></div></div>";

          foreach ($sorted as $hotspot) {
            $averageStars = getAverage($hotspot['hotspotID']);
            $minimum = 0;
            if (isset($_GET['rating'])) {
              $minimum = $_GET['rating'];
            }
            if ($averageStars >= $minimum) {
              echo "<a id=\"block-link\" href=\"item.php?id=".$hotspot['hotspotID']."&lat=".$_GET['lat']."&lon=".$_GET['lon']."\">
                <div class=\"result\">
                  <h3>".$hotspot['name']." - ".round($distance[$hotspot['name']], 2)." km"."</h3><br>".
                  $hotspot['address']."<br>".
                  $hotspot['suburb']."<br>";
              for ($i = 0; $i < $averageStars; $i++) {
                echo " <i class=\"fa fa-star\"></i> ";
              }
              echo "</div>
                </a>";
            }
          }
        } else {
          if (isset($_GET['search'])) {
            $resultSearch = $_GET['search'];
          } else {
            $resultSearch = "";
          }
          $sql = "
            SELECT *
            FROM items
            WHERE name LIKE '%".$resultSearch."%';";
          if (isset($_GET['suburb'])) {
            $resultSuburb = $_GET['suburb'];
            $sql = "
              SELECT *
              FROM items
              WHERE name LIKE '%".$resultSearch."%' AND suburb LIKE '%".$resultSuburb."%';";
          } else {
            $resultSuburb = "";
          }
          if (isset($_GET['rating'])) {
            $resultRating = $_GET['rating'];
            $sql = "
              SELECT *
              FROM items
              WHERE suburb LIKE '%".$resultSuburb."%' AND name LIKE '%".$resultSearch."%';";
          }

          $result = runSQL($sql);
          $temp = runSQL($sql);
          $ratingRequisite = runSQL($sql);

          $count = 0;
          foreach($temp as $nothing){
            $count++;
          }
          if (isset($_GET['rating'])) {
            $count = 0;
            foreach ($ratingRequisite as $row){
              if (getAverage($row['hotspotID']) >= $_GET['rating']) {
                $count++;
              }
            }
            echo "
              <h1>Results</h1>
              We found ".$count." hotspots that match your search query.
              <div class=\"break-line\"></div>
            </div>";
          } else {
            echo "
              <h1>Results</h1>
              We found ".$count." hotspots that match your search query.
              <div class=\"break-line\"></div>";
            if ($count == 0){
              require 'search_container.php';
            }
          }
          if ($count > 0) {
            $firstMarker = getFirstRow(runSQL($sql));
            $markers = runSQL($sql);
            generateResultsMap($firstMarker['latitude'], $firstMarker['longitude'], $markers, false);
            echo "<div class=\"break-line\"></div>";
          }
          echo "</div>";

          foreach ($result as $hotspot) {
            $averageStars = getAverage($hotspot['hotspotID']);
            $minimum = 0;
            if (isset($_GET['rating'])) {
              $minimum = $_GET['rating'];
            }
            if ($averageStars >= $minimum) {
              echo "<a id=\"block-link\" href=\"item.php?id=".$hotspot['hotspotID']."\">
                <div class=\"result\">
                  <h3>".$hotspot['name']."</h3><br>".
                  $hotspot['address']."<br>".
                  $hotspot['suburb']."<br>";
              for ($i = 0; $i < $averageStars; $i++) {
                echo " <i class=\"fa fa-star\"></i> ";
              }
              echo "</div>
                </a>";
            }
          }
        }

      ?>

      </div>
    <?php
      generateFooter();
    ?>
    </div>
  </body>
</html>
