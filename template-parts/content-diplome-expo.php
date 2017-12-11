<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hmsphr
 */
?>

<div id="post_overlay" style="top: 25px; display: block; visibility: visible;">
	 <div id="post_overlay_close_and_redirect"><a href="<?php echo get_permalink(105); //Page Diplômés ?>"><img src="http://lab.airlab.fr/esacm/wp-content/themes/esacm/img/close_black.svg" id="post_overlay_close_img"></a></div>
	 <div id="post_overlay_content">
	 	<h1 class="actuOpenedTitle typo_alpha"><?php echo get_the_title(); ?></h1>
		<div class="actuOpenedSubtitle typo_beta"><?php echo get_post_meta($post->ID, 'wpcf-fonction', true); ?></div>
		<div class="actuOpenedContent typo_beta entry-content">
			<?php the_content(); ?>
		</div>
	 </div>
</div><!-- #post-<?php the_ID(); ?> -->
<a id="false_popup_overlay_under" href="<?php echo get_permalink(105); //Page Diplômés ?>"></a>
