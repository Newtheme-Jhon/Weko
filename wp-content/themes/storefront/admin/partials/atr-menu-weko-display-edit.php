<?php 
/**
 * value get param url
 */
$page_edit  = $_GET['page_edit'];
$edit       = $_GET['edit'];

if( $page_edit == 'frontpage' && $edit == 'carrousel' ){
    include( get_template_directory() . '/admin/modules/carrousel.php' );

}elseif( $page_edit == 'frontpage' && $edit == 'servicios' ){
    include( get_template_directory() . '/admin/modules/servicios.php' );
}else{
    echo "Error! página no encontrada";
}

?>
