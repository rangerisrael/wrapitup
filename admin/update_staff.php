
<?php

include '../config/functions.php';

global $db;


    $id = $db->real_escape_string($_POST['id']);
    $email = $db->real_escape_string($_POST['email']);
   $fname = $db->real_escape_string($_POST['fname']);
    $lname = $db->real_escape_string($_POST['lname']);
   $username  = $db->real_escape_string($_POST['username']);
    $contact  = $db->real_escape_string($_POST['contact']);
    $bday      = $db->real_escape_string($_POST['bday']);
    $age = $db->real_escape_string($_POST['age']);
    $gender    = $db->real_escape_string($_POST['gender']);

updateStaff($id,$email, $fname, $lname, $username, $contact, $bday, $age,$gender);





?>