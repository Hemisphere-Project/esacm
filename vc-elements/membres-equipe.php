<?php
/*
Shortcode pour afficher les membres de l'équipe
*/
function shortcode_etablissements_partenaires( $atts ){
  	
  	//GET ADMINISTRATION MEMBERS
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'activite',
				'terms' => 16
			)
		),
		'order' => 'ASC'
	);
	$membres_administration = get_posts($args);

	//GET ENGLISH PROFESSORS
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'activite',
				'terms' => 17
			)
		),
		'order' => 'ASC'
	);
	$professeurs_anglais = get_posts($args);
	//GET OTHER PROFESSORS
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'activite',
				'terms' => 18
			)
		),
		'order' => 'ASC'
	);
	$professeurs = get_posts($args);
	//GET Assistants d’enseignement
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'activite',
				'terms' => 19
			)
		),
		'order' => 'ASC'
	);
	$assistants = get_posts($args);
  	
	$template = '<div class="columns_wrapper typo_epsilon equipe">';
		$template = '<div class="half_column first_column">';
			$template = '<ul id="membres_administration" class="membres_equipe">';
				foreach($membres_administration as $membre){ 
					$template = '<li class="membre">';
						$template = '<span class="nom_complet">'.$membre->post_title.'</span>';
						$fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
						if($fonction != ''){
						$template = '</br><span class="fonction">'.$fonction.'</span>';
						}	

						$template = '</br></br>';
					$template = '</li>';
				}
			$template = '</ul>';
			$template = '</br>';
			$template = '</br>';
			$template = '<h3>PROFESSEURS D’ANGLAIS</h3>';
			$template = '<ul id="professeurs_anglais" class="membres_equipe">';
				foreach($professeurs_anglais as $membre){
					$template = '<li class="membre">';
						$template = '<span class="nom_complet">'.$membre->post_title.'</span>';
						$template = '</br></br>';
					$template = '</li>';
				}
			$template = '</ul>';
		$template = '</div>';
		$template = '<div class="half_column last_column">';
			$template = '<h3>PROFESSEURS</h3>';
			$template = '<ul id="membres_administration" class="membres_equipe">';
				foreach($professeurs as $membre){
					$template = '<li class="membre">';
						if($membre->post_content != ''){
							$template = '<a id="'.$membre->ID.'" class="link_professeur nom_complet open_in_popup" href="'.get_permalink($membre->ID).'">'.$membre->post_title.'</a>';
						} else{
							$template = '<span class="nom_complet">'.$membre->post_title.'</span>';
						}
						$fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
						if($fonction != ''){
							$template = '</br><span class="fonction">'.$fonction.'</span>';
						}

						$template = '</br></br>';
					$template = '</li>';
				}
			$template = '</ul>';
			$template = '</br>';
			$template = '</br>';
			$template = '<h3>ASSISTANTS D\'ENSEIGNEMENT</h3>';
			$template = '<ul id="assistants" class="membres_equipe">';
				foreach($assistants as $membre){
					$template = '<li class="membre">';
						$template = '<span class="nom_complet">'.$membre->post_title.'</span>';
						$fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
						if($fonction != ''){
							$template = '</br><span class="fonction">'.$fonction.'</span>';
						}

						$template = '</br></br>';
					$template = '</li>';
				}
			$template = '</ul>';
		$template = '</div>';
	$template = '</div>';
		
	return $template;
}
add_shortcode( 'etablissements_partenaires', 'shortcode_etablissements_partenaires' );


?>
