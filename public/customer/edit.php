<?php

spl_autoload_register(function($class_name){
	include_once __DIR__ . "/../../" . $class_name . ".php";
});

use App\Controller\CustomerController as CustomerController;

if(!isset($_GET['id'])) header("Location: .");

$data = NULL;
$fromPOST = (
	sizeof($_POST) > 0) &&
	(
		!empty($_POST['id']) &&
		!empty($_POST['name']) &&
		!empty($_POST['address']) &&
		!empty($_POST['phonenumber']
	)
);

if (!$fromPOST && !empty($_GET['id'])) {
	$id = $_GET['id'];
	if ($customer = CustomerController::Read($id)) {
		$customer->setId($id);
		$data = $customer;
	}
}

if ($fromPOST) {
	// TODO: Request an Update Controller function
	// Store inside $data variable

	$data = CustomerController::Update($_POST['id'], $_POST['name'], $_POST['address'], $_POST['phonenumber']);
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
		<h4 class="mt-4"><b>Customer Detail</b></h4>
		<hr>

		<div class="row">
			
			<?php if ($fromPOST && $data) : ?>
				<div class="col-6">
					<div class="alert alert-success" role="alert">
						<button type="button" class="close" aria-label="Close" data-dismiss="alert">
							<span aria-hidden="true">&times;</span>
						</button>
						Customer <?php echo $data->getName(); ?> has been updated.
					</div>
				</div>
			<?php endif; ?>

			<div class="col-8">
				<form method="post" action="./edit.php">
					<input id="id-txt" name="id" hidden value="<?php echo $data->getId() ?>" />
					<div class="form-group">
						<label for="name-txt">Full Name</label>
						<input type="text" class="form-control" name="name" id="name-txt" aria-describedby="nameHelp" placeholder="Enter Full Name Here" value="<?php echo $data->getName(); ?>" required>
						<small id="nameHelp" class="form-text text-muted">Customer Full Name, First and Last Name.</small>
					</div>
					<div class="form-group">
						<label for="address-txt">Address</label>
						<input type="text" class="form-control" name="address" id="address-txt" aria-describedby="addressHelp" placeholder="Enter Address Here" value="<?php echo $data->getAddress(); ?>" required>
						<small id="addressHelp" class="form-text text-muted">Customers home address.</small>
					</div>
					<div class="form-group">
						<label for="phonenumber-txt">Phone Number</label>
						<input type="text" pattern="\+\d*|0\d*"  class="form-control" name="phonenumber" id="phonenumber" aria-describedby="phonenumberHelp" placeholder="Enter Phonenumber Here" value="<?php echo $data->getPhonenumber(); ?>" required>
						<small id="phonenumberHelp" class="form-text text-muted">Customers primary phone number.</small>
					</div>
					<button type="submit" class="btn btn-success"><i class="fas fa-check-circle text-white mr-2"></i>Edit</button>
					<button type="submit" formaction="./delete.php" form="id-form" class="btn btn-light text-danger"><i class="fas fa-trash-alt text-danger"></i> Delete</button>
				</form>
				<form id="id-form" action="get">
					<input id="id-txt" name="id" hidden value="<?php echo $data->getId() ?>" />
				</form>
			</div>
		</div>
	</div>

	<br><br><br>

	<!-- Scripts -->
	<?php include __DIR__ . "/common/_loadjs.php"; ?>
</body>

</html>