<template>
    <!--== Start Product Quick Add Cart Modal ==-->
    <aside class="product-action-modal modal fade" id="action-CartAddModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product-action-view-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                        <div class="modal-action-messages">
                            <i class="fa fa-check-square-o"></i> Товар в корзині
                        </div>
                        <div class="modal-action-product">
                            <div class="thumb">
                                <img :src="product.image" alt="{{product.title}}" width="466" height="320">
                            </div>
                            <h4 class="product-name"><router-link :to="'product/'+product.id">{{product.title}}</router-link></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!--== End Product Quick Add Cart Modal ==-->
</template>

<script>
    export default {
        name: "quick_add_card_product_modal",
        props:[
            'product'
        ],
        mounted() {
            /*$(document).trigger('change')*/
        },
    }
</script>

<style>
    .modal-action-messages{
        text-align: left;
    }
    .product-action-modal .product-action-view-content .btn-close {
        text-align: right;
    }
    .product-action-modal .product-action-view-content .btn-close i{
        margin-right: 15px;
    }
</style>
