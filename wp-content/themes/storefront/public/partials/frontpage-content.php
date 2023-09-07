<?php if(is_front_page()): ?>

<?php 
//get data servicios
$servicios = get_option('weko_options_servicios');
//var_dump($servicios);

?>

<div class="container-fluid gx-0">
    <div class="row row-container">
        <?php 
            foreach( $servicios as $servicio ):

                $iconHtml = esc_html($servicio['icon']);
                $iconHtml = str_replace('\\', '', $iconHtml);
        ?>
        <div class="col-12 col-sm-12 col-md-4">
            <div class="contenido py-3">
                <span class="icon">
                    <?php 
                        echo html_entity_decode($iconHtml, ENT_QUOTES);
                    ?>
                </span>
                <span class="text">
                    <h4><?php echo $servicio['title']; ?></h4>
                    <p><?php echo $servicio['content']; ?></p>
                </span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php endif;