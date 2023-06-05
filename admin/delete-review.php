<?php include '../config/functions.php';?>
<?php

$data = json_decode(trim(file_get_contents("php://input")));

deleteReview(validate($data->id))
?>