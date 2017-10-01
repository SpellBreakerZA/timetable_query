<?php

    include 'clash_bucket.php';
	class TimeTable {
	
        var $EMPTY = "";
		var $days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
		var $times = array();
		var $timetable;
		var $clashes;
		function __construct() {
	
			$this->timetable = array();
			for($j = 0; $j < 5; $j++) {
				for ($i = 7; $i < 18; $i++) {
                    $temp = $i;
                    if ($i < 10) {
                        $temp = '0' . $i;
                    }
					$this->timetable[$this->days[$j]][$temp.':30'] = $this->EMPTY;
				}	
			}
			echo '<br>';
			$this->clashes = new ClashBucket();
		}
		
		function is_occupied($day, $time) {
			return $this->timetable[$day][$time] !== $this->EMPTY;
		}
		
		function add_subject($day, $time, $subject) {
            if ($this->is_occupied($day, $time)) {
                echo '<br> CLASH!<br>';
				$this->clashes->add_subject($day, $time, $subject);
			}
			else {
				$this->timetable[$day][$time] = $subject;
			}
		}
		
		function add_prac($day, $time_start, $time_end, $subject) {
            
			$ok = true;
            $time_start = (int)$time_start;
            $time_end = (int)$time_end;
            
            //loop to see if free for full time slot
			for($i  = $time_start; $i < $time_end && $ok === true; $i++) {
                $temp = $i;
                if ($i < 10) {
                    $temp = '0'.$i;
                }
				$currtime = $temp.':30';
				if ($this->is_occupied($day, $currtime)) {
					$ok = false;
                }
			}
			
            //final loop to book slot or declate a clash
            for($i  = $time_start; $i < $time_end && $ok === true; $i++) {
                $temp = $i;
                if ($i < 10) {
                    $temp = '0'.$i;
                }
                $currtime = $temp.':30';
                if ($ok === true) {
                    $this->timetable[$day][$currtime] = $subject;
                }
                else {
                    $this->clashes->add_subject($day, $currtime, $subject);
                }
                
            }
            
		}
		
		function print_raw() {
			var_dump($this->timetable);
			echo'<br>';
			echo'<br>';
		}
		
		function getClashes() {
			return $this->clashes;
		}
		
		function createHTMLTable() {
			$subjects = [$this->EMPTY=>0];
			$currentSubject = 1;
			$table = "<table class = 'time-table'>";
			$table .= "<thead> <tr> <td></td>";
			
			
			foreach ($this->days as $val) {
				$table .= " <td> $val </td>";
			}
			$table .= "  </tr></thead>";
			$table .= " <tbody style = 'border: 2px solid #000'>";
			
			for($i  = 7; $i < 18; $i++) {
				$temp = $i;
                if ($i < 10) {
                    $temp = '0' . $i;
                }
                
				$currtime = $temp.":30";
				$table .= "<tr> <td> $currtime </td>";
				foreach ($this->days as $day) {
					if(!isset($subjects[$this->timetable[$day][$currtime]])) {
						$subjects[$this->timetable[$day][$currtime]] = $currentSubject++;
					}
					$table .= " <td class='mod-".$subjects[$this->timetable[$day][$currtime]]	."'> ".$this->timetable[$day][$currtime]."</td>";
				}
				$table .= " </tr> ";
			}
			
			$table .= "</tbody></table>";	
			return $table;
		}   
	}

    function slice($time) {
        return substr($time, 0, 5);        
    }


?>