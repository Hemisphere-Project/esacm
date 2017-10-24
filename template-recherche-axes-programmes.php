<?php
/*
 * Template Name: Page Recherche - Axes & Programmes
 * @package hmsphr
 */

/////////////////////////////////
//////////// GET AXES ///////////
/////////////////////////////////
$args =	array(
	'post_type'=>'axe',
	'posts_per_page'=> -1,
	'order' => 'DESC'
);
$axes = get_posts($args);
wp_reset_query();

/////////////////////////////////
/////////// PROGRAMMES //////////
/////////////////////////////////
$args =	array(
	'post_type'=>'programme',
	'posts_per_page'=> -1,
	'order' => 'DESC'
);
$programmes = get_posts($args);
wp_reset_query();

//////// SORT PROGRAMMES ///////
$programmes_encours = array();
$programmes_passes = array();
foreach ($programmes as $programme) {
	$encours = get_post_meta($programme->ID, 'wpcf-programme_encours',true);
	if($encours==1){ array_push($programmes_encours,$programme); }
	else{ array_push($programmes_passes,$programme); }
}





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

			<!-- ///////////////////  AXES  //////////////// -->
			<div class="spacer"></div>
			<div class="typo_gamma littleTitle">Les axes de recherche</div>

			<div class="postsTable">
				<div class="grid-sizer"></div>
				<div class="gutter-sizer"></div>

				<?php foreach ($axes as $axe) {?>
					<a class="post open_in_popup" id="<?php echo $axe->ID?>" href="<?php echo get_permalink($axe->ID); ?>">
						<div class="actuImage"><?php echo get_the_post_thumbnail($axe->ID) ; ?></div>
						<div class="actuTitle typo_delta"><?php echo $axe->post_title ; ?></div>
						<div class="actuExcerpt typo_epsilon"><?php echo get_post_meta($axe->ID, 'wpcf-axe_extrait')[0]; ?></div>
						<div class="actuOpen typo_epsilon">en savoir plus → </div>
					</a>
				<?php } ?>

			</div>

			<!-- /////////////////  PROGRAMMES  ////////////// -->
			<hr class="dashedLine" />
			<div class="typo_gamma littleTitle">Les programmes en cours</div>

			<div class="programmesTable">
				<?php foreach ($programmes_encours as $programme) {?>
					<a class="programmeItem" id="<?php echo $programme->ID?>" href="<?php echo get_permalink($programme->ID); ?>">
						<div class="programmeImage"><?php echo get_the_post_thumbnail($programme->ID) ; ?></div>
						<div class="programmeTitle typo_delta"><?php echo $programme->post_title ; ?></div>
					</a>
				<?php } ?>
			</div>

			<hr class="dashedLine" />
			<div class="typo_gamma littleTitle">Les programmes passés</div>

			<div class="programmesTable">
				<?php foreach ($programmes_passes as $programme) {?>
					<a class="programmeItem" id="<?php echo $programme->ID?>" href="<?php echo get_permalink($programme->ID); ?>">
						<div class="programmeImage"><?php echo get_the_post_thumbnail($programme->ID) ; ?></div>
						<div class="programmeTitle typo_delta"><?php echo $programme->post_title ; ?></div>
					</a>
				<?php } ?>
			</div>
			
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_grey">
							<span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span>
							<span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
						</div>
					</div>
				</div>
			</div>
			<div class="vc_row wpb_row vc_row-fluid">
				<div class="wpb_column vc_column_container vc_col-sm-6">
					<div class="vc_column-inner ">
						<div class="wpb_wrapper">
						</div>
					</div>
				</div>
				<div class="wpb_column vc_column_container vc_col-sm-6">
					<div class="vc_column-inner ">
						<div class="wpb_wrapper">
						        <div class="vc-lienpagesuivante-wrap typo_beta" "="">
								<a class="vc-lienpagesuivante" href="<?php echo get_permalink(94); //Page évènements et publications ?>">→&nbsp;évènements et publications</a>
							</div>
						</div>
					</div>
				</div>
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
