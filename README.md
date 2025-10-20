# SABAR (Sistem Administrasi Barang)

**SABAR** adalah aplikasi web yang dibangun menggunakan framework CodeIgniter 4 untuk membantu dalam pengelolaan dan administrasi data inventaris barang. Aplikasi ini dirancang untuk memudahkan pencatatan, pelacakan, dan pelaporan aset atau barang secara efisien.

## Fitur Utama

- **Autentikasi Pengguna**: Sistem registrasi, login, dan logout yang aman.
- **Manajemen Barang (CRUD)**:
  - Menambah, melihat, mengubah, dan menghapus data barang.
  - Mengelompokkan barang berdasarkan kategori dan lokasi.
- **DataTables Server-Side**: Menampilkan daftar barang dengan cepat dan efisien, bahkan dengan jumlah data yang sangat besar, lengkap dengan fitur pencarian dan paginasi.
- **Upload Media**:
  - Mengunggah **gambar barang** dengan preview sebelum upload.
  - Mengunggah **dokumen BAST** (Berita Acara Serah Terima) dalam format PDF, DOC, atau DOCX.
- **Generasi QR Code**: Setiap barang secara otomatis dibuatkan QR Code yang berisi informasi ringkas, memudahkan pelacakan fisik.
- **Halaman Detail**: Tampilan detail untuk setiap barang yang mencakup semua informasi, gambar, preview dokumen, dan QR Code yang dapat diunduh.
- **Validasi Form**: Validasi input di sisi server untuk memastikan integritas data.
- **UI/UX Modern**: Antarmuka yang bersih dan responsif menggunakan Bootstrap, dengan komponen interaktif seperti modal dan preview file.

## Teknologi yang Digunakan

- **Backend**: PHP 8.1+, CodeIgniter 4
- **Frontend**: HTML, CSS, JavaScript, Bootstrap 5, jQuery
- **Database**: MySQL (via `mysqlnd`)
- **Library**:
  - `chillerlan/php-qrcode`: Untuk menghasilkan QR Code.
  - `DataTables`: Untuk tabel interaktif.

## Persyaratan Server

PHP version 8.1 or higher is required, with the following extensions installed:

- intl
- mbstring

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- mysqlnd if you plan to use MySQL
- libcurl if you plan to use the HTTP\CURLRequest library

## Panduan Instalasi

1.  **Clone Repository**
    ```bash
    git clone [URL_REPOSITORY_ANDA] sabar
    cd sabar
    ```

2.  **Install Dependencies**
    Pastikan Anda memiliki Composer. Jalankan perintah berikut untuk menginstal semua library yang dibutuhkan.
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment**
    Salin file `env` menjadi `.env` untuk konfigurasi environment lokal Anda.
    ```bash
    copy env .env
    ```
    Buka file `.env` dan sesuaikan baris berikut:
    ```
    CI_ENVIRONMENT = development

    app.baseURL = 'http://localhost:8080' # Sesuaikan dengan URL Anda

    database.default.hostname = localhost
    database.default.database = sabar_db # Nama database Anda
    database.default.username = root
    database.default.password = # Password database Anda
    database.default.DBDriver = MySQLi
    ```

4.  **Setup Database**
    - Buat database baru di MySQL dengan nama yang telah Anda tentukan di file `.env` (contoh: `sabar_db`).
    - Jalankan migrasi untuk membuat semua tabel yang diperlukan oleh aplikasi.
      ```bash
      php spark migrate
      ```

5.  **Jalankan Aplikasi**
    Anda dapat menggunakan server development bawaan CodeIgniter.
    ```bash
    php spark serve
    ```
    Aplikasi akan berjalan dan dapat diakses di `http://localhost:8080` (atau sesuai `app.baseURL` Anda).

## Struktur Direktori Penting

- `public/uploads/barang/images/`: Lokasi penyimpanan gambar barang yang diunggah.
- `public/uploads/barang/documents/`: Lokasi penyimpanan dokumen BAST yang diunggah.
- `public/uploads/barang/qrcodes/`: Lokasi penyimpanan file QR Code yang dihasilkan.

Pastikan direktori-direktori di atas memiliki izin tulis (writable) oleh web server.

