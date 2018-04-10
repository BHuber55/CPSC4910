<?php

    // locations[country] = [country:city1:city2:city3]
    $ma = readMonitors();

    // so now we pull information that was entered in during the submit button.
    $facility = trim($_POST["new_locations"]);
    $monitor = trim($_POST["new_monitor"]);

    $ma = deleteLocation($ma, $facility, $monitor);




    // this function reads the file and will return an array containing the country as the key, and the line of the file as the value.
    function readMonitors() {
        $ma = array();

        //opening the file so we can read everything.
        $file = fopen("Monitors.txt", "r");

        while(!feof($file)) {
            $line = fgets($file);

            // making sure line isnt empty.
            if($line != "")
            {
                $line = trim($line);

                $splitted = explode(":", $line);
                $facility = trim($splitted[0]);

                $ma[$facility] = $line;
            }
        }

        // done with the file so lets close it.
        fclose($file);

        return $ma;
    }

    // this function exports the current list of locations to a file for future use.
    function exportMonitors($ma) {
        $file = fopen("Monitors.txt", "w");

        ksort($ma, $sort_flags = SORT_STRING);

        foreach($ma as $j) {
            fwrite($file, $j . "\n");
        }

        fclose($file);
    }

    function deleteLocation($ma, $f, $m) {
        // lets make it so that if its the only location in the list then we will just delete the country as well. i.e if they remove cario then it'll take out egypt.

        if(array_key_exists($f, $ma)) {
        // so the country exists in the array.
            $line = $ma[$f];
            $a = explode(":", $line);

            $test = array_search($m, $a);


            if($test === false)
            {
            // then the location doesn't exist.
                return 0;
            }

            unset($a[$test]);
            $a = array_splice($a, 0);

            // now I gotta add everything back to the line.

            if(count($a) == 1)
            {
                // then all locations are removed so we remove the country as well.
                unset($ma[$f]);
                $ma = array_splice($ma, 0);
            }
            else
            {
                // else there are still stuff in there.
                $ma[$f] = "$f";
                foreach($a as $i)
                {
                    if(strcmp($f, $i) != 0) {
                        $ma[$f] = $ma[$f] . ":" . $i;
                    }
                }
                $ma[$f] = $ma[$f];
            }
        }
        else {
            // the country doesn't exists.
            return 0;
        }

        exportMonitors($ma);

        return $ma;
    }
?>
