import LoginPage from "@/Pages/Auth/Login.vue";

const routes = [
    {
        path: "/auth/login",
        name: "auth.login",
        component: LoginPage,
        meta: {middleware: ['guest']}
    }
];

export default routes
