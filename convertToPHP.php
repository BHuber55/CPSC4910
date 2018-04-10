<?php

    $file = fopen("AdminPage.html", "r");
    $new_file = fopen("AdminPage.php", "w");


    // writing the php header.
    fputs($new_file, "<?php\n");

    while(!feof($file)) {
        $line = rtrim(fgets($file));

        if(strpos($line, "\"") !== false) {
            $line = addslashes($line);
        }

        $line = "echo \"" . $line . "\";\n";

        fputs($new_file, $line);
    }

    fputs($new_file, "?>");

    fclose($file);
    fclose($new_file);

?>
