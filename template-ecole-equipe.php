<?php
/*
 * Template Name: Page École - Équipe
 * @package hmsphr
 */

//GET ADMINISTRATION MEMBERS
$args =	array(
	'post_type'=>'membre-equipe',
	'posts_per_page'=> -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'activite',
			'terms' => 16
		)
	),
	'order' => 'ASC'
);
$membres_administration = get_posts($args);

//GET ENGLISH PROFESSORS
$args =	array(
	'post_type'=>'membre-equipe',
	'posts_per_page'=> -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'activite',
			'terms' => 17
		)
	),
	'order' => 'ASC'
);
$professeurs_anglais = get_posts($args);
//GET OTHER PROFESSORS
$args =	array(
	'post_type'=>'membre-equipe',
	'posts_per_page'=> -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'activite',
			'terms' => 18
		)
	),
	'order' => 'ASC'
);
$professeurs = get_posts($args);
//GET Assistants d’enseignement
$args =	array(
	'post_type'=>'membre-equipe',
	'posts_per_page'=> -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'activite',
			'terms' => 19
		)
	),
	'order' => 'ASC'
);
$assistants = get_posts($args);

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
					</br>
					</br>
					<h3>PROFESSEURS D’ANGLAIS</h3>
					<ul id="professeurs_anglais" class="membres_equipe">
						<?php foreach($professeurs_anglais as $membre){ ?>
							<li class="membre">
								<span class="nom_complet"><?php echo $membre->post_title; ?></span>
								</br></br>
							</li>
						<?php } ?>
					</ul>
				</div>
				<div class="half_column last_column">
					<h3>PROFESSEURS</h3>
					<ul id="membres_administration" class="membres_equipe">
						<?php foreach($professeurs as $membre){ ?>
							<li class="membre">
								<!-- CONTENT -->
								<?php if($membre->post_content != ''){ ?>
									<div id="<?php echo $membre->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($membre->ID); ?>">
										<div class="nom_complet"><?php echo $membre->post_title; ?></div>
										<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
										if($fonction != ''){?>
										<div class="fonction"><?php echo $fonction; ?></div>
										<?php }	?>
									</div>
								<!-- NO CONTENT -->
								<?php } else{ ?>
									<span class="nom_complet"><?php echo $membre->post_title; ?></span>
									<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
									if($fonction != ''){?>
									</br><span class="fonction"><?php echo $fonction; ?></span>
									<?php }	?>
								</br>
								<?php } ?>
								</br>
							</li>
						<?php } ?>
					</ul>
					</br>
					</br>
					<h3>ASSISTANTS D'ENSEIGNEMENT</h3>
					<ul id="assistants" class="membres_equipe">
						<?php foreach($assistants as $membre){ ?>
							<li class="membre">
								<!-- CONTENT -->
								<?php if($membre->post_content != ''){ ?>
									<div id="<?php echo $membre->ID; ?>" class="link_professeur open_in_popup" href="<?php echo get_permalink($membre->ID); ?>">
										<div class="nom_complet"><?php echo $membre->post_title; ?></div>
										<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
										if($fonction != ''){?>
										<div class="fonction"><?php echo $fonction; ?></div>
										<?php }	?>
									</div>
								<!-- NO CONTENT -->
								<?php } else{ ?>
									<span class="nom_complet"><?php echo $membre->post_title; ?></span>
									<?php $fonction = get_post_meta($membre->ID, 'wpcf-fonction', true);
									if($fonction != ''){?>
									</br><span class="fonction"><?php echo $fonction; ?></span>
									<?php }	?>
								</br>
								<?php } ?>
								</br>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
