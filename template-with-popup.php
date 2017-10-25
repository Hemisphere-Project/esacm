<?php
/*
 * Template Name: Page With Popup
 * @package hmsphr
 */

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

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
