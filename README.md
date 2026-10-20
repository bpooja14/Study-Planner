# StudyNest — Cloud Study Planner (PHP + MySQL)

## Included
- Landing page, student registration and login
- Password hashing and session-based authentication
- Per-user subjects and study tasks
- Add, complete/undo, and delete tasks
- Responsive Bootstrap layout and custom CSS
- MySQL schema

## Run locally with XAMPP
1. Install and start Apache and MySQL in XAMPP.
2. Copy the `cloud_study_planner` folder into `C:\xampp\htdocs\` (Windows) or the XAMPP `htdocs` directory.
3. Open phpMyAdmin at `http://localhost/phpmyadmin`.
4. Import `database.sql`.
5. If your MySQL credentials differ from XAMPP defaults, update `config.php`.
6. Visit `http://localhost/cloud_study_planner/`.

## AWS deployment overview
- EC2: deploy the PHP files to the web server document root and install Apache/PHP.
- RDS: create a MySQL database, import `database.sql`, set `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` as server environment variables, and allow port 3306 only from the EC2 security group.
- S3: optional extension for private study-material uploads. This starter does not yet upload files to S3; use an EC2 IAM role and AWS SDK for PHP, and keep the bucket private.
- Use HTTPS, secure session cookies, CSRF tokens, backups, and managed secrets before production use.

## Project scope
This learning starter includes the dashboard, subjects, study tasks, assignment and exam task types, and progress summary. It does not include Notes, Hub, Focus Room, AWS Cloud, or Viva sections. For production, add CSRF protection, secure session settings, HTTPS, backups, and managed secrets. Keep database credentials private and do not make the database publicly accessible.
