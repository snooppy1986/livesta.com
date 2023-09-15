<template>
    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <breadcrumbs :pageTitle="pageTitle"></breadcrumbs>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Product Area Wrapper ==-->
        <section class="section-space">
            <div class="container">
                <div class="row d-flex justify-content-center my-4">
                    <div class="col-md-8">
                        <div class="card mb-4 cart-box">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Кошик - {{totalQty}} тов.</h5>
                            </div>
                            <div class="card-body">
                                <!-- Single item -->
                                <div v-for="(cart_product, index) in products" class="row">
                                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                        <!-- Image -->
                                        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                            <img :src="cart_product.product.image_url"
                                                 class="w-100" alt="Blue Jeans Jacket" />
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                            </a>
                                        </div>
                                        <!-- Image -->
                                    </div>

                                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                        <!-- Data -->
                                        <router-link :to="'/product/'+cart_product.product.id"><strong>{{cart_product.product.title}}</strong></router-link>
                                        <p>Категорія: {{cart_product.product.category[0].title}}</p>
                                        <p>Об'єм: {{cart_product.product.attributes.weight}}</p>
                                        <button
                                            @click.prevent="removeProduct(index), preloader()"
                                            type="button"
                                            class="btn btn-danger btn-sm me-1 mb-2"
                                            data-mdb-toggle="tooltip"
                                                title="Видалити">
                                            <i class="fa fa-trash text-white"></i>
                                        </button>
                                        <!-- Data -->
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                        <!-- Quantity -->
                                        <div class="d-flex mb-4 qty-box" style="max-width: 300px">
                                            <button class="btn btn-outline-info px-3 me-2"
                                                    @click.prevent="decrement(index)">
                                                <i class="fa fa-minus text-info"></i>
                                            </button>

                                            <div class="form-outline">
                                                <input
                                                    :value="cart_product.qty"
                                                    min="1"
                                                    name="quantity"
                                                    value="1"
                                                    type="number"
                                                    class="form-control border border-info"
                                                    readonly/>

                                            </div>

                                            <button class="btn btn-outline-info px-3 ms-2"
                                                    @click.prevent="increment(index)">
                                                <i class="fa fa-plus text-info"></i>
                                            </button>
                                        </div>
                                        <!-- Quantity -->

                                        <!-- Price -->
                                        <p class="text-start text-md-center">
                                            <strong>{{cart_product.product.price_special * cart_product.qty}} &#x20b4</strong>
                                        </p>
                                        <!-- Price -->
                                    </div>
                                    <hr class="my-4" />
                                </div>
                                <!-- Single item -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Підсумок</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Сума
                                        <span>{{totalPrice}} &#x20b4</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Доставка
                                        <span>За тарифами перевізника</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                            <strong>Сума замовлення</strong>
                                            <strong>
                                                <p class="mb-0">(без послуг перевізника)</p>
                                            </strong>
                                        </div>
                                        <span><strong>{{totalPrice}} &#x20b4</strong></span>
                                    </li>
                                </ul>

                                <router-link to="/checkout" class="btn btn-primary btn-lg btn-block">Оформити</router-link>
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
    import breadcrumbs from "../elements/breadcrumb/_breadcrumbs.vue"
    export default {
        name: "index",
        // meta info
        metaInfo:{
            title: 'Кошик'
        },
        data(){
            return{
                products: {},
                totalPrice: 0,
                totalQty: 0,
                quantity: 1,
                pageTitle: "Кошик",
                statusLoader: true
            }
        },
        components:{
            ScaleLoader,
            breadcrumbs
        },
        mounted() {
            $(document).trigger('change');
            this.getCartProducts();
        },
        methods:{
            getCartProducts(){
                this.products = JSON.parse(localStorage.getItem('cart'));
                console.log(this.products);
                this.getTotalPrice(this.products);
                this.totalQty = this.getTotalQty(this.products);
                this.preloader();
            },

            increment (index) {
                console.log(index);
                this.products[index].qty++;
                this.getTotalPrice(this.products);
                localStorage.setItem('cart', JSON.stringify(this.products));
                this.totalQty = this.getTotalQty(this.products);
                this.$emit('countStatusCart', this.products);
            },
            decrement (index) {
                console.log(index);
                this.products[index].qty>1 ? this.products[index].qty-- : this.products[index].qty;
                this.getTotalPrice(this.products);
                localStorage.setItem('cart', JSON.stringify(this.products));
                this.totalQty = this.getTotalQty(this.products);
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

            getTotalQty(products){
                let qty = 0;
                products.forEach(product=>{
                    qty += product.qty
                })
                return qty;
            }

        }
    }
</script>

<style>
    .cart-box .btn{
        border-radius: 5px;
        font-size: 16px;
        letter-spacing: 0;

    }
    .qty-box .btn{
        background: none;
        border: 1px solid rgba(23,162,184);
        height: 42px;
        padding: 0;
    }
    /*.quantity-toggle{
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
    }*/

</style>
