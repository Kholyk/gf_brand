<?php
get_header(); 
get_template_part('buh', 'slider');
get_template_part('header', 'nav');
get_template_part('buh', 'calculator');
?>

<div class="container">
    <div class="item_block">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 central-col">
                <!-- <h1>Бухгалтерия с «Глобал Финанс» — это удобно!</h1> -->
            <?php
				
            $counter = 0;
            $blocks = new WP_Query(
				[
					'buhservices' => 'buh',
					'orderby' => 'date',
					'order' => 'ASC'
				]
			);
			
            while($blocks->have_posts()) {
                $blocks->the_post();
                
				print_r('<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-block">');
                print_r('<h2>'.get_the_title().'</h2>');
                print_r(''.the_content().'');
                print_r('</div></div>');
                
				if ($counter == 17) {
                    print_r('<h2>Наши знаменитые партнёры</h2>');
                    print_r('<h3>Холдинг «РосБизнесРесурс» работает с клиентами по всей России</h3>');
                    get_template_part('our', 'clients');
                }
				
                $counter += 1;
            }
				
            ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>