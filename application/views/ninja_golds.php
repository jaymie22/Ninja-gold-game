<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ninja Gold Game (CodeIgniter version)</title>
	<link rel="stylesheet" style="text/css" href="<?= base_url('assets/css/ninjagold.css') ?>">
</head>
<body>
<div id="wrapper">
	
	<div id="container_forms">
		<h3>Your Gold:</h3>
		<p class="gold"><?= $this->session->userdata('gold_value'); ?></p>
		<form action="<?= base_url('process_money') ?>" method="post" class="farm_form">
			<h4>Farm</h4>
			<p>(earns 10-20 golds)</p>
			<input type="hidden" name="building" value="farm" />
			<input type="submit" value="Find Gold!"/>
		</form>

		<form action="<?= base_url('process_money') ?>" method="post" class="cave_form">
			<h4>Cave</h4>
			<p>(earns 5-10 golds)</p>
			<input type="hidden" name="building" value="cave" />
			<input type="submit" value="Find Gold!"/>
		</form>

		<form action="<?= base_url('process_money') ?>" method="post" class="house_form">
			<h4>House</h4>
			<p>(earns 2-5 golds)</p>
			<input type="hidden" name="building" value="house" />
			<input type="submit" value="Find Gold!"/>
		</form>

		<form action="<?= base_url('process_money') ?>" method="post" class="casino_form">
			<h4>Casino</h4>
			<p>(earns/takes 0-50 golds)</p>
			<input type="hidden" name="building" value="casino" />
			<input type="submit" value="Find Gold!"/>
		</form>

	</div>

	<h2>Activities: </h2>
	<div id="activities_box"> 
	<?php 
		if(! empty($activity_log))
		{
			foreach (array_reverse($activity_log) as $activity) 
			{	
				$class = (strpos($activity,"lost")) ? "red" : "green";
	?>
			 	<p class="activity <?= $class  ?>"><?=  $activity ?></p> 
	<?php	
			} 	
		}	
	?>
	</div>
	<a href="<?= base_url('') ?>" class="reset">Reset</a>

</div>
	
</body>
</html>