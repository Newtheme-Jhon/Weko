<?php 
class ATR_Users{

    public function atr_new_user_data_client(){

        //User email
        $email = 'maria@maria.com';
        $user = new WP_User($email);
        //var_dump($user->exists());

        if ($user->exists() === true){
            //echo "El usuario con este email ya existe";
        }else{
            $this->atr_wp_user_insert($email);
        }

    }

    public function atr_wp_user_insert($email){

        //insert data user
        $userdata = [
            'user_login'        => $email,
            'user_pass'         => wp_generate_password( 18, false ),
            'user_email'        => $email,
            'first_name'        => 'Luz Maria',
            'last_name'         => 'Cano',
            'user_url'          => '',
            'description'       => '',
            'role'              => 'customer'
        ];

        // Validamos de nuevo si existe el usuario
        $user_id    = username_exists( $userdata['user_login'] );
        $user_email = email_exists( $userdata['user_email'] );

        if ( !$user_id && $user_email === false ){

            $cliente = wp_insert_user( $userdata );
            $this->atr_insert_data_customer( $cliente );

            if ( ! is_wp_error( $user_id ) ){

                //se envia email
                wp_mail(
                    $userdata['user_email'],
                    '!Bienvenido!',
                    "Su contraseña es : {$userdata['user_pass']}"
                );

            }

        }

    }

    public function atr_insert_data_customer( $cliente ){

        //Datos
        $datos = [
            'direccion'         => 'Calle San Ramon 47 Bloque 4 Piso 3 Puerta 2',
            'codigo_postal'     => 43130,
            'nombre'            => 'Luz Maria',
            'apellidos'         => 'Cano',
            'pais'              => 'ES',
            'provincia'         => 'Tarragona',
            'municipio'         => 'Salou',
            'telefono'          => 659443322,
        ];

        //datos de pedido del cliente
        update_user_meta( $cliente, 'billing_address_1', $datos['direccion'] );
        update_user_meta( $cliente, 'billing_address_2', $datos['direccion'] );
        update_user_meta( $cliente, 'billing_postcode', $datos['codigo_postal'] );
        update_user_meta( $cliente, 'billing_first_name', $datos['nombre'] );
        update_user_meta( $cliente, 'billing_last_name', $datos['apellidos'] );
        update_user_meta( $cliente, 'billing_country', $datos['pais'] );
        update_user_meta( $cliente, 'billing_state', $datos['provincia'] );
        update_user_meta( $cliente, 'billing_city', $datos['municipio'] );
        update_user_meta( $cliente, 'billing_phone', $datos['telefono'] );

        //datos de envio del cliente
        update_user_meta( $cliente, 'shipping_address_1', $datos['direccion'] );
        update_user_meta( $cliente, 'shipping_address_2', $datos['direccion'] );
        update_user_meta( $cliente, 'shipping_postcode', $datos['codigo_postal'] );
        update_user_meta( $cliente, 'shipping_first_name', $datos['nombre'] );
        update_user_meta( $cliente, 'shipping_last_name', $datos['apellidos'] );
        update_user_meta( $cliente, 'shipping_country', $datos['pais'] );
        update_user_meta( $cliente, 'shipping_state', $datos['provincia'] );
        update_user_meta( $cliente, 'shipping_city', $datos['municipio'] );
        update_user_meta( $cliente, 'shipping_phone', $datos['telefono'] );

    }

}