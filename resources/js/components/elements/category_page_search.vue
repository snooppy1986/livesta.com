<template>
    <div class="product-widget-search">
        <form @submit.prevent="clearSearch">
            <input
                type="text"
                placeholder="Пошук"
                v-model="searchRequest"
                @keyup="requestSearch"
                class = "search-cat-page"
            >
            <button v-if="isVisibleClose" type="submit" ><i class="fa fa-close"></i></button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "category_page_search",
        data(){
            return{
                searchRequest: '',
                isVisibleClose: false
            }
        },
        methods:{
            requestSearch(){
                this.$emit('getSearchReq', this.searchRequest);
                this.isVisibleClose = true;
            },

            clearSearch(){
                this.searchRequest = '';
                this.$emit('getSearchReq', this.searchRequest);
                this.isVisibleClose = false;
            }
        }
    }
</script>

<style>
    .search-cat-page{
        background-color: #f7f7f7c2;
        border: 1px solid #eeeeeedb;
        border-radius: 8px;
        box-shadow: none;
        color: #747474;
        font-size: 14px;
        font-weight: 400;
        height: 56px;
        padding: 10px 64px 10px 18px;
        width: 100%;
        outline-offset: -2px;
        -webkit-appearance: textfield;
    }
    .search-cat-page:hover{
        border-color: #ff6565;
    }
</style>
