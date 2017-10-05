<?php

class TimeTable {

                var $days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
                var $times = array();
                var $timetable;
                var $clashes;
                function __construct() {

                        $this->timetable = array();
                        for($j = 0; $j < 5; $j++) {
                                for ($i = 7; $i < 18; $i++) {
                                        $this->timetable[$this->days[$j]][$i.':30'] = "Unoccupied";
                                }
                        }
                        echo '<br>';
                        $this->clashes = new ClashBucket();
                }

                function is_occupied($day, $time) {
                    
                        //echo "Day: '$day' && time: '$time'";
                        return $this->timetable[$day][$time] !== "Unoccupied";
                }

                function add_subject($day, $time, $subject) {
                        if (!$this->is_occupied($day, $time)) {
                                $this->timetable[$day][$time] = $subject;
                        }
                        else {
                                echo 'CLASH!';
                                $this->clashes->add_subject($day, $time, $subject);
                        }
                }
    
                //time_start and time_end are integer values
                function add_prac($day, $time_start, $time_end, $subject) {
                        $ok = true;
                        for($i  = $time_start; $i < $time_end && $ok === true; $i++) {
                                $currtime = $i.':30';
                                if (!$this->is_occupied($day, $currtime)) {
                                        $this->timetable[$day][$currtime] = $subject;
                                }
                                else {
                                        $ok = false;
                                        $this->clashes->add_prac($day, $time_start, $time_end, $subject);
                                }
                        }

                        if ($ok === false) {
                            echo 'CLASH!';
                        }
                    
                    //return whether is was successfully added
                    return $ok;
                }

                function print_table() {
                        var_dump($this->timetable);
                        echo'<br>';
                        echo'<br>';
                }

                function getClashes() {
                        return $this->clashes;
                }

                function createHTMLTable() {
                        $subjects = ["Unoccupied"=>0];
                        $currentSubject = 1;
                        $table = "<table class = 'css timetable'>";
                        $table .= "<thead> <tr> <td></td>";


                        foreach ($this->days as $val) {
                                $table .= " <td> $val </td>";
                        }
                        $table .= "  </tr></thead>";
                        $table .= " <tbody style = 'border: 2px solid #000'>";

                        for($i  = 7; $i < 18; $i++) {

                                $currtime = $i.":30";
                                $table .= "<tr> <td> $currtime </td>";
                                foreach ($this->days as $day) {
                                        if(!isset($subjects[$this->timetable[$day][$currtime]])) {
                                                $subjects[$this->timetable[$day][$currtime]] = $currentSubject++;
                                        }
                                        $table .= " <td class='mod-".$subjects[$this->timetable[$day][$currtime]]       ."'> ".$this->timetable[$day][$currtime]."</td>";
                                }
                                $table .= " </tr> ";
                        }

                        $table .= "</tbody></table>";
                        return $table;
                }

        }

        class ClashBucket {

                var $days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
                var $times = array();
                var $timetable;
            
                function __construct() {

                        $this->timetable = array();
                        for($j = 0; $j < 5; $j++) {
                                for ($i = 7; $i < 18; $i++) {
                                    $this->timetable[$this->days[$j]][$i.':30'] = array();
                                }
                        }
                        echo '<br>';
                }

                function add_subject($day, $time, $subject) {                        
                        array_push($this->timetable[$day][$time], $subject);
                }

                //time_start and time_end are integer values
                function add_prac($day, $time_start, $time_end, $subject) {
                        for($i  = $time_start; $i < $time_end; $i++) {
                                $currtime = $i.':30';
                                //echo $currtime . ' ' . $day;
                                if ($this->timetable[$day][$currtime] != null) {
                                    array_push($this->timetable[$day][$currtime], $subject);
                                }
                        }
                }

                function remove_subject($day, $time) {
                        $this->timetable[$day][$time] = "Unoccupied";
                }

                function remove_prac($day, $time_start, $time_end) {
                        for($i  = $time_start; $i < $time_end; $i++) {
                                $currtime = $i.':30';
                                $this->timetable[$day][$currtime] = "Unoccupied";
                        }
                }

                function print_table() {
                        var_dump($this->timetable);
                        echo'<br>';
                        echo'<br>';
                }

                function createHTMLTable() {                        
                        $table = "<table class = 'css clash-table'>";
                        $table .= "<thead> <tr> <td></td>";
                        foreach ($this->days as $val) {
                                $table .= " <td> $val </td>";
                        }
                        $table .= "  </tr></thead>";
                        $table .= " <tbody style = 'border: 2px solid #000'>";

                        for($i  = 7; $i < 18; $i++) {

                                $currtime = $i.":30";
                                $table .= "<tr> <td> $currtime </td>";
                                foreach ($this->days as $day) {
                                        $table .= " <td> ". count($this->timetable[$day][$currtime])."</td>";
                                }
                                $table .= " </tr> ";
                        }

                        $table .= "</tbody></table>";
                        return $table;
                }

                function createHTMLTableVerbose() {
                        $table = "<table class = 'css'>";
                        $table .= "<thead> <tr> <td></td>";

                        foreach ($this->days as $val) {
                                $table .= " <td> $val </td>";
                        }
                        $table .= "  </tr></thead>";
                        $table .= " <tbody style = 'border: 2px solid #000'>";

                        for($i  = 7; $i < 18; $i++) {

                               $currtime = $i.":30";
                                $table .= "<tr> <td> $currtime </td>";
                                foreach ($this->days as $day) {
                                    $table .= " <td> ";
                                    foreach($this->timetable[$day][$currtime] as $module) {
                                        if ($module == "") {
                                            $table .= "---"; 
                                        }
                                        else {
                                            $table .= $module . " ";    
                                        }
                                    }        
                                    $table .= "</td>";
                                }
                                $table .= " </tr> ";
                        }

                        $table .= "</tbody></table>";
                        return $table;
                }

        }

?>