<?php
/*
 * Template Name: Page Protolab - Actus
 * @package hmsphr
 */

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
			 <!-- /////////////////// ACTU LOOP //////////////// -->
			 <!-- ////////////////////////////////////////////// -->

				 <section class="actus">

					 <div class="title typo_alpha">Projets &amp; Réalisations </div>

			 <!-- /////////////////// FILTRES  //////////////// -->

					 <div class="filterTitle typo_zeta">filtrer par type</div>
					 <div class="filterList typo_epsilon">
						 <div class='filterDiv' slug="all" >
							 <div class="filterCircle">⦁</div>
							 <div class="filterText">Tout afficher</div>
						 </div>
						 <?php
						 // POST DE CONFIGURATION / MOTS CLES A AFFICHER SUR LA PAGE
						 $args = array('post_type' => array('configuration'),'posts_per_page'=> -1,);
						 $loop = new WP_Query($args);
						 while ( $loop->have_posts() ) : $loop->the_post();
						 if(get_the_title()=="protolab_config"){
							 $keyword_list = wp_get_post_terms($post->ID, 'post_keyword', array("fields" => "all"));
							 foreach ($keyword_list as $keyword) {
								// if($keyword->parent==0){ // N'affiche pas ceux qui ont un parent
									?><div class='filterDiv' slug="<?php echo $keyword->slug ?> " >
											<div class="filterCircle">⦁</div>
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
			     var category_Name = "protolab"; // Pour les appels ajax load more; -> JS -> WP_Query
			 </script>
			 <?php $category_Name = "protolab" ?>

			 <!-- //////////////////// LOOP  ////////////////// -->
					<div class="postsTable">
						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>

					 <?php
					  $args = array(
					 	 'post_type' => array('actu', 'annonce'),
					 	 'posts_per_page'=> 10,
						 'category_name'=> $category_Name
					 	);
					  $loop = new WP_Query( $args );
					  while ( $loop->have_posts() ) : $loop->the_post();

							get_template_part( 'single-actu-and-annonce');

			 			endwhile; ?>
					</div>
						<div class="loadMore typo_beta" >
							<div class="notWaiting">→ voir plus d'actualités</div>
							<div class="loader waiting" style='display:none'>
							  <p>-----------------------------</p>
							</div>
						</div>

				 </section>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
