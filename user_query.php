<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form</title>
    <link rel = "stylesheet" href = "styles.css" type = "text/css"> 
  </head>
  <body>
  
      <div class = "intro-heading">Your Query Results!</div>
      
      <?php 
        if (isset($_POST) && isset($_POST['query'])) {

            include 'display_database.php';
            echo getResultAsTableString($_POST['query']);
            $conn->close();

        }
        else {
            echo "<p> There was an error with retrieving the query </p>";
        }
      ?>
      
  </body>
</html>

