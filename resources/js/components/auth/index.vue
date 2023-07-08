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
                                <li class="breadcrumb-item">Авторизація</li>

                            </ol>
                            <h2 class="page-header-title">Авторизація</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Account Area Wrapper ==-->
        <section class="section-space">
            <div class="container">
                <div class="row mb-n8">
                    <div class="col-lg-6 mb-8">
                        <!--== Start Login Area Wrapper ==-->
                        <div class="my-account-item-wrap">
                            <h3 class="title">Вхід</h3>
                            <div class="my-account-form">
                                <div v-if="login_error" class="alert alert-danger">
                                    {{login_error}}
                                </div>
                                <form action="#" method="post">
                                    <div class="form-group mb-6">
                                        <label for="login_username">Єлєктронна пошта<sup>*</sup></label>
                                        <input :class="{'form-control is-invalid': login_error}" v-model="login_email" type="email" id="login_username">
                                    </div>

                                    <div class="form-group mb-6">
                                        <label for="login_pwsd">Пароль <sup>*</sup></label>
                                        <input :class="{'form-control is-invalid': login_error}" v-model="login_password" type="password" id="login_pwsd">
                                    </div>

                                    <div class="form-group d-flex align-items-center mb-14">
                                        <button @click.prevent="login"  type="submit" class="btn" href="my-account.html">Увійти</button>

                                        <div class="form-check ms-3">
                                            <input type="checkbox" class="form-check-input" id="remember_pwsd">
                                            <label class="form-check-label" for="remember_pwsd">Запам'ятати мене</label>
                                        </div>
                                    </div>
                                    <a class="lost-password" href="my-account.html">Забули пароль?</a>
                                </form>
                            </div>
                        </div>
                        <!--== End Login Area Wrapper ==-->
                    </div>
                    <div class="col-lg-6 mb-8">
                        <!--== Start Register Area Wrapper ==-->
                        <div class="my-account-item-wrap">
                            <h3 class="title">Реєстрація</h3>
                            <div class="my-account-form">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <div class="form-group mb-6">
                                        <label for="name">Ім'я <sup>*</sup></label>
                                        <input v-model="reg_name" type="text" id="name">
                                    </div>
                                    <div class="form-group mb-6">
                                        <label for="surname">Прізвище <sup>*</sup></label>
                                        <input v-model="reg_surname" type="text" id="surname">
                                    </div>
                                    <div class="form-group mb-6">
                                        <label for="phone">Номер телефону <sup>*</sup></label>
                                        <input v-model="reg_phone" type="text" id="phone">
                                    </div>

                                    <div class="form-group mb-6">
                                        <label for="register_username">Електронна адреса <sup>*</sup></label>
                                        <input v-model="reg_email" type="email" id="register_username">
                                    </div>

                                    <div class="form-group mb-6 ">
                                        <div ref="avatarDropzone" class="avatar-box">
                                            Зображення акаунта
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>

                                    <div class="form-group mb-6">
                                        <label for="register_pwsd">Пароль <sup>*</sup></label>
                                        <input v-model="reg_password" type="password" id="register_pwsd">
                                    </div>

                                    <div class="form-group mb-6">
                                        <label for="confirm_register_pwsd">Підтвердити пароль <sup>*</sup></label>
                                        <input v-model="reg_confirm_password" type="password" id="confirm_register_pwsd">
                                    </div>

                                    <div class="form-group">
                                        <p class="desc mb-4">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
                                        <button @click.prevent="userRegister" class="btn" type="submit">Реєстрація</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--== End Register Area Wrapper ==-->
                    </div>
                </div>
            </div>
        </section>
        <!--== End Account Area Wrapper ==-->

    </main>
</template>

<script>
    import axios from 'axios';
    import Dropzone from 'dropzone';
    export default {
        name: "auth",
        data(){
            return{
                login_email: null,
                login_password: null,
                reg_name: null,
                reg_surname: null,
                reg_phone: null,
                reg_email: null,
                reg_password: null,
                reg_confirm_password: null,
                login_error: null,
                avatar_dropzone: null,
            }
        },

        mounted() {
            this.avatar_dropzone = new Dropzone(this.$refs.avatarDropzone,{
                url: '/login',
                autoProcessQueue: false,
                addRemoveLinks: true,
                maxFiles: 1,
                thumbnailWidth: 50,
                thumbnailHeight: 50,
                dictRemoveFile: 'Видалити'
            })
        },
        methods:{
            login(){
                axios.post('/api/auth/login', {
                    'email': this.login_email,
                    'password': this.login_password
                }).then(response=>{
                    console.log(response);
                    localStorage.setItem('access_token', response.data.access_token);
                    this.$router.push({name:'user.wellcome'});
                    this.$emit('statusLogin', true);
                }).catch(error=>{
                    console.log(error.response.data.error);
                    this.login_error = error.response.data.error;
                })
            },
            userRegister(){
                const data = new FormData();
                const files = this.avatar_dropzone.getAcceptedFiles();
                files.forEach(file => {
                    data.append('avatar[]', file);
                    this.avatar_dropzone.removeFile(file);
                });
                data.append('name', this.reg_name);
                data.append('surname', this.reg_surname);
                data.append('phone', this.reg_phone);
                data.append('email', this.reg_email);
                data.append('password', this.reg_password);
                data.append('password_confirmation', this.reg_confirm_password);
                axios.post('/register', data)
                    .then(response=>{
                        localStorage.setItem('access_token', response.data.access_token);
                        this.$router.push({name:'user.wellcome'});
                        this.$emit('statusLogin', true);
                    })
            }
        }
    }
</script>

<style>
    .avatar-box{
        border: 1px solid #D4D4D4;
        padding: 20px;
        margin-bottom: 10px;
        cursor: pointer;
        z-index: 10;
    }
    .avatar-box:hover{
        background: #ff6565;
        color: #f0f0f0;
    }
    .avatar-box:hover i{
        color: #f0f0f0;
    }
    .avatar-box:hover .dz-remove{
        border-color: #0a0e14;
    }
    .dz-success-mark,
    .dz-error-mark{
       display: none;
    }
    .avatar-box i{
        margin-left: 20px;
        color: #ff6565;
        font-size: 20px;
    }
    .dz-remove{
        width: 20%;
        display: block;
        border: 1px solid #ff6565;
        margin-top: 10px;
        padding: 5px;
        text-align: center;
    }
    .dz-remove:hover{
        border-color: #0a0e14;
        background: #e7e7e7;
    }
</style>
