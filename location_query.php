<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form</title>
    <link rel = "stylesheet" href = "styles.css" type = "text/css"> 
  </head>
  <body>
  
        <h1>Location Query</h1>
        
        <form method = "post" enctype="multipart/form-data" action="locale_query.php">
      
            <div>
                <input name = "venues" list="venues">
                <datalist id="venues">
                    <option value="Thuto">
                    <option value="Centenary">
                    <option value="Chancellor's">
                    <option value="Humanities">
                    <option value="Chem Building">
                    <option value="IT Building">
                    <option value="EMB Building">
                </datalist> 
            </div>
            
            <div> 
                <input name = "day" list="day">
                <datalist id="day">
                    <option value="Monday">
                    <option value="Tuesday">
                    <option value="Wednesday">
                    <option value="Thursday">
                    <option value="Friday">
                </datalist> 
            </div>
            
            <div> 
                <input name = "sem" list="sem">
                <datalist id="sem">
                    <option value="All year">
                    <option value="Semester 1">
                    <option value="Semester 2">
                </datalist> 
            </div>
            
            <div>
                <div style = "display: inline">Now?</div>
                <input name = "now" type = "checkbox">
            </div>
            
            <input type = submit>
            
        </form>
      
      
  </body>
</html>

