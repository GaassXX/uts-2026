# 📡 API Documentation & Feature Reference

## Introduction

This document provides comprehensive technical documentation of all features, endpoints, and usage patterns in the UTS Portfolio application. 

**Current Version**: 1.0.0  
**Base URL**: `https://uts.test` (development) / `https://your-domain.com` (production)

---

## Table of Contents
1. [Public Features](#public-features)
2. [Admin Panel Features](#admin-panel-features)
3. [Authentication](#authentication)
4. [File Uploads](#file-uploads)
5. [Livewire Components](#livewire-components)
6. [Database Queries](#database-queries)

---

## Public Features

### 1. Homepage (`/`)

**Component**: `App\Livewire\HomePage`  
**View**: `resources/views/livewire/home-page.blade.php`

**Features Displayed**:
- **Profile Card**
  - Profile photo
  - Name & tagline
  - Bio/introduction
  - Years of experience & total projects

- **Tech Stack Section**
  - Icons for each technology
  - Animated hover effects
  - Gradient backgrounds

- **Statistics**
  - Total projects completed
  - Years of experience
  - Custom metric

- **Call-to-Action Buttons**
  - "View Portfolio" → Projects page
  - "Contact Me" → Contact form
  - Social media links

**Data Source**:
```php
// Fetches from profiles table
$profile = Profile::first();
$projects = Project::where('status', 'completed')->count();
```

**Styling**:
- Custom Tailwind animations: `fade-in`, `slide-in`, `glow`
- Gradient backgrounds: `bg-gradient-to-r`
- Responsive grid layout: `grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3`

---

### 2. Projects Page (`/projects`)

**Component**: `App\Livewire\ProjectPage`  
**View**: `resources/views/livewire/project-page.blade.php`

**Features**:
- **Project Listing**
  - Grid layout (responsive)
  - Project cards with thumbnail
  - Title, description, tech stack display

- **Filtering** (Livewire reactive)
  - Filter by status: `planning`, `in_progress`, `completed`
  - Filter by final project: yes/no
  - Search by title/description

- **Project Card Information**
  - Thumbnail image
  - Title & description
  - Tech stack badges
  - Status indicator
  - Progress bar (0-100%)
  - Demo & GitHub links

**Query Example**:
```php
public function getProjectsProperty()
{
    $query = Project::query();
    
    // Filter by status
    if ($this->statusFilter) {
        $query->where('status', $this->statusFilter);
    }
    
    // Search
    if ($this->search) {
        $query->where('title', 'like', "%{$this->search}%")
              ->orWhere('description', 'like', "%{$this->search}%");
    }
    
    return $query->orderBy('created_at', 'desc')->get();
}
```

**Animations**:
- Fade-in on load
- Slide-up on scroll
- Hover scale effect on cards
- Progress bar animation

---

### 3. Contact Form

**Component**: Livewire contact component (if exists) or static form  
**Endpoint**: POST `/contact` or Livewire submission

**Fields**:
- `name` (required, string, max 255)
- `email` (required, email, max 255)
- `subject` (required, string, max 255)
- `message` (required, text, max 5000)

**Validation**:
```php
[
    'name' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'subject' => 'required|string|max:255',
    'message' => 'required|string|max:5000',
]
```

**Processing**:
- Store in `contacts` table
- Mark as `is_read = false`
- Optional: Send email notification to admin
- Return success message to user

**Database Insert**:
```sql
INSERT INTO contacts (name, email, subject, message, is_read, created_at, updated_at)
VALUES (?, ?, ?, ?, 0, NOW(), NOW());
```

---

## Admin Panel Features

### 1. Filament Admin Panel

**URL**: `/admin`  
**Authentication**: Required (via `AuthMiddleware`)  
**Authorization**: Role-based access control (Filament Shield)

---

### 2. Profile Management

**Resource**: `App\Filament\Resources\ProfileResource`  
**Table**: `profiles`

**Features**:
- **View All Profiles** - List view with sortable columns
- **Create Profile** - Create new profile record
- **Edit Profile** - Modify existing profile
- **Delete Profile** - Remove profile

**Fields in Form**:
```
- Name (text) - required
- Tagline (text) - optional, e.g., "Full Stack Developer"
- Bio (textarea) - required, detailed introduction
- Photo (file upload) - optional, profile photo
- Email (email) - required
- GitHub URL (url) - optional
- LinkedIn URL (url) - optional
- Skills (tags/array) - required, multiple tech skills
- Years Experience (numeric) - optional
- Total Projects (numeric) - optional
- Availability (select) - e.g., Available, Part-time, Not Available
```

**Validation**:
```php
[
    'name' => 'required|string|max:255',
    'tagline' => 'nullable|string|max:255',
    'bio' => 'required|string',
    'photo' => 'nullable|image|max:2048',
    'email' => 'required|email|max:255',
    'github' => 'nullable|url',
    'linkedin' => 'nullable|url',
    'skills' => 'required|array|min:1',
    'years_experience' => 'nullable|numeric|min:0',
    'total_projects' => 'nullable|numeric|min:0',
    'availability' => 'nullable|string',
]
```

**Events**:
- `ProfileCreated` - Triggered on create
- `ProfileUpdated` - Triggered on update
- `ProfileDeleted` - Triggered on delete
- Logged in `activity_log` table

---

### 3. Project Management

**Resource**: `App\Filament\Resources\ProjectResource`  
**Table**: `projects`

**Features**:
- **CRUD Operations**: Create, Read, Update, Delete projects
- **Bulk Actions**: Edit multiple projects, delete multiple
- **Export**: Export projects to CSV/Excel (optional)
- **Advanced Filtering**: By status, final project flag, date range

**Fields in Form**:
```
BASIC INFO:
- Title (text) - required, max 255
- Slug (text) - auto-generated from title, unique
- Thumbnail (file) - optional, project cover image
- Description (textarea) - required, project overview

DETAILED INFO:
- Problem Analysis (textarea) - optional, problem statement
- Solution (textarea) - optional, solution approach
- Features (textarea/array) - optional, key features list
- Tech Stack (tags/array) - required, technologies used

DOCUMENTATION:
- Flowchart (file) - optional, process flowchart image
- ERD Diagram (file) - optional, database ER diagram
- Use Case (file) - optional, use case diagram
- Diagram (file) - optional, other diagrams
- Document (file) - optional, project documentation PDF

LINKS:
- GitHub URL (url) - optional, repository link
- Demo URL (url) - optional, live demo link

PROJECT INFO:
- Status (select) - enum: planning, in_progress, completed
- Progress (numeric 0-100) - completion percentage
- Is Final Project (checkbox) - boolean flag
```

**Database Fields**:
```php
[
    'title' => 'UTS Portfolio',
    'slug' => 'uts-portfolio',
    'thumbnail' => 'storage/projects/1/thumb.jpg',
    'description' => 'Interactive portfolio...',
    'problem_analysis' => 'Need for portfolio management...',
    'solution' => 'Built with Laravel + Filament...',
    'features' => ['CRUD', 'Real-time', 'Admin Panel'],
    'tech_stack' => ['Laravel 12', 'Filament 3', 'Docker'],
    'flowchart' => 'storage/projects/1/flowchart.jpg',
    'erd_diagram' => 'storage/projects/1/erd.jpg',
    'use_case' => 'storage/projects/1/usecase.jpg',
    'diagram' => 'storage/projects/1/diagram.jpg',
    'github_url' => 'https://github.com/GaassXX/uts-2026',
    'demo_url' => 'https://uts.test',
    'document' => 'storage/projects/1/document.pdf',
    'status' => 'completed',
    'progress' => 100,
    'is_final_project' => true,
    'created_at' => '2026-05-18T10:00:00Z',
    'updated_at' => '2026-05-26T15:30:00Z',
]
```

**Slug Auto-Generation**:
```php
// In Model boot method
static::creating(function ($project) {
    if (empty($project->slug)) {
        $project->slug = Str::slug($project->title);
    }
});
```

**File Upload Handling**:
```php
// Files stored in storage/app/public/projects/{id}/
// Examples:
storage/projects/1/thumbnail.jpg
storage/projects/1/flowchart.jpg
storage/projects/1/erd_diagram.jpg
storage/projects/1/document.pdf

// Accessible via:
// https://uts.test/storage/projects/1/thumbnail.jpg (if symlink exists)
```

**Audit Trail**:
```php
// Activity logged when project is created/updated/deleted
// Query example:
Activity::where('subject_type', 'App\\Models\\Project')
        ->where('subject_id', 1)
        ->latest()
        ->get();

// Output:
[
    {
        'description' => 'created',
        'causer_id' => 1,
        'causer_name' => 'Admin User',
        'properties' => {...},
        'created_at' => '2026-05-26T15:30:00Z'
    }
]
```

---

### 4. Contact Messages Management

**Resource**: `App\Filament\Resources\ContactResource`  
**Table**: `contacts`

**Features**:
- **View Messages**: List all contact form submissions
- **Mark as Read/Unread**: Toggle `is_read` flag
- **Reply**: Send email reply to sender (optional)
- **Export**: Download messages as CSV
- **Delete**: Remove old messages

**Fields Displayed**:
- Name
- Email
- Subject
- Message preview
- Status (Read/Unread)
- Received date/time

**Filtering**:
- By status: `Read`, `Unread`
- By date range
- By sender email

---

### 5. User Management

**Resource**: `App\Filament\Resources\UserResource`  
**Table**: `users`

**Features**:
- **Create User**: Register new admin users
- **Edit User**: Update user information
- **Assign Roles**: Attach roles via Filament Shield
- **Delete User**: Remove users (if not last admin)
- **View Activity**: See user's action history

**User Fields**:
```
- Name (required)
- Email (required, unique)
- Password (required on create, optional on update)
- Avatar URL (optional)
- Email Verified (checkbox)
- Roles (multi-select)
```

**Role Assignment**:
```php
// Attach role to user
$user->assignRole('admin');
$user->assignRole('editor');

// Check permissions
if ($user->hasPermissionTo('view projects')) {
    // allowed
}

// Sync roles
$user->syncRoles(['admin', 'editor']);
```

**Available Roles**:
- `admin` - Full access to all features
- `editor` - Can manage projects & contacts
- `viewer` - Read-only access

---

### 6. Activity Log Viewing

**Resource**: Optional custom resource or built-in logging  
**Table**: `activity_log`

**Features**:
- View all application actions
- Filter by model type
- Filter by action (created, updated, deleted)
- See before/after changes
- User who made the change

**Example Queries**:
```php
// All project changes
Activity::where('subject_type', 'App\\Models\\Project')->get();

// All user actions
Activity::where('causer_id', $userId)->get();

// Changes to specific model instance
Activity::where('subject_type', 'App\\Models\\Project')
        ->where('subject_id', $projectId)
        ->latest()
        ->get();
```

**Activity Properties Example**:
```json
{
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

## Authentication

### Login Flow

**Route**: `GET/POST /login` (Filament managed)  
**Middleware**: `web` (CSRF protection enabled)

**Process**:
1. User enters email & password
2. Filament validates credentials
3. If valid: Create session, set `auth.user`
4. If invalid: Show error, redirect back

**Session Storage**:
- **Driver**: Configured in `config/session.php`
- **Lifetime**: Configurable in `.env` (`SESSION_LIFETIME`)
- **Default**: 120 minutes

**Logout**:
```
GET/POST /logout
→ Destroy session
→ Redirect to login
```

**Authentication Guard**:
```php
// In middleware/routes
auth()->user()           // Current authenticated user
auth()->check()          // Is user authenticated
auth()->id()             // Current user ID

// Usage
if (Auth::check()) {
    echo "Logged in as: " . Auth::user()->name;
}
```

---

## File Uploads

### Upload Destinations

```
storage/app/
├── public/
│   ├── projects/          # Project images/documents
│   │   └── {project_id}/
│   │       ├── thumbnail.jpg
│   │       ├── flowchart.jpg
│   │       ├── erd_diagram.jpg
│   │       └── document.pdf
│   ├── profiles/          # Profile photos
│   │   └── {user_id}/
│   │       └── avatar.jpg
│   └── contacts/          # Optional contact attachments
└── private/               # Non-public files
```

### File Upload Configuration

**Filesystem Config** (`config/filesystems.php`):
```php
'disks' => [
    'public' => [
        'driver' => 'local',
        'path' => 'storage/app/public',
        'url' => '/storage',
        'visibility' => 'public',
    ],
    
    'private' => [
        'driver' => 'local',
        'path' => 'storage/app/private',
        'visibility' => 'private',
    ],
],
```

### Upload Validation

**Allowed File Types**:
```php
// Images
'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

// Documents
'document' => 'mimes:pdf,doc,docx|max:10240',

// Multiple files
'diagrams' => 'file|mimes:jpg,png,pdf|max:5120',
```

### Storage Access

**Public Files**:
```
// Accessible directly via URL
https://uts.test/storage/projects/1/thumbnail.jpg

// In templates
<img src="{{ Storage::url('projects/1/thumbnail.jpg') }}" />
```

**Private Files**:
```php
// Access via route (with auth check)
Route::get('/download/{file}', function ($file) {
    return Storage::disk('private')->download($file);
})->middleware('auth');
```

---

## Livewire Components

### HomePage Component

**File**: `app/Livewire/HomePage.php`  
**View**: `resources/views/livewire/home-page.blade.php`

**Properties**:
```php
public ?Profile $profile = null;
public int $totalProjects = 0;
public int $yearsExperience = 0;
```

**Methods**:
```php
#[On('profile-updated')]
public function refreshProfile()
{
    $this->profile = Profile::first();
}
```

**Rendered Data**:
```php
public function render()
{
    return view('livewire.home-page', [
        'profile' => Profile::first(),
        'projects' => Project::where('status', 'completed')
                            ->count(),
    ]);
}
```

---

### ProjectPage Component

**File**: `app/Livewire/ProjectPage.php`  
**View**: `resources/views/livewire/project-page.blade.php`

**Public Properties** (reactive):
```php
#[Url]
public string $search = '';

#[Url]
public string $status = '';

#[Url]
public bool $finalOnly = false;
```

**Methods**:
```php
// Computed property
#[Computed]
public function projects()
{
    $query = Project::query();
    
    if ($this->search) {
        $query->where('title', 'like', "%{$this->search}%");
    }
    
    if ($this->status) {
        $query->where('status', $this->status);
    }
    
    if ($this->finalOnly) {
        $query->where('is_final_project', true);
    }
    
    return $query->orderBy('created_at', 'desc')
                 ->get();
}
```

---

## Database Queries

### Common Queries

**Get All Completed Projects**:
```php
$projects = Project::where('status', 'completed')
                    ->orderBy('created_at', 'desc')
                    ->get();
```

**Get Projects with Specific Tech**:
```php
$laravelProjects = Project::whereJsonContains('tech_stack', 'Laravel')
                           ->get();
```

**Get Unread Contacts**:
```php
$unread = Contact::where('is_read', false)
                  ->orderBy('created_at', 'desc')
                  ->get();
```

**Mark Contact as Read**:
```php
$contact = Contact::find($id);
$contact->update(['is_read' => true]);
```

**User with All Roles**:
```php
$user = User::find($id);
$roles = $user->roles;
$permissions = $user->permissions;
```

**Activity Log for Project**:
```php
$history = Activity::where('subject_type', 'App\\Models\\Project')
                    ->where('subject_id', $projectId)
                    ->latest()
                    ->paginate(15);
```

---

## Response Format

### Success Response
```json
{
  "success": true,
  "message": "Operation completed successfully",
  "data": {
    "id": 1,
    "name": "Project Name",
    ...
  }
}
```

### Error Response
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "title": ["Title is required"],
    "email": ["Email must be valid"]
  }
}
```

---

## Rate Limiting

**Current Implementation**: None (development)

**For Production**, add:
```php
// In routes
Route::middleware(['throttle:60,1'])->group(function () {
    // API routes
});
```

---

## CORS Configuration

**Current Setup**: No CORS restrictions (localhost)

**For Production**, add to `config/cors.php`:
```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_methods' => ['*'],
'allowed_origins' => ['https://your-domain.com'],
'allowed_origins_patterns' => ['https://*.your-domain.com'],
```

---

**Last Updated**: May 26, 2026  
**API Version**: 1.0.0  
**Status**: Active Development
