## DSTI CMS
### Cara Install

- Buka terminal kemudian jalankan `git clone https://github.com/rsuregar/gundalacms.git`
- buka folder `gundalaCMS` di Terminal. Jalankan `composer install`
- copy .env di terminal dengan perintah `cp .env.example .env`
- edit `.env` sesuaikan `APP_URL =urlWebAnda` dan atur konfigurasi database `DB_DATABASE=namaDB >> DB_USERNAME=userDB >> DB_PASSWORD=passwordDB`
- jalankan perintah `php artisan gundalacms:pasang ` ketik `yes` jika diminta untuk konfirmasi dan tunggu sampai proses instalasi selesai.
- jalankan perintah `php artisan serve` untuk menjalankan aplikasi
- silakan login melalui link `namaweb/auth/manage` dengan `user: admin@admin.com & pass: password`
- jalankan perintah `php artisan gundalacms:cabut` untuk uninstall GundalaCMS.
- instalasi selesai. Selamat menggunakan, bereksplorasi dan berkontribusi.

### Ayo berkolaborasi
- jika terdapat bug, error dan lain sebagainya silakan membuat issue di github
- silakan menambahkan dan memperbaiki apapun didalam GundalaCMS melalui PR dan lain sebgainya.
