<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php getMeta(); ?>
	<?php require_once 'partials/header.php'; ?>
	<title><?php getTitle(); ?></title>
</head>
<body style="overflow-x: hidden;">
	<?php ob_start(); ?>
	<?php require_once 'partials/nav/nav.php'; ?>
	<?php getContent(); ?>
	<?php require 'partials/modal/login-modal.php'; ?>
</body>
<script type="text/javascript" src="assets/js/script.js"></script>
</html>
