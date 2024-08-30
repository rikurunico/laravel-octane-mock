## Panduan Penggunaan Laravel Octane dengan FrankenPHP

Laravel Octane mempercepat aplikasi Laravel Anda dengan menggunakan server yang dioptimalkan. Dalam panduan ini, kita akan menggunakan FrankenPHP sebagai server yang didukung.

### Persiapan Awal

1. **Pastikan PHP dan Docker Terinstal**  
   Laravel Octane memerlukan PHP versi 8.1 atau lebih baru. Pastikan juga Docker sudah terinstal di sistem Anda karena Laravel Sail memerlukan Docker untuk menjalankan lingkungan pengembangannya.

2. **Install Dependensi dengan Composer**  
   Sebelum menjalankan aplikasi, pastikan semua dependensi telah terinstall. Jalankan perintah berikut di direktori proyek Anda:
   
   ```bash
   composer install
   ```

3. **Copy File `.env`**  
   Laravel memerlukan file `.env` untuk konfigurasi lingkungan. Jika file `.env` belum ada, copy file `.env.example` menjadi `.env`:
   
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**  
   Setelah file `.env` ter-copy, generate application key yang akan digunakan oleh Laravel untuk enkripsi data:
   
   ```bash
   php artisan key:generate
   ```

### Langkah-langkah Instalasi dan Menjalankan Aplikasi

1. **Jalankan Sail**  
   Laravel Sail adalah lingkungan pengembangan lokal berbasis Docker. Untuk menjalankan Sail, gunakan perintah berikut:
   
   ```bash
   ./vendor/bin/sail up -d
   ```
   
   Tambahkan `-d` di akhir perintah untuk menjalankannya di background.

2. **Jalankan Migrasi Database**  
   Setelah Sail aktif, jalankan migrasi database untuk membuat tabel yang diperlukan. Gunakan perintah berikut:
   
   ```bash
   ./vendor/bin/sail artisan migrate:fresh --seed
   ```

   Perintah ini akan menghapus semua tabel yang ada, membuat ulang tabel dari awal, serta menjalankan seeder untuk mengisi database dengan data awal.

3. **Install Laravel Octane dengan FrankenPHP**  
   Untuk menginstal Laravel Octane dan memilih FrankenPHP sebagai servernya, jalankan perintah berikut:
   
   ```bash
   ./vendor/bin/sail artisan octane:install --server=frankenphp
   ```

4. **Install Chokidar untuk Hot Reload**  
   Untuk mengaktifkan fitur hot reload yang memonitor perubahan file, install paket `chokidar` dengan perintah berikut:
   
   ```bash
   ./vendor/bin/sail npm install --save-dev chokidar
   ```

5. **Jalankan Laravel Octane dengan Hot Reload**  
   Setelah semua konfigurasi selesai, jalankan Laravel Octane dengan opsi `--watch` untuk mengaktifkan hot reload:
   
   ```bash
   ./vendor/bin/sail artisan octane:start --watch
   ```

### Catatan Tambahan

- **Hot Reload**: Opsi `--watch` menggunakan `chokidar` untuk memonitor perubahan file di aplikasi Anda dan secara otomatis me-restart server ketika perubahan terdeteksi.
- **FrankenPHP**: FrankenPHP adalah server yang dioptimalkan untuk PHP dan menawarkan kinerja yang lebih baik daripada server PHP standar.

---