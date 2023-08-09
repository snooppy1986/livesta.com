<template>
    <ul class="main-nav justify-content-start">
        <li class="has-submenu" v-for="category in categories">
            <router-link :to="'/category/'+category.id">{{category.title}}</router-link>
            <div>
                <child_main_menu :children="category.children"></child_main_menu>
            </div>
        </li>
    </ul>
</template>

<script>
    import axios from "axios";
    import child_main_menu from './child_main_menu.vue';
    export default {
        name: "_main_menu",
        data(){
            return {
                categories: []
            }
        },
        components:{
            child_main_menu
        },
        mounted() {
            this.loadCategories();
            $(document).trigger('change')
        },
        methods:{
            loadCategories(){
                axios.get('/api/menu')
                    .then(res=>{
                        this.categories =  res.data.data;
                    })
            },
        }
    }
</script>

<style scoped>

</style>
