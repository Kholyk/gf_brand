<?php
get_header(); 
// get_template_part('buhservice', 'slider');
get_template_part('header', 'nav');

$currentBlock = [
    'cols' => 3,
	'forcecols' => true,
    'ancor' => 'faces',
    'h2' => 'Лица компании',
    'h3' => 'Мы делаем Вашу работу проще с каждым днём!',
    'minheight' => 220,
    'bg' => ''
];
$blocks = new WP_Query([
    	'post_type' => 'staff',
    ]);


?>

<div class="container">
    <div class="empl">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php if (have_posts()) : while (have_posts()) : the_post();
            $curPostId = $post->ID;

             array_push($currentBlock, [
                'img' => get_the_post_thumbnail_url($curPostId, 'full'),
                'heading' => esc_html(get_the_title()),
                'desc' => '<a href="'.get_the_permalink().'">'.esc_html(get_the_excerpt()).'</a>',
             ]);

            endwhile; endif;?>
            <?php 
            $parsedBlock = new SectionBS($currentBlock);
            print_r(implode('', $parsedBlock->getSection()));
            //wp_reset_postdata();
            ?>

            </div>
        </div>
        <!-- Pagination -->
        <div class="pagi">
            <?php get_template_part('pagination', 'line'); ?>
        </div>  
    </div> 
</div>

<?php get_footer(); ?>