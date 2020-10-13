<?php get_header(); ?>
<?php
	if( have_posts() ) {
		while( have_posts() ) {
			the_post();
?>
	<header class="banner" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
		<h1><?php the_title(); ?></h1>
	</header>

	<div class="container-post">
    <?php
    $arguments= array(
        'post_type' => 'post',
        'posts_per_page' => 3,
    );
    $query = new WP_Query($arguments);
    if( $query->have_posts()) {
        while($query->have_posts()){
            $query->the_post();
            ?>
            <article class="shadow" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
                <a href="<?php the_permalink(); ?>">
                    <main class="text-post">
                        <h2><?php the_title(); ?></h2>
                    </main>
                </a>
            </article>
        <?php
        }
    }
    ?>
</div>
<?php
	}
}
?>

<?php get_footer(); ?>