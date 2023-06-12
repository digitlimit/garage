import { createWebHistory, createRouter } from "vue-router";

import CreateBooking  from "@/Pages/Booking/Create.vue";
import AdminDashboard from "@/Pages/Admin/Dashboard.vue";
import AuthLogin      from "@/Pages/Auth/Login.vue";
import ListBooking    from "@/Pages/Booking/List.vue";
import ViewBooking    from "@/Pages/Booking/View.vue";
import ListSlot       from "@/Pages/Slot/List.vue";
import CreateSlot     from "@/Pages/Slot/Create.vue";

const routes = [
    {
        path: "/",
        name: "landing.index",
        component: CreateBooking,
        meta: {middleware: ['admin', 'guest']}
    },
    {
        path: "/dashboard",
        name: "admin.dashboard",
        component: AdminDashboard,
        meta: {middleware: ['admin']}
    },
    {
        path: "/auth/login",
        name: "auth.login",
        component: AuthLogin,
        meta: {middleware: ['guest']}
    },
    {
        path: "/bookings",
        name: "bookings.list",
        component: ListBooking,
        meta: {middleware: ['admin']}
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
        path: "/slots",
        name: "slots.list",
        component: ListSlot,
        meta: {middleware: ['admin']}
    },
    {
        path: "/slots/create",
        name: "slots.create",
        component: CreateSlot,
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