<?php
require 'config.php'; if(empty($_SESSION['user_id'])){header('Location: login.php');exit;}
$uid=(int)$_SESSION['user_id']; $action=$_POST['action']??'';
if($action==='toggle'){$id=(int)($_POST['task_id']??0);$stmt=$conn->prepare("UPDATE tasks SET status=IF(status='Pending','Completed','Pending') WHERE id=? AND user_id=?");$stmt->bind_param('ii',$id,$uid);$stmt->execute();}
elseif($action==='delete'){$id=(int)($_POST['task_id']??0);$stmt=$conn->prepare('DELETE FROM tasks WHERE id=? AND user_id=?');$stmt->bind_param('ii',$id,$uid);$stmt->execute();}
elseif($_SERVER['REQUEST_METHOD']==='POST'){$title=trim($_POST['title']??'');$type=$_POST['task_type']??'Study';$priority=$_POST['priority']??'Medium';$date=$_POST['due_date']??'';$time=$_POST['start_time']?:null;$sid=(int)($_POST['subject_id']??0);$validTypes=['Study','Assignment','Exam','Revision'];$validPriorities=['Low','Medium','High'];
if($title && $date && in_array($type,$validTypes,true)&&in_array($priority,$validPriorities,true)){
 if($sid){$check=$conn->prepare('SELECT id FROM subjects WHERE id=? AND user_id=?');$check->bind_param('ii',$sid,$uid);$check->execute();if(!$check->get_result()->num_rows)$sid=0;}
 $subject=$sid?:null;$stmt=$conn->prepare('INSERT INTO tasks(user_id,subject_id,title,task_type,due_date,start_time,priority) VALUES(?,?,?,?,?,?,?)');$stmt->bind_param('iisssss',$uid,$subject,$title,$type,$date,$time,$priority);$stmt->execute();
}}
header('Location: dashboard.php');exit;
