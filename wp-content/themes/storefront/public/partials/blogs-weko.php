<?php 
/**
 * Aquí crearemos la estructura para mostrar los posts
 */
//var_dump(get_post());

//data image
$attachment_id  = get_post_thumbnail_id( $post->ID );
$imageUrl       = wp_get_attachment_image_url( $attachment_id, 'full' );

//atributos de la imagen
$attribute_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

//post attributes
$attachment             = get_post( $attachment_id );
$attribute_title        = $attachment->post_title;
$attribute_caption      = $attachment->post_excerpt;
$attribute_description  = $attachment->post_content;

//data sizes
$size = wp_get_attachment_metadata( $attachment_id );
$width = $size['width'];
$height = $size['height'];

?>

<div class="imagen text-center mb-3">
    <div class="sombra">
        <a href="<?php the_permalink(); ?>"><i class="fas fa-link"></i></a>
    </div>
    <a href="<?php the_permalink(); ?>">
        <img class="img-fluid" src="<?php echo esc_url($imageUrl); ?>" 
        alt="<?php echo $attribute_alt; ?>" 
        title="<?php echo $attribute_title; ?>" 
        width="<?php echo $width; ?>" 
        height="<?php echo $height; ?>">
    </a>
</div>

<div class="row row-content mb-3">
    <div class="col-12 col-title">
        <a href="<?php the_permalink(); ?>">
            <h3><?php echo get_post()->post_title; ?></h3>
        </a>
    </div>
    <div class="col-12 data-post">
        <div>
            <span class="author">
                <i class="fa-solid fa-address-card"></i>
                <?php the_author(); ?>
            </span>
            <span class="calendar">
                <i class="fa-solid fa-calendar-days"></i>
                <?php echo get_the_date(); ?>
            </span>
        </div>
    </div>
    <div class="col-12 mt-3">
        <div class="contenido">
            <?php the_excerpt(); ?>
        </div>
    </div>
</div>