<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form</title>
    <link rel = "stylesheet" href = "styles.css" type = "text/css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
  
    <h1>Timetable Query</h1>

    <?php
      
      if (isset($_POST) && isset($_POST['module-string'])) {
          $str = $_POST['module-string'];
          $arr = explode(",", $str);
          
          $queryText = "SELECT * FROM lecture WHERE module = '$arr[0]'";
          for($i = 1; $i < count($arr); $i++) {
              $queryText .= " OR module = '$arr[$i]' ";
          }
          $queryText .= " ORDER BY module, classType";
          //$queryText .= " ORDER BY module, classType";
          
          echo $queryText . '<br>';
          include 'display_database.php';
          for($i = 0; $i < count($arr); $i++) {
              echo $arr[$i] . " ";
          }
          
          echo getResultAsTableStringNoID($queryText);
          $conn->close();
          
      }
      else {
          echo "Error retrieving data";
      }
      
    ?>
      
      
  </body>
</html>