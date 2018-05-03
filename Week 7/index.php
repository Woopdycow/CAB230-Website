<!DOCTYPE html>
<html>
<head>
  <title>Week 7 - Table</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <table>
  <?php
    $size = 20;
    for ($i=0; $i<=$size; $i++) {
      echo '<tr>';
      for ($j=0; $j<=$size; $j++) {
        echo '<td>';
        if ($i == 0){
          if ($j == 0){
            echo "<b>X</b>";
          } else {
            echo "<b>$j</b>";
          }
        } else {
          if ($j == 0){
            echo "<b>$i</b>";
          } else {
            echo $i * $j ;
          }
        }
        echo '</td>';
      }
      echo '</tr>';
    }
  ?>
  </table>
</html>
