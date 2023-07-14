
<?php
include '../config/functions.php';

if (isset($_POST)) {
    global $db;
    $email    = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $code = $_POST['code'];

    create_new_account($email,$username,$password,$code );


    
}


?>