<?php
    class ClashBucket {
	
        var $EMPTY = "";
		var $days = array('Monday','Tuesday','Wednesday','Thursday','Friday');
		var $times = array();
		var $timetable;
		function __construct() {
	
			$this->timetable = array();
			for($j = 0; $j < 5; $j++) {
				for ($i = 7; $i < 18; $i++) {
                    $temp = $i;
                    if ($i < 10) {
                        $temp = '0' . $i;
                    }
					$this->timetable[$this->days[$j]][$temp.':30'] = array();
				}	
			}
			echo '<br>';
		}
		
		function add_subject($day, $time, $subject) {
			array_push($this->timetable[$day][$time], $subject);
		}
		
		//time_start and time_end are integer values
		function add_prac($day, $time_start, $time_end, $subject) {
            $time_start = (int)$time_start;
            $time_end = (int)$time_end;
			for($i  = $time_start; $i < $time_end; $i++) {
                $temp = $i;
                if ($i < 10) {
                    $temp = '0'.$i;
                }
				$currtime = $temp.':30';
				array_push($this->timetable[$day][$currtime], $subject);
			}
		}
		
		function remove_subject($day, $time) {
			$this->timetable[$day][$time] = $this->EMPTY;
		}
		
		function remove_prac($day, $time_start, $time_end) {
			for($i  = $time_start; $i < $time_end; $i++) {	
				$currtime = $i.':30';
				$this->timetable[$day][$currtime] = $this->EMPTY;
			}
		}
		
		function print_raw() {
			var_dump($this->timetable);
			echo'<br>';
			echo'<br>';
		}
		
		function createHTMLTable() {
			//$subjects = [$this->EMPTY=>0];
			//$currentSubject = 1;
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
					$table .= " <td> ". count($this->timetable[$day][$currtime])."</td>";
				}
				$table .= " </tr> ";
			}
			
			$table .= "</tbody></table>";	
			return $table;
		}
		
	}
	
?>