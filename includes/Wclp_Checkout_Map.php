<?php
defined( 'ABSPATH' ) || exit; //prevent direct file access.

class Wclp_Checkout_Map {
	protected $enabled;
	protected $api_key;

	public function __construct() {
		$this->enabled = get_option( 'wclp_checkout_enabled' );
		$this->api_key = get_option( 'wclp_checkout_map_key' );
	}


	public function display_map( $checkout ) {
		?>
        <div class="wclp-container">
            <h2><?php _e( 'Pick your location', 'wclp' ); ?></h2>
            <div class="wclp-google-map" id="wclp-google-map"></div>
            <input type="hidden" name="wclp_lat" id="wclp_lat">
            <input type="hidden" name="wclp_lng" id="wclp_lng">
        </div>
		<?php
	}

	function save_lat_lng( $order_id ) {
		if ( ! empty( $_POST['wclp_lat'] ) ) {
			update_post_meta( $order_id, 'Latitude', sanitize_text_field( $_POST['wclp_lat'] ) );
			update_post_meta( $order_id, 'Longitude', sanitize_text_field( $_POST['wclp_lng'] ) );
		}
	}


}