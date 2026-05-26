# 📊 Database Schema & Documentation

## Overview

Database aplikasi UTS Portfolio menggunakan **MySQL/MariaDB** dalam Docker container. Terdiri dari 7 tabel utama dengan relasi-relasi yang well-defined untuk mendukung sistem portfolio, user management, dan audit logging.

## Tabel-Tabel Utama

### 1. `users` - User Authentication & Management

**Purpose**: Menyimpan data user yang dapat login ke aplikasi & admin panel

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    avatar_url VARCHAR(255) NULLABLE,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULLABLE,
    password VARCHAR(255) NOT NULL (hashed with bcrypt),
    remember_token VARCHAR(100) NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    dark_mode_enabled BOOLEAN DEFAULT false,
    theme_color VARCHAR(50) DEFAULT 'brand'
);
```

**Fields Details**:
- `id`: Unique identifier
- `avatar_url`: Path ke user avatar (optional)
- `name`: Display name
- `email`: Email unik (login identifier)
- `password`: Hashed dengan bcrypt (never stored plaintext)
- `email_verified_at`: Timestamp jika email sudah verified
- `remember_token`: Token untuk "remember me" functionality
- `dark_mode_enabled`: User preference untuk dark mode
- `theme_color`: Selected theme color

**Indexes**:
```sql
CREATE UNIQUE INDEX users_email_unique ON users(email);
CREATE INDEX users_created_at ON users(created_at);
```

**Relationships**:
- `1:1` dengan `profiles` (optional)
- `1:Many` dengan `model_has_roles` (user roles)
- `1:Many` dengan `activity_log` (audit trail)

**Example Data**:
```json
{
  "id": 1,
  "name": "Rizqi Bagas Wicaksono",
  "email": "admin@uts.test",
  "avatar_url": "https://avatars.githubusercontent.com/u/...",
  "password": "$2y$12$...", // bcrypt hash
  "created_at": "2026-05-18T10:00:00Z",
  "updated_at": "2026-05-26T15:30:00Z"
}
```

---

### 2. `profiles` - Portfolio Owner Information

**Purpose**: Menyimpan informasi personal portfolio owner yang ditampilkan di homepage

```sql
CREATE TABLE profiles (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NULLABLE UNIQUE,
    name VARCHAR(255) NOT NULL,
    tagline VARCHAR(255) NULLABLE,    -- e.g., "Full Stack Developer"
    bio TEXT NOT NULL,
    photo VARCHAR(255) NULLABLE,       -- path ke profile photo
    email VARCHAR(255) NOT NULL,
    github VARCHAR(255) NULLABLE,      -- GitHub URL
    linkedin VARCHAR(255) NULLABLE,    -- LinkedIn URL
    skills JSON NOT NULL,              -- ["Laravel", "Vue", "Docker", ...]
    years_experience INT NULLABLE,     -- e.g., 3
    total_projects INT NULLABLE,       -- Total projects completed
    availability VARCHAR(50) NULLABLE, -- "Available", "Part-time", etc
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);
```

**Fields Details**:
- `user_id`: Foreign key ke users (optional - bisa ada tanpa user)
- `tagline`: One-liner professional tagline
- `bio`: Detailed biography/introduction
- `skills`: JSON array of skills
  ```json
  ["Laravel", "Vue.js", "Docker", "MySQL", "Git", "REST API", "JavaScript"]
  ```
- `years_experience`: Total pengalaman dalam tahun
- `total_projects`: Jumlah project yang sudah dikerjakan
- `availability`: Status ketersediaan profesional

**Indexes**:
```sql
CREATE UNIQUE INDEX profiles_user_id_unique ON profiles(user_id);
CREATE INDEX profiles_email ON profiles(email);
CREATE INDEX profiles_created_at ON profiles(created_at);
```

**Example Data**:
```json
{
  "id": 1,
  "user_id": 1,
  "name": "Rizqi Bagas Wicaksono",
  "tagline": "Full Stack Developer | Laravel Enthusiast",
  "bio": "Passionate software developer with expertise in building scalable web applications...",
  "email": "rizqibagas@example.com",
  "github": "https://github.com/GaassXX",
  "linkedin": "https://linkedin.com/in/...",
  "skills": ["Laravel", "Vue.js", "Docker", "MySQL", "Filament"],
  "years_experience": 3,
  "total_projects": 15,
  "availability": "Available"
}
```

---

### 3. `projects` - Portfolio Projects

**Purpose**: Menyimpan data project-project portfolio yang ditampilkan di halaman projects

```sql
CREATE TABLE projects (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,     -- URL-friendly identifier
    thumbnail VARCHAR(255) NULLABLE,       -- Path ke thumbnail image
    description TEXT NOT NULL,
    problem_analysis TEXT NULLABLE,        -- Problem statement
    solution TEXT NULLABLE,                -- Solusi yang dikerjakan
    features JSON NULLABLE,                -- Array of features
    tech_stack JSON NOT NULL,              -- ["Laravel", "Vue", ...]
    flowchart VARCHAR(255) NULLABLE,       -- Path ke flowchart image
    erd_diagram VARCHAR(255) NULLABLE,     -- Path ke ERD diagram
    use_case VARCHAR(255) NULLABLE,        -- Path ke use case diagram
    diagram VARCHAR(255) NULLABLE,         -- Path ke additional diagrams
    github_url VARCHAR(255) NULLABLE,      -- GitHub repository URL
    demo_url VARCHAR(255) NULLABLE,        -- Live demo URL
    document VARCHAR(255) NULLABLE,        -- Path ke project document (PDF)
    status ENUM('planning', 'in_progress', 'completed') DEFAULT 'planning',
    progress INT DEFAULT 0,                -- Completion percentage (0-100)
    is_final_project BOOLEAN DEFAULT false,-- Apakah project final (tugas akhir)
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Fields Details**:
- `slug`: Auto-generated dari title, untuk URL-friendly access
  - Generated: `Str::slug($title)` → "laravel-blog-platform"
  - Used di URL: `/projects/laravel-blog-platform`
  
- `features`: JSON array of project features
  ```json
  [
    "User authentication with roles",
    "CRUD operations for blog posts",
    "Real-time notifications",
    "Advanced search functionality"
  ]
  ```

- `tech_stack`: JSON array of technologies used
  ```json
  ["Laravel 12", "Vue.js", "Tailwind CSS", "MySQL", "Docker", "Filament"]
  ```

- `status`: Project development status
  - `planning`: Belum dimulai
  - `in_progress`: Sedang dikerjakan
  - `completed`: Sudah selesai

- `progress`: Completion percentage (0-100)

- `is_final_project`: Boolean untuk menandai project sebagai final/capstone project

**Indexes**:
```sql
CREATE UNIQUE INDEX projects_slug_unique ON projects(slug);
CREATE INDEX projects_status ON projects(status);
CREATE INDEX projects_is_final_project ON projects(is_final_project);
CREATE INDEX projects_created_at ON projects(created_at);
```

**Example Data**:
```json
{
  "id": 1,
  "title": "UTS Portfolio Application",
  "slug": "uts-portfolio-application",
  "thumbnail": "storage/projects/1/thumbnail.jpg",
  "description": "Interactive portfolio website with admin panel...",
  "problem_analysis": "Need for comprehensive portfolio management system...",
  "solution": "Built using Laravel + Filament with Docker containerization",
  "features": [
    "Dynamic project showcase",
    "Admin panel with CRUD operations",
    "Contact form with notifications",
    "Real-time project updates"
  ],
  "tech_stack": ["Laravel 12", "Filament 3", "Docker", "MySQL"],
  "github_url": "https://github.com/GaassXX/uts-2026",
  "demo_url": "https://uts.test",
  "status": "completed",
  "progress": 100,
  "is_final_project": true,
  "created_at": "2026-05-18T10:00:00Z",
  "updated_at": "2026-05-26T15:30:00Z"
}
```

---

### 4. `contacts` - Contact Form Messages

**Purpose**: Menyimpan pesan yang dikirim melalui contact form di website

```sql
CREATE TABLE contacts (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT false,     -- Status apakah sudah dibaca
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Fields Details**:
- `is_read`: Boolean untuk tracking pesan yang sudah dibaca di admin panel
- `created_at`: Kapan pesan dikirim

**Indexes**:
```sql
CREATE INDEX contacts_email ON contacts(email);
CREATE INDEX contacts_is_read ON contacts(is_read);
CREATE INDEX contacts_created_at ON contacts(created_at);
```

**Example Data**:
```json
{
  "id": 1,
  "name": "Prospective Client",
  "email": "client@example.com",
  "subject": "Web Development Inquiry",
  "message": "Interested in your Laravel expertise for our project...",
  "is_read": false,
  "created_at": "2026-05-26T14:20:00Z",
  "updated_at": "2026-05-26T14:20:00Z"
}
```

---

### 5. `activity_log` - Audit Trail

**Purpose**: Menyimpan semua aksi/perubahan di aplikasi untuk audit & debugging

**Provided by**: `spatie/laravel-activity` package

```sql
CREATE TABLE activity_log (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    log_name VARCHAR(255) DEFAULT 'default',
    description VARCHAR(255),          -- e.g., "created", "updated", "deleted"
    subject_type VARCHAR(255),         -- Model class name (e.g., "App\Models\Project")
    subject_id BIGINT UNSIGNED,        -- Model instance ID
    causer_type VARCHAR(255),          -- User class name
    causer_id BIGINT UNSIGNED,         -- User ID yang melakukan aksi
    properties JSON NULLABLE,          -- Additional data (old/new values)
    batch_uuid VARCHAR(36) NULLABLE,
    event VARCHAR(255) NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Purpose**:
- Track siapa yang mengubah apa, kapan
- Untuk security & debugging
- Compliance & audit requirements

**Example Data**:
```json
{
  "id": 1,
  "log_name": "default",
  "description": "updated",
  "subject_type": "App\\Models\\Project",
  "subject_id": 1,
  "causer_type": "App\\Models\\User",
  "causer_id": 1,
  "properties": {
    "old": {
      "status": "in_progress"
    },
    "new": {
      "status": "completed"
    }
  },
  "created_at": "2026-05-26T15:30:00Z"
}
```

---

### 6. `model_has_roles` - User Roles Assignment

**Purpose**: Relasi M:N antara users dan roles (untuk role-based access control)

**Provided by**: `spatie/laravel-permission` package

```sql
CREATE TABLE model_has_roles (
    role_id BIGINT UNSIGNED NOT NULL,
    model_id BIGINT UNSIGNED NOT NULL,
    model_type VARCHAR(255) NOT NULL,
    PRIMARY KEY (role_id, model_id, model_type),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    INDEX (model_id, model_type)
);
```

**Example Data**:
```
role_id: 1 (Admin)
model_id: 1 (User ID)
model_type: "App\Models\User"
```

---

### 7. `permissions`, `roles`, `model_has_permissions` - Permission System

**Purpose**: Role-based access control untuk Filament Admin Panel

**Provided by**: `spatie/laravel-permission` package

```sql
CREATE TABLE roles (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    guard_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE TABLE permissions (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    guard_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

CREATE TABLE model_has_permissions (
    permission_id BIGINT UNSIGNED NOT NULL,
    model_id BIGINT UNSIGNED NOT NULL,
    model_type VARCHAR(255) NOT NULL,
    PRIMARY KEY (permission_id, model_id, model_type)
);
```

**Example Roles**:
- `admin` - Full access to all features
- `editor` - Can manage projects & contacts
- `viewer` - Read-only access

---

## Database Relationships Diagram

```
┌──────────────────┐
│ users            │
│ (authentication) │
└────────┬─────────┘
         │
    ┌────┴─────┬────────────────┬─────────────────┐
    │           │                │                 │
    │ 1:1       │ 1:Many         │ 1:Many          │ 1:Many
    ▼ (opt)     ▼                ▼                 ▼
┌────────────┐ ┌──────────────┐ ┌────────────────┐ ┌────────────────┐
│ profiles   │ │ activity_log │ │ model_has_roles│ │ model_has_perms│
│ (personal) │ │ (audit)      │ │ (roles)        │ │ (permissions)  │
└────────────┘ └──────────────┘ └────────────────┘ └────────────────┘
                                      │                    │
                                      ▼                    ▼
                                ┌──────────┐         ┌─────────────┐
                                │ roles    │         │ permissions │
                                └──────────┘         └─────────────┘

┌──────────────┐
│ projects     │
│ (portfolio)  │
└──────────────┘

┌──────────────┐
│ contacts     │
│ (messages)   │
└──────────────┘

┌──────────────┐
│ activity_log │ ──► tracks changes on any model
└──────────────┘
```

---

## Key Database Patterns Used

### 1. Soft Deletes (Tidak digunakan, tapi bisa ditambah)
Jika perlu preserve deleted data:
```sql
ALTER TABLE projects ADD COLUMN deleted_at TIMESTAMP NULL;
```

### 2. JSON Columns untuk Array Data
```sql
-- tech_stack is stored as JSON
SELECT * FROM projects WHERE JSON_CONTAINS(tech_stack, '"Laravel"');
```

### 3. Slug Pattern untuk URL-friendly Access
```php
// In Migration
$table->string('slug')->unique();

// In Model
protected static function boot() {
    parent::boot();
    static::creating(function ($model) {
        if (empty($model->slug)) {
            $model->slug = Str::slug($model->title);
        }
    });
}
```

### 4. Timestamps untuk Audit Trail
```php
// Automatically created_at & updated_at
$table->timestamps();
```

### 5. Enums untuk Status Tracking
```sql
-- Project status is limited to specific values
status ENUM('planning', 'in_progress', 'completed')
```

---

## Query Examples

### Get Portfolio Owner Info
```sql
SELECT p.* FROM profiles p
WHERE p.email = 'rizqibagas@example.com'
LIMIT 1;
```

### Get All Completed Projects
```sql
SELECT * FROM projects
WHERE status = 'completed'
ORDER BY created_at DESC;
```

### Get Projects with Specific Tech Stack
```sql
SELECT * FROM projects
WHERE JSON_CONTAINS(tech_stack, '"Laravel"')
AND JSON_CONTAINS(tech_stack, '"Docker"');
```

### Get Unread Contact Messages
```sql
SELECT * FROM contacts
WHERE is_read = false
ORDER BY created_at DESC;
```

### Get Recent Activity Log
```sql
SELECT * FROM activity_log
WHERE subject_type = 'App\\Models\\Project'
ORDER BY created_at DESC
LIMIT 10;
```

### Get User with All Roles & Permissions
```sql
SELECT 
    u.*,
    GROUP_CONCAT(r.name) as roles,
    GROUP_CONCAT(p.name) as permissions
FROM users u
LEFT JOIN model_has_roles mhr ON u.id = mhr.model_id
LEFT JOIN roles r ON mhr.role_id = r.id
LEFT JOIN model_has_permissions mhp ON u.id = mhp.model_id
LEFT JOIN permissions p ON mhp.permission_id = p.id
WHERE u.id = 1
GROUP BY u.id;
```

---

## Performance Optimization Tips

### Indexes Strategy
- ✅ Index frequently queried columns: `email`, `slug`, `status`
- ✅ Index foreign keys: `user_id`, `causer_id`
- ✅ Index timestamp columns: `created_at` for sorting
- ❌ Don't over-index: increases write performance cost

### Query Optimization
```php
// Bad - N+1 query problem
$projects = Project::all();
foreach ($projects as $project) {
    echo $project->skills;
}

// Good - Eager loading
$projects = Project::with('relations')->get();
```

### Pagination for Large Datasets
```php
// Instead of getting all
$projects = Project::paginate(15);
```

---

## Migration & Seeding

### Run Migrations
```bash
php artisan migrate
```

### Create Seeder for Testing
```bash
php artisan make:seeder ProjectSeeder
```

### Reset Database (Development Only!)
```bash
php artisan migrate:refresh --seed
```

---

**Last Updated**: May 26, 2026  
**Schema Version**: 1.0  
**Database**: MySQL 8.0+ / MariaDB 10.4+
