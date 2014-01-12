//* Add scripts & styles*/
add_action( 'wp_enqueue_scripts', 'load_fontawesome_style', 999 );
function load_fontawesome_style() {
      wp_register_style( 'font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );
      wp_enqueue_style( 'font-awesome' );
}

//* Reposition the primary navigation menu above the header
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

//* Add widget area to primary navbar. Use for Simple Social Shares */
genesis_register_sidebar( array(
	'id'          => 'nav-social-menu',
	'name'        => __( 'Nav Social Menu', 'finley' ),
	'description' => __( 'This is the nav social menu section.', 'finley' ),
) );

add_filter( 'genesis_nav_items', 'sws_social_icons', 10, 2 );
add_filter( 'wp_nav_menu_items', 'sws_social_icons', 10, 2 );


//* Add new widget for social media icons in navbar */
function sws_social_icons($menu, $args) {
	$args = (array)$args;
	if ( 'primary' !== $args['theme_location'] )
		return $menu;
	ob_start();
	genesis_widget_area('nav-social-menu');
	$social = ob_get_clean();
	return $menu . $social;
}
