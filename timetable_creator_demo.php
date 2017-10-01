<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form</title>
        <?php include 'header.php'; ?>
        <link rel="stylesheet" type = "text/css" href= "css/timetable.css">
    </head>
    <body class = "oreo-wallpaper">
        <?php include 'navbar.php' ?>
        <?php 
    
            include "timetable_scheduler_functions.php";
    
            if ( (isset($_POST) && isset($_POST['module-string']) && isset($_POST['lang']) )) {
                
                $str = $_POST['module-string'];
                $str = filter_var($str, FILTER_SANITIZE_STRING);
                $arr = explode(",", $str);
                
                $t = new TimeTable();
                //$t->print_raw();
                $t->add_subject('Mon', '14:30', 'COS224');
                $t->add_subject('Mon', '13:30', 'COS224');
                $t->add_subject('Mon', '15:30', 'COS224');
                $t->add_subject('Mon', '16:30', 'COS224');
                $t->add_subject('Mon', '16:30', 'COS224');
                $t->add_subject('Mon', '16:30', 'COS224');
                $t->add_subject('Mon', '16:30', 'COS224');
                $t->add_prac('Tues', 13, 16 , 'OMG114');
                //$t->print_raw();
                echo $c = $t->getClashes()->createHTMLTable();
                echo $t->createHTMLTable();
                
            }
            else {
                echo '<p>ERROR: No data received...</p>';
            }
    
        ?>
        

    </body>
</html>

