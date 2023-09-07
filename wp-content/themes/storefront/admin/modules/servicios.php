<?php 
/**
 * Array data servicios (get_options)
 */
$data_servicios = get_option('weko_options_servicios');
//var_dump($data_servicios);

?>

<div class="container-fluid page-edit-servicios">
    <!--Bloque 1 título -->
    <div class="row block-01">
        <div class="col-12">
            <div class="card text-dark bg-light mb-3 mt-3 px-3 py-2" style="max-width:90%;">
                <h5><?php echo $edit; ?></h5>
            </div>
        </div>
    </div>
    <!--Bloque 2 -->
    <div class="row block-02">
        <form action="" method="post">
            <div class="col-sm-12">
                <div class="card text-card bg-light mb-3" style="max-width:100%;">
                    <div class="card-body">
                        <div class="buttonsActions">
                            <button type="button" class="btn btn-warning btn-back" id="btnBack">
                                <span class="dashicons dashicons-undo"></span> Back 
                            </button>
                            <button type="button" class="btn btn-info" id="btnSave" data-nombre="">
                                <span class="dashicons dashicons-cloud-upload"></span> Save 
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Add servicios--> 
            <div class="col-sm-12">
                <div class="card border-light mb-3" style="max-width:100%;">
                    <div class="card-header">
                        <h5>Contenidos Servicios</h5>
                    </div>
                    <div class="card-body">
                        <?php for($i = 0; $i<count($data_servicios); $i++): ?>

                            <?php 
                                //icons
                                $icon = $data_servicios[$i]['icon'];
                                $icon = htmlEntities($icon, ENT_QUOTES);

                                //Quitando barras invertidas que se producen al enviar html
                                $iconHtml = str_replace('\\', '', $icon);

                                //Título
                                $titulo = $data_servicios[$i]['title'];

                                //Contenido
                                $content = $data_servicios[$i]['content'];

                            ?>

                            <div class="row">
                                <div class="col-sm-12 col-md-3">
                                    <h5>Contenido <?php echo $i+1; ?></h5>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <h5>icon fontawesome 6</h5>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="icon" id="icon" value="<?php echo $iconHtml; ?>">
                                        <span class="input-group-text" id="basic-addons2">@</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <h5>Título</h5>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $titulo; ?>">
                                        <span class="input-group-text" id="basic-addons2">@</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <h5>Textos</h5>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" name="textServicio" id="textServicio" cols="30" rows="5">
                                            <?php echo $content; ?>
                                        </textarea>
                                        <label for="floatingTextarea">Comments</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="divider"></div>
                                </div>
                            </div>
                            <?php endfor; ?>
                    </div>
                </div>
            </div><!--/Add servicios-->
        </form>
    </div><!--/Bloque 2-->
</div>