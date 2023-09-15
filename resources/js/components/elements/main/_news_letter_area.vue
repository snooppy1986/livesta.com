<template>
    <section class="section-space pt-0">
        <div class="container">
            <div class="newsletter-content-wrap" data-bg-img="images/photos/bg1.webp">
                <div class="newsletter-content">
                    <div class="section-title mb-0">
                        <h2 class="title">Новини</h2>
                        <p>Отримувати новини про знижки, новинки, акції від компанії Livesta</p>
                    </div>
                </div>
                <div class="newsletter-form">
                    <input v-model="newsletter" type="email" class="form-control" placeholder="Введіть ваш email">
                    <button @click.prevent="storeNewsletter" class="btn-submit" type="button"><i class="fa fa-paper-plane"></i></button>
                </div>
            </div>
            <div v-if="newsletterError || newsletterResponse" class="alert alert-warning rounded-2 text-dark">
                {{newsletterResponse ?? ''}} {{newsletterError ?? ''}}
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";

export default {
    name: "_news_letter_area",
    data(){
        return{
            newsletter: '',
            newsletterResponse: '',
            newsletterError: '',
        }
    },
    methods:{
        //store news letter method
        storeNewsletter(){
            axios.post('/api/news-letter/store', {
                email: this.newsletter
            }).then(result => {
                this.newsletterResponse = result.data.message;
            }).catch(error => {
                console.log(error);
                this.newsletterError = error.response.data.message;
            })

            this.newsletter = null;
            setTimeout(() => {
                this.newsletterResponse = null;
                this.newsletterError = null;
            }, 5000)
        }
    }
}
</script>

<style scoped>

</style>
