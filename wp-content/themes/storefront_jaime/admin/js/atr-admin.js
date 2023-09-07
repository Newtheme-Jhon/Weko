$ = jQuery.noConflict();

//Variables globales Marco multimedia
let marco;
let imgSelect = document.querySelectorAll('.block-02 #imgSelect');
let imagen = $('.campo-imagen .imagen img');
//console.log(imgSelect);

//Marco Multimedia
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

            // get url imagen
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


// Limpiar url
function limpiar_ruta(url){
    
    //servidor local
    const local = /localhost/;

    if( local.test(url) ){
        //devuleve la url actual
        const ruta_url = location.pathname;
        const indexPost = ruta_url.indexOf('wp-admin');
        const url_post = ruta_url.slice(0, indexPost);
        const url_delete = location.protocol + '//' + location.host + url_post;
        //console.log(url_delete);
        return url_post + url.replace(url_delete, '');
    }else{
        // servidor remoto
        const url_servidor_remoto = location.protocol + '//' + location.hostname;
        return url.replace(url_servidor_remoto, '');
    }
}

// ajax carrousel
$(document).ready(function(){

    let btnSave = $('.page_edit_carrousel .buttonsActions #btnSave');
    
    btnSave.on('click', function(e){
        //alert(1)
        e.preventDefault();
        let imagenes = document.querySelectorAll('.campo-imagen .imagen img');
        //console.log(imagenes);

        let objetoImagenes = [];

        for( let i=0; i<imagenes.length; i++ ){
            objetoImagenes[i] = imagenes[i].currentSrc;
        }

        // console.log(objetoImagenes);
        // aqui el metodo ajax
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
                console.log(response);
            }
        });
    })
})

//Boton para volver atras
$(document).ready(function(){
    $(' .block-02 #btnBack').on('click',function(e){
        e.preventDefault();//este metodo lo que hace es detener la propagacion del evento lo que hace por defaul que es refrescar la pagina
        location.href = "?page=res_options_page";
    });
})