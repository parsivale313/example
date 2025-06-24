<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
    <div v-for="post in posts" :key="post.id" class="bg-white rounded-2xl shadow overflow-hidden">
      <img v-if="post.image" :src="`/storage/${post.image}`" class="w-full h-48 object-cover" />
      <div class="p-4">
        <h2 class="text-lg font-bold truncate">{{ post.title }}</h2>
        <p class="text-gray-600 text-sm mt-2 line-clamp-3">{{ post.body }}</p>
        <div class="mt-4 flex justify-between items-center">
          <Link :href="route('posts.show', post.id)" class="text-blue-500 text-sm">ادامه مطلب</Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({ posts: Array });
</script>