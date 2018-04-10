<html>
<head>
  <title>Add Location</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<?php

		$locations_array = readLocations();

		echo "<ul class=\"top-level-menu\">\n";
		echo "<li><a href=\"#\">Countries</a>\n";
        	echo "<ul class=\"second-level-menu\">\n";
		foreach($locations_array as $i)
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
	?>

</body>
</html>
