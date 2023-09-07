<?php
/**
 * Template Name: Page Contacto
 *
 * @package escuela
 */

get_header();
?>

<main id="primary" class="site-main">
    <header class="header-page">
        <div class="container text-white">
            <h1 class="text-white fw-bold">Contacta con nosotros</h1>
            <p style="max-width:600px">Estamos a su disposición para resolver cualquier duda o proporcionar cualquier información adicional que necesites.</p>
        </div>
    <header>
</main><!-- #main -->


<section class="py-4 mt-5 ">
  <div class="container">
    <div class="row">
      <div class="col">
        <h1 class="fw-bold">Servicio de contacto</h1>
        <p>Puedes contactar con nosotros por teléfono, escribiendo un correo electrónico o enviando el formulario de contacto de esta página.</p>
        <div class="row p-4 pb-0">
          <div class="col-sm-6 mb-4">
            <img class="alignleft img-fluid" src="/wp-content/themes/escuela/img/icons/phone-1.png" alt="telefono" width="55">
            <p class="fs-5 text-black fw-bold mb-0">Número de teléfono</p>
            <a href="tel:+34977248319"class="text-black">+34 977 24 83 19</a>
          </div>
          <div class="col-sm-6 mb-4">
            <img class="alignleft img-fluid" src="/wp-content/themes/escuela/img/icons/email-1.png" alt="email" width="55">
            <p class="fs-5 text-black fw-bold mb-0">Nuestro Email</p>
            <a href="mailto:info@ceasfor.com" class="text-black">info@ceasfor.com</a>
          </div>
        </div>
        <div class="row p-4 pt-0">
          <div class="col-sm-6 mb-4">
            <img class="alignleft img-fluid" src="/wp-content/themes/escuela/img/icons/office.png" alt="oficina" width="55">
            <p class="fs-5 text-black fw-bold mb-0"> Aprobatus España</p>
            <p class="text-black">Torredembarra, Tarragona</p>
          </div>
          
        </div>
        
      </div>
      <div class="col-md-6"><img class="img-fluid" src="/wp-content/themes/escuela/img/calidad.webp" alt="calidad"></div>
    </div>
  </div>
</section>




<section>
    <div class="container m-0">
  <div class="row">
    <div class="col-md-7"><img class="mt-5 mb-4" src="/wp-content/themes/escuela/img/operator.jpg" alt="operadora" width="1800" height="1800"></div>
    <div class="col-md-5 p-5 text-black">
      <?php get_template_part( 'public/partials/form', 'page-contacto' ); ?>
    </div>
  </div>
</div>
</section>

<section class="mt-5">
  <div class="container mb-5 mt-5">
    <div class="row mb-4">
      <h1 class="text-black fw-bold">Nuestra ubicación</h1>
    </div>
    <div class="row mb-4">
      <div class="col-sm-6">
        <p> Puedes encontrarnos en: Carrer del Catllar, 4A, Carrer del Catllar, 4A, 43830 Torredembarra, Tarragona</p>
      </div>
      <div class="col-sm-4"></div>
      <div class="col-sm-2">
        <a class="btn btn-primary-1" href="/cursos"> Ver más</a>
      </div>
    </div>
    <div class="row">
        
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3004.3025085497193!2d1.3907613152817935!3d41.149749979286824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a3f05856ed3915%3A0x257fcd35a8b58045!2sCarrer%20del%20Catllar%2C%204A%2C%2043830%20Torredembarra%2C%20Tarragona!5e0!3m2!1ses!2ses!4v1665653573779!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>

<?php include 'frontpage/amarillo.php'; ?>


<?php get_footer(); ?>
