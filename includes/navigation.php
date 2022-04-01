<?php
$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);
?>

<!-- Top Nav Bar -->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<a href="index.php" class=" navbar-brand">Mike's Logistics</a>
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="index.php">Home</a>
				</li>
			</ul>

			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="index.php">Contact</a>
				</li>
			</ul>
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="index.php">About Us</a>
				</li>
			</ul>
			<ul class="nav navbar-nav">
				<?php while($parent = mysqli_fetch_assoc($pquery)) : ?>	
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?><span class="caret"></span></a>
							<?php
								$parent_id = $parent['id'];
              					$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
              					$cquery = $db->query($sql2);
              				?>
						<ul class="dropdown-menu" role="menu">
							<?php while($child = mysqli_fetch_assoc($cquery)) : ?>
							<li><a href="#"><?=$child['category'];?></a></li>
							<!-- <li><a href="#">Storage</a></li>
							<li><a href="#">Cargo Transportation</a></li>
							<li><a href="#">Home Delivery</a></li> -->
							<?php endwhile; ?>
						</ul>	
					</li>
				<?php endwhile; ?>
			</ul>
			<p class="text-right"><a href="/projectpgd/admin/login.php" alt="login">Login</a></p>

			<style>
				{
					margin-top: 50px;
				}
			</style>

		</div>
	</div>
</nav>