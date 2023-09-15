<template>
    <section class="hero-slider-area position-relative">
        <swiper
            :modules="modules"
            :slides-per-view="1"
            :spaceBetween="30"
            :autoHeight="true"
            :effect="'fade'"
            :loop="true"
            :pagination="{
                    el: '.hero-slider-pagination',
                    type: 'fraction',

                }"
            :navigation="false"
            @swiper="onSwiper"
            @slideChange="onSlideChange"
            class="hero-slider-container"
        >
            <swiper-slide class="hero-slide-item" v-for="slide in slides">
                <div class="container">
                    <div class="row align-items-center position-relative">
                        <div class="col-12 col-md-6">
                            <div class="hero-slide-content">
                                <div class="hero-slide-text-img"><img src="/images/slider/text-theme.webp" width="427" height="232" alt="Image"></div>
                                <h2 class="hero-slide-title">{{slide.title}}</h2>
                                <p class="hero-slide-desc">{{slide.content}}</p>
                                <router-link class="btn btn-border-dark" :to="'/product/'+slide.product_id">Придбати</router-link>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="hero-slide-thumb">
                                <img :src="slide.image_link" width="841" height="832" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-slide-text-shape"><img src="/images/slider/text1.webp" width="70" height="955" alt="Image"></div>
                <div class="hero-slide-social-shape"></div>
            </swiper-slide>
            <div class="hero-slider-pagination"></div>
        </swiper>
    </section>
</template>

<script>
import { Navigation, Pagination, Scrollbar, A11y , Autoplay, EffectFade} from 'swiper';
import {Swiper, SwiperSlide} from 'swiper/vue';

export default {
    name: "_hero_slider_area",
    props:['slides'],
    components:{
        Swiper,
        SwiperSlide
    },
    setup() {
        const onSwiper = (swiper) => {
            console.log(swiper);
        };
        const onSlideChange = () => {
            console.log('slide change');
        };
        return {
            onSwiper,
            onSlideChange,
            modules: [Pagination, Navigation, Autoplay, EffectFade],
        };
    },
}
</script>

<style scoped>

</style>
