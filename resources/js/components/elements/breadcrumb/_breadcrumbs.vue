<template>
    <section class="page-header-area pt-10 pb-9" data-bg-color="#FFF3DA">
        <div class="container">
            <div class="row">
                <!--breadcrumb start-->
                <div class="col-md-8">
                    <div class="page-header-st3-content text-left text-md-start">
                        <ol class="breadcrumb justify-content-left justify-content-md-start">
                            <li class="breadcrumb-item">
                                <router-link class="text-dark" to="/">
                                    <i class="fa fa-home"></i>
                                </router-link>
                            </li>

                            <li v-for="parent in parents" class="breadcrumb-item">
                                <router-link class="text-dark" :to="'/category/'+parent.id">
                                    {{parent.title}}
                                </router-link>
                            </li>

                            <li v-if="category" class="breadcrumb-item active text-dark" aria-current="page">{{category.title}}</li>
                            <li v-if="pageTitle" class="breadcrumb-item active text-dark" aria-current="page">{{pageTitle}}</li>
                        </ol>
                        <h4 v-if="category" class="page-header-title">Продукти категорії <span class="text-primary">{{category.title}}</span></h4>
                        <h4 v-if="product" class="page-header-title"><span class="text-primary">{{product.title}}</span></h4>
                    </div>
                </div>
                <!--breadcrumb end-->
                <div v-if="count_product>0" class="col-md-4">
                    <h5 class="showing-pagination-results mt-5 mt-md-9 text-md-end">
                        {{count_product  ? count_product : 0}} товарів в категорії
                    </h5>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "_breadcrumbs",
    props:['parents', 'category', 'product', 'count_product', 'pageTitle']
}
</script>

<style scoped>
@media only screen and (max-width: 767px) {
    .page-header-area{
        padding-top: 15px!important;
        padding-bottom: 15px!important;
    }
    .page-header-title{
        font-size: 20px;
    }
}
</style>
