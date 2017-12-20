<?php
/*
Shortcode pour afficher les membres de l'équipe
*/
function shortcode_membres_equipe( $atts ){

  //GET DIRECTION MEMBERS
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'direction')),
		'order' => 'ASC'
	);
	$membres_direction = get_posts($args);

	//GET BIBLIOTHEQUE MEMBERS
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'bibliotheque')),
		'order' => 'ASC'
	);
	$membres_bibliotheque = get_posts($args);

	//GET ADMINISTRATION MEMBERS
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'administration')),
		'order' => 'ASC'
	);
	$membres_administration = get_posts($args);

	//GET BATIMENT MEMBERS
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'batiment')),
		'order' => 'ASC'
	);
	$membres_batiment = get_posts($args);

	//GET PROFESSEURS MEMBERS
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'professeurs')),
		'order' => 'ASC'
	);
	$membres_professeurs = get_posts($args);

	//GET ASSISTANTS D'ENSEIGNEMENT MEMBERS
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'assistants-denseignement')),
		'order' => 'ASC'
	);
	$membres_assistants = get_posts($args);

	//GET TECHNICIENS MEMBERS
	$args =	array(
		'post_type'=>'membre-equipe',
		'posts_per_page'=> -1,
		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'techniciens')),
		'order' => 'ASC'
	);
	$membres_techniciens = get_posts($args);




	$template = '<div class="columns_wrapper typo_epsilon equipe">';
		$template .= '<div class="half_column first_column">';

			$template .= '<h3>DIRECTION</h3>';
			$template .= '<ul id="membres_direction" class="membres_equipe">';
				foreach($membres_direction as $membre){
          // LI MEMBRE
            // Membre with content
            if($membre->post_content != ''){
              $template .= '<li class="membre has_related_post">';
              $template .= '<div id="'.$membre->ID.'" class="link_professeur open_in_popup" href="'.get_permalink($membre->ID).'">';
                $template .= '<div class="nom_complet">'.$membre->post_title.'</div>';
                $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
                if($fonction != ''){
                $template .='<div class="fonction">'.$fonction.'</div>';
                }
              $template .='</div>';
            // Membre No content
           } else{
              $template .= '<li class="membre">';
              $template .= '<span class="nom_complet">'.$membre->post_title.'</span>';
              $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
              if($fonction != ''){
              $template .= '</br><span class="fonction">'.$fonction.'</span>';
               }
              $template .= '</br>';
           }
            $template .= '</br>';
					$template .= '</li>';
				}
			$template .= '</ul>';
			$template .= '</br>';


			$template .= '<h3>BIBLIOTHÈQUE</h3>';
			$template .= '<ul id="membres_bibliotheque" class="membres_equipe">';
				foreach($membres_bibliotheque as $membre){
          // LI MEMBRE
            // Membre with content
            if($membre->post_content != ''){
              $template .= '<li class="membre has_related_post">';
              $template .= '<div id="'.$membre->ID.'" class="link_professeur open_in_popup" href="'.get_permalink($membre->ID).'">';
                $template .= '<div class="nom_complet">'.$membre->post_title.'</div>';
                $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
                if($fonction != ''){
                $template .='<div class="fonction">'.$fonction.'</div>';
                }
              $template .='</div>';
            // Membre No content
           } else{
              $template .= '<li class="membre">';
              $template .= '<span class="nom_complet">'.$membre->post_title.'</span>';
              $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
              if($fonction != ''){
              $template .= '</br><span class="fonction">'.$fonction.'</span>';
               }
              $template .= '</br>';
           }
            $template .= '</br>';
					$template .= '</li>';
				}
			$template .= '</ul>';
			$template .= '</br>';


			$template .= '<h3>ADMINISTRATION</h3>';
			$template .= '<ul id="membres_administration" class="membres_equipe">';
				foreach($membres_administration as $membre){
					// LI MEMBRE
						// Membre with content
						if($membre->post_content != ''){
							$template .= '<li class="membre has_related_post">';
							$template .= '<div id="'.$membre->ID.'" class="link_professeur open_in_popup" href="'.get_permalink($membre->ID).'">';
								$template .= '<div class="nom_complet">'.$membre->post_title.'</div>';
								$fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
								if($fonction != ''){
								$template .='<div class="fonction">'.$fonction.'</div>';
								}
							$template .='</div>';
						// Membre No content
					 } else{
							$template .= '<li class="membre">';
							$template .= '<span class="nom_complet">'.$membre->post_title.'</span>';
							$fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
							if($fonction != ''){
							$template .= '</br><span class="fonction">'.$fonction.'</span>';
							 }
							$template .= '</br>';
					 }
						$template .= '</br>';
					$template .= '</li>';
				}
			$template .= '</ul>';
			$template .= '</br>';


			$template .= '<h3>BATIMENT</h3>';
			$template .= '<ul id="membres_batiment" class="membres_equipe">';
				foreach($membres_batiment as $membre){
					// LI MEMBRE
						// Membre with content
						if($membre->post_content != ''){
							$template .= '<li class="membre has_related_post">';
							$template .= '<div id="'.$membre->ID.'" class="link_professeur open_in_popup" href="'.get_permalink($membre->ID).'">';
								$template .= '<div class="nom_complet">'.$membre->post_title.'</div>';
								$fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
								if($fonction != ''){
								$template .='<div class="fonction">'.$fonction.'</div>';
								}
							$template .='</div>';
						// Membre No content
					 } else{
							$template .= '<li class="membre">';
							$template .= '<span class="nom_complet">'.$membre->post_title.'</span>';
							$fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
							if($fonction != ''){
							$template .= '</br><span class="fonction">'.$fonction.'</span>';
							 }
							$template .= '</br>';
					 }
						$template .= '</br>';
					$template .= '</li>';
				}
			$template .= '</ul>';
			$template .= '</br>';

		$template .= '</div>';

		$template .= '<div class="half_column last_column">';

			$template .= '<h3>PROFESSEURS</h3>';
			$template .= '<ul id="membres_professeurs" class="membres_equipe">';
				foreach($membres_professeurs as $membre){
          // LI MEMBRE
          // Membre with content
          if($membre->post_content != ''){
            $template .= '<li class="membre has_related_post">';
            $template .= '<div id="'.$membre->ID.'" class="link_professeur open_in_popup" href="'.get_permalink($membre->ID).'">';
              $template .= '<div class="nom_complet">'.$membre->post_title.'</div>';
              $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
              if($fonction != ''){
              $template .='<div class="fonction">'.$fonction.'</div>';
              }
            $template .='</div>';
            // Membre No content
         } else{
            $template .= '<li class="membre">';
            $template .= '<span class="nom_complet">'.$membre->post_title.'</span>';
            $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
            if($fonction != ''){
            $template .= '</br><span class="fonction">'.$fonction.'</span>';
             }
            $template .= '</br>';
         }
          $template .= '</br>';
					$template .= '</li>';
				}
			$template .= '</ul>';
			$template .= '</br>';


			$template .= '<h3>ASSISTANTS D\'ENSEIGNEMENT</h3>';
			$template .= '<ul id="membres_assistants" class="membres_equipe">';
				foreach($membres_assistants as $membre){
          // LI MEMBRE
          // Membre With Content
          if($membre->post_content != ''){
            $template .= '<li class="membre has_related_post">';
            $template .= '<div id="'.$membre->ID.'" class="link_professeur open_in_popup" href="'.get_permalink($membre->ID).'">';
              $template .= '<div class="nom_complet">'.$membre->post_title.'</div>';
              $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
              if($fonction != ''){
              $template .='<div class="fonction">'.$fonction.'</div>';
              }
            $template .='</div>';
          // Membre No content
         } else{
            $template .= '<li class="membre">';
            $template .= '<span class="nom_complet">'.$membre->post_title.'</span>';
            $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
            if($fonction != ''){
            $template .= '</br><span class="fonction">'.$fonction.'</span>';
             }
            $template .= '</br>';
         }
          $template .= '</br>';
					$template .= '</li>';
				}
			$template .= '</ul>';
			$template .= '</br>';


			$template .= '<h3>TECHNICIENS</h3>';
			$template .= '<ul id="membres_techniciens" class="membres_equipe">';
				foreach($membres_techniciens as $membre){
					// LI MEMBRE
					// Membre with content
					if($membre->post_content != ''){
						$template .= '<li class="membre has_related_post">';
						$template .= '<div id="'.$membre->ID.'" class="link_professeur open_in_popup" href="'.get_permalink($membre->ID).'">';
							$template .= '<div class="nom_complet">'.$membre->post_title.'</div>';
							$fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
							if($fonction != ''){
							$template .='<div class="fonction">'.$fonction.'</div>';
							}
						$template .='</div>';
						// Membre No content
				 } else{
						$template .= '<li class="membre">';
						$template .= '<span class="nom_complet">'.$membre->post_title.'</span>';
						$fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
						if($fonction != ''){
						$template .= '</br><span class="fonction">'.$fonction.'</span>';
						 }
						$template .= '</br>';
				 }
					$template .= '</br>';
					$template .= '</li>';
				}
			$template .= '</ul>';
			$template .= '</br>';


		$template .= '</div>';
	$template .= '</div>';

	return $template;
}
add_shortcode( 'membres_equipe', 'shortcode_membres_equipe' );

?>
