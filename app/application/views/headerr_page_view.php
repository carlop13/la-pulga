<!DOCTYPE html>

<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta author="Carlos Guadalupe López Trejo">
	<title><?= $titulo ?></title>

	<link rel="shortcut icon" href="<?=base_url()?>static/images/logo.jpeg">
	<link rel="stylesheet" href="<?=base_url()?>static/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?=base_url()?>static/fontawesome/css/all.min.css" />

<?php
if (isset($css) ):
foreach ($css as $link ) : //ciclos para poner los CSS
?>

	<link href="<?=base_url()?>static/<?=$link?>" rel="stylesheet" />

<?php
endforeach;
endif;
?>

<script src="static/js/mapa.js"></script>

<script src="<?=base_url()?>static/js/jquery-3.6.1.min.js"></script>
<script src="<?=base_url()?>static/js/jquery-3.6.1.js"></script>
<script src="<?=base_url()?>static/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>
<body>