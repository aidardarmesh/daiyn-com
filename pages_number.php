<?php
	function pages_number_pdf($file){
    	$cmd = "./pdfinfo";

	    // PARSE ENTIRE OUTPUT
	    // SURROUND WITH DOUBLE QUOTES IF FILE NAME HAS SPACES
	    exec("$cmd \"$file\"", $output);

	    // ITERATE THROUGH LINES
	    $pagecount = 0;
	    foreach($output as $op){
	        // EXTRACT NUMBER
	        if(preg_match("/Pages:\s*(\d+)/i", $op, $matches) === 1){
	            $pagecount = intval($matches[1]);
	            break;
	        }
	    }
	    return $pagecount;
	}

	function pages_number_word($file){
		exec("java -jar pgs-numb.jar \"$file\"", $output);
		return $output[0];
	}
