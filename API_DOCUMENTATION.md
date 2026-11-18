
# Helpdesk API Documentation

## 1. Overview

Helpdesk API merupakan REST API untuk menyediakan akses data
Ticket dan Asset pada sistem IT Helpdesk PT Gateway Container Line.

API dibangun menggunakan Laravel dan Laravel Sanctum sebagai
mekanisme autentikasi.

API ini bersifat read-only, sehingga hanya menyediakan akses
untuk membaca data.

## 2. Base URL

Local:
http://localhost:8000/api/v1

Production:
Belum ditentukan.

## 3. Authentication

API menggunakan Laravel Sanctum dengan Bearer Token.

Setiap request ke endpoint API wajib menyertakan token
pada HTTP Authorization Header.

Contoh:

Authorization: Bearer YOUR_ACCESS_TOKEN

Token harus diperoleh melalui mekanisme autentikasi
yang disediakan oleh sistem.

## 4. Ticket Endpoints

### 4.1 Get All Tickets

- Method: GET
- Endpoint: /tickets
- Authentication: Required
- Description: Mengambil daftar tiket.
- Pagination: 15 data per halaman.

Contoh response:

{
  "success": true,
  "message": "Ticket list retrieved successfully.",
  "data": [],
  "meta": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 15,
    "total": 0
  }
}

### 4.2 Get Ticket Detail

- Method: GET
- Endpoint: /tickets/{id}
- Authentication: Required
- Description: Mengambil detail tiket berdasarkan ID.

Contoh response:

{
  "success": true,
  "message": "Ticket detail retrieved successfully.",
  "data": {
    "id": 1,
    "ticket_number": "TCK-001",
    "subject": "Network Issue",
    "priority": "high",
    "status": "open"
  }
}

## 5. Asset Endpoints

### 5.1 Get All Assets

- Method: GET
- Endpoint: /assets
- Authentication: Required
- Description: Mengambil daftar aset.
- Pagination: 15 data per halaman.

Contoh response:

{
  "success": true,
  "message": "Asset list retrieved successfully.",
  "data": [],
  "meta": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 15,
    "total": 0
  }
}

### 5.2 Get Asset Detail

- Method: GET
- Endpoint: /assets/{id}
- Authentication: Required
- Description: Mengambil detail aset berdasarkan ID.

Contoh response:

{
  "success": true,
  "message": "Asset detail retrieved successfully.",
  "data": {
    "id": 1,
    "asset_code": "AST-001",
    "name": "Laptop",
    "brand": "Lenovo",
    "condition": "good",
    "status": "in_use"
  }
}

## 6. HTTP Status Codes

| Status Code | Description |
|---|---|
| 200 | Request successful |
| 401 | Unauthenticated |
| 404 | Data not found |
| 500 | Internal server error |

## 7. Security

- API menggunakan autentikasi Laravel Sanctum.
- API hanya menyediakan metode GET.
- Password remote access tidak disertakan dalam response Ticket.
- Data hanya diberikan kepada request yang terautentikasi.

## 8. Notes

- API belum terhubung ke database development.
- Endpoint belum diuji secara langsung menggunakan Postman.
- Base URL production belum ditentukan.
- Penerbitan dan pengelolaan token masih perlu dikonfigurasi.
- Hak akses berdasarkan role pengguna masih perlu ditentukan.
