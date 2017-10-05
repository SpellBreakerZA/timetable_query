<link rel="stylesheet" type = "text/css" href= "../css/timetable.css">
<?php 

    include '../database_tools.php';
    include 'timetable_scheduler_functions.php';
    
    class ModuleData {
        
        var $name;
        
        function __construct($module_code) {
            $this->name = $module_code;
        }
        
        function getCode() {
            return $this->name;
        }
        
        function getTimes($printHTML) {
            $queryText = "SELECT * FROM lecture WHERE module = '".$this->name."'";
            $result = getData($queryText);
            
            if ($result === null) {
                echo 'Error ocurred... ' . $this->name . ' could not be located';
            }
            else {
                $times = array();
                $html = ""; 
                while ($row = $result->fetch_assoc()) {
                    
                    array_push($times, $row);                    
                    $html .= '<br>';
                    foreach ($row as $key => $val) {
                        $html .= $key . " => " . $val . " ";
                    }
                    $html .= '<br>';
                }
                if ($printHTML) {
                    echo $html;
                }
                return $times;
            }
        }
    }

    /* MODULE: COS 226

        Array ( [0] => Array ( [id] => 284 [module] => COS 226 [venue] => GW/HB 4-3 [day] => Friday [startTime] => 15:30:00 [endTime] => 16:30:00 [timePeriod] => S2 [classType] => L4 [language] => E [groupNum] => G01 ) [1] => Array ( [id] => 1014 [module] => COS 226 [venue] => Raadpleeg/Consult Dept [day] => Thursday [startTime] => 10:30:00 [endTime] => 13:30:00 [timePeriod] => S2 [classType] => P1 [language] => E [groupNum] => G02 ) [2] => Array ( [id] => 1015 [module] => COS 226 [venue] => Raadpleeg/Consult Dept [day] => Monday [startTime] => 13:30:00 [endTime] => 16:30:00 [timePeriod] => S2 [classType] => P1 [language] => E [groupNum] => G01 ) [3] => Array ( [id] => 1016 [module] => COS 226 [venue] => Mullersaal/Muller hall [day] => Wednesday [startTime] => 13:30:00 [endTime] => 14:30:00 [timePeriod] => S2 [classType] => L3 [language] => E [groupNum] => G01 ) [4] => Array ( [id] => 1128 [module] => COS 226 [venue] => Raadpleeg/Consult Dept [day] => Thursday [startTime] => 13:30:00 [endTime] => 16:30:00 [timePeriod] => S2 [classType] => P1 [language] => E [groupNum] => G03 ) [5] => Array ( [id] => 1923 [module] => COS 226 [venue] => IT 4-4 [day] => Tuesday [startTime] => 14:30:00 [endTime] => 15:30:00 [timePeriod] => S2 [classType] => L2 [language] => E [groupNum] => G01 ) [6] => Array ( [id] => 2773 [module] => COS 226 [venue] => GW/HB 4-1 [day] => Monday [startTime] => 07:30:00 [endTime] => 08:30:00 [timePeriod] => S2 [classType] => L1 [language] => E [groupNum] => G01 ) ) 
        adding 10:30 13:30 adding 13:30 16:30 adding 13:30 16:30

        MODULE: SLK 120

        Array ( [0] => Array ( [id] => 747 [module] => SLK 120 [venue] => Roossaal/Roos hall [day] => Wednesday [startTime] => 15:30:00 [endTime] => 16:30:00 [timePeriod] => S2 [classType] => L2 [language] => E [groupNum] => G03 ) [1] => Array ( [id] => 748 [module] => SLK 120 [venue] => Roossaal/Roos hall [day] => Tuesday [startTime] => 14:30:00 [endTime] => 15:30:00 [timePeriod] => S2 [classType] => L1 [language] => E [groupNum] => G03 ) [2] => Array ( [id] => 935 [module] => SLK 120 [venue] => GW/HB 4-13 [day] => Wednesday [startTime] => 13:30:00 [endTime] => 14:30:00 [timePeriod] => S2 [classType] => T1 [language] => E [groupNum] => G04 ) [3] => Array ( [id] => 967 [module] => SLK 120 [venue] => GW/HB 4-8 [day] => Thursday [startTime] => 13:30:00 [endTime] => 14:30:00 [timePeriod] => S2 [classType] => T2 [language] => E [groupNum] => G03 ) [4] => Array ( [id] => 968 [module] => SLK 120 [venue] => IT 4-2 [day] => Monday [startTime] => 09:30:00 [endTime] => 10:30:00 [timePeriod] => S2 [classType] => T1 [language] => E [groupNum] => G03 ) [5] => Array ( [id] => 969 [module] => SLK 120 [venue] => GW/HB 4-15 [day] => Tuesday [startTime] => 12:30:00 [endTime] => 13:30:00 [timePeriod] => S2 [classType] => T1 [language] => E [groupNum] => G02 ) [6] => Array ( [id] => 970 [module] => SLK 120 [venue] => GW/HB 4-6 [day] => Thursday [startTime] => 13:30:00 [endTime] => 14:30:00 [timePeriod] => S2 [classType] => T2 [language] => A [groupNum] => G01 ) [7] => Array ( [id] => 971 [module] => SLK 120 [venue] => GW/HB 4-15 [day] => Monday [startTime] => 11:30:00 [endTime] => 12:30:00 [timePeriod] => S2 [classType] => T1 [language] => A [groupNum] => G01 ) [8] => Array ( [id] => 2221 [module] => SLK 120 [venue] => Thuto 1-2 [day] => Tuesday [startTime] => 11:30:00 [endTime] => 12:30:00 [timePeriod] => S2 [classType] => L2 [language] => E [groupNum] => G02 ) [9] => Array ( [id] => 2222 [module] => SLK 120 [venue] => Thuto 1-1 [day] => Monday [startTime] => 14:30:00 [endTime] => 15:30:00 [timePeriod] => S2 [classType] => L1 [language] => E [groupNum] => G02 ) [10] => Array ( [id] => 2223 [module] => SLK 120 [venue] => VD Bijlsaal/VD Bijl hall [day] => Tuesday [startTime] => 11:30:00 [endTime] => 12:30:00 [timePeriod] => S2 [classType] => L2 [language] => A [groupNum] => G01 ) [11] => Array ( [id] => 2224 [module] => SLK 120 [venue] => VD Bijlsaal/VD Bijl hall [day] => Monday [startTime] => 14:30:00 [endTime] => 15:30:00 [timePeriod] => S2 [classType] => L1 [language] => A [groupNum] => G01 ) ) 
    */

    
    $t = new TimeTable();
    $t = addModule('COS 226', $t);
    $t->add_subject('Monday','08:30','pinochio');
    $t = addModule('WTW 248', $t);
    $t = addModule('SLK 120', $t);
    $t = addModule('COS 122', $t);
    $t = addModule('GTS 261', $t);

    echo $t->createHTMLTable();
    $c = $t->getClashes();
    echo $c->createHTMLTable();

    function addModule($mod, $t) {
        $m = new ModuleData($mod);
        $times = $m->getTimes(false);
        echo "<br><p>MODULE: $mod </p><br>";
        print_r($times);
        echo "<br>";
        foreach($times as $lecture) {
            if ($lecture['classType'][0] == 'P') {
                echo ' adding ' . slice($lecture['startTime']) ." ". slice($lecture['endTime']);
                $t->add_prac($lecture['day'], slice($lecture['startTime']), slice($lecture['endTime']) , $lecture['module']);
            }
            else {
                $t->add_subject($lecture['day'], slice($lecture['startTime']),$lecture['module']);
            }
        }
        return $t;
            
    } 
        
?>