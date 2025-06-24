<template>
  <div class="max-w-3xl mx-auto p-4">
    <img v-if="post.image" :src="`/storage/${post.image}`" class="w-full rounded-xl mb-4" />
    <h1 class="text-2xl font-bold mb-2">{{ post.title }}</h1>
    <p class="text-gray-700 leading-loose">{{ post.body }}</p>
  </div>
</template>

<script setup>
defineProps({ post: Object });
</script>