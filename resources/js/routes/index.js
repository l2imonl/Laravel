import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
    {
     path: "/",
     name: "Home",
     component : () => import("../components/Blog/index.vue")
    },
    {
      path: "/post/:id",
      name: "Blog-Post",
      component : () => import("../components/Blog/single.vue")
    },
    {
        path: "/login",
        name: "Login",
        component : () => import("../components/login.vue")
    }
];

const router = new VueRouter({
   routes
});

export default router;
