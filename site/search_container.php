<div id="search-container">
  <form name="search" action="results.php" method="GET">
    <input id="home-search-box" type="text" placeholder="Search for a Hotspot..." name="search">
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
  <button id="myLocation" onclick="getLocation()"><i class="fa fa-map-pin"></i></button>
</div>
