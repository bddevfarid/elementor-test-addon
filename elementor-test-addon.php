<?php
/**
 * Plugin Name: Elementor Test Addon
 * Description: Simple Hello World Elementor addon.
 * Plugin URI:  https://bddevfarid.com/
 * Version:     1.0.0
 * Author:      Faridul Islam
 * Author URI:  https://bddevfarid.com/
 * Text Domain: elementor-test-addon
 * 
 * Elementor tested up to: 3.14.0
 * Elementor Pro tested up to: 3.14.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Register Widgets
 *
 * Load widgets files and register new Elementor widgets.
 *
 * Fired by `elementor/widgets/register` action hook.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 */
function register_hello_world_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/hello-world.php' );

	$widgets_manager->register( new \Elementor_Test_Addon\Widgets\Elementor_Hello_World() );

}
add_action( 'elementor/widgets/register', 'register_hello_world_widget' );


/**
 * Register scripts and styles for Elementor test widgets.
 */
function elementor_test_widgets_dependencies() {

	/* Styles */
	wp_register_style( 'hello-world', plugins_url( 'assets/css/hello-world.css', __FILE__ ) );

}
add_action( 'wp_enqueue_scripts', 'elementor_test_widgets_dependencies' );



/**
 * Add Elementor widget categories
 */
function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'abc',
		[
			'title' => esc_html__( 'ABC', 'elementor-test-addon' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );


/**
 * Admin notice
 *
 * Warning when the site doesn't have Elementor installed or activated.
 *
 * @since 1.0.0
 * @access public
 */
function admin_notice_missing_main_plugin() {

	if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

	$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
		esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-addon' ),
		'<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-test-addon' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor', 'elementor-test-addon' ) . '</strong>'
	);

	printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

}

/**
 * Plugin load here correctly
 */
function elementor_test_addon_load_plugin(){

	// Check if Elementor installed and activated
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'admin_notice_missing_main_plugin' );
		return false;
	}
}

add_action('plugins_loaded', 'elementor_test_addon_load_plugin');
