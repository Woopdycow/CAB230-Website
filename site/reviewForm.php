<?php
  echo '<div id="validation-errors"></div>';
  echo "
  <form action=\"\" id=\"reviewForm\" method=\"POST\" onsubmit=\"return reviewValidate();\">
    <textarea name=\"text\" rows=\"4\" cols=\"80\" maxlength=\"255\" placeholder=\"Write review here...\"/></textarea><br/>
    <select id=\"review-rating\" name=\"rating\">
      <option value=\"\" disabled selected>Rating</option>
      <option value=\"1\">1 Star</option>
      <option value=\"2\">2 Stars</option>
      <option value=\"3\">3 Stars</option>
      <option value=\"4\">4 Stars</option>
      <option value=\"5\">5 Stars</option>
    </select><input id=\"review-submit\" type=\"submit\" value=\"Submit\">
  </form>
  <div class=\"break-line\"></div>";
?>
