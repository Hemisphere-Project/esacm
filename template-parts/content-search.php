<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hmsphr
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search_result typo_epsilon'); ?>>
	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	<?php the_excerpt(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
