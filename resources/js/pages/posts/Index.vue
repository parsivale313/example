<script setup>
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Head, router, Link } from '@inertiajs/vue3';

const props = defineProps({ posts: Object, flash: Object });

const breadcrumbs = [
  { title: 'داشبورد', href: route('dashboard') },
  { title: 'پست‌ها', href: route('posts.index') },
];

function deletePost(id) {
  if (confirm('آیا مطمئن هستید؟')) {
    router.delete(route('posts.destroy', id));
  }
}
</script>

<template>
  <Head title="لیست پست‌ها" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4">
      <div v-if="flash.success" class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ flash.success }}
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="post in posts.data" :key="post.id" class="bg-white rounded-2xl shadow overflow-hidden relative">
          <img v-if="post.image_url" :src="post.image_url" class="w-full h-48 object-cover" />
          <div class="p-4">
            <h2 class="text-lg font-bold truncate">{{ post.title }}</h2>
            <p class="text-gray-600 text-sm mt-2 line-clamp-3">{{ post.body }}</p>
            <div class="mt-4 flex justify-between items-center">
              <Link :href="route('posts.show', post.id)" class="text-blue-500 text-sm">ادامه مطلب</Link>
            </div>
          </div>
          <div class="absolute bottom-2 left-2 flex space-x-1">
            <Link :href="route('posts.edit', post.id)" class="text-xs bg-yellow-400 text-white px-2 py-1 rounded">ویرایش</Link>
            <form @submit.prevent="() => deletePost(post.id)">
              <button type="submit" class="text-xs bg-red-500 text-white px-2 py-1 rounded">حذف</button>
            </form>
          </div>
        </div>
      </div>

      <div class="mt-6 flex justify-center">
        <Link v-if="posts.prev_page_url" :href="posts.prev_page_url" class="mx-2">قبلی</Link>
        <Link v-if="posts.next_page_url" :href="posts.next_page_url" class="mx-2">بعدی</Link>
      </div>
    </div>
  </AppLayout>
</template>
