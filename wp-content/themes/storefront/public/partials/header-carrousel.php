<?php 
//Array imagenes
$data   = get_option('weko_options_carrousel', true);
$c      = 0;

?>


<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">

    <?php 
      foreach( $data as $imagen ): 
        $active = ( $c == 0 ? 'active' : '' );
    ?>
    <div class="carousel-item <?php echo $active; ?>" style="background-image: url('<?php echo $imagen; ?>')">
      
    </div>
    <?php $c++; endforeach; ?>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <i class="fa-solid fa-arrow-left-long"></i>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <i class="fa-solid fa-arrow-right-long"></i>
    <span class="visually-hidden">Next</span>
  </button>
</div>