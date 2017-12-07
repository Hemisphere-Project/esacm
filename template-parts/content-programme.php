
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

	<br>

	<!-- ////////////////////////////////////////////// -->
	<!-- ////////////////// POST OVERLAY ////////////// -->
	<!-- ////////////////////////////////////////////// -->


	<div id="post_overlay_under">
	  <div id="post_overlay">
	 	 <div id="post_overlay_close"></div>
	 	 <div id="post_overlay_content"></div>
	 </div>
	</div>

	<!-- //////////////////// CONFIG  ////////////////// -->
	<?php
	// GET KEYWORDS OF PAGE
	$programme_keywords = wp_get_post_terms($post->ID, 'post_keyword', array("fields" => "all"));
	$programme_keywords_slugs = array();
	foreach ($programme_keywords as $keyword) {
		array_push($programme_keywords_slugs,$keyword->slug);
	}
	?>
	<!-- //////////////////// LOOP  ////////////////// -->
	<div class="postsTable">
		 <div class="grid-sizer"></div>
		 <div class="gutter-sizer"></div>

		<?php
		 $args = array(
			'post_type' => array('actu', 'annonce'),
			'posts_per_page'=> -1,
			'tax_query' => array(
				array(
						'taxonomy' => 'post_keyword',
						'field' => 'slug',
						'terms' => $programme_keywords_slugs
				)
			)

		 );
		 $loop = new WP_Query( $args );

		 while ( $loop->have_posts() ) : $loop->the_post();

			 get_template_part( 'single-actu-and-annonce');

		 endwhile; ?>
	</div>

	<div class="spacer shadowedBox"></div>

	<div>
		 <div class="nextButton shadowedBox typo_beta" >
			 <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Axes et programmes' ) ) ); ?>">← Retour à la liste des programmes</a>
		 </div>
	</div>


	<footer class="entry-footer">
		<?php hmsphr_entry_footer(); ?>

	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
