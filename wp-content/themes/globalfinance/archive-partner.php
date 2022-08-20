<?php
get_header();
get_template_part('header', 'nav');

?>

<!-- <div class="container"> -->
    <div class="container module-container">
        <div class="row">
            <div id="tabs" class="col-lg-12 col-md-12 col-sm-12 col-12">
            <h1 class="d-none">Наши знаменитые партнёры</h1><br />
            <div  class="block-title">
            <!-- <h2>Холдинг «РосБизнесРесурс»</h2> -->
            <h3>Открытие счета у банка-партнера бесплатно!</h3>
</div>
                <?php get_template_part('our', 'clients')?>
            </div>
        </div>
    </div>
<!-- </div> -->

<?php get_footer(); ?>
