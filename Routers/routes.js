import { createWebHistory, createRouter } from "vue-router";

// import landing from "./landing";
import admin   from "admin";
import auth    from "./auth";
import booking from "./booking";
import slot    from "./slot";


const routes = [

  // ...landing,
  ...admin,
  ...auth,
  ...booking,
  ...slot
];

console.log(routes)

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  next();
});

export default router;