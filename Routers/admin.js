import Dashboard from "@/Pages/Admin/Dashboard.vue";

const routes = [
    {
        path: "/dashboard",
        name: "admin.dashboard",
        component: Dashboard,
        meta: {middleware: ['admin']}
    }
];

export default routes;
