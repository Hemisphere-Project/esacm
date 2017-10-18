<?php
/*
 * Template Name: Page Diplômés
 * @package hmsphr
 */

/////////////////////////////////
///////// GET DIPLOMES /////////
/////////////////////////////////
$args =	array(
	'post_type'=>'membre-chercheur',
	'posts_per_page'=> -1,
	'order' => 'DESC'
);
$membres_chercheurs = get_posts($args);
wp_reset_query();

/////////////////////////////////
//////   SORT DIPLOMES   ////////
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
// DEBUG ARRAY
// foreach ($membres_chercheurs_annees as $annee => $chercheurs_annees) {
// 	echo $annee.'<br>';
// 	foreach ($chercheurs_annees as $category => $chercheur_categories) {
// 		echo $category.'<br>';
// 		foreach ($chercheur_categories as $chercheur) {
// 			// echo $chercheur->ID.'<br>';
// 			// echo $chercheur->post_title.'<br>';
// 			// echo get_post_meta($chercheur->ID, 'wpcf-fonction-chercheur', true).'<br>';
// 		}
// 	}
// }


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			 <!-- ////////////////////////////////////////////// -->
			 <!-- ////////////////// POST OVERLAY ////////////// -->
			 <!-- ////////////////////////////////////////////// -->


			 <div id="post_overlay">
				 <div id="post_overlay_close"><img id="post_overlay_close_img" src="<?php echo get_template_directory_uri(); ?>/img/close_black.svg"> </div>
				 <div id="post_overlay_content"></div>
			</div>
			<div id="post_overlay_under"></div>

			 <!-- ////////////////////////////////////////////// -->
			 <!-- /////////////////// THE LOOP //////////////// -->
			 <!-- ////////////////////////////////////////////// -->
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>






		        <div class="vc-titreancre-wrap">
			  	<h2 class="vc-titreancre-title title typo_alpha" id="chercheurs2">Les chercheurs 2</h2>
		        </div>
			<div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>


			<div id="chercheurs_accordeon" class="accordeon">
				<?php
				foreach ($membres_chercheurs_annees as $annee => $chercheurs_annees) {?>
					<div class="spacer shadowedBox"></div>
					<div class="anneeTitle typo_beta shadowed">

						<div class="arrow arrowLeft">→</div>
						<?php echo $annee;?>
						<div class="arrow arrowRight">←</div>
					</div>
					<div class="anneeContent">
					<div class="anneeContentPadding"></div>
					<?php
					foreach ($chercheurs_annees as $category => $chercheur_categories) { ?>
						<div class="categoryContent">
							<div class="categoryTitle typo_gamma">
								<?php
								if($category==1){echo 'RÉSIDENTS CHERCHEURS';}
								elseif($category==2) {echo 'ÉTUDIANTS CHERCHEURS';}
								elseif($category==3) {echo 'CHERCHEURS ASSOCIÉS';}
								?>
							</div>
							<ul id="" class="membres_equipe chercheursList">
							<?php
							foreach ($chercheur_categories as $chercheur) {?>
								<li class="membre">
									<?php if($chercheur->post_content != ''){ ?>
										<a id="<?php echo $chercheur->ID; ?>" class="link_professeur nom_complet open_in_popup" href="<?php echo get_permalink($chercheur->ID); ?>"><?php echo $chercheur->post_title; ?></a><br>
									<?php } else{ ?>
										<span class="nom_complet"><?php echo $chercheur->post_title; ?></span><br>
									<?php } ?>
									<?php $fonction = get_post_meta($chercheur->ID, 'wpcf-fonction-chercheur', true);
									if($fonction != ''){?>
										<span class="fonction"><?php echo $fonction; ?></span>
									<?php } ?>

								</li>
							<?php
						} ?>
						</ul>
					</div>
					<?php
				}?>
			</div>
			<?php
				}
				?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
