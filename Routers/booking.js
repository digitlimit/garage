import List   from "@/Pages/Booking/List.vue";
import View   from "@/Pages/Booking/View.vue";
import Create from "@/Pages/Booking/Create.vue";

const routes = [
    {
        path: "/bookings",
        name: "bookings.list",
        component: List,
        meta: {middleware: ['admin']}
    },
    {
        path: "/bookings/:booking",
        name: "bookings.view",
        component: View,
        meta: {middleware: ['admin']}
    },
    {
        path: "/bookings/create",
        name: "bookings.create",
        component: Create,
        meta: {middleware: ['admin', 'guest']}
    }
];

export default routes
