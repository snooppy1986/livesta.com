<template>
    <!--== Start Aside User Login ==-->
    <aside  ref="offCanvas" class="aside-cart-wrapper offcanvas offcanvas-end" tabindex="-1" id="AsideOffcanvasUserLogin" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h1 class="d-none" id="offcanvasRightLabel">{{user.name}} {{user.surname}}</h1>
            <button
                class="btn-aside-cart-close"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            >
                {{user.name}} {{user.surname}}
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <router-link
                class="btn-total"
                :to="{name: 'user.wellcome'}"
                @click = "closeMenu"
            >
                Особистий кабінет
            </router-link>

            <button
                class="btn-total"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
                @click="logout"
            >
                Вихід
            </button>

        </div>
    </aside>
    <!--== End Aside User Login ==-->
</template>

<script>
    import Api from '../../api.js';
    import * as bootstrap from "bootstrap/dist/js/bootstrap";
    export default {
        name: "aside_user_login",
        data(){
            return {
                user: {}
            }
        },
        mounted() {
            this.getUser()
        },
        methods:{
            getUser(){
                Api.post('/api/auth/get-auth-user').then(response => {
                    this.user = response.data.user;
                })
            },
            closeMenu(){
                let myOffcanvas = document.getElementById('AsideOffcanvasUserLogin');
                let bsOffcanvas = bootstrap.Offcanvas.getInstance(myOffcanvas);
                bsOffcanvas.hide();
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
    .btn-total{
        width: 100%;
    }
</style>
