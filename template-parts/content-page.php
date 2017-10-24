<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hmsphr
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	//CHECK IF THERE ARE ANCHOR TITLE (CLASS = "vc-titreancre-title") IN THE CONTENT
	$submenu_items = array();
	$doc = new DOMDocument();
	//Do shortcode to get the final content
	$html_content = do_shortcode( get_the_content() );
	//Encode in utf-8
	$html_content = mb_convert_encoding($html_content, 'HTML-ENTITIES', 'UTF-8');
	$doc->loadHTML( $html_content );

	$classname = "vc-titreancre-title";
	$nodes = array();
	//GET ALL H2
	$nodes = $doc->getElementsByTagName("h2");
	foreach ($nodes as $element){
		$classy = $element->getAttribute("class");
		//CHECK CLASS
		if (strpos($classy, $classname) !== false){
		       $submenu_items[] = $element->textContent;
		}
	}

	if(count($submenu_items)>0){?>
		<div id="submenu_wrapper" class="typo_beta">
			<a href="#presentation">présentation</a>
			<?php foreach($submenu_items as $submenu){?>
			  • <a href="#<?php echo custom_url_encode(str_replace(' ', '-', $submenu)); ?>"><?php echo $submenu; ?></a>
			<?php } ?>
		</div>
		<div id="submenu_pusher"></div>
	<?php }
	?>


	<header class="entry-header">
		<?php if(count($submenu_items)>0){
			the_title( '<h1 class="title entry-title typo_alpha" id="presentation">', '</h1>' );
		}
		else{
			the_title( '<h1 class="title entry-title typo_alpha">', '</h1>' );
		}
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

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'hmsphr' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
