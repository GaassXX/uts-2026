# 📚 Portfolio Project UTS

Ini adalah project **Portfolio** yang dikembangkan sebagai tugas UTS untuk Mata Kuliah Pemrograman Web dengan menggunakan **Laravel Filament** sebagai admin panel.

---

## 👤 Informasi Mahasiswa

| Detail | Informasi |
|--------|-----------|
| **Nama** | Rizqi Bagas Wicaksono |
| **NIM** | 20240801187 |
| **URL Project** | https://uts.test |
| **Admin Panel** | https://uts.test/admin |

---

## 🎯 Fitur Utama

### 1. **Homepage** (`/`)
- Profil singkat dengan foto dan biodata
- Menampilkan pengalaman kerja dan total project
- Social media links (GitHub, LinkedIn, Email)
- Tech stack yang digunakan dengan icon

### 2. **Projects Page** (`/projects`)
- Grid layout modern untuk menampilkan semua project
- Filter berdasarkan kategori
- Tampilan card yang rapi dengan:
  - Icon/Thumbnail project
  - Status project (In Progress, Planning, Completed)
  - Deskripsi singkat
  - Tech stack yang digunakan
  - Progress bar
  - Informasi update terakhir
  - Tombol "View Detail" untuk melihat detail project

### 3. **Project Detail Page** (`/projects/{id}`)
- Tampilan detail lengkap dari sebuah project
- Galeri project
- Deskripsi lengkap
- Tech stack yang digunakan
- Live demo dan GitHub link
- Timeline perkembangan project

### 4. **Contact Page** (`/contact`)
- Form untuk mengirimkan pesan
- Informasi kontak langsung

### 5. **Admin Panel** (`/admin`)
- **Dashboard** - Overview dengan statistik
- **Profile Management** - Edit data diri, foto profil, biodata
- **Project Management** - CRUD project dengan fitur:
  - Upload thumbnail/galeri
  - Kelola tech stack
  - Set progress
  - Publish/unpublish project
- **User Management** - Kelola akun admin
- **Activity Logging** - Pencatatan semua aktivitas di admin

---

## 🛠️ Tech Stack

### Backend
- **Laravel 12** - PHP Framework
- **Filament 3** - Admin Panel & UI Components
- **MySQL/MariaDB** - Database
- **Livewire** - Reactive components

### Frontend
- **Tailwind CSS** - Styling
- **Alpine.js** - Interactivity
- **Vite** - Build tool
- **Blade** - Templating

### Tools & Infrastructure
- **Docker** - Containerization
- **Nginx** - Web server
- **PHP** - Backend runtime

---

## 📦 Instalasi & Setup

### Prerequisites
- Docker & Docker Compose
- Git

### Langkah-langkah Instalasi

#### 1. **Clone Repository**
```bash
git clone <repo-url>
cd uts
```

#### 2. **Setup Environment**
```bash
cd src
cp .env.example .env
```

#### 3. **Start Docker Containers**
```bash
cd ..
docker-compose up -d
```

#### 4. **Install Dependencies**
```bash
docker-compose exec php composer install
docker-compose exec php npm install
```

#### 5. **Generate Application Key**
```bash
docker-compose exec php php artisan key:generate
```

#### 6. **Run Database Migrations**
```bash
docker-compose exec php php artisan migrate
```

#### 7. **Seed Database (Optional - untuk data dummy)**
```bash
docker-compose exec php php artisan db:seed
```

#### 8. **Build Frontend Assets**
```bash
docker-compose exec php npm run build
```

#### 9. **Access Application**
- **Homepage**: https://uts.test
- **Admin Panel**: https://uts.test/admin
- **Projects**: https://uts.test/projects
- **Contact**: https://uts.test/contact

---

## 📖 Cara Menggunakan Project

### Sebagai Pengunjung (Public User)

#### 1. **Akses Homepage**
- Buka https://uts.test
- Lihat profil dan biodata
- Scroll untuk melihat tech stack yang digunakan
- Klik tombol "Lihat Project Saya" untuk melihat daftar project
- Klik social media untuk follow di LinkedIn/GitHub

#### 2. **Lihat Projects**
- Buka https://uts.test/projects
- Scroll untuk melihat grid project
- Hover di atas card untuk melihat efek hover
- Klik "View Detail →" untuk melihat detail project
- Lihat galeri, deskripsi lengkap, dan link project

#### 3. **Hubungi Developer**
- Buka https://uts.test/contact
- Isi form dengan nama, email, dan pesan
- Klik tombol kirim

### Sebagai Admin

#### 1. **Login ke Admin Panel**
- Buka https://uts.test/admin
- Gunakan kredensial yang telah dibuat

#### 2. **Edit Profil (Profile Management)**
- Klik menu "Profile" di sidebar
- Edit semua informasi:
  - **Nama Lengkap** - Nama Anda
  - **Tagline** - Tagline/posisi (misal: Full Stack Developer)
  - **Bio** - Deskripsi singkat tentang Anda
  - **Foto Profil** - Upload atau ubah foto
  - **Years of Experience** - Tahun pengalaman
  - **Total Projects** - Total project yang pernah dibuat
  - **Availability** - Status ketersediaan
  - **GitHub URL** - Link profil GitHub
  - **LinkedIn URL** - Link profil LinkedIn
  - **Email** - Email kontak
- Klik "Save" atau "Simpan" untuk menyimpan perubahan

#### 3. **Kelola Projects (Project Management)**
- Klik menu "Projects" di sidebar
- **Membuat Project Baru**:
  - Klik tombol "+ Create" atau "New Project"
  - Isi form dengan informasi project:
    - **Title** - Judul project
    - **Slug** - URL-friendly version (auto-generated)
    - **Description** - Deskripsi lengkap
    - **Short Description** - Deskripsi singkat
    - **Status** - In Progress / Planning / Completed
    - **Progress** - Persentase kemajuan (0-100)
    - **Thumbnail** - Upload gambar utama project
    - **Gallery** - Upload multiple gambar project
    - **Tech Stack** - Teknologi yang digunakan
    - **Live URL** - Link live project (jika ada)
    - **GitHub URL** - Link repository GitHub
    - **Is Final Project** - Tandai jika ini final project
    - **Is Published** - Publish project agar terlihat di public
  - Klik "Create" untuk membuat project

- **Edit Project**:
  - Klik pada project yang ingin diedit
  - Ubah informasi yang diperlukan
  - Klik "Update" atau "Simpan"

- **Hapus Project**:
  - Klik pada project
  - Klik tombol delete/trash
  - Konfirmasi penghapusan

#### 4. **View Activity Log**
- Klik menu "Logs" atau "Activity" di sidebar
- Lihat riwayat semua aktivitas yang dilakukan
- Filter berdasarkan tanggal dan tipe aktivitas

#### 5. **Kelola Users (Optional)**
- Klik menu "Users" di sidebar
- Lihat daftar user admin
- Tambah user baru atau edit user yang ada

---

## 📁 Struktur Folder Project

```
uts/
├── src/                          # Source code utama
│   ├── app/
│   │   ├── Console/             # Artisan commands
│   │   ├── Filament/            # Filament resources & components
│   │   ├── Http/                # Controllers, middleware, requests
│   │   ├── Livewire/            # Livewire components
│   │   ├── Models/              # Database models
│   │   └── Providers/           # Service providers
│   ├── bootstrap/               # Bootstrap files
│   ├── config/                  # Konfigurasi aplikasi
│   ├── database/
│   │   ├── factories/           # Model factories
│   │   ├── migrations/          # Database migrations
│   │   └── seeders/             # Database seeders
│   ├── public/
│   │   ├── build/              # Compiled assets
│   │   └── storage/            # Public storage
│   ├── resources/
│   │   ├── css/                # CSS files
│   │   ├── js/                 # JavaScript files
│   │   └── views/              # Blade templates
│   │       └── livewire/       # Livewire views
│   ├── routes/                  # Route definitions
│   ├── storage/                 # Application storage
│   ├── tests/                   # Unit & feature tests
│   ├── .env.example             # Example environment file
│   ├── composer.json            # PHP dependencies
│   ├── package.json             # Node dependencies
│   └── artisan                  # Laravel CLI
├── nginx/                        # Nginx configuration
├── php/                         # PHP configuration
├── db/                          # Database storage & config
├── docker-compose.yml           # Docker Compose configuration
└── README.md                    # File ini

```

---

## 🗄️ Database Schema

### Tabel Utama

#### `users`
Menyimpan data akun admin dan pengguna
- id, name, email, password, created_at, updated_at

#### `profiles`
Menyimpan data profil developer
- id, name, email, tagline, bio, photo, years_experience, total_projects, availability, github, linkedin, skills, created_at, updated_at

#### `projects`
Menyimpan data project
- id, title, slug, description, short_description, status, progress, thumbnail, gallery (JSON), tech_stack (JSON), live_url, github_url, is_final_project, is_published, created_at, updated_at

#### `activity_logs`
Menyimpan log aktivitas admin
- id, user_id, action, description, changes (JSON), created_at

---

## 🚀 Cara Menjalankan Project

### Development Mode
```bash
cd src
npm run dev
```

### Production Build
```bash
cd src
npm run build
php artisan optimize
```

### Menjalankan Custom Commands
```bash
# Clear cache
docker-compose exec php php artisan cache:clear

# Clear config cache
docker-compose exec php php artisan config:clear

# Regenerate autoload
docker-compose exec php composer dump-autoload

# Tinker (interactive shell)
docker-compose exec php php artisan tinker
```

---

## 🔧 Troubleshooting

### "Connection Refused" Error
- Pastikan Docker containers sudah berjalan: `docker-compose ps`
- Mulai ulang containers: `docker-compose restart`

### "Class not found" Error
- Jalankan: `docker-compose exec php composer dump-autoload`

### CSS/JS tidak loaded
- Rebuild assets: `docker-compose exec php npm run build`
- Clear cache: `docker-compose exec php php artisan cache:clear`

### Database Error
- Reset database: `docker-compose exec php php artisan migrate:refresh`
- Seed data: `docker-compose exec php php artisan db:seed`

### Forgot Admin Password
```bash
docker-compose exec php php artisan tinker
>>> \App\Models\User::where('email', 'admin@example.com')->update(['password' => Hash::make('newpassword')])
>>> exit
```

---

## 📝 Catatan Penting untuk Dosen

### Untuk Evaluasi Project

1. **Akses Public Pages**
   - Homepage: https://uts.test
   - Projects: https://uts.test/projects
   - Contact: https://uts.test/contact

2. **Akses Admin Panel**
   - URL: https://uts.test/admin
   - Silakan login dengan kredensial yang diberikan
   - Edit profile untuk melihat sistem working

3. **Fitur yang Dapat Dievaluasi**
   - ✅ Responsive design di semua halaman
   - ✅ Admin panel dengan CRUD functionality
   - ✅ Database integration (MySQL/MariaDB)
   - ✅ File upload system (foto, galeri)
   - ✅ Dynamic content dari database
   - ✅ Modern UI dengan Tailwind CSS
   - ✅ Livewire components untuk interaktifitas
   - ✅ Activity logging system

4. **Tech Stack yang Digunakan**
   - Backend: Laravel 12 + Filament 3 + Livewire
   - Frontend: Tailwind CSS + Alpine.js
   - Database: MySQL/MariaDB
   - Infrastructure: Docker + Nginx

### Data yang Sudah Tersimpan
- **Mahasiswa**: Rizqi Bagas Wicaksono (NIM: 20240801187)
- Profile sudah dapat diedit melalui admin panel
- Project dummy sudah tersedia untuk preview

---

## 📞 Kontak & Support

Untuk pertanyaan atau bantuan:
- **Email**: rizqibagaswicaksonoo@gmail.com
- **GitHub**: https://github.com/GaassXX


---

## 🤝 Cara Berkontribusi

Kontribusi sangat diterima! Berikut adalah langkah-langkah untuk berkontribusi ke project ini:

### 1. **Fork Repository**
- Kunjungi repository di GitHub
- Klik tombol "Fork" di bagian kanan atas
- Ini akan membuat copy dari repository ke akun GitHub Anda

### 2. **Clone Repository Anda**
```bash
git clone https://github.com/GaassXX/uts-2026.git
cd uts
```

### 3. **Buat Branch Feature**
```bash
git checkout -b feature/nama-fitur
# atau untuk bug fixes
git checkout -b bugfix/nama-bug
```

### 4. **Buat Perubahan**
- Edit file yang diperlukan
- Pastikan code mengikuti konvensi project
- Test perubahan Anda secara lokal

### 5. **Commit Perubahan**
```bash
git add .
git commit -m "Add: deskripsi perubahan yang jelas"
# atau untuk bug fixes:
git commit -m "Fix: deskripsi perubahan yang jelas"
```

### 6. **Push ke Repository Anda**
```bash
git push origin feature/nama-fitur
```

### 7. **Buat Pull Request**
- Buka repository asli di GitHub
- Klik "Pull Requests" → "New Pull Request"
- Pilih branch Anda dan deskripsi perubahan
- Submit pull request

### Guideline Kontribusi

#### Coding Style
- Gunakan **Laravel & PHP standards**
- Ikuti **PSR-12** untuk PHP code
- Gunakan **2 spaces** untuk indentation
- Gunakan **meaningful variable names**

#### Commit Messages
```
Add: Menambah fitur baru
Fix: Memperbaiki bug
Refactor: Mengubah struktur code tanpa fitur baru
Docs: Mengubah dokumentasi
Style: Mengubah formatting/style
Test: Menambah atau mengubah tests
```

#### Testing
- Pastikan semua tests berjalan: `docker-compose exec php php artisan test`
- Tambahkan tests untuk fitur baru
- Jangan break existing tests

#### Dokumentasi
- Update README.md jika ada fitur baru
- Tambahkan inline comments untuk code yang kompleks
- Update changelog jika diperlukan

#### Areas untuk Berkontribusi
- 🐛 Bug fixes
- ✨ Fitur baru
- 📝 Dokumentasi improvement
- 🎨 UI/UX improvements
- ⚡ Performance optimization
- 🧪 Test coverage

### Code of Conduct
- Respectful dan inclusive
- Fokus pada issue/feature, bukan pada orang
- Tidak boleh spam atau harassment

---

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik (Tugas UTS) dan dilisensikan di bawah MIT License.

---

**Last Updated**: 18 Mei 2026  
**Status**: ✅ Ready for Evaluation
