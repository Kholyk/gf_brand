<?php
?>
<div class="container featured-items">  
            <h2>Обратите внимание на эти установки:</h2>
            <div class="row">

                <?php
                $range = get_posts([
                    'post_type' => 'installation',
                    'installations' => 'tesla',
                    'exclude' => array($post->ID),
                    'numberposts' => 4,
                ]);
                foreach ($range as $item) {
                    ?>
                    <div class="col-md-3">
                        <h4><a href="<?= get_permalink($item->ID); ?>"><?php print_r(get_post_meta($item->ID, 'fullname', true)); ?></a></h4>
                        <p class="small"><?php print_r(get_post_meta($item->ID, 'shortdesc', true)); ?><br />
                            Стоимость: от <b><?php print_r(number_format(get_post_meta($item->ID, 'price', true), 0, ',', ' ')); ?></b> Руб. (С НДС)
                        </p>
                    </div>
                <?php } ?>

            </div>
        </div>