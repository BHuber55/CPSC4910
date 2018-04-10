<?php

// Brennan Huber
    session_start();

    $new_country = trim($_POST["new_country"]);
    $new_location = trim($_POST["new_location"]);
    $new_monitor = trim($_POST["new_monitor"]);

    if(!empty($new_country)) {
        // so new_country has stuff in it. We add the location.
        AddL();
    }

    if(!empty($new_location) && !empty($new_monitor)) {
        // new_location and new_monitor has stuff in it, then we can add the monitor
        AddM();
    }

    $_SESSION['New_Country'] = $new_country;
    $_SESSION['New_Location'] = $new_location;
    $_SESSION['New_Monitor'] = $new_monitor;

    header('Location: /SCHOOL/createNewHTMLPage.php');



    function AddL() {
        // locations[country] = [country:city1:city2:city3]
        $la = readLocations();

        // so now we pull information that was entered in during the submit button.
        $new_country = trim($_POST["new_country"]);
        $new_location = trim($_POST["new_location"]);

        $la = addLocation($la, $new_country, $new_location);
        ksort($la);
        exportLocations($la);

        $_SESSION['locations'] = $la;
    }

    function AddM() {
        // locations[country] = [country:city1:city2:city3]
        $ma = readMonitors();

        // so now we pull information that was entered in during the submit button.
        $new_facility = trim($_POST["new_location"]);
        $new_monitor = trim($_POST["new_monitor"]);

        $ma = addMonitor($ma, $new_facility, $new_monitor);
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
        $ma = array();

        //opening the file so we can read everything.
        $file = fopen("/staging.woodbridgemonitorhub.appspot.com/FileUploads/Monitors.txt", "r");

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
    function exportLocations($locations) {
        $file = fopen("Locations.txt", "w");

        ksort($locations, $sort_flags = SORT_STRING);

        foreach($locations as $j) {
            fwrite($file, $j . "\n");
        }

        fclose($file);
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

    // adds location to the array. Returns array just in case ya know.
    function addLocation($la, $c, $l) {

        if(empty($l)) {
            // if the location is empty.
            $la[$c] = $c;
            exportLocations($la);
            return $la;
        }
        if(array_key_exists($c, $la)) {
            // the country exists in the array.

            if(strpos($la[$c], $l) === false) {
                // check to make sure the location isnt already in the array
                $la[$c] = $la[$c] . ":" . $l;
            }
        } else {
            // else the country isnt in the array
            $la[$c] = $c . ":" . $l;
        }

        // so we have added the new country to the list, lets export it.
        exportLocations($la);

        return $la;
    }

    // adds location to the array. Returns array just in case ya know.
    function addMonitor($ma, $f, $m) {
        // lets see if the country exists in the array.
        if(array_key_exists($f, $ma)) {
            if(strpos($ma[$f], $m) === false) {
                $ma[$f] = $ma[$f] . ":" . $m;
            }
        } else {
            // else its not in the array.. so we just insert it into.
            $ma[$f] = $f . ":" . $m;
        }

        // so we have added the new country to the list, lets export it.
        exportMonitors($ma);

        return $ma;
    }
?>
