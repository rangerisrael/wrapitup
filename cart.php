<?php include 'layouts/header.php';?>
<?php if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { ?>
	<?php header('location: products.php?success=true&message='.urlencode('Your cart is empty'))?>
<?php } ?>
<?php if(isset($_POST['update_cart'])) { 
	$id = $_POST['id'];
	$quantity = $_POST['quantity'];
	update_cart($id,$quantity);
}
?>
<body>
    <div class="site-wrapper">
    <?php include 'layouts/navigation.php';?>
    <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
    <div class="container">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </div>
  </nav>
       
  
  <div class="cart_area cart-area-padding sp-inner-page--top">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<form method="POST">
							<!-- Cart Table -->
							<div class="cart-table table-responsive mb--40">
								<table class="table">
									<!-- Head Row -->
									<thead>
										<tr>
											<th class="pro-remove"></th>
											<th class="pro-thumbnail">Image</th>
											<th class="pro-title">Product</th>
											<th class="pro-price">Price</th>
											<th class="pro-quantity">Quantity</th>
											<th class="pro-subtotal">Total</th>
										</tr>

									</thead>
									<tbody>
										<!-- Product Row -->
										<?php $total=0;?>
										<?php foreach($_SESSION['cart'] as $cart) { ?>
											<?php $total += $cart['price'] * $cart['quantity'];?>
											<tr>
												<td class="pro-remove"><a href="?remove-cart=true&id=<?=$cart['id']?>"><i class="far fa-trash-alt"></i></a></td>
												<td class="pro-thumbnail"><a href="javascript:void(0)"><img src="assets/image/product/home-1/product-1.jpg" alt="Product"></a></td>
												<td class="pro-title"><a href="javascript:void(0)"><?=$cart['title']?></a></td>
												<td class="pro-price"><span>AED<?=number_format($cart['price'],2)?></span></td>
												<td class="pro-quantity">
													<div class="pro-qty" style="width:100px">
														<div class="count-input-block">
															<input type="hidden" name="id[]" value="<?=$cart['id']?>">
															<input type="number" id="quantity" name="quantity[]" class="form-control text-center" min=1 max=<?=$cart['stocks']?> value="<?=$cart['quantity']?>">
														</div>
													</div>
												</td>
												<td class="pro-subtotal"><span>AED<?=number_format($cart['price'] * $cart['quantity'],2)?></span></td>
											</tr>
										<?php } ?>
										
										<!-- Product Row -->
									
										<!-- Discount Row  -->
										<tr>
											<td colspan="5" class="actions" style="text-align:right" >
                                                    Sub Total
											</td>
											<td class="actions">
											AED<?=number_format($total,2)?>
											</td>
										</tr>

										<tr>
											<td colspan="6" class="actions">

												<div class="update-block text-end">
                                                    <button type="submit" class="btn" name="update_cart">Update cart</button>
                                                    <a href="checkout.php" class="btn btn-success text-white" name="update_cart">Checkout</a>
												</div>
											</td>
										</tr>
										
									</tbody>
								</table>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
        
        <!-- Slider bLock 4 -->

        <?php include 'layouts/footer.php';?>
    </div>
    <?php include 'layouts/scripts.php';?>
	<script>
		jQuery('#quantity').bind('keypress', function(e) {
			e.preventDefault(); 
		});
	</script>
</body>

</html>