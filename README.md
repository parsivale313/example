# Laravel 12 + Inertia.js + Vue 3 + Tailwind CSS - Post Module

این پروژه نمونه‌ای ساده و کامل از پیاده‌سازی یک ماژول پست در Laravel 12 است که با استفاده از **Vue 3**، **Inertia.js** و **Tailwind CSS** ساخته شده است.

---

## ✨ ویژگی‌ها

- 📄 ایجاد، نمایش، ویرایش و حذف پست‌ها (CRUD)
- 🖼️ آپلود و نمایش تصاویر با ذخیره‌سازی در `storage`
- 🧾 فرم اعتبارسنجی سمت سرور با پیام‌های خطای مناسب
- 🔐 احراز هویت برای محافظت از مسیرهای ساخت، ویرایش و حذف
- 🎨 طراحی واکنش‌گرا و زیبا با Tailwind CSS
- ⚡ اتصال مستقیم Vue و Laravel بدون نیاز به API با Inertia.js

---

## 📦 تکنولوژی‌های استفاده‌شده

- Laravel 12
- Vue 3 (Composition API)
- Inertia.js
- Tailwind CSS
- Vite
- Laravel Breeze (برای سیستم ورود و ثبت‌نام)

---

## 📷 دموی رابط کاربری

![Post Cards UI](./screenshots/posts.png)

---

## ⚙️ نصب و اجرا

```bash
git clone https://github.com/username/project-name.git
cd project-name

# نصب وابستگی‌های PHP
composer install

# نصب وابستگی‌های JavaScript
npm install && npm run dev

# راه‌اندازی تنظیمات پروژه
cp .env.example .env
php artisan key:generate

# اجرای مهاجرت‌ها
php artisan migrate

# لینک کردن پوشه storage
php artisan storage:link

resources/js/Pages/Posts/
  ├── Index.vue    # نمایش همه پست‌ها
  ├── Show.vue     # نمایش جزئیات پست
  ├── Create.vue   # ساخت پست جدید
  └── Edit.vue     # ویرایش پست

این پروژه تحت مجوز [Apache License 2.0](./LICENSE) منتشر شده است.  
© 2025 parsi_vale – استفاده، تغییر و توزیع پروژه با رعایت مفاد لایسنس آزاد است.