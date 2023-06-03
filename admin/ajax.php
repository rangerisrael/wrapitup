<?php include '../config/functions.php';?>
<?php

if(isset($_POST['action'])) {
    $product_categories_id = $_POST['product_categories_id'];
    $query = get_all_sub_categories($product_categories_id);
    foreach($query as $data) {
        $array[] = [
            'id' => $data['id'],
            'child' => $data['child']
        ];
    }
    echo json_encode($array);
}