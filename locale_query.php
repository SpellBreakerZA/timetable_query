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
                
                if (isset($_POST['now'])) {
                    $now = true;
                    //adding two hours to the time because the server
                    //time is wrong apparently
                    $time = time() + (2 * (60*60)); 
                    $hour = date('h', $time);
                    $query = "SELECT * FROM lecture 
                              WHERE venue LIKE '%$venue%' AND day LIKE '$day%'
                                    AND startTime LIKE '$hour%' " . $extraSemConstraint .
                              "ORDER BY venue, startTime, module";
                    echo getResultAsTableString($query);
                    $conn->close();
                }
                else {
                    $query = "SELECT * FROM lecture 
                              WHERE venue LIKE '%$venue%' AND day LIKE '$day%'" .$extraSemConstraint .
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

