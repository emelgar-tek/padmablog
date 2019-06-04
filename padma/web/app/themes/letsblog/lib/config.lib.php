<?php
//Setup theme constant and default data
$theme_obj = wp_get_theme('letsblog');

define("THEMENAME", $theme_obj['Name']);
define("THEMEDEMO", FALSE);
define("THEMEDEMOIG", 'kinfolklifestyle');
define("SHORTNAME", "pp");
define("THEMEVERSION", $theme_obj['Version']);
define("THEMEDOMAIN", THEMENAME.'Language');
define("THEMEDEMOURL", $theme_obj['ThemeURI']);
define("THEMEDATEFORMAT", get_option('date_format'));
define("THEMETIMEFORMAT", get_option('time_format'));
define("ENVATOITEMID", 12340419);

//Get default WP uploads folder
$wp_upload_arr = wp_upload_dir();
define("THEMEUPLOAD", $wp_upload_arr['basedir']."/".strtolower(sanitize_title(THEMENAME))."/");
define("THEMEUPLOADURL", $wp_upload_arr['baseurl']."/".strtolower(sanitize_title(THEMENAME))."/");

if(!is_dir(THEMEUPLOAD))
{
	mkdir(THEMEUPLOAD);
}

//Define all google font usages in customizer
$letsblog_google_fonts = array('tg_body_font', 'tg_header_font', 'tg_menu_font', 'tg_sidemenu_font', 'tg_sidebar_title_font', 'tg_button_font', 'tg_blog_title_font', 'tg_blog_date_font');
global $letsblog_google_fonts;

function letsblog_get_wp_filesystem() {
	require_once (ABSPATH . '/wp-admin/includes/file.php');
	WP_Filesystem();
	global $wp_filesystem;
	return $wp_filesystem;
}
?>