# 📝 Todo List Application

Aplikasi Todo List modern yang dibangun menggunakan Laravel untuk frontend dan Golang untuk backend API. Aplikasi ini memungkinkan pengguna untuk mengelola tugas-tugas mereka dengan antarmuka yang intuitif dan performa yang cepat.

## ✨ Fitur

- ✅ Membuat, membaca, memperbarui, dan menghapus tugas (CRUD)
- 🔄 Status tugas (Aktif/Selesai)
- 🎨 Antarmuka pengguna yang modern dan responsif
- ⚡ Backend API yang cepat dengan Golang
- 🔒 Arsitektur microservice yang aman

## 🛠️ Teknologi yang Digunakan

### Frontend

- Laravel 10.x
- Tailwind CSS
- Blade Template Engine
- JavaScript

### Backend

- Golang
- PostgreSQL
- Docker

## 📋 Prasyarat

Sebelum memulai, pastikan Anda telah menginstal:

- Docker dan Docker Compose
- Git

## 🚀 Cara Instalasi

1. Clone repository ini

```bash
git clone https://github.com/iqbalprasettya/todolist-laravel-golang.git
cd todolist-laravel-golang
```

2. Jalankan dengan Docker Compose

```bash
docker-compose up -d
```

3. Aplikasi akan berjalan pada:

- Frontend: http://localhost:8000
- Backend API: http://localhost:8080
- Database: PostgreSQL pada port 5432

## 📚 Struktur Proyek

```
todolist-laravel-golang/
├── todo-frontend/         # Laravel Frontend Application
│   ├── resources/        # Views, CSS, dan JavaScript
│   ├── routes/          # Route definitions
│   └── ...
├── todo-api/            # Golang Backend API
│   ├── controllers/     # API Controllers
│   ├── models/         # Data models
│   └── ...
└── docker-compose.yml   # Docker configuration
```

## 🔧 Konfigurasi

### Environment Variables

#### Frontend (.env)

```
APP_URL=http://localhost:8000
```

#### Backend (.env)

```
DB_HOST=db
DB_USER=postgres
DB_PASSWORD=secret
DB_NAME=todo_db
DB_PORT=5432
```

## 📝 API Endpoints

| Method | Endpoint         | Deskripsi                      |
| ------ | ---------------- | ------------------------------ |
| GET    | /tasks           | Mendapatkan semua tugas        |
| POST   | /tasks           | Membuat tugas baru             |
| PUT    | /tasks/{id}      | Memperbarui tugas              |
| DELETE | /tasks/{id}      | Menghapus tugas                |
| PATCH  | /tasks/{id}/done | Menandai tugas sebagai selesai |

## 👥 Kontribusi

Kontribusi selalu diterima dengan senang hati! Untuk berkontribusi:

1. Fork repository ini
2. Buat branch baru (`git checkout -b fitur-baru`)
3. Commit perubahan Anda (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE)

## 📞 Kontak

Iqbal Prasetya - [GitHub](https://github.com/iqbalprasettya)

Link Proyek: [https://github.com/iqbalprasettya/todolist-laravel-golang](https://github.com/iqbalprasettya/todolist-laravel-golang)
