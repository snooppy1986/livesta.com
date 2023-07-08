<template>
    <footer class="footer-area">
        <!--== Start Footer Main ==-->
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="widget-item">
                            <div class="widget-about">
                                <router-link class="widget-logo" to="/">
                                    <img src="/images/logo.webp" width="95" height="68" alt="Logo">
                                </router-link>
                                <p class="desc">Лише турбота про ближнього, краса навколо, душевна доброта та сила наших сердець об’єднує всю хоробрість українців, яку ми уособили в LIVESTA!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 mt-md-0 mt-9">
                        <div class="widget-item">
                            <h4 class="widget-title">Інформація</h4>
                            <ul class="widget-nav">
                                <li>
                                    <router-link :to="{name: 'main'}">Головна</router-link>
                                </li>
                                <li v-if="!access_token">
                                    <router-link :to="{name: 'user.login'}">Вхід</router-link>
                                </li>
                                <li v-if="access_token">
                                    <a @click.prevent="logout" href="">Вихід</a>
                                </li>
                                <li v-if="access_token">
                                    <router-link :to="{name: 'user.wellcome'}">Мій кабінет</router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'about'}">Про нас</router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'contact'}">Контакти</router-link>
                                </li>
                                <li ><router-link :to="{name: 'faq'}">Питання</router-link></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mt-lg-0 mt-6">
                        <div class="widget-item">
                            <h4 class="widget-title">Ми в соц мережах</h4>
                            <div class="widget-social">
                                <a href="https://twitter.com/" target="_blank" rel="noopener"><i class="fa fa-youtube"></i></a>
                                <a href="https://www.facebook.com/" target="_blank" rel="noopener"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.pinterest.com/" target="_blank" rel="noopener"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Footer Main ==-->

        <!--== Start Footer Bottom ==-->
        <div class="footer-bottom">
            <div class="container pt-0 pb-0">
                <div class="footer-bottom-content">
                    <p class="copyright">© 2023 Livesta.</p>
                </div>
            </div>
        </div>
        <!--== End Footer Bottom ==-->
    </footer>
</template>

<script>
    import Api from "../../../api";

    export default {
        name: "index",
        props: ['access_token'],
        data(){
            return {

            }
        },
        methods:{
            logout(){
                Api.post('/api/auth/logout').then(res=>{
                    localStorage.removeItem('access_token');
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

</style>
