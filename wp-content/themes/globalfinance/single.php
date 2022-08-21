<?php get_header();

if (is_front_page()) {
    get_template_part('homepage', 'slider');
}

wp_reset_postdata();

get_template_part('header', 'nav');
?>

<!-- start of page layout -->
<div class="container">
    <div class="item_block">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 central-col">
                <?php if ( have_posts() ) : ?>
			    <?php if ( is_home() || is_front_page()) : ?>
					    <h1><?php// the_title(); ?></h1>
                <?php endif; ?>
                <?php
			    // Start the loop.
			    while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title(); ?></h1>

				<?php	the_content();
				//
				// post navigation goes here
				// get_template_part('post', 'navigation');
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

		        endif;
		?>
            </div>
</div>
</div>

				<?php
				wp_reset_postdata();
					if (in_category('news')) {
						$latest_blog_posts = new WP_Query( [
							'posts_per_page' => 2,
							'category_name' => 'news'
							 ]);


					} else if (in_category('vacancies')){
						$latest_blog_posts = new WP_Query( [
							'posts_per_page' => 3,
							'category_name' => 'faces'
							 ]);

					} else {
						$latest_blog_posts = new WP_Query( [
							'posts_per_page' => 8,
							'category_name' => 'services'
							 ]);

					}
wp_reset_postdata();
					$currentBlock = [
						'cols' => 4,
						'forcecols' => true,
						'ancor' => 'stages',
						// 'h2' => 'Наши услуги',
						'h3' => 'Также наша компания оказывает  следующие услуги:',
						'minheight' => 120,
						'bg' => ''];
						?>

						<div class="container">
						<div class="">
								<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 central-col">
										
										<?php
										if ($latest_blog_posts->have_posts()) : while ($latest_blog_posts->have_posts()) : $latest_blog_posts->the_post();
										$curPostId = $post->ID;
										// var_dump($latest_blog_posts);
										 array_push(
												$currentBlock, [
														'img' => get_the_post_thumbnail_url($curPostId, 'post_thumb'),
														'heading' => esc_html(get_the_title()),
														'href' => get_post_permalink($post->ID)
										 ]);
				
										endwhile; endif;
										wp_reset_postdata();
										$parsedBlock = new SectionBS($currentBlock);
										print_r(implode('', $parsedBlock->getSection()));
										?>
				
										</div>
								</div>
						</div>
				</div>
</div>

 <!-- end of page layout -->

<?php
get_footer();

?>
