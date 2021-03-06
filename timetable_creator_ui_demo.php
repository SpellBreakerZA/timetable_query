<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form</title>
    <?php include 'header.php'; ?>
    <script src = "js/autocomplete.js" type = "text/javascript"></script>
    <style>
        .text-input{
            margin-top: 5px;
            margin-bottom: 5px;
            max-width: 50%;
        }
    </style>
  </head>
    
  <body>
      
        <?php include 'navbar.php'; ?>
        <?php include 'modal_update.php' ?>
  
        <h1 class = "center">Timetable Query</h1>
        
        <div id = "module-holder" class = "center">
            <input id = "ajax" type="text" list="modules" placeholder="Enter module code">
            <datalist id = "modules">
                <!-- dynamically filled -->
            </datalist>
            <button class = "btn btn-default btn-info" id = "add-module">Add module</button>
        </div>
      
        <form method = "post" enctype="multipart/form-data" action="timetable_creator_demo.php" class = "center">
      
            <div class = "center"> 
                <select name = "lang">
                    <option value="English">English</option>
                    <option value="Afrikaans">Afrikaans</option>
                    <option value="Both">Both</option>
                </select> 
            </div>
            
            <div class = "module-list" autocomplete = "off">
                <label for = "module-string">Enter all the modules you have as a comma separated list OR use the previous text box to add the modules one by one</label>
                <input class = "form-control center  text-input" name = "module-string" id = "module-string" type = "text" readonly>
            </div>
            
            <input type = submit class = "btn btn-default btn-danger">
        </form>
      
  </body>
</html>

