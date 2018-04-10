<?php

    $slides_array = readSlides();

    // so now we pull information that was entered in during the submit button.
    $new_name = trim($_POST["name"]);
    $new_duration = trim($_POST["duration"]);

    $slides_array = addSlide($slides_array, $new_name, $new_duration);
function addSlide($slides, $n, $d) {
    // lets see if the country exists in the array.
    $slides[$n] = $n . ":" . $d;

    // so we have added the new country to the list, lets export it.
    exportSlides($slides);

    $_SESSION['SLIDES'] = $slides;

    return $slides;
}

function exportSlides($slides) {
    $file = fopen("slides.txt", "w");

    foreach($slides as $j) {
        fwrite($file, $j . "\n");
    }

    fclose($file);
}


?>
