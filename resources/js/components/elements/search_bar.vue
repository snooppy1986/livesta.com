<template>
    <!--== Start Aside Search Form ==-->
    <aside class="aside-search-box-wrapper offcanvas offcanvas-top" tabindex="-1" id="AsideOffcanvasSearch" aria-labelledby="offcanvasTopLabel">
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
                </div>
            </div>
        </div>
    </aside>
    <!--== End Aside Search Form ==-->
</template>

<script>
    import axios from 'axios';

    export default {
        name: "search_bar",
        data(){
            return{
                search: null
            }
        },

        methods:{
            goToSearch(){
                var close_el = (this.$refs.close_search);
                this.$emit('search_req', this.search);//pass search data
                this.$router.push({name:'search'});//redirect to search page
                this.search  = null;//clear search input
                close_el.click();//close modal element search
            }
        },
        watch:{
            search:{
                handler: function(val) {
                    console.log(val);
                },
                deep: true
            }
        }

    }
</script>

<style scoped>

</style>
