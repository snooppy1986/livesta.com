<template>
    <div class="product-reviews-form-wrap">
        <h4 class="product-form-title">Залишити відгук</h4>

        <div class="product-reviews-form mt-5" >
            <form action="#" ref="reviews_form">
                <div class="form-input-item">
                    <input

                        v-model="name_surname"
                        class="form-control "
                        :class="{'is-invalid' : err_message.name_surname}"
                        type="text"
                        placeholder="Ім'я та прізвище"
                    >
                    <span v-if="err_message.name_surname" class="text-danger">{{err_message.name_surname[0]}}</span>
                </div>
                <div class="form-input-item">
                    <input
                        v-model="email"
                        class="form-control"
                        :class="{'is-invalid' : err_message.email}"
                        type="email"
                        placeholder="Електронна пошта"
                    >
                    <span v-if="err_message.email" class="text-danger">{{err_message.email[0]}}</span>
                </div>
                <div class="form-input-item">
                    <textarea
                        v-model="advantage"
                        class="form-control"
                        :class="{'is-invalid' : err_message.advantage}"
                        placeholder="Переваги"
                    >
                    </textarea>
                    <span v-if="err_message.advantage" class="text-danger">{{err_message.advantage[0]}}</span>
                </div>
                <div class="form-input-item">
                    <textarea
                        v-model="flaws"
                        class="form-control"
                        :class="{'is-invalid' : err_message.flaws}"
                        placeholder="Недоліки"
                    >
                    </textarea>
                    <span v-if="err_message.flaws" class="text-danger">{{err_message.flaws[0]}}</span>
                </div>
                <div class="form-input-item">
                    <textarea
                        v-model="message"
                        class="form-control"
                        :class="{'is-invalid' : err_message.message}"
                        placeholder="Повідомлення"
                    >
                    </textarea>
                    <span v-if="err_message.message" class="text-danger">{{err_message.message[0]}}</span>
                </div>

                <div class="form-input-item">
                    <div class="form-ratings-item">
                        <span class="title">Оцініть продукт</span>
                        <div class="product-ratingsform-form-wrap">
                            <div class="product-ratingsform-form-icon">
                                <StarRating
                                    inactive-color="#fff"
                                    border-color="#ff6565"
                                    active-color="#ff6565"
                                    v-bind:border-width=1
                                    aria-valuenow=3
                                    v-bind:star-size=22
                                    v-bind:read-only="false"
                                    v-bind:round-start-rating="false"
                                    @update:rating ="setRating"
                                ></StarRating>
                            </div>
                            <span v-if="err_message.rating" class="text-danger">{{err_message.rating[0]}}</span>
                        </div>
                    </div>
                </div>
                <div class="form-input-item mb-0">
                    <button @click.prevent="sendReview" type="submit" class="btn">Залишити відгук</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating';

    export default {
        name: "reviews_form",
        props: ['product_id'],
        data() {
            return{
                advantage: '',
                flaws: '',
                name_surname: '',
                email: '',
                rating: 1,
                message: '',
                err_message:[],
                statusSend: false
            }
        },
        components:{
            StarRating
        },
        methods:{
            sendReview(){
                axios.post('/api/review/store',{
                    product_id: this.product_id,
                    advantage: this.advantage,
                    flaws: this.flaws,
                    name_surname: this.name_surname,
                    email: this.email,
                    rating: this.rating,
                    message: this.message
                }).then(res=>{

                    if(res.data.status)
                    this.$emit('statusForm', true);
                    this.$refs.reviews_form.reset();
                }).catch(error=>{
                    console.log(error.response.data.errors);
                    this.err_message = error.response.data.errors;
                })
            },

            setRating(rating){
                this.rating=rating;
            },


        }

    }
</script>

<style >
    .product-reviews-form input,
    .product-reviews-form textarea,
    .form-ratings-item .title{
        font-size: 1.1em !important;
    }
</style>
