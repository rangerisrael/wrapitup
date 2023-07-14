
<?php
include '../config/functions.php';

if (isset($_POST)) {
    global $db;
    $email= $_POST['email'];
    $code = $_POST['code'][0].$_POST['code'][1].$_POST['code'][2].$_POST['code'][3];

    if($_POST['reset'] == "true"){
        reset_code($email, $code);

    }
    else{
        update_code($email, $code);
    }
    
    
}


?>