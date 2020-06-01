<?php

class Wclp_Order_Location {
	protected $enabled;

	public function __construct() {
		$this->enabled = get_option( 'wclp_checkout_enabled' );
	}

	function display_location( $order ) {
		$lat = get_post_meta( $order->id, 'Latitude', true );
		$lng = get_post_meta( $order->id, 'Longitude', true );
		if ( $lat && $lng ) {
			$location_link = add_query_arg( array(
				'api'   => 1,
				'query' => "$lat,$lng"
			), 'https://www.google.com/maps/search/' );
			echo '<p><a href="' . $location_link . '" target="_blank"><strong>' . __( 'Customer Location', 'wclp' ) . '</strong></a></p>';
		}
	}
}