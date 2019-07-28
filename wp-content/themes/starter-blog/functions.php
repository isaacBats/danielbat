<?php
/**
 * StarterBlog functions and definitions.
 * User Profile: https://profiles.wordpress.org/fahimmurshed
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package StarterBlog
 */

if ( ! function_exists( 'starterblog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function starterblog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on StarterBlog, use a find and replace
		 * to change 'starter-blog' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'starter-blog', get_template_directory() . '/languages' );

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
			'headermenu' => esc_html__( 'Header Menu', 'starter-blog' ),
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
			'image',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'starterblog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 100,
		) );
		
		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			the_post_thumbnail( 'full' );
			}
	}
endif; // starterblog_setup.
add_action( 'after_setup_theme', 'starterblog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function starterblog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'starterblog_content_width', 640 );
}
add_action( 'after_setup_theme', 'starterblog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function starterblog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'starter-blog' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'starterblog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function starterblog_scripts() {
	//Starter CSS
	wp_enqueue_style( 'starterblog-google-font', starterblog_fonts_url(), false );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	//RTL start
	if(is_rtl()) {
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/assets/css/bootstrap-rtl.min.css' );
	}
	//RTL end
	wp_enqueue_style( 'starterblog-main', get_template_directory_uri() . '/assets/css/main.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'starterblog-style', get_stylesheet_uri(), array( 'bootstrap', 'font-awesome' ) );

	//Starter Blog JS
	wp_enqueue_script( 'jquery-theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array( 'jquery' ), '20120207', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '20190219', true );
	wp_enqueue_script( 'starterblog-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20120211', true );

	wp_enqueue_script( 'starterblog-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130112', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'starterblog_scripts' );

if ( ! function_exists( 'starterblog_fonts_url' ) ) :
/**
 * Register Google fonts for StarterBlog.
 *
 * Create your own starterblog_fonts_url() function to override in a child theme.
 *
 * @since StarterBlog 1.0.0
 *
 * @return string Google fonts URL for the theme.
 */
function starterblog_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'cyrillic,latin-ext';


	$fonts[] = 'Ubuntu:400,400i,700,700i';

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

function starterblog_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'starterblog_add_editor_styles' );

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
 * Customizer Options
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Plugin Installer
 */
require_once get_template_directory() . '/inc/install-plugins.php';

/**
 * Guttenberg support ❤
 */
add_theme_support('align-wide');

add_theme_support('editor-styles');

add_theme_support( 'editor-color-palette', array(
	array(
		'name' => __( 'strong magenta', 'starter-blog' ),
		'slug' => 'strong-magenta',
		'color' => '#a156b4',
	),
	array(
		'name' => __( 'light grayish magenta', 'starter-blog' ),
		'slug' => 'light-grayish-magenta',
		'color' => '#d0a5db',
	),
	array(
		'name' => __( 'very light gray', 'starter-blog' ),
		'slug' => 'very-light-gray',
		'color' => '#eee',
	),
	array(
		'name' => __( 'very dark gray', 'starter-blog' ),
		'slug' => 'very-dark-gray',
		'color' => '#444',
	),
) );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function starterblog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'starterblog_pingback_header' );
