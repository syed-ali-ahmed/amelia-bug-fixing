<?php
/**
 * File Name class-adb-persist-preference.php
 *
 * @package Amelia_Bug_Fixing
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'ABF_Persist_Preference' ) ) {

	/**
	 * Class ABF_Persist_Preference
	 */
	class ABF_Persist_Preference {

		/**
		 * A function use to create instance of our plugin.
		 *
		 * @var null
		 */
		protected static $instance = null;

		/**
		 * A function use to get ajax before any action.
		 */
		public static function admin_init() {
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				self::instance()->modify_ajax_actions();
			}
		}

		/**
		 * A function use to get all ajax actions.
		 */
		public function modify_ajax_actions() {

		}

		/**
		 * A function use to create instance of you class.
		 *
		 * @return ABF_Persist_Preference|null
		 */
		protected static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
	}
}

return new ABF_Persist_Preference();
