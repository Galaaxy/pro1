<?php

function add_to_context($data) {

	global $wpdb;

	$data["url"] = get_site_url();

	$data["menu"] = new TimberMenu("new-menu");
	$data["menuFooter"] = new TimberMenu("footer-menu");
	$data["footer_widgets"] = Timber::get_widgets('footer-widgets');

	$data["fewo"] = $wpdb->get_results("SELECT id, name, text from wp_fewo_wohnungen");

	foreach ($data["fewo"] as $key => $content){
		$data["images"][$key] = loadImagesFrontendMarked($data["fewo"][$key]->id);
	}

	return $data;

}
add_filter('timber_context', 'add_to_context');

function register_my_menu() {
	register_nav_menu('new-menu',__( 'New Menu' ));
}
add_action( 'init', 'register_my_menu' );


function register_my_menus() {
	register_nav_menus(
		array(
			'new-menu' => __( 'Haupt Menu' ),
			'footer-menu' => __( 'Footer Menu' )
		)
	);
}
add_action( 'init', 'register_my_menus' );

/**
 * Customizer additions
 */
require_once get_template_directory() . '/inc/customizer.php';

function my_excerpt_protected( $excerpt ) {
	if ( post_password_required() )
		$excerpt = '<em>[This is password-protected.]</em>';
	return $excerpt;
}

add_filter( 'the_excerpt', 'my_excerpt_protected' );

function my_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "To view this protected post, enter the password below:" ) . '
    <label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
	return $o;
}
add_filter( 'the_password_form', 'my_password_form' );

/**
 * Thumbnail Specifications
 */
add_theme_support( 'post-thumbnails' );
add_image_size('thumbnail-crop', '500', '360', true);

// Create Widget Area
if (function_exists('register_sidebar')) {
	register_sidebar(array(
	'name' => 'Footer Widgets',
	'id'   => 'footer-widgets',
	'description'   => 'Widget Area',
	'before_widget' => '<div class="col-12 col-sm-6 col-md-3">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title'   => '</h2>'
	));
}

function kb_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
 }
 add_filter( 'mce_buttons_2', 'kb_mce_buttons_2' );


 // Individuelle Styles - Editor
 function kb_mce_before_init_insert_formats( $init_array ) {
	$style_formats = array(
	  
	array(
		'title' => 'Theme h1',
		'block' => 'h1',
		'classes' => 'theme-font'
	),
	array(
		'title' => 'Theme h2',
		'block' => 'h2',
		'classes' => 'theme-font'
	),
	array(
		'title' => 'Theme Font h3',
		'block' => 'h3',
		'classes' => 'theme-font'
	),
	array(
		'title' => 'Theme Font h4',
		'block' => 'h4',
		'classes' => 'theme-font'
	),
	array(
		'title' => 'Theme Font h5',
		'block' => 'h5',
		'classes' => 'theme-font'
	),
	array(
		'title' => 'Theme Font h6',
		'block' => 'h6',
		'classes' => 'theme-font'
	),
	array(
		'title' => 'Theme Font Text Groß',
		'inline' => 'span',
		'classes' => 'theme-font-big'
	),
	array(
		'title' => 'Theme Font Text Normal',
		'inline' => 'span',
		'classes' => 'theme-font-normal'
	),
	array(
		'title' => 'Theme Font Font Text Klein',
		'inline' => 'span',
		'classes' => 'theme-font-small'
	),
	array(
		'title' => 'Absatz Text Groß',
		'inline' => 'span',
		'classes' => 'font-big'
	),
	array(
		'title' => 'Absatz Text Normal',
		'inline' => 'span',
		'classes' => 'font-normal'
	),
	array(
		'title' => 'Absatz Text Klein',
		'inline' => 'span',
		'classes' => 'font-small'
	),
	array(
		'title' => 'UPPERCASE TEXT',
		'inline' => 'span',
		'classes' => 'text-uppercase'
	),

	);
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array; 
 }
 add_filter( 'tiny_mce_before_init', 'kb_mce_before_init_insert_formats' );

 // Color Palette - Editor
function my_mce4_options($init) {
	$default_colours = '"000000", "Black",
						"993300", "Burnt orange",
						"333300", "Dark olive",
						"003300", "Dark green",
						"003366", "Dark azure",
						"000080", "Navy Blue",
						"333399", "Indigo",
						"333333", "Very dark gray",
						"800000", "Maroon",
						"FF6600", "Orange",
						"808000", "Olive",
						"008000", "Green",
						"008080", "Teal",
						"0000FF", "Blue",
						"666699", "Grayish blue",
						"808080", "Gray",
						"FF0000", "Red",
						"FF9900", "Amber",
						"99CC00", "Yellow green",
						"339966", "Sea green",
						"33CCCC", "Turquoise",
						"3366FF", "Royal blue",
						"800080", "Purple",
						"999999", "Medium gray",
						"FF00FF", "Magenta",
						"FFCC00", "Gold",
						"FFFF00", "Yellow",
						"00FF00", "Lime",
						"00FFFF", "Aqua",
						"00CCFF", "Sky blue",
						"993366", "Red violet",
						"FFFFFF", "White",
						"FF99CC", "Pink",
						"FFCC99", "Peach",
						"FFFF99", "Light yellow",
						"CCFFCC", "Pale green",
						"CCFFFF", "Pale cyan",
						"99CCFF", "Light sky blue",
						"CC99FF", "Plum"';

	$custom_colours =  '"007540", "Theme Color 1",
						"5f3f12", "Theme Color 2"';

	// build colour grid default+custom colors
	$init['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';

	// enable 6th row for custom colours in grid
	$init['textcolor_rows'] = 6;

	return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');