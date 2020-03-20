## DSTI CMS
### Cara Install

- Buka terminal kemudian jalankan `git clone https://github.com/rsuregar/dsticms.git`
- buka folder dsticms di Terminal. Jalankan `composer install` 
- kemudian jalankan lagi `npm install && npm run dev`
- copy .env di terminal dengan perintah `cp .env.example .env`
- edit `.env` sesuaikan `APP_URL =url web Anda` dan atur konfigurasi database `DB_DATABASE=namaDB >> DB_USERNAME=userDB >> DB_PASSWORD=passwordDB`
- jalankan perintah `php artisan migrate` ketik `yes` jika diminta untuk konfirmasi
- jalankan perintah `php artisan db:seed --class=Setup` ketik `yes` jika diminta untuk konfirmasi
- silakan login melalui link `namaweb/auth/manage` dengan `user: admin@admin.com & pass: password`
- instalasi selesai. Selamat menggunakan dan bereksplorasi dan berkontribusi.
