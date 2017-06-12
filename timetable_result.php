<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form</title>
    <?php include 'header.php'; ?>
  </head>
  <body>
  
    <?php include 'navbar.php' ?>
    <h1 class = "text-center">Timetable Query</h1>

    <?php
      
      include 'display_database.php';
      if (isset($_POST) && isset($_POST['module-string'])) {
          $str = $_POST['module-string'];
          $arr = explode(",", $str);
          
          
          for($i = 0; $i < count($arr); $i++) {
              echo '<div class = "text-center module-text">' . $arr[$i] . '</div> <br>';
              $queryText = "SELECT * FROM lecture WHERE module = '$arr[$i]' ORDER BY classType";
              echo getResultAsTableStringNoID($queryText);
              echo '<br>';
          }
          $conn->close();
          
      }
      else {
          echo "Error retrieving data";
      }
      
    ?>
      
      
  </body>
</html>