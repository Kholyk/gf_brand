<div class="row text-center">  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                // Previous/next page navigation.
			        the_posts_pagination( array(
                        'show_all' => true,
                        'prev_text'          => '<span class="btn btn-light"> &larr; ' . __( 'К новым', 'gf' ) . ' </span>',
                        'next_text'          => '<span class="btn btn-light"> ' . __( 'К прошлым', 'gf' ) . ' &rarr; </span>',
                        'before_page_number' => '<span class="btn btn-success">',
                        'after_page_number' => ' </span>',
                        ));
                ?>

                
    		</div></div>