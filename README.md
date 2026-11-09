# SILKY & SIP - Artisanal Indulgence Website (Laravel)

Sistem E-Commerce berbasis Laravel untuk penjualan **Silky Pudding Caramel**, **Coffee Dalgona Signature**, dan **Paket Bundling**, dilengkapi dengan **Interactive Custom Studio**, **AI Taste Architect**, serta alur **Cart & Checkout** terintegrasi.

Proyek ini dibangun berdasarkan dokumen perancangan dan prototipe Google Stitch:
**Tugas Praktikum E-Commerce - Kelompok 4**  
Program Studi Manajemen Informatika, Fakultas Ilmu Komputer, Universitas Sriwijaya (2026).  
**Dosen Pengampu:** Iin Seprina, M.Kom.

---

## 🍮 Anggota Kelompok 4
1. Indi Rahmadani (09010282428036)
2. Nisa Nofrianti (09010282428038)
3. Elsa Fauzizah (09010282428038)
4. Najwa Hani Azzahra (09010582428056)
5. Taufik Arabi (09010582428064)
6. Nafisa Ayu Nadiya (09010582428065)

---

## ✨ Fitur Utama Sistem

1. **Halaman Home (`/`)**
   - Hero banner artisanal dengan tagline *"Lembut di lidah, Manis Bersua Serasi"*.
   - Tombol pintasan langsung: `Shop Now` dan `Build Your Treat`.
   - Showcase **Signature Creations** (Silky Pudding Caramel, Coffee Dalgona, Morning Indulgence Bundle).
   - Teaser studio kustomisasi dan AI Taste Architect.

2. **Halaman Shop / Indulgent Catalog (`/shop`)**
   - Filter kategori cepat: *All Creations*, *Silky Puddings*, *Dalgona & Brews*, dan *Bundles*.
   - Pencarian instan (Live search by treat name & ingredients).
   - Kartu produk lengkap dengan opsi Add-ons (*Wild Honey Drizzle*, *Extra Caramel Sauce*).
   - Tombol modal **Ingredients & Allergens** untuk transparansi bahan makanan.
   - Kontrol kuantitas (`-` `+`), tombol `Add to Cart`, dan `Buy Now`.

3. **Custom Treat / Interactive Studio (`/custom`)**
   - Kustomisasi hidangan secara visual:
     1. Pilih Base: Silky Pudding (Rp 12k), Coffee Dalgona (Rp 15k), atau Belgian Chocolate (Rp 14k).
     2. Atur Sweetness Level: *Less Sweet (50%)*, *Regular (100%)*, *Extra Sweet (+Rp 500)*.
     3. Pilih Artisanal Add-ons: *Wild Honey Drizzle* (+Rp 3.000), *Extra Caramel Sauce* (+Rp 2.000), *Whipped Dalgona Foam* (+Rp 2.500).
   - Kalkulasi harga langsung berubah secara real-time (*Live Estimated Price*).

4. **AI Assistant / Taste Architect (`/ai-assistant`)**
   - **Taste Navigator:** Rekomendasi instan untuk mood *Sweet & Creamy*, *Bold Espresso & Caramel*, *Best Bundles & Promos*, dan *Artisan Honey Pairings*.
   - **Palate Calibration:** Slider preferensi rasa manis, intensitas kopi, dan filter anggaran harga.
   - **SILKY Assistant Chat:** Percakapan pintar dengan kurator rasa AI yang merekomendasikan hidangan disertai tombol aksi `+ Add to Cart` langsung di dalam chat bubble.

5. **Cart & Checkout (`/cart`)**
   - Daftar item pilihan lengkap dengan thumbnail, tingkat kemanisan, add-ons terpilih, dan subtotal per baris.
   - Pengaturan jumlah item, penghapusan satuan, atau pengosongan keranjang (*Clear Cart*).
   - Formulir pengiriman: Nama Penerima, Nomor WhatsApp, Alamat Pengiriman, dan Catatan Khusus.
   - Pilihan metode pembayaran: **QRIS Instant**, **Bank Transfer (BCA/Mandiri)**, **E-Wallet (GoPay/OVO/Dana)**, dan **Cash on Delivery (COD)**.
   - Ringkasan biaya otomatis (Subtotal + Flat Delivery Fee + PPN Layanan 10% = Total Pembayaran).

6. **Order Successful & WhatsApp Confirmation (`/order-success/{id}`)**
   - Nomor struk transaksi unik (misal: `#SLK-79401`).
   - Rincian penerima, WhatsApp, metode pembayaran, dan total pembayaran.
   - Tombol **Kirim Konfirmasi ke WhatsApp** (`api.whatsapp.com`) yang otomatis mengisi pesan pesanan siap kirim.
   - Halaman cetak struk resmi / invoice (`/invoice/{id}`).

7. **Admin Order Dashboard (`/admin`)**
   - Ringkasan metrik: Total Pesanan, Total Omzet Pendapatan, Pesanan *Preparing*, dan Pesanan *Completed*.
   - Filter status pesanan dan pembaruan status langsung (*Preparing*, *On Delivery*, *Completed*, *Cancelled*).

---

## 🚀 Panduan Menjalankan Project

### 1. Prasyarat Sistem
- PHP 8.2+ (tersedia di XAMPP / Laragon)
- Extension PHP: `pdo_sqlite`, `fileinfo`, `mbstring`, `curl`, `openssl`, `zip`
- Composer

### 2. Cara Menjalankan Server
Buka terminal / PowerShell di folder proyek ini (`c:\Documents\Semester 5\Praktikum E-Commerce\Silky & SIP`):

```powershell
php artisan serve
```

Jika PHP berada di XAMPP dan belum masuk ke System PATH, jalankan:
```powershell
& "C:\xampp\php\php.exe" artisan serve
```

Akses website melalui browser:
👉 **http://127.0.0.1:8000**

---

## 🗄️ Database & Reset Data
Proyek menggunakan database SQLite lokal yang ringan dan tidak memerlukan konfigurasi server SQL eksternal (`database/database.sqlite`).

Untuk melakukan reset dan memasukkan kembali data awal (seed):
```powershell
& "C:\xampp\php\php.exe" artisan migrate:fresh --seed
```

---

## 🎨 Teknologi & Desain
- **Backend:** Laravel Framework v12
- **Database:** SQLite dengan Eloquent ORM
- **Frontend:** Blade Templating Engine + Tailwind CSS + Alpine.js
- **Typography:** *Playfair Display* (Serif Elegan) & *Plus Jakarta Sans* (Modern Clean Sans)
- **Palette Warna:** Warm Cream (`#FAF7F2`), Artisanal Caramel (`#C67D38`), Rich Coffee (`#23150F`), Amber Gold (`#DF9B52`).

---

## Deploy ke Vercel

Deploy menggunakan **Container Runtime Vercel + FrankenPHP**. SQLite lokal tidak persisten di Vercel; siapkan database MySQL atau PostgreSQL eksternal sebelum menerima pesanan.

1. Push repository ke GitHub dan import ke Vercel. Pastikan **Root Directory** menunjuk ke folder proyek yang berisi `Dockerfile`.
2. Tambahkan environment variables pada Vercel untuk Production dan Preview:
   - `APP_KEY`: hasilkan dengan `php artisan key:generate --show`; simpan nilainya hanya di pengaturan Vercel.
   - `APP_URL`: URL deployment, misalnya `https://nama-proyek.vercel.app`.
   - `DB_CONNECTION`: `mysql` atau `pgsql`, beserta `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` dari penyedia database.
   - `ADMIN_EMAIL` dan `ADMIN_PASSWORD`: kredensial admin unik untuk deployment. Jangan gunakan password demo lokal.
   - `APP_ENV=production`, `APP_DEBUG=false`, `LOG_CHANNEL=stderr`.
   - Untuk Neon, integrasi Vercel menyediakan `DATABASE_URL`; gunakan `DB_CONNECTION=pgsql` dan isi `DB_ENDPOINT` dengan ID endpoint dari hostname Neon. Konfigurasi PostgreSQL membaca `DATABASE_URL` dan meneruskan ID endpoint agar kompatibel dengan driver PostgreSQL yang belum mendukung SNI.
3. Jalankan migrasi pada database tersebut dari runner yang aman dan memakai environment variables production: `php artisan migrate --force`.
4. Isi katalog dan buat admin dengan `php artisan db:seed --force`. Di production, admin hanya dibuat jika `ADMIN_EMAIL` dan `ADMIN_PASSWORD` tersedia. Seeder juga memasukkan data demo, termasuk satu pesanan contoh.
5. Deploy ulang. Endpoint kesehatan Laravel tersedia di `/up`.

`SESSION_DRIVER=database` dan `CACHE_STORE=database` sudah dipilih pada image supaya session admin tersimpan di database bersama. Image juga membangun aset Vite; file `.env`, database SQLite lokal, `vendor`, dan `node_modules` tidak ikut dikirim sebagai konteks rahasia/duplikat.

Unggahan, bila ditambahkan nanti, harus disimpan di object storage seperti Vercel Blob; filesystem container tidak persisten. Jangan jalankan migrasi otomatis saat container mulai, karena beberapa instance dapat mulai bersamaan.
