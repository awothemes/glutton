<?php
/**
 * Glutton functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Glutton
 */

if ( ! function_exists( 'glutton_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function glutton_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Glutton, use a find and replace
	 * to change 'glutton' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'glutton', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_editor_style();
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
	set_post_thumbnail_size('glutton_blogroll-post-thumb', 340, 9999, array( 'center', 'center')  );
	
	/*
	 * Enable support for site logo.
	 */
	add_image_size( 'glutton_logo', 270, 60 );
	add_theme_support( 'custom-logo', array( 'size' => 'glutton_logo', 'flex-height' => true, 'flex-width'  => true, 'header-text' => array( 'site-title', 'site-description' ) ) );

	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'glutton' )
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
	add_theme_support( 'custom-background', apply_filters( 'glutton_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'glutton_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function glutton_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'glutton_content_width', 640 );
}
add_action( 'after_setup_theme', 'glutton_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function glutton_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'glutton' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'glutton' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
}
add_action( 'widgets_init', 'glutton_widgets_init' );

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

if ( ! function_exists( 'glutton_fonts_url' ) ) :
/**
 * Register Google fonts for Glutton.
 *
 * Create your own glutton_fonts_url() function to override in a child theme.
 *
 * @since Glutton 1.0.25
 *
 * @return string Google fonts URL for the theme.
 */
function glutton_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'cyrillic,latin,latin-ext';
	
	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'glutton' ) ) {
		$fonts[] = 'Merriweather:400,300,300italic,400italic,700,700italic,900,900italic';
	}	
	/* translators: If there are characters in your language that are not supported by Merriweather Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'glutton' ) ) {
		$fonts[] = 'Merriweather+Sans:700';
	}	
	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'glutton' ) ) {
		$fonts[] = 'Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
	}
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;
}

endif;

/**
 * Enqueue scripts and styles.
 */
function glutton_scripts() {
	//Stylesheets
	wp_enqueue_style( 'glutton-style', get_stylesheet_uri() );
	wp_enqueue_style( 'gumby-style', get_template_directory_uri() . '/css/gumby.css', array(), '20151215', false );
	wp_enqueue_style( 'glutton-fonts', glutton_fonts_url(), array(), null);  

	// Default Scripts Included and Registered by WordPress
	wp_enqueue_script('masonry');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	//Modernizr Gumbuy-build
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.6.2.min.js', array('jquery' ), '20151215', false );

	//Gumby library
	wp_enqueue_script( 'gumby', get_template_directory_uri() . '/js/libs/gumby.js', array(), '20151215', true );	
	wp_enqueue_script( 'gumby-retina', get_template_directory_uri() . '/js/libs/ui/gumby.retina.js', array(), '20151215', true );
	wp_enqueue_script( 'gumby-fixed', get_template_directory_uri() . '/js/libs/ui/gumby.fixed.js', array(), '20151215', true );
	wp_enqueue_script( 'gumby-toggleswitch', get_template_directory_uri() . '/js/libs/ui/gumby.toggleswitch.js', array(), '20151215', true );
	wp_enqueue_script( 'gumby-navbar', get_template_directory_uri() . '/js/libs/ui/gumby.navbar.js', array(), '20151215', true );
	wp_enqueue_script( 'gumby-validation', get_template_directory_uri() . '/js/libs/ui/jquery.validation.js', array(), '20151215', true );
	wp_enqueue_script( 'gumby-init', get_template_directory_uri() . '/js/libs/gumby.init.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'gumby-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'gumby-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'glutton_scripts' );



/**
 * Plugins install.
 */
require get_template_directory() . '/inc/plugin-install.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-menu-walker.php';

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

/**
 * Welcome Screen
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/class-glutton-welcome.php';
}
