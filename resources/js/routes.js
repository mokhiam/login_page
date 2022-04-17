import VueRouter from "vue-router";
import Home from "./auth/Home";

const routes = [
    {
        path: "/",
        component: Home,
        name: "home",
    },
    {
        path: "/auth/login",
        component: require("./auth/Login").default,
        name: "login"
    },
    {
      path:"/auth/register",
      component:require("./auth/Register").default,
      name:"register"
    },
    {
        path:"/auth/rest_pass",
        component:require("./auth/pass_cheng_1").default,
        name:"pass_cheng"
    }
    ,
    {
        path:"/auth/rest_pass_2",
        component:require("./auth/pass_cheng_2").default,
        name:"pass_cheng_2"
    },
    {
        path:"/auth/rest_pass_3",
        component:require("./auth/pass_cheng_3").default,
        name:"pass_cheng_3"
    }
];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;