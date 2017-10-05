<?php 

    class Group {

                var $entries;
                var $size;

                /*Entries is an array of timetableentry objects */
                function __construct($arr, $size) {
                        $this->entries = $arr;
                        $this->size = $size;
                }

                function get_group() {
                        if ($this->size > 0) {
                                return $this->entries[0]->get_group();
                        }
                        else return null;
                }

                function get_entry($index) {
                        if ($index >= 0 && $index < $size) {
                                return $this->entries[$index];
                        }
                        return null;
                }

                function get_all_entries() {
                        return $this->entries;
                }

                function get_size() {
                        return $this->size;
                }

                function to_string() {
                    $str = "GROUP: <br>";
                    foreach($this->entries as $entry) {
                        $str .= $entry->to_string();
                        $str .= "<br>";
                    }
                    return $str;
                }
        
        }
?>