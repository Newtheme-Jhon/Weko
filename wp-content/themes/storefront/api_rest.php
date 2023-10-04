<?php

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
