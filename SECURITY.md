# Security Policy

## Reporting a Vulnerability

If you discover a security vulnerability in this project, please email **rizqibagas@example.com** instead of using the issue tracker.

Please include:
- Description of the vulnerability
- Steps to reproduce
- Potential impact
- Suggested fix (if available)

We will acknowledge receipt of your report within 48 hours and will send a more detailed response within 72 hours indicating the next steps.

## Supported Versions

| Version | Status | End of Life |
|---------|--------|------------|
| 1.0.x   | Active | May 2027   |

## Security Considerations

### Input Validation
- All user inputs are validated using Laravel form validation
- CSRF tokens are enforced on all state-changing requests
- XSS protection via Blade templating

### Authentication & Authorization
- Password hashing using Laravel's `Hash` facade (bcrypt)
- Session management with Laravel's built-in session driver
- Role-based access control via Filament Shield

### Database Security
- SQL injection prevention via Laravel's query builder and Eloquent ORM
- Database credentials stored in `.env` (never in version control)
- Automatic timestamp management (created_at, updated_at)

### File Upload Security
- File type validation for uploads
- Files stored outside public directory
- File access control via storage disk permissions

### Secrets Management
- Application key in `.env` (never committed)
- No hardcoded credentials
- Use environment variables for sensitive data

### Dependencies
- Regular updates via Composer
- Dependency security scanning recommended
- Use `composer audit` to check for vulnerabilities

## Best Practices

1. **Keep Laravel updated** - Run `composer update` regularly
2. **Monitor dependencies** - Use `composer audit` for vulnerability checks
3. **Environment security** - Never share `.env` files
4. **Access control** - Restrict admin panel access to authorized users only
5. **Logging** - Monitor activity logs for suspicious behavior
6. **Database backups** - Regular backups of production data

## Security Headers

Add these headers in `nginx/default.conf`:
```nginx
# Prevent clickjacking
add_header X-Frame-Options "SAMEORIGIN" always;

# Disable MIME type sniffing
add_header X-Content-Type-Options "nosniff" always;

# Enable XSS protection
add_header X-XSS-Protection "1; mode=block" always;

# Referrer policy
add_header Referrer-Policy "strict-origin-when-cross-origin" always;
```

## SSL/TLS

- HTTPS is strongly recommended for production
- SSL certificates can be obtained from Let's Encrypt
- See `nginx/ssl/` directory for SSL configuration

## Questions?

For security questions or concerns, please contact **rizqibagas@example.com**
