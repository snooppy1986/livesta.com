<template>
    <!--== Start Order Show Modal ==-->
    <aside class="product-action-modal modal fade" id="action-ShowOrder" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product-action-view-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                        <div class="modal-action-product">
                            <!--== Start Wishlist Area Wrapper ==-->
                            <section class="section-space">
                                <div class="container">
                                    <div class="shopping-wishlist-form table-responsive">
                                        <form action="#" method="post">
                                            <table class="table text-center">
                                                <thead>
                                                <tr>
                                                    <th class="product-thumbnail">&nbsp;</th>
                                                    <th class="product-name">Назва</th>
                                                    <th class="product-price">Ціна</th>
                                                    <th class="product-stock-status">К-ть</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="order_product in order_products" class="tbody-item">
                                                    <td class="product-thumbnail">
                                                        <div class="thumb">
                                                            <router-link :to="{name:'product.index', params:{id:order_product.product.id}}">
                                                                <img :src="order_product.product.image"  alt="Image-HasTech">
                                                            </router-link>
                                                        </div>
                                                    </td>
                                                    <td class="product-name">
                                                        <router-link :to="{name:'product.index', params:{id:order_product.product.id}}">
                                                            {{order_product.product.title}}
                                                        </router-link>
                                                    </td>
                                                    <td class="product-price">
                                                        <span class="price">{{order_product.product.price_special}}</span>
                                                    </td>
                                                    <td class="product-stock-status">
                                                        <span class="wishlist-in-stock">{{order_product.qty}}</span>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </section>
                            <div class="cart-totals-wrap">
                                <h2 class="title">Замовлення</h2>
                                <table>
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Загальна ціна</th>
                                        <td>
                                            <span class="amount">{{order.total_price}}</span>
                                        </td>
                                    </tr>

                                    <tr class="order-total">
                                        <th>Статус</th>
                                        <td>
                                            <span class="amount">{{order.status === 0 ? 'Новий' : order.status ===1 ? 'Виконується' : 'Виконаний'}}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <!--== End Wishlist Area Wrapper ==-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!--== End Order Show Modal ==-->
</template>

<script>
    export default {
        name: "show_order_modal",
        props: ['order', 'order_products'],

    }
</script>

<style scoped>
    .section-space {
         padding-bottom: 25px;
         padding-top: 25px;
    }
    .cart-totals-wrap table tbody .amount{
        color: #FF6565;
    }
    .product-action-modal
    .product-action-view-content
    .modal-action-product
    .thumb img{
        width: 50px;
    }
</style>
