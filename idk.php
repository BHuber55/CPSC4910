<?php


echo "<html>\n";
echo "<head>\n";
echo   "<title>Copying Test</title>\n";
echo     "<link rel=\"stylesheet\" href=\"style.css\">\n";
echo "</head>\n";
echo "<body>\n";

echo     "<h1>Country: USA</h1>\n";
echo     "<h1>Facility: Chattanooga, TN 1</h1>\n";

    echo "<form action=\"createMonitorButtons.php\" method=\"post\">\n";
        echo  "<label>createnewHTML</label>\n";
        echo "<br>\n";
        echo "<label>Facility</label>\n";
        echo "<input type=\"text\" name=\"f\">\n";
        echo "<br>\n";

        echo "<label>Monitor</label>\n";
        echo "<input type=\"text\" name=\"m\">\n";
        echo "<br>\n";
        echo "<br>\n";

        echo "<input type=\"submit\" value=\"yeet\">\n";
    echo "</form>\n";


echo "</body>\n";
echo "</html>\n";



?>
