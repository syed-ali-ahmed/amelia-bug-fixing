<?php
/**
 * File Name: class-abf-init.php
 *
 * @package Amelia_Bug_Fixing
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ABF_Init' ) ) {
	class ABF_Init {
		public function __construct() {
			$this->run();
		}

		protected function run() {
			$this->required_files();
			$this->add_actions();
			$this->add_filters();
		}

		protected function required_files() {
		}

		public function wp_enqueue_scripts() {

		}

		protected function add_actions() {
			add_action( 'wp_enqueue_editor', array( $this, 'wp_enqueue_scripts' ) );
		}

		protected function add_filters() {

		}
	}
}

return 'ABF_Init';