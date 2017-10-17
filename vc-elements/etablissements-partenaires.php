<?php
/*
Shortcode pour afficher les établissements partenaires
*/
function shortcode_etablissements_partenaires( $atts ){
  	
  	//GET ETABLISSEMENTS PARTENAIRES ERASMUS
	$args =	array(
		'post_type'=>'etablissement',
		'posts_per_page'=> -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'categorie-d-etablissement',
				'terms' => 30
			)
		),
		'order' => 'ASC'
	);
	$etablissements_erasmus = get_posts($args);
  	
  	$template = '<div class="columns_wrapper typo_epsilon equipe">';
		$template .= '<div class="">';
			$template .= '<ul id="" class="membres_equipe membres_equipe_recherche">';
			foreach($etablissements_erasmus as $etablissement){
				$localisation = get_post_meta($etablissement->ID, 'wpcf-localisation', true);
				$lien = get_post_meta($etablissement->ID, 'wpcf-lien', true);
				$template .= '<li>';
				$template .= '<a id="'. $etablissement->ID .'" class="link_professeur nom_complet open_in_popup" href="'.$lien.'">'.$etablissement->post_title.'</a>';
				$template .= '<span class="localisation">'.$localisation.'</span>';
				$template .= '</li>';
			}
			$template .= '</ul>';
		$template .= '</div>';
	$template .= '</div>';			
					
							<
	return $template;
}
add_shortcode( 'etablissements_partenaires', 'shortcode_etablissements_partenaires' );


?>
