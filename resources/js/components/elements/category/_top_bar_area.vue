<template>
    <div class="shop-top-bar-area" >
        <div class="container">
            <div class="shop-top-bar">
                <v_select
                    class="mb-3"
                    :options="options"
                    :selected = "select_default"
                    @select_option = "getOption"
                ></v_select>
                <rangeSlider
                    v-if="statusRangeSlider"
                    v-bind:price_max = "price_max"
                    v-bind:price_min="price_min"
                    v-bind:key="price_max"
                    @prices="getOptionsPrice"
                ></rangeSlider>
            </div>
        </div>
    </div>
</template>

<script>
import rangeSlider from "../category/_rangeSlider.vue";
import v_select from "../category/_v-select.vue";

export default {
    name: "_top_bar_area",
    props:[
        'statusRangeSlider',
        'loadCategory',
        'price_max',
        'price_min'
    ],
    data: ()=>({
        options: [
            {name: 'По популярності', value: ['rating', 'DESC']},
            {name: 'За алфавітом А - Я', value: ['title', 'ASC']},
            {name: 'По зростанню цін', value: ['price_special', 'ASC']},
            {name: 'По зменшенню ціни', value: ['price_special', 'DESC']},

        ],
        select_default: 'Сортувати по:',
    }),
    components:{
        rangeSlider,
        v_select
    },
    methods:{
        getOption(option){
            this.select_default = option.name;
            this.$emit('sort_option', option.value) ;

        },

        getOptionsPrice(option){
            this.$emit('prices', option);
        }
    }
}
</script>

<style scoped>

</style>
