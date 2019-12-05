<!DOCTYPE html>
<html>
<head>
	<title>Travels</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/font.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/customize.css">
	<style type="text/css">
		.uk-button-back {
		    background-color: rgb(144, 12, 37);
		    color: rgb(255, 255, 255);
		    border-top-color: transparent;
		    border-right-color: transparent;
		    border-bottom-color: transparent;
		    border-left-color: transparent;
		    padding: 15px;
		}
		.uk-button-back:hover {
		    background-color: #cc687b;
		    color: white;
		    cursor: pointer;
		}

		.navbar {
			overflow: hidden;
			background-color: #333;
			position: fixed;
			top: 0;
			width: 100%;
		}

		.navbar a {
			float: left;
			display: block;
			color: #f2f2f2;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			font-size: 17px;
			font-family: 'Oswald', sans-serif;
		}

		.navbar a:hover {
			background: #ddd;
			color: black;
		}

		.slideshow{
			height: 1500px;
		}
	</style>
</head>
<body>

	<button class="uk-button-back">Back</button>

	<div class="navbar">
		<a style="margin-left: 43%;" href="<?php echo base_url(); ?>cn/travel">Return to Main Menu</a>
	</div>
	
	<section class="slideshow">


		<ul class="navigation" id="ul_navigation">

			<!-- let us display the first data as active -->
			<li class="navigation-item active">
				<span class="rotate-holder"></span>
				<span class="background-holder" style="background-image: url(<?php echo base_url().$result[0]->TravelPictureFileName; ?>);"></span>
			</li>

			<?php for($i = 1; $i < count($result); $i++){ ?>
				<li class="navigation-item">
					<span class="rotate-holder"></span>
					<span class="background-holder" style="background-image: url(<?php echo base_url().$result[$i]->TravelPictureFileName; ?>);"></span>
				</li>
			<?php } ?>

		</ul>
      
		<div class="detail">

			<!-- let us display the first data as active -->
			<div class="detail-item active">
				<div class="headline"><?php echo $result[0]->TravelName; ?></div>
				<div class="background" style="background-image: url(<?php echo base_url().$result[0]->TravelPictureFileName; ?>); height: 100vh;"></div>
			</div>

			<?php for($i = 1; $i < count($result); $i++){ ?>
				<div class="detail-item">
					<div class="headline"><?php echo $result[$i]->TravelName; ?></div>
					<div class="background" style="background-image: url(<?php echo base_url().$result[$i]->TravelPictureFileName; ?>); height: 100vh;"></div>
				</div>
			<?php } ?>

		</div>


	</section>

	<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/TweenMax.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/imagesloaded.pkgd.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/imagesloaded.pkgd.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/TextPlugin.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/demo.js"></script>

</body>
</html>