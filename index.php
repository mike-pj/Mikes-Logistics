<?php
	require_once 'core/init.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	include 'includes/headerfull.php';
	include 'includes/leftbar.php';

$sql = "SELECT * FROM services WHERE featured = 1";
$featured = $db->query($sql);

?>
 <!-- Main Content -->
	<div class="col-md-8">
	 	<div class="row">
	 		<h2 class="text-center">Feature Services</h2>
	 		<?php while($services = mysqli_fetch_assoc($featured)) : ?>
	 			<!-- <?php var_dump($service); ?> --> 
	 		<div class="col-md-3 text-center">
	 			<h4><?= $services['title']; ?></h4>
	 			<img src="<?= $services['image']; ?>" alt="<?= $services['title']; ?>" class="img-thumb" />
	 			<p class="list-price text-danger">List Price: <s><?= $services['list_price']; ?></s></p>
	 			<p class="price">Our Price:<?= $services['price']; ?></p>
	 			<button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $services['id']; ?>)">Details</button>
	 		</div>
	 	<?php endwhile; ?>
	 	</div>
	</div>

<style>
		.img-thumb{
			width: 190px;
			height: 200px;
		}
		
</style>

<div class="container">
        <div class="row mb-5">
          <div class="col-md-6 mb-5">
            <h3>About us</h3>
            <p class="mb-5">Here we can write our motto
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus et dolor blanditiis consequuntur ex voluptates perspiciatis omnis unde minima expedita.</p>
            <ul class="list-unstyled footer-link d-flex footer-social">
              <li><a href="#" class="p-2"><span class="fa fa-twitter"></span></a></li>
              <li><a href="#" class="p-2"><span class="fa fa-facebook"></span></a></li>
              <li><a href="#" class="p-2"><span class="fa fa-linkedin"></span></a></li>
              <li><a href="#" class="p-2"><span class="fa fa-instagram"></span></a></li>
            </ul>

          </div>
          <!-- <div class="col-md-3 mb-5">
            <h3>Quick Links</h3>
            <ul class="list-unstyled footer-link">
              <li><a href="#">Sermons</a></li>
              <li><a href="#">Activities</a></li>
              <li><a href="#">Events</a></li>
               <li><a href="#">Projects</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div> -->
          <div class="col-md-6 mb-5">
            <h3>Contact Info</h3>
            <ul class="list-unstyled footer-link">
              <li class="d-block">
                <span class="d-block">Address:</span>
                <span class="text-white">Mike's Logistics Company: #3 Asa Afariogun Street, Ajao Estate, Isolo, Lagos</span></li>
              <li class="d-block"><span class="d-block">Telephone:</span><span class="text-white">0801111111</span></li>
              <li class="d-block"><span class="d-block">Email:</span><span class="text-white">mike'slogistics@yahoo.com</span></li>
            </ul>
          </div>
          
        </div>
        <div class="row">
          <div class="col-12 text-md-center text-left">


<?php
	// include 'includes/rightbar.php';
	include 'includes/footer.php';
?>


