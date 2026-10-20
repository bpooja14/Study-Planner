<?php
require 'config.php';
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
 $name=trim($_POST['name']??''); $email=filter_var(trim($_POST['email']??''),FILTER_VALIDATE_EMAIL); $password=$_POST['password']??'';
 if (!$name || !$email || strlen($password)<8) $error='Enter your name, a valid email, and a password of at least 8 characters.';
 else {
  $hash=password_hash($password,PASSWORD_DEFAULT);
  $stmt=$conn->prepare('INSERT INTO users(name,email,password_hash) VALUES(?,?,?)'); $stmt->bind_param('sss',$name,$email,$hash);
  if ($stmt->execute()) { session_regenerate_id(true); $_SESSION['user_id']=$stmt->insert_id; $_SESSION['user_name']=$name; header('Location: dashboard.php'); exit; }
  $error='That email may already be registered. Try logging in.';
 }
}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Create account | StudyNest</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="assets/style.css" rel="stylesheet"></head><body class="auth-page"><div class="auth-card"><a class="navbar-brand fw-bold" href="index.php">✦ StudyNest</a><h2 class="fw-bold mt-4">Create your account</h2><p class="text-secondary">Start building a study routine that works for you.</p><?php if($error):?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif;?><form method="post" class="needs-validation" novalidate><label class="form-label">Full name</label><input class="form-control mb-3" name="name" required maxlength="100" autocomplete="name"><label class="form-label">Email</label><input class="form-control mb-3" type="email" name="email" required autocomplete="email"><label class="form-label">Password</label><input class="form-control mb-3" type="password" name="password" minlength="8" required autocomplete="new-password"><button class="btn btn-primary w-100 mt-2">Create account</button></form><p class="text-center mt-4 mb-0 small">Already registered? <a href="login.php">Log in</a></p></div><script src="assets/app.js"></script></body></html>
