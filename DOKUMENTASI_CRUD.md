# Laporan Dokumentasi Pembuatan Fitur CRUD (Eloquent ORM & Query Builder)

**Proyek:** POS Apotek (Lara-Quent)
**Deskripsi Tugas:** Mengimplementasikan fungsionalitas CRUD secara penuh untuk entitas Obat, Staff, dan Supplier, menggunakan dua pendekatan penulisan query Laravel yaitu **Eloquent ORM** dan **Query Builder**.

## Struktur File (Folder Tree)
Berikut adalah daftar direktori dan file yang dibuat/dimodifikasi secara khusus untuk fitur CRUD ini:

```text
Lara-Quent/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ObatController.php
│   │       ├── StaffController.php
│   │       └── SupplierController.php
│   └── Models/
│       ├── Obat.php
│       ├── Staff.php
│       └── Supplier.php
├── database/
│   ├── factories/
│   │   ├── ObatFactory.php
│   │   ├── StaffFactory.php
│   │   └── SupplierFactory.php
│   ├── migrations/
│   │   ├── 2026_03_10_141111_create_obats_table.php
│   │   ├── 2026_03_10_141055_create_staff_table.php
│   │   └── 2026_03_10_141213_create_suppliers_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── obat/
│       │   └── index.blade.php
│       ├── staff/
│       │   └── index.blade.php
│       └── supplier/
│       │   └── index.blade.php
└── routes/
    └── web.php
```

---

## Langkah-langkah Penyelesaian Tugas

### 1. Penyesuaian Database, Model, dan Data Awal
Tahap pertama adalah menyesuaikan kolom tabel pada *migration*, mendaftarkan properti *$fillable* pada model, serta menyiapkan *Factory* dan *Seeder* untuk data dumi.
*   **File Migrasi:**
    *   `database/migrations/2026_03_10_141111_create_obats_table.php`
    *   `database/migrations/2026_03_10_141055_create_staff_table.php`
    *   `database/migrations/2026_03_10_141213_create_suppliers_table.php`
    *(Tipe data String diubah menjadi Decimal, Text, dan Integer sesuai kebutuhan masing-masing)*
*   **File Model:**
    *   `app/Models/Obat.php`
    *   `app/Models/Staff.php`
    *   `app/Models/Supplier.php`
    *(Menambahkan deklarasi `protected $fillable` untuk proses input Mass Assignment)*
*   **File Factory & Seeder:**
    *   `database/factories/ObatFactory.php`, `StaffFactory.php`, `SupplierFactory.php`
    *   `database/seeders/DatabaseSeeder.php`
    *(Mengonfigurasi library Faker untuk generate 6 data dumi per-tabel bahasa Indonesia)*

### 2. Konfigurasi Routing (URL)
Tahap kedua adalah mendaftarkan rute *(routes)* aplikasi untuk menangani *Request* masuk yang diarahkan ke Controller sesuai dengan modenya.
*   **File Route:** `routes/web.php`
*   Terdiri dari rute *Read* (GET), *Create* (POST), *Update* (PUT), dan *Delete* (DELETE).
*   Rute tersebut dipisahkan menjadi dua prefix URI: 
    *   `/eloquent` (Contoh: `/obat/eloquent`)
    *   `/query-builder` (Contoh: `/obat/query-builder`)

### 3. Pembuatan Antarmuka (UI) dengan Bootstrap Modals
Tahap ketiga adalah membangun User Interface (UI) menggunakan *framework* CSS Bootstrap 5. 
*   **File Layout Utama:** `resources/views/layouts/app.blade.php` 
    *(Memuat styling sistem kerangka dasar Sidebar dinamis)*
*   **File View Halaman (Obat, Staff, Supplier):**
    *   `resources/views/obat/index.blade.php`
    *   `resources/views/staff/index.blade.php`
    *   `resources/views/supplier/index.blade.php`
*   **Komponen Terintegrasi:** 
    *   Tabel HTML untuk menampilkan daftar data (Read).
    *   Sebuah popup _Bootstrap Modal_ yang menampung form input data dinamis (Create/Edit)
    *   Fungsi *Vanilla JavaScript* untuk mengisi input data *(populate)* secara otomatis saat menekan tombol Edit berdasarkan baris data yang dipilih.
    *   Form khusus penghapusan yang menyertakan konfirmasi (*onclick alert*).

### 4. Implementasi Controller (Logika CRUD)
Tahap terakhir adalah mengolah *Request* untuk berinteraksi dengan Database pada Controller, dengan dua teknik yang diinstruksikan.
*   **File Controller:**
    *   `app/Http/Controllers/ObatController.php`
    *   `app/Http/Controllers/StaffController.php`
    *   `app/Http/Controllers/SupplierController.php`

Semua method melewati fase pengamanan Form Validasi terlebih dahulu: `$request->validate([...])`.

---

## Perbedaan Teknis: Eloquent vs Query Builder

Dalam pengaplikasian pada controller, terdapat perbedaan fundamental mengenai cara berinteraksi dengan basis data:

### **A. Eloquent ORM** (Object-Relational Mapping)
Bekerja dengan memetakan sebuah tabel ke dalam bentuk sebuah Class Object model (`app/Models/Obat.php`). Sintaksnya sangat ringkas, *readable*, dan Laravel menangani pengisian otomatis *timestamps* (`created_at` & `updated_at`). 
**(Kode Implementasi)**
*   **Read:** `Obat::latest()->get();`
*   **Create:** `Obat::create($validatedData);`
*   **Update:** `Obat::findOrFail($id)->update($validatedData);`
*   **Delete:** `Obat::findOrFail($id)->delete();`

### **B. Query Builder**
Bekerja langsung memanggil tabel di basis data dengan menggunakan fasad `DB::table()`. Eksekusinya dapat lebih cepat namun lebih eksplisit, di mana kita perlu menginjeksikan data tanggal manual untuk *timestamps*.
**(Kode Implementasi)**
*   **Read:** `DB::table('obats')->orderBy('created_at', 'desc')->get();`
*   **Create:** 
    `$validatedData['created_at'] = now();`
    `DB::table('obats')->insert($validatedData);`
*   **Update:** 
    `$validatedData['updated_at'] = now();`
    `DB::table('obats')->where('id', $id)->update($validatedData);`
*   **Delete:** `DB::table('obats')->where('id', $id)->delete();`
