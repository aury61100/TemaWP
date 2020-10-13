<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header>
        <?php
            wp_nav_menu([
                'theme_location' => 'main_menu',
                'container' => 'nav',
                'container_id' =>'',
                'container_class' =>'',
                'menu_id' =>'',
                'menu_class' =>'',
            ]);
        ?>
    </header>