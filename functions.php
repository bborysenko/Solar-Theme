<?php
/**
 * solar functions and definitions
 *
 * @package solar
 * @since solar 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since solar 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'solar_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since solar 1.0
 */
function solar_setup() {
	
	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );
	
	/**
	 * Custom functions that act independently of the theme templates
	 */
	require_once ( get_stylesheet_directory() . '/theme-options.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on solar, use a find and replace
	 * to change 'solar' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'solar', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'solar' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // solar_setup
add_action( 'after_setup_theme', 'solar_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since solar 1.0
 */
function solar_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'solar' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'solar_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function solar_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'solar_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );



function print_post_title() {
	
	global $post;
	
	$thePostID = $post->ID;
	$post_id = get_post($thePostID);
	$title = $post_id->post_title;
	$perm = get_permalink($post_id);
	$post_keys = array(); $post_val = array();
	$post_keys = get_post_custom_keys($thePostID);
	$is_link = 0;

	if (!empty($post_keys)) {
	
		foreach ($post_keys as $pkey) {
			if ($pkey=='_wp_svbtle_external_url' || $pkey=='_wp_svbtle_external_url' || $pkey=='_wp_svbtle_external_url') {
			$post_val = get_post_custom_values($pkey);
			}
		}
	
		if (empty($post_val)) {
			$link = $perm;
		} else {
			$link = $post_val[0];
			$is_link = 1;
		}
	
	} else {
	
		$link = $perm;
	
	}
	
	if ($is_link): ?>
		<h2 class="link">
			<a href="<?php echo $link ?>" >
				<?php echo the_title() ?>
				<img src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/anchor.svg" class="anchor">
			</a>
		</h2>
	
	<?php else: ?>
	
		<h2 class="no-link">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>

	<?php endif; 

}  
