<?php include 'layouts/header.php';?>
<?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>
<?php header('location: products.php')?>
<?php } ?>
<?php if(isset($_SESSION['type']) == 'Administrator') { ?>
<?php header('location: login.php')?>
<?php } ?>




<style>
    /* for radio buttonpayment gateway  */

    .radio-toolbar input[type="radio"] {
        opacity: 0;
        position: fixed;
        width: 0;
    }

    .radio-toolbar label {
        display: inline-block;
        background-color: #ddd;
        padding: 10px 20px;
        font-family: sans-serif, Arial;
        font-size: 16px;
        border: 2px solid #444;
        border-radius: 4px;
    }

    .radio-toolbar label:hover {
        background-color: #dfd;
    }

    .radio-toolbar input[type="radio"]:focus+label {
        border: 2px dashed #444;
    }

    .radio-toolbar input[type="radio"]:checked+label {
        background-color: #bfb;
        border-color: #4c4;
    }
</style>

<body>
    <div class="site-wrapper">
        <?php include 'layouts/navigation.php';?>
        <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page">Cart</li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div>
        </nav>


        <form id='billingForm' method="POST">

            <main id="content" class="page-section sp-inner-page checkout-area-padding space-db--20">
                <div class="container">
                    <div class="row">
                        <div class="col-12">

                            <!-- Checkout Form s-->
                            <div class="checkout-form">
                                <div class="row row-40">
                                    <div class="col-lg-7 mb--20">
                                        <!-- Billing Address -->
                                        <div id="billing-form" class="mb-40">
                                            <h4 class="checkout-title">Billing Address</h4>

                                            <div class="row">

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>First Name*</label>
                                                    <input type="text"  
                                                        placeholder="First Name"  name='firstname' >
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Last Name*</label>
                                                    <input type="text"
                                                        placeholder="Last Name" name='lastname' >
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Email Address*</label>
                                                    <input type="email" 
                                                        placeholder="Email Address" name='email' >
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Phone no*</label>
                                                    <input type="text"
                                                        placeholder="Phone number" name='contact' >
                                                </div>



                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Country*</label>
                                                    <select name='country' class="nice-select">
                                                        <option value="PH">Philippines</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Town/City*</label>
                                                    <input type="text" placeholder="Town/City" name='city'/>
                                                       
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>State*</label>
                                                    <input type="text" placeholder="State" name='state' />
                                                       
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Zip Code*</label>
                                                    <input type="text" placeholder="Zip Code" name='zip'/>
                                                        
                                                </div>

                                                <div class="col-12 mb--20">
                                                    <label>Address*</label>
                                                    <input type="text" placeholder="Address line 1"  name='address'/>
                                                      
                                                </div>

                                               
                                            </div>

                                        </div>

                                        <!-- Shipping Address -->
                                        <div id="shipping-form" class="mb--40">
                                            <h4 class="checkout-title">Shipping Address</h4>

                                            <div class="row">

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>First Name*</label>
                                                    <input type="text" readonly
                                                        value="<?=$shipping['shipping_firstname']?>"
                                                        placeholder="First Name">
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Last Name*</label>
                                                    <input type="text" value="<?=$shipping['shipping_surname']?>"
                                                        placeholder="Last Name" readonly>
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Email Address*</label>
                                                    <input type="email" value="<?=$user['email']?>"
                                                        placeholder="Email Address" readonly>
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Phone no*</label>
                                                    <input type="text" value="<?=$shipping['contact']?>"
                                                        placeholder="Phone number" readonly>
                                                </div>



                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Country*</label>
                                                    <select class="nice-select">
                                                        <option value="PH">Philippines</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Town/City*</label>
                                                    <input type="text" placeholder="Town/City"
                                                        value="<?=$billing['city']?>" readonly>
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>State*</label>
                                                    <input type="text" placeholder="State"
                                                        value="<?=$billing['state']?>" readonly>
                                                </div>

                                                <div class="col-md-6 col-12 mb--20">
                                                    <label>Zip Code*</label>
                                                    <input type="text" placeholder="Zip Code"
                                                        value="<?=$billing['zip']?>" readonly>
                                                </div>

                                                <div class="col-12 mb--20">
                                                    <label>Address*</label>
                                                    <input type="text" placeholder="Address line 1"
                                                        value="<?=$billing['address']?>" readonly>
                                                </div>

                                            </div>

                                        </div>



                                    <div class='col-md-12 col-12 mb--20'>
                                        <h3 class='text-dark'>Delivery Options</h3>
                                        <div>
                                            <span><input checked type="radio" value='bringitthere'  name="receive_item" onclick="isRadioCheck(this,'#getReceiveItem')" > </span>
                                            <span class='text-dark'>I will bring it there</span>
                                        
                                        </div>
                                        <div>
                                        <span><input type="radio" value='pickitupadress'   name="receive_item" onclick="isRadioCheck(this,'#getReceiveItem')"> </span>
                                        <span class='text-dark'>Pick it up from my address</span>

                                        <input type="hidden" name="getReceiveItem" id='getReceiveItem' value='0'>
                                       
                                        </div>

                                        <div >
                                        <span><input checked type="radio" value='pickitup'  name="wrap_item" onclick="isRadioCheck(this,'#getWrapItem')"> </span>
                                            <span class='text-dark'>I will pick it up</span>
                                        </div>
                                        <div >
                                        <span><input type="radio" value='deliveraddress'  name="wrap_item" onclick="isRadioCheck(this,'#getWrapItem')"> </span>
                                        <span class='text-dark'>Deliver it to my address</span>
                                       
                                        <input type="hidden" name="getWrapItem" id='getWrapItem' value='0'>

                                        </div>
                                    </div>
                                   




                                        <div class="order-note-block mt--30">
                                            <label for="order-note">Order notes</label>
                                            <textarea id="order-note" cols="30" rows="10" name="notes"
                                                class="order-note"
                                                placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="row">

                                            <!-- Cart Total -->
                                            <div class="col-12">
                                                <div class="checkout-cart-total">
                                                    <h2 class="checkout-title">YOUR ORDER</h2>
                                                    <h4 class="mb--20">Product <span>Total</span></h4>

                                                    <ul>
                                                        <?php $total = 0;?>
                                                        <?php foreach($_SESSION['cart'] as $cart) { ?>
                                                        <?php $total += $cart['price'] * $cart['quantity']?>
                                                        <li>
                                                            <span class="left"><?=$cart['title']?> X
                                                                <?=$cart['quantity']?></span>
                                                            <span
                                                                class="right">AED<?=number_format($cart['price'] * $cart['quantity'],2)?></span>
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                 
                                                    <p>Sub Total <span id='subTotal'>AED<?=number_format($total,2)?></span></p>
                                                    <p>Shipping Fee <span id='shipping_fee'>AED<?=number_format(0,2)?></span></p>
                                                 <input type="hidden" name="ship_fee" id="ship_fee" value='0'>                  
                                                    <h4>Grand Total <span id='grad_total'>AED<?=number_format($total + 0,2)?></span></h4>
                                                
                                                 <input type="hidden" name="grad_fee" id="grad_fee">                  

                                                    <div class="mb--25 mt--25">
                                                        <i class="fas fa-cash2 fa-fw"></i>
                                                        <div class="radio-toolbar">
                                                            <input type="radio" id="radioCOD" class="method"
                                                                name="method_of_payment" value="Cash On Delivery"
                                                                checked>
                                                            <label for="radioCOD"><img style="width:60px"
                                                                    src="assets/image/payment/cod.png" alt=""></label>

                                                            <!-- <input type="radio" id="radioBDO" class="method"
                                                                name="method_of_payment" value="Bank Transfer">
                                                            <label for="radioBDO"><img style="width:60px"
                                                                    src="assets/image/payment/bdo.png" alt=""></label>

                                                            <input type="radio" id="radioStripe" class="method"
                                                                name="method_of_payment" value="Stripe">
                                                            <label for="radioStripe"><img style="width:60px"
                                                                    src="assets/image/payment/stripe.png"
                                                                    alt=""></label>
 -->
                                                        </div>
                                                       <!--  <div id="bdo-details" hidden class="mt--10">
                                                            <div class="alert alert-warning">
                                                                <b style="text-transform:uppercase">Transfer your payment to this Account</b> <br>
                                                                
                                                                <label for="">Account Number</label>
                                                                <label class="">109351130135</label>
                                                                <br>
                                                                <label for="">Account Name</label>
                                                                <label class="">Ronald Matutino</label>
                                                                <br>
                                                                <label for="">Bank</label>
                                                                <label class="">Unionbank</label>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    
                                                    <div class="term-block">
                                                        <input type="checkbox" name='accept_terms2' id="accept_terms2" value='no'>
                                                        <label for="accept_terms2">Verify order details</label>
                                                    </div>
                                                    <button type="submit" name="btn_place_order" id="place"
                                                        class="btn btn-success text-white w-100">Place Oder</button>
        </form>
        <!-- <form method="GET">
            <input type="hidden" name="method-of-payment" value="Stripe">
            <input type="hidden" name="stripe_note" id="stripe_note">
            <input type="hidden" name="stripe_shipping_trigger" value="No" id="stripe_shipping_trigger">
            <div id="pay-stripe">
                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="<?php echo $stripe['publishable_key']; ?>" data-description="Welcome to Petmark"
                    data-amount="<?=number_format($total,2,'','')?>" data-currency="PHP"
                    data-email='<?=$user['email']?>' data-locale="auto"></script>
            </div>
        </form> -->
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </main>

    </form><!-- Slider bLock 4 -->

    <?php include 'layouts/footer.php';?>
    </div>
    <?php include 'layouts/scripts.php';?>

    <script>



 function isRadioCheck(radio,selected) {
  if (radio.checked) {

    console.log(selected,'getselected')

    console.log(radio.value,'radio value')
  
    
      $(selected).val(radio.value);
      // Here you can perform further actions with the selected value
    }

    let getSelectedReceive = $('#getReceiveItem').val();
    let getSelectedWrapItem = $('#getWrapItem').val();

   if(getSelectedReceive === 'bringitthere' && getSelectedWrapItem ==='deliveraddress' || getSelectedReceive === 'pickitupadress' && getSelectedWrapItem ==='pickitup'){
                $('#shipping_fee').text('AED 10.00');
                $('#ship_fee').val('10.00');
               const defaultTotal = $('#grad_total').text().replace('AED','');
              const newTotal = parseFloat(defaultTotal) + 10;
                $('#grad_total').text(`AED ${newTotal}`);
                $('#grad_fee').val(`AED ${newTotal}`);
                
    }
   if(getSelectedReceive === 'pickitupadress' && getSelectedWrapItem ==='deliveraddress'){
                $('#shipping_fee').text('AED 20.00');
                $('#ship_fee').val('20.00');
                const defaultTotal = $('#grad_total').text().replace('AED','');

                 
                const newTotal = parseFloat(defaultTotal) + 20;
                $('#grad_total').text(`AED ${newTotal}`);
                $('#grad_fee').val(`AED ${newTotal}`);
    }

 if(getSelectedReceive === 'bringitthere' && getSelectedWrapItem ==='pickitup'){

                $('#shipping_fee').text('AED 0.00');
                $('#ship_fee').val('0.00');

                const gradDefault = $('#subTotal').text();
               $('#grad_total').text(gradDefault);
                $('#grad_fee').val(`AED ${gradDefault}`);
  }



  }

    $('#shipAddress').hide();

  
            $('#billingForm').submit(function(e){
                e.preventDefault();
               
                const formList =  document.getElementById('billingForm');
                const formData = new FormData(formList);

                let data ={};

                for (const pair of formData) {
                    data[pair[0]] = pair[1];
                }


                // console.log(data,'get data')

               $.ajax({
                url: 'checkout-transaction.php',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                dataType: 'json',
                success: function (response) {

                  
                
                   
                    if(response.success === true){

                             
                        const emailData = {
                            "email":response.email,
                            htmlSrc:`
                            <div style="max-width:480px; margin: 0 auto;">
                                <div style="text-align: center;">
                                    <div style="float: left;">
                                        <img style="border-radius: 50%;" src="https://wrapitup.store/assets/image/wrapitup-logo.jpg" width="80" height="80" />
                                        <p style='font-weight:600;'>Wrapitup</p>
                                    </div>
                                    <div>
                                    <h4>You can track order by using refference number or login you generated account in the system</h4>
                                        <h3>Refference #: ${response.ref}</h3>
                                        <h3>Email: ${response.email}</h3>
                                        <h3 style="text-align:center;">Your password</h3>
                                        <h2 style="text-align:center;margin-left:100px;">${response.passcode}</h2>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                                </div>`
                            }



                             $.ajax({
                                url: './mail/mail-setup.php',
                                type: "POST",
                                data: JSON.stringify(emailData),
                                processData: false,
                                contentType: false,
                                async: false,
                                cache: false,
                                success: function (response) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Order sent succesfully',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                setTimeout(() => {

                                    location.href = 'my-account.php';

                                }, 1000);

                            
                                },
                                error: function (response) {
                                console.log("Failed");
                                }
                            
                            });
                    }
                    

                },
                error: function (response) {
                  console.log("Failed");
                }
            
            });

               
            })
 

        
    </script>
    <script>
        $('#pay-stripe').hide();

        $('.method').click(function () {
            if ($('#radioStripe').is(':checked')) {
                $('#pay-stripe').show();
                $('#place').hide();
            } else {
                $('#pay-stripe').hide();
                $('#place').show();
            }

            if ($('#radioBDO').is(':checked')) {
                $('#bdo-details').attr('hidden',false);
            } else {
                $('#bdo-details').attr('hidden',true);
            }
        });

        $('#order-note').keypress( e => {
            var note = $('#order-note').val();
            $('#stripe_note').val(note)
        })

        

        $('#shiping_address').click(e => {
            if(document.getElementById('shiping_address').checked) {
                var data = 'Yes';
            } else {
                var data = 'No';
            }
            $('#stripe_shipping_trigger').val(data)
        })



    </script>
</body>

</html>