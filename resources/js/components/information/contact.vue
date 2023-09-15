<template>
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <breadcrumbs :pageTitle="pageTitle"></breadcrumbs>

        <!--== End Page Header Area Wrapper ==-->
        <!--== Start Contact Area Wrapper ==-->
        <section class="contact-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="/images/about/livesta_brand.jpg" alt="Livesta brand image">
                    </div>
                    <div class="col-lg-6">
                        <div ref="start" class="section-title position-relative">
                            <h2 class="title">Будемо на зв'язку</h2>
                            <p class="m-0">Скористайтесь формою звортнього звязку на сайті,
                                і ми відповімо вам протягом 24 годин.</p>
                            <div class="line-left-style mt-4 mb-1"></div>
                            <div v-if="success_message" class="alert alert-success">
                                {{this.success_message}}
                            </div>
                        </div>
                        <!--== Start Contact Form ==-->
                        <div class="contact-form">
                            <form id="contact-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input v-model="name" class="form-control" type="text" name="con_name" placeholder="Ім'я">
                                            <div
                                                v-if="errors_message && errors_message.name"
                                                class="alert alert-danger"
                                            >
                                                {{errors_message.name[0]}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input v-model="surname" class="form-control" type="text" placeholder="Прізвище">
                                            <div
                                                v-if="errors_message && errors_message.surname"
                                                class="alert alert-danger"
                                            >
                                                {{errors_message.surname[0]}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input v-model="email" class="form-control" type="email" name="con_email" placeholder="Електронна пошта">
                                            <div
                                                v-if="errors_message && errors_message.email"
                                                class="alert alert-danger"
                                            >
                                                {{errors_message.email[0]}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea v-model="message" class="form-control" name="con_message" placeholder="Повідомлення"></textarea>
                                            <div
                                                v-if="errors_message && errors_message.message"
                                                class="alert alert-danger"
                                            >
                                                {{errors_message.message[0]}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-0">
                                            <button @click.prevent="sendMessage" class="btn btn-sm" type="submit">Відправити</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--== End Contact Form ==-->

                        <!--== Message Notification ==-->
                        <div class="form-message"></div>
                    </div>

                </div>
            </div>
            <!--<div class="contact-left-img" data-bg-img="/images/about/livesta_brand.jpg"></div>-->
        </section>
        <!--== End Contact Area Wrapper ==-->

        <!--== Start Contact Area Wrapper ==-->
        <section class="section-space">
            <div class="container">
                <div class="contact-info">
                    <div class="contact-info-item">
                        <img class="icon" src="/images/icons/1.webp" width="30" height="30" alt="Icon">
                        <a href="#">+38 093 53 26 722</a>
                        <a href="#">+38 098 21 05 260</a>
                    </div>
                    <div class="contact-info-item">
                        <img class="icon" src="/images/icons/2.webp" width="30" height="30" alt="Icon">
                        <a href="#">admin@livesta.com</a>
                        <a href="#">fabshop@ukr.net</a>
                    </div>
                    <div class="contact-info-item mb-0">
                        <img class="icon" src="/images/icons/3.webp" width="30" height="30" alt="Icon">
                        <p>просп. Миру, 2А, Миколаїв, Миколаївська область, 54000</p>
                    </div>
                </div>
                <div class="map-area" style="margin-top: 20px; height: 200px">
                    <div>
                        <div id="google-maps-display" style="height:350px; width:100%;max-width:100%;">
                            <iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=проспект+Мира,+2а,+Николаев,+Николаевская+область,+Украина&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Contact Area Wrapper ==-->



    </main>
</template>

<script>
    import axios from 'axios';
    import breadcrumbs from '../elements/breadcrumb/_breadcrumbs.vue';
    export default {
        name: "contact",
        data(){
            return{
                pageTitle: 'Контакти',
                name: null,
                surname: null,
                email: null,
                message: null,
                success_message: null,
                errors_message: null
            }
        },
        // meta info
        metaInfo:{
            title: 'Контакти'
        },
        components:{
            breadcrumbs
        },
        mounted() {
            $(document).trigger('change');
        },
        methods:{
            sendMessage(){
                this.errors_message = null;
                this.success_message = null;
                axios.post('/api/callback/store', {
                    name: this.name,
                    surname: this.surname,
                    email: this.email,
                    message: this.message
                }).then(res=>{
                    console.log(res.data.message);
                    this.success_message = res.data.message;
                    this.name = null;
                    this.surname = null;
                    this.email = null;
                    this.message = null;
                    this.$refs.start.scrollIntoView({behavior: 'smooth'});
                }).catch(error=>{
                    console.log(error.response.data.errors);
                    this.errors_message = error.response.data.errors;
                })
            }
        }
    }
</script>

<style scoped>

</style>
