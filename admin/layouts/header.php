<?php include '../config/functions.php';?>
<?php 
if(!isset($_SESSION['administrator'])) {
	header('location: index.php');
}
$user = account_details($_SESSION['admin_id'])->fetch_assoc();

if(isset($_GET['logout']) == true) {
	unset($_SESSION['administrator']);
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en" class="layout-static">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/x-icon" href="assets/image/wrapitup-logo.jpg">
	<title>Wrap it Up</title>
  <link rel="stylesheet" href="../assets/css/plugins.css" />
	 <link rel="stylesheet" href="../assets/css/main.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">  
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/all.min.css" rel="stylesheet" type="text/css">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- /global stylesheets -->
	<style>
		button {
			border-radius:0px !important;
		}
	</style>
</head>