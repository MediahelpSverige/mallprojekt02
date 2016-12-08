<?php
if ( ! function_exists( 'post_exists' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
}
if(function_exists('register_nav_menus')){
	register_nav_menus(
		array(
			'main_nav' => 'Meny i sidhuvud',
			'footer_nav' => 'Meny i sidfot'
			)
	);
}
if ( file_exists( STYLESHEETPATH . '/class.my-theme-options.php' ) )
	include_once( STYLESHEETPATH . '/class.my-theme-options.php' );
add_theme_support( 'post-thumbnails' );
/*
* Helper function to return the theme option value. If no value has been saved, it returns $default.
* Needed because options are saved as serialized strings.
*
* This code allows the theme to work without errors if the Options Framework plugin has been disabled.
*/
if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {

	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];

	if ( get_option($option_name) ) {
		$options = get_option($option_name);
	}

	if ( isset($options[$name]) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
}
add_theme_support( 'custom-logo' );
add_theme_support('title-tag');
/**
* Register our sidebars and widgetized areas.
*
*/
function mediahelp_widgets() {
	register_sidebar( array(
		'name'          => 'Sidebar 1',
		'id'            => 'sidebar1',
		'before_widget' => '<div class="sidebar-wrapper">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	// register_sidebar( array(
	// 'name' => __( 'Footer Widget adress', 'landqvist' ),
	// 'id' => 'footer-adress',
	// 'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template) Left Footer Widget.', 'landqvist' ),
	// 'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 'after_widget' => '</aside>',
	// 'before_title' => '<h3 class="widget-title">',
	// 'after_title' => '</h3>',
	// ) );

}
add_action( 'widgets_init', 'mediahelp_widgets' );

function custom_post() {
	$args = array(

		'public' =>true,
		'label' => 'Custom post',
		'description'        => __( 'Description.', 'mediahelp' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'custom-postt' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'taxonomies'		 => array('category'),
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )

	);
	register_post_type( 'projekt', $args );
}

add_action(  'init', 'custom_post' );


function mySearchFilter($query) {
	if ($query->is_search) {
		//$query->set('category_name','aktuellt');
	}
	return $query;
}
add_filter('pre_get_posts','mySearchFilter');
function my_project_filter_publish_dates( $the_date, $d, $post ) {
	if ( is_int( $post) ) {
		$post_id = $post;
	} else {
		$post_id = $post->ID;
	}
	if ( 'post' != get_post_type( $post_id ) )
		return $the_date;
	return date( 'Y-m-d', strtotime( $the_date ) );
}
add_action( 'get_the_date', 'my_project_filter_publish_dates', 10, 3 );


/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */

function new_excerpt_more( $more ) {
    return sprintf( '...<a class="read-more" href="%1$s">Läs mer</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


function wpdocs_custom_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


?>