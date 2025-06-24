<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
    <div
      v-for="post in posts.data"
      :key="post.id"
      class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition cursor-pointer"
    >
      <img
        v-if="post.image_url"
        :src="post.image_url"
        alt="تصویر پست"
        class="w-full h-48 object-cover"
      />
      <div class="p-4">
        <h2
          class="text-lg font-bold truncate"
          :title="post.title"
        >
          {{ post.title }}
        </h2>
        <p class="text-gray-600 text-sm mt-2 line-clamp-3">{{ post.body }}</p>
        <div class="mt-4 flex justify-between items-center">
          <Link
            :href="route('posts.show', post.id)"
            class="text-blue-600 hover:underline text-sm"
          >
            ادامه مطلب
          </Link>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    <div class="col-span-full flex justify-center mt-6">
      <button
        v-if="posts.prev_page_url"
        @click="navigate(posts.prev_page_url)"
        class="px-3 py-1 rounded border border-gray-300 mr-2 hover:bg-gray-100"
      >
        قبلی
      </button>
      <button
        v-if="posts.next_page_url"
        @click="navigate(posts.next_page_url)"
        class="px-3 py-1 rounded border border-gray-300 hover:bg-gray-100"
      >
        بعدی
      </button>
    </div>
  </div>
</template>

<script lang="js" setup>
import { Link, router } from '@inertiajs/vue3';

defineProps({
  posts: Object,
});

function navigate(url) {
  router.visit(url, { preserveState: true, preserveScroll: true });
}
</script>
