<?php
/*
Shortcode pour afficher les membres de l'équipe
*/
function shortcode_chercheurs( $atts ){

  	/////////////////////////////////
	///// GET EQUIPE CHERCHEURS /////
	/////////////////////////////////
	$args =	array(
		'post_type'=>'membre-chercheur',
		'posts_per_page'=> -1,
		'order' => 'DESC'
	);
	$membres_chercheurs = get_posts($args);
	wp_reset_query();

	/////////////////////////////////
	//// SORT EQUIPE CHERCHEURS /////
	/////////////////////////////////

	// YEARS
	$annees = get_terms( array(
	    'taxonomy' => 'annee',
	    'hide_empty' => false,
	) );
	// MULTIDIM ARRAY [YEAR][CATEGORIE]->CHERCHEUR
	$membres_chercheurs_annees = array();
	foreach ($annees as $annee) {
		foreach ($membres_chercheurs as $chercheur) {
			$annees_du_chercheur = wp_get_post_terms($chercheur->ID, 'annee', array("fields" => "all"));
			foreach($annees_du_chercheur as $annee_du_chercheur){
				if($annee_du_chercheur->name==$annee->name){
					$categorieNum = get_post_meta($chercheur->ID, 'wpcf-categorie-chercheur', true);
					$membres_chercheurs_annees[$annee->name][$categorieNum][]=$chercheur;
				}
			}
		}
	}
	// SORT
	krsort($membres_chercheurs_annees); //trie par la clé année en reverse order
	foreach ($membres_chercheurs_annees as $key => $value) {
		ksort($membres_chercheurs_annees[$key]); //trie par la clé categorie
	}

	$template = '<div id="chercheurs_accordeon" class="accordeon typo_epsilon">';
		$template .= '<div class="">';
				foreach ($membres_chercheurs_annees as $annee => $chercheurs_annees) {
					$template .= '<div class="spacer shadowedBox"></div>';
					$template .= '<div class="anneeTitle typo_beta shadowed">';

						$template .= '<div class="arrow arrowLeft">→</div>';
						$template .= $annee;
						$template .= '<div class="arrow arrowRight">←</div>';
					$template .= '</div>';
					$template .= '<div class="anneeContent">';
					$template .= '<div class="anneeContentPadding"></div>';
					foreach ($chercheurs_annees as $category => $chercheur_categories) {
						$template .= '<div class="categoryContent">';
							$template .= '<div class="half_column typo_gamma">';
							if($category==1){ $template .= 'RÉSIDENTS CHERCHEURS'; }
							elseif($category==2) { $template .= 'ÉTUDIANTS CHERCHEURS'; }
							elseif($category==3) { $template .= 'CHERCHEURS ASSOCIÉS'; }
							$template .= '</div>';
							$template .= '<ul id="" class="half_column membres_equipe chercheursList">';
							foreach ($chercheur_categories as $chercheur) {
								$template .= '<li class="membre">';
                // IF CONTENT : open_in_popup
                if($chercheur->post_content != ''){
                  $template .='<div id="'.$chercheur->ID.'" class="link_professeur open_in_popup" href="'.get_permalink($chercheur->ID).'">';
                  $template .='<div class="nom_complet">'.$chercheur->post_title.'</div>';
                  $fonction = get_post_meta($chercheur->ID, 'wpcf-fonction-chercheur', true);
                  $template .='div class="fonction">'.$fonction.'</div>';
                  $template .='</div>';
                } else{
                // NO CONTENT : TXT
                  $template .='<span class="nom_complet">'.$chercheur->post_title.'</span></br>';
                  $fonction = get_post_meta($chercheur->ID, 'wpcf-fonction-chercheur', true);
                  if($fonction != ''){
                    $template .='<span class="fonction">'.$fonction.'</span>';
                  }
                }

								// if($chercheur->post_content != ''){
								// 	$template .= '<a id="'.$chercheur->ID.'" class="link_professeur nom_complet open_in_popup" href="'.get_permalink($chercheur->ID).'">'.$chercheur->post_title.'</a><br>';
								// } else{
								// 	$template .= '<span class="nom_complet">'.$chercheur->post_title.'</span><br>';
								// }
								// $fonction = get_post_meta($chercheur->ID, 'wpcf-fonction-chercheur', true);
								// if($fonction != ''){
								// 	$template .= '<span class="fonction">'.$fonction.'</span>';
								// }
								$template .= '</li>';
						}
						$template .= '</ul>';
					$template .= '</div>';
					}
				$template .= '</div>';
				}
			$template .= '</div>';

	return $template;
}
add_shortcode( 'chercheurs', 'shortcode_chercheurs' );

?>
