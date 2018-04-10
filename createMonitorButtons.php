<html>
<head>
  <title>Buttons</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

    // locations[country] = [country:city1:city2:city3]
    $ma = readMonitors();

    createMonitorButtons($ma["Chattanooga, TN 1"]);







    function createMonitorButtons($f) {
        $a = explode(":", $f);

        echo "Monitors for: $a[0] </br>";

        for($i = 1; $i < count($a); $i++) {
            echo "<form method=\"get\" action =\"https://www.google.com\">";
                echo "<button type=\"submit\">$a[$i]</button>";
            echo "</form>";
        }
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

</body>
</html>
