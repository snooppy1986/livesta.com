<template>
    <main class="main-content">
        <!--== Start Faq Area Wrapper ==-->
        <section class="page-not-found-area">
            <div class="container">
                <div class="page-not-found">
                    <img src="assets/images/photos/page-not-found.webp" width="975" height="538" alt="Image">
                    <h3 class="title">Opps! You Lost</h3>
                    <h5 class="back-btn">Go to <router-link to="/">Home</router-link> Page</h5>
                </div>
            </div>
        </section>
        <!--== End Faq Area Wrapper ==-->
    </main>
</template>

<script>
    export default {
        name: "404",
        // meta info
        metaInfo:{
            title: 'Сторінка не знайдена'
        },
    }
</script>

<style scoped>

</style>
