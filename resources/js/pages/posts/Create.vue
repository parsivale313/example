<template>
  <div class="max-w-xl mx-auto p-4">
    <form @submit.prevent="submit" enctype="multipart/form-data">
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">عنوان</label>
        <input
          v-model="form.title"
          type="text"
          class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <div v-if="form.errors.title" class="text-red-600 text-sm mt-1">{{ form.errors.title }}</div>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">متن</label>
        <textarea
          v-model="form.body"
          rows="4"
          class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        ></textarea>
        <div v-if="form.errors.body" class="text-red-600 text-sm mt-1">{{ form.errors.body }}</div>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">تصویر</label>
        <input type="file" @change="handleFileChange" accept="image/*" />
        <div v-if="form.errors.image" class="text-red-600 text-sm mt-1">{{ form.errors.image }}</div>
      </div>

      <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
        :disabled="form.processing"
      >
        ارسال
      </button>
    </form>
  </div>
</template>

<script lang="js" setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  title: '',
  body: '',
  image: null,
});

function handleFileChange(e) {
  form.image = e.target.files[0];
}

function submit() {
  form.post(route('posts.store'));
}
</script>
