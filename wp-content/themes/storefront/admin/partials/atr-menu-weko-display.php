<?php 

//URL o slug de las páginas de configuración
$url = "/wp-admin/admin.php?page=res_options_page";

?>

<div class="container-fluid page-menu" style="background-color: #f1f1f1">
    <div class="row">
        <!--Bloque 1-->
        <div class="col-sm-12">
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row g-0">
                    <!--col-4-->
                    <div class="col-md-4">
                        <img src="<?php echo ATR_DIR_URI . '/admin/img/img-ajustes-weko.webp'; ?>" class="img-fluid" alt="Ajustes Weko" width="250px">
                    </div>
                    <!--col-8--> 
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Ajustes Weko</h5>
                            <p class="card-text">
                                Realiza los ajustes necesarios para personalizar tu tema weko.
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Transforma tu tema en el escaparate perfecto para llamar la atención de los usuarios.
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Bloque 1-->

        <!--Bloque 2-->
        <div class="col-sm-12">
            <div class="card text-dark mb-3">
                <div class="card-header">
                    <h5 class="res-box-title">Ajustes del Tema</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        En esta parte podrás editar cada uno de los bloques que hay en las páginas de tu tema.
                    </p>
                    <!-- Option carrousel --> 
                    <table class="table">
                        <thead>
                            <tr><th scope="col">Página de inicio</th></tr>
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
        <!--/Bloque 2-->
    </div>
</div>