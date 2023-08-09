<template>
    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <section class="page-header-area pt-10 pb-9" data-bg-color="#FFF3DA">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="page-header-st3-content text-center text-md-start">
                            <ol class="breadcrumb justify-content-center justify-content-md-start">
                                <li class="breadcrumb-item">
                                    <router-link class="text-dark" to="/">
                                        <i class="fa fa-home"></i>
                                    </router-link>
                                </li>
                                <li class="breadcrumb-item">Особистий кабінет</li>

                            </ol>
                            <h2 class="page-header-title">Особистий кабінет</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start My Account Area Wrapper ==-->
        <section class="my-account-area section-space">
            <div class="container">
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
                                        <p>Добрий день, <strong class="text-capitalize">{{user.name}} {{user.surname}}</strong> <!--(If Not <strong>Tuntuni !</strong><a href="account-login.html" class="logout"> Logout</a>)--></p>
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
                                                <div ref="avatarDropzone" class="avatar-box">
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
        </section>
        <!--== End My Account Area Wrapper ==-->
    </main>
    <ScaleLoader
        :loading="statusLoader"
        color="#ff6565"
        height="20px"
        width="5px"
    />
    <show_order_modal :order="order" :order_products="order_products"></show_order_modal>
    <address_editor_modal  :address="address" :user_id="user.id" @message="getMessage"></address_editor_modal>
</template>

<script>
    import Api from '../../api.js';
    import Dropzone from 'dropzone';
    import show_order_modal from "../elements/show_order_modal.vue";
    import address_editor_modal from "../elements/address_editor_modal.vue";
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
                order: [],
                order_products: [],
                address: {},
                message: null,
                message_edit_user: null,
                message_edit_password: null,
                errors_edit_user: {},
                error_password_matches: null,
                error_same_password: null,
                errors_edit_password: null,
                name: null,
                surname: null,
                phone: null,
                email: null,
                avatar: null,
                current_password: null,
                password: null,
                password_confirmation: null,
                removeImage: false,
                statusLoader: true
            }
        },
        components:{
            show_order_modal,
            address_editor_modal,
            ScaleLoader
        },
        mounted() {
            this.getUser();
            const dropzone = document.querySelector('.dropzone-box');
            this.avatar_dropzone = new Dropzone(this.$refs.avatarDropzone,{
                url: '/login',
                autoProcessQueue: false,
                addRemoveLinks: true,
                maxFiles: 1,
                thumbnailWidth: 50,
                thumbnailHeight: 50,
                dictRemoveFile: '<div class=""><i class="fa fa-trash " aria-hidden="true"></i> Видалити</div>',
                multiple: false,
                success: function (file, response) {
                    console.log('success');
                    this.removeFile(file);
                }

            })
            this.avatar_dropzone.on('removedfile', (file)=>{
                this.removeImage = true;
            })
            this.avatar_dropzone.on('addedfile', (file)=>{
                this.removeImage = false;
            })
            this.avatar_dropzone.on("maxfilesexceeded", function (file) {
                this.removeAllFiles();
                this.addFile(file);

            })

            dropzone.querySelector(".dz-clickable").addEventListener('click', function () {
                dropzone.querySelector('.dz-complete').style.display = "none";
            })

        },
        methods:{
            editPassword(){
                this.errors_edit_password = null;
                Api.post('/api/auth/update-password', {
                    current_password: this.current_password,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then(response => {
                    this.message_edit_password = response.data.message;
                    this.current_password = null;
                    this.password = null;
                    this.password_confirmation = null;
                }).catch(error => {
                    console.log(error);
                    this.errors_edit_password = error.response.data.errors;
                })
            },
            editUserData(){
                this.message_edit_user = null;
                this.errors_edit_user = {};
                //Form data
                const data = new FormData();
                const files = this.avatar_dropzone.getAcceptedFiles();
                files.forEach(file => {
                    data.append('avatar[]', file);
                    this.avatar_dropzone.removeFile(file);
                });
                data.append('name', this.name);
                data.append('surname', this.surname);
                data.append('phone', this.phone);
                data.append('email', this.email);
                data.append('password', this.password);
                data.append('password_confirmation', this.confirm_password);
                data.append('remove_image', this.removeImage);
                data.append('_method', 'PATCH');

                Api.post(`/api/auth/update-user/${this.user.id}`, data)
                    .then(result=>{
                        this.message_edit_user = result.data.message;
                        this.getUser();
                        this.$refs.start.scrollIntoView({behavior: 'smooth'});
                        this.removeImage=false;
                    })
                    .catch(error=>{
                        this.errors_edit_user = error.response.data.errors;
                        this.$refs.start.scrollIntoView({behavior: 'smooth'})
                    })
            },
            getMessage(value){
                this.message = value;
                this.getUser();
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

                    //get file to dropzone
                    let file = { name: this.user.avatar, size: response.data.size };
                    this.avatar_dropzone.displayExistingFile(file, this.user.avatar_url);
                    //loader off
                    this.statusLoader = false;
                })
            },
            getOrder(id){
                Api.post('/api/auth/get-order', {
                    order_id: id
                }).then(result => {
                    console.log(result.data.order.products);
                    this.order = result.data.order;
                    this.order_products = result.data.order.products
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

<style scoped>
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
</style>
