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
		 * A variable use to create instance of our plugin.
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
		 * A callback function for custom ajax.
		 */
		public static function abf_ajax() {
			if ( isset( $_REQUEST['method'] ) ) {
				$method = sanitize_text_field( wp_unslash( $_REQUEST['method'] ) );
				switch ( $method ) :
					case 'fill_fields_automatically':
						self::instance()->get_fields_values();
						break;
				endswitch;
			}
		}

		/**
		 * A function use to get all fields.
		 */
		protected function get_fields_values() {
			$logged_in_user_email = isset( $_COOKIE['ameliaUserEmail'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['ameliaUserEmail'] ) ) : '';

//          Checking if user is logged in or not.
			if ( ! empty( $logged_in_user_email ) ) {
				$values  = [];
				$user_id = get_user_by_email( $logged_in_user_email )->ID;

//				$language_id
				$meta_values = get_user_meta( $user_id, 'amelia_fields_values', true );
				if ( is_array( $meta_values ) ) {
				$i = 3;
//              getting all values through foreach loop
					foreach ( $meta_values as $value ) {
						$values[$i] = $value['value'];
						$i++;
					}

					// sending to json
					wp_send_json_error( array(
						'type' => 'fields_found',
						'data' => $values,
					), 301 );
				}
			}
			wp_send_json_success(
				'No Exception Found'
			);
		}

		/**
		 * A function use to get all ajax actions.
		 */
		protected function modify_ajax_actions() {
			if ( isset( $_REQUEST['action'] ) ) {
				$action = wp_unslash( sanitize_text_field( $_REQUEST['action'] ) );
				if ( 'wpamelia_api' === $action ) {
					if ( isset( $_REQUEST['call'] ) ) {
						$call = wp_unslash( sanitize_text_field( $_REQUEST['call'] ) );
						switch ( $call ) :
							case '/bookings':
								$this->save_all_fields_data();
							break;
						endswitch;
					}
				}
			}
		}

		/**
		 * A function use to save all fields.
		 */
		protected function save_all_fields_data() {
			$a_fields       = [];
			$allowed_fields = array(
				'appointment', 'package'
			);

			// getting all request fields which are not available in $_POST, $_GET and $_REQUEST.
			$fields = file_get_contents( 'php://input' );
			$fields = json_decode( $fields, true );

			// checking is person is only purchasing.
			if ( in_array( $fields['type'], $allowed_fields, true ) ) {
				$b_array       = $fields['bookings'];
				$booking       = $b_array[0];
				$custom_fields = isset( $booking['customFields'] ) ? $booking['customFields'] : [];
				$logged_in_user_email = isset( $_COOKIE['ameliaUserEmail'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['ameliaUserEmail'] ) ) : '';

				// If user is logged in so check and get his selected fields.
				if ( ! empty( $logged_in_user_email ) ) {
					$user_id = get_user_by_email( $logged_in_user_email )->ID;
					foreach ( $custom_fields as $fields ) :
						$a_fields[] = array(
							'label' => $fields['label'],
							'value' => $fields['value'],
						);
					endforeach;

					// Updating meta values.
					update_user_meta( $user_id, 'amelia_fields_values', $a_fields );
				}
			}
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
