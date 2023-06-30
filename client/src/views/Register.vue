<script setup>
import axios from "axios";
import { ref } from "vue";
import store from "../store";
import router from "../router";

const username = ref("");
const phone = ref("");
const accept_terms = ref(false);

const register = () => {
  const response = axios.post("/api/register", {
    username: username.value,
    phone: phone.value,
  });

  if (response.data.success == "ok") {
    store.commit("setUser", response.data.user);
    router.push("/");
  } else {
    alert(response.data.message);
  }
};
</script>

<template>
  <div class="mb-20"></div>
  <div class="container mx-auto">
    <div class="flex justify-center items-center">
      <div class="w-8/12">
        <div class="bg-white shadow-sm p-6">
          <div class="font-semibold text-lg mb-4">Register</div>

          <form @submit.prevent="register">
            <div class="mb-3">
              <label for="email" class="block text-left mb-1">Username</label>

              <input
                class="border rounded-md py-2 px-3 w-full"
                name="email"
                v-model="username"
                required
                autocomplete="email"
                autofocus
              />
            </div>

            <div class="mb-3">
              <label for="password" class="block text-left mb-1">Phone</label>

              <div>
                <input
                  type="password"
                  class="border rounded-md py-2 px-3 w-full"
                  name="phone"
                  v-model="phone"
                  required
                />
              </div>
            </div>

            <div class="mb-3">
              <div>
                <input class="mr-1" type="checkbox" v-model="accept_terms" />
                <label class="inline-block" for="accept_terms"
                  >Accept terms</label
                >
              </div>
            </div>

            <div class="mb-0">
              <div>
                <button
                  type="submit"
                  class="bg-blue-500 text-white py-2 px-4 rounded-md"
                >
                  Register
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
