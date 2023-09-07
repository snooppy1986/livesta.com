<template>
    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <section class="page-header-area pt-10 pb-9" data-bg-color="#FFF3DA">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="page-header-st3-content text-center text-md-start">
                            <ol class="breadcrumb justify-content-center justify-content-md-start">
                                <li class="breadcrumb-item">
                                    <router-link class="text-dark" to="/">
                                        <i class="fa fa-home"></i>
                                    </router-link>
                                </li>

                                <li v-for="parent in parents" class="breadcrumb-item">
                                    <router-link class="text-dark" :to="'/category/'+parent.id">
                                        {{parent.title}}
                                    </router-link>
                                </li>

                                <li class="breadcrumb-item active text-dark" aria-current="page">{{category.title}}</li>
                            </ol>
                            <h4 class="page-header-title">Продукти категорії <span class="text-primary">{{category.title}}</span></h4>
                        </div>
                    </div>
                    <div class="col-md-7" >
                        <h5 class="showing-pagination-results mt-5 mt-md-9 text-center text-md-end">
                            {{count_product  ? count_product : 0}} товарів в категорії
                        </h5>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Shop Top Bar Area Wrapper ==-->
        <div v-if="products.length" class="shop-top-bar-area" >
            <div class="container">
                <div class="shop-top-bar">
                    <v_select
                        :options="options"
                        :selected = "select_default"
                        @select_option = "selectOptions"
                    ></v_select>
                    <div class="select-on-sale d-flex d-md-none">
                        <span>On Sale :</span>
                        <select class="select-on-sale-form" >
                            <option selected>Yes</option>
                            <option value="1">No</option>
                        </select>
                    </div>

                    <rangeSlider
                        v-bind:price_max = "price_max"
                        v-bind:price_min="price_min"
                        v-bind:key="price_max"
                        @prices="getPrices"
                    ></rangeSlider>
                </div>
            </div>
        </div>
        <!--== End Shop Top Bar Area Wrapper ==-->


        <!--== Start Product Area Wrapper ==-->
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
                                            :to="{name:'product.index', params:{id:product.id}, query:{category: category.id}}"
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
                                        <button type="button" class="product-action-btn action-btn-quick-view" data-bs-toggle="modal" data-bs-target="#action-QuickViewModal">
                                            <i class="fa fa-expand"></i>
                                        </button>
                                        <button type="button" class="product-action-btn action-btn-wishlist" data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                                            <i class="fa fa-heart-o"></i>
                                        </button>
                                        <button type="button" class="product-action-btn action-btn-cart" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">
                                            <span>Add to cart</span>
                                        </button>
                                    </div>
                                </div>
                                <!--== End prPduct Item ==-->
                            </div>

                            <div class="col-12">
                                <!--vue js paginate-->
                                <paginate v-if="pagination.last_page>1"
                                    :page-count="pagination.last_page"
                                    :prev-text= "'Назад'"
                                    :prev-link-class = "'page-link previous'"
                                    :next-text="'Далі'"
                                    :next-link-class = "'page-link next'"
                                    :container-class ="'pagination justify-content-center me-auto ms-auto mt-5 mb-10'"
                                    :break-view-text="'....'"
                                    :page-range="4"
                                    :click-handler = "loadCategory"
                                >
                                </paginate>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="product-sidebar-widget">
                            <category_page_search
                                @getSearchReq="getSearchReq"
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
        <!--== End Product Area Wrapper ==-->

        <!--== Start Product Banner Area Wrapper ==-->
        <section>
            <div class="container">
                <!--== Start Product Category Item ==-->
                <a href="product.html">
                    <img src="/images/catbaner.jpg" width="1170" height="240" alt="Image-HasTech">
                </a>
                <!--== End Product Category Item ==-->
            </div>
        </section>
        <!--== End Product Banner Area Wrapper ==-->

        <product_preview :product="preview_product" :addToCart="addToCart"></product_preview>
        <product_wishlist :product = "preview_product"></product_wishlist>
    </main>
    <ScaleLoader
        :loading="statusLoader"
        color="#ff6565"
        height="20px"
        width="5px" />
</template>

<script>
    import axios from 'axios';
    import StarRating from 'vue-star-rating';
    import product_preview from '../elements/product_quick_view.vue';
    import product_wishlist from "../elements/product_wishlist.vue";
    import { Bootstrap5Pagination } from 'laravel-vue-pagination';
    import Paginate from 'vuejs-paginate-next';
    import rangeSlider from "../elements/rangeSlider.vue";
    import v_select from "../elements/v-select.vue";
    import category_page_search from "../elements/category_page_search.vue";
    import { ScaleLoader } from "vue3-spinner";
    export default {
        name: "index",
        props:[
            'addToCart',
            'addToWishList'
        ],
        data: ()=>({
            id: 0 ,
            products: [],
            count_product: 0,
            category:[],
            categories: [],
            pagination:[],
            parents: [],
            price_max: 0,
            price_min: 0,
            prices: [],
            preview_product: [],
            sort_type: '',

            options: [
                {name: 'По популярності', value: ['rating', 'DESC']},
                {name: 'За алфавітом А - Я', value: ['title', 'ASC']},
                {name: 'По зростанню цін', value: ['price_special', 'ASC']},
                {name: 'По зменшенню ціни', value: ['price_special', 'DESC']},

            ],
            select_default: 'Сортувати по:',
            searchReq: '',
            statusLoader: true,
            meta: {}
        }),
        metaInfo(){
            const meta = this.meta;
            return{
                title: meta.title ? meta.title : '',
                meta: meta.meta ? meta.meta : [],
                link: meta.link ? meta.link : []
            }
        },
        components:{
            StarRating,
            product_preview,
            Bootstrap5Pagination,
            Paginate,
            rangeSlider,
            product_wishlist,
            v_select,
            category_page_search,
            ScaleLoader
        },
        mounted() {
            this.id = this.$route.params.id;
            this.loadCategory();
            $(document).trigger('change');
        },
        watch:{
            $route(to, from){
                this.id = this.$route.params.id;
                this.loadCategory();
            },
        },
        methods:{
            loadCategory(page=1){
                this.statusLoader=true;
                axios.post('/api/category', {
                    'id': this.id,
                    'page': page,
                    'prices': this.prices,
                    'sort_type': this.sort_type,
                    'search': this.searchReq
                }).then(res=>{
                    this.products = res.data.data;
                    this.category = res.data.category;
                    this.pagination = res.data.meta;
                    this.categories = res.data.category.children;
                    this.parents = res.data.parents;
                    this.price_max = res.data.price_max;
                    this.price_min = res.data.price_min;
                    this.count_product = res.data.count_product;
                    this.meta = res.data.meta;
                    window.scrollTo({ top: 0, left: 0});
                    this.statusLoader=false;
                }).catch(error=>{
                    console.log(error);
                })
            },

            getPrices(prices){
                this.statusLoader=true;
                this.prices = prices;
                this.loadCategory();

            },

            productPreview(product){
                this.preview_product= product;
            },

            selectOptions(option){
                this.statusLoader=true;
                this.select_default = option.name;
                this.sort_type = option.value;
                this.loadCategory();
            },

            getSearchReq(search){
                this.statusLoader=true;
                this.searchReq = search;
                this.loadCategory();
            }

        }
    }
</script>

<style>
    .pagination .next,
    .pagination .previous{
        width: 100px;
    }
    .product-st3-item .product-info .title{
        height: 67px;
    }
    .pagination .previous:focus,
    .pagination .next:focus,
    .pagination .disabled:focus{
        box-shadow: none;
        border:none;
        background: transparent;
    }
    .page-item.disabled .page-link{
        background: transparent;
    }
</style>
