<template>
    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <breadcrumbs :parents="parents" :category="category" :count_product="count_product"></breadcrumbs>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Shop Top Bar Area Wrapper ==-->
        <top_bar
            v-if="products.length"
            :price_max="price_max"
            :price_min="price_min"
            :statusRangeSlider="true"
            @sort_option="selectOptions"
            @prices="getPrices"
        ></top_bar>
        <!--== End Shop Top Bar Area Wrapper ==-->


        <!--== Start Product Area Wrapper ==-->
        <product_area
            :addToCart="addToCart"
            :addToWishList="addToWishList"
            :products="products"
            :pagination="pagination"
            :categories="categories"
            @getSearchReq="getSearchReq"
            @getPageNum="loadCategory"
        ></product_area>
        <!--== End Product Area Wrapper ==-->

        <!--== Start Product Banner Area Wrapper ==-->
       <banner_are></banner_are>
        <!--== End Product Banner Area Wrapper ==-->
    </main>
    <ScaleLoader
        :loading="statusLoader"
        color="#ff6565"
        height="20px"
        width="5px" />
</template>

<script>
    import axios from 'axios';
    import { ScaleLoader } from "vue3-spinner";
    import breadcrumbs from "../elements/breadcrumb/_breadcrumbs.vue";
    import top_bar from "../elements/category/_top_bar_area.vue";
    import product_area from "../elements/category/_product_area.vue";
    import banner_are from "../elements/category/_banner_area.vue";
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
            sort_type: '',
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
            ScaleLoader,
            breadcrumbs,
            top_bar,
            product_area,
            banner_are
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

            selectOptions(option){
                this.statusLoader=true;
                this.select_default = option.name;
                this.sort_type = option;
                this.loadCategory();
            },

            getPrices(prices){
                this.statusLoader=true;
                this.prices = prices;
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

<style scoped>
    /*.pagination .next,
    .pagination .previous{
        width: 100px;
    }*/
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
