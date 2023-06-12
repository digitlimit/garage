import CreateBooking from "@/Pages/Booking/Create.vue";

const routes = [
    {
        path: "/",
        name: "landing.index",
        component: CreateBooking,
        meta: {middleware: ['admin', 'guest']}
    }
];

export default routes;
