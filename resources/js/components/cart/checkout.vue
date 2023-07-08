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
                        <router-link class="text-dark" to="/cart">
                            Кошик
                        </router-link>
                    </li>

                    <li class="breadcrumb-item">
                        Оформлення замовлення
                    </li>

                </ol>
            </div>
        </nav>
        <!--== End Page Header Area Wrapper ==-->


        <!--== Start Shopping Checkout Area Wrapper ==-->
        <section class="shopping-checkout-wrap section-space">
            <div class="container">
                <div class="checkout-page-coupon-wrap">
                    <!--== Start Checkout Coupon Accordion ==-->
                    <!--<div class="coupon-accordion" id="CouponAccordion">
                        <div class="card">
                            <h3>
                                <i class="fa fa-info-circle"></i>
                                Have a Coupon?
                                <a href="#/" data-bs-toggle="collapse" data-bs-target="#couponaccordion">Click here to enter your code</a>
                            </h3>
                            <div id="couponaccordion" class="collapse" data-bs-parent="#CouponAccordion">
                                <div class="card-body">
                                    <div class="apply-coupon-wrap">
                                        <p>If you have a coupon code, please apply it below.</p>
                                        <form action="#" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" placeholder="Coupon code">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn-coupon">Apply coupon</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <!--== End Checkout Coupon Accordion ==-->
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <!--== Start Billing Accordion ==-->
                        <div class="checkout-billing-details-wrap">
                            <h2 ref="start" class="title">Оформлення замовлення</h2>
                            <div class="billing-form-wrap">
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="f_name">Ім'я <abbr class="required" title="required">*</abbr></label>
                                                <input  v-model="name" :class="{'is-invalid': errors ? errors.name : ''}" id="f_name" type="text" class="form-control">
                                                <div v-if="errors && errors.name" class="alert alert-danger">
                                                    {{errors.name[0]}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="l_name">Прізвище <abbr class="required" title="required">*</abbr></label>
                                                <input v-model="surname" :class="{'is-invalid': errors ? errors.surname : ''}" id="l_name" type="text" class="form-control">
                                                <div v-if="errors && errors.surname" class="alert alert-danger">
                                                    {{errors.surname[0]}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Телефон <abbr class="required" title="required">*</abbr></label>
                                                <input v-model="phone" :class="{'is-invalid': errors ? errors.phone : ''}" id="phone" type="text" class="form-control">
                                                <div v-if="errors && errors.phone" class="alert alert-danger">
                                                    {{errors.phone[0]}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">Електронна пошта (не обов'язково)</label>
                                                <input v-model="email" :class="{'is-invalid': errors ? errors.email : ''}" id="email" type="text" class="form-control">
                                                <div v-if="errors && errors.email" class="alert alert-danger">
                                                    {{errors.email[0]}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mb-0">
                                                <div id="DeliveryMethodAccordion">
                                                    <div class="card">
                                                        <div class="card-header" id="delivery_1">
                                                            <h5
                                                                @click.prevent="setDeliveryMethod('newMail')"
                                                                class="title"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#itemDeliveryOne"
                                                                aria-controls="itemDeliveryOne"
                                                                aria-expanded="false"
                                                            >
                                                                Нова Пошта
                                                            </h5>
                                                        </div>
                                                        <div id="itemDeliveryOne" class="collapse" aria-labelledby="delivery_1" data-bs-parent="#DeliveryMethodAccordion">
                                                            <NewMail @addressDelivery="setDeliveryAddress"></NewMail>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="delivery_2">
                                                            <h5
                                                                @click.prevent="setDeliveryMethod('pickup')"
                                                                class="title"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#itemDeliveryTwo"
                                                                aria-controls="itemDeliveryTwo"
                                                                aria-expanded="false"
                                                            >
                                                                Самовивіз
                                                            </h5>
                                                        </div>
                                                        <div id="itemDeliveryTwo" class="collapse" aria-labelledby="delivery_2" data-bs-parent="#DeliveryMethodAccordion">
                                                            <div class="card-body">
                                                                <div class="mapouter">
                                                                    <div class="gmap_canvas">
                                                                        <iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=николаев 2-а проспект мира&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                                                                        <a href="https://capcuttemplate.org/">Capcuttemplate.org</a>
                                                                    </div>
                                                                </div>
                                                                <p>Самовивіз з роздрібного магазину можливий, якщо товар в наявності безпосередньо в магазині. Інформацію, стосовно наявності замовленого товару, Ви отримаєте від менеджера під час опрацювання замовлення. Замовлення з роздрібного магазину можна буде забрати після дзвінка з магазину, про готовність замовлення до видачі, або після отримання смс повідомлення про готовність замовлення. Термін зберігання замовлення - 3 дні з моменту готовності.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mb-0">
                                                <label for="order-notes">Примітки до замовлення (не обов'язково)</label>
                                                <textarea v-model="notes" :class="{'is-invalid': errors ? errors.notes : ''}" id="order-notes" class="form-control" placeholder="Примітки щодо вашого замовлення, напр. спеціальні примітки для доставки."></textarea>
                                                <div v-if="errors && errors.notes" class="alert alert-danger">
                                                    {{errors.notes[0]}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--== End Billing Accordion ==-->
                    </div>
                    <div class="col-lg-6">
                        <!--== Start Order Details Accordion ==-->
                        <div class="checkout-order-details-wrap">
                            <div class="order-details-table-wrap table-responsive">
                                <h2 class="title mb-25">Ваше замовлення</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Продукт</th>
                                            <th class="product-total">Сума</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        <tr v-for="cart_product in products" class="cart-item">
                                            <td class="product-name">{{cart_product.product.title}} <span class="product-quantity">× {{cart_product.qty}}</span></td>
                                            <td class="product-total">{{cart_product.product.price_special}}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-foot">
                                        <tr class="cart-subtotal">
                                            <th>Всього до сплати</th>
                                            <td>{{totalPrice}}</td>
                                        </tr>
                                        <!--<tr class="shipping">
                                            <th>Shipping</th>
                                            <td>Flat rate: £2.00</td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total </th>
                                            <td>£91.99</td>
                                        </tr>-->
                                    </tfoot>
                                </table>
                                <div class="shop-payment-method">
                                    <div id="PaymentMethodAccordion">
                                        <div v-if="deliveryMethod=='pickup'" class="card">
                                            <div class="card-header" id="check_payments">
                                                <h5
                                                    @click="paymentMethod='cash'"
                                                    class="title"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#itemOne"
                                                    aria-controls="itemOne"
                                                    aria-expanded="false"
                                                >
                                                    Готівкова
                                                </h5>
                                            </div>
                                            <div id="itemOne" class="collapse" aria-labelledby="check_payments" data-bs-parent="#PaymentMethodAccordion">
                                                <div class="card-body">
                                                    <p>Під час кур`єрської доставки по Миколаєву чи під час самовивозу</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="check_payments2">
                                                <h5
                                                    @click="paymentMethod='cashless'"
                                                    class="title"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#itemTwo"
                                                    aria-controls="itemTwo"
                                                    aria-expanded="false"
                                                >
                                                    Безготівкова
                                                </h5>
                                            </div>
                                            <div id="itemTwo" class="collapse" aria-labelledby="check_payments2" data-bs-parent="#PaymentMethodAccordion">
                                                <div class="card-body">
                                                    <p>Оплата за виставленим рахунком в будь-якому Банку, пункті прийому платежів або платіжному терміналі. Після підтвердження замовлення, консультант інтернет-магазину надішле Вам на електронну пошту рахунок, який Ви зможете оплатити протягом 3-х робочих днів</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="deliveryMethod=='newMail'" class="card">
                                            <div class="card-header" id="check_payments3">
                                                <h5
                                                    @click="paymentMethod='cod'"
                                                    class="title"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#itemThree"
                                                    aria-controls="itemTwo"
                                                    aria-expanded="false"
                                                >
                                                    Післяплата
                                                </h5>
                                            </div>
                                            <div id="itemThree" class="collapse" aria-labelledby="check_payments3" data-bs-parent="#PaymentMethodAccordion">
                                                <div class="card-body">
                                                    <p>Кур'єрські служби беруть додаткову плату за цю послугу, як правило це % від вартості замовлення, розмір якого залежить від умов конкретної служби доставки.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="check_payments4">
                                                <h5
                                                    @click="paymentMethod='credit_card'"
                                                    class="title"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#itemFour"
                                                    aria-controls="itemTwo"
                                                    aria-expanded="false"
                                                >
                                                    Visa/MasterCard
                                                </h5>
                                            </div>
                                            <div id="itemFour" class="collapse" aria-labelledby="check_payments4" data-bs-parent="#PaymentMethodAccordion">
                                                <div class="card-body">
                                                    <p>При будь-якому способі доставки. Ви можете оплатити своє замовлення безпосередньо на сайті картою Visa або MasterCard будь-якого банку.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="p-text">Згода на обробку даних</p>
                                    <div class="agree-policy">
                                        <div class="custom-control custom-checkbox">
                                            <input
                                                v-model="status_privace"
                                                name="privace"
                                                type="checkbox"
                                                id="privacy"
                                                class="custom-control-input visually-hidden">
                                            <label for="privacy" class="custom-control-label">
                                                Приймаю
                                                <!--<a href="#/" class="popup-open a">"угоду користувача"</a>-->
                                                <button
                                                    type="button"
                                                    class="popup-open"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#action-TermOfUse"

                                                >
                                                    угоду користувача
                                                </button>
                                                інтернет-магазину.<span class="required">*</span>
                                            </label>
                                        </div>
                                    </div>
                                    <button
                                        @click="checkout"
                                        :disabled="!status_privace"
                                        class="btn-place-order"
                                        :class="{disabled: !status_privace}"
                                    >
                                        Підтвердити замовлення
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!--== End Order Details Accordion ==-->
                    </div>
                </div>
            </div>
        </section>
        <!--== End Shopping Checkout Area Wrapper ==-->

    </main>
    <term_of_use_modal></term_of_use_modal>
</template>

<script>
    import Api from '../../api.js';
    import axios from 'axios';
    import NewMail from "../../components/elements/delivery/new_mail.vue";
    import term_of_use_modal from "../elements/term_of_use_modal.vue";
    import api from "../../api";
    export default {
        name: "checkout",
        data(){
            return{
                user: {},
                products: {},
                totalPrice:0,
                name: null,
                surname: null,
                phone: null,
                email: null,
                notes: null,
                deliveryMethod: null,
                deliveryAddress: {},
                paymentMethod: null,
                errors: {},
                status_privace: false
            }
        },
        components:{
            NewMail,
            term_of_use_modal
        },
        mounted() {
            this.getProducts();
            this.getTotalPrice();
            this.getUser();
        },
        methods:{
            checkout(){
                this.errors=null;
                  Api.post('/api/order/store', {
                      name: this.name,
                      surname: this.surname,
                      phone: this.phone,
                      email: this.email,
                      notes: this.notes,
                      deliveryMethod: this.deliveryMethod,
                      deliveryAddress: this.deliveryAddress,
                      paymentMethod: this.paymentMethod,
                      totalPrice: this.totalPrice,
                      products: this.products,
                      user_id: this.user.id,
                  }).then(result=>{
                      console.log(result.data.status);
                      localStorage.removeItem('cart');
                      localStorage.removeItem('cart_total');
                      if(result.data.status)
                        this.$router.push({name:'checkout.success'});
                  }).catch(error=>{
                        this.errors = error.response.data.errors;
                        this.$refs.start.scrollIntoView({behavior: 'smooth'})
                  })
            },
            getProducts(){
                this.products = JSON.parse(localStorage.getItem('cart'));
            },
            getTotalPrice(){
                this.totalPrice = JSON.parse(localStorage.getItem('cart_total'));
            },
            setDeliveryMethod(value){
                this.deliveryMethod = value
                console.log(this.deliveryMethod);
            },
            setDeliveryAddress(value){
                this.deliveryAddress = value
            },
            getUser(){
                api.post('/api/auth/get-auth-user').then(
                    res=>{
                        this.user = res.data.user;
                    }
                )
            },
        }
    }
</script>

<style scoped>
    .btn-place-order{
        width: 100%;
    }
    .billing-form-wrap .card{
        background-color: transparent;
        border-radius: 0;
        border: none;
        margin-bottom: 10px;
    }
    .billing-form-wrap .card-header{
        border: none;
        background-color: transparent;
        padding: 0;
        display: inline-block;
    }
    .billing-form-wrap .card-header:hover{
        cursor:pointer;
    }
    .billing-form-wrap .card .card-header .title{
        display: inline-block;
        font-weight: 400;
        font-size: 14px;
        margin-bottom: 0;
        position: relative;
        padding-left: 20px;
        padding-bottom: 0;
        text-transform: uppercase;
    }
    .billing-form-wrap .card .card-header .title:before{
        position: absolute;
        content: "";
        background-color: #fff;
        border: 1px solid #666;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        left: 0;
    }
    .billing-form-wrap .card .card-header .title:after{
        position: absolute;
        content: "";
        width: 6px;
        height: 6px;
        background-color: #0075ff;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        left: 3px;
        display: none;
    }
    .billing-form-wrap .card .card-header .title[aria-expanded=true]::after {
        display: block !important;
    }
    .title[aria-expanded=true]::before{border-color: #0075ff !important; }

    .billing-form-wrap .card .card-body p{
        color: #747474;
        font-size: 13px;
        line-height: 24px;
    }
    #novapochta .icon-np{
        display: inline-block;
    }
    #novapochta .icons-h2{
        display: inline-block;
        font-size: 14px;
        margin-left: 20px;
        margin-bottom: 15px;
    }
    #itemDeliveryTwo p{
        font-size: 16px;
        display: block;
        margin-top: 15px;
    }
    .mapouter{
        position:relative;
        text-align: left;
        width:500px;
        height:300px;
    }
    .gmap_canvas {
        overflow:hidden;
        background:none!important;
        width:500px;
        height:300px;
    }
    .gmap_iframe {
        width:500px!important;
        height:300px!important;
    }
    .popup-open{
        border:none;
        background: transparent;
        color: #FF6565;
    }
    .popup-open:hover{
        color: #0994bc;
    }
</style>
