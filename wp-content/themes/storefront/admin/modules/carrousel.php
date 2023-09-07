<?php 
/**
 * array imágenes (get_options)
 */

$imagen = get_option('weko_options_carrousel');

//var_dump($imagen);
?>

<div class="container-fluid page-edit-carrousel">
    <!--Bloque 1 título-->
    <div class="row block-01">
        <div class="col-12">
            <div class="card text-dark bg-light mb-3 mt-3 px-3 py-2" style="max-width: 90%;">
                <h5><?php echo $edit; ?></h5>
            </div>
        </div>
    </div>
     <!--Bloque 2-->
     <div class="row block-02">
        <form action="" method="post">
            <!--cabecera--> 
            <div class="col-sm-12">
                <div class="card text-card bg-light mb-3" style="max-width:100%;">
                    <div class="card-body">
                        <div class="buttonsActions">
                            <button class="btn btn-warning btn-back" id="btnBack">
                                <span class="dashicons dashicons-undo"></span> Back
                            </button>
                            <button type="button" class="btn btn-info" id="btnSave">
                                <span class="dashicons dashicons-cloud-upload"></span> Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Add imagenes--> 
            <div class="col-sm-12">
                <div class="card border-light mb-3" style="max-width:100%;">
                    <div class="card-header">
                        <h5>Imagenes Carrousel</h5>
                    </div>
                    <div class="card-body">
                        <?php for($i = 0; $i<count($imagen); $i++): ?>

                            <!--Imagenes--> 
                            <div class="row campo-imagen">
                                <div class="col-sm-12 col-md-3">
                                    <h5>Imagen <?php echo $i+1; ?></h5>
                                    <p>
                                        Añade una imagen <br>
                                        de 1920 x 850 pixeles
                                    </p>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <h5>URL imagen</h5>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="" 
                                        id="imgSelect" placeholder="#" 
                                        aria-label="#" aria-describedby="basic-addons2" 
                                        value="<?php echo $imagen[$i]; ?>"
                                        >
                                        <span class="input-group-text" id="basic-addons2">@</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5">
                                    <div class="imagen mt-3" id="imagen">
                                        <img src="<?php echo $imagen[$i]; ?>" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="divider"></div>
                                </div>
                            </div>

                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>