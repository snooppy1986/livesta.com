<template>
    <!--== Start Aside Search Form ==-->
    <aside class="aside-search-box-wrapper offcanvas offcanvas-top h-auto" tabindex="-1" id="AsideOffcanvasSearch" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h5 class="d-none" id="offcanvasTopLabel">Пошук</h5>
            <button ref="close_search" type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa fa-close"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="container pt--0 pb--0">
                <div class="search-box-form-wrap">
                    <div class="search-note">
                        <p>Почніть вводити текст і натисніть Enter для пошуку</p>
                    </div>
                    <form >
                        <div class="aside-search-form position-relative">
                            <label for="SearchInput" class="visually-hidden">Search</label>
                            <input v-model="search" id="SearchInput" type="search" class="form-control" placeholder="Пошук у всьому магазині …">
                            <button v-if="search" @click.prevent="goToSearch" class="search-button" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                    <p class="text-danger mt-2">{{error_message}}</p>

                    <div class="blog-search" >
                        <ul class="blog-search-widget">
                            <li v-for="product in products">
                                <div class="row">
                                    <div class="col-md-1 image">
                                        <img :src="product.image_url" :alt="product.title" width="70" height="70">
                                    </div>
                                    <div class="col-md-9 title">
                                        <div class="row mb-2 ">
                                            <div class="col-md-6 sku">
                                                {{product.code}}
                                            </div>
                                            <div class="col-md-6 price_bb ">
                                                {{product.price_balls}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <router-link @click="closeModal" :to="'/product/'+product.id">{{product.title}}</router-link>
                                        </div>
                                    </div>
                                    <div class="col-md-2 prices">
                                        <div class="price">
                                            {{product.price_special}} грн.
                                        </div>
                                        <div class="price_black">
                                            {{product.price_through}} грн.
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </aside>
    <!--== End Aside Search Form ==-->
</template>

<script>
    import axios from 'axios';
    import * as bootstrap from "bootstrap/dist/js/bootstrap";
    export default {
        name: "search_bar",
        data(){
            return{
                search: null,
                error_message: '',
                products: []
            }
        },

        methods:{
            goToSearch(){
                console.log('click search');
                this.$emit('search_req', this.search);//pass search data
                this.$router.push({name:'search'});//redirect to search page
                this.closeModal()
            },

            closeModal(){
                this.search  = null;//clear search input
                this.products = null;
                let myOffcanvas = document.getElementById('AsideOffcanvasSearch');
                let bsOffcanvas = bootstrap.Offcanvas.getInstance(myOffcanvas);
                bsOffcanvas.hide();
            }
        },
        watch:{
            search:{
                handler: function(val) {

                    if(val && val.length>0){
                        axios.post('/api/search', {
                            'search': val,
                            'page': 1
                        }).then(res => {
                            this.products = null;
                            this.error_message = '';
                            this.products = res.data.data;
                        }).catch(error => {
                            this.error_message = error.response.data.message;
                        });
                    }else {
                        this.products = null;
                        this.error_message = '';
                    }
                },
                deep: true
            }
        }

    }
</script>

<style scoped>
    .offcanvas-top.h-auto {
        bottom: initial;
    }
    .blog-search .blog-search-widget{
        max-height: 340px;
    }
    .blog-search .blog-search-widget li{
        padding: 5px 10px;
    }
    .blog-search .blog-search-widget .title a{
        padding: 0;
        margin-left: 10px;
    }
    .blog-search .blog-search-widget li:hover{
        background: #F9F7FC;
        transition: all .3s ease-out;
    }
    .blog-search .sku{
        background: rgb(243 243 244);
        font-weight: 400;
        font-size: 12px;
        line-height: 14px;
        text-align: right;
        color: #595B63;
        display: flex;
        align-items: center;
        padding: 2px 10px;
        width: fit-content;
        margin-right: 6px;
        margin-left: 10px;
    }

    .blog-search .price_bb{
        background: #ff3232;
        font-weight: 400;
        font-size: 12px;
        line-height: 14px;
        text-align: right;
        color: #FFF;
        display: flex;
        align-items: center;
        padding: 2px 8px;
        width: fit-content;
    }

    .blog-search .price{
        position: relative;
        top: -2px;
        font-weight: 600;
        font-size: 23px;
        line-height: 24px;
        text-align: right;
        letter-spacing: -0.02em;
        color: #000000;
        white-space: pre;
    }
    .blog-search .price_black{
        font-size: 13px;
        text-decoration-line: line-through;
        color: #9f9f9f;
        margin-right: 6px;
        text-align: right;
    }

</style>
