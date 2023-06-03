<?php include 'layouts/header.php';?>
<?php
    if(isset($_POST['btn-track-now'])) {
        global $db;
        $reference = $db->real_escape_string($_POST['reference']);
        if(get_order_details($reference)->num_rows == 0) {
            header('location:track-orders.php');
        }
        ?>
        <?php foreach(get_order_details($reference) as $orders) { ?>
            <?php $shippingTrack_trigger  = $orders['shipping_trigger']; ?>
            <?php $method_of_payment = $orders['method_of_payment']; ?>
            <?php $status   		 = $orders['status']; ?>
            <?php $receipt_image	 = $orders['receipt_image']; ?>
            <?php $accounts_id	     = $orders['accounts_id']; ?>
        <?php } ?>
        <?php $query         = account_details($accounts_id)?>
        <?php $userTrack          = $query->fetch_assoc();?>
        <?php $billingQuery  = account_billing_address($accounts_id)?>
        <?php $billingTrack       = $billingQuery->fetch_assoc();?>
        <?php $shippingQuery = account_shipping_address($accounts_id)?>
        <?php $shippingTrack      = $shippingQuery->fetch_assoc();?>
        <?php $detect = true;?>
    <?php } else { ?>
        <?php $detect = false;?>
    <?php } ?>
<body>
    <div class="site-wrapper">
        <?php include 'layouts/navigation.php';?>
        <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Track Your Order</li>
                </ol>
            </div>
        </nav>
        <!-- Promotion Block 2 -->
        <?php if($detect == 'false') { ?>
            <div class="page-section sp-inner-page">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-12">
						<h5 class="sidebar-title" >Billing Address</h5>
						<label>
							Name: <?=$userTrack['firstname']?> <?=$userTrack['surname']?> <br>
							Contact: <?=$userTrack['contact']?><br>
							Contact: <?=$userTrack['email']?> <br>
							Address: <?=$billingTrack['address']?> <?=$billingTrack['state']?> <br><?=$billingTrack['city']?>
							<?=$billingTrack['country']?>, <?=$billingTrack['zip']?> <br>
						</label>
					</div>

					<?php if($shippingTrack_trigger == 'Yes') {  ?>
						<div class="col-md-4 col-12">
							<h5 class="sidebar-title" >Shipping Address</h5>
							<label>
								Name: <?=$shippingTrack['shipping_firstname']?> <?=$shippingTrack['shipping_surname']?> <br>
								Contact: <?=$shippingTrack['contact']?><br>
								Address: <?=$shippingTrack['address']?> <?=$shippingTrack['state']?> <br><?=$shippingTrack['city']?>
								<?=$shippingTrack['country']?>, <?=$shippingTrack['zip']?> <br>
							</label>
						</div>
					<?php } else { ?>
						<div class="col-md-4 col-12">
							<h5 class="sidebar-title" >Shipping Address</h5>
							<label>
								Name: <?=$userTrack['firstname']?> <?=$userTrack['surname']?> <br>
								Contact: <?=$userTrack['contact']?><br>
								Contact: <?=$userTrack['email']?> <br>
								Address: <?=$billingTrack['address']?> <?=$billingTrack['state']?> <br><?=$billingTrack['city']?>
								<?=$billingTrack['country']?>, <?=$billingTrack['zip']?> <br>
							</label>
						</div>
					<?php } ?>

					<div class="col-md-4 col-12">
						
						<h5 class="sidebar-title">Order Details</h5>
						<label>
							Status: 
							<?php if($status == 0) {  ?> 
								Pending
							<?php } elseif($status == 1) { ?>
								Processing
							<?php } elseif($status == 2) { ?>
								Completed
							<?php } else { ?>
								Cancelled
							<?php } ?>
							
							
							<br>
							Reference: <?=$reference?>
							<br>
						</label>
					</div>
				</div>
				<br>
				<div class="col-12">
					<table class="table table-bordered">
						<thead class="thead-light">
							<tr>
								<th>#</th>
								<th>Product</th>
								<th style="width:1px;text-align:center">Price</th>
								<th style="width:1px;text-align:center">Items</th>
								<th style="width:1px;text-align:center">Total</th>
							</tr>
						</thead>

						<tbody>
							<?php $i=1;?>
							<?php $total = 0?>
							<?php foreach(get_order_details($reference) as $orders) { ?>
							<?php $total += $orders['price'] * $orders['quantity']?>

							<tr>
								<td style="width:1px"><?=$i++?></td>
								<td><?=$orders['product']?></td>
								<td style="width:1px;text-align:right">₱<?=number_format($orders['price'],2)?></td>
								<td style="width:1px;text-align:center"><?=$orders['quantity']?></td>
								<td style="width:1px;text-align:right">
									₱<?=number_format($orders['price'] * $orders['quantity'],2)?></td>
							</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan=3></td>
								<td></td>
								<td style="width:1px;text-align:right">₱<?=number_format($total,2)?></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
        <?php } else { ?>
        <main class="page-section pb--10 pt--50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                        <!-- Login Form s-->
                        
                        <form method="POST">

                            <div class="login-form">
                                <div class="row">
                                    <div class="col-md-12 col-12 mb--20">
                                        <label>Reference</label>
                                        <input class="mb-0" type="text" name="reference" required>
                                    </div>
                                   
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center flex-wrap">
                                            <button type="submit" name="btn-track-now" class="btn btn-success text-white w-100">Track Now</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php } ?>


        <!-- Slider bLock 4 -->

        <?php include 'layouts/footer.php';?>
    </div>
    <?php include 'layouts/scripts.php';?>
</body>

</html>