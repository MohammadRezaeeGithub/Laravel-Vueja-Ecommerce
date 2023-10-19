import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import Login from "../views/Login.vue";
import ResetPassword from "../views/ResetPassword.vue";
import NewPassword from "../views/NewPassword.vue";
import AppLayout from "../components/AppLayout.vue";
import Product from "../views/Products/Product.vue";
import store from "../store/index.js";
import NotFound from "../components/NotFound.vue";
import Orders from "../views/Orders/Orders.vue";
import OrderView from "../views/Orders/OrderView.vue";
import User from "../views/Users/User.vue";
import Customer from "../views/Customers/Customer.vue";

const routes = [
    {
        path : '/app',
        name : 'app',
        component: AppLayout,
        meta:{
          requiresAuth:true,
        },
        children : [
            {
                path:'dashboard',
                name: 'app.dashboard',
                component: Dashboard
            },
            {
                path:'product',
                name: 'app.product',
                component: Product
            },
            {
                path:'user',
                name: 'app.user',
                component: User
            },
            {
                path:'customer',
                name: 'app.customer',
                component: Customer
            },
            {
                path:'orders',
                name: 'app.orders',
                component: Orders
            },
            {
                path:'orders/:id',
                name: 'app.orders.view',
                component: OrderView
            },
        ]
    },
    {
        path:'/login',
        name: 'login',
        meta : {
            requiresGuest: true,
        },
        component: Login
    },
    {
        path:'/reset-password',
        name: 'resetPassword',
        meta : {
            requiresGuest: true,
        },
        component: ResetPassword
    },
    {
        path:'/new-password/:token',
        name: 'newPassword',
        meta : {
            requiresGuest: true,
        },
        component: NewPassword
    },
    {
        path:'/:pathMatch(.*)',
        name: 'notfound',
        component: NotFound,
    },
];


const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to,from,next)=>{

    if (to.meta.requiresAuth && !store.state.user.token){
        next({name:'login'});
    } else {
        next();
    }
})

export default router;
