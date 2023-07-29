<template>
    <!--== Start Product Quick Wishlist Modal ==-->
    <aside class="product-action-modal modal fade" id="action-WishlistModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product-action-view-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                        <div class="modal-action-messages">
                            <i class="fa fa-check-square-o"></i> Збережено в списку бажань!
                        </div>
                        <div class="modal-action-product">
                            <div class="thumb">
                                <img :src="product.image" :alt="product.title" width="466" height="320">
                            </div>
                            <h4 class="product-name"><a href="product-details.html">{{product.title}}</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!--== End Product Quick Wishlist Modal ==-->
</template>

<script>
    export default {
        name: "product_wishlist",
        props:[
            'product'
        ]
    }
</script>

<style scoped>

</style>
