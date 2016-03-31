<?php
/**
 * Henri Pourrat functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Henri_Pourrat
 */

if ( ! function_exists( 'hp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Henri Pourrat, use a find and replace
	 * to change 'hp' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'hp', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'hp' ),
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

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'hp_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hp_content_width', 640 );
}
add_action( 'after_setup_theme', 'hp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hp' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hp_scripts() {
	wp_enqueue_style( 'hp-style', get_stylesheet_uri() );

	wp_enqueue_script( 'hp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'hp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hp_scripts' );

function the_thumb_url() {
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
	echo $thumb[0];
}

add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/* Custom Post Livres */

function my_custom_post_livre() {
	$labels = array(
		'name'               => _x( 'Livres', 'post type general name' ),
		'singular_name'      => _x( 'livre', 'post type singular name' ),
		'add_new'            => _x( 'Ajouter', 'book' ),
		'add_new_item'       => __( 'Ajouter un nouveau livre' ),
		'edit_item'          => __( 'Modifié le livre' ),
		'new_item'           => __( 'Nouveau livre' ),
		'all_items'          => __( 'Tout les livres' ),
		'view_item'          => __( 'Voir livre' ),
		'search_items'       => __( 'Rechercher un livre' ),
		'not_found'          => __( 'Aucun livre trouvé' ),
		'not_found_in_trash' => __( 'Aucun livre dans la corbeille' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Livres'
	);
	$args = array(
		'labels'        => $labels,
		'hirarchical' => false,
		'description'   => 'Livres',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array(),
		'has_archive'   => true,
		'taxonomies' => array ()
	);
	register_post_type( 'livre', $args );
}
add_action( 'init', 'my_custom_post_livre' );

/* Custom Post Actu */

function my_custom_post_actu() {
	$labels = array(
		'name'               => _x( 'Actualités', 'post type general name' ),
		'singular_name'      => _x( 'actualité', 'post type singular name' ),
		'add_new'            => _x( 'Ajouter', 'book' ),
		'add_new_item'       => __( 'Ajouter une actualitée' ),
		'edit_item'          => __( 'Modifié une actualitée' ),
		'new_item'           => __( 'Nouvelle actualitée' ),
		'all_items'          => __( 'Toutes les actualitée' ),
		'view_item'          => __( 'Voir actualitée' ),
		'search_items'       => __( 'Rechercher une actualitée' ),
		'not_found'          => __( 'Aucune actualitée trouvé' ),
		'not_found_in_trash' => __( 'Aucune actualitée dans la corbeille' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Actualités'
	);
	$args = array(
		'labels'        => $labels,
		'hirarchical' => false,
		'description'   => 'Actualités',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array(),
		'has_archive'   => true,
		'taxonomies' => array ()
	);
	register_post_type( 'actualité', $args );
}
add_action( 'init', 'my_custom_post_actu' );

/* Custom Post Paramètres */

function my_custom_post_parametre() {
	$labels = array(
		'name'               => _x( 'Paramètres', 'post type general name' ),
		'singular_name'      => _x( 'paramètre', 'post type singular name' ),
		'menu_name'          => 'Paramètres'
	);
	$args = array(
		'labels'        => $labels,
		'hirarchical' => false,
		'description'   => 'Paramètres',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array(),
		'has_archive'   => true,
		'taxonomies' => array ()
	);
	register_post_type( 'paramètre', $args );
}
add_action( 'init', 'my_custom_post_parametre' );