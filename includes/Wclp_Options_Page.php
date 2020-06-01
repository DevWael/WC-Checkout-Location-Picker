<?php
defined( 'ABSPATH' ) || exit; //prevent direct file access.
class Wclp_Options_Page {

	public function __construct() {
		//will do some logic here...
	}

	public function build() {
		return new Wclp_Options_Builder( $this->form_args() );
	}

	private function form_args() {
		return array(
			'title'        => __( 'Checkout Location', 'wclp' ),
			'prefix'       => 'wclp_checkout_',
			'action'       => 'theme_options',
			'redirect_url' => admin_url( 'admin.php?page=wclp_checkout' ),
			'setting_page' => array(
				'parent'      => true, //display as parent or child menu item
				'parent_slug' => '', //required if parent is set to false
				'capability'  => 'manage_options',
				'name'        => __( 'Checkout Location', 'wclp' ),
				'slug'        => 'wclp_checkout',
				'icon'        => 'dashicons-location-alt', //required if parent is set to true
				'position'    => 6, //required if parent is set to true
			),
			'input_args'   => array(
				array(
					'id'      => 'enabled',
					'type'    => 'radio',
					'label'   => __( 'Activate', 'wclp' ),
					'options' => array(
						'yes' => __( 'Yes', 'wclp' ),
						'no'  => __( 'No', 'wclp' ),
					)
				),
				array(
					'id'    => 'map_key',
					'type'  => 'text',
					'label' => __( 'Google Maps API Key', 'wclp' ),
				),
			)
		);
	}
}