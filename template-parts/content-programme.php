<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hmsphr
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title title typo_alpha">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title title typo_alpha"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
 		?>
	</header><!-- .entry-header -->


	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hmsphr' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->


	<h2 class="entry-title title typo_alpha">événements liés au programme</h2>

	<!-- //////////////////// CONFIG  ////////////////// -->
	<!-- //////// accueil , recherche , protolab //////// -->
	<script>
			var category_Name = "accueil"; // Pour les appels ajax load more; -> JS -> WP_Query
	</script>
	<?php $category_Name = "accueil" ?>

	<?php
	// GET ALL KEYWORDS
	$keywords = get_terms( 'post_keyword', array(
	    'hide_empty' => false,
	));
	foreach ($keywords as $keyword) {
		echo $keyword->name;
	}
	// GET SLUG OF PAGE

	?>

	<!-- //////////////////// LOOP  ////////////////// -->
		 <div class="postsTable">
			 <div class="grid-sizer"></div>
			 <div class="gutter-sizer"></div>

			<?php
			 $args = array(
				'post_type' => array('actu', 'annonce'),
				'posts_per_page'=> -1,
				'category_name'=> $category_Name
			 );
			 $loop = new WP_Query( $args );
			 while ( $loop->have_posts() ) : $loop->the_post();

				 get_template_part( 'single-actu-and-annonce');

			 endwhile; ?>
		 </div>




	<footer class="entry-footer">
		<?php hmsphr_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
