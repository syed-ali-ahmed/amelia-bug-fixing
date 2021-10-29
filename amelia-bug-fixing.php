<?php
/**
 * Plugin Name: Amelia Bug Fixing
 * Plugin URI: </>
 * Plugin Author: P5Cure
 * Author URI: https://www.p5cure.com
 * Description: A amelia extension which will fix all the bugs
 * Tags: Bug Fixing
 * Version: 1.0
 *
 * @package Amelia_Bug_Fixing
 */

defined( 'ABSPATH' ) || exit;

define( 'ABF_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'ABF_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'ABF_VERSION', '1.0' );
define( 'ABF_PREFIX', 'abf-' );

if ( file_exists( ABF_DIR_PATH . 'includes/class-abf-init.php' ) ) {
	require_once ABF_DIR_PATH . 'includes/functions.php';
	$abf_init = require_once ABF_DIR_PATH . 'includes/class-abf-init.php';
	new $abf_init();
}
