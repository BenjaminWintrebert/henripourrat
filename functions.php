<?php
/**
 * Henri Pourrat functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Henri_Pourrat
 */

if (!function_exists('hp_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function hp_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Henri Pourrat, use a find and replace
         * to change 'hp' to the name of your theme in all the template files.
         */
        load_theme_textdomain('hp', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'hp'),
            'footer' => esc_html__('Footer', 'hp'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('hp_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
    }
endif;
add_action('after_setup_theme', 'hp_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hp_content_width()
{
    $GLOBALS['content_width'] = apply_filters('hp_content_width', 640);
}

add_action('after_setup_theme', 'hp_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hp_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'hp'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'hp_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function hp_scripts()
{
    wp_enqueue_style('hp-style', get_stylesheet_uri());

    wp_enqueue_script('hp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true);

    wp_enqueue_script('hp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);

    wp_enqueue_script("jquery");

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'hp_scripts');

function the_thumb_url()
{
    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
    if (empty($thumb)) {
        $couverture = get_field('couverture');
        echo $couverture['url'];
    } else {
        echo $thumb[0];
    }
}

add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header()
{
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

function my_custom_post_livre()
{
    $labels = array(
        'name' => _x('Livres', 'post type general name'),
        'singular_name' => _x('livre', 'post type singular name'),
        'add_new' => _x('Ajouter', 'book'),
        'add_new_item' => __('Ajouter un nouveau livre'),
        'edit_item' => __('Modifié le livre'),
        'new_item' => __('Nouveau livre'),
        'all_items' => __('Tout les livres'),
        'view_item' => __('Voir livre'),
        'search_items' => __('Rechercher un livre'),
        'not_found' => __('Aucun livre trouvé'),
        'not_found_in_trash' => __('Aucun livre dans la corbeille'),
        'parent_item_colon' => '',
        'menu_name' => 'Livres'
    );
    $args = array(
        'labels' => $labels,
        'hirarchical' => false,
        'description' => 'Livres',
        'public' => true,
        'menu_position' => 6,
        'supports' => array(),
        'has_archive' => true,
        'taxonomies' => array()
    );
    register_post_type('livre', $args);
}

add_action('init', 'my_custom_post_livre');


/* Custom Post contact */
function wpfstop_change_default_title($title)
{
    $screen = get_current_screen();
    if ('contact' == $screen->post_type) {
        $title = 'Nom prénom';
    }
    return $title;
}

add_filter('enter_title_here', 'wpfstop_change_default_title');

function my_custom_post_contact()
{
    $labels = array(
        'name' => _x('Contact', 'post type general name'),
        'singular_name' => _x('contact', 'post type singular name'),
        'add_new' => _x('Ajouter', 'book'),
        'add_new_item' => __('Ajouter un nouveau contact'),
        'edit_item' => __('Modifié le contact'),
        'new_item' => __('Nouveau contact'),
        'all_items' => __('Tout les contact'),
        'view_item' => __('Voir contact'),
        'search_items' => __('Rechercher un contact'),
        'not_found' => __('Aucun contact trouvé'),
        'not_found_in_trash' => __('Aucun contact dans la corbeille'),
        'parent_item_colon' => '',
        'menu_name' => 'Page de contact'
    );
    $args = array(
        'labels' => $labels,
        'hirarchical' => false,
        'description' => 'Contact',
        'public' => true,
        'menu_position' => 7,
        'supports' => array('title'),
        'has_archive' => true,
        'taxonomies' => array()
    );
    register_post_type('contact', $args);
}

add_action('init', 'my_custom_post_contact');


function default_comments_on($data)
{
    if ($data['post_type'] == 'event') {
        $data['comment_status'] = 1;
    }

    return $data;
}

add_filter('wp_insert_post_data', 'default_comments_on');

function month($date)
{
    $mois = array(1 => 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    preg_match('/(\d{1,2}) (\d{1,2}) (\d{4})/i', $date, $output);
    return $output[1] . ' ' . $mois[$output[2]] . ' ' . $output[3];
}

function get_domain_from_url($link)
{
    $link = parse_url($link);
    $domain = $link['host'];
    preg_match('/(?:www.)?([a-z0-9]+)(?:.[a-z0-9]+)/i', $domain, $output);
    return $output[1];
}

function the_marchand($string)
{
    $marchand = explode(';', $string);
    foreach ($marchand as $a_marchand) {
        echo '<a href="' . $a_marchand . '">' . get_domain_from_url($a_marchand) . '</a>';
    }
}

function crypt_mail($mail)
{
    return base64_encode($mail);
}

function blog_favicon()
{
    echo '<link rel="apple-touch-icon" sizes="57x57" href="' . get_template_directory_uri() . '/img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="' . get_template_directory_uri() . '/img/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="' . get_template_directory_uri() . '/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="' . get_template_directory_uri() . '/img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="' . get_template_directory_uri() . '/img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="' . get_template_directory_uri() . '/img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="' . get_template_directory_uri() . '/img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="' . get_template_directory_uri() . '/img/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="' . get_template_directory_uri() . '/img/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="' . get_template_directory_uri() . '/img/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="' . get_template_directory_uri() . '/img/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="' . get_template_directory_uri() . '/img/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="' . get_template_directory_uri() . '/img/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="' . get_template_directory_uri() . '/img/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="' . get_template_directory_uri() . '/img/manifest.json">
    <link rel="mask-icon" href="' . get_template_directory_uri() . '/img/safari-pinned-tab.svg" color="#000000">
    <link rel="shortcut icon" href="' . get_template_directory_uri() . '/img/favicon.ico">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="msapplication-TileImage" content="' . get_template_directory_uri() . '/img/mstile-144x144.png">
    <meta name="msapplication-config" content="' . get_template_directory_uri() . '/img/browserconfig.xml">
    <meta name="theme-color" content="#7dedc2">';
}

add_action('wp_head', 'blog_favicon');

/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */
class HenriPourrat
{
    private $henri_pourrat_options;

    public function __construct()
    {
        add_action('admin_menu', array($this, 'henri_pourrat_add_plugin_page'));
        add_action('admin_init', array($this, 'henri_pourrat_page_init'));
    }

    public function henri_pourrat_add_plugin_page()
    {
        add_menu_page(
            'Henri Pourrat', // page_title
            'Henri Pourrat', // menu_title
            'manage_options', // capability
            'henri-pourrat', // menu_slug
            array($this, 'henri_pourrat_create_admin_page'), // function
            'dashicons-hammer', // icon_url
            100 // position
        );
    }

    public function henri_pourrat_create_admin_page()
    {
        $this->henri_pourrat_options = get_option('henri_pourrat_option_name'); ?>

        <div class="wrap">
            <h2>Henri Pourrat</h2>
            <p></p>
            <?php settings_errors(); ?>

            <form method="post" action="options.php">
                <?php
                settings_fields('henri_pourrat_option_group');
                do_settings_sections('henri-pourrat-admin');
                submit_button();
                ?>
            </form>
        </div>
    <?php }

    public function henri_pourrat_page_init()
    {
        register_setting(
            'henri_pourrat_option_group', // option_group
            'henri_pourrat_option_name', // option_name
            array($this, 'henri_pourrat_sanitize') // sanitize_callback
        );

        add_settings_section(
            'henri_pourrat_setting_section', // id
            'Settings', // title
            array($this, 'henri_pourrat_section_info'), // callback
            'henri-pourrat-admin' // page
        );

        add_settings_field(
            'mini_bio_1', // id
            'Mini-bio', // title
            array($this, 'mini_bio_1_callback'), // callback
            'henri-pourrat-admin', // page
            'henri_pourrat_setting_section' // section
        );

        add_settings_field(
            'facebook_1', // id
            'Lien Facebook', // title
            array($this, 'facebook_1_callback'), // callback
            'henri-pourrat-admin', // page
            'henri_pourrat_setting_section' // section
        );

        add_settings_field(
            'twitter_2', // id
            'Lien Twitter', // title
            array($this, 'twitter_2_callback'), // callback
            'henri-pourrat-admin', // page
            'henri_pourrat_setting_section' // section
        );

        add_settings_field(
            'instagram_3', // id
            'Lien Instagram', // title
            array($this, 'instagram_3_callback'), // callback
            'henri-pourrat-admin', // page
            'henri_pourrat_setting_section' // section
        );

        add_settings_field(
            'flickr_4', // id
            'Lien Flickr', // title
            array($this, 'flickr_4_callback'), // callback
            'henri-pourrat-admin', // page
            'henri_pourrat_setting_section' // section
        );
    }

    public function henri_pourrat_sanitize($input)
    {
        $sanitary_values = array();
        if (isset($input['mini_bio_1'])) {
            $sanitary_values['mini_bio_1'] = esc_textarea($input['mini_bio_1']);
        }

        if (isset($input['facebook_1'])) {
            $sanitary_values['facebook_1'] = sanitize_text_field($input['facebook_1']);
        }

        if (isset($input['twitter_2'])) {
            $sanitary_values['twitter_2'] = sanitize_text_field($input['twitter_2']);
        }

        if (isset($input['instagram_3'])) {
            $sanitary_values['instagram_3'] = sanitize_text_field($input['instagram_3']);
        }

        if (isset($input['flickr_4'])) {
            $sanitary_values['flickr_4'] = sanitize_text_field($input['flickr_4']);
        }

        return $sanitary_values;
    }

    public function henri_pourrat_section_info()
    {

    }

    public function mini_bio_1_callback()
    {
        printf(
            '<textarea class="large-text" rows="5" name="henri_pourrat_option_name[mini_bio_1]" id="mini_bio_1">%s</textarea>',
            isset($this->henri_pourrat_options['mini_bio_1']) ? esc_attr($this->henri_pourrat_options['mini_bio_1']) : ''
        );
    }

    public function facebook_1_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="henri_pourrat_option_name[facebook_1]" id="facebook_1" value="%s">',
            isset($this->henri_pourrat_options['facebook_1']) ? esc_attr($this->henri_pourrat_options['facebook_1']) : ''
        );
    }

    public function twitter_2_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="henri_pourrat_option_name[twitter_2]" id="twitter_2" value="%s">',
            isset($this->henri_pourrat_options['twitter_2']) ? esc_attr($this->henri_pourrat_options['twitter_2']) : ''
        );
    }

    public function instagram_3_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="henri_pourrat_option_name[instagram_3]" id="instagram_3" value="%s">',
            isset($this->henri_pourrat_options['instagram_3']) ? esc_attr($this->henri_pourrat_options['instagram_3']) : ''
        );
    }

    public function flickr_4_callback()
    {
        printf(
            '<input class="regular-text" type="text" name="henri_pourrat_option_name[flickr_4]" id="flickr_4" value="%s">',
            isset($this->henri_pourrat_options['flickr_4']) ? esc_attr($this->henri_pourrat_options['flickr_4']) : ''
        );
    }

}

/*
 * Retrieve this value with:
 * $henri_pourrat_options = get_option( 'henri_pourrat_option_name' ); // Array of All Options
 * $mini_bio_1 = $henri_pourrat_options['mini_bio_1']; // Mini-bio
 * $facebook_1 = $henri_pourrat_options['facebook_1']; // Facebook
 * $twitter_2 = $henri_pourrat_options['twitter_2']; // Twitter
 * $instagram_3 = $henri_pourrat_options['instagram_3']; // Instagram
 * $flickr_4 = $henri_pourrat_options['flickr_4']; // Flickr
 */


if (is_admin())
    $henri_pourrat = new HenriPourrat();