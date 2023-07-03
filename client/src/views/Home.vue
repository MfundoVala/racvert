<script setup>
import store from "../store";
import router from "../router";
import { protectRoute } from "../helpers";
import { ref } from "vue";
import { IMAGES, baseUrl } from "../assets";

const authUser = store.state.user;
console.log(authUser);
protectRoute(authUser, router);
const users = ref(null);
const org = ref(null);

const getUsers = async () => {
  console.log(authUser.token);
  const response = await fetch(baseUrl + "api/users", {
    method: "GET",
    headers: {
      Authorization: `Bearer ${authUser.token}`,
    },
  });
  const data = await response.json();
  console.log(data);
  users.value = data.users;
};

const getOrg = async () => {
  const response = await fetch(`${baseUrl}api/organisations/${authUser.id}`, {
    method: "GET",
    headers: {
      Authorization: `Bearer ${authUser.token}`,
    },
  });
  const data = await response.json();
  console.log(data.organisation);
  org.value = data.organisation;
  org.value.logo_url = "images/" + data.organisation.logo_url;
};

getUsers();
getOrg();
</script>

<template>
  <div class="flex p-8 flex-col justify-start gap-4">
    <h1 class="text-2xl font-bold mb-8">Hello {{ authUser.username }}</h1>
    <h2 class="text-xl font-bold">Your Organisation</h2>
    <div
      v-if="org"
      class="bg-white rounded-lg shadow-md p-4 w-64 cursor-pointer"
    >
      <img
        :src="org.logo_url ? baseUrl + org.logo_url : IMAGES.orgPlaceholder"
        class="w-32 h-32 rounded-full mx-auto mb-4"
      />
      <h3 class="text-xl font-semibold text-center">
        {{ org.name ?? "Add organisation" }}
      </h3>
    </div>

    <h2 class="text-xl font-bold">Users</h2>
    <table class="table-auto rounded bg-white">
      <thead>
        <tr>
          <th class="px-4 py-2">ID</th>
          <th class="px-4 py-2">Username</th>
          <th class="px-4 py-2">Phone</th>
          <th class="px-4 py-2">Email</th>
        </tr>
      </thead>
      <tbody v-if="users && users.length > 0">
        <tr v-for="user in users" :key="user.id">
          <td class="border px-4 py-2">{{ user.id }}</td>
          <td class="border px-4 py-2">{{ user.username }}</td>
          <td class="border px-4 py-2">{{ user.phone }}</td>
          <td class="border px-4 py-2">
            {{ user.email ? user.email : "n/a" }}
          </td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr>
          <td class="border px-4 py-2 text-center" colspan="4">
            No users found
          </td>
        </tr>
      </tbody>
    </table>

    <button
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-56"
      @click="router.push({ name: 'CreateUser' })"
    >
      Create User
    </button>
  </div>
</template>
