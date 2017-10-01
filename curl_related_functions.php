<?php 

    //"http://upnet.up.ac.za/tt/hatfield_timetable.html"

    function getHTMLFromURL($url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $text = curl_exec($ch);
        curl_close($ch);

        return $text; 
    }

?>