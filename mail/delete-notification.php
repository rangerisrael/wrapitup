<?php
include '../config/functions.php';

if (isset($_POST)) {
  global $db;
  $id = $_POST['id'];

  deleteNotification($id);


}


?>