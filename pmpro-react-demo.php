<?php
/**
 * Plugin Name: PMPro React Demo
 * Plugin URI: https://github.com/pbrocks/pmpro-react-starter
 * Description: Starter WP Plugin built with React; forked from Peter Tasker's boilerplate plugin.
 * Author: Peter Tasker & pbrocks
 * Version: 0.1.1
 * Author URI: //deliciousbrains.com
 * Network: True
 */

class PMPro_React_Demo {

	public $plugin_domain;
	public $views_dir;
	public $version;

	public function __construct() {
		$this->plugin_domain = 'pmpro-react-demo';
		$this->views_dir     = trailingslashit( dirname( __FILE__ ) ) . 'server/views';
		$this->version       = '1.0';

		require_once __DIR__ . '/server/pmpro-rest-server.php';
		$pmpro_rest_server = new PMPro_Rest_Server();
		$pmpro_rest_server->init();

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu() {
		$title = __( 'PMPro React Demo', $this->plugin_domain );

		$hook_suffix = add_dashboard_page(
			$title, $title, 'export', $this->plugin_domain, array(
				$this,
				'load_admin_view',
			)
		);

		add_action( 'load-' . $hook_suffix, array( $this, 'load_assets' ) );
	}

	public function load_view( $view ) {
		$path = trailingslashit( $this->views_dir ) . $view;

		if ( file_exists( $path ) ) {
			include $path;
		}
	}

	public function load_admin_view() {
		$this->load_view( 'admin.php' );
	}

	public function load_assets() {
		wp_register_script( $this->plugin_domain . '-bundle', plugin_dir_url( __FILE__ ) . 'dist/bundle.js', array(), $this->version, 'all' );

		wp_localize_script(
			$this->plugin_domain . '-bundle', 'wpApiSettings', array(
				'root' => esc_url_raw( rest_url() ),
				'nonce' => wp_create_nonce( 'wp_rest' ),
				'pmpro_ajax_base' => defined( 'PMPRO_AJAX_BASE' ) ? PMPRO_AJAX_BASE : '',
				'pmpro_basic_auth' => defined( 'PMPRO_AJAX_BASIC_AUTH' ) ? PMPRO_AJAX_BASIC_AUTH : null,
			)
		);

		wp_enqueue_script( $this->plugin_domain . '-bundle' );
		wp_add_inline_script( $this->plugin_domain . '-bundle', '', 'before' );

		wp_enqueue_style( $this->plugin_domain . '-bundle-styles', plugin_dir_url( __FILE__ ) . 'dist/style.bundle.css', array(), $this->version, 'all' );
	}
}

new PMPro_React_Demo();
