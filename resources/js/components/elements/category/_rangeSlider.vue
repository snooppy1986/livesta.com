<template>
    <div class="select-price-range ">
        <h4 class="title">Ціна</h4>
        <div class="select-price-range-slider">
            <slider
                id="sortPrice"
                v-model="value"
                :value="value"
                :min="price_min"
                :max="price_max"
                @change="onChange"
            />
        </div>
    </div>
</template>

<script>
    import slider from '@vueform/slider';

    export default {
        name: "rangeSlider",
        props:[
            'price_max',
            'price_min'
        ],
        components:{
            slider,
        },
        data() {
            return {
                value: [this.$props.price_min, this.$props.price_max],
            }
        },
        methods:{
            onChange (value) {
                this.$emit('prices', value);
            }
        }
    }
</script>

<style src="../../../../../node_modules/@vueform/slider/themes/default.css"></style>

<style>
    .slider-target{
        width:200px
    }
    @media only screen and (max-width: 767px) {
        .select-price-range{
            padding: 15px;
        }
    }
</style>
