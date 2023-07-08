<template>


    <div class="select-price-range">
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
    /*import Vselect from 'vue-select-3';*/
    export default {
        name: "rangeSlider",
        components:{
            slider,
        },
        props:[
            'price_max',
            'price_min'
        ],
        data() {
            return {
                value: [this.$props.price_min, this.$props.price_max],
                /*format: function (value) {
                    return ` '&#8372'${value}`
                }*/
            }
        },
       mounted() {

       },
        methods:{
           /* setValue(){
                this.value.push(45, 34);
                console.log(value);
            },*/
            onChange (value) {
                this.$emit('prices', value);
            },

        },

    }
</script>

<style src="@vueform/slider/themes/default.css"></style>

<style>
    .slider-target{
        width:200px

    }
</style>
