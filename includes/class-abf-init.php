<?php
/**
 * File Name: class-abf-init.php
 *
 * @package Amelia_Bug_Fixing
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ABF_Init' ) ) {
	/**
	 * Class ABF_Init
	 */
	class ABF_Init {

		/**
		 * ABF_Init constructor.
		 */
		public function __construct() {
			$this->run();
		}

		/**
		 * A function which is use to run whole plugin.
		 */
		protected function run() {
			$this->required_files();
			$this->add_actions();
			$this->add_filters();
		}

		/**
		 * A function use to include dependencies.
		 */
		protected function required_files() {
			/**
			 * Module Name: Fill fields automatically.
			 * Description: If user already exist so fill his fields automatically.
			 */
			abf_required_file( 'includes/classes/class-abf-persist-preference' );
		}

		/**
		 * A function use to link styles & scripts.
		 */
		public function wp_enqueue_scripts() {

		}

		/**
		 * A function use to register action hooks.
		 */
		protected function add_actions() {
			add_action( 'wp_enqueue_editor', array( $this, 'wp_enqueue_scripts' ) );
			add_action( 'admin_init', array( 'ABF_Persist_Preference', 'admin_init' ) );
		}

		/**
		 * A function use to register filter hooks.
		 */
		protected function add_filters() {

		}
	}
}

return 'ABF_Init';
