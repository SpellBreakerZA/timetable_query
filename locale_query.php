<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form</title>
        <?php include 'header.php'; ?>
    </head>
    <body>

        <?php include 'navbar.php' ?>
        <div class = "center">Your Query Results!</div>

        <?php
    
            function createTable($queryText, $day) {
                global $conn;
    
                $prototypeVenue = [];

                //Looping through all possible times
                for($i = 7; $i < 19; $i++) {
                    $prototypeVenue[str_pad($i, 2, '0', STR_PAD_LEFT).':30:00'] = [
                        'occupied' => false,
                        'startTime' => str_pad($i, 2, '0', STR_PAD_LEFT).':30:00',
                        'endTime' => str_pad($i+1, 2, '0', STR_PAD_LEFT).':30:00',
                        'day' => $day
                    ];
                }
    
                if ($queryText === null || $queryText === '') {
                    return "<div class = 'center'> null query! </div>";
                }

                $result = $conn->query($queryText);
//                echo $queryText . '<br>';

                if ($result === null || $result->num_rows == 0) {
                    return "<div class = 'center'> This venue is free for the given times</div>";
                }
                
                $venues = [];
                $table = "";
                while ($row = $result->fetch_assoc()) {

                    if ($row['module'] == null) {
                        continue;
                    }
                    if(!isset($venues[$row['venue']])) {
                        $venues[$row['venue']] = $prototypeVenue;
                    }
                    $venues[$row['venue']];
                    if(!isset($venues[$row['venue']][$row['startTime']])){
                        echo "Weirdness just happened";
                        $venues[$row['venue']][$row['startTime']] = [];
                    }
                    $venues[$row['venue']][$row['startTime']]['occupied'] = true;
                    $venues[$row['venue']][$row['startTime']]['startTime'] = $row['startTime'];
                    $venues[$row['venue']][$row['startTime']]['endTime'] = $row['endTime'];
                    $venues[$row['venue']][$row['startTime']]['day'] = $row['day'];
                }
                
                foreach($venues as $venueName => $venueTimes) {
                    
                    $table .= '<p class = "center">' . $venueName . '</p><table class = "table-responsive table-hover table-center"> <thead>';
                    $table .= '<tr>
                                <td> Occupied </td>
                                <td> Venue </td>
                                <td> Day </td>
                            </tr>';
                    $table .= '</thead>';
                    $table .= '<tbody>';
                    
                    foreach($venueTimes as $venueTime) {
                        $table .= '<tr class="'.($venueTime['occupied']?"red":"green").'">';
                            $table .= '<td>'.($venueTime['occupied']?"Occupied":"Free").'</td>';
                            $table .= '<td>'.$venueName.'</td>';
                            $startTime = trim($venueTime['startTime'],'0');
                            $endTime = trim($venueTime['endTime'],'0');
                            $table .= '<td>'.substr($venueTime['day'],0,3).' '.substr($startTime,0,strlen($startTime)-1).' - '.substr($endTime,0,strlen($endTime)-1).'</td>';                        
                    }
                     $table .= '</tr>'; 
                        $table .= '</tbody></table>';

                }
                
                return $table;

            }
        
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
                    echo "<br> <p style = 'text-align: center'>All halls in Chancellor's are Roos, Muller, Louw, Te Water</p> <br>";
                    
                } else if ($venue === "Chem Building") {
                    $venueConstraint = " (venue LIKE '%North%' 
                                          OR venue LIKE '%South%' 
                                          OR venue LIKE '%Large Chem%') "; 
                    echo "<br> <p style = 'text-align: center'>All halls in Chem Building are North, South and Large Chem</p> <br>";
                }
                else if ($venue === "Humanities") {
                    $venueConstraint = " (venue LIKE '%HB%') ";
                    echo "<br> <p style = 'text-align: center'> All humanities locations are 3-12, 3-14, 3-15, 3-23, 3-24 and 4-1 until 4-16 and then magically a 4-21 </p> <br>";
                }
                else if ($venue === "IT Building") {
                    $venueConstraint = " (venue LIKE '%IT%') ";
                    echo "<br> <p style = 'text-align: center'> All IT rooms are 2-24, 2-25, 2-26, 4-1, 4-2, 4-3, 4-4, 4-5</p> <br>";
                }
                else if ($venue === "EMB Building") {
                    $venueConstraint = " (venue LIKE '%EMB%') ";
                    echo "<br> <p style = 'text-align: center'>All EMB rooms are 2-150, 2-151, 4-150, 4-151, 4-152</p> <br>";
                }
                else {
                    $venueConstraint = " (venue LIKE '%$venue%') ";
                }
                
//                echo "Venue Constraint is " . $venueConstraint;
                
                if (isset($_POST['time'])) {
                    
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
                        echo createTable($query, $day);
                        $conn->close();
                    }
                    else {
                        if ( isset($_POST['start-time']) || isset($_POST['end-time']) ) {
                            $start = "";
                            $end = "";
                            if (isset($_POST['start-time'])) {
                                $start = $_POST['start-time'];
                            }
                            if (isset($_POST['end-time'])) {
                                $end = $_POST['end-time'];
                            }    
                                
                            $startHour = date('h', strtotime($start));   
                            $endHour = date('h', strtotime($end));   
                            $query = "SELECT * FROM lecture 
                                      WHERE $venueConstraint AND day LIKE '$day%'
                                            AND " . " startTime BETWEEN '$start' AND '$end' " . $extraSemConstraint . 
                                      "ORDER BY venue, startTime, module";
                            echo createTable($query, $day);
                            $conn->close();
                        }
                        else {
                                echo "Error detected with given time input";
                        } 
                        
                    }
                }
                else {
                    $query = "SELECT * FROM lecture 
                              WHERE $venueConstraint AND day LIKE '$day%'" .$extraSemConstraint .
                              "ORDER BY venue, startTime, module";
                    echo createTable($query, $day);
                    $conn->close();
                }
                    
            }
            else {
                echo "Problem retrieving information from form";
            }

        ?>
        
    </body>
</html>