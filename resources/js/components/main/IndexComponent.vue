<template>
    <main class="main-content">
        <!--== Start Hero Area Wrapper ==-->
        <hero_slide :slides="slides"></hero_slide>
        <!--== End Hero Area Wrapper ==-->

        <!--== Start Product Category Area Wrapper ==-->
        <category_area :categories="main_categories"></category_area>
        <!--== End Product Category Area Wrapper ==-->

        <!--== Start Product Area Wrapper ==-->
        <product_area :products="products" :addToWishList="addToWishList" :addToCart="addToCart"></product_area>
        <!--== End Product Area Wrapper ==-->

        <!--== Start News Letter Area Wrapper ==-->
        <news_letter_area></news_letter_area>
        <!--== End News Letter Area Wrapper ==-->
    </main>

    <ScaleLoader
        :loading="statusLoader"
        color="#ff6565"
        height="20px"
        width="5px"
    />
</template>

<script>
    import axios from 'axios';
    import { ScaleLoader } from "vue3-spinner";
    import hero_slide from "../elements/main/_hero_slider_area.vue";
    import category_area from "../elements/main/_category_area.vue";
    import product_area from "../elements/main/_product_area.vue";
    import news_letter_area from "../elements/main/_news_letter_area.vue";

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
                slides: [],
                meta: {},
                statusLoader: true
            }
        },
        components:{
            ScaleLoader,
            hero_slide,
            category_area,
            product_area,
            news_letter_area
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
            }
        }
    }
</script>

<style >
    .newsletter-form .btn-submit{
        width: 65px;
    }
</style>
