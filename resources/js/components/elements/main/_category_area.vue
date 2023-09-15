<template>
    <section class="section-space pb-0">
        <div class="container">
            <div class="row g-3 g-sm-6">
                <div v-for="(categorie, index) in categories"
                     class="col-6 col-lg-4 col-lg-2 col-xl-2"
                     :class="{'mt-lg-0 mt-sm-6 mt-4': index>1}"
                >
                    <!--== Start Product Category Item ==-->
                    <router-link :to="'/category/'+categorie.id" class="product-category-item">
                        <img class="icon" :src="categorie.thumbnail" width="70" height="80" alt="Image-HasTech">
                        <h3 class="title">{{categorie.title}}</h3>
                        <!--<span class="flag-new">new</span>-->
                    </router-link>
                    <!--== End Product Category Item ==-->
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "_category_area",
    props: ['categories']
}
</script>

<style scoped>

</style>
