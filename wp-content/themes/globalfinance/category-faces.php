<?php get_header(); ?>
<?php get_template_part('header', 'nav');
$currentBlock = [
    'cols' => 4,
    'ancor' => 'faces',
    'h2' => 'Лица компании',
    'h3' => 'Мы делаем нашу работу на отлично!',
    'minheight' => 220,
    'bg' => ''
];

?>

<div class="container">
    <div class="">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php if (have_posts()) : while (have_posts()) : the_post();
            $curPostId = $post->ID;

             array_push($currentBlock, [
                'img' => get_the_post_thumbnail_url($curPostId, 'full'),
                'heading' => esc_html(get_the_title()),
                'desc' => '<a href="'.get_the_permalink().'">'.esc_html(get_the_content()).'</a>',
             ]);

            endwhile; endif;?>
            <?php 
            $parsedBlock = new SectionBS($currentBlock);
            $parsedBlock->makeSection();
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






<?php get_footer();?>