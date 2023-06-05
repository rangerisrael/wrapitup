<?php include 'layouts/header.php';?>
<?php if(!isset($_SESSION['id'])) { 
	header('location:login.php');
}
?>
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
					<?php if($status == 0) { ?>
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
							<input type="hidden" id='fname' name="fname" value=<?=$user['firstname'].' '.$user['surname'] ?> /> 
							<input type="hidden" id='emailed' name="emailed" value=<?=$user['email'] ?> /> 
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

                 



<!-- modal produc review -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="product_review" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Product review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form id='reviewform' class="site-form">
              
									<input type="hidden" id='transcId' name="ref" value='0' >
									<input type="hidden" id='productName' name="productName" value='0' >
                                     
             
               <div class="rating-row py-2">
                     <span class="d-inline">Your Rating</span>
                <span class="rating-widget-block ml-2">
                    <input type="radio" name="star" id="star1" data-count='5' onchange="selectRatings(this)">
                    <label for="star1"></label>
                    <input type="radio" name="star" id="star2" data-count='4' onchange="selectRatings(this)">
                    <label for="star2"></label>
                    <input type="radio" name="star" id="star3" data-count='3' onchange="selectRatings(this)">
                    <label for="star3"></label>
                    <input type="radio" name="star" id="star4" data-count='2' onchange="selectRatings(this)">
                    <label for="star4"></label>
                    <input type="radio" name="star" id="star5" data-count='1' onchange="selectRatings(this)">
                    <label for="star5"></label>
                </span>
										<input type="hidden" id='getRating' value='0'>

                </div>
                                         
                                                <div class="row">
                                                
                                                     <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="message">Comment</label>
                                                            <textarea name="message" id="message" cols="30" rows="10"  maxlength="300"
                                                                class="form-control"></textarea>
                                                        </div>
                                                    </div>

																									  <div class="col-12 d-flex flex-row justify-content-center py-2">
																												  <div class="form-group">
																												<label for="upload">
                                                          	<img src="assets/image/photovid.png" class="img-fluid img-thumbnail" id='photoReview' width='150' height='150' alt="...">
																											     <video class='d-none' width='250' height='250' id='videoReview' controls>
																														<source src='./no.mp4' />
																														Your browser does not support HTML5 video.
																													</video>
																												</label/>
																									
                                                        	</div>
                                                       
                                                    </div>

																										  <div class="col-12 d-flex flex-row justify-content-center py-2">
																												 
                                                        <div class="form-group">
                                                            <label for="upload" class='uploadtitle'>Upload videos or photos</label>
                                                           <input class='d-none' type="file" name="photovid" id="upload" onchange="filePreviewHandler(this)">
                                                        </div>
                                                    </div>

																				

                                            
                                                </div>
					    </div>
				 <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-success" value='Proceed'/>
      </div>
         </form>
  
     
    </div>
  </div>
</div>

<!-- end produc review -->
				<br>
				<div class="col-12 d-none d-sm-block">
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
								<td>
									<div class="d-flex flex-row justify-content-between">
										<?=$orders['product']?>
							
								<?php

							$checkReview = validateReviewExisting($orders["id"]);
						
						if($status ==  2 && $checkReview === true){
									?>

									<button type="button" onclick='getProductId("<?php echo $orders["id"] ?>", "<?php echo $orders["product"] ?>")'  class="btn btn-success" data-toggle="modal" data-target="#product_review">
									Add a review now
									</button>
															
								

									<?php
									}

									?>

									</div>
							</td>
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

				<div class='col-12 d-flex flex-row justify-content-end d-block d-sm-none px-0'>
										<table class="table table-bordered myaccount-table table-responsive text-center">
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
								<td>
									<div class="d-flex flex-row justify-content-between">
										<?=$orders['product']?>
							
								<?php

							$checkReview = validateReviewExisting($orders["id"]);
						
						if($status ==  2 && $checkReview === true){
									?>

									<button type="button" onclick='getProductId("<?php echo $orders["id"] ?>", "<?php echo $orders["product"] ?>")'  class="btn btn-success" data-toggle="modal" data-target="#product_review">
									Add a review now
									</button>
															
								

									<?php
									}

									?>

									</div>
							</td>
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
								<form  method="POST" class="mt--10" enctype="multipart/form-data">

								
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

	<?php include './layouts/footer.php';?>
	</div>
	<?php include 'layouts/scripts.php';?>
	  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	</body>

</html>

<script>

																								function getProductId(id,name){

																							
																								document.getElementById('transcId').value = id;
																								document.getElementById('productName').value = name;
																								
																								}
	
																								function selectRatings(e){
																									
																									document.getElementById('getRating').value = e.dataset.count;
																								}
</script>

		<script>
				


																								function filePreviewHandler(e){
																									const file = e.files[0];
																										const image = document.getElementById('photoReview');
																										const video = document.getElementById('videoReview');
																										const uploadTitle = document.querySelector('.uploadtitle');



																									console.log(file)

																									if(file.type.indexOf('image/') >= 0 ||  file.type.indexOf('video/')  >= 0 ){
																										if(file.type.indexOf('image/') >= 0){
																											
																											image.classList.remove('d-none');
																											video.classList.add('d-none');

																										image.src = URL.createObjectURL(file);
																										uploadTitle.innerHTML = 'Change uploaded photo';

																									
																									}

																							if(file.type.indexOf('video/')  >= 0 && file.size <= 2097152){
																											image.classList.add('d-none');
																											video.classList.remove('d-none');
																											video.src = URL.createObjectURL(file);
																											uploadTitle.innerHTML = 'Change uploaded video';
																											
																											
																							}
																							else{
																									
																									if(file.type.indexOf('video/')  >= 0 && file.size > 2097152){
																											alert('File size is too large');
																											return false;
																									}
																								
																								}
																								
																									}
																									else{
																										alert('Invalid file type');
																										return false;
																									}
																									
																								

																			}

												function renameUpload(
												renameFile,
												newName,
												uploadName,
												type,
												lastModified
											) {
												return new File([renameFile] , `${newName}-${uploadName}`, { type, lastModified });
											}



																			const reviewForm = document.querySelector('#reviewform');
																			
																			reviewForm.addEventListener('submit',function(e){
																				e.preventDefault();


																				let star = document.getElementById('getRating').value;
																				let transaction_id = document.getElementById('transcId').value;
																				let fname = document.getElementById('fname').value;
																				let email = document.getElementById('emailed').value;
																				let pname = document.getElementById('productName').value;

																				// const formData = {
																				// 	orderId:ordId,
																				// 	ratings: star,
																				// 	review: e.target[6].value,
																				// 	upload: e.target[7].files[0],
																				// 	fname:fname,
																				// 	email:email
																				
																				// }
													console.log(e)

													const file = e.target[9].files[0];
													var renameFile = renameUpload(file,pname,file.name,file.type,file.lastModified);

													const formRequest =  new FormData();
													formRequest.append('transaction_id',transaction_id);
													formRequest.append('transaction_name',pname);
													formRequest.append('ratings',star);
													formRequest.append('review',e.target[8].value);
													formRequest.append('upload',renameFile);
													formRequest.append('fname',fname);
													formRequest.append('email',email);


																			 fetch('review.php',{
																					method:'POST',
																					header: {
																						"Content-type": "application/json; charset=UTF-8"
																					},
																					body: formRequest
																				}).then((res) => res.json()).then((data) => {

																					
																					if(data.success === 'valid'){
																						successMessage()
																					}
																					if(data.sucess ===  'exist'){
																						failedMessage('You already submitted your review to this product');
																					}
																					if(data.success === 'invalid'){
																						failedMessage('Opps😔, Sorry there\'s something wrong submitting your review,make sure you inputted valid data')

																					}
																				
																				}).catch((err)=> console.log(err))
																			
																			})
			</script>