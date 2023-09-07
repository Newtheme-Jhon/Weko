<?php
// Url o slug que llaman para la configuracion de las paginas
$url = "/wp-admin/admin.php?page=res_options_page";
?>

<div class="container-fluid page-menu" style="background-color: #f1f1f1">
    <div class="row">
        <!--bloque 1-->
        <div class="col-sm-12">
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row g-0">
                    <!--col-4-->
                    <div class="col-md-4">
                        <img src="<?php echo ATR_DIR_URI . '/admin/img/img-ajustes-weko.webp'; ?>" class="img-fluid" alt="Ajustes Weko" width="250px"> <br>// para esto debo de ir a esta ruta E:\WampServer\www\weko\wp-content\themes\storefront\admin\img para pegar la imagen 
                        // todo esto que se esta viendo aqui lo cree en el archivo atr-menu-weko-display.php                  
                    </div>
                    <!--col-8-->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Ajustes Weko</h5>
                            <p class="card-text">
                                Realiza los ajustes necesarios para personalizar tu mema weko.
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    transforma tu tema para llamar la atencion de los usuarios.
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        <!--bloque 1-->

        <!--bloque 2-->
        <div class="col-sm-12">
            <div class="card text-dark mb-3">
                <div class="card-header">
                    <h5 class="res-box-title">Ajustes del tema</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        En esta parte podre editar cada uno de los bloques que hay en las paginas de tu tema.
                    </p>
                    <!--Opciones para el carrousel-->
                    <table class="table"> // La etiqueta thead se utiliza en HTML para definir la sección de encabezado de una tabla
                        <thead>
                            <tr><th scope="col">Página de Inicio</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="<?php echo $url; ?>&page_edit=frontpage&edit=carrousel"
                                    type="button" class="btn btn-primary text-uppercase" id="btn-carrousel">
                                    <span class="dashicons dashicons-format-gallery"></span> Ajustes Bloque Carrousel
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="<?php echo $url; ?>&page_edit=frontpage&edit=servicios"
                                    type="button" class="btn btn-primary text-uppercase" id="btn-servicios">
                                    <span class="dashicons dashicons-admin-tools"></span> Ajustes Bloque Servicios
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--bloque 2-->
    </div>
</div>
