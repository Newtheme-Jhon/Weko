$ = jQuery.noConflict();

$(document).ready(function(){

    //Aquí nuestro código
    $('.home header div').first().addClass('col-superior');
    $('.home header div.storefront-primary-navigation div').addClass('col-inferior');

})

//Background menú animate
window.onscroll = function(){
    var y = window.scrollY;
    //console.log(y);
    if(y > 0){
        var menu = document.querySelector('#masthead');
        menu.classList.add('backgroundMenuAnimate');
    }else{
        var menu = document.querySelector('#masthead');
        menu.classList.remove('backgroundMenuAnimate');
    }
}

//add class main blogs
function blog(){
    let objeto = document.querySelector(".blog #main");
    objeto.classList.add("row");
}

//bucle for activate functions
const page = document.querySelector("body").classList;
for(let i=0; i < page.length; i++){

    let objectPage = page[i];
    //console.log(blog);

    if(objectPage == 'blog'){
        blog();
    }

    if(objectPage == 'home'){
        home_products();
    }

    if(objectPage == 'single-product'){
        related_products();
    }

    if(objectPage == 'woocommerce-cart'){
        cross_selling_products();
    }

    if(objectPage == 'search-results'){
        search_results_products();
    }

    if(objectPage == 'archive'){
        archive_products();
    }
    
}

//Add class block products woocommerce
function home_products(){

    let divProducts = document.querySelectorAll(".home .storefront-product-section .woocommerce");
    for( let i=0; i < divProducts.length; i++ ){
        divProducts[i].classList.add('container');
        //console.log(divProducts[i].classList);
    }

    let ulProducts = document.querySelectorAll(".home .storefront-product-section .woocommerce .products");
    for( let i=0; i < ulProducts.length; i++ ){
        ulProducts[i].classList.add('row');
    }

    let liProduct = document.querySelectorAll(".home .storefront-product-section .woocommerce .products .product");
    for( let i=0; i < liProduct.length; i++ ){
        liProduct[i].classList.add('col-sm-6', 'col-md-6', 'col-lg-4', 'col-xl-3');
    }

}

//Add class block related products woocommerce
function related_products(){

    let divProducts = document.querySelectorAll(".product-template-default .related");
    for( let i=0; i < divProducts.length; i++ ){
        divProducts[i].classList.add('container');
    }

    let ulProducts = document.querySelectorAll(".product-template-default .related .products");
    for( let i=0; i < ulProducts.length; i++ ){
        ulProducts[i].classList.add('row');
    }

    let liProduct = document.querySelectorAll(".product-template-default .related .products .product");
    for( let i=0; i < liProduct.length; i++ ){
        liProduct[i].classList.add('col-sm-6', 'col-md-6', 'col-lg-4', 'col-xl-3');
    }

}

//Add class block cross-selling products woocommerce
function cross_selling_products(){

    let divProducts = document.querySelectorAll(".woocommerce-cart .cross-sells");
    for( let i=0; i < divProducts.length; i++ ){
        divProducts[i].classList.add('container');
    }

    let ulProducts = document.querySelectorAll(".woocommerce-cart .cross-sells .products");
    for( let i=0; i < ulProducts.length; i++ ){
        ulProducts[i].classList.add('row');
    }

    let liProduct = document.querySelectorAll(".woocommerce-cart .cross-sells .products .product");
    for( let i=0; i < liProduct.length; i++ ){
        liProduct[i].classList.add('col-sm-6', 'col-md-6', 'col-lg-4', 'col-xl-3');
    }

}

//Add class search results
function search_results_products(){

    let divProducts = document.querySelectorAll(".search-results .site-main");
    for( let i=0; i < divProducts.length; i++ ){
        divProducts[i].classList.add('container');
    }

    let ulProducts = document.querySelectorAll(".search-results .site-main .products");
    for( let i=0; i < ulProducts.length; i++ ){
        ulProducts[i].classList.add('row');
    }

    let liProduct = document.querySelectorAll(".search-results .site-main .products .product");
    for( let i=0; i < liProduct.length; i++ ){
        liProduct[i].classList.add('col-sm-6', 'col-md-6', 'col-lg-4', 'col-xl-3');
    }

}

//Add class category page
function archive_products(){

    let divProducts = document.querySelectorAll(".archive .site-main");
    for( let i=0; i < divProducts.length; i++ ){
        divProducts[i].classList.add('container');
    }

    let ulProducts = document.querySelectorAll(".archive .site-main .products");
    for( let i=0; i < ulProducts.length; i++ ){
        ulProducts[i].classList.add('row');
    }

    let liProduct = document.querySelectorAll(".archive .site-main .products .product");
    for( let i=0; i < liProduct.length; i++ ){
        liProduct[i].classList.add('col-sm-6', 'col-md-6', 'col-lg-4', 'col-xl-3');
    }

}

$(document).ready(function(){

    const menuItem = document.querySelectorAll("#menu-menu-secundario li a");

    //var urls import js
    const urls = menuicons.urls;

    //var user import js
    const user = menuicons.user;
    console.log(user);

    $('#menu-menu-secundario li a').css('display', 'block');

    for(let i=0; i<menuItem.length; i++){

        let url = menuItem[i].href;
        let objeto;

        if(url == urls[0]){

            objeto = $('#menu-menu-secundario li a[href="'+url+'"]');
            objeto.html('<span class="icon"><i class="fa-solid fa-user-large"></i></span> '+user+'');
        }

        if(url == urls[1]){

            objeto = $('#menu-menu-secundario li a[href="'+url+'"]');
            objeto.html('<span class="icon"><i class="fa-solid fa-money-check-dollar"></i></span>');
        }

    }

})