<?php

global $wpdb;

$atr_dir_path = ( substr( get_template_directory(),     -1 ) === '/' ) ? get_template_directory()     : get_template_directory()     . '/';
$atr_dir_uri  = ( substr( get_template_directory_uri(), -1 ) === '/' ) ? get_template_directory_uri() : get_template_directory_uri() . '/';

define( 'ATR_DIR_PATH', $atr_dir_path );
define( 'ATR_DIR_URI',  $atr_dir_uri  );

require_once ATR_DIR_PATH . 'includes/class-atr-master.php';

function atr_run_master() {
    
    $atr_master = new ATR_Master;
    $atr_master->run();
    
}

atr_run_master();

//add filter type image csv
function atr_mime_type_csv_woocommerce($mime_types){

    $types = array(
        'webp' => 'image/webp' //add webp extension
    );
    return $types;

}
add_filter('woocommerce_rest_allowed_image_mime_types', 'atr_mime_type_csv_woocommerce', 1, 1);

remove_action('storefront_loop_post', 'storefront_post_header', 10);
remove_action('storefront_loop_post', 'storefront_post_content', 30);
remove_action('storefront_loop_post', 'storefront_post_taxonomy', 40);

//Add new action hook post
function atr_theme_posts_content(){
    get_template_part('public/partials/blogs', 'weko');
}
add_action('storefront_loop_post', 'atr_theme_posts_content');

//echo 1; exit;


 function atr_get_category_library(){

    global $woocommerce;
    global $post;

    $product = wc_get_product( $post->ID );

    // var_dump(get_the_ID());
    // var_dump();

    global $product; 
    $terms = get_the_terms( $post->ID, 'product_cat' );
    var_dump($terms);

}
add_action('storefront_before_content', 'atr_get_category_library');


/**
 * Funciones para añadir un producto obligatorio
 * https://latiendadelcolegio.es/
 */
function atr_add_cart_item($cart_item){

    $id = $cart_item['product_id'];
    $producto = new WC_Product($id);

    //Product category
    $category_id = $producto->category_ids;
    $category_id = $category_id[0];

    $obligatorio = atr_categories_cursos_escuela_prueba($category_id);

    foreach ( WC()->cart->get_cart() as $cart_item ) {

        $product_id         = $cart_item['product_id'];
        $quantity           = $cart_item['quantity'];
        
        if($product_id == $obligatorio){

            if($quantity >=1){
                $add_product = "";
            }
            
            
        }
    
    }

    

}
add_action('woocommerce_after_cart_item_name', 'atr_add_cart_item');

/**
 * IDS libros obligatorios
 * EP1 obligatorio id = 1405
 * EP2 obligatorio id = 1423
 */
function atr_categories_cursos(){

    //Categorias de los cursos
    $cat = [
        'EP1' => 540,
        'EP2' => 530,
    ];

}

/**
 * Aquí cogeremos la categoria y añadiremos el producto obligatorio
 */
function atr_categories_cursos_escuela_prueba($category_id){

    /**
     * Este array lo usaremos para que segun la categoria me devuelva el id obligatorio del curso
     */
    $cats = [
        20 => array('curso' => 'ciclismo', 'id' => 118, 'cat_id' =>20),
        28 => array('curso' => 'ropa y equipo', 'id' => 142, 'cat_id' =>28),
        25 => array('curso' => 'esqui', 'id' => 130, 'cat_id' =>25),
    ];

    foreach ($cats as $key => $cat){
        if($category_id  != $key){
            $obligatorio = '';
        }else{
            $obligatorio = $cat['id'];
            //var_dump(WC()->cart->get_cart());
            WC()->cart->add_to_cart( $obligatorio, 1 );
            return $obligatorio;
        }
    }
    
}

function misha_order_details( $order ) {

    //var_dump($order);
    //User ID
    $userId = get_current_user_id();
    $url_category = '';
    $hijo = get_post_meta( $order->get_id(), 'atr_data_hijos', true );

    $obligatorios = [
        0 => array('curso' => 'EP1', 'id' => 4699, 'cat_id' =>589, 'sku' => 2802399600038),
        1 => array('curso' => 'EP2', 'id' => 4883, 'cat_id' =>590, 'sku' => 2802399600039),
        2 => array('curso' => 'EP3', 'id' => 4951, 'cat_id' =>591, 'sku' => 2802399600040),
        3 => array('curso' => 'EP4', 'id' => 4987, 'cat_id' =>592, 'sku' => 2802399600041),
        4 => array('curso' => 'EP5', 'id' => 5023, 'cat_id' =>593, 'sku' => 2802399600042),
        5 => array('curso' => 'EP6', 'id' => 5052, 'cat_id' =>594, 'sku' => 2802399600043),
        6 => array('curso' => 'ESO1', 'id' => 5074, 'cat_id' =>596, 'sku' => 2802399600044),
        7 => array('curso' => 'ESO2', 'id' => 5105, 'cat_id' =>597, 'sku' => 2802399600045),
        8 => array('curso' => 'ESO3', 'id' => 5127, 'cat_id' =>598, 'sku' => 2802399600046),
        9 => array('curso' => 'ESO4', 'id' => 5147, 'cat_id' =>599, 'sku' => 2802399600047),
        10 => array('curso' => 'ESO4', 'id' => 5147, 'cat_id' =>599, 'sku' => "B990031"),
    ];

    $count = count($obligatorios);

    $order = wc_get_order( $order->get_id() );
    $items = $order->get_items();

    foreach ( $items as $item ) {
        $product_name = $item->get_name();
        $product_id = $item->get_product_id();
        $product_variation_id = $item->get_variation_id();

        $producto_obligatorio = new WC_Product_Simple($product_id);
        $sku = $producto_obligatorio->sku;

        for($i = 0; $i < $count; $i++){
            $obligatorio = $obligatorios[$i]['sku'];
            if($sku == $obligatorio){
                //Name option
                $NameOption   = $userId.'-orders-'.$sku;
                $args = array(
                    'hijo' => $hijo,
                    'sku' => $sku
                );
            
                $data = update_option( $NameOption, $args, true );
                // $terms = get_the_terms( $product_id, 'product_cat' );
                // $url_category = $terms[0]->name;
            }

        }

    }
    
    if( $hijo ) :
		?>
			<tr>
				<th scope="row">Hijo añadido al pedido:</th>
				<td><?php echo esc_html( $hijo ) ?></td>
			</tr>
		<?php
	endif;

    // if($url_category != ''){
    //     $url = home_url("/product-category/$url_category");
    //     bbloomer_redirectcustom( $order, $url );
       
    // }

}
add_action( 'woocommerce_order_details_after_order_table_items', 'misha_order_details' );


add_action( 'woocommerce_thankyou', 'bbloomer_redirectcustom');
function bbloomer_redirectcustom( $order_id ){

    $userId = get_current_user_id();
    $url_category = '';
    $hijo = get_post_meta( $order_id, 'atr_data_hijos', true );

    $obligatorios = [
        0 => array('curso' => 'EP1', 'id' => 4699, 'cat_id' =>589, 'sku' => 2802399600038),
        1 => array('curso' => 'EP2', 'id' => 4883, 'cat_id' =>590, 'sku' => 2802399600039),
        2 => array('curso' => 'EP3', 'id' => 4951, 'cat_id' =>591, 'sku' => 2802399600040),
        3 => array('curso' => 'EP4', 'id' => 4987, 'cat_id' =>592, 'sku' => 2802399600041),
        4 => array('curso' => 'EP5', 'id' => 5023, 'cat_id' =>593, 'sku' => 2802399600042),
        5 => array('curso' => 'EP6', 'id' => 5052, 'cat_id' =>594, 'sku' => 2802399600043),
        6 => array('curso' => 'ESO1', 'id' => 5074, 'cat_id' =>596, 'sku' => 2802399600044),
        7 => array('curso' => 'ESO2', 'id' => 5105, 'cat_id' =>597, 'sku' => 2802399600045),
        8 => array('curso' => 'ESO3', 'id' => 5127, 'cat_id' =>598, 'sku' => 2802399600046),
        9 => array('curso' => 'ESO4', 'id' => 5147, 'cat_id' =>599, 'sku' => 2802399600047),
        10 => array('curso' => 'ESO4', 'id' => 5147, 'cat_id' =>599, 'sku' => "B990031"),
    ];

    $count = count($obligatorios);

    $order = wc_get_order( $order_id );
    $order = wc_get_order( $order->get_id() );
    $items = $order->get_items();

    foreach ( $items as $item ) {
        $product_name = $item->get_name();
        $product_id = $item->get_product_id();
        $product_variation_id = $item->get_variation_id();

        $producto_obligatorio = new WC_Product_Simple($product_id);
        $sku = $producto_obligatorio->sku;

        for($i = 0; $i < $count; $i++){
            $obligatorio = $obligatorios[$i]['sku'];
            if($sku == $obligatorio){
                $terms = get_the_terms( $product_id, 'product_cat' );
                $url_category = $terms[0]->name;
            }
        }
    }

    if($url_category != ''){
        $url = home_url("/product-category/$url_category");
        $order = wc_get_order( $order_id );

        if ( ! $order->has_status( 'failed' ) ) {
            wp_safe_redirect( $url );
            exit;
        }
    }


}


function atr_create_option(){
    
    $name = 'orders-items-11';
    $option = get_option($name);
    $rand = rand(0,7);

    if($option != false){
        $args = array('hijo' => 'Andres Cuervo', 'product_id' => $rand, 'sku' => $rand);
        array_push($option, $args);
        $objeto = update_option($name, $option, true);
    }else{
        $args[] = array('hijo' => 'Andres Cuervo', 'product_id' => $rand, 'sku' => $rand);
        update_option($name, $args, true);
    }

    //var_dump($option);
}
//add_action('init', 'atr_create_option');
// header("Content-Type: text/html; charset=UTF-8");
function atr_create_option_redirect(){

    //var_dump(111);

    // global $post;
    // $page = $post->post_title;
    // var_dump($page);

    // $url = 'http://weko.test/ciclismo/';
    // wp_redirect($url);
    // exit();
    
    // if ($page == 'Carrito') {

    // }

    
}
add_action('init', 'atr_create_option_redirect');
//add_action('storefront_before_content', 'atr_create_option_redirect');

// function url_category_function($url){
//     return $url;
// }



// var_dump(url_category_function($url));