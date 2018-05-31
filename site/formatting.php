<?php
  function generateHead($name){
    echo "
    <head>
    <title>$name</title>
    <meta charset=\"utf8\" />
    <meta name=\"author\" content=\"Bryan Kassulke\" />
    <meta name=\"description\" content=\"Brisbane WiFi Lookup\" />
    <meta name=\"keywords\" content=\"web, programming, QUT, brisbane, australia, wifi, hotpost, city, council\" />
    <script type=\"text/javascript\" src=\"javascript/script.js\"></script>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">";

  }

  function generateHeader(){
    echo "
      <div id=\"header\">
        <div id=\"header-contents\">
            <a href=\"index.php\"><button class=\"header-button\" href=\"index.php\"><h2>Home</h2></button></a>";
    if (isset($_SESSION['signedIn'])) {
      echo "<a href=\"logout.php\"><button class=\"header-button-right\"><h2>Log Out</h2></button></a>";
    } else {

      echo "<a href=\"registration.php\"><button class=\"header-button-right\"><h2>Sign Up</h2></button></a>";
      echo "<a href=\"login.php\"><button class=\"header-button-right\"><h2>Log In</h2></button></a>";
    }
    echo  "</div>
    </div>";
  }

  function generateFooter(){
    echo "
      <div id=\"footer\"><div id=\"footer-left\">
        <table class=\"valign\">
          <tr>
            <td><a href=\"http://www.facebook.com/pages/Brisbane-Australia/Brisbane-City-Council/80836222708\"><img src=\"img/facebook.png\" alt=\"Facebook Link\"><h3>Facebook</h3></a></td>
            <td><a href=\"http://instagram.com/brisbanecitycouncil\"><img src=\"img/insta.png\" alt=\"Instagram Link\"><h3>Instagram</h3></a></td>
          </tr>
          <tr>
            <td><a href=\"https://www.youtube.com/user/BrisbaneCityCouncil\"><img src=\"img/youtube.png\" alt=\"Youtube Link\"><h3>Youtube</h3></a></td>
            <td><a href=\"https://twitter.com/brisbanecityqld\"><img src=\"img/twitter.png\" alt=\"Twitter Link\"><h3>Twitter</h3></a></td>
          </tr>
        </table>
      </div>
      <div id=\"footer-right\">
          <img src=\"img/bcc.png\" alt=\"Brisbane City Council Logo\"><br>
          <i>Dedicated to a better Brisbane</i>
      </div>
      <div class=\"footer-break-line\"></div>
      <div id=\"footer-center\">
        Bryan Kassulke 2018
      </div>
    </div>
    ";
  }
?>
