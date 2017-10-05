<?php

        /* type refers to prac/lecture/tut/discusion */
        class TimeTableEntry {

                var $code;
                var $type;
                var $startTime;
                var $endTime;
                var $group;
                var $prio;
                var $place;
                var $day;

                function __construct($code, $type, $day,  $startTime, $endTime, $group, $place, $prio) {
                        $this->code = $code;
                        $this->type = $type;
                        $this->day = $day;
                        $this->startTime = $startTime;
                        $this->endTime = $endTime;
                        $this->group = $group;
                        $this->prio = $prio;
                        $this->place = $place;
                }

                function get_code() { 
                        return $this->code; 
                }

                function get_type() { 
                        return $this->type; 
                }

                function get_start() { 
                        return $this->startTime; 
                }
                function get_start_as_int() { 
                        return (int) $this->startTime; 
                }
            
                function get_end() { 
                        return $this->endTime; 
                }
                function get_end_as_int() { 
                        return (int) $this->endTime; 
                }

                function get_group() { 
                        return $this->group; 
                }

                function get_prio() { 
                        return $this->prio; 
                }
            
                function get_day() { 
                        return $this->day; 
                }
            
                function to_string() {
                    $str = "TimeTableEntry: ";
                    $str .= "Code: $this->code, Day: '$this->day' , Start: '$this->startTime', End: '$this->endTime', Place: $this->place, Prio: $this->prio, Type: $this->type, Group: $this->group";
                    return $str;
                }

        }

?>