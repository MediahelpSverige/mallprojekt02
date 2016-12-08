<!DOCTYPE html>
<html>
<head>
	<title><?php wp_title(''); ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<main>
