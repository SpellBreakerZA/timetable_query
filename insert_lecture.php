<?php

    include 'database_connection.php';
    include 'database_tools.php';

    function insertLecture($module, $venue, $start, $end, $time, $day, $classType) {
        
        global $conn;
        $stmt = $conn->prepare('INSERT INTO lecture (module, venue, startTime, endTime, timePeriod, day, classType) VALUES(?,?,?,?,?,?,?)');
        
        $stmt->bind_param("sssssss", $module, $venue, $start, $end, $time, $day, $classType);
        $stmt->execute();
        
    }
?>