<?php
if(!isset($page_title)) {
  $page_title = '';
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title><?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo h($page_title); ?>">
	  <!-- Compiled and minified CSS -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="../private/shared/css/styles.css?ver=<?php echo $version;?>" rel="stylesheet">
  </head>
  <body class="bg-brown">
