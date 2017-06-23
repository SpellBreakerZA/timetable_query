<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Form</title>
    <?php include 'header.php'; ?>
    <script src = "js/location_query.js" type = "text/javascript"></script>
    <style>
        .center {
            margin-left: auto !important;
            margin-right: auto !important;
            width: inherit;
            display: block;
            float: none;
            clear: both;
            text-align: center;
        }
    </style>    
  </head>
  <body>
  
        <?php include 'navbar.php' ?>
        <?php include 'modal_update.php' ?>
      
        <h1 class = "center">Location Query</h1>
        
        <form method = "post" enctype="multipart/form-data" action="locale_query.php" class = "center">
      
            <div class = "center">
                <select name = "venues" list="venues">
                    <option value="Thuto">Thuto</option>
                    <option value="Centenary">Centenary</option>
                    <option value="Chancellor's">Chancellor's</option>
                    <option value="Humanities">Humanities</option>
                    <option value="Chem Building">Chem Building</option>
                    <option value="IT Building">IT Building</option>
                    <option value="EMB Building">EMB Building</option>
                </select> 
            </div>
            
            <div class = "center"> 
                <select name = "day" list="day">
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                </select> 
            </div>
            
            <div class = "center"> 
                <select name = "sem" list="sem">
                    <option value="All year">All year</option>
                    <option value="Semester 1">Semester 1</option>
                    <option value="Semester 2" selected >Semester 2</option>
                </select> 
            </div>
            
            <div class = "center time">
                <div id = "select-time">
                    <div style = "display: inline">Filter based on time?</div>
                    <input id = "time" name = "time" type = "checkbox" value = "unchecked">
                </div>
                <div id = "time-inputs">
                    <div id = "time-specific-inputs">
                        <div style = "display: inline">From</div>
                        <input id = "start-time" name = "start-time" type = "time" class = "center">
                        <div style = "display: inline">To</div>
                        <input id = "end-time" name = "end-time" type = "time" class = "center">
                    </div>
                    <div style = "display: inline">Now?</div>
                    <input id = "now-box" name = "now" type = "checkbox">
                </div>
            </div>
            
            <input type = submit>
        </form>
      
      
  </body>
</html>

