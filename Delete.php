<?php
// Brennan Huber
    session_start();

    $new_country = trim($_POST["new_country"]);
    $new_location = trim($_POST["new_location"]);
    $new_monitor = trim($_POST["new_monitor"]);

    if(!empty($new_country && !empty($new_location))) {
        // so new_country has stuff in it. We delete the facility.
    	deleteL();
    }

    if(!empty($new_location) && !empty($new_monitor)) {
        // new_location and new_monitor has stuff in it, then we can add the monitor
    	deleteM();
    }

// This will delete the country/facility
    function DeleteL() {
    	$locations = readLocations();

    	// so now we pull information that was entered in during the submit button.
        $new_country = trim($_POST["new_country"]);
        $new_location = trim($_POST["new_location"]);

        $locations = deleteLocation($locations, $new_country, $new_location);
        ksort($locations);
        exportLocations($locations);

        $_SESSION['New_Country'] = $new_country;
        $_SESSION['New_Location'] = $new_location;
        $_SESSION['locations'] = $locations;
    }

// This will detete the Monitor.
    function DeleteM() {
        $ma = readMonitors();

        // so now we pull information that was entered in during the submit button.
        $new_facility = trim($_POST["new_location"]);
        $new_monitor = trim($_POST["new_monitor"]);

        $ma = deleteMonitor($ma, $new_facility, $new_monitor);
        ksort($ma);

        exportMonitors($ma);

        $_SESSION['New_Location'] = $new_facility;
        $_SESSION['New_Monitor'] = $new_monitor;
        $_SESSION['monitors'] = $ma;
    }



// this function reads the file and will return an array containing the country as the key, and the line of the file as the value.
    function readLocations() {
        $locations = array();

        //opening the file so we can read everything.
        $file = fopen("Locations.txt", "r");

        while(!feof($file)) {
            $line = fgets($file);

            // making sure line isnt empty.
            if($line != "")
            {
                $line = trim($line);

                $splitted = explode(":", $line);
                $country = trim($splitted[0]);

                $locations[$country] = $line;
            }
        }

        // done with the file so lets close it.
        fclose($file);

        return $locations;
    }

// this function reads the file and will return an array containing the country as the key, and the line of the file as the value.
    function readMonitors() {
        $monitors = array();

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

                $monitors[$facility] = $line;
            }
        }

        // done with the file so lets close it.
        fclose($file);

        return $monitors;
    }

// this function exports the current list of locations to a file for future use.
    function exportLocations($locations) {
        $file = fopen("Locations.txt", "w");

        ksort($locations);

        foreach($locations as $j) {
            fwrite($file, $j . "\n");
        }

        fclose($file);
    }

// this function exports the current list of locations to a file for future use.
    function exportMonitors($monitors) {
        $file = fopen("Monitors.txt", "w");

        ksort($monitors, $sort_flags = SORT_STRING);

        foreach($monitors as $j) {
            fwrite($file, $j . "\n");
        }

        fclose($file);
    }

    function deleteLocation($la, $c, $l) {
        // lets make it so that if its the only location in the list then we will just delete the country as well. i.e if they remove cario then it'll take out egypt.

        if(array_key_exists($c, $la)) {
        // so the country exists in the array.
            $line = $la[$c];
            $a = explode(":", $line);

            $test = array_search($l, $a);


            if($test === false)
            {
            // then the location doesn't exist.
                return $la;
            }

            unset($a[$test]);
            $a = array_splice($a, 0);

            // now I gotta add everything back to the line.

            if(count($a) == 1)
            {
                // then all locations are removed so we remove the country as well.
                unset($la[$c]);
                $la = array_splice($la, 0);
            }
            else
            {
                // else there are still stuff in there.
                $la[$c] = "$c";
                foreach($a as $i)
                {
                    if(strcmp($c, $i) != 0) {
                        $la[$c] = $la[$c] . ":" . $i;
                    }
                }
                $la[$c] = $la[$c];
            }
        }

        exportLocations($la);

        return $la;
    }

        function deleteMonitor($ma, $f, $m) {
        // lets make it so that if its the only location in the list then we will just delete the country as well. i.e if they remove cario then it'll take out egypt.

        if(array_key_exists($f, $ma)) {
        // so the country exists in the array.
            $line = $ma[$f];
            $a = explode(":", $line);

            $test = array_search($m, $a);


            if($test === false)
            {
            // then the location doesn't exist.
                return $ma;
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

        exportMonitors($ma);

        return $ma;
    }

?>
