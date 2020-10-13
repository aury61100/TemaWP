<?php the_post_thumbnail('large')?> <!-- immagine in evidenza -->
<div style="background-color:<?php the_field('background_color'); ?>">
    <h2><?php the_title();?></h2>
    <?php the_content();?>
</div>

