<template>
    <section class="section-space">
        <div class="container">
            <div v-if="products.length" class="row justify-content-between flex-xl-row-reverse">
                <div class="col-xl-9">
                    <div class="row g-3 g-sm-6">
                        <div v-for="product in products" class="col-6 col-lg-4 col-xl-4 mb-4 mb-sm-8">
                            <!--== Start Product Item ==-->
                            <div class="product-item product-st3-item">
                                <div class="product-thumb">
                                    <router-link
                                        class="d-block"
                                        :to="{name:'product.index', params:{id:product.id}/*, query:{category: category.id}*/}"
                                    >
                                        <img :src="product.image_url" width="370" height="450" :alt="product.title">
                                    </router-link>
                                    <span v-if="product.new" class="flag-new">новинка</span>
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
                                        <router-link :to="{name:'product.index', params:{id:product.id}}">{{product.title}}</router-link>
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

                        <div class="col-12">
                            <!--vue js paginate-->
                            <paginate v-if="pagination.last_page>1"
                                      :page-count="pagination.last_page"
                                      :prev-text= "'<i class=\'fa fa-chevron-left\'></i>'"
                                      :prev-link-class = "'page-link previous'"
                                      :next-text="'<i class=\'fa fa-chevron-right\'></i>'"
                                      :next-link-class = "'page-link next'"
                                      :container-class ="'pagination justify-content-center me-auto ms-auto mt-5 mb-10'"
                                      :break-view-text="'....'"
                                      :page-range="4"
                                      :click-handler = "getPageNum"
                            >
                            </paginate>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="product-sidebar-widget">
                        <category_page_search
                            @getSearchReq="SearchReq"
                        >

                        </category_page_search>

                        <div class="product-widget" v-if="categories.length">
                            <h4 class="product-widget-title">Категорії</h4>
                            <ul class="product-widget-category">
                                <li v-for="cat in categories">
                                    <router-link :to="'/category/'+cat.id">
                                        {{cat.title}} <span v-if="cat.children.length">({{cat.children.length}})</span>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="row g-3 g-sm-6">
                <h3>Товар не знайдений!!!</h3>
            </div>
        </div>
    </section>

    <product_preview :product="preview_product" :addToCart="addToCart"></product_preview>
    <product_wishlist :product = "preview_product"></product_wishlist>
</template>

<script>
import product_preview from '../modal/product_quick_view.vue';
import product_wishlist from "../modal/product_wishlist.vue";
import category_page_search from "../category/_category_page_search.vue";
import StarRating from 'vue-star-rating';
import Paginate from 'vuejs-paginate-next';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
export default {
    name: "_product_area",
    props:[
        'products',
        'pagination',
        'categories',
        'addToWishList',
        'addToCart'
    ],
    data: ()=>({
        preview_product: []
    }),
    components:{
        product_preview,
        product_wishlist,
        StarRating,
        Paginate,
        Bootstrap5Pagination,
        category_page_search,
    },
    methods:{
        productPreview(product){
            this.preview_product= product;
        },

        SearchReq(value){
            this.$emit('getSearchReq', value);
        },

        getPageNum(value){
            this.$emit('getPageNum', value);
        }
    }
}
</script>

<style scoped>

</style>
