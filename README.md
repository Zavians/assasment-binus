# Assasment Test Binus 
Nama : Kenza Vianda Dwiputra

## Panduan Instalasi
- Lakukan Gitclone pada project ini
- Setelah melakukan Gitclone masuk kedalam Project dan jalankan perintah
```bash
cp .env.example .env
```
- Setelah File .env terbentuk ubah nama database sesuai kemauan anda kemudian
```bash
php artisan migrate
```
- Lalu Jalankan perintah berikut secara berurutan
```bash
composer update
```
```bash
npm i
```
```bash
npm run build
```
- Ketika sudah semua jalankan perintah

```bash
php artisan key:generate
```
- Jalankan Aplikasi dengan perintah
```bash
php artisan serve
```
- lalu jalankan perintah ini pada terminal yang berbeda
```bash
npm run dev
```

## Jalankan Seeder
- Ketika Aplikasi Sudah berhasil di jalankan ketik perintah

```bash
php artisan db:seed
```
## CATATAN
- Ketika memasuki aplikasi dan masuk kelahaman login bisa di abaikan saja dan ubah url menjadi


```bash
http://127.0.0.1:8000/dashboard
```

- Upload File hanya bisa berupa file pertipe XLS,XSLS dan CSV (Excel)
- Anda Bisa menggunkana file berikut untuk pengujian query upload soal
[donwload here](https://docs.google.com/spreadsheets/d/1yLvguZ9tm4JiTmkb9aq43115b1dAR_sq/edit?usp=sharing&ouid=116225450301243167293&rtpof=true&sd=true)