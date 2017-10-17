<?php
/*
Shortcode pour afficher les établissements partenaires
*/
function shortcode_etablissements_partenaires( $atts ){
  	
  	$time = ( date('G') < 9 ) ? "good morning" : "good day";
  
	return "Hello, and " . $time . ', my name is Linda';
}
add_shortcode( 'etablissements_partenaires', 'shortcode_etablissements_partenaires' );


?>
