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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
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
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<script>
  // Enable pusher logging - don't include this in production
  // Pusher.logToConsole = true;

  var pusher = new Pusher('49f045793f7158a8e0e3', {
    cluster: 'ap1'
  });

  pusher.connection.bind('connected', function () {
    console.log('Pusher connected');
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function (data) {
    // console.log('Data received');
    // console.log(data);
    
    // Extract the user ID from the data object received from Pusher
    var userId = data.user_id;
    
    const formData = new FormData();
    formData.append('user_id', userId);
    
    // Perform the AJAX call using the user ID
    $.ajax({
      url: './mail/get-user.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      async: false,
      cache: false,
      dataType: 'json',
      success: function (response) {

    
        // console.log(response, 'get response');
        // console.log(data, 'get data');
        if (response.success === true) {
        
        let getStatus = Number(data.status);
        let getStatusColor = getStatus === 0 ? 'text-warning': getStatus === 4 ? 'text-danger' : 'text-success';
        

        document.getElementById("reference").innerText = data.reference; // Replace with the appropriate reference value
        document.getElementById("status").innerText = getStatus === 0 ? 'Pending' : getStatus === 1 ? 'Processing' : getStatus === 2 ? 'Completed' : getStatus === 3 ? 'Out For Delivery' : 'Cancelled'; // Replace with the appropriate status value
        document.getElementById('status').classList.add(getStatusColor);
        document.getElementById('badge').innerText = data.count ?? 0;
        document.getElementById('product').innerHTML = data.product.map((item)=> {
          return `
            <td><span class="pr-2">${item.product}</span></td>
            <td><span>${item.price}</span></td>
            <tr>
          `

        });
 
                                

      // Open the modal using JavaScript
         $('#myModal').modal('show');
          
        }
      },
      error: function (response) {
        console.log('Failed');
      }
    });
  });


   function closeModal() {
      // Close the modal using JavaScript
      $('#myModal').modal('hide');
      location.reload();
    }
</script>


</head>


  