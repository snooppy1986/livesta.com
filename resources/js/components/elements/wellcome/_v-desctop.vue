<template>
    <section class="my-account-area section-space v-desc">
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
                                                        v-model="user.name"
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
                                                        v-model="user.surname"
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
                                                v-model="user.phone"
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
                                                v-model="user.email"
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
                                            <div  class="avatar-box col-8">
                                                <input ref="fileUpload"  type="file" @change="onFileChange($event)">
                                            </div>
                                            <div class="col-2 img-preview text-center">
                                                <div v-if="image_name !== false">
                                                    <img
                                                        :src="image_name.length ? image_name : user.avatar_url"
                                                        alt=""
                                                        width="100"
                                                        height="100"
                                                    >
                                                    <i  @click.prevent="removeImage" class="fa fa-close"></i>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="single-input-item">
                                            <button @click.prevent="getEditData" class="check-btn sqr-btn">Змінити</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="password-edit" role="tabpanel" aria-labelledby="password-edit">
                            <div ref="startPassword"  class="myaccount-content">
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
                                            <button @click.prevent="editPasswordData" class="check-btn sqr-btn">Змінити пароль</button>
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
    <show_order_modal :order="order" :order_products="order_products"></show_order_modal>
    <address_editor_modal  :address="address" :user_id="user.id" @message="getMessage"></address_editor_modal>
</template>

<script>
import Api from "../../../api";
import show_order_modal from "../modal/_show_order_modal.vue";
import address_editor_modal from "../modal/_address_editor_modal.vue";

export default {
    name: "_v-desctop",
    props: [
        'orders',
        'user',
        'address',
        'order_products',
        'formatDate',
        'getUser',
        'logout',
        'message_edit_user',
        'errors_edit_user',
        'message_edit_password',
        'errors_edit_password'
    ],
    data(){
        return{
            image_name: {},
            status_remove_image: false,
            upload_image: {},
            order: [],
            order_products: [],
            message: null,
            current_password: null,
            password: null,
            password_confirmation: null,
        }
    },
    components:{
        show_order_modal,
        address_editor_modal
    },

    methods:{
        editPasswordData(){
            let passwordData={
                current_password: this.current_password,
                password: this.password,
                password_confirmation: this.password_confirmation
            }
            this.current_password = null;
            this.password = null;
            this.password_confirmation = null;
            this.$emit('passwordData', passwordData);
            this.$refs.startPassword.scrollIntoView({behavior: 'smooth'});
        },
        getEditData(){
            //Form data
            const editUserData = new FormData();
            editUserData.append('name', this.user.name);
            editUserData.append('surname', this.user.surname);
            editUserData.append('phone', this.user.phone);
            editUserData.append('email', this.user.email);
            editUserData.append('image', this.upload_image);
            editUserData.append('remove_image', this.status_remove_image);
            editUserData.append('_method', 'PATCH');

            this.$emit('editUserData', editUserData);
            this.$refs.start.scrollIntoView({behavior: 'smooth'});
        },

        onFileChange(event){
            let file = event.target.files[0] || event.dataTransfer.files;
            this.image_name = URL.createObjectURL(file);
            this.upload_image = file;
            this.status_remove_image=false;
        },

        removeImage(){
            this.image_name = false;
            this.upload_image = null;
            this.status_remove_image = true;
            this.$refs.fileUpload.value = null;
        },
        getOrder(id){
            Api.post('/api/auth/get-order', {
                order_id: id
            }).then(result => {
                this.order = result.data.order;
                this.order_products = result.data.order.products;
                console.log(this.order);
            })
        },

        getMessage(value){
            this.message = value;
            this.getUser();
        }
    }
}
</script>

<style scoped>
    .img-preview div{
        font-size: 20px;
    }
    .img-preview i{
        display:block;
        margin-top: 1em;
    }
    .img-preview i:hover{
        color: red;
    }
</style>
