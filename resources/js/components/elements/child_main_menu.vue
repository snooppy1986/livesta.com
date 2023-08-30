<template>
    <ul class="submenu-nav" v-if="children && children.length>0">
        <li v-for="child in children" class="has-submenu">
            <router-link
                :to="'/category/'+child.id"
            >
                {{child.title}}
            </router-link>
            <child_main_menu  :children="child.children"></child_main_menu>
        </li>

    </ul>
</template>

<script>

    export default {
        name: "child_main_menu",
        props:[
            'children'
        ],
        mounted() {
            $(document).trigger('change')
        }
    }
</script>

<style scoped>
.submenu-nav{
    z-index: 998 !important;
}
</style>
