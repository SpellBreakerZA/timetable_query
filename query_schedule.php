<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form</title>
    <?php include 'header.php' ?>
  </head>
  <body>
  
    <?php include 'navbar.php' ?>
    <form method = "post" enctype="application/x-www-form-urlencoded" action = "user_query.php" class = "center">
        SQL Query: <input type = "text" name = "query">
        <button type = "submit">Submit Query</button>
    </form>
      
  </body>
</html>