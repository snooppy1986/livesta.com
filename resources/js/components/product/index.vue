<template>
    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <section class="page-header-area pt-10 pb-9" data-bg-color="#FFF3DA">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="page-header-st3-content text-center text-md-start">
                            <ol class="breadcrumb justify-content-center justify-content-md-start">
                                <li class="breadcrumb-item">
                                    <router-link class="text-dark" to="/">
                                        <i class="fa fa-home"></i>
                                    </router-link>
                                </li>

                                <li v-for="category in categories" class="breadcrumb-item">
                                    <router-link class="text-dark" :to="'/category/'+category.id">
                                        {{category.title}}
                                    </router-link>
                                </li>

                                <li class="breadcrumb-item">
                                    <router-link class="text-dark" :to="'/category/'+category.id">
                                        {{category.title}}
                                    </router-link>
                                </li>

                            </ol>
                            <h4 class="page-header-title">Продукти категорії <span class="text-primary">{{category.title}}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Product Details Area Wrapper ==-->
        <section class="section-space">
            <div class="container">
                <div class="row product-details">
                    <div class="col-lg-6">
                        <div class="product-details-thumb">
                            <img :src="'/storage/images/'+product.image" width="570" height="693" :alt="product.title">
                            <span class="flag-new" v-if="product.new">новинка</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details-content">
                            <h5 class="product-details-collection">{{category.title}}</h5>
                            <h3 class="product-details-title">{{product.title}}</h3>
                            <div class="product-details-review mb-7">
                                <div class="product-review-icon">
                                    <StarRating
                                        inactive-color="#fff"
                                        border-color="#ff6565"
                                        active-color="#ff6565"
                                        v-bind:border-width=1
                                        aria-valuenow=3
                                        v-bind:star-size=18
                                        v-bind:read-only="true"
                                        v-bind:round-start-rating="false"
                                        v-model:rating="avgRating"
                                    ></StarRating>
                                </div>
                                <button type="button" class="product-review-show">{{reviews.length ? reviews.length : 0}} відгуки(ів)</button>
                            </div>
                            <p class="mb-7">{{product.content}}</p>
                            <div class="product-details-pro-qty">
                                <div class="pro-qty">
                                    <input class="qty-value" type="text" title="Кількість" value="1">
                                </div>
                            </div>
                            <!--<div class="product-details-shipping-cost">
                                <input class="form-check-input" type="checkbox" value="" id="ShippingCost" checked>
                                <label class="form-check-label" for="ShippingCost">Shipping from USA, Shipping Fees $4.22</label>
                            </div>-->
                            <div class="product-details-action">
                                <h4 class="price">{{product.price_special}} &#x20b4</h4>
                                <div class="product-details-cart-wishlist">
                                    <button @click="addToWishList(product), modal_product=product" type="button" class="btn-wishlist" data-bs-toggle="modal" data-bs-target="#action-WishlistModal"><i class="fa fa-heart-o"></i></button>
                                    <button @click="addToCart(product), modal_product=product" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">В кошик</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="nav product-details-nav" id="product-details-nav-tab" role="tablist">
                            <button
                                class="nav-link"
                                id="specification-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#specification"
                                type="button"
                                role="tab"
                                aria-controls="specification"
                                aria-selected="false"
                            >
                                Характеристики
                            </button>
                            <button
                                class="nav-link active"
                                id="review-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#review"
                                type="button"
                                role="tab"
                                aria-controls="review"
                                aria-selected="true"
                            >
                                Відгуки
                            </button>
                        </div>
                        <div class="tab-content" id="product-details-nav-tabContent">
                            <specification :attributes="attributes"></specification>

                            <reviews :reviews="reviews" ></reviews>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <reviews_form :product_id="product.id" @statusForm="statusForm"></reviews_form>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Details Area Wrapper ==-->

        <!--== Start Product Banner Area Wrapper ==-->
        <div class="container">
            <!--== Start Product Category Item ==-->
            <a href="product.html" class="product-banner-item">
                <img src="/images/shop/banner/7.webp" width="1170" height="240" alt="Image-HasTech">
            </a>
            <!--== End Product Category Item ==-->
        </div>
        <!--== End Product Banner Area Wrapper ==-->

        <!--== Start Product Area Wrapper ==-->
        <section class="section-space" v-show="related_products.length">
            <div class="container" >
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2 class="title">Пов'язані товари</h2>
                            <p class="m-0">Товари які пов'язані з товаром {{product.title}}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-n10">
                    <div class="col-12">
                        <div class="swiper related-product-slide-container">
                            <div class="swiper-wrapper">
                                <div v-for="related_product in related_products" class="swiper-slide mb-10">
                                    <!--== Start Product Item ==-->
                                    <div class="product-item product-st2-item">
                                        <div class="product-thumb">
                                            <router-link class="d-block" :to="{name:'product.index', params:{id:related_product.id}}">
                                                <img :src="'/storage/images/'+related_product.image" width="370" height="450" alt="Image-HasTech">
                                            </router-link>
                                            <span v-if="related_product.new" class="flag-new">новинка</span>
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
                                                        v-model:rating="related_product.rating"
                                                    ></StarRating>
                                                </div>
                                                <div class="reviews">{{related_product.rating}} відгуків</div>
                                            </div>
                                            <h4 class="title">
                                                <router-link :to="{name:'product.index', params:{id:related_product.id}}">{{related_product.title}}</router-link>
                                            </h4>
                                            <div class="prices">
                                                <span class="price">{{related_product.price_special}} &#x20b4</span>
                                                <span class="price-old">{{related_product.price_through}}</span>
                                            </div>
                                            <div class="product-action">
                                                <button
                                                    @click="addToCart(related_product, true),
                                                     modal_product=related_product"
                                                    type="button"
                                                    class="product-action-btn action-btn-cart"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#action-CartAddModal"
                                                >
                                                    <span>В кошик</span>
                                                </button>
                                                <button
                                                    @click="modal_product=related_product"
                                                    type="button"
                                                    class="product-action-btn action-btn-quick-view"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#action-QuickViewModal"
                                                >
                                                    <i class="fa fa-expand"></i>
                                                </button>
                                                <button @click="addToWishList(related_product), modal_product=related_product" type="button" class="product-action-btn action-btn-wishlist" data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                                                    <i class="fa fa-heart-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--== End prPduct Item ==-->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Area Wrapper ==-->
    </main>
    <product_wishlist :product = "modal_product"></product_wishlist>
    <quick_add_card_product_modal :product = "modal_product" ></quick_add_card_product_modal>
    <product_preview :product = "modal_product" :addToCart="addToCart"></product_preview>
    <ScaleLoader
        :loading="statusLoader"
        color="#ff6565"
        height="20px"
        width="5px"
    />
</template>

<script>
    import Api from '../../api.js'
    import StarRating from 'vue-star-rating';
    import product_wishlist from "../elements/product_wishlist.vue";
    import quick_add_card_product_modal from "../elements/quick_add_card_product_modal.vue";
    import product_preview from '../elements/product_quick_view.vue';
    import specification from "../elements/product/specification.vue";
    import reviews from "../elements/product/reviews.vue";
    import reviews_form from "../elements/product/reviews_form.vue";
    import { ScaleLoader } from "vue3-spinner";
    export default {
        name: "index",
        props:['id', 'title', 'addToCart', 'addToWishList'],

        data(){
            return{
                id: 0,
                category_id: 0,
                category:{},
                categrories:{},
                product: {},
                related_products: {},
                modal_product: {},
                attributes: {},
                reviews:{},
                avgRating: 0 ,
                statusLoader: true
            }
        },
        components:{
            StarRating,
            product_wishlist,
            quick_add_card_product_modal,
            product_preview,
            specification,
            reviews,
            reviews_form,
            ScaleLoader
        },
        mounted() {
            this.id = this.$route.params.id;
            this.category_id = this.$route.query.category;
            console.log(this.category_id);
            this.getProduct();
            $(document).trigger('change');
        },
        watch:{
            $route(to, from){
                this.id = this.$route.params.id;
                this.getProduct();
            },
        },
        methods:{
            getProduct(){
                Api.get('/api/product/'+this.id, {
                    params:{category_id: this.category_id}
                })
                    .then(res=>{
                        this.category = res.data.category;
                        this.categories = res.data.categories;
                        this.product = res.data.product;
                        this.related_products = res.data.related_products;
                        this.attributes = res.data.product.attributes;
                        this.reviews = res.data.product.reviews;
                        this.avgRating = res.data.rating;
                        this.statusLoader=false;
                    });
            },

            statusForm(status){
                console.log(status);
                this.statusLoader = true;
                if(status) this.getProduct();
            }

        }
    }
</script>

<style scoped>
    .product-item .product-info .title{
        height: 75px;
        overflow: hidden;
    }

</style>
