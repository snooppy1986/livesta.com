<template>
    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <breadcrumbs :pageTitle="pageTitle"></breadcrumbs>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Wishlist Area Wrapper ==-->
        <section class="section-space">
            <div class="container">
                <h4 class="mb-3">Обрані продукти</h4>
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
                                            <img :src="wish_product.product.image_url" width="68" height="84" alt="Image-HasTech">
                                        </router-link>
                                    </div>
                                </td>
                                <td class="product-name">
                                    <router-link class="title" :to="'/product/'+wish_product.product.id">{{wish_product.product.title}}</router-link>
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
                                        <span class="add-to-cart-text">В кошик</span>
                                        <i class="fa fa-shopping-cart add-to-cart-thumb" aria-hidden="true"></i>
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
    import breadcrumbs from "../elements/breadcrumb/_breadcrumbs.vue"
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
                statusLoader: true,
                pageTitle: 'Список бажань'
            }
        },
        props:['addToCart'],
        components:{
            ScaleLoader,
            quick_add_card_product_modal,
            breadcrumbs
        },
        mounted() {
            this.getWishList();
            $(document).trigger('change')
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
.shopping-wishlist-form .add-to-cart-thumb{
    display: none;
}
@media only screen and (max-width: 1200px) {
    .shopping-wishlist-form .add-to-cart-text{
        display: none;
    }

    .shopping-wishlist-form .add-to-cart-thumb{
        display: inline-block;
    }
    .shopping-wishlist-form .add-to-cart-thumb:before{
        font-size: 20px;
        color: #ff6565;
    }
    .shopping-wishlist-form .btn-shop-cart:hover .add-to-cart-thumb:before{
        color: #ffffff;
    }
}


@media only screen and (max-width: 991px) {
    .shopping-wishlist-form .table{
        width: 100%;
    }
    .shopping-wishlist-form .product-name{
        width: 4rem;
    }
}

@media only screen and (max-width: 575px) {
    .shopping-wishlist-form .product-stock-status{
        display: none;
    }
}

@media only screen and (max-width: 539px) {
    .shopping-wishlist-form .product-add-to-cart{
        display: none;
    }
}
</style>
