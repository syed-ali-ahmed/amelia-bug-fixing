<?php
/**
 * File Name: functions.php
 *
 * @package Amelia_Bug_Fixing
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'abf_required_file' ) ) {
	/**
	 * Required files is use to include files to your plugin.
	 *
	 * @param string $f_name Plugin name.
	 * @param array  $args   Required parameters.
	 */
	function abf_required_file( string $f_name, array $args = array() ) {
		if ( file_exists( ABF_DIR_PATH . $f_name . '.php' ) ) {
			require_once ABF_DIR_PATH . $f_name . '.php';
		}
	}
}
