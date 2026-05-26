# Contributing to Portfolio UTS

Thank you for your interest in contributing! This document provides guidelines and instructions for contributing to the project.

## Code of Conduct

- Be respectful and inclusive
- Focus on the idea, not the person
- No harassment, discrimination, or offensive language
- Welcome diversity of thought and experience

## Getting Started

### Prerequisites
- Git
- PHP 8.2+
- Composer
- Node.js 18+
- Docker & Docker Compose (recommended)
- MySQL/MariaDB

### Development Setup

1. **Fork the repository**
   ```bash
   # Click "Fork" on GitHub
   ```

2. **Clone your fork**
   ```bash
   git clone https://github.com/YOUR_USERNAME/uts-2026.git
   cd uts-2026
   ```

3. **Add upstream remote**
   ```bash
   git remote add upstream https://github.com/GaassXX/uts-2026.git
   ```

4. **Setup with Docker**
   ```bash
   docker-compose up -d
   cd src
   cp .env.example .env
   composer install
   npm install
   php artisan key:generate
   php artisan migrate
   npm run dev
   ```

5. **Verify setup**
   - Open https://uts.test in your browser
   - Admin panel: https://uts.test/admin

## Making Changes

### Branch Naming Convention

```
feature/description      - New features
bugfix/description       - Bug fixes
docs/description         - Documentation
refactor/description     - Code refactoring
test/description         - Testing improvements
```

### Create Feature Branch

```bash
git checkout -b feature/your-feature-name
```

### Commit Guidelines

Use **Conventional Commits** format:

```
type(scope): subject

body

footer
```

**Types:**
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation
- `style`: Code style (formatting, missing semicolons, etc)
- `refactor`: Code refactoring
- `perf`: Performance improvements
- `test`: Adding or updating tests
- `chore`: Maintenance tasks

**Examples:**
```
feat(projects): add search functionality to projects page

- Add search input component
- Implement live search with Livewire
- Add search to project repository

Closes #42
```

```
fix(auth): correct password validation logic

Body explaining what was wrong and how it's fixed.

Fixes #38
```

```
docs: update installation instructions for Docker
```

### Code Style

- Follow **PSR-12** standards for PHP
- Use **2 spaces** for indentation
- Use meaningful variable and function names
- Add comments for complex logic
- Keep functions focused and small
- Use type hints when possible

**Example:**
```php
// ✅ Good
class ProjectRepository
{
    public function findPublished(): Collection
    {
        return Project::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}

// ❌ Bad
function getProj() {
    return Project::all();
}
```

### Frontend Code Style

- Use **Tailwind CSS** for styling
- Keep component files focused
- Use **Livewire** for dynamic features
- Leverage **Alpine.js** for simple interactivity
- Write semantic HTML

### Testing

```bash
# Run tests locally
docker-compose exec php php artisan test

# Run with coverage
docker-compose exec php php artisan test --coverage
```

## Submitting Changes

### Before Submitting

- [ ] Code follows project style guidelines
- [ ] Local tests pass: `php artisan test`
- [ ] New features have tests
- [ ] Documentation is updated
- [ ] Commits are clean and well-described
- [ ] No debugging code or comments left

### Create Pull Request

1. **Push to your fork**
   ```bash
   git push origin feature/your-feature-name
   ```

2. **Create PR on GitHub**
   - Go to your fork on GitHub
   - Click "Compare & pull request"
   - Fill in PR title and description
   - Reference related issues: `Closes #123`

3. **PR Description Template**
   ```markdown
   ## Description
   Brief description of changes

   ## Type of Change
   - [ ] New feature
   - [ ] Bug fix
   - [ ] Documentation

   ## Related Issues
   Fixes #(issue number)

   ## Testing
   Steps to verify the changes

   ## Screenshots (if applicable)
   Screenshots of changes
   ```

### PR Review Process

- At least one maintainer review required
- CI/CD checks must pass
- Address feedback and update PR
- Squash commits before merge if requested

## Documentation

### When to Update Docs

- [ ] New features
- [ ] API changes
- [ ] Setup/installation changes
- [ ] New dependencies
- [ ] Configuration changes

### Documentation Files

- **README.md** - Main documentation
- **SECURITY.md** - Security policy
- **CHANGELOG.md** - Version history
- **Code comments** - Inline documentation

### Comment Guidelines

```php
// ❌ Bad - Obvious comments
$user = User::find($id); // Get user by ID

// ✅ Good - Explains why, not what
// Cache user for performance optimization
$user = Cache::remember("user.{$id}", 3600, function() {
    return User::find($id);
});
```

## Areas for Contribution

### High Priority
- 🐛 Bug fixes
- 📚 Documentation improvements
- 🧪 Test coverage
- ⚡ Performance optimizations

### Medium Priority
- ✨ New features (discuss first via issues)
- 🎨 UI/UX improvements
- ♿ Accessibility improvements

### Nice to Have
- 🌍 Internationalization
- 📱 Mobile responsiveness
- 💾 Database optimization

## Issue Reports

### Before Creating an Issue
- [ ] Check existing issues
- [ ] Search closed issues
- [ ] Read documentation

### Issue Template

```markdown
## Description
Clear description of the issue

## Steps to Reproduce
1. Step 1
2. Step 2
3. Expected result vs actual result

## Environment
- PHP: 8.2
- Laravel: 12
- Browser: Chrome 120

## Screenshots
If applicable
```

## Questions?

- Open a discussion on GitHub
- Email: rizqibagas@example.com
- LinkedIn: https://linkedin.com/in/rizqibagas

## Recognition

Contributors will be recognized in:
- CHANGELOG.md
- GitHub contributors page
- Project documentation (if applicable)

---

**Thank you for contributing! Your help makes this project better.** 🚀
