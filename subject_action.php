<?php
require 'config.php';if(empty($_SESSION['user_id'])){header('Location: login.php');exit;}$uid=(int)$_SESSION['user_id'];
if(isset($_POST['subject_name'])){$name=trim($_POST['subject_name']);if($name){$stmt=$conn->prepare('INSERT INTO subjects(user_id,name) VALUES(?,?)');$stmt->bind_param('is',$uid,$name);$stmt->execute();}}
if(($_POST['action']??'')==='delete'){$id=(int)($_POST['subject_id']??0);$stmt=$conn->prepare('DELETE FROM subjects WHERE id=? AND user_id=?');$stmt->bind_param('ii',$id,$uid);$stmt->execute();}
header('Location: dashboard.php');exit;
