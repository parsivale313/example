<template>
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
        <label class="block text-sm font-medium mb-1">تصویر</label>
        <input type="file" @change="e => form.image = e.target.files[0]" />
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">ارسال</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  title: '',
  body: '',
  image: null
});

function submit() {
  form.post(route('posts.store'));
}
</script>
