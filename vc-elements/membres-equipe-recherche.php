<?php
/*
Shortcode pour afficher les membres de l'équipe recherche
*/
function shortcode_membres_equipe_recherche( $atts ){

  	/////////////////////////////////
	///// GET EQUIPE RECHERCHE //////
	/////////////////////////////////
	$args =	array(
		'post_type'=>'membre-equipe-rech',
		'posts_per_page'=> -1,
		'order' => 'DESC'
	);
	$membres_equipe_recherche = get_posts($args);
	wp_reset_query();

	$template = '<div class="columns_wrapper typo_epsilon equipe">';
		$template .= '<div class="">';
			$template .= '<ul id="" class="membres_equipe membres_equipe_recherche">';
				foreach($membres_equipe_recherche as $membre){
					$template .= '<li class="membre">';
					// IF CONTENT : open_in_popup
					if($membre->post_content != ''){
						$template .='<div id="'.$membre->ID.'" class="link_professeur open_in_popup" href="'.get_permalink($membre->ID).'">';
						$template .='<div class="nom_complet">'.'HGFDJHGF'.$membre->post_title.'</div>';
						$fonction = get_post_meta($membre->ID, 'wpcf-fonction-recherche', true);
						$template .='div class="fonction">'.$fonction.'</div>';
						$template .='</div>';
					} else{
					// NO CONTENT : TXT
						$template .='<span class="nom_complet">'.$membre->post_title.'</span></br>';
						$fonction = get_post_meta($membre->ID, 'wpcf-fonction-recherche', true);
						if($fonction != ''){
							$template .='<span class="fonction">'.$fonction.'</span>';
						}
					}
					// if($membre->post_content != ''){
					// 	$template .= '<a id="'.$membre->ID.'" class="link_professeur nom_complet open_in_popup" href="'.get_permalink($membre->ID).'">'.$membre->post_title.'</a>';
					// } else{
					// 	$template .= '<span class="nom_complet">'.$membre->post_title.'</span>';
					// }
					// $fonction = get_post_meta($membre->ID, 'wpcf-fonction-recherche', true);
					// if($fonction != ''){
					// 	$template .= '</br><span class="fonction">'.$fonction.'</span>';
					// }
					$template .= '</li>';
				}
			$template .= '</ul>';

		$template .= '</div>';
	$template .= '</div>';

	return $template;
}
add_shortcode( 'membres_equipe_recherche', 'shortcode_membres_equipe_recherche' );

?>
