<script setup>
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({ post: Object });

const form = useForm({
  title: props.post.title,
  body: props.post.body,
  image: null
});

function submit() {
  form.post(route('posts.update', props.post.id), {
    _method: 'put'
  });
}

const breadcrumbs = [
  { title: 'داشبورد', href: route('dashboard') },
  { title: 'پست‌ها', href: route('posts.index') },
  { title: 'ویرایش پست', href: '#' },
];
</script>

<template>
  <Head title="ویرایش پست" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="max-w-xl mx-auto p-4">
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">عنوان</label>
          <input v-model="form.title" class="w-full rounded border-gray-300" />
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">متن</label>
          <textarea v-model="form.body" rows="4" class="w-full rounded border-gray-300"></textarea>
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium mb-1">تصویر جدید (اختیاری)</label>
          <input type="file" @change="e => form.image = e.target.files[0]" />
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">ویرایش</button>
      </form>
    </div>
  </AppLayout>
</template>
