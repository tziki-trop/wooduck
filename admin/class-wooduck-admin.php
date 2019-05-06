<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https:\\webduck.co.il
 * @since      1.0.0
 *
 * @package    Wooduck
 * @subpackage Wooduck/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wooduck
 * @subpackage Wooduck/admin
 * @author     webduck <office@webduck.co.il>
 */
class Wooduck_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wooduck_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wooduck_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wooduck-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wooduck_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wooduck_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wooduck-admin.js', array( 'jquery' ), $this->version, false );

	}
	public function create_menu_page() {

	//create new top-level menu
	add_menu_page(__( 'WebDuck Settings', 'client_to_google_sheet' ),
                  __( 'WebDuck Settings', 'client_to_google_sheet' ), 'administrator',
                  __FILE__, [ $this,'main_settings_page'] ,
                  'dashicons-editor-table' );

	//call register settings function
	add_action( 'admin_init', [ $this,'register_plugin_settings'] );
}
	public function register_plugin_settings() {
    register_setting('WebDuck_Settings', 'free_shiping' );

}
	public function main_settings_page() {
		?>
		<div class="wrap">
		<h1><?php  echo __( 'WebDuck Settings', 'client_to_google_sheet' ); ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'WebDuck_Settings' ); ?>
			<?php do_settings_sections( 'WebDuck_Settings' ); ?>
			<table class="form-table">
				<tr valign="top">
				<th scope="row"><?php  echo __( 'free shiping emount', 'client_to_google_sheet' ); ?></th>
				<td><input type="text" name="free_shiping" value="<?php echo esc_attr( get_option('free_shiping') ); ?>" /></td>
				</tr>
			</table>

			<?php submit_button(); ?>

		</form>
		</div>
		<?php
	}
}
