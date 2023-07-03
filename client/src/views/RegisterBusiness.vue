<script setup>
import axios from "axios";
import { ref } from "vue";
import store from "../store";
import router from "../router";
import { protectRoute } from "../helpers";

const user = store.state.user;
store.dispatch("getUserById", user);
console.log(user);
protectRoute(user, router);

const business_name = ref("");
const user_id = ref("");
const accept_terms = ref(false);
const logo_url = ref(null);

const handleFileUpload = (e) => {
  console.log(e.target.files[0]);
  logo_url.value = e.target.files[0];
};

const registerBusiness = () => {
  const token = user.token;

  const formData = new FormData();
  formData.append("name", business_name.value);
  formData.append("creator_id", user.id);
  formData.append("logo_url", logo_url.value);
  // formData.append("accept_terms", accept_terms.value);

  const response = axios
    .post("http://127.0.0.1:8000/api/add_organisation", formData, {
      headers: {
        contentType: "multipart/form-data",
        Authorization: `Bearer ${token}`,
      },
    })
    .then((res) => {
      if (res.status === 200) {
        console.log(res.data);
        router.push({ name: "Home" });
      } else {
        console.log(res.data);
        alert("Something went wrong");
      }
    })
    .catch((err) => {
      console.log(err);
      alert("Something went wrong");
    });
};
</script>

<template>
  <div class="mb-20"></div>
  <div class="container mx-auto">
    <div class="flex justify-center items-center">
      <div class="w-8/12">
        <div class="bg-white shadow-sm p-6">
          <div class="font-semibold text-lg mb-4">Register your business</div>

          <form @submit.prevent="registerBusiness">
            <input type="hidden" v-model="user_id" />
            <div class="mb-3">
              <label for="email" class="block text-left mb-1"
                >Business Name</label
              >

              <input
                class="border rounded-md py-2 px-3 w-full"
                v-model="business_name"
                required
                autocomplete="email"
                autofocus
              />
            </div>

            <div class="mb-3">
              <label class="block text-left mb-1">Logo</label>

              <input
                class="border rounded-md py-2 px-3 w-full"
                type="file"
                accept="image/*"
                @change="handleFileUpload"
                ref="logo_url"
              />
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
