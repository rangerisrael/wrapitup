<?php include 'config/functions.php';?>
<?php 
save_visitors();
if(isset($_GET['add-to-cart']) == true) { 
    add_to_cart_from_links($_GET['id']);
}

if(isset($_GET['remove-cart']) == true) { 
    remove_cart_from_links($_GET['id']);
    header('Location: cart.php?success=true&message='.urlencode('Item has been removed to your cart'));
}

if(isset($_GET['logout']) == true) { 
    logout();
}
if(isset($_GET['method-of-payment']) == 'Stripe') {
    $method_of_payment = $_GET['method-of-payment'];
    $stripe_note = $_GET['stripe_note'];
    $stripe_shipping_trigger = $_GET['stripe_shipping_trigger'];
    $stripeToken = $_GET['stripeToken'];
    $stripeEmail = $_GET['stripeEmail'];
    stripe($stripe_shipping_trigger,$method_of_payment,$stripe_note,$stripeToken,$stripeEmail);
}

if(isset($_GET['search']) == true) {
    $wildcard = urlencode($db->real_escape_string($_GET['wildcard']));
    $category = $db->real_escape_string($_GET['category']);
    get_searched_result($wildcard,$category);
    header('location: search.php?wildcard='.$wildcard.'&category='.$category);
}

?>

<?php if(isset($_SESSION['id'])) { ?>
    <?php $query         = account_details($_SESSION['id'])?>
    <?php $user          = $query->fetch_assoc();?>
    <?php $billingQuery  = account_billing_address($_SESSION['id'])?>
    <?php $billing       = $billingQuery->fetch_assoc();?>
    <?php $shippingQuery = account_shipping_address($_SESSION['id'])?>
    <?php $shipping      = $shippingQuery->fetch_assoc();?>
<?php } ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="index, follow" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Wrap it Up</title>
    <link rel="canonical" href="<?=canonical()?>" />
    <link rel="stylesheet" href="assets/css/plugins.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/image/wrapitup-logo.jpg">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DWTCPK0QT1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-DWTCPK0QT1');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7006703530854355"
     crossorigin="anonymous"></script>
     
     
</head>