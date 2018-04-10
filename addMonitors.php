<?php

    session_start();

    // locations[country] = [country:city1:city2:city3]
    $ma = readMonitors();

    // so now we pull information that was entered in during the submit button.
    $facility = trim($_POST["new_locations"]);
    $monitor = trim($_POST["new_monitor"]);

    $ma = addMonitor($ma, $facility, $monitor);
    ksort($ma);

    // now lets go to the new page to create a new document.

    $_SESSION['New_Location'] = $facility;
    $_SESSION['New_Monitor'] = $monitor;

    header('Location: /SCHOOL/newFile.html');



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

    // adds location to the array. Returns array just in case ya know.
    function addMonitor($ma, $f, $m) {
        // lets see if the country exists in the array.
        if(array_key_exists($f, $ma)) {
            $ma[$f] = $ma[$f] . ":" . $m;
        } else {
            // else its not in the array.. so we just insert it into.
            $ma[$f] = $f . ":" . $m;
        }

        // so we have added the new country to the list, lets export it.
        exportMonitors($ma);

        return $ma;
    }
?>
