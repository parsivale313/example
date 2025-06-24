<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;


class PostControllerTest extends TestCase
{
    use RefreshDatabase; // برای پاک‌سازی دیتابیس بین تست‌ها

    /** 
     * تست صفحه لیست پست‌ها 
     */
    public function test_index_displays_posts()
    {
        Post::factory()->count(3)->create();

        $response = $this->get(route('posts.index'));

        $response->assertStatus(200)
                 ->assertInertia(fn ($page) =>
                    $page->component('Posts/Index')
                         ->has('posts.data', 3)  // انتظار داریم ۳ پست دریافت کنیم
                 );
    }

    /**
     * تست نمایش صفحه ایجاد پست (نیازمند احراز هویت)
     */
    public function test_create_requires_authentication()
    {
        $response = $this->get(route('posts.create'));
        $response->assertRedirect('/login'); // اگر لاگین نکرده باشد به صفحه لاگین میرود

        // اگر احراز هویت کنیم باید ۲۰۰ شود
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('posts.create'));
        $response->assertStatus(200)
                 ->assertInertia(fn ($page) => 
                    $page->component('Posts/Create')
                 );
    }

    /**
     * تست ذخیره پست جدید با تصویر و داده‌های معتبر
     */
    public function test_store_saves_post_with_image()
    {
        Storage::fake('public');

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('post.jpg');

        $response = $this->post(route('posts.store'), [
            'title' => 'عنوان تست',
            'body' => 'متن تست',
            'image' => $file,
        ]);

        $response->assertRedirect(route('posts.index'))
                ->assertSessionHas('success', 'پست با موفقیت ایجاد شد.');

        $this->assertDatabaseHas('posts', [
            'title' => 'عنوان تست',
            'body' => 'متن تست',
        ]);

        // بررسی اینکه فایل تصویر در storage ذخیره شده
        Storage::disk('public')->assertExists('posts/' . $file->hashName());
    }

    /**
     * تست ویرایش پست (نمایش فرم و ارسال فرم)
     */
    public function test_edit_and_update_post()
    {
        Storage::fake('public');

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create([
            'title' => 'عنوان اولیه',
            'body' => 'متن اولیه',
            'image' => null,
        ]);

        // درخواست صفحه ویرایش
        $response = $this->get(route('posts.edit', $post->id));
        $response->assertStatus(200)
                 ->assertInertia(fn ($page) =>
                    $page->component('Posts/Edit')
                         ->where('post.id', $post->id)
                 );

        // ارسال فرم ویرایش با داده جدید و تصویر جدید
        $file = UploadedFile::fake()->image('newimage.png');

        $response = $this->put(route('posts.update', $post->id), [
            'title' => 'عنوان جدید',
            'body' => 'متن جدید',
            'image' => $file,
        ]);

        $response->assertRedirect(route('posts.index'))
                 ->assertSessionHas('success', 'پست ویرایش شد.');

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'عنوان جدید',
            'body' => 'متن جدید',
        ]);

        Storage::disk('public')->assertExists('posts/' . $file->hashName());
    }

    /**
     * تست حذف پست
     */
    public function test_destroy_deletes_post_and_image()
    {
        Storage::fake('public');

        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        // ایجاد پست با تصویر
        $file = UploadedFile::fake()->image('delete.jpg');
        $path = $file->store('posts', 'public');

        $post = Post::factory()->create([
            'image' => $path,
        ]);

        Storage::disk('public')->assertExists($path);

        // درخواست حذف
        $response = $this->delete(route('posts.destroy', $post->id));
        $response->assertRedirect(route('posts.index'))
                 ->assertSessionHas('success', 'پست حذف شد.');

        // بررسی حذف دیتابیس
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);

        // بررسی حذف فایل تصویر
        Storage::disk('public')->assertMissing($path);
    }
}
