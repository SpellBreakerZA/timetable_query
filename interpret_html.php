<?php 
        include 'insert_lecture.php';
        createTables();
        
        include 'curl_related_functions.php';
        
        $updatedhtmlcontent = getHTMLFromURL("http://upnet.up.ac.za/tt/hatfield_timetable.html");
        file_put_contents('updatehtmlpage.txt', $updatedhtmlcontent);
        
        $file = fopen('updatehtmlpage.txt','r') or die("FAILED!");
        while (!feof($file)) {
            $text = fgets($file);
            $vals = getAssociatedValues($text);
            $time = getSemester($vals);
            $day = getDay($vals);
            $start = getStartTime($vals);
            $end = getEndTime($vals);
            $lang = getLanguage($vals);
            $venue = getVenue($vals);
            $module = getModule($vals);
            $classType = getClassType($vals);
            $group = getGroup($vals);
//            echo '<br>';
//            echo '-------------------------------------------------<br>';
//            echo '<br>' . getModule($vals);
//            echo '<br>' . getDay($vals);
//            echo '<br>' . getVenue($vals);
//            echo '<br>' . getStartTime($vals);
//            echo '<br>' . getEndTime($vals);
//            echo '<br>' . getSemester($vals);
//            echo '<br>' . getClassType($vals);
//            echo '-------------------------------------------------';
            
            insertLecture($module, $venue, $start, $end, $lang, $time, $day, $classType, $group);
            
            $conn->query("DELETE FROM lecture WHERE module IS NULL");
 
        }
        fclose($file);
        $conn->close();
        
        header("Location: index.php");
        exit;

    /* The following functions use regular expressions to extract the data from the provided html page.
        The expressions aren't perfect but they extract the data of interest perfectly.
    
        The text retrieved  follows the following format
        
            -------------Key---------------
            ++ represents a <tr> tag
            -- represents in a <td> tag 
            -------------------------------

            ++
            -- Module / Group / Language
            -- Semester
            -- Day
            -- Time Start
            -- Time ends
            -- Venue
            ++ 
        
        Some values needed further extraction such as the module code
        
        */

    function getAssociatedValues($string) {
        
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

    function getGroup($results) {
        $str =  $results[1];
        echo $str;
        $match = preg_match('/.\/.*\/([\w\d]{3}).*/', $results[1], $output);
        
        if ($match) {
            return $output[1];
        }
        else return null;
    }

    function getSemester($results) {
        
        $str =  $results[1];
//        echo $str;
        $match = preg_match('/<td>(.*)/', $results[1], $output);
        if ($match) {
            return $output[1];
        }
        else return null;
    }

    function getLanguage($results) {
        $str =  $results[1];
        $match = preg_match('/.*\/.*\/.*\/(\w{1})\//', $results[1], $output);
        
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