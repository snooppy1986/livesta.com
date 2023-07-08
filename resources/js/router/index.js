import {createRouter, createWebHistory} from "vue-router";
import MainComponent from "../components/main/IndexComponent.vue";
import Category from "../components/categories/index.vue";
import Product from "../components/product/index.vue";
import WishList from "../components/wishlist/index.vue";
import Cart from "../components/cart/index.vue";
import Checkout from "../components/cart/checkout.vue";
import Auth from "../components/auth/index.vue";
import Wellcome from "../components/auth/wellcome.vue";
import about from "../components/information/about.vue";
import Contact from "../components/information/contact.vue";
import Faq from "../components/information/faq.vue";
import SuccessCheckout from "../components/cart/success_checkout.vue";
import Search from "../components/search/index.vue";
import PageNotExist from "../components/error/404.vue";

const routes = [
    {
        path: '/',
        name: 'main',
        component: MainComponent
    },
    {
        path: '/login',
        name: 'user.login',
        component: Auth
    },
    {
        path: '/wellcome',
        name: 'user.wellcome',
        component: Wellcome
    },
    {
        path: '/category/:id',
        name: 'category.index',
        component: Category,
    },
    {
        path: '/product/:id',
        name: 'product.index',
        component: Product,
        props: true
    },
    {
        path: '/wish-list',
        name: 'wishList.index',
        component: WishList,
    },
    {
        path: '/cart',
        name: 'cart.index',
        component: Cart
    },
    {
        path: '/checkout',
        name: 'cart.checkout',
        component: Checkout
    },
    {
        path: '/about-us',
        name: 'about',
        component: about
    },
    {
        path: '/contact',
        name: 'contact',
        component: Contact
    },
    {
        path: '/faq',
        name: 'faq',
        component: Faq
    },
    {
        path: '/success-checkout',
        name: 'checkout.success',
        component: SuccessCheckout
    },
    {
        path: '/search',
        name: 'search',
        component: Search,

    },
    {
        path: '/404',
        name: 'PageNotExist',
        component: PageNotExist,
    },
    {
        path: "/:catchAll(.*)", // Unrecognized path automatically matches 404
        redirect: '/404',
    },
];

const router = createRouter({
    history: createWebHistory(),
    /*import.meta.env.BASE_URL*/
    scrollBehavior(to, from, savedPosition) {
        // always scroll to top
        return { top: 0 }
    },
    routes
});
router.beforeEach((to, from, next)=>{

    const access_token = localStorage.getItem('access_token')
    if(to.name === 'user.login' && access_token){
        return next({
            name: 'user.wellcome'
        })
    }
    if(to.name === 'user.wellcome' && !access_token){
        return next({
            name: 'user.login'
        })
    }

    next()
})
export default router;
