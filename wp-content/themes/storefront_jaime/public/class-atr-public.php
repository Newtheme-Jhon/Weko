<?php

class ATR_Public {

    private $theme_name;
    private $version;

    public function __construct( $theme_name, $version ) {
        
        $this->theme_name = $theme_name;
        $this->version = $version;
    }

    public function enqueue_styles(){
    
        wp_enqueue_style( 
            'public-css', 
            ATR_DIR_URI . 'public/css/atr-public.css', 
            array(), 
            '1.0.0', 
            'all' 
        );
    
        //Libreria de bootstrap 5
        wp_enqueue_style(
            'bootstrap-css',
            ATR_DIR_URI . 'helpers/bootstrap-5.1.3/css/bootstrap.min.css',
            [],
            '5.1.3',
            'all'
        );
    
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
}
