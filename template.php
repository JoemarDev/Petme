<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php require_once 'partials/header.php'; ?>
	<title><?php getTitle(); ?></title>
</head>
<body style="overflow-x: hidden;">

	<?php 
			function seoUrl($string) {
			    //Lower case everything
			    $string = strtolower($string);
			    //Make alphanumeric (removes all other characters)
			    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
			    //Clean up multiple dashes or whitespaces
			    $string = preg_replace("/[\s-]+/", " ", $string);
			    //Convert whitespaces and underscore to dash
			    $string = preg_replace("/[\s_]/", "-", $string);
			    return $string;
			}
	 ?>

	<?php ob_start(); ?>
	<?php require_once 'partials/nav/nav.php'; ?>
	<?php getContent(); ?>
	<?php require 'partials/modal/login-modal.php'; ?>
</body>
<script type="text/javascript" src="assets/js/script.js"></script>
</html>
