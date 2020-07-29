<?php

spl_autoload_register(function($class_name){
	include_once __DIR__ . "/../../" . $class_name . ".php";
});

use App\Controller\CustomerController as CustomerController;

$data = NULL;
$fromPOST = (
	sizeof($_POST) > 0) &&
	(
		!empty($_POST['name']) &&
		!empty($_POST['address']) &&
		!empty($_POST['phonenumber']
	)
);

if ($fromPOST) {
	// TODO: Request an Update Controller function
	// Store inside $data variable

	$data = CustomerController::Create($_POST['name'], $_POST['address'], $_POST['phonenumber']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php include __DIR__ . "/common/_loadcss.php"; ?>

	<title>Customer - Home</title>
</head>

<body>
	<?php include __DIR__ . "/common/navbar.php" ?>

	<div class="container">
		<div class="mt-3">
			<a href="." class="btn btn-dark text-white"><i class="fas fa-arrow-alt-circle-left text-white mr-2"></i>Go Back</a>
		</div>
		<h4 class="mt-4 font-weight-bold">Customer Detail 
			<?php if($data) : ?>
				<span class="bg-info text-white text-uppercase font-italic font-weight-bold p-1 rounded" style="font-size: .3em;">Already Created</span>
			<?php endif; ?>
		</h4>
		<hr>

		<div class="row">
			<?php if ($data) : ?>
				<div class="col-6">
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" aria-label="Close" data-dismiss="alert">
							<span aria-hidden="true">&times;</span>
						</button>
						Customer <?= $data->getName(); ?> has been created.
					</div>
				</div>
			<?php endif; ?>
			<div class="col-8">
				<form name="main-form" method="post" action="<?php if ($data) echo "./edit.php";
																else echo "./create.php";  ?>">
					<?php if ($data) : ?>
						<input type="text" class="form-control" name="id" id="id-txt" aria-describedby="idHelp" placeholder="Enter Id" value="<?= $data->getId() ?>" hidden>
					<?php endif; ?>
					<div class="form-group">
						<label for="name-txt">Full Name</label>
						<input type="text" class="form-control" name="name" id="name-txt" aria-describedby="nameHelp" placeholder="Enter Full Name Here" value="<?php if ($data) echo $data->getName(); ?>" required>
						<small id="nameHelp" class="form-text text-muted">Customer Full Name, First and Last Name.</small>
					</div>
					<div class="form-group">
						<label for="address-txt">Address</label>
						<input type="text" class="form-control" name="address" id="address-txt" aria-describedby="addressHelp" placeholder="Enter Address" value="<?php if ($data) echo $data->getAddress(); ?>" required>
						<small id="addressHelp" class="form-text text-muted">Customers home address.</small>
					</div>
					<div class="form-group">
						<label for="phonenumber-txt">Phone Number</label>
						<input type="text" pattern="\+\d*|0\d*" class="form-control" name="phonenumber" id="phonenumber-txt" aria-describedby="phonenumberHelp" placeholder="Enter Phone Number" value="<?php if ($data) echo $data->getPhonenumber(); ?>" required>
						<small id="phonenumberHelp" class="form-text text-muted">Customers primary phone number.</small>
					</div>
					<button type="submit" class="btn btn-success text-white submit-btn"><i class="fas fa-check-circle text-white mr-2"></i>Create</button>
					<a href="." class="btn btn-light text-dark"><i class="fas fa-exclamation-circle text-dark mr-2"></i>Cancel</a>
				</form>
			</div>
		</div>
	</div>

	<br><br><br>

	<!-- Scripts -->
	<?php include __DIR__ . "/common/_loadjs.php"; ?>
	<script src="./../script/js/customer/create.js"></script>
</body>

</html>