<template>
    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <nav aria-label="breadcrumb" class="breadcrumb-style1">
            <div class="container">
                <ol class="breadcrumb justify-content-center justify-content-md-start">
                    <li class="breadcrumb-item">
                        <router-link class="text-dark" to="/">
                            <i class="fa fa-home"></i>
                        </router-link>
                    </li>

                    <li class="breadcrumb-item">
                        Список бажань
                    </li>

                </ol>
            </div>
        </nav>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Wishlist Area Wrapper ==-->
        <section class="section-space">
            <div class="container">
                <div class="shopping-wishlist-form table-responsive">
                    <form v-if="products.length>0" action="#" method="post">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Товар</th>
                                <th class="product-price">Ціна</th>
                                <th class="product-stock-status">Артикль</th>
                                <th class="product-add-to-cart">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(wish_product, index) in products" class="tbody-item">
                                <td class="product-remove">
                                    <a @click.prevent="removeWishItem(index), preloader()" class="remove" >×</a>
                                </td>
                                <td class="product-thumbnail">
                                    <div class="thumb">
                                        <router-link :to="'/product/'+wish_product.product.id">
                                            <img :src="'storage/images/'+wish_product.product.image" width="68" height="84" alt="Image-HasTech">
                                        </router-link>
                                    </div>
                                </td>
                                <td class="product-name">
                                    <a class="title" href="single-product.html">{{wish_product.product.title}}</a>
                                </td>
                                <td class="product-price">
                                    <span class="price">{{wish_product.product.price_special}} &#x20b4</span>
                                </td>
                                <td class="product-stock-status">
                                    <span class="wishlist-in-stock">{{wish_product.product.code}}</span>
                                </td>
                                <td class="product-add-to-cart">
                                    <a
                                        @click.prevent="addToCart(wish_product.product, true), getItemProduct(wish_product.product)"
                                        class="btn-shop-cart"
                                        data-bs-toggle="modal"
                                        data-bs-target="#action-CartAddModal"
                                    >
                                        В кошик
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                    <h3 v-else>Список бажань порожній.</h3>
                </div>
            </div>
        </section>
        <!--== End Wishlist Area Wrapper ==-->

    </main>
    <ScaleLoader
        :loading="statusLoader"
        color="#ff6565"
        height="20px"
        width="5px"
    />
    <quick_add_card_product_modal :product = "itemProduct" ></quick_add_card_product_modal>
</template>

<script>
    import { ScaleLoader } from "vue3-spinner";
    import quick_add_card_product_modal from "../elements/quick_add_card_product_modal.vue";
    export default {
        name: "index",
        // meta info
        metaInfo:{
            title: 'Список бажань'
        },
        data(){
            return{
                products: {},
                itemProduct:{},
                statusLoader: true
            }
        },
        props:['addToCart'],
        components:{
            ScaleLoader,
            quick_add_card_product_modal
        },
        mounted() {
            this.getWishList()
        },
        methods:{
            getWishList(){
                this.products = JSON.parse(localStorage.getItem('wishList'));
                this.preloader();
            },
            preloader(){
                this.statusLoader=true;
                setTimeout(()=>{this.statusLoader= false}, 1000);
            },
            getItemProduct(product){
                this.itemProduct = product
            },
            removeWishItem(index){
                let wishList = JSON.parse(localStorage.getItem('wishList'));
                wishList.splice(index, 1);
                localStorage.setItem('wishList', JSON.stringify(wishList));
                this.getWishList();
                this.$emit('countStatus', true)
            }
        }
    }
</script>

<style scoped>

</style>
