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
        
        <form method = "post" enctype="multipart/form-data" action="timetable_result.php">
      
            <div class = "module-list">
                <div>Enter all the modules you have as a comma separated list</div>
                <input name = "module-string" type = "text">
            </div>
            
            <input type = submit>
        </form>
      
      
  </body>
</html>

