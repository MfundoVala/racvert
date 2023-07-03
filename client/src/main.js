import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import NavBar from "./components/layouts/NavBar.vue";

createApp(App).component("NavBar", NavBar).use(router).use(store).mount("#app");
