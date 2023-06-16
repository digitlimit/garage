import { createWebHistory, createRouter } from "vue-router";
import { useAuth } from './Store/auth';

import BookingList   from "@/Pages/Booking/List.vue";
import CreateBooking from "@/Pages/Booking/Create.vue";
import AuthLogin     from "@/Pages/Auth/Login.vue";
import ViewBooking   from "@/Pages/Booking/View.vue";
import ListSlot      from "@/Pages/Slot/List.vue";
import CloseSlot     from "@/Pages/Slot/Close.vue";
import Error404      from "@/Pages/Error/404.vue";

const routes = [
    {
        path: "/",
        name: "landing.index",
        component: CreateBooking,
        meta: {middleware: ['guest', 'admin', 'user']}
    },
    {
        path: "/dashboard",
        name: "dashboard.index",
        component: BookingList,
        meta: {middleware: ['admin']}
    },
    {
        path: "/auth/login",
        name: "auth.login",
        component: AuthLogin,
        meta: {middleware: ['guest']}
    },
    {
        path: "/bookings/:booking",
        name: "bookings.view",
        component: ViewBooking,
        meta: {middleware: ['admin']}
    },
    {
        path: "/bookings/create",
        name: "bookings.create",
        component: CreateBooking,
        meta: {middleware: ['guest', 'admin']}
    },
    {
        path: "/slots/list",
        name: "slots.list",
        component: ListSlot,
        meta: {middleware: ['admin']}
    },
    {
        path: "/slots/close",
        name: "slots.close",
        component: CloseSlot,
        meta: {middleware: ['admin']}
    },
    { 
        path: "/:catchAll(.*)",
        name: "errors.404",
        component: Error404,
        meta: {middleware: ['guest', 'admin', 'user']}
    }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  next();
});

router.beforeEach((to, from) => {

    const auth        = useAuth()
    const middlewares = to.meta.middleware;

    if(!auth.middleware(middlewares)) 
    {
        return auth.loggedIn 
            ? {name: 'landing.index'}
            : {name: 'auth.login'};
    }
})

export default router;