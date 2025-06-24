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
        <label class="block text-sm font-medium mb-1">تصویر فعلی</label>
        <img
          v-if="form.imagePreview || post.image_url"
          :src="form.imagePreview ? form.imagePreview : post.image_url"
          alt="تصویر پست"
          class="w-full rounded mb-4 object-cover max-h-64"
        />
        <label class="block text-sm font-medium mb-1">تصویر جدید (در صورت تمایل تغییر دهید)</label>
        <input type="file" @change="handleFileChange" accept="image/*" />
        <div v-if="form.errors.image" class="text-red-600 text-sm mt-1">{{ form.errors.image }}</div>
      </div>

      <button
        type="submit"
        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition"
        :disabled="form.processing"
      >
        ذخیره تغییرات
      </button>
    </form>
  </div>
</template>

<script lang="js" setup>
import { useForm } from '@inertiajs/vue3';

defineProps({
  post: Object,
});

const form = useForm({
  title: post.title,
  body: post.body,
  image: null,
});

const formRef = ref(null);
const formData = reactive(form);

const formImagePreview = ref(null);

function handleFileChange(e) {
  const file = e.target.files[0];
  form.image = file || null;
  if (file) {
    const reader = new FileReader();
    reader.onload = e => {
      form.imagePreview = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    form.imagePreview = null;
  }
}

function submit() {
  form.put(route('posts.update', post.id));
}
</script>
