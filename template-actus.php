<?php
/*
 * Template Name: Page Actus
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

   <?php

    $tag=$_GET["tag"];
    $tags = explode(",", $tag);

    // Name List for title
    $tagsNames=array();
    foreach ($tags as $slug) {
      $term = get_term_by('slug', $slug, 'post_keyword');
      if ($term){
        $name = $term->name;
        array_push($tagsNames, $name);
      }
    }

    // Args for Query
    if(!empty($tagsNames)){
       $args = array(
        'post_type' => array('actu', 'annonce'),
        'posts_per_page'=> -1,
        'tax_query' => array(
          array(
              'taxonomy' => 'post_keyword',
              'field' => 'slug',
              'terms' => $tags
          )
        )
       );
     }else if(empty($tagsNames)){
       $args = array(
        'post_type' => array('actu', 'annonce'),
        'posts_per_page'=> -1
       );
     }

     ?>

  	 <section class="actus">
  		 <div class="title typo_alpha"><?php if(!empty($tagsNames)){echo implode(', ', $tagsNames);}else{echo 'évènements et actualités';} ?></div>


   <!-- //////////////////// LOOP  ////////////////// -->
  		<div class="postsTable">
  			<div class="grid-sizer"></div>
  			<div class="gutter-sizer"></div>

        <?php
        
  		  $loop = new WP_Query( $args );
  		  while ( $loop->have_posts() ) : $loop->the_post();

  				get_template_part( 'single-actu-and-annonce');

   			endwhile; ?>
  		</div>

  	 </section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
