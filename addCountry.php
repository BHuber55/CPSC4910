<?php

    Add();

    // now lets go to the new page to create a new document.


    function Add() {
        // locations[country] = [country:city1:city2:city3]
        $locations_array = readLocations();

        // so now we pull information that was entered in during the submit button.
        $new_country = trim($_POST["new_country"]);
        $new_location = trim($_POST["new_location"]);
        $new_monitor = trim($_POST["new_monitor"]);

        $locations_array = addLocation($locations_array, $new_country, $new_location, $new_monitor);
        ksort($locations_array);
        exportLocations($locations_array);
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

    // this function exports the current list of locations to a file for future use.
    function exportLocations($locations) {
        $file = fopen("Locations.txt", "w");

        ksort($locations, $sort_flags = SORT_STRING);

        foreach($locations as $j) {
            fwrite($file, $j . "\n");
        }

        fclose($file);
    }

    // adds location to the array. Returns array just in case ya know.
    function addLocation($la, $c, $l, $m) {
        // lets see if the country exists in the array.
        if(array_key_exists($c, $la)) {
            $la[$c] = $la[$c] . ":" . $l;
        } else {
            // else its not in the array.. so we just insert it into.
            $la[$c] = $c . ":" . $l;
        }

        // so we have added the new country to the list, lets export it.
        exportLocations($la);

        return $la;
    }
?>
