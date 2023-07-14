<?php include 'layouts/header.php';?>
<?php if(get_order_details($_GET['reference'])->num_rows == 0) {
	header('location:transaction.php');
}
?>

<?php foreach(get_order_details($_GET['reference']) as $orders) { ?>
<?php $transaction_id    = $orders['id']; ?>
<?php $shipping_trigger  = $orders['shipping_trigger']; ?>
<?php $method_of_payment = $orders['method_of_payment']; ?>
<?php $status   		 = $orders['status']; ?>
<?php $receipt_image	 = $orders['receipt_image']; ?>
<?php $accounts_id	     = $orders['accounts_id']; ?>
<?php $receipt_image	 = $orders['receipt_image']; ?>
<?php } ?>
<?php $query         = account_details($accounts_id)?>
<?php $user          = $query->fetch_assoc();?>
<?php $billingQuery  = account_billing_address($accounts_id)?>
<?php $billing       = $billingQuery->fetch_assoc();?>
<?php $shippingQuery = account_shipping_address($accounts_id)?>
<?php $shipping      = $shippingQuery->fetch_assoc();?>

<?php if(isset($_GET['reference']) && isset($_GET['status'])) { ?>
    <?php update_transaction_status($_GET['reference'],$_GET['status'], $user['id'], $_GET['product']); ?>
    
<?php } ?>
<body>

    <!-- Main navbar -->
    <?php include 'layouts/top-navigation.php';?>
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <?php include 'layouts/navigation.php';?>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-light">
                <div class="page-header-content d-sm-flex">
                    <div class="page-title">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Product</span> -
                            Transaction</h4>
                    </div>
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-sm-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            <a href="#" class="breadcrumb-item">Dashboard</a>
                            <a href="#" class="breadcrumb-item">Products</a>
                            <a href="#" class="breadcrumb-item active">Transaction</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

                <div class="card">
                    <div class="card-body">

                            <?php
                            $_SESSION['product_order'] = []; // Initialize the session variable as an empty string
                            $_SESSION['product_item'] = '';
                            $_SESSION['product_price'] = '';

                            foreach (get_order_details($_GET['reference']) as $orders) {

                                $product = [
                                    'product' => $orders['product'],
                                    'price' => $orders['price']
                                ];
                                $_SESSION['product_order'][] = $product;
                                $_SESSION['product_item'] .= $orders['product'].',';
                                $_SESSION['product_price'] .= $orders['price'].',';

                            }
                            ?>

                    
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <h5 class="sidebar-title">Billing Address</h5>
                                <label>
                                    Name: <?=$user['firstname']?> <?=$user['surname']?> <br>
                                    Contact: <?=$user['contact']?><br>
                                    Contact: <?=$user['email']?> <br>
                                    Address: <?=$billing['address']?> <?=$billing['state']?> <br><?=$billing['city']?>
                                    <?=$billing['country']?>, <?=$billing['zip']?> <br>
                                </label>
                            </div>

                            <?php if($shipping_trigger == 'Yes') {  ?>
                            <div class="col-md-4 col-12">
                                <h5 class="sidebar-title">Shipping Address</h5>
                                <label>
                                    Name: <?=$shipping['shipping_firstname']?> <?=$shipping['shipping_surname']?> <br>
                                    Contact: <?=$shipping['contact']?><br>
                                    Address: <?=$shipping['address']?> <?=$shipping['state']?>
                                    <br><?=$shipping['city']?>
                                    <?=$shipping['country']?>, <?=$shipping['zip']?> <br>
                                </label>
                            </div>
                            <?php } else { ?>
                            <div class="col-md-4 col-12">
                                <h5 class="sidebar-title">Shipping Address</h5>
                                <label>
                                    Name: <?=$user['firstname']?> <?=$user['surname']?> <br>
                                    Contact: <?=$user['contact']?><br>
                                    Contact: <?=$user['email']?> <br>
                                    Address: <?=$billing['address']?> <?=$billing['state']?> <br><?=$billing['city']?>
                                    <?=$billing['country']?>, <?=$billing['zip']?> <br>
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
                                     <?php } elseif($status == 3) { ?>
                                    Out For Delivery
                                    <?php } else { ?>
                                        
                                    Cancelled
                                    <?php } ?>


                                    <br>
                                    Reference: <?=$_GET['reference']?>
                                    <br>
                                    Method of Payment: <?=$method_of_payment?>
                                    <br>
                                    <div class="btn-group">
                                    <?php if($method_of_payment == 'Bank Transfer') { ?>
                                        <a href="../assets/image/receipt/<?=$receipt_image?>" download class="btn btn-sm btn-info">Download Receipt</a>
                                    <?php } ?>
                                    <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Update Status
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="orders.php?reference=<?=$_GET['reference']?>&status=0&product=<?= $_GET['product']?>">Pending</a>
                                        <a class="dropdown-item" href="orders.php?reference=<?=$_GET['reference']?>&status=1&product=<?= $_GET['product']?>">Processing</a>
                                        <a class="dropdown-item" href="orders.php?reference=<?=$_GET['reference']?>&status=2&product=<?= $_GET['product']?>">Completed</a>
                                        <a class="dropdown-item" href="orders.php?reference=<?= $_GET['reference'] ?>&status=3&product=<?= $_GET['product']?>">Out For Delivery</a>
                                          <a class="dropdown-item" href="orders.php?reference=<?=$_GET['reference']?>&status=4&product=<?= $_GET['product']?>">Cancelled</a>
                                    </div>
                                    </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
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
							<?php foreach(get_order_details($_GET['reference']) as $orders) { ?>
							<?php $total += $orders['price'] * $orders['quantity']?>

							<tr>
								<td style="width:1px"><?=$i++?></td>
								<td><?=$orders['product']?></td>
								<td style="width:1px;text-align:right">AED&nbsp;<?=number_format($orders['price'],2)?></td>
								<td style="width:1px;text-align:center"><?=$orders['quantity']?></td>
								<td style="width:1px;text-align:right">
									AED&nbsp;<?=number_format($orders['price'] * $orders['quantity'],2)?></td>
							</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan=3></td>
								<td></td>
								<td style="width:1px;text-align:right">AED&nbsp;<?=number_format($total,2)?></td>
							</tr>
						</tfoot>
					</table>
                    </div>
                </div>
            </div>
            <!-- /content area -->


            <!-- Footer -->
            <?php include 'layouts/footer.php';?>
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->
    <?php include 'layouts/scripts.php';?>
    <!-- Theme JS files -->
    <script src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>
    <script src="assets/js/demo_pages/datatables_responsive.js"></script>
</body>


</html>