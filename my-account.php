<?php include 'layouts/header.php';?>
<?php if(!isset($_SESSION['customer'])) { 
	header('location:login.php');

}
?>
<?php if(isset($_POST['btn_account_details'])) {
	global $db;
	$firstname = $db->real_escape_string($_POST['firstname']);
	$surname   = $db->real_escape_string($_POST['surname']);
	$email 	   = $db->real_escape_string($_POST['email']);
	$contact   = $db->real_escape_string($_POST['contact']);
	$birthday  = $db->real_escape_string($_POST['birthday']);
	$age   	   = $db->real_escape_string($_POST['age']);
	$gender    = $db->real_escape_string($_POST['gender']);
	$marital   = $db->real_escape_string($_POST['marital']);
	update_account_details($firstname,$surname,$email,$contact,$birthday,$age,$gender,$marital);
}

if(isset($_POST['btn_account_billing'])) {
	global $db;
	$id  	  = $db->real_escape_string($_POST['billing_id']);
	$country  = $db->real_escape_string($_POST['billing_country']);
	$city	  = $db->real_escape_string($_POST['billing_city']);
	$state	  = $db->real_escape_string($_POST['billing_state']);
	$zip	  = $db->real_escape_string($_POST['billing_zip']);
	$address  = $db->real_escape_string($_POST['billing_address']);
	insert_or_update_account_billing_details($id,$country,$city,$state,$zip,$address,'Billing Address');
}

if(isset($_POST['btn_account_shipping'])) {
	global $db;
	$id  	  			= $db->real_escape_string($_POST['shipping_id']);
	$shipping_firstname = $db->real_escape_string($_POST['shipping_firstname']);
	$shipping_surname  	= $db->real_escape_string($_POST['shipping_surname']);
	$contact  			= $db->real_escape_string($_POST['contact']);
	$country  			= $db->real_escape_string($_POST['shipping_country']);
	$city	  			= $db->real_escape_string($_POST['shipping_city']);
	$state	  			= $db->real_escape_string($_POST['shipping_state']);
	$zip	  			= $db->real_escape_string($_POST['shipping_zip']);
	$address  			= $db->real_escape_string($_POST['shipping_address']);
	insert_or_update_account_shipping_details($id,$shipping_firstname,$shipping_surname,$contact,$country,$city,$state,$zip,$address,'Shipping Address');
}

if(isset($_POST['btn_change_password'])) {
	global $db;
	$old_password  	   	   = $db->real_escape_string($_POST['old_password']);
	$new_password 	   	   = $db->real_escape_string($_POST['new_password']);
	$confirm_new_password  = $db->real_escape_string($_POST['confirm_new_password']);
	change_password($old_password,$new_password,$confirm_new_password);
}
$city=empty($billing['city']) ? '' : $billing['city'];
//$city = strlen($billing['city']) > 0 ? $billing['city'] : '';
$state = empty($billing['state']) ? '' : $billing['state'];
$zip = empty($billing['zip']) ? '' : $billing['zip'];
$address = empty($billing['address']) ? '' : $billing['address'];

$fname= empty($shipping['shipping_firstname']) ? '' : $shipping['shipping_firstname'];
$sname = empty($shipping['shipping_surname']) ? '' : $shipping['shipping_surname'];
$cNumber = empty($shipping['contact']) ? '' : $shipping['contact'];
$shipCity = empty($shipping['city']) ? '' : $shipping['city'];
$shipState = empty($shipping['state']) ? '' : $shipping['state'];
$shipZip = empty($shipping['zip']) ? '' : $shipping['zip'];
$shipAddress = empty($shipping['address']) ? '' : $shipping['address'];

?>
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet">
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
			<div class="row">
				<div class="col-12">
					<div class="row">
						<!-- My Account Tab Menu Start -->
						<div class="col-lg-3 col-12">
							<div class="myaccount-tab-menu nav" role="tablist">
								<a href="#dashboad" class="active" data-bs-toggle="tab"><i class="fas fa-tachometer-alt"></i>
									Dashboard</a>

								<a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>

								<a href="#address-edit" data-bs-toggle="tab"><i class="fa fa-map-marker"></i> address</a>

								<a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account Details</a>

								<a href="#change-password" data-bs-toggle="tab"><i class="fa fa-lock"></i> Change Password</a>

								<a href="?logout=true"><i class="fas fa-sign-out-alt"></i> Logout</a>
							</div>
						</div>
						<!-- My Account Tab Menu End -->

						<!-- My Account Tab Content Start -->
						<div class="col-lg-9 col-12 mt--30 mt-lg-0">
							<div class="tab-content" id="myaccountContent">
								<!-- Single Tab Content Start -->
								<div class="tab-pane  show active" id="dashboad" role="tabpanel">
									<div class="myaccount-content">
										<h3>Dashboard</h3>

										<div class="welcome mb-20">
											<p>Hello, <strong><?=!empty($user['firstname']) ? $user['firstname'].' '.$user['surname'] : $user['username']?></strong> </p>
										</div>

										<p class="mb-0">From your account dashboard. you can easily check &amp; view your
											recent orders, manage your shipping and billing addresses and edit your
											password and account details.</p>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane " id="orders" role="tabpanel">
									<div class="myaccount-content">
										<h3>Orders</h3>

										<div class="myaccount-table table-responsive text-center">
											<table class="table " id="myTable">
												<thead class="">
												<tr>
													<th>No</th>
													<th>Reference</th>
													<th>Mode of Payment</th>
													<th>Date</th>
													<th style="width:1px">Status</th>
													<th style="width:1px">Total</th>
													<th style="width:1px">Items</th>
													<th style="width:1px"></th>
												</tr>
												</thead>

												<tbody>
													<?php $i=1;?>
													<?php foreach(my_orders() as $orders) { ?>
														<tr>
															<td><?=$i++?></td>
															<td><?=$orders['reference']?></td>
															<td><?=$orders['method_of_payment']?></td>
															<td><?=$orders['created_at']?></td>
															<td>
																<?php 
																	if($orders['status'] == 0) {
																		echo 'Pending';
																	} elseif($orders['status'] == 1) {
																		echo 'Processing';
																	} elseif($orders['status'] == 2) {
																		echo 'Completed';
																	} else {
																		echo 'Cancelled';
																	}
																?>
															</td>
															<td>AED&nbsp;<?=number_format($orders['total'],2)?></td>
															<td><?=$orders['items']?></td>
															<td><a href="orders.php?reference=<?=$orders['reference']?>" class="">View</a></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane " id="address-edit" role="tabpanel">
									<div class="myaccount-content">
										<h3>Billing Address</h3>

										<div class="account-details-form">
											<form method="POST">
												<div class="row">
													<div class="col-12 mb-30">
														<input type="hidden" name="billing_country" value="PH">
														<input id="country" placeholder="Country" readonly value="Philippines" type="text">
														<input type="hidden" name="billing_id" value="<?=$billing['id']?>">
													</div>

													<div class="col-12 mb-30">
														<input id="city" class="form-control" placeholder="City" name="billing_city" value="<?=$city?>" type="text" required>
													</div>

													<div class="col-12 mb-30">
														<input id="state" placeholder="State" value="<?=$state?>" name="billing_state" type="text" required>
													</div>


													<div class="col-12 mb-30">
														<input id="zip" placeholder="Zip" value="<?=$zip?>" name="billing_zip" type="text" required>
													</div>

													<div class="col-md-12 col-12 mb-30">
														<input id="address" placeholder="Address"value="<?=$address?>" name="billing_address" type="text" required>
													</div>

													
														<div class="col-12 d-flex flex-row justify-content-end d-block d-sm-none">
														<button type="submit" name="btn_account_billing" class="theme-btn">Save Changes</button>
													</div>
													<div class="col-12 d-none d-sm-block">
														<button type="submit" name="btn_account_billing" class="theme-btn">Save Changes</button>
													</div>

												</div>
											</form>
										</div>
									</div>

									<div class="myaccount-content">
										<h3>Shipping Details</h3>

										<div class="account-details-form">
											<form method="POST">
												<div class="row">

													<div class="col-12 mb-30">
														<input id="shipping_firstname" class="form-control" placeholder="Shipping First Name" name="shipping_firstname" value="<?=$fname?>" type="text" required>
													</div>

													<div class="col-12 mb-30">
														<input id="shipping_surname" class="form-control" placeholder="Shipping Last Name" name="shipping_surname"  value="<?=$sname?>" type="text" required>
													</div>

													<div class="col-12 mb-30">
														<input id="contact" class="form-control" placeholder="Shipping Contact" name="contact"  value="<?=$cNumber?>"  type="text" required>
													</div>

													<div class="col-12 mb-30">
													<input type="hidden" name="shipping_country" value="PH">
													<input type="hidden" name="shipping_id" value="<?=$shipping['id']?>">
														<input id="country" placeholder="Country" readonly value="Philippines" type="text">
													</div>

													<div class="col-12 mb-30">
														<input id="city" class="form-control" placeholder="City" name="shipping_city" value="<?=$shipCity?>"  type="text" required>
													</div>

													<div class="col-12 mb-30">
														<input id="state" placeholder="State" value="<?=$shipState?>"  name="shipping_state" type="text" required>
													</div>


													<div class="col-12 mb-30">
														<input id="zip" placeholder="Zip" value="<?=$shipZip?>" name="shipping_zip" type="text" required>
													</div>

													<div class="col-md-12 col-12 mb-30">
														<input id="address" placeholder="Address" value="<?=$shipAddress?>" name="shipping_address" type="text" required>
													</div>

												
															<div class="col-12 d-flex flex-row justify-content-end d-block d-sm-none">
														<button type="submit" name="btn_account_shipping" class="theme-btn">Save Changes</button>
													</div>
													<div class="col-12 d-none d-sm-block">
														<button type="submit" name="btn_account_shipping" class="theme-btn">Save Changes</button>
													</div>

													

												</div>
											</form>
										</div>
									</div>
									
								</div>
								<!-- Single Tab Content End -->

								<!-- Single Tab Content Start -->
								<div class="tab-pane " id="account-info" role="tabpanel">
									<div class="myaccount-content">
										<h3>Account Details</h3>

										<div class="account-details-form">
											<form method="POST">
												<div class="row">
													<div class="col-12 mb-30">
														<input iame" placeholder="First Name" name="firstname" value="<?=$user['firstname']?>" type="text">
													</div>

													<div class="col-12 mb-30">
														<input id="last-name" placeholder="Last Name" name="surname" value="<?=$user['surname']?>" type="text">
													</div>

													<div class="col-12 mb-30">
														<input id="email" readonly placeholder="Email Address" value="<?=$user['email']?>" name="email" type="email">
													</div>

													<div class="col-12 mb-30">
														<input id="display-name" placeholder="Contact Number" value="<?=$user['contact']?>" name="contact" type="text">
													</div>


													<div class="col-md-6 col-sm-12 mb-30">
														<input id="birthday" placeholder="Birth Date" value="<?=$user['birthday']?>" name="birthday" type="date">
													</div>

													<div class="col-md-2 col-sm-12 mb-30 ">
														<input readonly class="text-center" placeholder="Age" id="age" value="<?=$user['age']?>" name="age" type="text">
													</div>

													<div class="col-md-2 col-sm-12 mb-30 ">
														<select name="gender" class="form-control" style="height:50px">
															<option value="Male" <?=$user['gender'] == 'Male' ? 'selected' : ''?>>Male</option>
															<option value="Female" <?=$user['gender'] == 'Female' ? 'selected' : ''?>>Female</option>
														</select>
													</div>

													<div class="col-md-2 col-sm-12 mb-30 ">
														<select name="marital" class="form-control" style="height:50px">
															<option value="Single"   <?=$user['marital'] == 'Single' ? 'selected' : ''?>>Single</option>
															<option value="Married"  <?=$user['marital'] == 'Married' ? 'selected' : ''?>>Married</option>
															<option value="Widowed"  <?=$user['marital'] == 'Widowed' ? 'selected' : ''?>>Widowed</option>
															<option value="Divorced" <?=$user['marital'] == 'Divorced' ? 'selected' : ''?>>Divorced</option>
														</select>
													</div>

													<div class="col-12 d-flex flex-row justify-content-end d-block d-sm-none">
														<button type="submit" name="btn_account_details" class="theme-btn">Save Changes</button>
													</div>
													<div class="col-12 d-none d-sm-block">
														<button type="submit" name="btn_account_details" class="theme-btn">Save Changes</button>
													</div>

												</div>
											</form>
										</div>
									</div>
								</div>

								<div class="tab-pane " id="change-password" role="tabpanel">
									<div class="myaccount-content">
										<h3>Password change</h3>

										<div class="account-details-form">
											<form method="POST" >
												<div class="row">

													<div class="col-12 mb-30">
														<input id="current-pwd" placeholder="Current Password" name="old_password" type="password">
													</div>

													<div class="col-12 mb-30">
														<input id="new-pwd" placeholder="New Password" name="new_password" type="password">
													</div>

													<div class="col-12 mb-30">
														<input id="confirm-pwd" placeholder="Confirm Password" name="confirm_new_password" type="password">
													</div>

													
													<div class="col-12 d-flex flex-row justify-content-end d-block d-sm-none">
														<button type="submit" name="btn_change_password" class="theme-btn">Save Changes</button>
													</div>
													<div class="col-12 d-none d-sm-block">
														<button type="submit" name="btn_change_password" class="theme-btn">Save Changes</button>
													</div>

												</div>
											</form>
										</div>
									</div>
								</div>
								<!-- Single Tab Content End -->
							</div>
						</div>
						<!-- My Account Tab Content End -->
					</div>

				</div>
			</div>
		</div>
    </div>
        <!-- Slider bLock 4 -->

        <?php include 'layouts/footer.php';?>
    </div>
    <?php include 'layouts/scripts.php';?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script>
		$('#birthday').change( e => {
			var dob = $('#birthday').val();
			if(dob != ''){
				var age = moment().diff(moment(dob, 'YYYY-MM-DD'), 'years');
				$('#age').val(age);
			}
		})
		
		$('#myTable').DataTable();

	</script>
</body>

</html>