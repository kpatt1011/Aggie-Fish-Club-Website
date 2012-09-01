<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 590; /* pixels */

if ( ! function_exists( 'onlinemarketer_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function onlinemarketer_setup() {
	/**
	 * Make theme available for translation
	 */
	load_theme_textdomain( 'online-marketer', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'online-marketer' ),
	) );

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery' ) );
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	// custom backgrounds
	add_custom_background();
	// header image define
	define('NO_HEADER_TEXT', true ); // I prefer no header text, you can change this
	// define('HEADER_TEXTCOLOR', 'ffffff'); // the text color in the header ( to use uncomment it and comment no header tx
	define('HEADER_IMAGE', '%s/library/images/headers/header.jpg'); // %s is the template dir uri
	define('HEADER_IMAGE_WIDTH', 975); // the width of the logo
	define('HEADER_IMAGE_HEIGHT', 241); // the height of the logo
	// gets included in the site header
	function header_style() { ?>
	<?php
	}
	// gets included in the admin header
	function admin_header_style() {
	?><style type="text/css">
	#headimg {
	width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	}
	</style><?php
	}
	add_custom_image_header('header_style', 'admin_header_style');
	add_theme_support( 'post-thumbnails' );
}
endif; // onlinemarketer_setup

add_action( 'after_setup_theme', 'onlinemarketer_setup' );


/**
 * Title filter 
 */
function onlinemarketer_filter_wp_title( $title ) {
    // Get the Site Name
    $site_name = get_bloginfo( 'name' );
    // Prepend name
    $filtered_title = $site_name . $title;
    
	// Get the Site Description
	$site_description = get_bloginfo( 'description' );
	// Append Site Description to title
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$filtered_title = $site_name . ' | ' . $site_description;
	}
	
    // Return the modified title
    return $filtered_title;
}
// Hook into 'wp_title'
add_filter( 'wp_title', 'onlinemarketer_filter_wp_title' );




/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
if ( ! function_exists( 'onlinemarketer_main_nav' ) ) :
function onlinemarketer_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu( 
    	array( 
    		'menu' => 'primary', /* menu name */
    		'theme_location' => 'primary', /* where in the theme it's assigned */
    		'container_class' => 'menu', /* container class */
    		'fallback_cb' => 'onlinemarketer_main_nav_fallback' /* menu fallback */
    	)
    );
}
endif;

if ( ! function_exists( 'onlinemarketer_main_nav_fallback' ) ) :
	function onlinemarketer_main_nav_fallback() { wp_page_menu( 'show_home=Home&menu_class=menu' ); }
endif;

function onlinemarketer_enqueue_comment_reply() {
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
        }
 }
add_action( 'wp_enqueue_scripts', 'onlinemarketer_enqueue_comment_reply' );
 
 
function onlinemarketer_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'onlinemarketer_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function onlinemarketer_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar 1', 'online-marketer' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'onlinemarketer_widgets_init' );

if ( ! function_exists( 'onlinemarketer_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 */
function onlinemarketer_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav id="<?php echo $nav_id; ?>">
		<h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'online-marketer' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'online-marketer' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'online-marketer' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'online-marketer' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'online-marketer' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif;


if ( ! function_exists( 'onlinemarketer_comment' ) ) :
/**
 * Template for comments and pingbacks.
 */
function onlinemarketer_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'online-marketer' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'online-marketer' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="clearfix">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'online-marketer' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'online-marketer' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'online-marketer' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'online-marketer' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for onlinemarketer_comment()

if ( ! function_exists( 'onlinemarketer_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function onlinemarketer_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'online-marketer' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'online-marketer' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds custom classes to the array of body classes.
 */
function onlinemarketer_body_classes( $classes ) {
	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	return $classes;
}
add_filter( 'body_class', 'onlinemarketer_body_classes' );

/**
 * Returns true if a blog has more than 1 category
 */
function onlinemarketer_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Flush out the transients used in onlinemarketer_categorized_blog
 */
function onlinemarketer_category_transient_flusher() {
	
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'onlinemarketer_category_transient_flusher' );
add_action( 'save_post', 'onlinemarketer_category_transient_flusher' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function onlinemarketer_enhanced_image_navigation( $url ) {
	global $post, $wp_rewrite;

	$id = (int) $post->ID;
	$object = get_post( $id );
	if ( wp_attachment_is_image( $post->ID ) && ( $wp_rewrite->using_permalinks() && ( $object->post_parent > 0 ) && ( $object->post_parent != $id ) ) )
		$url = $url . '#main';

	return $url;
}
add_filter( 'attachment_link', 'onlinemarketer_enhanced_image_navigation' );
