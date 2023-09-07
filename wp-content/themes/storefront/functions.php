<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

include 'functions_weko.php';

//header.php replace
function atr_replace_content_header(){

	$bolean = '';
	$txt_file = fopen(ATR_DIR_PATH . 'header.php', 'r');
	$line = 1;

	while( $text_line = fgets($txt_file) ){

		if($line == 2 && $text_line == 'include "header-weko.php";'){
			$bolean = true;
		}else{
			$bolean = false;
		}
	}

	fclose($txt_file);

	if ($bolean === false){

		file_put_contents( ATR_DIR_PATH. "header.php", "" );
		$file_handle = fopen( ATR_DIR_PATH . 'header.php', 'a+' );
		fwrite( $file_handle, '<?php' );
		fwrite( $file_handle, "\n" );
		fwrite( $file_handle, 'include "header-weko.php";' );
		fclose( $file_handle );

	}

}
//add_action('after_setup_theme', 'atr_replace_content_header', 10, 2);


//API REST WordPress
$host = 'https://newtheme.eu';
$urlApi = $host.'/wp-json/wp/v2/';

//authorization
$api_user = 'jhonja14795';
$api_password = "y0BC cXc5 QlE5 w7GD tTPv 9T3N";

function getPostApiRest($urlApi){

	//$options = array('per_page' => 3, 'page' => 1);
	//$request = wp_remote_get('https://newtheme.eu/wp-json/wp/v2/posts/?per_page=3&page=1');
	$options = array(
		'body' => array('per_page' => 3, 'page' => 1)
	);
	$request = wp_remote_get('https://newtheme.eu/wp-json/wp/v2/posts', $options);

	$json = json_decode($request['body']);
	//var_dump($json[0]->title);
	//echo $json[0]->title->rendered;

	$ids = [];

	foreach($json as $item){
		$item = array(
			'id' 		=> $item->id,
			'title' 	=> $item->title->rendered
		);
		array_push($ids, $item);
	}

	//return $ids;
	var_dump($ids);
	
}

//Mostrar array api get
//getPostApiRest($urlApi);

//Api autorization
//Consultar un post privado
//SOlo para consultar este post privado utilizamos el content-type
function remote_post_aut_basic_post(){

	$args = array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( 'jhonja14795' . ':' . 'y0BC cXc5 QlE5 w7GD tTPv 9T3N' ),
			'Content-Type' => 'application/json',
		),
	);
	
	$request = wp_remote_post('https://newtheme.eu/wp-json/wp/v2/posts/889', $args);
	//$json = json_decode($request['body']);
	var_dump($request);

}

//remote_post_aut_basic_post();

function remote_post_aut_basic_users(){

	$args = array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( 'jhonja14795' . ':' . 'y0BC cXc5 QlE5 w7GD tTPv 9T3N' ),
			'Content-Type' => 'application/json',
			'Cache-Control' => 'no-cache',
		),
	);
	
	$request = wp_remote_get('https://newtheme.eu/wp-json/wp/v2/users', $args);
	//$json = json_decode($request['body']);
	var_dump($request);

}

//remote_post_aut_basic_users();


//Esta funcion sirve para editar un posts
//IMPORTANTE: No debemos utilizar ningun parametro mas en el header de content-type ni nada
//Los atributos pra actualizar los consultaremos aqui: https://developer.wordpress.org/rest-api/reference/posts/

function remote_post_aut_basic_post_edit(){

	$body = [
		'title' => 'Post Actualizado desde HTTP'
	];

	$args = array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( 'jhonja14795' . ':' . 'y0BC cXc5 QlE5 w7GD tTPv 9T3N' ),
		),
		'body' => $body,
	);
	
	$request = wp_remote_post('https://newtheme.eu/wp-json/wp/v2/posts/889', $args);
	$json = json_decode($request['body']);
	//var_dump($json);

}

//remote_post_aut_basic_post_edit();

//create posts
function createPosts(){

	$body = [
		'title'   => 'My testsdcfcf',
		'status'  => 'private', // ok, we do not want to publish it immediately
		'content' => 'lalalafvgf',
		'author' => 1,
		'categories' => 12, // category ID
		'slug' => 'new-test-post' // part of the URL usually 
	];

	$args = [
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( 'jhonja14795' . ':' . 'y0BC cXc5 QlE5 w7GD tTPv 9T3N' ),
		),
		'body' => $body
	];

	$api_response = wp_remote_post( 'https://newtheme.eu/wp-json/wp/v2/posts', $args);
	$body = json_decode( $api_response['body'] );

}
//add_action('after_setup_theme', 'createPosts', 10, 2);

//createPosts();



//items menu secundari


// $args = wp_nav_menu(
// 	array(
// 		'theme_location' => 'secondary',
// 		'fallback_cb'    => '',
// 	)
// );


function add_extra_item_to_nav_menu( $items, $args ) {

	$item = '<select name="hijo" id="hijo">
	<option value="">seleccione un hijo</option>
	<option value="1">hijo1</option>
	<option value="1">hijo2</option>
	<option value="1">hijo3</option>
	</select>';

	//var_dump($args->menu->slug);
	//seleccionamos el menu donde se añade el item
    if (is_user_logged_in() && $args->menu->slug == 'menu-secundario') {
        $items .= $item;
    }
   
    return $items;
}
add_filter( 'wp_nav_menu_items', 'add_extra_item_to_nav_menu', 10, 2 );

?>
