<?php

    session_start();

    $slides_array = readSlides();

    // so now we pull information that was entered in during the submit button.
    // $new_name = trim($_POST["name"]);
    // $new_duration = trim($_POST["duration"]);

    // $slides_array = addSlide($slides_array, $new_name, $new_duration);
    // exportSlides($slides_array);

    $_SESSION['SLIDES'] = $slides_array;


    echo "<table border=\"1\">";
        echo "<tr>";
            echo "<th>Edit</th>";
            echo "<th>Name</th>";
            echo "<th>Duration</th>";
            echo "<th>Deletion</th>";
        echo "</tr>";

    foreach($slides_array as $i) {
        $a = explode(":", $i);
        echo "<tr>";
            echo "<td> <a href=\"editPage.php\">Edit</a></td>";
            echo "<td> href=\"THE NAME OF THE SLIDE .whatever\">$a[0]</td>";
            echo "<td>$a[1]</td>";
            echo "<td><a href=\"deleteSlide.php?name=$a[0]\">Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "<p>Insert the Drag and Drop feature here</p>";




function addSlide($slides, $n, $d) {
    // lets see if the country exists in the array.
    $slides[$n] = $n . ":" . $d;

    // so we have added the new country to the list, lets export it.
    exportSlides($slides);

    return $slides;
}

function deleteSlide($slides, $n) {
    if(array_key_exists($n, $slides)) {
        unset($slides[$n]);
        $slides = array_values($slides);
    }

    return $slides;
}


function readSlides() {
	$slides = array();

        //opening the file so we can read everything.
        $file = fopen("slides.txt", "r");

        while(!feof($file)) {
            $line = fgets($file);

            // making sure line isnt empty.
            if($line != "")
            {
                $line = trim($line);

                $splitted = explode(":", $line);
                $single = trim($splitted[0]);

                $slides[$single] = $line;
            }
        }

        // done with the file so lets close it.
        fclose($file);

        return $slides;
}

// this function exports the current list of locations to a file for future use.
function exportSlides($slides) {
    $file = fopen("slides.txt", "w");

    foreach($slides as $j) {
        fwrite($file, $j . "\n");
    }

    fclose($file);
}


?>
