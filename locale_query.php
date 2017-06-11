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

            if (isset($_POST) && isset($_POST['day']) && isset($_POST['venues']) && isset($_POST['sem'])) {
                
                include 'display_database.php';
                $venue = $_POST['venues'];
                $day = $_POST['day'];
                $sem = $_POST['sem'];
                $now = false;
                
                $extraSemConstraint;
                if ($sem === "Semester 1") {
                    $extraSemConstraint = " AND (timePeriod IN('S1','J/Y')
                                        OR timePeriod LIKE '%Q1%'
                                        OR timePeriod LIKE '%Q2%') ";
                }
                else if ($sem === "Semester 2") {
                    $extraSemConstraint = " AND (timePeriod IN('S2','J/Y')
                                        OR timePeriod LIKE '%Q3%'
                                        OR timePeriod LIKE '%Q4%') ";
                }
                else {
                    $extraSemConstraint = "";
                }
                
                $venueConstraint;
                if ($venue === "Chancellor's") {
                    $venueConstraint = " (venue LIKE '%Roos%' 
                                          OR venue LIKE '%Bijl%' 
                                          OR venue LIKE '%Muller%'
                                          OR venue LIKE '%Louw%'
                                          OR venue LIKE '%Te Water%') ";
                    echo "<br> All halls in Chancellor's are Roos, Muller, Louw, Te Water <br>";
                    
                } else if ($venue === "Chem Building") {
                    $venueConstraint = " (venue LIKE '%North%' 
                                          OR venue LIKE '%South%' 
                                          OR venue LIKE '%Large Chem%') "; 
                    echo "<br> All halls in Chem Building are North, South and Large Chem <br>";
                }
                else if ($venue === "Humanities") {
                    $venueConstraint = " (venue LIKE '%HB%') ";
                    echo "<br> All humanities locations are 3-12, 3-14, 3-15, 3-23, 3-24 and 4-1 until 4-16 and then magically a 4-21 <br>";
                }
                else if ($venue === "IT Building") {
                    $venueConstraint = " (venue LIKE '%IT%') ";
                    echo "<br> All IT rooms are 2-24, 2-25, 2-26, 4-1, 4-2, 4-3, 4-4, 4-5 <br>";
                }
                else if ($venue === "EMB Building") {
                    $venueConstraint = " (venue LIKE '%EMB%') ";
                    echo "<br> All EMB rooms are 2-150, 2-151, 4-150, 4-151, 4-152 <br>";
                }
                else {
                    $venueConstraint = " (venue LIKE '%$venue%') ";
                }
                
                echo "Venue Constraint is " . $venueConstraint;
                
                if (isset($_POST['now'])) {
                    $now = true;
                    //adding two hours to the time because the server
                    //time is wrong apparently
                    $time = time() + (2 * (60*60)); 
                    $hour = date('h', $time);
                    $query = "SELECT * FROM lecture 
                              WHERE $venueConstraint AND day LIKE '$day%'
                                    AND startTime LIKE '$hour%' " . $extraSemConstraint .
                              "ORDER BY venue, startTime, module";
                    echo getResultAsTableString($query);
                    $conn->close();
                }
                else {
                    $query = "SELECT * FROM lecture 
                              WHERE $venueConstraint AND day LIKE '$day%'" .$extraSemConstraint .
                              "ORDER BY venue, startTime, module";
                    echo getResultAsTableString($query);
                    $conn->close();
                }
                    
            }
            else {
                echo "Problem retrieving information from form";
            }

        ?>

    </body>
</html>

