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
        <section class="section-space pt-0 mb-n1">
            <div class="container">

                <div class="about-content justify-content-center">
                    <h2 class="title">Замовлення оформлено успішно</h2>
                    <p class="desc">Дякуємо за покупку! Найблжчим часом з вами зв'яжеться наш менеджер.</p>
                    <router-link :to="{name:'main'}" class="btn-place-main mx-auto">В магазин</router-link>
                </div>
            </div>
        </section>
        <!--== End Shopping Checkout Area Wrapper ==-->

    </main>
</template>

<script>
    export default {
        name: "success_checkout",
        // meta info
        metaInfo:{
            title: 'Замовлення оформлено успішно'
        },
        mounted() {
            this.$emit('success_checkout', true);
        }
    }
</script>

<style scoped>
    .btn-place-main{
        display: block;
        text-align: center;
        border-radius: 0;
        padding: 18px 20px 16px;
        margin-top: 50px;
        font-size: 16px;
        background-color: #ff6565;
        border-color: #ff6565;
        color: #fff;
        text-transform: uppercase;
        font-weight: 600;
        width: 40%;
    }

    .btn-place-main:hover{
        background-color: #000;
        border-color: #000;
    }

</style>
