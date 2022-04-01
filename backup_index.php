<?php
	require_once 'core/init.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	include 'includes/headerfull.php';
	include 'includes/leftbar.php';

?>
 <!-- Main Content -->
	<div class="col-md-8">
	 	<div class="row">
	 		<h2 class="text-center">Feature Services</h2>
	 		
	 		<div class="col-md-3 text-center">
	 			<h4>Warehouse</h4>
	 			<img src="./images/warehouse.jpg" alt="warehouse" class="img-thumb" />
	 			<p class="list-price text-danger">List Price: <s>N154.99</s></p>
	 			<p class="price">Our Price: N100.99</p>
	 			<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details-1">Details</button>
	 		</div>

	 		<div class="col-md-3 text-center">
	 			<h4>Storage</h4>
	 			<img src="./images/storage.jpg" alt="storage" class="img-thumb" />
	 			<p class="list-price text-danger">List Price: <s>N78.99</s></p>
	 			<p class="price">Our Price: N58.99</p>
	 			<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details-1">Details</button>
	 		</div>

	 		<div class="col-md-3 text-center">
	 			<h4>Cargo Transportation</h4>
	 			<img src="./images/truck.jpg" alt="truck" class="img-thumb" />
	 			<p class="list-price text-danger">List Price: <s>N88.99</s></p>
	 			<p class="price">Our Price: N59.99</p>
	 			<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details-1">Details</button>
	 		</div>

	 		<div class="col-md-3 text-center">
	 			<h4>Home Delivery</h4>
	 			<img src="./images/delivery_van.jpg" alt="delivery_van" class="img-thumb" />
	 			<p class="list-price text-danger">List Price: <s>N40.99</s></p>
	 			<p class="price">Our Price: N20.99</p>
	 			<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details-1">Details</button>
	 		</div>
	 	
	 	</div>
	</div>

<style>
		.img-thumb{
			width: 190px;
			height: 200px;
		}
		
</style>

<?php
	include 'includes/detailsmodal.php';
	include 'includes/rightbar.php';
	include 'includes/footer.php';
?>


