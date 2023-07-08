<template>
    <!--== Start Header Wrapper ==-->
    <header class="header-area sticky-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-5 col-lg-2 col-xl-1">
                    <div class="header-logo">
                        <router-link to="/">
                            <img class="logo-main" src="/images/logo.webp" width="95" height="68" alt="Logo" />
                        </router-link>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-10 d-none d-lg-block">
                    <div class="header-navigation ps-7">
                        <main_menu></main_menu>
                    </div>
                </div>
                <div class="col-7 col-lg-1 col-xl-1">
                    <div class="header-action justify-content-end">
                        <!--search bar-->
                        <button
                            class="header-action-btn ms-0"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#AsideOffcanvasSearch"
                            aria-controls="AsideOffcanvasSearch"
                        >
                                <span class="icon">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect class="icon-rect" width="30" height="30" fill="url(#pattern1)"/>
                                        <defs>
                                            <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                <use xlink:href="#image0_504:11" transform="scale(0.0333333)"/>
                                            </pattern>
                                            <image id="image0_504:11" width="30" height="30" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABiUlEQVRIie2Wu04CQRSGP0G2EUtIbHwA8B3EQisLIcorEInx8hbEZ9DKy6toDI1oAgalNFpDoYWuxZzJjoTbmSXERP7kZDbZ859vdmb27MJcf0gBUAaugRbQk2gBV3IvmDa0BLwA4Zh4BorTACaAU6fwPXAI5IAliTxwBDScvJp4vWWhH0BlTLEEsC+5Fu6lkgNdV/gKDnxHCw2I9rSiNQNV8baBlMZYJtpTn71KAg9SY3dUYn9xezLPgG8P8BdwLteq5X7CzDbnAbXKS42WxtQVUzoGeFlqdEclxXrnhmhhkqR+8KuMqzHA1vumAddl3IwB3pLxVmOyr1NjwKQmURJ4lBp7GmOAafghpg1qdSDeDrCoNReJWmZB4dsAPsW7rYVa1Rx4FbOEw5TEPKmFvgMZX3DCgYeYNniMaQ5piTXghGhPLdTmZ33hYNpem98f/UHRwSxvhqhXx4anMA3/EmhiOlJPJnSBOb3uQcpOE65VhujPpAms/Bu4u+x3swRbeB24mTV4LgB+AFuLedkPkcmmAAAAAElFTkSuQmCC"/>
                                        </defs>
                                    </svg>
                                </span>
                        </button>
                        <!--cart bar-->
                        <button
                            @click="cartProduct"
                            class="header-action-btn position-relative"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#AsideOffcanvasCart"
                            aria-controls="AsideOffcanvasCart"
                        >
                            <span class="icon">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect  class="icon-rect" width="30" height="30" fill="url(#pattern2)"/>
                                    <defs>
                                        <pattern id="pattern2" patternContentUnits="objectBoundingBox" width="1" height="1" >
                                            <use  xlink:href="#image0_504:9" transform="scale(0.0333333)"/>
                                        </pattern>
                                        <image  id="image0_504:9" width="30" height="30" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABFUlEQVRIie2VMU7DMBSGvwAqawaYuAmKxCW4A1I5Qg4AA93KBbp1ZUVUlQJSVVbCDVhgzcTQdLEVx7WDQ2xLRfzSvzzb+d6zn2MYrkugBBYevuWsHKiFn2JBMwH8Bq6Aw1jgBwHOYwGlPgT4LDZ4I8BJDNiEppl034UEJ8DMAJ0DByHBACPgUYEugePQUKkUWAmnsaB/Ry/YO9aXCwlT72AdrqaWEohwBWxSwc8ReIVtYIr5bM5pXqO+Men7rozGlkVSv4lJj1WQfsbvXVkNVNk1eEK4ik9/yuwzAPhLh5iuU4jtftMDR4ZJJXChxTJ2H3zXGDgWc43/X2Wro8G81a8u2fXU2nXiLVAxvNIKuPGW/r/2SltF+a3Rkw4pmwAAAABJRU5ErkJggg=="/>
                                    </defs>
                                </svg>
                            </span>
                            <span v-if="cart_products_count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{cart_products_count}}
                            </span>
                        </button>
                        <!--wishlist bar-->
                        <router-link class="header-action-btn position-relative" to="/wish-list">
                            <span class="icon">
                                <svg id="svg1" class='lab__container__elt2__svg' xmlns="http://www.w3.org/2000/svg" version="1.1" width="30" height="30" viewBox="0 0 500 500">
                                    <defs>
                                        <linearGradient id="gradient" :x1="wish_list_count ? 1+'%' : 0+'%'" y1="100%" x2="0%" y2="100%">
                                              <stop class="color1" offset="0" stop-color="#FF6565">
                                                <animate attributeName="offset" begin="svg1.click" dur="1s"  fill="freeze" from="0" to="1" />
                                              </stop>
                                              <stop class="color2" offset="0" stop-color="#fff">
                                                <animate attributeName="offset" begin="svg1.click" dur="1s"  fill="freeze" from="0" to="1" />
                                              </stop>
                                        </linearGradient>
                                    </defs>
                                    <path fill="url(#gradient)" stroke="black" stroke-width="40" stroke- d="M340.8,98.4c50.7,0,91.9,41.3,91.9,92.3c0,26.2-10.9,49.8-28.3,66.6L256,407.1L105,251.6c-15.8-16.6-25.6-39.1-25.6-63.9 c0-51,41.1-92.3,91.9-92.3c38.2,0,70.9,23.4,84.8,56.8C269.8,121.9,302.6,98.4,340.8,98.4"/>
                                </svg>
                            </span>
                            <span v-if="wish_list_count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{wish_list_count}}
                            </span>
                        </router-link>
                        <!--login page-->
                        <router-link v-if="!access_token" class="header-action-btn" to="/login">
                            <span class="icon">
                                  <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect class="icon-rect" width="30" height="30" fill="url(#pattern3)"/>
                                    <defs>
                                      <pattern id="pattern3" patternContentUnits="objectBoundingBox" width="1" height="1">
                                        <use xlink:href="#image0_504:10" transform="scale(0.0333333)"/>
                                      </pattern>
                                      <image id="image0_504:10" width="30" height="30" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAABEUlEQVRIie3UMUoDYRDF8Z8psqUpLBRrBS+gx7ATD6E5iSjeQQ/gJUzEwmChnZZaKZiQ0ljsLkhQM5/5Agr74DX7DfOfgZ1Hoz+qAl30Marcx2H1thCtY4DJN76parKqmAH9DM+6eTcArX2QE3yVAO7lBA8TwMNIw6UgeJI46My+rWCjUQL0LVIUBd8lgEO1UfBZAvg8oXamCuWNRu64nRNMmUo/wReSXLXayoDoKc9miMvqW/ZNG2VRNLla2MYudrCFTvX2intlnl/gGu/zDraGYzyLZ/UTjrD6G2AHpxgnAKc9xgmWo9BNPM4BnPYDNiLg24zQ2oNpyFdZvRKZLlGhnvvKPzXXti/Yy7hEo3+iD9EHtgdqxQnwAAAAAElFTkSuQmCC"/>
                                    </defs>
                                  </svg>
                            </span>
                        </router-link>
                        <button v-else
                            class="header-action-btn user-in"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#AsideOffcanvasUserLogin"
                            aria-controls="AsideOffcanvasUserLogin"
                        >
                            <span class="icon">
                                <img src="/images/auth-user.png" width="28" alt="">
                            </span>
                        </button>
                        <button class="header-menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasMenu" aria-controls="AsideOffcanvasMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--== End Header Wrapper ==-->

    <router-view
        :addToCart="addToCart"
        :addToWishList="addToWishList"
        v-bind:search_result = "search_result"
        :search_req = "search_req"
        @countStatus="wishListCount"
        @countStatusCart = "getTotalPrice"
        @statusLogin = "getAccessToken"
        @logout_status = "logoutStatus($event)"
        @success_checkout = "checkout($event)"
    />

    <!--== Start Footer Area Wrapper ==-->
    <footer_block :access_token="access_token" @logout_status="logoutStatus($event)"></footer_block>
    <!--== End Footer Area Wrapper ==-->

    <search_bar  @search_req="getSearchReq($event)"></search_bar>
    <aside_user_login v-if="access_token" @logout_status="logoutStatus($event)"></aside_user_login>
    <aside_cart :products="cart_products" :totalPrice="totalPrice" @removeId="removeCartProduct($event)"></aside_cart>
</template>

<script>
    import Api from '../api.js';
    import axios from "axios";
    import main_menu from "./elements/_main_menu.vue";
    import search_bar from "./elements/search_bar.vue";
    import aside_cart from "./elements/aside_cart.vue";
    import aside_user_login from "./elements/aside_user_login.vue";
    import footer_block from './elements/footer/index.vue';
    export default {
        name: "IndexComponent",
        data(){
            return {
                category: [],
                cart_products: [],
                totalPrice: 0,
                cart_products_count: 0,
                wish_list_count: 0,
                access_token: null,
                search_result: null,
                search_req: null
            }
        },
        components:{
            main_menu,
            search_bar,
            aside_cart,
            aside_user_login,
            footer_block
        },
        mounted() {


            this.loadCategories();
            this.cartProduct();
            this.wishListCount();
            this.getAccessToken();
            $(document).trigger('change');
        },
        methods:{

            getUser(){
                Api.post('/api/auth/get-auth-user').then(response => {
                    this.user = response.data.user;
                    this.orders = response.data.orders;
                    this.address = response.data.address;
                    this.name = response.data.user ? response.data.user.name : null;
                    this.surname = response.data.user ? response.data.user.surname : null;
                    this.phone = response.data.user ? response.data.user.phone : null;
                    this.email = response.data.user ? response.data.user.email : null;
                    this.avatar = response.data.user ? response.data.user.avatar : null;

                    //get file to dropzone
                    let file = { name: this.user.avatar, size: response.data.size };
                    this.avatar_dropzone.displayExistingFile(file, this.user.avatar_url);
                })
            },
            getAccessToken(){
                this.access_token = localStorage.getItem('access_token')
            },
            loadCategories(){
                Api.get('/api/menu')
                    .then(res=>{
                        this.category =  res.data;
                    })
            },
            /*cart product*/
            addToCart(product, isSingle, isModal){
                let qty = 0;
                if(isSingle)
                    qty = 1;
                else{
                    qty = isModal ? $('.modal-qty-value').val() :  $('.qty-value').val();
                }

                let cart = localStorage.getItem('cart');
                $('.qty-value').val(1);
                $('.modal-qty-value').val(1);
                let newProduct = [
                    {
                        'product': product,
                        'qty': qty,
                    }
                ];

                if(!cart){
                    localStorage.setItem('cart', JSON.stringify(newProduct));
                }else{
                    cart = JSON.parse(cart);
                    cart.forEach(productInCart=>{
                        if(productInCart.product.id === product.id){
                            productInCart.qty = Number(productInCart.qty)+Number(qty);
                            newProduct = null;

                        }
                    });
                    Array.prototype.push.apply(cart, newProduct);
                    localStorage.setItem('cart', JSON.stringify(cart));
                    this.getTotalPrice(cart);
                }
                return false;

            },

            cartProduct(){
                this.cart_products = JSON.parse(localStorage.getItem('cart'));
                if(this.cart_products)
                this.getTotalPrice(this.cart_products);
            },

            getTotalPrice(cartProduct){
                this.totalPrice = 0;
                this.cart_products_count = 0;
                cartProduct.forEach(product=>{
                    this.totalPrice += product.product.price_special * product.qty;
                    this.cart_products_count += Number(product.qty);
                })
                localStorage.setItem('cart_total', this.totalPrice)
            },

            removeCartProduct(id){
                let cart = JSON.parse(localStorage.getItem('cart'));
                localStorage.removeItem('cart');
                cart.forEach((cart_product, index) => {

                    if(cart_product.product.id === id){
                        console.log(index);
                        cart.splice(index, 1);
                    }
                })
                localStorage.setItem('cart', JSON.stringify(cart));
                this.cartProduct();
                this.cartProductCount(cart);

            },

            cartProductCount(cart){
                this.cart_products_count =  cart.length;
            },

            /*wish list product */
            addToWishList(product){
                let wishList = localStorage.getItem('wishList');
                this.wish_list_count = 0;
                let newWishList = [
                    {
                        'product': product
                    }
                ];
                if(!wishList){
                    localStorage.setItem('wishList', JSON.stringify(newWishList));
                    this.wishListCount();
                }else{
                    wishList = JSON.parse(wishList);
                    wishList.forEach(productInWishList=>{
                        if(productInWishList.product.id === product.id){
                            newWishList = null;
                        }
                    });
                    Array.prototype.push.apply(wishList, newWishList);

                    localStorage.setItem('wishList', JSON.stringify(wishList));
                    this.wishListCount(true);
                }
            },

            wishListCount(){
                    let wishList = JSON.parse(localStorage.getItem('wishList'));
                    this.wish_list_count = wishList ? wishList.length : null;
            },

            logoutStatus(value){
                if(value){
                    this.getAccessToken();
                }
            },

            //if checkout success clear cart
            checkout(event){
                if(event){
                    this.cartProduct();
                    this.cart_products_count=0;
                    this.totalPrice=0;
                }
            },

            //get search request
            getSearchReq(value, page=1){
                this.search_req = value;
                /*console.log(value);
                axios.post('/api/search', {
                    'page': page,
                    'search': value
                }).then(res=>{
                    console.log(res.data.count_product);
                    this.search_req = value;
                    this.search_result = res.data.count_product;
                })*/
            }
        },
    }
</script>

<style>
    .header-action button{
        z-index: 5;
    }
    .offcanvas{
        visibility: unset !important;
    }
    .fa-sign-out {
        transform: scale(1.8,1.8);
        line-height: 2em;
    }
    .user-in img{
        max-width: none;
    }
</style>
