<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hmsphr
 */
?>

<div id="post_overlay" style="top: 50px; display: block; visibility: visible;">
	 <div id="post_overlay_close_and_redirect"><a href="<?php echo get_permalink(89); //Page La coopérative de recherche ?>"><img src="http://lab.airlab.fr/esacm/wp-content/themes/esacm/img/close_black.svg" id="post_overlay_close_img"></a></div>
	 <div id="post_overlay_content">
	 	<h1 class="actuOpenedTitle typo_alpha"><?php echo get_the_title(); ?></h1>
		<div class="actuOpenedSubtitle typo_epsilon"><?php echo get_post_meta($post->ID, 'wpcf-fonction', true); ?></div>
		<div class="actuOpenedContent typo_epsilon entry-content">
			<?php the_content(); ?>
		</div>

</div><!-- #post-<?php the_ID(); ?> -->
