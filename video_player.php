<?php
/*
Template Name: video-player 
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo CFS()->get('seo_title') ?></title>
    <?php wp_head();?>
</head>

<body>
    <?php get_header(); ?>

    <main class = 'mainPlayer'>
        <?php $videoName = $_GET['videoName'] ?>        

        <video controls class = 'player' src="<?php bloginfo('template_url')?>/assets/img/videos/<?php echo $videoName ?>"></video> 

    </main>    


    <?php get_footer(); ?>
    <?php  wp_footer(); ?>

</body>
</html>