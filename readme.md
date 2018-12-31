### Clone proyek

```sh
git clone https://github.com/harumshidiqi/laravel-blog.git
```

### Konfigurasi proyek
Jalankan perintah berikut untuk melakukan konfigurasi proyek

Copy file .env.example dan rename menjadi .env kemudian atur database
```sh
DB_DATABASE=(nama database)
DB_USERNAME=(username)
DB_PASSWORD=(password bila ada/kosong bila tidak ada)
```
---
Setelah setup database jalankan perintah berikut
```sh
composer install
npm install
php artisan key:generate
php artisan migrate:fresh --seed
```
---
Sebelum membuka __localhost:8000__ silahkan compile file asset dengan menjalankan
```sh
npm run dev
```
Untuk menjalankan laravel-blog jalankan perintah berikut di terminal lalu buka __localhost:8000__
```sh
php artisan serve
```