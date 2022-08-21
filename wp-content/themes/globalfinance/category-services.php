<?php get_header(); ?>
<?php get_template_part('header', 'nav');
$currentBlock = [
    'cols' => 2,
    'ancor' => 'stages',
    'h2' => 'Наши услуги',
    'h3' => 'Высококачественные бухгалтерские услуги бизнесу',
    'minheight' => 120,
    'bg' => ''];

?>

<div class="container">
    <div class="">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 central-col">
            <?php if (have_posts()) : while (have_posts()) : the_post();
            $curPostId = $post->ID;

             array_push(
                $currentBlock, [
                    'img' => get_the_post_thumbnail_url($curPostId, 'post_thumb'),
                    'heading' => esc_html(get_the_title()),
                    'href' => get_post_permalink($post->ID)
             ]);

            endwhile; endif;

            $parsedBlock = new SectionBS($currentBlock);
            print_r(implode('', $parsedBlock->getSection()));
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
