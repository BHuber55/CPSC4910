<?php

	session_start();

	$locations_array = readLocations();
	$monitors_array = readMonitors();

echo "";
echo "<html>";
echo "<head>";
echo "  <title>Admin Page</title>";
echo "    <link rel=\"stylesheet\" href=\"style.css\">";
echo "</head>";
echo "<body>";
echo "";
echo "    <h1>Admin Page</h1>";
echo "";
echo "<!-- Need to make it so you hit a button and the text fields pop up for you to enter in what you want to add/delete. -->";
echo "<!-- I need to make the corresponding php files generate/delete the correct webpage for each location added/deleted. -->";
echo "<!-- Try to combine the addCountry and addMonitor into one thing.       DONE. -->";
echo "";
echo "";
echo "";
echo "<!-- Add  -->";
echo "    <form action=\"Add.php\" method=\"post\">";
echo "        <label>Add Location</label>";
echo "        <br>";
echo "";
echo "        <label>Country</label>";
echo "        <input type=\"text\" name=\"new_country\">";
echo "        <br>";
echo "";
echo "        <label>Facility</label>";
echo "        <input type=\"text\" name=\"new_location\">";
echo "        <br>";
echo "";
echo "        <label>Monitor</label>";
echo "        <input type=\"text\" name=\"new_monitor\">";
echo "        <br>";
echo "";
echo "        <input type=\"submit\" value=\"Add\">";
echo "        <br>";
echo "    </form>";
echo "";
echo "<!-- Delete  -->";
echo "    <form action=\"Delete.php\" method=\"post\">";
echo "        <label>Delete Location</label>";
echo "        <br>";
echo "";
echo "        <label>Country</label>";
echo "        <select name=\"country\">";
					$countries = array_keys($locations_array);

					foreach($countries as $c) {
						echo "<option value=\"$c\">$c</option>";
					}
echo "        </select>";
echo "        <br>";
echo "";
echo "        <label>Facility</label>";
echo "        <select name=\"country\">";
echo "            <option value=\"Red\">Red</option>";
echo "            <option value=\"Green\">Green</option>";
echo "            <option value=\"Blue\">Blue</option>";
echo "            <option value=\"Pink\">Pink</option>";
echo "            <option value=\"Yellow\">Yellow</option>";
echo "        </select>";
echo "        <br>";
echo "";
echo "        <label>Monitor</label>";
echo "        <select name=\"country\">";
echo "            <option value=\"Red\">Red</option>";
echo "            <option value=\"Green\">Green</option>";
echo "            <option value=\"Blue\">Blue</option>";
echo "            <option value=\"Pink\">Pink</option>";
echo "            <option value=\"Yellow\">Yellow</option>";
echo "        </select>";
echo "        <br>";
echo "";
echo "        <input type=\"submit\" name=\"submit\" value=\"Delete\" />";
echo "    </form>";
echo "";
echo "";
echo "";
echo "";
echo "";
echo "</body>";
echo "</html>";
echo "";
echo "";
echo "";



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
