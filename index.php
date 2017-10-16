<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hmsphr
 */

get_header(); ?>

<script>
    theme_directory = "<?php echo get_template_directory_uri() ?>";
</script>

<div id="primary" class="content-area">
<main id="main" class="site-main">

<!-- ////////////////////////////////////////////// -->
<!-- //////////////// POPUP OVERLAY /////////////// -->
<!-- ////////////////////////////////////////////// -->

<div id="popup_overlay">
	<?php
	$args = array(
	 'post_type' => 'popup',
	 'posts_per_page'=> -1);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		$picture=types_render_field( "picture");
		$text=types_render_field( "text", array( ) );
		if($picture){ $post_type='image_popup'; }
		if(!$picture && $text){ $post_type='text_popup'; }

		if($post_type=='image_popup'){?> <div class="popup image_popup"><?php echo types_render_field( "picture");?> </div> <?php }
 		elseif($post_type=='text_popup'){?> <div class="popup text_popup"><?php echo types_render_field( "text");?> </div> <?php } ?>

	 <?php endwhile; ?>
 </div>

 <!-- ////////////////////////////////////////////// -->
 <!-- ////////////////// POST OVERLAY ////////////// -->
 <!-- ////////////////////////////////////////////// -->


 <div id="post_overlay">
	 <div id="post_overlay_close"><img id="post_overlay_close_img" src="<?php echo get_template_directory_uri(); ?>/img/close_black.svg"> </div>
	 <div id="post_overlay_content"></div>
</div>
<div id="post_overlay_under"></div>


 <!-- ////////////////////////////////////////////// -->
 <!-- /////////////////// ACTU LOOP //////////////// -->
 <!-- ////////////////////////////////////////////// -->

	 <section class="actus">

		 <div class="title typo_alpha">ÉVÈNEMENTS &amp; ACTUALITÉS </div>

 <!-- /////////////////// FILTRES  //////////////// -->

		 <div class="filterTitle typo_zeta">filtrer par type</div>
		 <div class="filterList typo_epsilon">
			 <div class='filterDiv' slug="all" >
				 <div class="filterCircle">○</div>
				 <div class="filterText">Tout afficher</div>
			 </div>
			 <?php
			 // POST DE CONFIGURATION / MOTS CLES A AFFICHER SUR LA PAGE
			 $args = array('post_type' => array('configuration'),'posts_per_page'=> -1,);
			 $loop = new WP_Query($args);
			 while ( $loop->have_posts() ) : $loop->the_post();
			 if(get_the_title()=="accueil_config"){
				 $keyword_list = wp_get_post_terms($post->ID, 'post_keyword', array("fields" => "all"));
				 foreach ($keyword_list as $keyword) {
					// if($keyword->parent==0){ // N'affiche pas ceux qui ont un parent
						?><div class='filterDiv' slug="<?php echo $keyword->slug ?> " >
								<div class="filterCircle">○</div>
								<div class="filterText"><?php echo $keyword->name ?></div>
						</div> <?php
					// }
					}
			 }
			endwhile;
			 ?>
		 </div>

 <!-- //////////////////// CONFIG  ////////////////// -->
 <!-- //////// accueil , recherche , protolab //////// -->
 <script>
     var category_Name = "accueil"; // Pour les appels ajax load more; -> JS -> WP_Query
 </script>
 <?php $category_Name = "accueil" ?>

 <!-- //////////////////// LOOP  ////////////////// -->
		<div class="postsTable">
			<div class="grid-sizer"></div>
			<div class="gutter-sizer"></div>

		 <?php
		  $args = array(
		 	 'post_type' => array('actu', 'annonce'),
		 	 'posts_per_page'=> 5,
			 'category_name'=> $category_Name
		 	);
		  $loop = new WP_Query( $args );
		  while ( $loop->have_posts() ) : $loop->the_post();

				get_template_part( 'single-actu-and-annonce');

 			endwhile; ?>
		</div>
			<div class="loadMore shadowedBox typo_beta" >
				<div class="notWaiting">→ voir plus d'actualités</div>
				<div class="loader waiting" style='display:none'>
				  <p>-----------------------------</p>
				</div>
			</div>

	 </section>


	 <!-- ////////////////////////////////////////////// -->
	 <!-- ////////////////////////////////////////////// -->
	 <!-- ////////////////////////////////////////////// -->


		<?php
		// if ( have_posts() ) :
		//
		// 	if ( is_home() && ! is_front_page() ) : ?>
		 		<!-- <header>
		 			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		 		</header>
		  -->
		 	<?php
		// 	endif;
		//
		// 	/* Start the Loop */
		// 	while ( have_posts() ) : the_post();
		//
		// 		/*
		// 		 * Include the Post-Format-specific template for the content.
		// 		 * If you want to override this in a child theme, then include a file
		// 		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		// 		 */
		// 		get_template_part( 'template-parts/content', get_post_format() );
		//
		// 	endwhile;
		//
		// 	the_posts_navigation();
		//
		// else :
		//
		// 	get_template_part( 'template-parts/content', 'none' );
		//
		// endif;
		?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
