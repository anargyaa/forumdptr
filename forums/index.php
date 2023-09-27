<?php
    // session start
    if(!empty($_SESSION)){ }else{ session_start(); }
    require 'proses/panggil.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form action="post" class="" enctype="multipart/form-data">
		<input type="text" name="" value="" placeholder="">
		<input type="file" name="" value="" placeholder="">
	</form>
</body>
</html>