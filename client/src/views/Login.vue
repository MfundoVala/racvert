<script setup>
import axios from "axios";
import { ref } from "vue";

const username = ref("");
const phone = ref("");

const login = () => {
  axios
    .post("/api/login", {
      username: username.value,
      phone: phone.value,
    })
    .then((response) => {
      console.log(response);
      // localStorage.setItem("token", response.data.data.token);
      // console.log(localStorage.getItem("token"));
      // location.href = "/";
    })
    .catch((error) => {
      console.log(error);
    });
};
</script>

<template>
  <div class="mb-20"></div>

  <div class="container mx-auto">
    <div class="flex justify-center items-center">
      <div class="w-8/12">
        <div class="bg-white shadow-sm p-6">
          <div class="font-semibold text-lg mb-4">Login</div>

          <form method="POST" @submit="login">
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

              <input
                class="border rounded-md py-2 px-3 w-full"
                name="phone"
                v-model="phone"
                required
              />
            </div>

            <div class="mb-0">
              <button
                type="submit"
                class="bg-blue-500 text-white py-2 px-4 rounded-md"
              >
                Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
