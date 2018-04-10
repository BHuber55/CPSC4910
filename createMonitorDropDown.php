<html>
<head>
  <title>Drop Down</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <?php

    // locations[country] = [country:city1:city2:city3]
    $ma = readMonitors();


    createMonitorDropDown($ma);







    function createMonitorDropDown($ma) {
        echo "<ul class=\"top-level-menu\">\n";
        echo "<li><a href=\"#\">Facilities</a>\n";
            echo "<ul class=\"second-level-menu\">\n";
        foreach($ma as $i)
        {
            $a = explode(":", $i);

            // prints out the country name.
            echo "<li><a href=\"#\">$a[0]\n";

            echo "<ul class=\"third-level-menu\">\n";
            for($i = 1; $i < count($a); $i++)
            {
                echo "<li><a href=\"#\">$a[$i]</li>\n";
            }
            echo "</li>\n";
            echo "</ul>\n";

        }

            echo "</ul>\n";
        echo "</ul>\n";
    }

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

?>
