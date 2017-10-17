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
	//GET ETABLISSEMENTS PARTENAIRES NON ERASMUS
	$args =	array(
		'post_type'=>'etablissement',
		'posts_per_page'=> -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'categorie-d-etablissement',
				'terms' => 31
			)
		),
		'order' => 'ASC'
	);
	$etablissements_non_erasmus = get_posts($args);
  	
  	$template = '<div class="columns_wrapper typo_epsilon equipe">';
		$template .= '<div class="">';
			$template .= '<ul id="" class="membres_equipe membres_equipe_recherche">';
			$template .= '<li class="titre-categorie">RÉSEAU ERASMUS</br></br></li>';
			foreach($etablissements_erasmus as $etablissement){
				$localisation = get_post_meta($etablissement->ID, 'wpcf-localisation', true);
				$lien = get_post_meta($etablissement->ID, 'wpcf-lien', true);
				$template .= '<li class="membre">';
				$template .= '<a target="_blank" href="'.$lien.'">'.$etablissement->post_title.'</a>';
				$template .= '</br><span class="localisation">'.$localisation.'</span>';
				$template .= '</li>';
			}
			$template .= '<li class="titre-categorie">RÉSEAU HORS ERASMUS</br></br></li>';
			foreach($etablissements_non_erasmus as $etablissement){ 
				$localisation = get_post_meta($etablissement->ID, 'wpcf-localisation', true);
				$lien = get_post_meta($etablissement->ID, 'wpcf-lien', true);
				$template .= '<li class="membre">';
				$template .= '<a target="_blank" href="'.$lien.'">'.$etablissement->post_title.'</a>';
				$template .= '</br><span class="localisation">'.$localisation.'</span>';
				$template .= '</li>';
			}
			$template .= '</ul>';
		$template .= '</div>';
	$template .= '</div>';			
					
	return $template;
}
add_shortcode( 'etablissements_partenaires', 'shortcode_etablissements_partenaires' );


?>
