<?php get_header();



if (is_front_page()) {
    get_template_part('homepage', 'slider');
}

wp_reset_postdata();

get_template_part('header', 'nav');
//get_template_part('buh', 'calculator');
?>
<!-- start of page layout -->
<div class="container">
    <div class="item_block">


        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 central-col main">
                <?php if ( have_posts() ) : ?>
			    <?php if ( is_home() || is_front_page()) : ?>

                <?php endif; ?>
                <?php
			    // Start the loop.
			    while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title(); ?></h1>

				<?php	the_content();

					//the_content();

			    // End the loop.
			    endwhile;

			        // Previous/next page navigation.
			        the_posts_pagination( array(
				    'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				    'next_text'          => __( 'Next page', 'twentyfifteen' ),
				    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			        ));

		        // If no content, include the "No posts found" template.
                else :
                    print_r('- no posts... ');
			        get_template_part( 'content', 'none' );

		        endif; ?>
            </div>

        </div>
	</div>
	<div class="pagi">
            <?php get_template_part('pagination', 'line'); ?>
        </div>
</div>

 <!-- end of page layout -->

<?php get_footer(); ?>
