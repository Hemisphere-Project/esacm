<?php
/**
 * hmsphr functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hmsphr
 */

if ( ! function_exists( 'hmsphr_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hmsphr_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on hmsphr, use a find and replace
		 * to change 'hmsphr' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hmsphr', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'hmsphr' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'hmsphr_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'hmsphr_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hmsphr_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hmsphr_content_width', 640 );
}
add_action( 'after_setup_theme', 'hmsphr_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hmsphr_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hmsphr' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hmsphr' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hmsphr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hmsphr_scripts() {
	wp_enqueue_style( 'hmsphr-style', get_stylesheet_uri() );

	wp_enqueue_script( 'hmsphr-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'hmsphr-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// register jQuery UI
	wp_enqueue_script('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('jquery'), '1.12.1');
	// deregister default jQuery included with Wordpress (il marche pas..???)
	wp_deregister_script( 'jquery' );
	// register jQuery
	$jquery_cdn = '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js';
	wp_enqueue_script( 'jquery', $jquery_cdn, array(), '2.2.4', true );

	// POPUPS
	if(is_home()){
		wp_enqueue_script( 'popup_script', get_template_directory_uri() . '/js/popup.js', array('jquery'), '20151215', true );
	}
	// POSTS NAVIGATION
	wp_enqueue_script( 'posts_navigation', get_template_directory_uri() . '/js/posts_navigation.js', array('jquery'), '20151215', true );
	// pass Ajax Url to script-navigation.js
	wp_localize_script('posts_navigation', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

	// PAGES NAVIGATION
	wp_enqueue_script( 'pages_navigation', get_template_directory_uri() . '/js/pages_navigation.js', array('jquery'), '20151215', true );

	// MASONRY
	wp_enqueue_script( 'masonry', get_template_directory_uri() . '/js/lib/masonry.pkgd.min.js', array('jquery'), '20151215', true );
	// FLICKITY
	wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/lib/flickity.pkgd.js', array('jquery'), '20151215', true );
	wp_enqueue_style( 'flickity-style', get_template_directory_uri().'/js/lib/flickity.css' );

}
add_action( 'wp_enqueue_scripts', 'hmsphr_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//Remove unused bloc added by Types plugin in back-office
function remove_types_info_box() {
    return false;
}
add_filter( 'types_information_table', 'remove_types_info_box' );

/*----------------------------------------*\
	GALERIES
\*----------------------------------------*/


function pw_show_gallery_image_urls( $content ) {
   global $post;
 	// Only do this on singular items
 	if( ! is_singular() )
 		return $content;
 	// Make sure the post has a gallery in it
 	if( ! has_shortcode( $post->post_content, 'gallery' ) )
 		return $content;
 	// Retrieve all galleries of this post
 	$galleries = get_post_galleries_images( $post );
	$image_list = '<ul>';
	// Loop through all galleries found
	foreach( $galleries as $gallery ) {
		// Loop through each image in each gallery
		foreach( $gallery as $image ) {
			$image_list .= '<li>' . $image . '</li>';
		}
	}
	$image_list .= '</ul>';
	// Append our image list to the content of our post
	$content .= $image_list;
 	return $content;
 }
 add_filter( 'the_content', 'pw_show_gallery_image_urls' );


/*------------------------------------*\
	GET SINGLE POST
\*------------------------------------*/

add_action('wp_ajax_nopriv_ajaxLoad', 'ajaxLoadFunction');
add_action('wp_ajax_ajaxLoad', 'ajaxLoadFunction');

function ajaxLoadFunction() {

	$id = $_POST['id'];
	$args = array(
	    'p' => $id,
      	    'post_type' => 'any'
	);
	$ajax_query = new WP_Query($args);

  	if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
    	// TO DO - Mettre le contenu html dans single_actu.php
    	// get_template_part( 'single_actu );
	$post_type = get_post_type($id);
	if($post_type == "actu" or $post_type == "annonce"){
	?>
		<div class="title typo_alpha"><?php echo the_title() ; ?></div>
		<div class="actuOpenedSubtitle typo_epsilon"><?php echo types_render_field("subtitle"); ?></div>
		<div class="actuOpenedContent typo_epsilon"><?php echo the_content() ; ?></div>
	<?php
	}
	elseif($post_type == "membre-equipe"){?>
		<div class="actuOpenedTitle typo_alpha"><?php echo the_title() ; ?></div>
		<div class="actuOpenedSubtitle typo_epsilon"><?php echo get_post_meta($id, 'wpcf-fonction', true); ?></div>
		<div class="actuOpenedContent typo_epsilon"><?php echo the_content() ; ?></div>
	<?php }
	elseif($post_type == "membre-equipe-rech"){?>
		<div class="actuOpenedTitle typo_alpha"><?php echo the_title() ; ?></div>
		<div class="actuOpenedSubtitle typo_epsilon"><?php echo get_post_meta($id, 'wpcf-fonction-recherche', true); ?></div>
		<div class="actuOpenedContent typo_epsilon"><?php echo the_content() ; ?></div>
	<?php }
	elseif($post_type == "membre-chercheur"){?>
		<div class="actuOpenedTitle typo_alpha"><?php echo the_title() ; ?></div>
		<div class="actuOpenedSubtitle typo_epsilon"><?php echo get_post_meta($id, 'wpcf-fonction-chercheur', true); ?></div>
		<div class="actuOpenedContent typo_epsilon"><?php echo the_content() ; ?></div>
	<?php }
	elseif($post_type == "axe"){?>
		<div class="actuOpenedTitle typo_alpha"><?php echo the_title() ; ?></div>
		<div class="actuOpenedContent typo_epsilon"><?php echo the_content() ; ?></div>
	<?php }
	elseif(($post_type == "diplome")||($post_type == "diplome_expo")){?>
		<div class="actuOpenedTitle typo_alpha"><?php echo the_title() ; ?></div>
		<div class="actuOpenedContent typo_epsilon"><?php echo the_content() ; ?></div>
	<?php }
  	endwhile;
  	endif;

  	die();
}
/*------------------------------------*\
	GET MORE POSTS
\*------------------------------------*/

add_action('wp_ajax_nopriv_ajaxLoadMore', 'ajaxLoadMoreFunction');
add_action('wp_ajax_ajaxLoadMore', 'ajaxLoadMoreFunction');

function ajaxLoadMoreFunction() {

	$firstId = $_POST['firstId'];
	$category = $_POST['category'];
	$timeB4 = get_the_time( 'U', $firstId );

	$args = array(
    'posts_per_page' => 5,
    'post_type' => array('actu', 'annonce'),
    'date_query' => array(
        'before' => date( 'c' , $timeB4 )
			),
		'category_name'=> $category
	);

	$ajax_query = new WP_Query($args);

  if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();

    get_template_part( 'single-actu-and-annonce');

  endwhile;
  endif;

  die();
}

/*----------------------------------------*\
	          EDITOR
\*----------------------------------------*/

/********* Registers an editor stylesheet for the theme ***********/
if ( ! function_exists( 'hmsphr_theme_add_editor_styles' ) ) {
	function hmsphr_theme_add_editor_styles() {
	    add_editor_style( 'custom-editor-style.css' );
	}
}

// After VC Init
add_action( 'vc_after_init', 'vc_after_init_actions' );

function vc_after_init_actions() {

    // Remove VC Elements
    if( function_exists('vc_remove_element') ){

        // Remove VC Elements
        vc_remove_element( 'vc_btn' );
        vc_remove_element( 'vc_icon' );
        //vc_remove_element( 'vc_text_separator' );
        vc_remove_element( 'vc_message' );
        vc_remove_element( 'vc_facebook' );
        vc_remove_element( 'vc_tweetmeme' );
        vc_remove_element( 'vc_googleplus' );
        vc_remove_element( 'vc_pinterest' );
        vc_remove_element( 'vc_toggle' );
        vc_remove_element( 'vc_tta_tabs' );
        vc_remove_element( 'vc_tta_tour' );
        vc_remove_element( 'vc_tta_pageable' );
        vc_remove_element( 'vc_custom_heading' );
        vc_remove_element( 'vc_widget_sidebar' );
        vc_remove_element( 'vc_posts_slider' );
        vc_remove_element( 'vc_video' );
        vc_remove_element( 'vc_gmaps' );
        vc_remove_element( 'vc_cta' );
        vc_remove_element( 'vc_flickr' );
        vc_remove_element( 'vc_progress_bar' );
        vc_remove_element( 'vc_pie' );
        vc_remove_element( 'vc_round_chart' );
        vc_remove_element( 'vc_line_chart' );
        vc_remove_element( 'vc_basic_grid' );
        vc_remove_element( 'vc_media_grid' );
        vc_remove_element( 'vc_masonry_grid' );
        vc_remove_element( 'vc_masonry_media_grid' );
        vc_remove_element( 'vc_wp_search' );
        vc_remove_element( 'vc_wp_meta' );
        vc_remove_element( 'vc_wp_recentcomments' );
        vc_remove_element( 'vc_wp_calendar' );
        vc_remove_element( 'vc_wp_pages' );
        vc_remove_element( 'vc_wp_tagcloud' );
        vc_remove_element( 'vc_wp_custommenu' );
        vc_remove_element( 'vc_wp_text' );
        vc_remove_element( 'vc_wp_posts' );
        vc_remove_element( 'vc_wp_categories' );
        vc_remove_element( 'vc_wp_archives' );
        vc_remove_element( 'vc_wp_rss' );
    }

}

// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );

function vc_before_init_actions() {

    // Require new custom Element
    require_once( get_template_directory().'/vc-elements/sous-titre.php' );
    require_once( get_template_directory().'/vc-elements/dotted-hr.php' );
    require_once( get_template_directory().'/vc-elements/exergue.php' );
    require_once( get_template_directory().'/vc-elements/titre-ancre.php' );
    require_once( get_template_directory().'/vc-elements/glyphe.php' );
    require_once( get_template_directory().'/vc-elements/lien-encadre.php' );
    
}

//Require new shortcode
require_once( get_template_directory().'/vc-elements/etablissements-partenaires.php' );

/*----------------------------------------*\
	STICKY POSTS
\*----------------------------------------*/


function filter_loop( $posts, $query=NULL, $c=NULL ) {
	global $wp_query, $wpdb;
	if ( !count( $posts ) ){ return $posts;	}

	$sticked_posts=array();
	$normal_posts=array();

	if(($posts[0]->post_type=="annonce")||($posts[0]->post_type=="actu")){
		foreach($posts as $key => $post){
		  $type = $post->post_type;
			if($type=='actu'){
				$sticked = get_post_meta($post->ID,"wpcf-sticked_actu");
				if($sticked[0]==1){ array_push($sticked_posts, $post); }
				else{ array_push($normal_posts, $post); }
			}
			if($type=='annonce'){
				$sticked = get_post_meta($post->ID,"wpcf-sticked_annonce");
				if($sticked[0]==1){ array_push($sticked_posts, $post); }
				else{ array_push($normal_posts, $post); }
			}
		}
		$filtered_posts = array_merge($sticked_posts, $normal_posts);
		return $filtered_posts;
	}else{
		return $posts;
	}
}

add_filter( 'the_posts', 'filter_loop' );

/*----------------------------------------*\
	NO IMAGE LINK (remove links surrounding images)
\*----------------------------------------*/


function attachment_image_link_remove_filter($content){
        $content = preg_replace(array('{<a[^>]*><img}', '{/></a>}'), array('<img', '/>'), $content);
        return $content;
}

add_filter('the_content', 'attachment_image_link_remove_filter');

function custom_url_encode($str) {
    $str = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $str);
    return urlencode( strtr(utf8_decode($str), utf8_decode("àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'"), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY-') );
}
