<?php get_header(); ?>

<?php
if( have_posts() ) {
    while( have_posts() ) {
        the_post();
?>
<header class="banner bannerSinglePage" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
</header>

<div class="single-article">	
	<main>
		<div class="content-article">
			<h1 class="h1-article"><?php the_title(); ?></h1>
			<p><?php the_content(); ?></p>
			<p>
				<small>Scritto da <?php the_author() ?> il <?php the_date() ?> </small>
			</p>
		</div>
		
	
				
	
	
	</main>
</div>
	
<?php
    }
}

?>

<?php get_footer(); ?>