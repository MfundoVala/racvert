<script setup>
import { computed } from "vue";
import store from "../store";

const organisations = computed(() => store.state.organisations);
</script>

<template>
  <div class="flex p-8 justify-center">
    <input type="text" class="rounded border-2 border-gray-200 w-64" />
  </div>
</template>
