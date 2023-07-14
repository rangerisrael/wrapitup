
<?php

include '../config/functions.php';

global $db;


    $email = $db->real_escape_string($_POST['email']);
   $fname = $db->real_escape_string($_POST['fname']);
    $lname = $db->real_escape_string($_POST['lname']);
   $username  = $db->real_escape_string($_POST['username']);
    $password  = $db->real_escape_string($_POST['password']);
    $contact  = $db->real_escape_string($_POST['contact']);
    $bday      = $db->real_escape_string($_POST['bday']);
    $age = $db->real_escape_string($_POST['age']);
    $gender    = $db->real_escape_string($_POST['gender']);
 
    addNewStaff($email, $fname, $lname, $username, $password, $contact, $bday, $age,$gender);





?>