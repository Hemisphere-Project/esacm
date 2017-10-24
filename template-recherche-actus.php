<?php
/*
 * Template Name: Page Recherche - Actus
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
			 <!-- /////////////////// ACTU LOOP //////////////// -->
			 <!-- ////////////////////////////////////////////// -->

				 <section class="actus">

					 <div class="title typo_alpha">ÉVÈNEMENTS &amp; PUBLICATIONS </div>

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
						 if(get_the_title()=="recherche_config"){
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
			     var category_Name = "recherche"; // Pour les appels ajax load more; -> JS -> WP_Query
			 </script>
			 <?php $category_Name = "recherche" ?>

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
								<a class="vc-lienpagesuivante" href="<?php echo get_permalink(97); //Page appels à candidature ?>">→&nbsp;appels à candidature</a>
							</div>
						</div>
					</div>
				</div>
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
