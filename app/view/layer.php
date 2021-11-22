<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="<?php echo $this->get('public-url') ?>/asset/bootstrap-5.0.2/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo $this->get('public-url') ?>/app.css" rel="stylesheet">
		
		<title><?php echo $this->get('title', '') ?></title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="<?php echo $this->get('root-url') ?>/">beejeeTest</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbar">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $this->get('root-url') ?>/">Список задач</a>
						</li>
						<li class="nav-item">
							<?php 
							if($this->get('admin-login')) {
								echo '<a class="nav-link" href="'.$this->get('root-url').'/admin/logout">Выход</a>';
							}
							else {
								echo '<a class="nav-link" href="'.$this->get('root-url').'/admin/login">Вход</a>';
							}
							?>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
		<section class="app-main mt-25">
		
		<?php
			if($mtpl = $this->get('main-template')) {
				$this->show($mtpl);
			}
		?>
		
		</section>
		
		<footer class="app-footer mt-25">
			<p>Тестовое задание для beejee.ru</p>
		</footer>
		
		<script src="<?php echo $this->get('public-url') ?>/asset/jquery/jquery-3.6.0.min.js"></script>
		<script src="<?php echo $this->get('public-url') ?>/asset/bootstrap-5.0.2/js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo $this->get('public-url') ?>/app.js"></script>
	</body>
</html>