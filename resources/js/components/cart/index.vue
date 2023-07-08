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
                        Кошик
                    </li>

                </ol>
            </div>
        </nav>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Product Area Wrapper ==-->
        <section class="section-space">
            <div class="container">
                <div class="shopping-cart-form table-responsive">
                    <form>
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th class="product-remove">&nbsp;</th>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name">Товар</th>
                                <th class="product-price">Ціна</th>
                                <th class="product-quantity">Кількість</th>
                                <th class="product-subtotal">Загальна сума</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(cart_product, index) in products" class="tbody-item">
                                    <td class="product-remove">
                                        <a @click.prevent="removeProduct(index), preloader()" class="remove" >×</a>
                                    </td>
                                    <td class="product-thumbnail">
                                        <div class="thumb">
                                            <router-link :to="'/product/'+cart_product.product.id" href="single-product.html">
                                                <img :src="'/storage/images/'+cart_product.product.image" width="68" height="84" alt="Image-HasTech">
                                            </router-link>
                                        </div>
                                    </td>
                                    <td class="product-name">
                                        <router-link class="title" :to="'/product/'+cart_product.product.id">{{cart_product.product.title}}</router-link>
                                    </td>
                                    <td class="product-price">
                                        <span class="price">{{cart_product.product.price_special}} &#x20b4</span>
                                    </td>
                                    <td class="product-quantity">
                                        <!--<div @click="getTotalPrice(cart_product.product.price_special, index)" class="pro-qty">
                                            <input
                                                @input="totalPrice=$event.currentTarget.value"
                                                type="text"
                                                class="quantity"
                                                title="Quantity"
                                                :value="cart_product.qty">
                                        </div>-->
                                        <div class="quantity-toggle">
                                            <button @click.prevent="decrement(index)" class="dec qty-btn">-</button>
                                            <input type="text" :value="cart_product.qty" readonly>
                                            <button @click.prevent="increment(index)" class="inc qty-btn">+</button>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="price">{{cart_product.product.price_special * cart_product.qty}} &#x20b4</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="row">
                    <!--<div class="col-12 col-lg-6">
                        <div class="coupon-wrap">
                            <h4 class="title">Coupon</h4>
                            <p class="desc">Enter your coupon code if you have one.</p>
                            <input type="text" class="form-control" placeholder="Coupon code">
                            <button type="button" class="btn-coupon">Apply coupon</button>
                        </div>
                    </div>-->
                    <div class="col-12 col-lg-6">
                        <div class="cart-totals-wrap">
                            <h2 class="title">Сума замовлення</h2>
                            <table>
                                <tbody>
                                <tr class="cart-subtotal">
                                    <th>Сума</th>
                                    <td>
                                        <span class="amount">{{totalPrice}}</span>
                                    </td>
                                </tr>
                                <!--<tr class="shipping-totals">
                                    <th>Shipping</th>
                                    <td>
                                        <ul class="shipping-list">
                                            <li class="radio">
                                                <input type="radio" name="shipping" id="radio1" checked>
                                                <label for="radio1">Flat rate: <span>$3.00</span></label>
                                            </li>
                                            <li class="radio">
                                                <input type="radio" name="shipping" id="radio2">
                                                <label for="radio2">Free shipping</label>
                                            </li>
                                            <li class="radio">
                                                <input type="radio" name="shipping" id="radio3">
                                                <label for="radio3">Local pickup</label>
                                            </li>
                                        </ul>
                                        <p class="destination">Shipping to <strong>USA</strong>.</p>
                                        <a href="javascript:void(0)" class="btn-shipping-address">Change address</a>
                                    </td>
                                </tr>
                                <tr class="order-total">
                                    <th>Total</th>
                                    <td>
                                        <span class="amount">$504.00</span>
                                    </td>
                                </tr>-->
                                </tbody>
                            </table>
                            <div class="text-end">
                                <router-link to="/checkout" class="checkout-button"> Оформлення замовлення</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Product Area Wrapper ==-->
    </main>
    <ScaleLoader
        :loading="statusLoader"
        color="#ff6565"
        height="20px"
        width="5px"
    />
</template>

<script>
    import { ScaleLoader } from "vue3-spinner";
    export default {
        name: "index",
        data(){
            return{
                products: {},
                totalPrice: 0,
                quantity: 1,
                statusLoader: true
            }
        },
        components:{
            ScaleLoader
        },
        mounted() {
            $(document).trigger('change');
            this.getCartProducts();
        },
        methods:{
            getCartProducts(){
                this.products = JSON.parse(localStorage.getItem('cart'));
                this.getTotalPrice(this.products);
                this.preloader();
            },

            increment (index) {
                this.products[index].qty++;
                this.getTotalPrice(this.products);
                localStorage.setItem('cart', JSON.stringify(this.products))
                this.$emit('countStatusCart', this.products);
            },
            decrement (index) {
                this.products[index].qty>1 ? this.products[index].qty-- : this.products[index].qty;
                this.getTotalPrice(this.products);
                localStorage.setItem('cart', JSON.stringify(this.products));
                this.$emit('countStatusCart', this.products);
            },
            getTotalPrice(cartProduct){
                this.totalPrice = 0;
                cartProduct.forEach(product=>{
                    this.totalPrice += product.product.price_special * product.qty;
                })
                localStorage.setItem('cart_total', JSON.stringify(this.totalPrice));

            },
            removeProduct(index){
                let products = JSON.parse(localStorage.getItem('cart'));
                products.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(products));
                this.getCartProducts();
                this.$emit('countStatusCart', products);
            },
            preloader(){
                this.statusLoader=true;
                setTimeout(()=>{this.statusLoader= false}, 1000);
            },

        }
    }
</script>

<style>
    .quantity-toggle{
        display: inline-block;
        position: relative;
    }
    .quantity-toggle input {
        width: 170px;
        height: 50px;
        font-size: 13px;
        border: 2px solid #E63946;
        border-radius: 50px;
        color: #231942;
        font-weight: 700;
        padding: 0 55px 0;
        text-align: center;
    }
    .quantity-toggle .qty-btn {
        cursor: pointer;
        position: absolute;
        line-height: 21px;
        color: #555555;
        height: 25px;
        top: 50%;
        transform: translate(0%, -50%);
        font-size: 28px;
        width: 53px;
        text-align: center;
        transition: all 0.5s ease 0s;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border:none;
        background: transparent;
    }
    .quantity-toggle .qty-btn:hover {
        color: #FF6565;
    }
    .quantity-toggle .dec {
        left: 0;
        border-right: 1px solid #CDCDCD;
        padding-left: 5px;
        line-height: 22px;
    }
    .quantity-toggle .inc {
        right: 0;
        border-left: 1px solid #CDCDCD;
        padding-right: 5px;
    }

</style>
