<?php

    // Still have to figure out how we are going to be storing the monitor list as well

    // locations[country] = [country:city1:city2:city3]
    $locations_array = readLocations();

    // so now we pull information that was entered in during the submit button.
    $new_country = trim($_POST["new_country"]);
    $new_location = trim($_POST["new_location"]);
    $new_monitor = trim($_POST["new_monitor"]);

    deleteLocation($locations_array, $new_country, $new_location, $new_monitor);






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

        ksort($locations);

        foreach($locations as $j) {
            fwrite($file, $j . "\n");
        }

        fclose($file);
    }

    function deleteLocation($la, $c, $l, $m) {
        // lets make it so that if its the only location in the list then we will just delete the country as well. i.e if they remove cario then it'll take out egypt.

        if(array_key_exists($c, $la)) {
        // so the country exists in the array.
            $line = $la[$c];
            $a = explode(":", $line);

            $test = array_search($l, $a);


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
        else {
            // the country doesn't exists.
            return 0;
        }

        exportLocations($la);

        return $la;
    }
?>
