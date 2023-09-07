<?php

class ATR_Public {

    private $theme_name;
    private $version;

    public function __construct( $theme_name, $version ) {
        
        $this->theme_name = $theme_name;
        $this->version = $version;
    }

    public function enqueue_styles(){

         /**
         * libreria fontawesome
         * https://fontawesome.com/download
         */
        wp_enqueue_style( 
            'fontawesome', 
            ATR_DIR_URI . 'helpers/fontawesome-6.1.1/css/fontawesome.min.css', 
            [], 
            '5.15.4', 
            'all'
        );

        //Libreria de bootstrap 5
        wp_enqueue_style(
            'bootstrap-css',
            ATR_DIR_URI . 'helpers/bootstrap-5.1.3/css/bootstrap.min.css',
            ['storefront-woocommerce-style'],
            '5.1.3',
            'all'
        );

        wp_enqueue_style( 
            'public-css', 
            ATR_DIR_URI . 'public/css/atr-public.css', 
            array('storefront-woocommerce-style'), 
            '1.0.0', 
            'all' 
        );

    }

    
    public function enqueue_scripts(){
    
        wp_enqueue_script( 
            'public-js', 
            ATR_DIR_URI . 'public/js/atr-public.js', 
            ['jquery', 'bootstrap-min'], 
            '1.0.0', 
            true 
        );
    
         //Encolando libreria de bootstrap
         wp_enqueue_script(
            'bootstrap-min',
            ATR_DIR_URI . 'helpers/bootstrap-5.1.3/js/bootstrap.min.js',
            ['jquery'],
            '5.1.3',
            true
        );

        /**
         * libreria fontawesome
         * https://fontawesome.com/download
         */
        wp_enqueue_script(
            'fontawesome-js', 
            ATR_DIR_URI . 'helpers/fontawesome-6.1.1/js/fontawesome.min.js', 
            array(), 
            '5.3.1', 
            true 
        );

        wp_enqueue_script(
            'regular-js', 
            ATR_DIR_URI . 'helpers/fontawesome-6.1.1/js/regular.min.js', 
            array(), 
            '5.3.1', 
            true 
        );

        wp_enqueue_script(
            'solid-js', 
            ATR_DIR_URI . 'helpers/fontawesome-6.1.1/js/solid.min.js', 
            array(), 
            '5.3.1', 
            true 
        );

        //localize script export var php
        wp_localize_script(
            'public-js',
            'menuicons',
            array(
                'urls' => [
                    get_permalink(get_option('woocommerce_myaccount_page_id')),
                    get_permalink(get_option('woocommerce_checkout_page_id'))
                ],
                'user' => (is_user_logged_in()) ? wp_get_current_user()->user_firstname : ''
            )
        );
    
    }

    /**
     * Aquí cargaremos algunas funciones para ajustar el menú frontend
     */
    public function atr_theme_support(){

    }

    public function atr_register_sidebars(){
        /**
         * sidebar para el blog
         */
        register_sidebar(array(
            'name' => __('Sidebar Blog', 'weko'),
            'id' => __('blog', 'weko'),
            'description' => __('sidebar para el blog', 'weko'),
            'before_widget' => '<div class="%1$s" id="widget-blog">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-blog">',
            'after_title' => '</h3>'
        ));

    }

    public function atr_header_carrousel(){
        include( 'partials/header-carrousel.php' );
    }

    public function atr_footer_widgets_column(){
        return 3;
    }

    public function atr_before_page_content(){
        include('partials/frontpage-content.php');
    }

    public function add_post_class_blog($classes){

        if(is_home() !== true){
            return $classes;
        }

        $classes[] = 'col-sm-6';
        return $classes;

    }

    public function atr_add_product_description( $category ){

        $description = $category->description;
        $output = '<p class="cat_description">'.$description.'</p>';
        $output .= '</div>';
        echo $output;
        // var_dump($category);

    }

    public function atr_add_html_product_description( $category ){

        $output = '<div class="contain_cat_description">';
        echo $output;

    }

    public function atr_add_reviews_cart($cart_item){

        //var_dump($cart_item['product_id']);
        $id = $cart_item['product_id'];
        $producto = new WC_Product($id);
        $startValue = (int) $producto->average_rating;
        $totalReviews = $producto->review_count;

        //echo gettype($startValue), "\n";

        //se muestran las estrellas si hay una calificación
        if( $startValue > 0 ){
            echo '<br>';
            $this->atr_startValue($startValue);
        }

        //Se indican la cantidad de reseñas
        if( $totalReviews > 0 ){
            echo '<br>';

            //Función plural - singular _n()
            printf(
                _n('%s reseña', '%s reseñas', $totalReviews, 'storefront'),
                $totalReviews
            );

        }else{

            echo "<br>";
            echo 'No hay reseñas';

        }

    }

    public function atr_startValue($startValue){

        $startBlack     = 5 - $startValue;
        $startYellow    = $startValue;

        for($i = 0; $i<$startYellow; $i++){
            echo '<span class="start-yellow"><i class="fa-solid fa-star"></i></span>';
        }

        for($i = 0; $i<$startBlack; $i++){
            echo '<span class="start-black"><i class="fa-solid fa-star"></i></span>';
        }

    }

    public function atr_new_position_collaterals_products(){

        $collateralProducts = woocommerce_cross_sell_display( 4, 4, 'rand', 'desc' );
        return $collateralProducts;

    }

    public function atr_add_title_current_page_top_header(){

        if(!is_front_page()){

            $id = get_the_ID();
            $title = '';

            if(is_home()){
                $title = 'Blog';
            }else{
                $title = get_the_title($id);
            }

            $output = '<div class="top-header-title d-block d-md-none"><h2>'.$title.'</h2></div>';
            echo $output;

        }

    }

    public function atr_my_account_menu_order(){
        $menu_order = array(
            'dashboard'         => __('Dashboard', 'woocommerce'),
            'edit-account'      => __('Detalles de la cuenta', 'woocommerce'),
            'edit-address'      => __('Addresses', 'woocommerce'),
            'orders'            => __('Orders', 'woocommerce'),
            'downloads'         => __('Downloads', 'woocommerce'),
            'datos'             => __('Datos', 'woocommerce'),
            'soporte'           => __('Soporte', 'woocommerce'),
            'customer-logout'   => __('Logout', 'woocommerce')
        );

        return $menu_order;
    }

    public function atr_my_account_new_endpoints(){

        add_rewrite_endpoint('datos', EP_ROOT | EP_PAGES);
        add_rewrite_endpoint('soporte', EP_ROOT | EP_PAGES);

        //Elimina las reglas de reescritura y luego las crea
        flush_rewrite_rules();

    }

    public function atr_datos_endpoint_content(){
        get_template_part( 'public/partials/datos' );
    }

    public function atr_soporte_endpoint_content(){
        get_template_part( 'public/partials/soporte' );
    }

}
