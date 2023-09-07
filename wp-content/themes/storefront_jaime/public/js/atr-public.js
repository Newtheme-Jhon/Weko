$ = jQuery.noConflict();

$(document).ready(function(){

    //Aquí nuestro código

})

// background para animar el menu
window.onscroll = function(){
    var y = window.scrollY;
    //console.log(y);
    if(y > 0){
        var menu = document.querySelector('#masthead');
        menu.classList.add('backgroundMenuAnimate');  //aqui añadimos una clase a este objecto #masthead 
                                                        // que es el contenedor donde esta el nav
    }else{
        var menu = document.querySelector('#masthead');
        menu.classList.remove('backgroundMenuAnimate');
    }    
}
