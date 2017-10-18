<?php

function convert_address(){
	// check if the repeater field has rows of data
	if( have_rows('addresses') ):
	
	    // loop through the rows of data
	    while ( have_rows('addresses') ) : the_row();
	
          //Get the Address from a repeater created with ACF
	        $address = get_sub_field('address');

          //Prepair the Address url friendly
	        $prepAddr = str_replace(' ','+',$address);
	        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false&key=APIKEY');
	        $output= json_decode($geocode);
	        $latitude = $output->results[0]->geometry->location->lat;
	        $longitude = $output->results[0]->geometry->location->lng;
  
          //Update the two other field inside the repeater with the LAT and the LNG
	        update_sub_field('latitude', $latitude);
	        update_sub_field('longitude', $longitude);
	
	    endwhile;
	
	endif;
}
