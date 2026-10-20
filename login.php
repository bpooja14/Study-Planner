<?php
require 'config.php'; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
 $email=trim($_POST['email']??''); $password=$_POST['password']??'';
 $stmt=$conn->prepare('SELECT id,name,password_hash FROM users WHERE email=?'); $stmt->bind_param('s',$email); $stmt->execute(); $u=$stmt->get_result()->fetch_assoc();
 if($u && password_verify($password,$u['password_hash'])) { session_regenerate_id(true); $_SESSION['user_id']=$u['id']; $_SESSION['user_name']=$u['name']; header('Location: dashboard.php'); exit; }
 $error='Email or password was not recognized.';
}
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Log in | StudyNest</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="assets/style.css" rel="stylesheet"></head><body class="auth-page"><div class="auth-card"><a class="navbar-brand fw-bold" href="index.php">✦ StudyNest</a><h2 class="fw-bold mt-4">Welcome back</h2><p class="text-secondary">Pick up where you left off.</p><?php if($error):?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif;?><form method="post"><label class="form-label">Email</label><input class="form-control mb-3" type="email" name="email" required><label class="form-label">Password</label><input class="form-control mb-3" type="password" name="password" required><button class="btn btn-primary w-100 mt-2">Log in</button></form><p class="text-center mt-4 mb-0 small">New here? <a href="register.php">Create an account</a></p></div></body></html>
