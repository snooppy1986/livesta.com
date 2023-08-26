<template>
    <main class="main-content">
        <!--== Start Hero Area Wrapper ==-->
        <section class="hero-slider-area position-relative">

            <swiper
                :modules="modules"
                :slides-per-view="1"
                :spaceBetween="30"
                :autoHeight="true"
                :effect="'fade'"
                :loop="true"

                :pagination="{
                    el: '.hero-slider-pagination',
                    type: 'fraction',

                }"
                :navigation="false"
                :scrollbar="{ draggable: true }"
                @swiper="onSwiper"
                @slideChange="onSlideChange"
                class="hero-slider-container"
            >
                <swiper-slide class="hero-slide-item" v-for="slide in slides">
                    <div class="container">
                        <div class="row align-items-center position-relative">
                            <div class="col-12 col-md-6">
                                <div class="hero-slide-content">
                                    <div class="hero-slide-text-img"><img src="/images/slider/text-theme.webp" width="427" height="232" alt="Image"></div>
                                    <h2 class="hero-slide-title">{{slide.title}}</h2>
                                    <p class="hero-slide-desc">{{slide.content}}</p>
                                    <router-link class="btn btn-border-dark" :to="'/product/'+slide.product_id">Придбати</router-link>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="hero-slide-thumb">
                                    <img :src="slide.image_link" width="841" height="832" alt="Image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-slide-text-shape"><img src="/images/slider/text1.webp" width="70" height="955" alt="Image"></div>
                    <div class="hero-slide-social-shape"></div>
                </swiper-slide>
                <div class="hero-slider-pagination"></div>
            </swiper>
        </section>
        <!--== End Hero Area Wrapper ==-->

        <!--== Start Product Category Area Wrapper ==-->
        <section class="section-space pb-0">
            <div class="container">
                <div class="row g-3 g-sm-6">
                    <div v-for="categorie in main_categories" class="col-6 col-lg-4 col-lg-2 col-xl-2">
                        <!--== Start Product Category Item ==-->
                        <router-link :to="'/category/'+categorie.id" class="product-category-item">
                            <img class="icon" :src="categorie.thumbnail" width="70" height="80" alt="Image-HasTech">
                            <h3 class="title">{{categorie.title}}</h3>
                            <!--<span class="flag-new">new</span>-->
                        </router-link>
                        <!--== End Product Category Item ==-->
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Category Area Wrapper ==-->

        <!--== Start Product Area Wrapper ==-->
        <section class="section-space">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2 class="title">Топ продажу</h2>
                            <p>Лише турбота про ближнього, краса навколо, душевна доброта та сила наших сердець об’єднує всю хоробрість українців, яку ми уособили в <b>LIVESTA!</b></p>
                        </div>
                    </div>
                </div>
                <div class="row mb-n4 mb-sm-n10 g-3 g-sm-6">
                    <div v-for="product in products" class="col-6 col-lg-4 mb-4 mb-sm-9">
                        <!--== Start Product Item ==-->
                        <div class="product-item">
                            <div class="product-thumb">
                                <router-link class="d-block" :to="'/product/'+product.id">
                                    <img :src="product.image_url" width="370" height="450" alt="Image-HasTech">
                                </router-link>
                                <span class="flag-new">Новинка</span>
                                <div class="product-action">
                                    <button
                                        @click="productPreview(product)"
                                        type="button"
                                        class="product-action-btn action-btn-quick-view"
                                        data-bs-toggle="modal"
                                        data-bs-target="#action-QuickViewModal"
                                    >
                                        <i class="fa fa-expand"></i>
                                    </button>
                                    <button
                                        @click="addToCart(product, true), productPreview(product)"
                                        type="button"
                                        class="product-action-btn action-btn-cart"
                                        data-bs-toggle="modal"
                                        data-bs-target="#action-CartAddModal"
                                    >
                                        <span>В кошик</span>
                                    </button>
                                    <button
                                        @click="addToWishList(product), productPreview(product)"
                                        type="button"
                                        class="product-action-btn action-btn-wishlist"
                                        data-bs-toggle="modal"
                                        data-bs-target="#action-WishlistModal"
                                    >
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-rating">
                                    <div class="rating">
                                        <StarRating
                                            inactive-color="#fff"
                                            border-color="#ff6565"
                                            active-color="#ff6565"
                                            v-bind:border-width=1
                                            aria-valuenow=3
                                            v-bind:star-size=18
                                            v-bind:read-only="true"
                                            v-bind:round-start-rating="false"
                                            v-model:rating="product.rating"
                                        ></StarRating>
                                    </div>
                                    <div class="reviews">Відгуків {{product.rating}}</div>
                                </div>
                                <h4 class="title">
                                    <router-link :to="'/product/'+product.id">{{product.title}}</router-link>
                                </h4>
                                <div class="prices">
                                    <span class="price">{{product.price_special}} &#8372</span>
                                    <span class="price-old">{{product.price_through}}</span>
                                </div>
                            </div>
                            <div class="product-action-bottom">
                                <button  type="button" class="product-action-btn action-btn-quick-view" data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                    <i class="fa fa-expand"></i>
                                </button>
                                <button type="button" class="product-action-btn action-btn-wishlist" data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                                    <i class="fa fa-heart-o"></i>
                                </button>
                                <button type="button" class="product-action-btn action-btn-cart" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">
                                    <span>В кошик</span>
                                </button>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Area Wrapper ==-->

        <!--== Start News Letter Area Wrapper ==-->
        <section class="section-space pt-0">
            <div class="container">
                <div class="newsletter-content-wrap" data-bg-img="images/photos/bg1.webp">
                    <div class="newsletter-content">
                        <div class="section-title mb-0">
                            <h2 class="title">Новини</h2>
                            <p>Отримувати новини про знижки, новинки, акції від компанії Livesta</p>
                        </div>
                    </div>
                    <div class="newsletter-form">
                        <form>
                            <input type="email" class="form-control" placeholder="Введіть ваш email">
                            <button class="btn-submit" type="submit"><i class="fa fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--== End News Letter Area Wrapper ==-->

    </main>
    <product_preview :product="preview_product" :addToCart="addToCart"></product_preview>
    <product_wishlist :product = "preview_product"></product_wishlist>
    <ScaleLoader
        :loading="statusLoader"
        color="#ff6565"
        height="20px"
        width="5px"
    />
</template>

<script>
    import axios from 'axios';
    import StarRating from 'vue-star-rating';
    import product_preview from '../elements/product_quick_view.vue';
    import product_wishlist from "../elements/product_wishlist.vue";
    import { ScaleLoader } from "vue3-spinner";
    import { Navigation, Pagination, Scrollbar, A11y , Autoplay, EffectFade} from 'swiper';
    import {Swiper, SwiperSlide} from 'swiper/vue';
    import 'swiper/css/pagination';
    import 'swiper/css/navigation';
    export default {
        name: "IndexComponent",
        metaInfo(){
            const meta = this.meta;
            return{
                title: meta.title ? meta.title : '',
                meta: meta.meta ? meta.meta : [],
                link: meta.link ? meta.link : []
            }
        },
        props:['addToCart', 'addToWishList', 'createMeta'],
        data(){
            return{
                products: [],
                main_categories: [],
                menu_categories: [],
                preview_product: [],
                slides: [],
                meta: {},
                statusLoader: true
            }
        },
        components:{
            StarRating,
            product_preview,
            product_wishlist,
            Swiper,
            SwiperSlide,
            ScaleLoader
        },

        setup() {
            const onSwiper = (swiper) => {
                console.log(swiper);
            };
            const onSlideChange = () => {
                console.log('slide change');
            };
            return {
                onSwiper,
                onSlideChange,
                modules: [Pagination, Navigation, Autoplay, EffectFade],
            };
        },
        mounted() {
            this.loadProduct();
            $(document).trigger('change');
        },
        methods:{
            loadProduct(){
                axios.get('/api/start')
                    .then(res=>{
                        console.log(res);
                        this.products =  res.data.products.data;
                        this.main_categories = res.data.main_categories.slice(0, 6);
                        this.menu_categories = res.data.main_categories;
                        this.slides = res.data.main_slides;
                        this.meta = res.data.meta;
                        this.statusLoader = false;
                    })
            },
            productPreview(product){
                this.preview_product= product;
            }
        }
    }
</script>

<style >
    .newsletter-form .btn-submit{
        width: 65px;
    }
    .hero-slider-pagination{
        width: 363px !important;
        top: calc(50% - 12px) !important;
    }
    .hero-slide-content .hero-slide-title{
        font-size: 50px;
    }
    .hero-slide-content .hero-slide-desc{
        font-size: 18px;
    }
</style>
