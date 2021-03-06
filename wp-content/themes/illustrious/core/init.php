<?php
//Theme options setup
if(!function_exists('cpotheme_setup')){
	add_action('after_setup_theme', 'cpotheme_setup');
	function cpotheme_setup(){
		//Set core variables
		define('CPOCORE_STORE', 'http://www.cpothemes.com');
		define('CPOCORE_VERSION', '4.3.5');
		define('CPOCORE_AUTHOR', 'CPOThemes');
		if(!defined('CPOTHEME_ID')) define('CPOTHEME_ID', 'core');
		if(!defined('CPOTHEME_NAME')) define('CPOTHEME_NAME', 'theme');
		if(!defined('CPOTHEME_VERSION')) define('CPOTHEME_VERSION', '1.0.0');
		if(!defined('CPOTHEME_PREMIUM_NAME')) define('CPOTHEME_PREMIUM_NAME', __('Premium Version', 'illustrious'));
		if(!defined('CPOTHEME_PREMIUM_URL')) define('CPOTHEME_PREMIUM_URL', 'http://www.cpothemes.com');
		if(!defined('CPOTHEME_THUMBNAIL_WIDTH')) define('CPOTHEME_THUMBNAIL_WIDTH', '600');
		if(!defined('CPOTHEME_THUMBNAIL_HEIGHT')) define('CPOTHEME_THUMBNAIL_HEIGHT', '400');
		
		//Add custom image size
		add_image_size('portfolio', apply_filters('cpotheme_thumbnail_width', CPOTHEME_THUMBNAIL_WIDTH), apply_filters('cpotheme_thumbnail_height', CPOTHEME_THUMBNAIL_HEIGHT), true);
		
		//Initialize supported theme features
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('custom-header', array('header-text' => false,'width' => 1600, 'height' => 500, 'flex-width' => true, 'flex-height' => true));
		add_theme_support('custom-background', apply_filters('cpotheme_background_args', array('default-color' => 'ffffff')));
		add_theme_support('automatic-feed-links');
		add_theme_support('woocommerce');
		add_theme_support('bbpress');
		
		//Set content width for embeds
		global $content_width;
		if(!isset($content_width)) $content_width = 640;
		
		//Load translation text domain and make translation available
		$languages_path = get_template_directory().'/core/languages';
		if(defined('CPOTHEME_CORELITE')) $languages_path = CPOTHEME_CORELITE.'/languages';
		load_theme_textdomain('illustrious', $languages_path);
		$locale = get_locale();
		$locale_file = get_template_directory()."/languages/$locale.php";
		if(is_readable($locale_file)) require_once($locale_file);
	}
}

//Add Public scripts
if(!function_exists('cpotheme_scripts_front')){
	add_action('wp_enqueue_scripts', 'cpotheme_scripts_front');
	function cpotheme_scripts_front( ){
		$scripts_theme_path = get_template_directory_uri().'/scripts/';
		$scripts_path = get_template_directory_uri().'/core/scripts/';
		if(defined('CPOTHEME_CORELITE_URL')) $scripts_path = CPOTHEME_CORELITE_URL.'/scripts/';

		//Enqueue necessary scripts already in the WordPress core
		//wp_enqueue_script('jquery-ui-core');
		if(is_singular() && get_option('thread_comments')) 
			wp_enqueue_script('comment-reply');
		
		wp_enqueue_script('cpotheme_html5', $scripts_path.'html5-min.js');
		//Register custom scripts for later enqueuing
		wp_enqueue_script('cpotheme_core', $scripts_path.'core.js', array(), false, true);
		wp_register_script('cpotheme_cycle', $scripts_path.'jquery-cycle2-min.js', array('jquery'), false, true);
		wp_register_script('cpotheme-magnific', $scripts_path.'jquery-magnific-min.js', array('jquery'), false, true);
	}
}

//Add Admin scripts
if(!function_exists('cpotheme_scripts_back')){
	add_action('admin_enqueue_scripts', 'cpotheme_scripts_back');
	function cpotheme_scripts_back(){
		$screen = get_current_screen();
		if($screen->base == 'post'){
			$scripts_path = get_template_directory_uri().'/core/scripts/';
			if(defined('CPOTHEME_CORELITE_URL')) $scripts_path = CPOTHEME_CORELITE_URL.'/scripts/';
			wp_enqueue_script('cpotheme_script_admin', $scripts_path.'admin.js', array('jquery'));
		}
	}
}

//Add public stylesheets
if(!function_exists('cpotheme_add_styles')){
	add_action('wp_enqueue_scripts', 'cpotheme_add_styles');
	function cpotheme_add_styles(){
		$stylesheets_path = get_template_directory_uri().'/core/css/';
		if(defined('CPOTHEME_CORELITE_URL')) $stylesheets_path = CPOTHEME_CORELITE_URL.'/css/';
		
		//Common styles
		wp_enqueue_style('cpotheme-base', $stylesheets_path.'base.css');
		wp_register_style('cpotheme-magnific', $stylesheets_path.'magnific.css');
		wp_enqueue_style('cpotheme-main', get_stylesheet_uri());
		
		//Font Libraries
		wp_register_style('cpotheme-fontawesome', $stylesheets_path.'icon-fontawesome.css');
	}
}

//Add admin stylesheets
if(!function_exists('cpotheme_add_admin_styles')){
	add_action('admin_print_styles', 'cpotheme_add_admin_styles');
	function cpotheme_add_admin_styles(){
		$stylesheets_path = get_template_directory_uri().'/core/css/';
		if(defined('CPOTHEME_CORELITE_URL')) $stylesheets_path = CPOTHEME_CORELITE_URL.'/css/';
		
		$screen = get_current_screen();
		if($screen->base == 'post'){
			add_editor_style($stylesheets_path.'editor.css');
			
			wp_enqueue_style('cpotheme_admin', $stylesheets_path.'admin.css');
			wp_enqueue_style('cpotheme-fontawesome', $stylesheets_path.'icon-fontawesome.css');
			
		}
	}
}


if(!function_exists('cpotheme_add_admin_styles_welcome')){
	add_action('admin_print_styles-appearance_page_cpotheme-welcome', 'cpotheme_add_admin_styles_welcome');
	function cpotheme_add_admin_styles_welcome(){
		$stylesheets_path = get_template_directory_uri().'/core/css/';
		if(defined('CPOTHEME_CORELITE_URL')) $stylesheets_path = CPOTHEME_CORELITE_URL.'/css/';
		wp_enqueue_style('cpotheme_admin', $stylesheets_path.'welcome.css');
	}
}


//Add all Core components
$core_path = get_template_directory().'/core/';
if(defined('CPOTHEME_CORELITE')) $core_path = CPOTHEME_CORELITE;
	
//Classes
require_once($core_path.'classes/class_customizer.php');
require_once($core_path.'classes/class_menu.php');
//Main Components
require_once($core_path.'admin.php');
require_once($core_path.'functions.php');
require_once($core_path.'markup.php');
require_once($core_path.'filters.php');
require_once($core_path.'meta.php');
require_once($core_path.'metaboxes.php');
require_once($core_path.'forms.php');
require_once($core_path.'taxonomy.php');
require_once($core_path.'icons.php');
require_once($core_path.'layout.php');
require_once($core_path.'woocommerce.php');
require_once($core_path.'menus.php');
require_once($core_path.'customizer.php');
//Metadata
require_once($core_path.'metadata/data_general.php');
require_once($core_path.'metadata/data_icons.php');
require_once($core_path.'metadata/data_metaboxes.php');
require_once($core_path.'metadata/data_customizer.php');