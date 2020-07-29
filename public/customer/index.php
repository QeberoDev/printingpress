<?php

spl_autoload_register(function($class_name){
	include_once __DIR__ . "/../../" . $class_name . ".php";
});

use App\Controller\CustomerController as CustomerController;
use App\Util\Pager as Pager;

if (!isset($_GET['pg'])) header("Location: ?pg=1");

$customers = CustomerController::ReadAll((int) $_GET['pg']);
$pager = new Pager($customers["page_count"], (int) $_GET['pg']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php include __DIR__ . "/common/_loadcss.php"; ?>

	<title>Customer - Dashboard</title>
</head>

<body>
	<?php include __DIR__ . "/common/navbar.php" ?>

	<div class="container">
		<br>
		<h4><b><i class="fas fa-clipboard-list text-dark mr-2"></i>Customer List</b></h4>
		<hr>
		<div>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="./create.php"><i class="fas fa-plus-circle"></i> Add</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="fas fa-minus-circle"></i> Remove</a>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-dark my-2 my-sm-0" type="submit">Search</button>
				</form>
			</nav>
		</div>
		<br>
		<div>
			<?php if ($pager->pageExists()) : ?>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Id</th>
							<th scope="col">Full Name</th>
							<th scope="col">Address</th>
							<th scope="col">Phonenumber</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>

						<?php foreach ($customers["data"] as $key => $customer) : ?>
							<?php /** @var \App\Model\Customer $customer */ ?>
							<tr>
								<th scope="row"><?= $customer->getId() ?></th>
								<td><?= $customer->getName() ?></td>
								<td><?= $customer->getAddress() ?></td>
								<td><?= $customer->getPhonenumber() ?></td>
								<td class="">
									<div class="d-flex">
										<a href="./edit.php?id=<?= $customer->getId() ?>" class="text-info mx-2" role="button">
											<i class="fas fa-paperclip text-info pr-1"></i> View
										</a>
										<a href="./edit.php?id=<?= $customer->getId() ?>" class="text-warning mx-2" role="button">
											<i class="fas fa-pen-alt text-warning pr-1"></i> Edit
										</a>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>

					</tbody>
				</table>

				<nav aria-label="...">
					<ul class="pagination">
						<li class="page-item <?= $pager->getPrevious() ? null : "disabled" ?>">
							<a class="page-link" href="?pg=<?= $pager->getPrevious() ?>" tabindex="-1" aria-disabled="true">Previous</a>
						</li>

						<?php for ($i = 1; $i <= $pager->getCount(); ++$i) : ?>
							<li class="page-item <?= ($i == $pager->getCurrent()) ? "active" : null ?>">
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
	</div>

	<br><br><br>

	<!-- Scripts -->
	<?php include __DIR__ . "/common/_loadjs.php"; ?>
</body>

</html>