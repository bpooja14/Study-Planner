<?php
// Local XAMPP: localhost, root, empty password. Update for your own database.
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db   = getenv('DB_NAME') ?: 'study_planner';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { http_response_code(500); die('Database connection failed. Check config.php.'); }
$conn->set_charset('utf8mb4');
if (session_status() === PHP_SESSION_NONE) session_start();
