<?php
include '../config/functions.php';


  global $db;
  $role = $db->real_escape_string($_POST['role']);
  $username = $db->real_escape_string($_POST['username']);
  $password = $db->real_escape_string($_POST['password']);
  login($username, $password, $role);


?>