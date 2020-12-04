<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
	<base href="/petme/"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="canonical" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ?>" />
	<?php require_once 'partials/header.php'; ?>
	<title><?php getTitle(); ?></title>
	<?php getMeta(); ?>
</head>
<body style="overflow-x: hidden;">
	<?php ob_start(); ?>
	<?php require_once 'partials/nav/nav.php'; ?>
	<?php getContent(); ?>
	<?php require 'partials/modal/login-modal.php'; ?>
</body>
<script type="text/javascript" src="assets/js/script.js?v=4151421"></script>
</html>
