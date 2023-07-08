<template>
    <ul class="submenu-nav" v-if="children && children.length>0">
        <li v-for="child in children" class="has-submenu">
            <router-link  :to="'/category/'+child.id">{{child.title}}</router-link>
                        <!--<ul class="submenu-nav" v-if="child.children.length>0">
                <li v-for="child in child.children">
                    <router-link :to="'/category/'+child.id">{{child.title}}</router-link>
                </li>
                &lt;!&ndash;<li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>&ndash;&gt;
            </ul>-->
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
        components:{

        }
    }
</script>

<style scoped>

</style>
