<template>
  <div class="max-w-3xl mx-auto p-4">
    <img
      v-if="post.image_url"
      :src="post.image_url"
      alt="تصویر پست"
      class="w-full rounded-xl mb-6 object-cover max-h-96"
    />
    <h1 class="text-3xl font-bold mb-4">{{ post.title }}</h1>
    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ post.body }}</p>
  </div>
</template>

<script setup>
defineProps({
  post: Object,
});
</script>
