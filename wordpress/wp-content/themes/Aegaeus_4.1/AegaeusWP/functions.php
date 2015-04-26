<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */

// Define Directories
define( 'HBTHEMES_INCLUDES' , get_template_directory() . '/includes' );
define ( 'HBTHEMES_FUNCTIONS' , get_template_directory() . '/functions' );
define( 'HBTHEMES_ADMIN' , get_template_directory() . '/admin' );
define  ( 'HBTHEMES_ROOT' , get_template_directory() );

// Define Names
define('SHORTNAME', 'hb');
define('THEMENAME', 'Aegaeus');
$shortname = SHORTNAME;
$themename = THEMENAME;
$themepath = get_template_directory_uri();

//Theme Setup
function hb_theme_setup() {
	global $shortname;
	global $themename;
	global $themepath;
	global $data;

	
	require_once ( HBTHEMES_INCLUDES . '/theme-styles.php' );
  	require_once ( HBTHEMES_INCLUDES . '/theme-scripts.php' ); 
  	
}
add_action( 'after_setup_theme', 'hb_theme_setup');

// Include Theme Options
require_once ( HBTHEMES_ADMIN . '/index.php' );

// Include Functions
include_once ( HBTHEMES_FUNCTIONS . '/meta-tags.php' );
include_once ( HBTHEMES_FUNCTIONS . '/favicon.php' );
include_once ( HBTHEMES_FUNCTIONS . '/header-dropdown.php' );
include_once ( HBTHEMES_FUNCTIONS . '/header-logo-socials.php' );
include_once ( HBTHEMES_FUNCTIONS . '/main-navigation.php' );
include_once ( HBTHEMES_FUNCTIONS . '/header-separator.php' );
include_once ( HBTHEMES_FUNCTIONS . '/page-sidebar-position.php' );
include_once ( HBTHEMES_FUNCTIONS . '/page-title.php' );
include_once ( HBTHEMES_FUNCTIONS . '/page-featured-image-slider.php' );
include_once ( HBTHEMES_FUNCTIONS . '/breadcrumbs.php' );
include_once ( HBTHEMES_FUNCTIONS . '/convert-string-to-array.php' );
include_once ( HBTHEMES_FUNCTIONS . '/portfolio-filter.php' );
include_once ( HBTHEMES_FUNCTIONS . '/portfolio-items.php' );
include_once ( HBTHEMES_FUNCTIONS . '/flexslider.php' );
include_once ( HBTHEMES_FUNCTIONS . '/portfolio-details.php' );
include_once ( HBTHEMES_FUNCTIONS . '/portfolio-related-posts.php' );
include_once ( HBTHEMES_FUNCTIONS . '/blog-grid.php' );
include_once ( HBTHEMES_FUNCTIONS . '/blog-sidebar.php' );
include_once ( HBTHEMES_FUNCTIONS . '/backstretch.php' );


if ( defined( 'WP_ADMIN' ) && WP_ADMIN ) {
	require_once('includes/theme-metabox-class.php');
	require_once('includes/theme-metabox-usage.php');
	require_once('mce/shortcode-popup.php');
}

require_once ( HBTHEMES_INCLUDES . '/theme-widget-areas.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-shortcodes.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-post-types.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-taxonomies.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-likes.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-thumbnails-resize.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-pagination.php' );
require_once ( HBTHEMES_INCLUDES . '/theme-plugin-activation.php' ); 

include ( HBTHEMES_INCLUDES . '/widgets/widget-video.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-contact.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-infobox.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-flickr.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-pinterest.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-instagram.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-dribbble.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-testimonial.php' ); 	
include ( HBTHEMES_INCLUDES . '/widgets/widget-portfolio.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-recent-posts.php' ); 
include ( HBTHEMES_INCLUDES . '/widgets/widget-newsletter.php' ); 
/*	
	
	include ( HBTHEMES_INCLUDES . '/widgets/widget-newsletter.php' ); 
	include ( HBTHEMES_INCLUDES . '/widgets/widget-comments.php' ); */
	
// Register Menus
function hb_register_menu() {

  register_nav_menu('main-menu', __('Main Menu', 'hbthemes'));
  register_nav_menu('footer-menu', __('Footer Menu', 'hbthemes'));

}
add_action( 'init', 'hb_register_menu' );

// Add Supports
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats' , array( 'aside', 'link' , 'video' , 'gallery') );
add_theme_support( 'automatic-feed-links' );	
add_filter('widget_text', 'do_shortcode');

load_theme_textdomain( 'hbthemes', get_template_directory().'/languages' );

if ( ! isset( $content_width ) ){ $content_width = 930; }

if ( has_filter('icl_ls_languages'))
	add_filter( 'icl_ls_languages', 'fixing_bug' );

function fixing_bug( $languages ) {
	wp_reset_query();
	return $languages;
}


// Contact 
add_action('wp_ajax_mail_action', 'sending_mail');
add_action('wp_ajax_nopriv_mail_action', 'sending_mail');

function sending_mail(){
		
		$theme = get_bloginfo('name');
		$subject = $_POST['subject'];
		$email = $_POST['email'];
		$comments = $_POST['comments'];
		$name = $_POST['name'];

        $to = get_bloginfo('admin_email');
        $message = "Name: $name \n\nEmail: $email \n\nComments: $comments \n\nThis email has been sent from $theme"; 
		$headers = 'From: '.$name. "\r\n" . 'Reply-To: ' . $email;

        mail($to, $subject, $message, $headers);
}

// Get Current Template Function
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}
add_filter( 'template_include', 'var_template_include', 1000 );

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo $GLOBALS['current_theme_template'];
    else
        return $GLOBALS['current_theme_template'];
}

/* CUSTOM ADMIN STYLES
================================================== */
function my_admin_theme_style() {
	wp_enqueue_style('my-admin-theme', get_template_directory_uri() . '/admin/assets/css/custom-admin.css');
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');

function admin_scripts()
{
   wp_enqueue_script('media-upload');
   wp_enqueue_script('thickbox');
}

function admin_styles()
{
   wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'admin_scripts');
add_action('admin_print_styles', 'admin_styles');

function get_src_from_embedded_link( $embedded_link ) {
	$src_value = substr( $embedded_link , strpos( $embedded_link , 'src="') + 5 , strlen( $embedded_link ) );
	$src_value = substr( $src_value , 0 , strpos ( $src_value , '"' )  ) ;
	if ($src_value)
		return $src_value;
	return $embedded_link;
}

function get_action_for_form ( $embedded_link ) {
	$action_value = substr( $embedded_link , strpos( $embedded_link , 'action="') + 8 , strlen( $embedded_link ) );
	$action_value = substr( $action_value , 0 , strpos ( $action_value , '"' )  ) ;
	if ( $action_value )
		return $action_value;
	return $embedded_link; 
}

// Fixes Shortcodes empty paragraphs
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content) {  
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']',
		']<br />' => ']',
	);
	$content = strtr($content, $array);
	return $content;
}

// Set RevSlider as theme
if ( function_exists('set_revslider_as_theme') ){
	set_revslider_as_theme();
}

// Tag Cloud Filter
function tag_cloud_filter($args = array()) {
 $args['smallest'] = 12;
 $args['largest'] = 12;
 $args['unit'] = 'px';
 return $args;
}
add_filter('widget_tag_cloud_args', 'tag_cloud_filter', 90);


// Enable more post editor buttons
add_filter("mce_buttons_3", "enable_more_buttons");
function enable_more_buttons($buttons) {
  $buttons[] = 'fontselect';
  $buttons[] = 'fontsizeselect';
  return $buttons;
}

function my_formatTinyMCE( $init ) {

	$init['theme_advanced_buttons3_add'] = 'styleselect';
	$init['theme_advanced_styles'] = 'Default Ordered List=ordered-list;Default Unordered List=unordered-list;Plain List=prestyled;Regular Square List=square-list;Regular Numbered List=number-list;Plus List=prestyled list-plus;Star List=prestyled list-star;Minus List=prestyled list-minus;Cross List=prestyled list-cross;Check List=prestyled list-check';
	return $init;
}
add_filter( 'tiny_mce_before_init', 'my_formatTinyMCE' );

function hb_admin_scripts()
{
   wp_enqueue_script('media-upload');
   wp_enqueue_script('thickbox');
}

function hb_admin_styles()
{
   wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'hb_admin_scripts');
add_action('admin_print_styles', 'hb_admin_styles');

// Change Media Upload Button Text
add_action( 'admin_head', 'admin_head_script' ); 
function admin_head_script() { ?>
<script> jQuery(document).ready(function($){ $('input[value="Insert into Post"]').val('Use this Image'); });
</script>
<?php }

function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Plugin activation
function hbthemes_register_required_plugins() {
	$plugins = array(
		array(
			'name' => 'Revolution Slider',
			'slug' => 'revslider',
			'source' => 'http://hb-themes.com/repository/plugins/revslider.zip',
			'required' => false,
			'version' => '4.6.0',
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'LayerSlider WP',
			'slug' => 'LayerSlider',
			'source' => 'http://hb-themes.com/repository/plugins/layerslider.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name' => 'Live Chat Plugin',
			'slug' => 'screets-chat',
			'source' => 'http://hb-themes.com/repository/plugins/screets-chat.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false
		),
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
			)		
		);
	
		// Change this to your theme text domain, used for internationalising strings
		$theme_text_domain = 'hbthemes';
	
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
			'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
				'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
				'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
	
		tgmpa($plugins, $config);
		
	}
add_action('tgmpa_register', 'hbthemes_register_required_plugins');

/* WooCommerce Integration ---------------------------------------------------------------------------------------- */
if ( has_action('woocommerce_before_main_content') && has_action('woocommerce_after_main_content') ){
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	add_action('woocommerce_before_main_content', 'hb_woo_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'hb_woo_wrapper_end', 10);
}

function hb_woo_wrapper_start() {
  echo '<section id="main">';
}

function hb_woo_wrapper_end() {
  echo '</section>';
}

add_theme_support( 'woocommerce' );
/* END WooCommerce ------------------------------------------------------------------------------------------------*/

/* Disable Layer Slider Auto Update */
add_action('layerslider_ready', 'my_layerslider_overrides');

    // Define your function
    function my_layerslider_overrides() {
         
        // Items to override
        $GLOBALS['lsAutoUpdateBox'] = false;
    }
	
function get_all_layer_sliders () {
	if ( ! is_layer_slider_activated() )  return;

	$sliders = array();
	$sliders[''] = __('Select Slider' , 'hbthemes');
	if ( function_exists ( 'lsSliders' ) ) {
		$all_sliders = lsSliders ( 1000000, true, true );
		if ( !empty ( $all_sliders ) ) {
			foreach ( $all_sliders as $slider ) {
				$sliders[$slider['id']] = $slider['name'];
			}
		}		
	}
	return $sliders;
}

function is_layer_slider_activated() {
	$layerslider = ABSPATH . 'wp-content/plugins/LayerSlider/layerslider.php';
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( ! is_plugin_active ( 'LayerSlider/layerslider.php' ) )  return false;
	return true;
}
function is_layer_slider_installed() {
	$layerslider = ABSPATH . 'wp-content/plugins/LayerSlider/layerslider.php';
	if ( ! file_exists ( $layerslider ) )  return false;
	return true;
}

// Add links in WP admin bar
add_action( 'admin_bar_menu', 'toolbar_link_to_mypage', 140 );
function toolbar_link_to_mypage( $wp_admin_bar ) {
    $theme_options_url = admin_url().'themes.php?page=optionsframework';
    $args = array(
        'id'    => 'aegaeus_theme_options_link',
        'title' => 'Theme Options',
        'href'  => $theme_options_url,
        'meta'  => array( 'class' => 'aegaeus_theme_options_link' )
    );
    $wp_admin_bar->add_node( $args );
}

add_action( 'admin_bar_menu', 'hb_support_in_toolbar', 142 );
function hb_support_in_toolbar( $wp_admin_bar ) {
    $support_url = 'http://support.hb-themes.com';
    $args = array(
        'id'    => 'aegaeus_support_link',
        'title' => 'Theme Support',
        'href'  => $support_url,
        'meta'  => array( 'class' => 'aegaeus_support_link' )
    );
    $wp_admin_bar->add_node( $args );
}

add_action( 'admin_bar_menu', 'hb_docs_in_toolbar', 140 );
function hb_docs_in_toolbar( $wp_admin_bar ) {
    $docs_url = 'http://documentation.hb-themes.com/aegaeus';
    $args = array(
        'id'    => 'aegaeus_docs_link',
        'title' => 'Theme Documentation',
        'href'  => $docs_url,
        'parent' => 'aegaeus_support_link',
        'meta'  => array( 'class' => 'aegaeus_docs_link' )
    );
    $wp_admin_bar->add_node( $args );
}

add_action( 'admin_bar_menu', 'hb_forum_in_toolbar', 141 );
function hb_forum_in_toolbar( $wp_admin_bar ) {
    $forum_url = 'http://forum.hb-themes.com';
    $args = array(
        'id'    => 'aegaeus_forum_link',
        'title' => 'Support Forum',
        'href'  => $forum_url,
        'parent' => 'aegaeus_support_link',
        'meta'  => array( 'class' => 'aegaeus_forum_link' )
    );
    $wp_admin_bar->add_node( $args );
}

/* ADMIN HB DASHBOARD WIDGET
    ================================================== */
    if (!function_exists('hb_dashboard_widget')){
        function hb_dashboard_widget() {
            $my_theme          = wp_get_theme();
            $menus_url         = ADMIN_URL . 'nav-menus.php';
            $front_page_url    = ADMIN_URL . 'options-reading.php';
            $theme_options_url = ADMIN_URL . 'themes.php?page=optionsframework';
            $widgets_url       = ADMIN_URL . 'widgets.php';

            // Fetch RSS news
            $hb_rss = new DOMDocument();
            $hb_rss->load('http://hb-themes.com/home/feed/');
            $limit = 1;
            $hb_feed = array();

            foreach ($hb_rss->getElementsByTagName('item') as $node) {
                $item = array ( 
                    'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                    'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                    'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                    'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                );
                array_push($hb_feed, $item);
            }

            echo '
                <div class="main clearfix" id="highend_widget_box">
                <p class="nbm">' . __('You are using', 'hbthemes') .' <strong>'. $my_theme->get( 'Name' ) . '</strong> ' . __('theme. Version','hbthemes') . ' ' . ' <strong>' . $my_theme->get('Version') . '.</strong>
                </p>

                <hr/>

                <p>' . __('First Steps', 'hbthemes') . '</p>
                <ul id="highend_links">
                    <li><a href="' . $theme_options_url . '">' . __('Theme Options', 'hbthemes' ) . '</a></li>
                    <li><a href="' . $front_page_url . '">'. __('Choose your front page', 'hbthemes') .'</a></li>
                    <li><a href="' . $menus_url . '">'. __('Manage menus', 'hbthemes') . '</a></li>
                    <li><a href="' . $widgets_url . '">' . __('Manage widgets', 'hbthemes') . '</a></li>
                </ul>

                <hr/>

                <p>Need help?</p>
                <ul id="highend_widget">
                    <li id="highend_docs"><a href="http://documentation.hb-themes.com/aegaeus/index.html" target="_blank">' . __('Read the documentation', 'hbthemes') . '</a></li>
                    <li id="highend_videos"><a href="http://www.screenr.com/r9V8" target="_blank">' . __('Watch video tutorials', 'hbthemes') . '</a></li>
                    <li id="highend_forum"><a href="http://forum.hb-themes.com" target="_blank">' . __('Open a support topic', 'hbthemes') . '</a></li>
                    <li id="highend_facebook"><a href="http://facebook.com/hbthemes" target="_blank">' . __('Find us on Facebook', 'hbthemes') . '</a></li>
                    <li id="highend_twitter"><a href="http://twitter.com/hbthemes" target="_blank">' . __('Follow us on Twitter', 'hbthemes') . '</a></li>
                    <li id="highend_customization"><a href="http://hb-themes.com/home/hire-us" target="_blank">' . __('Hire HB-Themes to build your website', 'hbthemes') . '</a></li>
                </ul>';

                if ( !empty($hb_feed) ){
                    echo '
                    <div class="hb-latest-news-section rss-widget">
                        <hr/>
                        <p>' . __('HB-Themes News', 'hbthemes') . '</p>';

                        for($x=0;$x<$limit;$x++) {
                            $title = str_replace(' & ', ' &amp; ', $hb_feed[$x]['title']);
                            $link = $hb_feed[$x]['link'];
                            $description = $hb_feed[$x]['desc'];
                            //$date = date('F d, Y', strtotime($hb_feed[$x]['date']));
                            echo '<a class="rsswidget" href="'.$link.'" title="'.$title.'" target="_blank">'.$title.'</a><br/>';
                            //echo '<small class="rss-date">'.$date.'</small>';
                            echo '<p class="rssSummary">'.$description.'</p>';
                        }

                    echo '</div>';
                }

                echo '<div class="clear"></div></div>';
        }


        function hb_add_dashboard_widgets() {
            wp_add_dashboard_widget(
                'elevate_dashboard_widget',
                'Aegaeus',
                'hb_dashboard_widget'
            );  
        }


        if ( current_user_can( 'manage_options' ) ){
            add_action('wp_dashboard_setup', 'hb_add_dashboard_widgets');
        }
    }

?>