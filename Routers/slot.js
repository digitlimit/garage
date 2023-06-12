import List   from "@/Pages/Slot/List.vue";
import Create from "@/Pages/Slot/Create.vue";

const routes = [
    {
        path: "/slots",
        name: "slots.list",
        component: List,
        meta: {middleware: ['admin']}
    },
    {
        path: "/slots/create",
        name: "slots.create",
        component: Create,
        meta: {middleware: ['admin']}
    }
];

export default routes;
