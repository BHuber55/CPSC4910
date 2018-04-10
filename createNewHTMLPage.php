<?php
    session_start();

    // pull information
    $country = $_SESSION["New_Country"];
    $facility = $_SESSION["New_Location"];
    $monitor = $_SESSION["New_Monitor"];


    // open the default html file that we are going to copy from.
    $default_file = fopen("Default.html", "r");
    $new_file = fopen("$facility.html", "w");


    // so this copies everything from default over to the new file..
    while(!feof($default_file)) {
        $line = trim(fgets($default_file));

        if(strpos($line, 'COUNTRY') !== false) {
            $line = str_replace('COUNTRY', $country, $line);
        }

        if(strpos($line, 'FACILITY') !== false) {
            $line = str_replace('FACILITY', $facility, $line);
        }

        if(strpos($line, 'MONITOR') !== false) {
            $line = str_replace('MONITOR', $monitor, $line);
        }



        fwrite($new_file, $line . "\n");
    }

    // so now lets search the new file for the variables we are interested in changing..

    fclose($default_file);
    fclose($new_file);


    // we will go check out the new page.
    $fileloc = "/SCHOOL/$facility.html";
    header('Location: ' . $fileloc);


?>
