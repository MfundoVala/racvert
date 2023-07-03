<script setup>
import { ref } from "vue";
import router from "../../router";
import store from "../../store";

const isDropdownOpen = ref(false);

const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};

const logout = () => {
  store.commit("setUser", {});
  router.push({ name: "Login" });
};
</script>

<template>
  <nav class="bg-gray-800 w-full">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <a class="text-white font-bold text-lg" href="#">Logo</a>
        </div>
        <div class="invisible">
          <ul class="flex items-center space-x-4">
            <li class="relative sm:visible">
              <a
                class="flex items-center text-white hover:text-gray-300 px-2 py-1 rounded-md"
                href="#"
                @click="toggleDropdown"
                :class="{ 'text-gray-300': isDropdownOpen }"
              >
                <div class="w-7 h-7 flex flex-col justify-between">
                  <span class="bg-white h-1"></span>
                  <span class="bg-white h-1"></span>
                  <span class="bg-white h-1"></span>
                </div>
              </a>
              <div
                v-show="isDropdownOpen"
                class="absolute right-0 mt-3 w-48 bg-white rounded-md shadow-lg"
              >
                <div class="py-1">
                  <a
                    href="#"
                    class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                    >Users</a
                  >
                  <a
                    href="#"
                    class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                    >My Org</a
                  >
                  <a
                    href="#"
                    class="block px-4 py-2 text-gray-800 hover:bg-gray-200"
                    >My Profile</a
                  >
                  <button class="text-black px-4 py-2" @click="logout">
                    Logout
                  </button>
                </div>
              </div>
            </li>
            <li class="sm:hidden md:block">
              <a
                class="hover:bg-white p-2 text-white hover:text-gray-800 md:visible"
                href="#"
                >My Org</a
              >
            </li>
            <li class="sm:hidden md:block">
              <a
                class="hover:bg-white p-2 text-white hover:text-gray-800 md:visible"
                href="/login"
                >My Profile</a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>

<style lang=""></style>
