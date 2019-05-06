<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https:\\webduck.co.il
 * @since      1.0.0
 *
 * @package    Wooduck
 * @subpackage Wooduck/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wooduck
 * @subpackage Wooduck/public
 * @author     webduck <office@webduck.co.il>
 */
class Wooduck_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wooduck-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wooduck-public.js', array( 'jquery' ), $this->version, false );
	}
		
public function add_custom_discount_2nd_at_50( $wc_cart ){
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
    $discount = 0;
    $items_prices = array();
    $qty_notice = 0;  //  <==  Added HERE

    // Set HERE your targeted variable product ID
    $targeted_product_id = 40;
	$total_price_amount = 0;
    foreach ( $wc_cart->get_cart() as $key => $cart_item ) {
      //  if( $cart_item['product_id'] == $targeted_product_id ){
            $qty = intval( $cart_item['quantity'] );
            $qty_notice += intval( $cart_item['quantity'] ); //  <==  Added HERE
            for( $i = 0; $i < $qty; $i++ ){
                $items_prices[] = floatval( $cart_item['data']->get_price());
				$total_price_amount  = $total_price_amount + floatval( $cart_item['data']->get_price());
			}
      //  }
    }
    $count_items_prices = count($items_prices);
	//$fix_prose_to_shoping = 500;
$free_shipping_settings = get_option( 'free_shiping' );
	//var_dump($free_shipping_settings);
	if(!$free_shipping_settings)
		return;
	//var_dump($free_shipping_settings);
//$fix_prose_to_shoping = $free_shipping_settings['min_amount'];
if($total_price_amount < (int)$free_shipping_settings){
			$left = $free_shipping_settings - $total_price_amount;
		        wc_clear_notices();
				     //   wc_add_notice( $fix_prose_to_shoping , 'notice');

		        wc_add_notice( __( "נשאר לך עוד" )." ₪".$left." ".__( "למשלוח חינם!" )." <a class='back_to_stor' href='/shop/'>חזרה לחנות <i class='fa fa-chevron-circle-left' aria-hidden='true'></i></a> " , 'notice');

	}
	
}
	







public function add_content_after_addtocart() {

    // get the current post/product ID
    $current_product_id = get_the_ID();

    // get the product based on the ID
    $product = wc_get_product( $current_product_id );

    // get the "Checkout Page" URL
    $checkout_url = WC()->cart->get_checkout_url();
   $myurl = $checkout_url.'?add-to-cart='.$current_product_id;
    // run only on simple products
     echo '<a id="single_add_to_cart_button" href="'.$checkout_url.'?add-to-cart='.$current_product_id.'" class="single_add_to_cart_button button alt" >לתשלום</a>';

    if ( $product->is_type('variable') ) {
         
        ?>
        <script>
			var cuurent_pr_url = "<?php echo $myurl; ?>";
        jQuery(document).ready(function($) {
            $('input.variation_id').change( function(){
                if( '' != $('input.variation_id').val() ) {
                  			
                    var var_id = $(".elementor-add-to-cart").find('input.variation_id').val();
					var var_id = this.value;
				//	var current = $("#single_add_to_cart_button").attr("href");
					var current = cuurent_pr_url + "&variation_id=" + var_id;
					$(".single_add_to_cart_button").attr("href",current);
                     
                }
            });
             
        });
        </script>

add_filter( 'woocommerce_checkout_fields' , 'custom_remove_woo_checkout_fields' );
 
function custom_remove_woo_checkout_fields( $fields ) {

    // remove billing fields
    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    unset($fields['billing']['billing_email']);
   
    // remove shipping fields 
    unset($fields['shipping']['shipping_first_name']);    
    unset($fields['shipping']['shipping_last_name']);  
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_1']);
    unset($fields['shipping']['shipping_address_2']);
    unset($fields['shipping']['shipping_city']);
    unset($fields['shipping']['shipping_postcode']);
    unset($fields['shipping']['shipping_country']);
    unset($fields['shipping']['shipping_state']);
    
    // remove order comment fields
    unset($fields['order']['order_comments']);
    
    return $fields;
}
        <?php
	}
}
}
