<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form</title>
    <?php include 'header.php'; ?>
  </head>
  <body>
      
      <?php include 'navbar.php' ?>
      <div class = "intro-heading center">Your Query Results!</div>
      
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

