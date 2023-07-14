
<?php
include '../config/functions.php';

if (isset($_POST)) {
    global $db;
    $id    = $_POST['user_id'];

    if(isset($_SESSION['id']) && $_SESSION['id'] == $id){
        get_account_user($id);
    }
    


    
}


?>