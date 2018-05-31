<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <?php
    require 'formatting.php';
    require 'dbConnect.php';
    generateHead('Hotspot');
  ?>
  <body>
    <div id="wrapper">
      <?php
        generateHeader();

        echo '<div id="content">';
        //IF THE STORE's ID IS PROVIDED IN THE URL/GET
        if (isset($_GET['id'])) {
          $hotspotID = $_GET['id'];
          $sql = "SELECT * FROM items WHERE hotspotID = ".$hotspotID.";";
          $result = runSQL($sql);
          foreach ($result as $hotspot ) {
            echo "<div class=\"center-content-text\" itemscope itemtype=\"http://schema.org/Place\">
              <h1 itemprop=\"name\">".$hotspot['name']."</h1>".
              "<div itemprop=\"address\">".$hotspot['address']."</div><br>".
              $hotspot['suburb']."
              <div itemprop=\"geo\" itemscope itemtype=\"http://schema.org/GeoCoordinates\">
              <meta itemprop=\"latitude\" content=\"".$hotspot['latitude']."\"/>
              <meta itemprop=\"longitude\" content=\"".$hotspot['longitude']."\"/>
              </div>
              <div class=\"break-line\"></div>
              <h1>";
            $averageStars = getAverage($hotspot['hotspotID']);
            for ($i = 0; $i < $averageStars; $i++) {
              echo " <i class=\"fa fa-star\"></i> ";
            }
            echo "</h1>";
            generateItemMap($hotspot['latitude'], $hotspot['longitude'], $hotspot['name']);
            echo "<br>
              <div class=\"break-line\"></div>";
            // IF THE USER IS SIGNED IN
            if (isset($_SESSION['signedIn'])) {
              if (isset($_POST['text']) || isset($_POST['rating'])) {
                require 'validate.php';
                validateTextArea($errors, $_POST);
                validateRating($errors, $_POST);
                if ($errors) {
                  echo "<h2>Leave a Review</h2><br/>";
                  foreach ($errors as $error){
                    echo $error;
                  }
                } else {
                  $date = date('Y').'-'.date('m').'-'.date('d');
                  $sql = "INSERT INTO reviews (hotspotID, date, userID, text, rating) VALUES ('".$_GET['id']."', '".$date."', '".$_SESSION['userID']."', '".$_POST['text']."', '".$_POST['rating']."');";
                  $result = runSQL($sql);
                  echo 'Review successful!<br/>';
                  header( "refresh:1;url=item.php?id=".$_GET['id'] );
                }
                require 'reviewForm.php';
              } else {
                echo "<h2>Leave a Review</h2><br/>";
                require 'reviewForm.php';
              }
              printReviews();
              echo "</div>
                  </div>";
            } else {
              printReviews();
              echo "</div>
                  </div>";
            }
          }
        } else {
          require 'search_container.php';
        }
        echo '</div>';
        generateFooter();
      ?>
    </div>
  </body>
</html>
