<?php

	session_start();

	$slides_array = $_SESSION['SLIDES'];
	$name = $_GET['name'];



	deleteSlide($slides_array, $name);
	header("Location: slideList.php");
	exit;



	function deleteSlide($slides, $n) {
	    if(array_key_exists($n, $slides)) {
	        unset($slides[$n]);
	        $slides = array_values($slides);
	    }

	    exportSlideS($slides);

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
