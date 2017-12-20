<?php
/*
 * Template Name: Page École - Équipe
 * @package hmsphr
 */


   //GET DIRECTION MEMBERS
 	$args =	array(
 		'post_type'=>'membre-equipe',
 		'posts_per_page'=> -1,
 		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'direction')),
 		'order' => 'ASC'
 	);
 	$membres_direction = get_posts($args);

 	//GET BIBLIOTHEQUE MEMBERS
 	$args =	array(
 		'post_type'=>'membre-equipe',
 		'posts_per_page'=> -1,
 		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'bibliotheque')),
 		'order' => 'ASC'
 	);
 	$membres_bibliotheque = get_posts($args);

 	//GET ADMINISTRATION MEMBERS
 	$args =	array(
 		'post_type'=>'membre-equipe',
 		'posts_per_page'=> -1,
 		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'administration')),
 		'order' => 'ASC'
 	);
 	$membres_administration = get_posts($args);

 	//GET BATIMENT MEMBERS
 	$args =	array(
 		'post_type'=>'membre-equipe',
 		'posts_per_page'=> -1,
 		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'batiment')),
 		'order' => 'ASC'
 	);
 	$membres_batiment = get_posts($args);

 	//GET PROFESSEURS MEMBERS
 	$args =	array(
 		'post_type'=>'membre-equipe',
 		'posts_per_page'=> -1,
 		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'professeurs')),
 		'order' => 'ASC'
 	);
 	$membres_professeurs = get_posts($args);

 	//GET ASSISTANTS D'ENSEIGNEMENT MEMBERS
 	$args =	array(
 		'post_type'=>'membre-equipe',
 		'posts_per_page'=> -1,
 		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'assistants-denseignement')),
 		'order' => 'ASC'
 	);
 	$membres_assistants = get_posts($args);

 	//GET TECHNICIENS MEMBERS
 	$args =	array(
 		'post_type'=>'membre-equipe',
 		'posts_per_page'=> -1,
 		'tax_query' => array(array( 'taxonomy' => 'activite', 'field' => 'slug','terms' => 'techniciens')),
 		'order' => 'ASC'
 	);
 	$membres_techniciens = get_posts($args);



wp_reset_query();

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
			 <!-- /////////////////// THE LOOP //////////////// -->
			 <!-- ////////////////////////////////////////////// -->
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
			<div class="columns_wrapper typo_epsilon equipe">
				<div class="half_column first_column">

					<h3>DIRECTION</h3>
					<ul id="membres_direction" class="membres_equipe">
						<?php foreach($membres_direction as $membre){ ?>
							<!-- CONTENT -->
							<?php if($membre->post_content != ''){ ?>
								<li class="membre has_related_post">
									<div id="<?php echo $membre->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($membre->ID); ?>">
										<div class="nom_complet"><?php echo $membre->post_title; ?></div>
										<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
										if($fonction != ''){?>
										<div class="fonction"><?php echo $fonction; ?></div>
										<?php }	?>
									</div>
									</br>
								</li>
							<!-- NO CONTENT -->
							<?php } else{ ?>
								<li class="membre">
									<span class="nom_complet"><?php echo $membre->post_title; ?></span>
									<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
									if($fonction != ''){?>
									</br><span class="fonction"><?php echo $fonction; ?></span>
									<?php }	?>
									</br>
									</br>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>

					<h3>BIBLIOTHÈQUE</h3>
					<ul id="membres_bibliotheque" class="membres_equipe">
						<?php foreach($membres_bibliotheque as $membre){ ?>
							<!-- CONTENT -->
							<?php if($membre->post_content != ''){ ?>
								<li class="membre has_related_post">
									<div id="<?php echo $membre->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($membre->ID); ?>">
										<div class="nom_complet"><?php echo $membre->post_title; ?></div>
										<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
										if($fonction != ''){?>
										<div class="fonction"><?php echo $fonction; ?></div>
										<?php }	?>
									</div>
									</br>
								</li>
							<!-- NO CONTENT -->
							<?php } else{ ?>
								<li class="membre">
									<span class="nom_complet"><?php echo $membre->post_title; ?></span>
									<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
									if($fonction != ''){?>
									</br><span class="fonction"><?php echo $fonction; ?></span>
									<?php }	?>
									</br>
									</br>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>

					<h3>ADMINISTRATION</h3>
					<ul id="membres_administration" class="membres_equipe">
						<?php foreach($membres_administration as $membre){ ?>
							<!-- CONTENT -->
							<?php if($membre->post_content != ''){ ?>
								<li class="membre has_related_post">
									<div id="<?php echo $membre->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($membre->ID); ?>">
										<div class="nom_complet"><?php echo $membre->post_title; ?></div>
										<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
										if($fonction != ''){?>
										<div class="fonction"><?php echo $fonction; ?></div>
										<?php }	?>
									</div>
									</br>
								</li>
							<!-- NO CONTENT -->
							<?php } else{ ?>
								<li class="membre">
									<span class="nom_complet"><?php echo $membre->post_title; ?></span>
									<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
									if($fonction != ''){?>
									</br><span class="fonction"><?php echo $fonction; ?></span>
									<?php }	?>
									</br>
									</br>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>

					<h3>BÂTIMENT</h3>
					<ul id="membres_batiment" class="membres_equipe">
						<?php foreach($membres_batiment as $membre){ ?>
							<!-- CONTENT -->
							<?php if($membre->post_content != ''){ ?>
								<li class="membre has_related_post">
									<div id="<?php echo $membre->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($membre->ID); ?>">
										<div class="nom_complet"><?php echo $membre->post_title; ?></div>
										<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
										if($fonction != ''){?>
										<div class="fonction"><?php echo $fonction; ?></div>
										<?php }	?>
									</div>
									</br>
								</li>
							<!-- NO CONTENT -->
							<?php } else{ ?>
								<li class="membre">
									<span class="nom_complet"><?php echo $membre->post_title; ?></span>
									<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
									if($fonction != ''){?>
									</br><span class="fonction"><?php echo $fonction; ?></span>
									<?php }	?>
									</br>
									</br>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>

				</div>
				<div class="half_column last_column">

					<h3>PROFESSEURS</h3>
					<ul id="membres_professeurs" class="membres_equipe">
						<?php foreach($membres_professeurs as $membre){ ?>
							<!-- CONTENT -->
							<?php if($membre->post_content != ''){ ?>
								<li class="membre has_related_post">
									<div id="<?php echo $membre->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($membre->ID); ?>">
										<div class="nom_complet"><?php echo $membre->post_title; ?></div>
										<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
										if($fonction != ''){?>
										<div class="fonction"><?php echo $fonction; ?></div>
										<?php }	?>
									</div>
									</br>
								</li>
							<!-- NO CONTENT -->
							<?php } else{ ?>
								<li class="membre">
									<span class="nom_complet"><?php echo $membre->post_title; ?></span>
									<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
									if($fonction != ''){?>
									</br><span class="fonction"><?php echo $fonction; ?></span>
									<?php }	?>
									</br>
									</br>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>

					<h3>ASSISTANTS D'ENSEIGNEMENT</h3>
					<ul id="membres_assistants" class="membres_equipe">
						<?php foreach($membres_assistants as $membre){ ?>
							<!-- CONTENT -->
							<?php if($membre->post_content != ''){ ?>
								<li class="membre has_related_post">
									<div id="<?php echo $membre->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($membre->ID); ?>">
										<div class="nom_complet"><?php echo $membre->post_title; ?></div>
										<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
										if($fonction != ''){?>
										<div class="fonction"><?php echo $fonction; ?></div>
										<?php }	?>
									</div>
									</br>
								</li>
							<!-- NO CONTENT -->
							<?php } else{ ?>
								<li class="membre">
									<span class="nom_complet"><?php echo $membre->post_title; ?></span>
									<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
									if($fonction != ''){?>
									</br><span class="fonction"><?php echo $fonction; ?></span>
									<?php }	?>
									</br>
									</br>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>

					<h3>TECHNICIENS</h3>
					<ul id="membres_techniciens" class="membres_equipe">
						<?php foreach($membres_techniciens as $membre){ ?>
							<!-- CONTENT -->
							<?php if($membre->post_content != ''){ ?>
								<li class="membre has_related_post">
									<div id="<?php echo $membre->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($membre->ID); ?>">
										<div class="nom_complet"><?php echo $membre->post_title; ?></div>
										<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
										if($fonction != ''){?>
										<div class="fonction"><?php echo $fonction; ?></div>
										<?php }	?>
									</div>
									</br>
								</li>
							<!-- NO CONTENT -->
							<?php } else{ ?>
								<li class="membre">
									<span class="nom_complet"><?php echo $membre->post_title; ?></span>
									<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
									if($fonction != ''){?>
									</br><span class="fonction"><?php echo $fonction; ?></span>
									<?php }	?>
									</br>
									</br>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>

				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
