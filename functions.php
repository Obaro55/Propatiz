<?php


/**
 * Sets up theme defaults and registers support for various WordPress features
 */

if(!function_exists('propatiz_setup')):

function propatiz_setup() {
	
	load_theme_textdomain( 'propatiz' );

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
	 * Enable support for custom logo.
	 */
	 
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	

	add_theme_support('post-thumbnails');
		
	
		
	// add_image_size('post_section_thumbnail', 265, 220, true); 
	add_image_size('post_section_thumbnail', 325, 199, true); 
	add_image_size('proptatiz_profile_picture', 250, 250, true); 
	add_image_size('propatiz_slider', 950, 550, true); 
	

	
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
	 * Enable support for Post Formats
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	 
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

}
endif; // propatiz_setup
add_action( 'after_setup_theme', 'propatiz_setup' );






/**
 * Sets the content width in pixels, based on the theme's design and stylesheet
 */

function propatiz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'propatiz_content_width', 840 );
}
add_action( 'after_setup_theme', 'propatiz_content_width', 0 );






/**
 * Registers a widget area.
 */
 
function propatiz_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'propatiz' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'propatiz' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	

}
add_action( 'widgets_init', 'propatiz_widgets_init' );






/**
 * Handles JavaScript detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
 
function propatiz_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'propatiz_javascript_detection', 0 );






/**
 * Enqueues scripts and styles.
 */
 
function propatiz_scripts() {
	
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Load the html5 shiv.
	wp_enqueue_script( 'propatiz-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	/* wp_script_add_data( 'propatiz-html5', 'conditional', 'lt IE 9' );*/

	wp_enqueue_script( 'propatiz-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'propatiz-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

}
add_action( 'wp_enqueue_scripts', 'propatiz_scripts' );






/**
 * Enqueueing styles and scripts
 */

function propatiz_load_styles() {
		
	
	wp_enqueue_style('swiper', get_template_directory_uri() . '/css/swiper.min.css');
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.min.css');
	wp_enqueue_style('select-two', get_template_directory_uri() . '/css/select2.min.css');
	wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('slick', get_template_directory_uri() . '/slick/slick.css');
	wp_enqueue_style('slick-theme', get_template_directory_uri() . '/slick/slick-theme.css');
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css');
}

add_action('wp_enqueue_scripts', 'propatiz_load_styles');






function custom_jquery() {
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery-3.3.1.min.js', array(), NULL, true);
}

add_action('wp_enqueue_scripts', 'custom_jquery');






function propatiz_load_scripts() {
	wp_enqueue_script('swiper', get_template_directory_uri().'/js/swiper.min.js', array('jquery'), NULL, false);
	wp_enqueue_script('select', get_template_directory_uri().'/js/select2.min.js', array('jquery'), NULL, false);
	wp_enqueue_script('propatiz_scripts', get_template_directory_uri().'/js/scripts.js', array('jquery'), NULL, false);
	wp_enqueue_script('contact_form', get_template_directory_uri().'/js/contact-form.js', array('jquery'), NULL, false);
	wp_enqueue_script('slick', get_template_directory_uri().'/slick/slick.min.js', array('jquery'), NULL, true);	
	wp_enqueue_script('modernizr_custom', get_template_directory_uri().'/js/modernizr-custom.js', array(), NULL, false);
	wp_enqueue_script('modernizr_svg', get_template_directory_uri().'/js/modernizr-svg.js', array('modernizr-custom', 'jquery'), NULL, false);
}

add_action('wp_enqueue_scripts', 'propatiz_load_scripts');






/**
 * Enqueueing Google Fonts
 */
 
function propatiz_google_fonts() {
    $fonts = array(
               'Roboto:400,500,700,800',
               'Montserrat:800,900'
            );
        
	$propatiz_fonts = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts)),
            'subset' => 'latin'
            ),'https://fonts.googleapis.com/css');
        
		return $propatiz_fonts;
     }

function propatiz_load_google_font(){
		
    wp_enqueue_style('propatiz-fonts', propatiz_google_fonts());
}
	 
add_action('wp_enqueue_scripts', 'propatiz_load_google_font');

  
  



/**
 * For enqueueing dashicons
 */

function load_dashicons() {
	wp_enqueue_style('dashicons');
}

add_action('wp_enqueue_scripts', 'load_dashicons');






/**
 * Enqueueing more scripts
 */

// IE Fixes
function ie_scripts() {
    // HTML5 elements for IE8
    wp_register_script( 'html5shiv', ( '//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js' ), false, null, true );
    wp_enqueue_script('html5shiv');
    wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
 
    // Make responsive websites and media queries work in IE8
    wp_register_script( 'respond', ( '//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js' ), false, null, true );
    wp_enqueue_script('repond');
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
 
    // Support for :nth-child(n), :last-child, etc in IE8
    wp_register_script( 'selectivizr', ( '//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js' ), false, null, true );
    wp_enqueue_script('selectivizr');
    wp_script_add_data( 'selectivizr', 'conditional', 'lt IE 9' );
 
    // Make form placeholders work in IE
    wp_register_script( 'placeholder', ( '//cdnjs.cloudflare.com/ajax/libs/jquery-placeholder/2.3.1/jquery.placeholder.min.js' ), false, null, true );
    wp_enqueue_script('placeholder');
    wp_script_add_data( 'placeholder', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'ie_scripts' );






/**
 * Custom Post Navigation Function
 */

function propatiz_custom_post_navigation() {

?>

<div class="propatiz_next_prev_navigation">
	<div class="navigation-left">
        <?php previous_post_link('%link', '<span class="navigation_link_indicator">Previous post</span><br /><span class="title-left">%title</span>', false, '4,5'); ?> 
	</div>
    
	<div class="navigation-right">
        <?php next_post_link('%link', '<span class="navigation_link_indicator">Next post</span><br /><span class="title-right">%title</span>', false, '4,5'); ?> 
	</div>
    
	<div class="clear">
	</div>
	
</div>

<?php

}






/**
 * Custom Post Navigation Function
 */

function propatiz_custom_post_navigation_1() {

?>

<div class="propatiz_next_prev_navigation">
	<div class="navigation-left">
        <?php previous_post_link('%link', '<span class="navigation_link_indicator">Previous post</span><br /><span class="title-left">%title</span>', false, '5,6'); ?> 
	</div>
    
	<div class="navigation-right">
        <?php next_post_link('%link', '<span class="navigation_link_indicator">Next post</span><br /><span class="title-right">%title</span>', false, '5,6'); ?> 
	</div>
    
	<div class="clear">
	</div>
	
</div>

<?php

}






/**
 * Custom Post Navigation Function
 */

function propatiz_custom_post_navigation_2() {

?>

<div class="propatiz_next_prev_navigation">
	<div class="navigation-left">
        <?php previous_post_link('%link', '<span class="navigation_link_indicator">Previous post</span><br /><span class="title-left">%title</span>', false, '1'); ?> 
	</div>
    
	<div class="navigation-right">
        <?php next_post_link('%link', '<span class="navigation_link_indicator">Next post</span><br /><span class="title-right">%title</span>', false, '1'); ?> 
	</div>
    
	<div class="clear">
	</div>
	
</div>

<?php

}






/**
 * Script for a custom avatar
 */

function add_custom_gravatar( $avatar_defaults ) {
     $myavatar = get_stylesheet_directory_uri() . '/images/propatiz-custom-gravatar.png';
     $avatar_defaults[$myavatar] = "Custom Gravatar";
     return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'add_custom_gravatar' ); 






/**
 * Script removing pages from search result
 */
 
 function searchFilter($query) {
	if($query->is_search) {
		$query->set('post_type', 'property');
	}
	return $query;
}

add_filter('pre_get_posts', 'searchFilter');






/**
 * Custom search form 
 */

function get_search_form_1( $echo = true ) {
	/**
	 * Fires before the search form is retrieved, at the start of get_search_form().
	 *
	 * @since 2.7.0 as 'get_search_form' action.
	 * @since 3.6.0
	 *
	 * @link https://core.trac.wordpress.org/ticket/19321
	 */
	do_action( 'pre_get_search_form' );

	$format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';

	/**
	 * Filters the HTML format of the search form.
	 *
	 * @since 3.6.0
	 *
	 * @param string $format The type of markup to use in the search form.
	 *                       Accepts 'html5', 'xhtml'.
	 */
	$format = apply_filters( 'search_form_format', $format );

	$search_form_template = locate_template( 'searchform.php' );
	if ( '' != $search_form_template ) {
		ob_start();
		require( $search_form_template );
		$form = ob_get_clean();
	} else {
		if ( 'html5' == $format ) {
			$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
					<input type="hidden" name="cat" id="cat" value="4" />
					<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" />
				</label>
				<input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
			</form>';
		} else {
			$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '">
				<div>
					<label class="screen-reader-text" for="s">' . _x( 'Search for:', 'label' ) . '</label>
					<input type="hidden" name="cat" id="cat" value="4" />
					<input type="text" value="' . get_search_query() . '" name="s" id="s" />
					<input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
				</div>
			</form>';
		}
	}
	
	
	
		/**
	 * Filters the HTML output of the search form.
	 *
	 * @since 2.7.0
	 *
	 * @param string $form The search form HTML output.
	 */
	$result = apply_filters( 'get_search_form', $form );

	if ( null === $result )
		$result = $form;

	if ( $echo )
		echo $result;
	else
		return $result;
}






/**
 * Custom search form 
 */

function get_search_form_2( $echo = true ) {
	/**
	 * Fires before the search form is retrieved, at the start of get_search_form().
	 *
	 * @since 2.7.0 as 'get_search_form' action.
	 * @since 3.6.0
	 *
	 * @link https://core.trac.wordpress.org/ticket/19321
	 */
	do_action( 'pre_get_search_form' );

	$format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';

	/**
	 * Filters the HTML format of the search form.
	 *
	 * @since 3.6.0
	 *
	 * @param string $format The type of markup to use in the search form.
	 *                       Accepts 'html5', 'xhtml'.
	 */
	$format = apply_filters( 'search_form_format', $format );

	$search_form_template = locate_template( 'searchform.php' );
	if ( '' != $search_form_template ) {
		ob_start();
		require( $search_form_template );
		$form = ob_get_clean();
	} else {
		if ( 'html5' == $format ) {
			$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
					<input type="hidden" name="cat" id="cat" value="4" />
					<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" />
				</label>
				<input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
			</form>';
		} else {
			$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '">
				<div>
					<label class="screen-reader-text" for="s">' . _x( 'Search for:', 'label' ) . '</label>
					<input type="hidden" name="cat" id="cat" value="4" />
					<input type="text" value="' . get_search_query() . '" name="s" id="s" />
					<input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
				</div>
			</form>';
		}
	}
	
	
	
		/**
	 * Filters the HTML output of the search form.
	 *
	 * @since 2.7.0
	 *
	 * @param string $form The search form HTML output.
	 */
	$result = apply_filters( 'get_search_form', $form );

	if ( null === $result )
		$result = $form;

	if ( $echo )
		echo $result;
	else
		return $result;
}






/**
 * Google reCAPTCHA v3
 */
 
 
function google_recaptcha_v3(){ ?>
    
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_SITE_KEY; ?>"></script>
<script>
grecaptcha.ready(function () {
grecaptcha.execute('<?php echo RECAPTCHA_SITE_KEY; ?>', {action: 'homepage'}).then(function (token) {
document.getElementById('g-recaptcha-response').value = token;
});
});
</script>
	
	<?php
}
add_action ( 'wp_footer', 'google_recaptcha_v3' );






/**
 * Creating the "Property" custom post type
 */

function propatiz_property_custom_post_type() {
	
	$labels = array(
		'name' => esc_html__('Properties'),
		'singular_name' => esc_html__('Property'),
		'menu_name' => esc_html__('Properties'),
		'parent_item_colon' => esc_html__('Parent Property'),
		'all_items' => esc_html__('All Properties'),
		'view_item' => esc_html__('View Property'),
		'add_new_item' => esc_html__('Add New Property'),
		'add_new' => esc_html__('Add New'),
		'edit_item' => esc_html__('Edit Property'),
		'update_item' => esc_html__('Update Property'),
		'search_items' => esc_html__('Search Property'),
		'not_found' => esc_html__('Not Found'),
		'not_found_in_trash' => esc_html__('Not found in Trash')
	);
	
	$args = array(
		'label' => esc_html__('Properties'),
		'description' => esc_html__('Propatiz "Property" custom post type'),
		'labels' => $labels,
		'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
		'public' => true,
		'hierarchical' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'has_archive' => 'property',
		'can_export' => true,
		'exclude_from_search' => false,
	        'yarpp_support' => true,
		'taxonomies' => array('classification', 'type'),
		'publicly_queryable' => true,
		'rewrite' => array('slug' => 'property', 'with_front' => true),
		'query_var' => true,
		'menu_icon' => 'dashicons-admin-multisite',	
		'map_meta_cap' => true,
		'capability_type' => 'post'
);
	register_post_type('property', $args);
}

add_action('init', 'propatiz_property_custom_post_type', 0);






/**
 * Register custom taxonomy
 */

 function propatiz_register_custom_taxonomies() {
	
		$labels = array(
		'name' => esc_html__('Classification', 'propatiz'),
		'label' => esc_html__('Classification', 'propatiz'),
		'add_new_item' => esc_html__('Add New Classification', 'propatiz')
		);


		$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'label' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'classification', 'with_front' => true),
		'show_admin_column' => true,
		);	
	
	register_taxonomy('classification', array('property'), $args);
	

	
	
	$labels = array(
		'name' => esc_html__('Type', 'propatiz'),
		'label' => esc_html__('Type', 'propatiz'),
		'add_new_item' => esc_html__('Add New Property Type', 'propatiz')
		);
			


	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'label' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'type', 'with_front' => true),
		'show_admin_column' => true,
	);
	
	register_taxonomy('type', array('property'), $args);
	
} 

add_action('init', 'propatiz_register_custom_taxonomies');






/**
 * Build search form markup
 */
function propatiz_search_form(){
	  	     
	$output = '<div class="propatiz-homepage-search"><h1>Find properties for sale, rent, or lease.</h2>		
	<form class="propatiz-search-form" action="' . esc_url( home_url() ) . '" method="GET" role="search">';	
	$output .='<div class="search-container"><label for="keywords">Keywords</label><input type="text" name="s" placeholder="Search by category, address, city, or state" value="' . get_search_query() . '" /><input type="submit" value="" id="search-button" /></div>';
    $output .= '</form></div>';

    return $output;
   
}






/**
 * For loading the custom login page stylesheet 
 */

function propatiz_custom_login()
{
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-style.css" />';
}
add_action('login_head', 'propatiz_custom_login');






/**
 * For re-directing the logo
 */

function custom_login_logo_url() {
return get_bloginfo( 'url' );
}
add_filter('login_headerurl', 'custom_login_logo_url');






/**
 * For creating user roles
 */
 
add_role('propatiz_approved_user', 'Propatiz Approved User', 'read');
add_role('propatiz_pending_user', 'Propatiz Pending User', 'read');






/**
 * For removing the top of the admin dashboard for logged-in users
 */

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if(!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}






/**
 * For generating random numbers
 */

function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-.='
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}






/**
 * Function for formating Paystack payment amount
 */

function paystack_price_convert($price) {
$price = intval(preg_replace('/[^\d.]/', "", $price));
$price = $price * 100;

return $price;

}






/**
 * Function formating prices
 */

function price_convert($price) {
$price = intval(preg_replace('/[^\d.]/', "", $price));
$price = number_format($price, 0, ".", ",");
$price = "₦" . $price . "";

return $price;

}






/**
 * Function for getting post author
 */

function propatiz_get_author($post_id){
        $post = get_post($post_id);
        return $post->post_author;
}






/**
 * Function for ending subscription 
 */

function unlimited_listings_expiration() {

$args = array(
	'role' => 'propatiz_approved_user'
);


$propatiz_user_query = new WP_User_Query($args);

$propatiz_users = $propatiz_user_query->get_results();

if(!empty($propatiz_users)) {
	
	foreach($propatiz_users as $propatiz_user) {
	
		$propatiz_user->ID;
		
		$propatiz_plan = get_user_meta($propatiz_user->ID, 'propatiz_plan', true);
		
		
		if($propatiz_plan == 'unlimited') {
			
		$propatiz_user_id = $propatiz_user->ID;
		
		$propatiz_user_data = get_userdata($propatiz_user_id);
		$propatiz_user_display_name = $propatiz_user_data->display_name;
		$propatiz_user_email = $propatiz_user_data->user_email;
		
		$now = time();
		
		$unlimited_listings_start_date = get_user_meta($propatiz_user_id, 'unlimited_listings_start_date', true);
		$thirtyDays = $unlimited_listings_start_date + (30*60*60*24);
		
		
		$subject = "30-day Listing Subscription has Lapsed";

		$message .= "Hello " . $propatiz_user_display_name . ",\r\n \r\n";
		$messgae .= "Your 30-day unlimited listings subscription has lapsed.";
		$message .= "You can always renew. \r\n \r\n";

		$message .= "Thanks for using Propatiz. \r\n \r\n";
		$message .= "Subscription Management Team, \r\n";
		$message .= "Propatiz";

		$headers .= "From: Propatiz <subscription@propatiz.com>\r\n";
		$headers .= "Reply-To: Propatiz <subscription@propatiz.com>\r\n";
		$headers .= "Return-Path: Propatiz <subscription@propatiz.com>\r\n";
		$headers .= "Organization: Propatiz \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		$headers .= "X-Priority: 1\r\n";
		$headers .= "X-Sender: Propatiz <subscription@propatiz.com>\r\n";
		$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
		
		
		$propatiz_plan = get_user_meta($propatiz_user->ID, 'propatiz_plan', true);
		

		if($now > $thirtyDays && $propatiz_plan == 'unlimited') {

		update_user_meta($propatiz_user_id, 'propatiz_plan', 'regular');
		update_user_meta($propatiz_user_id, 'unlimited_listings_start_date', 0);

	
		mail($propatiz_user_email, $subject, $message, $headers, '-fmail@propatiz.com');
	
		}
		
				
		}
	
    }
	
}

}






/**
 * Unlimited listings cron event
 */

if (!wp_next_scheduled('unlimited_listings_expiration_hook')) {
        wp_schedule_event(time(), 'daily', 'unlimited_listings_expiration_hook');
}

add_action('unlimited_listings_expiration_hook', 'unlimited_listings_expiration');






/**
 * Function for ending subscription 
 */

function promoted_listing_expiration() {

$args = array(
	'post_type' => 'property',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'meta_query' => array(
						array(
							'key' => 'property_listing_status',
							'value' => 'promoted',
							'compare' => '='
							)
						)
);


$promoted_listings = new WP_query($args);


if ($promoted_listings->have_posts()){    

        while ($promoted_listings->have_posts()) {

		global $post;

		$promoted_listings->the_post();

		$promoted_listings_ids = array();
		
		$promoted_listings_ids[] = $post->ID;
		
		foreach($promoted_listings_ids as $promoted_listing_id) {
		
		$promoted_listing_start_date = get_post_meta($promoted_listing_id, 'promoted_listing_start_date', true); /* update_post_meta($promoted_listing_id, 'promoted_listing_start_date', time()) */
		
		$now = time();
		$thirtyDays = $promoted_listing_start_date + (30*60*60*24);

		$propatiz_user_id = propatiz_get_author($promoted_listing_id);
		$listing_title = get_the_title($promoted_listing_id);
		
		$propatiz_user_data = get_userdata($propatiz_user_id);
		$propatiz_user_display_name = $propatiz_user_data->display_name;
		$propatiz_user_email = $propatiz_user_data->user_email;
	
	$subject = "30-day Promoted Listing has Lapsed";


	$message = "Hello " . $propatiz_user_display_name . ",\r\n \r\n";
	$message .= "Your 30-day promoted listing " . "'" . $listing_title . "'" . " has lapsed.";
	$message .= "You can choose to promote it again or promote another listing. \r\n \r\n";

	$message .= "Thanks for using Propatiz. \r\n \r\n";
	$message .= "Subscription Management Team, \r\n";
	$message .= "Propatiz";

	$headers = "From: Propatiz <subscription@propatiz.com>\r\n";
	$headers .= "Reply-To: Propatiz <subscription@propatiz.com>\r\n";
	$headers .= "Return-Path: Propatiz <subscription@propatiz.com>\r\n";
	$headers .= "Organization: Propatiz \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
	$headers .= "X-Priority: 1\r\n";
	$headers .= "X-Sender: Propatiz <subscription@propatiz.com>\r\n";
	$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
		
	
	$property_listing_status = get_post_meta($promoted_listing_id, 'property_listing_status', true);
	

    if($now > $thirtyDays && $property_listing_status == 'promoted') {

	update_post_meta($promoted_listing_id, 'property_listing_status', 'regular');
	update_post_meta($promoted_listing_id, 'promoted_listing_start_date', 0);	
	
	mail($propatiz_user_email, $subject, $message, $headers, '-fmail@propatiz.com');
	
		
		}

	}

}

}

wp_reset_query();

}






/**
 * Promoted listings cron event
 */

if (!wp_next_scheduled('promoted_listing_expiration_hook')) {
        wp_schedule_event(time(), 'daily', 'promoted_listing_expiration_hook');
}

add_action('promoted_listing_expiration_hook', 'promoted_listing_expiration');






/**
 * Function for notifying users when their role changes
 */

function user_role_update( $user_id, $new_role ) {
    if ($new_role == 'propatiz_approved_user') { 
        $user_data = get_userdata($user_id);
        $to = $user_data->user_email;
        $subject = "Registration verified on Propatiz";
       
		$message = "Hello " . $user_data->display_name. ",\r\n \r\n";
		$message .= "Your registration details have been verified. You can now submit properties on Propatiz.com. \r\n \r\n"; 
		$message .= "To sign in, visit: https://www.propatiz.com/login/  \r\n \r\n"; 
		
		$message .= "Verification Team, \r\n";
		$message .= "Propatiz";
		
		$headers = "From: Propatiz <verification@propatiz.com>\r\n";
		$headers .= "Reply-To: Propatiz <verification@propatiz.com>\r\n";
		$headers .= "Return-Path: Propatiz <verification@propatiz.com>\r\n";
		$headers .= "Organization: Propatiz \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		$headers .= "X-Priority: 1\r\n";
		$headers .= "X-Sender: Propatiz <verification@propatiz.com>\r\n";
		$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
		
		mail($to, $subject, $message, $headers, '-fmail@propatiz.com');
		
    }
}

add_action( 'set_user_role', 'user_role_update', 10, 2);






/**
 * Header JavaScript Variables 
 */
  
function javascript_variables(){ ?>
    <script type="text/javascript">
        var ajax_url = '<?php echo admin_url( "admin-ajax.php" ); ?>';
        var ajax_nonce = '<?php echo wp_create_nonce( "propatiz_form_nonce" ); ?>';
    </script><?php
}
add_action ('wp_head', 'javascript_variables');






/**
 * Function for sending email using the contact form
 */

add_action('wp_ajax_contact_agent', 'contact_agent'); // This is for authenticated users
add_action('wp_ajax_nopriv_contact_agent', 'contact_agent'); // This is for unauthenticated users.


 
 
function contact_agent(){

$nonce_check = check_ajax_referer('propatiz_form_nonce', 'security');

if(!nonce_check) {
	
	wp_die();
	
}



$postID = intval($_POST['listingID']);

$agentID = propatiz_get_author($postID);
$listing_title = get_the_title($postID);
$agent_data = get_userdata($agentID);
$agent_email = $agent_data->user_email;

$subject = "Someone sent you a message from Propatiz";

$name = sanitize_text_field($_POST['name']);
$phone_number = sanitize_text_field($_POST['phone_number']);
$email_address = sanitize_email($_POST['email_address']); 
$message_text = sanitize_textarea_field($_POST['message_text']);


$message = "Sender name: $name \r\n";
$message .= "Sender phone number: $phone_number \r\n";
$message .= "Sender email: $email_address \r\n \r\n";

$message .= "Message: \r\n \r\n$message_text";


$headers = "From: Propatiz <email@propatiz.com>\r\n";
$headers .= "Reply-To: $email_address\r\n";
$headers .= "Return-Path: Propatiz <email@propatiz.com>\r\n";
$headers .= "Organization: Propatiz \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "X-Priority: 1\r\n";
$headers .= "X-Sender: Propatiz <email@propatiz.com>\r\n";
$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

mail($agent_email, $subject, $message, $headers, '-fmail@propatiz.com');

wp_die();

}
 





/**
 * Function for reporting a listing
 */

add_action('wp_ajax_report_listing_form', 'report_listing_form'); // This is for authenticated users
add_action('wp_ajax_nopriv_report_listing_form', 'report_listing_form'); // This is for unauthenticated users.
 
 
function report_listing_form(){
	
$nonce_check = check_ajax_referer( 'propatiz_form_nonce', 'security' );

if(!nonce_check) {
	
	wp_die();
	
}

$report_listing = "report_listing@propatiz.com";

$sender_name = sanitize_text_field($_POST['name']);
$email_address = sanitize_email($_POST['email_address']); 
$phone_number = sanitize_text_field($_POST['phone_number']);

$postID = intval($_POST['listingID']);

$agentID = propatiz_get_author($postID);
$listing_title = get_the_title($postID);
$agent_data = get_userdata($agentID);
$agent_username = $agent_data->login_name;
$agent_name = $agent_data->display_name;
$agent_email = $agent_data->user_email;
$agent_phone = get_user_meta($agentID, 'phone_number', true);

$subject = "Reporting A Listing";

$message_text = sanitize_textarea_field($_POST['report_message_text']);


$message = "Sender name: $sender_name \r\n";
$message .= "Sender phone number: $phone_number \r\n";
$message .= "Sender email: $email_address \r\n \r\n";

$message .= "- - - - - - - - - - - - - - - - - - - - - - - - - - - \r\n";
$message .= "Agent name: $agent_name \r\n";
$message .= "Agent username: $agent_username \r\n";
$message .= "Agent email: $agent_email \r\n";
$message .= "Agent phone number: $agent_phone \r\n";
$message .= "Listing ID: $postID \r\n";
$message .= "Listing title: $listing_title \r\n";
$message .= "- - - - - - - - - - - - - - - - - - - - - - - - - - - \r\n \r\n";


$message .= "Message: \r\n \r\n$message_text";


$headers = "From: Propatiz <report_listing@propatiz.com>\r\n";
$headers .= "Reply-To: $email_address\r\n";
$headers .= "Return-Path: Propatiz <report_listing@propatiz.com>\r\n";
$headers .= "Organization: Propatiz \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "X-Priority: 1\r\n";
$headers .= "X-Sender: Propatiz <report_listing@propatiz.com>\r\n";
$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

mail($report_listing, $subject, $message, $headers, '-fmail@propatiz.com');

wp_die();

}






/**
 * Function for making uploaded pictures bigger, when these pictures don't match the set default dimensions in size
 */

function propatiz_thumbnail_resize( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){

    if(!$crop) return null; // Let the wordpress default function handle this

    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);

    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );

    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}

add_filter( 'image_resize_dimensions', 'propatiz_thumbnail_resize', 10, 6 );







/**
 * Function for capitalizing the word after an hyphen
 */

function uc_hyphenated_words($text) {
	
	return str_replace("- ", "-", ucwords(str_replace("-", "- ", $text)));
	
}






/**
 * Function for capitalizing the word after an apostrophe
 */

function uc_words_after_apostrophe($text) {
	
	return str_replace("' ", "'", ucwords(str_replace("'", "' ", $text)));
	
}






/**
 * For filtering the search result
 */


function propatiz_filter_search($query) {
	
  if (! is_admin() && $query->is_main_query() && $query->is_search() ) {
    $query->set('post_type', 'property');
    $query->set('meta_query', array(
       'relation' => 'OR',
        array( 
                'key' => 'property_listing_status',
				'value' => 'regular'
            ),
          array( 
                'key' => 'property_listing_status',
				'value' => 'promoted'
            )
        ));
    $query->set('orderby', array(
        'meta_value'=>'ASC',
        'date' =>'DESC',
    ));
    $query->set('posts_per_page', 16);
  }

}


add_action('pre_get_posts', 'propatiz_filter_search'); 






/**
 * For filtering the archive pages
 */

function propatiz_archive_page_filter( $query ) {

if(!is_admin() && $query->is_main_query() && $query->is_tax('classification')) {

		$query->set('meta_query', array(
       'relation' => 'OR',
        array( 
                'key' => 'property_listing_status',
				'value' => 'regular'
            ),
          array( 
                'key' => 'property_listing_status',
				'value' => 'promoted'
            )
        ));
    $query->set('orderby', array(
        'meta_value'=>'ASC',
        'date' =>'DESC',
    ));
    $query->set('posts_per_page', 16);
				
	}

}

add_action('pre_get_posts', 'propatiz_archive_page_filter');






/**
 * Function for adding "http" to URLs
 */
	
function addhttp($url) {
if(!preg_match("~^(?:f|ht)tps?://~i", $url)) {
$url = "http://" . $url;
}

return $url;

}






/**
 * For re-directing logged-in users to the "My Listings" page
 */
 
function custom_login_redirect($redirect_to, $request, $user) {
	return (is_array($user->roles) && in_array('administrator', $user->roles)) ? admin_url():site_url('/my-listings/', 'https');
}

add_filter("login_redirect", "custom_login_redirect", 10, 3);






/**
 * Function for prevent login fail redirect to wp-login
 */

add_action('init', 'prevent_wp_login');

function prevent_wp_login() {
	
if(isset($_POST['log']) && isset($_POST['pwd'])) {
if($_POST['log']=='' && $_POST['pwd']=='') {
	
   $redirect_url = home_url('login');
   $redirect_url = add_query_arg('username', 'blank', $redirect_url);
   $redirect_url = add_query_arg('password', 'blank', $redirect_url);
   wp_redirect($redirect_url);	
   exit();
}

elseif($_POST['log']=='') {
   $redirect_url = home_url('login');
   $redirect_url = add_query_arg('username', 'blank', $redirect_url);
   wp_redirect($redirect_url);
   exit();
}

else if($_POST['pwd']=='') {
   $redirect_url = home_url('login');
   $redirect_url = add_query_arg('password', 'blank', $redirect_url);
   wp_redirect($redirect_url);
   exit();
}

}

}



 


/**
 * Function for outputting login (where both the username and password are used) error to the login page
 */
 
function propatiz_front_end_login_fail($username) {
	
	$redirect_url = home_url('login');
    if (!empty($redirect_url) && !strstr($redirect_url,'wp-login') && !strstr($redirect_url,'wp-admin')) {
	$redirect_url = add_query_arg('login-attempt', 'failed', $redirect_url);
	wp_redirect($redirect_url);	  
    exit();
	
   }
}


add_action( 'wp_login_failed', 'propatiz_front_end_login_fail' ); 






/**
 * Function for redirecting after logging out
 */
 

function propatiz_redirect_external_after_logout(){
	$redirect_url = home_url('login');
	$redirect_url = add_query_arg('loggedout', 'true', $redirect_url);
	wp_redirect($redirect_url);
	exit();
}


add_action('wp_logout','propatiz_redirect_external_after_logout');






/**
 * For re-directing to new password request form page (bypassing the default wp-login.php page)
 */

function redirect_to_custom_lostpassword() {
    if ('GET' == $_SERVER['REQUEST_METHOD']) {
        if (is_user_logged_in()) {
            wp_redirect(home_url('/'));
            exit();
        }
 
        wp_redirect(home_url('/user-password-lost/') );
        exit();
    }
}


add_action('login_form_lostpassword', 'redirect_to_custom_lostpassword');






/**
 * Function for outputting en error message at the new password request form if a valid email isn't provided or redirecting to the logged in page if a valid email is provided
 */
 
function do_password_lost() {
    if ('POST' == $_SERVER['REQUEST_METHOD']) {
        $errors = retrieve_password();
        if (is_wp_error($errors)) {
			
            // Errors found
            $redirect_url = home_url('user-password-lost');
            $redirect_url = add_query_arg('errors', join(',', $errors->get_error_codes()), $redirect_url);
			
        } else {
			
            // Email sent
            $redirect_url = home_url('login');
            $redirect_url = add_query_arg('checkemail', 'confirm', $redirect_url);
        }
 
        wp_redirect($redirect_url);
        exit();
    }
}


add_action('login_form_lostpassword', 'do_password_lost');






/**
 * Function for reformating password reset email text
 */

function replace_retrieve_password_message($message, $key, $user_login, $user_data) {
    
    $message  = "Hello, \r\n\r\n";
    $message .= sprintf("You asked us to reset your password for your account using the email address %s.", $user_login) . "\r\n\r\n";
    $message .= "If this was a mistake, or you didn't ask for a password reset, just ignore this email and nothing will happen. \r\n\r\n";
    $message .= "To reset your password, visit the following link: \r\n\r\n";
    $message .= site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . "\r\n\r\n";
    $message .= "Regard, \r\n \r\n";
	$message .= "Email Management Team, \r\n";
	$message .= "Propatiz";
 
    return $message;
}


add_filter('retrieve_password_message', 'replace_retrieve_password_message', 10, 4 );






/**
 * Function for re-directing to new password change form page 
 */
 
function redirect_to_custom_password_reset() {
    if ('GET' == $_SERVER['REQUEST_METHOD']) {
		
        // Verify key / login combo
        $user = check_password_reset_key($_REQUEST['key'], $_REQUEST['login']);
		
        if (!$user || is_wp_error($user) ) {
            if ($user && $user->get_error_code() === 'expired_key') {
                wp_redirect(home_url('login?login=expiredkey') );
            } else {
                wp_redirect(home_url('login?login=invalidkey') );
            }
            exit();
        }
 
        $redirect_url = home_url('user-password-reset-form');
        $redirect_url = add_query_arg('login', esc_attr($_REQUEST['login']), $redirect_url);
        $redirect_url = add_query_arg('key', esc_attr($_REQUEST['key']), $redirect_url);
 
        wp_redirect($redirect_url);
        exit();
    }
}


add_action('login_form_rp', 'redirect_to_custom_password_reset');
add_action('login_form_resetpass', 'redirect_to_custom_password_reset');






/**
 * Function for re-setting the password and outputting the appropriate messages
 */

function do_password_reset() {
	
    if ('POST' == $_SERVER['REQUEST_METHOD']) {
        $rp_key = $_REQUEST['rp_key'];
        $rp_login = $_REQUEST['rp_login'];
 
        $user = check_password_reset_key( $rp_key, $rp_login );
 
        if (!$user || is_wp_error($user)) {
            if ($user && $user->get_error_code() === 'expired_key') {
                wp_redirect(home_url('login?login=expiredkey'));
            } else {
                wp_redirect(home_url('login?login=invalidkey'));
            }
            exit();
        }
 
        if (isset($_POST['pass1'])) {
            if ($_POST['pass1'] != $_POST['pass2']) {
				
                // Passwords don't match
                $redirect_url = home_url('user-password-reset-form');
 
                $redirect_url = add_query_arg('key', $rp_key, $redirect_url );
                $redirect_url = add_query_arg('login', $rp_login, $redirect_url );
                $redirect_url = add_query_arg('error', 'password_reset_mismatch', $redirect_url);
 
                wp_redirect( $redirect_url );
                exit();
            }
 
            if (empty($_POST['pass1'])) {
				
                // Passwords is empty
                $redirect_url = home_url( 'user-password-reset-form' );
 
                $redirect_url = add_query_arg('key', $rp_key, $redirect_url );
                $redirect_url = add_query_arg('login', $rp_login, $redirect_url );
                $redirect_url = add_query_arg('error', 'password_reset_empty', $redirect_url );
 
                wp_redirect($redirect_url);
                exit();
            }
 
            // Parameter checks OK, reset password
            reset_password($user, $_POST['pass1']);
            wp_redirect(home_url('login?password=changed'));
        } else {
            echo "<p class='invalid-request'>Invalid request</p>";
        }
 
        exit();
    }
}


add_action('login_form_rp', 'do_password_reset');
add_action('login_form_resetpass', 'do_password_reset');






/**
 * Function for blocking wp-login and wp-admin
 *//*

add_action('init','custom_login');

function custom_login(){
 global $pagenow;
 if( 'wp-login.php' == $pagenow && $_GET['action']!="logout" && $_GET['action']!="lostpassword" && $_GET['action']!="rp") {
  wp_redirect( home_url( '/' ) );
 }
}






/**
 * For populating the img tag alt and title atttribute with the post title
 */

function propatiz_add_img_title_and_tag($attr) {

global $post;

$listing_title = get_the_title($post->ID);
$listing_title = trim($listing_title);

$attr['title'] = $listing_title;
$attr['alt'] = $listing_title;

if(get_post_type() === 'property') {

return $attr;

}

}

add_filter('wp_get_attachment_image_attributes', 'propatiz_add_img_title_and_tag', 10, 2);






/**
 * For setting the featured and ensuring that the first picture becomes the featured image
 */

function propatiz_set_featured_image() {
	
    global $post;
              
	$featured_image_exists = has_post_thumbnail($post->ID);
    
	if (!$featured_image_exists)  {
	
	$attachments = get_children(array(
            'post_parent' => $post->ID, 
            'post_status' => 'inherit', 
            'post_type' => 'attachment', 
            'post_mime_type' => 'image', 
            'order' => 'ASC', 
            'orderby' => 'ID'
    ));
    
	if($attachments) {
            foreach ($attachments as $attachment) {
                set_post_thumbnail($post->ID, $attachment->ID);
                break;
            }

    	}
			  
    }
    
}


add_action('the_post', 'propatiz_set_featured_image');






/**
 * For preventing WordPress from sending a notification to the user after the user changes their password
 */

add_filter( 'send_password_change_email', '__return_false' );






/**
 * For removing the <p> tage from the post excerpt
 */
 
remove_filter('the_excerpt', 'wpautop');






/**
 * Filter the excerpt length
 */
 
function propatiz_excerpt_length($length) {
	return 30;
}

add_filter('excerpt_length', 'propatiz_excerpt_length', 999);






/**
 * For removing taxonomy name from archive page title
 */


add_filter( 'get_the_archive_title', function ($title) {    
        if ( is_category() ) {    
                $title = single_cat_title( '', false );    
            } elseif ( is_tag() ) {    
                $title = single_tag_title( '', false );    
            } elseif ( is_author() ) {    
                $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
            } elseif ( is_tax() ) { //for custom post types
                $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
            } elseif (is_post_type_archive()) {
                $title = post_type_archive_title( '', false );
            }
        return $title;    
    });






