<script setup>
import store from "../store";
import router from "../router";
import { protectRoute } from "../helpers";
import { ref } from "vue";
import { IMAGES } from "../assets";

const authUser = store.state.user;
protectRoute(authUser, router);
const users = ref(null);
const org = ref(null);

const getUsers = async () => {
  console.log(authUser.token);
  const response = await fetch("http://localhost:8000/api/users", {
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
  const response = await fetch(
    `http://localhost:8000/api/organisations/${authUser.id}`,
    {
      method: "GET",
      headers: {
        Authorization: `Bearer ${authUser.token}`,
      },
    }
  );
  const data = await response.json();
  console.log(data.organisation);
  org.value = data.organisation;
};

getUsers();
getOrg();
</script>

<template>
  <div class="flex p-8 flex-col justify-start gap-4">
    <h1 class="text-2xl font-bold mb-8">Hello {{ authUser.username }}</h1>
    <h2 class="text-xl font-bold">Your Organisation</h2>
    <v-card class="bg-white rounded-lg shadow-md p-4 w-64 cursor-pointer">
      <img
        :src="org.logo_url ? org.logo_url : IMAGES.orgPlaceholder"
        class="w-32 h-32 rounded-full mx-auto mb-4"
      />
      <h3 class="text-xl font-semibold text-center">{{ org.name }}</h3>
      <p class="text-center">{{ org.description }}</p>
    </v-card>

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
    </table>
  </div>
</template>
