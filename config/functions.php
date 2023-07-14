<?php
include 'database.php';
require __DIR__ . '/vendor/autoload.php';


function login($username,$password,$role) {
    global $db;
    $check = $db->query("SELECT * FROM accounts WHERE username = '$username' OR email='$username' AND status = 0 "); // validate if username already exist
    if($check->num_rows > 0) {
        $row = $check->fetch_assoc();
        if(password_verify($password,$row['password'])) {
            

            if($row['is_verify'] == 0){
                header('location: verification.php?username='.$row['username'].'&email=' . $row['email'] . '&success=false&message=' . urlencode('Your account is not yet verified. Please check your email for verification'));
            }

            else{

                $_SESSION['role'] = $row['role'];
                if ($row['role'] == 0) {
                    $_SESSION['administrator'] = 1;
                    $_SESSION['admin_id'] = $row['id'];
                //    if($role === '1'){
                //         header('location: admin/dashboard.php');
                //    }
                //    else{
                        header('location: dashboard.php');
                //    }
                }
                else if ($row['role'] == 2) {
                  

                    if($role == 2){
                     $_SESSION['customer'] = 2;
                     $_SESSION['id'] = $row['id'];

                        echo json_encode(array("success" => true,'role' => 2));

                     }
                    if($role == 1){
                        echo json_encode(array("success" => true,'role' => 2));
                    }

                    
                    if($role == 0){
                        $_SESSION['administrator'] = 2;
                        $_SESSION['admin_id'] = $row['id'];
                        header('location: dashboard.php');

                    }

                      

                    
                    //    }
                }
                
                else {

                    if($role == 1){
                        $_SESSION['customer'] = 1;
                        $_SESSION['id'] = $row['id'];

                        echo json_encode(array("success" => true,'role' => 1));
                    }
                    if ($role == 2) {
                        echo json_encode(array("success" => true, 'role' => 1));
                    }
                  
                   
                   
                }
            }

          
        } else {
            if($role == 0) {
                header('location: index.php?success=false&message='.urlencode('Invalid username or password'));
            } else {
                echo json_encode(array("success" => false));
            }
        }
    } else {
        if($role == 0) {
            header('location: index.php?success=false&message='.urlencode('Invalid username or password'));
        } else {
            echo json_encode(array("success" => false));
        }
    }
}


function cancel($reference) {
    global $db;
    $query = $db->query("UPDATE transaction SET status = 3 WHERE reference = '$reference'");
    header('location: orders.php?reference='.$reference.'&success=true&message='.urlencode('Your transaction has been cancelled'));
}
function logout() {
    unset($_SESSION['customer'],$_SESSION['id']);
    header('location: home.php');
}

function create_new_account($email,$username,$pwd,$code) {
    global $db;
    $check = $db->query("SELECT * FROM accounts WHERE email = '$email'"); // validate if email already exist
    if($check->num_rows > 0) {
        echo json_encode(array("exist" => true));
    } else {
        // roles: 
        // 0 = admin
        // 1 = customer
        $month    = date('n');
        $year     = date('Y');
        $password = password_hash($pwd,PASSWORD_DEFAULT);
        $query    = $db->query("INSERT INTO accounts (email,username,password,role,status,month,year,verify_code,is_verify) VALUES ('$email','$username','$password','1',0,$month,$year,$code,0)");
        if($query) {
            echo json_encode(array("success" => true));

        } else {
            echo $db->error;
            exit;
        }
    }
}


function reset_code($email, $code)
{
    global $db;
    $check = $db->query("SELECT * FROM accounts WHERE email = '$email'"); // validate if email already exist

    $result = $check->fetch_assoc();
    $verifyCode = $result['verify_code'];


    if ($check->num_rows > 0 && $result['is_verify'] == 0) {


        $db->query("UPDATE accounts SET verify_code =$code WHERE email = '$email'");


        echo json_encode(array("success" => true));
    } else {

        echo json_encode(array("success" => false));

    }
}

function update_code($email,$code){
    global $db;
    $check = $db->query("SELECT * FROM accounts WHERE email = '$email'"); // validate if email already exist

    $result = $check->fetch_assoc();
    $verifyCode = $result['verify_code'];
    $verify = $result['is_verify'];


    if($check->num_rows > 0 && strval($verifyCode) == $code && $verify == 0 ) {

 
     $db->query("UPDATE accounts SET verify_code ='',is_verify= true WHERE email = '$email'");


        echo json_encode(array("success" => true));
    } else {

        echo json_encode(array("success" => false));


    }
}

function get_all_customer($from,$to) {
    global $db;
    if(empty($from) && empty($to)) {
        $query = $db->query("SELECT * FROM accounts WHERE role = 1");
    } else {
        $query = $db->query("SELECT * FROM accounts WHERE role = 1 AND created_at BETWEEN '$from' AND '$to'");
    }
    return $query;
}

function get_all_staff($from, $to)
{
    global $db;
    if (empty($from) && empty($to)) {
        $query = $db->query("SELECT * FROM accounts WHERE role = 2");
    } else {
        $query = $db->query("SELECT * FROM accounts WHERE role = 2 AND created_at BETWEEN '$from' AND '$to'");
    }
    return $query;
}

function get_individual_staff($from, $to,$id)
{
    global $db;
    if (empty($from) && empty($to)) {
        $query = $db->query("SELECT * FROM accounts WHERE role = 2 AND id='$id'");
    } else {
        $query = $db->query("SELECT * FROM accounts WHERE role = 2 AND created_at BETWEEN '$from' AND '$to' AND id='$id'");
    }
    return $query;
}

function get_maritals($from,$to) {
    global $db;
    if(empty($from) && empty($to)) {
        $query = $db->query("SELECT *, COUNT(marital) as count FROM accounts  GROUP BY marital ");
    } else {
        $query = $db->query("SELECT *, COUNT(marital) as count FROM accounts WHERE created_at BETWEEN '$from' AND '$to' GROUP BY marital");
    }
    return $query;
}

function get_locations($from,$to) {
    global $db;
    if(empty($from) && empty($to)) {
        $query = $db->query("SELECT *, COUNT(city) as count FROM accounts_address  GROUP BY city ");
    } else {
        $query = $db->query("SELECT *, COUNT(city) as count FROM accounts_address WHERE created_at BETWEEN '$from' AND '$to' GROUP BY city");
    }
    return $query;
}


function most_buying_product($from,$to) {
    global $db;
    if(empty($from) && empty($to)) {
        $query = $db->query("SELECT *, SUM(quantity) as items FROM transaction GROUP BY product ORDER BY items DESC");
    } else {
        $query = $db->query("SELECT *, SUM(quantity) as items FROM transaction WHERE created_at BETWEEN '$from' AND '$to' GROUP BY product  ORDER BY items DESC");
    }
    return $query;
}

function product_counter($product) {
    global $db;
    $query = $db->query("SELECT * FROM transaction WHERE product = '$product'");
    return $query->fetch_assoc();
}




function get_all_payments($from,$to) {
    global $db;
    if(empty($from) && empty($to)) {
        $query = $db->query("SELECT *, COUNT('method_of_payment') as items FROM transaction GROUP BY method_of_payment");
    } else {
        $query = $db->query("SELECT *, COUNT('method_of_payment') as items FROM transaction WHERE created_at BETWEEN '$from' AND '$to'  GROUP BY method_of_payment");
    }
    return $query;
}

function account_details($id) {
    global $db;
    $query = $db->query("SELECT * FROM accounts WHERE id = $id");

    
    return $query;  
}


function get_account_user($id)
{
    global $db;
    $query = $db->query("SELECT * FROM accounts WHERE id = $id");

    if($query->num_rows > 0) {
       echo json_encode(array("success" => true));
    } else {
      echo json_encode(array("success" => false));

    }

}


function update_account_details($firstname,$surname,$email,$contact,$birthday,$age,$gender,$marital) {
    global $db;
    $query = $db->query("UPDATE accounts SET firstname = '$firstname', surname = '$surname', email = '$email', contact = '$contact', birthday = '$birthday', age = '$age', gender = '$gender', marital = '$marital' WHERE id = ".$_SESSION['id']);
    if($query) {
        header('location: my-account.php?success=true&message='.urlencode('Account details has been updated'));
    }
}


function account_billing_address($id) {
    global $db;
    $query = $db->query("SELECT * FROM accounts_address WHERE category = 'Billing Address' AND accounts_id = $id");
    return $query;  
}

function account_shipping_address($id) {
    global $db;
    $query = $db->query("SELECT * FROM accounts_address WHERE category = 'Shipping Address' AND accounts_id = $id");
    return $query;  
}

function get_all_products() {
    global $db;
    $query = $db->query("SELECT * FROM product");
    return $query;  
}

function get_searched_result($title,$category) {
    global $db;
    $wildcard = urldecode($title);
    if($category == 'all') {
        $query = $db->query("SELECT * FROM product WHERE title LIKE '%$wildcard%'");
    } else {
        $query = $db->query("SELECT * FROM product WHERE product_categories_id = $category AND title LIKE '%$wildcard%'");
    }
    return $query; 
}

function insert_or_update_account_billing_details($id,$country,$city,$state,$zip,$address,$category) {
    global $db;
    $accounts_id = $_SESSION['id'];
    $check = $db->query("SELECT * FROM accounts_address WHERE category = 'Billing Address' AND id = ".$id);
    if($check->num_rows > 0) {
        $query = $db->query("UPDATE accounts_address SET country = '$country', city = '$city', state = '$state', zip = '$zip', address = '$address', category = '$category' WHERE id = ".$id);
        header('location: my-account.php?success=true&message='.urlencode('Billing Address has been updated'));
    } else {
        $query = $db->query("INSERT INTO accounts_address (accounts_id,country,city,state,address,zip,category) VALUES ('$accounts_id','$country','$city','$state','$address','$zip','$category')");
        header('location: my-account.php?success=true&message='.urlencode('Billing Address has been updated'));
    }
}

function insert_or_update_account_shipping_details($id,$shipping_firstname,$shipping_surname,$contact,$country,$city,$state,$zip,$address,$category) {
    global $db;
    $accounts_id = $_SESSION['id'];
    $check = $db->query("SELECT * FROM accounts_address WHERE category = 'Shipping Address' AND id = ".$id);
    if($check->num_rows > 0) {
        $query = $db->query("UPDATE accounts_address SET  shipping_firstname = '$shipping_firstname', shipping_surname = '$shipping_surname', contact = '$contact', country = '$country', city = '$city', state = '$state', zip = '$zip', address = '$address', category = '$category' WHERE id = ".$id);
        header('location: my-account.php?success=true&message='.urlencode('Shipping Address has been updated'));
    } else {
        $query = $db->query("INSERT INTO accounts_address (accounts_id,shipping_firstname,shipping_surname,contact,country,city,state,address,zip,category) VALUES ('$accounts_id','$shipping_firstname','$shipping_surname','$contact','$country','$city','$state','$address','$zip','$category')");
        header('location: my-account.php?success=true&message='.urlencode('Shipping Address has been updated'));
    }
}

function my_orders() {
    global $db;
    $query = $db->query("SELECT *, SUM(price * quantity) as total, SUM(quantity) as items FROM transaction WHERE accounts_id = ".$_SESSION['id']." GROUP BY reference ORDER BY created_at DESC ");
    return $query;  
}

function assisted_staff_orders()
{
    global $db;
    $query = $db->query("SELECT t.*, SUM(t.price * t.quantity) as total, SUM(t.quantity) as items, a.email as email FROM transaction t, accounts a WHERE a.id =" . $_SESSION['id'] . " AND t.assisted_by = " . $_SESSION['id'] . " GROUP BY reference ORDER BY created_at DESC ");
    return $query;
}


function view_orders() {
    global $db;
    $query = $db->query("SELECT *, SUM(price * quantity) as total, SUM(quantity) as items FROM transaction GROUP BY reference ORDER BY created_at DESC ");
    return $query;  
}



function get_order_details($reference) {
    global $db;
    $query = $db->query("SELECT * FROM transaction WHERE reference = '$reference'");
    return $query;  
}

function get_all_order_details($from,$to) {
    global $db;
    if(empty($from) && empty($to)) {
        $query = $db->query("SELECT * FROM transaction");
    } else {
        $query = $db->query("SELECT * FROM transaction WHERE created_at BETWEEN '$from' AND '$to'");
    }
    return $query;  
}

function get_genders($from,$to) {
    global $db;
    if(empty($from) && empty($to)) {
        $query = $db->query("SELECT * FROM accounts WHERE role = 1 GROUP BY gender");
    } else {
        $query = $db->query("SELECT * FROM accounts WHERE role = 1 AND created_at BETWEEN '$from' AND '$to' GROUP BY gender");
    }
    return $query;  
}

function gender_counter($gender) {
    global $db;
    $query = $db->query("SELECT * FROM accounts WHERE gender = '$gender' AND role = 1");
    return $query->num_rows;
}

function age_counter($age) {
    global $db;
    $query = $db->query("SELECT * FROM accounts WHERE age = '$age' AND role = 1");
    return $query->num_rows;
}



function get_ages($from,$to) {
    global $db;
    if(empty($from) && empty($to)) {
        $query = $db->query("SELECT * FROM accounts WHERE role = 1");
    } else {
        $query = $db->query("SELECT * FROM accounts WHERE  role = 1 AND created_at BETWEEN '$from' AND '$to'");
    }
    return $query;  
}


function get_all_genders() {
    global $db;
    $query = $db->query("SELECT *, MONTH(created_at) as m FROM accounts GROUP BY month ORDER BY created_at ASC LIMIT 12");
    return $query;  
}

function get_all_ages() {
    global $db;
    $query = $db->query("SELECT *, COUNT(age) as count FROM accounts GROUP BY age");
    return $query; 
}


function count_male($month,$year) {
    global $db;
    $query = $db->query("SELECT * FROM accounts WHERE gender = 'Male' AND month = '$month' AND year = '$year'");
    return $query->num_rows;  
}

function count_female($month,$year) {
    global $db;
    $query = $db->query("SELECT * FROM accounts WHERE gender ='Female' AND month = '$month' AND year = '$year'");
    return $query->num_rows;  
}

function update_transaction_status($reference,$status,$id,$product) {

    $productDetails = isset($_SESSION['product_order']) ? $_SESSION['product_order'] : [];
    $productItem = isset($_SESSION['product_item']) ? $_SESSION['product_item'] : '';
    $productPrice = isset($_SESSION['product_price']) ? $_SESSION['product_price'] : '';




    global $db;
    $query = $db->query("UPDATE transaction SET status = $status WHERE reference = '$reference'");
    pushNotification(array('title' => 'Order Status', 'message' => 'Your order status has been updated', 'reference' => $reference, 'user_id' => $id,'status' => $status,'product' => $productDetails,'price' => $productPrice,'productItem' => $productItem));
  
    header('location: orders.php?reference='.$reference.'&success=true&product='.$product.'&message='.urlencode('Status has been updated'));
}

function pushNotification($payload){


    $userId = $payload['user_id'];
    $ref = $payload['reference'];
    $stat = $payload['status'];
    $productItem = $payload['productItem'];
    $prices = $payload['price'];


    global $db;

    $count = 0;

   
    $notificationCount = $db->query("SELECT COUNT(*) as listNotification FROM order_notification  WHERE user_id = $userId ORDER BY date_created DESC" );
  
 

    if ($notificationCount->num_rows > 0) {
        $countItems = $notificationCount->fetch_assoc();
       $count = $countItems['listNotification'];
    } else {
       $count = 0;
    }

    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        '49f045793f7158a8e0e3',
        '98ff9a54ca0dbbdf44aa',
        '1632345',
        $options
    );

    $data['title'] = $payload['title'];
    $data['message'] = $payload['message'];
    $data['reference'] = $payload['reference'];
    $data['user_id'] = $payload['user_id'];
    $data['status'] = $payload['status'];
    $data['count'] = number_format($count) + 1;
    $data['product'] = $payload['product'];

    $pusher->trigger('my-channel', 'my-event', $data);

   
  $db->query("INSERT INTO order_notification (user_id,reference_number,status,read_msg,product_item,product_price) VALUES ('$userId','$ref','$stat',0,'$productItem','$prices')");




}

function getCountNotification($userId){

    global $db;

   if($userId != ''){
     $notificationCount = $db->query("SELECT COUNT(*) as listNotification FROM order_notification  WHERE user_id = $userId");

   $countList = 0;

    if ($notificationCount->num_rows > 0) {
        $countItems = $notificationCount->fetch_assoc();
        $countList = $countItems['listNotification'];
    } else {
        $countList = 0;
    }

    return $countList;
   }
}

function getNotification($userId)
{
    global $db;
    $query = $db->query("SELECT * FROM order_notification  WHERE user_id = $userId ORDER BY date_created DESC");
    return $query;
}

function deleteNotification($id){
    global $db;
    $query = $db->query("DELETE FROM order_notification WHERE id = $id");
    
    echo json_encode(array('status' => 'success'));
}

function deleteNotificationAll()
{
    global $db;
    $query = $db->query("DELETE FROM order_notification");

    echo json_encode(array('status' => 'success'));
}



function get_all_sales_transaction() {
    global $db;
    $query = $db->query("SELECT *, MONTH(created_at) as m FROM transaction WHERE status = 2 GROUP BY month ORDER BY created_at ASC LIMIT 12");
    return $query;  
}


function get_all_payment_method_used() {
    global $db;
    $query = $db->query("SELECT *, MONTH(created_at) as m FROM transaction  GROUP BY month ORDER BY created_at ASC LIMIT 12");
    return $query;  
}



function count_cod($month,$year) {
    global $db;
    $query = $db->query("SELECT * FROM transaction WHERE method_of_payment = 'Cash On Delivery' AND month = '$month' AND year = '$year' GROUP BY reference");
    return $query->num_rows;  
}

function count_bank_transfer($month,$year) {
    global $db;
    $query = $db->query("SELECT * FROM transaction WHERE method_of_payment = 'Bank Transfer' AND month = '$month' AND year = '$year' GROUP BY reference");
    return $query->num_rows;  
}

function count_stripe($month,$year) {
    global $db;
    $query = $db->query("SELECT * FROM transaction WHERE method_of_payment = 'Stripe' AND month = '$month' AND year = '$year' GROUP BY reference");
    return $query->num_rows;  
}

function get_sales($month,$year) {
    global $db;
    $query = $db->query("SELECT *, SUM(price*quantity) as total FROM transaction WHERE month = '$month' AND year = '$year' AND status = 2");
    return $query->fetch_object();  
}

function get_all_users() {
    global $db;
    $query = $db->query("SELECT *, MONTH(created_at) as month FROM accounts WHERE role = 1 GROUP BY month ORDER BY created_at ASC");
    return $query;  
}

function get_all_signups($month,$year) {
    global $db;
    $query = $db->query("SELECT *, count(month) as total FROM accounts WHERE month = '$month' AND year = '$year' AND role = 1");
    return $query->fetch_object();  
}

function get_all_visitors() {
    global $db;
    $query = $db->query("SELECT *, MONTH(created_at) as month FROM visitors  GROUP BY month ORDER BY created_at ASC LIMIT 12");
    return $query;  
}

function get_visitor_count($month,$year) {
    global $db;
    $query = $db->query("SELECT *, count(month) as total FROM visitors WHERE month = '$month' AND year = '$year'");
    return $query->fetch_object();  
}


function update_receipt($reference) {
    global $db;
    $receipt = $_FILES['files']['name'];
    move_uploaded_file($_FILES['files']['tmp_name'],'assets/image/receipt/'.$_FILES['files']['name']);
    $query = $db->query("UPDATE transaction SET receipt_image = '$receipt' WHERE reference = '$reference'");
    header('location: orders.php?reference='.$reference.'&success=true&message='.urlencode('Receipt has been uploaded')); 
}


function delete_receipt($reference) {
    global $db;
    $query         = $db->query("SELECT * FROM transaction WHERE reference = '$reference'");
    $row           = $query->fetch_assoc();
    $receipt_image = $row['receipt_image'];
    $Path          = 'assets/image/receipt/'.$receipt_image;
    if (unlink($Path)) {    
        $db->query("UPDATE transaction SET receipt_image = NULL WHERE reference = '$reference'");
    } else {
    }
    header('location: orders.php?reference='.$reference.'&success=true&message='.urlencode('Receipt has been deleted')); 
}



function transaction($shipping_trigger,$method_of_payment,$notes,$shipping_fee = 0) {
    global $db;
    $reference      = reference(10);
    $accounts_id    = $_SESSION['id'];
    $status         = 0;
    $date           = date('Y-m-d');
    $month          = date('n',strtotime($date));
    $year           = date('Y',strtotime($date));
    foreach($_SESSION['cart'] as $key => $value) {
        $product_id = $value['id'];
        $title      = $value['title'];
        $quantity   = $value['quantity'];
        $price      = $value['price'] +  number_format($shipping_fee,2);
        $query      = $db->query("INSERT INTO transaction (accounts_id,product,quantity,price,method_of_payment,status,reference,notes,shipping_trigger,month,year) VALUES ($accounts_id,'$title',$quantity,'$price','$method_of_payment','$status','$reference','$notes','$shipping_trigger','$month','$year')");

        if($query) {
            $db->query("UPDATE product SET stocks=stocks-$quantity WHERE id =".$product_id);
        }
        
    }
    unset($_SESSION['cart']);
    header('location: my-account.php');
}

function  staffTransaction($firstname,$lastname,$email,$contact,$country,$address,$city,$state,$zip_code,$method_of_payment,$notes,$shipping_fee){
    // create account for user
    global $db;
    
    $checkUserExist = $db->query("SELECT * FROM accounts WHERE email = '$email'  ");

    if($checkUserExist->num_rows > 0){

        $reference = reference(10);
        $recent_id = $checkUserExist->fetch_assoc()['id'];
        $status = 0;
        $date = date('Y-m-d');
        $month = date('n', strtotime($date));
        $year = date('Y', strtotime($date));
        $assistedStaff = $_SESSION['id'];

        
        foreach ($_SESSION['cart'] as $key => $value) {
            $product_id = $value['id'];
            $title = $value['title'];
            $quantity = $value['quantity'];
            $price = $value['price'] + number_format($shipping_fee, 2);
            $query = $db->query("INSERT INTO transaction (accounts_id,product,quantity,price,method_of_payment,status,reference,notes,shipping_trigger,month,year,transaction_type,assisted_by) VALUES ($recent_id,'$title',$quantity,'$price','$method_of_payment','$status','$reference','$notes','No','$month','$year','walked_in','$assistedStaff')");

            if ($query) {
                $db->query("UPDATE product SET stocks=stocks-$quantity WHERE id =" . $product_id);
            }

        }

        unset($_SESSION['cart']);

        echo json_encode(array("success" => true, "message" => "Transaction Successfull", "ref" => $reference, "passcode" => 'Account_existed', "username" => 'Account_existed', "email" => $email));
    }
    else{
     
        $genUseName = $firstname.reference(5);
        $pwd = reference(5);
        $password = password_hash($pwd,PASSWORD_DEFAULT);
        $query    = $db->query("INSERT INTO accounts (firstname,surname,email,contact,username,password,role,is_verify) VALUES ('$firstname','$lastname','$email','$contact','$genUseName','$password',1,1)");
        if ($query) {

            $getRecentId = number_format($db->insert_id,0);

             $billingAddress = $db->query("INSERT INTO accounts_address (accounts_id,shipping_firstname,shipping_surname,contact,country,city,state,address,zip,category) VALUES ($getRecentId,'$firstname','$lastname','$contact','$country','$city','$state','$address','$zip_code','Billing Address')");


             if($billingAddress){
             
                $reference = reference(10);
                $accounts_id = $getRecentId;
                $status = 0;
                $date = date('Y-m-d');
                $month = date('n', strtotime($date));
                $year = date('Y', strtotime($date));
                $assistedStaff = $_SESSION['id'];
                foreach ($_SESSION['cart'] as $key => $value) {
                    $product_id = $value['id'];
                    $title = $value['title'];
                    $quantity = $value['quantity'];
                    $price = $value['price'] + number_format($shipping_fee, 2);
                    $query = $db->query("INSERT INTO transaction (accounts_id,product,quantity,price,method_of_payment,status,reference,notes,shipping_trigger,month,year,transaction_type,assisted_by) VALUES ($accounts_id,'$title',$quantity,'$price','$method_of_payment','$status','$reference','$notes','No','$month','$year','walked_in','$assistedStaff')");

                    if ($query) {
                        $db->query("UPDATE product SET stocks=stocks-$quantity WHERE id =" . $product_id);
                    }

                }
                
                unset($_SESSION['cart']);

                echo json_encode(array("success" => true, "message" => "Transaction Successfull", "ref" => $reference, "passcode" => $pwd, "username" => $genUseName, "email" => $email));
             }
         


          

        } else {
            echo $db->error;
            exit;
        }
    }




    // insert to account address



    // insert to transaction user id
    // update product stock

}


function stripe($shipping_trigger,$method_of_payment,$notes,$stripeToken,$stripeEmail) {
    global $db;
    $accounts_id    = $_SESSION['id'];
    $status = 2;
    $customer = \Stripe\Customer::create(array(
        'email' => $stripeEmail,
        'source'  => $stripeToken
    ));
  
    $total = 0;
    foreach($_SESSION['cart'] as $key => $value) {
        $total += $value['price'] * $value['quantity'];
    }

    $charge = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount'   => number_format($total,2,'',''),
        'currency' => 'PHP'
    ));
    

    $reference      = $charge->id;

    foreach($_SESSION['cart'] as $key => $value) {
        $product_id = $value['id'];
        $title      = $value['title'];
        $quantity   = $value['quantity'];
        $price      = $value['price'];
        $month      = date('n');
        $year       = date('Y');
        $query      = $db->query("INSERT INTO transaction (accounts_id,product,quantity,price,method_of_payment,status,reference,notes,shipping_trigger,month,year) VALUES ($accounts_id,'$title',$quantity,'$price','$method_of_payment','$status','$reference','$notes','$shipping_trigger','$month','$year')");
        if($query) {
            $db->query("UPDATE product SET stocks=stocks-$quantity WHERE id =".$product_id);
        }
    }


    unset($_SESSION['cart']);
    header('location: my-account.php');
}

function get_all_product_gallery($id) {
    global $db;
    $query = $db->query("SELECT * FROM product_galleries WHERE product_id = $id");
    return $query;  
}

function delete_gallery($id,$gallery_id) {
    global $db;
    $query = $db->query("DELETE FROM product_galleries WHERE id = $gallery_id");
    header('location: view-product.php?id='.$id);
}

function get_specific_products($id) {
    global $db;
    $query = $db->query("SELECT * FROM product WHERE id = ".$id);
    return $query;  
}

function get_specific_category($id) {
    global $db;
    $query = $db->query("SELECT * FROM product_categories WHERE id = $id");
    return $query; 
}

function get_all_category() {
    global $db;
    $query = $db->query("SELECT * FROM product_categories");
    return $query; 
}

function get_specific_sub_category($id) {
    global $db;
    $query = $db->query("SELECT * FROM product_sub_categories WHERE id = $id");
    return $query; 
}

function get_related_products($id,$product_categories_id) {
    global $db;
    $query = $db->query("SELECT * FROM product WHERE product_categories_id = '$product_categories_id' 
    AND id not in(SELECT id from product WHERE id = $id)");
    return $query;
}

function get_all_categories() {
    global $db;
    $query = $db->query("SELECT * FROM product_categories  ORDER BY created_at ASC ");
    return $query;
}

function get_all_sub_categories($id) {
    global $db;
    $query = $db->query("SELECT * FROM product_sub_categories WHERE product_categories_id = $id");
    return $query;
}

function get_featured_categories() {
    global $db;
    $query = $db->query("SELECT * FROM product_categories WHERE is_featured = 1 GROUP BY parent ORDER BY created_at ASC");
    return $query;
}

function get_featured_product() {
    global $db;
    $query = $db->query("SELECT * FROM product WHERE is_featured = 1");
    return $query;
}

function add_to_cart_from_links($id) {
    $query = get_specific_products($id)->fetch_assoc();
    if(isset($_SESSION['cart'][$id]['id']) == $id) {
        $stocks = $_SESSION['cart'][$id]['stocks'];
        $qty = $_SESSION['cart'][$id]['quantity'];
        if($stocks <= $qty) {

        } else {
            $_SESSION['cart'][$id]['quantity'] += 1;
        }
    }  else {
        if($query['stocks'] <= 1) {

        } else {
            $_SESSION['cart'][$id] = [
                'id'        => $id,
                'image'     => $query['featured_image'],
                'title'     => $query['title'],
                'price'     => $query['discount'] != 0 ? $query['price'] - ($query['price'] * ($query['discount'] / 100)) : $query['price'],
                'stocks'    => $query['stocks'],
                'quantity'  => 1
            ];
        }
    }
}

function add_to_cart_from_details($id,$quantity) {
    $query = get_specific_products($id)->fetch_assoc();

    if(isset($_SESSION['cart'][$id]['id']) == $id) {
        $stocks = $_SESSION['cart'][$id]['stocks'];
        $qty = $_SESSION['cart'][$id]['quantity'];
        if($stocks < $qty) {

        } else {
            if($query['stocks'] < ($quantity + $qty)) {

            } else {
                $_SESSION['cart'][$id]['quantity'] += $quantity;
            }
        }
        
    }  else {

        if($query['stocks'] < $quantity) {

        } else {
            $_SESSION['cart'][$id] = [
                'id'        => $id,
                'image'     => $query['featured_image'],
                'title'     => $query['title'],
                'price'     => $query['discount'] != 0 ? $query['price'] - ($query['price'] * ($query['discount'] / 100)) : $query['price'],
                'stocks'    => $query['stocks'],
                'quantity'  => $quantity
            ];
        }
    }
    header('location: product-details.php?id='.$id.'&success=true&message='.urlencode('Item has been added to your cart'));
}



function update_cart($id,$quantity) {
    $counter = count($id);
    for($i=0;$i<$counter;$i++) {
        $_SESSION['cart'][$id[$i]]['quantity'] = $quantity[$i];
    }
    header('location: cart.php?success=true&message='.urlencode('Your cart has been updated'));
}

function remove_cart_from_links($id) {
    unset($_SESSION['cart'][$id]);
}


function get_all_products_by_category($id) {
    global $db;
    $query = $db->query("SELECT * FROM product WHERE product_categories_id = $id");
    return $query;
}

function change_password($old_password,$new_password,$confirm_password) {
    global $db;
    if($new_password == $confirm_password) {
        $check = $db->query("SELECT * FROM accounts WHERE id = ".$_SESSION['id']); // validate if username already exist
        if($check->num_rows > 0) {
            $row = $check->fetch_assoc();
            if(password_verify($old_password,$row['password'])) {
                $new = password_hash($new_password,PASSWORD_DEFAULT);
                $db->query("UPDATE accounts SET password = '$new' WHERE id = ".$_SESSION['id']);
                header('location: my-account.php?success=true&message='.urlencode('Your password has been updated'));
            } else {
                header('location: my-account.php?success=false&message='.urlencode('Old password is incorrect'));
            }
        } else {
            header('location: my-account.php?success=false&message='.urlencode('An error occured.'));
        }
    } else {
        header('location:my-account.php?success=false&message='.urlencode('Password mismatched'));
    }
    

}

function get_all_products_by_sub_category($id) {
    global $db;
    $query = $db->query("SELECT * FROM product WHERE product_sub_categories_id = $id");
    return $query;
}

function post($data) {
    return $db->real_escape_string(htmlentities($_POST[$data]));
}

function get($data) {
    return $db->real_escape_string(htmlentities($_GET[$data]));
}

function canonical() {
    return "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}


function reference($length_of_string) {
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($str_result), 0, $length_of_string);
}

function get_ip() {
	$ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function save_visitors() {
    global $db;
    $ip_address = get_ip();
    $month = date('n');
    $year = date('Y');
    $check = $db->query("SELECT * FROM visitors WHERE ip_address = '$ip_address' AND month = '$month' AND year = '$year'");
    if($check->num_rows > 0) {

    } else {
        $db->query("INSERT INTO visitors (ip_address,month,year) VALUES ('$ip_address','$month','$year')");
    }
}

/// admin

function get_transaction_status($status) {
    global $db;
    $query = $db->query("SELECT COUNT(status) as total FROM transaction WHERE status = $status")->fetch_assoc();
    return number_format($query['total']);
}

function get_transaction_sales() {
    global $db;
    $query = $db->query("SELECT SUM(price*quantity) as total FROM transaction WHERE status = 2")->fetch_assoc();
    return number_format($query['total'],2);
}

function get_registered_user() {
    global $db;
    $query = $db->query("SELECT * FROM accounts WHERE role = 1")->num_rows;
    return number_format($query);
}

function get_all_location() {
    global $db;
    $query = $db->query("SELECT *, COUNT(city) as total FROM accounts_address GROUP BY city");
    return $query;
}

function get_visitors() {
    global $db;
    $query = $db->query("SELECT * FROM visitors ")->num_rows;
    return number_format($query);
}


function all_sub_categories() {
    global $db;
    $query = $db->query("SELECT * FROM product_sub_categories");
    return $query;
}

function add_gallery($id) {
    global $db;
    foreach($_FILES["images"]["tmp_name"] as $key => $value) {
        $image_name = $_FILES['images']['name'][$key];
        move_uploaded_file($_FILES['images']['tmp_name'][$key],'../assets/image/product/gallery/'.$_FILES['images']['name'][$key]);
        $query = $db->query("INSERT INTO product_galleries (product_id,images) VALUES ('$id','$image_name')");
    }
    header('location: view-product.php?id='.$id.'&success=true&message='.urlencode('New image has been added'));
}

function add_products($product_categories_id,$product_sub_categories_id,$title,$short_description,$long_description,$price,$stocks,$discount,$is_featured,$meta_description,$meta_keywords) {
    global $db;
    $check = $db->query("SELECT * FROM product WHERE title = '$title'");
    if($check->num_rows > 0) {
        header('location: add-new-products.php?success=false&message='.urlencode('Product already exist'));
    } else {
        if(empty($_FILES['images']['name'])) {
            $query = $db->query("INSERT INTO product (product_categories_id,product_sub_categories_id,title,short_description,long_description,price,stocks,discount,is_featured,meta_description,meta_keywords) VALUES ('$product_categories_id','$product_sub_categories_id','$title','$short_description','$long_description','$price','$stocks','$discount','$is_featured','$meta_description','$meta_keywords')");
        } else {
            $featured_image = $_FILES['images']['name'];
            move_uploaded_file($_FILES['images']['tmp_name'],'../assets/image/category/'.$_FILES['images']['name']);
            $query = $db->query("INSERT INTO product (featured_image,product_categories_id,product_sub_categories_id,title,short_description,long_description,price,stocks,discount,is_featured,meta_description,meta_keywords) VALUES ('$featured_image','$product_categories_id','$product_sub_categories_id','$title','$short_description','$long_description','$price','$stocks','$discount','$is_featured','$meta_description','$meta_keywords')");
        }
        if($query) {
            header('location: add-new-products.php?success=true&message='.urlencode('New product has been added'));
        }
    }
}

function update_products($id,$product_categories_id,$product_sub_categories_id,$title,$short_description,$long_description,$price,$stocks,$discount,$is_featured,$meta_description,$meta_keywords) {
    global $db;
    if(empty($_FILES['images']['name'])) {
        $query = $db->query("UPDATE product SET product_categories_id = '$product_categories_id', product_sub_categories_id = '$product_sub_categories_id', title = '$title', short_description = '$short_description', long_description = '$long_description',
        price = '$price', stocks = '$stocks', discount = '$discount', is_featured = '$is_featured', meta_description = '$meta_description', meta_keywords = '$meta_keywords' WHERE id = $id");
    } else {
        $featured_image = $_FILES['images']['name'];
        move_uploaded_file($_FILES['images']['tmp_name'],'../assets/image/product/'.$_FILES['images']['name']);
        $query = $db->query("UPDATE product SET featured_image = '$featured_image', product_categories_id = '$product_categories_id', product_sub_categories_id = '$product_sub_categories_id', title = '$title', short_description = '$short_description', long_description = '$long_description',
        price = '$price', stocks = '$stocks', discount = '$discount', is_featured = '$is_featured', meta_description = '$meta_description', meta_keywords = '$meta_keywords' WHERE id = $id");
    }
    if($query) {
        header('location: view-product.php?id='.$id.'&success=true&message='.urlencode('product has been updated'));
    }
}



function product_categories($parent,$is_featured) {
    global $db;
    $check = $db->query("SELECT * FROM product_categories WHERE parent = '$parent'");
    if($check->num_rows > 0) {
        header('location: add-new-categories.php?success=false&message='.urlencode('Category already exist'));
    } else {
        if(empty($_FILES['images']['name'])) {
            $query = $db->query("INSERT INTO product_categories (images,parent,is_featured) VALUES ('$images','$parent','$featured')");
        } else {
            $images = $_FILES['images']['name'];
            move_uploaded_file($_FILES['images']['tmp_name'],'../assets/image/category/'.$_FILES['images']['name']);
            $query = $db->query("INSERT INTO product_categories (images,parent,is_featured) VALUES ('$images','$parent','$featured')");
        }
        if($query) {
            header('location: add-new-categories.php?success=true&message='.urlencode('New category has been added'));
        }
    }
}

function update_product_categories($id,$parent,$is_featured) {
    global $db;
    if(empty($_FILES['update_images']['name'])) {
        $query = $db->query("UPDATE product_categories SET parent = '$parent', is_featured = '$is_featured' WHERE id = $id");
    } else {
        $images = $_FILES['update_images']['name'];
        move_uploaded_file($_FILES['update_images']['tmp_name'],'../assets/image/category/'.$_FILES['update_images']['name']);
        $query = $db->query("UPDATE product_categories SET images = '$images', parent = '$parent', is_featured = '$is_featured' WHERE id = $id");
    }
    if($query) {
        header('location: add-new-categories.php?success=true&message='.urlencode('New category has been added'));
    }
}

function product_sub_categories($product_categories_id,$child) {
    global $db;
    $check = $db->query("SELECT * FROM product_sub_categories WHERE product_categories_id = '$product_categories_id' AND child = '$child'");
    if($check->num_rows > 0) {
        header('location: add-new-sub-categories.php?success=false&message='.urlencode('Sub category already exist'));
    } else {
        $query = $db->query("INSERT INTO product_sub_categories (product_categories_id,child) VALUES ('$product_categories_id','$child')");
        if($query) {
            header('location: add-new-sub-categories.php?success=true&message='.urlencode('New sub category has been added'));
        }
    }
}

function update_sub_categories($id,$update_product_categories_id,$update_child) {
    global $db;
    $query = $db->query("UPDATE product_sub_categories SET product_categories_id = '$update_product_categories_id', child = '$update_child' WHERE id = '$id'");
    if($query) {
        header('location: add-new-sub-categories.php?success=true&message='.urlencode('Sub category has been updated'));
    }
}

function count_product($id) {
    global $db;
    $query = $db->query("SELECT * FROM product WHERE product_sub_categories_id = $id");
    return $query->num_rows;
}

function count_marital($marital) {
    global $db;
    $query = $db->query("SELECT * FROM accounts WHERE marital = '$marital' ");
    return $query->num_rows;
}

function get_all_maritals() {
    global $db;
    $query = $db->query("SELECT * FROM accounts GROUP BY marital");
    return $query;
}

function getAllReviewsById($product_name) {
    global $db;
    $query = $db->query("SELECT * FROM reviews WHERE product_name = '$product_name'");
    return $query;
}


function getAllReviews(){
     global $db;
    $query = $db->query("SELECT * FROM reviews");
    return $query;
}


function deleteReview($id) {
    global $db;

    $check = $db->query("SELECT * FROM reviews WHERE id= '$id' ");

    if($check->num_rows > 0) {   
       $query = $db->query("DELETE FROM reviews WHERE id = $id");
        if($query) {
                    echo json_encode(array("response" => 'valid'));
        }
        else{
                echo json_encode(array("response" => 'invalid'));
        }
    } else {
                echo json_encode(array("response" => 'notfound'));
      
    }

}


function count_reviewsbyProduct($product_name) {
    global $db;
    $query = $db->query("SELECT * FROM reviews WHERE product_name = '$product_name' ");
    return $query->num_rows;
}

function validateReviewExisting($transcId){
       global $db;
    $check = $db->query("SELECT * FROM reviews WHERE transaction_id= '$transcId' ");

    if($check->num_rows > 0) {   
      return false;
    } else {
      return true;
    }
}

function save_reviews($transcId,$transcName,$name,$email,$ratings,$reviews,$fileName,$fileType){
     global $db;

    $check = validateReviewExisting($transcId);
        
    if($check === false){

        echo json_encode(array("sucess" => 'exist'));

    } 
    
    else {
        $query = $db->query("INSERT INTO reviews (transaction_id,product_name,name,email,ratings,comment,filename,filetype) VALUES ('$transcId','$transcName','$name','$email','$ratings','$reviews','$fileName','$fileType')");
        if($query) {
                 echo json_encode(array("success" => 'valid'));
        }
        else{
              echo json_encode(array("success" => 'invalid'));
        }
    }


   
}

function get_staff($id)
{
    global $db;
    $query = $db->query("SELECT *   FROM accounts WHERE id = '$id' ");
    $data=  $query->num_rows;
    if($data > 0){
        $get_record = $query->fetch_assoc();
        unset($get_record['password']);
        
        echo json_encode($get_record);
    }
}



function  addNewStaff($email, $fname, $lname, $username, $password, $contact, $bday, $age,$gender){
    global $db;

    $check = $db->query("SELECT * FROM accounts WHERE email= '$email' OR username = '$username'");

    if($check->num_rows > 0){
        echo json_encode(array("success" => 'exist'));
    }
    else{

        $hashPassWord = password_hash($password, PASSWORD_DEFAULT);

        $month = date('n');
        $year = date('Y');

        $query = $db->query("INSERT INTO accounts (firstname,surname,email,contact,birthday,age,gender,username,password,role,status,month,year,verify_code,is_verify) VALUES ('$fname','$lname','$email','$contact','$bday','$age','$gender','$username','$hashPassWord','2',0,$month,$year,'','')");
        if ($query) {
            echo json_encode(array("success" => 'valid'));

        } else {
            echo $db->error;
            exit;
        }
      
    }
}


function updateStaff($id,$email, $fname, $lname, $username, $contact, $bday, $age,$gender){
    global $db;

    $check = $db->query("SELECT * FROM accounts WHERE id = $id");

    if($check->num_rows > 0){

        $query = $db->query("UPDATE  accounts SET firstname = '$fname',surname= '$lname', email = '$email', contact = '$contact', birthday = '$bday', age = '$age', gender = '$gender', username = '$username' WHERE id = '$id' ");
        if ($query) {
            echo json_encode(array("success" => 'valid'));

        } else {
            echo $db->error;
            exit;
        }
    }
    else{

        echo json_encode(array("success" => 'not-exist'));

           
    }
}

function delete_staff($id)
{
    global $db;
    $check = $db->query('SELECT * FROM accounts WHERE id = '.$id.' ');

    if($check->num_rows > 0){
        $query = $db->query('DELETE FROM accounts WHERE id = '.$id.' ');
        if($query){
            echo json_encode(array("status" => 'valid'));
        }
        else{
            echo json_encode(array("status" => 'invalid'));
        }
    }
    else{
        echo json_encode(array("status" => 'not-exist'));
    }
}







function validate($data) { // Input fields validator to avoid XSS and SQL Injection
   $data = trim($data); // remove extra white space(s)
   $data = stripslashes($data); // remove forward and back slashes
   $data = htmlspecialchars($data); // remove special characters
   return $data;
}



function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds = $time_elapsed;
    $minutes = round($time_elapsed / 60);
    $hours = round($time_elapsed / 3600);
    $days = round($time_elapsed / 86400);
    $weeks = round($time_elapsed / 604800);
    $months = round($time_elapsed / 2600640);
    $years = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        return "just now";
    }
    //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "one minute ago";
        } else {
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            return "an hour ago";
        } else {
            return "$hours hrs ago";
        }
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            return "yesterday";
        } else {
            return "$days days ago";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            return "a week ago";
        } else {
            return "$weeks weeks ago";
        }
    }
    //Months
    else if ($months <= 12) {
        if ($months == 1) {
            return "a month ago";
        } else {
            return "$months months ago";
        }
    }
    //Years
    else {
        if ($years == 1) {
            return "one year ago";
        } else {
            return "$years years ago";
        }
    }
}