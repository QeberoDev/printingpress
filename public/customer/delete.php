<?php

spl_autoload_register(function($class_name){
	include_once __DIR__ . "/../../" . $class_name . ".php";
});

use App\Controller\CustomerController as CustomerController;

if (!isset($_GET['id'])) header("Location: .");

$data = NULL;
$fromPOST = (sizeof($_POST) > 0) && !empty($_POST['id']);

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

	$data = CustomerController::Delete($_POST['id']);
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
			<a href="./edit.php?id=<?= $data->getId() ?>" class="btn btn-dark text-white"><i class="fas fa-arrow-alt-circle-left text-white mr-2"></i>Go Back</a>
		</div>
		<h4 class="mt-4"><b>Customer Detail</b></h4>
		<hr>

		<div class="row">

			<?php if ($fromPOST && $data) : ?>
				<div class="col-6">
					<div class="alert alert-danger" role="alert">
						<button type="button" class="close" aria-label="Close" data-dismiss="alert">
							<span aria-hidden="true">&times;</span>
						</button>
						Customer <?php echo $data->getName(); ?> has been removed.
					</div>
				</div>
			<?php endif; ?>

			<div class="col-8">
				<form method="post" action="./delete.php">
					<input id="id-txt" name="id" hidden value="<?php echo $data->getId() ?>" />

					<div class="lead"><b>Full Name: </b><?= $data->getName() ?></div>
					<div class="lead"><b>Address: </b><?= $data->getAddress() ?></div>
					<div class="lead"><b>Phone Number: </b><?= $data->getPhonenumber() ?></div>
					<br>

					<div>
						<p class="text-muted">Are you sure you want to remove this Customer?</p>
					</div>
					<button type="submit" class="btn btn-danger text-white px-3"><i class="fas fa-check-circle text-white mr-2"></i>Yes</button>
					<button formaction="./edit.php" formmethod="get" type="submit" class="btn btn-light px-4"><i class="fas fa-exclamation-circle text-dark mr-2"></i>No</button>
				</form>
			</div>
		</div>
	</div>

	<br><br><br>

	<!-- Scripts -->
	<?php include __DIR__ . "/common/_loadjs.php"; ?>
</body>

</html>