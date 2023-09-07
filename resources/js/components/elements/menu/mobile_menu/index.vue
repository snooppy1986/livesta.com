<template>
    <!--== Start Aside Menu ==-->
    <aside class="off-canvas-wrapper offcanvas offcanvas-start " tabindex="-1" id="AsideOffcanvasMenu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header mb-3">
            <h1 class="d-none" id="offcanvasExampleLabel">Додаткове меню</h1>
            <button  class="btn-menu-close" data-bs-dismiss="offcanvas" aria-label="Close">меню <i class="fa fa-chevron-left"></i></button>
        </div>

        <div class="offcanvas-body">
            <div v-if="children.length" class="offcanvasNavBack mb-3">
                <button
                    @click.prevent="backToParent(parent.parent_id)"
                    class="btn"
                > <i class="fa fa-chevron-left "></i>
                </button>
            </div>
            <div id="offcanvasNav" class="offcanvas-menu-nav">
                <!--Main category -->
                <ul v-if="categories && !children.length">
                    <li
                        v-for="(category) in categories"
                        class="offcanvas-nav-parent mb-3"
                    >

                        <router-link
                            class="offcanvas-nav-item d-inline col-md-13"
                            :to="'/category/'+category.id"
                            @click="closeMenu"
                        >
                           {{category.title}}
                        </router-link>
                        <i @click.prevent="showChildren(category.id)"
                           class="fa fa-chevron-right col-md-1 float-end d-inline"
                        ></i>
                    </li>

                </ul>

                <!--Children category -->
                <ul v-if="children.length">
                    <li
                        v-for="(category) in children"
                        class="offcanvas-nav-parent mb-3"
                    >

                        <router-link
                            class="offcanvas-nav-item d-inline col-md-13"
                            :to="'/category/'+category.id"
                            @click="closeMenu"
                        >
                            {{category.title}}
                        </router-link>
                        <i v-if="category.children.length"
                           @click.prevent="showChildren(category.id)"
                           class="fa fa-chevron-right col-md-1 float-end d-inline"
                        ></i>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <!--== End Aside Menu ==-->
</template>

<script>
import axios from "axios";
import * as bootstrap from "bootstrap/dist/js/bootstrap";

export default {
    name: "index",
    props: ['keys'],

    data(){
        return {
            categories: [],
            children: [],
            parents: [],
            parent: {},
            test: false
        }
    },

    mounted() {
        this.loadCategories();
    },

    watch:{
        keys: function (){
            this.children=[];
        }
    },

    methods:{
        loadCategories(){
            axios.get('/api/menu')
                .then(res=>{
                    this.categories = res.data.data;
                })
        },

        showChildren(id){
            //get parents category list
            this.parents = this.children
                ?? this.children;
            //get parent category
            this.parent = !this.children.length
                ? this.categories.filter(item => [id].includes(item.id)).map(item => item)[0]
                : this.children.filter(item => [id].includes(item.id)).map(item => item)[0];

            //get children category
            this.children = !this.children.length
                ? this.categories.filter(item => [id].includes(item.id)).map(item => item.children)[0]
                : this.children.filter(item => [id].includes(item.id)).map(item => item.children)[0];

        },

        //back to parent category
        backToParent(parent_id){
            /*console.log(this.parents);*/
            if(this.parent.parent_id !== 0){
                this.children = this.parents;

                //get parent category
                this.getParentCategory(this.categories, parent_id);

            }else{
                this.children = [];
            }
        },

        getParentCategory(categories, parent_id){
            var parent = [];
            categories.forEach(value => {
                if(value.id === parent_id){
                    parent = value;
                    return;
                }else{
                    this.getParentCategory(value.children, parent_id);
                }
            });
            this.parent = parent;
        },

        //closes offcanvas if go to link
        closeMenu(){
            let myOffcanvas = document.getElementById('AsideOffcanvasMenu');
            let bsOffcanvas = bootstrap.Offcanvas.getInstance(myOffcanvas);
            bsOffcanvas.hide();
        }
    }
}
</script>

<style scoped>
    .offcanvas-menu-nav a:not(:only-child):after {
        content:""
    }
    .fa-chevron-right:before{
        color: #fff;
        font-size: inherit;
    }
    .offcanvas-body .btn{
        padding: 0;
        background-color: transparent !important;
        border: none;
    }
    .offcanvas-body .btn:focus{
        box-shadow: none;
    }
    .offcanvas-body .fa-chevron-left{
        font-size: 25px;
    }
</style>
