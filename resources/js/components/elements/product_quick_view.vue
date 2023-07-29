<template>
    <!--== Start Product Quick View Modal ==-->
    <aside class="product-cart-view-modal modal fade" id="action-QuickViewModal"  >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product-quick-view-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <span class="fa fa-close"></span>
                        </button>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!--== Start Product Thumbnail Area ==-->
                                    <div class="product-single-thumb">
                                        <img :src="product.image" width="544" height="560" alt="Image-HasTech">
                                    </div>
                                    <!--== End Product Thumbnail Area ==-->
                                </div>
                                <div class="col-lg-6">
                                    <!--== Start Product Info Area ==-->
                                    <div class="product-details-content">
                                        <h5 class="product-details-collection">{{product.title}}</h5>
                                        <h3 class="product-details-title">{{product.title}}</h3>
                                        <div class="product-details-review mb-5">
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
                                                    v-model:rating="product.rating"
                                                ></StarRating>
                                            </div>
                                            <button type="button" class="product-review-show">{{product.rating}} reviews</button>
                                        </div>
                                        <p class="mb-6">{{product.content}}</p>
                                        <div class="product-details-pro-qty">
                                            <div class="pro-qty">
                                                <input class="modal-qty-value" type="text" title="Quantity" value="1">
                                            </div>
                                        </div>
                                        <div class="product-details-action">
                                            <h4 class="price">{{product.price_special}} &#8372</h4>
                                            <div class="product-details-cart-wishlist">
                                                <button @click="addToCart(product, false, true)" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#action-CartAddModal">Покласти в корзину</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--== End Product Info Area ==-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <quick_add_card_product_modal :product = "product"></quick_add_card_product_modal>
    <!--== End Product Quick View Modal ==-->
</template>

<script>
    import StarRating from 'vue-star-rating';
    import quick_add_card_product_modal from "./quick_add_card_product_modal.vue";
    export default {
        name: "product_quick_view",
        props:[
            'product',
            'addToCart'
        ],
        components:{
            StarRating,
            quick_add_card_product_modal,
        },
        mounted() {
            $(document).trigger('change')
        },
    }
</script>

<style scoped>

</style>
