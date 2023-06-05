<?php include 'layouts/header.php';?>
<?php if(get_order_details($_GET['reference'])->num_rows == 0) {
	header('location:my-account.php');
}

if(isset($_GET['cancel']) == 'true') {
	cancel($_GET['reference']);
}

?>
<?php foreach(get_order_details($_GET['reference']) as $orders) { ?>
	<?php $shipping_trigger  = $orders['shipping_trigger']; ?>
	<?php $method_of_payment = $orders['method_of_payment']; ?>
	<?php $status   		 = $orders['status']; ?>
	<?php $receipt_image	 = $orders['receipt_image']; ?>
<?php } ?>

<?php 
if(isset($_POST['btn_upload'])) { 
	update_receipt($_GET['reference']);
}
if(isset($_GET['delete']) == true) {
	delete_receipt($_GET['reference']);
}
?>

<body>
	<div class="site-wrapper">
		<?php include 'layouts/navigation.php';?>
		<nav aria-label="breadcrumb" class="breadcrumb-wrapper">
			<div class="container">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="home.php">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">My Account</li>
				</ol>
			</div>
		</nav>
		<!-- Promotion Block 2 -->

		<div class="page-section sp-inner-page">
			<div class="container">
				<div class="mb--10">
				<a href="my-account.php" class="btn btn-success">Back</a>
				<?php if($method_of_payment == 'Stripe'){ ?>
				<?php } else { ?>
					<?php if($status == 1 || $status == 2) { ?>
					<a href="?cancel=true&reference=<?=$_GET['reference']?>" onclick="return confirm('Are you sure you want to cancel this transaction?')"  class="btn btn-danger">Cancel</a>
					<?php } ?>
				<?php } ?>
				</div>
				<div class="row">
					<div class="col-md-4 col-12">
						<h5 class="sidebar-title" >Billing Address</h5>
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
							<h5 class="sidebar-title" >Shipping Address</h5>
							<label>
								Name: <?=$shipping['shipping_firstname']?> <?=$shipping['shipping_surname']?> <br>
								Contact: <?=$shipping['contact']?><br>
								Address: <?=$shipping['address']?> <?=$shipping['state']?> <br><?=$shipping['city']?>
								<?=$shipping['country']?>, <?=$shipping['zip']?> <br>
							</label>
						</div>
					<?php } else { ?>
						<div class="col-md-4 col-12">
							<h5 class="sidebar-title" >Shipping Address</h5>
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
							<?php } else { ?>
								Cancelled
							<?php } ?>
							
							
							<br>
							Reference: <?=$_GET['reference']?>
							<br>
							Method of Payment: <?=$method_of_payment?> 
							<?php if($status == 0 && $method_of_payment == 'Bank Transfer') { ?>
								<?php if($receipt_image == NULL || empty($receipt_image)) { ?>
									<br>
									<a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#receipt" href="javascript:void(0)"><small>Upload Receipt</small></a>
								<?php } else { ?>
									<br>
									<a data-bs-toggle="modal" data-bs-target="#receipt" href="javascript:void(0)"><small>View Receipt</small></a> | <a href="orders.php?reference=R7D0HVEILP&delete=true&success=true&message=<?=urlencode('Receipt has been deleted')?>"><small>Delete Receipt</small></a>
								<?php } ?>
							<?php } ?>
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
							<?php foreach(get_order_details($_GET['reference']) as $orders) { ?>
							<?php $total += $orders['price'] * $orders['quantity']?>

							<tr>
								<td style="width:1px"><?=$i++?></td>
								<td><?=$orders['product']?></td>
								<td style="width:1px;text-align:right">AED<?=number_format($orders['price'],2)?></td>
								<td style="width:1px;text-align:center"><?=$orders['quantity']?></td>
								<td style="width:1px;text-align:right">
									AED<?=number_format($orders['price'] * $orders['quantity'],2)?></td>
							</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan=3></td>
								<td></td>
								<td style="width:1px;text-align:right">AED<?=number_format($total,2)?></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	</div>


	<div class="modal modal-quick-view" id="receipt" tabindex="-1" role="dialog" aria-labelledby="receipt"
         aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content" style="width:400px;margin:auto" >
                <div class="pm-product-details">
              
                    <div class="row">
                      <div class="col-12">
						  	<?php if($receipt_image == NULL || empty($receipt_image)) { ?>
								<form method="POST" class="mt--10" enctype="multipart/form-data">

								
									<div class="form-group">
										<label for="">Account Number</label>
										<label class="form-control">109351130135</label>
									</div>

									<div class="form-group">
										<label for="">Account Name</label>
										<label class="form-control">Ronald Matutino</label>
									</div>

									<div class="form-group">
										<label for="">Bank</label>
										<label class="form-control">Unionbank</label>
									</div>

									<hr>
									
									<div class="form-group">
										<input type="file" class="form-control" name="files" accept="image/x-png,image/gif,image/jpeg"  required>
									</div>
									<div class="form-group">
										<button type="submit" name="btn_upload" class="btn btn-success w-100">Upload</button>
									</div>
								</form>
							<?php } else { ?>
							<img src="assets/image/receipt/<?=$receipt_image?>" class="image-responsive" style="width:100%" alt="">
							<?php } ?>
					  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<!-- Slider bLock 4 -->

	<?php include 'layouts/footer.php';?>
	</div>
	<?php include 'layouts/scripts.php';?>
</body>

</html>