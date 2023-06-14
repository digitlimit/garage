import { createWebHistory, createRouter } from "vue-router";

import CreateBooking    from "@/Pages/Booking/Create.vue";
import AdminDashboard   from "@/Pages/Admin/Dashboard.vue";
import AuthLogin        from "@/Pages/Auth/Login.vue";
import ListBooking      from "@/Pages/Booking/List.vue";
import ViewBooking      from "@/Pages/Booking/View.vue";
import ListClosedSlot   from "@/Pages/Slot/ListClosedSlot.vue";
import CreateClosedSlot from "@/Pages/Slot/CreateClosedSlot.vue";

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
        path: "/slots/closed",
        name: "slots.closed.list",
        component: ListClosedSlot,
        meta: {middleware: ['admin']}
    },
    {
        path: "/slots/close",
        name: "slots.close",
        component: CreateClosedSlot,
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