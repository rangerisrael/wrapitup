<?php include 'config/functions.php';?>
<?php


$fileName = $_FILES["upload"]["name"];
$fileType = $_FILES["upload"]["type"];

if(str_contains($_FILES['upload']['type'],'video')){
  $vid_dir = './assets/review/video-clip/';
    if(!is_dir($vid_dir)){
    mkdir($vid_dir);
  }
 
    //  if(file_exists($vid_dir.validate($_POST['orderId']))){
    //      unlink($vid_dir.validate($_POST['orderId']));
    //  }
  
     $vid_file = $vid_dir . basename($_FILES["upload"]["name"]);
     move_uploaded_file($_FILES["upload"]["tmp_name"], $vid_file);

 save_reviews(validate($_POST['transaction_id']),validate($_POST['transaction_name']),validate($_POST['fname']),validate($_POST['email']),validate($_POST['ratings']),validate($_POST['review']),$fileName,$fileType);

     
  
}
if(str_contains($_FILES['upload']['type'],'image')){
  $img_dir = './assets/review/image/';
    if(!is_dir($img_dir)){
    mkdir($img_dir);
  }
  //  if(file_exists($img_dir.validate($_POST['orderId']))){
  //        unlink($img_dir.validate($_POST['orderId']));
  //    }
  
 
    $img_file = $img_dir . basename($_FILES["upload"]["name"]);
     move_uploaded_file($_FILES["upload"]["tmp_name"], $img_file);

   save_reviews(validate($_POST['transaction_id']),validate($_POST['transaction_name']),validate($_POST['fname']),validate($_POST['email']),validate($_POST['ratings']),validate($_POST['review']),$fileName,$fileType);

  

}




?>
