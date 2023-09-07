<?php
/**
 * Value get parametros url
 */
$page_edit = $_GET['page_edit'];
$edit      = $_GET['edit'];

if( $page_edit == 'frontpage'  && $edit == 'carrousel'){    
    include( get_template_directory() . '/admin/modules/carrousel.php' );// con esta funcion obtengo la ruta de la raiz del archivo storefront
    
}elseif( $page_edit == 'frontpage'  && $edit == 'servicios'){
    include( get_template_directory() . '/admin/modules/servicios.php' );
}else{
    echo "Error! página no encontrada";
}

?>

