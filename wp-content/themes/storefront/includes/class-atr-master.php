<?php

class ATR_Master {

    protected $cargador;
    protected $theme_name;
    protected $version;

    public function __construct() {
        
        $this->theme_name = 'weko';
        $this->version = '1.0.0';
        
        $this->cargar_dependencias();
        $this->cargar_instancias();
        $this->set_idiomas();
        $this->definir_admin_hooks();
        $this->definir_public_hooks();
    }

    private function cargar_dependencias() {

         /**
		 * La clase responsable de iterar las acciones y 
         * filtros del núcleo del theme.
		 */
        require_once ATR_DIR_PATH . 'includes/class-atr-cargador.php';
        
        /**
		 * La clase responsable de definir la funcionalidad de la
         * internacionalización del theme
		 */
        require_once ATR_DIR_PATH . 'includes/class-atr-i18n.php';
        
        /**
         * La clase responsable de registrar menús y submenús
         * en el área de administración
         */
        require_once ATR_DIR_PATH . 'includes/class-atr-build-menupage.php';
        
        /**
		 * La clase responsable de definir todas las acciones en el
         * área de administración
		 */
        require_once ATR_DIR_PATH . 'admin/class-atr-admin.php';
        
        /**
		 * La clase responsable de definir todas las acciones en el
         * área del lado del cliente/público
		 */
        require_once ATR_DIR_PATH . 'public/class-atr-public.php';

        /**
         * La clase responsable de crear nuevos widgets
         * widgets personalizados para un sidebar
         */
        require_once ATR_DIR_PATH . 'includes/class-atr-widgets.php';

        /**
         * La clase responsable de crear los cpt
         * Custom Post Types
         */
        require_once ATR_DIR_PATH . 'includes/class-atr-cpt.php';

        /**
         * La clase responsable de crear los Metaboxes
         */
        require_once ATR_DIR_PATH . 'includes/class-atr-metaboxes.php';

        /**
         * La clase responsable de crear consultas a la BBDD
         */
        require_once ATR_DIR_PATH . 'includes/class-atr-database.php';

        /**
         * En esta clase se cargara la libreria CMB2
         */
        require_once ATR_DIR_PATH . 'includes/class-atr-cmb2.php';

        /**
         * En esta clase manejaremos el sistema de verificación de usuarios
         */
        require_once ATR_DIR_PATH . 'includes/class-atr-users.php';
        

    }

    private function set_idiomas() {
        
        $atr_i18n = new ATR_i18n();
        $this->cargador->add_action( 'after_setup_theme', $atr_i18n, 'load_theme_textdomain' );
        
    }

    //Metodo para los widgets
    public function registro_widgets(){

        register_widget('ATR_Widgets');

    }
    

    private function cargar_instancias() {
        
        /**
         * Cree una instancia del cargador que se utilizará para 
         * registrar los ganchos con WordPress.
         */
        $this->cargador     	    = new ATR_Cargador;
        $this->atr_admin    	    = new ATR_Admin( $this->get_theme_name(), $this->get_version() );
        $this->atr_public   	    = new ATR_Public( $this->get_theme_name(), $this->get_version() );
        $this->atr_cpt   	        = new ATR_CPT();
        $this->atr_metaboxes   	    = new ATR_Metaboxes;
        $this->atr_database   	    = new ATR_Database;
        $this->atr_cmb2   	        = new ATR_CMB2;
        $this->atr_users   	        = new ATR_Users;
        
    }

    private function definir_admin_hooks() {

        //Encolamiento archivos cssy js
        $this->cargador->add_action( 'admin_enqueue_scripts', $this->atr_admin, 'enqueue_styles' );
        $this->cargador->add_action( 'admin_enqueue_scripts', $this->atr_admin, 'enqueue_scripts' );

        //añadiendo menú al administrador
        $this->cargador->add_action( 'admin_menu', $this->atr_admin, 'add_menu' );

        //Gancho para widgets
        //$this->cargador->add_action( 'widgets_init', $this, 'registro_widgets' );

        //Gancho para CPT
        $this->cargador->add_action( 'init', $this->atr_cpt, 'atr_cpt_weko' );
        $this->cargador->add_action( 'init', $this->atr_cpt, 'atr_taxonomia_weko' );

        //Ganchos CMB2
        $this->cargador->add_action( 'cmb2_admin_init', $this->atr_cmb2, 'atr_cmb2_metaboxes' );

        //Carrousel
        $this->cargador->add_action( 'after_setup_theme', $this->atr_admin, 'weko_add_options_carrousel' );

        //Ajax carrousel
        $this->cargador->add_action( 'wp_ajax_weko_update_options_carrousel', $this->atr_admin, 'weko_update_options_carrousel' );

        //Servicios
        $this->cargador->add_action( 'after_setup_theme', $this->atr_admin, 'weko_add_options_servicios' );

        //Ajax servicios
        $this->cargador->add_action( 'wp_ajax_weko_update_options_servicios', $this->atr_admin, 'weko_update_options_servicios' );

        //Addb user data
        $this->cargador->add_action( 'init', $this->atr_users, 'atr_new_user_data_client' );

    }

    private function definir_public_hooks() {

        $this->cargador->add_action( 'wp_enqueue_scripts', $this->atr_public, 'enqueue_styles' );
        $this->cargador->add_action( 'wp_enqueue_scripts', $this->atr_public, 'enqueue_scripts' );

        //add menu frontend
        $this->cargador->add_action( 'init', $this->atr_public, 'atr_theme_support' );

        //Registro de sidebars
        $this->cargador->add_action('init', $this->atr_public, 'atr_register_sidebars');

        //footer filters
        $this->cargador->add_filter('storefront_footer_widget_columns', $this->atr_public, 'atr_footer_widgets_column');

        //filter page storefront
        $this->cargador->add_filter('storefront_before_content', $this->atr_public, 'atr_before_page_content');

        $this->cargador->add_filter('post_class', $this->atr_public, 'add_post_class_blog');

        //add cat description
        $this->cargador->add_action('woocommerce_after_subcategory_title', $this->atr_public, 'atr_add_product_description');
        $this->cargador->add_action('woocommerce_before_subcategory_title', $this->atr_public, 'atr_add_html_product_description');

        //Add reviews page cart
        $this->cargador->add_action('woocommerce_after_cart_item_name', $this->atr_public, 'atr_add_reviews_cart');

        //new position cross-selling products
        $this->cargador->add_action('woocommerce_after_cart', $this->atr_public, 'atr_new_position_collaterals_products');

        //Add title current page
        $this->cargador->add_action('storefront_header', $this->atr_public, 'atr_add_title_current_page_top_header');

        //Modifications my account
        $this->cargador->add_action('woocommerce_account_menu_items', $this->atr_public, 'atr_my_account_menu_order');

        //Add endpoints
        $this->cargador->add_action('init', $this->atr_public, 'atr_my_account_new_endpoints');

        //Add endpoint datos y soporte
        $this->cargador->add_action('woocommerce_account_datos_endpoint', $this->atr_public, 'atr_datos_endpoint_content');
        $this->cargador->add_action('woocommerce_account_soporte_endpoint', $this->atr_public, 'atr_soporte_endpoint_content');

    }

    public function get_theme_name() {
        return $this->theme_name;
    }

    public function get_version() {
        return $this->version;
    }

    public function get_cargador() {
        return $this->cargador;
    }

    public function run() {
        $this->cargador->run();
    }

}