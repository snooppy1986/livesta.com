<template>
    <!--== Start Aside Cart ==-->
    <aside  ref="offCanvas" class="aside-cart-wrapper offcanvas offcanvas-end" tabindex="-1" id="AsideOffcanvasCart" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h1 class="d-none" id="offcanvasRightLabel">Корзина товарів</h1>
            <button
                class="btn-aside-cart-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            >
                Корзина товарів
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>
        <div v-if="totalPrice" class="offcanvas-body">
            <ul class="aside-cart-product-list">
                <li v-for="cart_product in products" class="aside-product-list-item">
                    <a @click.prevent="removeProduct(cart_product.product.id)" href="#/" class="remove">×</a>
                    <router-link :to="'/product/'+cart_product.product.id">
                        <img :src="cart_product.product.image_url" width="68" height="84" alt="Image">
                        <span class="product-title">{{cart_product.product.title.length<52 ? cart_product.product.title : cart_product.product.title.slice(0, 52)+'...'}}</span>
                    </router-link>
                    <span class="product-price">{{cart_product.qty}} × {{cart_product.product.price_special}}</span>
                </li>
            </ul>
            <p class="cart-total">
                <span>Всього:</span>
                <span class="amount">{{totalPrice}}</span>
            </p>
            <router-link
                class="btn-total"
                to="/cart"
                @click = "closeMenu"
            >
                В кошик
            </router-link>
            <button
                class="btn-total"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            >
                Продовжувати покупки
            </button>
        </div>
        <div v-else class="offcanvas-body">
            <h4>Кошик порожній</h4>
            <button
                class="btn-total"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            >
                Продовжувати покупки
            </button>
        </div>
    </aside>
    <!--== End Aside Cart ==-->
</template>

<script>
    import * as bootstrap from "bootstrap/dist/js/bootstrap";
    export default {
        name: "asideCart",
        props:['products', 'totalPrice'],
        data(){
            return {

            }
        },
        mounted() {

        },
        methods: {
            removeProduct(id){
                this.$emit('removeId', id);
            },
            closeMenu(){
                let myOffcanvas = document.getElementById('AsideOffcanvasCart');
                let bsOffcanvas = bootstrap.Offcanvas.getInstance(myOffcanvas);
                bsOffcanvas.hide();
            }
        }
    }
</script>

<style scoped>
    .btn-total{
        width: 100%;
    }
</style>
