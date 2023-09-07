$ = jQuery.noConflict();

//variables globales Marco multimedia
let marco;
let imgSelect = document.querySelectorAll('.block-02 #imgSelect');
let imagen = $('.campo-imagen .imagen img');
//console.log(imgSelect);

//Marco multimedia
$(document).ready(function(){

    for( let i=0; i < imgSelect.length; i++ ){

        imgSelect[i].onclick = function(e){

            marco = wp.media({
                frame: 'select',
                title: 'Seleccione una imagen para el carrousel',
                button: {
                    text: 'Usar esta imagen'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            //get url image
            marco.on('select', function(){
                const imgCarrousel = marco.state().get('selection').first().toJSON();
                const nuevaUrl = limpiar_ruta(imgCarrousel.url);
                imgSelect[i].value = nuevaUrl;
                imagen[i].src = nuevaUrl;
            })

            marco.open();
        }
    }
    
})

//Limpiar url
function limpiar_ruta(url){

    //servidor local
    const local = /localhost/;

    if( local.test(url) ){

        //Devuelve la url Actual
        const ruta_url = location.pathname;
        const indexPost = ruta_url.indexOf('wp-admin');
        const url_post = ruta_url.slice(0, indexPost);
        const url_delete = location.protocol + '//' + location.host + url_post;
        //console.log(url_delete);
        return url_post + url.replace(url_delete, '');

    }else{
        //Servidor remoto
        const url_servidor_remoto = location.protocol + '//' + location.hostname;
        return url.replace(url_servidor_remoto, '');
    }
}

//Ajax Carrousel
$(document).ready(function(){

    let btnSave = $('.page-edit-carrousel .buttonsActions #btnSave');

    btnSave.on('click', function(e){

        e.preventDefault();
        let imagenes = document.querySelectorAll('.campo-imagen .imagen img');
        //console.log(imagenes);

        let objetoImagenes = [];

        for( let i=0; i<imagenes.length; i++ ){
            objetoImagenes[i] = imagenes[i].currentSrc;
        }

        //console.log(objetoImagenes);

        //Aquí el método Ajax
        $.ajax({
            url: data_carrousel.url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'weko_update_options_carrousel',
                nonce: data_carrousel.seguridad,
                objeto: data_carrousel.objeto,
                objeto_u: objetoImagenes,
                tipo: 'update'
            },
            success: function(response){
                //console.log(response);
            }
        });

    })
})

//Botón para volver atrás
$(document).ready(function(){

    $('.block-02 #btnBack').on('click', function(e){
        e.preventDefault();
        location.href = "?page=res_options_page";
    });

})

//Ajax servicios
$(document).ready(function(){

    let btnSave = $('.page-edit-servicios .buttonsActions #btnSave');

    btnSave.on('click', function(e){

        e.preventDefault();

        //Indices de array
        let icon        = document.querySelectorAll('.page-edit-servicios .card-body #icon');
        let titulo      = document.querySelectorAll('.page-edit-servicios .card-body #titulo');
        let content     = document.querySelectorAll('.page-edit-servicios .card-body #textServicio');

        let dataObjeto = [];

        for( let i=0; i<icon.length; i++ ){

            let iconUpdate      = icon[i].value;
            let titleUpdate     = titulo[i].value;
            let contentUpdate   = content[i].value;

            //En el icon remplazamos comillas dobles por simples
            dataObjeto[i] = {
                icon: iconUpdate,
                title: titleUpdate,
                content: contentUpdate
            }

        }

        //console.log(dataObjeto);

        //Aquí el método Ajax
        $.ajax({
            url: data_servicios.url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'weko_update_options_servicios',
                nonce: data_servicios.seguridad,
                objeto: data_servicios.objeto,
                objeto_u: dataObjeto,
                tipo: 'update'
            },
            success: function(response){
                //console.log(response);

                if( response.result == true ){
                    alert('Datos Guardados');
                }
            }
        });

    });

})