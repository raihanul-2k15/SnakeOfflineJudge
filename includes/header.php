<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $pages[$current_page]["title"]." | sOJ";?></title>
		<link rel="stylesheet" href="styles/template.css">
		<link rel="stylesheet" href="styles/<?php echo $pages[$current_page]["slug"]?>.css">
		<?php 
		  if (array_key_exists("js",$pages[$current_page]) === true) {
		      echo "<script src=\"scripts/" . $pages[$current_page]["js"] . ".js\"></script>";
		  }
		?>
		<meta name="viewport" content="width=device-width initial-scale=1.0">
	</head>
	
	<body <?php if (array_key_exists("onload",$pages[$current_page]) === true) echo "onload=\"".$pages[$current_page]["onload"]."()\"";?>>
	<header class="page-header">
		<img src="img/home-logo.png"></img>
		<h1>offline judge</h1>
		<h2><?php echo $pages[$current_page]["title"];?></h2>
	</header>