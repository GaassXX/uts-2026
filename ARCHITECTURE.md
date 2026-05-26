# 🏗️ Arsitektur Project UTS Portfolio

## Pendahuluan

Project ini adalah aplikasi portfolio interaktif berbasis **Laravel 12** dengan admin panel **Filament 3**. Dibangun menggunakan arsitektur MVC (Model-View-Controller) yang terstruktur dengan baik untuk mendukung skala aplikasi yang dapat berkembang.

## Diagram Arsitektur Keseluruhan

```
┌─────────────────────────────────────────────────────────────────────┐
│                         Client (Browser)                            │
├─────────────────────────────────────────────────────────────────────┤
│  ┌──────────────────────────────────────────────────────────────┐   │
│  │  Frontend Layer (Livewire + Alpine.js + Tailwind)           │   │
│  │  ├─ Homepage (home-page.blade.php)                          │   │
│  │  ├─ Projects Page (project-page.blade.php)                  │   │
│  │  ├─ Contact Form                                            │   │
│  │  └─ Interactive Components (Alpine.js)                      │   │
│  └──────────────────────────────────────────────────────────────┘   │
└──────────────────────────────────┬──────────────────────────────────┘
                                   │ HTTP/HTTPS
┌──────────────────────────────────▼──────────────────────────────────┐
│              Application Layer (Laravel 12 + Filament 3)            │
├──────────────────────────────────────────────────────────────────────┤
│  ┌─────────────────┐  ┌──────────────────┐  ┌─────────────────┐    │
│  │ Route Layer     │  │ Middleware       │  │ Action Classes  │    │
│  │ (web.php)       │  │ (Auth, CORS)     │  │ (Filament)      │    │
│  └────────┬────────┘  └──────────────────┘  └─────────────────┘    │
│           │                                                          │
│  ┌────────▼─────────────────────────────────────────────────────┐  │
│  │ Controllers (if any API endpoints)                          │  │
│  │ - Livewire Components                                       │  │
│  │ - Filament Resources (Projects, Profiles, Users)           │  │
│  └────────┬─────────────────────────────────────────────────────┘  │
│           │                                                          │
│  ┌────────▼─────────────────────────────────────────────────────┐  │
│  │ Models & Business Logic                                     │  │
│  │ - User (with roles/permissions)                             │  │
│  │ - Profile (portfolio owner info)                            │  │
│  │ - Project (portfolio projects)                              │  │
│  │ - Contact (contact messages)                                │  │
│  └────────┬─────────────────────────────────────────────────────┘  │
│           │                                                          │
│  ┌────────▼─────────────────────────────────────────────────────┐  │
│  │ Service Layer (Optional - Business Logic)                   │  │
│  │ - Mail Service                                              │  │
│  │ - File Storage Service                                      │  │
│  └────────┬─────────────────────────────────────────────────────┘  │
└──────────────────────────────────┬──────────────────────────────────┘
                                   │
┌──────────────────────────────────▼──────────────────────────────────┐
│                    Data Layer (Eloquent ORM)                        │
├──────────────────────────────────────────────────────────────────────┤
│  ┌──────────────────────────────────────────────────────────────┐   │
│  │ Database (MySQL/MariaDB in Docker)                          │   │
│  │ ├─ users (sistem autentikasi)                               │   │
│  │ ├─ profiles (info portfolio owner)                          │   │
│  │ ├─ projects (project portfolios)                            │   │
│  │ ├─ contacts (pesan dari contact form)                       │   │
│  │ ├─ activity_log (audit trails)                              │   │
│  │ └─ permission_tables (role-based access)                    │   │
│  └──────────────────────────────────────────────────────────────┘   │
└──────────────────────────────────────────────────────────────────────┘
```

## Struktur Folder & Alur Data

### 📁 `/src` - Root Aplikasi Laravel

```
src/
├── app/                          # Logika aplikasi
│   ├── Console/                  # Artisan commands
│   ├── Filament/                 # Admin panel resources
│   │   ├── Resources/
│   │   │   ├── ProfileResource.php    (CRUD Profile)
│   │   │   ├── ProjectResource.php    (CRUD Project)
│   │   │   ├── UserResource.php       (User management)
│   │   │   └── ContactResource.php    (Contact messages)
│   │   └── Pages/                (Custom admin pages)
│   ├── Http/
│   │   └── Controllers/          (API/Web controllers - jika ada)
│   ├── Livewire/                 # Livewire components (reactive)
│   │   ├── HomePage.php          (Homepage logic)
│   │   ├── ProjectPage.php       (Projects listing logic)
│   │   └── ContactForm.php       (Contact form logic)
│   ├── Models/                   # Database models
│   │   ├── User.php              (User dengan roles/permissions)
│   │   ├── Profile.php           (Profile portfolio owner)
│   │   ├── Project.php           (Project entries)
│   │   └── Contact.php           (Contact messages)
│   ├── Policies/                 # Authorization policies
│   │   └── (Role-based access via Filament Shield)
│   ├── Providers/                # Service providers
│   │   ├── AppServiceProvider    (Global configs)
│   │   ├── AuthServiceProvider   (Auth policies)
│   │   └── RouteServiceProvider  (Route bindings)
│   └── ...
│
├── bootstrap/                    # Bootstrap aplikasi
│   ├── app.php                   (App instance setup)
│   ├── providers.php             (Service provider registration)
│   └── cache/                    (Cache files)
│
├── config/                       # Konfigurasi aplikasi
│   ├── app.php                   (App settings)
│   ├── auth.php                  (Auth config)
│   ├── database.php              (Database config)
│   ├── filament.php              (Filament config)
│   ├── filesystems.php           (Storage config)
│   ├── mail.php                  (Email config)
│   ├── permission.php            (Role/permission config)
│   └── ...
│
├── database/
│   ├── migrations/               # Database migrations
│   │   ├── create_users_table.php
│   │   ├── create_profiles_table.php
│   │   ├── create_projects_table.php
│   │   ├── create_contacts_table.php
│   │   └── ...
│   ├── factories/                # Model factories untuk testing
│   └── seeders/                  # Database seeders
│
├── public/                       # Public-facing files
│   ├── index.php                 (Entry point)
│   ├── storage/                  (Symlink ke storage/app/public)
│   ├── build/                    (Vite build output)
│   ├── css/, js/                 (Compiled assets)
│   └── ...
│
├── resources/
│   ├── css/
│   │   └── app.css               (Tailwind CSS imports)
│   ├── js/
│   │   └── app.js                (Alpine.js, etc)
│   └── views/                    # Blade templates
│       ├── layouts/
│       │   ├── app.blade.php     (Main layout)
│       │   └── guest.blade.php   (Login layout)
│       ├── livewire/
│       │   ├── home-page.blade.php       (Homepage view)
│       │   ├── project-page.blade.php    (Projects view)
│       │   └── contact-form.blade.php    (Contact view)
│       ├── components/           (Reusable view components)
│       └── ...
│
├── routes/
│   ├── web.php                   (Web routes)
│   ├── api.php                   (API routes - optional)
│   └── console.php               (Console routes/commands)
│
├── storage/
│   ├── app/                      (File storage)
│   │   ├── public/               (Publicly accessible files)
│   │   │   ├── projects/         (Project thumbnails, images)
│   │   │   ├── profiles/         (Profile photos)
│   │   │   └── documents/        (Project documents)
│   │   └── private/              (Private files)
│   ├── framework/                (Laravel framework storage)
│   ├── logs/                     (Application logs)
│   └── ...
│
├── tests/                        # Tests
│   ├── Unit/                     (Unit tests)
│   ├── Feature/                  (Feature tests)
│   └── Pest.php                  (Pest config)
│
├── vendor/                       # Composer dependencies
│
├── .env.example                  # Environment variables template
├── artisan                       # Artisan CLI
├── composer.json                 # PHP dependencies
├── package.json                  # Node dependencies
├── vite.config.js                # Vite config
└── tailwind.config.js            # Tailwind config
```

## Data Flow - Contoh: Menampilkan Project di Homepage

```
┌─ User Akses Homepage (https://uts.test)
│
├─ Route: routes/web.php → Livewire::route('/') → HomePage component
│
├─ Livewire Component: app/Livewire/HomePage.php
│   └─ mount()
│       └─ Query: $this->projects = Project::all();
│           └─ Model: app/Models/Project.php (Eloquent)
│
├─ Blade Template: resources/views/livewire/home-page.blade.php
│   └─ Loop: @foreach($projects as $project)
│       └─ Display: Gradient cards dengan project info
│           └─ Styling: Tailwind CSS + custom animations
│
└─ Browser Render → User melihat projects di homepage
```

## Data Flow - Contoh: Create Project di Admin Panel

```
┌─ Admin login ke https://uts.test/admin
│
├─ Filament Resource: app/Filament/Resources/ProjectResource.php
│   └─ CreateProjectAction triggered
│
├─ Form filled with:
│   ├─ Title
│   ├─ Description
│   ├─ Tech Stack (array)
│   ├─ GitHub URL
│   ├─ Thumbnail (uploaded)
│   └─ ... other fields
│
├─ Model Create: app/Models/Project.php
│   └─ Slug auto-generated dari title
│   └─ Insert ke database: INSERT INTO projects (...)
│
├─ Event: ProjectCreated (optional)
│
├─ File Storage (jika ada upload)
│   └─ Thumbnail disimpan ke storage/app/public/projects/
│
└─ Success message → Project visible di homepage & project list
```

## Arsitektur Database - Entity Relationship Diagram

```
┌─────────────────────┐
│ users               │
├─────────────────────┤
│ id (PK)            │
│ name               │
│ email (UNIQUE)     │
│ password (hashed)  │
│ avatar_url         │
│ email_verified_at  │
│ remember_token     │
│ created_at         │
│ updated_at         │
└────────┬────────────┘
         │
         │ 1:1 (optional)
         │
         ▼
┌─────────────────────┐
│ profiles            │
├─────────────────────┤
│ id (PK)            │
│ user_id (FK)       │──┐
│ name               │  │
│ tagline            │  │
│ bio                │  │
│ photo              │  │
│ email              │  │
│ github             │  │
│ linkedin           │  │
│ skills (JSON)      │  │
│ years_experience   │  │
│ total_projects     │  │
│ availability       │  │
│ created_at         │  │
│ updated_at         │  │
└─────────────────────┘  │
                         │
┌────────────────────────┴─────────┐
│ projects                         │
├──────────────────────────────────┤
│ id (PK)                         │
│ title                           │
│ slug (UNIQUE)                   │
│ thumbnail                       │
│ description                     │
│ problem_analysis                │
│ solution                        │
│ features (JSON array)           │
│ tech_stack (JSON array)         │
│ flowchart                       │
│ erd_diagram                     │
│ use_case                        │
│ diagram                         │
│ github_url                      │
│ demo_url                        │
│ document                        │
│ status (enum)                   │
│ progress (0-100)                │
│ is_final_project (boolean)      │
│ created_at                      │
│ updated_at                      │
└──────────────────────────────────┘

┌─────────────────────┐
│ contacts            │
├─────────────────────┤
│ id (PK)            │
│ name               │
│ email              │
│ subject            │
│ message            │
│ is_read (boolean)  │
│ created_at         │
│ updated_at         │
└─────────────────────┘

┌────────────────────────────┐
│ activity_log               │
├────────────────────────────┤
│ id (PK)                   │
│ log_name (string)         │
│ description (string)      │
│ subject_type (string)     │
│ subject_id (integer)      │
│ causer_type (string)      │
│ causer_id (integer)       │
│ properties (JSON)         │
│ created_at                │
│ updated_at                │
└────────────────────────────┘

┌─────────────────────────────┐
│ model_has_roles             │
├─────────────────────────────┤
│ role_id (FK)              │
│ model_id (FK)             │
│ model_type (string)       │
└─────────────────────────────┘
  ▲                    ▲
  │                    │
  └────────┬───────────┘
           │
    ┌──────┴────────┐
    │               │
┌───▼────────┐ ┌──▼───────────┐
│ roles      │ │ permissions  │
└────────────┘ └──────────────┘
```

## Technology Stack Breakdown

### Backend
- **Laravel 12**: Full-stack PHP framework
- **Filament 3**: Modern admin panel builder
- **Livewire**: Real-time component framework
- **Eloquent ORM**: Database abstraction layer
- **Spatie Permission**: Role & permission management
- **Spatie Activity Log**: Audit logging

### Frontend
- **Blade**: PHP templating engine (from Laravel)
- **Livewire Components**: Server-driven UI updates
- **Alpine.js**: Lightweight JavaScript framework
- **Tailwind CSS**: Utility-first CSS framework
- **Vite**: Modern frontend bundler

### Infrastructure
- **Docker**: Containerization
- **Nginx**: Web server
- **MySQL/MariaDB**: Database
- **PHP 8.2+**: Server-side language

## Request Lifecycle

```
1. Browser Request
   ↓
2. Nginx routes ke PHP-FPM
   ↓
3. Laravel Bootstrap (bootstrap/app.php)
   ↓
4. Service Provider Registration
   ↓
5. Route Matching (routes/web.php)
   ↓
6. Middleware execution
   ├─ AuthMiddleware
   ├─ VerifyCsrfToken
   └─ etc.
   ↓
7. Controller/Livewire Component execution
   ├─ Business logic
   ├─ Database queries
   └─ etc.
   ↓
8. Response prepared
   ├─ Blade template rendering
   ├─ JSON response (if API)
   └─ etc.
   ↓
9. Response sent to client
   ↓
10. Browser renders HTML/Livewire updates DOM
```

## Key Architectural Decisions

### 1. **Livewire untuk Interactivity**
   - **Alasan**: Full-stack reaktivitas tanpa SPA complexity
   - **Benefit**: Server-side logic tetap aman, real-time updates
   - **Trade-off**: Sedikit latency untuk real-time updates

### 2. **Filament untuk Admin Panel**
   - **Alasan**: Rapid development dengan built-in CRUD
   - **Benefit**: Minimal code, maximum functionality
   - **Trade-off**: Kurang fleksibel untuk custom workflows (tapi bisa override)

### 3. **JSON fields untuk dynamic data**
   - **Alasan**: Fleksibilitas untuk array data (tech_stack, features, skills)
   - **Benefit**: Tidak perlu pivot tables untuk list-like data
   - **Trade-off**: Kurang optimal untuk complex queries

### 4. **Docker Containerization**
   - **Alasan**: Consistency across environments
   - **Benefit**: Development = production environment
   - **Trade-off**: Overhead resource consumption

## Performance Considerations

### Optimizations Implemented
- **Query Optimization**: Eager loading dengan `with()`
- **Caching**: Laravel query caching
- **Asset Pipeline**: Vite untuk optimized CSS/JS
- **Database Indexing**: Indexes pada frequently queried columns

### Monitoring
- Activity logging via `spatie/laravel-activity`
- Application logs di `storage/logs/`

## Security Architecture

- **Authentication**: Laravel built-in auth + Filament integration
- **Authorization**: Spatie permission-based role system
- **CSRF Protection**: Laravel middleware
- **SQL Injection Prevention**: Eloquent parameterized queries
- **File Upload Security**: Validation + storage outside public (untuk private files)
- **Environment Secrets**: Sensitive data di `.env` file

## Future Scalability

Jika perlu scale project ke depannya:

1. **Caching Layer**: Redis untuk session/query caching
2. **Queue Jobs**: Laravel queue untuk async processing
3. **API Gateway**: Separate REST API dengan Laravel
4. **Microservices**: Split functionality ke separate services
5. **Database Replication**: Master-slave setup untuk read scaling
6. **CDN**: Distribute assets globally

---

**Last Updated**: May 26, 2026  
**Architecture Version**: 1.0  
**Framework Version**: Laravel 12 + Filament 3
