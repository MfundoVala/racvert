import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import RegisterBusiness from "../views/RegisterBusiness.vue";
import CreateUser from "../views/CreateUser.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { showNav: true },
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
    meta: { showNav: false },
  },
  {
    path: "/register",
    name: "Register",
    component: Register,
    meta: { showNav: false },
  },
  {
    path: "/registerbusiness",
    name: "RegisterBusiness",
    component: RegisterBusiness,
    meta: { showNav: false },
  },
  {
    path: "/create_user",
    name: "CreateUser",
    component: CreateUser,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
