<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?= RUTACSS ?>normalize.css">
	<title><?php echo $this->titlepage; ?></title>
	<link rel="stylesheet" href="<?= RUTACSS ?>404.css">
    <link rel="icon" href="<?=RUTA?>/public/assets/img/lunch-system-favicon.ico">
</head>

<body>
	
	<main>
		<section class="notFound">
			<h1 class="notFound-title"><?php echo $this->head; ?></h1>
			<img src="<?= RUTAIMG ?>this-is-fine-404.gif" alt="<?php echo $this->head; ?>" class="notFound-img">
			<p class="notFound-text"><?php echo $this->mensaje; ?></p>
		</section>
	</main>
	
</body>

</html>