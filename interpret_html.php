<?php 

    if (isset($_POST)) {
        
        $textReceived = $_POST['text'];
        $text = '<tr><td>2/EKN 214/G02/E/L2</td><td>S1</td><td>Thursday</td><td>11:30:00</td><td>12:30:00</td><td>Louwsaal/Louw hall</td></tr>';
        echo $textReceived;
        echo '<br>';
        
        /* The text  provide follows the following format
            
            ++
            -- Module / Group / Language
            -- Semester
            -- Day
            -- Time Start
            -- Time ends
            -- Venue
            ++ 
        
        */
        
        include 'insert_lecture.php';
        createTables();
        
        $match = preg_match("/($textReceived)/i", $text, $results);
        if ($match) {
            echo 'Found the following! = ' . $results[0];
        }
        else echo 'Found nothing :(';
        
        echo "opening file";
        $file = fopen('sample.txt','r') or die("FAILED!");
        echo "opened file";
        while (!feof($file)) {
            $text = fgets($file);
            //echo $text;
            $vals = getAssociatedValues($text);
            echo '<br>';
            print_r($vals);
            $time = getSemester($vals);
            $day = getDay($vals);
            $start = getStartTime($vals);
            $end = getEndTime($vals);
            $venue = getVenue($vals);
            $module = getModule($vals);
            $classType = getClassType($vals);
            echo '<br>';
            echo '<br>' . getSemester($vals);
            echo '<br>' . getDay($vals);
            echo '<br>' . getStartTime($vals);
            echo '<br>' . getEndTime($vals);
            echo '<br>' . getVenue($vals);
            echo '<br>' . getModule($vals);
            echo '<br>' . getClassType($vals);
            
            insertLecture($module, $venue, $start, $end, $time, $day, $classType);
            
            
        }
        fclose($file);
        $conn->close();
    }

    function getAssociatedValues($string) {
        
        //$string = mysqli_escape($string);
        $match = preg_match('/<tr><td>(.*)<\/td><td>(.*)<\/td><td>(.*)<\/td><td>(.*)<\/td><td>(.*)<\/td><\/tr>/i',$string, $results);
        
        if ($match) {
            return $results;
        }
        else return null;
    }

    function getModule($results) {
        
        $str =  $results[1];
        $match = preg_match('/.\/([\w\s]{7}).*/', $results[1], $output);
        
        if ($match) {
            return $output[1];
        }
        else return null;
        
    }

    function getSemester($results) {
        
        $str =  $results[1];
        echo $str;
        $match = preg_match('/<td>(.*)/', $results[1], $output);
        if ($match) {
            return $output[1];
        }
        else return null;
    }

    function getDay($results) {
        return $results[2];
    }

    function getStartTime($results) {
        return $results[3];
    }
    function getEndTime($results) {
        return $results[4];
    }
    function getVenue($results) {
        return $results[5];
    }

    function getClassType($results) {
        $str =  $results[1];
        $match = preg_match('/.\/.*\/.*\/.*\/(.*)<\/.*./', $results[1], $output);
        
        if ($match) {
            return $output[1];
        }
        else return null;
    } 

?>