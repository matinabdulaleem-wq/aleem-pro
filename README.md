[README.md](https://github.com/user-attachments/files/33061363/README.md)
# Abdul Aleem Matin — Portfolio (PHP 8 + MySQL)

## Structure
- `public/` — the ONLY web-accessible folder (document root). Contains index.php, contact.php, install.php, assets/, admin/, uploads/.
- `app/` and `database/` and `.env` — keep OUTSIDE the document root.

## Install
1. Create a MySQL database and user in your hosting panel (utf8mb4).
2. Import `database/database.sql` (phpMyAdmin → Import, or `mysql -u USER -p DB < database/database.sql`).
3. Copy `.env.example` to `.env` (in the project root, next to `app/`) and fill DB_*, APP_URL, APP_SECRET (long random string), NOTIFY_TO, MAIL_FROM.
4. Upload everything. Point the domain's document root to `public/`. If the host only offers `public_html`, put the contents of `public/` there and upload `app/`, `database/`, `.env` one level above it.
5. Open `https://your-domain/install.php`, create the first admin (12+ character password), then DELETE `install.php`.
6. Log in at `/admin/login.php`.
7. HTTPS: enable a free certificate (Let's Encrypt / host panel) and force HTTPS redirect. Session cookies become `Secure` automatically over HTTPS.
8. Update `canonical`/sitemap/robots placeholders (`your-domain.com`) to your real domain.
9. Test the contact form: send a message, confirm it appears in Admin → Messages and that the email arrives at NOTIFY_TO.

## Email
Notifications use PHP `mail()`, which requires the host to have mail enabled and MAIL_FROM on your domain (SPF/DKIM recommended). Messages are always saved in MySQL even if mail fails. For SMTP, add PHPMailer; the MAIL_HOST/PORT/USERNAME/PASSWORD variables are not used by this build.

## Security notes
Prepared statements, password_hash, CSRF tokens, escaped output, honeypot + 5 messages/hour per IP, validated image uploads (PHP execution blocked in uploads/ via .htaccess — Apache; on Nginx deny PHP in /uploads).
