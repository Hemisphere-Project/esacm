<?php
/*
 * Template Name: Page Recherche
 * @package hmsphr
 */

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


			 <div id="post_overlay_under">
			   <div id="post_overlay">
			  	 <div id="post_overlay_close"></div>
			  	 <div id="post_overlay_content"></div>
			  </div>
			 </div>

			 <!-- ////////////////////////////////////////////// -->
			 <!-- /////////////////// THE LOOP //////////////// -->
			 <!-- ////////////////////////////////////////////// -->
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>


			<div class="vc-titreancre-wrap">
					<h2 class="vc-titreancre-title title typo_alpha" id="equipe">L'équipe</h2>
			</div>
			<div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>


			<div class="columns_wrapper typo_epsilon equipe">
				<div class="">
					<ul id="" class="membres_equipe membres_equipe_recherche">
						<?php foreach($membres_equipe_recherche as $membre){ ?>
							<li class="membre">
								<!-- IF CONTENT : open_in_popup -->
								<?php if($membre->post_content != ''){ ?>
									<div id="<?php echo $membre->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($membre->ID); ?>">
										<div class="nom_complet"><?php echo $membre->post_title; ?></div>
										<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction-recherche', true);?>
										<div class="fonction"><?php echo $fonction; ?></div>
									</div>
								<?php } else{ ?>
									<!-- NO CONTENT : TXT -->
									<span class="nom_complet"><?php echo $membre->post_title; ?></span><br>
									<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction-recherche', true);?>
									<?php if($fonction!=''){ ?>
										<span class="fonction"><?php echo $fonction; ?></span>
									<?php } ?>
								<?php } ?>
							</li>
						<?php } ?>
					</ul>

				</div>
			</div>


		        <div class="vc-titreancre-wrap">
			  	<h2 class="vc-titreancre-title title typo_alpha" id="chercheurs">Les chercheurs</h2>
		        </div>
			<div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>


			<div id="chercheurs_accordeon" class="accordeon typo_epsilon">
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
							<div class="half_column typo_gamma">
								<?php
								if($category==1){echo 'RÉSIDENTS CHERCHEURS';}
								elseif($category==2) {echo 'ÉTUDIANTS CHERCHEURS';}
								elseif($category==3) {echo 'CHERCHEURS ASSOCIÉS';}
								?>
							</div>
							<ul id="" class="membres_equipe chercheursList half_column">
							<?php
							foreach ($chercheur_categories as $chercheur) {?>
								<li class="membre">
									<!-- IF CONTENT : open_in_popup -->
									<?php if($chercheur->post_content != ''){ ?>
										<div id="<?php echo $chercheur->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($chercheur->ID); ?>">
											<div class="nom_complet"><?php echo $chercheur->post_title; ?></div>
											<?php $fonction = get_post_meta($chercheur->ID, 'wpcf-fonction-chercheur', true);?>
											<div class="fonction"><?php echo $fonction; ?></div>
										</div>
									<!-- NO CONTENT : TXT -->
									<?php } else{ ?>
										<span class="nom_complet"><?php echo $chercheur->post_title; ?></span><br>
										<?php $fonction = get_post_meta($chercheur->ID, 'wpcf-fonction-chercheur', true);?>
										<?php if($fonction!=''){ ?>
											<span class="fonction"><?php echo $fonction; ?></span>
										<?php } ?>
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
