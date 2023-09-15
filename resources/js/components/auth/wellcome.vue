<template>
    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <breadcrumb :pageTitle="pageTitle" ></breadcrumb>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start My Account Area Wrapper ==-->
        <!--desctop version -->
<!--        <section class="my-account-area section-space v-desc">
            <div class="container">
                <h2 class="page-header-title mb-3">Особистий кабінет</h2>
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="my-account-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="dashboad-tab" data-bs-toggle="tab" data-bs-target="#dashboad" type="button" role="tab" aria-controls="dashboad" aria-selected="true">Головна</button>
                            <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="orders" aria-selected="false"> Замовлення</button>
                            <button class="nav-link" id="payment-method-tab" data-bs-toggle="tab" data-bs-target="#payment-method" type="button" role="tab" aria-controls="payment-method" aria-selected="false">Спосіб оплати</button>
                            <button class="nav-link" id="address-edit-tab" data-bs-toggle="tab" data-bs-target="#address-edit" type="button" role="tab" aria-controls="address-edit" aria-selected="false">Адреса</button>
                            <button class="nav-link" id="account-info-tab" data-bs-toggle="tab" data-bs-target="#account-info" type="button" role="tab" aria-controls="account-info" aria-selected="false">Особиста інформація</button>
                            <button class="nav-link" id="password-edit-tab" data-bs-toggle="tab" data-bs-target="#password-edit" type="button" role="tab" aria-controls="password-edit" aria-selected="false">Пароль</button>
                            <button @click="logout" class="nav-link"  type="button">Вихід</button>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel" aria-labelledby="dashboad-tab">
                                <div class="myaccount-content">
                                    <h3><img :src="user.avatar_url" alt="" width="50"> Вітаю!</h3>                                  <div class="welcome">
                                    <p>Добрий день, <strong class="text-capitalize">{{user.name}} {{user.surname}}</strong> &lt;!&ndash;(If Not <strong>Tuntuni !</strong><a href="account-login.html" class="logout"> Logout</a>)&ndash;&gt;</p>
                                </div>
                                    <p>З інформаційної панелі вашого облікового запису. Ви можете легко перевіряти та переглядати свої останні замовлення, керувати адресами доставки та виставлення рахунків, а також редагувати пароль і дані облікового запису.</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                <div class="myaccount-content">
                                    <h3>Замовлення</h3>
                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>№</th>
                                                <th>Дата</th>
                                                <th>Статус</th>
                                                <th>Сума</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(order, key) in orders">
                                                <td>{{key+1}}</td>
                                                <td>{{formatDate(order.created_at)}}</td>
                                                <td>{{order.status === 0 ? 'Новий' : order.status ===1 ? 'Виконується' : 'Виконаний'}}</td>
                                                <td>{{order.total_price}}</td>
                                                <td>
                                                    <button
                                                        @click="getOrder(order.id)"
                                                        type="button"
                                                        class="btn-show-order"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#action-ShowOrder"
                                                    >
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="payment-method" role="tabpanel" aria-labelledby="payment-method-tab">
                                <div class="myaccount-content">
                                    <h3>Спосіб Оплати</h3>
                                    <p class="saved-message">Поки недоступно.</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="address-edit" role="tabpanel" aria-labelledby="address-edit-tab">
                                <div class="myaccount-content">
                                    <h3>Адреса</h3>
                                    <div v-if="message" class="alert alert-success">{{message}}</div>
                                    <address v-if="address">
                                        <p><strong>{{user.name}} {{user.surname}}</strong></p>
                                        <p>{{address.area}} обл., м. {{address.city}} <br>
                                            вул. {{address.street}}, буд. {{address.house_number}} <br>
                                            Поштовий індекс: {{address.postcode}}
                                        </p>
                                        <p>Номер телефона: {{user.phone}}</p>
                                    </address>
                                    <p v-else>Ви можете додати свою адресу</p>
                                    <button
                                        class="check-btn sqr-btn editor-address"
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#action-AddressEditor"
                                    >
                                        <i class="fa fa-edit"></i> {{address ? 'Змінити адресу' : 'Додати адресу'}}
                                    </button>
                                </div>
                            </div>

                            <div ref="start" class="tab-pane fade" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
                                <div class="myaccount-content">
                                    <h3>Особиста інформація</h3>
                                    <div v-if="message_edit_user" class="alert alert-success">{{message_edit_user}}</div>
                                    <div class="account-details-form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="first-name" class="">Ім'я</label>
                                                        <input
                                                            v-model="name"
                                                            class="form-control"
                                                            :class="{'is-invalid': errors_edit_user && errors_edit_user.name}"
                                                            type="text"
                                                            id="first-name"
                                                            placeholder="Ваше ім'я"
                                                        />
                                                        <div
                                                            v-if="errors_edit_user && errors_edit_user.name"
                                                            class="alert alert-danger "
                                                        >
                                                            {{errors_edit_user.name[0]}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="last-name" class="required">Прізвище</label>
                                                        <input
                                                            v-model="surname"
                                                            class="form-control"
                                                            :class="{'is-invalid': errors_edit_user && errors_edit_user.surname}"
                                                            type="text" id="last-name"
                                                            placeholder="Ваше прізвище"/>
                                                        <div
                                                            v-if="errors_edit_user && errors_edit_user.surname"
                                                            class="alert alert-danger "
                                                        >
                                                            {{errors_edit_user.surname[0]}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-input-item">
                                                <label for="display-name" class="required">Номер телефону</label>
                                                <input
                                                    v-model="phone"
                                                    class="form-control"
                                                    :class="{'is-invalid': errors_edit_user && errors_edit_user.phone}"
                                                    type="text"
                                                    id="display-name"
                                                    placeholder="Ваш номер телефону"
                                                />
                                                <div
                                                    v-if="errors_edit_user && errors_edit_user.phone"
                                                    class="alert alert-danger"
                                                >
                                                    {{errors_edit_user.phone[0]}}
                                                </div>
                                            </div>
                                            <div class="single-input-item">
                                                <label for="email" class="required">Електронна адреса</label>
                                                <input
                                                    v-model="email"
                                                    class="form-control"
                                                    :class="{'is-invalid': errors_edit_user && errors_edit_user.email}"
                                                    type="email"
                                                    id="email"
                                                    placeholder="Ваша адреса електронної пошти"/>
                                                <div
                                                    v-if="errors_edit_user && errors_edit_user.email"
                                                    class="alert alert-danger "
                                                >
                                                    {{errors_edit_user.email[0]}}
                                                </div>
                                            </div>
                                            <div class="form-group mb-6 dropzone-box">
                                                <div ref="avatarDropzone"  class="avatar-box">
                                                    Зображення акаунта
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </div>

                                            <div class="single-input-item">
                                                <button @click.prevent="editUserData" class="check-btn sqr-btn">Змінити</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="password-edit" role="tabpanel" aria-labelledby="password-edit">
                                <div class="myaccount-content">
                                    <h3>Пароль</h3>
                                    <div v-if="message_edit_password" class="alert alert-success">{{message_edit_password}}</div>
                                    <div class="account-details-form">
                                        <form action="#">
                                            <fieldset>
                                                <legend>Змінити пароль</legend>
                                                <div class="single-input-item">
                                                    <label for="current-pwd" class="required">Діючий пароль</label>
                                                    <input
                                                        v-model="current_password"
                                                        class="form-control"
                                                        :class="{'is-invalid': errors_edit_password && errors_edit_password.current_password}"
                                                        type="password"
                                                        id="current-pwd"
                                                        placeholder="Діючий пароль"/>
                                                    <div
                                                        v-if="errors_edit_password && errors_edit_password.current_password"
                                                        class="alert alert-danger "
                                                    >
                                                        {{errors_edit_password.current_password[0]}}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="new-pwd" class="required">Новий пароль</label>
                                                            <input
                                                                v-model="password"
                                                                class="form-control"
                                                                :class="{'is-invalid': errors_edit_password && errors_edit_password.password}"
                                                                type="password"
                                                                id="new-pwd"
                                                                placeholder="Новий пароль"/>
                                                            <div
                                                                v-if="errors_edit_password && errors_edit_password.password"
                                                                class="alert alert-danger "
                                                            >
                                                                {{errors_edit_password.password[0]}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="confirm-pwd" class="required">Підтвердити новий пароль</label>
                                                            <input
                                                                v-model="password_confirmation"
                                                                class="form-control"
                                                                :class="{'is-invalid': errors_edit_password && errors_edit_password.password}"
                                                                type="password"
                                                                id="confirm-pwd"
                                                                placeholder="Підтвердіть новий пароль"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="single-input-item">
                                                <button @click.prevent="editPassword" class="check-btn sqr-btn">Змінити пароль</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        <v_desctop
            v-if="windowWidth>767"
            :orders="orders"
            :user="user"
            :address="address"
            :order_products="order_products"
            :formatDate="formatDate"
            :getUser="getUser"
            :logout="logout"
            :message_edit_user="message_edit_user"
            :errors_edit_user="errors_edit_user"
            :message_edit_password="message_edit_password"
            :errors_edit_password="errors_edit_password"
            @editUserData="editUserData"
            @passwordData="editPassword"
        ></v_desctop>
        <!--mobile version -->
        <v_mobile v-else
                  :orders="orders"
                  :user="user"
                  :address="address"
                  :order_products="order_products"
                  :formatDate="formatDate"
                  :getUser="getUser"
                  :logout="logout"
                  :message_edit_user="message_edit_user"
                  :errors_edit_user="errors_edit_user"
                  :message_edit_password="message_edit_password"
                  :errors_edit_password="errors_edit_password"
                  @editUserData="editUserData"
                  @passwordData="editPassword"
        ></v_mobile>
        <!--== End My Account Area Wrapper ==-->
    </main>
    <ScaleLoader
        :loading="statusLoader"
        color="#ff6565"
        height="20px"
        width="5px"
    />
</template>

<script>
    import Api from '../../api.js';
    import breadcrumbs from "../elements/breadcrumb/_breadcrumbs.vue";
    import v_desctop from "../elements/wellcome/_v-desctop.vue";
    import v_mobile from "../elements/wellcome/_v-mobile.vue";
    import show_order_modal from "../elements/modal/_show_order_modal.vue";
    import address_editor_modal from "../elements/modal/_address_editor_modal.vue";
    import { ScaleLoader } from "vue3-spinner";


    export default {
        name: "welcome",
        // meta info
        metaInfo:{
            title: 'Особистий кабінет'
        },
        data(){
            return{
                user: {},
                orders: [],
                address: {},
                message_edit_user: null,
                message_edit_password: null,
                errors_edit_user: {},
                error_password_matches: null,
                error_same_password: null,
                errors_edit_password: null,
                /*name: null,
                surname: null,
                phone: null,
                email: null,
                avatar: null,*/

                removeImage: false,
                pageTitle: 'Особистий кабінет',
                statusLoader: true,
                windowWidth: window.innerWidth
            }
        },
        components:{
            ScaleLoader,
            breadcrumbs,
            v_desctop,
            v_mobile,
            show_order_modal,
            address_editor_modal
        },
        mounted() {
            this.$nextTick(() => {
                window.addEventListener('resize', this.onResize);
            });
            this.getUser();
        },
        beforeDestroy() {
            window.removeEventListener('resize', this.onResize);
        },
        methods:{
            onResize() {
                this.windowWidth = window.innerWidth
            },
            editPassword(data){
                this.statusLoader=true;
                this.errors_edit_password = null;
                this.message_edit_password = null;
                Api.post('/api/auth/update-password', data).then(response => {
                    this.message_edit_password = response.data.message;
                    this.statusLoader=false;
                }).catch(error => {
                    this.statusLoader=false;
                    this.errors_edit_password = error.response.data.errors;
                })
            },
            editUserData(data){
                this.statusLoader=true;
                this.message_edit_user = null;
                this.errors_edit_user = {};
                Api.post(`/api/auth/update-user/${this.user.id}`, data)
                    .then(result=>{
                        this.message_edit_user = result.data.message;
                        this.getUser();
                        this.removeImage=false;
                        this.statusLoader=false;
                    })
                    .catch(error=>{
                        this.errors_edit_user = error.response.data.errors;
                        this.statusLoader=false;
                    })
            },

            getUser(){
                Api.post('/api/get-auth-user').then(response => {
                    this.user = response.data.user;
                    this.orders = response.data.user.orders;
                    this.address = response.data.user.address;
                    this.name = response.data.user ? response.data.user.name : null;
                    this.surname = response.data.user ? response.data.user.surname : null;
                    this.phone = response.data.user ? response.data.user.phone : null;
                    this.email = response.data.user ? response.data.user.email : null;
                    this.avatar = response.data.user ? response.data.user.avatar_url : null;
                    this.statusLoader = false;
                })
            },

            formatDate(dateSting){
                const date=new Date(dateSting);
                return new Intl.DateTimeFormat('uk', {dateStyle: 'long'}).format(date);
            },
            logout(){
                Api.post('/api/auth/logout').then(res=>{
                    localStorage.removeItem('access_token');
                    this.getAccessToken();
                    this.$emit('logout_status', true)
                    this.$router.push({name:'user.login'})
                });
            },
            getAccessToken(){
                this.access_token = localStorage.getItem('access_token')
            },
        }
    }
</script>

<style>
    .btn-show-order{
        background: transparent;
        border: none;
        font-size: 20px;
        color: #FF6565;
    }
    .btn-show-order:hover{
        color: #0a001f;
    }
    .myaccount-content h3 img{
        margin-right: 20px;
    }
    .myaccount-content .editor-address{
        background: transparent;
        border: none;
    }
    .myaccount-content .editor-address:hover{
        color: #FF6565;
    }

    .dz-remove-icon{
        display: none;
    }
    .avatar-box{
        overflow-wrap: break-word;
    }

    @media only screen and (max-width: 575px) {
        .dz-remove-text{
            display: none;
        }
        .dz-remove-icon{
            display: inline-block;
            margin-left: 0 !important;
        }
        .dz-remove:hover .dz-remove-icon{
            color: #ff6565;
        }

    }
</style>
