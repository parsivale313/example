<script setup>
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({ post: Object });

const breadcrumbs = [
  { title: 'داشبورد', href: route('dashboard') },
  { title: 'پست‌ها', href: route('posts.index') },
  { title: props.post.title, href: '#' },
];
</script>

<template>
  <Head title="{{ post.title }}" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="max-w-3xl mx-auto p-4">
      <img v-if="post.image_url" :src="post.image_url" class="w-full rounded-xl mb-4" />
      <h1 class="text-2xl font-bold mb-2">{{ post.title }}</h1>
      <p class="text-gray-700 leading-loose">{{ post.body }}</p>
    </div>
  </AppLayout>
</template>