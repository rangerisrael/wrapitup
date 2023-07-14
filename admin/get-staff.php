
<?php

include '../config/functions.php';

global $db;


$id = $db->real_escape_string($_POST['id']);


get_staff($id);





?>