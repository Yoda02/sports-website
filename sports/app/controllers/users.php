<?php
include("app/database/database.php");
if(isset($_POST['login'])){
   $login=$_POST['login'];
   $email=$_POST['email'];
   $pass=password_hash($_POST['passecond'], PASSWORD_DEFAULT);
   $admin=0;

$post =[
'admin'=> $admin,
'user_name'=> $login,
'email'=> $email,
'password'=> $pass

];
insert('users',$post);

}