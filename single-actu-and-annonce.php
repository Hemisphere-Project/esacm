<?php

$post_type = get_post_type();
$date_start = types_render_field( "date_start", array("format" => "U"));
$date_end = types_render_field( "date_end", array("format" => "U"));
date_default_timezone_set('Europe/Paris');
$date_now = time();
$keyword_list = wp_get_post_terms($post->ID, 'post_keyword', array("fields" => "all"));

if($post_type=='actu'){ ?>

 <!-- /////////////////// ACTUS  //////////////// -->

<!-- On echo tous les mots clés du post, et si l'un d'eux a un parent on lui affecte le mot clé du parent -->
<a class="post actu open_in_popup" id="<?php the_ID(); ?>" href="<?php echo get_post_permalink(); ?>" keywords="<?php foreach ($keyword_list as $keyword) { echo ($keyword->slug.' '); if($keyword->parent!=0){ $parent=get_term_by('id', $keyword->parent,'post_keyword'); echo $parent->slug.' ';}}?>">
	<div class="actuImage"><?php echo get_the_post_thumbnail() ; ?></div>

	<?php if($date_start&&$date_end){
		// CHECK à venir / En cours / rien - pour DRAPEAU
		if(($date_now>=$date_start)&&($date_now<=$date_end)){
			?><div class="flag shadowed typo_delta">⚑ EN COURS</div> <?php
		}else if(($date_now<=$date_start)){
			?><div class="flag shadowed typo_delta">⚑ À VENIR</div> <?php
		}
	} ?>
	<?php if($date_start&&!$date_end){
		// CHECK à venir / rien - pour DRAPEAU
		if(($date_now<=$date_start)){
			?><div class="flag shadowed typo_delta">⚑ À VENIR</div> <?php
		}
	} ?>

	<div class="actuTitle typo_delta"><?php echo the_title() ; ?></div>
	<div class="actuSubtitle typo_epsilon"><?php echo types_render_field("subtitle"); ?></div>
	<div class="actuExcerpt typo_epsilon"><?php echo types_render_field("extrait"); ?></div>
	<div class="actuOpen typo_epsilon">en savoir plus → </div>
</a>

<?php }else if($post_type=='annonce'){ ?>

<!-- /////////////////// ANNONCES  //////////////// -->

<div class="post annonce shadowedBox" id="<?php the_ID(); ?>" permalink="<?php echo get_post_permalink(); ?>" keywords="<?php foreach ($keyword_list as $keyword) { echo ($keyword->slug.' '); if($keyword->parent!=0){ $parent=get_term_by('id', $keyword->parent,'post_keyword'); echo $parent->slug.' ';}}?>">
<div class="annonceText typo_beta"><?php echo types_render_field("annonce_description"); ?></div>
<a class="annonceLink" href=<?php echo types_render_field("annonce_url", array("output"=>"raw")); ?>
	<?php if(strpos(types_render_field("annonce_url", array("output"=>"raw")), 'esacm')==false){ echo 'target="_blank"'; }else{ echo 'target="_self"'; } ?>
	>→ lire l'annonce
</a>
</div>

<?php } ?>
