<?php
/*
 * Template Name: Page Diplômés
 * @package hmsphr
 */

/////////////////////////////////
///////// GET DIPLOMES /////////
/////////////////////////////////
$args =	array(
	'post_type'=>'diplome',
	'posts_per_page'=> -1,
	'order' => 'DESC'
);
$diplomes = get_posts($args);
wp_reset_query();

/////////////////////////////////
//////////  GET EXPOS  //////////
/////////////////////////////////
$args =	array(
	'post_type'=>'diplome_expo',
	'posts_per_page'=> -1,
	'order' => 'DESC'
);
$diplomes_expos = get_posts($args);
wp_reset_query();

/////////////////////////////////
//////   SORT DIPLOMES   ////////
/////////////////////////////////

// YEARS
$annees = get_terms( array(
    'taxonomy' => 'annee',
    'hide_empty' => false,
) );

// NEW ARRAY DIPLOMES EACH YEAR
$diplomes_annees = array();
foreach ($annees as $annee) {
	foreach ($diplomes as $diplome) {
		$annees_du_diplome = wp_get_post_terms($diplome->ID, 'annee', array("fields" => "all"));
		foreach ($annees_du_diplome as $annee_du_diplome) {
			if($annee_du_diplome->name==$annee->name){
				$diplomes_annees[$annee->name][]=$diplome;
			}
		}
	}
}
// SORT
krsort($diplomes_annees); //trie par la clé année en reverse order

// LOOP
// foreach ($diplomes_annees as $annee => $diplomes_annee) {
// 	echo $annee;
// 	// EXPOS
// 	foreach ($diplomes_expos as $diplomes_expo) {
// 		$annees_de_lexpo = wp_get_post_terms($diplomes_expo->ID, 'annee', array("fields" => "all"));
// 		foreach ($annees_de_lexpo as $annee_de_lexpo) {
// 			if($annee_de_lexpo->name==$annee){
// 				echo $diplomes_expo->post_title;
// 			}
// 		}
// 	}
// 	// DIPLOME
// 	foreach ($diplomes_annee as $diplome) {
// 		echo $diplome->post_title;
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

			<div id="chercheurs_accordeon" class="accordeon">

				<?php
				foreach ($diplomes_annees as $annee => $diplomes_annee) {
					?>
					<div class="spacer shadowedBox"></div>
					<div class="anneeTitle typo_beta shadowed">
						<div class="arrow arrowLeft">→</div>
						<?php echo $annee;?>
						<div class="arrow arrowRight">←</div>
					</div>


					<?php
					// EXPOS
					foreach ($diplomes_expos as $diplomes_expo) {
						$annees_de_lexpo = wp_get_post_terms($diplomes_expo->ID, 'annee', array("fields" => "all"));
						foreach ($annees_de_lexpo as $annee_de_lexpo) {
							if($annee_de_lexpo->name==$annee){
								echo $diplomes_expo->post_title;
							}
						}
					}
					// DIPLOME
					foreach ($diplomes_annee as $diplome) {
						echo $diplome->post_title;
					}
				}
				?>

			</div>







		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
