<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <?php
    $test = ( !function_exists('apc_fetch') && ini_get('apc.enabled') );
    require 'formatting.php';
    require 'dbConnect.php';
    generateHead('Home');
  ?>
  <body>
    <div id="wrapper">
      <div id="splash">
        <div id="splash-contents">
          <?php
            if (isset($_SESSION['signedIn'])) {
              echo "<a href=\"logout.php\"><button id=\"login-button\"><h2>Log Out</h2></button></a>";
            } else {
              echo "<a href=\"login.php\"><button id=\"login-button\"><h2>Log In</h2></button></a>";
              echo "<a href=\"registration.php\"><button id=\"signup-button\"><h2>Sign Up</h2></button></a>";
            }
          ?>


          <div id="splash-logo">
            <img src="img/logo.png"  alt="Logo">
          </div>
          <div id="search-container">
            <form name="search" action="results.php" method="GET">
              <input id="home-search-box" type="text" placeholder="Search for a Hotspot..." name="search">
              <br/>
              <select id="home-select-left" name="suburb">
                <option value="" disabled selected>Suburb</option>
                <?php
                  $sql = 'SELECT DISTINCT suburb FROM items';
                  $result = runSQL($sql);
                  foreach ($result as $suburb) {
                    echo '<option value="' . $suburb['suburb'] . '">' . $suburb['suburb'] . '</option>';
                  }
                ?>
              </select>
              <select id="home-select-right" name="rating">
                <option value="" disabled selected>Minimum Rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
              </select>
              <input type="submit" id="home-search-button" value='Search'>
            </form>
            <button id="myLocation" onclick="getLocation()"><i class="fa fa-map-pin"></i> Near me</button>
          </div>
        </div>
      </div>
      <div id="content">
        <div class="center-content-text">
          <h1>We're helping you connect, wherever you are.</h1>
          <div class="break-line"></div>
          Free wireless internet (Wi-Fi) is one way Brisbane City Council is creating
          a more connected and accessible city.  Free Wi-Fi is now available in 30 parks
          and public spaces across Brisbane, including the Queen Street Mall, Reddacliff
          Place, Victoria Bridge, South Bank Parklands, Roma Street Parkland, Valley Malls,
          Mt Coot-tha Summit Lookout, Brisbane Libraries and on CityCats.
        </div>
        <div class="break-line"></div>
        <div class="split-content-left">
          <h1>Where can you find a connection?</h1>
          <ul>
            <li>Parks</li>
            <li>Brisbane Central Business District</li>
            <li>Brisbane precincts</li>
            <li>South Bank Parklands</li>
            <li>Roma Street Parkland</li>
            <li>Valley Malls</li>
            <li>Brisbane Libraries</li>
            <li>Wi-Fi on CityCats</li>
          </ul>
        </div>
        <div class="split-content-right">
          <img src="img/image1.png"  alt="Image 1">
        </div>
      </div>
      <?php
        generateFooter();
      ?>
    </div>
  </body>
</html>
