# IT Helpdesk PT Gateway

Sistem IT Helpdesk berbasis web yang dikembangkan untuk membantu proses pelaporan, penanganan, pemantauan, dan pencatatan masalah IT di lingkungan PT Gateway.

Sistem ini dirancang untuk mempermudah komunikasi antara User, IT Support, dan Admin/Manager serta membantu dokumentasi aktivitas IT secara lebih terstruktur.

---

## 📌 Tentang Project

IT Helpdesk PT Gateway merupakan aplikasi internal berbasis web yang digunakan untuk mengelola layanan dan permasalahan IT.

Sistem mencakup beberapa proses utama:

- Pelaporan masalah IT melalui tiket
- Pengelolaan dan penanganan tiket
- Penentuan metode penanganan
- Manajemen aset IT
- Pemeliharaan komputer
- Pemeliharaan Internet/Server
- Riwayat aktivitas
- Monitoring dan pelaporan

Project ini dikembangkan menggunakan framework Laravel dan ditujukan untuk kebutuhan internal PT Gateway.

---

## 👥 Role Pengguna

Sistem memiliki 3 role utama:

### 👤 User

User merupakan karyawan yang menggunakan layanan IT Helpdesk.

Fitur utama:

- Dashboard
- Membuat tiket
- Melihat tiket sendiri
- Melihat status tiket
- Melihat informasi maintenance yang berkaitan dengan perangkatnya
- Konfirmasi hasil maintenance

---

### 🧑‍💻 IT Support

IT Support bertugas menangani laporan dan melakukan pemeliharaan perangkat maupun infrastruktur IT.

Fitur utama:

- Dashboard IT Support
- Melihat semua tiket
- Mengambil/menangani tiket
- Melihat tiket yang sedang ditangani
- Mengubah status tiket
- Menentukan metode penanganan
- Maintenance PC/Komputer
- Maintenance Internet/Server
- Melihat riwayat maintenance
- Mengelola informasi penanganan

Metode penanganan yang tersedia:

- Tatap Muka
- Remote

---

### 👨‍💼 Admin / Manager

Admin/Manager bertugas melakukan monitoring dan pengelolaan sistem.

Fitur utama:

- Dashboard Admin
- Monitoring tiket
- Asset Management
- Melihat riwayat aset
- Monitoring maintenance
- Melihat laporan PC Maintenance
- Melihat laporan Internet/Server Maintenance
- Monitoring aktivitas IT

---

## 🎫 Sistem Ticketing

User dapat membuat tiket ketika mengalami masalah IT.

Informasi tiket meliputi:

- Nomor tiket
- Kategori masalah
- Nama/kode aset
- Subjek masalah
- Deskripsi masalah
- Prioritas
- Status tiket
- IT Support yang menangani
- Metode penanganan
- Waktu penanganan
- Waktu penyelesaian

### Status Tiket

Beberapa status yang digunakan dalam proses ticketing:

```text
Open
  ↓
Assigned
  ↓
In Progress
  ↓
Resolved
  ↓
Closed
