<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hmsphr
 */

header("HTTP/1.1 301 Moved Permanently");
header("Location: ".get_bloginfo('url')."/#actu");
exit();


get_header(); ?>

	<!-- <div id="primary" class="content-area">
		<main id="main" class="site-main">
		</main>
	</div> -->

<?php
get_footer();
