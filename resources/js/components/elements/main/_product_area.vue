<template>
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
                            <span class="flag-new">Хіт</span>
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
                                <div class="reviews">Відгуків {{product.reviews.length}}</div>
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
                                @click="addToWishList(product), productPreview(product)"
                                type="button"
                                class="product-action-btn action-btn-wishlist"
                                data-bs-toggle="modal"
                                data-bs-target="#action-WishlistModal"
                            >
                                <i class="fa fa-heart-o"></i>
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
                        </div>
                    </div>
                    <!--== End prPduct Item ==-->
                </div>
            </div>
        </div>
    </section>
    <product_preview :product="preview_product" :addToCart="addToCart"></product_preview>
    <product_wishlist :product = "preview_product"></product_wishlist>
</template>

<script>
import StarRating from 'vue-star-rating';
import product_preview from "/resources/js/components/elements/modal/product_quick_view.vue";
import product_wishlist from "/resources/js/components/elements/modal/product_wishlist.vue";
export default {
    name: "_product_area",
    props:['products', 'addToWishList', 'addToCart'],
    data(){
        return{
            preview_product: [],
        }
    },
    components:{
        StarRating,
        product_preview,
        product_wishlist
    },
    methods:{
        productPreview(product){
            this.preview_product = product;
        },
    }
}
</script>

<style scoped>

</style>
