import { createWebHistory, createRouter } from "vue-router";

import BookingList   from "@/Pages/Booking/List.vue";
import CreateBooking from "@/Pages/Booking/Create.vue";
import AuthLogin     from "@/Pages/Auth/Login.vue";
import ViewBooking   from "@/Pages/Booking/View.vue";
import ListSlot      from "@/Pages/Slot/List.vue";
import CloseSlot     from "@/Pages/Slot/Close.vue";

const routes = [
    {
        path: "/",
        name: "landing.index",
        component: CreateBooking,
        meta: {middleware: ['admin', 'guest']}
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
        meta: {middleware: ['admin', 'guest']}
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
    }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  next();
});

export default router;