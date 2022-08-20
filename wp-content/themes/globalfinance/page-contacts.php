<?php get_header();

require 'general.php';

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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 central-col">

                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                       <h3>Наш адрес:</h3>
                       <p>
                        <?php 
                        print_r($company['postcode'] . ', г. '.$company['city'][0] . ',<br />' . $company['address']);
                        ?>
                    </p>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <h3>Телефоны:</h3>
                      <p>
                        <?php
                            array_map(
                                function ($phone) {
                                    $phoneLink = createPhoneLink($phone, 'text-success text-bold');
                                    print_r($phoneLink . '<br />');
                                },
                                $company['phones']
                            ); ?> 
                      </p>   
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                       <h3>E-mail:</h3>
                          <p>
                             <i class="far fa-envelope text-success"></i> <a href="mailto:<?=$company['mailbox']?>">
                          <?=$company['mailbox']?></a>
                       </p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <h3><?=$company['worktime'][0]?></h3>
                        <p><?=$company['worktime'][1]?>,<br />СБ, ВС: выходной.</p>
                    </div>
                </div>
                <hr>
                <div id="map" style="width: 100%; height: 400px"></div>
            </div>       
        </div>
    </div>
</div>

 <!-- end of page layout -->

<?php
get_footer();

?>