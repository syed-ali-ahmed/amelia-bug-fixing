<?php

if ( ! function_exists( 'abf_required_file' ) ) {
	function abf_required_file( $f_name, array $args = [] ) {
		if ( file_exists( ABF_DIR_PATH . $f_name . '.php' ) ) {
			require_once ABF_DIR_PATH . $f_name . '.php';
		}
	}
}