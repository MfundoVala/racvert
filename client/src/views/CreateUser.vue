<script setup>
import axios from "axios";
import { ref, computed } from "vue";
import store from "../store";
import router from "../router";
import { protectRoute } from "../helpers";

// protectRoute(store.state.user, router);
console.log(store.state.user);
const token = store.state.user.token;

const username = ref("");
const phone = ref("");

const createUser = () => {
  axios
    .post(
      "http://127.0.0.1:8000/api/create_user",
      {
        username: username.value,
        phone: phone.value,
      },
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    )
    .then((response) => {
      if (response.status == 200) {
        router.push({ name: "Home" });
      } else {
        alert(response.data.message);
      }
    })
    .catch((error) => {
      console.log(error);
      alert(error);
    });
};
</script>

<template>
  <div class="mb-20"></div>

  <div class="container mx-auto">
    <div class="flex justify-center items-center">
      <div class="w-8/12">
        <div class="bg-white shadow-sm p-6">
          <div class="font-semibold text-lg mb-4">Create User</div>

          <form @submit.prevent="createUser">
            <div class="mb-3">
              <label for="email" class="block text-left mb-1">Username</label>

              <input
                class="border rounded-md py-2 px-3 w-full"
                name="email"
                v-model="username"
                required
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
                Create User
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
