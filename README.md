## Panduan Penggunaan Laravel Octane dengan FrankenPHP

Laravel Octane mempercepat aplikasi Laravel Anda dengan menggunakan server yang dioptimalkan. Dalam panduan ini, kita akan menggunakan FrankenPHP sebagai server yang didukung.

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

   Perintah ini akan menghapus semua tabel yang ada dan membuat ulang tabel dari awal, serta menjalankan seeder untuk mengisi database dengan data awal.

3. **Install Laravel Octane dengan FrankenPHP**  
   Untuk menginstal Laravel Octane dan memilih FrankenPHP sebagai servernya, jalankan perintah berikut:
   
   ```bash
   ./vendor/bin/sail artisan octane:install --server=frankenphp
   ```

4. **Install Chokidar untuk Hot Reload**  
   Untuk mengaktifkan fitur hot reload yang memonitor perubahan file, install paket `chokidar` dengan perintah berikut:
   
   ```bash
   npm install --save-dev chokidar
   ```

5. **Jalankan Laravel Octane dengan Hot Reload**  
   Setelah semua konfigurasi selesai, jalankan Laravel Octane dengan opsi `--watch` untuk mengaktifkan hot reload:
   
   ```bash
   ./vendor/bin/sail artisan octane:start --watch
   ```

### Catatan Tambahan

- **Hot Reload**: Opsi `--watch` menggunakan `chokidar` untuk memonitor perubahan file di aplikasi Anda dan secara otomatis me-restart server ketika perubahan terdeteksi.
- **FrankenPHP**: FrankenPHP adalah server yang dioptimalkan untuk PHP dan menawarkan kinerja yang lebih baik daripada server PHP standar.