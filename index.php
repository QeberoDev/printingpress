<?php

	// include_once __DIR__ . "/util/pager.php";
	
	// include_once __DIR__ . "/lib/Abstraction/Comparable.php";
	// include_once __DIR__ . "/lib/Abstraction/Controller.php";
	// include_once __DIR__ . "/lib/Abstraction/IParsable.php";
	// include_once __DIR__ . "/lib/Abstraction/ICatagorical.php";
	// include_once __DIR__ . "/lib/Database.php";

	// include_once __DIR__ . "/model/Customer.php";
	// include_once __DIR__ . "/controller/CustomerController.php";

	spl_autoload_register(function ($class_name){
		include_once __DIR__ . "/" . $class_name . ".php"; 
	});

	use App\Controller\CustomerController;
	use App\Util\Pager as Pager;
	
	if(!isset($_GET['pg'])) header("Location: ?pg=1");
	
	$customers = CustomerController::ReadAll((int) $_GET['pg']);

	$pager = new Pager($customers["page_count"], (int) $_GET['pg']);

	var_dump($customers);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./resources/addons/bootstrap/dist/css/bootstrap.min.css">

	<title>Document</title>
</head>

<body>
	<div class="container">
		<br>

		<?php if (isset($_GET['pg'])) echo "Current Page: " . $_GET['pg']; ?>

		<div>
			<br>
		</div>

		<?php if ($pager->pageExists()) : ?>
			<nav aria-label="...">
				<ul class="pagination">
					<li class="page-item <?= $pager->getPrevious() ? null : "disabled" ?>">
						<a class="page-link" href="?pg=<?= $pager->getPrevious() ?>" tabindex="-1" aria-disabled="true">Previous</a>
					</li>

					<?php for ($i = 1; $i <= $pager->getCount(); ++$i) : ?>
						<li class="page-item <?= ($i == $_GET['pg']) ? "active" : null ?>">
							<a class="page-link" href="?pg=<?= $i ?>"><?= $i ?></a>
						</li>
					<?php endfor; ?>

					<li class="page-item <?= $pager->getNext() ? null : "disabled" ?>">
						<a class="page-link" href="?pg=<?= $pager->getNext() ?>">Next</a>
					</li>
				</ul>
			</nav>
		<?php else : ?>
			<h4>Page Doesn't Exist</h4>
		<?php endif; ?>

	</div>

	<script src="./resources/addons/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php 
	
?>