<?php 
    // Genera un ID automatico
    $id = 'square-' . $block['id'];
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
    }

    // Aggiunge delle classi apposite (square è generica)
    $className = 'square';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }
    if( !empty($block['align']) ) {
        $className .= ' align' . $block['align'];
    }
?>
<!-- esc_attr toglie i caratteri speciali che potrebbero dare problemi -->
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background-color:<?php the_field('background') ?>"> 

</div>